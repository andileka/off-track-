<?php

namespace Hikify\Pages\Maintenance;

class Teamedit extends \QCubed\Project\Control\Editor {
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtNameEn;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtNameFr;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtNameNl;
	/**
	 *
	 * @var \QCubed\Project\Control\Button
	 */
	public $btnSave;
	/**
	 *
	 * @var \QCubed\Project\Control\Checkbox
	 */
	public $chkActive;
	/** @var \Team */
	private $objTeam;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/team-edit.tpl.php';
		$this->addCssFile("/project/assets/css/boolean-button.css");
		$this->objTeam				= new \Team();	
		$this->Build();
		
		if(isset($_GET['id'])) {
			$objTeam = \Team::Load((int) $_GET['id']);
			$this->txtNameEn->Text									= $objTeam->NameEn;
			$this->txtNameNl->Text									= $objTeam->NameNl;
			$this->txtNameFr->Text									= $objTeam->NameFr;
			$this->chkActive->Checked								= ($objTeam->Active == 1);
			
			$this->objTeam											= $objTeam;
		}
		
	}
	public function Save() {
		\QCubed\Project\Application::Log('Save');
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT VALID FORM');
			return;
		}
		
		if(!$this->objTeam) {			
			$this->objTeam = new \Team();			
		}
		$check = \Team::QuerySingle(
									\QCubed\Query\QQ::AndCondition(
										\QCubed\Query\QQ::Equal(\QQN::Team()->NameNl, $this->txtNameNl->Text), 
										\QCubed\Query\QQ::Equal(\QQN::Team()->NameEn,$this->txtNameEn->Text),
										\QCubed\Query\QQ::Equal(\QQN::Team()->NameFr, $this->txtNameFr->Text),
										\QCubed\Query\QQ::NotEqual(\QQN::Team()->Id, $this->objTeam->Id)
									));
		if(!$check){
			$this->objTeam->Active				= $this->chkActive->Checked;
			$this->objTeam->NameEn				= $this->txtNameEn->Text;
			$this->objTeam->NameFr				= $this->txtNameFr->Text;
			$this->objTeam->NameNl				= $this->txtNameNl->Text;

			$this->objTeam->Save();

			\QCubed\Project\Application::Log('Save3');

			\QCubed\Project\Application::Redirect('/?c=maintenance&a=teams');
		}else{
			$this->objForm->ShowAlert(tr('A team with the same name already exists.'));
		}
	}
	private function Build() {		
		$this->txtNameEn				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameEn->Name			= tr('Name EN');
		$this->txtNameEn->Required		= true;
		
		$this->txtNameFr				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameFr->Name			= tr('Name FR');
		$this->txtNameFr->Required		= true;
		
		$this->txtNameNl				= new \QCubed\Project\Control\TextBox($this);
		$this->txtNameNl->Name			= tr('Name NL');
		$this->txtNameNl->Required		= true;
		
		$this->chkActive						= new \QCubed\Project\Jqui\Checkbox($this);
		
		$this->chkActive->HtmlBefore			= "<label class='chk_select_label'>";
		$this->chkActive->addWrapperCssClass("chk_select");
		$this->chkActive->HtmlAfter				= "<span>".tr("Active")."</span></label>";
		
		$this->btnSave					= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Team'));
	}

	
}
