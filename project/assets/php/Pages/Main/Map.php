<?php

namespace Hikify\Pages\Main;

class Map extends \QCubed\Control\Panel {

	/** @var \QCubed\Control\Panel */
	public $pnlIndex;
	/**
	 *
	 * @var \QCubed\Project\Control\Mapbox 
	 */
	public $mpbox;
	/**
	 *
	 * @var \PositionList
	 */
	public $tblTourist;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstTourist;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Datepicker
	 */
	public $ddtDate;
	/**
	 *
	 * @var \QCubed\Bootstrap\Label
	 */
	public $lblFilter;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Scheduler 
	 */
	public $pnlCal;
	/**
	 *
	 * @var \QCubed\Project\Jqui\ChartJS 
	 */
	public $pnlChart;
	/**
	 *
	 * @var \QCubed\Bootstrap\Nav
	 */
	public $navPlanning;
	/**
	 *
	 * @var Panel 
	 */
	public $pnlNotification;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/main/map.tpl.php';

		
		$this->Build();
		if(isset($_GET['e']) && $_GET['e']!== ""){
			$this->lstTourist->SelectedValues = explode(',',$_GET['e']);
			
		}
		$this->Databind();	
		
	}
	public function GetConditions(){
		$conditions		= array();
		$conditions[]	= \QCubed\Query\QQ::in(\QQN::tourist()->Id, $this->lstTourist->SelectedValues);
		$conditions[]	= \QCubed\Query\QQ::isNotNull(\QQN::tourist()->PositionId);

				
		return \QCubed\Query\QQ::andCondition($conditions);
	}
	
	public function Databind(){		
		$this->ShowTabs(true);	
		$this->tblTourist->Condition =$this->GetConditions();
		
		$this->tblTourist->Databind();
	}

	/**
	 *
	 * @return \Position[]
	 */
	public function GetAllFilteredTourists(){
		return \Tourist::QueryArray($this->GetConditions());
	}

	
	public function rand_color() {
		return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
	}

	
	private function Build() {		
		$this->navPlanning = new \QCubed\Bootstrap\Nav($this);
		$this->navPlanning->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "Click"));
		
		$this->ShowTabs(false);
		$this->BuildFilter();
				
	}
	
	protected function Click(){
		/* Show map full 100% width */
		\QCubed\Project\Application::executeJavaScript("window.dispatchEvent(new Event('resize'));");
	}
	
	protected function Search(){
		\QCubed\Project\Application::redirect('?c=main&a=map&e='.join(',',$this->lstTourist->SelectedValues).'&d='.$this->ddtDate->DateTime);
	}
	
	protected function DraWMap(){
		$arrTourists = \Tourist::loadAll();
		if(!count($arrTourists)) {
			return;
		}
		$this->mpbox				= new \QCubed\Project\Control\Mapbox($this->navPlanning);
		$this->mpbox->Name			= tr("Mapview");

		$arrCoordinates = array();
		$arrProperties	= array();
		
		foreach($arrTourists as $objTourist) {
			$arrCoordinates[]			= (string)$objTourist->Position;
			$strAdditionalClassName		= '';

			if(isset($_GET['highlight']) && $objTourist->Id == $_GET['highlight'] || $objTourist->Status == \Tourist::REQUESTED_HELP) {
				$strAdditionalClassName = ' blink';
				$this->mpbox->SetMapCenter($objTourist->Position->Lat, $objTourist->Position->Long);
			}

			$event = $objTourist->Position->Event;
			$arrProperties[]	=	array(
										'title'=>(string)$objTourist->GetUrl(),
										'description'=>$objTourist->Status . '<br/>'.(string)$objTourist->Language->Name . '<br/>'.$objTourist->Contactinfo . '<br/>'.($event ? ' last known position recorded on ' . $event : ''),
										'className'=>$objTourist->Status . $strAdditionalClassName
									) ;
		}
		
		$this->mpbox->Draw($arrCoordinates, $arrProperties);
		
	}
	
	protected function DrawCalendar(){
		
	}
	
	protected function BuildFilter(){
		$this->lblFilter = new \QCubed\Control\Label($this);
		$this->lblFilter->Text = tr('Filter');
		
		$this->lstTourist					= \Tourist::GetListBox($this);
		$this->lstTourist->Name				= tr('Tourist');
		$this->lstTourist->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'Search'));
		$this->lstTourist->SelectionMode = "Multiple";
		
		$this->ddtDate						= new \QCubed\Project\Jqui\DatepickerBox($this);
		$this->ddtDate->Name				= tr('Date');
		$this->ddtDate->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'Search'));
		$this->ddtDate->Text				= date('d-m-Y');
		
	}
	
	protected function ShowTabs($blnShow=false){
		if($blnShow){
			$this->navPlanning->removeChildControls(true);
						
			$this->DraWMap();

			$this->tblTourist						= new \TouristList($this->navPlanning);
			$this->tblTourist->Name					= tr("Listview");
			$this->tblTourist->CssClass				= 'work_table table';
			$this->tblTourist->CreateColumns();
			/*
			$this->pnlChart						= new \QCubed\Project\Jqui\ChartJS($this->navPlanning);
			$this->pnlChart->Name				= tr("Chartview");
			$this->pnlChart->SetDataSet("bar",$this::SetChartData());
			$this->pnlChart->Draw();
			*/
			
			$this->DrawCalendar();
		}
		
	}
	
	protected function SetChartData(){
		return array();		
	}
}
