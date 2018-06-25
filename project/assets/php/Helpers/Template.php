<?php
namespace Hikify\Helpers;

class Template {
	public static $PATH			= '';
	public static $OPEN_TAG		= '[';
	public static $CLOSE_TAG	= ']';
	public static $BLOCKSTART	= ':';	// position: after open tag
	public static $BLOCKEND		= '/:'; // position: after open tag
	public static $VARIABLE		= '*';	// position: after open tag AND before close tag
	public static $IGNORE_TAG	= '--';	// position: after open tag
	public static $PREP_JS		= '&';  // position: after open tag

	private $html = '';
	private $meta = array();
	private $strFilePath = '';
	private $footer;
	private $header;
	private $header_spacing;
	private $footer_spacing;
	

	public static function GetTemplateListBox($parent, $glob_filter, $lang=null, $blnShowHidden=false) {
		$lst		= new QListBox($parent);
		$lst->Name	= 'Print';
		$lst->AddItem(tr("Select"));
		foreach(self::GetTemplates($glob_filter, $lang) as $file_path) {
			$helper = new Template; //start to helper to find the display en short names
			$helper->SetTemplate($file_path);
			
			if(!$blnShowHidden && $helper->IsHidden()) {
				continue;
			}
			
			$lst->AddItem($helper->GetDisplayName(), $file_path);
		}
		return $lst;
	}
	
	/***
	 * I KNOW this is almost the same code and this sucks but i have no time to fix this 
	 */
	public static function GetTemplateListBoxWithShortNames($parent, $glob_filter, $lang=null, $blnShowHidden=false) {
		$lst		= new QListBox($parent);
		$lst->Name	= 'Print';
		$lst->AddItem(tr("Select"));
		foreach(self::GetTemplates($glob_filter, $lang) as $file_path) {
			$helper = new Template(); //start to helper to find the display en short names
			$helper->SetTemplate($file_path);
			
			if(!$blnShowHidden && $helper->IsHidden()) {
				continue;
			}
			
			$lst->AddItem($helper->GetDisplayName(), $helper->GetShortName());
		}
		return $lst;
	}
	/**
	 * returns a list of pathnames from the template directory where the filename starts with the given name and - if language is given - ends with .<language>.html
	 * @param string $name
	 * @param string $lang
	 * @return array
	 */
	public static function GetTemplates($name, $lang = null) {		
		if (empty(self::$PATH)) {
			self::$PATH = sprintf("%s/%s/", __DOCROOT__, COMPANY_FOLDER);
		}

		if(!$lang){
			return glob(sprintf("%s%s*.html", self::$PATH, $name));
		}

		return glob(sprintf("%s%s*.%s.html", self::$PATH, $name, $lang));
	}

	/**
	 * returns a list of filenames from the template directory starting with the given name and - if language is given - ending with .<language>.html
	 * @param string $name
	 * @param string $lang
	 * @return array
	 */
	public static function GetTemplatesShortlist($name, $lang = null) {
		$files = self::GetTemplates($name, $lang);

		if(!is_null($lang) && !$files){
			$files = self::GetTemplates($name);
		}

		foreach ($files as $key => $filename) {
			$files[$key] = preg_replace("/^.*?([^\/]+)$/", "$1", $filename);
		}

		return $files;
	}

	public function __construct($template = null, $lang = null) {
//		if (empty(self::$PATH)) {
//			self::$PATH = sprintf("%s/%s/", __DOCROOT__, COMPANY_FOLDER);
//		}
//	
//		if ($template) {
//			if(!$this->SetTemplate(self::$PATH . $template . '.' . ($lang ? $lang : QApplication::$LanguageCode) . '.html')){
//				if(!$this->SetTemplate(self::$PATH . $template . '.html')){
//					throw new TemplateException('Template Not Found: ' . self::$PATH . $template .'.html');
//				}
//			}
//		}
	}

	public function Reset() {
		$this->html		= '';
		$this->header	= '';
		$this->footer	= '';
		$this->meta		= array();
	}
	
	public function __get($name) {
		switch($name){
			case 'Html'			: return $this->html;
			case 'Header'		: return $this->header;
			case 'Footer'		: return $this->footer;
			case 'HeaderSpacing': return $this->header_spacing;
			case 'FooterSpacing': return $this->footer_spacing;
		}

		if (isset($this->html)) {
			switch ($name) {
				case 'JSPrompt'	: return $this->GetVariablePromptString();
			}
		}
	}

