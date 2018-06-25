<?php

namespace Hikify\Panels\Maintenance;

/**
 * @property Phone
 */
class Phone extends \QCubed\Control\Panel {	
	/**
	 *
	 * @var \EntityPhone 
	 */
	private $objEntityPhone;
	/*
	 * @var \EmailType
	 */
	public $lstType;
	/*
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtNr;
	/*
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtContact;
	
	private $strTitle;
	/* SELECT DEFAULT BELGIUM */
	private $COUNTRYCODE = "BE";
	public function __construct($objParentObject) {
		parent::__construct($objParentObject);

		$this->strTemplate	= __TEMPLATES__ . '/panels/maintenance/phone.tpl.php';
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
	public function setEntityPhone(\EntityPhone $objEntityPhone=null){
		if(!$objEntityPhone) {
			return; //voorlopig niets doen, maar zou alle velden moeten clearen.
			//$this->Clear();
		}  
		$CountryPhone  = \Country::loadByCode($this->COUNTRYCODE);
		$this->txtNr->Text				= \Hikify\Helpers\Convert::toHumanReadablePhoneNumber($objEntityPhone->Nr,$CountryPhone);
		$this->lstType->SelectedValue	= $objEntityPhone->TypeId;
		$this->txtContact->Text			= $objEntityPhone->Contact;
		$this->objEntityPhone			= $objEntityPhone;
	}

	public function Save(\Entity $objEntity){
		if($objEntity->Address){
			$this->COUNTRYCODE = $objEntity->Address->City->Country->IsoCode;
		}
		$CountryPhone  = \Country::loadByCode($this->COUNTRYCODE);
		
		if($this->ShouldLineBeSaved()) {
			if(!$this->objEntityPhone) {
				$this->objEntityPhone = new \EntityPhone();
				$this->objEntityPhone->Entity = $objEntity;
			}
			/* replace all non numeric characters */
			/* load countrycode */
			$phone = \Hikify\Helpers\Convert::capture_phonenumbers($this->txtNr->Text, $CountryPhone);
			$this->objEntityPhone->Nr		= $phone;
			$this->objEntityPhone->TypeId	= $this->lstType->SelectedValue;
			$this->objEntityPhone->Contact	= $this->txtContact->Text;
			$this->objEntityPhone->Save();
		}
		
		
	}
	
	public function ShouldLineBeSaved() {
		return ($this->lstType->SelectedValue && $this->txtNr->Text);
	}
	
	private function Build() {
		$this->lstType							= \PhoneType::GetListBox($this);
		$this->lstType->addCssClass('form-control');
		$this->lstType->blnUseWrapper = false;
		$this->lstType->Required				= true;
		
		$this->txtNr							= new \QCubed\Project\Control\TextBox($this);
		$this->txtNr->blnUseWrapper = false;
		$this->txtNr->addCssClass('form-control');
		
		$this->txtContact						= new \QCubed\Project\Control\TextBox($this);
		$this->txtContact->blnUseWrapper		= false;
		$this->txtContact->addCssClass('form-control');
	}
	
}
