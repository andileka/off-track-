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
use QCubed\Control\DateTimePicker;

/**
 * This is a ModelConnector class, providing a Form or Panel access to event handlers
 * and Controls to perform the Create, Edit, and Delete functionality
 * of the DeviceTourist class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single DeviceTourist object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a DeviceTouristConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read DeviceTourist $DeviceTourist the actual DeviceTourist data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Project\Control\ListBox $DeviceIdControl
 * @property-read QCubed\\Control\\Label $DeviceIdLabel
 * @property QCubed\Project\Control\ListBox $TouristIdControl
 * @property-read QCubed\\Control\\Label $TouristIdLabel
 * @property QCubed\Control\DateTimePicker $StartDateControl
 * @property-read QCubed\\Control\\Label $StartDateLabel
 * @property QCubed\Control\DateTimePicker $EndDateControl
 * @property-read QCubed\\Control\\Label $EndDateLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class DeviceTouristConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var DeviceTourist objDeviceTourist
     * @access protected
     */
    protected $objDeviceTourist;
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

    // Controls that correspond to DeviceTourist's individual data fields
    /**
     * @var Label
     * @access protected
     */
    protected $lblId;

    /**
     * @var QCubed\Project\Control\ListBox
     * @access protected
     */
    protected $lstDevice;

    /**
     * @var string 
     * @access protected
     */
    protected $strDeviceNullLabel;

    /**
    * @var QQCondition
    * @access protected
    */
    protected $objDeviceCondition;

    /**
    * @var QQClause[]
    * @access protected
    */
    protected $objDeviceClauses;
    /**
     * @var Label
     * @access protected
     */
    protected $lblDevice;

    /**
     * @var QCubed\Project\Control\ListBox
     * @access protected
     */
    protected $lstTourist;

    /**
     * @var string 
     * @access protected
     */
    protected $strTouristNullLabel;

    /**
    * @var QQCondition
    * @access protected
    */
    protected $objTouristCondition;

    /**
    * @var QQClause[]
    * @access protected
    */
    protected $objTouristClauses;
    /**
     * @var Label
     * @access protected
     */
    protected $lblTourist;

    /**
     * @var QCubed\Control\DateTimePicker

     * @access protected
     */
    protected $calStartDate;

    /**
     * @var Label
     * @access protected
     */
    protected $lblStartDate;

    /**
     * @var QCubed\Control\DateTimePicker

     * @access protected
     */
    protected $calEndDate;

    /**
     * @var Label
     * @access protected
     */
    protected $lblEndDate;



    /**
     * Main constructor.  Constructor OR static create methods are designed to be called in either
     * a parent Panel or the main Form when wanting to create a
     * DeviceTouristConnector to edit a single DeviceTourist object within the
     * Panel or Form.
     *
     * This constructor takes in a single DeviceTourist object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this DeviceTouristConnector
     * @param DeviceTourist $objDeviceTourist new or existing DeviceTourist object
     */
     public function __construct($objParentObject, DeviceTourist $objDeviceTourist)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this DeviceTouristConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked DeviceTourist object
        $this->objDeviceTourist = $objDeviceTourist;

        // Figure out if we're Editing or Creating New
        if ($this->objDeviceTourist->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this DeviceTouristConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing DeviceTourist object creation - defaults to CreateOrEdit
     * @return DeviceTouristConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objDeviceTourist = DeviceTourist::load($intId);

            // DeviceTourist was found -- return it!
            if ($objDeviceTourist)
                return new DeviceTouristConnector($objParentObject, $objDeviceTourist);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a DeviceTourist object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new DeviceTouristConnector($objParentObject, new DeviceTourist());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this DeviceTouristConnector
     * @param integer $intCreateType rules governing DeviceTourist object creation - defaults to CreateOrEdit
     * @return DeviceTouristConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return DeviceTouristConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this DeviceTouristConnector
     * @param integer $intCreateType rules governing DeviceTourist object creation - defaults to CreateOrEdit
     * @return DeviceTouristConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return DeviceTouristConnector::create($objParentObject, $intId, $intCreateType);
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
        $this->lblId->LinkedNode = QQN::DeviceTourist()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objDeviceTourist->Id : t('N\A');
        return $this->lblId;
    }



		/**
		 * Create and setup QCubed\Project\Control\ListBox lstDevice
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objCondition override the default condition of QQ::all() to the query, itself
		 * @param QQClause[] $objClauses additional QQClause object or array of QQClause objects for the query
		 * @return ListBox
		 */
		public function lstDevice_Create($strControlId = null, QQCondition $objCondition = null, $objClauses = null) {
			$this->objDeviceCondition = $objCondition;
			$this->objDeviceClauses = $objClauses;
			$this->lstDevice = new \QCubed\Project\Control\ListBox($this->objParentObject, $strControlId);
			$this->lstDevice->Name = t('Device');
			$this->lstDevice->PreferredRenderMethod = 'RenderWithName';
        $this->lstDevice->LinkedNode = QQN::DeviceTourist()->Device;
      if (!$this->strDeviceNullLabel) {
      	if (!$this->lstDevice->Required) {
      		$this->strDeviceNullLabel = t('- None -');
      	}
      	elseif (!$this->blnEditMode) {
      		$this->strDeviceNullLabel = t('- Select One -');
      	}
      }
      $this->lstDevice->addItem($this->strDeviceNullLabel, null);
      $this->lstDevice->addItems($this->lstDevice_GetItems());
      $this->lstDevice->SelectedValue = $this->objDeviceTourist->DeviceId;
			return $this->lstDevice;
		}

		/**
		 *	Create item list for use by lstDevice
		 */
		 public function lstDevice_GetItems() {
			$a = array();
			$objCondition = $this->objDeviceCondition;
			if (is_null($objCondition)) $objCondition = QQ::all();
			$objDeviceCursor = Device::queryCursor($objCondition, $this->objDeviceClauses);

			// Iterate through the Cursor
			while ($objDevice = Device::instantiateCursor($objDeviceCursor)) {
				$objListItem = new ListItem($objDevice->__toString(), $objDevice->Id);
				if (($this->objDeviceTourist->Device) && ($this->objDeviceTourist->Device->Id == $objDevice->Id))
					$objListItem->Selected = true;
				$a[] = $objListItem;
			}
			return $a;
		 }

    /**
     * Create and setup QCubed\Control\Label lblDevice
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblDevice_Create($strControlId = null) 
    {
        $this->lblDevice = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblDevice->Name = t('Device');
        $this->lblDevice->PreferredRenderMethod = 'RenderWithName';
        $this->lblDevice->LinkedNode = QQN::DeviceTourist()->Device;
			$this->lblDevice->Text = $this->objDeviceTourist->Device ? $this->objDeviceTourist->Device->__toString() : null;
        return $this->lblDevice;
    }



		/**
		 * Create and setup QCubed\Project\Control\ListBox lstTourist
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objCondition override the default condition of QQ::all() to the query, itself
		 * @param QQClause[] $objClauses additional QQClause object or array of QQClause objects for the query
		 * @return ListBox
		 */
		public function lstTourist_Create($strControlId = null, QQCondition $objCondition = null, $objClauses = null) {
			$this->objTouristCondition = $objCondition;
			$this->objTouristClauses = $objClauses;
			$this->lstTourist = new \QCubed\Project\Control\ListBox($this->objParentObject, $strControlId);
			$this->lstTourist->Name = t('Tourist');
			$this->lstTourist->PreferredRenderMethod = 'RenderWithName';
        $this->lstTourist->LinkedNode = QQN::DeviceTourist()->Tourist;
      if (!$this->strTouristNullLabel) {
      	if (!$this->lstTourist->Required) {
      		$this->strTouristNullLabel = t('- None -');
      	}
      	elseif (!$this->blnEditMode) {
      		$this->strTouristNullLabel = t('- Select One -');
      	}
      }
      $this->lstTourist->addItem($this->strTouristNullLabel, null);
      $this->lstTourist->addItems($this->lstTourist_GetItems());
      $this->lstTourist->SelectedValue = $this->objDeviceTourist->TouristId;
			return $this->lstTourist;
		}

		/**
		 *	Create item list for use by lstTourist
		 */
		 public function lstTourist_GetItems() {
			$a = array();
			$objCondition = $this->objTouristCondition;
			if (is_null($objCondition)) $objCondition = QQ::all();
			$objTouristCursor = Tourist::queryCursor($objCondition, $this->objTouristClauses);

			// Iterate through the Cursor
			while ($objTourist = Tourist::instantiateCursor($objTouristCursor)) {
				$objListItem = new ListItem($objTourist->__toString(), $objTourist->Id);
				if (($this->objDeviceTourist->Tourist) && ($this->objDeviceTourist->Tourist->Id == $objTourist->Id))
					$objListItem->Selected = true;
				$a[] = $objListItem;
			}
			return $a;
		 }

    /**
     * Create and setup QCubed\Control\Label lblTourist
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblTourist_Create($strControlId = null) 
    {
        $this->lblTourist = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblTourist->Name = t('Tourist');
        $this->lblTourist->PreferredRenderMethod = 'RenderWithName';
        $this->lblTourist->LinkedNode = QQN::DeviceTourist()->Tourist;
			$this->lblTourist->Text = $this->objDeviceTourist->Tourist ? $this->objDeviceTourist->Tourist->__toString() : null;
        return $this->lblTourist;
    }



		/**
		 * Create and setup a QCubed\Control\DateTimePicker calStartDate
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Control\DateTimePicker
		 */
		public function calStartDate_Create($strControlId = null) {
			$this->calStartDate = new \QCubed\Control\DateTimePicker($this->objParentObject, $strControlId);
			$this->calStartDate->Name = t('Start Date');
			$this->calStartDate->DateTime = $this->objDeviceTourist->StartDate;
			$this->calStartDate->DateTimePickerType = DateTimePicker::SHOW_DATE_TIME;
			$this->calStartDate->PreferredRenderMethod = 'RenderWithName';
        $this->calStartDate->LinkedNode = QQN::DeviceTourist()->StartDate;
			return $this->calStartDate;
		}

    /**
     * Create and setup QCubed\Control\Label lblStartDate
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblStartDate_Create($strControlId = null) 
    {
        $this->lblStartDate = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblStartDate->Name = t('Start Date');
        $this->lblStartDate->PreferredRenderMethod = 'RenderWithName';
        $this->lblStartDate->LinkedNode = QQN::DeviceTourist()->StartDate;
			$this->lblStartDate->Text = $this->objDeviceTourist->StartDate;
        return $this->lblStartDate;
    }



		/**
		 * Create and setup a QCubed\Control\DateTimePicker calEndDate
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Control\DateTimePicker
		 */
		public function calEndDate_Create($strControlId = null) {
			$this->calEndDate = new \QCubed\Control\DateTimePicker($this->objParentObject, $strControlId);
			$this->calEndDate->Name = t('End Date');
			$this->calEndDate->DateTime = $this->objDeviceTourist->EndDate;
			$this->calEndDate->DateTimePickerType = DateTimePicker::SHOW_DATE_TIME;
			$this->calEndDate->PreferredRenderMethod = 'RenderWithName';
        $this->calEndDate->LinkedNode = QQN::DeviceTourist()->EndDate;
			return $this->calEndDate;
		}

    /**
     * Create and setup QCubed\Control\Label lblEndDate
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblEndDate_Create($strControlId = null) 
    {
        $this->lblEndDate = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblEndDate->Name = t('End Date');
        $this->lblEndDate->PreferredRenderMethod = 'RenderWithName';
        $this->lblEndDate->LinkedNode = QQN::DeviceTourist()->EndDate;
			$this->lblEndDate->Text = $this->objDeviceTourist->EndDate;
        return $this->lblEndDate;
    }






    /**
     * Refresh this ModelConnector with Data from the local DeviceTourist object.
     * @param boolean $blnReload reload DeviceTourist from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objDeviceTourist); // Notify in development version
        if (!($this->objDeviceTourist)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objDeviceTourist->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objDeviceTourist->Id : t('N\A');


      if ($this->lstDevice) {
        $this->lstDevice->removeAllItems();
        $this->lstDevice->addItem($this->strDeviceNullLabel, null);
        $this->lstDevice->addItems($this->lstDevice_GetItems());
        $this->lstDevice->SelectedValue = $this->objDeviceTourist->DeviceId;
      
      }
			if ($this->lblDevice) $this->lblDevice->Text = $this->objDeviceTourist->Device ? $this->objDeviceTourist->Device->__toString() : null;


      if ($this->lstTourist) {
        $this->lstTourist->removeAllItems();
        $this->lstTourist->addItem($this->strTouristNullLabel, null);
        $this->lstTourist->addItems($this->lstTourist_GetItems());
        $this->lstTourist->SelectedValue = $this->objDeviceTourist->TouristId;
      
      }
			if ($this->lblTourist) $this->lblTourist->Text = $this->objDeviceTourist->Tourist ? $this->objDeviceTourist->Tourist->__toString() : null;


			if ($this->calStartDate) $this->calStartDate->DateTime = $this->objDeviceTourist->StartDate;
			if ($this->lblStartDate) $this->lblStartDate->Text = $this->objDeviceTourist->StartDate;


			if ($this->calEndDate) $this->calEndDate->DateTime = $this->objDeviceTourist->EndDate;
			if ($this->lblEndDate) $this->lblEndDate->Text = $this->objDeviceTourist->EndDate;


    }

    /**
     * Load this ModelConnector with a DeviceTourist object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|DeviceTourist
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objDeviceTourist = DeviceTourist::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objDeviceTourist = new DeviceTourist();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objDeviceTourist) {
            $this->refresh ();
        }
        return $this->objDeviceTourist;
    }




        /**
    * This will update this object's DeviceTourist instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateDeviceTourist()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->lstDevice) $this->objDeviceTourist->DeviceId = $this->lstDevice->SelectedValue;

				if ($this->lstTourist) $this->objDeviceTourist->TouristId = $this->lstTourist->SelectedValue;

				if ($this->calStartDate) $this->objDeviceTourist->StartDate = $this->calStartDate->DateTime;

				if ($this->calEndDate) $this->objDeviceTourist->EndDate = $this->calEndDate->DateTime;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's DeviceTourist instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveDeviceTourist($blnForceUpdate = false)
    {
        try {
            $this->updateDeviceTourist();
            $id = $this->objDeviceTourist->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's DeviceTourist instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteDeviceTourist()
    {
        $this->objDeviceTourist->delete();
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
            case 'DeviceTourist': return $this->objDeviceTourist;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to DeviceTourist fields -- will be created dynamically if not yet created
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'DeviceIdControl':
                if (!$this->lstDevice) return $this->lstDevice_Create();
                return $this->lstDevice;
            case 'DeviceIdLabel':
                if (!$this->lblDevice) return $this->lblDevice_Create();
                return $this->lblDevice;
            case 'DeviceNullLabel':
                return $this->strDeviceNullLabel;
            case 'TouristIdControl':
                if (!$this->lstTourist) return $this->lstTourist_Create();
                return $this->lstTourist;
            case 'TouristIdLabel':
                if (!$this->lblTourist) return $this->lblTourist_Create();
                return $this->lblTourist;
            case 'TouristNullLabel':
                return $this->strTouristNullLabel;
            case 'StartDateControl':
                if (!$this->calStartDate) return $this->calStartDate_Create();
                return $this->calStartDate;
            case 'StartDateLabel':
                if (!$this->lblStartDate) return $this->lblStartDate_Create();
                return $this->lblStartDate;
            case 'EndDateControl':
                if (!$this->calEndDate) return $this->calEndDate_Create();
                return $this->calEndDate;
            case 'EndDateLabel':
                if (!$this->lblEndDate) return $this->lblEndDate_Create();
                return $this->lblEndDate;
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

                // Controls that point to DeviceTourist fields
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'DeviceIdControl':
                    $this->lstDevice = Type::Cast($mixValue, '\\QCubed\Project\Control\ListBox');
                    break;
                case 'DeviceIdLabel':
                    $this->lblDevice = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'DeviceNullLabel':
                    $this->strDeviceNullLabel = $mixValue;
                    break;
                case 'TouristIdControl':
                    $this->lstTourist = Type::Cast($mixValue, '\\QCubed\Project\Control\ListBox');
                    break;
                case 'TouristIdLabel':
                    $this->lblTourist = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'TouristNullLabel':
                    $this->strTouristNullLabel = $mixValue;
                    break;
                case 'StartDateControl':
                    $this->calStartDate = Type::Cast($mixValue, '\\QCubed\Control\DateTimePicker');
                    break;
                case 'StartDateLabel':
                    $this->lblStartDate = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'EndDateControl':
                    $this->calEndDate = Type::Cast($mixValue, '\\QCubed\Control\DateTimePicker');
                    break;
                case 'EndDateLabel':
                    $this->lblEndDate = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