	public function __set($name, $value) {
		switch ($name) {
			case 'Text' :
			case 'Html' : $this->html = $value; break;
			
			case 'Header' :
				if(file_exists(self::$PATH . $value)){
					$this->header = file_get_contents(self::$PATH . $value);
				}
				break;

			case 'Footer' :
				if(file_exists(self::$PATH . $value)){
					$this->footer = file_get_contents(self::$PATH . $value);
				}
				break;
				
			case 'HeaderSpacing' : $this->header_spacing = $value; break;
			case 'FooterSpacing' : $this->footer_spacing = $value; break;
			
		}
	}

	/**
	 *
	 * @return string
	 */
	public function GetVariablePromptString() {
		$prompt_string = '';
		foreach ($this->GetVariables() as $var) {
			$var = explode('|', $var, 2);
			$prompt_string .= "+'&'+ encodeURI('$var[0]')+'='+encodeURI(prompt('$var[0]','" . (isset($var[1]) ? $var[1] : '') . "'))";
		}
		return $prompt_string;
	}

	public function GetSignature() {
		if (isset($this->html)) {
			return strpos($this->html, '[Signature]');
		}
		return false;
	}

	/**
	 *
	 * @return array
	 */
	public function GetVariables() {
		if (isset($this->html)) {
			$o = '\\' . self::$OPEN_TAG;
			$c = '\\' . self::$CLOSE_TAG;
			$v = '\\' . self::$VARIABLE;
			preg_match_all("/$o$v(.*?)$v$c/", $this->html, $matches);
			return $matches[1];
		} else {
			return array();
		}
	}

	/**
	 * META TAGS
	 * ---------
	 * header => path/of/header
	 * footer => path/of/footer
	 * header_spacing => _px / _cm
	 * footer_spacing => _px / _cm
	 * non_zero_lines (no content - boolean tag -> <meta name="non_zero_lines"/>)
	 * @return array
	 */
	public function GetMetaData() {
		if (!count($this->meta) && isset($this->html)) {
			$meta		= preg_match_all('/<meta\s+name="([^"]+)"(?:\s+content="([^"]+)")?\s*\/?>/', $this->html, $matches);
			$this->meta = $meta ? array_combine($matches[1], $matches[2]) : array();
		}
		return $this->meta;
	}
	
	public function GetMetaTagValue($tagName) {
		$meta = $this->GetMetaData();
		if(isset($meta[$tagName])) {
			return $meta[$tagName];
		} else {
			return '';
		}
	}

	/**
	 * return true if the template is hidden (starts with _)
	 * @return boolean
	 */
	public function IsHidden() {
		return (substr($this->GetShortName(),0,1) === '_');
	}
	
	public function GetShortName() {
		return substr($this->strFilePath, strrpos(self::$PATH, '/')+1);
	}
	
	public function GetDisplayName() {
		$displayName = $this->GetMetaTagValue('display_name');
		return $displayName ? $displayName : $this->GetShortName();
	}
	/**
	 *
	 * @param array $variables
	 */
	public function SetVariables($variables) {
		if (isset($this->html)) {
			if($variables && is_array($variables)) {
				foreach ($variables as $key => $value) {
					if (is_array($value)) {
						continue;
					} // arrays will fail so fuck them
					$this->SetVariable($key, $value);				
				}
			}
		}
	}

	public function SetVariable($key, $value) {
		$o = '\\' . self::$OPEN_TAG;
		$c = '\\' . self::$CLOSE_TAG;
		$v = '\\' . self::$VARIABLE;
	
		$k			= str_replace('_', ' ', $key);
		$regx		= "/$o$v$k(?:\\|[^$v]+)?$v$c/";
		$this->html = preg_replace($regx, ($value != 'null' ? $value : ''), $this->html);

		if($this->header){
			$this->header = preg_replace($regx, ($value != 'null' ? $value : ''), $this->header);
		}
		if($this->footer){
			$this->footer = preg_replace($regx, ($value != 'null' ? $value : ''), $this->footer);
		}
	}

	/**
	 * Set template
	 * @param string $src full path to template
	 */
	public function SetTemplate($src) {
		if (file_exists($src)) {
			$this->html		= file_get_contents($src);
			$this->strFilePath = $src;
			return true;
		} else {
			return false;
		}
	}

