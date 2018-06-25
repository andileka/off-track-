<?php

namespace Hikify\Pages\Booking;

class Appointment extends \QCubed\Control\Panel {
	
	const ALL_DAY			= '';
	
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
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstType;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlNotification;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtComment;
	/**
	 *
	 * @var \Job 
	 */
	private $objJob;
	/**
	 *
	 * @var \Entity 
	 */
	private $objEntity;
	private $placeId;
	private $dttSelectedDate;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/booking/appointment.tpl.php';
		$this->Build();
		$this->pnlNotification->Display = false;
		
	}
	public function SetEntity($objEntity){	
		$this->objEntity			= $objEntity;		
	}
	
	public function SetJob($objJob){	
		$this->objJob			= $objJob;		
	}
	
	
	public function HideNotification(){
		$this->pnlNotification->Display =false;
	}
	
	public function txtDate_YearMonthChanged($intYear, $intMonth) {
		$this->pnlTimeOfDay_Changed();
	}
	
	public function txtDate_Selected(\QCubed\QDateTime $dttSelectedDate) {	
		$this->dttSelectedDate = $dttSelectedDate;
	}
	
	public function Save(){
		$error = true;
		if(!$this->dttSelectedDate){
			$this->pnlNotification->Text	= "<p><i class='fa fa-lock' aria-hidden='true'></i> " . tr("Select a date") . "</p>";
			$this->pnlNotification->Display = true;
			$error = false;
			$this->Trigger('onValidate',[]);
		}
		if($error){
			$objEntity		= $this->objEntity;
			if(!$objEntity){
				return;
			}
			if($this->placeId){
				$objAddress		= \Address::load((int) $objEntity->VisitingAddressId);
				$zipcode		=  $objAddress->CityId;
				$objAreaZipcode	= \AreaZipcode::loadByZipcodeId($zipcode);
			}else{
				$this->placeId = $objEntity->Address->Id;
				$objAreaZipcode	= \AreaZipcode::loadByZipcodeId($objEntity->Address->CityId);
			}		

			$AreaId			= $objAreaZipcode->AreaId;
			$objAreaOverride = \ExpertAreaOverride::loadByOriginalAreaIdAndEndDate($AreaId,$this->dttSelectedDate->format("Y-m-d"));

			if($objAreaOverride){
				$AreaId		= $objAreaOverride->OverrideWithArea->Id;
			}
			/* check if Entity override is active */
			$objEntityOverride = \AreaEntity::loadByEntityAndType($objEntity->Id, "exclude");
			if($objEntityOverride){
				/* Is true */		
				$AreaId		= \AreaEntity::loadByEntityAndType($objEntity->Id, "include")->AreaId;
			}

			$objAreaExpert	= \ExpertArea::loadLastInsertedExpertByAreaId($AreaId, $this->dttSelectedDate->format('Y-m-d') );
			if(!$objAreaExpert){
				return;
			}
			$objFirstappointment							= new \Appointment();
			$objFirstappointment->ExpertId					= $objAreaExpert->ExpertId;
			$objFirstappointment->EntityId					= $this->objEntity->Id;
			$objFirstappointment->PlaceId					= $this->objEntity->VisitingAddressId;
			$objFirstappointment->CreatedBy					= \Hikify\Helpers\Security::GetLoggedInUser()->Id;
			$objFirstappointment->JobId						= $this->objJob->Id;
			$objFirstappointment->Comment					= $this->txtComment->Text;
			$objFirstappointment->PreferredDate				= $this->dttSelectedDate;
			$objFirstappointment->PreferredTime				= $this->pnlTimeOfDay->SelectedValue;
			$objFirstappointment->TypeId					= $this->lstType->SelectedValue;
			$objFirstappointment->PreferredTimeMayChange	= $this->blnPreferredTimeMayChange->SelectedValue;

			$objFirstappointment->Save();


			$this->Trigger('OnSave',[$objFirstappointment]);
		}
		
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
		$intPlaceId								= $this->objEntity->VisitingAddressId;
		$strTimeOfDay							= $this->pnlTimeOfDay->SelectedValue;
		list($dttStartOfMonth, $dttEndOfMonth)	= $this->pnlDatepickerContainer->GetCurrentDateFork();
		$this->pnlDatepickerContainer->Availabilities	= $this->GetAvailabilities($intPlaceId, $strTimeOfDay, $dttStartOfMonth, $dttEndOfMonth);
//		$this->pnlDatepickerContainer->DayNamesMin		= $this->GetVisitinghours($intPlaceId, $strTimeOfDay);
		$this->pnlDatepickerContainer->Show();
		
		
	}
	
	public function Validate() {
		if(!$this->objEntity){return;}
		return ($this->objEntity->VisitingAddressId);
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
		
		$ArrWeeklyExperts = $this->GetWeeklyExperts($this->objEntity->VisitingAddressId,$strTimeOfDay,$dttStart,$dttEnd);
		
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
//		$this->placeId = $this->objEntity->VisitingAddressId;
		/* 1 Load visiting address of entity */
		$objEntity = \Entity::load((int) $this->objEntity->Id);
		
		if(!$objEntity){
			return;
		}
		if(!$objEntity->Address && !$this->placeId){
			return;
		}
		$intZipcode = $this->objEntity->VisitingAddress->CityId;
		
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
		if($blnHasNoExperts) {
			$this->pnlNotification->Display = true;
		} else {
			$this->pnlNotification->Display = false;
		}
		return $arrGetWeeklyExperts;
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
																$this->GetCssClassName($intAppointments, $intMaxAppointments), 
																$intAppointments . ' / '.$intMaxAppointments
														);
			}	
		}
	}
	
	private function GetCssClassName($intAppointments, $intMaxAppointments) {
		if($intMaxAppointments <= 2){
			if($intAppointments < 1) {
				return 'green';
			}
			if($intAppointments >= 1) {
				return 'yellow';
			}
		}else{
			$percentage = $intAppointments/$intMaxAppointments*100;
			if($percentage < 70) {
				return 'green';
			}
			if($percentage < 90) {
				return 'yellow';
			}
			if($percentage <= 100) {
				return 'red';
			}
		}
		
	}
	
	private function GetPossibleHourFork($intEntityId, $intExpertId, $strTimeOfDay, $strDayName) {
		static $arrPossibleHours = [];//using static keyword to cache on a a function level.
		$arrDays = array("Monday", "Tuesday", "Wednesday","Thursday","Friday");
		$strCacheKey			= $intEntityId.'.'.$intExpertId.'.'.$strTimeOfDay.'.'.$strDayName;
		if(!isset($arrPossibleHours[$strCacheKey])) {
			$objVisitingHour		= \EntityVisitinghour::LoadByAmPmDayEntityId($strTimeOfDay, $strDayName, $intEntityId);
//			$objWorkingHour			= \ExpertWorkinghour::LoadByAmPmDayExpertId($strTimeOfDay, strtolower($strDayName), $intExpertId);	
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
		
		
		//expert working hours
//		$dttWorkingHourFrom		= new \DateTime($objWorkingHour->From->format("H:i:s"));
//		$dttWorkingHourTo		= new \DateTime($objWorkingHour->To->format("H:i:s"));
//		if($dttWorkingHourFrom > $dttLowerLimit) {
//			$dttLowerLimit = $dttWorkingHourFrom;
//		}
//
//		if($dttWorkingHourTo < $dttUpperLimit) {
//			$dttUpperLimit = $dttWorkingHourTo;
//		}
		
		
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
	
	
	private function Build() {
		
		$this->pnlTimeOfDay							= new \QCubed\Project\Control\RadioButtonGroup($this);
		$this->pnlTimeOfDay->Name					= tr('Preferred time');
		$this->pnlTimeOfDay->AddItem(tr('AM 00:00 -> 12:00')	, 'am');
		$this->pnlTimeOfDay->AddItem(tr('PM 12:00 -> 24:00')	, 'pm');
		$this->pnlTimeOfDay->AddButtonClassnames([
			'sunrise',
			'sunset'
		]);
		
		$this->lstType								= \AppointmentType::GetListBox($this);
		$this->lstType->Required					= true;
		$this->lstType->Name						= tr('Type afspraak');
		
		$this->pnlTimeOfDay->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'pnlTimeOfDay_Changed'));
		
		$this->blnPreferredTimeMayChange		= new \QCubed\Project\Control\BooleanButton($this, false);
		$this->blnPreferredTimeMayChange->Name	= tr('Preferred time may change');
		
		$this->pnlDatepickerContainer					= new \QCubed\Project\Control\Datepickerwrapper($this);
		$this->pnlDatepickerContainer->FirstDay			= 1;//\QCubed\Project\Jqui\Datepicker::MONDAY
		$this->pnlDatepickerContainer->Register('OnSelect', 'txtDate_Selected');
		$this->pnlDatepickerContainer->Register('OnYearMonthChange', 'txtDate_YearMonthChanged');
		
		$this->txtComment							= new \QCubed\Project\Control\TextBox($this);
		$this->txtComment->Name						= tr("Comment");
		$this->txtComment->TextMode					= \QCubed\Control\TextBoxBase::MULTI_LINE;	
		
		$this->pnlNotification						= new \QCubed\Control\Panel($this);
		$this->pnlNotification->AddCssClass("callout callout-warning ");
		$this->pnlNotification->Text				= "<p><i class='fa fa-lock' aria-hidden='true'></i> " . tr("There were no experts configured for this entity. Click here to add them.") . "</p>";
		$this->pnlNotification->Cursor				= 'pointer';
		$this->pnlNotification->Display				= false;
		
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


