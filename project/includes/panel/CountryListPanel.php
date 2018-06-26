<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/CountryListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/CountryList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the Country class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class CountryListPanel extends CountryListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/CountryListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the CountryList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the CountryList creates the default columns.

	protected function dtgCountries_CreateColumns() 
	{
		$col = $this->dtgCountries->createNodeColumn("Id", QQN::Country()->Id);
		$col = $this->dtgCountries->createNodeColumn("Iso Code", QQN::Country()->IsoCode);
		$col = $this->dtgCountries->createNodeColumn("Tel Code", QQN::Country()->TelCode);
		$col = $this->dtgCountries->createNodeColumn("European Union", QQN::Country()->EuropeanUnion);
		$col = $this->dtgCountries->createNodeColumn("Name En", QQN::Country()->NameEn);
		$col = $this->dtgCountries->createNodeColumn("Name Nl", QQN::Country()->NameNl);
		$col = $this->dtgCountries->createNodeColumn("Name Fr", QQN::Country()->NameFr);
		$col = $this->dtgCountries->createNodeColumn("Name Es", QQN::Country()->NameEs);
		$col = $this->dtgCountries->createNodeColumn("Name It", QQN::Country()->NameIt);
		$col = $this->dtgCountries->createNodeColumn("Name De", QQN::Country()->NameDe);
		$col = $this->dtgCountries->createNodeColumn("Name Pl", QQN::Country()->NamePl);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgCountries_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgCountries_EditClick'));
			$this->dtgCountries->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::Country()->Id, null, false, 0);
			$this->dtgCountries->removeCssClass('clickable-rows');
		}

		protected function dtgCountries_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
