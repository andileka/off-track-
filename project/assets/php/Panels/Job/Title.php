<?php

namespace Hikify\Panels\Job;

class Title extends \QCubed\Control\Panel {
	public $strName;
	public $disable = false;
	
	public function __construct($objParentObject, $strControlId = null,$strName="Name") {
		parent::__construct($objParentObject, $strControlId);
		$this->strName	= $strName;
	}
	
	public function GetAccordionHeader() {
			return tr($this->strName);
	}
	
	public function Disable(){
		$this->disable = true;
	}
	
	public function GetDisabled(){
		return $this->disable;
	}
}
