<?php

require(QCUBED_PROJECT_MODELCONNECTOR_GEN_DIR . '/UserConnectorGen.php');

/**
 * This is a ModelConnector customizable subclass, providing a Form or Panel access to event handlers
 * and QControls to perform the Create, Edit, and Delete functionality of the
 * User class.  This code-generated class extends from
 * the generated ModelConnector class, which contains all the basic elements to help a Panel or Form
 * display an HTML form that can manipulate a single User object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a UserModelConnector
 * class.
 *
 * This file is intended to be modified.  Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class UserConnector extends UserConnectorGen
{
    // Initialize fields with default values from database definition
/*
    public function __construct($objParentObject, User $objUser)
    {
        parent::__construct($objParentObject,$objUser);
        if ( !$this->blnEditMode ){
            $this->objUser->Initialize();
        }
    }
*/
}
