<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/DeviceListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/DeviceList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the Device class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class DeviceListPanel extends DeviceListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/DeviceListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the DeviceList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the DeviceList creates the default columns.

	protected function dtgDevices_CreateColumns() 
	{
		$col = $this->dtgDevices->createNodeColumn("Id", QQN::Device()->Id);
		$col = $this->dtgDevices->createNodeColumn("Pac", QQN::Device()->Pac);
		$col = $this->dtgDevices->createNodeColumn("Serial", QQN::Device()->Serial);
		$col = $this->dtgDevices->createNodeColumn("Company", QQN::Device()->Company);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgDevices_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgDevices_EditClick'));
			$this->dtgDevices->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::Device()->Id, null, false, 0);
			$this->dtgDevices->removeCssClass('clickable-rows');
		}

		protected function dtgDevices_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
