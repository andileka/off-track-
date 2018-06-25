<?php

namespace Hikify\Pages\Planning;

class Listing extends \QCubed\Control\Panel {

	/** @var \QCubed\Control\Panel */
	public $pnlIndex;
	/**
	 *
	 * @var \QCubed\Project\Control\Mapbox 
	 */
	public $mpbox;
	/**
	 *
	 * @var \AppointmentList 
	 */
	public $tblAppointment;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstExpert;
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
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/planning/listing.tpl.php';

		$this->addCssFile("/project/assets/css/datatables.css");	
		$this->Build();
		if(isset($_GET['e']) && $_GET['e']!== "" && isset($_GET['d'])){
			$this->lstExpert->SelectedValues = explode(',',$_GET['e']);
			$this->ddtDate->DateTime = $_GET['d'];
			$this->Databind();
			
		}
		
	}
	public function GetConditions(){
		$conditions = array();
		$conditions[] = \QCubed\Query\QQ::in(\QQN::appointment()->ExpertId, $this->lstExpert->SelectedValues);
		
		
		if($this->ddtDate->DateTime){			
			$conditions[] = \QCubed\Query\QQ::Equal(\QQN::appointment()->PreferredDate, $this->ddtDate->DateTime->format('Y-m-d'));
		}
		
		return $conditions;
	}
	public function Databind(){		
		$this->ShowTabs(true);	
		$conditions = $this->GetConditions();
		
		if(count($conditions) > 0) {
			$this->tblAppointment->Condition = \QCubed\Query\QQ::andCondition($conditions);
		} 
		
		$this->tblAppointment->Databind();
	}
	
	public function GetAllFilteredAppontments(){
		$conditions = array();
		$conditions = $this->GetConditions();
		
		if(count($conditions) > 0) {
			return \Appointment::QueryArray( \QCubed\Query\QQ::andCondition($conditions));
		} 
		
		
	}
	
	public function GetAllAppointments() {
		$minutes = 480; /* START AT 8AM (+8H)*/
		$colors = [];
		$arrItems = array();
		$arrClosingDays = $this->GetAllFilteredAppontments();
		foreach ($arrClosingDays as $objClosingDay) {
			if(!array_key_exists((string)$objClosingDay->Expert,$colors)){
				$colors[(string)$objClosingDay->Expert] = $this->rand_color();
			}
			
			$dateStart = new \QCubed\QDateTime($objClosingDay->PreferredDate->format("YmdHis"));
			$dateEnd = new \QCubed\QDateTime($objClosingDay->PreferredDate->format("YmdHis"));
			$arrItems[] = new \QCubed\Project\Jqui\SchedulerItem($objClosingDay->Id, $dateStart->addMinutes($minutes), $dateEnd->addMinutes(($minutes+60)), $objClosingDay->Expert.":".$objClosingDay->Entity . " ".$objClosingDay->Entity->VisitingAddress,$colors[(string)$objClosingDay->Expert],$objClosingDay->Expert  );
			/* ADD ONE HOUR TO SHOW ALL THE APPOINTMENTS FOR THIS DAY */
			$minutes = $minutes + 60;
		}

		return $arrItems;
	}
	public function rand_color() {
		return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
	}
	private function HideNotification(){
		$this->pnlNotification->Display =false;
	}
		
	private function Build() {		
		$this->navPlanning = new \QCubed\Bootstrap\Nav($this);
		$this->navPlanning->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "Click"));
		
		$this->pnlNotification						= new \QCubed\Control\Panel($this);
		$this->pnlNotification->AddCssClass("callout callout-warning ");
		$this->pnlNotification->Text				= tr('<p><i class="fa fa-warning" aria-hidden="true"></i> '.tr("Select Expert and Date").'</p>');
		
		$this->ShowTabs(false);
		$this->BuildFilter();
				
	}
	
	protected function Click(){
		/* Show map full 100% width */
		\QCubed\Project\Application::executeJavaScript("window.dispatchEvent(new Event('resize'));");
	}
	
	protected function Search(){
		\QCubed\Project\Application::redirect('?c=planning&a=listing&e='.join(',',$this->lstExpert->SelectedValues).'&d='.$this->ddtDate->DateTime); 
	}
	
	protected function DraWMap(){

		$arrAddresses = [];
		$arrAppointments = $this->GetAllFilteredAppontments();
		foreach($arrAppointments as $appointment){
//			
			if($appointment->Place){
				$arrAddresses[] = $appointment->Place;
				$arrExperts["Appointments"][]	= $appointment;
			}
//			print_r($arrAddresses);
		}
//		exit;
		if(count($arrAddresses) > 0){	
			$this->mpbox				= new \QCubed\Project\Control\Mapbox($this->navPlanning);		
			$this->mpbox->Name			= tr("Mapview");
			$arrSortedAddresses			= $arrAddresses;
			
			/* 
			 * DrawMapWithPins() => $strType = Marker
			 * Draw()  		     => $strType = null
			 * 
			 */
			
			$strType = "Marker";
			if(count($arrAddresses) > 2 && $strType !== "Marker"){	
				/* MIN 2 COORDINATES REQUIRED */
//				$arrSortedAddresses = $this->mpbox->OptimizeAddresses($arrAddresses);
			}
			$arrExperts["SortedLocation"] = ($arrAddresses);
			
			$arrCoordinates = array_map(function(\Address $objAddress) {
				return $objAddress->Coordinates;
			}, $arrAddresses); //ff adressen omzetten naar coordinates
			$this->mpbox->setMapLayerSettings($strType);
			$this->mpbox->DrawMapWithPins($arrCoordinates,$arrExperts);
		}
	}
	
	protected function DrawCalendar(){
		$this->pnlCal = new \QCubed\Project\Jqui\Scheduler($this->navPlanning);
		$this->pnlCal->Name = tr('Calendarview');
		$this->pnlCal->SetItems($this->GetAllAppointments());
		$this->pnlCal->setMultipleExpertsViews(false);
		$this->pnlCal->setView(array(\QCubed\Project\Jqui\Scheduler::VIEW_DAY,\QCubed\Project\Jqui\Scheduler::VIEW_WEEK, \QCubed\Project\Jqui\Scheduler::VIEW_AGENDA));
		if($this->ddtDate){
			$this->pnlCal->setDay($this->ddtDate->DateTime->format('Y,d,m'));
		}else{
			$this->pnlCal->setDay(date('Y,m,d'));
		}
		
		$this->pnlCal->Draw();

//		$this->pnlCal->addAction(new \QCubed\Project\Jqui\SchedulerItemCreate(), new \QCubed\Action\AjaxControl($this, "OnCalCreate"));
//		$this->pnlCal->addAction(new \QCubed\Project\Jqui\SchedulerItemChange(), new \QCubed\Action\AjaxControl($this, "OnCalChange"));
//		$this->pnlCal->addAction(new \QCubed\Project\Jqui\SchedulerItemDelete(), new \QCubed\Action\AjaxControl($this, "OnCalDelete"));
	}
	
	protected function BuildFilter(){
		$this->lblFilter = new \QCubed\Control\Label($this);
		$this->lblFilter->Text = tr('Filter');
		
		$this->lstExpert					= \Expert::GetListBox($this);
		$this->lstExpert->Name				= tr('Expert');
		$this->lstExpert->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'Search'));
		$this->lstExpert->SelectionMode = "Multiple";
		
		$this->ddtDate						= new \QCubed\Project\Jqui\DatepickerBox($this);
		$this->ddtDate->Name				= tr('Date');
		$this->ddtDate->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'Search'));
		$this->ddtDate->Text				= date('d-m-Y');
		
	}
	
	protected function ShowTabs($blnShow=false){
		if($blnShow){
			$this->HideNotification();
			$this->navPlanning->removeChildControls(true);
						
			$this->tblAppointment						= new \AppointmentList($this->navPlanning);
			$this->tblAppointment->Name					= tr("Listview");
			$this->tblAppointment->CssClass				= 'work_table table';
			$this->tblAppointment->CreateColumns();
			
			$this->pnlChart						= new \QCubed\Project\Jqui\ChartJS($this->navPlanning);
			$this->pnlChart->Name				= tr("Chartview");
			$this->pnlChart->SetDataSet("bar",$this::SetChartData());
			$this->pnlChart->Draw();
			
			$this->DraWMap();
			$this->DrawCalendar();
		}
		
	}
	
	protected function SetChartData(){
		
		$dayname = $this->ddtDate->DateTime->format('l');
		$arrBookedAppointments = [];
		$arrMaxAppointment = [];
		$arrExpertNames = [];
		foreach($this->lstExpert->SelectedValues as $Expert){
			$objExpert = \Expert::load((int) $Expert);
			if($objExpert){
				// DO SOMETHING
				$sum = ($objExpert->{'MaxAppointments'.$dayname.'Am'} + $objExpert->{'MaxAppointments'.$dayname.'Pm'});
				$bookedAppointments = count(\Appointment::loadArrayByDayAndExpert($Expert, $this->ddtDate->DateTime->format('Y-m-d')));
				$arrBookedAppointments[] = $bookedAppointments;
				$arrMaxAppointment[] = $sum - $bookedAppointments;
				$arrExpertNames[]	= $objExpert->User->FirstName;
			}
		}
		$arrData = array($arrBookedAppointments,$arrMaxAppointment,$arrExpertNames );
		
		return $arrData;
	}
}
