<?php

namespace Hikify\Pages\Maintenance;

class Config extends \QCubed\Control\Panel {

	/**
	 *
	 * @var \ConfigList
	 */
	public $dgConfig;
	/**
	 *
	 * @var \QCubed\Project\Control\Button 
	 */
	public $btnNew;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/config.tpl.php';
		$this->Build();
		
	}
	
	private function Build() {		
		$this->dgConfig = new \ConfigList($this);
		$this->dgConfig->createColumns();
		$this->dgConfig->CssClass	= 'config_table table';
//		$this->dgConfig->AddJavascriptRowAction('maintenance','configedit');
		
		$this->btnNew									= new \QCubed\Project\Control\Button($this);
		$this->btnNew->Text								= tr('New config');
		$this->btnNew->AddCssClass('btn btn-flat btn-default newbutton');
		$this->btnNew->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\Redirect('/?c=maintenance&a=configedit'));
		
		
	}
	
}
