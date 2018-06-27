<?php
require(QCUBED_PROJECT_PANEL_GEN_DIR . '/QuestionListPanelGen.php');
require(QCUBED_PROJECT_MODELCONNECTOR_DIR . '/QuestionList.php');

/**
 * This is the customizable subclass for the list panel functionality
 * of the Question class.
 *
 * This file is intended to be modified. Subsequent code regenerations will NOT modify
 * or overwrite this file.
 */
class QuestionListPanel extends QuestionListPanelGen
{
	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);

		/**
		 * Default is just to render everything generic. Comment out the AutoRenderChildren line, and uncomment the
		 * template line to use a template for greater customization of how the panel draws its contents.
		 **/
		$this->AutoRenderChildren = true;
		//$this->Template =  QCUBED_PROJECT_PANEL_GEN_DIR . '/QuestionListPanel.tpl.php';
	}

/*
	 Uncomment this block to directly create the columns here, rather than creating them in the QuestionList connector.
	 You can then modify the column creation process by editing the function below. Or, you can instead call the parent function 
	 and modify the columns after the QuestionList creates the default columns.

	protected function dtgQuestions_CreateColumns() 
	{
		$col = $this->dtgQuestions->createNodeColumn("Id", QQN::Question()->Id);
		$col = $this->dtgQuestions->createNodeColumn("Question", QQN::Question()->Question);
	}

*/	
		
/*
	 Uncomment this block to use an Edit column instead of clicking on a highlighted row in order to edit an item.

		protected $pxyEditRow;

		protected function dtgQuestions_MakeEditable () 
		{
			$this->>pxyEditRow = new \QCubed\Control\Proxy($this);
			$this->>pxyEditRow->addAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'dtgQuestions_EditClick'));
			$this->dtgQuestions->createLinkColumn(t('Edit'), t('Edit'), $this->>pxyEditRow, QQN::Question()->Id, null, false, 0);
			$this->dtgQuestions->removeCssClass('clickable-rows');
		}

		protected function dtgQuestions_EditClick($strFormId, $strControlId, $param) 
		{
			$this->editItem($param);
		}
*/	



}
