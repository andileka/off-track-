<?php

namespace Hikify\Pages\Maintenance;

class Relationsedit extends \QCubed\Control\Panel {

	public $lblFilter;
	/** @var \QCubed\Control\Panel */
	public $pnlIndex;
	public $pnlFilter;
	public $txtNumber;
	public $txtEntity;
	public $lstType;
	public $btnNew;
	/** @var \Relations */
	public $lstExpert;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/relations.tpl.php';
		$this->Build();
		
	}
	
	private function Build() {		
		$this->pnlIndex									= new \QCubed\Control\Panel($this);
		$this->pnlIndex->Text							= tr('Relations page');
		
		$this->lblFilter								= new \QCubed\Control\Label($this);
		$this->lblFilter->Text							= tr('Filter');
		
		$this->pnlFilter								= self::ShowFilter();
		
		$this->btnNew									= new \QCubed\Project\Control\Button($this);
		$this->btnNew->Text								= tr('New Role');
		$this->btnNew->AddCssClass('btn-default');
		$this->btnNew->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\Redirect('/?c=maintenance&a=relationseedit'));
		
		$this->lstExpert								= new \RelationRoleList($this);
		$this->lstExpert->CssClass						= 'relations_table table';
		$this->lstExpert->AddJavascriptRowAction('maintenance','relationseedit');
		$this->lstExpert->CreateColumns();
		
	}
	
	protected function ShowFilter(){
		$this->lblFilter				= new \QCubed\Control\Label($this);
		$this->lblFilter->Text			= tr('Filter');
		
		$this->txtNumber				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNumber->Placeholder	= tr('Number');
		
		$this->txtEntity				= new \QCubed\Project\Control\TextBox($this);
		$this->txtEntity->Placeholder	= tr('Relations');
		
		$this->lstType					= \Expert::GetListBox($this);
		
	}
	
}
