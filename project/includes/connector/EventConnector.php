<?php

require(QCUBED_PROJECT_MODELCONNECTOR_GEN_DIR . '/EventConnectorGen.php');

/**
 * This is a ModelConnector customizable subclass, providing a Form or Panel access to event handlers
 * and QControls to perform the Create, Edit, and Delete functionality of the
 * Event class.  This code-generated class extends from
 * the generated ModelConnector class, which contains all the basic elements to help a Panel or Form
 * display an HTML form that can manipulate a single Event object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a EventModelConnector
 * class.
 *
 * This file is intended to be modified.  Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class EventConnector extends EventConnectorGen
{
    // Initialize fields with default values from database definition
/*
    public function __construct($objParentObject, Event $objEvent)
    {
        parent::__construct($objParentObject,$objEvent);
        if ( !$this->blnEditMode ){
            $this->objEvent->Initialize();
        }
    }
*/
}
