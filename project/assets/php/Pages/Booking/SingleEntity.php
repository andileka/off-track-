<?php

namespace Hikify\Pages\Booking;

class SingleEntity extends \QCubed\Control\Panel {
	
	/** @var \QCubed\Project\Control\BooleanButton */
	public $blnLegaltype;
	/**
	 *
	 * @var \QCubed\Bootstrap\Label 
	 */
	public $lblEntity;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtName;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtCompanyNumber;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtTypeId;
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
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtStreet;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtNumber;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtEmail;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtPhone;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Autocomplete 
	 */
	public $txtCity;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstCountry;
	/**
	 *
	 * @var \QCubed\Project\Control\Checkbox
	 */
	public $chkSelect;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/booking/singleentity.tpl.php';
		\QCubed\Project\Application::executeJavaScript('
														var height = $(".wrapper").outerHeight();
														$(".content-wrapper").css("min-height",height+"px");
														$(".content-wrapper").css("height",height+"px")
													');
		$this->addJavascriptFile("/project/assets/js/booking.js");
		$this->Build();
		
		
	}
	/**
	 * this makes sure that the country ID is set on the txtCity, so it can correctly autofill
	 */
	public function lstCountry_Changed() {
		$this->txtCity->setCustomAttribute("country_id", $this->lstCountry->SelectedValue);		
	}
	
	public function SetEntity($strName, $strTypeId, \EntityJob $objEntity = null){
		
		/** DEFAULT **/
		$this->lblEntity->Text		= $strName;
//		$this->ShowCompanyFields(true);
		$this->blnLegaltype->SelectedValue	= \Entity::LEGALTYPE_PRIVATE;
		$this->txtTypeId->Text				= $strTypeId;
		
		if($objEntity){
			if($objEntity->Entity->LegalType == \Entity::LEGALTYPE_LEGAL){
				\QCubed\Project\Application::executeJavaScript("Booking.ShowCompanyFields('".$this->ControlId."')");
			}else{
				\QCubed\Project\Application::executeJavaScript("Booking.ShowPrivateFields('".$this->ControlId."')");
			}
			$objEntityMail						= \EntityEmail::loadEntityEmailWorkAddress($objEntity->EntityId);
			$objEntityPhone						= \EntityPhone::loadEntityPhoneWorkNumber($objEntity->EntityId);
			
			$this->txtName->Text				= $objEntity->Entity->CompanyName;
			$this->txtStreet->Text				= $objEntity->Entity->Address->Street;
			$this->txtNumber->Text				= $objEntity->Entity->Address->Nr;
			$this->blnLegaltype->SelectedValue	= $objEntity->Entity->LegalType;
			$this->txtFirstname->Text			= $objEntity->Entity->FirstName;
			$this->txtLastname->Text			= $objEntity->Entity->LastName;
			$this->txtCompanyNumber->Text		= $objEntity->Entity->CompanyNr;
			$this->txtCity->SelectedId			= $objEntity->Entity->Address->CityId;
			$this->txtCity->Text				= $objEntity->Entity->Address->City;
			
			if($objEntityMail){
				$this->txtEmail->Text			= $objEntityMail->Address;
			}
			if($objEntityPhone){
				$this->txtPhone->Text			= $objEntityPhone->Nr;
			}
			
		}else{
			\QCubed\Project\Application::executeJavaScript("Booking.ShowPrivateFields('".$this->ControlId."')");
		}
		
	}
	public function blnLegaltype_changed(){
//		$this->ShowCompanyFields(false);
		
		if($this->blnLegaltype->SelectedValue == \Entity::LEGALTYPE_LEGAL){
			\QCubed\Project\Application::executeJavaScript("Booking.ShowCompanyFields('".$this->ControlId."')");
		}else{
			\QCubed\Project\Application::executeJavaScript("Booking.ShowPrivateFields('".$this->ControlId."')");
		}
	}
	
