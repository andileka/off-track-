<?php

use QCubed\Control\Panel;
use QCubed\Project\Control\ControlBase;
use QCubed\Project\Control\FormBase;
use QCubed\Exception\Caller;
use \QCubed\Project\Application;

require (QCUBED_PROJECT_MODELCONNECTOR_DIR . '/UserConnector.php');

/**
 * This is the base class for the the UserEditPanel class.  It uses the code-generated
 * UserModelConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of a User columns.
 *
 * Implement your customizations in the UserEditPanel.php file, not here.
 * This file is overwritten every time you do a code generation, so any changes you make here will be lost.
 */
class UserEditPanelGen extends Panel
{
	/** @var UserConnector */
	public $mctUser;

	// Controls for User's Data Fields

	/** @var \QCubed\Control\Label */
	protected $lblId;

	/** @var \QCubed\Project\Control\ListBox */
	protected $lstCompany;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtEmail;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtPassword;

	/** @var \QCubed\Project\Control\TextBox */
	protected $txtSalt;


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

		// Construct the UserConnector
		// MAKE SURE we specify "$this" as the Connector's (and thus all subsequent controls') parent
		$this->mctUser = UserConnector::create($this);

		$this->createObjects();
	}

	/**
	 * Call ModelConnector's methods to create QControls based on User's data fields
	 **/
	protected function createObjects() {
		$this->lblId = $this->mctUser->lblId_Create();
		$this->lstCompany = $this->mctUser->lstCompany_Create();
		$this->txtEmail = $this->mctUser->txtEmail_Create();
		$this->txtPassword = $this->mctUser->txtPassword_Create();
		$this->txtSalt = $this->mctUser->txtSalt_Create();
	}

	/**
	 * @param null|integer $intId
	 **/
	public function load ($intId = null) {
		if (!$this->mctUser->Load ($intId)) {
			Application::displayAlert(t('Could not load the record. Perhaps it was deleted? Try again.'));
		}
	}


	/**
     * Refresh the objects in the panel, optionally loading from saved data in the database.
     *
     * @param boolean $blnReload
	 **/
	public function refresh ($blnReload = false) {
        $this->mctUser->refresh($blnReload);
	}


	public function save($blnForceUpdate = false) {
		$this->mctUser->saveUser($blnForceUpdate);
	}

	public function delete() {
		$this->mctUser->deleteUser();
	}

	// Check for records that may violate Unique Clauses
	public function validate() {
		$blnToReturn = true;
		if (($this->txtEmail) && ($objUser = User::LoadByEmail($this->txtEmail->Text)) && ($objUser->Id != $this->mctUser->User->Id )){
				$blnToReturn = false;
				$this->txtEmail->Warning = t("This value is already in use.");
			}
		return $blnToReturn;
	}
}
