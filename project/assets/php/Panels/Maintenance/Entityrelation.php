<?php

namespace Hikify\Panels\Maintenance;

/**
 * @property EntityRelation
 */
class Entityrelation extends \QCubed\Control\Panel {

	/**
	 *
	 * @var \RelationRole 
	 */
	public $lstRoles;

	/**
	 *
	 * @var \Entity 
	 */
	public $lstEntities;

	/**
	 *
	 * @var \QCubed\QDateTime
	 */
	public $dttDateExpiresOn;
	/**
	 *
	 * @var \EntityRelation
	 */
	private $objEntityRelation;
	private $objEntity1;
	private $objEntity2;
	
	public function __construct($objParentObject) {
		parent::__construct($objParentObject);

		$this->strTemplate = __TEMPLATES__ . '/panels/maintenance/entityrelation.tpl.php';
		$this->Build();
	}

	public function setEntity($objEntity1 = null, $objEntity2 = null) {
		$this->objEntity1 = $objEntity1;
		$this->objEntity2 = $objEntity2;
	}

	public function setEntityRelation(\EntityRelation $objEntityRelation = null) {
		if (!$objEntityRelation) {
			$this->lstRoles->SelectedValue = null;
			$this->lstEntities->SelectedValue = null;
		} else {
			$this->lstRoles->SelectedValue = $objEntityRelation->EntityRoleId;
			$this->lstEntities->SelectedValue = $objEntityRelation->Entity2Id;
			$this->dttDateExpiresOn->Text = $objEntityRelation->ExpiresOn;
		}

		$this->objEntityRelation = $objEntityRelation;
	}

	public function ShouldLineBeSaved() {
		return ($this->lstRoles->SelectedValue && $this->lstEntities->SelectedValue);
	}

	public function Save() {
		if ($this->ShouldLineBeSaved()) {
			if (!$this->objEntityRelation) {
				$this->objEntityRelation = new \EntityRelation();
				$this->objEntityRelation->Entity1 = $this->objEntity1;
			}
			$this->objEntityRelation->EntityRoleId = $this->lstRoles->SelectedValue;
			$this->objEntityRelation->Entity2Id = $this->lstEntities->SelectedValue;
			$this->objEntityRelation->ExpiresOn = $this->dttDateExpiresOn->DateTime;
			$this->objEntityRelation->save();
			return true;
		}
	}

	private function Build() {
		
		//<span class="rating big-red"></span>
		$this->lstRoles = \RelationRole::GetListBox($this);
		$this->lstRoles->Name = tr('Role');
		$this->lstEntities = \Entity::GetListBox($this);
		$this->lstEntities->Name = tr('Entity');
		$this->dttDateExpiresOn = new \QCubed\Project\Jqui\DatepickerBox($this);
		$this->dttDateExpiresOn->Name = tr('Expires on');
		
	}
	
}
