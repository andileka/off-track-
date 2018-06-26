<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/TouristTrackConnector.php');

/**
 * This is the base class for the the TouristTrackEditPanel class.  It uses the code-generated
 * TouristTrackModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a TouristTrack columns.
 *
 * Implement your customizations in the TouristTrackEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class TouristTrackEditPanelGen extends Panel
{
	/** @var TouristTrackConnector */
	public $mctTouristTrack;

	// Controls for TouristTrack's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstTourist;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstTrack;


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

		// Construct the TouristTrackConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctTouristTrack = TouristTrackConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on TouristTrack's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctTouristTrack->lblId_Create();
		$this->lstTourist = $this->mctTouristTrack->lstTourist_Create();
		$this->lstTrack = $this->mctTouristTrack->lstTrack_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctTouristTrack->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctTouristTrack->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctTouristTrack->saveTouristTrack($blnForceUpdate);
	}

	public function delete() {
		$this->mctTouristTrack->deleteTouristTrack();
	}

}
