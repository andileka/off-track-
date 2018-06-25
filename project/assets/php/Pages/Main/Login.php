<?php

namespace Hikify\Pages\Main;
use Hikify\Helpers\Security as SecurityHelper;

class Login extends \QCubed\Control\Panel {
	public $icoWait;

	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtEmail;

	/**
	 *
	 * @var \QCubed\Project\Control\TextBox 
	 */
	public $txtPassword;

	/**
	 *
	 * @var \QCubed\Project\Control\Button
	 */
	public $btnLogin;

	/**
	 * 
	 * @var \QCubed\Control\LinkButton
	 */
	public $btnForgotPassword;

	/**
	 *
	 * @var \QCubed\Project\Control\Checkbox
	 */
	public $chkRememberMe;
	
	/**
	 *
	 * @var \QCubed\Control\Label
	 */
	public $msgLogoutSuccess;

	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		if ($objParentObject->loggedout === true) {
			$this->msgLogoutSuccess = new \QCubed\Control\Label($this);
			$this->msgLogoutSuccess->Name = tr('You\'ve been succesfully logged out.');
		}
		$this->icoWait = new \QCubed\Control\WaitIcon($this);
		$this->strTemplate = __TEMPLATES__ . '/pages/main/login.tpl.php';
		$this->addCssFile("/project/assets/css/login.css");

		$this->txtEmail = new \QCubed\Project\Control\TextBox($this);
		$this->txtEmail->Name = tr('Email');
		$this->txtEmail->CrossScripting = \QCubed\Control\TextBoxBase::XSS_ALLOW;
		
		$this->txtPassword = new \QCubed\Project\Control\TextBox($this);
		$this->txtPassword->Name = tr('Password');
		$this->txtPassword->TextMode = \QCubed\Control\TextBoxBase::PASSWORD;

		$this->btnForgotPassword = new \QCubed\Control\LinkButton($this);
		$this->btnForgotPassword->Name = tr('Forgot password?');
		$this->btnForgotPassword->Text = tr('Forgot password?');

		$this->chkRememberMe = new \QCubed\Project\Control\Checkbox($this);
		$this->chkRememberMe->Name = tr('Remember me');

		$this->btnLogin = new \QCubed\Project\Control\Button($this, 'btnLogin');
		$this->btnLogin->Text = tr('Login');
		$this->btnLogin->HtmlEntities	= false;
		$this->btnLogin->PrimaryButton	= true;
		$this->btnLogin->AddCssClass('btn-primary');
		$this->btnLogin->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\AjaxControl($this, 'Login'));
	}

	public function Render($blnDisplayOutput = true) {
		return parent::Render($blnDisplayOutput);
	}

	public function Login(){
		SecurityHelper::DestroySession();
		SecurityHelper::Login($this->txtEmail->Text, $this->txtPassword->Text);
		\QCubed\Project\Application::Redirect('/');
	}
}
