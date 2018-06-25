<?php

namespace Hikify\Pages\Maintenance;

class Appointmenttypeedit extends \QCubed\Project\Control\Editor {
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox 
	 */
	public $txtNameEn;
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox 
	 */
	public $txtNameFr;
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox 
	 */
	public $txtNameNl;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Checkbox
	 */
	public $chkActive;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Button
	 */
	public $btnSave;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlEdit;
	/** @var \AppointmentTaskType */
	private $objAppointmentTaskType;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/appointmenttype-edit.tpl.php';
		$this->objAppointmentTaskType			= new \AppointmentTaskType();	
		$this->addCssFile("/project/assets/css/boolean-button.css");
		$this->Build();
		
		if(isset($_GET['id'])) {
			$objAppointmentTaskType = \AppointmentTaskType::Load((int) $_GET['id']);
			$this->txtNameEn->Text									= $objAppointmentTaskType->NameEn;
			$this->txtNameNl->Text									= $objAppointmentTaskType->NameNl;
			$this->txtNameFr->Text									= $objAppointmentTaskType->NameFr;
			$this->chkActive->Checked								= ($objAppointmentTaskType->Active == 1) ? true : false;
			
			$this->objAppointmentTaskType							= $objAppointmentTaskType;
		}
		
	}
	public function Save() {
		\QCubed\Project\Application::Log('Save');
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT VALID FORM');
			return;
		}
		
		if(!$this->objAppointmentTaskType) {			
			$this->objAppointmentTaskType = new \AppointmentTaskType();			
		}
		$check = \AppointmentTaskType::QuerySingle(
									\QCubed\Query\QQ::AndCondition(
										\QCubed\Query\QQ::Equal(\QQN::appointmentTaskType()->NameNl, $this->txtNameNl->Text), 
										\QCubed\Query\QQ::Equal(\QQN::appointmentTaskType()->NameEn,$this->txtNameEn->Text),
										\QCubed\Query\QQ::Equal(\QQN::appointmentTaskType()->NameFr, $this->txtNameFr->Text),
										\QCubed\Query\QQ::NotEqual(\QQN::appointmentTaskType()->Id, $this->objAppointmentTaskType->Id)
									));
		if(!$check){
			\QCubed\Project\Application::Log('Save2');

			$this->objAppointmentTaskType->NameEn		= $this->txtNameEn->Text;
			$this->objAppointmentTaskType->NameFr		= $this->txtNameFr->Text;
			$this->objAppointmentTaskType->NameNl		= $this->txtNameNl->Text;
			$this->objAppointmentTaskType->Active		= $this->chkActive->Checked;

			$this->objAppointmentTaskType->Save();

			\QCubed\Project\Application::Log('Save3');

			\QCubed\Project\Application::Redirect('/?c=maintenance&a=appointmenttype');
		}else{
			$this->objForm->ShowAlert(tr('A Task type with the same name already exists.'));
		}
	}
	private function Build() {		
		
		$this->pnlEdit = new \QCubed\Control\Panel($this);
		$this->txtNameEn				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameEn->Name			= tr('Name EN');
		$this->txtNameEn->Required		= true;
		
		$this->txtNameFr				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameFr->Name			= tr('Name FR');
		$this->txtNameFr->Required		= true;
		
		$this->txtNameNl				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameNl->Name			= tr('Name NL');
		$this->txtNameNl->Required		= true;
		
		$this->chkActive						= new \QCubed\Project\Jqui\Checkbox($this);
		
		$this->chkActive->HtmlBefore			= "<label class='chk_select_label'>";
		$this->chkActive->addWrapperCssClass("chk_select");
		$this->chkActive->HtmlAfter				= "<span>".tr("Active")."</span></label>";
		
		$this->btnSave					= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Tasktype'));
	}

	
}
