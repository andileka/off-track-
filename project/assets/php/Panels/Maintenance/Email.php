<?php

namespace Hikify\Panels\Maintenance;

/**
 * @property Email
 */
class Email extends \QCubed\Control\Panel {	
	/**
	 *
	 * @var \EntityEmail 
	 */
	private $objEntityEmail;
	/*
	 * @var \EmailType
	 */
	public $lstType;
	/*
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtEmail;
	private $strTitle;
	
	public function __construct($objParentObject) {
		parent::__construct($objParentObject);

		$this->strTemplate	= __TEMPLATES__ . '/panels/maintenance/email.tpl.php';
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
	
	public function setEntityEmail(\EntityEmail $objEntityEmail=null){
		if(!$objEntityEmail) {
			return; //voorlopig niets doen, maar zou alle velden moeten clearen.
			//$this->Clear();
		}  
		$this->txtEmail->Text			= $objEntityEmail->Address;
		$this->lstType->SelectedValue	= $objEntityEmail->TypeId;
		$this->objEntityEmail			= $objEntityEmail;
	}

	public function Save(\Entity $objEntity){
		if($this->ShouldLineBeSaved()) {
			if(!$this->objEntityEmail) {
				$this->objEntityEmail = new \EntityEmail();
				$this->objEntityEmail->Entity = $objEntity;
			}
			
			$this->objEntityEmail->Address		= $this->txtEmail->Text;
			$this->objEntityEmail->TypeId		= $this->lstType->SelectedValue;
			$this->objEntityEmail->Save();
		}
		
		
	}
	
	public function ShouldLineBeSaved() {
		return ($this->lstType->SelectedValue && $this->txtEmail->Text);
	}
	
	private function Build() {
		$this->lstType							= \EmailType::GetListBox($this);
		$this->lstType->Required				= true;
		$this->lstType->addCssClass('form-control');
		$this->txtEmail							= new \QCubed\Project\Control\TextBox($this);
		$this->txtEmail->Name					= tr('Email');
		$this->txtEmail->addCssClass('form-control');
	}
	
}
