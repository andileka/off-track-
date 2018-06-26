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

/**
 * This is a ModelConnector class, providing a Form or Panel access to event handlers
 * and Controls to perform the Create, Edit, and Delete functionality
 * of the TouristTrack class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single TouristTrack object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a TouristTrackConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read TouristTrack $TouristTrack the actual TouristTrack data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Project\Control\ListBox $TouristIdControl
 * @property-read QCubed\\Control\\Label $TouristIdLabel
 * @property QCubed\Project\Control\ListBox $TrackIdControl
 * @property-read QCubed\\Control\\Label $TrackIdLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class TouristTrackConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var TouristTrack objTouristTrack
     * @access protected
     */
    protected $objTouristTrack;
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

    // Controls that correspond to TouristTrack's individual data fields
    /**
     * @var Label
     * @access protected
     */
    protected $lblId;

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
     * @var QCubed\Project\Control\ListBox
     * @access protected
     */
    protected $lstTrack;

    /**
     * @var string 
     * @access protected
     */
    protected $strTrackNullLabel;

    /**
    * @var QQCondition
    * @access protected
    */
    protected $objTrackCondition;

    /**
    * @var QQClause[]
    * @access protected
    */
    protected $objTrackClauses;
    /**
     * @var Label
     * @access protected
     */
    protected $lblTrack;



    /**
     * Main constructor.  Constructor OR static create methods are designed to be called in either
     * a parent Panel or the main Form when wanting to create a
     * TouristTrackConnector to edit a single TouristTrack object within the
     * Panel or Form.
     *
     * This constructor takes in a single TouristTrack object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TouristTrackConnector
     * @param TouristTrack $objTouristTrack new or existing TouristTrack object
     */
     public function __construct($objParentObject, TouristTrack $objTouristTrack)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this TouristTrackConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked TouristTrack object
        $this->objTouristTrack = $objTouristTrack;

        // Figure out if we're Editing or Creating New
        if ($this->objTouristTrack->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TouristTrackConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing TouristTrack object creation - defaults to CreateOrEdit
     * @return TouristTrackConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objTouristTrack = TouristTrack::load($intId);

            // TouristTrack was found -- return it!
            if ($objTouristTrack)
                return new TouristTrackConnector($objParentObject, $objTouristTrack);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a TouristTrack object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new TouristTrackConnector($objParentObject, new TouristTrack());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TouristTrackConnector
     * @param integer $intCreateType rules governing TouristTrack object creation - defaults to CreateOrEdit
     * @return TouristTrackConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return TouristTrackConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TouristTrackConnector
     * @param integer $intCreateType rules governing TouristTrack object creation - defaults to CreateOrEdit
     * @return TouristTrackConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return TouristTrackConnector::create($objParentObject, $intId, $intCreateType);
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
        $this->lblId->LinkedNode = QQN::TouristTrack()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objTouristTrack->Id : t('N\A');
        return $this->lblId;
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
        $this->lstTourist->LinkedNode = QQN::TouristTrack()->Tourist;
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
      $this->lstTourist->SelectedValue = $this->objTouristTrack->TouristId;
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
				if (($this->objTouristTrack->Tourist) && ($this->objTouristTrack->Tourist->Id == $objTourist->Id))
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
        $this->lblTourist->LinkedNode = QQN::TouristTrack()->Tourist;
			$this->lblTourist->Text = $this->objTouristTrack->Tourist ? $this->objTouristTrack->Tourist->__toString() : null;
        return $this->lblTourist;
    }



		/**
		 * Create and setup QCubed\Project\Control\ListBox lstTrack
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objCondition override the default condition of QQ::all() to the query, itself
		 * @param QQClause[] $objClauses additional QQClause object or array of QQClause objects for the query
		 * @return ListBox
		 */
		public function lstTrack_Create($strControlId = null, QQCondition $objCondition = null, $objClauses = null) {
			$this->objTrackCondition = $objCondition;
			$this->objTrackClauses = $objClauses;
			$this->lstTrack = new \QCubed\Project\Control\ListBox($this->objParentObject, $strControlId);
			$this->lstTrack->Name = t('Track');
			$this->lstTrack->PreferredRenderMethod = 'RenderWithName';
        $this->lstTrack->LinkedNode = QQN::TouristTrack()->Track;
      if (!$this->strTrackNullLabel) {
      	if (!$this->lstTrack->Required) {
      		$this->strTrackNullLabel = t('- None -');
      	}
      	elseif (!$this->blnEditMode) {
      		$this->strTrackNullLabel = t('- Select One -');
      	}
      }
      $this->lstTrack->addItem($this->strTrackNullLabel, null);
      $this->lstTrack->addItems($this->lstTrack_GetItems());
      $this->lstTrack->SelectedValue = $this->objTouristTrack->TrackId;
			return $this->lstTrack;
		}

		/**
		 *	Create item list for use by lstTrack
		 */
		 public function lstTrack_GetItems() {
			$a = array();
			$objCondition = $this->objTrackCondition;
			if (is_null($objCondition)) $objCondition = QQ::all();
			$objTrackCursor = Track::queryCursor($objCondition, $this->objTrackClauses);

			// Iterate through the Cursor
			while ($objTrack = Track::instantiateCursor($objTrackCursor)) {
				$objListItem = new ListItem($objTrack->__toString(), $objTrack->Id);
				if (($this->objTouristTrack->Track) && ($this->objTouristTrack->Track->Id == $objTrack->Id))
					$objListItem->Selected = true;
				$a[] = $objListItem;
			}
			return $a;
		 }

    /**
     * Create and setup QCubed\Control\Label lblTrack
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblTrack_Create($strControlId = null) 
    {
        $this->lblTrack = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblTrack->Name = t('Track');
        $this->lblTrack->PreferredRenderMethod = 'RenderWithName';
        $this->lblTrack->LinkedNode = QQN::TouristTrack()->Track;
			$this->lblTrack->Text = $this->objTouristTrack->Track ? $this->objTouristTrack->Track->__toString() : null;
        return $this->lblTrack;
    }






    /**
     * Refresh this ModelConnector with Data from the local TouristTrack object.
     * @param boolean $blnReload reload TouristTrack from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objTouristTrack); // Notify in development version
        if (!($this->objTouristTrack)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objTouristTrack->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objTouristTrack->Id : t('N\A');


      if ($this->lstTourist) {
        $this->lstTourist->removeAllItems();
        $this->lstTourist->addItem($this->strTouristNullLabel, null);
        $this->lstTourist->addItems($this->lstTourist_GetItems());
        $this->lstTourist->SelectedValue = $this->objTouristTrack->TouristId;
      
      }
			if ($this->lblTourist) $this->lblTourist->Text = $this->objTouristTrack->Tourist ? $this->objTouristTrack->Tourist->__toString() : null;


      if ($this->lstTrack) {
        $this->lstTrack->removeAllItems();
        $this->lstTrack->addItem($this->strTrackNullLabel, null);
        $this->lstTrack->addItems($this->lstTrack_GetItems());
        $this->lstTrack->SelectedValue = $this->objTouristTrack->TrackId;
      
      }
			if ($this->lblTrack) $this->lblTrack->Text = $this->objTouristTrack->Track ? $this->objTouristTrack->Track->__toString() : null;


    }

    /**
     * Load this ModelConnector with a TouristTrack object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|TouristTrack
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objTouristTrack = TouristTrack::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objTouristTrack = new TouristTrack();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objTouristTrack) {
            $this->refresh ();
        }
        return $this->objTouristTrack;
    }




        /**
    * This will update this object's TouristTrack instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateTouristTrack()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->lstTourist) $this->objTouristTrack->TouristId = $this->lstTourist->SelectedValue;

				if ($this->lstTrack) $this->objTouristTrack->TrackId = $this->lstTrack->SelectedValue;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's TouristTrack instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveTouristTrack($blnForceUpdate = false)
    {
        try {
            $this->updateTouristTrack();
            $id = $this->objTouristTrack->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's TouristTrack instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteTouristTrack()
    {
        $this->objTouristTrack->delete();
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
            case 'TouristTrack': return $this->objTouristTrack;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to TouristTrack fields -- will be created dynamically if not yet created
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'TouristIdControl':
                if (!$this->lstTourist) return $this->lstTourist_Create();
                return $this->lstTourist;
            case 'TouristIdLabel':
                if (!$this->lblTourist) return $this->lblTourist_Create();
                return $this->lblTourist;
            case 'TouristNullLabel':
                return $this->strTouristNullLabel;
            case 'TrackIdControl':
                if (!$this->lstTrack) return $this->lstTrack_Create();
                return $this->lstTrack;
            case 'TrackIdLabel':
                if (!$this->lblTrack) return $this->lblTrack_Create();
                return $this->lblTrack;
            case 'TrackNullLabel':
                return $this->strTrackNullLabel;
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

                // Controls that point to TouristTrack fields
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
                case 'TrackIdControl':
                    $this->lstTrack = Type::Cast($mixValue, '\\QCubed\Project\Control\ListBox');
                    break;
                case 'TrackIdLabel':
                    $this->lblTrack = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'TrackNullLabel':
                    $this->strTrackNullLabel = $mixValue;
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
