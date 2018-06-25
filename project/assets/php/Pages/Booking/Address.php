<?php

namespace Hikify\Pages\Booking;

class Address extends \QCubed\Control\Panel {
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
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlNotification;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlAddress;
	
	private $objJob;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/booking/address.tpl.php';
		\QCubed\Project\Application::executeJavaScript('
														var height = $(".wrapper").outerHeight();
														$(".content-wrapper").css("min-height",height+"px");
														$(".content-wrapper").css("height",height+"px")
													');
		$this->addCssFile("/project/assets/css/booking.css");	
		
//		$this->addJavascriptFile("/project/assets/js/round-button.js");
		$this->Build();
		
		
	}
	public function SetEntity($objJob){
		if(!$objJob){
			$this->GetEntityForms();
		}else{
			$this->objJob = $objJob;
			$this->SetEntityForms($objJob);
		}

	}
	public function onValidate(){
		$this->Trigger('onValidate',[]);
	}
	public function onSave($objEntity){
		
		$this->Trigger('onAddressSave',[$objEntity]);
	}
	public function SetEntityForms($objJob){
		$arr = array("Schadelijder" => 7, "Bestuurder" => 3, "Hersteller" => 4, "Andere" => 5, "Drive-in" => 6);
		foreach($arr as $singleEntity => $intTypeId){
			$objEntity = \EntityJob::loadByJobIdAndType($objJob->Id,$intTypeId);
			$pnlSingleEntity	= new SingleEntity($this->pnlAddress);
			$pnlSingleEntity->SetEntity($singleEntity,$intTypeId, $objEntity);
			$pnlSingleEntity->Register('onSave',"onSave", $this);
			$pnlSingleEntity->Register('onValidate',"onValidate", $this);
		}
	}
	public function Save(){
		$x= 0;
		foreach($this->pnlAddress->getChildControls() as $pnl){
			/* GET LEGAL TYPE */
			if($this->CheckLegalType($pnl->blnLegaltype->SelectedValue, $pnl)){
				$pnl->Save($this->objJob);
				($pnl->chkSelect->Checked) ? $x++ : '';
			}

		}
		/* CHECK IF THERE IS AT LEAST ONE ENTITY */
		if($x <= 0){
			$this->pnlNotification->Display = true;
			\QCubed\Project\Application::executeJavaScript("
					$('#'+'".$this->pnlNotification->ControlId."').removeClass('hide');
					$('html, body').animate({ scrollTop: 150 }, 'slow');
			");
			$this->Trigger('onValidate',[]);
		}
		
	}
	public function CheckLegalType($type, $pnl){
		switch($type){
			/* CHECK IF AT LEAST NAME IS FILLED BEFORE VALIDATION */
			case "private individual":
				if($pnl->txtFirstname->Text!="" && $pnl->txtLastname->Text!=""){
					return true;
				}
			case "legal":
				if(($pnl->txtCompanyNumber->Text!="" && $pnl->txtName->Text!="")){
					return true;
				}
		}
		
	}
	public function GetEntityForms(){
		$arr = array("Schadelijder" => 4, "Bestuurder" => 2, "Hersteller" => 3, "Andere" => 6, "Drive-in" => 5);
		foreach($arr as $singleEntity => $intTypeId){
			$pnlSingleEntity	= new SingleEntity($this->pnlAddress);
			$pnlSingleEntity->SetEntity($singleEntity, $intTypeId);
		}
	}
	private function Build() {
		$this->pnlAddress					= new \QCubed\Control\Panel($this);
		$this->pnlAddress	->AutoRenderChildren				= true;
		$this->pnlAddress->addCssClass("display-container");
		
		$this->pnlNotification						= new \QCubed\Control\Panel($this);
		$this->pnlNotification->AddCssClass("callout callout-warning ");	
		$this->pnlNotification->Text	= "<p><i class='fa fa-lock' aria-hidden='true'></i> " . tr("Select a location") . "</p>";
		$this->pnlNotification->addCssClass("hide");
//		$this->GetEntityForms();				
	}
	
}
