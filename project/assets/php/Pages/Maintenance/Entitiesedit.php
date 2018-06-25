<?php

namespace Hikify\Pages\Maintenance;

class Entitiesedit extends \QCubed\Control\Panel {
	public $txtNameEn;
	public $txtNameFr;
	public $txtNameNl;
	public $chkActive;
	public $btnSave;
	/** @var \EntityType **/
	public $pnlEdit;
	private $objEntities;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/entities-edit.tpl.php';
		$this->objEntities			= new \EntityType();	
		$this->Build();
		
		if(isset($_GET['id'])) {
			$objEntities = \EntityType::Load((int) $_GET['id']);
			$this->txtNameEn->Text									= $objEntities->NameEn;
			$this->txtNameNl->Text									= $objEntities->NameNl;
			$this->txtNameFr->Text									= $objEntities->NameFr;
			$this->chkActive->Checked								= ($objEntities->Active == 1) ? true : false;
			
			$this->objEntities										= $objEntities;
		}
		
	}
	public function Save() {
		\QCubed\Project\Application::Log('Save');
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT VALID FORM');
			return;
		}
		
		if(!$this->objEntities) {			
			$this->objEntities = new \EntityType();			
		}
		$check = \EntityType::QuerySingle(
									\QCubed\Query\QQ::AndCondition(
										\QCubed\Query\QQ::Equal(\QQN::EntityType()->NameNl, $this->txtNameNl->Text), 
										\QCubed\Query\QQ::Equal(\QQN::EntityType()->NameEn,$this->txtNameEn->Text),
										\QCubed\Query\QQ::Equal(\QQN::EntityType()->NameFr, $this->txtNameFr->Text),
										\QCubed\Query\QQ::NotEqual(\QQN::EntityType()->Id, $this->objEntities->Id)
									));
		if(!$check){

			\QCubed\Project\Application::Log('Save2');

			$this->objEntities->NameEn		= $this->txtNameEn->Text;
			$this->objEntities->NameFr		= $this->txtNameFr->Text;
			$this->objEntities->NameNl		= $this->txtNameNl->Text;
			$this->objEntities->Active		= $this->chkActive->Checked;

			$this->objEntities->Save();

			\QCubed\Project\Application::Log('Save3');

			\QCubed\Project\Application::Redirect('/?c=maintenance&a=entities');
		}else{
			$this->objForm->ShowAlert(tr('A entity type with the same name already exists.'));
		}	
	}
	private function Build() {		
		$this->pnlEdit = new \QCubed\Control\Panel($this);
		
		$this->txtNameEn				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameEn->Name			= tr('Name EN');
		
		$this->txtNameFr				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameFr->Name			= tr('Name FR');
		
		$this->txtNameNl				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameNl->Name			= tr('Name NL');
		
		$this->chkActive				= new \QCubed\Project\Control\Checkbox($this);
		$this->chkActive->Name			= tr('Active');
		
		$this->btnSave					= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Jobtype'));
	}

	
}
