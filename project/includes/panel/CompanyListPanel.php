<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/CompanyListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/CompanyList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the Company class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class CompanyListPanel extends CompanyListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/CompanyListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the CompanyList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the CompanyList creates the default columns.

	protected function dtgCompanies_CreateColumns() 
	{
		$col = $this->dtgCompanies->createNodeColumn("Id", QQN::Company()->Id);
		$col = $this->dtgCompanies->createNodeColumn("Name", QQN::Company()->Name);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgCompanies_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgCompanies_EditClick'));
			$this->dtgCompanies->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::Company()->Id, null, false, 0);
			$this->dtgCompanies->removeCssClass('clickable-rows');
		}

		protected function dtgCompanies_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
