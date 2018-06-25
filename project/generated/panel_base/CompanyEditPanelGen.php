<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/CompanyConnector.php');

/**
 * This is the base class for the the CompanyEditPanel class.  It uses the code-generated
 * CompanyModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a Company columns.
 *
 * Implement your customizations in the CompanyEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class CompanyEditPanelGen extends Panel
{
	/** @var CompanyConnector */
	public $mctCompany;

	// Controls for Company's Data Fields

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

		// Construct the CompanyConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctCompany = CompanyConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on Company's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctCompany->lblId_Create();
		$this->txtName = $this->mctCompany->txtName_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctCompany->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctCompany->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctCompany->saveCompany($blnForceUpdate);
	}

	public function delete() {
		$this->mctCompany->deleteCompany();
	}

}
