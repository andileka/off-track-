<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/CityConnector.php');

/**
 * This is the base class for the the CityEditPanel class.  It uses the code-generated
 * CityModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a City columns.
 *
 * Implement your customizations in the CityEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class CityEditPanelGen extends Panel
{
	/** @var CityConnector */
	public $mctCity;

	// Controls for City's Data Fields

	/** @var \QCubed\Control\IntegerTextBox */
	protected $txtId;

	/** @var \QCubed\Control\IntegerTextBox */
	protected $txtCountryId;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtPostalCode;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtName;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtAdminName1;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtAdminCode1;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtAdminName2;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtAdminCode2;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtAdminName3;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtAdminCode3;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtLatitude;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtLongitude;

	/** @var \QCubed\Control\IntegerTextBox */
	protected $txtAccuracy;


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

		// Construct the CityConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctCity = CityConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on City's data fields
	 **/
	protected function createObjects() {
		$this->txtId = $this->mctCity->txtId_Create();
		$this->txtCountryId = $this->mctCity->txtCountryId_Create();
		$this->txtPostalCode = $this->mctCity->txtPostalCode_Create();
		$this->txtName = $this->mctCity->txtName_Create();
		$this->txtAdminName1 = $this->mctCity->txtAdminName1_Create();
		$this->txtAdminCode1 = $this->mctCity->txtAdminCode1_Create();
		$this->txtAdminName2 = $this->mctCity->txtAdminName2_Create();
		$this->txtAdminCode2 = $this->mctCity->txtAdminCode2_Create();
		$this->txtAdminName3 = $this->mctCity->txtAdminName3_Create();
		$this->txtAdminCode3 = $this->mctCity->txtAdminCode3_Create();
		$this->txtLatitude = $this->mctCity->txtLatitude_Create();
		$this->txtLongitude = $this->mctCity->txtLongitude_Create();
		$this->txtAccuracy = $this->mctCity->txtAccuracy_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctCity->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctCity->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctCity->saveCity($blnForceUpdate);
	}

	public function delete() {
		$this->mctCity->deleteCity();
	}

}
