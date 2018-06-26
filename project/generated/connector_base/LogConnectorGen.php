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
use QCubed\Control\IntegerTextBox;

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
 * @property QCubed\Project\Control\ListBox $UserIdControl
 * @property-read QCubed\\Control\\Label $UserIdLabel
 * @property QCubed\Project\Control\TextBox $ActionControl
 * @property-read QCubed\\Control\\Label $ActionLabel
 * @property QCubed\Project\Control\TextBox $ValueControl
 * @property-read QCubed\\Control\\Label $ValueLabel
 * @property QCubed\Control\DateTimePicker $DatetimeControl
 * @property-read QCubed\\Control\\Label $DatetimeLabel
 * @property QCubed\Control\IntegerTextBox $IpControl
 * @property-read QCubed\\Control\\Label $IpLabel
 * @property QCubed\Project\Control\TextBox $LogcolControl
 * @property-read QCubed\\Control\\Label $LogcolLabel
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
     * @var QCubed\Project\Control\ListBox
     * @access protected
     */
    protected $lstUser;

    /**
     * @var string 
     * @access protected
     */
    protected $strUserNullLabel;

    /**
    * @var QQCondition
    * @access protected
    */
    protected $objUserCondition;

    /**
    * @var QQClause[]
    * @access protected
    */
    protected $objUserClauses;
    /**
     * @var Label
     * @access protected
     */
    protected $lblUser;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtAction;

    /**
     * @var Label
     * @access protected
     */
    protected $lblAction;

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
     * @var QCubed\Control\IntegerTextBox

     * @access protected
     */
    protected $txtIp;

    /**
     * @var Label
     * @access protected
     */
    protected $lblIp;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtLogcol;

    /**
     * @var Label
     * @access protected
     */
    protected $lblLogcol;



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
		 * Create and setup QCubed\Project\Control\ListBox lstUser
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objCondition override the default condition of QQ::all() to the query, itself
		 * @param QQClause[] $objClauses additional QQClause object or array of QQClause objects for the query
		 * @return ListBox
		 */
		public function lstUser_Create($strControlId = null, QQCondition $objCondition = null, $objClauses = null) {
			$this->objUserCondition = $objCondition;
			$this->objUserClauses = $objClauses;
			$this->lstUser = new \QCubed\Project\Control\ListBox($this->objParentObject, $strControlId);
			$this->lstUser->Name = t('User');
			$this->lstUser->PreferredRenderMethod = 'RenderWithName';
        $this->lstUser->LinkedNode = QQN::Log()->User;
      if (!$this->strUserNullLabel) {
      	if (!$this->lstUser->Required) {
      		$this->strUserNullLabel = t('- None -');
      	}
      	elseif (!$this->blnEditMode) {
      		$this->strUserNullLabel = t('- Select One -');
      	}
      }
      $this->lstUser->addItem($this->strUserNullLabel, null);
      $this->lstUser->addItems($this->lstUser_GetItems());
      $this->lstUser->SelectedValue = $this->objLog->UserId;
			return $this->lstUser;
		}

		/**
		 *	Create item list for use by lstUser
		 */
		 public function lstUser_GetItems() {
			$a = array();
			$objCondition = $this->objUserCondition;
			if (is_null($objCondition)) $objCondition = QQ::all();
			$objUserCursor = User::queryCursor($objCondition, $this->objUserClauses);

			// Iterate through the Cursor
			while ($objUser = User::instantiateCursor($objUserCursor)) {
				$objListItem = new ListItem($objUser->__toString(), $objUser->Id);
				if (($this->objLog->User) && ($this->objLog->User->Id == $objUser->Id))
					$objListItem->Selected = true;
				$a[] = $objListItem;
			}
			return $a;
		 }

    /**
     * Create and setup QCubed\Control\Label lblUser
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblUser_Create($strControlId = null) 
    {
        $this->lblUser = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblUser->Name = t('User');
        $this->lblUser->PreferredRenderMethod = 'RenderWithName';
        $this->lblUser->LinkedNode = QQN::Log()->User;
			$this->lblUser->Text = $this->objLog->User ? $this->objLog->User->__toString() : null;
        return $this->lblUser;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtAction
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtAction_Create($strControlId = null) {
			$this->txtAction = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtAction->Name = t('Action');
			$this->txtAction->Required = true;
			$this->txtAction->MaxLength = Log::ActionMaxLength;
			$this->txtAction->PreferredRenderMethod = 'RenderWithName';
        $this->txtAction->LinkedNode = QQN::Log()->Action;
			$this->txtAction->Text = $this->objLog->Action;
			return $this->txtAction;
		}

    /**
     * Create and setup QCubed\Control\Label lblAction
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblAction_Create($strControlId = null) 
    {
        $this->lblAction = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblAction->Name = t('Action');
        $this->lblAction->PreferredRenderMethod = 'RenderWithName';
        $this->lblAction->LinkedNode = QQN::Log()->Action;
			$this->lblAction->Text = $this->objLog->Action;
        return $this->lblAction;
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
		 * Create and setup a QCubed\Control\IntegerTextBox txtIp
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Control\IntegerTextBox
		 */
		public function txtIp_Create($strControlId = null) {
			$this->txtIp = new \QCubed\Control\IntegerTextBox($this->objParentObject, $strControlId);
			$this->txtIp->Name = t('Ip');
			$this->txtIp->PreferredRenderMethod = 'RenderWithName';
        $this->txtIp->LinkedNode = QQN::Log()->Ip;
			$this->txtIp->Text = $this->objLog->Ip;
			return $this->txtIp;
		}

    /**
     * Create and setup QCubed\Control\Label lblIp
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblIp_Create($strControlId = null) 
    {
        $this->lblIp = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblIp->Name = t('Ip');
        $this->lblIp->PreferredRenderMethod = 'RenderWithName';
        $this->lblIp->LinkedNode = QQN::Log()->Ip;
			$this->lblIp->Text = $this->objLog->Ip;
        return $this->lblIp;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtLogcol
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtLogcol_Create($strControlId = null) {
			$this->txtLogcol = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtLogcol->Name = t('Logcol');
			$this->txtLogcol->MaxLength = Log::LogcolMaxLength;
			$this->txtLogcol->PreferredRenderMethod = 'RenderWithName';
        $this->txtLogcol->LinkedNode = QQN::Log()->Logcol;
			$this->txtLogcol->Text = $this->objLog->Logcol;
			return $this->txtLogcol;
		}

    /**
     * Create and setup QCubed\Control\Label lblLogcol
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblLogcol_Create($strControlId = null) 
    {
        $this->lblLogcol = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblLogcol->Name = t('Logcol');
        $this->lblLogcol->PreferredRenderMethod = 'RenderWithName';
        $this->lblLogcol->LinkedNode = QQN::Log()->Logcol;
			$this->lblLogcol->Text = $this->objLog->Logcol;
        return $this->lblLogcol;
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


      if ($this->lstUser) {
        $this->lstUser->removeAllItems();
        $this->lstUser->addItem($this->strUserNullLabel, null);
        $this->lstUser->addItems($this->lstUser_GetItems());
        $this->lstUser->SelectedValue = $this->objLog->UserId;
      
      }
			if ($this->lblUser) $this->lblUser->Text = $this->objLog->User ? $this->objLog->User->__toString() : null;


			if ($this->txtAction) $this->txtAction->Text = $this->objLog->Action;
			if ($this->lblAction) $this->lblAction->Text = $this->objLog->Action;


			if ($this->txtValue) $this->txtValue->Text = $this->objLog->Value;
			if ($this->lblValue) $this->lblValue->Text = $this->objLog->Value;


			if ($this->calDatetime) $this->calDatetime->DateTime = $this->objLog->Datetime;
			if ($this->lblDatetime) $this->lblDatetime->Text = $this->objLog->Datetime;


			if ($this->txtIp) $this->txtIp->Text = $this->objLog->Ip;
			if ($this->lblIp) $this->lblIp->Text = $this->objLog->Ip;


			if ($this->txtLogcol) $this->txtLogcol->Text = $this->objLog->Logcol;
			if ($this->lblLogcol) $this->lblLogcol->Text = $this->objLog->Logcol;


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

				if ($this->lstUser) $this->objLog->UserId = $this->lstUser->SelectedValue;

				if ($this->txtAction) $this->objLog->Action = $this->txtAction->Text;

				if ($this->txtValue) $this->objLog->Value = $this->txtValue->Text;

				if ($this->calDatetime) $this->objLog->Datetime = $this->calDatetime->DateTime;

				if ($this->txtIp) $this->objLog->Ip = $this->txtIp->Text;

				if ($this->txtLogcol) $this->objLog->Logcol = $this->txtLogcol->Text;


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
                if (!$this->lstUser) return $this->lstUser_Create();
                return $this->lstUser;
            case 'UserIdLabel':
                if (!$this->lblUser) return $this->lblUser_Create();
                return $this->lblUser;
            case 'UserNullLabel':
                return $this->strUserNullLabel;
            case 'ActionControl':
                if (!$this->txtAction) return $this->txtAction_Create();
                return $this->txtAction;
            case 'ActionLabel':
                if (!$this->lblAction) return $this->lblAction_Create();
                return $this->lblAction;
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
            case 'IpControl':
                if (!$this->txtIp) return $this->txtIp_Create();
                return $this->txtIp;
            case 'IpLabel':
                if (!$this->lblIp) return $this->lblIp_Create();
                return $this->lblIp;
            case 'LogcolControl':
                if (!$this->txtLogcol) return $this->txtLogcol_Create();
                return $this->txtLogcol;
            case 'LogcolLabel':
                if (!$this->lblLogcol) return $this->lblLogcol_Create();
                return $this->lblLogcol;
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
                    $this->lstUser = Type::Cast($mixValue, '\\QCubed\Project\Control\ListBox');
                    break;
                case 'UserIdLabel':
                    $this->lblUser = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'UserNullLabel':
                    $this->strUserNullLabel = $mixValue;
                    break;
                case 'ActionControl':
                    $this->txtAction = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'ActionLabel':
                    $this->lblAction = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
                case 'IpControl':
                    $this->txtIp = Type::Cast($mixValue, '\\QCubed\Control\IntegerTextBox');
                    break;
                case 'IpLabel':
                    $this->lblIp = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'LogcolControl':
                    $this->txtLogcol = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'LogcolLabel':
                    $this->lblLogcol = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
