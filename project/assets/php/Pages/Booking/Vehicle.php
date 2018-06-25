<?php

namespace Hikify\Pages\Booking;

class Vehicle extends \QCubed\Control\Panel {
	
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstMake;
	/**
	 * 
	 * @var \QCubed\Project\Jqui\Autocomplete
	 */
	public $txtModel;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtNumberKm;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtColor;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtVin;
	/**
	 *
	 * @var \QCubed\QDateTime
	 */
	public $ddtDateAccident;
	/**
	 * 
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstVehicletype;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtPlate;
	private $objVehicle;
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/booking/vehicle.tpl.php';
		\QCubed\Project\Application::executeJavaScript('
														var height = $(".wrapper").outerHeight();
														$(".content-wrapper").css("min-height",height+"px");
														$(".content-wrapper").css("height",height+"px")
													');
		$this->addCssFile("/project/assets/css/booking.css");			
//		$this->addJavascriptFile("/project/assets/js/round-button.js");
		$this->Build();
		
		
	}
	public function lstMake_Changed() {
		$this->txtModel->setCustomAttribute("make_id", $this->lstMake->SelectedValue);		
	}
	public function CheckVehicle(){
		$objJob = "";
		if($this->objVehicle){
			/** FIND JOB VEHICLE ID */
			$objJob = \Job::loadByVehicleId($this->objVehicle->Id, \QCubed\Query\QQ::orderBy(\QQN::job()->Id, 'DESC'));
			
			
		}else{
			// JOB AND VEHICLE IS UNKNOWN
			$objModel					= \Model::loadByMakeIdName($this->lstMake->SelectedValue, $this->txtModel->Text);
			if(!$objModel){
				$objModel				= new \Model();
				$objModel->MakeId		= $this->lstMake->SelectedValue;
				$objModel->Name			= $this->txtModel->Text;
				$objModel->Save();
			}
			$objVehicle					= new \Vehicle();
			$objVehicle->MakeId			= $this->lstMake->SelectedValue;
			$objVehicle->ModelId		= $objModel->Id;
			$objVehicle->Plate			= $this->txtPlate->Text;
			$objVehicle->TypeId			= $this->lstVehicletype->SelectedValue;
			$objVehicle->Colour			= $this->txtColor->Text;
			$objVehicle->Vin			= $this->txtVin->Text;
			
			$objVehicle->Save();
			
			$objJob						= new \Job();
			$objJob->TypeId				= 1;
			$objJob->VehicleId			= $objVehicle->Id;
			$objJob->Number				= $objJob->Id;
			$objJob->AccidentDate		= $this->ddtDateAccident->DateTime;
			$objJob->Save();
		}
		$this->Trigger('CheckVehicle',[$objJob]);
	}
	public function SetVehicleInformation(\Vehicle $objVehicle){
		$this->objVehicle						= $objVehicle;
		$this->lstMake->SelectedValue			= $objVehicle->MakeId;
		$this->txtModel->Text					= $objVehicle->Model->Name;
		$this->txtVin->Text						= $objVehicle->Vin;
		$this->txtPlate->Text					= $objVehicle->Plate;
		$this->lstVehicletype->SelectedValue	= $objVehicle->TypeId;
		$this->txtColor->Text					= $objVehicle->Colour;
		
	}
	public function SetPlate($strPlate){
		$this->txtPlate->Text					= $strPlate;
	}
	public function Validate(){
		if($this->lstMake->SelectedValue && $this->txtModel->Text && $this->txtVin->Text && $this->txtPlate->Text){
			$this->lstMake->removeCssClass("has-error");
			$this->txtModel->removeCssClass("has-error");
			$this->txtVin->removeCssClass("has-error");
			$this->txtPlate->removeCssClass("has-error");
			return true;
		}else{
			$this->lstMake->addCssClass("has-error");
			$this->txtModel->addCssClass("has-error");
			$this->txtVin->addCssClass("has-error");
			$this->txtPlate->addCssClass("has-error");
		}
	}
	private function Build() {
		$this->lstVehicletype					= \VehicleType::GetListBox($this);
		$this->lstVehicletype->Required         = true;
		$this->lstVehicletype->SelectedValue	= 1;
		
		$this->lstMake							= \Make::GetListBox($this);
		$this->lstMake->Required				= true;
		$this->lstMake->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'lstMake_Changed'));
		
		$this->txtModel							= \Model::GetAutocompleteTextBox($this, 'Model::GetModelsAsListItems');
		$this->txtModel->Placeholder			= tr('Model');
		$this->txtModel->Required				= true;
		
		$this->txtVin							= \Vehicle::GetAutocompleteTextBox($this, '\Vehicle::GetVinAsListItems');
//		$this->txtVin->AddAction(new \QCubed\Event\Change, new \QCubed\Action\AjaxControl($this, 'VinSelected'));
		$this->txtVin->Placeholder				= tr('VIN');
		$this->txtVin->Required					= false;
		$this->txtVin->MaxLength				= \Vehicle::VIN_MAX_LENGTH;
		
		$this->ddtDateAccident                  = new \QCubed\Project\Jqui\DatepickerBox($this);
		$this->ddtDateAccident->Placeholder     = tr('Date Accident');
		$this->ddtDateAccident->Required		= true;
		$this->ddtDateAccident->addWrapperCssClass("input-group");
		$this->ddtDateAccident->HtmlBefore	= "<span class='input-group-addon'><i class='fas fa-calendar-alt'></i></span>";
		
		$this->txtNumberKm						= new \QCubed\Project\Control\TextBox($this);
		$this->txtNumberKm->Placeholder			= tr('Total Km');
		$this->txtNumberKm->Required			= false;
		$this->txtNumberKm->addWrapperCssClass("input-group");
		$this->txtNumberKm->HtmlBefore			= "<span class='input-group-addon'><i class='fas fa-tachometer-alt'></i></span>";
		
		$this->txtPlate							= new \QCubed\Bootstrap\TextBox($this);
		
		$this->txtColor							= new \QCubed\Bootstrap\TextBox($this);
		$this->txtColor->Placeholder			= tr('Color');
//		$this->txtPlate->Display				= false;
						
	}
	
}
