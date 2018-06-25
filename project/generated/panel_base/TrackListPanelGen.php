<?php

use QCubed as Q;
use QCubed\Project\Application;
use QCubed\Query\QQ;
use QCubed\Control\Panel;
use QCubed\Project\Control\TextBox;
use QCubed\Query\Condition\ConditionInterface as QQCondition;



/**
 * This is the base list class for the  Track class.
 *
 * Do not edit this file, this file is overwritten on any code regenerations. Make any changes you need to the subclass.
 *
 */
abstract class TrackListPanelGen extends \QCubed\Control\Panel
{
	/** @var Panel **/
	protected $pnlFilter;

	/** @var TextBox **/
	protected $txtFilter;

	/** @var Panel **/
	protected $pnlButtons;

	/** @var Button **/
	protected $btnNew;

	/** @var TrackList **/
	protected $dtgTracks;


	public function __construct($objParent, $strControlId = null) {
		parent::__construct($objParent, $strControlId);
		$this->dtgTracks_Create();
		$this->createFilterPanel();
		$this->dtgTracks->setDataBinder('BindData', $this);
		$this->createButtonPanel();
	}

   /**
	* Creates the data grid and prepares it to be row clickable. Override for additional creation operations.
	**/
	protected function dtgTracks_Create() 
	{
		$this->dtgTracks = new TrackList($this);
		$this->dtgTracks_CreateColumns();
		$this->dtgTracks_MakeEditable();
		$this->dtgTracks->RowParamsCallback = [$this, "dtgTracks_GetRowParams"];
        $this->dtgTracks->LinkedNode = QQN::Track();
	}

   /**
	* Calls the list connector to add the columns. Override to customize column creation.
	**/
	protected function dtgTracks_CreateColumns() 
	{
		$this->dtgTracks->createColumns();
	}
    /**
     * Make the datagrid editable
     */
	protected function dtgTracks_MakeEditable() 
	{
		$this->dtgTracks->addAction(new Q\Event\CellClick(0, null, null, true), new Q\Action\AjaxControl($this, 'dtgTracks_CellClick', null, null, Q\Event\CellClick::ROW_VALUE));
		$this->dtgTracks->addCssClass('clickable-rows');
	}

    /**
     * Respond to a cell click
     * @param string $strFormId The form id
     * @param string $strControlId The control id of the control clicked on.
     * @param mixed $param Params coming from the cell click. In this situations, it is a string containing the id of row clicked.
     */
	protected function dtgTracks_CellClick($strFormId, $strControlId, $param) 
	{
		if ($param) {
			$this->editItem($param);
		}
	}
    /**
     * Get row parameters for the row tag
     * 
     * @param mixed $objRowObject   A database object
     * @param int $intRowIndex      The row index
     * @return array
     */
	public function dtgTracks_GetRowParams($objRowObject, $intRowIndex) 
	{
		$strKey = $objRowObject->primaryKey();
		$params['data-value'] = $strKey;
		return $params;
	}

	/**
	 *
	 **/
	protected function createFilterPanel() {
		$this->pnlFilter = new Panel($this);	// div wrapper for filter objects
		$this->pnlFilter->AutoRenderChildren = true;

		$this->txtFilter = new TextBox($this->pnlFilter);
		$this->txtFilter->Placeholder = t('Search...');
		$this->txtFilter->TextMode = \QCubed\Control\TextBoxBase::SEARCH;
		$this->addFilterActions();
	}

	protected function addFilterActions() {
		$this->txtFilter->addAction(new \QCubed\Event\Input(300), new \QCubed\Action\AjaxControl ($this, 'filterChanged'));
		$this->txtFilter->addActionArray(new \QCubed\Event\EnterKey(),
			[
				new Q\Action\AjaxControl($this, 'FilterChanged'),
				new Q\Action\Terminate()
			]
		);
	}

	protected function filterChanged() {
		$this->dtgTracks->refresh();
	}

	/**
	 *	Bind Data to the list control.
	 **/
	public function bindData() {
		$objCondition = $this->getCondition();
		$this->dtgTracks->bindData($objCondition);
	}


	/**
	 *  Get the condition for the data binder.
	 *  @return QQCondition;
	 **/
	protected function getCondition() {
		$strSearchValue = $this->txtFilter->Text;
		$strSearchValue = trim($strSearchValue);

		if (is_null($strSearchValue) || $strSearchValue === '') {
			 return \QCubed\Query\QQ::all();
		} else {
			return \QCubed\Query\QQ::orCondition(
				\QCubed\Query\QQ::equal(QQN::Track()->Id, $strSearchValue),
            \QCubed\Query\QQ::like(QQN::Track()->Name, "%" . $strSearchValue . "%")
			);
		}

	}



	/**
	 *
	 **/
	protected function createButtonPanel() {
		$this->pnlButtons = new \QCubed\Control\Panel ($this);
		$this->pnlButtons->AutoRenderChildren = true;

		$this->btnNew = new \QCubed\Project\Control\Button ($this->pnlButtons);
		$this->btnNew->Text = t('New');
		$this->btnNew->addAction(new Q\Event\Click(), new Q\Action\AjaxControl ($this, 'btnNew_Click'));
	}

	protected function btnNew_Click() {
		$this->editItem();
	}


protected function editItem($strKey = null) {
		$strQuery = '';
		if ($strKey) {
			$strQuery =  '?intId=' . $strKey;
		}
		$strEditPageUrl = QCUBED_FORMS_URL . '/track_edit.php' . $strQuery;
		Application::redirect($strEditPageUrl);
	}

}
