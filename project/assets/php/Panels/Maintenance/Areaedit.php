<?php

namespace Hikify\Panels\Maintenance;

/**
 * .@property-read int $EntityId Description
 */
class Areaedit extends \QCubed\Control\Panel {
		
	public $lstCountry;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Autocomplete 
	 */
	public $txtCity;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtName;
	
	/**
	 *
	 * @var \AreaZipcodeList
	 */
	public $dgZipcodes;
	/**
	 *
	 * @var Button
	 */
	public $btnSave;
	/**
	 *
	 * @var \QCubed\Control\Label 
	 */
	public $lblCreateNew;
	/**
	 *
	 * @var \QCubed\Control\Label 
	 */
	public $lblOverviewZip;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $pnlDayAM;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $pnlDayPM;

	/**
	 *
	 * @var \QCubed\Project\Control\Button 
	 */
	public $addZipCode;
	/**
	 *
	 * @var \QCubed\Project\Control\BooleanButton
	 */
	public $blnAddZipRange;
	/**
	 *
	 * @var Textbox 
	 */
	public $txtRangeMin;
	/**
	 *
	 * @var Textbox 
	 */
	public $txtRangeMax;
	/**
	 *
	 * @var AreaZipcode
	 */
	private $objAreaZipcode;
	private $objArea;
	private $objAreaDay;
	private $objExpertArea;
	private $AreaId;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		$this->strTemplate	= __TEMPLATES__ . '/panels/maintenance/area-edit.tpl.php';
		$this->addCssFile("/project/assets/css/datagrid.css");

