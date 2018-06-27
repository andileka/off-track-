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
 * of the Question class.  This code-generated class
 * contains all the basic elements to help a Panel or Form display an HTML form that can
 * manipulate a single Question object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form or Panel which instantiates a QuestionConnector
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent
 * code re-generation.
 *
 * @package My QCubed Application
 * @subpackage ModelConnector
 * @property-read Question $Question the actual Question data class being edited
 * @property-read QCubed\\Control\\Label $IdLabel
 * @property QCubed\Project\Control\TextBox $QuestionControl
 * @property-read QCubed\\Control\\Label $QuestionLabel
 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
 */

class QuestionConnectorGen extends \QCubed\ObjectBase
{
    
    /**
     * @var Question objQuestion
     * @access protected
     */
    protected $objQuestion;
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

    // Controls that correspond to Question's individual data fields
    /**
     * @var Label
     * @access protected
     */
    protected $lblId;

    /**
     * @var QCubed\Project\Control\TextBox

     * @access protected
     */
    protected $txtQuestion;

    /**
     * @var Label
     * @access protected
     */
    protected $lblQuestion;



    /**
     * Main constructor.  Constructor OR static create methods are designed to be called in either
     * a parent Panel or the main Form when wanting to create a
     * QuestionConnector to edit a single Question object within the
     * Panel or Form.
     *
     * This constructor takes in a single Question object, while any of the static
     * create methods below can be used to construct based off of individual PK ID(s).
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this QuestionConnector
     * @param Question $objQuestion new or existing Question object
     */
     public function __construct($objParentObject, Question $objQuestion)
     {
        // Setup Parent Object (e.g. Form or Panel which will be using this QuestionConnector)
        $this->objParentObject = $objParentObject;

        // Setup linked Question object
        $this->objQuestion = $objQuestion;

        // Figure out if we're Editing or Creating New
        if ($this->objQuestion->__Restored) {
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
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this QuestionConnector
     * @param null|integer $intId primary key value
     * @param integer $intCreateType rules governing Question object creation - defaults to CreateOrEdit
     * @return QuestionConnector
     * @throws Caller
     */
    public static function create($objParentObject, $intId = null, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        // Attempt to Load from PK Arguments
        if (strlen($intId)) {
            $objQuestion = Question::load($intId);

            // Question was found -- return it!
            if ($objQuestion)
                return new QuestionConnector($objParentObject, $objQuestion);

            // If CreateOnRecordNotFound not specified, throw an exception
            else if ($intCreateType != Q\ModelConnector\Options::CREATE_ON_RECORD_NOT_FOUND)
                throw new Caller('Could not find a Question object with PK arguments: ' . $intId);

        // If EditOnly is specified, throw an exception
        } else if ($intCreateType == Q\ModelConnector\Options::EDIT_ONLY)
            throw new Caller('No PK arguments specified');

        // If we are here, then we need to create a new record
        return new QuestionConnector($objParentObject, new Question());
    }

    /**
     * Static Helper Method to Create using PathInfo arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this QuestionConnector
     * @param integer $intCreateType rules governing Question object creation - defaults to CreateOrEdit
     * @return QuestionConnector
     */
    public static function createFromPathInfo($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->pathInfo(0);
        return QuestionConnector::create($objParentObject, $intId, $intCreateType);
    }

    /**
     * Static Helper Method to Create using QueryString arguments
     *
     * @param FormBase|ControlBase $objParentObject Form or Panel which will be using this QuestionConnector
     * @param integer $intCreateType rules governing Question object creation - defaults to CreateOrEdit
     * @return QuestionConnector
     */
    public static function createFromQueryString($objParentObject, $intCreateType = Q\ModelConnector\Options::CREATE_OR_EDIT)
    {
        $intId = Application::instance()->context()->queryStringItem('intId');
        return QuestionConnector::create($objParentObject, $intId, $intCreateType);
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
        $this->lblId->LinkedNode = QQN::Question()->Id;
			$this->lblId->Text =  $this->blnEditMode ? $this->objQuestion->Id : t('N\A');
        return $this->lblId;
    }



		/**
		 * Create and setup a QCubed\Project\Control\TextBox txtQuestion
		 * @param string $strControlId optional ControlId to use
		 * @return QCubed\Project\Control\TextBox
		 */
		public function txtQuestion_Create($strControlId = null) {
			$this->txtQuestion = new \QCubed\Project\Control\TextBox($this->objParentObject, $strControlId);
			$this->txtQuestion->Name = t('Question');
			$this->txtQuestion->MaxLength = Question::QuestionMaxLength;
			$this->txtQuestion->PreferredRenderMethod = 'RenderWithName';
        $this->txtQuestion->LinkedNode = QQN::Question()->Question;
			$this->txtQuestion->Text = $this->objQuestion->Question;
			return $this->txtQuestion;
		}

    /**
     * Create and setup QCubed\Control\Label lblQuestion
     *
     * @param string $strControlId optional ControlId to use
     * @return QCubed\Control\Label
     */
    public function lblQuestion_Create($strControlId = null) 
    {
        $this->lblQuestion = new \QCubed\Control\Label($this->objParentObject, $strControlId);
        $this->lblQuestion->Name = t('Question');
        $this->lblQuestion->PreferredRenderMethod = 'RenderWithName';
        $this->lblQuestion->LinkedNode = QQN::Question()->Question;
			$this->lblQuestion->Text = $this->objQuestion->Question;
        return $this->lblQuestion;
    }






    /**
     * Refresh this ModelConnector with Data from the local Question object.
     * @param boolean $blnReload reload Question from the database
     * @return void
     */
    public function refresh($blnReload = false)
    {
        assert($this->objQuestion); // Notify in development version
        if (!($this->objQuestion)) return; // Quietly fail in production

        if ($blnReload) {
            $this->objQuestion->Reload();
        }
			if ($this->lblId) $this->lblId->Text =  $this->blnEditMode ? $this->objQuestion->Id : t('N\A');


			if ($this->txtQuestion) $this->txtQuestion->Text = $this->objQuestion->Question;
			if ($this->lblQuestion) $this->lblQuestion->Text = $this->objQuestion->Question;


    }

    /**
     * Load this ModelConnector with a Question object. Returns the object found, or null if not
     * successful. The primary reason for failure would be that the key given does not exist in the database. This
     * might happen due to a programming error, or in a multi-user environment, if the record was recently deleted.
     * @param null|integer $intId
     * @param $objClauses
     * @return null|Question
     */
    public function load($intId = null, $objClauses = null)
    {
        if (!is_null($intId)) {
            $this->objQuestion = Question::Load($intId, $objClauses);
            $this->strTitleVerb = t('Edit');
            $this->blnEditMode = true;
        }
        else {
            $this->objQuestion = new Question();
            $this->strTitleVerb = t('Create');
            $this->blnEditMode = false;
        }
        if ($this->objQuestion) {
            $this->refresh ();
        }
        return $this->objQuestion;
    }




        /**
    * This will update this object's Question instance,
    * updating only the fields which have had a control created for it.
    * @throws Caller
    */
    public function updateQuestion()
    {
        try {
            // Update any fields for controls that have been created

				if ($this->txtQuestion) $this->objQuestion->Question = $this->txtQuestion->Text;


            // Update any UniqueReverseReferences for controls that have been created for it

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    /**
     * This will save this object's Question instance,
     * updating only the fields which have had a control created for it.
     * @param bool $blnForceUpdate
     * @return mixed
     * @throws Caller
     */
    public function saveQuestion($blnForceUpdate = false)
    {
        try {
            $this->updateQuestion();
            $id = $this->objQuestion->save(false, $blnForceUpdate);

        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }

        return $id;
    }

    /**
     * This will DELETE this object's Question instance from the database.
     * It will also unassociate itself from any ManyToManyReferences.
     */
    public function deleteQuestion()
    {
        $this->objQuestion->delete();
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
            case 'Question': return $this->objQuestion;
            case 'TitleVerb': return $this->strTitleVerb;
            case 'EditMode': return $this->blnEditMode;

            // Controls that point to Question fields -- will be created dynamically if not yet created
            case 'IdLabel':
                if (!$this->lblId) return $this->lblId_Create();
                return $this->lblId;
            case 'QuestionControl':
                if (!$this->txtQuestion) return $this->txtQuestion_Create();
                return $this->txtQuestion;
            case 'QuestionLabel':
                if (!$this->lblQuestion) return $this->lblQuestion_Create();
                return $this->lblQuestion;
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

                // Controls that point to Question fields
                case 'IdLabel':
                    $this->lblId = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
                    break;
                case 'QuestionControl':
                    $this->txtQuestion = Type::Cast($mixValue, '\\QCubed\Project\Control\TextBox');
                    break;
                case 'QuestionLabel':
                    $this->lblQuestion = Type::Cast($mixValue, '\\QCubed\\Control\\Label');
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
