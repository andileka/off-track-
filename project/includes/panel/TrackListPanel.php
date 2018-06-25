<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/TrackListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/TrackList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the Track class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class TrackListPanel extends TrackListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/TrackListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the TrackList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the TrackList creates the default columns.

	protected function dtgTracks_CreateColumns() 
	{
		$col = $this->dtgTracks->createNodeColumn("Id", QQN::Track()->Id);
		$col = $this->dtgTracks->createNodeColumn("Name", QQN::Track()->Name);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgTracks_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgTracks_EditClick'));
			$this->dtgTracks->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::Track()->Id, null, false, 0);
			$this->dtgTracks->removeCssClass('clickable-rows');
		}

		protected function dtgTracks_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
