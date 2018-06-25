<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/TouristListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/TouristList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the Tourist class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class TouristListPanel extends TouristListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/TouristListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the TouristList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the TouristList creates the default columns.

	protected function dtgTourists_CreateColumns() 
	{
		$col = $this->dtgTourists->createNodeColumn("Id", QQN::Tourist()->Id);
		$col = $this->dtgTourists->createNodeColumn("Name", QQN::Tourist()->Name);
		$col = $this->dtgTourists->createNodeColumn("Passport", QQN::Tourist()->Passport);
		$col = $this->dtgTourists->createNodeColumn("Contactinfo", QQN::Tourist()->Contactinfo);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgTourists_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgTourists_EditClick'));
			$this->dtgTourists->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::Tourist()->Id, null, false, 0);
			$this->dtgTourists->removeCssClass('clickable-rows');
		}

		protected function dtgTourists_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
