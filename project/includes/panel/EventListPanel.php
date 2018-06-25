<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/EventListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/EventList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the Event class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class EventListPanel extends EventListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/EventListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the EventList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the EventList creates the default columns.

	protected function dtgEvents_CreateColumns() 
	{
		$col = $this->dtgEvents->createNodeColumn("Id", QQN::Event()->Id);
		$col = $this->dtgEvents->createNodeColumn("Device", QQN::Event()->Device);
		$col = $this->dtgEvents->createNodeColumn("Type", QQN::Event()->Type);
		$col = $this->dtgEvents->createNodeColumn("Datetime", QQN::Event()->Datetime);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgEvents_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgEvents_EditClick'));
			$this->dtgEvents->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::Event()->Id, null, false, 0);
			$this->dtgEvents->removeCssClass('clickable-rows');
		}

		protected function dtgEvents_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
