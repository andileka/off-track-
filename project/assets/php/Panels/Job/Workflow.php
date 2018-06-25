<?php

namespace Hikify\Panels\Job;

class Workflow extends \QCubed\Control\Panel {
	/**
	 * 
	 * @var \QCubed\Project\Control\ListBox
	 */
    public $lstWorkflow;
	/**
	 *
	 * @var \QCubed\Control\Panel
	 */
	public $pnlWorkflow;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Button 
	 */
	public $btnSave;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtNewWorkflowStep;
	/**
	 *
	 * @var Button 
	 */
	public $btnAddWorkflowStep;
	
	/* @var \Job*/
	private $objJob;
	private $strTitle;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/panels/job/workflow.tpl.php';		
		$this->Build(); 
		
	}
	
	public function GetAccordionHeader() {
		if(count($this->strTitle)>0){
			return tr('Workflow') . ': ' . join(', ',$this->strTitle);
		}
		return tr('Workflow');
	}
	
	public function SetJob(\Job $objJob=null) {
		if(!$objJob) {
			return;
		}
		$this->objJob									= $objJob;
		$this->LoadJobWorkflow();
	}
	
	
	public function Save() {
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT INVALID FORM');
			return;
		}
		
		if(!$this->objWorkflowStep) {			
			$this->objWorkflowStep = new \JobWorkflow();			
		}

		$this->objVehicle->Save();
        
		$this->Trigger('OnSave',[$this->objVehicle]);
	}
	
	public function lstWorkflow_changed(){
		\JobWorkflow::DeleteByJobId($this->objJob->Id);			
		$arr = \WorkflowDetail::LoadArrayByWorkflowId($this->lstWorkflow->SelectedValue);
		foreach($arr as $step){
			$this->CreateJobWorkflow($step);
		}
		$this->LoadJobWorkflow();
	}
	
	public function LoadJobWorkflow(){
		$this->pnlWorkflow->RemoveChildControls(true);
		$arr = \JobWorkflow::LoadArrayByJobId($this->objJob->Id);
		if(count($arr) > 0){
			$strTitle= ': ';
			foreach($arr as $jobworkflow){
				$this->AddToPanel($jobworkflow);
				$this->strTitle[]= "<span class='".str_replace(' ','',strtolower($jobworkflow->Status))."'>".$jobworkflow->WorkflowDetail->WorkflowStep."</span>";
			}
			$this->lstWorkflow->SelectedValue	= $jobworkflow->WorkflowDetail->WorkflowId;
		}
	}
	
	public function AddStep_click(){
		if(!$this->txtNewWorkflowStep->Text){
			$this->txtNewWorkflowStep->addCssClass("has-error");
		}else{
			$this->txtNewWorkflowStep->removeCssClass("has-error");
			$this->lstWorkflow->SelectedValue;
			$objWorkflowStep												= new \WorkflowStep();
			$objWorkflowStep->NameEn										= $this->txtNewWorkflowStep->Text;
			$objWorkflowStep->NameNl										= $this->txtNewWorkflowStep->Text;
			$objWorkflowStep->NameFr										= $this->txtNewWorkflowStep->Text;
			$objWorkflowStep->Active										= 1;
			
			$objWorkflowStep->Save();
			
			$countedSteps = count(\WorkflowDetail::loadArrayByWorkflowId($this->lstWorkflow->SelectedValue));
			if($objWorkflowStep){
				$objWorkflowDetail						= new \WorkflowDetail();
				$objWorkflowDetail->Number				= ($countedSteps+1);
				$objWorkflowDetail->WorkflowStepId		= $objWorkflowStep->Id;
				$objWorkflowDetail->WorkflowId			= $this->lstWorkflow->SelectedValue;
				$objWorkflowDetail->Save();
			}
			
			$this->CreateJobWorkflow($objWorkflowDetail);
			$this->LoadJobWorkflow();
			
			$this->txtNewWorkflowStep->Text				= "";
		}
	}
	
	private function GetStepHeaderDisplay(\JobWorkflow $jobworkflow) {
			return $jobworkflow->WorkflowDetail->WorkflowStep;
	}
	
	private function Build() {
		$this->lstWorkflow						= \Workflow::GetListBox($this);
		$this->lstWorkflow->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'lstWorkflow_changed'));
		
		$this->pnlWorkflow						= new \QCubed\Control\Panel($this);
		$this->pnlWorkflow->AutoRenderChildren	= true;
		
		$this->txtNewWorkflowStep				= new \QCubed\Project\Control\TextBox($this);
		
		$this->btnAddWorkflowStep				= \QCubed\Project\Control\Button::GetFontAwesomeButton($this, "", "fas fa-plus-square");
		$this->btnAddWorkflowStep->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "AddStep_click"));
		
	}
	
	private function CreateJobWorkflow(\WorkflowDetail $objWorkflowStep=null) {
		$objJobWorkflow							= new \JobWorkflow();
		$objJobWorkflow->WorkflowDetail			= $objWorkflowStep;
		$objJobWorkflow->JobId					= $this->objJob->Id;
		
		$objJobWorkflow->Save();
		
	}
	
	private function AddToPanel(\JobWorkflow $objWorkflowStep=null) {
		$pnlWorkflow							= new Jobworkflow($this->pnlWorkflow);
		$pnlWorkflow->SetJobWorkFlow($objWorkflowStep);
		
		$this->btnSave							= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Workflow'));
	}
}

