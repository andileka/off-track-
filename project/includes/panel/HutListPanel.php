<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/HutListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/HutList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the Hut class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class HutListPanel extends HutListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/HutListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the HutList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the HutList creates the default columns.

	protected function dtgHuts_CreateColumns() 
	{
		$col = $this->dtgHuts->createNodeColumn("Id", QQN::Hut()->Id);
		$col = $this->dtgHuts->createNodeColumn("Position", QQN::Hut()->Position);
		$col = $this->dtgHuts->createNodeColumn("Name", QQN::Hut()->Name);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgHuts_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgHuts_EditClick'));
			$this->dtgHuts->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::Hut()->Id, null, false, 0);
			$this->dtgHuts->removeCssClass('clickable-rows');
		}

		protected function dtgHuts_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
