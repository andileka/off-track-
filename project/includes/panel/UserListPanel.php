<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/UserListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/UserList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the User class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class UserListPanel extends UserListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/UserListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the UserList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the UserList creates the default columns.

	protected function dtgUsers_CreateColumns() 
	{
		$col = $this->dtgUsers->createNodeColumn("Id", QQN::User()->Id);
		$col = $this->dtgUsers->createNodeColumn("Company", QQN::User()->Company);
		$col = $this->dtgUsers->createNodeColumn("Email", QQN::User()->Email);
		$col = $this->dtgUsers->createNodeColumn("Password", QQN::User()->Password);
		$col = $this->dtgUsers->createNodeColumn("Salt", QQN::User()->Salt);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgUsers_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgUsers_EditClick'));
			$this->dtgUsers->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::User()->Id, null, false, 0);
			$this->dtgUsers->removeCssClass('clickable-rows');
		}

		protected function dtgUsers_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
