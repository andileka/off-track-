<?php

namespace Hikify\Panels\Job;

class Estimates extends \QCubed\Project\Control\Editor {
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox 
	 */
	public $txtPartCost;
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox 
	 */
	public $txtPaintingCost;
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox 
	 */
	public $txtLabourCosts;
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox 
	 */
	public $txtPaintingLabourHours;
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox 
	 */
	public $txtComment;
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox 
	 */
	public $txtLabourHours;
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox 
	 */
	public $txtPaintingLaborCost;
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox 
	 */
	public $txtSubstractCosts;
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox 
	 */
	public $txtOtherCosts;
	/**
	 *
	 * @var \EstimateList 
	 */
	public $ddgJobEstimate;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Button
	 */
	public $btnSave;
	/**
	 * 
	 * @var \QCubed\Project\Jqui\DatepickerBox
	 */
	public $dttDateRecieved;
	/**
	 *
	 * @var \QCubed\Project\Control\BooleanButton 
	 */
	public $blnStatus;
	/**
	 *
	 * @var \Estimate
	 */
	public $objEstimate;
	/**
	 *
	 * @var \Job 
	 */
	private $objJob;
	
	const CUSTOM_FIELD_TYPE = "estimate"; 
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);		
		$this->strTemplate			= __TEMPLATES__ .  '/panels/job/estimates.tpl.php';
		$this->Build();
		
	}
	
	public function GetAccordionHeader() {
		if($this->objJob){
			$objEstimates = \Estimate::loadArrayByJobId($this->objJob->Id);
			$Total = ($objEstimates) ? end($objEstimates)->TotalAmount : "";
			return tr('Estimates') ." ".tr("Last known amount"). ": ". $Total;
		}else{
			return tr('Estimates');
		}
		
		
	}
	
	public function SetEstimate(\Job $objJob=null) {
		if(!$objJob) {
			return;
		}
		
			$this->objJob						= $objJob;
			$objEstimates						= \Estimate::loadArrayByJobId($objJob->Id);
			$this->ddgJobEstimate->DataSource	= $objEstimates;
	}
	
	public function Save() {
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT A VALID FORM');
			return;
		}	
		if(!$this->objEstimate) {			
			$this->objEstimate = new \Estimate();			
		}
		$this->objEstimate->Comment					= $this->txtComment->Text;
		$this->objEstimate->LabourTime				= $this->txtLabourHours->Text;
		$this->objEstimate->LabourAmount			= $this->txtLabourCosts->Text;
		$this->objEstimate->PaintTime				= $this->txtPaintingLabourHours->Text;
		$this->objEstimate->PaintAmount				= $this->txtPaintingLaborCost->Text;
		$this->objEstimate->SubstractedAmount		= $this->txtSubstractCosts->Text;
		$this->objEstimate->PaintProducts			= $this->txtPaintingCost->Text;
		$this->objEstimate->Parts					= $this->txtPartCost->Text;
		$this->objEstimate->Other					= $this->txtOtherCosts->Text;
		$this->objEstimate->JobId					= $this->objJob->Id;
		$this->objEstimate->TotalAmount				= ($this->txtLabourCosts->Text + $this->txtPaintingCost->Text + $this->txtPaintingLaborCost->Text +  $this->txtPartCost->Text + $this->txtOtherCosts->Text);
		$this->objEstimate->Approval				= $this->blnStatus->SelectedValue;
		$this->objEstimate->DateReceived			= $this->dttDateRecieved->DateTime;
		$this->objEstimate->Save();
		
		$this->ClearFields();
		$this->ddgJobEstimate->bindData(\QCubed\Query\QQ::equal(\QQN::estimate()->JobId, $this->objJob->Id));
		$this->ddgJobEstimate->dataBind();
	}
	
	public function GetCustomFields(){
		/* Load all custom fields for vehicle */
		$arrCustomFieldTypes	= \CustomFieldType::loadArrayByContainer($this::CUSTOM_FIELD_TYPE);
		foreach($arrCustomFieldTypes as $objCustomfieldType){
			$this->ArrCustomFields[] = \CustomFieldType::CreateCustomField($this->pnlCustomfields, $objCustomfieldType);
		}
	}
	public function ClearFields(){
		$this->txtLabourCosts->Text				= "";
		$this->txtLabourHours->Text				= "";
		$this->txtOtherCosts->Text				= "";
		$this->txtPaintingCost->Text			= "";
		$this->txtPaintingLabourHours->Text		= "";
		$this->txtPaintingLaborCost->Text		= "";
		$this->txtPartCost->Text				= "";
		$this->blnStatus->SelectedValue			= null;
		$this->dttDateRecieved->Text			= "";	
		$this->txtSubstractCosts->Text			= "";
		$this->txtComment->Text					= "";
	}
	
	public function SetCustomFields(){
		/* Load all custom fields for vehicle */
		foreach($this->ArrCustomFields as $customField){
			\CustomField::SetCustomFields($customField, $this::CUSTOM_FIELD_TYPE, $intJobId=null, $this->objVehicle->Id, $intEntityId=null, $intAppointmentId=null);
		}
	}
	
	public function btnedit_click($intEstimateId){
		$this->objEstimate = \Estimate::load($intEstimateId);
		$this->txtComment->Text					= $this->objEstimate->Comment;
		$this->txtLabourHours->Text				= $this->objEstimate->LabourTime;
		$this->txtLabourCosts->Text				= $this->objEstimate->LabourAmount;
		$this->txtPaintingLabourHours->Text		= $this->objEstimate->PaintTime;
		$this->txtPaintingLaborCost->Text		= $this->objEstimate->PaintAmount;
		$this->txtOtherCosts->Text				= $this->objEstimate->Other;
		$this->txtSubstractCosts->Text			= $this->objEstimate->SubstractedAmount;
		$this->txtPaintingCost->Text			= $this->objEstimate->PaintProducts;
		$this->txtPartCost->Text				= $this->objEstimate->Parts;
		$this->blnStatus->SelectedValue			= $this->objEstimate->Approval;
		$this->dttDateRecieved->Text			= $this->objEstimate->DateReceived;		
	}
	
	public function btndelete_click($intEstimateId){
		\Estimate::deleteById($intEstimateId);
		$this->ddgJobEstimate->bindData(\QCubed\Query\QQ::equal(\QQN::estimate()->JobId, $this->objJob->Id));
		$this->ddgJobEstimate->dataBind();
	}
	
	private function Build() {
		$this->txtPartCost							= new \QCubed\Bootstrap\TextBox($this);
		$this->txtPartCost->Placeholder				= tr('Parts');
		$this->txtPartCost->addWrapperCssClass("input-group");
		$this->txtPartCost->HtmlBefore				= "<span class='input-group-addon'><i class='fas fa-euro-sign'></i></span>";
		
		$this->txtPaintingCost						= new \QCubed\Bootstrap\TextBox($this);
		$this->txtPaintingCost->Placeholder			= tr('Painting');
		$this->txtPaintingCost->addWrapperCssClass("input-group");
		$this->txtPaintingCost->HtmlBefore			= "<span class='input-group-addon'><i class='fas fa-euro-sign'></i></span>";
		
		$this->txtLabourCosts						= new \QCubed\Bootstrap\TextBox($this);
		$this->txtLabourCosts->Placeholder			= tr('Labour Costs');
		$this->txtLabourCosts->addWrapperCssClass("input-group");
		$this->txtLabourCosts->HtmlBefore			= "<span class='input-group-addon'><i class='fas fa-euro-sign'></i></span>";
		
		$this->txtPaintingLabourHours				= new \QCubed\Bootstrap\TextBox($this);
		$this->txtPaintingLabourHours->Placeholder	= tr('Painting labour');
		$this->txtPaintingLabourHours->addWrapperCssClass("input-group");
		$this->txtPaintingLabourHours->HtmlBefore	= "<span class='input-group-addon'><i class='fas fa-clock'></i></span>";
		
		$this->txtComment							= new \QCubed\Bootstrap\TextBox($this);
		$this->txtComment->Placeholder				= tr('Comment');
		$this->txtComment->TextMode					= "MultiLine";
		
		$this->txtLabourHours						= new \QCubed\Bootstrap\TextBox($this);
		$this->txtLabourHours->Placeholder			= tr('Labour Hours');
		$this->txtLabourHours->addWrapperCssClass("input-group");
		$this->txtLabourHours->HtmlBefore			= "<span class='input-group-addon'><i class='fas fa-clock'></i></span>";
		
		$this->txtPaintingLaborCost					= new \QCubed\Bootstrap\TextBox($this);
		$this->txtPaintingLaborCost->Placeholder	= tr('Painting labour costs');
		$this->txtPaintingLaborCost->addWrapperCssClass("input-group");
		$this->txtPaintingLaborCost->HtmlBefore		= "<span class='input-group-addon'><i class='fas fa-euro-sign'></i></span>";
		
		$this->txtSubstractCosts					= new \QCubed\Bootstrap\TextBox($this);
		$this->txtSubstractCosts->Placeholder		= tr('Substract amount');
		$this->txtSubstractCosts->addWrapperCssClass("input-group");
		$this->txtSubstractCosts->HtmlBefore		= "<span class='input-group-addon'><i class='fas fa-euro-sign'></i></span>";
		
		$this->txtOtherCosts						= new \QCubed\Bootstrap\TextBox($this);
		$this->txtOtherCosts->Placeholder			= tr('Several');
		$this->txtOtherCosts->addWrapperCssClass("input-group");
		$this->txtOtherCosts->HtmlBefore			= "<span class='input-group-addon'><i class='fas fa-euro-sign'></i></span>";
		
		$this->ddgJobEstimate						= new \EstimateList($this);
		$this->ddgJobEstimate->createColumns();
		$this->ddgJobEstimate->DataSource			= array();
		$this->ddgJobEstimate->Register("OnEdit","btnedit_click",$this);
		$this->ddgJobEstimate->Register("OnDelete","btndelete_click",$this);
		
		$this->blnStatus							= new \QCubed\Project\Control\RadioButtonGroup($this);
		$this->blnStatus->AddItem(tr('Approved')	, 'APPROVED');
		$this->blnStatus->AddItem(tr('Rejected')	, 'REJECTED');
		$this->blnStatus->AddItem(tr('Unknown')	, 'UNKNOWN');
		$this->blnStatus->AddButtonClassnames(['green','red', 'grey']);
		
		$this->dttDateRecieved                      = new \QCubed\Project\Jqui\DatepickerBox($this);
		$this->dttDateRecieved->Placeholder         = tr('Date recieved');
		$this->dttDateRecieved->Required            = true;
		$this->dttDateRecieved->addWrapperCssClass("input-group");
		$this->dttDateRecieved->HtmlBefore	= "<span class='input-group-addon'><i class='fas fa-calendar-alt'></i></span>";
		
		$this->btnSave								= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Estimate'));
		
	}
}
