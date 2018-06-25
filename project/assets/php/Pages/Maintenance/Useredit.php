<?php

namespace Hikify\Pages\Maintenance;

class Useredit extends \QCubed\Control\Panel {
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtFirstName;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtLastName;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtEmail;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtMobilePhone;
	/**
	 *
	 * @var \QCubed\Project\Jqui\Button
	 */
	public $btnSave;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtpassword1;
	/**
	 *
	 * @var \QCubed\Project\Control\TextBox
	 */
	public $txtpassword2;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstType;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstLanguage;
	/**
	 *
	 * @var \QCubed\Project\Control\ListBox 
	 */
	public $lstPermissions;
	/**
	 *
	 * @var \QCubed\Project\Control\Checkbox 
	 */
	public $chkActive;
	/** @var \User */
	private $objUser;
	
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		
		$this->strTemplate			= __TEMPLATES__ .  '/pages/maintenance/user-edit.tpl.php';
		$this->objUser				= new \User();	
		\QCubed\Project\Application::executeJavaScript('
														var height = $(".wrapper").outerHeight();
														$(".content-wrapper").css("min-height",height+"px");
														$(".content-wrapper").css("height",height+"px")
													');
		$this->addCssFile("/project/assets/css/booking.css");	
		$this->addCssFile("/project/assets/css/boolean-button.css");	
		$this->Build();
		
		if(isset($_GET['id'])) {
			$objUser = \User::Load((int) $_GET['id']);
			$this->txtFirstName->Text									= $objUser->FirstName;
			$this->txtLastName->Text									= $objUser->LastName;
			$this->txtEmail->Text										= $objUser->Email;
			$this->txtMobilePhone->Text									= $objUser->MobilePhone;
			$this->chkActive->Checked									= ($objUser->Active)? true : false;
			$this->lstType->SelectedValue								= $objUser->Type;
			$this->lstLanguage->SelectedValue							= $objUser->Language;
			$this->lstPermissions->SelectedValue						= $objUser->PermissionGroupId;
			$this->objUser												= $objUser;
		}
		
	}
	public function Save() {
		if(!$this->Validate()) {
			\QCubed\Project\Application::Log('NOT VALID FORM');
			return;
		}
		
		if(!$this->objUser) {			
			$this->objUser = new \User();			
		}

		
		$this->objUser->FirstName			= $this->txtFirstName->Text;
		$this->objUser->LastName			= $this->txtLastName->Text;
		$this->objUser->Email				= $this->txtEmail->Text;
		$this->objUser->MobilePhone			= $this->txtMobilePhone->Text;
		$this->objUser->Language			= $this->lstLanguage->SelectedValue;
		$this->objUser->Type				= $this->lstType->SelectedValue;
		$this->objUser->Active				= $this->chkActive->Checked;
		$this->objUser->PermissionGroupId	= $this->lstPermissions->SelectedValue;
		
		if($this->txtpassword1->Text){
			$this->objUser->Password	= md5($this->txtpassword1->Text);
		}
		
		
        $this->objUser->Save();
                
		if(!isset($_GET['id'])){
			\QCubed\Project\Application::Redirect('/?c=maintenance&a=users');
		}
//		
	}
	public function Validate(){
		if($this->txtFirstName->Text && $this->txtLastName->Text && $this->txtEmail->Text){
			if($this->txtpassword1->Text === $this->txtpassword2->Text){
				$this->txtFirstName->removeCssClass("has-error");
				$this->txtLastName->removeCssClass("has-error");
				$this->txtEmail->removeCssClass("has-error");
				return true;
			}else{
				$this->txtpassword1->addCssClass("has-error");
				$this->txtpassword2->addCssClass("has-error");
			}
		}else{
			$this->txtFirstName->addCssClass("has-error");
			$this->txtLastName->addCssClass("has-error");
			$this->txtEmail->addCssClass("has-error");
			$this->txtpassword1->addCssClass("has-error");
			$this->txtpassword2->addCssClass("has-error");
		}
	}
	private function Build() {		
		$this->txtFirstName						= new \QCubed\Project\Control\TextBox($this);
		$this->txtFirstName->Placeholder		= tr('Firstname');
		
		$this->txtLastName						= new \QCubed\Project\Control\TextBox($this);
		$this->txtLastName->Placeholder			= tr('Lastname');
		
		$this->txtEmail							= new \QCubed\Project\Control\TextBox($this);
		$this->txtEmail->Placeholder			= tr("Email");
		$this->txtEmail->Required				= true;
		$this->txtEmail->addWrapperCssClass("input-group");
		$this->txtEmail->HtmlBefore				= "<span class='input-group-addon'><i class='fas fa-at'></i></span>";
		
		$this->txtMobilePhone					= new \QCubed\Project\Control\TextBox($this);
		$this->txtMobilePhone->Placeholder		= tr("Phone");
		$this->txtMobilePhone->Required			= true;
		$this->txtMobilePhone->addWrapperCssClass("input-group");
		$this->txtMobilePhone->HtmlBefore		= "<span class='input-group-addon'><i class='fas fa-phone'></i></span>";
		
		$this->btnSave							= \QCubed\Project\Control\Button::GetSaveButton($this, tr('Save User'));

		$this->txtpassword1						= new \QCubed\Project\Control\TextBox($this);
		$this->txtpassword1->Placeholder		= tr("Enter password");
		$this->txtpassword1->TextMode			= "PASSWORD";
		$this->txtpassword1->addWrapperCssClass("input-group");
		$this->txtpassword1->HtmlBefore			= "<span class='input-group-addon'><i class='fas fa-key'></i></span>";
		
		$this->txtpassword2						= new \QCubed\Project\Control\TextBox($this);
		$this->txtpassword2->Placeholder		= tr("Enter password");
		$this->txtpassword2->TextMode			= "PASSWORD";
		$this->txtpassword2->addWrapperCssClass("input-group");
		$this->txtpassword2->HtmlBefore			= "<span class='input-group-addon'><i class='fas fa-key'></i></span>";
		
		$this->lstType							= new \QCubed\Project\Control\ListBox($this);
		$arrTypes = array('admin', 'dev', 'expert');
		$this->lstType->addItem(tr('Select type'), null);
		foreach($arrTypes as $type){
			$this->lstType->addItem(ucfirst($type), $type);
		}
		$this->lstType->addWrapperCssClass("input-group");
		$this->lstType->HtmlBefore				= "<span class='input-group-addon'><i class='fas fa-users'></i></span>";
		
		$this->lstLanguage						= new \QCubed\Project\Control\ListBox($this);
		$arrLanguages = array('en_UK','nl_BE','nl_NL','fr_BE','fr_FR','fr_LU','de_DE','pl_PL','it_IT','es_ES');
		$this->lstLanguage->addItem(tr('Select language'), null);
		foreach($arrLanguages as $language){
			$this->lstLanguage->addItem($language, $language);
		}
		$this->lstLanguage->addWrapperCssClass("input-group");
		$this->lstLanguage->HtmlBefore			= "<span class='input-group-addon'><i class='fas fa-flag'></i></span>";
		
		$this->chkActive						= new \QCubed\Project\Jqui\Checkbox($this);
		
		$this->chkActive->HtmlBefore			= "<label class='chk_select_label'>";
		$this->chkActive->addWrapperCssClass("chk_select");
		$this->chkActive->HtmlAfter				= "<span>".tr("Active")."</span></label>";
		
		
		$this->lstPermissions					= \PermissionGroup::GetListBox($this);
		
		
	}

	
}
