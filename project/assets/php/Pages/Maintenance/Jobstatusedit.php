<?php

namespace Hikify\Pages\Maintenance;

class Jobstatusedit extends \QCubed\Project\Control\Editor {
	public $txtNameEn;
	public $txtNameFr;
	public $txtNameNl;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Checkbox 
	 */
	public $chkActive;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Checkbox 
	 */
	public $chkSystem;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Button 
	 */
	public $btnSave;
	/** @var \JobStatus */
	public $pnlEdit;
	private $objStatus;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/jobstatus-edit.tpl.php';
		$this->objStatus = new \JobStatus();	
		$this->addCssFile("/project/assets/css/boolean-button.css");
		$this->Build();
		
		if(isset($_GET['id'])) {
			$objStatus = \JobStatus::Load((int) $_GET['id']);
			$this->txtNameEn->Text									= $objStatus->NameEn;
			$this->txtNameNl->Text									= $objStatus->NameNl;
			$this->txtNameFr->Text									= $objStatus->NameFr;
			$this->chkActive->Checked								= ($objStatus->Active == 1) ? true : false;
			$this->chkSystem->Checked								= ($objStatus->System == 1) ? true : false;
			
			($objStatus->System == 1) ? $this->btnSave->setCustomAttribute("disabled", true) : $this->btnSave->removeCustomAttribute ("disabled");
			
			$this->objStatus											= $objStatus;
		}
		
	}
	public function Save() {
		if(!$this->Validate()) {
			return;
		}
		
		if(!$this->objStatus) {			
			$this->objStatus = new \JobStatus();			
		}
		$check = \JobStatus::QuerySingle(
									\QCubed\Query\QQ::AndCondition(
										\QCubed\Query\QQ::Equal(\QQN::jobStatus()->NameNl, $this->txtNameNl->Text), 
										\QCubed\Query\QQ::Equal(\QQN::jobStatus()->NameEn,$this->txtNameEn->Text),
										\QCubed\Query\QQ::Equal(\QQN::jobStatus()->NameFr, $this->txtNameFr->Text),
										\QCubed\Query\QQ::NotEqual(\QQN::jobStatus()->Id, $this->objStatus->Id)
									));
		if(!$check){
			
			$this->objStatus->NameEn		= $this->txtNameEn->Text;
			$this->objStatus->NameFr		= $this->txtNameFr->Text;
			$this->objStatus->NameNl		= $this->txtNameNl->Text;
			$this->objStatus->Active		= $this->chkActive->Checked;
			$this->objStatus->System		= $this->chkSystem->Checked;
			$this->objStatus->Save();

			\QCubed\Project\Application::Redirect('/?c=maintenance&a=jobstatus');
		}else{
			$this->objForm->ShowAlert(tr('A job status with the same name already exists.'));
		}
	}
	private function Build() {		
		$this->pnlEdit = new \QCubed\Control\Panel($this);
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
		
		$this->chkSystem						= new \QCubed\Project\Jqui\Checkbox($this);
		$this->chkSystem->HtmlBefore			= "<label class='chk_select_label'>";
		$this->chkSystem->addWrapperCssClass("chk_select");
		$this->chkSystem->HtmlAfter				= "<span>".tr("System")."</span></label>";
		$this->chkSystem->Display				= false;
		
		$this->btnSave					= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Status'));
	}

	
}
