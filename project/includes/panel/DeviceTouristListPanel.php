<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/DeviceTouristListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/DeviceTouristList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the DeviceTourist class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class DeviceTouristListPanel extends DeviceTouristListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/DeviceTouristListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the DeviceTouristList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the DeviceTouristList creates the default columns.

	protected function dtgDeviceTourists_CreateColumns() 
	{
		$col = $this->dtgDeviceTourists->createNodeColumn("Id", QQN::DeviceTourist()->Id);
		$col = $this->dtgDeviceTourists->createNodeColumn("Device", QQN::DeviceTourist()->Device);
		$col = $this->dtgDeviceTourists->createNodeColumn("Tourist", QQN::DeviceTourist()->Tourist);
		$col = $this->dtgDeviceTourists->createNodeColumn("Start Date", QQN::DeviceTourist()->StartDate);
		$col = $this->dtgDeviceTourists->createNodeColumn("End Date", QQN::DeviceTourist()->EndDate);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgDeviceTourists_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgDeviceTourists_EditClick'));
			$this->dtgDeviceTourists->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::DeviceTourist()->Id, null, false, 0);
			$this->dtgDeviceTourists->removeCssClass('clickable-rows');
		}

		protected function dtgDeviceTourists_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
