<?php

namespace Hikify\Pages\Help;

class Index extends \QCubed\Control\Panel {
	public $txtHelp;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/help/index.tpl.php';
		$this->Build();
		
	}
	private function Build() {	
		$this->txtHelp = new \QCubed\Control\Label($this);
		$this->txtHelp->Text = "Help page contents";
	}
}