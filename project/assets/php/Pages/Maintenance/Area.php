<?php

namespace Hikify\Pages\Maintenance;

class Area extends \QCubed\Control\Panel {

	/** @var \QCubed\Control\Panel */
	public $pnlIndex;
	/**
	 *
	 * @var \QCubed\Project\Control\Button 
	 */
	public $btnNew;
	/** @var \AreaList */
	public $ddgArea;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/area.tpl.php';
		$this->addCssFile("/project/assets/css/datatables.css");
		$this->Build();
		
	}
	public function OnAreaCopy_click(){
		\QCubed\Project\Application::Log("Click");
	}
	private function Build() {		
		$this->pnlIndex									= new \QCubed\Control\Panel($this);
		$this->pnlIndex->Text							= tr('Area page');
		
		$this->btnNew									= new \QCubed\Project\Control\Button($this);
		$this->btnNew->Text								= tr('New Expert area');
		$this->btnNew->AddCssClass('btn btn-flat btn-default newbutton');
		$this->btnNew->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\Redirect('/?c=maintenance&a=areaedit'));
		
		$this->ddgArea									= new \AreaList($this);
		$this->ddgArea->CssClass						= 'area_table table';
		$this->ddgArea->CreateColumns();
		$this->ddgArea->Register('OnAreaCopy','OnAreaCopy_click', $this);
		
	}
	
	
}
