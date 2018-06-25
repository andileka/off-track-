<?php

namespace Hikify\Pages\Maintenance;

class Jobroleedit extends \QCubed\Project\Control\Editor {
	public $txtNameEn;
	public $txtNameFr;
	public $txtNameNl;
	public $chkActive;
	public $btnSave;
	/** @var \JobRole */
	public $pnlEdit;
	private $objRole;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/jobrole-edit.tpl.php';
		$this->objRole = new \JobRole();	
		$this->addCssFile("/project/assets/css/boolean-button.css");
		$this->Build();
		
		if(isset($_GET['id'])) {
			$objRole = \JobRole::Load((int) $_GET['id']);
			$this->txtNameEn->Text									= $objRole->NameEn;
			$this->txtNameNl->Text									= $objRole->NameNl;
			$this->txtNameFr->Text									= $objRole->NameFr;
			$this->chkActive->Checked								= ($objRole->System == 1) ? true : false;
			
			$this->objRole											= $objRole;
		}
		
	}
	public function Save() {
		\QCubed\Project\Application::Log('Save');
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT VALID FORM');
			return;
		}
		
		if(!$this->objRole) {			
			$this->objRole = new \JobRole();			
		}
		$check = \JobRole::QuerySingle(
									\QCubed\Query\QQ::AndCondition(
										\QCubed\Query\QQ::Equal(\QQN::JobRole()->NameNl, $this->txtNameNl->Text), 
										\QCubed\Query\QQ::Equal(\QQN::JobRole()->NameEn,$this->txtNameEn->Text),
										\QCubed\Query\QQ::Equal(\QQN::JobRole()->NameFr, $this->txtNameFr->Text),
										\QCubed\Query\QQ::NotEqual(\QQN::JobRole()->Id, $this->objRole->Id)
									));
		if(!$check){
			\QCubed\Project\Application::Log('Save2');

			$this->objRole->NameEn		= $this->txtNameEn->Text;
			$this->objRole->NameFr		= $this->txtNameFr->Text;
			$this->objRole->NameNl		= $this->txtNameNl->Text;
			$this->objRole->Active		= $this->chkActive->Checked;

			$this->objRole->Save();

			\QCubed\Project\Application::Log('Save3');

			\QCubed\Project\Application::Redirect('/?c=maintenance&a=jobrole');
		}else{
			$this->objForm->ShowAlert(tr('A job role with the same name already exists.'));
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
		
		$this->btnSave					= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Jobrole'));
	}

	
}
