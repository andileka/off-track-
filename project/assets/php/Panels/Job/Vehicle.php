<?php

namespace Hikify\Panels\Job;

class Vehicle extends \QCubed\Project\Control\Editor {
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $id;
	/**
	 * 
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstVehicletype;
	/**
	 * 
	 * @var  \QCubed\Project\Jqui\Autocomplete
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
	public $txtModelType;
	/**
	 * 
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtkW;
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
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtColor;
	/**
	 * 
	 * @var \QCubed\Project\Jqui\DatepickerBox
	 */
	public $dttFirstRegistrationDate;
	/**
	 * 
	 * @var \QCubed\Project\Jqui\DatepickerBox
	 */
	public $dttLastRegistrationDate;
	/**
	 * 
	 * @var \QCubed\Control\FloatTextBox
	 */
	public $txtRetailValue;
	/**
	 * 
	 * @var \QCubed\Control\FloatTextBox
	 */
	public $txtCurrentValue;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtVehicleNumber;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtEngineCapacity;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtPayload;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtTarra;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtProfileDepth;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtNmbrSeats;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtHorsepower;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtCo2;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtMileage;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstFuelType;
	/**
	 *
	 * @var \VehicleTiresList 
	 */
	public $ddgTireInfo;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstTireProfile;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Checkbox
	 */
	public $chkHasAlarm;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Checkbox
	 */
	public $chkHasSootFilter;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Button
	 */
	public $btnSave;		
	/**
	 *
	 * @var \QCubed\Control\Panel
	 */
	public $pnlCustomfields;
	/**
	 *
	 * @var \QCubed\Project\Control\Button 
	 */
	public $btnAdd;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlKnowJobs;
	
	/**
	 *
	 * @var \Vehicle 
	 */
	public $ArrCustomFields= [];
	public $blnHasTires  = false;
	
	
	
	public $blnHideNumber				= true;
	public $blnHideVin					= false;
	public $blnHideTechnicalInfo		= false;
	public $blnHideOptions				= false;
	public $blnMileage					= false;
	public $bldttFirstRegistrationDate	= false;
	public $blddttLastRegistrationDate	= false;
	public $blnHasEngine				= false;
	public $hasPreviousJobs				= false;
	
	private $objVehicle;
	private $objJob;
	private $objVehicleCounterparty;
	
	const TYPE_CAR						= 1;
	const TYPE_VAN						= 2;
	const TYPE_BUS						= 3;
	const TYPE_TRUCK					= 4;
	const TYPE_BICYCLE					= 5;
	const TYPE_TRAM						= 6;
	const TYPE_TRAIN					= 7;
	const TYPE_MOTORCYCLE				= 8;
	const TYPE_EBIKE					= 9;
	const TYPE_TRAILER					= 10;
	
	const CUSTOM_FIELD_TYPE = "vehicle"; 
	
	/* DEFAULT CAR */
	public $VehicleType = self::TYPE_CAR;
	
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/panels/job/vehicle.tpl.php';
		if(isset($_GET['id'])){
			$this->objJob				= \Job::load($_GET['id']);
		}
		
