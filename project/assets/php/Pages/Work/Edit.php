<?php

namespace Hikify\Pages\Work;

class Edit extends \QCubed\Control\Panel {
	/**
	 *
	 * @var \QCubed\Control\Label 
	 */
	public $lblTemp;
	
	
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/work/edit.tpl.php';
		$this->Build();
		
		
	}

	
	private function Build() {
		$this->lblTemp			= new \QCubed\Control\Label($this);
		$this->lblTemp->Text	= tr("Edit");
		
	}

	
}