	/**
	 *
	 * @param array $records
	 * @param string $name
	 */
	public function SetBlockValues($records, $name) {
		if (isset($this->html)) {
			$doc		= $this->html;
			$blockstart = self::$OPEN_TAG . self::$BLOCKSTART	. $name . self::$CLOSE_TAG;
			$blockend	= self::$OPEN_TAG . self::$BLOCKEND		. $name . self::$CLOSE_TAG;
			$start_s	= stripos($doc, $blockstart);
			$start_e	= $start_s + strlen($blockstart);
			$end_s		= stripos($doc, $blockend);
			$end_e		= $end_s + strlen($blockend);
			if ($start_s && $end_s) {
				$block	= substr($doc, $start_e, $end_s - $start_e);
				$lines	= '';
				foreach ($records as $values) {
					list($tags, $replacements) = $this->GetReplacementArrays($values);
					$lines .= str_replace($tags, $replacements, $block);
				}
				$block		= substr($doc, $start_s, $end_e - $start_s);
				$this->html = str_replace($block, $lines, $doc);
			}
		}
	}

	/**
	 *
	 * @param array $values
	 */
	public function SetValues($values) {
		if (isset($this->html)) {
			list($tags, $replacements) = $this->GetReplacementArrays($values);

			$this->html = str_replace($tags, $replacements, $this->html);

			if($this->header){
				$this->header = str_replace($tags, $replacements, $this->header);
			}
			if($this->footer){
				$this->footer = str_replace($tags, $replacements, $this->footer);
			}
		}
	}

	public function ClearUnusedTags() {
		if($this->html){
			$o1		= '\\' . self::$OPEN_TAG . '\\' . self::$BLOCKSTART;
			$c1		= '\\' . self::$OPEN_TAG . '\\' . self::$BLOCKEND;

			$o2		= '\\' . self::$OPEN_TAG;
			$c2		= '\\' . self::$CLOSE_TAG;

			$ig		= '\\' . self::$IGNORE_TAG;

			$from	= array("/$o1.*?$c1.*?$c2/s", "/$o2(?!$ig).*?$c2/", "/{$o2}{$ig}(.*?)$c2/");
			$to		= array("", "", "[$1]");

			$this->html	= preg_replace($from, $to, $this->html);

			if($this->header){
				$this->header	= preg_replace($from, $to, $this->header);
			}
			if($this->footer){
				$this->footer	= preg_replace($from, $to, $this->footer);
			}
		}
	}
	
	public function MakePDF($filename = 'export', $download = true, $orientation='portrait'){
		$pdfhelper = new PdfHelper();
		$pdfhelper->set_orientation($orientation);
		$pdfhelper->SetHtml($this->html);
		
		if($this->header){
			$pdfhelper->SetHeader($this->header);
		}
		if($this->footer){
			$pdfhelper->SetFooter($this->footer);
//			echo $this->footer;
//			exit;
		}
		if($this->header_spacing){
			$pdfhelper->SetHeaderSpacing($this->header_spacing);
		}
		if($this->footer_spacing){
			$pdfhelper->SetFooterSpacing($this->footer_spacing);
		}
		
		$pdfhelper->Render();
		
		if($download){
			$pdfhelper->Output(PdfHelper::$PDF_DOWNLOAD, $filename . '.pdf');
			exit(0);
		} else {
			return $pdfhelper->Output(PdfHelper::$PDF_ASSTRING, $filename . '.pdf');
		}
	}
	
	private function PrepForJavaScript($string, $html = false){
		return addslashes(preg_replace('/\r\n|\r|\n/', $html ? '<br>' : ' ', $string));
	}
	
	private function GetReplacementArrays($values){
		$r = array();

		foreach ($values as $key => $val) {
			$r[0][] = self::$OPEN_TAG . $key . self::$CLOSE_TAG;
			$r[0][] = self::$OPEN_TAG . self::$PREP_JS . $key . self::$CLOSE_TAG;
			$r[1][] = ($val);
			$r[1][] = $this->PrepForJavaScript($val,true);
		}

		return $r;
	}
}

if(!class_exists('TemplateException')) {
	class TemplateException extends \Exception {}
}

/*****************
 * DATACOLLECTOR *
 *****************/
class DataCollector {
	/** OBJECTS */
	/** @var QDateTime		*/ protected $now;
	/** @var Contract		*/ protected $contract;
	/** @var Contract		*/ protected $parent_contract;
	/** @var Vehicle		*/ protected $vehicle;
	/** @var Composition		*/ protected $composition;
	/** @var Fuelcard		*/ protected $fuelcard;
	/** @var Invoice		*/ protected $invoice;

