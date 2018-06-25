<?php
use QCubed as Q;
use QCubed\Project\Application;
use QCubed\Project\Control\Dialog;
use QCubed\Project\Control\FormBase;
use QCubed\Project\Control\ControlBase;

// Load the QCubed Development Framework
require('../qcubed.inc.php');

require(QCUBED_PROJECT_PANEL_DIR . '/TrackPointListPanel.php');

/**
 * This is a draft FormBase object to do the List All functionality
 * of the TrackPoint class, and is a starting point for the form object.
 *
 * Any display customizations and presentation-tier logic can be implemented
 * here by overriding existing or implementing new methods, properties and variables.
 */
class TrackPointListForm extends FormBase
{
    protected $pnlNav;
    protected $pnlTrackPointList;

    // Override Form Event Handlers as Needed
    protected function formRun() {
        parent::formRun();

        // If your app requires a login, or some other kind of authroization step, this is the place to do that
        Application::checkAuthorized();
    }

    protected function formCreate() {
        $this->pnlNav = new NavPanel($this);
        $this->pnlTrackPointList = new TrackPointListPanel($this);
    }
}

// Go ahead and run this form object to generate the page and event handlers, implicitly using
// track_point_list.tpl.php as the included HTML template file
TrackPointListForm::run('TrackPointListForm');