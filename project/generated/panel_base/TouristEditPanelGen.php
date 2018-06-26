<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/TouristConnector.php');

/**
 * This is the base class for the the TouristEditPanel class.  It uses the code-generated
 * TouristModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a Tourist columns.
 *
 * Implement your customizations in the TouristEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class TouristEditPanelGen extends Panel
{
	/** @var TouristConnector */
	public $mctTourist;

	// Controls for Tourist's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtName;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtPassport;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtContactinfo;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstLanguage;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstCity;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstCountry;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstPosition;


	/**
	 * @param FormBase|ControlBase $objParentObject
	 * @param null|string $strControlId
	 * @throws Exception
	 * @throws Caller
	 */
	public function __construct($objParentObject, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (Caller $objExc) {
			$objExc->incrementOffset();
			throw $objExc;
		}

		// Construct the TouristConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctTourist = TouristConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on Tourist's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctTourist->lblId_Create();
		$this->txtName = $this->mctTourist->txtName_Create();
		$this->txtPassport = $this->mctTourist->txtPassport_Create();
		$this->txtContactinfo = $this->mctTourist->txtContactinfo_Create();
		$this->lstLanguage = $this->mctTourist->lstLanguage_Create();
		$this->lstCity = $this->mctTourist->lstCity_Create();
		$this->lstCountry = $this->mctTourist->lstCountry_Create();
		$this->lstPosition = $this->mctTourist->lstPosition_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctTourist->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctTourist->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctTourist->saveTourist($blnForceUpdate);
	}

	public function delete() {
		$this->mctTourist->deleteTourist();
	}

}
