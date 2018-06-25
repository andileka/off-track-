<?php

namespace Hikify\Pages\Maintenance;

class Test extends \QCubed\Control\Panel {
	/* test communication */
	/*public $lstTemplates;
	public $lstEntityEmailList;
	public $txtSubject;
	public $ckMessage;
	
	/* end test communication */
	/* mapbox */
	/*
	public $mpbox;*/
	
	
	
	
	/**
	 *
	 * @var \QCubed\Project\Jqui\Scheduler 
	 */
	public $pnlCal;
	
	
	/* end */
	public $btnSave;
	private $EntityId;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);

		$this->strTemplate = __TEMPLATES__ . '/pages/maintenance/test.tpl.php';
		$this->EntityId = 2;
		$this->Build();
	}

	public function ShowExpertiseLocations() {
		/* Add locations into listbox end Start */
		/* ADD Action \QCubed\Event\Change => GetSortedAddresses */
		$places = \Appointment::LoadArrayByExpertId(3);
		if($places){
			$this->GetSortedAddresses($places);
		}
		//exit;
		//\QCubed\Project\Application::Log(json_encode($places));
		
	}

	public function Save() {
		//\QCubed\Project\Application::displayAlert('saveing to communiction_template and word_template');
		/*
		  $reportingHelper			= new \Hikify\Helpers\Reporting($this);
		  $Document					= $reportingHelper->MergeReportData($this);

		  \QCubed\Project\Application::Log("Send"); */


		/*$objEntity					= \Entity::load(1);
		$arrTags					= $objEntity->GetTemplateTags('Repairer');
		$reportingHelper			= new \Hikify\Helpers\Reporting($this);
		\QCubed\Project\Application::Log($reportingHelper->MergeReportData($this->lstTemplates->SelectedValue, $arrTags));*/
	}
		/* Mapbox */
	
		public function GetSortedAddresses() {
		$arrAddresses = \Address::LoadAll();
		$arrSortedAddresses = $this->mpbox->OptimizeAddresses($arrAddresses);
		foreach ($arrSortedAddresses as $address) {
			\QCubed\Project\Application::Log($address);
		}
		$arrCoordinates = array_map(function(\Address $objAddress) {
			return $objAddress->Coordinates;
		}, $arrSortedAddresses); //ff adressen omzetten naar coordinates
		$this->mpbox->Draw($arrCoordinates);
	}

	
	public function OnCalCreate() {
		if(!$this->pnlCal->SelectedValue) {
			return;
		}
		
		$ArrDatesBetween  = $this->createDateRange($this->pnlCal->SelectedValue->Start->format("YmdHis"), $this->pnlCal->SelectedValue->End->format("YmdHis"));
		foreach($ArrDatesBetween as $date){
			\QCubed\Project\Application::Log($date);
			$objClosingDate					= new \EntityClosingday();
			$objClosingDate->Subject		= $this->pnlCal->SelectedValue->Subject;
			$objClosingDate->DateStart		= new \QCubed\QDateTime($date);
			$objClosingDate->EntityId		= $this->EntityId;
			
			$objClosingDate->Save();
		}
		
		
		
	}
	
	public function createDateRange($startDate, $endDate, $format = "Y-m-d")
	{
		$period = new \DatePeriod(
			new \DateTime($startDate),
			new \DateInterval('P1D'),
			new \DateTime($endDate)
	   );
		foreach ($period as $key => $value) {
			$arrDatesBetween[] = $value->format('YmdHis') ;
		}
		$arrDatesBetween[] = $endDate ;
		return $arrDatesBetween;
	}
	
	public function OnCalChange() {
		if(!$this->pnlCal->SelectedValue) {
			return;
		}
		/* delete days between selected Dates by entity and Subject */
		$objEntity = \EntityClosingday::deleteByEntityAndSubject($this->EntityId,str_replace('_',' ',$this->pnlCal->SelectedValue->Id));
		
		$ArrDatesBetween  = $this->createDateRange($this->pnlCal->SelectedValue->Start->format("YmdHis"), $this->pnlCal->SelectedValue->End->format("YmdHis"));
		foreach($ArrDatesBetween as $date){
			$objClosingDate					= new \EntityClosingday();
			$objClosingDate->Subject		= $this->pnlCal->SelectedValue->Subject;
			$objClosingDate->DateStart		= new \QCubed\QDateTime($date);
			$objClosingDate->EntityId		= 2;
			
			$objClosingDate->Save();
		}
	}
	
	
	public function OnCalDelete() {
		if(!$this->pnlCal->SelectedValue) {
			return;
		}
		$objEntity = \EntityClosingday::deleteByEntityAndSubject($this->EntityId,str_replace('_',' ',$this->pnlCal->SelectedValue->Id));
	}
	
	 
	private function Build() {
		
		/*PnlCal*/
		$this->pnlCal		= new \QCubed\Project\Jqui\Scheduler($this);
		
		$arrItems = array();
		$arrClosingDays = \EntityClosingday::getArrayBetweendDatesByEntityId(2);
		
		foreach($arrClosingDays as $objClosingDay){
			$arrItems[] = new \QCubed\Project\Jqui\SchedulerItem(str_replace(' ','_',$objClosingDay->Subject),new \QCubed\QDateTime($objClosingDay->getVirtualAttribute("minstart")), new \QCubed\QDateTime($objClosingDay->getVirtualAttribute("maxstart")), $objClosingDay->Subject);
		}
		
		$this->pnlCal->SetItems($arrItems);
		$this->pnlCal->setView(array("monthView"));
		$this->pnlCal->Draw();
		
		$this->pnlCal->addAction(new \QCubed\Project\Jqui\SchedulerItemCreate(), new \QCubed\Action\AjaxControl($this, "OnCalCreate"));
		$this->pnlCal->addAction(new \QCubed\Project\Jqui\SchedulerItemChange(), new \QCubed\Action\AjaxControl($this, "OnCalChange"));
		$this->pnlCal->addAction(new \QCubed\Project\Jqui\SchedulerItemDelete(), new \QCubed\Action\AjaxControl($this, "OnCalDelete"));
		/* test communication */
		/* $this->lstEntityEmailList	= new \QCubed\Control\Panel($this);
		  $this->lstEntityEmailList->Name = tr("List Entity"); */
		/*$this->lstEntityEmailList = \EntityEmail::GetMailingList($this);
		$reportingHelper = new \Hikify\Helpers\Reporting($this);
		$this->lstTemplates = $reportingHelper->GetTemplatesListbox($this);
		$this->txtSubject = new \QCubed\Project\Control\TextBox($this);
		$this->txtSubject->Name = tr('Subject');
		$this->ckMessage = new \QCubed\Bootstrap\TextBox($this);
		$this->ckMessage->TextMode = \QCubed\Control\TextBoxBase::MULTI_LINE;
		$this->ckMessage->addJavascriptFile("/vendor/almasaeed2010/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js");
		$this->ckMessage->addCssFile("/vendor/almasaeed2010/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css");
		//\QCubed\Project\Application::executeJavaScript("$('#" . $this->ckMessage->ControlId . "').wysihtml5()");
		/* end test communication */
		
		/* Mapbox */
		/*$this->mpbox		= new \QCubed\Project\Control\Mapbox($this);
		$this->ShowExpertiseLocations();*/
		/* end Mapbox */
		
		$this->btnSave = \QCubed\Project\Control\Button::GetSaveButton($this);
	}

}
