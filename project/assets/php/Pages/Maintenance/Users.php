<?php

namespace Hikify\Pages\Maintenance;

class Users extends \QCubed\Control\Panel {

	public $lblFilter;


	public $pnlFilter;
	public $txtNumber;
	public $txtEntity;
	public $lstType;
	public $btnNew;
	/** @var \UserList */
	public $lstUsers;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/users.tpl.php';
		$this->addCssFile("/project/assets/css/datatables.css");	
		$this->Build();
		
	}
	
	private function Build() {		
		
		$this->lblFilter			= new \QCubed\Control\Label($this);
		$this->lblFilter->Text		= tr('Filter');
		
		$this->pnlFilter			= self::ShowFilter();
		
		$this->btnNew				= new \QCubed\Project\Control\Button($this);
		$this->btnNew->Text			= tr('New User');
		$this->btnNew->AddCssClass('btn btn-flat btn-default newbutton');
		$this->btnNew->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\Redirect('/?c=maintenance&a=useredit'));
		
		$this->lstUsers				= new \UserList($this);
		$this->lstUsers->CssClass	= 'user_table table';
		$this->lstUsers->AddJavascriptRowAction('maintenance','useredit');
		$this->lstUsers->CreateColumns();
		
	}
	
	protected function ShowFilter(){
		$this->lblFilter				= new \QCubed\Control\Label($this);
		$this->lblFilter->Text			= tr('Filter');
		
		$this->txtNumber				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNumber->Placeholder	= tr('Number');
		
		$this->txtEntity				= new \QCubed\Project\Control\TextBox($this);
		$this->txtEntity->Placeholder	= tr('Entity');
		
		$this->lstType					= \EntityType::GetListBox($this);
		
	}
	
}
