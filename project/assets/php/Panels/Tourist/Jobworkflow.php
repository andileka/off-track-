<?php

namespace Hikify\Panels\Job;

use QCubed\Plugin\Bootstrap as Bs;

class Jobworkflow extends \QCubed\Control\Panel {
	/**
	 *
	 * @var \QCubed\Control\Label 
	 */
	public $lblWorkStep;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstWorkTeam;
	/**
	 *
	 * @var \QCubed\Project\Jqui\DatepickerBox
	 */
	public $txtDeadlineDate;
	/**
	 *
	 * @var \QCubed\Control\DateTimeTextBox
	 */
	public $txtDeadlineDateTime;
	/**
	 *
	 * @var \QCubed\Project\Control\Button 
	 */
	public $btnStatus;
	/**
	 *
	 * @var \JobWorkflow 
	 */
    private $objJobWorkflow;
	

	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/panels/maintenance/workflow.tpl.php';		
		$this->Build();
		
	}
	
	public function SaveWorkflow(){
		if($this->btnStatus->SelectedValue == "done"){}
		if(!$this->objJobWorkflow) {			
			return;			
		}
		$dttDatetime = new \QCubed\QDateTime($this->txtDeadlineDate->DateTime.' '.$this->txtDeadlineDateTime->Text);

		$this->objJobWorkflow->Status				= $this->btnStatus->SelectedValue;
		$this->objJobWorkflow->AssignedBy			= \Hikify\Helpers\Security::GetLoggedInUser();
		$this->objJobWorkflow->AssignedToId			= $this->lstWorkTeam->SelectedValue;
		$this->txtDeadlineDateTime->Text			= $this->txtDeadlineDate->DateTime ? $dttDatetime->format('H:i') : '';
		$this->objJobWorkflow->Deadline				= $dttDatetime;

		$this->objJobWorkflow->Save();
	}
    public function SetJobWorkFlow(\JobWorkflow $objJobWorkflow=null) {
		$this->objJobWorkflow						= $objJobWorkflow;
		$this->lblWorkStep->Text					= (string)$objJobWorkflow->WorkflowDetail->WorkflowStep;
		$this->lstWorkTeam->SelectedValue			= $objJobWorkflow->WorkflowDetail->WorkflowStep->TeamId;
		
		if($objJobWorkflow->IsDone()) {
			$this->lblWorkStep->SetCustomStyle('text-decoration', 'line-through');
			
		}
		$this->txtDeadlineDate->DateTime			= $objJobWorkflow->Deadline;
		$this->txtDeadlineDateTime->Text			= $objJobWorkflow->Deadline ? $objJobWorkflow->Deadline->format('H:i') : $objJobWorkflow->Deadline;
		$this->btnStatus->SelectedValue				= $objJobWorkflow->Status;
		if($objJobWorkflow->AssignedToId){
			$this->lstWorkTeam->SelectedValue			= $objJobWorkflow->AssignedToId;
		}
		
		$this->btnStatus->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'SaveWorkflow'));		
	}
	

	private function Build() {
		$this->lblWorkStep					= new \QCubed\Control\Label($this);
		
		$this->lstWorkTeam					= \Team::GetListBox($this, null, tr('Assign to team'));
		$this->lstWorkTeam->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'SaveWorkflow'));
		$this->txtDeadlineDate				= new \QCubed\Project\Jqui\DatepickerBox($this);
		$this->txtDeadlineDate->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'SaveWorkflow'));
		$this->txtDeadlineDate->Placeholder	= tr('Deadline');
		$this->txtDeadlineDateTime			= new \QCubed\Control\DateTimeTextBox($this);
		$this->txtDeadlineDateTime->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'SaveWorkflow'));
		
		$this->btnStatus					= \JobWorkflow::GetStatusRadioButtonGroup($this);
		
	}
}

