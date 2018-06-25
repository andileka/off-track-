<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/LogListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/LogList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the Log class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class LogListPanel extends LogListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/LogListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the LogList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the LogList creates the default columns.

	protected function dtgLogs_CreateColumns() 
	{
		$col = $this->dtgLogs->createNodeColumn("Id", QQN::Log()->Id);
		$col = $this->dtgLogs->createNodeColumn("User Id", QQN::Log()->UserId);
		$col = $this->dtgLogs->createNodeColumn("Type", QQN::Log()->Type);
		$col = $this->dtgLogs->createNodeColumn("Value", QQN::Log()->Value);
		$col = $this->dtgLogs->createNodeColumn("Datetime", QQN::Log()->Datetime);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgLogs_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgLogs_EditClick'));
			$this->dtgLogs->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::Log()->Id, null, false, 0);
			$this->dtgLogs->removeCssClass('clickable-rows');
		}

		protected function dtgLogs_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
