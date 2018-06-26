<?php

namespace Hikify\Panels\Job;
use QCubed\Bootstrap\Bootstrap;
// do not confuse this class with EntityRole! It is only displayed in the Entity Editor (see wireframes)
class Entity extends \QCubed\Project\Control\Editor {
	
	/**
	 *
	 * @var \Entity 
	 */
	private $objEntity;
	
	
	/** @var \QCubed\Project\Control\BooleanButton */
	public $blnLegaltype;
	/**
	 * 
	 * @var \QCubed\Project\Jqui\Autocomplete
	 */
	public $txtSearch;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtCompanyName;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtCompanyType;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtCompanyNumber;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtFirstname;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtLastname;
	/**
	 *
	 * @var \QCubed\Project\Control\BooleanButton 
	 */
	public $lstSex;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstType;
	/**
	 *
	 * @var \QCubed\Project\Control\Button 
	 */
	public $btnSave;	
	/**
	 *
	 * @var \QCubed\Bootstrap\Nav 
	 */
	public $navEntity;
	/**
	 *
	 * @var \Hikify\Panels\Maintenance\Address 
	 */
	public $pnlHome;
	/**
	 *
	 * @var \Hikify\Panels\Maintenance\Address 
	 */
	public $pnlVisiting;
	/**
	 *
	 * @var \Hikify\Panels\Maintenance\Address 
	 */
	public $pnlPostal;
	/**
	 *
	 * @var \Hikify\Panels\Maintenance\Address 
	 */
	public $pnlInvoice;
	/**
	 *
	 * @var \QCubed\Control\Panel
	 */
	public $pnlPhone;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlEmail;
	/**
	 *
	 * @var \QCubed\Control\Panel 
	 */
	public $pnlNotification;
	/**
	 *
	 * @var \QCubed\Bootstrap\Accordion
	 */
	public $pnlAccordion;
	
	/*
	 * @var \QCubed\Project\Control\Button
	 */
	public $btnAddfieldEmail;
	
