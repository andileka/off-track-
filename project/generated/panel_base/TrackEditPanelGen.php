<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/TrackConnector.php');

/**
 * This is the base class for the the TrackEditPanel class.  It uses the code-generated
 * TrackModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a Track columns.
 *
 * Implement your customizations in the TrackEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class TrackEditPanelGen extends Panel
{
	/** @var TrackConnector */
	public $mctTrack;

	// Controls for Track's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

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

		// Construct the TrackConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctTrack = TrackConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on Track's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctTrack->lblId_Create();
		$this->txtName = $this->mctTrack->txtName_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctTrack->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctTrack->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctTrack->saveTrack($blnForceUpdate);
	}

	public function delete() {
		$this->mctTrack->deleteTrack();
	}

}
