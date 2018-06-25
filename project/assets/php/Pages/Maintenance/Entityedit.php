<?php

namespace Hikify\Pages\Maintenance;

/**
 * .@property-read int $EntityId Description
 */
class Entityedit extends \QCubed\Control\Panel {

	public $btnSave;
	/**
	 *
	 * @var \SubcontractorsList
	 */
	public $dgSubcontractors;
	/**
	 *
	 * @var \QCubed\Project\Control\Weekschedule 
	 */
	public $pnlWeekAm;

	/**
	 *
	 * @var \QCubed\Project\Control\Weekschedule 
	 */
	public $pnlWeekPm;

	/**
	 *
	 * @var \Hikify\Panels\Job\Entity 
	 */
	public $pnlEntityEdit;

	/**
	 *
	 * @var \Hikify\Panels\Maintenance\EntityRelation 
	 */
	public $pnlEntityRelations;
	/*
	 * @var \QCubed\Project\Control\Button
	 */
	public $btnAddfieldRelation;
	public $lstType;

	/**
	 *
	 * @var \EntityRelationList
	 */
	public $dgEntityRelations;

	/**
	 *
	 * @var \QCubed\Project\Jqui\Scheduler 
	 */
	public $pnlCal;

	/**
	 *
	 * @var \QCubed\Bootstrap\Nav
	 */
	public $navEntity;

	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlEntityRelationContainer;
	public $pnlVisiting;
	public $pnlSubcontractor;

	/**
	 *
	 * @var \Hikify\Panels\Maintenance\Entityrelation
	 */
	public $pnlEntityrelation;
	public $pnlEntityArrRelations;
	public $pnlEntityExpert;

	/**
	 *
	 * @var \Hikify\Panels\Maintenance\EntityExpert
	 */
	private $pnlMon;

	/**
	 *
	 * @var \Hikify\Panels\Maintenance\EntityExpert
	 */
	private $pnlTue;

	/**
	 *
	 * @var \Hikify\Panels\Maintenance\EntityExpert
	 */
	private $pnlWed;

	/**
	 *
	 * @var \Hikify\Panels\Maintenance\EntityExpert
	 */
	private $pnlThu;

	/**
	 *
	 * @var \Hikify\Panels\Maintenance\EntityExpert
	 */
	private $pnlFri;

	/**
	 *
	 * @var \Hikify\Panels\Maintenance\EntityExpert
	 */
	private $pnlSat;

	/**
	 *
	 * @var \Hikify\Panels\Maintenance\EntityExpert
	 */
	private $pnlSun;

	/**
	 *
	 * @var \QCubed\Bootstrap\Button
	 */
	public $btnSaveEntityExpert;

	/**
	 *
	 * @var \QCubed\Bootstrap\Button
	 */
	public $btnSaveVisitingHours;

