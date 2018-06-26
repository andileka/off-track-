<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/TrackPointConnector.php');

/**
 * This is the base class for the the TrackPointEditPanel class.  It uses the code-generated
 * TrackPointModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a TrackPoint columns.
 *
 * Implement your customizations in the TrackPointEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class TrackPointEditPanelGen extends Panel
{
	/** @var TrackPointConnector */
	public $mctTrackPoint;

	// Controls for TrackPoint's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstTrack;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstPosition;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtType;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtName;


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

		// Construct the TrackPointConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctTrackPoint = TrackPointConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on TrackPoint's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctTrackPoint->lblId_Create();
		$this->lstTrack = $this->mctTrackPoint->lstTrack_Create();
		$this->lstPosition = $this->mctTrackPoint->lstPosition_Create();
		$this->txtType = $this->mctTrackPoint->txtType_Create();
		$this->txtName = $this->mctTrackPoint->txtName_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctTrackPoint->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctTrackPoint->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctTrackPoint->saveTrackPoint($blnForceUpdate);
	}

	public function delete() {
		$this->mctTrackPoint->deleteTrackPoint();
	}

}
