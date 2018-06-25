<?php

namespace Hikify\Pages\Maintenance;

class Templates extends \QCubed\Control\Panel {

	/** @var \QCubed\Control\Panel */
	public $pnlIndex;
	public $txtNumber;
	public $txtEntity;
	public $lstType;
	public $btnNew;
	/** @var \CommunicationTemplate */
	public $lstTemplates;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/templates.tpl.php';
		$this->addCssFile("/project/assets/css/datatables.css");
		$this->Build();
		
	}
	
	private function Build() {		
		$this->pnlIndex									= new \QCubed\Control\Panel($this);
		$this->pnlIndex->Text							= tr('Documents page');
		
		$this->btnNew									= new \QCubed\Project\Control\Button($this);
		$this->btnNew->Text								= tr('New Document');
		$this->btnNew->AddCssClass('btn btn-flat btn-default newbutton');
		$this->btnNew->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\Redirect('/?c=maintenance&a=templatesedit'));
		
		//$this->lstEntityType							= new \QCubed\Control\Panel($this);
		$this->lstTemplates							= new \CommunicationTemplateList($this);
		$this->lstTemplates->createColumns();
		$this->lstTemplates->CssClass					= 'entitytype_table table';
		$this->lstTemplates->AddJavascriptRowAction('maintenance','templatesedit');
		
	}

}
