<?php

namespace Hikify\Pages\Maintenance;

class Relationroleedit extends \QCubed\Project\Control\Editor{
	public $btnSave;	
	
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtRole;
	public $lblMaxAppointments;

	private $objRole;
	
	
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/relationrole-edit.tpl.php';
		$this->objRole			= new \RelationRole();	
		$this->Build();
		
		if(isset($_GET['id'])) {
			$this->SetRole(\RelationRole::Load((int) $_GET['id']));
		}
		
	}
	public function SetRole(\RelationRole $objRole){
		$this->objRole						= $objRole;
		$this->txtRole->Text				= $objRole->{\QCubed\Project\Application::$LocaleName};
	}
	
	
	public function Save(){	
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT VALID FORM');
			return;
		}
		
		if(!$this->objRole) {
			$this->objRole = new \RelationRole();
		}
		$this->objRole->Name				= $this->txtRole->Text;
		$this->objRole->Save();
		\QCubed\Project\Application::Redirect('index.php?c=maintenance&a=relationrole');//back to the list if job not found!
		
	}
	
	private function Build() {
		
		$this->txtRole					= new \QCubed\Project\Control\TextBox($this);
		$this->txtRole->Name			= tr('Role');
		$this->txtRole->Required		= true;
		
		/* End Userinfo*/
		
		$this->btnSave						= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Role'));
	}

	
}
