<?php

namespace Hikify\Panels\Tourist;

class Detail extends \QCubed\Project\Control\Editor {
	
	/**
	 *
	 * @var \Tourist
	 */
	private $objTourist;


	/** @var ListBox */
	public $lstLanguage;
	
	/** @var \QCubed\Project\Control\ListBox */
	public $lstCity;
	/** @var \QCubed\Project\Control\ListBox */
	public $lstCountry;
	
	public $txtName;
	/** @var \QCubed\Project\Control\TextBox */
	public $txtContactinfo;

	public $btnSave;
	public $ArrCustomFields= []; 
	const CUSTOM_FIELD_TYPE = "job"; 
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/panels/tourist/detail.tpl.php';
		$this->Build();
		
	}
	
	public function SetTourist(\Tourist $objTourist=null) {
		if(!$objTourist) {
			return; 
		}
		$this->objTourist								= $objTourist;

		$this->lstCity->SelectedValue					= $objTourist->CityId;
		$this->lstCountry->SelectedValue				= $objTourist->CountryId;
		$this->lstLanguage->SelectedValue				= $objTourist->LanguageId;
		$this->txtName->Text							= $this->objTourist->Name;
		
		//$this->SetCustomFields();
		
	}

	public function Save() {
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT A VALID FORM');
			return;
		}
		if(!$this->objTourist) {
			$this->objTourist = new \Tourist();
		}

		$this->objTourist->CityId				= $this->lstCity->SelectedValue;
		$this->objTourist->CountryId			= $this->lstCountry->SelectedValue;
		$this->objTourist->LanguageId			= $this->lstLanguage->SelectedValue;
		$this->objTourist->Name					= $this->txtName->Text;
		
		$this->objTourist->save();
		/*
		foreach($this->ArrCustomFields as $customField){
		   \CustomFieldType::SaveCustomField($customField, $this::CUSTOM_FIELD_TYPE, $this->objTourist->Id, $intVehicleId=null, $intEntityId=null, $intAppointmentId=null);
		}*/
		
		$this->Trigger('OnSave',[$this->objTourist]);
	}
	
	public function GetAccordionHeader() {
		if($this->objTourist) {
			return tr('Tourist') .  (string)$this->objTourist;
		}
		return tr('Tourist');
	}
	
	public function GetCustomFields(){
		/* Load all custom fields for vehicle */
		$arrCustomFieldTypes = \CustomFieldType::loadArrayByContainer($this::CUSTOM_FIELD_TYPE);
		foreach($arrCustomFieldTypes as $objCustomfieldType){
			$this->ArrCustomFields[] = \CustomFieldType::CreateCustomField($this->pnlCustomfields, $objCustomfieldType);
		}
	}
	
	public function SetCustomFields(){
		/* Load all custom fields for vehicle */
		foreach($this->ArrCustomFields as $customField){
			\CustomField::SetCustomFields($customField, $this::CUSTOM_FIELD_TYPE, $this->objTourist);
		}
	}
	

	public function lstCountry_Changed() {
		\City::FillByCountryId($this->lstCity, $this->lstCountry->SelectedValue);
	}
	
	private function Build() {
		
		$this->lstCountry					= \Country::GetListBox($this);
		$this->lstCountry->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this,'lstCountry_Changed'));
		$this->lstCity						= \City::GetListBox($this, null);
		$this->lstLanguage					= \Language::GetListBox($this);


		$this->txtName						= new \QCubed\Project\Control\TextBox($this);
		$this->txtContactinfo				= new \QCubed\Project\Control\TextBox($this);
		$this->txtContactinfo->TextMode		= \QCubed\Project\Control\TextBox::MULTI_LINE;

		/* define customfield container */
//		$this->pnlCustomfields								= new \QCubed\Control\Panel($this);
//		$this->pnlCustomfields	->PreferredRenderMethod		= "RenderFormGroup";
//		$this->pnlCustomfields	->AutoRenderChildren		= true;
//
//		$this->GetCustomFields();





		
		$this->btnSave							= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save detail'));


		
	}
}
