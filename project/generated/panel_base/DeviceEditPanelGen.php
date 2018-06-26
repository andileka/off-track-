<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/DeviceConnector.php');

/**
 * This is the base class for the the DeviceEditPanel class.  It uses the code-generated
 * DeviceModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a Device columns.
 *
 * Implement your customizations in the DeviceEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class DeviceEditPanelGen extends Panel
{
	/** @var DeviceConnector */
	public $mctDevice;

	// Controls for Device's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtSerial;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstCompany;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtRemark;


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

		// Construct the DeviceConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctDevice = DeviceConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on Device's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctDevice->lblId_Create();
		$this->txtSerial = $this->mctDevice->txtSerial_Create();
		$this->lstCompany = $this->mctDevice->lstCompany_Create();
		$this->txtRemark = $this->mctDevice->txtRemark_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctDevice->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctDevice->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctDevice->saveDevice($blnForceUpdate);
	}

	public function delete() {
		$this->mctDevice->deleteDevice();
	}

}
