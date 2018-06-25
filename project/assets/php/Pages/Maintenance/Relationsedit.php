<?php

namespace Hikify\Pages\Maintenance;

class Relationsedit extends \QCubed\Control\Panel {
	public $btnSave;	
	
	/**
	 *
	 * @var \RelationRole
	 */
	public $lstRole;
	/**
	 *
	 * @var \Entity
	 */
	public $lstEntity;
	public $lblMaxAppointments;

	private $objRole;
	
	
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/relations-edit.tpl.php';
		$this->objRole			= new \RelationRole();	
		$this->Build();
		
		if(isset($_GET['id'])) {
			$this->SetRole(\RelationRole::Load((int) $_GET['id']));
		}
		
	}
	public function SetRole(\RelationRole $objRole){
		$this->objRole						= $objRole;
	}
	
	
	public function Save(){	
		if(!$this->objRole) {
			$this->objRole = new \RelationRole();
		}
		$this->objRole->Name				= $this->txtRole->Text;
		$this->objRole->Save();
		\QCubed\Project\Application::Redirect('index.php?c=maintenance&a=relationrole');//back to the list if job not found!
		
	}
	
	private function Build() {
		$this->lstRole					= \RelationRole::GetListBox($this);
		$this->lstEntity				= \Entity::GetListBox($this);
		$this->btnSave						= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Role'));
	}

	
}