	public function Save($objJob=null){	
		if($this->chkSelect->Checked){
			if($this->Validate()){
				// CHECK IF SELECTED ENTITY IS KNOWN IN DB 				
				$objEntity = $this->SaveEntity($objJob);
				$this->Trigger('onSave',[$objEntity]);
			}
		}else{
			if($this->Validate()){
				// CHECK IF SELECTED ENTITY IS KNOWN IN DB 				
				$objEntity = $this->SaveEntity($objJob);
			}
		}
		
		
		
	}
	public function SaveEntity($objJob=null){
		$objEntity = $this->GetEntity();
		if(!$objEntity){
			/** CHECK IF ADDRESS EXISTS **/
			
			$objAddress = $this->GetAddress();

			$objEntity						= new \Entity();
			$objEntity->FirstName			= $this->txtFirstname->Text;
			$objEntity->LastName			= $this->txtLastname->Text;
			$objEntity->CompanyName			= $this->txtName->Text;
			$objEntity->CompanyNr			= $this->txtCompanyNumber->Text;
			$objEntity->LegalType			= $this->blnLegaltype->SelectedValue;
			$objEntity->VisitingAddressId	= $objAddress->Id;
			$objEntity->TypeId				= $this->txtTypeId->Text;
			$objEntity->Language			= 'nl';
			$objEntity->Save();

		}
		if($objEntity){
			$this->CheckEmail($objEntity->Id);
			$this->CheckPhone($objEntity->Id);
		}
		if($objJob){				
			$this->SetEntityJob($objJob->Id, $objEntity->Id);
		}
		
		return $objEntity;
	}
	public function Validate(){		
		$errorArr = [$this->txtCity->ControlId, $this->txtPhone->ControlId, $this->txtNumber->ControlId, $this->txtStreet->ControlId];
		if($this->txtCity->SelectedId &&  $this->txtPhone->Text && $this->txtNumber->Text && $this->txtStreet->Text){
			\QCubed\Project\Application::executeJavaScript("Booking.RemoveError('".json_encode($errorArr)."')");
			return true;
		}else{
				if($this->txtCity->SelectedId == ""){
					\QCubed\Project\Application::executeJavaScript("$('#'+'".$this->txtCity->ControlId."').val('')");
					$this->txtCity->Text = null;
				}
				\QCubed\Project\Application::executeJavaScript("Booking.ShowError('".json_encode($errorArr)."')");
//				$this->Trigger('onValidate',[]);			
		}
	}
	public function SetEntityJob($intJobId, $intEntityId){
		$objJobEntity					= \EntityJob::loadByRoleIdJobId($this->txtTypeId->Text, $intJobId);
				
		if(!$objJobEntity){
			$objJobEntity				= new \EntityJob();
			$objJobEntity->EntityId		= $intEntityId;
			$objJobEntity->JobId		= $intJobId;
			$objJobEntity->RoleId		= $this->txtTypeId->Text;
			$objJobEntity->Save();
		}
		
		return $objJobEntity;
	}
	public function CheckEmail($intEntityId){
		$objMail						= \EntityEmail::loadEntityEmailWorkAddress($intEntityId);
		if(!$objMail){
			$objMail					= new \EntityEmail();
			$objMail->TypeId			= 1;
			$objMail->EntityId			= $intEntityId;
			$objMail->Address			= $this->txtEmail->Text;
			$objMail->Save();
		}
		
		return $objMail;
	}
	public function CheckPhone($intEntityId){
		$objPhone						= \EntityPhone::loadEntityPhoneWorkNumber($intEntityId);
		
		if(!$objPhone){
			$objPhone					= new \EntityPhone();
			$objPhone->TypeId			= 2;
			$objPhone->EntityId			= $intEntityId;
			$objPhone->Nr				= $this->txtPhone->Text;
			$objPhone->Save();
		}

		return $objPhone;
	}
	public function GetEntity(){
		if($this->blnLegaltype->SelectedValue == \Entity::LEGALTYPE_LEGAL){
			$objEntity = \Entity::loadByCompany($this->txtName->Text);
		}else{
			$objEntity = \Entity::loadByName($this->txtFirstname->Text,$this->txtLastname->Text);
		}
		
		return $objEntity;
	}
	public function GetAddress(){
		$objAddress						= \Address::loadByStreetNumberCity($this->txtStreet->Text,$this->txtNumber->Text, $this->txtCity->SelectedId );
			if(!$objAddress){
				$objAddress						= new \Address();
				$objAddress->Street				= $this->txtStreet->Text;
				$objAddress->Nr					= $this->txtNumber->Text;
				$objAddress->CityId				= $this->txtCity->SelectedId;
				$objAddress->save();
			}
			
			return $objAddress;
	}

