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
 * of the Track class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single Track object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a TrackConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read Track $Track the actual Track data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Project\Control\TextBox $NameControl
 * @property-read QCubed\\Control\\Label $NameLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class TrackConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var Track objTrack
     * @access protected
     */
    protected $objTrack;
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

    // Controls that correspond to Track's individual data fields
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
     * Main constructor.  Constructor OR static create methods are designed to be called in either
     * a parent Panel or the main Form when wanting to create a
     * TrackConnector to edit a single Track object within the
     * Panel or Form.
     *
     * This constructor takes in a single Track object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TrackConnector
     * @param Track $objTrack new or existing Track object
     */
     public function __construct($objParentObject, Track $objTrack)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this TrackConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked Track object
        $this->objTrack = $objTrack;

        // Figure out if we're Editing or Creating New
        if ($this->objTrack->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TrackConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing Track object creation - defaults to CreateOrEdit
     * @return TrackConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objTrack = Track::load($intId);

            // Track was found -- return it!
            if ($objTrack)
                return new TrackConnector($objParentObject, $objTrack);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a Track object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new TrackConnector($objParentObject, new Track());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TrackConnector
     * @param integer $intCreateType rules governing Track object creation - defaults to CreateOrEdit
     * @return TrackConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return TrackConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TrackConnector
     * @param integer $intCreateType rules governing Track object creation - defaults to CreateOrEdit
     * @return TrackConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return TrackConnector::create($objParentObject, $intId, $intCreateType);
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
        $this->lblId->LinkedNode = QQN::Track()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objTrack->Id : t('N\A');
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
			$this->txtName->MaxLength = Track::NameMaxLength;
			$this->txtName->PreferredRenderMethod = 'RenderWithName';
        $this->txtName->LinkedNode = QQN::Track()->Name;
			$this->txtName->Text = $this->objTrack->Name;
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
        $this->lblName->LinkedNode = QQN::Track()->Name;
			$this->lblName->Text = $this->objTrack->Name;
        return $this->lblName;
    }






    /**
     * Refresh this ModelConnector with Data from the local Track object.
     * @param boolean $blnReload reload Track from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objTrack); // Notify in development version
        if (!($this->objTrack)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objTrack->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objTrack->Id : t('N\A');


			if ($this->txtName) $this->txtName->Text = $this->objTrack->Name;
			if ($this->lblName) $this->lblName->Text = $this->objTrack->Name;


    }

    /**
     * Load this ModelConnector with a Track object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|Track
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objTrack = Track::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objTrack = new Track();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objTrack) {
            $this->refresh ();
        }
        return $this->objTrack;
    }




        /**
    * This will update this object's Track instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateTrack()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->txtName) $this->objTrack->Name = $this->txtName->Text;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's Track instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveTrack($blnForceUpdate = false)
    {
        try {
            $this->updateTrack();
            $id = $this->objTrack->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's Track instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteTrack()
    {
        $this->objTrack->delete();
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
            case 'Track': return $this->objTrack;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to Track fields -- will be created dynamically if not yet created
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'NameControl':
                if (!$this->txtName) return $this->txtName_Create();
                return $this->txtName;
            case 'NameLabel':
                if (!$this->lblName) return $this->lblName_Create();
                return $this->lblName;
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

                // Controls that point to Track fields
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'NameControl':
                    $this->txtName = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'NameLabel':
                    $this->lblName = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
