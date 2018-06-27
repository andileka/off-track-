<?php
/**
 * Generated TouristAnswer base class file
 */

use QCubed\Query\QQ;
use QCubed\Query\Condition\ConditionInterface as iCondition;
use QCubed\Query\Clause\ClauseInterface as iClause;
use QCubed\Query\Node;
use QCubed\Exception\Caller;
use QCubed\Type;
use QCubed\QDateTime;
use QCubed\Query\ModelTrait;

/**
 * Class TouristAnswerGen
 *
 * The abstract TouristAnswerGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the TouristAnswer subclass which
 * extends this TouristAnswerGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the TouristAnswer class.
 *
 * @package My QCubed Application
 * @subpackage ModelGen
 * @property-read integer $Id the value of the id column (Read-Only PK)
 * @property integer $TouristId the value of the tourist_id column 
 * @property integer $QuestionId the value of the question_id column 
 * @property string $Answer the value of the answer column 
 * @property Tourist $Tourist the value of the Tourist object referenced by intTouristId 
 * @property Question $Question the value of the Question object referenced by intQuestionId 
 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
 */
abstract class TouristAnswerGen extends \QCubed\ObjectBase implements IteratorAggregate, JsonSerializable {

    use ModelTrait;

    /** @var boolean Set to false in superclass to save a little time if this db object should not be watched for changes. */
    public static $blnWatchChanges = true;

    /** @var TouristAnswer[] Short term cached TouristAnswer objects */
    protected static $objCacheArray = array();

    ///////////////////////////////////////////////////////////////////////
    // PROTECTED AND PRIVATE MEMBER VARIABLES and CONSTS
    ///////////////////////////////////////////////////////////////////////

    /**
     * Protected member variable that maps to the database PK Identity column tourist_answer.id
     * @var integer intId
     */
    private $intId;

    const ID_DEFAULT = null;
    const ID_FIELD = 'id';


    /**
     * Protected member variable that maps to the database column tourist_answer.tourist_id
     * @var integer intTouristId
     */
    private $intTouristId;

    const TOURIST_ID_DEFAULT = null;
    const TOURIST_ID_FIELD = 'tourist_id';


    /**
     * Protected member variable that maps to the database column tourist_answer.question_id
     * @var integer intQuestionId
     */
    private $intQuestionId;

    const QUESTION_ID_DEFAULT = null;
    const QUESTION_ID_FIELD = 'question_id';


    /**
     * Protected member variable that maps to the database column tourist_answer.answer
     * @var string strAnswer
     */
    private $strAnswer;

    const ANSWER_DEFAULT = null;
    const ANSWER_FIELD = 'answer';


    /**
     * Protected array of virtual attributes for this object (e.g. extra/other calculated and/or non-object bound
     * columns from the run-time database query result for this object).  Used by InstantiateDbRow and
     * GetVirtualAttribute.
     * @var string[] $__strVirtualAttributeArray
     */
    protected $__strVirtualAttributeArray = array();

    /**
     * Protected internal member variable that specifies whether or not this object is Restored from the database.
     * Used by Save() to determine if Save() should perform a db UPDATE or INSERT.
     * @var bool __blnRestored;
     */
    protected $__blnRestored;

    /**
     * Protected internal array that records which fields are dirty.
     * Used by Save() to optimize the Update or Insert function.
     * @var bool[] __blnDirty;
     */
    private $__blnDirty;

    /**
     * Protected internal array that records which fields are valid.
     * Used by getters to prevent accidentally reading data that was not taken from the database.
     * @var bool[] __blnDirty;
     */
    private $__blnValid;

    ///////////////////////////////
    // PROTECTED MEMBER OBJECTS
    ///////////////////////////////

    /**
     * Protected member variable that contains the object pointed by the reference
     * in the database column tourist_answer.tourist_id.
     *
     * NOTE: Always use the Tourist property getter to correctly retrieve this Tourist object.
     * (Because this class implements late binding, this variable reference MAY be null.)
     * @var Tourist objTourist
     */
    protected $objTourist;

    /**
     * Protected member variable that contains the object pointed by the reference
     * in the database column tourist_answer.question_id.
     *
     * NOTE: Always use the Question property getter to correctly retrieve this Question object.
     * (Because this class implements late binding, this variable reference MAY be null.)
     * @var Question objQuestion
     */
    protected $objQuestion;



    /**
     * Construct a new TouristAnswer object.
     * @param bool $blnInitialize
     */
    public function __construct($blnInitialize = true)
    {
        if ($blnInitialize) {
            $this->Initialize();
        }
    }

    /**
     * Initialize each property with default values from database definition
     */
    public function initialize()
    {
        $this->intTouristId = TouristAnswer::TOURIST_ID_DEFAULT;
        $this->__blnValid[self::TOURIST_ID_FIELD] = true;
        $this->intQuestionId = TouristAnswer::QUESTION_ID_DEFAULT;
        $this->__blnValid[self::QUESTION_ID_FIELD] = true;
        $this->strAnswer = TouristAnswer::ANSWER_DEFAULT;
        $this->__blnValid[self::ANSWER_FIELD] = true;
    }

   /**
    *
    * @returns string
    */
    abstract function __toString();

    /**
     * Returns a single unique value representing the primary key.
     * @return integer
     */
    public function primaryKey()
    {
        return $this->intId;
    }

    /**
    * Returns the primary key directly from a database row.
    * @param \QCubed\Database\RowBase $objDbRow
    * @param string $strAliasPrefix
    * @param string[] $strColumnAliasArray
    * @return integer
    **/
    protected static function getRowPrimaryKey(\QCubed\Database\RowBase $objDbRow, $strAliasPrefix, $strColumnAliasArray)
    {
        $strAlias = $strAliasPrefix . 'id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        $strColumns = $objDbRow->GetColumnNameArray();
        $mixVal = (isset ($strColumns[$strAliasName]) ? $strColumns[$strAliasName] : null);
        $mixVal = (integer)$mixVal;
        return $mixVal;
    }

