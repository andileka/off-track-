<?php

use QCubed as Q;
use QCubed\Exception\Caller as Caller;
use QCubed\Project\Control\FormBase;
use QCubed\Project\Control\ControlBase;
use QCubed\Query\QQ;
use QCubed\Control\Label;
use QCubed\Control\IntegerTextBox;
use QCubed\Project\Control\TextBox;
use QCubed\Control\DateTimePicker;

/**
 * This is a ModelConnector class, providing a Form or Panel access to event handlers
 * and Controls to perform the Create, Edit, and Delete functionality
 * of the Log class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single Log object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a LogConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read Log $Log the actual Log data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Control\IntegerTextBox $UserIdControl
 * @property-read QCubed\\Control\\Label $UserIdLabel
 * @property QCubed\Project\Control\TextBox $TypeControl
 * @property-read QCubed\\Control\\Label $TypeLabel
 * @property QCubed\Project\Control\TextBox $ValueControl
 * @property-read QCubed\\Control\\Label $ValueLabel
 * @property QCubed\Control\DateTimePicker $DatetimeControl
 * @property-read QCubed\\Control\\Label $DatetimeLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class LogConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var Log objLog
     * @access protected
     */
    protected $objLog;
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

    // Controls that correspond to Log's individual data fields
    /**
     * @var Label
     * @access protected
     */
    protected $lblId;

    /**
     * @var QCubed\Control\IntegerTextBox

     * @access protected
     */
    protected $txtUserId;

    /**
     * @var Label
     * @access protected
     */
    protected $lblUserId;

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
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtValue;

    /**
     * @var Label
     * @access protected
     */
    protected $lblValue;

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
     * LogConnector to edit a single Log object within the
     * Panel or Form.
     *
     * This constructor takes in a single Log object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this LogConnector
     * @param Log $objLog new or existing Log object
     */
     public function __construct($objParentObject, Log $objLog)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this LogConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked Log object
        $this->objLog = $objLog;

        // Figure out if we're Editing or Creating New
        if ($this->objLog->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this LogConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing Log object creation - defaults to CreateOrEdit
     * @return LogConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objLog = Log::load($intId);

            // Log was found -- return it!
            if ($objLog)
                return new LogConnector($objParentObject, $objLog);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a Log object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new LogConnector($objParentObject, new Log());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this LogConnector
     * @param integer $intCreateType rules governing Log object creation - defaults to CreateOrEdit
     * @return LogConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return LogConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this LogConnector
     * @param integer $intCreateType rules governing Log object creation - defaults to CreateOrEdit
     * @return LogConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return LogConnector::create($objParentObject, $intId, $intCreateType);
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
        $this->lblId->LinkedNode = QQN::Log()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objLog->Id : t('N\A');
        return $this->lblId;
    }



		/**
		 * Create and setup a QCubed\Control\IntegerTextBox txtUserId
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Control\IntegerTextBox
		 */
		public function txtUserId_Create($strControlId = null) {
			$this->txtUserId = new \QCubed\Control\IntegerTextBox($this->objParentObject, $strControlId);
			$this->txtUserId->Name = t('User Id');
			$this->txtUserId->PreferredRenderMethod = 'RenderWithName';
        $this->txtUserId->LinkedNode = QQN::Log()->UserId;
			$this->txtUserId->Text = $this->objLog->UserId;
			return $this->txtUserId;
		}

    /**
     * Create and setup QCubed\Control\Label lblUserId
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblUserId_Create($strControlId = null) 
    {
        $this->lblUserId = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblUserId->Name = t('User Id');
        $this->lblUserId->PreferredRenderMethod = 'RenderWithName';
        $this->lblUserId->LinkedNode = QQN::Log()->UserId;
			$this->lblUserId->Text = $this->objLog->UserId;
        return $this->lblUserId;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtType
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtType_Create($strControlId = null) {
			$this->txtType = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtType->Name = t('Type');
			$this->txtType->MaxLength = Log::TypeMaxLength;
			$this->txtType->PreferredRenderMethod = 'RenderWithName';
        $this->txtType->LinkedNode = QQN::Log()->Type;
			$this->txtType->Text = $this->objLog->Type;
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
        $this->lblType->LinkedNode = QQN::Log()->Type;
			$this->lblType->Text = $this->objLog->Type;
        return $this->lblType;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtValue
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtValue_Create($strControlId = null) {
			$this->txtValue = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtValue->Name = t('Value');
			$this->txtValue->MaxLength = Log::ValueMaxLength;
			$this->txtValue->PreferredRenderMethod = 'RenderWithName';
        $this->txtValue->LinkedNode = QQN::Log()->Value;
			$this->txtValue->Text = $this->objLog->Value;
			return $this->txtValue;
		}

    /**
     * Create and setup QCubed\Control\Label lblValue
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblValue_Create($strControlId = null) 
    {
        $this->lblValue = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblValue->Name = t('Value');
        $this->lblValue->PreferredRenderMethod = 'RenderWithName';
        $this->lblValue->LinkedNode = QQN::Log()->Value;
			$this->lblValue->Text = $this->objLog->Value;
        return $this->lblValue;
    }



		/**
		 * Create and setup a QCubed\Control\DateTimePicker calDatetime
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Control\DateTimePicker
		 */
		public function calDatetime_Create($strControlId = null) {
			$this->calDatetime = new \QCubed\Control\DateTimePicker($this->objParentObject, $strControlId);
			$this->calDatetime->Name = t('Datetime');
			$this->calDatetime->DateTime = $this->objLog->Datetime;
			$this->calDatetime->DateTimePickerType = DateTimePicker::SHOW_DATE_TIME;
			$this->calDatetime->PreferredRenderMethod = 'RenderWithName';
        $this->calDatetime->LinkedNode = QQN::Log()->Datetime;
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
        $this->lblDatetime->LinkedNode = QQN::Log()->Datetime;
			$this->lblDatetime->Text = $this->objLog->Datetime;
        return $this->lblDatetime;
    }






    /**
     * Refresh this ModelConnector with Data from the local Log object.
     * @param boolean $blnReload reload Log from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objLog); // Notify in development version
        if (!($this->objLog)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objLog->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objLog->Id : t('N\A');


			if ($this->txtUserId) $this->txtUserId->Text = $this->objLog->UserId;
			if ($this->lblUserId) $this->lblUserId->Text = $this->objLog->UserId;


			if ($this->txtType) $this->txtType->Text = $this->objLog->Type;
			if ($this->lblType) $this->lblType->Text = $this->objLog->Type;


			if ($this->txtValue) $this->txtValue->Text = $this->objLog->Value;
			if ($this->lblValue) $this->lblValue->Text = $this->objLog->Value;


			if ($this->calDatetime) $this->calDatetime->DateTime = $this->objLog->Datetime;
			if ($this->lblDatetime) $this->lblDatetime->Text = $this->objLog->Datetime;


    }

    /**
     * Load this ModelConnector with a Log object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|Log
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objLog = Log::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objLog = new Log();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objLog) {
            $this->refresh ();
        }
        return $this->objLog;
    }




        /**
    * This will update this object's Log instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateLog()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->txtUserId) $this->objLog->UserId = $this->txtUserId->Text;

				if ($this->txtType) $this->objLog->Type = $this->txtType->Text;

				if ($this->txtValue) $this->objLog->Value = $this->txtValue->Text;

				if ($this->calDatetime) $this->objLog->Datetime = $this->calDatetime->DateTime;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's Log instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveLog($blnForceUpdate = false)
    {
        try {
            $this->updateLog();
            $id = $this->objLog->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's Log instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteLog()
    {
        $this->objLog->delete();
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
            case 'Log': return $this->objLog;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to Log fields -- will be created dynamically if not yet created
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'UserIdControl':
                if (!$this->txtUserId) return $this->txtUserId_Create();
                return $this->txtUserId;
            case 'UserIdLabel':
                if (!$this->lblUserId) return $this->lblUserId_Create();
                return $this->lblUserId;
            case 'TypeControl':
                if (!$this->txtType) return $this->txtType_Create();
                return $this->txtType;
            case 'TypeLabel':
                if (!$this->lblType) return $this->lblType_Create();
                return $this->lblType;
            case 'ValueControl':
                if (!$this->txtValue) return $this->txtValue_Create();
                return $this->txtValue;
            case 'ValueLabel':
                if (!$this->lblValue) return $this->lblValue_Create();
                return $this->lblValue;
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

                // Controls that point to Log fields
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'UserIdControl':
                    $this->txtUserId = Type::Cast($mixValue, '\\QCubed\Control\IntegerTextBox');
                    break;
                case 'UserIdLabel':
                    $this->lblUserId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'TypeControl':
                    $this->txtType = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'TypeLabel':
                    $this->lblType = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'ValueControl':
                    $this->txtValue = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'ValueLabel':
                    $this->lblValue = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
