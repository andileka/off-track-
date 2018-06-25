<?php

namespace Hikify\Panels\Maintenance;

/**
 * @property Address $Address Description
 */
class Closingdate extends \QCubed\Control\Panel {
	
	public $lstCountry;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Autocomplete 
	 */
	public $txtCity;
	public $txtAddressStreet;
	public $txtAddressNumber;
	public $strTitle;
	//public $btnSave;
	
	/**
	 *
	 * @var \EntityClosingday 
	 */
	private $objAddress;

	
	public function __construct($objParentObject, $strTitle=null) {
		parent::__construct($objParentObject, null);
		\QCubed\Project\Application::displayAlert("test");
		$this->strTemplate	= __TEMPLATES__ . '/panels/maintenance/entitydates.tpl.php';
	}
	
	private function Build() {
		/*
		$this->lstCountry			= \Country::GetListBox($this);
		$this->lstCountry->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'lstCountry_Changed'));
		$this->lstCountry->Required	=true;
				
		$this->txtCity					= \City::GetAutocompleteTextBox($this,'City::GetCitiesAsListItems');
		$this->txtCity->Required		= true;
		
		$this->lstCountry_changed();
		
		$this->txtAddressStreet = new \QCubed\Project\Control\TextBox($this);
		$this->txtAddressStreet->Name = tr('Street');
		$this->txtAddressStreet->Required=true;
		
		$this->txtAddressNumber = new \QCubed\Project\Control\TextBox($this);
		$this->txtAddressNumber->Name = tr('Number');
		$this->txtAddressNumber->Required=true;
                
		//$this->btnSave							= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Address'));
		*/
	}
	
}
