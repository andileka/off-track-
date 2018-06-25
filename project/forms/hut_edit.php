<?php

use QCubed as Q;
use QCubed\Project\Application;
use QCubed\Project\Control\Dialog;
use QCubed\Project\Control\FormBase;
use QCubed\Project\Control\ControlBase;

// Load the QCubed Development Framework
require('../qcubed.inc.php');

require(QCUBED_PROJECT_PANEL_DIR . '/HutEditPanel.php');

/**
 * This is a draft FormBase object to do Create, Edit, and Delete functionality
 * of the Hut class.  It uses the code-generated
 * HutConnector class, which has methods to help with
 * easily creating/defining controls to modify the fields of Hut columns.
 *
 * Any display customizations and presentation-tier logic can be implemented
 * here by overriding existing or implementing new methods, properties and variables.
 */
class HutEditForm extends FormBase
{

    /** @var HutEditPanel  */
	protected $pnlHut;

	/** @var \QCubed\Project\Control\Button  */
	protected $btnSave;
	/** @var \QCubed\Project\Control\Button  */
	protected $btnCancel;
	/** @var \QCubed\Project\Control\Button  */
	protected $btnDelete;

	// Override Form Event Handlers as Needed
	protected function formRun() {
		parent::formRun();

        // If your app requires a login, or some other kind of authroization step, this is the place to do that
		Application::checkAuthorized();
	}

//	protected function formLoad() {}


    protected function formCreate() {
		parent::formCreate();

		$this->pnlHut = new HutEditPanel($this);
		$intId = Application::instance()->context()->queryStringItem('intId');
	    $this->pnlHut->load($intId);
		$this->createButtons();
	}


    /**
	 * Create the buttons at the bottom of the dialog.
	 */
	protected function CreateButtons() {
		// Create Buttons and Actions on this Form
		$this->btnSave = new \QCubed\Project\Control\Button($this);
		$this->btnSave->Text = t('Save');
		$this->btnSave->addAction(new Q\Event\Click(), new Q\Action\Ajax('btnSave_Click'));
		$this->btnSave->CausesValidation = true;

		$this->btnCancel = new \QCubed\Project\Control\Button($this);
		$this->btnCancel->Text = t('Cancel');
		$this->btnCancel->addAction(new Q\Event\Click(), new Q\Action\Ajax('btnCancel_Click'));

		$this->btnDelete = new \QCubed\Project\Control\Button($this);
		$this->btnDelete->Text = t('Delete');
		$this->btnDelete->addAction(new Q\Event\Click(), new Q\Action\Confirm(sprintf(t('Are you SURE you want to DELETE this %s?'), t('Hut'))));
		$this->btnDelete->addAction(new Q\Event\Click(), new Q\Action\Ajax('btnDelete_Click'));
		$this->btnDelete->Visible = $this->pnlHut->mctHut->EditMode;
	}


   /**
    * Process a click on the Save button.
    *
    * @param $strFormId
    * @param $strControlId
    * @param $strParameter
    */
    protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
        try {
		    $this->pnlHut->Save();
        }
        catch (Q\Exception\OptimisticLocking $e) {
            $dlg = Dialog::alert (
                t("Another user has changed the information while you were editing it. Would you like to overwrite their changes, or refresh the page and try editing again?"),
                [t("Refresh"), t("Overwrite")]);
            $dlg->addAction(new Q\Event\DialogButton(0, null, null, true), new Q\Action\Ajax("dlgOptimisticLocking_ButtonEvent"));
            return;
        }
		$this->redirectToListPage();
	}

   /**
    * An optimistic lock exception has fired and we have put a dialog on the screen asking the user what they want to do.
    * The user can either overwrite the data, or refresh and start the edit process over.
    *
    * @param string $strFormId      The form id
    * @param string $strControlId   The control id of the dialog
    * @param string $btn            The text on the button
    */
    protected function dlgOptimisticLocking_ButtonEvent($strFormId, $strControlId, $btn) {
        if ($btn == "Overwrite") {
            $this->pnlHut->save(true);
            $this->getControl($strControlId)->close();
            $this->redirectToListPage();
        } else { // Refresh
            $this->getControl($strControlId)->close();
            $this->pnlHut->refresh(true);
        }
    }

   /**
    * Process a click of the delete button.
    *
    * @param string $strFormId      The form id
    * @param string $strControlId   The control id of the dialog
    * @param string $strParameter   The control parameter, not used
    */
	protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {
		$this->pnlHut->delete();
		$this->redirectToListPage();
	}

   /**
    * Process a click of the cancel button.
    *
    * @param string $strFormId      The form id
    * @param string $strControlId   The control id of the dialog
    * @param string $strParameter   The control parameter, not used
    */
	protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->redirectToListPage();
	}

   /**
    * The user has pressed one of the buttons, and now wants to go back to the list page.
    * Override this if you have another way of going to the list page.
    *
    * @param string $strFormId      The form id
    * @param string $strControlId   The control id of the dialog
    * @param string $strParameter   The control parameter, not used
    */
	protected function redirectToListPage() {
		Application::redirect(QCUBED_FORMS_URL . '/hut_list.php',
            false); // Putting false here is important to preventing an optimistic locking exception as a result of the user pressing the back button on the browser
	}

}

// Go ahead and run this form object to render the page and its event handlers, implicitly using
// hut_edit.tpl.php as the included HTML template file
HutEditForm::run('HutEditForm');
