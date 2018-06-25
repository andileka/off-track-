<?php

namespace Hikify\Pages\Maintenance;

class Makeedit extends \QCubed\Project\Control\Editor {
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox 
	 */
	public $txtName;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstVehicleType;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Button 
	 */
	public $btnSave;
	/** @var \Make */
	private $objMake;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/make-edit.tpl.php';
		$this->objMake		= new \Make();	
		$this->addCssFile("/project/assets/css/boolean-button.css");
		$this->Build();
		
		if(isset($_GET['id'])) {
			$objMake											= \Make::Load((int) $_GET['id']);
			$this->txtName->Text								= $objMake->Name;
			$this->lstVehicleType->SelectedValue				= $objMake->VehicleTypeId;
			$this->objMake										= $objMake;
		}
		
	}
	public function Save() {
		if( !$this->Validate() ) {
			\QCubed\Project\Application::Log('NOT VALID FORM');
			return;
		}
		
		if(!$this->objMake) {			
			$this->objMake = new \Make();			
		}
		$check = \Make::QuerySingle(
									\QCubed\Query\QQ::AndCondition(
										\QCubed\Query\QQ::andCondition(
											\QCubed\Query\QQ::Equal(\QQN::make()->Name, $this->txtName->Text), 
											\QCubed\Query\QQ::Equal(\QQN::make()->VehicleTypeId,$this->lstVehicleType->SelectedValue)
										)										
									));
		if(!$check){
			$this->objMake->Name				= $this->txtName->Text;
			$this->objMake->VehicleTypeId		= $this->lstVehicleType->SelectedValue;
			$this->objMake->Save();

			\QCubed\Project\Application::Redirect('/?c=maintenance&a=makes');
		}else{
			$this->objForm->ShowAlert(tr('A make with the same name already exists.'));
		}
	}
	private function Build() {		
		
		$this->txtName				= new \QCubed\Project\Control\TextBox($this);
		$this->txtName->Required		= true;
		$this->txtName->Name			= tr('Name');
		
		$this->lstVehicleType			= \VehicleType::GetListBox($this);
		$this->lstVehicleType->Name		= tr("Vehicle type");
		
		$this->btnSave					= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Make'));
	}

	
}