    ///////////////////////////////
    // CLASS-WIDE LOAD AND COUNT METHODS
    ///////////////////////////////

    /**
     * Static method to retrieve the Database object that owns this class.
     * @return \QCubed\Database\DatabaseBase reference to the Database object that can query this class
     */
    public static function getDatabase()
    {
        return \QCubed\Database\Service::getDatabase(self::getDatabaseIndex());
    }

    /**
     * Load a TouristAnswer from PK Info
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return TouristAnswer
     */
    public static function load($intId, $objOptionalClauses = null)
    {
        if (!$objOptionalClauses) {
            $objCachedObject = static::getFromCache ($intId);
            if ($objCachedObject) return $objCachedObject;
        }

        // Use QuerySingle to Perform the Query
        $objToReturn = TouristAnswer::querySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::TouristAnswer()->Id, $intId)
            ),
            $objOptionalClauses
        );
        return $objToReturn;
    }


    /**
     * Load all TouristAnswers
     * @param iClause[]|null $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return TouristAnswer[]
     * @throws Caller
     */
    public static function loadAll($objOptionalClauses = null)
    {
        if (func_num_args() > 1) {
            throw new Caller("LoadAll must be called with an array of optional clauses as a single argument");
        }
        // Call TouristAnswer::queryArray to perform the LoadAll query
        try {
            return TouristAnswer::queryArray(QQ::All(), $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count all TouristAnswers
     * @return int
     */
    public static function countAll()
    {
        // Call TouristAnswer::queryCount to perform the CountAll query
        return TouristAnswer::queryCount(QQ::All());
    }


    /**
     * Static Qcubed Query method to query for a single TouristAnswer object.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return TouristAnswer the queried object
     */
    public static function querySingle(iCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null)
    {
        return static::_QuerySingle($objConditions, $objOptionalClauses, $mixParameterArray);
    }

    /**
     * Static Qcubed Query method to query for an array of TouristAnswer objects.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return TouristAnswer[] the queried objects as an array
     */
    public static function queryArray(iCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null)
    {
        return static::_QueryArray($objConditions, $objOptionalClauses, $mixParameterArray);
    }

    public static function queryPrimaryKeys(iCondition $objConditions = null)
    {
        if ($objConditions === null) {
            $objConditions = QQ::All();
        }
        $clauses[] = QQ::Select(QQN::TouristAnswer()->Id);
        $objTouristAnswers = self::QueryArray($objConditions, $clauses);
        $pks = [];
        foreach ($objTouristAnswers as $objTouristAnswer) {
            $pks[] = $objTouristAnswer->intId;
        }
        return $pks;
    }

    // See QModelTrait.trait.php for the following
    // protected static function BuildQueryStatement(&$objQueryBuilder, iCondition $objConditions, $objOptionalClauses, $mixParameterArray, $blnCountOnly) {
    // public static function QueryCursor(iCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
    // public static function QueryCount(iCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
    // public static function QueryArrayCached(iCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null, $blnForceUpdate = false) {

    /**
    * Return an object corresponding to the given key, or null.
    *
    * The key might be null if:
    * 	The table has no primary key, or
    *  SetSkipPrimaryKey was used in a query with QSelect.
    *
    * Otherwise, the default here is to use the local cache.
    *
    * Note that you rarely would want to change this. Caching at this level happens
    * after a query has executed. Using a cache like APC or MemCache at this point would
    * be really expensive, and would only be worth it for a large table.
    *
    * Offloads the work to the ModelTrait
    *
    * @param $key
    * @return TouristAnswer the queried object
    */
    public static function getFromCache($key)
    {
        return static::_GetFromCache($key);
    }


    /**
     * Instantiate a TouristAnswer from a Database Row.
     * Takes in an optional strAliasPrefix, used in case another Object::instantiateDbRow
     * is calling this TouristAnswer::instantiateDbRow in order to perform
     * early binding on referenced objects.
     * @param \QCubed\Database\RowBase $objDbRow
     * @param string $strAliasPrefix
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param array|null $objPreviousItemArray Used by expansion code to aid in expanding arrays
     * @param string[] $strColumnAliasArray Array of column aliases mapping names in the query to items in the object
     * @param boolean $blnCheckDuplicate Used by ExpandArray to indicate we should not create a new object if this is a duplicate of a previoius object
     * @param string $strParentExpansionKey If this is part of an expansion, indicates what the parent item is
     * @param mixed $objExpansionParent If this is part of an expansion, is the object corresponding to the key so that we can refer back to the parent object
     * @return mixed Either a TouristAnswer, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
    */
    public static function instantiateDbRow(
        \QCubed\Database\RowBase $objDbRow,
        $strAliasPrefix = null,
        Node\NodeBase $objExpandAsArrayNode = null,
        $objPreviousItemArray = null,
        $strColumnAliasArray = array(),
        $blnCheckDuplicate = false,
        $strParentExpansionKey = null,
        $objExpansionParent = null
    ) {

        // If blank row, return null
        if (!$objDbRow) {
            return null;
        }

        $strColumns = $objDbRow->GetColumnNameArray();
        $strColumnKeys = array_fill_keys(array_keys($strColumns), 1); // to be able to use isset

        $key = static::getRowPrimaryKey ($objDbRow, $strAliasPrefix, $strColumnAliasArray);
        if (empty ($strAliasPrefix) && $objPreviousItemArray) {
            $objPreviousItemArray = (!empty ($objPreviousItemArray[$key]) ? $objPreviousItemArray[$key] : null);
        }
			

        // See if we're doing an array expansion on the previous item
        if ($objExpandAsArrayNode &&
                is_array($objPreviousItemArray) &&
                count($objPreviousItemArray)) {

            $expansionStatus = static::expandArray ($objDbRow, $strAliasPrefix, $objExpandAsArrayNode, $objPreviousItemArray, $strColumnAliasArray);
            if ($expansionStatus) {
                return false; // db row was used but no new object was created
            } elseif ($expansionStatus === null) {
                $blnCheckDuplicate = true;
            }
        }


        $objToReturn = static::getFromCache ($key);
        if (empty($objToReturn)) {
            // Create a new instance of the TouristAnswer object
            $objToReturn = new TouristAnswer(false);
            $objToReturn->__blnRestored = true;
            $blnNoCache = false;

            $strAlias = $strAliasPrefix . 'id';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = (integer)$mixVal;
                }
                $objToReturn->intId = $mixVal;
                $objToReturn->__blnValid[self::ID_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'tourist_id';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = (integer)$mixVal;
                }
                $objToReturn->intTouristId = $mixVal;
                $objToReturn->__blnValid[self::TOURIST_ID_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'question_id';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = (integer)$mixVal;
                }
                $objToReturn->intQuestionId = $mixVal;
                $objToReturn->__blnValid[self::QUESTION_ID_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'answer';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strAnswer = $mixVal;
                $objToReturn->__blnValid[self::ANSWER_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }

            assert ($key === null || $objToReturn->PrimaryKey() == $key);

            if (!$blnNoCache) {
                $objToReturn->WriteToCache();
            }
        }

        if (isset($objPreviousItemArray) && is_array($objPreviousItemArray) && $blnCheckDuplicate) {
            foreach ($objPreviousItemArray as $objPreviousItem) {
                if ($objToReturn->Id != $objPreviousItem->Id) {
                    continue;
                }
                // this is a duplicate in a complex join
                return null; // indicates no object created and the db row has not been used
            }
        }

        // Instantiate Virtual Attributes
        $strVirtualPrefix = $strAliasPrefix . '__';
        $strVirtualPrefixLength = strlen($strVirtualPrefix);
        foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
            if (strncmp($strColumnName, $strVirtualPrefix, $strVirtualPrefixLength) == 0)
                $objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
        }


        // Prepare to Check for Early/Virtual Binding

        $objExpansionAliasArray = array();
        if ($objExpandAsArrayNode) {
            $objExpansionAliasArray = $objExpandAsArrayNode->ChildNodeArray;
        }

        if (!$strAliasPrefix)
            $strAliasPrefix = 'tourist_answer__';

        // Check for Tourist Early Binding
        $strAlias = $strAliasPrefix . 'tourist_id__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        if (isset ($strColumns[$strAliasName])) {
            $objExpansionNode = (empty($objExpansionAliasArray['tourist_id']) ? null : $objExpansionAliasArray['tourist_id']);
            $objToReturn->objTourist = Tourist::instantiateDbRow($objDbRow, $strAliasPrefix . 'tourist_id__', $objExpansionNode, null, $strColumnAliasArray, false, 'touristanswer', $objToReturn);
        }
        elseif ($strParentExpansionKey === 'tourist_id' && $objExpansionParent) {
            $objToReturn->objTourist = $objExpansionParent;
        }

        // Check for Question Early Binding
        $strAlias = $strAliasPrefix . 'question_id__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        if (isset ($strColumns[$strAliasName])) {
            $objExpansionNode = (empty($objExpansionAliasArray['question_id']) ? null : $objExpansionAliasArray['question_id']);
            $objToReturn->objQuestion = Question::instantiateDbRow($objDbRow, $strAliasPrefix . 'question_id__', $objExpansionNode, null, $strColumnAliasArray, false, 'touristanswer', $objToReturn);
        }
        elseif ($strParentExpansionKey === 'question_id' && $objExpansionParent) {
            $objToReturn->objQuestion = $objExpansionParent;
        }




        return $objToReturn;
    }

    /**
     * Instantiate an array of TouristAnswers from a Database Result
     * @param \QCubed\Database\ResultBase $objDbResult
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param string[] $strColumnAliasArray
     * @return TouristAnswer[]
     */
    public static function instantiateDbResult(\QCubed\Database\ResultBase $objDbResult, Node\NodeBase $objExpandAsArrayNode = null, $strColumnAliasArray = null)
    {
        $objToReturn = array();

        if (!$strColumnAliasArray)
            $strColumnAliasArray = array();

        // If blank resultset, then return empty array
        if (!$objDbResult)
            return $objToReturn;

        // Load up the return array with each row
        if ($objExpandAsArrayNode) {
            $objToReturn = array();
            $objPrevItemArray = array();
            while ($objDbRow = $objDbResult->GetNextRow()) {
                $objItem = TouristAnswer::instantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
                if ($objItem) {
                    $objToReturn[] = $objItem;
                    $objPrevItemArray[$objItem->intId][] = $objItem;
		
                }
            }
        } else {
            while ($objDbRow = $objDbResult->GetNextRow())
                $objToReturn[] = TouristAnswer::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
        }

        return $objToReturn;
    }


    /**
     * Instantiate a single TouristAnswer object from a query cursor (e.g. a DB ResultSet).
     * Cursor is automatically moved to the "next row" of the result set.
     * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
     * @param \QCubed\Database\ResultBase $objDbResult cursor resource
     * @return TouristAnswer next row resulting from the query
     */
    public static function instantiateCursor(\QCubed\Database\ResultBase $objDbResult)
    {
        // If blank resultset, then return empty result
        if (!$objDbResult) return null;

        // If empty resultset, then return empty result
        $objDbRow = $objDbResult->GetNextRow();
        if (!$objDbRow) return null;

        // We need the Column Aliases
        $strColumnAliasArray = $objDbResult->ColumnAliasArray;
        if (!$strColumnAliasArray) $strColumnAliasArray = array();

        // Load up the return result with a row and return it
        return TouristAnswer::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
    }



    ///////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Single Load and Array)
    ///////////////////////////////////////////////////

    /**
     * Load a single TouristAnswer object,
     * by Id Index(es)
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return TouristAnswer
    */
    public static function loadById($intId, $objOptionalClauses = null)
    {
        return TouristAnswer::QuerySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::TouristAnswer()->Id, $intId)
            ),
            $objOptionalClauses
        );
    }

    /**
     * Load an array of TouristAnswer objects,
     * by TouristId Index(es)
     * @param integer $intTouristId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return TouristAnswer[]
    */
    public static function loadArrayByTouristId($intTouristId, $objOptionalClauses = null)
    {
        // Call TouristAnswer::QueryArray to perform the LoadArrayByTouristId query
        try {
            return TouristAnswer::QueryArray(
                QQ::Equal(QQN::TouristAnswer()->TouristId, $intTouristId),
                $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count TouristAnswers
     * by TouristId Index(es)
     * @param integer $intTouristId
     * @return int
    */
    public static function countByTouristId($intTouristId)
    {
        // Call TouristAnswer::QueryCount to perform the CountByTouristId query
        return TouristAnswer::QueryCount(
            QQ::Equal(QQN::TouristAnswer()->TouristId, $intTouristId)
        );
    }

    /**
     * Load an array of TouristAnswer objects,
     * by QuestionId Index(es)
     * @param integer $intQuestionId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return TouristAnswer[]
    */
    public static function loadArrayByQuestionId($intQuestionId, $objOptionalClauses = null)
    {
        // Call TouristAnswer::QueryArray to perform the LoadArrayByQuestionId query
        try {
            return TouristAnswer::QueryArray(
                QQ::Equal(QQN::TouristAnswer()->QuestionId, $intQuestionId),
                $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count TouristAnswers
     * by QuestionId Index(es)
     * @param integer $intQuestionId
     * @return int
    */
    public static function countByQuestionId($intQuestionId)
    {
        // Call TouristAnswer::QueryCount to perform the CountByQuestionId query
        return TouristAnswer::QueryCount(
            QQ::Equal(QQN::TouristAnswer()->QuestionId, $intQuestionId)
        );
    }


    ////////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Array via Many to Many)
    ////////////////////////////////////////////////////




    //////////////////////////
    // SAVE, DELETE AND RELOAD
    //////////////////////////
    

    /**
    * Save this TouristAnswer
    * @param bool $blnForceInsert
    * @param bool $blnForceUpdate
    * @throws Caller
    * @return int
    */
    public function save($blnForceInsert = false, $blnForceUpdate = false)
    {
        $mixToReturn = null;
        try {
            if ((!$this->__blnRestored && !$blnForceUpdate) || ($blnForceInsert)) {
                $mixToReturn = $this->Insert();
            } else {
                $this->Update($blnForceUpdate);
            }
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
        // Update __blnRestored and any Non-Identity PK Columns (if applicable)
        $this->__blnRestored = true;

        $this->deleteFromCache();

        $this->__blnDirty = null; // reset dirty values

        return $mixToReturn;
    }

    /**
     * Insert into TouristAnswer
     */
    protected function insert()
    {
        $mixToReturn = null;
        $objDatabase = TouristAnswer::GetDatabase();

        $objDatabase->NonQuery('
            INSERT INTO `tourist_answer` (
							`tourist_id`,
							`question_id`,
							`answer`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intTouristId) . ',
							' . $objDatabase->SqlVariable($this->intQuestionId) . ',
							' . $objDatabase->SqlVariable($this->strAnswer) . '
						)
        ');
        // Update Identity column and return its value
        $mixToReturn = $this->intId = $objDatabase->InsertId('tourist_answer', 'id');
        $this->__blnValid[self::ID_FIELD] = true;


        static::broadcastInsert($this->PrimaryKey());

        return $mixToReturn;
    }

   /**
    * Update this TouristAnswer
    * @param bool $blnForceUpdate
    */
    protected function update($blnForceUpdate = false)
    {
        $objDatabase = static::getDatabase();

        if (empty($this->__blnDirty)) {
            return; // nothing has changed
        }

        $strValues = $this->GetValueClause();

        $strSql = '
        UPDATE
            `tourist_answer`
        SET
        ' . $strValues . '

        WHERE
                `id` = ' . $objDatabase->SqlVariable($this->intId);
        $objDatabase->NonQuery($strSql);
		static::broadcastUpdate($this->PrimaryKey(), array_keys($this->__blnDirty));
	}

   /**
	* Creates a value clause for the currently changed fields.
	*
	* @return string
	*/
	protected function getValueClause()
    {
		$values = [];
		$objDatabase = static::getDatabase();

		if (isset($this->__blnDirty[self::TOURIST_ID_FIELD])) {
			$strCol = '`tourist_id`';
			$strValue = $objDatabase->sqlVariable($this->intTouristId);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::QUESTION_ID_FIELD])) {
			$strCol = '`question_id`';
			$strValue = $objDatabase->sqlVariable($this->intQuestionId);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::ANSWER_FIELD])) {
			$strCol = '`answer`';
			$strValue = $objDatabase->sqlVariable($this->strAnswer);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if ($values) {
			return implode(",\n", $values);
		}
		else {
			return "";
		}
	}



    /**
     * Delete this TouristAnswer
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
     */
    public function delete()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Cannot delete this TouristAnswer with an unset primary key.');

        // Get the Database Object for this Class
        $objDatabase = TouristAnswer::GetDatabase();


        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `tourist_answer`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($this->intId) . '');

        $this->DeleteFromCache();
        static::BroadcastDelete($this->PrimaryKey());
    }

    /**
     * Delete all TouristAnswers
     * @return void
     */
    public static function deleteAll()
    {
        // Get the Database Object for this Class
        $objDatabase = TouristAnswer::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            DELETE FROM
                `tourist_answer`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    /**
     * Truncate tourist_answer table
     * @return void
     */
    public static function truncate()
    {
        // Get the Database Object for this Class
        $objDatabase = TouristAnswer::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            TRUNCATE `tourist_answer`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    
    /**
	 * Reload this TouristAnswer from the database.
     * @param iClause[]|null $clauses
     * @throws Caller
	 * @return void
	 */
	public function reload($clauses = null)
    {
		// Make sure we are actually Restored from the database
		if (!$this->__blnRestored)
			throw new Caller('Cannot call Reload() on a new, unsaved TouristAnswer object.');

		// throw away all previous state of the object
		$this->DeleteFromCache();
		$this->__blnValid = null;
		$this->__blnDirty = null;

		// Reload the Object
		$objReloaded = TouristAnswer::Load($this->intId, $clauses);

		// Update $this's local variables to match
		$this->__blnValid[self::ID_FIELD] = true;
		if (isset($objReloaded->__blnValid[self::TOURIST_ID_FIELD])) {
			$this->intTouristId = $objReloaded->intTouristId;
			$this->objTourist = $objReloaded->objTourist;
			$this->__blnValid[self::TOURIST_ID_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::QUESTION_ID_FIELD])) {
			$this->intQuestionId = $objReloaded->intQuestionId;
			$this->objQuestion = $objReloaded->objQuestion;
			$this->__blnValid[self::QUESTION_ID_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::ANSWER_FIELD])) {
			$this->strAnswer = $objReloaded->strAnswer;
			$this->__blnValid[self::ANSWER_FIELD] = true;
		}
	}
    ////////////////////
    // UTILITIES
    ////////////////////
    
    /**
     *  Return an array of TouristAnswers keyed by the unique Id property.
     *	@param TouristAnswer[]
     *	@return TouristAnswer[]
     **/
    public static function keyTouristAnswersById($touristanswers) {
        if (empty($touristanswers)) {
            return $touristanswers;
        }
        $ret = [];
        foreach ($touristanswers as $touristanswer) {
            $ret[$touristanswer->intId] = $touristanswer;
        }
        return $ret;
    }

    
    //////////////////////////////////////////////////////////////
    //															//
    //				GETTERS and SETTERS  						//
    //															//
    //////////////////////////////////////////////////////////////

   /**
	* Gets the value of intId (Read-Only PK)
	* @return integer
	*/
	public function getId()
    {
		return $this->intId;
	}




   /**
	* Gets the value of intTouristId 
	* @throws Caller
	* @return integer
	*/
	public function getTouristId()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::TOURIST_ID_FIELD])) {
			throw new Caller("TouristId was not selected in the most recent query and is not valid.");
		}
		return $this->intTouristId;
	}


    /**
     * Gets the value of the Tourist object referenced by intTouristId 
     * If the object is not loaded, will load the object (caching it) before returning it.
     * @throws Caller
     * @return Tourist
     */
     public function getTourist()
     {
 		if ($this->__blnRestored && empty($this->__blnValid[self::TOURIST_ID_FIELD])) {
			throw new Caller("TouristId was not selected in the most recent query and is not valid.");
		}
        if ((!$this->objTourist) && (!is_null($this->intTouristId))) {
            $this->objTourist = Tourist::Load($this->intTouristId);
        }
        return $this->objTourist;
     }



   /**
	* Sets the value of intTouristId 
	* Returns $this to allow chaining of setters.
	* @param integer|null $intTouristId
    * @throws Caller
	* @return TouristAnswer
	*/
	public function setTouristId($intTouristId)
    {
		$intTouristId = Type::Cast($intTouristId, QCubed\Type::INTEGER);

		if ($this->intTouristId !== $intTouristId) {
			$this->objTourist = null; // remove the associated object
			$this->intTouristId = $intTouristId;
			$this->__blnDirty[self::TOURIST_ID_FIELD] = true;
		}
		$this->__blnValid[self::TOURIST_ID_FIELD] = true;
		return $this; // allows chaining
	}

    /**
     * Sets the value of the Tourist object referenced by intTouristId 
     * @param null|Tourist $objTourist
     * @throws Caller
     * @return TouristAnswer
     */
    public function setTourist($objTourist) {
        if (is_null($objTourist)) {
            $this->setTouristId(null);
        } else {
            $objTourist = Type::Cast($objTourist, 'Tourist');

            // Make sure its a SAVED Tourist object
            if (is_null($objTourist->Id)) {
                throw new Caller('Unable to set an unsaved Tourist for this TouristAnswer');
            }

            // Update Local Member Variables
            $this->setTouristId($objTourist->getId());
            $this->objTourist = $objTourist;
        }
        return $this;
    }

   /**
	* Gets the value of intQuestionId 
	* @throws Caller
	* @return integer
	*/
	public function getQuestionId()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::QUESTION_ID_FIELD])) {
			throw new Caller("QuestionId was not selected in the most recent query and is not valid.");
		}
		return $this->intQuestionId;
	}


    /**
     * Gets the value of the Question object referenced by intQuestionId 
     * If the object is not loaded, will load the object (caching it) before returning it.
     * @throws Caller
     * @return Question
     */
     public function getQuestion()
     {
 		if ($this->__blnRestored && empty($this->__blnValid[self::QUESTION_ID_FIELD])) {
			throw new Caller("QuestionId was not selected in the most recent query and is not valid.");
		}
        if ((!$this->objQuestion) && (!is_null($this->intQuestionId))) {
            $this->objQuestion = Question::Load($this->intQuestionId);
        }
        return $this->objQuestion;
     }



   /**
	* Sets the value of intQuestionId 
	* Returns $this to allow chaining of setters.
	* @param integer|null $intQuestionId
    * @throws Caller
	* @return TouristAnswer
	*/
	public function setQuestionId($intQuestionId)
    {
		$intQuestionId = Type::Cast($intQuestionId, QCubed\Type::INTEGER);

		if ($this->intQuestionId !== $intQuestionId) {
			$this->objQuestion = null; // remove the associated object
			$this->intQuestionId = $intQuestionId;
			$this->__blnDirty[self::QUESTION_ID_FIELD] = true;
		}
		$this->__blnValid[self::QUESTION_ID_FIELD] = true;
		return $this; // allows chaining
	}

    /**
     * Sets the value of the Question object referenced by intQuestionId 
     * @param null|Question $objQuestion
     * @throws Caller
     * @return TouristAnswer
     */
    public function setQuestion($objQuestion) {
        if (is_null($objQuestion)) {
            $this->setQuestionId(null);
        } else {
            $objQuestion = Type::Cast($objQuestion, 'Question');

            // Make sure its a SAVED Question object
            if (is_null($objQuestion->Id)) {
                throw new Caller('Unable to set an unsaved Question for this TouristAnswer');
            }

            // Update Local Member Variables
            $this->setQuestionId($objQuestion->getId());
            $this->objQuestion = $objQuestion;
        }
        return $this;
    }

   /**
	* Gets the value of strAnswer 
	* @throws Caller
	* @return string
	*/
	public function getAnswer()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::ANSWER_FIELD])) {
			throw new Caller("Answer was not selected in the most recent query and is not valid.");
		}
		return $this->strAnswer;
	}




   /**
	* Sets the value of strAnswer 
	* Returns $this to allow chaining of setters.
	* @param string|null $strAnswer
    * @throws Caller
	* @return TouristAnswer
	*/
	public function setAnswer($strAnswer)
    {
		$strAnswer = Type::Cast($strAnswer, QCubed\Type::STRING);

		if ($this->strAnswer !== $strAnswer) {
			$this->strAnswer = $strAnswer;
			$this->__blnDirty[self::ANSWER_FIELD] = true;
		}
		$this->__blnValid[self::ANSWER_FIELD] = true;
		return $this; // allows chaining
	}


    /**
    * Copying an object creates a copy of the object with all external references nulled and null primary keys in
    * preparation for saving or further processing.
   	*/
   	public function copy()
    {
		$objCopy = clone $this;
		$objCopy->__blnRestored = false;

		// Make sure all valid data is dirty so it will be saved
		foreach ($this->__blnValid as $key=>$val) {
			$objCopy->__blnDirty[$key] = $val;
		}

   		// Nullify primary keys so they will be saved as a different object
		$objCopy->intId = null;



		return $objCopy;
	}

    
   /**
	* The current record has just been inserted into the table. Let everyone know.
	* @param integer	$pk Primary key of record just inserted.
	*/
	protected static function broadcastInsert($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'tourist_answer');
        }
	}

   /**
	* The current record has just been updated. Let everyone know. $this->__blnDirty has the fields
    * that were just updated.
	* @param integer	$pk Primary key of record just updated.
	* @param string[] $fields array of field names that were modified.
	*/
	protected static function broadcastUpdate($pk, $fields)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'tourist_answer');
        }
	}

   /**
	* The current record has just been deleted. Let everyone know.
	* @param integer	$pk Primary key of record just deleted.
	*/
	protected static function broadcastDelete($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'tourist_answer');
        }
	}

   /**
	* All records have just been deleted. Let everyone know.
	*/
	protected static function broadcastDeleteAll()
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'tourist_answer');
        }
	}

   /**
    * An association table entry has just been added. Let everyone know.
    *
    * @params string $strTableName
    * @param integer	$pk1
    * @param mixed	$pk2
    */
    protected static function broadcastAssociationAdded($strTableName, $pk1, $pk2)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, $strTableName);
        }
    }

   /**
    * An association table entry has just been removed. Let everyone know.
    *
    * @params string $strTableName
    * @param integer|null$pk1    Null if we are removing all associations
    * @param mixed|null	$pk2            Null if we are removing all associations
    */
    protected static function broadcastAssociationRemoved($strTableName, $pk1 = null, $pk2 = null)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, $strTableName);
        }
    }

    ////////////////////
    // PUBLIC OVERRIDERS
    ////////////////////

    
    /**
     * Override method to perform a property "Get"
     * This will get the value of $strName
     *
     * @param string $strName Name of the property to get
     * @throws Caller
     * @return mixed
     */
    public function __get($strName)
    {
        switch ($strName) {

            ////////////////////////////
            // Virtual Object References (Many to Many and Reverse References)
            // (If restored via a "Many-to" expansion)
            ////////////////////////////


            case '__Restored':
                return $this->__blnRestored;

            default:
                try {
                    // Use getter if it exists
                    $strMethod = 'get' . $strName;
                    if (method_exists($this, $strMethod)) {
                        return $this->$strMethod();
                    }

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
     * @param string $mixValue New value of the property
     * @throws Caller
     * @return void
     */
    public function __set($strName, $mixValue)
    {
        try {

            // Use setter if it exists
            $strMethod = 'set' . $strName;
            if (method_exists($this, $strMethod)) {
                $this->$strMethod($mixValue);
            } else {
                parent::__set($strName, $mixValue);
            }
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }


    
    /**
     * Lookup a VirtualAttribute value (if applicable).  Returns NULL if none found.
     * @param string $strName
     * @return string|null
     */
    public function getVirtualAttribute($strName)
    {
        $strName = QQ::GetVirtualAlias($strName);
        if (isset($this->__strVirtualAttributeArray[$strName])) {
            return $this->__strVirtualAttributeArray[$strName];
        }
        return null;
    }

    /**
     * Returns true if a virtual attribute exists. Useful for telling that the attribute exists, but is null.
     * @param string $strName
     * @return boolean
     */
    public function hasVirtualAttribute($strName)
    {
        $strName = QQ::GetVirtualAlias($strName);
        if (array_key_exists($strName, $this->__strVirtualAttributeArray)) {
            return true;
        }
        return false;
    }

    
    ///////////////////////////////
    // ASSOCIATED OBJECTS' METHODS
    ///////////////////////////////



    
    ///////////////////////////////
    // METHODS TO EXTRACT INFO ABOUT THE CLASS
    ///////////////////////////////

    /**
     * Static method to retrieve the Table name that owns this class.
     * @return string Name of the table from which this class has been created.
     */
    public static function getTableName()
    {
        return "tourist_answer";
    }

    /**
     * Static method to retrieve the Database name from which this class has been created.
     * @return string Name of the database from which this class has been created.
     */
    public static function getDatabaseName()
    {
        return self::GetDatabase()->Database;
    }

    /**
     * Static method to retrieve the Database index in the configuration.inc.php file.
     * This can be useful when there are two databases of the same name which create
     * confusion for the developer. There are no internal uses of this function but are
     * here to help retrieve info if need be!
     * @return int position or index of the database in the config file.
     */
    public static function getDatabaseIndex()
    {
        return 1;
    }

    /**
     * Return the base node corresponding to this table.
     * @return NodeTouristAnswer
     */
    public static function baseNode()
    {
        return QQN::TouristAnswer();
    }

    
    ////////////////////////////////////////
    // METHODS for SOAP-BASED WEB SERVICES
    ////////////////////////////////////////

    public static function getSoapComplexTypeXml()
    {
        $strToReturn = '<complexType name="TouristAnswer"><sequence>';
        $strToReturn .= '<element name="Id" type="xsd:int"/>';
        $strToReturn .= '<element name="Tourist" type="xsd1:Tourist"/>';
        $strToReturn .= '<element name="Question" type="xsd1:Question"/>';
        $strToReturn .= '<element name="Answer" type="xsd:string"/>';
        $strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
        $strToReturn .= '</sequence></complexType>';
        return $strToReturn;
    }

    public static function alterSoapComplexTypeArray(&$strComplexTypeArray)
    {
        if (!array_key_exists('TouristAnswer', $strComplexTypeArray)) {
            $strComplexTypeArray['TouristAnswer'] = TouristAnswer::GetSoapComplexTypeXml();
            Tourist::AlterSoapComplexTypeArray($strComplexTypeArray);
            Question::AlterSoapComplexTypeArray($strComplexTypeArray);
        }
    }

    public static function getArrayFromSoapArray($objSoapArray)
    {
        $objArrayToReturn = array();

        foreach ($objSoapArray as $objSoapObject)
            array_push($objArrayToReturn, TouristAnswer::GetObjectFromSoapObject($objSoapObject));

        return $objArrayToReturn;
    }

    public static function getObjectFromSoapObject($objSoapObject)
    {
        $objToReturn = new TouristAnswer();
        if (property_exists($objSoapObject, 'Id'))
            $objToReturn->intId = $objSoapObject->Id;
        if ((property_exists($objSoapObject, 'Tourist')) &&
            ($objSoapObject->Tourist))
            $objToReturn->Tourist = Tourist::GetObjectFromSoapObject($objSoapObject->Tourist);
        if ((property_exists($objSoapObject, 'Question')) &&
            ($objSoapObject->Question))
            $objToReturn->Question = Question::GetObjectFromSoapObject($objSoapObject->Question);
        if (property_exists($objSoapObject, 'Answer'))
            $objToReturn->strAnswer = $objSoapObject->Answer;
        if (property_exists($objSoapObject, '__blnRestored'))
            $objToReturn->__blnRestored = $objSoapObject->__blnRestored;
        return $objToReturn;
    }

    public static function getSoapArrayFromArray($objArray)
    {
        if (!$objArray)
            return null;

        $objArrayToReturn = array();

        foreach ($objArray as $objObject)
            array_push($objArrayToReturn, TouristAnswer::GetSoapObjectFromObject($objObject, true));

        return unserialize(serialize($objArrayToReturn));
    }

    public static function getSoapObjectFromObject($objObject, $blnBindRelatedObjects)
    {
        if ($objObject->objTourist)
            $objObject->objTourist = Tourist::GetSoapObjectFromObject($objObject->objTourist, false);
        else if (!$blnBindRelatedObjects)
            $objObject->intTouristId = null;
        if ($objObject->objQuestion)
            $objObject->objQuestion = Question::GetSoapObjectFromObject($objObject->objQuestion, false);
        else if (!$blnBindRelatedObjects)
            $objObject->intQuestionId = null;
        return $objObject;
    }


    
    // this function is required for objects that implement the
    // IteratorAggregate interface
    public function getIterator()
    {
        $iArray = array();

        if (isset($this->__blnValid[self::ID_FIELD])) {
            $iArray['Id'] = $this->intId;
        }
        if (isset($this->__blnValid[self::TOURIST_ID_FIELD])) {
            $iArray['TouristId'] = $this->intTouristId;
        }
        if (isset($this->__blnValid[self::QUESTION_ID_FIELD])) {
            $iArray['QuestionId'] = $this->intQuestionId;
        }
        if (isset($this->__blnValid[self::ANSWER_FIELD])) {
            $iArray['Answer'] = $this->strAnswer;
        }
        return new ArrayIterator($iArray);
    }

    /**
     *   @deprecated. Just call json_encode on the object. See the jsonSerialize function for the result.
    /*/
    public function getJson()
    {
        return json_encode($this->getIterator());
    }

    /**
     * Default "toJsObject" handler
     * Specifies how the object should be displayed in JQuery UI lists and menus. Note that these lists use
     * value and label differently.
     *
     * value 	= The short form of what to display in the list and selection.
     * label 	= [optional] If defined, is what is displayed in the menu
     * id 		= Primary key of object.
     *
     * @return string
     */
    public function toJsObject ()
    {
        return JavaScriptHelper::toJsObject(array('value' => $this->__toString(), 'id' =>  $this->intId ));
    }

    /**
     * Default "jsonSerialize" handler
     * Specifies how the object should be serialized using json_encode.
     * Control the values that are output by using QQ::Select to control which
     * fields are valid, and QQ::Expand to control embedded objects.
     * WARNING: If an object is found in short-term cache, it will be used instead of the queried object and may
     * contain data fields that were fetched earlier. To really control what fields exist in this object, preceed
     * any query calls (like Load or QueryArray), with a call to TouristAnswer::ClearCache()
     *
     * @return array An array that is json serializable
     */
    public function jsonSerialize ()
    {
        $a = [];
        if (isset($this->__blnValid[self::ID_FIELD])) {
            $a['id'] = $this->intId;
        }
        if (isset($this->objTourist)) {
            $a['tourist'] = $this->objTourist;
        } elseif (isset($this->__blnValid[self::TOURIST_ID_FIELD])) {
            $a['tourist_id'] = $this->intTouristId;
        }
        if (isset($this->objQuestion)) {
            $a['question'] = $this->objQuestion;
        } elseif (isset($this->__blnValid[self::QUESTION_ID_FIELD])) {
            $a['question_id'] = $this->intQuestionId;
        }
        if (isset($this->__blnValid[self::ANSWER_FIELD])) {
            $a['answer'] = $this->strAnswer;
        }
        return $a;
    }



    

}



/////////////////////////////////////
// ADDITIONAL CLASSES for QCubed QUERY
/////////////////////////////////////

/**
 * @property-read Node\Column $Id
 * @property-read Node\Column $TouristId
 * @property-read NodeTourist $Tourist
 * @property-read Node\Column $QuestionId
 * @property-read NodeQuestion $Question
 * @property-read Node\Column $Answer
 * @property-read Node\Column $_PrimaryKeyNode
 **/
class NodeTouristAnswer extends Node\Table {
    protected $strTableName = 'tourist_answer';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'TouristAnswer';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "tourist_id",
            "question_id",
            "answer",
        ];
    }

    /**
    * @return array
    */
    public function primaryKeyFields() {
        return [
            "id",
        ];
    }

   /**
    * @return AbstractDatabase
    */
    protected function database() {
        return \QCubed\Database\Service::getDatabase(1);
    }


    /**
    * __get Magic Method
    *
    * @param string $strName
    * @throws Caller
    */
    public function __get($strName) {
        switch ($strName) {
            case 'Id':
                return new Node\Column('id', 'Id', 'Integer', $this);
            case 'TouristId':
                return new Node\Column('tourist_id', 'TouristId', 'Integer', $this);
            case 'Tourist':
                return new NodeTourist('tourist_id', 'Tourist', 'Integer', $this);
            case 'QuestionId':
                return new Node\Column('question_id', 'QuestionId', 'Integer', $this);
            case 'Question':
                return new NodeQuestion('question_id', 'Question', 'Integer', $this);
            case 'Answer':
                return new Node\Column('answer', 'Answer', 'VarChar', $this);

            case '_PrimaryKeyNode':
                return new Node\Column('id', 'Id', 'Integer', $this);
            default:
                try {
                    return parent::__get($strName);
                } catch (Caller $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
        }
    }
}

/**
 * @property-read Node\Column $Id
 * @property-read Node\Column $TouristId
 * @property-read NodeTourist $Tourist
 * @property-read Node\Column $QuestionId
 * @property-read NodeQuestion $Question
 * @property-read Node\Column $Answer

 * @property-read Node\Column $_PrimaryKeyNode
 **/
class ReverseReferenceNodeTouristAnswer extends Node\ReverseReference {
    protected $strTableName = 'tourist_answer';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'TouristAnswer';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "tourist_id",
            "question_id",
            "answer",
        ];
    }

    /**
    * @return array
    */
    public function primaryKeyFields() {
        return [
            "id",
        ];
    }

    /**
    * __get Magic Method
    *
    * @param string $strName
    * @throws Caller
    */
    public function __get($strName) {
        switch ($strName) {
            case 'Id':
                return new Node\Column('id', 'Id', 'Integer', $this);
            case 'TouristId':
                return new Node\Column('tourist_id', 'TouristId', 'Integer', $this);
            case 'Tourist':
                return new NodeTourist('tourist_id', 'Tourist', 'Integer', $this);
            case 'QuestionId':
                return new Node\Column('question_id', 'QuestionId', 'Integer', $this);
            case 'Question':
                return new NodeQuestion('question_id', 'Question', 'Integer', $this);
            case 'Answer':
                return new Node\Column('answer', 'Answer', 'VarChar', $this);

            case '_PrimaryKeyNode':
                return new Node\Column('id', 'Id', 'Integer', $this);
            default:
                try {
                    return parent::__get($strName);
                } catch (Caller $objExc) {
                    $objExc->incrementOffset();
                    throw $objExc;
                }
        }
    }
}
