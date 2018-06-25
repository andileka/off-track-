<?php

namespace Hikify\Pages\Maintenance;

class Jobtypeedit extends \QCubed\Project\Control\Editor {
	public $txtNameEn;
	public $txtNameFr;
	public $txtNameNl;
	public $chkActive;
	public $btnSave;
	/** @var \JobType */
	public $pnlEdit;
	/**
	 *
	 * @var \QCubed\Bootstrap\TextBox 
	 */
	public $txtColor;
	private $objJobtype;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/jobtype-edit.tpl.php';
		$this->objJobtype			= new \JobType();	
		$this->addCssFile("/project/assets/css/boolean-button.css");
		$this->addCssFile(__BOOTSTRAP_ADMINLTE_BOWER_COMPONENTS__."/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css");
		$this->addJavascriptFile(__BOOTSTRAP_ADMINLTE_BOWER_COMPONENTS__."/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js");
		$this->Build();
		\QCubed\Project\Application::executeJavaScript("$('.colorpicker').colorpicker();");
		
		if(isset($_GET['id'])) {
			$objJobtype = \JobType::Load((int) $_GET['id']);
			$this->txtNameEn->Text									= $objJobtype->NameEn;
			$this->txtNameNl->Text									= $objJobtype->NameNl;
			$this->txtColor->Text									= $objJobtype->Color;
			$this->txtNameFr->Text									= $objJobtype->NameFr;
			$this->chkActive->Checked								= ($objJobtype->Active == 1) ? true : false;
			
			$this->objJobtype										= $objJobtype;
		}
		
	}
	public function Save() {
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT VALID FORM');
			return;
		}
		
		if(!$this->objJobtype) {			
			$this->objJobtype = new \JobType();			
		}
		$check = \JobType::QuerySingle(
									\QCubed\Query\QQ::AndCondition(
										\QCubed\Query\QQ::Equal(\QQN::JobType()->NameNl, $this->txtNameNl->Text), 
										\QCubed\Query\QQ::Equal(\QQN::JobType()->NameEn,$this->txtNameEn->Text),
										\QCubed\Query\QQ::Equal(\QQN::JobType()->NameFr, $this->txtNameFr->Text),
										\QCubed\Query\QQ::NotEqual(\QQN::JobType()->Id, $this->objJobtype->Id)
									));
		if(!$check){
			$this->objJobtype->NameEn		= $this->txtNameEn->Text;
			$this->objJobtype->NameFr		= $this->txtNameFr->Text;
			$this->objJobtype->NameNl		= $this->txtNameNl->Text;
			$this->objJobtype->Color		= $this->txtColor->Text;
			$this->objJobtype->Active		= $this->chkActive->Checked;

			$this->objJobtype->Save();

			\QCubed\Project\Application::Redirect('/?c=maintenance&a=jobtype');
		}else{
			$this->objForm->ShowAlert(tr('A job type with the same name already exists.'));
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
		
		$this->txtColor					= new \QCubed\Bootstrap\TextBox($this);
		$this->txtColor->HtmlAfter		= "<div class='input-group-addon'></div>";
		$this->txtColor->WrapperCssClass = "input-group colorpicker col-sm-12";
		
		$this->chkActive						= new \QCubed\Project\Jqui\Checkbox($this);
		$this->chkActive->HtmlBefore			= "<label class='chk_select_label'>";
		$this->chkActive->addWrapperCssClass("chk_select");
		$this->chkActive->HtmlAfter				= "<span>".tr("Active")."</span></label>";
		
		$this->btnSave							= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save Jobtype'));
	}

	
}
