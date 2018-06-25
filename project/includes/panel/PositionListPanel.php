<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/PositionListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/PositionList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the Position class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class PositionListPanel extends PositionListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/PositionListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the PositionList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the PositionList creates the default columns.

	protected function dtgPositions_CreateColumns() 
	{
		$col = $this->dtgPositions->createNodeColumn("Id", QQN::Position()->Id);
		$col = $this->dtgPositions->createNodeColumn("Lat", QQN::Position()->Lat);
		$col = $this->dtgPositions->createNodeColumn("Long", QQN::Position()->Long);
		$col = $this->dtgPositions->createNodeColumn("Height", QQN::Position()->Height);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgPositions_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgPositions_EditClick'));
			$this->dtgPositions->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::Position()->Id, null, false, 0);
			$this->dtgPositions->removeCssClass('clickable-rows');
		}

		protected function dtgPositions_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
