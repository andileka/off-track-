<?php

namespace Hikify\Pages\Maintenance;

class Entities extends \QCubed\Control\Panel {

	public $lblFilter;
	/** @var \QCubed\Control\Panel */
	public $pnlIndex;
	public $pnlFilter;
	public $txtNumber;
	public $txtEntity;
	public $lstType;
	public $btnNew;
	/** @var \EntityType */
	public $lstEntityType;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/entities.tpl.php';
		$this->Build();
		
	}
	
	private function Build() {		
		$this->pnlIndex									= new \QCubed\Control\Panel($this);
		$this->pnlIndex->Text							= tr('Entities page');
		
		$this->lblFilter								= new \QCubed\Control\Label($this);
		$this->lblFilter->Text							= tr('Filter');
		
		$this->pnlFilter								= self::ShowFilter();
		
		$this->btnNew									= new \QCubed\Project\Control\Button($this);
		$this->btnNew->Text								= tr('New Entity');
		$this->btnNew->AddCssClass('btn-default');
		$this->btnNew->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\Redirect('/?c=maintenance&a=entitiesedit'));
		
		$this->lstEntityType							= new \EntityTypeList($this);
		$this->lstEntityType->CssClass					= 'entitytype_table table';
		$this->lstEntityType->AddJavascriptRowAction('maintenance','entitiesedit');
		$this->lstEntityType->CreateColumns();
		
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
