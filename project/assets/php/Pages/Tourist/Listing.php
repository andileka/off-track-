<?php

namespace Hikify\Pages\Tourist;

class Listing extends \QCubed\Control\Panel {
	/** @var \TouristList */
	public $lstTourists;
	/** @var \QCubed\Project\Control\Button */
	public $btnNew;
	/**
	 *
	 * @var \QCubed\Control\Label
	 */
	public $lblFilter;
	/**
	 *
	 * @var \QCubed\Control\Panel
	 */
	public $pnlFilter;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtDevice;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtEntity;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtName;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstType;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstState;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstExpert;

	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);

		$this->strTemplate			= __TEMPLATES__ .  '/pages/tourist/listing.tpl.php';
		$this->addJavascriptFile(__BOOTSTRAP_ADMINLTE_BOWER_COMPONENTS__."/datatables.net/js/jquery.dataTables.min.js");
		$this->addCssFile("/project/assets/css/datatables.css");

		\QCubed\Project\Application::executeJavaScript("
				$(function () {
					$('.table').DataTable({
					  'paging'      : false,
					  'lengthChange': false,
					  'searching'   : false,
					  'ordering'    : true,
					  'order'		: [[7,'desc']],
					  'info'        : false,
					  'autoWidth'   : true
					})
				  })");

		$this->Build();

	}

	public function Databind(){
		$conditions = array();
		if($this->txtName->Text){
			$conditions[] = \QCubed\Query\QQ::like(\QQN::tourist()->Vehicle->Plate, $this->txtName->Text."%");
		}
		if($this->txtDevice->Text){
			$conditions[] = \QCubed\Query\QQ::equal(\QQN::tourist()->Number, $this->txtDevice->Text);
		}
		if($this->txtEntity->Text){
			$conditions[] = \QCubed\Query\QQ::orCondition(
						\QCubed\Query\QQ::like(\QQN::tourist()->EntityTourist->Entity->CompanyName, "%".$this->txtEntity->Text."%"),
						\QCubed\Query\QQ::like(\QQN::tourist()->EntityTourist->Entity->FirstName, "%".$this->txtEntity->Text."%")
						);
		}
		if($this->lstState->SelectedValue){
			$conditions[] = \QCubed\Query\QQ::equal(\QQN::tourist()->Status, $this->lstState->SelectedValue);
		}
		if($this->lstExpert->SelectedValue){
			$conditions[] = \QCubed\Query\QQ::equal(\QQN::tourist()->Appointment->ExpertId, $this->lstExpert->SelectedValue);
		}
		if(count($conditions) > 0) {
			$this->lstTourists->Condition = \QCubed\Query\QQ::andCondition($conditions);
		} else {
			$conditions[] = \QCubed\Query\QQ::like(\QQN::tourist()->Vehicle->Plate, "%");
			$this->lstTourists->Condition = \QCubed\Query\QQ::orCondition($conditions);
		}
		$this->lstTourists->Databind();
	}


	private function Build() {
		$this->btnNew				= new \QCubed\Project\Control\Button($this);
		$this->btnNew->Text			= tr('New tourist');
		$this->btnNew->AddCssClass('btn btn-flat btn-default newbutton');
		$this->btnNew->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\Redirect('/?c=tourist&a=edit'));

		$this->lstTourists							= new \TouristList($this);
		$this->lstTourists->addWrapperCssClass("table-responsive");
		$this->lstTourists->CssClass				= 'table no-margin';

//		$this->lstTourists->AddJavascriptRowAction('tourist','edit');
		$this->lstTourists->CreateColumns();

		$this->pnlFilter = self::ShowFilter();
	}

	protected function ShowFilter(){
		$this->lblFilter					= new \QCubed\Control\Label($this);
		$this->lblFilter->Text				= tr('Filter');

		$this->txtName						= new \QCubed\Project\Control\TextBox($this);
		$this->txtName->Placeholder			= tr('Tourist');
		$this->txtName->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'Databind'));

		$this->txtDevice					= new \QCubed\Project\Control\TextBox($this);
		$this->txtDevice->Placeholder		= tr('Device');
		$this->txtDevice->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\AjaxControl($this, 'Databind'));

		
	}


}
