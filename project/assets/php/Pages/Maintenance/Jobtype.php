<?php

namespace Hikify\Pages\Maintenance;

class Jobtype extends \QCubed\Control\Panel {

	public $lblFilter;
	/** @var \QCubed\Control\Panel */
	public $pnlIndex;
	public $pnlFilter;
	public $txtNumber;
	public $txtEntity;
	public $lstType;
	public $btnNew;
	/** @var \JobType */
	public $lstJobtypes;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/jobtype.tpl.php';
		$this->addCssFile("/project/assets/css/datatables.css");	
		$this->Build();
		
	}
	
	private function Build() {		
		$this->pnlIndex								= new \QCubed\Control\Panel($this);
		$this->pnlIndex->Text						= tr('Vehicle page');
		
		$this->lblFilter							= new \QCubed\Control\Label($this);
		$this->lblFilter->Text						= tr('Filter');
		
		$this->pnlFilter							= self::ShowFilter();
		
		$this->btnNew								= new \QCubed\Project\Control\Button($this);
		$this->btnNew->Text							= tr('New Jobtype');
		$this->btnNew->AddCssClass('btn btn-flat btn-default newbutton');
		$this->btnNew->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\Redirect('/?c=maintenance&a=jobtypeedit'));
		
		$this->lstJobtypes							= new \JobTypeList($this);
		$this->lstJobtypes->CssClass				= 'jobtype_table table';
		$this->lstJobtypes->AddJavascriptRowAction('maintenance','jobtypeedit');
		$this->lstJobtypes->CreateColumns();
		
	}
	
	protected function ShowFilter(){
		$this->lblFilter				= new \QCubed\Control\Label($this);
		$this->lblFilter->Text			= tr('Filter');
		
		$this->txtNumber				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNumber->Placeholder	= tr('Number');
		
		$this->txtEntity				= new \QCubed\Project\Control\TextBox($this);
		$this->txtEntity->Placeholder	= tr('Entity');
		
		$this->lstType					= \EntityType::GetListBox($this);
		
	}
	
}