	/** PEOPLE */
	/** @var Company		*/ protected $supplier;
	/** @var Company		*/ protected $client;
	/** @var Company		*/ protected $company;
	/** @var Driver			*/ protected $driver;

	/** ARRAYS */
	/** @var Contract[]			*/ protected $contracts;
	/** @var Contract[]			*/ protected $child_contracts;
	/** @var ContractField[]		*/ protected $contract_fields;
	/** @var Contract[]			*/ protected $contracts_current;
	/** @var Vehicle[]			*/ protected $vehicles;
	/** @var Vehicle[]			*/ protected $vehicles_current;
	/** @var Driver[]			*/ protected $drivers;
	/** @var Driver[]			*/ protected $drivers_current;
	/** @var InvoiceLine[]		*/ protected $invoice_lines;
	/** @var composition[]		*/ protected $compositions;
	/** @var CompositionLine[]	*/ protected $composition_lines;

	/** META */
	private $meta = array();
	private $arrBlocks = array();
	private $arrObjects= array();
	
	public function __construct($objects = null, $cascade = false) {
		$this->now = new \DateTime(date('d-m-Y'));
		
		if (is_array($objects)) {
			foreach ($objects as $value) {
				$this->Load($value, $cascade);				
			}
		}
	}

	protected function init($class, $id) {
		switch ($class) {
			case 'Contract'		: return Contract::LoadById($id, $this->GetContractClauses());
			case 'Vehicle'		: return Vehicle::LoadById($id, $this->GetVehicleClauses());
			case 'Invoice'		: return Invoice::LoadById($id, $this->GetInvoiceClauses());
			default:
				throw new Exception('I DIDNT EXPECT THIS TO HAPPEN');
				//return $this->Load($class, $id);
		}
	}

	/**
	 * 
	 * @param string $strQueryString a querystring in the following form ?1&objects['Contract']=5&objects['Vehicle']=6&objects['Violation']=454
	 */
	public function LoadObjectsByQueryString($strQueryString) {
		$objects		= array();
		parse_str($strQueryString, $objects); //now lets parse the query string (eg: ?1&objects['Contract']=5&objects['Vehicle']=6&objects['Violation']=454
		if(isset($objects['objects'])) {
			foreach($objects['objects'] as $strTagName=>$intObjectId) {
				if($intObjectId) {
					if(isset($objects['classes']) && isset($objects['classes'][$strTagName])) {
						$strObjectName = $objects['classes'][$strTagName];
					} else {
						$strObjectName = $strTagName;
					}
					
					$objObject = $strObjectName::Load($intObjectId);
					$this->Load($objObject, $strTagName); //load the object
				}
			}
		}
	}
	
	public function Load($objObject, $tagName=null) {
		if(!is_object($objObject)) {
			throw new \Exception('Has to be an object');
		}
		if(is_null($tagName)) {
			$tagName = get_class($objObject);
		}
		$this->arrObjects[$tagName] = $objObject;
	}

	public function LoadArray(array $arr, $tagName=null) {
		if(is_null($tagName) && isset($arr[0])) {
			$tagName = get_class($arr[0]);
		}
		$this->arrBlocks[$tagName] = $arr;
	}
	
	public function Parse(Template &$helper) {
		// load meta
		$this->meta			= $helper->GetMetaData();

		if(isset($this->meta['header'])){
			$helper->Header = $this->meta['header'];
		}
		if(isset($this->meta['footer'])){
			$helper->Footer = $this->meta['footer'];
		}
		if(isset($this->meta['header_spacing'])){
			$helper->HeaderSpacing = $this->meta['header_spacing'];
		}
		if(isset($this->meta['footer_spacing'])){
			$helper->FooterSpacing = $this->meta['footer_spacing'];
		}

		// get data
		$values	= $this->collect_values();

		// block values
		foreach($this->arrBlocks as $tagName => $arr) {
			$tags = $this->collect_block_values($arr);
			if ($tags)	{ 
				$helper->SetBlockValues($tags, $tagName);				
			}
		}
		
//		$helper->SetVariables($_GET);
		$helper->SetValues($values);
		$helper->ClearUnusedTags();//always do this, else our javascript wont work

		return $helper->Html;
	}

	public function GetValues(){
		// get data
		return $this->collect_values();
	}

