<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/LogConnector.php');

/**
 * This is the base class for the the LogEditPanel class.  It uses the code-generated
 * LogModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a Log columns.
 *
 * Implement your customizations in the LogEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class LogEditPanelGen extends Panel
{
	/** @var LogConnector */
	public $mctLog;

	// Controls for Log's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstUser;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtAction;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtValue;

	/** @var \QCubed\Control\DateTimePicker */
	protected $calDatetime;

	/** @var \QCubed\Control\IntegerTextBox */
	protected $txtIp;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtLogcol;


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

		// Construct the LogConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctLog = LogConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on Log's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctLog->lblId_Create();
		$this->lstUser = $this->mctLog->lstUser_Create();
		$this->txtAction = $this->mctLog->txtAction_Create();
		$this->txtValue = $this->mctLog->txtValue_Create();
		$this->calDatetime = $this->mctLog->calDatetime_Create();
		$this->txtIp = $this->mctLog->txtIp_Create();
		$this->txtLogcol = $this->mctLog->txtLogcol_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctLog->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctLog->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctLog->saveLog($blnForceUpdate);
	}

	public function delete() {
		$this->mctLog->deleteLog();
	}

}
