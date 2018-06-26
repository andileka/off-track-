<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/CityListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/CityList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the City class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class CityListPanel extends CityListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/CityListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the CityList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the CityList creates the default columns.

	protected function dtgCities_CreateColumns() 
	{
		$col = $this->dtgCities->createNodeColumn("Id", QQN::City()->Id);
		$col = $this->dtgCities->createNodeColumn("Country Id", QQN::City()->CountryId);
		$col = $this->dtgCities->createNodeColumn("Postal Code", QQN::City()->PostalCode);
		$col = $this->dtgCities->createNodeColumn("Name", QQN::City()->Name);
		$col = $this->dtgCities->createNodeColumn("Admin Name 1", QQN::City()->AdminName1);
		$col = $this->dtgCities->createNodeColumn("Admin Code 1", QQN::City()->AdminCode1);
		$col = $this->dtgCities->createNodeColumn("Admin Name 2", QQN::City()->AdminName2);
		$col = $this->dtgCities->createNodeColumn("Admin Code 2", QQN::City()->AdminCode2);
		$col = $this->dtgCities->createNodeColumn("Admin Name 3", QQN::City()->AdminName3);
		$col = $this->dtgCities->createNodeColumn("Admin Code 3", QQN::City()->AdminCode3);
		$col = $this->dtgCities->createNodeColumn("Latitude", QQN::City()->Latitude);
		$col = $this->dtgCities->createNodeColumn("Longitude", QQN::City()->Longitude);
		$col = $this->dtgCities->createNodeColumn("Accuracy", QQN::City()->Accuracy);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgCities_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgCities_EditClick'));
			$this->dtgCities->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::City()->Id, null, false, 0);
			$this->dtgCities->removeCssClass('clickable-rows');
		}

		protected function dtgCities_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