		$this->Build();
		
	}
	
	public function GetAccordionHeader() {
		if($this->objVehicle) {
			return tr('Vehicle') . ': '.(string)$this->objVehicle;
		}
			
		return tr('Vehicle');
	}
	
	public function SetVehicle(\Vehicle $objVehicle=null, \Vehicle $objVehicleCounterparty=null) {
		if(!$objVehicle) {
			return;
		}
				$this->btnAdd->removeCustomAttribute("disabled");
				
				$this->lstVehicletype->SelectedValue	= $objVehicle->TypeId;
				$this->lstMake->SelectedValue           = $objVehicle->MakeId;
				$this->lstMake->Text					= ($objVehicle->MakeId) ? $objVehicle->Make->Name : '';
                $this->txtModel->Text					= $objVehicle->Model;
                $this->txtModelType->Text               = (string)$objVehicle->ModelType;
                $this->txtPlate->Text                   = $objVehicle->Plate;
                $this->txtVin->Text                     = $objVehicle->Vin;
                $this->txtColor->Text					= $objVehicle->Colour;
                $this->dttFirstRegistrationDate->Text	= $objVehicle->FirstRegistrationDate;
                $this->dttLastRegistrationDate->Text	= $objVehicle->LastRegistrationDate;
                $this->txtRetailValue->Text             = $objVehicle->RetailValue;
                $this->txtCurrentValue->Text            = $objVehicle->CurrentValue;
				$this->txtVehicleNumber->Text			= $objVehicle->Number;
				$this->txtkW->Text						= $objVehicle->Kw;
				$this->txtEngineCapacity->Text			= $objVehicle->EngineCapacity;
				$this->txtHorsepower->Text				= $objVehicle->Horsepower;
				$this->txtPayload->Text					= $objVehicle->Payload;
				$this->txtTarra->Text					= $objVehicle->Tarra;
				$this->txtNmbrSeats->Text				= $objVehicle->NumberSeats;
				$this->lstTireProfile->SelectedValue	= $objVehicle->TyreProfile;
				$this->txtCo2->Text						= $objVehicle->Co2;
				$this->lstFuelType->SelectedValue		= $objVehicle->FeulType;
				$this->chkHasAlarm->Checked				= ($objVehicle->Alarm) ? true : '';
				$this->chkHasSootFilter->Checked		= ($objVehicle->SootFilter) ? true : '';
				$this->txtMileage->Text					= $objVehicle->Milage;
                $this->objVehicle						= $objVehicle;
                $this->objVehicleCounterparty			= $objVehicleCounterparty;
				$this->HasTires($objVehicle);
				
				/* CHECK IF VEHICLE IS KNOWN */
				$this->FindVehicleByPlateAndMake();
				
				$this->SetCustomFields();
				
				$this->VehicleType						= $objVehicle->TypeId;
				
				$this->ShowFieldsByType($this->lstVehicletype->SelectedValue);
	}
	public function FindVehicleByPlateAndMake(){
		$ArrJObsKnown = \Job::FindCarByPlateAndMake($this->lstMake->SelectedValue, $this->txtPlate->Text, $this->objJob->Id );
		if(!$ArrJObsKnown){ 
			$this->pnlKnowJobs->Display					= false;
			return;			
		}
		$html = "";
		
		foreach($ArrJObsKnown as $objJob){
			if($_GET['id'] != $objJob->Id){
				$html.= "<li><a href='?c=job&a=edit&id=".$objJob->Id."' target='_blank'>".tr("Single Job")." #".$objJob->Id."</a></li>";
			}
			
		}
		$this->pnlKnowJobs->Display					= true;
		$this->pnlKnowJobs->Text					= "<ul>".$html."</ul>";
	}
	public function Save() {
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT A VALID FORM');
			return;
		}
		
		
		if(!$this->objVehicle) {			
			$this->objVehicle = new \Vehicle();			
		}

	
		$this->objVehicle->TypeId                   = $this->lstVehicletype->SelectedValue;
		$this->objVehicle->MakeId                   = $this->lstMake->SelectedValue;
		$this->objVehicle->Model                    = ($this->txtModel->Text) ? \Model::GetOrCreate($this->objVehicle->MakeId, $this->txtModel->Text) : null;
		$this->objVehicle->ModelType                = $this->txtModelType->Text;
		$this->objVehicle->Plate                    = $this->txtPlate->Text;
		$this->objVehicle->Vin                      = $this->txtVin->Text;
		$this->objVehicle->FirstRegistrationDate    = $this->dttFirstRegistrationDate->DateTime;
		$this->objVehicle->LastRegistrationDate     = $this->dttLastRegistrationDate->DateTime;
		$this->objVehicle->RetailValue              = $this->txtRetailValue->Text;
		$this->objVehicle->CurrentValue             = $this->txtCurrentValue->Text;
		$this->objVehicle->Colour                   = $this->txtColor->Text;
        $this->objVehicle->Number					= $this->txtVehicleNumber->Text;
		$this->objVehicle->EngineCapacity			= $this->txtEngineCapacity->Text;
		$this->objVehicle->Horsepower				= $this->txtHorsepower->Text;
		$this->objVehicle->Payload					= $this->txtPayload->Text;
		$this->objVehicle->Tarra					= $this->txtTarra->Text;
		$this->objVehicle->TyreProfile				= $this->lstTireProfile->SelectedValue;
		$this->objVehicle->NumberSeats				= $this->txtNmbrSeats->Text;
		$this->objVehicle->Co2						= $this->txtCo2->Text;
		$this->objVehicle->FeulType					= $this->lstFuelType->SelectedValue;
		$this->objVehicle->SootFilter				= $this->chkHasSootFilter->Checked;
		$this->objVehicle->Alarm					= $this->chkHasAlarm->Checked;
		$this->objVehicle->Milage					= $this->txtMileage->Text;
		$this->objVehicle->Kw						= $this->txtkW->Text;
		$this->objVehicle->Save();
		
       foreach($this->ArrCustomFields as $customField){
		   \CustomFieldType::SaveCustomField($customField, $this::CUSTOM_FIELD_TYPE, $intJobId=null, $this->objVehicle->Id, $intEntityId=null, $intAppointmentId=null);	
		}
		
		$this->Trigger('OnSave',[$this->objVehicle]);
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
			\CustomField::SetCustomFields($customField, $this::CUSTOM_FIELD_TYPE, $intJobId=null, $this->objVehicle->Id, $intEntityId=null, $intAppointmentId=null);
		}
	}
	public function VinSelected(){
		if($this->txtVin->SelectedValue != -1){
				$TempObjVehicle = \Vehicle::loadById($this->txtVin->SelectedValue);
				$this->SetVehicle($TempObjVehicle);
		}
	}
	
	public function PlateSelected(){
		if($this->txtPlate->SelectedValue != -1){
				$TempObjVehicle = \Vehicle::loadById($this->txtPlate->SelectedValue);
				$this->SetVehicle($TempObjVehicle);
		}
	}
	
	public function VehicleNumberSelected(){
		if($this->txtVehicleNumber->SelectedValue != -1){
				$TempObjVehicle = \Vehicle::loadById($this->txtVehicleNumber->SelectedValue);
				$this->SetVehicle($TempObjVehicle);
		}
	}
	/**
	 * this makes sure that the country ID is set on the txtCity, so it can correctly autofill
	 */
	public function lstMake_Changed() {
		$this->txtModel->setCustomAttribute("make_id", $this->lstMake->SelectedValue);		
	}
	public function Vehicletype_Changed(){
		/* SHOW MAKE BY VEHICLETYPE ID */
		$this->ShowMakeByVehicleType($this->lstVehicletype->SelectedValue);
		$this->ShowFieldsByType($this->lstVehicletype->SelectedValue);
	}
	public function ShowFieldsByType($intType){
		switch($intType){
			 /* VAN */
			case $intType == self::TYPE_VAN:
				$this->blnHideNumber				= false;
				$this->blnHideVin					= false;
				$this->blnHideTechnicalInfo			= false;
				$this->blnHideOptions				= false;
				$this->blnMileage					= false;
				$this->bldttFirstRegistrationDate	= false;
				$this->blddttLastRegistrationDate	= false;
				$this->blnHasEngine					= false;
				break;
			/* BUS */
			case $intType == self::TYPE_BUS:
				$this->blnHideNumber				= false;
				$this->blnHideVin					= false;
				$this->blnHideTechnicalInfo			= false;
				$this->blnHideOptions				= false;
				$this->blnMileage					= false;
				$this->bldttFirstRegistrationDate	= false;
				$this->blddttLastRegistrationDate	= false;
				$this->blnHasEngine					= false;
				break;
			/* TRUCK */
			case $intType == self::TYPE_TRUCK:
				$this->blnHideNumber				= false;
				$this->blnHideVin					= false;
				$this->blnHideTechnicalInfo			= false;
				$this->blnHideOptions				= false;
				$this->blnMileage					= false;
				$this->bldttFirstRegistrationDate	= false;
				$this->blddttLastRegistrationDate	= false;
				$this->blnHasEngine					= false;
				break;
			/* BICYCLE | ELECTRIC BIKE */
			case $intType == self::TYPE_BICYCLE || $intType == self::TYPE_EBIKE:
				$this->blnHideNumber				= true;
				$this->blnHideVin					= true;
				$this->blnHideTechnicalInfo			= true;
				$this->blnHideOptions				= true;
				$this->blnMileage					= true;
				$this->bldttFirstRegistrationDate	= true;
				$this->blddttLastRegistrationDate	= true;
				break;
			/* TRAM | TRAIN */
			case $intType == self::TYPE_TRAM || $intType == self::TYPE_TRAIN:
				$this->blnHideNumber				= true;
				$this->blnHideVin					= false;
				$this->blnHideTechnicalInfo			= false;
				$this->blnHideOptions				= false;
				$this->blnMileage					= false;
				$this->bldttFirstRegistrationDate	= false;
				$this->blddttLastRegistrationDate	= false;
				$this->blnHasEngine					= true;
				break;
			/* TRAILER */
			case $intType == self::TYPE_TRAILER:
				$this->blnHideNumber				= false;
				$this->blnHideVin					= false;
				$this->blnHideTechnicalInfo			= false;
				$this->blnHideOptions				= true;
				$this->blnMileage					= true;
				$this->bldttFirstRegistrationDate	= false;
				$this->blddttLastRegistrationDate	= false;
				$this->blnHasEngine					= true;
				break;
			 /* 1 CAR | 8 MOTORCYCLE*/
			default:
				$this->blnHideNumber				= true;
				$this->blnHideVin					= false;
				$this->blnHideTechnicalInfo			= false;
				$this->blnHideOptions				= false;
				$this->blnMileage					= false;
				$this->bldttFirstRegistrationDate	= false;
				$this->blddttLastRegistrationDate	= false;
				$this->blnHasEngine					= false;
				break;
		}

		
		$this->blnModified						= true;
	}
	public function PlateOnLeave(){
		\QCubed\Project\Application::Log("We zijn er uit");
	}
	public function btnAdd_clicked(){
		if(!$this->objVehicle){
			return;
		}
		
		$objTire					= new \VehicleTires();
		$objTire->VehicleId			= $this->objVehicle->Id;
		$objTire->Type				= $this->lstTireProfile->SelectedValue;
		$objTire->Depth				= $this->txtProfileDepth->Text;
		$objTire->Save();
	
		$this->lstTireProfile->SelectedValue	= null;
		$this->txtProfileDepth->Text			= "";
		
		$this->HasTires();
	}
	public function HasTires(){
		$countTires =  0;
		if($this->objVehicle){
			$countTires								= \VehicleTires::countByVehicleId($this->objVehicle->Id);
		}

		if($countTires > 0) {
			$this->blnHasTires					= true;	
			$conditions[] =\QCubed\Query\QQ::Equal(\QQN::VehicleTires()->VehicleId, $this->objVehicle->Id);
			$this->ddgTireInfo->Condition = \QCubed\Query\QQ::orCondition($conditions);
			$this->ddgTireInfo->Display			= true;
			$this->ddgTireInfo->dataBind();
			
		}else{
			$this->blnHasTires					= false;	
			$this->ddgTireInfo->Display			= false;
		}
		$this->blnModified			= true;
	}
	public function ShowMakeByVehicleType($vehicleTypeId){
		$this->lstMake->setCustomAttribute("VehicleType", $this->lstVehicletype->SelectedValue);	
		
	}
	
	public function btndelete_click($intSelectedTire){
		\VehicleTires::deleteById($intSelectedTire);
		$this->HasTires();
		
	}
	
	private function Build() {
		
		$this->lstVehicletype					= \VehicleType::GetListBox($this);
		$this->lstVehicletype->Required         = true;
		$this->lstVehicletype->AddAction(new \QCubed\Event\Change, new \QCubed\Action\AjaxControl($this, 'Vehicletype_Changed'));
		/* DEFAULT 1 => CAR */
		$this->lstVehicletype->SelectedValue	= self::TYPE_CAR;
		
		$this->lstMake							= \Make::GetAutocompleteTextBox($this, 'Make::GetMakesAsListItems');
		$this->lstMake->Placeholder				= tr("Select Vehicle make");
		$this->lstMake->Required				= true;
		$this->lstMake->setCustomAttribute("VehicleType", $this->lstVehicletype->SelectedValue);
		$this->lstMake->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'lstMake_Changed'));
		$this->lstMake->addAction(new \QCubed\Event\FocusOut(), new \QCubed\Action\AjaxControl($this, "FindVehicleByPlateAndMake"));
		
		$this->txtModel							= \Model::GetAutocompleteTextBox($this, 'Model::GetModelsAsListItems');
		$this->txtModel->Placeholder			= tr('Model');
		
		$this->txtModelType						= new \QCubed\Project\Control\TextBox($this);
		$this->txtModelType->Placeholder		= tr('Model type');
		
		$this->lstMake_Changed();
		
		$this->txtPlate							= new \QCubed\Project\Control\TextBox($this);
		$this->txtPlate							= \Vehicle::GetAutocompleteTextBox($this, '\Vehicle::GetPlateAsListItems');
		$this->txtPlate->AddAction(new \QCubed\Event\Change, new \QCubed\Action\AjaxControl($this, 'PlateSelected'));
		$this->txtPlate->addAction(new \QCubed\Event\FocusOut(), new \QCubed\Action\AjaxControl($this, "FindVehicleByPlateAndMake"));
		$this->txtPlate->Placeholder			= tr('Plate');
			
		$this->txtVin							= \Vehicle::GetAutocompleteTextBox($this, '\Vehicle::GetVinAsListItems');
		$this->txtVin->AddAction(new \QCubed\Event\Change, new \QCubed\Action\AjaxControl($this, 'VinSelected'));
		$this->txtVin->Placeholder				= tr('Vin');
		$this->txtVin->MaxLength				= \Vehicle::VIN_MAX_LENGTH;
				
		$this->txtColor						= new \QCubed\Project\Control\TextBox($this);
		$this->txtColor->Placeholder			= tr('Color');	
		
		$this->dttFirstRegistrationDate                         = new \QCubed\Project\Jqui\DatepickerBox($this);
		$this->dttFirstRegistrationDate->Placeholder            = tr('First registration date');
		$this->dttFirstRegistrationDate->addWrapperCssClass("input-group");
		$this->dttFirstRegistrationDate->HtmlBefore	= "<span class='input-group-addon'><i class='fas fa-calendar-alt'></i></span>";
		
		$this->dttLastRegistrationDate							= new \QCubed\Project\Jqui\DatepickerBox($this);
		$this->dttLastRegistrationDate->Placeholder				= tr('Last registration date');
		$this->dttLastRegistrationDate->addWrapperCssClass("input-group");
		$this->dttLastRegistrationDate->HtmlBefore	= "<span class='input-group-addon'><i class='fas fa-calendar-alt'></i></span>";
		
		$this->txtRetailValue									= new \QCubed\Control\FloatTextBox($this);
		$this->txtRetailValue->Placeholder						= tr('Retail value');
		$this->txtRetailValue->addWrapperCssClass("input-group");
		$this->txtRetailValue->HtmlBefore						= "<span class='input-group-addon'><i class='fas fa-euro-sign'></i></span>";
		
		$this->txtCurrentValue									= new \QCubed\Control\FloatTextBox($this);
		$this->txtCurrentValue->Placeholder						= tr('Current value');
		$this->txtCurrentValue->addWrapperCssClass("input-group");
		$this->txtCurrentValue->HtmlBefore						= "<span class='input-group-addon'><i class='fas fa-euro-sign'></i></span>";
				
		/* define customfield container */
		$this->pnlCustomfields									= new \QCubed\Control\Panel($this); 
		$this->pnlCustomfields	->PreferredRenderMethod			= "RenderFormGroup";
		$this->pnlCustomfields	->AutoRenderChildren			= true;
		
		$this->GetCustomFields();	
		$this->btnSave											= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Vehicle'));
		
		$this->txtVehicleNumber									= \Vehicle::GetAutocompleteTextBox($this, '\Vehicle::GetVehicleNumberAsListItems');
		$this->txtVehicleNumber->AddAction(new \QCubed\Event\Change, new \QCubed\Action\AjaxControl($this, 'VehicleNumberSelected'));
		
		$this->txtEngineCapacity								= new \QCubed\Project\Control\TextBox($this);
		$this->txtEngineCapacity->Placeholder					= tr('Engine capacity');
		
		$this->txtHorsepower									= new \QCubed\Project\Control\TextBox($this);
		$this->txtHorsepower->Placeholder						= tr('Horsepower');
		
		$this->txtPayload										= new \QCubed\Project\Control\TextBox($this);
		$this->txtPayload->Placeholder							= tr('Payload');
		$this->txtPayload->addWrapperCssClass("input-group");
		$this->txtPayload->HtmlBefore							= "<span class='input-group-addon'><i class='fas fa-truck-loading'></i></span>";
		
		$this->txtTarra											= new \QCubed\Project\Control\TextBox($this);
		$this->txtTarra->Placeholder							= tr('Tarra');
		$this->txtTarra->addWrapperCssClass("input-group");
		$this->txtTarra->HtmlBefore								= "<span class='input-group-addon'><i class='fas fa-balance-scale'></i></span>";
		
		$this->txtNmbrSeats										= new \QCubed\Project\Control\TextBox($this);
		$this->txtNmbrSeats->Placeholder						= tr('Number of seats');
		$this->txtNmbrSeats->addWrapperCssClass("input-group");
		$this->txtNmbrSeats->HtmlBefore							= "<span class='input-group-addon'><i class='fas fa-users'></i></span>";
		
		$this->lstFuelType										= new \QCubed\Project\Control\ListBox($this);
		$this->lstFuelType->addItem(tr("Select feultype"),null);
		$this->lstFuelType->addItem(tr("Gasoline"), "gasoline");
		$this->lstFuelType->addItem(tr("Diesel"), "diesel");
		$this->lstFuelType->addItem(tr("LPG"), "lpg");
		$this->lstFuelType->addItem(tr("Hybride"), "hybride");
		$this->lstFuelType->addItem(tr("Electric"), "electric");
		$this->lstFuelType->addItem(tr("Other"), "other");
		
		$this->lstTireProfile									= new \QCubed\Project\Control\ListBox($this);
		$this->lstTireProfile->addItem(tr("Select tireprofile"),null);
		$arrProfiles= array('na', 'vl', 'vr', 'al', 'ar', 'spare');
		foreach($arrProfiles as $profile){
			$this->lstTireProfile->addItem(strtoupper($profile),$profile);
		}
		
		$this->txtCo2											= new \QCubed\Bootstrap\TextBox($this);
		$this->txtCo2->Placeholder								= tr("CO2");
		
		$this->txtProfileDepth									= new \QCubed\Bootstrap\TextBox($this);
		$this->txtProfileDepth->Placeholder						= tr("Profile depth");
		
		$this->txtkW											= new \QCubed\Bootstrap\TextBox($this);
		$this->txtkW->Placeholder								= tr("kW");
		
		$this->ddgTireInfo										= new \VehicleTiresList($this);
		$this->ddgTireInfo->Display								= false;
		$this->ddgTireInfo->CreateColumns();
		$this->ddgTireInfo->Paginator		= null;
		$this->ddgTireInfo->Register("OnDelete","btndelete_click",$this);
		
		$this->btnAdd				= \QCubed\Project\Jqui\Button::GetFontAwesomeButton($this, tr("Add"), "fas fa-plus-square");
		$this->btnAdd->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "btnAdd_clicked"));	
		$this->btnAdd->setCustomAttribute("disabled", true);
		
		$this->chkHasAlarm										= new \QCubed\Project\Jqui\Checkbox($this);
		$this->chkHasAlarm->HtmlBefore							= "<label class='chk_select_label'>";
		$this->chkHasAlarm->addWrapperCssClass("chk_select");
		$this->chkHasAlarm->HtmlAfter							= "<span>".tr("Has alarm")."</span></label>";
		
		$this->chkHasSootFilter									= new \QCubed\Project\Jqui\Checkbox($this);
		$this->chkHasSootFilter->HtmlBefore						= "<label class='chk_select_label'>";
		$this->chkHasSootFilter->addWrapperCssClass("chk_select");
		$this->chkHasSootFilter->HtmlAfter						= "<span>".tr("Has Sootfilter")."</span></label>";
		
		$this->txtMileage										= new \QCubed\Bootstrap\TextBox($this);
		$this->txtMileage->Placeholder							= tr('Mileage');
		$this->txtMileage->addWrapperCssClass("input-group");
		$this->txtMileage->HtmlBefore							= "<span class='input-group-addon'><i class='fas fa-tachometer-alt'></i></span>";
		
		$this->ShowFieldsByType($this->lstVehicletype->SelectedValue);
		
		$this->pnlKnowJobs										= new \QCubed\Control\Panel($this);
		$this->pnlKnowJobs->HtmlBefore							= '<label class="label label-warning">'. tr("Previous know jobs").'</label>';
		$this->pnlKnowJobs->Display								= false;
		
	}
	
	
}
