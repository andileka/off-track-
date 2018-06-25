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
use QCubed\Control\DateTimePicker;

/**
 * This is a ModelConnector class, providing a Form or Panel access to event handlers
 * and Controls to perform the Create, Edit, and Delete functionality
 * of the Event class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single Event object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a EventConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read Event $Event the actual Event data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Project\Control\ListBox $DeviceIdControl
 * @property-read QCubed\\Control\\Label $DeviceIdLabel
 * @property QCubed\Project\Control\TextBox $TypeControl
 * @property-read QCubed\\Control\\Label $TypeLabel
 * @property QCubed\Control\DateTimePicker $DatetimeControl
 * @property-read QCubed\\Control\\Label $DatetimeLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class EventConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var Event objEvent
     * @access protected
     */
    protected $objEvent;
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

    // Controls that correspond to Event's individual data fields
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
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtType;

    /**
     * @var Label
     * @access protected
     */
    protected $lblType;

    /**
     * @var QCubed\Control\DateTimePicker

     * @access protected
     */
    protected $calDatetime;

    /**
     * @var Label
     * @access protected
     */
    protected $lblDatetime;



    /**
     * Main constructor.  Constructor OR static create methods are designed to be called in either
     * a parent Panel or the main Form when wanting to create a
     * EventConnector to edit a single Event object within the
     * Panel or Form.
     *
     * This constructor takes in a single Event object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this EventConnector
     * @param Event $objEvent new or existing Event object
     */
     public function __construct($objParentObject, Event $objEvent)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this EventConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked Event object
        $this->objEvent = $objEvent;

        // Figure out if we're Editing or Creating New
        if ($this->objEvent->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this EventConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing Event object creation - defaults to CreateOrEdit
     * @return EventConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objEvent = Event::load($intId);

            // Event was found -- return it!
            if ($objEvent)
                return new EventConnector($objParentObject, $objEvent);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a Event object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new EventConnector($objParentObject, new Event());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this EventConnector
     * @param integer $intCreateType rules governing Event object creation - defaults to CreateOrEdit
     * @return EventConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return EventConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this EventConnector
     * @param integer $intCreateType rules governing Event object creation - defaults to CreateOrEdit
     * @return EventConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return EventConnector::create($objParentObject, $intId, $intCreateType);
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
        $this->lblId->LinkedNode = QQN::Event()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objEvent->Id : t('N\A');
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
        $this->lstDevice->LinkedNode = QQN::Event()->Device;
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
      $this->lstDevice->SelectedValue = $this->objEvent->DeviceId;
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
				if (($this->objEvent->Device) && ($this->objEvent->Device->Id == $objDevice->Id))
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
        $this->lblDevice->LinkedNode = QQN::Event()->Device;
			$this->lblDevice->Text = $this->objEvent->Device ? $this->objEvent->Device->__toString() : null;
        return $this->lblDevice;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtType
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtType_Create($strControlId = null) {
			$this->txtType = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtType->Name = t('Type');
			$this->txtType->PreferredRenderMethod = 'RenderWithName';
        $this->txtType->LinkedNode = QQN::Event()->Type;
			$this->txtType->Text = $this->objEvent->Type;
			return $this->txtType;
		}

    /**
     * Create and setup QCubed\Control\Label lblType
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblType_Create($strControlId = null) 
    {
        $this->lblType = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblType->Name = t('Type');
        $this->lblType->PreferredRenderMethod = 'RenderWithName';
        $this->lblType->LinkedNode = QQN::Event()->Type;
			$this->lblType->Text = $this->objEvent->Type;
        return $this->lblType;
    }



		/**
		 * Create and setup a QCubed\Control\DateTimePicker calDatetime
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Control\DateTimePicker
		 */
		public function calDatetime_Create($strControlId = null) {
			$this->calDatetime = new \QCubed\Control\DateTimePicker($this->objParentObject, $strControlId);
			$this->calDatetime->Name = t('Datetime');
			$this->calDatetime->DateTime = $this->objEvent->Datetime;
			$this->calDatetime->DateTimePickerType = DateTimePicker::SHOW_DATE_TIME;
			$this->calDatetime->PreferredRenderMethod = 'RenderWithName';
        $this->calDatetime->LinkedNode = QQN::Event()->Datetime;
			return $this->calDatetime;
		}

    /**
     * Create and setup QCubed\Control\Label lblDatetime
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblDatetime_Create($strControlId = null) 
    {
        $this->lblDatetime = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblDatetime->Name = t('Datetime');
        $this->lblDatetime->PreferredRenderMethod = 'RenderWithName';
        $this->lblDatetime->LinkedNode = QQN::Event()->Datetime;
			$this->lblDatetime->Text = $this->objEvent->Datetime;
        return $this->lblDatetime;
    }






    /**
     * Refresh this ModelConnector with Data from the local Event object.
     * @param boolean $blnReload reload Event from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objEvent); // Notify in development version
        if (!($this->objEvent)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objEvent->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objEvent->Id : t('N\A');


      if ($this->lstDevice) {
        $this->lstDevice->removeAllItems();
        $this->lstDevice->addItem($this->strDeviceNullLabel, null);
        $this->lstDevice->addItems($this->lstDevice_GetItems());
        $this->lstDevice->SelectedValue = $this->objEvent->DeviceId;
      
      }
			if ($this->lblDevice) $this->lblDevice->Text = $this->objEvent->Device ? $this->objEvent->Device->__toString() : null;


			if ($this->txtType) $this->txtType->Text = $this->objEvent->Type;
			if ($this->lblType) $this->lblType->Text = $this->objEvent->Type;


			if ($this->calDatetime) $this->calDatetime->DateTime = $this->objEvent->Datetime;
			if ($this->lblDatetime) $this->lblDatetime->Text = $this->objEvent->Datetime;


    }

    /**
     * Load this ModelConnector with a Event object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|Event
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objEvent = Event::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objEvent = new Event();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objEvent) {
            $this->refresh ();
        }
        return $this->objEvent;
    }




        /**
    * This will update this object's Event instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateEvent()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->lstDevice) $this->objEvent->DeviceId = $this->lstDevice->SelectedValue;

				if ($this->txtType) $this->objEvent->Type = $this->txtType->Text;

				if ($this->calDatetime) $this->objEvent->Datetime = $this->calDatetime->DateTime;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's Event instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveEvent($blnForceUpdate = false)
    {
        try {
            $this->updateEvent();
            $id = $this->objEvent->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's Event instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteEvent()
    {
        $this->objEvent->delete();
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
            case 'Event': return $this->objEvent;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to Event fields -- will be created dynamically if not yet created
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
            case 'TypeControl':
                if (!$this->txtType) return $this->txtType_Create();
                return $this->txtType;
            case 'TypeLabel':
                if (!$this->lblType) return $this->lblType_Create();
                return $this->lblType;
            case 'DatetimeControl':
                if (!$this->calDatetime) return $this->calDatetime_Create();
                return $this->calDatetime;
            case 'DatetimeLabel':
                if (!$this->lblDatetime) return $this->lblDatetime_Create();
                return $this->lblDatetime;
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

                // Controls that point to Event fields
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
                case 'TypeControl':
                    $this->txtType = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'TypeLabel':
                    $this->lblType = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'DatetimeControl':
                    $this->calDatetime = Type::Cast($mixValue, '\\QCubed\Control\DateTimePicker');
                    break;
                case 'DatetimeLabel':
                    $this->lblDatetime = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
