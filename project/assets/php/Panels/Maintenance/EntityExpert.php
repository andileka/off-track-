<?php

namespace Hikify\Panels\Maintenance;

/**
 * @property EntityExpert
 */
class EntityExpert extends \QCubed\Control\Panel {	
	/*
	 * @var \Expert
	 */
	public $lstExpert;
	/**
	 *
	 * @var \QCubed\Control\Label 
	 */
	public $lblDay;
	private $strLabel;
	
	public function __construct($objParentObject, $strLabel) {
		parent::__construct($objParentObject);

		$this->strTemplate	= __TEMPLATES__ . '/panels/maintenance/entity-expert.tpl.php';
		$this->strLabel = $strLabel;
		$this->Build();
	}
	
	public function __get($strName) {
		switch($strName) {
			default:
				return parent::__get($strName);
		}
	}
	
	
	public function __set($strName, $strValue) {
		switch($strName) {
			default:
				return parent::__set($strName, $strValue);
		}
	}
	public function setEntityExpert($intEntity, $strDay){
		$objEntityExpert = \EntityExpert::loadByEntityAndDay($intEntity,$strDay);
		if(!$objEntityExpert) {
			return; //voorlopig niets doen, maar zou alle velden moeten clearen.
			//$this->Clear();
		}  
		$this->lstExpert->SelectedValue	= $objEntityExpert->ExpertId;
	}

	
	private function Build() {
		$this->lstExpert						= \Expert::GetListBox($this);
		$this->lstExpert->Required				= true;
		
		$this->lblDay							= new \QCubed\Control\Label($this);
		$this->lblDay->Name						= tr($this->strLabel);
	}
	
}
