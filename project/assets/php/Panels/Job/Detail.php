<?php

namespace Hikify\Panels\Job;

class Detail extends \QCubed\Project\Control\Editor {
	/** @var \QCubed\Project\Control\ListBox  */
	public $lstJobType;
	/** @var \QCubed\Project\Control\ListBox  */
	public $lstJobStatus;
	/**
	 *
	 * @var \QCubed\Control\Panel
	 */
	public $pnlCustomfields;
	/**
	 *
	 * @var \QCubed\Project\Control\Button 
	 */
	public $btnSave;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstLanguage;
	
	/* INFORMEX */
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstMandateType;
	/**
	 *
	 * @var \QCubed\Project\Control\BooleanButton 
	 */
	public $blnRemoteInspection;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstLimitAmountType;
	
	/* MANDATOR */
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtMandatorName;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstPolicyType;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtPolicyNr;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtClaimReference;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtInsuredValue;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtExemption;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstExemptionType;
	/**
	 *
	 * @var \QCubed\Project\Control\BooleanButton 
	 */
	public $blnThoroughMandate;
	/**
	 * 
	 * @var \QCubed\Project\Jqui\DatepickerBox
	 */
	public $dtAccidentDate;
	/**
	 * 
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtPlate;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtVin;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlNotification;
	/**
	 *
	 * @var \Job 
	 */
	private $objJob;
	/**
	 *
	 * @var \JobDetail
	 */
	private $objJobDetail;
	
