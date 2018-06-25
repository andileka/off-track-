<?php

namespace Hikify\Pages\Booking;

class Success extends \QCubed\Control\Panel {
	/** VEHICLE **/
	public $lblType;
	public $lblMake;
	public $lblModel;
	public $lblPlate;
	public $lblColor;
	public $lblVin;
	public $lblDate;
	/** ENTITY **/
	public $lblEntity;
	public $lblEntityType;
	public $lblAddress;
	/** APPOINTMENT **/
	public $lblappointmentType;
	public $lblDateAppointment;
	public $lblDateMayChange;
	/** OPTIONS **/
	/**
	 *
	 * @var \QCubed\Control\Label 
	 */
	public $lblOptions;
	private $objAppointment;
	private $objEntity;
	private $objJob;
	private $objVehicle;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/booking/success.tpl.php';
		\QCubed\Project\Application::executeJavaScript('
														var height = $(".wrapper").outerHeight();
														$(".content-wrapper").css("min-height",height+"px");
														$(".content-wrapper").css("height",height+"px")
													');
		$this->addCssFile("/project/assets/css/booking.css");	
		
//		$this->addJavascriptFile("/project/assets/js/round-button.js");
		$this->Build();
		
		
	}
	
	public function SetAppointment(\Appointment $objAppointment){
		$this->objAppointment = $objAppointment;
		$this->lblappointmentType->Text				= $objAppointment->Type;
		$this->lblDateAppointment->Text				= $objAppointment->PreferredDate . " " . $objAppointment->PreferredTime;
		$this->lblDateMayChange->Text				= $objAppointment->PreferredTimeMayChange;
	}
	public function SetEntity(\Entity $objEntity){
		if($objEntity){
			$this->objEntity = $objEntity;
			$objEntityJob						= \EntityJob::loadByJobIdAndEntity($this->objJob->Id, $objEntity->Id);
			$this->lblEntity->Text				= ($objEntity->CompanyName) ? $objEntity->CompanyName : $objEntity->FirstName . " ". $objEntity->LastName;
			$this->lblAddress->Text				= $objEntity->Address;
//			$this->lblEntityType->Text			= $objEntityJob->Role;
		}
	}
	public function SetVehicle(\Vehicle $objVehicle){
		$this->objVehicle = $objVehicle;
		$this->lblType->Text			= $objVehicle->Type;
		$this->lblMake->Text			= $objVehicle->Make;
		$this->lblModel->Text			= $objVehicle->Model;
		$this->lblPlate->Text			= $objVehicle->Plate;
		$this->lblColor->Text			= $objVehicle->Colour;
		$this->lblVin->Text				= $objVehicle->Vin;
		
	}
	public function SetJob(\Job $objJob){
		$txtTask="";
		$this->objJob = $objJob;
		$this->lblDate->Text			= ($objJob->AccidentDate) ? $objJob->AccidentDate->format("D d/m/Y") : tr("Not known");
		$arrJobTasks					= \AppointmentTasks::loadArrayByAppointmentId($this->objAppointment->Id);
		if($arrJobTasks){
			foreach($arrJobTasks as $objTask){
				$lbl		= new \QCubed\Control\Label($this->lblOptions); 
				$lbl->Text	= $objTask->Task->{\QCubed\Project\Application::$LocaleName};
			}
		}
		
		$this->lblOptions->Text			= $txtTask;
	}
	
	private function GetAllTaskTypes(){
		$this->pnlOptions->removeChildControls();
		foreach(\AppointmentTaskType::loadByAppointmentId($this->objAppointment->Id) as $objTask){
			$chkSelect				= new \QCubed\Project\Jqui\Checkbox($this->pnlOptions);
			$chkSelect->HtmlBefore	= "<label class='chk_select_label'>";
			$chkSelect->addWrapperCssClass("chk_select col-md-3");
			$chkSelect->setCustomAttribute("taskid", $objTask->Id);
			$chkSelect->HtmlAfter		= "<span>".$objTask->{\QCubed\Project\Application::$LocaleName}."</span></label>";
		}
	}
	private function Build() {
		$this->lblType						= new \QCubed\Bootstrap\Label($this);
		$this->lblType->addCssClass("label");
		$this->lblType->Text = "Test";
		$this->lblMake						= new \QCubed\Bootstrap\Label($this);
		$this->lblMake->addCssClass("label");
		$this->lblModel						= new \QCubed\Bootstrap\Label($this);
		$this->lblModel->addCssClass("label");
		$this->lblPlate						= new \QCubed\Bootstrap\Label($this);
		$this->lblPlate->addCssClass("label");
		$this->lblColor						= new \QCubed\Bootstrap\Label($this);
		$this->lblColor->addCssClass("label");
		$this->lblVin						= new \QCubed\Bootstrap\Label($this);
		$this->lblVin->addCssClass("label");
		$this->lblDate						= new \QCubed\Bootstrap\Label($this);
		$this->lblDate->addCssClass("label");
			
		$this->lblEntity					= new \QCubed\Bootstrap\Label($this);
		$this->lblEntity->addCssClass("label");
		$this->lblEntityType				= new \QCubed\Bootstrap\Label($this);
		$this->lblEntityType->addCssClass("label");
		$this->lblAddress					= new \QCubed\Bootstrap\Label($this);
		$this->lblAddress->addCssClass("label");
		
		$this->lblappointmentType			= new \QCubed\Bootstrap\Label($this);
		$this->lblappointmentType->addCssClass("label");
		$this->lblDateAppointment			= new \QCubed\Bootstrap\Label($this);
		$this->lblDateAppointment->addCssClass("label");
		$this->lblDateMayChange				= new \QCubed\Bootstrap\Label($this);
		$this->lblDateMayChange->addCssClass("label");
		
		$this->lblOptions					= new \QCubed\Control\Panel($this);
		$this->lblOptions	->AutoRenderChildren				= true;
		$this->lblOptions->addCssClass("display-container label");
	}
	
}
