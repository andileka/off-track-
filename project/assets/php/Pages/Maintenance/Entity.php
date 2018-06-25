<?php

namespace Hikify\Pages\Maintenance;

class Entity extends \QCubed\Control\Panel {

	public $lblFilter;
	/** @var \QCubed\Control\Panel */
	public $pnlIndex;
	public $pnlFilter;
	public $txtNumber;
	public $txtEntity;
	public $lstType;
	public $btnNew;
	/** @var \Entity */
	public $lstEntity;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/entity.tpl.php';
		$this->addCssFile("/project/assets/css/datatables.css");	
		$this->addJavascriptFile(__BOOTSTRAP_ADMINLTE_BOWER_COMPONENTS__."/datatables.net/js/jquery.dataTables.min.js");
		\QCubed\Project\Application::executeJavaScript("
				$(function () {
					$('.table').DataTable({
					  'paging'      : false,
					  'lengthChange': false,
					  'searching'   : false,
					  'ordering'    : true,
					  'info'        : false,
					  'autoWidth'   : true
					})
				  })");
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
		$this->btnNew->AddCssClass('btn btn-flat btn-default newbutton');
		$this->btnNew->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\Redirect('/?c=maintenance&a=entityedit'));
		
		$this->lstEntity								= new \EntityList($this);
		$this->lstEntity->CssClass						= 'table';
		$this->lstEntity->AddJavascriptRowAction('maintenance','entityedit');
		$this->lstEntity->CreateColumns();
		
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
