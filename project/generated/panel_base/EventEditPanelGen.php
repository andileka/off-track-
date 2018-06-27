<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/EventConnector.php');

/**
 * This is the base class for the the EventEditPanel class.  It uses the code-generated
 * EventModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a Event columns.
 *
 * Implement your customizations in the EventEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class EventEditPanelGen extends Panel
{
	/** @var EventConnector */
	public $mctEvent;

	// Controls for Event's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstDevice;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtType;

	/** @var \QCubed\Control\DateTimePicker */
	protected $calDatetime;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstPosition;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtStatus;


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

		// Construct the EventConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctEvent = EventConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on Event's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctEvent->lblId_Create();
		$this->lstDevice = $this->mctEvent->lstDevice_Create();
		$this->txtType = $this->mctEvent->txtType_Create();
		$this->calDatetime = $this->mctEvent->calDatetime_Create();
		$this->lstPosition = $this->mctEvent->lstPosition_Create();
		$this->txtStatus = $this->mctEvent->txtStatus_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctEvent->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctEvent->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctEvent->saveEvent($blnForceUpdate);
	}

	public function delete() {
		$this->mctEvent->deleteEvent();
	}

}
