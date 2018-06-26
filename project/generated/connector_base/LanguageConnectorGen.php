<?php

use QCubed as Q;
use QCubed\Exception\Caller as Caller;
use QCubed\Project\Control\FormBase;
use QCubed\Project\Control\ControlBase;
use QCubed\Query\QQ;
use QCubed\Control\Label;
use QCubed\Project\Control\TextBox;

/**
 * This is a ModelConnector class, providing a Form or Panel access to event handlers
 * and Controls to perform the Create, Edit, and Delete functionality
 * of the Language class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single Language object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a LanguageConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read Language $Language the actual Language data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Project\Control\TextBox $NameControl
 * @property-read QCubed\\Control\\Label $NameLabel
 * @property QCubed\Project\Control\TextBox $LocaleControl
 * @property-read QCubed\\Control\\Label $LocaleLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class LanguageConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var Language objLanguage
     * @access protected
     */
    protected $objLanguage;
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

    // Controls that correspond to Language's individual data fields
    /**
     * @var Label
     * @access protected
     */
    protected $lblId;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtName;

    /**
     * @var Label
     * @access protected
     */
    protected $lblName;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtLocale;

    /**
     * @var Label
     * @access protected
     */
    protected $lblLocale;



    /**
     * Main constructor.  Constructor OR static create methods are designed to be called in either
     * a parent Panel or the main Form when wanting to create a
     * LanguageConnector to edit a single Language object within the
     * Panel or Form.
     *
     * This constructor takes in a single Language object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this LanguageConnector
     * @param Language $objLanguage new or existing Language object
     */
     public function __construct($objParentObject, Language $objLanguage)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this LanguageConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked Language object
        $this->objLanguage = $objLanguage;

        // Figure out if we're Editing or Creating New
        if ($this->objLanguage->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this LanguageConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing Language object creation - defaults to CreateOrEdit
     * @return LanguageConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objLanguage = Language::load($intId);

            // Language was found -- return it!
            if ($objLanguage)
                return new LanguageConnector($objParentObject, $objLanguage);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a Language object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new LanguageConnector($objParentObject, new Language());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this LanguageConnector
     * @param integer $intCreateType rules governing Language object creation - defaults to CreateOrEdit
     * @return LanguageConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return LanguageConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this LanguageConnector
     * @param integer $intCreateType rules governing Language object creation - defaults to CreateOrEdit
     * @return LanguageConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return LanguageConnector::create($objParentObject, $intId, $intCreateType);
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
        $this->lblId->LinkedNode = QQN::Language()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objLanguage->Id : t('N\A');
        return $this->lblId;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtName
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtName_Create($strControlId = null) {
			$this->txtName = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtName->Name = t('Name');
			$this->txtName->Required = true;
			$this->txtName->MaxLength = Language::NameMaxLength;
			$this->txtName->PreferredRenderMethod = 'RenderWithName';
        $this->txtName->LinkedNode = QQN::Language()->Name;
			$this->txtName->Text = $this->objLanguage->Name;
			return $this->txtName;
		}

    /**
     * Create and setup QCubed\Control\Label lblName
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblName_Create($strControlId = null) 
    {
        $this->lblName = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblName->Name = t('Name');
        $this->lblName->PreferredRenderMethod = 'RenderWithName';
        $this->lblName->LinkedNode = QQN::Language()->Name;
			$this->lblName->Text = $this->objLanguage->Name;
        return $this->lblName;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtLocale
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtLocale_Create($strControlId = null) {
			$this->txtLocale = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtLocale->Name = t('Locale');
			$this->txtLocale->Required = true;
			$this->txtLocale->MaxLength = Language::LocaleMaxLength;
			$this->txtLocale->PreferredRenderMethod = 'RenderWithName';
        $this->txtLocale->LinkedNode = QQN::Language()->Locale;
			$this->txtLocale->Text = $this->objLanguage->Locale;
			return $this->txtLocale;
		}

    /**
     * Create and setup QCubed\Control\Label lblLocale
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblLocale_Create($strControlId = null) 
    {
        $this->lblLocale = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblLocale->Name = t('Locale');
        $this->lblLocale->PreferredRenderMethod = 'RenderWithName';
        $this->lblLocale->LinkedNode = QQN::Language()->Locale;
			$this->lblLocale->Text = $this->objLanguage->Locale;
        return $this->lblLocale;
    }






    /**
     * Refresh this ModelConnector with Data from the local Language object.
     * @param boolean $blnReload reload Language from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objLanguage); // Notify in development version
        if (!($this->objLanguage)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objLanguage->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objLanguage->Id : t('N\A');


			if ($this->txtName) $this->txtName->Text = $this->objLanguage->Name;
			if ($this->lblName) $this->lblName->Text = $this->objLanguage->Name;


			if ($this->txtLocale) $this->txtLocale->Text = $this->objLanguage->Locale;
			if ($this->lblLocale) $this->lblLocale->Text = $this->objLanguage->Locale;


    }

    /**
     * Load this ModelConnector with a Language object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|Language
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objLanguage = Language::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objLanguage = new Language();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objLanguage) {
            $this->refresh ();
        }
        return $this->objLanguage;
    }




        /**
    * This will update this object's Language instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateLanguage()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->txtName) $this->objLanguage->Name = $this->txtName->Text;

				if ($this->txtLocale) $this->objLanguage->Locale = $this->txtLocale->Text;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's Language instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveLanguage($blnForceUpdate = false)
    {
        try {
            $this->updateLanguage();
            $id = $this->objLanguage->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's Language instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteLanguage()
    {
        $this->objLanguage->delete();
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
            case 'Language': return $this->objLanguage;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to Language fields -- will be created dynamically if not yet created
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'NameControl':
                if (!$this->txtName) return $this->txtName_Create();
                return $this->txtName;
            case 'NameLabel':
                if (!$this->lblName) return $this->lblName_Create();
                return $this->lblName;
            case 'LocaleControl':
                if (!$this->txtLocale) return $this->txtLocale_Create();
                return $this->txtLocale;
            case 'LocaleLabel':
                if (!$this->lblLocale) return $this->lblLocale_Create();
                return $this->lblLocale;
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

                // Controls that point to Language fields
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'NameControl':
                    $this->txtName = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'NameLabel':
                    $this->lblName = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'LocaleControl':
                    $this->txtLocale = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'LocaleLabel':
                    $this->lblLocale = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
