<?php

namespace Hikify\Pages\Maintenance;

class Workflowedit extends \QCubed\Project\Control\Editor {
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtMainNameEn;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtMainNameFr;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtMainNameNl;
	/**
	 *
	 * @var \QCubed\Project\Control\Checkbox
	 */
	public $chkMainActive;
	/**
	 *
	 * @var \QCubed\Project\Control\Button
	 */
	public $btnSave;
	/**
	 *
	 * @var \QCubed\QDateTime
	 */
	public $ddtFrom;
	/**
	 *
	 * @var \QCubed\QDateTime
	 */
	public $ddtTill;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstTeam;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtNameEn;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtNameFr;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtNameNl;
	/**
	 *
	 * @var \QCubed\Project\Control\Button
	 */
	public $btnSaveStep;
	/**
	 *
	 * @var \QCubed\Project\Control\Checkbox
	 */
	public $chkActive;
	/**
	 *
	 * @var \QCubed\Project\Control\DataGrid 
	 */
	public $dtgWorkflow;
	/** @var \Workflow */
	private $objWorkflow;
	private $objWorkflowStep;
	private $objWorkflowDetail;
	private $selectedStep;
	
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/workflow-edit.tpl.php';
		$this->addCssFile('/project/assets/css/sortable.css');
		$this->addJavascriptFile("/project/assets/js/sortable.js");
		$this->addCssFile("/project/assets/css/datatables.css");	
		$this->addCssFile("/project/assets/css/boolean-button.css");	
		$this->objWorkflow				= new \Workflow();	
		$this->Build();
		
