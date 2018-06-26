<?php

use QCubed as Q;
use QCubed\Exception\Caller as Caller;
use QCubed\Project\Control\FormBase;
use QCubed\Project\Control\ControlBase;
use QCubed\Query\QQ;
use QCubed\Control\Label;
use QCubed\Project\Control\TextBox;
use QCubed\Control\IntegerTextBox;
use QCubed\Project\Control\Checkbox;

/**
 * This is a ModelConnector class, providing a Form or Panel access to event handlers
 * and Controls to perform the Create, Edit, and Delete functionality
 * of the Country class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single Country object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a CountryConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read Country $Country the actual Country data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Project\Control\TextBox $IsoCodeControl
 * @property-read QCubed\\Control\\Label $IsoCodeLabel
 * @property QCubed\Control\IntegerTextBox $TelCodeControl
 * @property-read QCubed\\Control\\Label $TelCodeLabel
 * @property QCubed\Project\Control\Checkbox $EuropeanUnionControl
 * @property-read QCubed\\Control\\Label $EuropeanUnionLabel
 * @property QCubed\Project\Control\TextBox $NameEnControl
 * @property-read QCubed\\Control\\Label $NameEnLabel
 * @property QCubed\Project\Control\TextBox $NameNlControl
 * @property-read QCubed\\Control\\Label $NameNlLabel
 * @property QCubed\Project\Control\TextBox $NameFrControl
 * @property-read QCubed\\Control\\Label $NameFrLabel
 * @property QCubed\Project\Control\TextBox $NameEsControl
 * @property-read QCubed\\Control\\Label $NameEsLabel
 * @property QCubed\Project\Control\TextBox $NameItControl
 * @property-read QCubed\\Control\\Label $NameItLabel
 * @property QCubed\Project\Control\TextBox $NameDeControl
 * @property-read QCubed\\Control\\Label $NameDeLabel
 * @property QCubed\Project\Control\TextBox $NamePlControl
 * @property-read QCubed\\Control\\Label $NamePlLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class CountryConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var Country objCountry
     * @access protected
     */
    protected $objCountry;
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

    // Controls that correspond to Country's individual data fields
    /**
     * @var Label
     * @access protected
     */
    protected $lblId;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtIsoCode;

    /**
     * @var Label
     * @access protected
     */
    protected $lblIsoCode;

    /**
     * @var QCubed\Control\IntegerTextBox

     * @access protected
     */
    protected $txtTelCode;

    /**
     * @var Label
     * @access protected
     */
    protected $lblTelCode;

    /**
     * @var QCubed\Project\Control\Checkbox

     * @access protected
     */
    protected $chkEuropeanUnion;

    /**
     * @var Label
     * @access protected
     */
    protected $lblEuropeanUnion;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtNameEn;

    /**
     * @var Label
     * @access protected
     */
    protected $lblNameEn;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtNameNl;

    /**
     * @var Label
     * @access protected
     */
    protected $lblNameNl;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtNameFr;

    /**
     * @var Label
     * @access protected
     */
    protected $lblNameFr;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtNameEs;

    /**
     * @var Label
     * @access protected
     */
    protected $lblNameEs;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtNameIt;

    /**
     * @var Label
     * @access protected
     */
    protected $lblNameIt;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtNameDe;

    /**
     * @var Label
     * @access protected
     */
    protected $lblNameDe;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtNamePl;

    /**
     * @var Label
     * @access protected
     */
    protected $lblNamePl;



    /**
     * Main constructor.  Constructor OR static create methods are designed to be called in either
     * a parent Panel or the main Form when wanting to create a
     * CountryConnector to edit a single Country object within the
     * Panel or Form.
     *
     * This constructor takes in a single Country object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this CountryConnector
     * @param Country $objCountry new or existing Country object
     */
     public function __construct($objParentObject, Country $objCountry)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this CountryConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked Country object
        $this->objCountry = $objCountry;

        // Figure out if we're Editing or Creating New
        if ($this->objCountry->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this CountryConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing Country object creation - defaults to CreateOrEdit
     * @return CountryConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objCountry = Country::load($intId);

            // Country was found -- return it!
            if ($objCountry)
                return new CountryConnector($objParentObject, $objCountry);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a Country object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new CountryConnector($objParentObject, new Country());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this CountryConnector
     * @param integer $intCreateType rules governing Country object creation - defaults to CreateOrEdit
     * @return CountryConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return CountryConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this CountryConnector
     * @param integer $intCreateType rules governing Country object creation - defaults to CreateOrEdit
     * @return CountryConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return CountryConnector::create($objParentObject, $intId, $intCreateType);
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
        $this->lblId->LinkedNode = QQN::Country()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objCountry->Id : t('N\A');
        return $this->lblId;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtIsoCode
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtIsoCode_Create($strControlId = null) {
			$this->txtIsoCode = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtIsoCode->Name = t('Iso Code');
			$this->txtIsoCode->Required = true;
			$this->txtIsoCode->MaxLength = Country::IsoCodeMaxLength;
			$this->txtIsoCode->PreferredRenderMethod = 'RenderWithName';
        $this->txtIsoCode->LinkedNode = QQN::Country()->IsoCode;
			$this->txtIsoCode->Text = $this->objCountry->IsoCode;
			return $this->txtIsoCode;
		}

    /**
     * Create and setup QCubed\Control\Label lblIsoCode
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblIsoCode_Create($strControlId = null) 
    {
        $this->lblIsoCode = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblIsoCode->Name = t('Iso Code');
        $this->lblIsoCode->PreferredRenderMethod = 'RenderWithName';
        $this->lblIsoCode->LinkedNode = QQN::Country()->IsoCode;
			$this->lblIsoCode->Text = $this->objCountry->IsoCode;
        return $this->lblIsoCode;
    }



		/**
		 * Create and setup a QCubed\Control\IntegerTextBox txtTelCode
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Control\IntegerTextBox
		 */
		public function txtTelCode_Create($strControlId = null) {
			$this->txtTelCode = new \QCubed\Control\IntegerTextBox($this->objParentObject, $strControlId);
			$this->txtTelCode->Name = t('Tel Code');
			$this->txtTelCode->PreferredRenderMethod = 'RenderWithName';
        $this->txtTelCode->LinkedNode = QQN::Country()->TelCode;
			$this->txtTelCode->Text = $this->objCountry->TelCode;
			return $this->txtTelCode;
		}

    /**
     * Create and setup QCubed\Control\Label lblTelCode
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblTelCode_Create($strControlId = null) 
    {
        $this->lblTelCode = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblTelCode->Name = t('Tel Code');
        $this->lblTelCode->PreferredRenderMethod = 'RenderWithName';
        $this->lblTelCode->LinkedNode = QQN::Country()->TelCode;
			$this->lblTelCode->Text = $this->objCountry->TelCode;
        return $this->lblTelCode;
    }



		/**
		 * Create and setup a QCubed\Project\Control\Checkbox chkEuropeanUnion
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\Checkbox
		 */
		public function chkEuropeanUnion_Create($strControlId = null) {
			$this->chkEuropeanUnion = new \QCubed\Project\Control\Checkbox($this->objParentObject, $strControlId);
			$this->chkEuropeanUnion->Name = t('European Union');
			$this->chkEuropeanUnion->Checked = $this->objCountry->EuropeanUnion;
			$this->chkEuropeanUnion->PreferredRenderMethod = 'RenderWithName';
        $this->chkEuropeanUnion->LinkedNode = QQN::Country()->EuropeanUnion;
			return $this->chkEuropeanUnion;
		}

    /**
     * Create and setup QCubed\Control\Label lblEuropeanUnion
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblEuropeanUnion_Create($strControlId = null) 
    {
        $this->lblEuropeanUnion = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblEuropeanUnion->Name = t('European Union');
        $this->lblEuropeanUnion->PreferredRenderMethod = 'RenderWithName';
        $this->lblEuropeanUnion->LinkedNode = QQN::Country()->EuropeanUnion;
			$this->lblEuropeanUnion->Text = $this->objCountry->EuropeanUnion ? t('Yes') : t('No');
        return $this->lblEuropeanUnion;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtNameEn
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtNameEn_Create($strControlId = null) {
			$this->txtNameEn = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtNameEn->Name = t('Name En');
			$this->txtNameEn->Required = true;
			$this->txtNameEn->MaxLength = Country::NameEnMaxLength;
			$this->txtNameEn->PreferredRenderMethod = 'RenderWithName';
        $this->txtNameEn->LinkedNode = QQN::Country()->NameEn;
			$this->txtNameEn->Text = $this->objCountry->NameEn;
			return $this->txtNameEn;
		}

    /**
     * Create and setup QCubed\Control\Label lblNameEn
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblNameEn_Create($strControlId = null) 
    {
        $this->lblNameEn = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblNameEn->Name = t('Name En');
        $this->lblNameEn->PreferredRenderMethod = 'RenderWithName';
        $this->lblNameEn->LinkedNode = QQN::Country()->NameEn;
			$this->lblNameEn->Text = $this->objCountry->NameEn;
        return $this->lblNameEn;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtNameNl
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtNameNl_Create($strControlId = null) {
			$this->txtNameNl = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtNameNl->Name = t('Name Nl');
			$this->txtNameNl->MaxLength = Country::NameNlMaxLength;
			$this->txtNameNl->PreferredRenderMethod = 'RenderWithName';
        $this->txtNameNl->LinkedNode = QQN::Country()->NameNl;
			$this->txtNameNl->Text = $this->objCountry->NameNl;
			return $this->txtNameNl;
		}

    /**
     * Create and setup QCubed\Control\Label lblNameNl
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblNameNl_Create($strControlId = null) 
    {
        $this->lblNameNl = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblNameNl->Name = t('Name Nl');
        $this->lblNameNl->PreferredRenderMethod = 'RenderWithName';
        $this->lblNameNl->LinkedNode = QQN::Country()->NameNl;
			$this->lblNameNl->Text = $this->objCountry->NameNl;
        return $this->lblNameNl;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtNameFr
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtNameFr_Create($strControlId = null) {
			$this->txtNameFr = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtNameFr->Name = t('Name Fr');
			$this->txtNameFr->MaxLength = Country::NameFrMaxLength;
			$this->txtNameFr->PreferredRenderMethod = 'RenderWithName';
        $this->txtNameFr->LinkedNode = QQN::Country()->NameFr;
			$this->txtNameFr->Text = $this->objCountry->NameFr;
			return $this->txtNameFr;
		}

    /**
     * Create and setup QCubed\Control\Label lblNameFr
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblNameFr_Create($strControlId = null) 
    {
        $this->lblNameFr = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblNameFr->Name = t('Name Fr');
        $this->lblNameFr->PreferredRenderMethod = 'RenderWithName';
        $this->lblNameFr->LinkedNode = QQN::Country()->NameFr;
			$this->lblNameFr->Text = $this->objCountry->NameFr;
        return $this->lblNameFr;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtNameEs
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtNameEs_Create($strControlId = null) {
			$this->txtNameEs = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtNameEs->Name = t('Name Es');
			$this->txtNameEs->MaxLength = Country::NameEsMaxLength;
			$this->txtNameEs->PreferredRenderMethod = 'RenderWithName';
        $this->txtNameEs->LinkedNode = QQN::Country()->NameEs;
			$this->txtNameEs->Text = $this->objCountry->NameEs;
			return $this->txtNameEs;
		}

    /**
     * Create and setup QCubed\Control\Label lblNameEs
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblNameEs_Create($strControlId = null) 
    {
        $this->lblNameEs = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblNameEs->Name = t('Name Es');
        $this->lblNameEs->PreferredRenderMethod = 'RenderWithName';
        $this->lblNameEs->LinkedNode = QQN::Country()->NameEs;
			$this->lblNameEs->Text = $this->objCountry->NameEs;
        return $this->lblNameEs;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtNameIt
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtNameIt_Create($strControlId = null) {
			$this->txtNameIt = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtNameIt->Name = t('Name It');
			$this->txtNameIt->MaxLength = Country::NameItMaxLength;
			$this->txtNameIt->PreferredRenderMethod = 'RenderWithName';
        $this->txtNameIt->LinkedNode = QQN::Country()->NameIt;
			$this->txtNameIt->Text = $this->objCountry->NameIt;
			return $this->txtNameIt;
		}

    /**
     * Create and setup QCubed\Control\Label lblNameIt
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblNameIt_Create($strControlId = null) 
    {
        $this->lblNameIt = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblNameIt->Name = t('Name It');
        $this->lblNameIt->PreferredRenderMethod = 'RenderWithName';
        $this->lblNameIt->LinkedNode = QQN::Country()->NameIt;
			$this->lblNameIt->Text = $this->objCountry->NameIt;
        return $this->lblNameIt;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtNameDe
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtNameDe_Create($strControlId = null) {
			$this->txtNameDe = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtNameDe->Name = t('Name De');
			$this->txtNameDe->MaxLength = Country::NameDeMaxLength;
			$this->txtNameDe->PreferredRenderMethod = 'RenderWithName';
        $this->txtNameDe->LinkedNode = QQN::Country()->NameDe;
			$this->txtNameDe->Text = $this->objCountry->NameDe;
			return $this->txtNameDe;
		}

    /**
     * Create and setup QCubed\Control\Label lblNameDe
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblNameDe_Create($strControlId = null) 
    {
        $this->lblNameDe = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblNameDe->Name = t('Name De');
        $this->lblNameDe->PreferredRenderMethod = 'RenderWithName';
        $this->lblNameDe->LinkedNode = QQN::Country()->NameDe;
			$this->lblNameDe->Text = $this->objCountry->NameDe;
        return $this->lblNameDe;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtNamePl
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtNamePl_Create($strControlId = null) {
			$this->txtNamePl = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtNamePl->Name = t('Name Pl');
			$this->txtNamePl->MaxLength = Country::NamePlMaxLength;
			$this->txtNamePl->PreferredRenderMethod = 'RenderWithName';
        $this->txtNamePl->LinkedNode = QQN::Country()->NamePl;
			$this->txtNamePl->Text = $this->objCountry->NamePl;
			return $this->txtNamePl;
		}

    /**
     * Create and setup QCubed\Control\Label lblNamePl
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblNamePl_Create($strControlId = null) 
    {
        $this->lblNamePl = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblNamePl->Name = t('Name Pl');
        $this->lblNamePl->PreferredRenderMethod = 'RenderWithName';
        $this->lblNamePl->LinkedNode = QQN::Country()->NamePl;
			$this->lblNamePl->Text = $this->objCountry->NamePl;
        return $this->lblNamePl;
    }






    /**
     * Refresh this ModelConnector with Data from the local Country object.
     * @param boolean $blnReload reload Country from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objCountry); // Notify in development version
        if (!($this->objCountry)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objCountry->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objCountry->Id : t('N\A');


			if ($this->txtIsoCode) $this->txtIsoCode->Text = $this->objCountry->IsoCode;
			if ($this->lblIsoCode) $this->lblIsoCode->Text = $this->objCountry->IsoCode;


			if ($this->txtTelCode) $this->txtTelCode->Text = $this->objCountry->TelCode;
			if ($this->lblTelCode) $this->lblTelCode->Text = $this->objCountry->TelCode;


			if ($this->chkEuropeanUnion) $this->chkEuropeanUnion->Checked = $this->objCountry->EuropeanUnion;
			if ($this->lblEuropeanUnion) $this->lblEuropeanUnion->Text = $this->objCountry->EuropeanUnion ? t('Yes') : t('No');


			if ($this->txtNameEn) $this->txtNameEn->Text = $this->objCountry->NameEn;
			if ($this->lblNameEn) $this->lblNameEn->Text = $this->objCountry->NameEn;


			if ($this->txtNameNl) $this->txtNameNl->Text = $this->objCountry->NameNl;
			if ($this->lblNameNl) $this->lblNameNl->Text = $this->objCountry->NameNl;


			if ($this->txtNameFr) $this->txtNameFr->Text = $this->objCountry->NameFr;
			if ($this->lblNameFr) $this->lblNameFr->Text = $this->objCountry->NameFr;


			if ($this->txtNameEs) $this->txtNameEs->Text = $this->objCountry->NameEs;
			if ($this->lblNameEs) $this->lblNameEs->Text = $this->objCountry->NameEs;


			if ($this->txtNameIt) $this->txtNameIt->Text = $this->objCountry->NameIt;
			if ($this->lblNameIt) $this->lblNameIt->Text = $this->objCountry->NameIt;


			if ($this->txtNameDe) $this->txtNameDe->Text = $this->objCountry->NameDe;
			if ($this->lblNameDe) $this->lblNameDe->Text = $this->objCountry->NameDe;


			if ($this->txtNamePl) $this->txtNamePl->Text = $this->objCountry->NamePl;
			if ($this->lblNamePl) $this->lblNamePl->Text = $this->objCountry->NamePl;


    }

    /**
     * Load this ModelConnector with a Country object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|Country
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objCountry = Country::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objCountry = new Country();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objCountry) {
            $this->refresh ();
        }
        return $this->objCountry;
    }




        /**
    * This will update this object's Country instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateCountry()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->txtIsoCode) $this->objCountry->IsoCode = $this->txtIsoCode->Text;

				if ($this->txtTelCode) $this->objCountry->TelCode = $this->txtTelCode->Text;

				if ($this->chkEuropeanUnion) $this->objCountry->EuropeanUnion = $this->chkEuropeanUnion->Checked;

				if ($this->txtNameEn) $this->objCountry->NameEn = $this->txtNameEn->Text;

				if ($this->txtNameNl) $this->objCountry->NameNl = $this->txtNameNl->Text;

				if ($this->txtNameFr) $this->objCountry->NameFr = $this->txtNameFr->Text;

				if ($this->txtNameEs) $this->objCountry->NameEs = $this->txtNameEs->Text;

				if ($this->txtNameIt) $this->objCountry->NameIt = $this->txtNameIt->Text;

				if ($this->txtNameDe) $this->objCountry->NameDe = $this->txtNameDe->Text;

				if ($this->txtNamePl) $this->objCountry->NamePl = $this->txtNamePl->Text;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's Country instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveCountry($blnForceUpdate = false)
    {
        try {
            $this->updateCountry();
            $id = $this->objCountry->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's Country instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteCountry()
    {
        $this->objCountry->delete();
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
            case 'Country': return $this->objCountry;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to Country fields -- will be created dynamically if not yet created
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'IsoCodeControl':
                if (!$this->txtIsoCode) return $this->txtIsoCode_Create();
                return $this->txtIsoCode;
            case 'IsoCodeLabel':
                if (!$this->lblIsoCode) return $this->lblIsoCode_Create();
                return $this->lblIsoCode;
            case 'TelCodeControl':
                if (!$this->txtTelCode) return $this->txtTelCode_Create();
                return $this->txtTelCode;
            case 'TelCodeLabel':
                if (!$this->lblTelCode) return $this->lblTelCode_Create();
                return $this->lblTelCode;
            case 'EuropeanUnionControl':
                if (!$this->chkEuropeanUnion) return $this->chkEuropeanUnion_Create();
                return $this->chkEuropeanUnion;
            case 'EuropeanUnionLabel':
                if (!$this->lblEuropeanUnion) return $this->lblEuropeanUnion_Create();
                return $this->lblEuropeanUnion;
            case 'NameEnControl':
                if (!$this->txtNameEn) return $this->txtNameEn_Create();
                return $this->txtNameEn;
            case 'NameEnLabel':
                if (!$this->lblNameEn) return $this->lblNameEn_Create();
                return $this->lblNameEn;
            case 'NameNlControl':
                if (!$this->txtNameNl) return $this->txtNameNl_Create();
                return $this->txtNameNl;
            case 'NameNlLabel':
                if (!$this->lblNameNl) return $this->lblNameNl_Create();
                return $this->lblNameNl;
            case 'NameFrControl':
                if (!$this->txtNameFr) return $this->txtNameFr_Create();
                return $this->txtNameFr;
            case 'NameFrLabel':
                if (!$this->lblNameFr) return $this->lblNameFr_Create();
                return $this->lblNameFr;
            case 'NameEsControl':
                if (!$this->txtNameEs) return $this->txtNameEs_Create();
                return $this->txtNameEs;
            case 'NameEsLabel':
                if (!$this->lblNameEs) return $this->lblNameEs_Create();
                return $this->lblNameEs;
            case 'NameItControl':
                if (!$this->txtNameIt) return $this->txtNameIt_Create();
                return $this->txtNameIt;
            case 'NameItLabel':
                if (!$this->lblNameIt) return $this->lblNameIt_Create();
                return $this->lblNameIt;
            case 'NameDeControl':
                if (!$this->txtNameDe) return $this->txtNameDe_Create();
                return $this->txtNameDe;
            case 'NameDeLabel':
                if (!$this->lblNameDe) return $this->lblNameDe_Create();
                return $this->lblNameDe;
            case 'NamePlControl':
                if (!$this->txtNamePl) return $this->txtNamePl_Create();
                return $this->txtNamePl;
            case 'NamePlLabel':
                if (!$this->lblNamePl) return $this->lblNamePl_Create();
                return $this->lblNamePl;
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

                // Controls that point to Country fields
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'IsoCodeControl':
                    $this->txtIsoCode = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'IsoCodeLabel':
                    $this->lblIsoCode = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'TelCodeControl':
                    $this->txtTelCode = Type::Cast($mixValue, '\\QCubed\Control\IntegerTextBox');
                    break;
                case 'TelCodeLabel':
                    $this->lblTelCode = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'EuropeanUnionControl':
                    $this->chkEuropeanUnion = Type::Cast($mixValue, '\\QCubed\Project\Control\Checkbox');
                    break;
                case 'EuropeanUnionLabel':
                    $this->lblEuropeanUnion = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'NameEnControl':
                    $this->txtNameEn = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'NameEnLabel':
                    $this->lblNameEn = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'NameNlControl':
                    $this->txtNameNl = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'NameNlLabel':
                    $this->lblNameNl = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'NameFrControl':
                    $this->txtNameFr = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'NameFrLabel':
                    $this->lblNameFr = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'NameEsControl':
                    $this->txtNameEs = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'NameEsLabel':
                    $this->lblNameEs = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'NameItControl':
                    $this->txtNameIt = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'NameItLabel':
                    $this->lblNameIt = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'NameDeControl':
                    $this->txtNameDe = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'NameDeLabel':
                    $this->lblNameDe = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'NamePlControl':
                    $this->txtNamePl = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'NamePlLabel':
                    $this->lblNamePl = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
