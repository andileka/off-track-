<?php

namespace Hikify\Pages\Maintenance;

class Expertedit extends \QCubed\Control\Panel {

	public $btnSave;

	/**
	 *
	 * @var \Weekschedule 
	 */
	public $pnlWeekAm;

	/**
	 *
	 * @var \Weekschedule 
	 */
	public $pnlWeekPm;
	
	/**
	 *
	 * @var \Hikify\Panels\Maintenance\Maxappointments
	 */
	public $pnlMaxAm;

	/**
	 *
	 * @var \Hikify\Panels\Maintenance\Maxappointments
	 */
	public $pnlMaxPm;

	/**
	 * \QCubed\Control\Label
	 */
	public $lblUserInfo;

	/**
	 *
	 * @var \Hikify\Panels\Maintenance\Address 
	 */
	public $pnlStartingAddress;

	/**
	 *
	 * @var \QCubed\Control\Label
	 */
	public $lblMaxAppointments;

	/**
	 *
	 * @var \QCubed\Bootstrap\Nav
	 */
	public $navEntity;
	public $pnlVisiting;
	public $pnlAppointment;
	public $pnlUserInfo;
	/**
	 *
	 * @var \QCubed\Bootstrap\Button
	 */
	public $btnSaveVisitingHours;
	/**
	 *
	 * @var \QCubed\Bootstrap\Button
	 */
	public $btnSaveMaxAppointments;

	
	/**
	 *
	 * @var \QCubed\Project\Jqui\Scheduler 
	 */
	public $pnlCal;
	private $objExpert;

	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);

		$this->strTemplate = __TEMPLATES__ . '/pages/maintenance/expert-edit.tpl.php';
		$this->objExpert = new \Expert();
		$this->Build();

		if (isset($_GET['id'])) {
			$this->SetExpert(\Expert::Load((int) $_GET['id']));
			$this->pnlWeekAm->SetAllWeekDays($this->GetAllDayWeekHours("am"));
			$this->pnlWeekPm->SetAllWeekDays($this->GetAllDayWeekHours("pm"));
			
			$this->pnlMaxAm->SetAllWeekDays($this->GetAllMaxAppointments("Am"));
			$this->pnlMaxPm->SetAllWeekDays($this->GetAllMaxAppointments("Pm"));
		}
	}
	public function GetAllMaxAppointments($strAmPm){
		\QCubed\Project\Application::Log($strAmPm);
		//echo "-->".$strAmPm;exit;
		$objMaxAppointments = \Expert::loadById($this->objExpert->Id);
		return array(
			"Monday"		=> $objMaxAppointments->{'MaxAppointmentsMonday'.$strAmPm},
			"Tuesday"		=> $objMaxAppointments->{'MaxAppointmentsTuesday'.$strAmPm},
			"Wednesday"		=> $objMaxAppointments->{'MaxAppointmentsWednesday'.$strAmPm},
			"Thursday"		=> $objMaxAppointments->{'MaxAppointmentsThursday'.$strAmPm},
			"Friday"		=> $objMaxAppointments->{'MaxAppointmentsFriday'.$strAmPm},
			"Saturday"		=> $objMaxAppointments->{'MaxAppointmentsSaturday'.$strAmPm},
			"Sunday"		=> $objMaxAppointments->{'MaxAppointmentsSunday'.$strAmPm}
		);
	}
	public function SetExpert(\Expert $objExpert) {
		$this->objExpert = $objExpert;
		$this->pnlStartingAddress->SetAddress($objExpert->StartingAddress);
		/* end Userinfo */
	}

	public function GetAllDayWeekHours($amPm) {
		$Days = array();
		$LoadedArray = \ExpertWorkinghour::LoadByAmPmExpertId($amPm, (int) $_GET['id']);

		foreach ($LoadedArray as $row) {
			$Days[$row->Day]['Start'] = $row->From->format('H:i');
			$Days[$row->Day]['End'] = $row->To->format('H:i');
		}
		return $Days;
	}

	public function Save() {
		
		if (!$this->objExpert) {
			$this->objExpert = new \Expert();
		}

		$this->objExpert->UserId = $this->objExpert->Id;
		
		$this->pnlStartingAddress->Save();
		$this->objExpert->StartingAddress = $this->pnlStartingAddress->Address;

		$this->objExpert->Save();

		
		\QCubed\Project\Application::Redirect('index.php?c=maintenance&a=expert'); //back to the list if job not found!
	}

	public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	public function OnCalCreate() {
		if (!$this->pnlCal->SelectedValue) {
			return;
		}
		$strRandomGenerated = $this->generateRandomString();
		$ArrDatesBetween = $this->createDateRange($this->pnlCal->SelectedValue->Start->format("Ymd"), $this->pnlCal->SelectedValue->End->format("Ymd"));
		foreach ($ArrDatesBetween as $date) {
			$objClosingDate = new \ExpertAbsence();
			$objClosingDate->Subject = $this->pnlCal->SelectedValue->Subject;
			$objClosingDate->Date = new \QCubed\QDateTime($date);
			$objClosingDate->ExpertId = $_GET['id'];
			$objClosingDate->Identifier = $strRandomGenerated;

			$objClosingDate->Save();
		}
	}

	public function createDateRange($startDate, $endDate, $strFormat = "Ymd") {
		$period = new \DatePeriod(
				new \DateTime($startDate), new \DateInterval('P1D'), new \DateTime($endDate)
		);
		foreach ($period as $value) {
			$arrDatesBetween[] = $value->format($strFormat);
		}
		$arrDatesBetween[] = $endDate;

		return $arrDatesBetween;
	}
	
	public function OnCalChange() {
		if (!$this->pnlCal->SelectedValue) {
			return;
		}
		/* delete days between selected Dates by entity and Subject */
		$objEntity = \ExpertAbsence::deleteByEntityAndIdentiefier($_GET['id'], $this->pnlCal->SelectedValue->Id);

		$ArrDatesBetween = $this->createDateRange($this->pnlCal->SelectedValue->Start->format("Ymd"), $this->pnlCal->SelectedValue->End->format("Ymd"));
		foreach ($ArrDatesBetween as $date) {
			$objClosingDate = new \ExpertAbsence();
			$objClosingDate->Subject = $this->pnlCal->SelectedValue->Subject;
			$objClosingDate->Date = new \QCubed\QDateTime($date);
			$objClosingDate->ExpertId = $_GET['id'];
			$objClosingDate->Identifier = $this->pnlCal->SelectedValue->Id;

			$objClosingDate->Save();
		}
		
	}

	public function OnCalDelete() {
		if (!$this->pnlCal->SelectedValue) {
			return;
		}
		$objEntity = \ExpertAbsence::deleteByEntityAndIdentiefier($_GET['id'], $this->pnlCal->SelectedValue->Id);
	}

	public function GetAllClosingDates() {
		$arrItems = array();
		$arrClosingDays = \ExpertAbsence::getArrayBetweendDatesByExpertId($_GET['id']);

		foreach ($arrClosingDays as $objClosingDay) {
			$arrItems[] = new \QCubed\Project\Jqui\SchedulerItem($objClosingDay->Identifier, new \QCubed\QDateTime($objClosingDay->getVirtualAttribute("minstart")), new \QCubed\QDateTime($objClosingDay->getVirtualAttribute("maxstart")), $objClosingDay->Subject);
		}

		return $arrItems;
	}
	
	public function btnSaveVisitingHours_Clicked() {
		\ExpertWorkinghour::DeleteByExpertId($this->objExpert->Id);
		foreach ($this->pnlWeekAm->GetAllWeekDays() as $day => $hours) {
			$workinhour = new \ExpertWorkinghour();
			$workinhour->ExpertId = $this->objExpert->Id;
			$workinhour->Day = $day;
			$workinhour->AmPm = "am";
			$workinhour->From = $hours['Start'];
			$workinhour->To = $hours['End'];
			/* check if hours not empty */
			if ($hours['Start'] != "" && $hours['End'] != "")
				$workinhour->Save();
		}
		foreach ($this->pnlWeekPm->GetAllWeekDays() as $day => $hours) {
			$workinhour = new \ExpertWorkinghour();
			$workinhour->ExpertId = $this->objExpert->Id;
			$workinhour->Day = $day;
			$workinhour->AmPm = "pm";
			$workinhour->From = $hours['Start'];
			$workinhour->To = $hours['End'];
			/* check if hours not empty */
			if ($hours['Start'] != "" && $hours['End'] != "")
				$workinhour->Save();
		}
		
		\QCubed\Project\Application::Redirect('?c=maintenance&a=expertedit&id='.$this->objExpert->Id.'');
	}
	
	public function btnSaveMaxAppointments_Clicked(){
		\QCubed\Project\Application::Log("Save");
		
		if (!$this->objExpert) {
			$this->objExpert = new \Expert();
			
		}
		$this->objExpert->UserId = $this->objExpert->Id;
		
		foreach ($this->pnlMaxAm->GetAllWeekDaysMaxAppointments() as $day => $maxAppointments) {
			\QCubed\Project\Application::Log("Day-->".$day . "--".$maxAppointments);
			$this->objExpert->{'MaxAppointments'.$day.'Am'} = $maxAppointments;
		}
		
		foreach ($this->pnlMaxPm->GetAllWeekDaysMaxAppointments() as $day => $maxAppointments) {
			\QCubed\Project\Application::Log("Day-->".$day . "--".$maxAppointments);
			$this->objExpert->{'MaxAppointments'.$day.'Pm'} = $maxAppointments;
		}
		
		$this->objExpert->Save();
		\QCubed\Project\Application::Redirect('?c=maintenance&a=expertedit&id='.$this->objExpert->Id.'');
	}
	
	private function Build() {

		$this->navEntity = new \QCubed\Bootstrap\Nav($this);

		$this->pnlVisiting = new \QCubed\Control\Panel($this->navEntity);
		$this->pnlVisiting->Name = tr('Visiting hours');
		$this->pnlVisiting->PreferredRenderMethod = "RenderFormGroup";
		$this->pnlVisiting->AutoRenderChildren = true;

		$this->pnlWeekAm = new \QCubed\Project\Control\Weekschedule($this->pnlVisiting);
		$this->pnlWeekAm->Title = tr('Visiting hours AM');
		$this->pnlWeekAm->addCssClass("col-sm-12 col-md-6");

		$this->pnlWeekPm = new \QCubed\Project\Control\Weekschedule($this->pnlVisiting);
		$this->pnlWeekPm->Title = tr('Visiting hours PM');
		$this->pnlWeekPm->addCssClass("col-sm-12 col-md-6");
		
		$this->btnSaveVisitingHours = \QCubed\Bootstrap\Button::GetFontAwesomeButton($this->pnlVisiting, "Save", 'far fa-save');
		$this->btnSaveVisitingHours->addCssClass("btn-success");
		$this->btnSaveVisitingHours->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "btnSaveVisitingHours_Clicked", 'default', false));


		$this->pnlAppointment = new \QCubed\Control\Panel($this->navEntity);
		$this->pnlAppointment->Name = tr('Max Appointments');
		$this->pnlAppointment->PreferredRenderMethod = "RenderFormGroup";
		$this->pnlAppointment->AutoRenderChildren = true;

		$this->pnlCal = new \QCubed\Project\Jqui\Scheduler($this->navEntity);
		$this->pnlCal->Name = tr('Absence expert');
		$this->pnlCal->SetItems($this->GetAllClosingDates());
		$this->pnlCal->setView(array(\QCubed\Project\Jqui\Scheduler::VIEW_MONTH,\QCubed\Project\Jqui\Scheduler::VIEW_WEEK, \QCubed\Project\Jqui\Scheduler::VIEW_AGENDA));
		$this->pnlCal->setDay(date('Y,m,d'));
		
		$this->pnlCal->Draw();
		
		
		$this->pnlCal->addAction(new \QCubed\Project\Jqui\SchedulerItemCreate(), new \QCubed\Action\AjaxControl($this, "OnCalCreate"));
		$this->pnlCal->addAction(new \QCubed\Project\Jqui\SchedulerItemChange(), new \QCubed\Action\AjaxControl($this, "OnCalChange"));
		$this->pnlCal->addAction(new \QCubed\Project\Jqui\SchedulerItemDelete(), new \QCubed\Action\AjaxControl($this, "OnCalDelete"));
		
		$this->pnlMaxAm = new \Hikify\Panels\Maintenance\Maxappointments($this->pnlAppointment);
		$this->pnlMaxAm->Title = tr('Max Appointments AM');
		$this->pnlMaxAm->addCssClass("col-sm-12 col-md-6");
		
		$this->pnlMaxPm = new \Hikify\Panels\Maintenance\Maxappointments($this->pnlAppointment);
		$this->pnlMaxPm->Title = tr('Max Appointments PM');
		$this->pnlMaxPm->addCssClass("col-sm-12 col-md-6");
		
		$this->btnSaveMaxAppointments = \QCubed\Bootstrap\Button::GetFontAwesomeButton($this->pnlAppointment, "Save", 'far fa-save');
		$this->btnSaveMaxAppointments->addCssClass("btn-success");
		$this->btnSaveMaxAppointments->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "btnSaveMaxAppointments_Clicked", 'default', false));

		$this->pnlUserInfo = new \QCubed\Control\Panel($this->navEntity);
		$this->pnlUserInfo->Name = tr('Expert info');
		$this->pnlUserInfo->PreferredRenderMethod = "RenderFormGroup";
		$this->pnlUserInfo->AutoRenderChildren = true;
		/* Userinfo */
		$this->lblUserInfo = new \QCubed\Control\Label($this->pnlUserInfo);
		$this->lblUserInfo->Name = tr("Starting Address");
		$this->pnlStartingAddress = new \Hikify\Panels\Maintenance\Address($this->pnlUserInfo, tr('Address'));

		/* End Userinfo */

		$this->btnSave = \QCubed\Project\Control\Button::GetFontAwesomeButton($this->pnlUserInfo, tr('Save'), 'far fa-save', null, 'btn-success');
		$this->btnSave->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "Save", 'default', false));
	}

}
