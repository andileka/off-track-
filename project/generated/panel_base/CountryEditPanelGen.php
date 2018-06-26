<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/CountryConnector.php');

/**
 * This is the base class for the the CountryEditPanel class.  It uses the code-generated
 * CountryModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a Country columns.
 *
 * Implement your customizations in the CountryEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class CountryEditPanelGen extends Panel
{
	/** @var CountryConnector */
	public $mctCountry;

	// Controls for Country's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtIsoCode;

	/** @var \QCubed\Control\IntegerTextBox */
	protected $txtTelCode;

	/** @var \QCubed\Project\Control\Checkbox */
	protected $chkEuropeanUnion;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtNameEn;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtNameNl;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtNameFr;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtNameEs;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtNameIt;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtNameDe;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtNamePl;


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

		// Construct the CountryConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctCountry = CountryConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on Country's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctCountry->lblId_Create();
		$this->txtIsoCode = $this->mctCountry->txtIsoCode_Create();
		$this->txtTelCode = $this->mctCountry->txtTelCode_Create();
		$this->chkEuropeanUnion = $this->mctCountry->chkEuropeanUnion_Create();
		$this->txtNameEn = $this->mctCountry->txtNameEn_Create();
		$this->txtNameNl = $this->mctCountry->txtNameNl_Create();
		$this->txtNameFr = $this->mctCountry->txtNameFr_Create();
		$this->txtNameEs = $this->mctCountry->txtNameEs_Create();
		$this->txtNameIt = $this->mctCountry->txtNameIt_Create();
		$this->txtNameDe = $this->mctCountry->txtNameDe_Create();
		$this->txtNamePl = $this->mctCountry->txtNamePl_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctCountry->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctCountry->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctCountry->saveCountry($blnForceUpdate);
	}

	public function delete() {
		$this->mctCountry->deleteCountry();
	}

	// Check for records that may violate Unique Clauses
	public function validate() {
		$blnToReturn = true;
		if (($this->txtIsoCode) && ($objCountry = Country::LoadByIsoCode($this->txtIsoCode->Text)) && ($objCountry->Id != $this->mctCountry->Country->Id )){
				$blnToReturn = false;
				$this->txtIsoCode->Warning = t("This value is already in use.");
			}
		return $blnToReturn;
	}
}
