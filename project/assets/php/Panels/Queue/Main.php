<?php

namespace Hikify\Panels\Queue;

class Main extends \QCubed\Control\Panel {
	/** 
	 * 
	 * @var \Hikify\Panels\Job\Ubench 
	 */
	public $pnlUbench;
	/** 
	 * 
	 * @var \Hikify\Panels\Job\Informex 
	 */
	public $pnlInformex;
	/**
	 *
	 * @var \QCubed\Project\Control\Accordion
	 */
	public $pnlAccordion;
	
	public $arrPanels = array(
		'pnlUbench',
		'pnlInformex',
	);
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/panels/queue/main.tpl.php';
		$this->Build();
		
	}
	
	
	
	
	private function Build() {
		$this->pnlUbench		= new \Hikify\Panels\Job\Ubench($this);
		$this->pnlInformex		= new \Hikify\Panels\Job\Informex($this);
	}
	
	public function Accordion_Bind() {
		$this->pnlAccordion->DataSource = [$this->pnlUbench, $this->pnlInformex];		
	}	
	
	public function Accordion_Draw($objAccordion, $strPart, $objItem, $intIndex) {
		switch ($strPart) {
			case \QCubed\Bootstrap\Accordion::RENDER_HEADER:
				$objAccordion->RenderToggleHelper($objItem->GetAccordionHeader());
				break;
			case \QCubed\Bootstrap\Accordion::RENDER_BODY:
				$objItem->Render();
				break;
		}
	}
}


