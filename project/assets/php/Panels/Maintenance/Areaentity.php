<?php

namespace Hikify\Panels\Maintenance;

/**
 * .@property-read int $EntityId Description
 */
class Areaentity extends \QCubed\Project\Control\Editor { 
	/**
	 *
	 * @var Button 
	 */
	public $btnSave;	
	/**
	 *
	 * @var \QCubed\Codegen\Generator\Autocomplete
	 */
	public $txtEntity;
	/**
	 *
	 * @var \QCubed\Project\Control\BooleanButton 
	 */
	public $blnIncludeExclude;
	/**
	 *
	 * @var Button 
	 */
	public $btnAddEntity;
	/**
	 *
	 * @var \EntityList 
	 */
	public $ddgListEntities;
	
	/**
	 *
	 * @var \QCubed\Control\Label
	 */
	public $lblOverviewEntities;
	
	private $objAreaZipcode;
	private $objArea;
	private $objAreaDay;
	private $objExpertArea;
	private $AreaId;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		$this->strTemplate	= __TEMPLATES__ . '/panels/maintenance/area-entity.tpl.php';
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

		$this->ddgListEntities->createListOverviewEntities($this->objArea->Id);
		$this->ddgListEntities->bindData(\QCubed\Query\QQ::equal(\QQN::areaEntity()->AreaId, $this->objArea->Id));

	}
	
	
	public function btnAddEntity_clicked(){
		$this->CheckFields();
		if($this->txtEntity->SelectedId && $this->blnIncludeExclude->Value){
			$objAreaEntity						= new \AreaEntity();
			$objAreaEntity->AreaId				= $this->objArea->Id;
			$objAreaEntity->EnitityId			= $this->txtEntity->SelectedId;
			$objAreaEntity->IncludeOrExclude	= strtolower($this->blnIncludeExclude->Value);

			$objAreaEntity->Save();
		}
			$this->txtEntity->Text				= "";
			$this->ddgListEntities->bindData(\QCubed\Query\QQ::equal(\QQN::areaEntity()->AreaId, $this->objArea->Id));
		
		
	}
	public function CheckFields(){
		if($this->blnIncludeExclude->Value){
			$this->blnIncludeExclude->removeCssClass("has-error");			
		}else{
			$this->blnIncludeExclude->addCssClass("has-error");
		}
		if($this->txtEntity->SelectedId){
			$this->txtEntity->removeCssClass("has-error");
		}else{
			$this->txtEntity->addCssClass("has-error");
		}
		
	}
	public function btninclude_click($intSelectedEntityRowId){
		
		$objAreaEntity = \AreaEntity::load((int) $intSelectedEntityRowId);
		if($objAreaEntity){
			$objAreaEntity->IncludeOrExclude	= "include";
			$objAreaEntity->Save();
			
		}
		$this->ddgListEntities->bindData(\QCubed\Query\QQ::equal(\QQN::areaEntity()->AreaId, $this->objArea->Id));
		$this->ddgListEntities->dataBind();
	}
	public function btnexclude_click($intSelectedEntityRowId){
		
		$objAreaEntity = \AreaEntity::load((int) $intSelectedEntityRowId);
		if($objAreaEntity){
			$objAreaEntity->IncludeOrExclude	= "exclude";
			$objAreaEntity->Save();
			
		}
		$this->ddgListEntities->bindData(\QCubed\Query\QQ::equal(\QQN::areaEntity()->AreaId, $this->objArea->Id));
		$this->ddgListEntities->dataBind();
	}
	public function btndelete_click($intSelectedEntityRowId){
		\AreaEntity::deleteById($intSelectedEntityRowId);
		$this->ddgListEntities->bindData(\QCubed\Query\QQ::equal(\QQN::areaEntity()->AreaId, $this->objArea->Id));
		$this->ddgListEntities->dataBind();
		
	}
	
	private function Build() {
		$this->lblOverviewEntities					= new \QCubed\Control\Label($this);
//		$this->lblOverviewEntities->Text			= tr("Overview Entities");
		
		$this->txtEntity							= \Entity::GetAutocompleteTextBox($this, '\Entity::GetEntitysAsListItems');
		$this->txtEntity->Name						= tr('Search entity');
		
		$this->blnIncludeExclude					= \CustomFieldType::GetRadioButtonGroup($this, "Include;Exclude", ["green","red"]);
		$this->blnIncludeExclude->Name				= tr("Include/Exclude");
		$this->blnIncludeExclude->Required			= true;
		
		
		$this->btnAddEntity							= \QCubed\Project\Jqui\Button::GetFontAwesomeButton($this, tr("Add"), "fas fa-plus-square");
		$this->btnAddEntity->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, "btnAddEntity_clicked"));
		$this->btnAddEntity->addCssClass("add-button");
		
		$this->ddgListEntities						= new \AreaEntityList($this);
		$this->ddgListEntities->addCssClass("datagrid");
		
		$this->ddgListEntities->Register("OnDelete","btndelete_click",$this);
		$this->ddgListEntities->Register("OnInclude","btninclude_click",$this);
		$this->ddgListEntities->Register("OnExclude","btnexclude_click",$this);
	}

}