		$this->Build();
		
	}
	/**
	 * 
	 * @param int $intAreaId
	 */
	public function SetArea($intAreaId){
		$this->objArea = \Area::load((int) $intAreaId);
		$this->AreaId = $this->objArea->Id;
		$this->EnableAddZipcode(true);
		$this->txtName->Value = $this->objArea->Name;
		$this->dgZipcodes->createListOverviewZipcodes($this->objArea->Id);
		$this->dgZipcodes->bindData(\QCubed\Query\QQ::equal(\QQN::AreaZipcode()->AreaId, $this->objArea->Id));

		$arrAM = \AreaDay::loadArrayByAreaIdAndDayPart($this->objArea->Id, 'am');
		$arrPM = \AreaDay::loadArrayByAreaIdAndDayPart($this->objArea->Id, 'pm');
		foreach($this->GetDayParts($arrAM) as $SelectedDay){
			$this->SetDayActive($SelectedDay,$this->pnlDayAM);
		}
		foreach($this->GetDayParts($arrPM) as $SelectedDay){
			$this->SetDayActive($SelectedDay,$this->pnlDayPM);
		}

	}
	public function SetDayActive($strDay, $objPanel){
		foreach($objPanel->GetChildControls() as $control){
			if($control->Name == $strDay){
				$control->Checked = true;
			}
		}
	}
	public function GetDayParts($arrAreaDays){
		$SelectedValues = [];
		foreach($arrAreaDays as $AreaDay){
				$SelectedValues[] = $AreaDay->Day;
			}
			
		return $SelectedValues;
	}
	public function lstCountry_Changed() {
		$this->txtCity->setCustomAttribute("country_id", $this->lstCountry->SelectedValue);		
	}
	public function Save(){
		if(!$this->objArea) {
			$this->objArea = new \Area();					
		}
		if(isset($_GET['copy']) && $_GET['copy'] == 1) {
			$AreaId  = $this->objArea->Id;
			$this->objArea = new \Area();
		}
		$this->objArea->Name			= $this->txtName->Value;
		$this->objArea->Save();
		
		if(isset($_GET['copy']) && $_GET['copy'] == 1) {
			/* SAVE ZIPCODES */
			$arrZipcodes = \AreaZipcode::loadArrayByAreaId($AreaId);
			foreach($arrZipcodes as $objZipcode){
				$this->objAreaZipcode = new \AreaZipcode();	
				$this->objAreaZipcode->AreaId	= $this->objArea->Id;
				$this->objAreaZipcode->Zipcode	= $objZipcode->Zipcode;
				$this->objAreaZipcode->Save();
			}
			$arrEntities = \AreaEntity::loadArrayByAreaId($AreaId);
			foreach($arrEntities as $objEntity){
				$objAreaEntity = new \AreaEntity();	
				$objAreaEntity->AreaId				= $this->objArea->Id;
				$objAreaEntity->EnitityId			= $objEntity->EnitityId;
				$objAreaEntity->IncludeOrExclude	= $objEntity->IncludeOrExclude;
				$objAreaEntity->Save();
			}
			/* Experts */
			$arrExperts = \ExpertArea::loadArrayByAreaId($AreaId);
			foreach($arrExperts as $objExpert){
				$objAreaExpert = new \ExpertArea();	
				$objAreaExpert->AreaId				= $this->objArea->Id;
				$objAreaExpert->ExpertId			= $objExpert->ExpertId;
				$objAreaExpert->ExpiresOn			= $objExpert->ExpiresOn;
				$objAreaExpert->Save();
			}
			
		}
		/* SAVE EXPERT */
//		$this->objExpertArea = \ExpertArea::loadByAreaIdAndExpireDate((int) $this->objArea->Id, $this->ddtExpiresOn->DateTime);
//		if(!$this->objExpertArea){
//			$this->objExpertArea		= new \ExpertArea();
//		}
//		$this->objExpertArea->AreaId	= $this->objArea->Id;
//		$this->objExpertArea->ExpertId	= $this->lstExperts->SelectedValue;
//		$this->objExpertArea->ExpiresOn	= $this->ddtExpiresOn->DateTime;
//		
//		$this->objExpertArea->Save();
		
		/* SAVE DAYS */
		if($this->objArea->Id){
			\AreaDay::deleteByAreaId($this->objArea->Id);
		}
		$this->SaveAreaDay($this->pnlDayAM, "am");
		$this->SaveAreaDay($this->pnlDayPM, "pm");
		
		if (!isset($_GET['id']) || isset($_GET['copy']) && $_GET['copy'] == 1) {
			\QCubed\Project\Application::Redirect('index.php?c=maintenance&a=Area'); //back to the list if Area is new 
		}
		
	}
	public function SaveAreaDay($objPanel, $strDayPart="am"){
		foreach($objPanel->GetChildControls() as $control){
			if($control->Checked){		
				$this->objAreaDay				= new \AreaDay();
				$this->objAreaDay->AreaId		= $this->objArea->Id;
				$this->objAreaDay->Day			= strtolower($control->Text);
				$this->objAreaDay->AmPm			= $strDayPart;
				$this->objAreaDay->Save();
			}
			
		}
		
		
		
		
	}
	public function btnrelationdelete_click($intSelectedZipcode){
		\AreaZipcode::DeleteByAreaAndZip($this->objArea->Id,$intSelectedZipcode);
		$this->dgZipcodes->bindData(\QCubed\Query\QQ::equal(\QQN::AreaZipcode()->AreaId, $this->objArea->Id));
		$this->dgZipcodes->dataBind();
	}
	public function btnAddZip_clicked(){
		if($this->blnAddZipRange->SelectedValue == "Single"){
			$this->AddZipCodes($this->txtCity->SelectedId);
		}else{
			$this->AddZipcodeRange();
		}
		
		
		$this->dgZipcodes->bindData(\QCubed\Query\QQ::equal(\QQN::AreaZipcode()->AreaId, $this->objArea->Id));
		$this->dgZipcodes->dataBind();
		
	}
	public function AddZipcodeRange(){
		$arrCities = \City::loadCitiesBetweenRange($this->txtRangeMin->Text, $this->txtRangeMax->Text, $this->lstCountry->SelectedValue);
		foreach($arrCities as $objCity){
			$this->AddZipCodes($objCity->Id);
		}
		$this->dgZipcodes->bindData(\QCubed\Query\QQ::equal(\QQN::AreaZipcode()->AreaId, $this->objArea->Id));
	}
	public function AddZipCodes($CityId){
		/* SAVE ZIP*/
		/* CHECK IF ZIP IS ALREADY IN DB */
		$this->objAreaZipcode			= \AreaZipcode::loadByAreaIdAndZipCode((int) $this->objArea->Id,$CityId );
		
		if(!$this->objAreaZipcode) {
			$this->objAreaZipcode = new \AreaZipcode();
		}
		$this->objAreaZipcode->AreaId	= $this->objArea->Id;
		$this->objAreaZipcode->Zipcode	= $CityId;
		if($CityId){
			$this->objAreaZipcode->Save();
		}
	}
	public function AddZipRange_clicked(){
		if($this->blnAddZipRange->SelectedValue == "Single"){
			$this->ShowCityRange(false);
		}else{
			$this->ShowCityRange(true);
		}
	}
	public function ShowCityRange($blnShow){
		$this->txtCity-> Display = !$blnShow;
		$this->txtRangeMin->Display = $blnShow;
		$this->txtRangeMax->Display = $blnShow;
	}
	public function EnableAddZipcode($blnDisplay = true){
		if($this->objArea){
			$this->addZipCode->removeCustomAttribute("disabled",$blnDisplay);
		}
	}
	private function AddDays(){
		$arrDays = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
		foreach($arrDays as $strDay){
			$chkAm					= new \QCubed\Project\Control\Checkbox($this->pnlDayAM);
			$chkAm->Name				= $strDay;
			$chkAm->WrapperCssClass	= "col-md-2 chkDays";
			
			$chkPm					= new \QCubed\Project\Control\Checkbox($this->pnlDayPM);
			$chkPm->Name				= $strDay;
			$chkPm->WrapperCssClass	= "col-md-2 chkDays";
		}
		
	}
	private function Build() {
		
		$this->txtName								= new \QCubed\Project\Control\TextBox($this);
		$this->txtName->Placeholder					= tr("Name");
		
		$this->lstCountry			= \Country::GetListBox($this);
		$this->lstCountry->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'lstCountry_Changed'));
		$this->lstCountry->Required	=true;
				
		$this->txtCity					= \City::GetAutocompleteTextBox($this,'City::GetCitiesAsListItems');
		$this->txtCity->Required		= true;
		$this->txtCity->Name			= tr("City");
		
		$this->lstCountry_changed();

		
		$this->dgZipcodes				= new \AreaZipcodeList($this);
		$this->dgZipcodes->addCssClass("datagrid");
		$this->dgZipcodes->Register("OnDelete","btnrelationdelete_click",$this);
		
		$this->pnlDayAM					= new \QCubed\Control\Panel($this);
