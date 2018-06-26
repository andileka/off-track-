<?php

use QCubed as Q;
use QCubed\Exception\Caller as Caller;
use QCubed\Project\Control\FormBase;
use QCubed\Project\Control\ControlBase;
use QCubed\Query\QQ;
use QCubed\Control\Label;
use QCubed\Project\Control\TextBox;
use QCubed\Project\Control\ListBox;
use QCubed\Control\ListControl;
use QCubed\Control\ListItem;
use QCubed\Query\Condition\ConditionInterface as QQCondition;
use QCubed\Query\Clause\ClauseInterface as QQClause;

/**
 * This is a ModelConnector class, providing a Form or Panel access to event handlers
 * and Controls to perform the Create, Edit, and Delete functionality
 * of the Tourist class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single Tourist object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a TouristConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read Tourist $Tourist the actual Tourist data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Project\Control\TextBox $NameControl
 * @property-read QCubed\\Control\\Label $NameLabel
 * @property QCubed\Project\Control\TextBox $PassportControl
 * @property-read QCubed\\Control\\Label $PassportLabel
 * @property QCubed\Project\Control\TextBox $ContactinfoControl
 * @property-read QCubed\\Control\\Label $ContactinfoLabel
 * @property QCubed\Project\Control\ListBox $LanguageIdControl
 * @property-read QCubed\\Control\\Label $LanguageIdLabel
 * @property QCubed\Project\Control\ListBox $CityIdControl
 * @property-read QCubed\\Control\\Label $CityIdLabel
 * @property QCubed\Project\Control\ListBox $CountryIdControl
 * @property-read QCubed\\Control\\Label $CountryIdLabel
 * @property QCubed\Project\Control\ListBox $PositionIdControl
 * @property-read QCubed\\Control\\Label $PositionIdLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class TouristConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var Tourist objTourist
     * @access protected
     */
    protected $objTourist;
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

    // Controls that correspond to Tourist's individual data fields
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
    protected $txtPassport;

    /**
     * @var Label
     * @access protected
     */
    protected $lblPassport;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtContactinfo;

    /**
     * @var Label
     * @access protected
     */
    protected $lblContactinfo;

    /**
     * @var QCubed\Project\Control\ListBox
     * @access protected
     */
    protected $lstLanguage;

    /**
     * @var string 
     * @access protected
     */
    protected $strLanguageNullLabel;

    /**
    * @var QQCondition
    * @access protected
    */
    protected $objLanguageCondition;

    /**
    * @var QQClause[]
    * @access protected
    */
    protected $objLanguageClauses;
    /**
     * @var Label
     * @access protected
     */
    protected $lblLanguage;

    /**
     * @var QCubed\Project\Control\ListBox
     * @access protected
     */
    protected $lstCity;

    /**
     * @var string 
     * @access protected
     */
    protected $strCityNullLabel;

    /**
    * @var QQCondition
    * @access protected
    */
    protected $objCityCondition;

    /**
    * @var QQClause[]
    * @access protected
    */
    protected $objCityClauses;
    /**
     * @var Label
     * @access protected
     */
    protected $lblCity;

    /**
     * @var QCubed\Project\Control\ListBox
     * @access protected
     */
    protected $lstCountry;

    /**
     * @var string 
     * @access protected
     */
    protected $strCountryNullLabel;

    /**
    * @var QQCondition
    * @access protected
    */
    protected $objCountryCondition;

    /**
    * @var QQClause[]
    * @access protected
    */
    protected $objCountryClauses;
    /**
     * @var Label
     * @access protected
     */
    protected $lblCountry;

    /**
     * @var QCubed\Project\Control\ListBox
     * @access protected
     */
    protected $lstPosition;

    /**
     * @var string 
     * @access protected
     */
    protected $strPositionNullLabel;

    /**
    * @var QQCondition
    * @access protected
    */
    protected $objPositionCondition;

    /**
    * @var QQClause[]
    * @access protected
    */
    protected $objPositionClauses;
    /**
     * @var Label
     * @access protected
     */
    protected $lblPosition;



    /**
     * Main constructor.  Constructor OR static create methods are designed to be called in either
     * a parent Panel or the main Form when wanting to create a
     * TouristConnector to edit a single Tourist object within the
     * Panel or Form.
     *
     * This constructor takes in a single Tourist object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TouristConnector
     * @param Tourist $objTourist new or existing Tourist object
     */
     public function __construct($objParentObject, Tourist $objTourist)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this TouristConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked Tourist object
        $this->objTourist = $objTourist;

        // Figure out if we're Editing or Creating New
        if ($this->objTourist->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TouristConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing Tourist object creation - defaults to CreateOrEdit
     * @return TouristConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objTourist = Tourist::load($intId);

            // Tourist was found -- return it!
            if ($objTourist)
                return new TouristConnector($objParentObject, $objTourist);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a Tourist object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new TouristConnector($objParentObject, new Tourist());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TouristConnector
     * @param integer $intCreateType rules governing Tourist object creation - defaults to CreateOrEdit
     * @return TouristConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return TouristConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TouristConnector
     * @param integer $intCreateType rules governing Tourist object creation - defaults to CreateOrEdit
     * @return TouristConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return TouristConnector::create($objParentObject, $intId, $intCreateType);
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
        $this->lblId->LinkedNode = QQN::Tourist()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objTourist->Id : t('N\A');
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
			$this->txtName->MaxLength = Tourist::NameMaxLength;
			$this->txtName->PreferredRenderMethod = 'RenderWithName';
        $this->txtName->LinkedNode = QQN::Tourist()->Name;
			$this->txtName->Text = $this->objTourist->Name;
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
        $this->lblName->LinkedNode = QQN::Tourist()->Name;
			$this->lblName->Text = $this->objTourist->Name;
        return $this->lblName;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtPassport
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtPassport_Create($strControlId = null) {
			$this->txtPassport = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtPassport->Name = t('Passport');
			$this->txtPassport->Required = true;
			$this->txtPassport->MaxLength = Tourist::PassportMaxLength;
			$this->txtPassport->PreferredRenderMethod = 'RenderWithName';
        $this->txtPassport->LinkedNode = QQN::Tourist()->Passport;
			$this->txtPassport->Text = $this->objTourist->Passport;
			return $this->txtPassport;
		}

    /**
     * Create and setup QCubed\Control\Label lblPassport
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblPassport_Create($strControlId = null) 
    {
        $this->lblPassport = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblPassport->Name = t('Passport');
        $this->lblPassport->PreferredRenderMethod = 'RenderWithName';
        $this->lblPassport->LinkedNode = QQN::Tourist()->Passport;
			$this->lblPassport->Text = $this->objTourist->Passport;
        return $this->lblPassport;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtContactinfo
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtContactinfo_Create($strControlId = null) {
			$this->txtContactinfo = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtContactinfo->Name = t('Contactinfo');
			$this->txtContactinfo->MaxLength = Tourist::ContactinfoMaxLength;
			$this->txtContactinfo->PreferredRenderMethod = 'RenderWithName';
        $this->txtContactinfo->LinkedNode = QQN::Tourist()->Contactinfo;
			$this->txtContactinfo->Text = $this->objTourist->Contactinfo;
			return $this->txtContactinfo;
		}

    /**
     * Create and setup QCubed\Control\Label lblContactinfo
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblContactinfo_Create($strControlId = null) 
    {
        $this->lblContactinfo = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblContactinfo->Name = t('Contactinfo');
        $this->lblContactinfo->PreferredRenderMethod = 'RenderWithName';
        $this->lblContactinfo->LinkedNode = QQN::Tourist()->Contactinfo;
			$this->lblContactinfo->Text = $this->objTourist->Contactinfo;
        return $this->lblContactinfo;
    }



		/**
		 * Create and setup QCubed\Project\Control\ListBox lstLanguage
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objCondition override the default condition of QQ::all() to the query, itself
		 * @param QQClause[] $objClauses additional QQClause object or array of QQClause objects for the query
		 * @return ListBox
		 */
		public function lstLanguage_Create($strControlId = null, QQCondition $objCondition = null, $objClauses = null) {
			$this->objLanguageCondition = $objCondition;
			$this->objLanguageClauses = $objClauses;
			$this->lstLanguage = new \QCubed\Project\Control\ListBox($this->objParentObject, $strControlId);
			$this->lstLanguage->Name = t('Language');
			$this->lstLanguage->PreferredRenderMethod = 'RenderWithName';
        $this->lstLanguage->LinkedNode = QQN::Tourist()->Language;
      if (!$this->strLanguageNullLabel) {
      	if (!$this->lstLanguage->Required) {
      		$this->strLanguageNullLabel = t('- None -');
      	}
      	elseif (!$this->blnEditMode) {
      		$this->strLanguageNullLabel = t('- Select One -');
      	}
      }
      $this->lstLanguage->addItem($this->strLanguageNullLabel, null);
      $this->lstLanguage->addItems($this->lstLanguage_GetItems());
      $this->lstLanguage->SelectedValue = $this->objTourist->LanguageId;
			return $this->lstLanguage;
		}

		/**
		 *	Create item list for use by lstLanguage
		 */
		 public function lstLanguage_GetItems() {
			$a = array();
			$objCondition = $this->objLanguageCondition;
			if (is_null($objCondition)) $objCondition = QQ::all();
			$objLanguageCursor = Language::queryCursor($objCondition, $this->objLanguageClauses);

			// Iterate through the Cursor
			while ($objLanguage = Language::instantiateCursor($objLanguageCursor)) {
				$objListItem = new ListItem($objLanguage->__toString(), $objLanguage->Id);
				if (($this->objTourist->Language) && ($this->objTourist->Language->Id == $objLanguage->Id))
					$objListItem->Selected = true;
				$a[] = $objListItem;
			}
			return $a;
		 }

    /**
     * Create and setup QCubed\Control\Label lblLanguage
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblLanguage_Create($strControlId = null) 
    {
        $this->lblLanguage = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblLanguage->Name = t('Language');
        $this->lblLanguage->PreferredRenderMethod = 'RenderWithName';
        $this->lblLanguage->LinkedNode = QQN::Tourist()->Language;
			$this->lblLanguage->Text = $this->objTourist->Language ? $this->objTourist->Language->__toString() : null;
        return $this->lblLanguage;
    }



		/**
		 * Create and setup QCubed\Project\Control\ListBox lstCity
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objCondition override the default condition of QQ::all() to the query, itself
		 * @param QQClause[] $objClauses additional QQClause object or array of QQClause objects for the query
		 * @return ListBox
		 */
		public function lstCity_Create($strControlId = null, QQCondition $objCondition = null, $objClauses = null) {
			$this->objCityCondition = $objCondition;
			$this->objCityClauses = $objClauses;
			$this->lstCity = new \QCubed\Project\Control\ListBox($this->objParentObject, $strControlId);
			$this->lstCity->Name = t('City');
			$this->lstCity->PreferredRenderMethod = 'RenderWithName';
        $this->lstCity->LinkedNode = QQN::Tourist()->City;
      if (!$this->strCityNullLabel) {
      	if (!$this->lstCity->Required) {
      		$this->strCityNullLabel = t('- None -');
      	}
      	elseif (!$this->blnEditMode) {
      		$this->strCityNullLabel = t('- Select One -');
      	}
      }
      $this->lstCity->addItem($this->strCityNullLabel, null);
      $this->lstCity->addItems($this->lstCity_GetItems());
      $this->lstCity->SelectedValue = $this->objTourist->CityId;
			return $this->lstCity;
		}

		/**
		 *	Create item list for use by lstCity
		 */
		 public function lstCity_GetItems() {
			$a = array();
			$objCondition = $this->objCityCondition;
			if (is_null($objCondition)) $objCondition = QQ::all();
			$objCityCursor = City::queryCursor($objCondition, $this->objCityClauses);

			// Iterate through the Cursor
			while ($objCity = City::instantiateCursor($objCityCursor)) {
				$objListItem = new ListItem($objCity->__toString(), $objCity->Id);
				if (($this->objTourist->City) && ($this->objTourist->City->Id == $objCity->Id))
					$objListItem->Selected = true;
				$a[] = $objListItem;
			}
			return $a;
		 }

    /**
     * Create and setup QCubed\Control\Label lblCity
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblCity_Create($strControlId = null) 
    {
        $this->lblCity = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblCity->Name = t('City');
        $this->lblCity->PreferredRenderMethod = 'RenderWithName';
        $this->lblCity->LinkedNode = QQN::Tourist()->City;
			$this->lblCity->Text = $this->objTourist->City ? $this->objTourist->City->__toString() : null;
        return $this->lblCity;
    }



		/**
		 * Create and setup QCubed\Project\Control\ListBox lstCountry
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objCondition override the default condition of QQ::all() to the query, itself
		 * @param QQClause[] $objClauses additional QQClause object or array of QQClause objects for the query
		 * @return ListBox
		 */
		public function lstCountry_Create($strControlId = null, QQCondition $objCondition = null, $objClauses = null) {
			$this->objCountryCondition = $objCondition;
			$this->objCountryClauses = $objClauses;
			$this->lstCountry = new \QCubed\Project\Control\ListBox($this->objParentObject, $strControlId);
			$this->lstCountry->Name = t('Country');
			$this->lstCountry->PreferredRenderMethod = 'RenderWithName';
        $this->lstCountry->LinkedNode = QQN::Tourist()->Country;
      if (!$this->strCountryNullLabel) {
      	if (!$this->lstCountry->Required) {
      		$this->strCountryNullLabel = t('- None -');
      	}
      	elseif (!$this->blnEditMode) {
      		$this->strCountryNullLabel = t('- Select One -');
      	}
      }
      $this->lstCountry->addItem($this->strCountryNullLabel, null);
      $this->lstCountry->addItems($this->lstCountry_GetItems());
      $this->lstCountry->SelectedValue = $this->objTourist->CountryId;
			return $this->lstCountry;
		}

		/**
		 *	Create item list for use by lstCountry
		 */
		 public function lstCountry_GetItems() {
			$a = array();
			$objCondition = $this->objCountryCondition;
			if (is_null($objCondition)) $objCondition = QQ::all();
			$objCountryCursor = Country::queryCursor($objCondition, $this->objCountryClauses);

			// Iterate through the Cursor
			while ($objCountry = Country::instantiateCursor($objCountryCursor)) {
				$objListItem = new ListItem($objCountry->__toString(), $objCountry->Id);
				if (($this->objTourist->Country) && ($this->objTourist->Country->Id == $objCountry->Id))
					$objListItem->Selected = true;
				$a[] = $objListItem;
			}
			return $a;
		 }

    /**
     * Create and setup QCubed\Control\Label lblCountry
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblCountry_Create($strControlId = null) 
    {
        $this->lblCountry = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblCountry->Name = t('Country');
        $this->lblCountry->PreferredRenderMethod = 'RenderWithName';
        $this->lblCountry->LinkedNode = QQN::Tourist()->Country;
			$this->lblCountry->Text = $this->objTourist->Country ? $this->objTourist->Country->__toString() : null;
        return $this->lblCountry;
    }



		/**
		 * Create and setup QCubed\Project\Control\ListBox lstPosition
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objCondition override the default condition of QQ::all() to the query, itself
		 * @param QQClause[] $objClauses additional QQClause object or array of QQClause objects for the query
		 * @return ListBox
		 */
		public function lstPosition_Create($strControlId = null, QQCondition $objCondition = null, $objClauses = null) {
			$this->objPositionCondition = $objCondition;
			$this->objPositionClauses = $objClauses;
			$this->lstPosition = new \QCubed\Project\Control\ListBox($this->objParentObject, $strControlId);
			$this->lstPosition->Name = t('Position');
			$this->lstPosition->PreferredRenderMethod = 'RenderWithName';
        $this->lstPosition->LinkedNode = QQN::Tourist()->Position;
      if (!$this->strPositionNullLabel) {
      	if (!$this->lstPosition->Required) {
      		$this->strPositionNullLabel = t('- None -');
      	}
      	elseif (!$this->blnEditMode) {
      		$this->strPositionNullLabel = t('- Select One -');
      	}
      }
      $this->lstPosition->addItem($this->strPositionNullLabel, null);
      $this->lstPosition->addItems($this->lstPosition_GetItems());
      $this->lstPosition->SelectedValue = $this->objTourist->PositionId;
			return $this->lstPosition;
		}

		/**
		 *	Create item list for use by lstPosition
		 */
		 public function lstPosition_GetItems() {
			$a = array();
			$objCondition = $this->objPositionCondition;
			if (is_null($objCondition)) $objCondition = QQ::all();
			$objPositionCursor = Position::queryCursor($objCondition, $this->objPositionClauses);

			// Iterate through the Cursor
			while ($objPosition = Position::instantiateCursor($objPositionCursor)) {
				$objListItem = new ListItem($objPosition->__toString(), $objPosition->Id);
				if (($this->objTourist->Position) && ($this->objTourist->Position->Id == $objPosition->Id))
					$objListItem->Selected = true;
				$a[] = $objListItem;
			}
			return $a;
		 }

    /**
     * Create and setup QCubed\Control\Label lblPosition
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblPosition_Create($strControlId = null) 
    {
        $this->lblPosition = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblPosition->Name = t('Position');
        $this->lblPosition->PreferredRenderMethod = 'RenderWithName';
        $this->lblPosition->LinkedNode = QQN::Tourist()->Position;
			$this->lblPosition->Text = $this->objTourist->Position ? $this->objTourist->Position->__toString() : null;
        return $this->lblPosition;
    }






    /**
     * Refresh this ModelConnector with Data from the local Tourist object.
     * @param boolean $blnReload reload Tourist from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objTourist); // Notify in development version
        if (!($this->objTourist)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objTourist->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objTourist->Id : t('N\A');


			if ($this->txtName) $this->txtName->Text = $this->objTourist->Name;
			if ($this->lblName) $this->lblName->Text = $this->objTourist->Name;


			if ($this->txtPassport) $this->txtPassport->Text = $this->objTourist->Passport;
			if ($this->lblPassport) $this->lblPassport->Text = $this->objTourist->Passport;


			if ($this->txtContactinfo) $this->txtContactinfo->Text = $this->objTourist->Contactinfo;
			if ($this->lblContactinfo) $this->lblContactinfo->Text = $this->objTourist->Contactinfo;


      if ($this->lstLanguage) {
        $this->lstLanguage->removeAllItems();
        $this->lstLanguage->addItem($this->strLanguageNullLabel, null);
        $this->lstLanguage->addItems($this->lstLanguage_GetItems());
        $this->lstLanguage->SelectedValue = $this->objTourist->LanguageId;
      
      }
			if ($this->lblLanguage) $this->lblLanguage->Text = $this->objTourist->Language ? $this->objTourist->Language->__toString() : null;


      if ($this->lstCity) {
        $this->lstCity->removeAllItems();
        $this->lstCity->addItem($this->strCityNullLabel, null);
        $this->lstCity->addItems($this->lstCity_GetItems());
        $this->lstCity->SelectedValue = $this->objTourist->CityId;
      
      }
			if ($this->lblCity) $this->lblCity->Text = $this->objTourist->City ? $this->objTourist->City->__toString() : null;


      if ($this->lstCountry) {
        $this->lstCountry->removeAllItems();
        $this->lstCountry->addItem($this->strCountryNullLabel, null);
        $this->lstCountry->addItems($this->lstCountry_GetItems());
        $this->lstCountry->SelectedValue = $this->objTourist->CountryId;
      
      }
			if ($this->lblCountry) $this->lblCountry->Text = $this->objTourist->Country ? $this->objTourist->Country->__toString() : null;


      if ($this->lstPosition) {
        $this->lstPosition->removeAllItems();
        $this->lstPosition->addItem($this->strPositionNullLabel, null);
        $this->lstPosition->addItems($this->lstPosition_GetItems());
        $this->lstPosition->SelectedValue = $this->objTourist->PositionId;
      
      }
			if ($this->lblPosition) $this->lblPosition->Text = $this->objTourist->Position ? $this->objTourist->Position->__toString() : null;


    }

    /**
     * Load this ModelConnector with a Tourist object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|Tourist
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objTourist = Tourist::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objTourist = new Tourist();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objTourist) {
            $this->refresh ();
        }
        return $this->objTourist;
    }




        /**
    * This will update this object's Tourist instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateTourist()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->txtName) $this->objTourist->Name = $this->txtName->Text;

				if ($this->txtPassport) $this->objTourist->Passport = $this->txtPassport->Text;

				if ($this->txtContactinfo) $this->objTourist->Contactinfo = $this->txtContactinfo->Text;

				if ($this->lstLanguage) $this->objTourist->LanguageId = $this->lstLanguage->SelectedValue;

				if ($this->lstCity) $this->objTourist->CityId = $this->lstCity->SelectedValue;

				if ($this->lstCountry) $this->objTourist->CountryId = $this->lstCountry->SelectedValue;

				if ($this->lstPosition) $this->objTourist->PositionId = $this->lstPosition->SelectedValue;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's Tourist instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveTourist($blnForceUpdate = false)
    {
        try {
            $this->updateTourist();
            $id = $this->objTourist->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's Tourist instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteTourist()
    {
        $this->objTourist->delete();
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
            case 'Tourist': return $this->objTourist;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to Tourist fields -- will be created dynamically if not yet created
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'NameControl':
                if (!$this->txtName) return $this->txtName_Create();
                return $this->txtName;
            case 'NameLabel':
                if (!$this->lblName) return $this->lblName_Create();
                return $this->lblName;
            case 'PassportControl':
                if (!$this->txtPassport) return $this->txtPassport_Create();
                return $this->txtPassport;
            case 'PassportLabel':
                if (!$this->lblPassport) return $this->lblPassport_Create();
                return $this->lblPassport;
            case 'ContactinfoControl':
                if (!$this->txtContactinfo) return $this->txtContactinfo_Create();
                return $this->txtContactinfo;
            case 'ContactinfoLabel':
                if (!$this->lblContactinfo) return $this->lblContactinfo_Create();
                return $this->lblContactinfo;
            case 'LanguageIdControl':
                if (!$this->lstLanguage) return $this->lstLanguage_Create();
                return $this->lstLanguage;
            case 'LanguageIdLabel':
                if (!$this->lblLanguage) return $this->lblLanguage_Create();
                return $this->lblLanguage;
            case 'LanguageNullLabel':
                return $this->strLanguageNullLabel;
            case 'CityIdControl':
                if (!$this->lstCity) return $this->lstCity_Create();
                return $this->lstCity;
            case 'CityIdLabel':
                if (!$this->lblCity) return $this->lblCity_Create();
                return $this->lblCity;
            case 'CityNullLabel':
                return $this->strCityNullLabel;
            case 'CountryIdControl':
                if (!$this->lstCountry) return $this->lstCountry_Create();
                return $this->lstCountry;
            case 'CountryIdLabel':
                if (!$this->lblCountry) return $this->lblCountry_Create();
                return $this->lblCountry;
            case 'CountryNullLabel':
                return $this->strCountryNullLabel;
            case 'PositionIdControl':
                if (!$this->lstPosition) return $this->lstPosition_Create();
                return $this->lstPosition;
            case 'PositionIdLabel':
                if (!$this->lblPosition) return $this->lblPosition_Create();
                return $this->lblPosition;
            case 'PositionNullLabel':
                return $this->strPositionNullLabel;
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

                // Controls that point to Tourist fields
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'NameControl':
                    $this->txtName = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'NameLabel':
                    $this->lblName = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'PassportControl':
                    $this->txtPassport = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'PassportLabel':
                    $this->lblPassport = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'ContactinfoControl':
                    $this->txtContactinfo = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'ContactinfoLabel':
                    $this->lblContactinfo = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'LanguageIdControl':
                    $this->lstLanguage = Type::Cast($mixValue, '\\QCubed\Project\Control\ListBox');
                    break;
                case 'LanguageIdLabel':
                    $this->lblLanguage = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'LanguageNullLabel':
                    $this->strLanguageNullLabel = $mixValue;
                    break;
                case 'CityIdControl':
                    $this->lstCity = Type::Cast($mixValue, '\\QCubed\Project\Control\ListBox');
                    break;
                case 'CityIdLabel':
                    $this->lblCity = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'CityNullLabel':
                    $this->strCityNullLabel = $mixValue;
                    break;
                case 'CountryIdControl':
                    $this->lstCountry = Type::Cast($mixValue, '\\QCubed\Project\Control\ListBox');
                    break;
                case 'CountryIdLabel':
                    $this->lblCountry = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'CountryNullLabel':
                    $this->strCountryNullLabel = $mixValue;
                    break;
                case 'PositionIdControl':
                    $this->lstPosition = Type::Cast($mixValue, '\\QCubed\Project\Control\ListBox');
                    break;
                case 'PositionIdLabel':
                    $this->lblPosition = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'PositionNullLabel':
                    $this->strPositionNullLabel = $mixValue;
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
