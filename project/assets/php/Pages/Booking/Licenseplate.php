<?php

namespace Hikify\Pages\Booking;

class Licenseplate extends \QCubed\Control\Panel {
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtLicensePlate;
	/**
	 *
	 * @var Button 
	 */
	public $btnNext;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/booking/licenseplate.tpl.php';
		\QCubed\Project\Application::executeJavaScript('
														var height = $(".wrapper").outerHeight();
														$(".content-wrapper").css("min-height",height+"px");
														$(".content-wrapper").css("height",height+"px")
													');
		$this->addCssFile("/project/assets/css/booking.css");	
		
//		$this->addJavascriptFile("/project/assets/js/round-button.js");
		$this->Build();
		
		
	}
	
	public function CheckLicenseplate(){
		$objVehicle = \Vehicle::loadVehicleByPlate($this->txtLicensePlate->Text);
		if(!$objVehicle){
			$this->Trigger('LicenseplateChecked',[$this->txtLicensePlate->Text]);
		}else{$this->Trigger('VehicleFound',[$objVehicle]);}
		
		
	}
	public function Validate(){
		
		if($this->txtLicensePlate->Text !=""){
			$this->txtLicensePlate->removeCssClass("has-error");
			return true;
		}else{
			$this->txtLicensePlate->addCssClass("has-error");
		}
	}
	
	private function Build() {
		$this->txtLicensePlate				= new \QCubed\Project\Control\TextBox($this);
		$this->txtLicensePlate->Placeholder	= tr("Enter licenseplate");
		$this->txtLicensePlate->addWrapperCssClass("input-group");
		$this->txtLicensePlate->HtmlBefore	= "<span class='input-group-addon'><i class='fas fa-car'></i></span>";
		$this->txtLicensePlate->Required	= true;
						
	}
	
}
