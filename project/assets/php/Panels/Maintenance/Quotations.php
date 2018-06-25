<?php

namespace Hikify\Panels\Maintenance;

/**
 * @property Phone
 */
class Quotations extends \QCubed\Control\Panel {	
	/**
	 *
	 * @var \EntityPhone 
	 */
	private $objEntityPhone;
	/**
	 * 
	 * @var \QCubed\Project\Jqui\DatepickerBox
	 */
	public $ddtValidUntil;
	/*
	 * @var \QCubed\Project\Control\Listbox
	 */
	public $lstLowerQuotation;
	/**
	 *
	 * @var \QCubed\Control\Panel
	 */
	public $pnlBuyers;
	/**
	 *
	 * @var \QuotationList 
	 */
	public $dgBuyers;
	
	public $objQuotation;
	public $objDamage;
	
	public function __construct($objParentObject) {
		parent::__construct($objParentObject);

		$this->strTemplate	= __TEMPLATES__ . '/panels/maintenance/quotations.tpl.php';
		$this->addCssFile("/project/assets/css/datatables.css");
		$this->Build();
	}
	
	public function setQuotationPanel(\Damage $objDamage=null){
		if(!$objDamage) {
			return; //voorlopig niets doen, maar zou alle velden moeten clearen.
			//$this->Clear();
		}  
//		print_r($objDamage);
		$this->objDamage			= $objDamage;
		$this->objQuotation			= \Quotation::loadArrayByDamageId($this->objDamage->Id);
		$this->dgBuyers->DataSource	= $this->objQuotation;
		
	}
	public function btnrelationedit_click($intSelectedQuotation){
		$objQuotation			= \Quotation::loadById($intSelectedQuotation);
		if($objQuotation){
			$this->ddtValidUntil->Text					= $objQuotation->ValidUntil;
			$this->lstLowerQuotation->SelectedValue		= $objQuotation->LowerQuotationTypeId;
			$this->pnlBuyers->SetEntity($objQuotation->Entity);
		}
	}
	public function btnrelationdelete_click($intSelectedQuotation){
		\Quotation::deleteById($intSelectedQuotation);
		$this->dgBuyers->bindData(\QCubed\Query\QQ::equal(\QQN::quotation()->DamageId, $this->objDamage->Id));
		$this->dgBuyers->dataBind();
	}
	
	public function Save(){
		/* 2. SAVE ENTITY */
		\QCubed\Project\Application::Log("Start Save");
		if(!$this->Validate()) {
			return;
		}
		$this->pnlBuyers->Save();
	}
	
	public function ShouldLineBeSaved() {
		return ($this->lstType->SelectedValue && $this->txtNr->Text);
	}
	public function SaveBuyer(\Entity $objEntity){
		/* 3. SAVE QUOTATION */
		if(!$objEntity){
			return;
		}
		if(!$this->objDamage && !$objEntity->Id){
			return;
		}
//		\QCubed\Project\Application::Log(json_encode($this->objDamage));exit;
		if($this->objDamage && $this->lstLowerQuotation->SelectedValue ){
			$objQuotation						= \Quotation::loadByDamageAndEntity($this->objDamage->Id, $objEntity->Id);
			if(!$objQuotation){
				$objQuotation					= new \Quotation();
			}
			$objQuotation->ValidUntil			= $this->ddtValidUntil->DateTime;
			$objQuotation->LowerQuotationTypeId	= $this->lstLowerQuotation->SelectedValue;
			$objQuotation->DamageId				= $this->objDamage->Id;
			$objQuotation->EntityId				= $objEntity->Id;

			$objQuotation->Save();
			$this->pnlBuyers->ClearFields();
			$this->ddtValidUntil->Text	= "";
			$this->lstLowerQuotation->SelectedValue = null;
			$this->dgBuyers->bindData(\QCubed\Query\QQ::equal(\QQN::quotation()->DamageId, $this->objDamage->Id));
			$this->dgBuyers->dataBind();
		}else{
			\QCubed\Project\Application::executeJavaScript("window.reload();");
		}
		
	}
	private function Build() {
		$this->ddtValidUntil	= new \QCubed\Project\Jqui\DatepickerBox($this);
		$this->ddtValidUntil->Placeholder				= tr('Valid until');
		$this->ddtValidUntil->Required				= true;
		$this->ddtValidUntil->addWrapperCssClass("input-group");
		$this->ddtValidUntil->HtmlBefore	= "<span class='input-group-addon'><i class='fas fa-calendar-alt'></i></span>";
		
		$this->lstLowerQuotation	= \LowerQuotationType::GetListbox($this);
		
		$this->pnlBuyers			= new \Hikify\Panels\Job\Entity($this);
		$this->pnlBuyers->SetReadOnlyFields(false);
		$this->pnlBuyers->HideAllFields(false);
		$this->pnlBuyers->HideSearch(true);
		$this->pnlBuyers->HideNotification();
		$this->pnlBuyers->HideSaveButton();
		$this->pnlBuyers->Register("OnSave", "SaveBuyer");
		
		
		$this->dgBuyers = new \QuotationList($this);
		$this->dgBuyers->createColumns();
		$this->dgBuyers->DataSource = array();
		$this->dgBuyers->Register("OnEdit","btnrelationedit_click",$this);
		$this->dgBuyers->Register("OnDelete","btnrelationdelete_click",$this);
	}
	
}
