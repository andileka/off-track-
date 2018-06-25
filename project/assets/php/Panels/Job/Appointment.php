<?php

namespace Hikify\Panels\Job;

class Appointment extends \QCubed\Control\Panel {
	const ALL_DAY			= '';
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstType;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstPlace;
	/**
	 *
	 * @var \QCubed\Control\Label 
	 */
	public $lblPlaceVisitingHours;
	
	/**
	 *
	 * @var \QCubed\Control\Label 
	 */
	public $lblExpertWorkingHours;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstExpert;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtComment;
	/**
	 *
	 * @var \QCubed\Project\Control\RadioButtonGroup 
	 */
	public $pnlTimeOfDay;
	
	/**
	 *
	 * @var \QCubed\Project\Control\BooleanButton 
	 */
	public $blnPreferredTimeMayChange; /* useful for when the vehicle is always on site */
	
	/**
	 *
	 * @var \QCubed\Project\Control\Datepickerwrapper
	 */
	public $pnlDatepickerContainer;
	public $ArrCustomFields= [];
	/**
	 *
	 * @var \QCubed\Control\Panel
	 */
	public $pnlCustomfields;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlNotification;
	/**
	 *
	 * @var \AppointmentList 
	 */
	public $dgAppointments;
	/**
	 *
	 * @var \QCubed\Project\Control\DataGrid 
	 */
	public $pnlPlaceVisitingHours;
	/**
	 *
	 * @var \Hikify\Panels\Maintenance\Address 
	 */
	public $pnlHome;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstAddTasks;
	/**
	 *
	 * @var \Job 
	 */
	private $objJob;
	