	/*
	 * @var \QCubed\Project\Control\Button
	 */
	public $btnAddfieldPhone;
	/**
	 *
	 * @var \QCubed\Control\Panel
	 */
	public $pnlCustomfields;
	/**
	 *
	 * @var \QCubed\Project\Control\Button 
	 */
	public $btnCheckVies;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstCompanyCountry;
	/**
	 *
	 * @var \QCubed\Project\Jqui\StarRating 
	 */
	public $rtStars;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstLang;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtProfession;
	public $ArrCustomFields= [];
	public $SelectedEntityType;
	/**
	 *
	 * @var \Hikify\Panels\Maintenance\Email[]
	 */
	private $arrEmailPanels=array();
	/**
	 *
	 * @var \Hikify\Panels\Maintenance\Phone[]
	 */
	private $arrPhonePanels=array();
	private $MAX_RATING = 5;
	private $CURRENT_RATING = 0;
	/* 
	 * Add variable numberOfClicks to check if the editbutton is clicked once or multiple times, when you click the first time the function Draw rating will be called
	 * This is the only time when the function is called
	 * Fix 05/03/2018 Only one line for rating, this will fix the problem, everytime you clicked on the edit button it called the Drawrating function.
	 */	
	private $numberOfClicks = 0; 
	/* MODULE ENTITY => CUSTOM FIELDS */
	const CUSTOM_FIELD_TYPE = "entity"; 
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/panels/job/entity.tpl.php';
		$this->objEntity			= new \Entity;
		$this->Build();
		$this->HideAllFields();
	}
	
	public function Show(\Entity $objEntity=null, $lstSelectedValue=null) {
		$this->SelectedEntityType = $lstSelectedValue;
		$this->SetEntity($objEntity);
		$this->Display = true;
	}
	
	public function blnLegaltype_changed(){
		$this->HideAllFields(false);
		if($this->blnLegaltype->Value == \Entity::LEGALTYPE_PRIVATE){
			$this->ShowPrivateFields();
			$this->Accordion_Bind();	
		}else{
			$this->ShowCompanyFields();
			$this->Accordion_Bind();
		}		
	}
	public function EntitySelected(){
		if($this->txtSearch->SelectedValue != -1){
			$this->SetEntity(\Entity::Load((int) $this->txtSearch->Value));
			$this->Save();
		}else{
			$this->lstType->SelectedValue		= $this->SelectedEntityType;
			$this->ClearFields();
			$this->txtSearch->Display	= false;
			$this->blnModified = true;
		}
		
	}
	public function HideNotification(){
		$this->pnlNotification->Display =false;
	}
	public function ClearFields(){
		$this->HideAllFields(false);
		$this->blnLegaltype->SelectedValue		= \Entity::LEGALTYPE_LEGAL;	
		$this->lstType->SelectedValue			= ($this->SelectedEntityType) ? $this->SelectedEntityType : null;
		$this->txtCompanyName->Text				= "";
		$this->txtCompanyNumber->Text			= "";
		$this->txtCompanyType->Text				= "";
		$this->txtFirstname->Text				= "";
		$this->txtLastname->Text				= "";
		$this->pnlHome->Clear();
		$this->pnlInvoice->Clear();
		$this->pnlVisiting->Clear();
		$this->Accordion_Bind();
		
		$this->txtSearch->Text					= "";
	}
	
	public function SetEntity(\Entity $objEntity=null) {
		
		if(!$objEntity) {
			$this->pnlNotification->Display = false;
			return;
		}
		$this->objEntity						= $objEntity;
		
		$this->blnLegaltype->SelectedValue		= $objEntity->LegalType;
		$this->lstType->SelectedValue			= ($this->SelectedEntityType) ? $this->SelectedEntityType : $objEntity->TypeId;
		$this->txtCompanyName->Text				= $objEntity->CompanyName;
		$this->txtCompanyNumber->Text			= $objEntity->CompanyNr;
		$this->txtCompanyType->Text				= $objEntity->CompanyType;
		$this->txtFirstname->Text				= $objEntity->FirstName;
		$this->txtLastname->Text				= $objEntity->LastName;
		$this->lstSex->SelectedValue			= $objEntity->Sex;
		$this->lstLang->SelectedValue			= $objEntity->Language;
		$this->txtProfession->Text				= $objEntity->Profession;
		
		$this->pnlHome->SetAddress($this->objEntity->HomeAddress);
		$this->pnlPostal->SetAddress($this->objEntity->PostalAddress);
		$this->pnlInvoice->SetAddress($this->objEntity->InvoiceAddress);
		$this->pnlVisiting->SetAddress($this->objEntity->VisitingAddress);
		$this->blnLegaltype_changed();
		
		$this->CURRENT_RATING = $objEntity->Rating;
		$this->rtStars->buildRatingItem($this->CURRENT_RATING,$this->MAX_RATING);
		$this->rtStars->Draw();
		
		/* Add mail */
		$arrMail = \EntityEmail::LoadArrayByEntityId($this->objEntity->Id);
		foreach($arrMail as $entityEmail){
			$this->AddToEmailPanel($entityEmail);
		}
		/* Add phone */
		$arrPhone = \EntityPhone::LoadArrayByEntityId($this->objEntity->Id);
		foreach($arrPhone as $entityPhone){
			$this->AddToPhonePanel($entityPhone);
		}
		
		$this->SetReadOnlyFields(true);
		$this->SetCustomFields();
		
	}
	/* DUNNO OLD CODE */
	public function Accordion_Bind() {
		if($this->blnLegaltype->SelectedValue == \Entity::LEGALTYPE_LEGAL){
//			$this->pnlAccordion->DataSource = [$this->pnlHome, $this->pnlPostal, $this->pnlInvoice, $this->pnlVisiting];
		}else{
//			$this->pnlAccordion->DataSource = [$this->pnlHome, $this->pnlPostal, $this->pnlInvoice];
		}
			
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
	public function btnAddfieldEmail_Clicked(){
		$this->AddToEmailPanel();
	}
	
	public function btnAddfieldPhone_Clicked(){
		$this->AddToPhonePanel();
	}
	public function Validate(){
		if(($this->blnLegaltype && $this->txtFirstname->Text && $this->txtLastname->Text && $this->lstType->SelectedValue) || ($this->blnLegaltype && $this->txtCompanyName->Text && $this->txtCompanyNumber->Text && $this->lstType->SelectedValue) ){
			return true;
		}
	}
	public function Save(){
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT A VALID FORM');
			$this->txtFirstname->addCssClass("has-error");
			$this->txtLastname->addCssClass("has-error");
			$this->txtCompanyName->addCssClass("has-error");
			$this->txtCompanyNumber->addCssClass("has-error");
			$this->lstType->addCssClass("has-error");
			$this->lstLang->addCssClass("has-error");
			return;
		}else{
			/* remove validation errors*/
			$this->txtFirstname->removeCssClass("has-error");
			$this->txtLastname->removeCssClass("has-error");
			$this->txtCompanyName->removeCssClass("has-error");
			$this->txtCompanyNumber->removeCssClass("has-error");
			$this->lstType->removeCssClass("has-error");
			$this->lstLang->removeCssClass("has-error");
			
		}
		
		if(!$this->objEntity) {
			$this->objEntity = new \Entity();
		}
		$this->objEntity->LegalType		= $this->blnLegaltype->SelectedValue;
		$this->objEntity->TypeId        = $this->lstType->SelectedValue;
		$this->objEntity->CompanyName	= $this->txtCompanyName->Text;
		$this->objEntity->CompanyNr		= $this->txtCompanyNumber->Text;
		$this->objEntity->CompanyType   = $this->txtCompanyType->Text;
		$this->objEntity->FirstName		= $this->txtFirstname->Text;
		$this->objEntity->LastName		= $this->txtLastname->Text;
		$this->objEntity->Sex			= $this->lstSex->SelectedValue;
		$this->objEntity->Profession	= $this->txtProfession->Text;
		$this->objEntity->Rating		= $this->rtStars->getCustomAttribute("value");
		$this->objEntity->Language		= $this->lstLang->SelectedValue;
		
		$this->pnlHome->Save();
		$this->pnlPostal->Save();
		$this->pnlInvoice->Save();
		$this->pnlVisiting->Save();
		
		if($this->blnLegaltype->SelectedValue == \Entity::LEGALTYPE_LEGAL	){
			$this->pnlVisiting->Save();
			$this->objEntity->VisitingAddress		= $this->pnlVisiting->Address;
		}
		
		$this->objEntity->HomeAddress				= $this->pnlHome->Address;
		$this->objEntity->PostalAddress				= $this->pnlPostal->Address;
		$this->objEntity->InvoiceAddress			= $this->pnlInvoice->Address;
		$this->objEntity->VisitingAddress			= $this->pnlVisiting->Address;
		
		$this->objEntity->Save();
		
		foreach($this->arrEmailPanels as $emailpanel) {
			$emailpanel->Save($this->objEntity);
		}
				
		foreach($this->arrPhonePanels as $phonepanel) {
			$phonepanel->Save($this->objEntity);
		}
		
		foreach($this->ArrCustomFields as $customField){
		   \CustomFieldType::SaveCustomField($customField, $this::CUSTOM_FIELD_TYPE, $intJobId=null, $intVehicleId=null, $this->objEntity->Id, $intAppointmentId=null);	
		}
		
		$this->Trigger('OnSave',[$this->objEntity]);
		
	}
		
	
	public function lstChangedEntityType(){
		/* DISPLAY WEEKSCHEDULE ONLY IN MAINTENANCE */
		$this->Trigger("OnTypeChanged", array($this->lstType->SelectedValue));
	}
	public function bln_unlock($blnShow=true){
		$this->SetReadOnlyFields(false);
		$this->HideSearch(true);
		$this->HideAllFields(false);
		$this->pnlNotification->Text			= "<p><i class='fa fa-unlock-alt' aria-hidden='true'></i> ".tr('Unlocked')."</p>";
		$this->pnlNotification->Display			= false;
		
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
			\CustomField::SetCustomFields($customField, $this::CUSTOM_FIELD_TYPE, $intJobId=null, $intVehicleId=null, $this->objEntity->Id, $intAppointmentId=null);
		}
	}
	public function RatingSelected(){
		$this->rtStars->setCustomAttribute("value", $this->rtStars->SelectedValue);
		$this->rtStars->rebuild($this->rtStars->SelectedValue,$this->MAX_RATING);
	}
	public function searchVatInformation_click(){
		$ViesData = \Hikify\Helpers\ViesCheck::GetViesData($this->lstCompanyCountry->SelectedValue,$this->txtCompanyNumber->Text);
		if($ViesData){
			$this->blnLegaltype->SelectedValue	= \Entity::LEGALTYPE_LEGAL;
			$this->txtCompanyName->Text			= $ViesData->Name;	
			$this->Accordion_Bind();
			$this->pnlVisiting->SetViesData($ViesData);
		}
	}
	public function SetReadOnlyFields($blnReadOnly=true){
		$this->HideAllFields(!$blnReadOnly);
		$this->ReadOnly						= $blnReadOnly;
		$this->btnSave->Display				= !$blnReadOnly;
		$this->btnAddfieldEmail->Display	= !$blnReadOnly;
		$this->btnAddfieldPhone->Display	= !$blnReadOnly;
		if(!$blnReadOnly && $_GET["c"] !== "maintenance" && $this->numberOfClicks < 1){
			$this->numberOfClicks++;
			$this->rtStars->buildRatingItem($this->CURRENT_RATING,$this->MAX_RATING);
			$this->rtStars->Draw();
		}
		$this->HideSearch($blnReadOnly);
	}
	public function HideAllFields($blnHide=true){
		
		$this->blnLegaltype->Display		= !$blnHide;
		$this->lstType->Display				= !$blnHide;
		$this->txtCompanyName->Display		= !$blnHide;
		$this->txtCompanyType->Display		= !$blnHide;
		$this->txtCompanyNumber->Display	= !$blnHide;
		$this->btnCheckVies->Display		= !$blnHide;
		$this->lstCompanyCountry->Display	= !$blnHide;
		$this->rtStars->Display				= !$blnHide;
		$this->lstLang->Display				= !$blnHide;
		
		$this->txtFirstname->Display		= !$blnHide;
		$this->txtProfession->Display		= !$blnHide;
		$this->txtLastname->Display			= !$blnHide;
		$this->lstSex->Display				= !$blnHide;
		
		$this->btnAddfieldPhone->Display	= !$blnHide;
		$this->btnAddfieldEmail->Display	= !$blnHide;
		$this->pnlPhone->Display			= !$blnHide;
		$this->pnlEmail->Display			= !$blnHide;
		$this->pnlCustomfields->Display		= !$blnHide;
	}
	
	public function HideSaveButton(){
		$this->btnSave->Display				= false;
	}
	
	public function HideSearch($blnHide=true){
		$this->txtSearch->Display					= !$blnHide;
	}
	
	/**
	 * 
	 * @param \EntityEmail $objEntityEmail
	 * @return \Hikify\Panels\Maintenance\Email
	 */
	private function AddToEmailPanel(\EntityEmail $objEntityEmail=null) {
		$pnlEntityEmail = new \Hikify\Panels\Maintenance\Email($this->pnlEmail);
		$pnlEntityEmail->SetEntityEmail($objEntityEmail);
		$this->arrEmailPanels[] = $pnlEntityEmail;
		return $pnlEntityEmail;
	}
	
	/**
	 * 
	 * @param \EntityPhone $objEntityPhone
	 * @return \Hikify\Panels\Maintenance\Phone
	 */
	private function AddToPhonePanel(\EntityPhone $objEntityPhone=null){
		$pnlEntityPhone = new \Hikify\Panels\Maintenance\Phone($this->pnlPhone);
		$pnlEntityPhone->SetEntityPhone($objEntityPhone);
		$this->arrPhonePanels[] = $pnlEntityPhone;
		return $pnlEntityPhone;
	}
	
	private function Build() {		
		/* Navigation */
		$this->navEntity = new \QCubed\Bootstrap\Nav($this);
		
		$this->pnlNotification						= new \QCubed\Control\Panel($this);
		$this->pnlNotification->AddCssClass("callout callout-warning ");
		$this->pnlNotification->Cursor				= 'pointer';
		$this->pnlNotification->Text				= "<p><i class='fa fa-lock' aria-hidden='true'></i> ".tr('Locked, to unlock click here')."</p>";
		$this->pnlNotification->AddAction(new \QCubed\Event\Click(),new \QCubed\Action\AjaxControl($this, 'bln_unlock'));
		
		$this->blnLegaltype							= \Entity::GetLegalTypeRadioButtonGroup($this);
		$this->blnLegaltype->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'blnLegaltype_changed'));
		$this->blnLegaltype->addCssClass("two-buttons");
		
		/* Default legal type*/
		$this->lstType								= \EntityType::GetListBox($this); 
		$this->lstType->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'lstChangedEntityType'));
		$this->lstType->Required					= true;
		$this->lstType->Name = tr('Role');
		$this->lstType->SelectedValue = 5;
		
		$this->lstLang								= new \QCubed\Project\Control\ListBox($this);
		$this->lstLang->Required					= true;
		$this->lstLang->Name = tr('Language');
		$this->lstLang->AddItem("NL", "nl");
		$this->lstLang->AddItem("FR", "fr");
		$this->lstLang->AddItem("EN", "en");
		$this->lstLang->AddItem("DE", "de");
			
		$this->rtStars	= new \QCubed\Project\Jqui\StarRating($this, $this->rtStars);
		$this->rtStars->addAction(new \QCubed\Project\Jqui\RatingSelected(), new \QCubed\Action\AjaxControl($this, "RatingSelected"));
		
		$this->txtSearch							= \Entity::GetAutocompleteTextBox($this, '\Entity::GetEntitysAsListItems', 'EntitySelected');
		$this->txtSearch->Name						= tr('Search entity');
		
		$this->lstCompanyCountry					= \Country::GetListBoxCodes($this);
		$this->lstCompanyCountry->AddCssClass('form-control');
		$this->txtCompanyNumber						= new \QCubed\Project\Control\TextBox($this);
		$this->txtCompanyNumber->Name		= tr('Company number');
		$this->txtCompanyNumber->AddCssClass('form-control');
		$this->txtCompanyNumber->Required			= true;
		
		$this->btnCheckVies							= \QCubed\Project\Control\Button::GetFontAwesomeButton($this, "", "fas fa-search-plus");
		$this->btnCheckVies->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "searchVatInformation_click"));
		
		$this->txtCompanyName						= new \QCubed\Project\Control\TextBox($this);
		$this->txtCompanyName->Name					= tr('Company name');
		$this->txtCompanyName->Required				= true;
		
		$this->txtCompanyType						= new \QCubed\Project\Control\TextBox($this);
		$this->txtCompanyType->Name					= tr('Company type');
		$this->txtCompanyType->Required				= true;
		
		$this->lstSex								= \Entity::GetGenderRadioButtonGroup($this);
		$this->lstSex->Name							= tr('Sex');
		$this->lstSex->addCssClass("three-buttons");
		
		$this->txtFirstname							= new \QCubed\Project\Control\TextBox($this);
		$this->txtFirstname->Name					= tr('Firstname');
		$this->txtFirstname->Required				= true;
		
		$this->txtLastname							= new \QCubed\Project\Control\TextBox($this);
		$this->txtLastname->Name					= tr('Lastname');
		$this->txtLastname->Required				= true;
		
		$this->txtProfession						= new \QCubed\Project\Control\TextBox($this);
		$this->txtProfession->Name					= tr('Profession');
		
		$this->pnlCustomfields								= new \QCubed\Control\Panel($this); 
		$this->pnlCustomfields	->PreferredRenderMethod		= "RenderFormGroup";
		$this->pnlCustomfields	->AutoRenderChildren		= true;
		
		$this->btnAddfieldPhone						=  \QCubed\Project\Control\Button::GetFontAwesomeButton($this,tr('Add Phone'),'fas fa-phone');
		$this->btnAddfieldPhone->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'btnAddfieldPhone_Clicked'));
		
		$this->btnAddfieldEmail						=  \QCubed\Project\Control\Button::GetFontAwesomeButton($this,tr('Add E-Mail'),'fas fa-envelope');
		$this->btnAddfieldEmail->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'btnAddfieldEmail_Clicked'));
		
		$this->pnlEmail								= new \QCubed\Control\Panel($this);
		$this->pnlEmail->AutoRenderChildren			= true;
		
		$this->pnlPhone								= new \QCubed\Control\Panel($this);
		$this->pnlPhone->AutoRenderChildren			= true;
		
		$this->pnlHome								= new \Hikify\Panels\Maintenance\Address($this, tr('Home address'));
		
		$this->pnlPostal							= new \Hikify\Panels\Maintenance\Address($this, tr('Postal address'));
		$this->pnlInvoice							= new \Hikify\Panels\Maintenance\Address($this, tr('Invoice address'));		
		$this->pnlVisiting							= new \Hikify\Panels\Maintenance\Address($this, tr('Visiting address'));
		
		$this->GetCustomFields();
		
		$this->btnSave								= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Entity'));
		$this->AddToEmailPanel();
		$this->AddToPhonePanel();
		/* Legal */
		$this->ShowCompanyFields();
		
	}
	
	private function ShowPrivateFields($blnShow=true) {
		$this->ShowCompanyFields(!$blnShow);
	}
	
	private function ShowCompanyFields($blnShow=true) {		
		$this->txtCompanyName->Visible		= $blnShow;
		$this->txtCompanyType->Visible		= $blnShow;
		$this->txtCompanyNumber->Visible	= $blnShow;
		$this->btnCheckVies->Visible		= $blnShow;
		$this->rtStars->Visible				= $blnShow;
		$this->lstCompanyCountry->Display	= $blnShow;
		
		/* Private */
		$this->txtProfession->Visible		= !$blnShow;
		$this->txtFirstname->Visible		= !$blnShow;
		$this->txtLastname->Visible			= !$blnShow;
		$this->lstSex->Visible				= !$blnShow;
	}
	
}

