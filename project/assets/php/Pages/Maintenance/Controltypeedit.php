<?php

namespace Hikify\Pages\Maintenance;

class Controltypeedit extends \QCubed\Project\Control\Editor {
	public $txtNameEn;
	public $txtNameFr;
	public $txtNameNl;
	public $chkActive;
	public $chkSystem;
	public $btnSave;
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox
	 */
	public $txtDuration;
	/** @var \JobRole */
	public $pnlEdit;
	private $objAppointmentType;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/controltype-edit.tpl.php';
		$this->objAppointmentType = new \AppointmentType();	
		$this->addCssFile("/project/assets/css/boolean-button.css");
		$this->Build();
		
		if(isset($_GET['id'])) {
			$objAppointmentType = \AppointmentType::Load((int) $_GET['id']);
			$this->txtNameEn->Text									= $objAppointmentType->NameEn;
			$this->txtNameNl->Text									= $objAppointmentType->NameNl;
			$this->txtNameFr->Text									= $objAppointmentType->NameFr;
			$this->chkActive->Checked								= ($objAppointmentType->Active == 1) ? true : false;
			$this->chkSystem->Checked								= ($objAppointmentType->System == 1) ? true : false;
			$this->txtDuration->Text								= $objAppointmentType->Duration;
			
			if($objAppointmentType->System){
				$this->btnSave->setCustomAttribute("disabled",true);
			}
			
			$this->objAppointmentType											= $objAppointmentType;
		}
		
	}
	public function Save() {
		\QCubed\Project\Application::Log('Save');
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT VALID FORM');
			return;
		}
		
		if(!$this->objAppointmentType) {			
			$this->objAppointmentType = new \AppointmentType();			
		}
		$check = \AppointmentType::QuerySingle(
									\QCubed\Query\QQ::AndCondition(
										\QCubed\Query\QQ::Equal(\QQN::appointmentType()->NameNl, $this->txtNameNl->Text), 
										\QCubed\Query\QQ::Equal(\QQN::appointmentType()->NameEn,$this->txtNameEn->Text),
										\QCubed\Query\QQ::Equal(\QQN::appointmentType()->NameFr, $this->txtNameFr->Text),
										\QCubed\Query\QQ::NotEqual(\QQN::appointmentType()->Id, $this->objAppointmentType->Id)
									));
		if(!$check){
			\QCubed\Project\Application::Log('Save2');

			$this->objAppointmentType->NameEn		= $this->txtNameEn->Text;
			$this->objAppointmentType->NameFr		= $this->txtNameFr->Text;
			$this->objAppointmentType->NameNl		= $this->txtNameNl->Text;
			$this->objAppointmentType->Active		= $this->chkActive->Checked;
			$this->objAppointmentType->System		= $this->chkSystem->Checked;
			$this->objAppointmentType->Duration		= $this->txtDuration->Text;

			$this->objAppointmentType->Save();

			\QCubed\Project\Application::Redirect('/?c=maintenance&a=controltype');
		}else{
			$this->objForm->ShowAlert(tr('A appointment type with the same name already exists.'));
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
		
		$this->chkActive				= new \QCubed\Project\Jqui\Checkbox($this);
		$this->chkActive->HtmlBefore	= "<label class='chk_select_label'>";
		$this->chkActive->addWrapperCssClass("chk_select");
		$this->chkActive->HtmlAfter		= "<span>".tr("Active")."</span></label>";
		$this->chkActive->Display		= true;
		
		$this->chkSystem				= new \QCubed\Project\Jqui\Checkbox($this);
		$this->chkSystem->HtmlBefore	= "<label class='chk_select_label'>";
		$this->chkSystem->addWrapperCssClass("chk_select");
		$this->chkSystem->HtmlAfter		= "<span>".tr("Active")."</span></label>";
		$this->chkSystem->Display		= false;
		
		$this->txtDuration				= new \QCubed\Project\Control\TextBox($this);
		$this->txtDuration->Name		= tr('Duration');
		$this->txtDuration->TextMode	= 'number';
		$this->txtDuration->Required	= true;
		
		$this->btnSave					= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Control type'));
	}

	
}