//		$this->pnlDayAM->Name			= tr("Select Day AM");
		$this->pnlDayAM->PreferredRenderMethod		= "RenderFormGroup";
		$this->pnlDayAM->AutoRenderChildren			= true;
			
		$this->pnlDayPM					= new \QCubed\Control\Panel($this);
//		$this->pnlDayPM->Name			= tr("Select Day PM");
		$this->pnlDayPM->PreferredRenderMethod		= "RenderFormGroup";
		$this->pnlDayPM->AutoRenderChildren			= true;
		
		$this->AddDays();
		
		$this->addZipCode				= \QCubed\Project\Jqui\Button::GetFontAwesomeButton($this, tr("Add"), "fas fa-plus-square");
		$this->addZipCode->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "btnAddZip_clicked"));
//		$this->EnableAddZipcode(false);.
		$this->addZipCode->setCustomAttribute("disabled",true);
		
		$this->blnAddZipRange			= \CustomFieldType::GetRadioButtonGroup($this, "Single;Range", ["color_48D1CC","color_FF34B3"]);
		$this->blnAddZipRange->SelectedValue = "Single";
		$this->blnAddZipRange->addAction(new \QCubed\Event\Click(),new \QCubed\Action\AjaxControl($this, 'AddZipRange_clicked'));
		
		$this->txtRangeMin				= new \QCubed\Project\Control\TextBox($this);
		$this->txtRangeMin->Name		= tr("From");
		$this->txtRangeMin->Display		= false;
		
		$this->txtRangeMax				= new \QCubed\Project\Control\TextBox($this);
		$this->txtRangeMax->Name		= tr("Till");
		$this->txtRangeMax->Display		= false;
		
		$this->btnSave					= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save'));
	}

}
