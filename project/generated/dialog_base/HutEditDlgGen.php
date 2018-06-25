<?php

use QCubed as Q;
use QCubed\Exception\Caller;
use QCubed\Database\Exception\OptimisticLocking;
use QCubed\Project\Jqui\Dialog;


include (QCUBED_PROJECT_PANEL_DIR . '/HutEditPanel.php');

/**
* This is the HutEditDlgGen class.  It uses the code-generated
* HutEditPanel class, which has all the controls for editing
* a record in the hut table.
*
*
* @package My QCubed Application
*/
class HutEditDlgGen extends \QCubed\Project\Control\Dialog
{

	/** @var HutEditPanel  */
	protected $pnlHut;

	/**
	 * @param FormBase|ControlBase $objParentObject
	 * @param null|string $strControlId
	 * @throws Caller
	 */
	public function __construct($objParentObject = null, $strControlId = null)
    {
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (Caller $objExc) {
			$objExc->incrementOffset();
			throw $objExc;
		}

		$this->pnlHut = new HutEditPanel($this);
		$this->createButtons();
	}

	/**
	 * Create the buttons at the bottom of the dialog.
	 */
	protected function createButtons()
    {
		// Create Buttons
		$this->addButton(t('Save'), 'save', true, true, null, array('class'=>'ui-priority-primary'));
		$this->addButton(t('Cancel'), 'cancel');
		$this->addButton(t('Delete'), 'delete', false, false,
			sprintf(t('Are you SURE you want to DELETE this %s?'),  t('Hut')),
			array('class'=>'ui-button-left')
		);
		$this->addAction(new Q\Event\DialogButton(0, null, null, true), new Q\Action\AjaxControl($this, 'buttonClick'));
	}

	/**
	 * Load the dialog using primary keys.
	 *
	 * @param null|integer $intId
	 */
	public function load($intId = null)
    {
		$this->pnlHut->load($intId);
		$blnIsNew = is_null($intId);
		$this->showHideButton('delete', !$blnIsNew);	// show delete button if editing a previous record.

		if ($blnIsNew) {
			$strTitle = t('New') . ' ';
		} else {
			$strTitle = t('Edit') . ' ';
		};
		$strTitle .= 'Hut';
		$this->Title = $strTitle;
	}


	/**
	 * A button was clicked. Override to do something different than the default or process further.
	 * @param string $strFormId
	 * @param string $strControlId
	 * @param mixed $param
	 */
	public function buttonClick($strFormId, $strControlId, $param)
    {
		switch ($param) {
			case 'save':
				$this->save();
				break;

			case 'delete':
				$this->pnlHut->delete();
                $this->close();
				break;

			case 'cancel':
                $this->close();
                break;
		}
	}

   /**
    * Process a click on the Save button.
    */
    protected function save()
    {
        try {
            $this->pnlHut->save();
        }
        catch (OptimisticLocking $e) {
            $dlg = Dialog::alert(
                t("Another user has changed the information while you were editing it. Would you like to overwrite their changes, or refresh the page and try editing again?"),
                [t("Refresh"), t("Overwrite")]);
            $dlg->addAction(new Q\Event\DialogButton(0, null, null, true), new Q\Action\AjaxControl($this, "dlgOptimisticLocking_ButtonEvent"));
            return;
        }
        $this->close();
    }

   /**
    * An optimistic lock exception has fired and we have put a dialog on the screen asking the user what they want to do.
    * The user can either overwrite the data, or refresh and start the edit process over.
    *
    * @param string $strFormId      The form id
    * @param string $strControlId   The control id of the dialog
    * @param string $btn            The text on the button
    */
    protected function dlgOptimisticLocking_ButtonEvent($strFormId, $strControlId, $btn)
    {
        if ($btn == "Overwrite") {
            $this->pnlHut->save(true);
            $this->Form->getControl($strControlId)->close();
            $this->close();
        } else { // Refresh
            $this->Form->getControl($strControlId)->close();
            $this->pnlHut->refresh(true);
        }
    }

}
