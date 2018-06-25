<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/HutConnector.php');

/**
 * This is the base class for the the HutEditPanel class.  It uses the code-generated
 * HutModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a Hut columns.
 *
 * Implement your customizations in the HutEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class HutEditPanelGen extends Panel
{
	/** @var HutConnector */
	public $mctHut;

	// Controls for Hut's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstPosition;

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

		// Construct the HutConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctHut = HutConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on Hut's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctHut->lblId_Create();
		$this->lstPosition = $this->mctHut->lstPosition_Create();
		$this->txtName = $this->mctHut->txtName_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctHut->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctHut->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctHut->saveHut($blnForceUpdate);
	}

	public function delete() {
		$this->mctHut->deleteHut();
	}

}
