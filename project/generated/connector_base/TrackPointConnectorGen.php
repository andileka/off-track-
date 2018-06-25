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
 * of the TrackPoint class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single TrackPoint object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a TrackPointConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read TrackPoint $TrackPoint the actual TrackPoint data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Project\Control\ListBox $TrackIdControl
 * @property-read QCubed\\Control\\Label $TrackIdLabel
 * @property QCubed\Project\Control\ListBox $PositionIdControl
 * @property-read QCubed\\Control\\Label $PositionIdLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class TrackPointConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var TrackPoint objTrackPoint
     * @access protected
     */
    protected $objTrackPoint;
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

    // Controls that correspond to TrackPoint's individual data fields
    /**
     * @var Label
     * @access protected
     */
    protected $lblId;

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
     * TrackPointConnector to edit a single TrackPoint object within the
     * Panel or Form.
     *
     * This constructor takes in a single TrackPoint object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TrackPointConnector
     * @param TrackPoint $objTrackPoint new or existing TrackPoint object
     */
     public function __construct($objParentObject, TrackPoint $objTrackPoint)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this TrackPointConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked TrackPoint object
        $this->objTrackPoint = $objTrackPoint;

        // Figure out if we're Editing or Creating New
        if ($this->objTrackPoint->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TrackPointConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing TrackPoint object creation - defaults to CreateOrEdit
     * @return TrackPointConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objTrackPoint = TrackPoint::load($intId);

            // TrackPoint was found -- return it!
            if ($objTrackPoint)
                return new TrackPointConnector($objParentObject, $objTrackPoint);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a TrackPoint object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new TrackPointConnector($objParentObject, new TrackPoint());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TrackPointConnector
     * @param integer $intCreateType rules governing TrackPoint object creation - defaults to CreateOrEdit
     * @return TrackPointConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return TrackPointConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TrackPointConnector
     * @param integer $intCreateType rules governing TrackPoint object creation - defaults to CreateOrEdit
     * @return TrackPointConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return TrackPointConnector::create($objParentObject, $intId, $intCreateType);
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
        $this->lblId->LinkedNode = QQN::TrackPoint()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objTrackPoint->Id : t('N\A');
        return $this->lblId;
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
        $this->lstTrack->LinkedNode = QQN::TrackPoint()->Track;
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
      $this->lstTrack->SelectedValue = $this->objTrackPoint->TrackId;
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
				if (($this->objTrackPoint->Track) && ($this->objTrackPoint->Track->Id == $objTrack->Id))
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
        $this->lblTrack->LinkedNode = QQN::TrackPoint()->Track;
			$this->lblTrack->Text = $this->objTrackPoint->Track ? $this->objTrackPoint->Track->__toString() : null;
        return $this->lblTrack;
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
        $this->lstPosition->LinkedNode = QQN::TrackPoint()->Position;
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
      $this->lstPosition->SelectedValue = $this->objTrackPoint->PositionId;
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
				if (($this->objTrackPoint->Position) && ($this->objTrackPoint->Position->Id == $objPosition->Id))
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
        $this->lblPosition->LinkedNode = QQN::TrackPoint()->Position;
			$this->lblPosition->Text = $this->objTrackPoint->Position ? $this->objTrackPoint->Position->__toString() : null;
        return $this->lblPosition;
    }






    /**
     * Refresh this ModelConnector with Data from the local TrackPoint object.
     * @param boolean $blnReload reload TrackPoint from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objTrackPoint); // Notify in development version
        if (!($this->objTrackPoint)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objTrackPoint->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objTrackPoint->Id : t('N\A');


      if ($this->lstTrack) {
        $this->lstTrack->removeAllItems();
        $this->lstTrack->addItem($this->strTrackNullLabel, null);
        $this->lstTrack->addItems($this->lstTrack_GetItems());
        $this->lstTrack->SelectedValue = $this->objTrackPoint->TrackId;
      
      }
			if ($this->lblTrack) $this->lblTrack->Text = $this->objTrackPoint->Track ? $this->objTrackPoint->Track->__toString() : null;


      if ($this->lstPosition) {
        $this->lstPosition->removeAllItems();
        $this->lstPosition->addItem($this->strPositionNullLabel, null);
        $this->lstPosition->addItems($this->lstPosition_GetItems());
        $this->lstPosition->SelectedValue = $this->objTrackPoint->PositionId;
      
      }
			if ($this->lblPosition) $this->lblPosition->Text = $this->objTrackPoint->Position ? $this->objTrackPoint->Position->__toString() : null;


    }

    /**
     * Load this ModelConnector with a TrackPoint object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|TrackPoint
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objTrackPoint = TrackPoint::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objTrackPoint = new TrackPoint();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objTrackPoint) {
            $this->refresh ();
        }
        return $this->objTrackPoint;
    }




        /**
    * This will update this object's TrackPoint instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateTrackPoint()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->lstTrack) $this->objTrackPoint->TrackId = $this->lstTrack->SelectedValue;

				if ($this->lstPosition) $this->objTrackPoint->PositionId = $this->lstPosition->SelectedValue;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's TrackPoint instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveTrackPoint($blnForceUpdate = false)
    {
        try {
            $this->updateTrackPoint();
            $id = $this->objTrackPoint->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's TrackPoint instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteTrackPoint()
    {
        $this->objTrackPoint->delete();
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
            case 'TrackPoint': return $this->objTrackPoint;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to TrackPoint fields -- will be created dynamically if not yet created
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'TrackIdControl':
                if (!$this->lstTrack) return $this->lstTrack_Create();
                return $this->lstTrack;
            case 'TrackIdLabel':
                if (!$this->lblTrack) return $this->lblTrack_Create();
                return $this->lblTrack;
            case 'TrackNullLabel':
                return $this->strTrackNullLabel;
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

                // Controls that point to TrackPoint fields
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
