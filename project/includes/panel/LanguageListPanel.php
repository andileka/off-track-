<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/LanguageListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/LanguageList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the Language class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class LanguageListPanel extends LanguageListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/LanguageListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the LanguageList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the LanguageList creates the default columns.

	protected function dtgLanguages_CreateColumns() 
	{
		$col = $this->dtgLanguages->createNodeColumn("Id", QQN::Language()->Id);
		$col = $this->dtgLanguages->createNodeColumn("Name", QQN::Language()->Name);
		$col = $this->dtgLanguages->createNodeColumn("Locale", QQN::Language()->Locale);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgLanguages_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgLanguages_EditClick'));
			$this->dtgLanguages->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::Language()->Id, null, false, 0);
			$this->dtgLanguages->removeCssClass('clickable-rows');
		}

		protected function dtgLanguages_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
