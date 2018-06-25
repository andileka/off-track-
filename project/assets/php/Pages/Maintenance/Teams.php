<?php

namespace Hikify\Pages\Maintenance;

class Teams extends \QCubed\Control\Panel {

	public $lblFilter;
	/** @var \QCubed\Control\Panel */
	public $pnlIndex;
	public $pnlFilter;
	public $txtNumber;
	public $txtEntity;
	public $lstType;
	public $btnNew;
	/** @var \TeamList */
	public $lstTeams;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/teams.tpl.php';
		$this->addCssFile("/project/assets/css/datatables.css");	
		$this->Build();
		
	}
	
	private function Build() {		
		$this->pnlIndex				= new \QCubed\Control\Panel($this);
		$this->pnlIndex->Text		= tr('Vehicle page');
		
		$this->lblFilter			= new \QCubed\Control\Label($this);
		$this->lblFilter->Text		= tr('Filter');
		
		$this->pnlFilter = self::ShowFilter();
		
		$this->btnNew				= new \QCubed\Project\Control\Button($this);
		$this->btnNew->Text			= tr('New Team');
		$this->btnNew->AddCssClass('btn btn-flat btn-default newbutton');
		$this->btnNew->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\Redirect('/?c=maintenance&a=teamedit'));
		
		$this->lstTeams							= new \TeamList($this);
		$this->lstTeams->CssClass				= 'teams_table table';
		$this->lstTeams->AddJavascriptRowAction('maintenance','teamedit');
		$this->lstTeams->CreateColumns();
		
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