	/**
	 *
	 * @var \Appointment 
	 */
	private $objFirstappointment;
	public $blnPlannable = true;
	private $toggle = false;
	private $placeId;
	const CUSTOM_FIELD_TYPE = "appointment"; 
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/panels/job/appointment.tpl.php';
		$this->Build();
		
		
		
		
	}
	public function lblVisitingHours_Closed_Clicked(){
		$this->pnlPlaceVisitingHours = null;
		$this->lblPlaceVisitingHours->removeAllActions('lblVisitingHours_Closed_Clicked');
		$this->lblPlaceVisitingHours->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'lblVisitingHours_Clicked'));
	}
	public function lblVisitingHours_Clicked() {
		if($this->lstPlace->SelectedValue){
			if(!$this->toggle){
				$this->lblPlaceVisitingHours->Text			= tr('Visiting hours').' <i class="fas fa-eye-slash" aria-hidden="true"></i>';
				$this->ShowVisitingHours();
			}else{
				$this->lblPlaceVisitingHours->Text			= tr('Visiting hours').' <i class="fas fa-eye" aria-hidden="true"></i>';
				$this->pnlPlaceVisitingHours->Display = false;
				$this->toggle = false;
			}
			
		}
	}
	
	public function ShowVisitingHours(){
		$this->pnlPlaceVisitingHours->Display = true;
		$conditions[] = \QCubed\Query\QQ::equal(\QQN::entityVisitinghour()->AmPm, $this->pnlTimeOfDay->SelectedValue);
		$conditions[] = \QCubed\Query\QQ::equal(\QQN::entityVisitinghour()->EntityId, $this->lstPlace->SelectedValue);
		$this->pnlPlaceVisitingHours->Condition = \QCubed\Query\QQ::andCondition($conditions);
		$this->pnlPlaceVisitingHours->Databind();
		$this->pnlPlaceVisitingHours->HtmlBefore	= "<h3>".tr($this->pnlTimeOfDay->SelectedValue)."</h3>";
		$this->toggle = true;
	}
	
	public function txtDate_YearMonthChanged($intYear, $intMonth) {
		$this->pnlTimeOfDay_Changed();
	}
	
	public function txtDate_Selected(\QCubed\QDateTime $dttSelectedDate) {	
		$objEntity		= \Entity::load((int) $this->lstPlace->SelectedValue);
		if(!$objEntity){
			return;
		}
		if($this->placeId){
			$objAddress		= \Address::load((int) $this->placeId);
			$zipcode		=  $objAddress->CityId;
			$objAreaZipcode	= \AreaZipcode::loadByZipcodeId($zipcode);
		}else{
			$this->placeId = $objEntity->Address->Id;
			$objAreaZipcode	= \AreaZipcode::loadByZipcodeId($objEntity->Address->CityId);
		}		
		
		$AreaId			= $objAreaZipcode->AreaId;
		$objAreaOverride = \ExpertAreaOverride::loadByOriginalAreaIdAndEndDate($AreaId,$dttSelectedDate->format("Y-m-d"));
		
		if($objAreaOverride){
			$AreaId		= $objAreaOverride->OverrideWithArea->Id;
		}
		/* check if Entity override is active */
		$objEntityOverride = \AreaEntity::loadByEntityAndType($objEntity->Id, "exclude");
		if($objEntityOverride){
			/* Is true */		
			$AreaId		= \AreaEntity::loadByEntityAndType($objEntity->Id, "include")->AreaId;
		}
		
		$objAreaExpert	= \ExpertArea::loadLastInsertedExpertByAreaId($AreaId, $dttSelectedDate->format('Y-m-d') );
		if(!$objAreaExpert){
			return;
		}
		$this->objFirstappointment							= new \Appointment();
		$this->objFirstappointment->ExpertId				= $objAreaExpert->ExpertId;
		$this->objFirstappointment->EntityId				= $this->lstPlace->SelectedValue;
		$this->objFirstappointment->PlaceId					= $this->placeId;
		$this->objFirstappointment->CreatedBy				= \Hikify\Helpers\Security::GetLoggedInUser()->Id;
		$this->objFirstappointment->JobId					= $this->objJob->Id;
		$this->objFirstappointment->Comment					= $this->txtComment->Text;
		$this->objFirstappointment->TypeId					= $this->lstType->SelectedValue;
		$this->objFirstappointment->PreferredDate			= $dttSelectedDate;
		$this->objFirstappointment->PreferredTime			= $this->pnlTimeOfDay->SelectedValue;
		$this->objFirstappointment->PreferredTimeMayChange	= $this->blnPreferredTimeMayChange->SelectedValue;
		
		$this->objFirstappointment->Save();
		
		/* ADD SELECTED TASKS */
		foreach($this->lstAddTasks->SelectedValues as $Value){
			$objAppointmentTask						= new \AppointmentTasks();
			$objAppointmentTask->AppointmentId		= $this->objFirstappointment->Id;
			$objAppointmentTask->TaskId				= $Value;
			$objAppointmentTask->Save();
		
		}
		
		foreach($this->ArrCustomFields as $customField){
		   \CustomFieldType::SaveCustomField($customField, $this::CUSTOM_FIELD_TYPE, $intJobId=null, $intVehicleId=null, $intEntityId=null, $this->objFirstappointment->Id);	
		}
		
		$this->Trigger('OnSave',[]);
		
	}
	
	
	
	public function lstPlace_Changed(){
		$this->pnlTimeOfDay_Changed();
	}
	public function GetAccordionHeader() {
		if($this->objFirstappointment){
			$ArrAppointments = \Appointment::loadArrayByJobId($this->objFirstappointment->JobId);		
			$objLastAppointment = end($ArrAppointments);
			
			if($objLastAppointment) {
				return tr('Appointments') . ': ' . $objLastAppointment . ' - ' .$objLastAppointment->Entity ;
			}
			
		}
		
		return tr('Appointments');		
	}
	
	public function SetJob(\Job $objJob=null) {
		if(!$objJob) {
			return;
		}
		
		$this->objJob						= $objJob;
		
		$this->lstPlace						= $this->objJob->GetEntityJobListBox($this);
//		$this->lstPlace->Name				= tr("Visiting place");
		$this->lstPlace->HtmlBefore					= "<label>".tr('Visiting place')."<sup>*</sup></label>";
		$this->lstPlace->Required			= true;
		$this->lstPlace->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this,'lstPlace_Changed'));
		$appointments = \Appointment::LoadArrayByJobId($objJob->Id);
		if($appointments) {		
			/* DISABLE SET APPOINTMENT UNTIL EXPERT IS COMPLETLY FINSHED => ERROR */
			$this->objFirstappointment						= $appointments[0];
			$this->lstType->SelectedValue					= $this->objFirstappointment->TypeId;
			$this->lstPlace->SelectedValue					= $this->objFirstappointment->EntityId;
			$this->txtComment->Text							= $this->objFirstappointment->Comment;
			$this->pnlTimeOfDay->SelectedValue				= $this->objFirstappointment->PreferredTime;
			$this->blnPreferredTimeMayChange->SelectedValue = $this->objFirstappointment->PreferredTimeMayChange;
		
			$this->pnlDatepickerContainer->DateTime			= $this->objFirstappointment->PreferredDate;
			$this->dgAppointments->DataSource				= $appointments;
			
			$this->CheckLatestAppointment($this->objJob);
			if(!$this->blnPlannable) {
				$this->pnlDatepickerContainer->Display = false;
			}
			$this->CheckHasActiveAppointments();
		
		}
		$this->SetCustomFields();
	}
	private function CheckLatestAppointment(\Job $objJob) {
		$objLatestAppointment = \Appointment::loadByJobId($objJob->Id, \QCubed\Query\QQ::clause(\QCubed\Query\QQ::maximum(\QQN::appointment()->PreferredDate, 'latestAppointment')));
		if($objLatestAppointment && $objLatestAppointment->PreferredDate >= \QCubed\QDateTime::now()) {
			$this->blnPlannable = false;
		}
	}
	public function pnlTimeOfDay_Changed() {
		if(!$this->Validate()) {
			return;
		}
		$intPlaceId								= $this->lstPlace->SelectedValue;
		$strTimeOfDay							= $this->pnlTimeOfDay->SelectedValue;
		list($dttStartOfMonth, $dttEndOfMonth)	= $this->pnlDatepickerContainer->GetCurrentDateFork();
		$this->pnlDatepickerContainer->Availabilities	= $this->GetAvailabilities($intPlaceId, $strTimeOfDay, $dttStartOfMonth, $dttEndOfMonth);
		$this->pnlDatepickerContainer->Show();
		$this->ShowVisitingHours();
		
	}
	
	public function Validate() {
		return ($this->lstPlace->Validate() & $this->lstType->Validate());
	}
	
	
	/**
	 * @param int $intEntityId
	 * @param str $strDayName
	 * @return Expert
	 */
	
	private function GetExpertForDay($intEntityId, $strDayName) {
		$objEntityExpert = \EntityExpert::loadByEntityAndDay($intEntityId, $strDayName);
		if($objEntityExpert) {
			return $objEntityExpert->Expert;
		}
		return false;
	}
	
	
	private function GetVisitinghours($intEntityId, $strTimeOfDay='am') {
		//first define order and defaults
		$arrDaysOfWeek = \QCubed\Project\Control\Datepickerwrapper::GetDayNameArray();
		
		foreach($arrDaysOfWeek as $strDayName=>$strDefaultDisplay) {
			$objExpert = $this->GetExpertForDay($intEntityId, $strDayName);
			if($objExpert) {
				list($dttFrom, $dttTo) = $this->GetPossibleHourFork($intEntityId, $objExpert->Id, $strTimeOfDay, $strDayName);
				if($dttFrom && $dttTo) {
					$arrDaysOfWeek[$strDayName] .= ' '.$dttFrom->format('H:i') . ' &rarr; ' . $dttTo->format('H:i') . '<br/>' . $objExpert;
				}		
			}
		}
		
		return array_values($arrDaysOfWeek);//strip the keys, before returning
	}
	
	/**
	 * This method will fetch visiting hours and working hours from the database and merge them together. 
	 * Because this is rather intensive, it will do this just once for each day (monday, tuesday)
	 * Subsequent calls to the same day, will be returned from the static cache.
	 * 
	 * @param int $intEntityId
	 * @param string $strTimeOfDay am|pm
	 * @param string $strDayName monday|tuesday...
	 * @return array with 2 elements:  0 = from DateTime object | 1 = to DateTime object
	 */
	
	private function GetAvailabilities($intEntityId, $strTimeOfDay,\QCubed\QDateTime $dttStart, \QCubed\QDateTime $dttEnd) {
		$objPlace			= \Entity::Load($intEntityId);
		$objExpert			= \Expert::Load(1);
		if(!($objPlace)) {
			return [];
		}
		$arrAvailability	= [];
		$dttDate			= clone $dttStart;
		
		$ArrWeeklyExperts = $this->GetWeeklyExperts($this->lstPlace->SelectedValue,$strTimeOfDay,$dttStart,$dttEnd);
		
		while ($dttDate->IsEarlierOrEqualTo($dttEnd)) {
			try{

					$objExpert = $ArrWeeklyExperts[$dttDate->format("D")];
					$arrAvailability[$dttDate->format("Y-n-j")] = $this->GetAvailabilitiesForDay($dttDate, $objExpert, $objPlace, $strTimeOfDay, $dttStart, $dttEnd);
					$dttDate->AddDays(1);
				
			}catch(Exception $e){}
		}
		return $arrAvailability;
	}
	/**
	 * 
	 * @param int $intEntityId
	 * @param string $strTimeOfDay
	 * @param \QCubed\QDateTime $dttStart
	 * @param \QCubed\QDateTime $dttEnd
	 * @return type
	 */
	public function GetWeeklyExperts($intEntityId,$strTimeOfDay,\QCubed\QDateTime $dttStart, \QCubed\QDateTime $dttEnd){
		/* 1 Load visiting address of entity */
		$objEntity = \Entity::load((int) $intEntityId);
		
		if(!$objEntity){
			return;
		}
		if(!$objEntity->Address && !$this->placeId){
			/* Add Address panel */
			$this->pnlHome->Display						= true;
			return;
			
		}
		$this->pnlHome->Display						= false;
		if(!$this->placeId){
			$intZipcode = $objEntity->Address->CityId;
		}
		$objZipcode = \Address::load((int) $this->placeId);
		if($objZipcode){
			$intZipcode = $objZipcode->CityId;
		}
		$objArea	= \AreaZipcode::loadByZipcodeId($intZipcode);
		if(!$objArea){
			$this->pnlNotification->Text				= tr("There were no area's configured for this zipcode.");
			$this->pnlNotification->Display				= true;
			return;
			
		}
		
		$AreaId		= $objArea->AreaId;
		/* check if override is active */
		$objAreaOverride = \ExpertAreaOverride::loadByOriginalAreaIdAndStartAndEndDate($objArea->AreaId,$dttStart,$dttEnd);
		
		if($objAreaOverride){
			$AreaId		= $objAreaOverride->OverrideWithArea->Id;
		}
		/* check if Entity override is active */
		$objEntityOverride = \AreaEntity::loadByEntityAndType($objEntity->Id, "exclude");
		
		if($objEntityOverride){
			/* Is true */		
			$AreaId		= \AreaEntity::loadByEntityAndType($objEntity->Id, "include")->AreaId;
		}
		
		/* GET SINGLE EXPERT ORDERED BY EXPIRES ON DATE */
		$objExpert		= \ExpertArea::loadByAreaIdAndDates($AreaId,$dttStart->format('Y-m-d'),$dttEnd->format('Y-m-d'));
		$blnHasNoExperts = true;
		$arrDays = array("monday","tuesday","wednesday","thursday","friday","saturday","sunday");
		foreach($arrDays as $strDay){
			$objExpertEntity  = \AreaDay::loadByAreaAndDayAndDaypart($objArea->AreaId, $strDay,$strTimeOfDay );
			$arrGetWeeklyExperts[substr(ucfirst($strDay),0,3)] = null;
			if($objExpertEntity && $objExpert){
				$blnHasNoExperts = false;
				$arrGetWeeklyExperts[substr(ucfirst($strDay),0,3)] = \Expert::loadById($objExpert->ExpertId);
			}
		}
		/* SHOW NOTIFICATION ONLY IF DAYPART IS SELECTED */
		if($blnHasNoExperts && $this->pnlTimeOfDay->SelectedValue) {
			$this->pnlNotification->Display = true;
			$this->pnlNotification->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'GoToEntityEdit'));
			$this->pnlNotification->ActionParameter = $intEntityId;
		} else {
			$this->pnlNotification->Display = false;
		}
		return $arrGetWeeklyExperts;
	}
	
	public function GoToEntityEdit(\QCubed\Action\ActionParams $params) {
		//TODO : REDIRECT TO THE EXPERT TAB ITSELF INSTEAD OF JUST THE MAIN PAGE
		\QCubed\Project\Application::redirect("?c=maintenance&a=entityedit&id=$params->ActionParameter");
	}

	
	/**
	 * This will return the availability object for a single date
	 * 
	 * @param \QCubed\QDateTime $dttDate
	 * @param \Expert $objExpert
	 * @param \Entity $objPlace
	 * @param string $strTimeOfDay
	 * 
	 * @return \Datepickerwrapper_availability
	 */
	private function GetAvailabilitiesForDay(\QCubed\QDateTime $dttDate, $objExpert, \Entity $objPlace, $strTimeOfDay) {
		if($dttDate->format("Ymd") >= date("Ymd")){
			if($objExpert){
				$dttFrom									= null;
				$dttTo										= null;
				$partDay									= null; /* Am, Pm */

				if($this->pnlTimeOfDay->SelectedValue){
					$partDay = ucfirst($this->pnlTimeOfDay->SelectedValue);
				}
				$strDayName									= $dttDate->format('l'); //Monday, Tuesday...
				$intMaxAppointments							= $objExpert->{'MaxAppointments'.$strDayName.$partDay};//becomes MaxAppoinmentsMonday, MaxAppoinmentsTuesday, .. 
				if($intMaxAppointments) {				
					$intAppointments						= $objExpert->CountAppointmentsOnDay($dttDate, $strTimeOfDay);
					$isDaySelectable						= $objExpert->IsWorkingOn($dttDate,$strTimeOfDay) && $objPlace->IsOpenOn($dttDate, $strTimeOfDay);

					if($isDaySelectable) {
						//double check if the day is selectable, it might be there just isn't a workinghour/visitinghour combination that works.
						list($dttFrom, $dttTo)	= $this->GetPossibleHourFork($objPlace->Id, $objExpert->Id, $strTimeOfDay, $strDayName); //this is cached in memory, no worries
					}

					return new \QCubed\Project\Control\Datepickerwrapper_availability(
																	$isDaySelectable && $dttFrom && $dttTo, 
																	$this->GetCssClassName($intAppointments, $intMaxAppointments, $dttDate, $objExpert->Id), 
																	$intAppointments . ' / '.$intMaxAppointments
															);
				}	
			}
		}
	}
	private function CheckHasVisitingExpert(\QCubed\QDateTime $dttDate, $objExpert){
		$arrAppointments = \Appointment::loadArrayByDayAndExpert($objExpert, $dttDate->format("Y-m-d"));
		if(count($arrAppointments) > 0){ return true; }
	}
	private function GetCssClassName($intAppointments, $intMaxAppointments, $dttDate, $Expert = null) {
		$Class = array();
		/* ADD HAS EXPERTS  => has-visiting-expert*/
		if($this->CheckHasVisitingExpert($dttDate, $Expert)){
			$Class[] = "has-visiting-expert"; 
		}
		if($intMaxAppointments <= 2){
			if($intAppointments < 1) {
				$Class[] =  'green';
			}
			if($intAppointments >= 1) {
				$Class[] =  'yellow';
			}
		}else{
			$percentage = $intAppointments/$intMaxAppointments*100;
			if($percentage < 70) {
				$Class[] = 'green';
			}
			if($percentage < 90 && $percentage > 70) {
				 $Class[] = 'yellow';
			}
			if($percentage <= 100 && $percentage > 90 || $percentage > 100  ) {
				$Class[] = 'red';
			}
		}
		
		return join(" ",$Class);
		
	}
	
	private function GetPossibleHourFork($intEntityId, $intExpertId, $strTimeOfDay, $strDayName) {
		static $arrPossibleHours = [];//using static keyword to cache on a a function level.
		$arrDays = array("Monday", "Tuesday", "Wednesday","Thursday","Friday");
		$strCacheKey			= $intEntityId.'.'.$intExpertId.'.'.$strTimeOfDay.'.'.$strDayName;
		if(!isset($arrPossibleHours[$strCacheKey])) {
			$objVisitingHour		= \EntityVisitinghour::LoadByAmPmDayEntityId($strTimeOfDay, $strDayName, $intEntityId);
			if($objVisitingHour) {
				$arrPossibleHours[$strCacheKey] = $this->MergeDates($objVisitingHour, $strTimeOfDay);
			} else {
				foreach($arrDays as $Day){
					$arrPossibleHours[$strCacheKey] = $this->MergeDatesNoVisitingHoursKnown($strTimeOfDay);
				}
				
			}
		}

		return $arrPossibleHours[$strCacheKey];
	}
	private function MergeDatesNoVisitingHoursKnown($strTimeOfDay){
		//base
		$dttLowerLimit			= new \DateTime(($strTimeOfDay == 'am' ? 0	: 12)	.":00:00");
		$dttUpperLimit			= new \DateTime(($strTimeOfDay == 'am' ? 12 : 24)	.":00:00");
		$dttVisitingHourFrom = "";
		$dttVisitingHourTo = "";
		
		$dttVisitingHourFrom	= new \DateTime("08:00:00");
		$dttVisitingHourTo		= new \DateTime("18:00:00");

		

		if($dttVisitingHourFrom > $dttLowerLimit) {
			$dttLowerLimit = $dttVisitingHourFrom;
		}

		if($dttVisitingHourTo < $dttUpperLimit) {
			$dttUpperLimit = $dttVisitingHourTo;
		}
		
		
		return [
			$dttLowerLimit,
			$dttUpperLimit
		]; 
	}
	/**
	 * This will merge EntityVisitinghour with ExpertWorking hour. We want to return the overlap between the two.
	 * We should be able to refactor this method so it is a general \QCubed\QDateTime::GetOverlap($dttDateTime1, $dttDateTime2, ...) 
	 * but right now my brain is done... 
	 * 
	 * @param \EntityVisitinghour $objVisitingHour
	 * @param string $strTimeOfDay am|pm
	 * @return []
	 */
	private function MergeDates(\EntityVisitinghour $objVisitingHour, $strTimeOfDay='am'){
		//base
		$dttLowerLimit			= new \DateTime(($strTimeOfDay == 'am' ? 0	: 12)	.":00:00");
		$dttUpperLimit			= new \DateTime(($strTimeOfDay == 'am' ? 12 : 24)	.":00:00");
		$dttVisitingHourFrom = "";
		$dttVisitingHourTo = "";
		
		//entity/place visiting hours
		if($objVisitingHour->From){
			$dttVisitingHourFrom	= new \DateTime($objVisitingHour->From->format("H:i:s"));
		}
		if($objVisitingHour->To){
			$dttVisitingHourTo		= new \DateTime($objVisitingHour->To->format("H:i:s"));
		}
		
		

		if($dttVisitingHourFrom > $dttLowerLimit) {
			$dttLowerLimit = $dttVisitingHourFrom;
		}

		if($dttVisitingHourTo < $dttUpperLimit) {
			$dttUpperLimit = $dttVisitingHourTo;
		}
				
		
		return [
			$dttLowerLimit,
			$dttUpperLimit
		]; 
	}
	
	public function GetCustomFields(){
		/* Load all custom fields for vehicle */
		$arrCustomFieldTypes = \CustomFieldType::loadArrayByContainer($this::CUSTOM_FIELD_TYPE);
		foreach($arrCustomFieldTypes as $objCustomfieldType){
			$this->ArrCustomFields[] = \CustomFieldType::CreateCustomField($this->pnlCustomfields, $objCustomfieldType);
		}
	}
	
	public function SetCustomFields(){
		/* Load all custom fields for vehicle */
		foreach($this->ArrCustomFields as $customField){
			\CustomField::SetCustomFields($customField, $this::CUSTOM_FIELD_TYPE, $intJobId=null, $intVehicleId=null, $intEntityId=null, $this->objFirstappointment->Id);
		}
	}
	public function AddressIsSaved($objAddress){
		if($objAddress){
			$this->placeId = $objAddress->Id;
			$this->pnlHome->Display						= false;
			$this->pnlTimeOfDay_Changed();
		}
		
		
	}
	public function SaveAddress(){
		$this->pnlHome->Save();
		
	}
	public function btndelete_click($intSelectedAppointment){
		$objAppointment = \Appointment::load($intSelectedAppointment);
		$objAppointment->Status = "deleted";
		$objAppointment->Save();
		$this->dgAppointments->Condition = \QCubed\Query\QQ::andCondition(		
						\QCubed\Query\QQ::notEqual(\QQN::appointment()->Status, "deleted"),
						\QCubed\Query\QQ::equal(\QQN::appointment()->JobId, $this->objJob->Id)
					);
		$this->dgAppointments->dataBind();
	}
	public function btnedit_click(){}
	private function Build() {
		
		$this->lstType								= \AppointmentType::GetListBox($this);
		$this->lstType->Required					= true;
//		$this->lstType->Name						= tr('Type control');
		$this->lstType->HtmlBefore					= "<label>".tr('Type control')."<sup>*</sup></label>";
		
		$this->txtComment							= new \QCubed\Project\Control\TextBox($this);
		$this->txtComment->Name						= tr("Comment");
		$this->txtComment->TextMode					= \QCubed\Control\TextBoxBase::MULTI_LINE;	
		
		$this->lstPlace								= new \QCubed\Control\Panel($this);
		$this->lstPlace->Text						= 'this is a place holder, we should probably allow you to jump to selecting the entities... but yeah not right now';
		
		$this->lblPlaceVisitingHours				= new \QCubed\Control\Label($this);
		$this->lblPlaceVisitingHours->Display		= false;
		$this->lblPlaceVisitingHours->Text			= tr('Visiting hours').' <i class="fas fa-eye" aria-hidden="true"></i>';
		$this->lblPlaceVisitingHours->HtmlEntities	= false;
		$this->lblPlaceVisitingHours->Cursor		= \QCubed\Css\CursorType::POINTER;
		$this->lblPlaceVisitingHours->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'lblVisitingHours_Clicked'));
		$this->lblPlaceVisitingHours->addCssClass("visitinghours");
		
		$this->pnlPlaceVisitingHours				= new \EntityVisitinghourList($this);
		$this->pnlPlaceVisitingHours->createColumns();
		$this->pnlPlaceVisitingHours->addWrapperCssClass("business_hours");
		$this->pnlPlaceVisitingHours->addCssClass("business_hours_table");
		$this->pnlPlaceVisitingHours->Paginator->Display		= false;
		$this->pnlPlaceVisitingHours->removeCssClass("datagrid");
		$this->pnlPlaceVisitingHours->Display		= false;
		
		$this->pnlTimeOfDay							= new \QCubed\Project\Control\RadioButtonGroup($this);
		$this->pnlTimeOfDay->Name					= tr('Preferred time');
		$this->pnlTimeOfDay->AddItem(tr('am')	, 'am');
		$this->pnlTimeOfDay->AddItem(tr('pm')	, 'pm');
		$this->pnlTimeOfDay->AddButtonClassnames([
			'sunrise',
			'sunset'
		]);
		$this->pnlTimeOfDay->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'pnlTimeOfDay_Changed'));
		
		$this->blnPreferredTimeMayChange		= new \QCubed\Project\Control\BooleanButton($this, false);
		$this->blnPreferredTimeMayChange->Name	= tr('Preferred time may change');
		
		$this->pnlDatepickerContainer					= new \QCubed\Project\Control\Datepickerwrapper($this);
		$this->pnlDatepickerContainer->FirstDay			= 1;
		$this->pnlDatepickerContainer->Register('OnSelect', 'txtDate_Selected');
		$this->pnlDatepickerContainer->Register('OnYearMonthChange', 'txtDate_YearMonthChanged');
		
		/* define customfield container */
		$this->pnlCustomfields								= new \QCubed\Control\Panel($this); 
		$this->pnlCustomfields	->PreferredRenderMethod		= "RenderFormGroup";
		$this->pnlCustomfields	->AutoRenderChildren		= true;
		$this->GetCustomFields();
		
		$this->dgAppointments = new \AppointmentList($this);
		$this->dgAppointments->createColumns();
		$this->dgAppointments->DataSource = array();
		$this->dgAppointments->Register("OnDelete","btndelete_click",$this);
		
		$this->pnlNotification						= new \QCubed\Control\Panel($this);
		$this->pnlNotification->AddCssClass("callout callout-warning ");
		$this->pnlNotification->Text				= tr("There were no experts configured for this entity. Click here to add them.");
		$this->pnlNotification->Cursor				= 'pointer';
		$this->pnlNotification->Display				= false;
		
		$this->pnlHome								= new \Hikify\Panels\Maintenance\Address($this, tr('Home address'));
		$this->pnlHome	->PreferredRenderMethod		= "RenderFormGroup";
		$this->pnlHome	->AutoRenderChildren		= true;
		$this->pnlHome->Display						= false;
		$this->pnlHome->Register('OnSave', 'AddressIsSaved');
		
		$btnSaveAddress							= \QCubed\Project\Control\Button::GetFontAwesomeButton($this->pnlHome, tr('Save Address'), 'fas fa-save', null, 'btn-success');
		$btnSaveAddress->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "SaveAddress"));
		$btnSaveAddress->addWrapperCssClass("col-md-12");
		
		$this->lstAddTasks							= \AppointmentTaskType::GetListBox($this);
		$this->lstAddTasks->Name					= tr("Select tasks");
		$this->lstAddTasks->SelectionMode			= "Multiple";
	}
	public function CheckHasActiveAppointments(){
		$objActiveAppointments = \Appointment::GetActiveAppointments($this->objJob->Id, date('Y-m-d'));
		if($objActiveAppointments){
			$this->lstType -> Display					= false;
			$this->txtComment -> Display				= false;
			$this->lstPlace -> Display					= false;
			$this->lblPlaceVisitingHours -> Display		= false;
			$this->pnlTimeOfDay -> Display				= false;
			$this->blnPreferredTimeMayChange -> Display	= false;
			$this->pnlCustomfields -> Display			= false;
			$this->lstAddTasks->Display					= false;
		}
	}
	public function dg_OnExpertChanged($intExpertId, $intAppointmentId){
		$objAppointment = \Appointment::loadById($intAppointmentId);
	
		$objAppointment->ExpertId = $intExpertId;
		$objAppointment->Save();
		
		$this->SetJob($this->objJob);
	}
}


