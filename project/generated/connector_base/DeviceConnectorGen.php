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
 * of the Device class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single Device object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a DeviceConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read Device $Device the actual Device data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Project\Control\TextBox $PacControl
 * @property-read QCubed\\Control\\Label $PacLabel
 * @property QCubed\Project\Control\TextBox $SerialControl
 * @property-read QCubed\\Control\\Label $SerialLabel
 * @property QCubed\Project\Control\ListBox $CompanyIdControl
 * @property-read QCubed\\Control\\Label $CompanyIdLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class DeviceConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var Device objDevice
     * @access protected
     */
    protected $objDevice;
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

    // Controls that correspond to Device's individual data fields
    /**
     * @var Label
     * @access protected
     */
    protected $lblId;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtPac;

    /**
     * @var Label
     * @access protected
     */
    protected $lblPac;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtSerial;

    /**
     * @var Label
     * @access protected
     */
    protected $lblSerial;

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
     * Main constructor.  Constructor OR static create methods are designed to be called in either
     * a parent Panel or the main Form when wanting to create a
     * DeviceConnector to edit a single Device object within the
     * Panel or Form.
     *
     * This constructor takes in a single Device object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this DeviceConnector
     * @param Device $objDevice new or existing Device object
     */
     public function __construct($objParentObject, Device $objDevice)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this DeviceConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked Device object
        $this->objDevice = $objDevice;

        // Figure out if we're Editing or Creating New
        if ($this->objDevice->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this DeviceConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing Device object creation - defaults to CreateOrEdit
     * @return DeviceConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objDevice = Device::load($intId);

            // Device was found -- return it!
            if ($objDevice)
                return new DeviceConnector($objParentObject, $objDevice);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a Device object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new DeviceConnector($objParentObject, new Device());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this DeviceConnector
     * @param integer $intCreateType rules governing Device object creation - defaults to CreateOrEdit
     * @return DeviceConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return DeviceConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this DeviceConnector
     * @param integer $intCreateType rules governing Device object creation - defaults to CreateOrEdit
     * @return DeviceConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return DeviceConnector::create($objParentObject, $intId, $intCreateType);
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
        $this->lblId->LinkedNode = QQN::Device()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objDevice->Id : t('N\A');
        return $this->lblId;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtPac
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtPac_Create($strControlId = null) {
			$this->txtPac = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtPac->Name = t('Pac');
			$this->txtPac->MaxLength = Device::PacMaxLength;
			$this->txtPac->PreferredRenderMethod = 'RenderWithName';
        $this->txtPac->LinkedNode = QQN::Device()->Pac;
			$this->txtPac->Text = $this->objDevice->Pac;
			return $this->txtPac;
		}

    /**
     * Create and setup QCubed\Control\Label lblPac
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblPac_Create($strControlId = null) 
    {
        $this->lblPac = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblPac->Name = t('Pac');
        $this->lblPac->PreferredRenderMethod = 'RenderWithName';
        $this->lblPac->LinkedNode = QQN::Device()->Pac;
			$this->lblPac->Text = $this->objDevice->Pac;
        return $this->lblPac;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtSerial
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtSerial_Create($strControlId = null) {
			$this->txtSerial = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtSerial->Name = t('Serial');
			$this->txtSerial->MaxLength = Device::SerialMaxLength;
			$this->txtSerial->PreferredRenderMethod = 'RenderWithName';
        $this->txtSerial->LinkedNode = QQN::Device()->Serial;
			$this->txtSerial->Text = $this->objDevice->Serial;
			return $this->txtSerial;
		}

    /**
     * Create and setup QCubed\Control\Label lblSerial
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblSerial_Create($strControlId = null) 
    {
        $this->lblSerial = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblSerial->Name = t('Serial');
        $this->lblSerial->PreferredRenderMethod = 'RenderWithName';
        $this->lblSerial->LinkedNode = QQN::Device()->Serial;
			$this->lblSerial->Text = $this->objDevice->Serial;
        return $this->lblSerial;
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
			$this->lstCompany->PreferredRenderMethod = 'RenderWithName';
        $this->lstCompany->LinkedNode = QQN::Device()->Company;
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
      $this->lstCompany->SelectedValue = $this->objDevice->CompanyId;
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
				if (($this->objDevice->Company) && ($this->objDevice->Company->Id == $objCompany->Id))
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
        $this->lblCompany->LinkedNode = QQN::Device()->Company;
			$this->lblCompany->Text = $this->objDevice->Company ? $this->objDevice->Company->__toString() : null;
        return $this->lblCompany;
    }






    /**
     * Refresh this ModelConnector with Data from the local Device object.
     * @param boolean $blnReload reload Device from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objDevice); // Notify in development version
        if (!($this->objDevice)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objDevice->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objDevice->Id : t('N\A');


			if ($this->txtPac) $this->txtPac->Text = $this->objDevice->Pac;
			if ($this->lblPac) $this->lblPac->Text = $this->objDevice->Pac;


			if ($this->txtSerial) $this->txtSerial->Text = $this->objDevice->Serial;
			if ($this->lblSerial) $this->lblSerial->Text = $this->objDevice->Serial;


      if ($this->lstCompany) {
        $this->lstCompany->removeAllItems();
        $this->lstCompany->addItem($this->strCompanyNullLabel, null);
        $this->lstCompany->addItems($this->lstCompany_GetItems());
        $this->lstCompany->SelectedValue = $this->objDevice->CompanyId;
      
      }
			if ($this->lblCompany) $this->lblCompany->Text = $this->objDevice->Company ? $this->objDevice->Company->__toString() : null;


    }

    /**
     * Load this ModelConnector with a Device object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|Device
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objDevice = Device::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objDevice = new Device();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objDevice) {
            $this->refresh ();
        }
        return $this->objDevice;
    }




        /**
    * This will update this object's Device instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateDevice()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->txtPac) $this->objDevice->Pac = $this->txtPac->Text;

				if ($this->txtSerial) $this->objDevice->Serial = $this->txtSerial->Text;

				if ($this->lstCompany) $this->objDevice->CompanyId = $this->lstCompany->SelectedValue;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's Device instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveDevice($blnForceUpdate = false)
    {
        try {
            $this->updateDevice();
            $id = $this->objDevice->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's Device instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteDevice()
    {
        $this->objDevice->delete();
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
            case 'Device': return $this->objDevice;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to Device fields -- will be created dynamically if not yet created
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'PacControl':
                if (!$this->txtPac) return $this->txtPac_Create();
                return $this->txtPac;
            case 'PacLabel':
                if (!$this->lblPac) return $this->lblPac_Create();
                return $this->lblPac;
            case 'SerialControl':
                if (!$this->txtSerial) return $this->txtSerial_Create();
                return $this->txtSerial;
            case 'SerialLabel':
                if (!$this->lblSerial) return $this->lblSerial_Create();
                return $this->lblSerial;
            case 'CompanyIdControl':
                if (!$this->lstCompany) return $this->lstCompany_Create();
                return $this->lstCompany;
            case 'CompanyIdLabel':
                if (!$this->lblCompany) return $this->lblCompany_Create();
                return $this->lblCompany;
            case 'CompanyNullLabel':
                return $this->strCompanyNullLabel;
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

                // Controls that point to Device fields
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'PacControl':
                    $this->txtPac = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'PacLabel':
                    $this->lblPac = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'SerialControl':
                    $this->txtSerial = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'SerialLabel':
                    $this->lblSerial = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
