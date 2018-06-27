<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/TouristAnswerEditPanelGen.php');

/**
 * This is the customizable subclass for the edit panel functionality
 * of the TouristAnswer class. This is where you should create your customizations to the edit
 * panel that edits a tourist_answer record.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class TouristAnswerEditPanel extends TouristAnswerEditPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		// Set AutoRenderChildren in order to use the PreferredRenderMethod attribute in each control
		// to render the controls. If you want more control, you can use the generated template
		// instead in your superclass and modify the template.
		$this->AutoRenderChildren = true;

		//$this->Template = QCUBED_PROJECT_PANEL_GEN_DIR . '/TouristAnswerEditPanel.tpl.php';
	}
}