		if(isset($_GET['id'])) {
			$objWorkflow = \Workflow::Load((int) $_GET['id']);
			$this->dtgWorkflow->bindData(\QCubed\Query\QQ::equal(\QQN::workflowDetail()->WorkflowId, $objWorkflow->Id));
			$this->txtMainNameEn->Text									= $objWorkflow->NameEn;
			$this->txtMainNameNl->Text									= $objWorkflow->NameNl;
			$this->txtMainNameFr->Text									= $objWorkflow->NameFr;
			$this->ddtFrom->DateTime									= $objWorkflow->DateFrom->format("d-m-Y");
			$this->ddtTill->DateTime									= $objWorkflow->DateTo->format("d-m-Y");
			$this->chkMainActive->Checked								= ($objWorkflow->Active == 1);
//			
			$this->objWorkflow											= $objWorkflow;
		}
		
	}
	public function Save() {

		if(!$this->objWorkflow) {			
			$this->objWorkflow = new \Workflow();			
		}
		$check = \Workflow::QuerySingle(
									\QCubed\Query\QQ::AndCondition(
										\QCubed\Query\QQ::Equal(\QQN::workflow()->NameNl, $this->txtNameNl->Text), 
										\QCubed\Query\QQ::Equal(\QQN::workflow()->NameEn,$this->txtNameEn->Text),
										\QCubed\Query\QQ::Equal(\QQN::workflow()->NameFr, $this->txtNameFr->Text),
										\QCubed\Query\QQ::NotEqual(\QQN::workflow()->Id, $this->objWorkflow->Id)
									));
		if(!$check){
			$this->objWorkflow->Active				= $this->chkMainActive->Checked;
			$this->objWorkflow->NameEn				= $this->txtMainNameEn->Text;
			$this->objWorkflow->NameFr				= $this->txtMainNameFr->Text;
			$this->objWorkflow->NameNl				= $this->txtMainNameNl->Text;
			$this->objWorkflow->DateFrom			= $this->ddtFrom->DateTime;
			$this->objWorkflow->DateTo				= $this->ddtTill->DateTime;
			$this->objWorkflow->Save();

			\QCubed\Project\Application::Redirect('/?c=maintenance&a=workflow');
		}else{
			$this->objForm->ShowAlert(tr('A workflow with the same name already exists.'));
		}
	}
	public function btndelete_click($intWorkflowStepId){
		$this->objWorkflowStep					= \WorkflowStep::load($intWorkflowStepId);
		if(!$this->objWorkflowStep){ return;}
		$this->objWorkflowStep->Active			= null;
		$this->objWorkflowStep->Save();
		$this->dtgWorkflow->bindData(\QCubed\Query\QQ::equal(\QQN::workflowDetail()->WorkflowId, $this->objWorkflow->Id));
	
	}
	public function btnEdit_click($intWorkflowStepId){
		if($intWorkflowStepId){
			$this->selectedStep				= $intWorkflowStepId;
			$this->objWorkflowStep			= \WorkflowStep::load($intWorkflowStepId);
			$this->txtNameEn->Text			= $this->objWorkflowStep->NameEn;
			$this->txtNameFr->Text			= $this->objWorkflowStep->NameFr;
			$this->txtNameNl->Text			= $this->objWorkflowStep->NameNl;
			$this->lstTeam->SelectedValue	= $this->objWorkflowStep->TeamId;
			$this->chkActive->Checked		= ($this->objWorkflowStep->Active == 1);
		}
		
		
	}
	public function SaveStep(){
		\QCubed\Project\Application::Log("Save_step");
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT VALID FORM');
			return;
		}
		if(!$this->selectedStep){
			$check = \WorkflowStep::QuerySingle(
						\QCubed\Query\QQ::AndCondition(
							\QCubed\Query\QQ::Equal(\QQN::workflowStep()->NameNl, $this->txtNameNl->Text), 
							\QCubed\Query\QQ::Equal(\QQN::workflowStep()->NameEn,$this->txtNameEn->Text),
							\QCubed\Query\QQ::Equal(\QQN::workflowStep()->NameFr, $this->txtNameFr->Text),
							\QCubed\Query\QQ::NotEqual(\QQN::workflowStep()->Id, $this->selectedStep)
						));
			if(!$check){
				$this->objWorkflowStep		= new \WorkflowStep();
				$this->objWorkflowDetail	= new \WorkflowDetail();
			}else{
				$this->objForm->ShowAlert(tr('A workflowstep with the same name already exists for this workflow.'));
			}
			
		}
		
		$this->objWorkflowStep->NameEn	= $this->txtNameEn->Text;
		$this->objWorkflowStep->NameFr	= $this->txtNameFr->Text;
		$this->objWorkflowStep->NameNl	= $this->txtNameNl->Text;
		$this->objWorkflowStep->Active	= $this->chkActive->Checked;
		$this->objWorkflowStep->TeamId	= $this->lstTeam->SelectedValue;
		$this->objWorkflowStep->Save();
		
		if($this->objWorkflowDetail && $this->objWorkflow){
			$this->objWorkflowDetail->WorkflowId		= $this->objWorkflow->Id;
			$this->objWorkflowDetail->WorkflowStepId	= $this->objWorkflowStep->Id;
			$this->objWorkflowDetail->Number			= count(\WorkflowStep::loadByWorkflowId($this->objWorkflow->Id))+1;
			$this->objWorkflowDetail->Save();
		}
		
		
		$this->txtNameEn->Text			= "";
		$this->txtNameFr->Text			= "";
		$this->txtNameNl->Text			= "";
		$this->chkActive->Checked		= null;
		$this->lstTeam->SelectedValue	= null;
		$this->dtgWorkflow->bindData(\QCubed\Query\QQ::equal(\QQN::workflowDetail()->WorkflowId, $this->objWorkflow->Id));
		
	}
	
	public function UpdateNumber(){
		$x=0;
		foreach($this->dtgWorkflow->SelectedOrder as $WorkflowStepId){
			$objWorkflowDetail				= \WorkflowDetail::load($WorkflowStepId);
			$objWorkflowDetail->Number		= ++$x;
			$objWorkflowDetail->Save();
		}	
	}
	private function Build() {		
		$this->txtMainNameEn				= new \QCubed\Project\Control\TextBox($this);
		$this->txtMainNameEn->Placeholder	= tr('Name EN');
		$this->txtMainNameEn->Required		= true;
		
		$this->txtMainNameFr				= new \QCubed\Project\Control\TextBox($this);
		$this->txtMainNameFr->Placeholder	= tr('Name FR');
		$this->txtMainNameFr->Required		= true;
		
		$this->txtMainNameNl				= new \QCubed\Project\Control\TextBox($this);
		$this->txtMainNameNl->Placeholder	= tr('Name NL');
		$this->txtMainNameNl->Required		= true;
		
		$this->chkMainActive						= new \QCubed\Project\Jqui\Checkbox($this);
		
		$this->chkMainActive->HtmlBefore			= "<label class='chk_select_label'>";
		$this->chkMainActive->addWrapperCssClass("chk_select");
		$this->chkMainActive->HtmlAfter				= "<span>".tr("Active")."</span></label>";
		
		$this->txtNameEn					= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameEn->Placeholder		= tr('Name EN');
		$this->txtNameEn->Required			= true;
		
		$this->txtNameFr					= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameFr->Placeholder		= tr('Name FR');
		$this->txtNameFr->Required			= true;
		
		$this->txtNameNl					= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameNl->Placeholder		= tr('Name NL');
		$this->txtNameNl->Required			= true;

		$this->lstTeam						= \Team::GetListBox($this);
		$this->lstTeam->Name				= tr("Team");
		$this->lstTeam->addItem(tr('Select team'), null);
		$this->lstTeam->SelectedValue		= null;
		
		$this->chkActive						= new \QCubed\Project\Jqui\Checkbox($this);
		
		$this->chkActive->HtmlBefore			= "<label class='chk_select_label'>";
		$this->chkActive->addWrapperCssClass("chk_select");
		$this->chkActive->HtmlAfter				= "<span>".tr("Active")."</span></label>";
		
		$this->btnSave						= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Workflow'));
	
		$this->btnSaveStep					= \QCubed\Project\Control\Button::GetFontAwesomeButton($this, tr('Save Workflowstep'), 'fas fa-plus', 'SaveStep', 'btn-primary');
		
		$this->dtgWorkflow					= new \WorkflowDetailList($this);
		$this->dtgWorkflow->CssClass		= 'workflow_table table';
		$this->dtgWorkflow->CreateColumns();
		$this->dtgWorkflow->RowCssClass		= "ui-state-default";
		$this->dtgWorkflow->Register("OnDelete","btndelete_click",$this);
		$this->dtgWorkflow->Register("OnEdit","btnEdit_click",$this);
		$this->dtgWorkflow->addAction(new \SortWorkflowItem(), new \QCubed\Action\AjaxControl($this, "UpdateNumber"));
		\QCubed\Project\Application::executeJavaScript("sortable.init('{$this->dtgWorkflow->ControlId}')");
		
		$this->ddtFrom						= new  \QCubed\Project\Jqui\DatepickerBox($this);
		$this->ddtFrom->Placeholder			= tr('From');
			
		$this->ddtTill						= new  \QCubed\Project\Jqui\DatepickerBox($this);
		$this->ddtTill->Placeholder			= tr('From');
		
	}

	
}

