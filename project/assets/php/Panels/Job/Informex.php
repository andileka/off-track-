<?php

namespace Hikify\Panels\Job;

class Informex extends \QCubed\Control\Panel {
	/** 
	 * 
	 * @var \QueueInformexList  
	 */
	public $dgInformex;

	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/panels/job/informex.tpl.php';
		$this->Build();
		
	}
	
	public function GetAccordionHeader($blnRefresh = false) {
		if($blnRefresh) {
			parent::refresh();
		}
		$count = count(\QueueInformex::loadAll());
		if($count > 0) {
			return 'Informex' . ': ' . $count;
		}
		return 'Informex';
	}
	
	public static function ParseInformexData(\QueueInformex $objQueueInformex) {
		return $arrResults = json_decode($objQueueInformex->RawData);
	}
	
	private function Build() {
		$this->dgInformex				= new \QueueInformexList($this); 
		$this->dgInformex->CssClass	= 'jobs_table table';		
		$this->dgInformex->CreateColumns();
		$this->dgInformex->Register("OnClick","btnlink_click",$this);

	}
	
	public function btnlink_click($intExternInformexId, $strQueueInformexReference, $intJobId){
		\QCubed\Project\Application::Log('$intExternInformexId :'.$intExternInformexId);
		\QCubed\Project\Application::Log('$strQueueInformexReferenc :'.$strQueueInformexReference);
		\QCubed\Project\Application::Log('$intJobId :'.$intJobId);
		if($intExternInformexId && $strQueueInformexReference && $intJobId) {
			$objJob = \Job::loadById($intJobId);
			$objJob->JobExternInformexId = $intExternInformexId;
			$objJob->Save();
			
			\QueueInformex::DeleteByReference($strQueueInformexReference);
			$this->dgInformex->dataBind();
			
		}

	}
}