	private function Build() {
		$this->lblEntity					= new \QCubed\Bootstrap\Label($this);
		
		$this->txtCompanyNumber						= new \QCubed\Project\Control\TextBox($this);
		$this->txtCompanyNumber->Placeholder		= tr('Company number');
		$this->txtCompanyNumber->addWrapperCssClass("input-group companyField");
		$this->txtCompanyNumber->Required			= true;
		$this->txtCompanyNumber->HtmlBefore	= "<span class='input-group-addon'><i class='fas fa-building'></i></span>";
		
		$this->txtName						= new \QCubed\Project\Control\TextBox($this);
		$this->txtName->Placeholder			= tr("Companyname");
		$this->txtName->Required			= true;
		$this->txtName->addWrapperCssClass("input-group companyField");
		$this->txtName->HtmlBefore	= "<span class='input-group-addon'><i class='fas fa-building'></i></span>";
		
		$this->txtFirstname						= new \QCubed\Project\Control\TextBox($this);
		$this->txtFirstname->Placeholder		= tr("Firstname");
		$this->txtFirstname->Required			= true;
		$this->txtFirstname->addWrapperCssClass("input-group privateField");
		$this->txtFirstname->HtmlBefore			= "<span class='input-group-addon'><i class='fas fa-user'></i></span>";
		
		$this->txtLastname						= new \QCubed\Project\Control\TextBox($this);
		$this->txtLastname->Placeholder		= tr("Lastname");
		$this->txtLastname->Required			= false;
		$this->txtLastname->addWrapperCssClass("input-group privateField");
		$this->txtLastname->HtmlBefore			= "<span class='input-group-addon'><i class='fas fa-user'></i></span>";
		
		$this->txtPhone						= new \QCubed\Project\Control\TextBox($this);
		$this->txtPhone->Placeholder		= tr("Phone");
		$this->txtPhone->Required			= true;
		$this->txtPhone->addWrapperCssClass("input-group");
		$this->txtPhone->HtmlBefore	= "<span class='input-group-addon'><i class='fas fa-phone'></i></span>";
		
		$this->txtEmail						= new \QCubed\Project\Control\TextBox($this);
		$this->txtEmail->Placeholder		= tr("Email");
		$this->txtEmail->Required			= true;
		$this->txtEmail->addWrapperCssClass("input-group");
		$this->txtEmail->HtmlBefore	= "<span class='input-group-addon'><i class='fas fa-at'></i></span>";
		
		$this->txtStreet					= new \QCubed\Project\Control\TextBox($this);
		$this->txtStreet->Placeholder		= tr("Street");
		$this->txtStreet->addWrapperCssClass("input-group");
		$this->txtStreet->HtmlBefore		= "<span class='input-group-addon'><i class='fas fa-home'></i></span>";
		
		$this->txtNumber					= new \QCubed\Project\Control\TextBox($this);
		$this->txtNumber->Required			= true;
		$this->txtNumber->Placeholder		= tr("Number");
		
		$this->lstCountry			= \Country::GetListBox($this);
		$this->lstCountry->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'lstCountry_Changed'));
		$this->lstCountry->Required	=true;
				
		$this->txtCity					= \City::GetAutocompleteTextBox($this,'City::GetCitiesAsListItems');
		$this->txtCity->Required		= true;
		
		$this->lstCountry_changed();
		
		$this->chkSelect				= new \QCubed\Project\Jqui\Checkbox($this);
		$this->chkSelect->HtmlBefore	= "<label class='chk_select_label'>";
		$this->chkSelect->addWrapperCssClass("chk_select");
		$this->chkSelect->HtmlAfter		= "<span>".tr("Select as location")."</span></label>";
		
		$this->blnLegaltype							= \Entity::GetLegalTypeRadioButtonGroup($this);
		$this->blnLegaltype->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'blnLegaltype_changed'));
		$this->blnLegaltype->addCssClass("two-buttons");
		
		$this->txtTypeId				= new \QCubed\Bootstrap\TextBox($this);
		$this->txtTypeId->addCssClass("hidden");
						
	}
	
	
	
}
