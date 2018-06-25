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

/**
 * This is a ModelConnector class, providing a Form or Panel access to event handlers
 * and Controls to perform the Create, Edit, and Delete functionality
 * of the Hut class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single Hut object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a HutConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read Hut $Hut the actual Hut data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Project\Control\ListBox $PositionIdControl
 * @property-read QCubed\\Control\\Label $PositionIdLabel
 * @property QCubed\Project\Control\TextBox $NameControl
 * @property-read QCubed\\Control\\Label $NameLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class HutConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var Hut objHut
     * @access protected
     */
    protected $objHut;
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

    // Controls that correspond to Hut's individual data fields
    /**
     * @var Label
     * @access protected
     */
    protected $lblId;

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
     * HutConnector to edit a single Hut object within the
     * Panel or Form.
     *
     * This constructor takes in a single Hut object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this HutConnector
     * @param Hut $objHut new or existing Hut object
     */
     public function __construct($objParentObject, Hut $objHut)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this HutConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked Hut object
        $this->objHut = $objHut;

        // Figure out if we're Editing or Creating New
        if ($this->objHut->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this HutConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing Hut object creation - defaults to CreateOrEdit
     * @return HutConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objHut = Hut::load($intId);

            // Hut was found -- return it!
            if ($objHut)
                return new HutConnector($objParentObject, $objHut);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a Hut object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new HutConnector($objParentObject, new Hut());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this HutConnector
     * @param integer $intCreateType rules governing Hut object creation - defaults to CreateOrEdit
     * @return HutConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return HutConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this HutConnector
     * @param integer $intCreateType rules governing Hut object creation - defaults to CreateOrEdit
     * @return HutConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return HutConnector::create($objParentObject, $intId, $intCreateType);
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
        $this->lblId->LinkedNode = QQN::Hut()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objHut->Id : t('N\A');
        return $this->lblId;
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
        $this->lstPosition->LinkedNode = QQN::Hut()->Position;
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
      $this->lstPosition->SelectedValue = $this->objHut->PositionId;
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
				if (($this->objHut->Position) && ($this->objHut->Position->Id == $objPosition->Id))
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
        $this->lblPosition->LinkedNode = QQN::Hut()->Position;
			$this->lblPosition->Text = $this->objHut->Position ? $this->objHut->Position->__toString() : null;
        return $this->lblPosition;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtName
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtName_Create($strControlId = null) {
			$this->txtName = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtName->Name = t('Name');
			$this->txtName->MaxLength = Hut::NameMaxLength;
			$this->txtName->PreferredRenderMethod = 'RenderWithName';
        $this->txtName->LinkedNode = QQN::Hut()->Name;
			$this->txtName->Text = $this->objHut->Name;
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
        $this->lblName->LinkedNode = QQN::Hut()->Name;
			$this->lblName->Text = $this->objHut->Name;
        return $this->lblName;
    }






    /**
     * Refresh this ModelConnector with Data from the local Hut object.
     * @param boolean $blnReload reload Hut from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objHut); // Notify in development version
        if (!($this->objHut)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objHut->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objHut->Id : t('N\A');


      if ($this->lstPosition) {
        $this->lstPosition->removeAllItems();
        $this->lstPosition->addItem($this->strPositionNullLabel, null);
        $this->lstPosition->addItems($this->lstPosition_GetItems());
        $this->lstPosition->SelectedValue = $this->objHut->PositionId;
      
      }
			if ($this->lblPosition) $this->lblPosition->Text = $this->objHut->Position ? $this->objHut->Position->__toString() : null;


			if ($this->txtName) $this->txtName->Text = $this->objHut->Name;
			if ($this->lblName) $this->lblName->Text = $this->objHut->Name;


    }

    /**
     * Load this ModelConnector with a Hut object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|Hut
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objHut = Hut::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objHut = new Hut();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objHut) {
            $this->refresh ();
        }
        return $this->objHut;
    }




        /**
    * This will update this object's Hut instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateHut()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->lstPosition) $this->objHut->PositionId = $this->lstPosition->SelectedValue;

				if ($this->txtName) $this->objHut->Name = $this->txtName->Text;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's Hut instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveHut($blnForceUpdate = false)
    {
        try {
            $this->updateHut();
            $id = $this->objHut->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's Hut instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteHut()
    {
        $this->objHut->delete();
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
            case 'Hut': return $this->objHut;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to Hut fields -- will be created dynamically if not yet created
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'PositionIdControl':
                if (!$this->lstPosition) return $this->lstPosition_Create();
                return $this->lstPosition;
            case 'PositionIdLabel':
                if (!$this->lblPosition) return $this->lblPosition_Create();
                return $this->lblPosition;
            case 'PositionNullLabel':
                return $this->strPositionNullLabel;
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

                // Controls that point to Hut fields
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
