<?php

namespace Hikify\Pages\Maintenance;

/**
 * .@property-read int $EntityId Description
 */
class Areaedit extends \QCubed\Control\Panel {
	/**
	 *
	 * @var \QCubed\Bootstrap\Nav
	 */
	public $navArea;
	/**
	 *
	 * @var \Hikify\Panels\Maintenance\Areaedit
	 */
	public $pnlMain;
	/**
	 *
	 * \Hikify\Panels\Maintenance\Areaentity
	 */
	public $pnlEntity;
	/**
	 *
	 * \Hikify\Panels\Maintenance\Areaentity
	 */
	public $pnlExperts;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);

		$this->strTemplate = __TEMPLATES__ . '/pages/maintenance/area-edit.tpl.php';
		$this->addCssFile("/project/assets/css/datagrid.css");
		$this->Build();
		

		if (isset($_GET['id'])) {
			$this->pnlMain->SetArea($_GET['id']);		
			$this->pnlEntity->SetArea($_GET['id']);		
			$this->pnlExperts->SetArea($_GET['id']);		
		}
	}
	
	private function Build() {
		$this->navArea								= new \QCubed\Bootstrap\Nav($this);		
		
		$this->pnlMain								= new \Hikify\Panels\Maintenance\Areaedit($this->navArea);
		$this->pnlMain->Name						= tr("Main");
		$this->pnlMain->PreferredRenderMethod		= "RenderFormGroup";
		$this->pnlMain->AutoRenderChildren			= true;
		
		$this->pnlEntity							= new \Hikify\Panels\Maintenance\Areaentity($this->navArea);
		$this->pnlEntity->Name						= tr("Entity");
		$this->pnlEntity->PreferredRenderMethod		= "RenderFormGroup";
		$this->pnlEntity->AutoRenderChildren		= true;
		
		$this->pnlExperts							= new \Hikify\Panels\Maintenance\Areaexpert($this->navArea);
		$this->pnlExperts->Name						= tr("Expert");
		$this->pnlExperts->PreferredRenderMethod	= "RenderFormGroup";
		$this->pnlExperts->AutoRenderChildren		= true;
	}

}
