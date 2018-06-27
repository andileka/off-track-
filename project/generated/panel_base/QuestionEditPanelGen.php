<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/QuestionConnector.php');

/**
 * This is the base class for the the QuestionEditPanel class.  It uses the code-generated
 * QuestionModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a Question columns.
 *
 * Implement your customizations in the QuestionEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class QuestionEditPanelGen extends Panel
{
	/** @var QuestionConnector */
	public $mctQuestion;

	// Controls for Question's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtQuestion;


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

		// Construct the QuestionConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctQuestion = QuestionConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on Question's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctQuestion->lblId_Create();
		$this->txtQuestion = $this->mctQuestion->txtQuestion_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctQuestion->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctQuestion->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctQuestion->saveQuestion($blnForceUpdate);
	}

	public function delete() {
		$this->mctQuestion->deleteQuestion();
	}

}
