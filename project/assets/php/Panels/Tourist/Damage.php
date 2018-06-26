<?php

namespace Hikify\Panels\Job;

class Damage extends \QCubed\Control\Panel {
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtExcess;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstExcessType;
	/**
	 * 
	 * @var \QCubed\Project\Jqui\DatepickerBox
	 */
	public $ddtAtRepairer;	
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtDescription;	
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstFirstImpact;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstCause;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstFault;
/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtLimitAmount;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtValue;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtMin;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtLimitRdr;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtMax;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtProvisionalRepairCosts;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtBreakDownCosts;
	/**
	 *
	 * @var \QCubed\Project\Control\BooleanButton
	 */
	public $blnTowed;
	/**
	 *
	 * @var \QCubed\Project\Control\BooleanButton
	 */
	public $blnProvisionalRepaired;	
	/**
	 *
	 * @var \QCubed\Project\Control\BooleanButton
	 */
	public $blnDeduct;
	/**
	 *
	 * @var \QCubed\Project\Control\BooleanButton 
	 */
	public $blnTotalLoss;
	
	/* DAMAGEPOINTS */
	/*
	 * \QCubed\Project\Control\DamagePoints
	 */
	public $btnDamagePoints;
	/**
	 *
	 * @var \QCubed\Project\Control\RoundButton 
	 */
	public $btnDirection;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtHitDirection;
	/**
	 *
	 * @var \QCubed\Project\Control\Button
	 */
	public $btnSave;
	/**
	 *
	 * @var \QCubed\Control\Panel
	 */
	public $pnlEntity;
	/**
	 *
	 * @var \QCubed\Control\Panel
	 */
	public $pnlCustomfields;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlNotification;
	
	/**
	 *
	 * @var \QCubed\Project\Control\BooleanButton 
	 */
	public $blnImmobilized;
		
	public $blnBreakdown = false;
	public $blnShowProvisionalRepaired = false;
	public $ArrCustomFields= [];
	public $strType;
	/* DEFAULT CAR => IF VEHICLE TYPE IS SOMETHING ELSE DIFFERENT SVG WILL BE USED */
	public $strVehicleType;
	public $DirectionSelected;
	public $ZonesSelected;
	/**
	 *
	 * @var \Damage 
	 */
	private $objDamage;

	/* MODULE DAMAGE => CUSTOM FIELDS */
	const CUSTOM_FIELD_TYPE = "damage"; 
	
	public function __construct($objParentObject,$strVehicleType="Car", $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		$this->strVehicleType = $strVehicleType;
		$this->strTemplate			= __TEMPLATES__ .  '/panels/job/damage.tpl.php';
		$this->objDamage			= new \Damage;
		$this->Build();
		
	}
	
	public function SetDamage(\Damage $objDamage=null, $objVehicle=null) {
		if(!$objDamage) {
			return;
		}
		
		$this->strType				=  ($objVehicle) ? $objVehicle->Type->NameEn : "Car";
		$this->setFields($objDamage);		
		$this->objDamage			= $objDamage;	
		$this->btnDirection->SetVehicleType($this->strType);
		$this->btnDamagePoints->addCssClass($this->strType);
		       
	}
	public function SetFields(\Damage $objDamage=null){
		
		
		$this->btnDirection->SetHitDirection($objDamage->HitDirection);
		$this->btnDamagePoints->SetDamageZones($objDamage->DamagePoints);
		$this->DirectionSelected						= $objDamage->HitDirection;
		$this->txtDescription->Text						= $objDamage->Description;
		$this->lstFirstImpact->SelectedValue			= $objDamage->FirstImpactPoint;
		$this->ZonesSelected							= explode(',',$objDamage->DamagePoints);
		$this->blnTotalLoss->SelectedValue				= $objDamage->TotalLoss;
		$this->lstExcessType->SelectedValue				= $objDamage->ExcessType;
		$this->lstFault->SelectedValue					= $objDamage->Fault;
		$this->ddtAtRepairer->Text						= $objDamage->DateAtRepairer;
		$this->lstCause->SelectedValue					= $objDamage->Cause;
		$this->blnTowed->SelectedValue					= $objDamage->Towed;
		$this->txtBreakDownCosts->Text					= $objDamage->BreakDownCosts;
		$this->blnProvisionalRepaired->SelectedValue	= $objDamage->ProvisionalRepair;
		$this->txtProvisionalRepairCosts->Text			= $objDamage->ProvisionalRepairCosts;
		$this->blnDeduct->SelectedValue					= $objDamage->ToDeduct;
		$this->txtMin->Text								= $objDamage->Min;
		$this->txtMax->Text								= $objDamage->Max;
		$this->txtValue->Text							= $objDamage->Value;
		$this->txtLimitAmount->Text						= $objDamage->AmountLimit;
		$this->txtLimitRdr->Text						= $objDamage->LimitRdr;
		$this->blnImmobilized->SelectedValue			= $objDamage->Immobilised;
		$this->SetCustomFields();
		$this->bln_provisionalRepaired();
		$this->bln_isTowed();
		
	}
	public function GetAccordionHeader() {
		if($this->objDamage->Description){
			return tr('Damage') . ': '. (string)$this->objDamage->Description;			
		}else{
			return tr('Damage');
		}
	}
	
