<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/TrackPointListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/TrackPointList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the TrackPoint class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class TrackPointListPanel extends TrackPointListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/TrackPointListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the TrackPointList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the TrackPointList creates the default columns.

	protected function dtgTrackPoints_CreateColumns() 
	{
		$col = $this->dtgTrackPoints->createNodeColumn("Id", QQN::TrackPoint()->Id);
		$col = $this->dtgTrackPoints->createNodeColumn("Track", QQN::TrackPoint()->Track);
		$col = $this->dtgTrackPoints->createNodeColumn("Position", QQN::TrackPoint()->Position);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgTrackPoints_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgTrackPoints_EditClick'));
			$this->dtgTrackPoints->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::TrackPoint()->Id, null, false, 0);
			$this->dtgTrackPoints->removeCssClass('clickable-rows');
		}

		protected function dtgTrackPoints_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
