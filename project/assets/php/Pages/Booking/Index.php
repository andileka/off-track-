<?php

namespace Hikify\Pages\Booking;

class Index extends \QCubed\Control\Panel {
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlBookingSlider;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlStepOne;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlStepTwo;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlStepThree;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlStepFour;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlStepFive;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlStepSix;
	/**
	 *
	 * @var Button 
	 */
	public $btnNext;
	/**
	 *
	 * @var Button 
	 */
	public $btnBack;
	/**
	 *
	 * @var Button 
	 */
	public $btnComplete;
	
	private $ClickCount = 0;
	const	MIN_PAGES	= 0;
	const	MAX_PAGES	= 5;
	
	private $objJob;
	private $objEntity;
	private $objVehicle;
	private $objAppointment;
	
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/booking/index.tpl.php';
		\QCubed\Project\Application::executeJavaScript('
														var height = $(".wrapper").outerHeight();
														$(".content-wrapper").css("min-height",height+"px");
														$(".content-wrapper").css("height",height+"px")
													');
		$this->addCssFile("/project/assets/css/booking.css");	
		
		$this->addJavascriptFile("/project/assets/js/booking.js");
		$this->Build();
		\QCubed\Project\Application::executeJavaScript("Booking.init()");
		$this->CheckTotalClicks();
		
	}
	public function clicked_next(){
		$this->ClickCount++;
		$this->CheckTotalClicks();
		$this->DoFormAction();
		\QCubed\Project\Application::executeJavaScript("Booking.plusDivs(+1)");
	}
	public function clicked_back(){
		$this->ClickCount--;
		$this->CheckTotalClicks();
		\QCubed\Project\Application::executeJavaScript("Booking.plusDivs(-1)");		
	}
	public function CheckValidation($pnlCheck){
			if($pnlCheck->Validate()){
				return true;
			}else{
				$this->ClickCount--;
				\QCubed\Project\Application::executeJavaScript("Booking.plusDivs(-1)");	
			}
		
		
	}
	public function DoFormAction(){
		switch($this->ClickCount){
			case 1:
				if($this->CheckValidation($this->pnlStepOne)){
					$this->pnlStepOne->CheckLicenseplate();
				}
				break;
			case 2:
				if($this->CheckValidation($this->pnlStepTwo)){
					$this->pnlStepTwo->CheckVehicle();
				}
				break;
			case 3:
				$this->pnlStepThree->Save();
				$this->pnlStepFour->SetEntity($this->objEntity);
				$this->pnlStepFour->SetJob($this->objJob);
				break;
			case 4:
				$this->pnlStepFour->Save();
				break;
			case 5:
				$this->pnlStepFive->Save();
				$this->pnlStepSix->SetAppointment($this->objAppointment);
				$this->pnlStepSix->SetJob($this->objJob);
				$this->pnlStepSix->SetVehicle($this->objVehicle);
				$this->pnlStepSix->SetEntity($this->objEntity);
				$this->btnNext->Display = false;
				$this->btnComplete->Display = true;
				break;
		}
	}
	public function InsertVehicleInformation($objVehicle){
		$this->objVehicle		= $objVehicle;
		$this->pnlStepTwo->SetVehicleInformation($objVehicle);
	}
	public function InsertLicenseplate($strLicenseplate){
		$this->pnlStepTwo->SetPlate($strLicenseplate);
	}
	public function InsertEntities($objJob){
		$this->objJob			= $objJob;
		$this->objVehicle		= $objJob->Vehicle;
		$this->pnlStepThree->removeChildControls($this);
		$this->pnlStepThree->SetEntity($objJob);		
	}
	private function CheckTotalClicks(){
		if($this->ClickCount <= self::MIN_PAGES){
			$this->Disable($this->btnBack);
		}else{
			$this->SetActive($this->btnBack);
		}
		
		if($this->ClickCount >= self::MAX_PAGES){
			$this->Disable($this->btnNext);
		}else{
			$this->SetActive($this->btnNext);
		}
	}
	private function SetActive($objButton){
		$objButton->removeCustomAttribute("disabled");	
	}
	private function Disable($objButton){
		$objButton->setCustomAttribute("disabled",true);
	}
	public function AppointmentMade($objAppointment){
		$this->objAppointment = $objAppointment;
		$this->pnlStepFive->SetAppointment($this->objAppointment);
	}
	public function AddressSaved($objEntity){
		$this->objEntity			= $objEntity;
	}
	public function cliked_success(){
		/* NEW BOOKING */
		\QCubed\Project\Application::redirect('/?c=booking'); 	
	}
	public function onValidate(){
		$this->ClickCount--;
		\QCubed\Project\Application::executeJavaScript("Booking.plusDivs(-1)");	
	}
	private function Build() {
		$this->pnlBookingSlider				= new \QCubed\Control\Panel($this);
		$this->pnlBookingSlider	->AutoRenderChildren				= true;
		$this->pnlBookingSlider->addCssClass("display-container");
		
		$this->pnlStepOne					= new Licenseplate($this->pnlBookingSlider);
		$this->pnlStepOne->Text				= "<h3>".tr("Step 1: Enter licenseplate")."<h3>";
		$this->pnlStepOne->addCssClass("mySlides");
		$this->pnlStepOne->Register('LicenseplateChecked',"InsertLicenseplate", $this);
		$this->pnlStepOne->Register('VehicleFound',"InsertVehicleInformation", $this);
		
		$this->pnlStepTwo					= new Vehicle($this->pnlBookingSlider);
		$this->pnlStepTwo->Text				= "<h3>".tr("Step 2: Enter vehicle information")."</h3>";
		$this->pnlStepTwo->addCssClass("mySlides");
		$this->pnlStepTwo->Register('CheckVehicle',"InsertEntities", $this);
		
		$this->pnlStepThree					= new Address($this->pnlBookingSlider);
		$this->pnlStepThree->Text			= "<h3>".tr("Step 3: Enter entity information")."</h3>";
		$this->pnlStepThree->addCssClass("mySlides");
		$this->pnlStepThree->Register('onAddressSave',"AddressSaved", $this);
		$this->pnlStepThree->Register('onValidate',"onValidate", $this);
		
		$this->pnlStepFour					= new Appointment($this->pnlBookingSlider);
		$this->pnlStepFour->Text			= "<h3>".tr("Step 4: Select appointment")."</h3>";
		$this->pnlStepFour->addCssClass("mySlides");
		$this->pnlStepFour->Register('OnSave',"AppointmentMade", $this);
		$this->pnlStepFour->Register('onValidate',"onValidate", $this);
		
		$this->pnlStepFive					= new Options($this->pnlBookingSlider);
		$this->pnlStepFive->Text			= "<h3>".tr("Step 5: Appointment options")."</h3>";
		$this->pnlStepFive->addCssClass("mySlides");
		
		$this->pnlStepSix					= new Success($this->pnlBookingSlider);
		$this->pnlStepSix->Text				= "<h3>".tr("Step 6: Appointment booked")."</h3>";
		$this->pnlStepSix->addCssClass("mySlides");
		
		$this->btnNext						= \QCubed\Project\Jqui\Button::GetFontAwesomeButton($this, tr("Next"), "fas fa-chevron-right");
		$this->btnNext->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "clicked_next"));
		$this->btnNext->addCssClass("left");
		
		$this->btnBack						= \QCubed\Project\Jqui\Button::GetFontAwesomeButton($this, tr("Back"), "fas fa-chevron-left");
		$this->btnBack->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "clicked_back"));
		
		$this->btnComplete					= \QCubed\Project\Jqui\Button::GetFontAwesomeButton($this, "Success", "fas fa-thumbs-up",null,'btn-success');
		$this->btnComplete->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "cliked_success"));
		$this->btnComplete->Display			= false;
	}
	
}
