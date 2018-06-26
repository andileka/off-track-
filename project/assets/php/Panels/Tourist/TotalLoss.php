<?php

namespace Hikify\Panels\Job;

class TotalLoss extends \QCubed\Project\Control\Editor {
	/**
	 * 
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstType;
	/**
	 * 
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstDestinationVehicle;
	/**
	 *
	 * @var \QCubed\Project\Control\BooleanButton 
	 */
	public $blnMargeOnSale;
	/**
	 * 
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtCurrentValue;
	/**
	 * 
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtCostsSubjectToVTA;
	/**
	 * 
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtDeductedValue;
	/**
	 * 
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtVehicleValue;
	/**
	 * 
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtCostsNoSubjectVTA;
	/**
	 * 
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtTransferAccessories;
	/**
	 * 
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtReplaceAccessories;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlQuotations;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Button
	 */
	public $btnSave;		
	/**
	 *
	 * @var \Vehicle 
	 */
	public $ArrCustomFields= [];
	private $objDamage;
	private $objTotalLoss;
	
	const CUSTOM_FIELD_TYPE = "totalloss"; 
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/panels/job/total_loss.tpl.php';
		$this->Build();
		
	}
	
	public function GetAccordionHeader() {
		if($this->objTotalLoss) {
			return tr('Total Loss') . ': '.(string)$this->objTotalLoss->TotalLossType->{\QCubed\Project\Application::$LocaleName};
		}
			
		return tr('Total Loss');
	}
	
	public function SetTotalLoss(\Damage $objDamage=null) {
		if(!$objDamage) {
			return;
		}
				$this->objDamage								= $objDamage;
				$this->objTotalLoss								= \DamageDetails::loadByDamageId($this->objDamage->Id);
				if($this->objTotalLoss){
					$this->lstType->SelectedValue					= $this->objTotalLoss->TotalLossType->Id;
					$this->lstDestinationVehicle->SelectedValue		= $this->objTotalLoss->DestinationVehicleId;
					$this->blnMargeOnSale->SelectedValue			= $this->objTotalLoss->Margin;
					$this->txtCurrentValue->Text					= $this->objTotalLoss->MarketValue;
					$this->txtDeductedValue->Text					= $this->objTotalLoss->Deduction;
					$this->txtCostsSubjectToVTA->Text				= $this->objTotalLoss->SubjectToVat;
					$this->txtCostsNoSubjectVTA->Text				= $this->objTotalLoss->NoSubjectToVat;
					$this->txtTransferAccessories->Text				= $this->objTotalLoss->TransferAccessories;
					$this->txtReplaceAccessories->Text				= $this->objTotalLoss->ReplacementAccessories;
					$this->pnlQuotations->setQuotationPanel($this->objDamage);
				}
				
                
				$this->SetCustomFields( );
	}
	
	public function Save() {
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT A VALID FORM');
			return;
		}
		
		
		if(!$this->objTotalLoss) {			
			$this->objTotalLoss = new \DamageDetails();			
		}
		$this->objTotalLoss->DamageId					= $this->objDamage->Id;
		$this->objTotalLoss->TotalLossTypeId			= $this->lstType->SelectedValue;
		$this->objTotalLoss->DestinationVehicleId		= $this->lstDestinationVehicle->SelectedValue;				
		$this->objTotalLoss->Margin						= $this->blnMargeOnSale->SelectedValue;
		$this->objTotalLoss->MarketValue				= $this->txtCurrentValue->Text;
		$this->objTotalLoss->Deduction					= $this->txtDeductedValue->Text;
		$this->objTotalLoss->NoSubjectToVat				= $this->txtCostsNoSubjectVTA->Text;
		$this->objTotalLoss->SubjectToVat				= $this->txtCostsSubjectToVTA->Text;
		$this->objTotalLoss->TransferAccessories		= $this->txtTransferAccessories->Text;
		$this->objTotalLoss->ReplacementAccessories		= $this->txtReplaceAccessories->Text;
		$this->objTotalLoss->Save();
		if($this->Validate() && $this->pnlQuotations->lstLowerQuotation->SelectedValue) {
			$this->pnlQuotations->Save();
		}
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
	
	private function Build() {
		
		$this->lstType							= \TotalLossType::GetListBox($this);
		$this->lstType->Required				= true;
		
		$this->lstDestinationVehicle			= \DestinationVehicleType::GetListBox($this);
		$this->lstDestinationVehicle->Required	= true;
		
		$this->txtCurrentValue					= new \QCubed\Bootstrap\TextBox($this);
		$this->txtCurrentValue->addWrapperCssClass("input-group");
		$this->txtCurrentValue->HtmlBefore		= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
		
		$this->txtCostsSubjectToVTA				= new \QCubed\Bootstrap\TextBox($this);		
		$this->txtCostsSubjectToVTA->addWrapperCssClass("input-group");
		$this->txtCostsSubjectToVTA->HtmlBefore	= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
	
		$this->txtDeductedValue					= new \QCubed\Bootstrap\TextBox($this);	
		$this->txtDeductedValue->addWrapperCssClass("input-group");
		$this->txtDeductedValue->HtmlBefore		= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
		
		$this->txtVehicleValue					= new \QCubed\Bootstrap\TextBox($this);	
		$this->txtVehicleValue->addWrapperCssClass("input-group");
		$this->txtVehicleValue->HtmlBefore		= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
		
		$this->txtCostsNoSubjectVTA				= new \QCubed\Bootstrap\TextBox($this);		
		$this->txtCostsNoSubjectVTA->addWrapperCssClass("input-group");
		$this->txtCostsNoSubjectVTA->HtmlBefore	= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
		
		$this->txtTransferAccessories				= new \QCubed\Bootstrap\TextBox($this);
		$this->txtTransferAccessories->addWrapperCssClass("input-group");
		$this->txtTransferAccessories->HtmlBefore	= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
		
		$this->txtReplaceAccessories				= new \QCubed\Bootstrap\TextBox($this);
		$this->txtReplaceAccessories->addWrapperCssClass("input-group");
		$this->txtReplaceAccessories->HtmlBefore	= "<span class='input-group-addon'><i class='fas fas fa-euro-sign'></i></span>";
		
		$this->blnMargeOnSale						= new \QCubed\Project\Control\RadioButtonGroup($this);
		$this->blnMargeOnSale->AddItem(tr('Yes')	, 'yes');
		$this->blnMargeOnSale->AddItem(tr('No')	, 'no');
		$this->blnMargeOnSale->AddButtonClassnames(['green','red']);
		
		$this->pnlQuotations						= new \Hikify\Panels\Maintenance\Quotations($this);
		
		$this->GetCustomFields();
		
		$this->btnSave								= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Total Loss'));
		
		
	}
}
