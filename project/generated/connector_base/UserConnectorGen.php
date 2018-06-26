<?php

use QCubed as Q;
use QCubed\Exception\Caller as Caller;
use QCubed\Project\Control\FormBase;
use QCubed\Project\Control\ControlBase;
use QCubed\Query\QQ;
use QCubed\Control\Label;
use QCubed\Project\Control\ListBox;
use QCubed\Control\ListControl;
use QCubed\Control\ListItem;
use QCubed\Query\Condition\ConditionInterface as QQCondition;
use QCubed\Query\Clause\ClauseInterface as QQClause;
use QCubed\Project\Control\TextBox;

/**
 * This is a ModelConnector class, providing a Form or Panel access to event handlers
 * and Controls to perform the Create, Edit, and Delete functionality
 * of the User class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single User object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a UserConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read User $User the actual User data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Project\Control\ListBox $CompanyIdControl
 * @property-read QCubed\\Control\\Label $CompanyIdLabel
 * @property QCubed\Project\Control\TextBox $EmailControl
 * @property-read QCubed\\Control\\Label $EmailLabel
 * @property QCubed\Project\Control\TextBox $PasswordControl
 * @property-read QCubed\\Control\\Label $PasswordLabel
 * @property QCubed\Project\Control\TextBox $SaltControl
 * @property-read QCubed\\Control\\Label $SaltLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class UserConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var User objUser
     * @access protected
     */
    protected $objUser;
    /**
     * @var FormBase|ControlBase
     * @access protected
     */
    protected $objParentObject;
    /**
     * @var string strTitleVerb
     * @access protected
     */
    protected $strTitleVerb;
    /**
     * @var boolean blnEditMode
     * @access protected
     */
    protected $blnEditMode;

    // Controls that correspond to User's individual data fields
    /**
     * @var Label
     * @access protected
     */
    protected $lblId;

    /**
     * @var QCubed\Project\Control\ListBox
     * @access protected
     */
    protected $lstCompany;

    /**
     * @var string 
     * @access protected
     */
    protected $strCompanyNullLabel;

    /**
    * @var QQCondition
    * @access protected
    */
    protected $objCompanyCondition;

    /**
    * @var QQClause[]
    * @access protected
    */
    protected $objCompanyClauses;
    /**
     * @var Label
     * @access protected
     */
    protected $lblCompany;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtEmail;

    /**
     * @var Label
     * @access protected
     */
    protected $lblEmail;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtPassword;

    /**
     * @var Label
     * @access protected
     */
    protected $lblPassword;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtSalt;

    /**
     * @var Label
     * @access protected
     */
    protected $lblSalt;



    /**
     * Main constructor.  Constructor OR static create methods are designed to be called in either
     * a parent Panel or the main Form when wanting to create a
     * UserConnector to edit a single User object within the
     * Panel or Form.
     *
     * This constructor takes in a single User object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this UserConnector
     * @param User $objUser new or existing User object
     */
     public function __construct($objParentObject, User $objUser)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this UserConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked User object
        $this->objUser = $objUser;

        // Figure out if we're Editing or Creating New
        if ($this->objUser->__Restored) {
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        } else {
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
     }

    /**
     * Static Helper Method to Create using PK arguments
     * You must pass in the PK arguments on an object to load, or leave it blank to create a new one.
     * If you want to load via QueryString or PathInfo, use the CreateFromQueryString or CreateFromPathInfo
     * static helper methods.  Finally, specify a CreateType to define whether or not we are only allowed to
     * edit, or if we are also allowed to create a new one, etc.
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this UserConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing User object creation - defaults to CreateOrEdit
     * @return UserConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objUser = User::load($intId);

            // User was found -- return it!
            if ($objUser)
                return new UserConnector($objParentObject, $objUser);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a User object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new UserConnector($objParentObject, new User());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this UserConnector
     * @param integer $intCreateType rules governing User object creation - defaults to CreateOrEdit
     * @return UserConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return UserConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this UserConnector
     * @param integer $intCreateType rules governing User object creation - defaults to CreateOrEdit
     * @return UserConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return UserConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Create and setup QCubed\Control\Label lblId
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblId_Create($strControlId = null) 
    {
        $this->lblId = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblId->Name = t('Id');
        $this->lblId->PreferredRenderMethod = 'RenderWithName';
        $this->lblId->LinkedNode = QQN::User()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objUser->Id : t('N\A');
        return $this->lblId;
    }



		/**
		 * Create and setup QCubed\Project\Control\ListBox lstCompany
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objCondition override the default condition of QQ::all() to the query, itself
		 * @param QQClause[] $objClauses additional QQClause object or array of QQClause objects for the query
		 * @return ListBox
		 */
		public function lstCompany_Create($strControlId = null, QQCondition $objCondition = null, $objClauses = null) {
			$this->objCompanyCondition = $objCondition;
			$this->objCompanyClauses = $objClauses;
			$this->lstCompany = new \QCubed\Project\Control\ListBox($this->objParentObject, $strControlId);
			$this->lstCompany->Name = t('Company');
			$this->lstCompany->Required = true;
			$this->lstCompany->PreferredRenderMethod = 'RenderWithName';
        $this->lstCompany->LinkedNode = QQN::User()->Company;
      if (!$this->strCompanyNullLabel) {
      	if (!$this->lstCompany->Required) {
      		$this->strCompanyNullLabel = t('- None -');
      	}
      	elseif (!$this->blnEditMode) {
      		$this->strCompanyNullLabel = t('- Select One -');
      	}
      }
      $this->lstCompany->addItem($this->strCompanyNullLabel, null);
      $this->lstCompany->addItems($this->lstCompany_GetItems());
      $this->lstCompany->SelectedValue = $this->objUser->CompanyId;
			return $this->lstCompany;
		}

		/**
		 *	Create item list for use by lstCompany
		 */
		 public function lstCompany_GetItems() {
			$a = array();
			$objCondition = $this->objCompanyCondition;
			if (is_null($objCondition)) $objCondition = QQ::all();
			$objCompanyCursor = Company::queryCursor($objCondition, $this->objCompanyClauses);

			// Iterate through the Cursor
			while ($objCompany = Company::instantiateCursor($objCompanyCursor)) {
				$objListItem = new ListItem($objCompany->__toString(), $objCompany->Id);
				if (($this->objUser->Company) && ($this->objUser->Company->Id == $objCompany->Id))
					$objListItem->Selected = true;
				$a[] = $objListItem;
			}
			return $a;
		 }

    /**
     * Create and setup QCubed\Control\Label lblCompany
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblCompany_Create($strControlId = null) 
    {
        $this->lblCompany = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblCompany->Name = t('Company');
        $this->lblCompany->PreferredRenderMethod = 'RenderWithName';
        $this->lblCompany->LinkedNode = QQN::User()->Company;
			$this->lblCompany->Text = $this->objUser->Company ? $this->objUser->Company->__toString() : null;
        return $this->lblCompany;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtEmail
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtEmail_Create($strControlId = null) {
			$this->txtEmail = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtEmail->Name = t('Email');
			$this->txtEmail->Required = true;
			$this->txtEmail->MaxLength = User::EmailMaxLength;
			$this->txtEmail->PreferredRenderMethod = 'RenderWithName';
        $this->txtEmail->LinkedNode = QQN::User()->Email;
			$this->txtEmail->Text = $this->objUser->Email;
			return $this->txtEmail;
		}

    /**
     * Create and setup QCubed\Control\Label lblEmail
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblEmail_Create($strControlId = null) 
    {
        $this->lblEmail = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblEmail->Name = t('Email');
        $this->lblEmail->PreferredRenderMethod = 'RenderWithName';
        $this->lblEmail->LinkedNode = QQN::User()->Email;
			$this->lblEmail->Text = $this->objUser->Email;
        return $this->lblEmail;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtPassword
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtPassword_Create($strControlId = null) {
			$this->txtPassword = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtPassword->Name = t('Password');
			$this->txtPassword->MaxLength = User::PasswordMaxLength;
			$this->txtPassword->PreferredRenderMethod = 'RenderWithName';
        $this->txtPassword->LinkedNode = QQN::User()->Password;
			$this->txtPassword->Text = $this->objUser->Password;
			return $this->txtPassword;
		}

    /**
     * Create and setup QCubed\Control\Label lblPassword
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblPassword_Create($strControlId = null) 
    {
        $this->lblPassword = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblPassword->Name = t('Password');
        $this->lblPassword->PreferredRenderMethod = 'RenderWithName';
        $this->lblPassword->LinkedNode = QQN::User()->Password;
			$this->lblPassword->Text = $this->objUser->Password;
        return $this->lblPassword;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtSalt
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtSalt_Create($strControlId = null) {
			$this->txtSalt = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtSalt->Name = t('Salt');
			$this->txtSalt->MaxLength = User::SaltMaxLength;
			$this->txtSalt->PreferredRenderMethod = 'RenderWithName';
        $this->txtSalt->LinkedNode = QQN::User()->Salt;
			$this->txtSalt->Text = $this->objUser->Salt;
			return $this->txtSalt;
		}

    /**
     * Create and setup QCubed\Control\Label lblSalt
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblSalt_Create($strControlId = null) 
    {
        $this->lblSalt = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblSalt->Name = t('Salt');
        $this->lblSalt->PreferredRenderMethod = 'RenderWithName';
        $this->lblSalt->LinkedNode = QQN::User()->Salt;
			$this->lblSalt->Text = $this->objUser->Salt;
        return $this->lblSalt;
    }






    /**
     * Refresh this ModelConnector with Data from the local User object.
     * @param boolean $blnReload reload User from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objUser); // Notify in development version
        if (!($this->objUser)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objUser->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objUser->Id : t('N\A');


      if ($this->lstCompany) {
        $this->lstCompany->removeAllItems();
        $this->lstCompany->addItem($this->strCompanyNullLabel, null);
        $this->lstCompany->addItems($this->lstCompany_GetItems());
        $this->lstCompany->SelectedValue = $this->objUser->CompanyId;
      
      }
			if ($this->lblCompany) $this->lblCompany->Text = $this->objUser->Company ? $this->objUser->Company->__toString() : null;


			if ($this->txtEmail) $this->txtEmail->Text = $this->objUser->Email;
			if ($this->lblEmail) $this->lblEmail->Text = $this->objUser->Email;


			if ($this->txtPassword) $this->txtPassword->Text = $this->objUser->Password;
			if ($this->lblPassword) $this->lblPassword->Text = $this->objUser->Password;


			if ($this->txtSalt) $this->txtSalt->Text = $this->objUser->Salt;
			if ($this->lblSalt) $this->lblSalt->Text = $this->objUser->Salt;


    }

    /**
     * Load this ModelConnector with a User object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|User
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objUser = User::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objUser = new User();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objUser) {
            $this->refresh ();
        }
        return $this->objUser;
    }




        /**
    * This will update this object's User instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateUser()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->lstCompany) $this->objUser->CompanyId = $this->lstCompany->SelectedValue;

				if ($this->txtEmail) $this->objUser->Email = $this->txtEmail->Text;

				if ($this->txtPassword) $this->objUser->Password = $this->txtPassword->Text;

				if ($this->txtSalt) $this->objUser->Salt = $this->txtSalt->Text;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's User instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveUser($blnForceUpdate = false)
    {
        try {
            $this->updateUser();
            $id = $this->objUser->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's User instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteUser()
    {
        $this->objUser->delete();
    }

    /**
     * Override method to perform a property "Get"
     * This will get the value of $strName
     *
     * @param string $strName Name of the property to get
     * @return mixed
     * @throws Caller
     */
    public function __get($strName)
    {
        switch ($strName) {
            // General ModelConnectorVariables
            case 'User': return $this->objUser;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to User fields -- will be created dynamically if not yet created
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'CompanyIdControl':
                if (!$this->lstCompany) return $this->lstCompany_Create();
                return $this->lstCompany;
            case 'CompanyIdLabel':
                if (!$this->lblCompany) return $this->lblCompany_Create();
                return $this->lblCompany;
            case 'CompanyNullLabel':
                return $this->strCompanyNullLabel;
            case 'EmailControl':
                if (!$this->txtEmail) return $this->txtEmail_Create();
                return $this->txtEmail;
            case 'EmailLabel':
                if (!$this->lblEmail) return $this->lblEmail_Create();
                return $this->lblEmail;
            case 'PasswordControl':
                if (!$this->txtPassword) return $this->txtPassword_Create();
                return $this->txtPassword;
            case 'PasswordLabel':
                if (!$this->lblPassword) return $this->lblPassword_Create();
                return $this->lblPassword;
            case 'SaltControl':
                if (!$this->txtSalt) return $this->txtSalt_Create();
                return $this->txtSalt;
            case 'SaltLabel':
                if (!$this->lblSalt) return $this->lblSalt_Create();
                return $this->lblSalt;
            default:
                try {
                    return parent::__get($strName);
                } catch (Caller $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
        }
    }

    
    /**
     * Override method to perform a property "Set"
     * This will set the property $strName to be $mixValue
     *
     * @param string $strName Name of the property to set
     * @param mixed $mixValue New value of the property
     * @return void
     * @throws Caller
     */
    public function __set($strName, $mixValue)
    {
        try {
            switch ($strName) {
                case 'Parent':
                    $this->objParentObject = $mixValue;
                    break;

                // Controls that point to User fields
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'CompanyIdControl':
                    $this->lstCompany = Type::Cast($mixValue, '\\QCubed\Project\Control\ListBox');
                    break;
                case 'CompanyIdLabel':
                    $this->lblCompany = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'CompanyNullLabel':
                    $this->strCompanyNullLabel = $mixValue;
                    break;
                case 'EmailControl':
                    $this->txtEmail = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'EmailLabel':
                    $this->lblEmail = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'PasswordControl':
                    $this->txtPassword = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'PasswordLabel':
                    $this->lblPassword = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'SaltControl':
                    $this->txtSalt = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'SaltLabel':
                    $this->lblSalt = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                default:
                    parent::__set($strName, $mixValue);
                    break;
            }
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }
}
