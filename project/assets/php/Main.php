<?php

namespace Hikify;
use Hikify\Helpers\Security as SecurityHelper;

/**
 * class Main
 * calls the correct controller based on the variables in the url
 * and loads it into the page.
 */
class Main extends \QCubed\Project\Control\FormBase {
    const ANNOYANCE = 10; // less is more
    // Controls
    public $pnlAppController;
	public $ctrl	= 'main';	// GET 'c' param
	public $action	= 'index';	// GET 'a' param
    /**
	 *
	 * @var Panels\Navigator
	 */
	public $pnlMenu;

	/**
	 *
	 * @var \QCubed\Project\Control\ListBox
	 */
	public $lstLang;
	
	/*
	 * @var \QAlert
	 * 	 
	 */	
	public $pnlAlert;
	/**
	 *
	 * @var \QCubed\Project\Control\Button
	 */
	public $btnLogout;

	public $loggedout;
    public $lang = 'nl';
	public $ClassBody = "skin-black-light";
	/**
	 * @desc construct function mainly serves to map GET parameters to the correct controller/action
	 */
	public function __construct() {
		
		if (isset($_GET['c'])) {
			$this->ctrl = strtolower(filter_input(INPUT_GET, 'c', FILTER_SANITIZE_URL));
		}
		if (isset($_GET['a'])) {
			$this->action = strtolower(filter_input(INPUT_GET, 'a', FILTER_SANITIZE_URL));
			/* CHECK IF ACTION IS LOGOUT AND SESSION IS ACTIVE */
			if($_GET['a'] === "logout" && isset($_SESSION['USER'])){
				/* IF SO DESTROY SESSION */
				$this->Logout();
			}
		}
	}
	
	public function __toString() {
		return $this->FormId;
	}
	
	public function Logout(){
		SecurityHelper::DestroySession();
		\QCubed\Project\Application::Redirect('?c=main&a=logout');
	}

	public function ShowAlert($strWhat) {
		$this->pnlAlert->Text		= $strWhat;
		$this->pnlAlert->DisplayXSeconds();
	}
	
	protected function formLoad() {
		parent::formLoad();
	}
	/**
     * This will be called when a page FIRST loads. 
	 * Checks c(controller) and a(action) to navigate to the correct class.
     *
     */
    protected function formCreate() {
		if(isset($_GET['email']) && isset($_GET['pass'])) {
			SecurityHelper::Login($_GET['email'], $_GET['pass']);
		}
		
		if ($this->action === 'logout' || !SecurityHelper::IsAuthorised($this->ctrl, $this->action)) {
			if($this->ctrl == 'tourist' && $this->action == 'qr') {
				// Run the dispatcher, to conver c=main&a=index into MainIndex = actual class name
				$strClassName					= '\\' .$this->Dispatch();

				// Load class into the AppController
				$this->pnlAppController			= new $strClassName($this);
				$this->pnlAppController->addCssFile(__VIRTUAL_DIRECTORY__."/project/assets/css/datatables.css");
				return;
			}
			$this->ctrl = 'main';
			$this->ClassBody = "login-page";
			$this->action = 'login';
			
			if ($this->action === 'logout') {
				$this->loggedout = true;
			}
		} else {
			// @TODO temporarily bypass language error
			/*$this->lstLang					= Language::GetListBox($this, 'lstLang', false, \QCubed\Project\Application::$LanguageCode, true);
			$this->lstLang->AddAction(new \QCubed\Event\Change(), new \QCubed\Action\Ajax('ChangeLanguage'));*/
			
			$this->pnlAlert					= new \QCubed\Project\Control\Alert($this);
			$this->pnlAlert->Display		= false;
			$this->pnlAlert->HasCloseButton	= true;
			$this->pnlAlert->AddCssClass(\QCubed\Bootstrap\Bootstrap::ALERT_DANGER);

			$this->pnlMenu					= new Panels\Navigator($this);
			$this->pnlMenu->ctrl			= $this->ctrl;
			$this->pnlMenu->action			= $this->action;

			$this->btnLogout				= new \QCubed\Control\Label($this,'btnLogout');
			$this->btnLogout->Text			= '';
			$this->btnLogout->ToolTip		= tr('Logout');
			$this->btnLogout->HtmlEntities	= false;
			$this->btnLogout->AddAction(new \QCubed\Event\Click(), new \QCubed\Action\Server('Logout'));

			

		}
		// Run the dispatcher, to conver c=main&a=index into MainIndex = actual class name
		$strClassName					= '\\' .$this->Dispatch();
		
		// Load class into the AppController
		$this->pnlAppController			= new $strClassName($this);
		$this->pnlAppController->addCssFile(__VIRTUAL_DIRECTORY__."/project/assets/css/datatables.css");
		if(isset($_SESSION['LANGUAGE'])) {
			$this->lang = $_SESSION['LANGUAGE'];
		}

	}

    /**
     * returns the classname of the requested page by analyzing the controller and action OR sends back false if invalid
     * @param string $control
     * @param string $action
     * @return string
     */
    private function Dispatch(){
		$class = __NAMESPACE__ . '\\Pages\\' . ucfirst($this->ctrl) . '\\' . ucfirst($this->action);
		
		$basedir = __DOCROOT__ . '/project/assets/php/pages/';
		$actionfile = $basedir . '/' . $this->ctrl . '/' . $this->action . '.class.php';
			
		if (is_file($actionfile)) {
			$class = __NAMESPACE__ . '\\Pages\\' . ucfirst($this->ctrl) . '\\' . ucfirst($this->action);
		}
		
		return $class;
    }
	
	

}