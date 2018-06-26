<?php

namespace Hikify\Panels;

use \QCubed\Plugin\Bootstrap as Bs;

class Navigator extends \QCubed\Control\Panel {
	public $icoWait;
	public $itemsLeft	= array();
	public $itemsRight	= array();
	public $subNav      = array();
	public static $expertName;
	public static $jobNr;
	public static $Lisenceplate;	
	public $ctrl;
	public $action;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstLanguage;
	public $params		= array(); // to pass parameters from parent
	public $navItems   = array(
		'main'			=> array('map'),
		'tourist'		=> array('listing','find-me'),
		'planning'		=> array(),
		'maintenance'	=> array(
			'device' => array('device'),
			'config' => array('config'),
			'users' => array('users'),
			/*'teams' => array('teams'),
			'workflow' => array('workflow'),
			'job' => array('jobtype','jobrole','jobstatus'),
			'entity' => array('entity','relationrole'), 
			'expert' => array('expert'),
			'communication' => array('templates','documents'),
			'customfields' => array('customfields'),
			'area' => array('area'),
			'appointments' => array('appointmenttype', 'controltype'),*/
		),
//		'booking' => array('booking'),
	);
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		$this->SetItemsRight();
		$this->icoWait						= new \QCubed\Control\WaitIcon($this);
		$this->strTemplate					= __TEMPLATES__ . '/panels/navigator.tpl.php';
		$this->addCssFile('https://use.fontawesome.com/releases/v5.0.6/css/all.css');
		
		
		$this->AddCssClass('main-header');
		$this->AddMenuLang();
	}
	
	public static function SetJobInfoInMenu(\Job $objJob=null, $objAppointment=null ){
		self::$jobNr			=	$objJob->Id;
		self::$Lisenceplate		= ($objJob->VehicleId) ? $objJob->Vehicle->Plate : '';
		self::$expertName		= ($objAppointment) ? $objAppointment->Expert : '';  
	}
	
	public function AddMenuLang(){
		$this->lstLanguage						= new \QCubed\Project\Control\ListBox($this);
		$this->lstLanguage->addCssClass("selectpicker custom-select minimal");
		$this->lstLanguage->addWrapperCssClass("input-group");
		$this->lstLanguage->HtmlBefore					= "<span class='input-group-addon'><i class='fas fa-globe'></i></span>";
		$this->lstLanguage->addAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this,"SetLanguage"));
		$arrLang = array(
			"BE" => "nl_BE",
			"NL" => "nl_NL",
			"FR" => "fr_FR",
			"EN" => "en_GB",
		);
		foreach($arrLang as $key => $lang){
			$this->lstLanguage->addItem($key, $lang);
		}
			$this->lstLanguage->SelectedValue = \QCubed\Project\Application::$LanguageCode;
		
		
	}
	public function SetLanguage(){
		\QCubed\Project\Application::SetLanguage($this->lstLanguage->SelectedValue);
	}
	public function GetNavItems(){
		return $this->navItems;
	}
	public function Render($blnDisplayOutput = true) {
		$this->SetItemsLeft();
		$this->SetSubNav();
		return parent::Render($blnDisplayOutput);
	}
		
	public function ClearItems() {
		//$this->itemsLeft = $this->itemsRight = array();
	}
	
	private function SetItemsLeft(){
		foreach($this->navItems as $key => $item){
			if($key == "main"){
				$this->itemsLeft[] = sprintf('<li%s><a href="index.php?c=%s&a=map" aria-controls="subnav-%s" data-target="#subnav-%s" class="'.$key.'">%s</a></li>',
				($this->ctrl === $key ? ' class="active"' : ''), $key, $key, $key, ucfirst(tr($key)));
			}else{
				$this->itemsLeft[] = sprintf('<li%s><a href="index.php?c=%s&a=listing" aria-controls="subnav-%s" data-target="#subnav-%s" class="'.$key.'">%s</a></li>', 
				($this->ctrl === $key ? ' class="active"' : ''), $key, $key, $key, ucfirst(tr($key)));
			}
			
		}
	}
	
	private function SetItemsRight(){
		$this->itemsRight[] = sprintf('<li><a href="index.php?c=help">%s</a></li>', tr('Help'));		
	}
	
	private function SetSubNav() {
		$navbarItems = [];

		if(isset($_GET['c'])){
			switch($_GET['c']){
				case "maintenance":
					$navbarItems['maintenance'] = $this->navItems['maintenance'];
				break;
				default :
					$navbarItems['tourist'] = $this->navItems['tourist'];
				break;
			}
		}
		foreach($navbarItems as $key => $item){			
			$subnav = array();
			if (count($item) > 0) {
				$subnav[] = '<ul class="nav navbar-nav navbar-left">';
				foreach($item as $keyDropdown => $subitem) {
					if(is_array($subitem)){
						$subnav[] = '<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.ucfirst(tr($keyDropdown)).'<span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">';
						foreach($subitem as $itemkey => $Dropdown){
							$subnav[] = '<li role="presentation"' . ($this->action === $Dropdown ? ' class="active"' : '') . '><a href="index.php?c=' . $key . '&a=' . $Dropdown  . '">' . ucfirst(tr($Dropdown)) . '</a></li>';
						}
						$subnav[] = '</ul></li>';
					}else{
						$subnav[] = '<li role="presentation"' . ($this->action === $subitem ? ' class="active"' : '') . '><a href="index.php?c=' . $key . '&a=' . $subitem  . '">' . ucfirst(tr($subitem)) . '</a></li>';
					}
				}
				$subnav[] = '</ul>';
				$this->subNav[] = sprintf('<div role="tabpanel" class="tab-pane%s" id="subnav-%s">%s</div>',
				($this->ctrl === $key ? ' active' : ''), $key, implode('', $subnav));
			}
		}
	}
}