<?php

namespace Hikify\Panels\Maintenance;

/**
 * @property Address $Address Description
 */
class Address extends \QCubed\Control\Panel {
	
	public $lstCountry;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Autocomplete 
	 */
	public $txtCity;
	public $txtAddressStreet;
	public $txtAddressNumber;
	//public $btnSave;
	
	/**
	 *
	 * @var \Address 
	 */
	private $objAddress;
	
	private $strTitle;
	
	public function __construct($objParentObject, $strTitle) {
		parent::__construct($objParentObject, null);

		$this->strTemplate	= __TEMPLATES__ . '/panels/maintenance/address.tpl.php';
		$this->objAddress	= new \Address();
		$this->strTitle		= $strTitle;
		$this->Build();
	}
	
	public function __get($strName) {
		switch($strName) {
			case 'Address':
				return $this->objAddress->Id ? $this->objAddress : null;
			default:
				return parent::__get($strName);
		}
	}
	
	public function __set($strName, $mixValue) {
		switch($strName) {
			case 'Address':
				return $this->SetAddress($mixValue);
			default:
				return parent::__set($strName, $mixValue);
		}
	}
	
	public function Clear(){
		$this->lstCountry->SelectedValue		= null;
		$this->txtCity->Text					= "";
		$this->txtCity->SelectedId				= "";
		$this->txtAddressStreet->Text           = "";
		$this->txtAddressNumber->Text           = "";
		$this->objAddress						= new \Address;
	}

	/**
	 * this makes sure that the country ID is set on the txtCity, so it can correctly autofill
	 */
	public function lstCountry_Changed() {
		$this->txtCity->setCustomAttribute("country_id", $this->lstCountry->SelectedValue);		
	}
	
	public function SetAddress(\Address $objAddress=null) {
		if($objAddress && $objAddress->Id) {
			$this->lstCountry->SelectedValue		= $objAddress->City->CountryId;
			$this->txtCity->Text					= (string)$objAddress->City;
			$this->txtCity->SelectedId				= $objAddress->CityId;
			$this->txtAddressStreet->Text           = $objAddress->Street;
			$this->txtAddressNumber->Text           = $objAddress->Nr;
			$this->objAddress						= $objAddress;			
		}
	}
	public function SetViesData($data){
		preg_match('/\d+/',$data->City,$Zipcode);
		preg_match('/\d+/',$data->Street,$streetNumber);
		
		$countryId									= \Country::loadByCode($data->Country)->Id;
		$cityId										= \City::LoadSingleByNameOrZipcodeAndCountryId($Zipcode[0], $countryId);
		
		
		
		if($cityId && $countryId){
			$this->txtCity->Text						= trim($data->City);
			$this->txtCity->SelectedId					= $cityId->Id;
			$this->txtAddressStreet->Text				= str_replace($streetNumber[0],'',$data->Street);
			$this->txtAddressNumber->Text				= $streetNumber[0];
			$this->lstCountry->SelectedValue			= $countryId;
			
		}
		
		
	}
	public function GetAccordionHeader() {
		if($this->objAddress->Id) {
			return $this->strTitle . ': '. $this->objAddress;
		} else {
			return $this->strTitle;
		}		
	}
        
	public function Save(){
		if($this->Validate()) {
			
			$this->objAddress->Street   = $this->txtAddressStreet->Text;
			$this->objAddress->Nr       = $this->txtAddressNumber->Text;
			$this->objAddress->CityId   = $this->txtCity->SelectedId;
			$this->objAddress->Save();
			
			$this->Trigger('OnSave',[$this->objAddress]);
		}
		
		
	}
	
	public function Validate() {
		return ($this->txtAddressStreet->Text && $this->txtAddressNumber->Text && $this->txtCity->SelectedId);
	}
	
	private function Build() {
		
		$this->lstCountry			= \Country::GetListBox($this);
		$this->lstCountry->Name = tr('Country');
		$this->lstCountry->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'lstCountry_Changed'));
		$this->lstCountry->Required	=true;
				
		$this->txtCity					= \City::GetAutocompleteTextBox($this,'City::GetCitiesAsListItems');
		$this->txtCity->Name = tr('City');
		$this->txtCity->Required		= true;
		
		$this->lstCountry_changed();
		
		$this->txtAddressStreet = new \QCubed\Project\Control\TextBox($this);
		$this->txtAddressStreet->Name = tr('Street');
		$this->txtAddressStreet->Required=true;
		
		$this->txtAddressNumber = new \QCubed\Project\Control\TextBox($this);
		$this->txtAddressNumber->Name = tr('Number');
		$this->txtAddressNumber->Required=true;
                
		//$this->btnSave							= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Address'));
		
	}
	
}