	public function Save() {
		if(!$this->Validate()) {
			return;
		}
		
		if(!$this->objDamage) {			
			$this->objDamage = new \Damage();			
		}
		
		$this->objDamage->Description				= $this->txtDescription->Text;
		$this->objDamage->FirstImpactPoint			= $this->lstFirstImpact->SelectedValue;
		$this->objDamage->DamagePoints				= (count($this->ZonesSelected) > 0) ? join(',',$this->ZonesSelected) : '' ;
		$this->objDamage->Excess					= $this->txtExcess->Text;
		$this->objDamage->ExcessType				= $this->lstExcessType->SelectedValue;
		$this->objDamage->Cause						= $this->lstCause->SelectedValue;
		$this->objDamage->Fault						= $this->lstFault->SelectedValue;
		$this->objDamage->DateAtRepairer			= $this->ddtAtRepairer->DateTime;
		$this->objDamage->Towed						= $this->blnTowed->SelectedValue;
		$this->objDamage->BreakDownCosts			= $this->txtBreakDownCosts->Text;
		$this->objDamage->ProvisionalRepair			= $this->blnProvisionalRepaired->SelectedValue;
		$this->objDamage->ProvisionalRepairCosts	= $this->txtProvisionalRepairCosts->Text;
		$this->objDamage->ToDeduct					= $this->blnDeduct->SelectedValue;
		$this->objDamage->Value						= $this->txtValue->Text;
		$this->objDamage->Min						= $this->txtMin->Text;
		$this->objDamage->Max						= $this->txtMax->Text;
		$this->objDamage->HitDirection				= $this->DirectionSelected;
		$this->objDamage->AmountLimit				= $this->txtLimitAmount->Text;
		$this->objDamage->TotalLoss					= $this->blnTotalLoss->SelectedValue;
		$this->objDamage->LimitRdr					= $this->txtLimitRdr->Text;
		$this->objDamage->Immobilised				= $this->blnImmobilized->SelectedValue;
		
		
		
        $this->objDamage->Save();
		
		foreach($this->ArrCustomFields as $customField){
		   \CustomFieldType::SaveCustomField($customField, $this::CUSTOM_FIELD_TYPE, $intJobId=null, $intVehicleId=null, $intEntityId=null, $intAppointmentId=null, $this->objDamage->Id);	
		}
                
		$this->Trigger('OnSave',[$this->objDamage, $this->strType]);
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
			\CustomField::SetCustomFields($customField, $this::CUSTOM_FIELD_TYPE, $intJobId=null, null, $intEntityId=null, $intAppointmentId=null, $this->objDamage->Id);
		}
	}
	
	public function DirectionSelected(){
		$this->DirectionSelected = $this->btnDirection->SelectedValue;
	}
	
	public function ZonesSelected(){	
		$this->ZonesSelected = json_decode($this->btnDamagePoints->SelectedValue);
	}
	
	public function UnknownZoneSelected(){
		$this->pnlNotification->Display	= true;
		$this->btnDamagePoints->DisableUnknownZone();
	}
	public function bln_unlock(){
		$this->pnlNotification->Display	= $bln;
	}

	public function bln_provisionalRepaired(){
		if($this->blnProvisionalRepaired->SelectedValue == "yes"){
			$this->txtProvisionalRepairCosts->Display	= true;
			$this->blnShowProvisionalRepaired			= true;
		}else{
			$this->txtProvisionalRepairCosts->Display	= false;
			$this->blnShowProvisionalRepaired			= false;
		}
		$this->blnModified					= true;
	}
	public function bln_isTowed(){
		if($this->blnTowed->SelectedValue == "yes"){
			$this->txtBreakDownCosts->Display	= true;
			$this->blnBreakdown					= true;
		}else{
			$this->txtBreakDownCosts->Display	= false;
			$this->blnBreakdown					= false;
		}
		$this->blnModified					= true;
	}

	private function Build() {

		$this->txtDescription					= new \QCubed\Project\Control\TextBox($this);
		$this->txtDescription->Placeholder		= tr('Description');
		$this->txtDescription->TextMode			= \QCubed\Control\TextBoxBase::MULTI_LINE;
		$this->txtDescription->setCssStyle("height", "183px");
		
		$this->lstFirstImpact					= new \QCubed\Project\Control\ListBox($this);
		$this->lstFirstImpact->AddItem(tr("First impactpoint"), null);
		$this->lstFirstImpact->AddItem(tr('Unknown'), 'Unknown');
		$arrType = array('Front', 'Right Front', 'Right', 'Right Rear', 'Rear', 'Left Rear', 'Left', 'Left Front');	
			foreach($arrType as $type){
				$this->lstFirstImpact->AddItem(tr($type), $type);
			}
		
		$this->lstCause							= new \QCubed\Project\Control\ListBox($this);
		$this->lstCause->AddItem(tr("Select Cause"), null);
		$this->lstCause->AddItem(tr('Unknown'), 'Unknown');
		$arrCause = array('Reverse', 'Obstacle', 'Swing Out', 'Traffic Violation', 'Fire or Theft', 'Glass Damage', 'Other');
		$this->lstCause->SelectedValue			= 'Unknown';
			foreach($arrCause as $Cause){
				$this->lstCause->AddItem(tr($Cause), $Cause);
			}
		
		$this->lstFault							= new \QCubed\Project\Control\ListBox($this);
		$this->lstFault->AddItem(tr('Select Fault'), null);
		$this->lstFault->AddItem(tr('Unknown'), 'Unknown');
		$this->lstFault->SelectedValue			= 'Unknown';
		$arrFault = array('0%', '50%', '100%');
			foreach($arrFault as $Fault){
				$this->lstFault->AddItem(tr($Fault), $Fault);
			}
		
		
		$this->txtExcess						= new \QCubed\Project\Control\TextBox($this);
		$this->txtExcess->Placeholder			= tr('Excess');
		$this->txtExcess->Text					= 0;
		$this->txtExcess->TextMode				= \QCubed\Control\TextBoxBase::NUMBER;
		
		$this->lstExcessType					= new \QCubed\Project\Control\ListBox($this);
		$this->lstExcessType->AddItem(tr('Normal')		, 'normal');
		$this->lstExcessType->AddItem(tr('English')		, 'english');
		
		$this->ddtAtRepairer                                 = new \QCubed\Project\Jqui\DatepickerBox($this);
		$this->ddtAtRepairer->Placeholder		             = tr('Date at repairer');
		$this->ddtAtRepairer->Required                       = false;
		$this->ddtAtRepairer->addWrapperCssClass("input-group");
		$this->ddtAtRepairer->HtmlBefore	= "<span class='input-group-addon'><i class='fas fa-calendar-alt'></i></span>";
		
		$this->blnTowed										= new \QCubed\Project\Control\RadioButtonGroup($this);
		$this->blnTowed->AddItem(tr('Car has been towed')	, 'yes');
		$this->blnTowed->AddItem(tr('Car has not been towed')	, 'no');
		$this->blnTowed->AddButtonClassnames(['green','red']);
		$this->blnTowed->AddAction(new \QCubed\Event\Change() ,new \QCubed\Action\AjaxControl($this, 'bln_isTowed'));
		
		$this->blnTotalLoss									= new \QCubed\Project\Control\BooleanButton($this);
		$this->blnTotalLoss->Name							= tr('Total loss');
		
		$this->txtBreakDownCosts							= new \QCubed\Project\Control\TextBox($this);
		$this->txtBreakDownCosts->Placeholder				= tr("Towing Costs");
		$this->txtBreakDownCosts->addWrapperCssClass("input-group");
		$this->txtBreakDownCosts->HtmlBefore				= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
		$this->txtBreakDownCosts->Display					= false;
		
		$this->blnProvisionalRepaired						= new \QCubed\Project\Control\RadioButtonGroup($this);
		$this->blnProvisionalRepaired->AddItem(tr('Has been provisional repaired')	, 'yes');
		$this->blnProvisionalRepaired->AddItem(tr('Has not been provisional repaired')	, 'no');
		$this->blnProvisionalRepaired->AddButtonClassnames(['green','red']);
		$this->blnProvisionalRepaired->AddAction(new \QCubed\Event\Change() ,new \QCubed\Action\AjaxControl($this, 'bln_provisionalRepaired'));
		
		$this->txtProvisionalRepairCosts					= new \QCubed\Project\Control\TextBox($this);
		$this->txtProvisionalRepairCosts->Placeholder		= tr("Provisional repair costs");
		$this->txtProvisionalRepairCosts->addWrapperCssClass("input-group");
		$this->txtProvisionalRepairCosts->HtmlBefore		= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
		$this->txtProvisionalRepairCosts->Display			= false;
		
		$this->blnDeduct									= new \QCubed\Project\Control\RadioButtonGroup($this);
		$this->blnDeduct->AddItem(tr('Deduct from intervention')	, 'yes');
		$this->blnDeduct->AddItem(tr('Not deduct from intervention')	, 'no');
		$this->blnDeduct->AddButtonClassnames(['green','red']);
		
		$this->txtLimitAmount								= new \QCubed\Project\Control\TextBox($this);
		$this->txtLimitAmount->Placeholder					= tr("Limit Amount");
		$this->txtLimitAmount->addWrapperCssClass("input-group");
		$this->txtLimitAmount->HtmlBefore					= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
		
		$this->txtLimitRdr									= new \QCubed\Project\Control\TextBox($this);
		$this->txtLimitRdr->Placeholder						= tr("Rdr Limit");
		$this->txtLimitRdr->addWrapperCssClass("input-group");
		$this->txtLimitRdr->HtmlBefore						= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
		
		$this->txtValue										= new \QCubed\Project\Control\TextBox($this);
		$this->txtValue->Placeholder						= tr("Value");
		$this->txtValue->addWrapperCssClass("input-group");
		$this->txtValue->HtmlBefore							= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
		
		$this->txtMin										= new \QCubed\Project\Control\TextBox($this);
		$this->txtMin->Placeholder							= tr("Min");
		$this->txtMin->addWrapperCssClass("input-group");
		$this->txtMin->HtmlBefore							= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
			
		$this->txtMax										= new \QCubed\Project\Control\TextBox($this);
		$this->txtMax->Placeholder							= tr("Max");
		$this->txtMax->addWrapperCssClass("input-group");
		$this->txtMax->HtmlBefore							= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
		
		/* DAMAGEPOINTS */
		$this->btnDamagePoints								= new \QCubed\Project\Jqui\DamagePoints($this);
		$this->btnDamagePoints->addCssClass($this->strType);
		$this->btnDamagePoints->AddAction(new \QCubed\Project\Jqui\ZonesSelected(), new \QCubed\Action\AjaxControl($this, "ZonesSelected"));
		$this->btnDamagePoints->AddAction(new \QCubed\Project\Jqui\unknownSelectorSelected(), new \QCubed\Action\AjaxControl($this, "UnknownZoneSelected"));
		
		$this->btnDirection									= new \QCubed\Project\Jqui\RoundButton($this);
		$this->btnDirection->Name							= tr("Impact direction");
		$this->btnDirection->Register("Circle_clicked", "Direction_clicked");
		$this->btnDirection->addAction(new \QCubed\Project\Jqui\DirectionSelected(), new \QCubed\Action\AjaxControl($this, "DirectionSelected"));
		
		$this->pnlNotification								= new \QCubed\Control\Panel($this);
		$this->pnlNotification->AddCssClass("callout callout-warning ");
		$this->pnlNotification->Cursor						= 'pointer';
		$this->pnlNotification->Text						= '<p><i class="fa fa-lock" aria-hidden="true"></i> '.tr('Unable to select, the damage point is known').'</p>';
		$this->pnlNotification->Display						= false;
		
		/* define customfield container */
		$this->pnlCustomfields								= new \QCubed\Control\Panel($this); 
		$this->pnlCustomfields	->PreferredRenderMethod		= "RenderFormGroup";
		$this->pnlCustomfields	->AutoRenderChildren		= true;
		$this->GetCustomFields();
		
		$this->blnImmobilized							= new \QCubed\Project\Control\BooleanButton($this);
		$this->blnImmobilized->Name						= tr("Immobilized");
		
		$this->btnSave										= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Damage'));
		
		
	}
}

