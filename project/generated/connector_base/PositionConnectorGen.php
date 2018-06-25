<?php

use QCubed as Q;
use QCubed\Exception\Caller as Caller;
use QCubed\Project\Control\FormBase;
use QCubed\Project\Control\ControlBase;
use QCubed\Query\QQ;
use QCubed\Control\Label;
use QCubed\Project\Control\TextBox;
use QCubed\Control\IntegerTextBox;

/**
 * This is a ModelConnector class, providing a Form or Panel access to event handlers
 * and Controls to perform the Create, Edit, and Delete functionality
 * of the Position class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single Position object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a PositionConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read Position $Position the actual Position data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Project\Control\TextBox $LatControl
 * @property-read QCubed\\Control\\Label $LatLabel
 * @property QCubed\Project\Control\TextBox $LongControl
 * @property-read QCubed\\Control\\Label $LongLabel
 * @property QCubed\Control\IntegerTextBox $HeightControl
 * @property-read QCubed\\Control\\Label $HeightLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class PositionConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var Position objPosition
     * @access protected
     */
    protected $objPosition;
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

    // Controls that correspond to Position's individual data fields
    /**
     * @var Label
     * @access protected
     */
    protected $lblId;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtLat;

    /**
     * @var Label
     * @access protected
     */
    protected $lblLat;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtLong;

    /**
     * @var Label
     * @access protected
     */
    protected $lblLong;

    /**
     * @var QCubed\Control\IntegerTextBox

     * @access protected
     */
    protected $txtHeight;

    /**
     * @var Label
     * @access protected
     */
    protected $lblHeight;



    /**
     * Main constructor.  Constructor OR static create methods are designed to be called in either
     * a parent Panel or the main Form when wanting to create a
     * PositionConnector to edit a single Position object within the
     * Panel or Form.
     *
     * This constructor takes in a single Position object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this PositionConnector
     * @param Position $objPosition new or existing Position object
     */
     public function __construct($objParentObject, Position $objPosition)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this PositionConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked Position object
        $this->objPosition = $objPosition;

        // Figure out if we're Editing or Creating New
        if ($this->objPosition->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this PositionConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing Position object creation - defaults to CreateOrEdit
     * @return PositionConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objPosition = Position::load($intId);

            // Position was found -- return it!
            if ($objPosition)
                return new PositionConnector($objParentObject, $objPosition);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a Position object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new PositionConnector($objParentObject, new Position());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this PositionConnector
     * @param integer $intCreateType rules governing Position object creation - defaults to CreateOrEdit
     * @return PositionConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return PositionConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this PositionConnector
     * @param integer $intCreateType rules governing Position object creation - defaults to CreateOrEdit
     * @return PositionConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return PositionConnector::create($objParentObject, $intId, $intCreateType);
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
        $this->lblId->LinkedNode = QQN::Position()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objPosition->Id : t('N\A');
        return $this->lblId;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtLat
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtLat_Create($strControlId = null) {
			$this->txtLat = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtLat->Name = t('Lat');
			$this->txtLat->MaxLength = Position::LatMaxLength;
			$this->txtLat->PreferredRenderMethod = 'RenderWithName';
        $this->txtLat->LinkedNode = QQN::Position()->Lat;
			$this->txtLat->Text = $this->objPosition->Lat;
			return $this->txtLat;
		}

    /**
     * Create and setup QCubed\Control\Label lblLat
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblLat_Create($strControlId = null) 
    {
        $this->lblLat = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblLat->Name = t('Lat');
        $this->lblLat->PreferredRenderMethod = 'RenderWithName';
        $this->lblLat->LinkedNode = QQN::Position()->Lat;
			$this->lblLat->Text = $this->objPosition->Lat;
        return $this->lblLat;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtLong
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtLong_Create($strControlId = null) {
			$this->txtLong = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtLong->Name = t('Long');
			$this->txtLong->MaxLength = Position::LongMaxLength;
			$this->txtLong->PreferredRenderMethod = 'RenderWithName';
        $this->txtLong->LinkedNode = QQN::Position()->Long;
			$this->txtLong->Text = $this->objPosition->Long;
			return $this->txtLong;
		}

    /**
     * Create and setup QCubed\Control\Label lblLong
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblLong_Create($strControlId = null) 
    {
        $this->lblLong = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblLong->Name = t('Long');
        $this->lblLong->PreferredRenderMethod = 'RenderWithName';
        $this->lblLong->LinkedNode = QQN::Position()->Long;
			$this->lblLong->Text = $this->objPosition->Long;
        return $this->lblLong;
    }



		/**
		 * Create and setup a QCubed\Control\IntegerTextBox txtHeight
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Control\IntegerTextBox
		 */
		public function txtHeight_Create($strControlId = null) {
			$this->txtHeight = new \QCubed\Control\IntegerTextBox($this->objParentObject, $strControlId);
			$this->txtHeight->Name = t('Height');
			$this->txtHeight->PreferredRenderMethod = 'RenderWithName';
        $this->txtHeight->LinkedNode = QQN::Position()->Height;
			$this->txtHeight->Text = $this->objPosition->Height;
			return $this->txtHeight;
		}

    /**
     * Create and setup QCubed\Control\Label lblHeight
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblHeight_Create($strControlId = null) 
    {
        $this->lblHeight = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblHeight->Name = t('Height');
        $this->lblHeight->PreferredRenderMethod = 'RenderWithName';
        $this->lblHeight->LinkedNode = QQN::Position()->Height;
			$this->lblHeight->Text = $this->objPosition->Height;
        return $this->lblHeight;
    }






    /**
     * Refresh this ModelConnector with Data from the local Position object.
     * @param boolean $blnReload reload Position from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objPosition); // Notify in development version
        if (!($this->objPosition)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objPosition->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objPosition->Id : t('N\A');


			if ($this->txtLat) $this->txtLat->Text = $this->objPosition->Lat;
			if ($this->lblLat) $this->lblLat->Text = $this->objPosition->Lat;


			if ($this->txtLong) $this->txtLong->Text = $this->objPosition->Long;
			if ($this->lblLong) $this->lblLong->Text = $this->objPosition->Long;


			if ($this->txtHeight) $this->txtHeight->Text = $this->objPosition->Height;
			if ($this->lblHeight) $this->lblHeight->Text = $this->objPosition->Height;


    }

    /**
     * Load this ModelConnector with a Position object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|Position
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objPosition = Position::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objPosition = new Position();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objPosition) {
            $this->refresh ();
        }
        return $this->objPosition;
    }




        /**
    * This will update this object's Position instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updatePosition()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->txtLat) $this->objPosition->Lat = $this->txtLat->Text;

				if ($this->txtLong) $this->objPosition->Long = $this->txtLong->Text;

				if ($this->txtHeight) $this->objPosition->Height = $this->txtHeight->Text;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's Position instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function savePosition($blnForceUpdate = false)
    {
        try {
            $this->updatePosition();
            $id = $this->objPosition->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's Position instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deletePosition()
    {
        $this->objPosition->delete();
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
            case 'Position': return $this->objPosition;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to Position fields -- will be created dynamically if not yet created
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'LatControl':
                if (!$this->txtLat) return $this->txtLat_Create();
                return $this->txtLat;
            case 'LatLabel':
                if (!$this->lblLat) return $this->lblLat_Create();
                return $this->lblLat;
            case 'LongControl':
                if (!$this->txtLong) return $this->txtLong_Create();
                return $this->txtLong;
            case 'LongLabel':
                if (!$this->lblLong) return $this->lblLong_Create();
                return $this->lblLong;
            case 'HeightControl':
                if (!$this->txtHeight) return $this->txtHeight_Create();
                return $this->txtHeight;
            case 'HeightLabel':
                if (!$this->lblHeight) return $this->lblHeight_Create();
                return $this->lblHeight;
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

                // Controls that point to Position fields
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'LatControl':
                    $this->txtLat = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'LatLabel':
                    $this->lblLat = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'LongControl':
                    $this->txtLong = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'LongLabel':
                    $this->lblLong = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'HeightControl':
                    $this->txtHeight = Type::Cast($mixValue, '\\QCubed\Control\IntegerTextBox');
                    break;
                case 'HeightLabel':
                    $this->lblHeight = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
