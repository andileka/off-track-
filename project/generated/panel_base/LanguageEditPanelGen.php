<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/LanguageConnector.php');

/**
 * This is the base class for the the LanguageEditPanel class.  It uses the code-generated
 * LanguageModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a Language columns.
 *
 * Implement your customizations in the LanguageEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class LanguageEditPanelGen extends Panel
{
	/** @var LanguageConnector */
	public $mctLanguage;

	// Controls for Language's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtName;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtLocale;


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

		// Construct the LanguageConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctLanguage = LanguageConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on Language's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctLanguage->lblId_Create();
		$this->txtName = $this->mctLanguage->txtName_Create();
		$this->txtLocale = $this->mctLanguage->txtLocale_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctLanguage->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctLanguage->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctLanguage->saveLanguage($blnForceUpdate);
	}

	public function delete() {
		$this->mctLanguage->deleteLanguage();
	}

	// Check for records that may violate Unique Clauses
	public function validate() {
		$blnToReturn = true;
		if (($this->txtLocale) && ($objLanguage = Language::LoadByLocale($this->txtLocale->Text)) && ($objLanguage->Id != $this->mctLanguage->Language->Id )){
				$blnToReturn = false;
				$this->txtLocale->Warning = t("This value is already in use.");
			}
		return $blnToReturn;
	}
}
