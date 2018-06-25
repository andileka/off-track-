<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/PositionConnector.php');

/**
 * This is the base class for the the PositionEditPanel class.  It uses the code-generated
 * PositionModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a Position columns.
 *
 * Implement your customizations in the PositionEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class PositionEditPanelGen extends Panel
{
	/** @var PositionConnector */
	public $mctPosition;

	// Controls for Position's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtLat;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtLong;

	/** @var \QCubed\Control\IntegerTextBox */
	protected $txtHeight;


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

		// Construct the PositionConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctPosition = PositionConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on Position's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctPosition->lblId_Create();
		$this->txtLat = $this->mctPosition->txtLat_Create();
		$this->txtLong = $this->mctPosition->txtLong_Create();
		$this->txtHeight = $this->mctPosition->txtHeight_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctPosition->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctPosition->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctPosition->savePosition($blnForceUpdate);
	}

	public function delete() {
		$this->mctPosition->deletePosition();
	}

}