	protected function collect_object_values() {
		$values = array();
		foreach ($this->arrObjects as $tagName=>$object) {
			$r		= $object->GetTemplateTags($tagName);
			if(!is_array($r)) {
				throw new Exception('Template tags function for tagname: ' . $tagName . ' is not an array. It looks like a ' . gettype($r));
			}
			$values = array_merge($values, $r);
		}
		return $values;
	}
	
	protected function collect_values() {
		if(isset($_SESSION['USER'])){
			/** @var User */
			$user = \User::LoadById($_SESSION['USER']);
		} else {
			$user = false;
		}
		

		/***************
		 * GLOBAL TAGS *
		 ***************/
		$values = array(
			/* Current Date & Time */
			'Now'						=> $this->now->format('d-m-Y'),
			'Year'						=> $this->now->format('Y'),
			'NowTime'					=> $this->now->format('H:i'),

			/* Current User */
			'User'						=> $user ? $user->FirstName	: "",
			'UserMail'					=> $user ? $user->Email : "",

		);
		
		
		return array_merge($values, $this->collect_object_values());
	}


	protected function collect_block_values($arrObjects) {
		$arr = array();
		foreach ($arrObjects as $object) {
			$arr[] = $object->GetTemplateTags(get_class($object));
		}
		
		return $arr;
	}
	
	private static function GetContractClauses(){
		return QCubed\Query\QCubed\Query\QQ::Clause(
			QCubed\Query\QQ::Expand(\QQN::Contract()->Client),
			QCubed\Query\QQ::Expand(\QQN::Contract()->Underwriter),
			QCubed\Query\QQ::Expand(\QQN::Contract()->Type),
			QCubed\Query\QQ::Expand(\QQN::Contract()->Remark),
			QCubed\Query\QQ::ExpandAsArray(\QQN::Contract()->ContractField));
	}

	private static function GetVehicleClauses(){
		return QCubed\Query\QQ::Clause(
			QCubed\Query\QQ::Expand(\QQN::vehicle()->Make),
			QCubed\Query\QQ::Expand(\QQN::Vehicle()->Model->Make));
	}
	
	private static function GetDriverClauses(){
		return QCubed\Query\QQ::Clause(
			QCubed\Query\QQ::Expand(\QQN::Driver()->Address1),
			QCubed\Query\QQ::Expand(\QQN::Driver()->Address1->Town),
			QCubed\Query\QQ::Expand(\QQN::Driver()->Address1->Town->Country),
			QCubed\Query\QQ::Expand(\QQN::Driver()->Address2),
			QCubed\Query\QQ::Expand(\QQN::Driver()->Address2->Town),
			QCubed\Query\QQ::Expand(\QQN::Driver()->Address2->Town->Country),
			QCubed\Query\QQ::Expand(\QQN::Driver()->Remark));
	}
	
	private static function GetCompanyClauses(){
		return QCubed\Query\QQ::Clause(
			QCubed\Query\QQ::Expand(\QQN::Company()->Address1),
			QCubed\Query\QQ::Expand(\QQN::Company()->Address1->Town),
			QCubed\Query\QQ::Expand(\QQN::Company()->Address1->Town->Country),
			QCubed\Query\QQ::Expand(\QQN::Company()->Address2),
			QCubed\Query\QQ::Expand(\QQN::Company()->Address2->Town),
			QCubed\Query\QQ::Expand(\QQN::Company()->Address2->Town->Country),
			QCubed\Query\QQ::Expand(\QQN::Company()->BusinessType));
	}
	
	private static function GetInvoiceClauses(){
		return QCubed\Query\QQ::Clause(
			QCubed\Query\QQ::Expand(\QQN::Invoice()->Invoicedby),
			QCubed\Query\QQ::Expand(\QQN::Invoice()->Invoicedby->Company),
			QCubed\Query\QQ::Expand(\QQN::Invoice()->Invoicedby->Driver),
			QCubed\Query\QQ::Expand(\QQN::Invoice()->Invoicedto),
			QCubed\Query\QQ::Expand(\QQN::Invoice()->Invoicedto->Company),
			QCubed\Query\QQ::Expand(\QQN::Invoice()->Invoicedto->Driver),
			QCubed\Query\QQ::Expand(\QQN::Invoice()->Journal),
			QCubed\Query\QQ::ExpandAsArray(\QQN::Invoice()->InvoiceLine));
	}
	
	private static function GetCompositionClauses(){
		return QCubed\Query\QQ::ExpandAsArray(\QQN::Composition()->CompositionLine);
	}
	
	
}