	public $ArrCustomFields= []; 
	const CUSTOM_FIELD_TYPE = "job"; 
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/panels/job/detail.tpl.php';
		$this->Build();
		
	}
	
	public function SetJob(\Job $objJob=null) {
		if(!$objJob) {
			return; 
		}
		$this->objJob									= $objJob;
		$this->objJobDetail								= \JobDetail::loadByJobId($objJob->Id);
		$this->lstJobType->SelectedValue				= $objJob->TypeId;
		$this->lstLanguage->SelectedValue				= $objJob->Language;
		$this->lstJobStatus->SelectedValue				= $this->objJob->Status;
		$this->dtAccidentDate->Text						= $this->objJob->AccidentDate;
		$this->SetCustomFields();
		
		if($this->objJobDetail){
			$this->lstLimitAmountType->SelectedValue	= $this->objJobDetail->AppointmentType;
			$this->lstMandateType->SelectedValue		= $this->objJobDetail->MandateType;
			$this->blnRemoteInspection->SelectedValue	= $this->objJobDetail->RemoteInspection;
			$this->blnThoroughMandate->SelectedValue	= $this->objJobDetail->ThoroughMandate;
			$this->lstExemptionType->SelectedValue		= $this->objJobDetail->AppointmentType;
			$this->txtMandatorName->Text				= $this->objJobDetail->MandatorName;
			$this->lstPolicyType->SelectedValue			= $this->objJobDetail->PolicyTypeId;
			$this->txtPolicyNr->Text					= $this->objJobDetail->PolicyNumber;
			$this->txtClaimReference->Text				= $this->objJobDetail->DamageClaimNumber;
			$this->txtInsuredValue->Text				= $this->objJobDetail->ValueInsurance;
			$this->txtExemption->Text					= $this->objJobDetail->Exemption;
			$this->lstExemptionType->SelectedValue		= $this->objJobDetail->TypeExemption;
		}
		
		$this->SetVehicleInfo($this->objJob);
	}
	public function SetVehicleInfo(\Job $objJob){
		if($objJob->VehicleId){
			$this->txtPlate->Text		= $objJob->Vehicle->Plate;
			$this->txtVin->Text			= $objJob->Vehicle->Vin;
		}
	}
	public function FindVehicleByPlateAndAccidentDate(){
		if($this->txtPlate->Text !== "" && $this->dtAccidentDate->Text !=="" || $this->dtAccidentDate->Text !=="" && $this->txtVin->Text !=="" ){
			$jobKnown = \Job::FindVehicleByPlateAndAccidentDate($this->txtPlate->Text, $this->dtAccidentDate, $this->txtVin->Text );
			/* ONLY SHOW NOTIFICATION NEW JOB */
			if(!isset($_GET['id'])){
				$this->BuildNotification($jobKnown);
			}
			
		}
	}
	public function BuildNotification($jobKnown=null){
		if($jobKnown){ 
			$html = array();
				foreach($jobKnown as $objJob){
					$html[]= sprintf(tr("We found a job with accidentdate %s, license Plate %s, and or Vin %s. Click <a href='?c=job&a=edit&id=%s' target='_blank'>here</a> to go to job"),$this->dtAccidentDate->DateTime,$this->txtPlate->Text, $this->txtVin->Text,$objJob->Id);
				}
				
				$this->pnlNotification->Text				= '<h4><i class="icon fa fa-info"></i> ' .tr('Warning') . '</h4>'. join("<br>",$html);
				/* SHOW NOTIFICATION */
				$this->pnlNotification->Display				= (count($html) > 0) ? true : false ;
				$this->blnModified							= true;
			}else{
				$this->pnlNotification->Display				= false;
				$this->blnModified							= false;
			}
	}
	public function Save() {
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT A VALID FORM');
			return;
		}
		if(!$this->objJob) {		
			$this->objJob = new \Job();
		}
				
		$this->objJob->TypeId				= $this->lstJobType->SelectedValue;
		$this->objJob->Language				= $this->lstLanguage->SelectedValue;
		$this->objJob->JobExternInformexId	= null;
		$this->objJob->Status				= $this->lstJobStatus->SelectedValue;
		$this->objJob->AccidentDate			= $this->dtAccidentDate->DateTime;
		$objVehicle = $this->InsertNewVehicle($this->objJob);
		
		if($objVehicle){
			$this->objJob->VehicleId		= $objVehicle->Id;
		}
		
		$isNewJob = $this->objJob->Save();
		
		if(!$this->objJobDetail){
			$this->objJobDetail	= new \JobDetail();
		}
		
		$this->objJobDetail->JobId						= $this->objJob->Id;
		$this->objJobDetail->MandateType				= $this->lstMandateType->SelectedValue;
		$this->objJobDetail->ThoroughMandate			= $this->blnThoroughMandate->SelectedValue;
		$this->objJobDetail->RemoteInspection			= $this->blnRemoteInspection->SelectedValue;
		$this->objJobDetail->AppointmentType			= $this->lstLimitAmountType->SelectedValue;
		$this->objJobDetail->MandatorName				= $this->txtMandatorName->Text;
		$this->objJobDetail->PolicyTypeId				= $this->lstPolicyType->SelectedValue;
		$this->objJobDetail->PolicyNumber				= $this->txtPolicyNr->Text;
		$this->objJobDetail->DamageClaimNumber			= $this->txtClaimReference->Text;
		$this->objJobDetail->ValueInsurance				= $this->txtInsuredValue->Text;
		$this->objJobDetail->Exemption					= $this->txtExemption->Text;
		$this->objJobDetail->TypeExemption				= $this->lstExemptionType->SelectedValue;
		$this->objJobDetail->Save();
		
		
		
		foreach($this->ArrCustomFields as $customField){
		   \CustomFieldType::SaveCustomField($customField, $this::CUSTOM_FIELD_TYPE, $this->objJob->Id, $intVehicleId=null, $intEntityId=null, $intAppointmentId=null);	
		}
		
		$this->Trigger('OnSave',[$this->objJob,$isNewJob]);
	}
	public function InsertNewVehicle(\Job $objJob){
		if(!$objJob->VehicleId){
			/* CHECK IF VEHICLE IS KNOWN */
			$objVehicle = \Vehicle::loadVehicleByPlate($this->txtPlate->Text);
			if(!$objVehicle){
				$objVehicle = new \Vehicle();
				$objVehicle->Plate		= $this->txtPlate->Text;
				$objVehicle->Vin		= $this->txtVin->Text;
				$objVehicle->TypeId		= Vehicle::TYPE_CAR;

				$objVehicle->Save();
			}
		}else{
			$objVehicle = $objJob->Vehicle;
		}
		
		return $objVehicle;
		
	}
	public function GetAccordionHeader() {
		if($this->objJob) {
			return tr('Single Job') . ' #'.$this->objJob->Id. ' ' .tr('Type').": " . $this->objJob->Type . " (". (string)$this->objJob->StatusObject. ")";
		}
		return tr('Single Job');
	}
	
	public function GetCustomFields(){
		/* Load all custom fields for vehicle */
		$arrCustomFieldTypes = \CustomFieldType::loadArrayByContainer($this::CUSTOM_FIELD_TYPE);
		foreach($arrCustomFieldTypes as $objCustomfieldType){
			$this->ArrCustomFields[] = \CustomFieldType::CreateCustomField($this->pnlCustomfields, $objCustomfieldType);
		}
	}
	
	public function SetCustomFields(){
		/* Load all custom fields for vehicle */
		foreach($this->ArrCustomFields as $customField){
			\CustomField::SetCustomFields($customField, $this::CUSTOM_FIELD_TYPE, $this->objJob->Id, $intVehicleId=null, $intEntityId=null, $intAppointmentId=null);
		}
	}
	

	private function Build() {
		
		
		$this->lstJobType						= \JobType::GetListBox($this);
		$this->lstJobType->Required				= true;
		
		$this->lstJobStatus						= \JobStatus::GetListBox($this);
		
		$this->lstLanguage						= new \QCubed\Project\Control\ListBox($this);
		$this->lstLanguage->addItem(tr('Select language'), null);
		$arrLang = array("nl","fr","en");
		foreach($arrLang as $strLang){
			$this->lstLanguage->addItem(tr(strtoupper($strLang)), $strLang);
		}
		$this->lstLanguage->SelectedValue		= \QCubed\Project\Application::GetDefaultLang();
		/* define customfield container */
		$this->pnlCustomfields								= new \QCubed\Control\Panel($this); 
		$this->pnlCustomfields	->PreferredRenderMethod		= "RenderFormGroup";
		$this->pnlCustomfields	->AutoRenderChildren		= true;
		
		$this->GetCustomFields();
		
		$this->btnSave							= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save job detail'));
		
		/* Informex*/
		
		$this->lstLimitAmountType				= new \QCubed\Project\Control\ListBox($this);
		$this->lstLimitAmountType->addItem(tr("Limit amount direct payment"), null);
		$this->lstLimitAmountType->addItem(tr("Implicit"), 'implicit');
		$this->lstLimitAmountType->addItem(tr("Explicit"), 'explicit');
		
		$this->lstMandateType					= new \QCubed\Project\Control\ListBox($this);
		$this->lstMandateType->addItem(tr("Select mandate type"), null);
		
		$this->blnRemoteInspection				= new \QCubed\Project\Control\BooleanButton($this);
		$this->blnRemoteInspection->Name		= tr('Remote control');
		
		
		$this->blnThoroughMandate				= new \QCubed\Project\Control\BooleanButton($this);
		$this->blnThoroughMandate->Name			= tr('Thorough mandate');
		
		
		/* Mandator */
		$this->txtMandatorName					= new \QCubed\Project\Control\TextBox($this);
		$this->txtMandatorName->Name			= tr("Mandator");
		
		$this->lstPolicyType					= \PolicyType::GetListBox($this);
		
		$this->txtPolicyNr						= new \QCubed\Project\Control\TextBox($this);
		$this->txtPolicyNr->Placeholder			= tr('Policy number');
		
		$this->txtClaimReference				= new \QCubed\Project\Control\TextBox($this);
		$this->txtClaimReference->Placeholder	= tr('Claim reference number');
		
		$this->txtPolicyNr						= new \QCubed\Project\Control\TextBox($this);
		$this->txtPolicyNr->Placeholder			= tr('Policy number');
		
		$this->txtInsuredValue					= new \QCubed\Project\Control\TextBox($this);
		$this->txtInsuredValue->Placeholder		= tr("Insured value");
		$this->txtInsuredValue->addWrapperCssClass("input-group");
		$this->txtInsuredValue->HtmlBefore		= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
		
		$this->lstExemptionType					= new \QCubed\Project\Control\ListBox($this);
		$this->lstExemptionType->addItem(tr("Select"),null);
		$this->lstExemptionType->addItem("%","percentage");
		$this->lstExemptionType->addItem("€","amount");
		$this->lstExemptionType->addItem(tr("English excess"),"english");
		
		$this->txtExemption						= new \QCubed\Project\Control\TextBox($this);
		$this->txtExemption->Placeholder		= tr("Exemption % | €");
		
		$this->dtAccidentDate                   = new \QCubed\Project\Jqui\DatepickerBox($this);
		$this->dtAccidentDate->Placeholder		= tr('Accident date');
		$this->dtAccidentDate->Required         = false;
		$this->dtAccidentDate->addWrapperCssClass("input-group");
		$this->dtAccidentDate->HtmlBefore		= "<span class='input-group-addon'><i class='fas fa-calendar-alt'></i></span>";
		$this->dtAccidentDate->addAction(new \QCubed\Event\FocusOut(), new \QCubed\Action\AjaxControl($this, "FindVehicleByPlateAndAccidentDate"));
		
		$this->txtPlate							= new \QCubed\Project\Control\TextBox($this);
		$this->txtPlate							= \Vehicle::GetAutocompleteTextBox($this, '\Vehicle::GetPlateAsListItems');
		$this->txtPlate->addAction(new \QCubed\Event\FocusOut(), new \QCubed\Action\AjaxControl($this, "FindVehicleByPlateAndAccidentDate"));
		$this->txtPlate->Placeholder			= tr('Plate');
		
		$this->txtVin							= \Vehicle::GetAutocompleteTextBox($this, '\Vehicle::GetVinAsListItems');
		$this->txtVin->addAction(new \QCubed\Event\FocusOut(), new \QCubed\Action\AjaxControl($this, "FindVehicleByPlateAndAccidentDate"));
		$this->txtVin->Placeholder				= tr('Vin');
		$this->txtVin->MaxLength				= \Vehicle::VIN_MAX_LENGTH;
		
		$this->pnlNotification						= new \QCubed\Control\Panel($this);
		$this->pnlNotification->AddCssClass("callout callout-info ");
		$this->pnlNotification->Cursor				= 'pointer';
		$this->pnlNotification->Display				= false;
		
	}
}
