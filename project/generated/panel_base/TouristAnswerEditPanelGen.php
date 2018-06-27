<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/TouristAnswerConnector.php');

/**
 * This is the base class for the the TouristAnswerEditPanel class.  It uses the code-generated
 * TouristAnswerModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a TouristAnswer columns.
 *
 * Implement your customizations in the TouristAnswerEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class TouristAnswerEditPanelGen extends Panel
{
	/** @var TouristAnswerConnector */
	public $mctTouristAnswer;

	// Controls for TouristAnswer's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

	/** @var \QCubed\Control\IntegerTextBox */
	protected $txtTouristId;

	/** @var \QCubed\Control\IntegerTextBox */
	protected $txtQuestionId;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtAnswer;


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

		// Construct the TouristAnswerConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctTouristAnswer = TouristAnswerConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on TouristAnswer's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctTouristAnswer->lblId_Create();
		$this->txtTouristId = $this->mctTouristAnswer->txtTouristId_Create();
		$this->txtQuestionId = $this->mctTouristAnswer->txtQuestionId_Create();
		$this->txtAnswer = $this->mctTouristAnswer->txtAnswer_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctTouristAnswer->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctTouristAnswer->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctTouristAnswer->saveTouristAnswer($blnForceUpdate);
	}

	public function delete() {
		$this->mctTouristAnswer->deleteTouristAnswer();
	}

}
