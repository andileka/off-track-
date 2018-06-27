<?php

use QCubed as Q;
use QCubed\Exception\Caller as Caller;
use QCubed\Project\Control\FormBase;
use QCubed\Project\Control\ControlBase;
use QCubed\Query\QQ;
use QCubed\Control\Label;
use QCubed\Control\IntegerTextBox;
use QCubed\Project\Control\TextBox;

/**
 * This is a ModelConnector class, providing a Form or Panel access to event handlers
 * and Controls to perform the Create, Edit, and Delete functionality
 * of the TouristAnswer class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single TouristAnswer object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a TouristAnswerConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read TouristAnswer $TouristAnswer the actual TouristAnswer data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Control\IntegerTextBox $TouristIdControl
 * @property-read QCubed\\Control\\Label $TouristIdLabel
 * @property QCubed\Control\IntegerTextBox $QuestionIdControl
 * @property-read QCubed\\Control\\Label $QuestionIdLabel
 * @property QCubed\Project\Control\TextBox $AnswerControl
 * @property-read QCubed\\Control\\Label $AnswerLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class TouristAnswerConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var TouristAnswer objTouristAnswer
     * @access protected
     */
    protected $objTouristAnswer;
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

    // Controls that correspond to TouristAnswer's individual data fields
    /**
     * @var Label
     * @access protected
     */
    protected $lblId;

    /**
     * @var QCubed\Control\IntegerTextBox

     * @access protected
     */
    protected $txtTouristId;

    /**
     * @var Label
     * @access protected
     */
    protected $lblTouristId;

    /**
     * @var QCubed\Control\IntegerTextBox

     * @access protected
     */
    protected $txtQuestionId;

    /**
     * @var Label
     * @access protected
     */
    protected $lblQuestionId;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtAnswer;

    /**
     * @var Label
     * @access protected
     */
    protected $lblAnswer;



    /**
     * Main constructor.  Constructor OR static create methods are designed to be called in either
     * a parent Panel or the main Form when wanting to create a
     * TouristAnswerConnector to edit a single TouristAnswer object within the
     * Panel or Form.
     *
     * This constructor takes in a single TouristAnswer object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TouristAnswerConnector
     * @param TouristAnswer $objTouristAnswer new or existing TouristAnswer object
     */
     public function __construct($objParentObject, TouristAnswer $objTouristAnswer)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this TouristAnswerConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked TouristAnswer object
        $this->objTouristAnswer = $objTouristAnswer;

        // Figure out if we're Editing or Creating New
        if ($this->objTouristAnswer->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TouristAnswerConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing TouristAnswer object creation - defaults to CreateOrEdit
     * @return TouristAnswerConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objTouristAnswer = TouristAnswer::load($intId);

            // TouristAnswer was found -- return it!
            if ($objTouristAnswer)
                return new TouristAnswerConnector($objParentObject, $objTouristAnswer);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a TouristAnswer object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new TouristAnswerConnector($objParentObject, new TouristAnswer());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TouristAnswerConnector
     * @param integer $intCreateType rules governing TouristAnswer object creation - defaults to CreateOrEdit
     * @return TouristAnswerConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return TouristAnswerConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this TouristAnswerConnector
     * @param integer $intCreateType rules governing TouristAnswer object creation - defaults to CreateOrEdit
     * @return TouristAnswerConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return TouristAnswerConnector::create($objParentObject, $intId, $intCreateType);
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
        $this->lblId->LinkedNode = QQN::TouristAnswer()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objTouristAnswer->Id : t('N\A');
        return $this->lblId;
    }



		/**
		 * Create and setup a QCubed\Control\IntegerTextBox txtTouristId
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Control\IntegerTextBox
		 */
		public function txtTouristId_Create($strControlId = null) {
			$this->txtTouristId = new \QCubed\Control\IntegerTextBox($this->objParentObject, $strControlId);
			$this->txtTouristId->Name = t('Tourist Id');
			$this->txtTouristId->PreferredRenderMethod = 'RenderWithName';
        $this->txtTouristId->LinkedNode = QQN::TouristAnswer()->TouristId;
			$this->txtTouristId->Text = $this->objTouristAnswer->TouristId;
			return $this->txtTouristId;
		}

    /**
     * Create and setup QCubed\Control\Label lblTouristId
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblTouristId_Create($strControlId = null) 
    {
        $this->lblTouristId = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblTouristId->Name = t('Tourist Id');
        $this->lblTouristId->PreferredRenderMethod = 'RenderWithName';
        $this->lblTouristId->LinkedNode = QQN::TouristAnswer()->TouristId;
			$this->lblTouristId->Text = $this->objTouristAnswer->TouristId;
        return $this->lblTouristId;
    }



		/**
		 * Create and setup a QCubed\Control\IntegerTextBox txtQuestionId
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Control\IntegerTextBox
		 */
		public function txtQuestionId_Create($strControlId = null) {
			$this->txtQuestionId = new \QCubed\Control\IntegerTextBox($this->objParentObject, $strControlId);
			$this->txtQuestionId->Name = t('Question Id');
			$this->txtQuestionId->PreferredRenderMethod = 'RenderWithName';
        $this->txtQuestionId->LinkedNode = QQN::TouristAnswer()->QuestionId;
			$this->txtQuestionId->Text = $this->objTouristAnswer->QuestionId;
			return $this->txtQuestionId;
		}

    /**
     * Create and setup QCubed\Control\Label lblQuestionId
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblQuestionId_Create($strControlId = null) 
    {
        $this->lblQuestionId = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblQuestionId->Name = t('Question Id');
        $this->lblQuestionId->PreferredRenderMethod = 'RenderWithName';
        $this->lblQuestionId->LinkedNode = QQN::TouristAnswer()->QuestionId;
			$this->lblQuestionId->Text = $this->objTouristAnswer->QuestionId;
        return $this->lblQuestionId;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtAnswer
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtAnswer_Create($strControlId = null) {
			$this->txtAnswer = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtAnswer->Name = t('Answer');
			$this->txtAnswer->PreferredRenderMethod = 'RenderWithName';
        $this->txtAnswer->LinkedNode = QQN::TouristAnswer()->Answer;
			$this->txtAnswer->Text = $this->objTouristAnswer->Answer;
			return $this->txtAnswer;
		}

    /**
     * Create and setup QCubed\Control\Label lblAnswer
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblAnswer_Create($strControlId = null) 
    {
        $this->lblAnswer = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblAnswer->Name = t('Answer');
        $this->lblAnswer->PreferredRenderMethod = 'RenderWithName';
        $this->lblAnswer->LinkedNode = QQN::TouristAnswer()->Answer;
			$this->lblAnswer->Text = $this->objTouristAnswer->Answer;
        return $this->lblAnswer;
    }






    /**
     * Refresh this ModelConnector with Data from the local TouristAnswer object.
     * @param boolean $blnReload reload TouristAnswer from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objTouristAnswer); // Notify in development version
        if (!($this->objTouristAnswer)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objTouristAnswer->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objTouristAnswer->Id : t('N\A');


			if ($this->txtTouristId) $this->txtTouristId->Text = $this->objTouristAnswer->TouristId;
			if ($this->lblTouristId) $this->lblTouristId->Text = $this->objTouristAnswer->TouristId;


			if ($this->txtQuestionId) $this->txtQuestionId->Text = $this->objTouristAnswer->QuestionId;
			if ($this->lblQuestionId) $this->lblQuestionId->Text = $this->objTouristAnswer->QuestionId;


			if ($this->txtAnswer) $this->txtAnswer->Text = $this->objTouristAnswer->Answer;
			if ($this->lblAnswer) $this->lblAnswer->Text = $this->objTouristAnswer->Answer;


    }

    /**
     * Load this ModelConnector with a TouristAnswer object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|TouristAnswer
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objTouristAnswer = TouristAnswer::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objTouristAnswer = new TouristAnswer();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objTouristAnswer) {
            $this->refresh ();
        }
        return $this->objTouristAnswer;
    }




        /**
    * This will update this object's TouristAnswer instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateTouristAnswer()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->txtTouristId) $this->objTouristAnswer->TouristId = $this->txtTouristId->Text;

				if ($this->txtQuestionId) $this->objTouristAnswer->QuestionId = $this->txtQuestionId->Text;

				if ($this->txtAnswer) $this->objTouristAnswer->Answer = $this->txtAnswer->Text;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's TouristAnswer instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveTouristAnswer($blnForceUpdate = false)
    {
        try {
            $this->updateTouristAnswer();
            $id = $this->objTouristAnswer->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's TouristAnswer instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteTouristAnswer()
    {
        $this->objTouristAnswer->delete();
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
            case 'TouristAnswer': return $this->objTouristAnswer;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to TouristAnswer fields -- will be created dynamically if not yet created
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'TouristIdControl':
                if (!$this->txtTouristId) return $this->txtTouristId_Create();
                return $this->txtTouristId;
            case 'TouristIdLabel':
                if (!$this->lblTouristId) return $this->lblTouristId_Create();
                return $this->lblTouristId;
            case 'QuestionIdControl':
                if (!$this->txtQuestionId) return $this->txtQuestionId_Create();
                return $this->txtQuestionId;
            case 'QuestionIdLabel':
                if (!$this->lblQuestionId) return $this->lblQuestionId_Create();
                return $this->lblQuestionId;
            case 'AnswerControl':
                if (!$this->txtAnswer) return $this->txtAnswer_Create();
                return $this->txtAnswer;
            case 'AnswerLabel':
                if (!$this->lblAnswer) return $this->lblAnswer_Create();
                return $this->lblAnswer;
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

                // Controls that point to TouristAnswer fields
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'TouristIdControl':
                    $this->txtTouristId = Type::Cast($mixValue, '\\QCubed\Control\IntegerTextBox');
                    break;
                case 'TouristIdLabel':
                    $this->lblTouristId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'QuestionIdControl':
                    $this->txtQuestionId = Type::Cast($mixValue, '\\QCubed\Control\IntegerTextBox');
                    break;
                case 'QuestionIdLabel':
                    $this->lblQuestionId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'AnswerControl':
                    $this->txtAnswer = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'AnswerLabel':
                    $this->lblAnswer = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
