<?php

namespace Hikify\Pages\Maintenance;

class Workflow extends \QCubed\Control\Panel {

	public $lblFilter;
	/** @var \QCubed\Control\Panel */
	public $txtNumber;
	public $txtEntity;
	public $lstType;
	public $pnlFilter;
	public $btnNew;
	/** @var \WorkflowList */
	public $lstWorkflow;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/workflow.tpl.php';
		$this->addCssFile("/project/assets/css/datatables.css");	
		$this->Build();
		
	}
	
	private function Build() {		
		
		$this->btnNew				= new \QCubed\Project\Control\Button($this);
		$this->btnNew->Text			= tr('New Workflow');
		$this->btnNew->AddCssClass('btn btn-flat btn-default newbutton');
		$this->btnNew->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\Redirect('/?c=maintenance&a=workflowedit'));
		
		$this->lstWorkflow							= new \WorkflowList($this);
		$this->lstWorkflow->CssClass				= 'workflow_table table';
		$this->lstWorkflow->AddJavascriptRowAction('maintenance','workflowedit');
		$this->lstWorkflow->CreateColumns();
		
		$this->pnlFilter = self::ShowFilter();
		
	}
	
	protected function ShowFilter(){
		$this->lblFilter = new \QCubed\Control\Label($this);
		$this->lblFilter->Text = tr('Filter');
		
		$this->txtNumber = new \QCubed\Project\Control\TextBox($this);
		$this->txtNumber->Placeholder = tr('Number');
		
		$this->txtEntity= new \QCubed\Project\Control\TextBox($this);
		$this->txtEntity->Placeholder = tr('Entity');
		
		$this->lstType	= \EntityType::GetListBox($this);
		
	}
	
}