	/**
	 *
	 * @var \QCubed\Bootstrap\Button
	 */
	public $btnSaveEntityRelations;
	private $objEntity;
	public $EntityId;

	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);

		$this->strTemplate = __TEMPLATES__ . '/pages/maintenance/entity-edit.tpl.php';
		$this->addCssFile("/project/assets/css/datagrid.css");
		$this->objEntity = new \Entity();
		$this->EntityId = isset($_GET['id'])?$_GET['id']:$this->objEntity->Id;

		$this->Build();
		$this->toggleDisplayWeekSchedule();

		if (isset($_GET['id'])) {
			$this->objEntity = \Entity::Load((int) $_GET['id']);
			$this->EntityId = $this->objEntity->Id;
			$this->pnlEntityEdit->SetEntity($this->objEntity);
			$this->pnlEntityrelation->setEntity($this->objEntity);
			$this->dgSubcontractors->Condition = \QCubed\Query\QQ::andCondition(\QCubed\Query\QQ::equal(\QQN::subcontractors()->EntityId, $this->objEntity->Id ));
			$this->dgSubcontractors->BindData();
			$this->dgSubcontractors->createColumns();
			
			$this->CheckIfEntityIsLegal($this->objEntity->LegalType);
			if ($this->objEntity->LegalType == \Entity::LEGALTYPE_LEGAL) {
				$this->pnlWeekAm->SetAllWeekDays($this->GetAllDayWeekHours("am"));
				$this->pnlWeekPm->SetAllWeekDays($this->GetAllDayWeekHours("pm"));
				$this->toggleDisplayWeekSchedule($this->objEntity->TypeId);
			}

			

			$this->setEntityRelation();
			$this->SetPnlDays($this->EntityId);
		}
		$this->pnlEntityEdit->SetReadOnlyFields(false);
		$this->pnlEntityEdit->HideAllFields(false);
		$this->pnlEntityEdit->HideSearch(true);
		$this->pnlEntityEdit->HideNotification();
	}

	public function __get($strName) {
		switch ($strName) {
			case 'EntityId':
				return $this->objEntity->Id;

			default: return parent::__get($strName);
		}
	}

	public function setEntityRelation() {
		$this->dgEntityRelations->createListOverviewRelations($this->objEntity->Id);
		$this->dgEntityRelations->Condition = \QCubed\Query\QQ::orCondition(
													\QCubed\Query\QQ::equal(\QQN::entityRelation()->Entity1->Id, $this->objEntity->Id), 
													\QCubed\Query\QQ::equal(\QQN::entityRelation()->Entity2->Id, $this->objEntity->Id)
												);
	}

	public function GetAllDayWeekHours($amPm) {
		$Days = array();
		$LoadedArray = \EntityVisitinghour::LoadByAmPmEntityId($amPm, (int) $this->EntityId);

		foreach ($LoadedArray as $row) {
			$Days[$row->Day]['Start'] = "";
			$Days[$row->Day]['End'] = "";
			if ($row->From) {
				$Days[$row->Day]['Start'] = $row->From->format('H:i');
			}
			if ($row->To) {
				$Days[$row->Day]['End'] = $row->To->format('H:i');
			}
		}
		return $Days;
	}

	public function saveEntity() {


		/* if ($this->objEntity->Id && count($this->pnlEntityrelation->getChildControls())) {
		  if (\EntityRelation::loadArrayByEntity1Id($this->objEntity->Id)) {
		  \EntityRelation::DeleteByEntityId($this->objEntity->Id);
		  }

		  foreach($this->pnlEntityrelation->getChildControls() as $pnlEntityRelation){
		  $relation = new \EntityRelation();
		  $relation->Entity1Id = $this->EntityId;
		  $relation->Entity2Id = $pnlEntityRelation->lstEntities->SelectedValue;
		  $relation->EntityRoleId = $pnlEntityRelation->lstRoles->SelectedValue;

		  $relation->Save();
		  }
		  } */

		\QCubed\Project\Application::Redirect('index.php?c=maintenance&a=entity'); //back to the list if job not found!
	}

	public function SetPnlDays() {
		if (!$this->objEntity->Id) {
			return;
		}
//		$this->pnlMon->setEntityExpert($this->objEntity->Id, 'monday');
//		$this->pnlTue->setEntityExpert($this->objEntity->Id, 'tuesday');
//		$this->pnlWed->setEntityExpert($this->objEntity->Id, 'wednesday');
//		$this->pnlThu->setEntityExpert($this->objEntity->Id, 'thursday');
//		$this->pnlFri->setEntityExpert($this->objEntity->Id, 'friday');
//		$this->pnlSat->setEntityExpert($this->objEntity->Id, 'saturday');
//		$this->pnlSun->setEntityExpert($this->objEntity->Id, 'sunday');
	}

	public function GetArrayPnlDays() {
		return array(
			'monday' => $this->pnlMon->lstExpert->SelectedValue,
			'tuesday' => $this->pnlTue->lstExpert->SelectedValue,
			'wednesday' => $this->pnlWed->lstExpert->SelectedValue,
			'thursday' => $this->pnlThu->lstExpert->SelectedValue,
			'friday' => $this->pnlFri->lstExpert->SelectedValue,
			'saturday' => $this->pnlSat->lstExpert->SelectedValue,
			'sunday' => $this->pnlSun->lstExpert->SelectedValue,
		);
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

		$ArrDatesBetween = $this->createDateRange($this->pnlCal->SelectedValue->Start->format("Ymd"), $this->pnlCal->SelectedValue->End->format("Ymd"));
		$strRandomGenerated = $this->generateRandomString();
		foreach ($ArrDatesBetween as $date) {
			$objClosingDate = new \EntityClosingday();
			$objClosingDate->Subject = $this->pnlCal->SelectedValue->Subject;
			$objClosingDate->Date = new \QCubed\QDateTime($date);
			$objClosingDate->EntityId = $this->EntityId;
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
		\EntityClosingday::deleteByEntityAndIdentifier($this->EntityId, $this->pnlCal->SelectedValue->Id);

		$ArrDatesBetween = $this->createDateRange($this->pnlCal->SelectedValue->Start->format("Ymd"), $this->pnlCal->SelectedValue->End->format("Ymd"));
		foreach ($ArrDatesBetween as $date) {
			$objClosingDate = new \EntityClosingday();
			$objClosingDate->Subject = $this->pnlCal->SelectedValue->Subject;
			$objClosingDate->Date = new \QCubed\QDateTime($date);
			$objClosingDate->EntityId = $this->EntityId;
			$objClosingDate->Identifier = $this->pnlCal->SelectedValue->Id;

			$objClosingDate->Save();
		}
	}

	public function OnCalDelete() {
		if (!$this->pnlCal->SelectedValue) {
			return;
		}
		\EntityClosingday::deleteByEntityAndIdentifier($this->EntityId, $this->pnlCal->SelectedValue->Id);
	}

	public function btnAddfieldRelation_Clicked() {
		
		$this->pnlEntityrelation->Save();
		$this->pnlEntityrelation->setEntityRelation(null);
		$this->dgEntityRelations->dataBind();
	}

	/**
	 * 
	 * @return \QCubed\Project\Jqui\SchedulerItem[]
	 */
	private function GetAllClosingDates() {
		$arrItems = array();

		$arrClosingDays = \EntityClosingday::getArrayBetweendDatesByEntityId($this->EntityId);

		foreach ($arrClosingDays as $objClosingDay) {
			$arrItems[] = new \QCubed\Project\Jqui\SchedulerItem($objClosingDay->Identifier, new \QCubed\QDateTime($objClosingDay->getVirtualAttribute("minstart")), new \QCubed\QDateTime($objClosingDay->getVirtualAttribute("maxstart")), $objClosingDay->Subject);
		}

		return $arrItems;
	}

	public function btnEntityExpertSaved_Clicked() {
		foreach ($this->GetArrayPnlDays() as $Day => $Expert) {
			if($Expert){
				$objEntityExpert = \EntityExpert::loadByEntityAndDay($this->objEntity->Id,$Day);
				if (!$objEntityExpert) {
					$objEntityExpert = new \EntityExpert();
				}
				$objEntityExpert->ExpertId = $Expert;
				$objEntityExpert->EntityId = $this->objEntity->Id;
				$objEntityExpert->Day = $Day;
				$objEntityExpert->Save();
			}
			
		}
	}

	public function btnSaveVisitingHours_Clicked() {
		if ($this->objEntity->Id) {
			\EntityVisitinghour::DeleteByEntityId($this->objEntity->Id);
		}
		foreach ($this->pnlWeekAm->GetAllWeekDays() as $day => $hours) {
			\EntityVisitinghour::Create($this->objEntity->Id, $day, $hours['Start'], $hours['End'], 'am')->save();
		}
		foreach ($this->pnlWeekPm->GetAllWeekDays() as $day => $hours) {
			\EntityVisitinghour::Create($this->objEntity->Id, $day, $hours['Start'], $hours['End'], 'pm')->save();
		}
	}
	
	public function btnrelationedit_click($intSelectedRelationId){
		$this->pnlEntityrelation->setEntityRelation(\EntityRelation::loadById($intSelectedRelationId));
		
	}
	
	public function btnrelationdelete_click($intSelectedRelationId){
		\EntityRelation::DeleteById($intSelectedRelationId);
		$this->dgEntityRelations->dataBind();
	}
	private function Build() {
		$this->navEntity = new \QCubed\Bootstrap\Nav($this);

		$this->pnlEntityEdit = new \Hikify\Panels\Job\Entity($this->navEntity);
		$this->pnlEntityEdit->Name = tr('Entity');
		$this->pnlEntityEdit->Register('OnSave', 'saveEntity', $this);
		$this->pnlEntityEdit->Register('OnTypeChanged', 'toggleDisplayWeekSchedule', $this);

		$this->pnlEntityRelationContainer = new \QCubed\Control\Panel($this->navEntity);
		$this->pnlEntityRelationContainer->Name = tr('Relations');
		$this->pnlEntityRelationContainer->PreferredRenderMethod = "RenderFormGroup";
		$this->pnlEntityRelationContainer->AutoRenderChildren = true;

		$this->pnlEntityrelation = new \Hikify\Panels\Maintenance\Entityrelation($this->pnlEntityRelationContainer);
		
//		$this->pnlEntityExpert = new \QCubed\Control\Panel($this->navEntity);
//		$this->pnlEntityExpert->Name = tr('Expert');
//		$this->pnlEntityExpert->PreferredRenderMethod = "RenderFormGroup";
//		$this->pnlEntityExpert->AutoRenderChildren = true;

//		$this->pnlMon = new \Hikify\Panels\Maintenance\EntityExpert($this->pnlEntityExpert, "Monday");
//		$this->pnlTue = new \Hikify\Panels\Maintenance\EntityExpert($this->pnlEntityExpert, "Tuesday");
//		$this->pnlWed = new \Hikify\Panels\Maintenance\EntityExpert($this->pnlEntityExpert, "Wednesday");
//		$this->pnlThu = new \Hikify\Panels\Maintenance\EntityExpert($this->pnlEntityExpert, "Thursday");
//		$this->pnlFri = new \Hikify\Panels\Maintenance\EntityExpert($this->pnlEntityExpert, "Friday");
//		$this->pnlSat = new \Hikify\Panels\Maintenance\EntityExpert($this->pnlEntityExpert, "Saturday");
//		$this->pnlSun = new \Hikify\Panels\Maintenance\EntityExpert($this->pnlEntityExpert, "Sunday");
		
//		$this->btnSaveEntityExpert = \QCubed\Bootstrap\Button::GetFontAwesomeButton($this->pnlEntityExpert, "Save", 'far fa-save');
//		$this->btnSaveEntityExpert->addCssClass("btn-success");
//		$this->btnSaveEntityExpert->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "btnEntityExpertSaved_Clicked", 'default', false));

		$this->btnAddfieldRelation = \QCubed\Project\Control\Button::GetFontAwesomeButton($this->pnlEntityRelationContainer, tr('Add Relation'), 'far fa-handshake');
		$this->btnAddfieldRelation->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "btnAddfieldRelation_Clicked", 'default', false));
		$this->btnAddfieldRelation->addCssClass("btn-success");
		
		$this->dgEntityRelations = new \EntityRelationList($this->pnlEntityRelationContainer);
		$this->dgEntityRelations->addCssClass("datagrid");
		$this->dgEntityRelations->Register("OnEdit","btnrelationedit_click",$this);
		$this->dgEntityRelations->Register("OnDelete","btnrelationdelete_click",$this);
		
		$this->pnlCal = new \QCubed\Project\Jqui\Scheduler($this->navEntity);
		$this->pnlCal->Name = tr('Closing days');
		$this->pnlCal->SetItems($this->GetAllClosingDates());
		$this->pnlCal->setView(array(\QCubed\Project\Jqui\Scheduler::VIEW_MONTH,\QCubed\Project\Jqui\Scheduler::VIEW_AGENDA));
		$this->pnlCal->setDay(date('Y,m,d'));
		
		$this->pnlCal->Draw();
		
		$this->pnlCal->addAction(new \QCubed\Project\Jqui\SchedulerItemCreate(), new \QCubed\Action\AjaxControl($this, "OnCalCreate"));
		$this->pnlCal->addAction(new \QCubed\Project\Jqui\SchedulerItemChange(), new \QCubed\Action\AjaxControl($this, "OnCalChange"));
		$this->pnlCal->addAction(new \QCubed\Project\Jqui\SchedulerItemDelete(), new \QCubed\Action\AjaxControl($this, "OnCalDelete"));

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
		
		$pnlSubcontractors  = new \QCubed\Control\Panel($this->navEntity);
		$pnlSubcontractors->Name = tr('Subcontractor');
		$pnlSubcontractors->PreferredRenderMethod = "RenderFormGroup";
		$pnlSubcontractors->AutoRenderChildren = true;
		
		$this->dgSubcontractors	= new \SubcontractorsList($pnlSubcontractors);
		$this->dgSubcontractors->CssClass						= 'table';
		$this->dgSubcontractors->Register("OnEdit","btnSubcontractorsedit_click",$this);
		$this->dgSubcontractors->Register("OnDelete","btnSubcontractorsdelete_click",$this);
		
		$this->pnlSubcontractor = new \Hikify\Panels\Job\Entity($pnlSubcontractors);
		$this->pnlSubcontractor->Register('OnSave', 'saveSubcontractor', $this);
		
	}
	public function btnSubcontractorsedit_click($intSelectedId){
		\QCubed\Project\Application::redirect('/?c=maintenance&a=entityedit&id='.$intSelectedId); 
	}
	public function btnSubcontractorsdelete_click($intSelectedId){
		\Subcontractors::deleteById($intSelectedId);
		$this->dgSubcontractors->dataBind();
	}
	public function saveSubcontractor(\Entity $objEntitySubcontractor){
		if($objEntitySubcontractor && $this->objEntity){
			$this->objEntity->HasSubcontractors = 1;
			$this->objEntity->Save();
			$objSubcontractor = \Subcontractors::loadByEntityIdAndSubcontractorId($this->objEntity->Id, $objEntitySubcontractor->Id);
			if(!$objSubcontractor){
				$objSubcontractor = new \Subcontractors();			
			}
			$objSubcontractor->EntityId = $this->objEntity->Id;
			$objSubcontractor->SubcontractorId = $objEntitySubcontractor->Id;
			$objSubcontractor->Save();
		}
		$this->pnlSubcontractor->HideSearch(false);
		$this->pnlSubcontractor->ClearFields();
		$this->pnlSubcontractor->ReadOnly = false;
		
		$this->dgSubcontractors->Condition = \QCubed\Query\QQ::andCondition(\QCubed\Query\QQ::equal(\QQN::subcontractors()->EntityId, $this->objEntity->Id ));
		$this->dgSubcontractors->BindData();
	}

	public function CheckIfEntityIsLegal($strEntityType = "legal") {
		if ($strEntityType == \Entity::LEGALTYPE_LEGAL) {
			$this->pnlCal->Draw();
		}
	}

	public function toggleDisplayWeekSchedule($intEntityType = null) {
		$this->lstType = $intEntityType;
	//	$blnHide = false;
	//	if ($intEntityType == 4) {
		$blnHide = true;
	//	}
		$this->pnlWeekPm->Visible = $blnHide;
		$this->pnlWeekAm->Visible = $blnHide;
	}

}
