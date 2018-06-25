<?php

namespace Hikify\Pages\Maintenance;

class VehicleTypeEdit extends \Editor {
	public $txtNameEn;
	public $txtNameFr;
	public $txtNameNl;
	public $chkActive;
	
	public $btnSave;
	/** @var \VehicleType */
	private $objVehicleType;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/vehicletype-edit.tpl.php';
		$this->objVehicleType		= new \VehicleType();	
		$this->Build();
		
		if(isset($_GET['id'])) {
			$objVehicleType											= \VehicleType::Load((int) $_GET['id']);
			$this->txtNameEn->Text									= $objVehicleType->NameEn;
			$this->txtNameNl->Text									= $objVehicleType->NameNl;
			$this->txtNameFr->Text									= $objVehicleType->NameFr;
			$this->chkActive->Checked								= ($objVehicleType->Active == 1);
			
			$this->objVehicleType									= $objVehicleType;
		}
		
	}
	public function Save() {
		if( !$this->Validate() ) {
			\QCubed\Project\Application::Log('NOT VALID FORM');
			return;
		}
		
		if(!$this->objVehicleType) {			
			$this->objVehicleType = new \VehicleType();			
		}
		$check = \VehicleType::QuerySingle(
									\QCubed\Query\QQ::AndCondition(
										\QCubed\Query\QQ::OrCondition(
											\QCubed\Query\QQ::Equal(\QQN::VehicleType()->NameNl, $this->txtNameNl->Text), 
											\QCubed\Query\QQ::Equal(\QQN::VehicleType()->NameEn,$this->txtNameEn->Text),
											\QCubed\Query\QQ::Equal(\QQN::VehicleType()->NameFr, $this->txtNameFr->Text)
										),										
										\QCubed\Query\QQ::NotEqual(\QQN::VehicleType()->Id, $this->objVehicleType->Id)
									));
		if(!$check){
			\QCubed\Project\Application::Log('Save2');

			$this->objVehicleType->NameEn		= $this->txtNameEn->Text;
			$this->objVehicleType->NameFr		= $this->txtNameFr->Text;
			$this->objVehicleType->NameNl		= $this->txtNameNl->Text;
			$this->objVehicleType->Active		= $this->chkActive->Checked;

			$this->objVehicleType->Save();

			\QCubed\Project\Application::Log('Save3');

			\QCubed\Project\Application::Redirect('/?c=maintenance&a=vehicletypes');
		}else{
			$this->objForm->ShowAlert(tr('A vehicle type with the same name already exists.'));
		}
	}
	private function Build() {		
		
		$this->txtNameEn				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameEn->Required		= true;
		$this->txtNameEn->Name			= tr('Name EN');
		
		$this->txtNameFr				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameFr->Required		= true;
		$this->txtNameFr->Name			= tr('Name FR');
		
		$this->txtNameNl				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameNl->Required		= true;
		$this->txtNameNl->Name			= tr('Name NL');
		
		$this->chkActive				= new \QCubed\Project\Control\Checkbox($this);
		$this->chkActive->Name			= tr('Active');
		$this->chkActive->Checked		= true;
		
		$this->btnSave					= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Type'));
	}

	
}
