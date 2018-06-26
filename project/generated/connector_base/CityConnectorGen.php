<?php

use QCubed as Q;
use QCubed\Exception\Caller as Caller;
use QCubed\Project\Control\FormBase;
use QCubed\Project\Control\ControlBase;
use QCubed\Query\QQ;
use QCubed\Control\IntegerTextBox;
use QCubed\Control\Label;
use QCubed\Project\Control\TextBox;

/**
 * This is a ModelConnector class, providing a Form or Panel access to event handlers
 * and Controls to perform the Create, Edit, and Delete functionality
 * of the City class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single City object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a CityConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read City $City the actual City data class being edited
 * @property QCubed\Control\IntegerTextBox $IdControl
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Control\IntegerTextBox $CountryIdControl
 * @property-read QCubed\\Control\\Label $CountryIdLabel
 * @property QCubed\Project\Control\TextBox $PostalCodeControl
 * @property-read QCubed\\Control\\Label $PostalCodeLabel
 * @property QCubed\Project\Control\TextBox $NameControl
 * @property-read QCubed\\Control\\Label $NameLabel
 * @property QCubed\Project\Control\TextBox $AdminName1Control
 * @property-read QCubed\\Control\\Label $AdminName1Label
 * @property QCubed\Project\Control\TextBox $AdminCode1Control
 * @property-read QCubed\\Control\\Label $AdminCode1Label
 * @property QCubed\Project\Control\TextBox $AdminName2Control
 * @property-read QCubed\\Control\\Label $AdminName2Label
 * @property QCubed\Project\Control\TextBox $AdminCode2Control
 * @property-read QCubed\\Control\\Label $AdminCode2Label
 * @property QCubed\Project\Control\TextBox $AdminName3Control
 * @property-read QCubed\\Control\\Label $AdminName3Label
 * @property QCubed\Project\Control\TextBox $AdminCode3Control
 * @property-read QCubed\\Control\\Label $AdminCode3Label
 * @property QCubed\Project\Control\TextBox $LatitudeControl
 * @property-read QCubed\\Control\\Label $LatitudeLabel
 * @property QCubed\Project\Control\TextBox $LongitudeControl
 * @property-read QCubed\\Control\\Label $LongitudeLabel
 * @property QCubed\Control\IntegerTextBox $AccuracyControl
 * @property-read QCubed\\Control\\Label $AccuracyLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class CityConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var City objCity
     * @access protected
     */
    protected $objCity;
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

    // Controls that correspond to City's individual data fields
    /**
     * @var QCubed\Control\IntegerTextBox

     * @access protected
     */
    protected $txtId;

    /**
     * @var Label
     * @access protected
     */
    protected $lblId;

    /**
     * @var QCubed\Control\IntegerTextBox

     * @access protected
     */
    protected $txtCountryId;

    /**
     * @var Label
     * @access protected
     */
    protected $lblCountryId;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtPostalCode;

    /**
     * @var Label
     * @access protected
     */
    protected $lblPostalCode;

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
    protected $txtAdminName1;

    /**
     * @var Label
     * @access protected
     */
    protected $lblAdminName1;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtAdminCode1;

    /**
     * @var Label
     * @access protected
     */
    protected $lblAdminCode1;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtAdminName2;

    /**
     * @var Label
     * @access protected
     */
    protected $lblAdminName2;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtAdminCode2;

    /**
     * @var Label
     * @access protected
     */
    protected $lblAdminCode2;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtAdminName3;

    /**
     * @var Label
     * @access protected
     */
    protected $lblAdminName3;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtAdminCode3;

    /**
     * @var Label
     * @access protected
     */
    protected $lblAdminCode3;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtLatitude;

    /**
     * @var Label
     * @access protected
     */
    protected $lblLatitude;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtLongitude;

    /**
     * @var Label
     * @access protected
     */
    protected $lblLongitude;

    /**
     * @var QCubed\Control\IntegerTextBox

     * @access protected
     */
    protected $txtAccuracy;

    /**
     * @var Label
     * @access protected
     */
    protected $lblAccuracy;



    /**
     * Main constructor.  Constructor OR static create methods are designed to be called in either
     * a parent Panel or the main Form when wanting to create a
     * CityConnector to edit a single City object within the
     * Panel or Form.
     *
     * This constructor takes in a single City object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this CityConnector
     * @param City $objCity new or existing City object
     */
     public function __construct($objParentObject, City $objCity)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this CityConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked City object
        $this->objCity = $objCity;

        // Figure out if we're Editing or Creating New
        if ($this->objCity->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this CityConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing City object creation - defaults to CreateOrEdit
     * @return CityConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objCity = City::load($intId);

            // City was found -- return it!
            if ($objCity)
                return new CityConnector($objParentObject, $objCity);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a City object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new CityConnector($objParentObject, new City());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this CityConnector
     * @param integer $intCreateType rules governing City object creation - defaults to CreateOrEdit
     * @return CityConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return CityConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this CityConnector
     * @param integer $intCreateType rules governing City object creation - defaults to CreateOrEdit
     * @return CityConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return CityConnector::create($objParentObject, $intId, $intCreateType);
    }

		/**
		 * Create and setup a QCubed\Control\IntegerTextBox txtId
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Control\IntegerTextBox
		 */
		public function txtId_Create($strControlId = null) {
			$this->txtId = new \QCubed\Control\IntegerTextBox($this->objParentObject, $strControlId);
			$this->txtId->Name = t('Id');
			$this->txtId->Required = true;
			$this->txtId->PreferredRenderMethod = 'RenderWithName';
        $this->txtId->LinkedNode = QQN::City()->Id;
			$this->txtId->Text = $this->objCity->Id;
			return $this->txtId;
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
        $this->lblId->LinkedNode = QQN::City()->Id;
			$this->lblId->Text = $this->objCity->Id;
        return $this->lblId;
    }



		/**
		 * Create and setup a QCubed\Control\IntegerTextBox txtCountryId
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Control\IntegerTextBox
		 */
		public function txtCountryId_Create($strControlId = null) {
			$this->txtCountryId = new \QCubed\Control\IntegerTextBox($this->objParentObject, $strControlId);
			$this->txtCountryId->Name = t('Country Id');
			$this->txtCountryId->Required = true;
			$this->txtCountryId->PreferredRenderMethod = 'RenderWithName';
        $this->txtCountryId->LinkedNode = QQN::City()->CountryId;
			$this->txtCountryId->Text = $this->objCity->CountryId;
			return $this->txtCountryId;
		}

    /**
     * Create and setup QCubed\Control\Label lblCountryId
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblCountryId_Create($strControlId = null) 
    {
        $this->lblCountryId = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblCountryId->Name = t('Country Id');
        $this->lblCountryId->PreferredRenderMethod = 'RenderWithName';
        $this->lblCountryId->LinkedNode = QQN::City()->CountryId;
			$this->lblCountryId->Text = $this->objCity->CountryId;
        return $this->lblCountryId;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtPostalCode
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtPostalCode_Create($strControlId = null) {
			$this->txtPostalCode = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtPostalCode->Name = t('Postal Code');
			$this->txtPostalCode->MaxLength = City::PostalCodeMaxLength;
			$this->txtPostalCode->PreferredRenderMethod = 'RenderWithName';
        $this->txtPostalCode->LinkedNode = QQN::City()->PostalCode;
			$this->txtPostalCode->Text = $this->objCity->PostalCode;
			return $this->txtPostalCode;
		}

    /**
     * Create and setup QCubed\Control\Label lblPostalCode
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblPostalCode_Create($strControlId = null) 
    {
        $this->lblPostalCode = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblPostalCode->Name = t('Postal Code');
        $this->lblPostalCode->PreferredRenderMethod = 'RenderWithName';
        $this->lblPostalCode->LinkedNode = QQN::City()->PostalCode;
			$this->lblPostalCode->Text = $this->objCity->PostalCode;
        return $this->lblPostalCode;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtName
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtName_Create($strControlId = null) {
			$this->txtName = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtName->Name = t('Name');
			$this->txtName->MaxLength = City::NameMaxLength;
			$this->txtName->PreferredRenderMethod = 'RenderWithName';
        $this->txtName->LinkedNode = QQN::City()->Name;
			$this->txtName->Text = $this->objCity->Name;
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
        $this->lblName->LinkedNode = QQN::City()->Name;
			$this->lblName->Text = $this->objCity->Name;
        return $this->lblName;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtAdminName1
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtAdminName1_Create($strControlId = null) {
			$this->txtAdminName1 = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtAdminName1->Name = t('Admin Name 1');
			$this->txtAdminName1->MaxLength = City::AdminName1MaxLength;
			$this->txtAdminName1->PreferredRenderMethod = 'RenderWithName';
        $this->txtAdminName1->LinkedNode = QQN::City()->AdminName1;
			$this->txtAdminName1->Text = $this->objCity->AdminName1;
			return $this->txtAdminName1;
		}

    /**
     * Create and setup QCubed\Control\Label lblAdminName1
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblAdminName1_Create($strControlId = null) 
    {
        $this->lblAdminName1 = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblAdminName1->Name = t('Admin Name 1');
        $this->lblAdminName1->PreferredRenderMethod = 'RenderWithName';
        $this->lblAdminName1->LinkedNode = QQN::City()->AdminName1;
			$this->lblAdminName1->Text = $this->objCity->AdminName1;
        return $this->lblAdminName1;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtAdminCode1
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtAdminCode1_Create($strControlId = null) {
			$this->txtAdminCode1 = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtAdminCode1->Name = t('Admin Code 1');
			$this->txtAdminCode1->MaxLength = City::AdminCode1MaxLength;
			$this->txtAdminCode1->PreferredRenderMethod = 'RenderWithName';
        $this->txtAdminCode1->LinkedNode = QQN::City()->AdminCode1;
			$this->txtAdminCode1->Text = $this->objCity->AdminCode1;
			return $this->txtAdminCode1;
		}

    /**
     * Create and setup QCubed\Control\Label lblAdminCode1
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblAdminCode1_Create($strControlId = null) 
    {
        $this->lblAdminCode1 = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblAdminCode1->Name = t('Admin Code 1');
        $this->lblAdminCode1->PreferredRenderMethod = 'RenderWithName';
        $this->lblAdminCode1->LinkedNode = QQN::City()->AdminCode1;
			$this->lblAdminCode1->Text = $this->objCity->AdminCode1;
        return $this->lblAdminCode1;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtAdminName2
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtAdminName2_Create($strControlId = null) {
			$this->txtAdminName2 = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtAdminName2->Name = t('Admin Name 2');
			$this->txtAdminName2->MaxLength = City::AdminName2MaxLength;
			$this->txtAdminName2->PreferredRenderMethod = 'RenderWithName';
        $this->txtAdminName2->LinkedNode = QQN::City()->AdminName2;
			$this->txtAdminName2->Text = $this->objCity->AdminName2;
			return $this->txtAdminName2;
		}

    /**
     * Create and setup QCubed\Control\Label lblAdminName2
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblAdminName2_Create($strControlId = null) 
    {
        $this->lblAdminName2 = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblAdminName2->Name = t('Admin Name 2');
        $this->lblAdminName2->PreferredRenderMethod = 'RenderWithName';
        $this->lblAdminName2->LinkedNode = QQN::City()->AdminName2;
			$this->lblAdminName2->Text = $this->objCity->AdminName2;
        return $this->lblAdminName2;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtAdminCode2
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtAdminCode2_Create($strControlId = null) {
			$this->txtAdminCode2 = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtAdminCode2->Name = t('Admin Code 2');
			$this->txtAdminCode2->MaxLength = City::AdminCode2MaxLength;
			$this->txtAdminCode2->PreferredRenderMethod = 'RenderWithName';
        $this->txtAdminCode2->LinkedNode = QQN::City()->AdminCode2;
			$this->txtAdminCode2->Text = $this->objCity->AdminCode2;
			return $this->txtAdminCode2;
		}

    /**
     * Create and setup QCubed\Control\Label lblAdminCode2
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblAdminCode2_Create($strControlId = null) 
    {
        $this->lblAdminCode2 = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblAdminCode2->Name = t('Admin Code 2');
        $this->lblAdminCode2->PreferredRenderMethod = 'RenderWithName';
        $this->lblAdminCode2->LinkedNode = QQN::City()->AdminCode2;
			$this->lblAdminCode2->Text = $this->objCity->AdminCode2;
        return $this->lblAdminCode2;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtAdminName3
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtAdminName3_Create($strControlId = null) {
			$this->txtAdminName3 = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtAdminName3->Name = t('Admin Name 3');
			$this->txtAdminName3->MaxLength = City::AdminName3MaxLength;
			$this->txtAdminName3->PreferredRenderMethod = 'RenderWithName';
        $this->txtAdminName3->LinkedNode = QQN::City()->AdminName3;
			$this->txtAdminName3->Text = $this->objCity->AdminName3;
			return $this->txtAdminName3;
		}

    /**
     * Create and setup QCubed\Control\Label lblAdminName3
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblAdminName3_Create($strControlId = null) 
    {
        $this->lblAdminName3 = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblAdminName3->Name = t('Admin Name 3');
        $this->lblAdminName3->PreferredRenderMethod = 'RenderWithName';
        $this->lblAdminName3->LinkedNode = QQN::City()->AdminName3;
			$this->lblAdminName3->Text = $this->objCity->AdminName3;
        return $this->lblAdminName3;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtAdminCode3
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtAdminCode3_Create($strControlId = null) {
			$this->txtAdminCode3 = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtAdminCode3->Name = t('Admin Code 3');
			$this->txtAdminCode3->MaxLength = City::AdminCode3MaxLength;
			$this->txtAdminCode3->PreferredRenderMethod = 'RenderWithName';
        $this->txtAdminCode3->LinkedNode = QQN::City()->AdminCode3;
			$this->txtAdminCode3->Text = $this->objCity->AdminCode3;
			return $this->txtAdminCode3;
		}

    /**
     * Create and setup QCubed\Control\Label lblAdminCode3
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblAdminCode3_Create($strControlId = null) 
    {
        $this->lblAdminCode3 = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblAdminCode3->Name = t('Admin Code 3');
        $this->lblAdminCode3->PreferredRenderMethod = 'RenderWithName';
        $this->lblAdminCode3->LinkedNode = QQN::City()->AdminCode3;
			$this->lblAdminCode3->Text = $this->objCity->AdminCode3;
        return $this->lblAdminCode3;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtLatitude
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtLatitude_Create($strControlId = null) {
			$this->txtLatitude = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtLatitude->Name = t('Latitude');
			$this->txtLatitude->MaxLength = City::LatitudeMaxLength;
			$this->txtLatitude->PreferredRenderMethod = 'RenderWithName';
        $this->txtLatitude->LinkedNode = QQN::City()->Latitude;
			$this->txtLatitude->Text = $this->objCity->Latitude;
			return $this->txtLatitude;
		}

    /**
     * Create and setup QCubed\Control\Label lblLatitude
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblLatitude_Create($strControlId = null) 
    {
        $this->lblLatitude = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblLatitude->Name = t('Latitude');
        $this->lblLatitude->PreferredRenderMethod = 'RenderWithName';
        $this->lblLatitude->LinkedNode = QQN::City()->Latitude;
			$this->lblLatitude->Text = $this->objCity->Latitude;
        return $this->lblLatitude;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtLongitude
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtLongitude_Create($strControlId = null) {
			$this->txtLongitude = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtLongitude->Name = t('Longitude');
			$this->txtLongitude->MaxLength = City::LongitudeMaxLength;
			$this->txtLongitude->PreferredRenderMethod = 'RenderWithName';
        $this->txtLongitude->LinkedNode = QQN::City()->Longitude;
			$this->txtLongitude->Text = $this->objCity->Longitude;
			return $this->txtLongitude;
		}

    /**
     * Create and setup QCubed\Control\Label lblLongitude
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblLongitude_Create($strControlId = null) 
    {
        $this->lblLongitude = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblLongitude->Name = t('Longitude');
        $this->lblLongitude->PreferredRenderMethod = 'RenderWithName';
        $this->lblLongitude->LinkedNode = QQN::City()->Longitude;
			$this->lblLongitude->Text = $this->objCity->Longitude;
        return $this->lblLongitude;
    }



		/**
		 * Create and setup a QCubed\Control\IntegerTextBox txtAccuracy
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Control\IntegerTextBox
		 */
		public function txtAccuracy_Create($strControlId = null) {
			$this->txtAccuracy = new \QCubed\Control\IntegerTextBox($this->objParentObject, $strControlId);
			$this->txtAccuracy->Name = t('Accuracy');
			$this->txtAccuracy->PreferredRenderMethod = 'RenderWithName';
        $this->txtAccuracy->LinkedNode = QQN::City()->Accuracy;
			$this->txtAccuracy->Text = $this->objCity->Accuracy;
			return $this->txtAccuracy;
		}

    /**
     * Create and setup QCubed\Control\Label lblAccuracy
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblAccuracy_Create($strControlId = null) 
    {
        $this->lblAccuracy = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblAccuracy->Name = t('Accuracy');
        $this->lblAccuracy->PreferredRenderMethod = 'RenderWithName';
        $this->lblAccuracy->LinkedNode = QQN::City()->Accuracy;
			$this->lblAccuracy->Text = $this->objCity->Accuracy;
        return $this->lblAccuracy;
    }






    /**
     * Refresh this ModelConnector with Data from the local City object.
     * @param boolean $blnReload reload City from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objCity); // Notify in development version
        if (!($this->objCity)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objCity->Reload();
        }
			if ($this->txtId) $this->txtId->Text = $this->objCity->Id;
			if ($this->lblId) $this->lblId->Text = $this->objCity->Id;


			if ($this->txtCountryId) $this->txtCountryId->Text = $this->objCity->CountryId;
			if ($this->lblCountryId) $this->lblCountryId->Text = $this->objCity->CountryId;


			if ($this->txtPostalCode) $this->txtPostalCode->Text = $this->objCity->PostalCode;
			if ($this->lblPostalCode) $this->lblPostalCode->Text = $this->objCity->PostalCode;


			if ($this->txtName) $this->txtName->Text = $this->objCity->Name;
			if ($this->lblName) $this->lblName->Text = $this->objCity->Name;


			if ($this->txtAdminName1) $this->txtAdminName1->Text = $this->objCity->AdminName1;
			if ($this->lblAdminName1) $this->lblAdminName1->Text = $this->objCity->AdminName1;


			if ($this->txtAdminCode1) $this->txtAdminCode1->Text = $this->objCity->AdminCode1;
			if ($this->lblAdminCode1) $this->lblAdminCode1->Text = $this->objCity->AdminCode1;


			if ($this->txtAdminName2) $this->txtAdminName2->Text = $this->objCity->AdminName2;
			if ($this->lblAdminName2) $this->lblAdminName2->Text = $this->objCity->AdminName2;


			if ($this->txtAdminCode2) $this->txtAdminCode2->Text = $this->objCity->AdminCode2;
			if ($this->lblAdminCode2) $this->lblAdminCode2->Text = $this->objCity->AdminCode2;


			if ($this->txtAdminName3) $this->txtAdminName3->Text = $this->objCity->AdminName3;
			if ($this->lblAdminName3) $this->lblAdminName3->Text = $this->objCity->AdminName3;


			if ($this->txtAdminCode3) $this->txtAdminCode3->Text = $this->objCity->AdminCode3;
			if ($this->lblAdminCode3) $this->lblAdminCode3->Text = $this->objCity->AdminCode3;


			if ($this->txtLatitude) $this->txtLatitude->Text = $this->objCity->Latitude;
			if ($this->lblLatitude) $this->lblLatitude->Text = $this->objCity->Latitude;


			if ($this->txtLongitude) $this->txtLongitude->Text = $this->objCity->Longitude;
			if ($this->lblLongitude) $this->lblLongitude->Text = $this->objCity->Longitude;


			if ($this->txtAccuracy) $this->txtAccuracy->Text = $this->objCity->Accuracy;
			if ($this->lblAccuracy) $this->lblAccuracy->Text = $this->objCity->Accuracy;


    }

    /**
     * Load this ModelConnector with a City object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|City
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objCity = City::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objCity = new City();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objCity) {
            $this->refresh ();
        }
        return $this->objCity;
    }




        /**
    * This will update this object's City instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateCity()
    {
        try {
            // Update any fields for controls that have been created
				if ($this->txtId) $this->objCity->Id = $this->txtId->Text;

				if ($this->txtCountryId) $this->objCity->CountryId = $this->txtCountryId->Text;

				if ($this->txtPostalCode) $this->objCity->PostalCode = $this->txtPostalCode->Text;

				if ($this->txtName) $this->objCity->Name = $this->txtName->Text;

				if ($this->txtAdminName1) $this->objCity->AdminName1 = $this->txtAdminName1->Text;

				if ($this->txtAdminCode1) $this->objCity->AdminCode1 = $this->txtAdminCode1->Text;

				if ($this->txtAdminName2) $this->objCity->AdminName2 = $this->txtAdminName2->Text;

				if ($this->txtAdminCode2) $this->objCity->AdminCode2 = $this->txtAdminCode2->Text;

				if ($this->txtAdminName3) $this->objCity->AdminName3 = $this->txtAdminName3->Text;

				if ($this->txtAdminCode3) $this->objCity->AdminCode3 = $this->txtAdminCode3->Text;

				if ($this->txtLatitude) $this->objCity->Latitude = $this->txtLatitude->Text;

				if ($this->txtLongitude) $this->objCity->Longitude = $this->txtLongitude->Text;

				if ($this->txtAccuracy) $this->objCity->Accuracy = $this->txtAccuracy->Text;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's City instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveCity($blnForceUpdate = false)
    {
        try {
            $this->updateCity();
            $id = $this->objCity->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's City instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteCity()
    {
        $this->objCity->delete();
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
            case 'City': return $this->objCity;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to City fields -- will be created dynamically if not yet created
            case 'IdControl':
                if (!$this->txtId) return $this->txtId_Create();
                return $this->txtId;
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'CountryIdControl':
                if (!$this->txtCountryId) return $this->txtCountryId_Create();
                return $this->txtCountryId;
            case 'CountryIdLabel':
                if (!$this->lblCountryId) return $this->lblCountryId_Create();
                return $this->lblCountryId;
            case 'PostalCodeControl':
                if (!$this->txtPostalCode) return $this->txtPostalCode_Create();
                return $this->txtPostalCode;
            case 'PostalCodeLabel':
                if (!$this->lblPostalCode) return $this->lblPostalCode_Create();
                return $this->lblPostalCode;
            case 'NameControl':
                if (!$this->txtName) return $this->txtName_Create();
                return $this->txtName;
            case 'NameLabel':
                if (!$this->lblName) return $this->lblName_Create();
                return $this->lblName;
            case 'AdminName1Control':
                if (!$this->txtAdminName1) return $this->txtAdminName1_Create();
                return $this->txtAdminName1;
            case 'AdminName1Label':
                if (!$this->lblAdminName1) return $this->lblAdminName1_Create();
                return $this->lblAdminName1;
            case 'AdminCode1Control':
                if (!$this->txtAdminCode1) return $this->txtAdminCode1_Create();
                return $this->txtAdminCode1;
            case 'AdminCode1Label':
                if (!$this->lblAdminCode1) return $this->lblAdminCode1_Create();
                return $this->lblAdminCode1;
            case 'AdminName2Control':
                if (!$this->txtAdminName2) return $this->txtAdminName2_Create();
                return $this->txtAdminName2;
            case 'AdminName2Label':
                if (!$this->lblAdminName2) return $this->lblAdminName2_Create();
                return $this->lblAdminName2;
            case 'AdminCode2Control':
                if (!$this->txtAdminCode2) return $this->txtAdminCode2_Create();
                return $this->txtAdminCode2;
            case 'AdminCode2Label':
                if (!$this->lblAdminCode2) return $this->lblAdminCode2_Create();
                return $this->lblAdminCode2;
            case 'AdminName3Control':
                if (!$this->txtAdminName3) return $this->txtAdminName3_Create();
                return $this->txtAdminName3;
            case 'AdminName3Label':
                if (!$this->lblAdminName3) return $this->lblAdminName3_Create();
                return $this->lblAdminName3;
            case 'AdminCode3Control':
                if (!$this->txtAdminCode3) return $this->txtAdminCode3_Create();
                return $this->txtAdminCode3;
            case 'AdminCode3Label':
                if (!$this->lblAdminCode3) return $this->lblAdminCode3_Create();
                return $this->lblAdminCode3;
            case 'LatitudeControl':
                if (!$this->txtLatitude) return $this->txtLatitude_Create();
                return $this->txtLatitude;
            case 'LatitudeLabel':
                if (!$this->lblLatitude) return $this->lblLatitude_Create();
                return $this->lblLatitude;
            case 'LongitudeControl':
                if (!$this->txtLongitude) return $this->txtLongitude_Create();
                return $this->txtLongitude;
            case 'LongitudeLabel':
                if (!$this->lblLongitude) return $this->lblLongitude_Create();
                return $this->lblLongitude;
            case 'AccuracyControl':
                if (!$this->txtAccuracy) return $this->txtAccuracy_Create();
                return $this->txtAccuracy;
            case 'AccuracyLabel':
                if (!$this->lblAccuracy) return $this->lblAccuracy_Create();
                return $this->lblAccuracy;
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

                // Controls that point to City fields
                case 'IdControl':
                    $this->txtId = Type::Cast($mixValue, '\\QCubed\Control\IntegerTextBox');
                    break;
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'CountryIdControl':
                    $this->txtCountryId = Type::Cast($mixValue, '\\QCubed\Control\IntegerTextBox');
                    break;
                case 'CountryIdLabel':
                    $this->lblCountryId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'PostalCodeControl':
                    $this->txtPostalCode = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'PostalCodeLabel':
                    $this->lblPostalCode = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'NameControl':
                    $this->txtName = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'NameLabel':
                    $this->lblName = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'AdminName1Control':
                    $this->txtAdminName1 = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'AdminName1Label':
                    $this->lblAdminName1 = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'AdminCode1Control':
                    $this->txtAdminCode1 = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'AdminCode1Label':
                    $this->lblAdminCode1 = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'AdminName2Control':
                    $this->txtAdminName2 = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'AdminName2Label':
                    $this->lblAdminName2 = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'AdminCode2Control':
                    $this->txtAdminCode2 = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'AdminCode2Label':
                    $this->lblAdminCode2 = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'AdminName3Control':
                    $this->txtAdminName3 = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'AdminName3Label':
                    $this->lblAdminName3 = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'AdminCode3Control':
                    $this->txtAdminCode3 = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'AdminCode3Label':
                    $this->lblAdminCode3 = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'LatitudeControl':
                    $this->txtLatitude = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'LatitudeLabel':
                    $this->lblLatitude = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'LongitudeControl':
                    $this->txtLongitude = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'LongitudeLabel':
                    $this->lblLongitude = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'AccuracyControl':
                    $this->txtAccuracy = Type::Cast($mixValue, '\\QCubed\Control\IntegerTextBox');
                    break;
                case 'AccuracyLabel':
                    $this->lblAccuracy = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
