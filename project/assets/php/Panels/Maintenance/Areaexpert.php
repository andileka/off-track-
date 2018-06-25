<?php

namespace Hikify\Panels\Maintenance;

/**
 * .@property-read int $EntityId Description
 */
class Areaexpert extends \QCubed\Project\Control\Editor { 
	/**
	 *
	 * @var Button 
	 */
	public $btnSave;	
	/**
	 *
	 * @var \QCubed\Codegen\Generator\Autocomplete
	 */
	public $txtExpert;
	/**
	 *
	 * @var Button 
	 */
	public $btnAddExpert;
	/**
	 *
	 * @var \EntityList 
	 */
	public $ddgListExperts;
	
	/**
	 *
	 * @var \QCubed\Control\Label
	 */
	public $lblOverviewEntities;
	
	/**
	 *
	 * @var \QCubed\QDateTime
	 */
	public $ddtEndDate;
	/**
	 *
	 * @var \QCubed\QDateTime
	 */
	public $ddtStartdate;
	private $objAreaZipcode;
	private $objArea;
	private $objAreaDay;
	private $objExpertArea;
	private $AreaId;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		$this->strTemplate	= __TEMPLATES__ . '/panels/maintenance/area-expert.tpl.php';
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

		$this->ddgListExperts->createListOverviewExperts($this->objArea->Id);
		$this->ddgListExperts->bindData(\QCubed\Query\QQ::equal(\QQN::expertArea()->AreaId, $this->objArea->Id));

	}
	
	public function CheckFields(){
		if($this->txtExpert->SelectedId){
			$this->txtExpert->removeCssClass("has-error");
		}else{
			$this->txtExpert->addCssClass("has-error");
		}
		
	}
	public function btndeleteExpert_click($intSelectedExpertRowId){
		\ExpertArea::deleteById($intSelectedExpertRowId);
		$this->ddgListExperts->bindData(\QCubed\Query\QQ::equal(\QQN::expertArea()->AreaId, $this->objArea->Id));
		$this->ddgListExperts->dataBind();
	}
	public function btnAddExpert_clicked(){
		$this->CheckFields();
		if($this->txtExpert->SelectedId){
			$objAreaEntity						= new \ExpertArea();
			$objAreaEntity->AreaId				= $this->objArea->Id;
			$objAreaEntity->ExpertId			= $this->txtExpert->SelectedId;
			$objAreaEntity->StartDate			= $this->ddtStartdate->DateTime;
			$objAreaEntity->ExpiresOn			= $this->ddtEndDate->DateTime;

			$objAreaEntity->Save();
		}
			$this->txtExpert->Text				= "";
			$this->ddtEndDate->Text				= "";
			$this->ddgListExperts->bindData(\QCubed\Query\QQ::equal(\QQN::expertArea()->AreaId, $this->objArea->Id));
			$this->ddgListExperts->dataBind();
	}
	
	private function Build() {
		$this->lblOverviewEntities					= new \QCubed\Control\Label($this);
		
		$this->txtExpert							= \Expert::GetAutocompleteTextBox($this, '\Expert::GetExpertsAsListItems');
		$this->txtExpert->Name						= tr('Search expert');
		
		$this->btnAddExpert							= \QCubed\Project\Jqui\Button::GetFontAwesomeButton($this, tr("Add"), "fas fa-plus-square");
		$this->btnAddExpert->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "btnAddExpert_clicked"));
		$this->btnAddExpert->addCssClass("add-button");
		
		$this->ddgListExperts						= new \ExpertAreaList($this);
		$this->ddgListExperts->addCssClass("datagrid");
		$this->ddgListExperts->Register("OnDeleteExpert","btndeleteExpert_click",$this);
		
		$this->ddtStartdate			= new \QCubed\Project\Jqui\DatepickerBox($this);
		$this->ddtStartdate->Name	= tr('From');
		
		$this->ddtEndDate			= new \QCubed\Project\Jqui\DatepickerBox($this);
		$this->ddtEndDate->Name		= tr('Till');
	}

}
