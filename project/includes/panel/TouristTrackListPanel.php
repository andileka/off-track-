<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/TouristTrackListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/TouristTrackList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the TouristTrack class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class TouristTrackListPanel extends TouristTrackListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/TouristTrackListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the TouristTrackList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the TouristTrackList creates the default columns.

	protected function dtgTouristTracks_CreateColumns() 
	{
		$col = $this->dtgTouristTracks->createNodeColumn("Id", QQN::TouristTrack()->Id);
		$col = $this->dtgTouristTracks->createNodeColumn("Tourist", QQN::TouristTrack()->Tourist);
		$col = $this->dtgTouristTracks->createNodeColumn("Track", QQN::TouristTrack()->Track);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgTouristTracks_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgTouristTracks_EditClick'));
			$this->dtgTouristTracks->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::TouristTrack()->Id, null, false, 0);
			$this->dtgTouristTracks->removeCssClass('clickable-rows');
		}

		protected function dtgTouristTracks_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
