<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/TouristAnswerListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/TouristAnswerList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the TouristAnswer class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class TouristAnswerListPanel extends TouristAnswerListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/TouristAnswerListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the TouristAnswerList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the TouristAnswerList creates the default columns.

	protected function dtgTouristAnswers_CreateColumns() 
	{
		$col = $this->dtgTouristAnswers->createNodeColumn("Id", QQN::TouristAnswer()->Id);
		$col = $this->dtgTouristAnswers->createNodeColumn("Tourist Id", QQN::TouristAnswer()->TouristId);
		$col = $this->dtgTouristAnswers->createNodeColumn("Question Id", QQN::TouristAnswer()->QuestionId);
		$col = $this->dtgTouristAnswers->createNodeColumn("Answer", QQN::TouristAnswer()->Answer);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgTouristAnswers_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgTouristAnswers_EditClick'));
			$this->dtgTouristAnswers->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::TouristAnswer()->Id, null, false, 0);
			$this->dtgTouristAnswers->removeCssClass('clickable-rows');
		}

		protected function dtgTouristAnswers_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
