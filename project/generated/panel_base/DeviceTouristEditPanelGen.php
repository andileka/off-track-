<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/DeviceTouristConnector.php');

/**
 * This is the base class for the the DeviceTouristEditPanel class.  It uses the code-generated
 * DeviceTouristModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a DeviceTourist columns.
 *
 * Implement your customizations in the DeviceTouristEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class DeviceTouristEditPanelGen extends Panel
{
	/** @var DeviceTouristConnector */
	public $mctDeviceTourist;

	// Controls for DeviceTourist's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstDevice;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstTourist;

	/** @var \QCubed\Control\DateTimePicker */
	protected $calStartDate;

	/** @var \QCubed\Control\DateTimePicker */
	protected $calEndDate;


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

		// Construct the DeviceTouristConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctDeviceTourist = DeviceTouristConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on DeviceTourist's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctDeviceTourist->lblId_Create();
		$this->lstDevice = $this->mctDeviceTourist->lstDevice_Create();
		$this->lstTourist = $this->mctDeviceTourist->lstTourist_Create();
		$this->calStartDate = $this->mctDeviceTourist->calStartDate_Create();
		$this->calEndDate = $this->mctDeviceTourist->calEndDate_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctDeviceTourist->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctDeviceTourist->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctDeviceTourist->saveDeviceTourist($blnForceUpdate);
	}

	public function delete() {
		$this->mctDeviceTourist->deleteDeviceTourist();
	}

}
