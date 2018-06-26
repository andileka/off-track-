<?php
/**
 * Generated Log base class file
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
 * Class LogGen
 *
 * The abstract LogGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the Log subclass which
 * extends this LogGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the Log class.
 *
 * @package My QCubed Application
 * @subpackage ModelGen
 * @property-read integer $Id the value of the id column (Read-Only PK)
 * @property integer $UserId the value of the user_id column 
 * @property string $Action the value of the action column (Not Null)
 * @property string $Value the value of the value column 
 * @property \QCubed\QDateTime $Datetime the value of the datetime column 
 * @property integer $Ip the value of the ip column 
 * @property string $Logcol the value of the logcol column 
 * @property User $User the value of the User object referenced by intUserId 
 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
 */
abstract class LogGen extends \QCubed\ObjectBase implements IteratorAggregate, JsonSerializable {

    use ModelTrait;

    /** @var boolean Set to false in superclass to save a little time if this db object should not be watched for changes. */
    public static $blnWatchChanges = true;

    /** @var Log[] Short term cached Log objects */
    protected static $objCacheArray = array();

    ///////////////////////////////////////////////////////////////////////
    // PROTECTED AND PRIVATE MEMBER VARIABLES and CONSTS
    ///////////////////////////////////////////////////////////////////////

    /**
     * Protected member variable that maps to the database PK Identity column log.id
     * @var integer intId
     */
    private $intId;

    const ID_DEFAULT = null;
    const ID_FIELD = 'id';


    /**
     * Protected member variable that maps to the database column log.user_id
     * @var integer intUserId
     */
    private $intUserId;

    const USER_ID_DEFAULT = null;
    const USER_ID_FIELD = 'user_id';


    /**
     * Protected member variable that maps to the database column log.action
     * @var string strAction
     */
    private $strAction;
    const ActionMaxLength = 45; // Deprecated
    const ACTION_MAX_LENGTH = 45;

    const ACTION_DEFAULT = null;
    const ACTION_FIELD = 'action';


    /**
     * Protected member variable that maps to the database column log.value
     * @var string strValue
     */
    private $strValue;
    const ValueMaxLength = 255; // Deprecated
    const VALUE_MAX_LENGTH = 255;

    const VALUE_DEFAULT = null;
    const VALUE_FIELD = 'value';


    /**
     * Protected member variable that maps to the database column log.datetime
     * @var \QCubed\QDateTime dttDatetime
     */
    private $dttDatetime;

    const DATETIME_DEFAULT = null;
    const DATETIME_FIELD = 'datetime';


    /**
     * Protected member variable that maps to the database column log.ip
     * @var integer intIp
     */
    private $intIp;

    const IP_DEFAULT = null;
    const IP_FIELD = 'ip';


    /**
     * Protected member variable that maps to the database column log.logcol
     * @var string strLogcol
     */
    private $strLogcol;
    const LogcolMaxLength = 45; // Deprecated
    const LOGCOL_MAX_LENGTH = 45;

    const LOGCOL_DEFAULT = null;
    const LOGCOL_FIELD = 'logcol';


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
     * in the database column log.user_id.
     *
     * NOTE: Always use the User property getter to correctly retrieve this User object.
     * (Because this class implements late binding, this variable reference MAY be null.)
     * @var User objUser
     */
    protected $objUser;



    /**
     * Construct a new Log object.
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
        $this->intUserId = Log::USER_ID_DEFAULT;
        $this->__blnValid[self::USER_ID_FIELD] = true;
        $this->strAction = Log::ACTION_DEFAULT;
        $this->__blnValid[self::ACTION_FIELD] = true;
        $this->strValue = Log::VALUE_DEFAULT;
        $this->__blnValid[self::VALUE_FIELD] = true;
        $this->dttDatetime = (Log::DATETIME_DEFAULT === null)?null:new QDateTime(Log::DATETIME_DEFAULT);
        $this->__blnValid[self::DATETIME_FIELD] = true;
        $this->intIp = Log::IP_DEFAULT;
        $this->__blnValid[self::IP_FIELD] = true;
        $this->strLogcol = Log::LOGCOL_DEFAULT;
        $this->__blnValid[self::LOGCOL_FIELD] = true;
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
     * Load a Log from PK Info
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return Log
     */
    public static function load($intId, $objOptionalClauses = null)
    {
        if (!$objOptionalClauses) {
            $objCachedObject = static::getFromCache ($intId);
            if ($objCachedObject) return $objCachedObject;
        }

        // Use QuerySingle to Perform the Query
        $objToReturn = Log::querySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::Log()->Id, $intId)
            ),
            $objOptionalClauses
        );
        return $objToReturn;
    }


    /**
     * Load all Logs
     * @param iClause[]|null $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return Log[]
     * @throws Caller
     */
    public static function loadAll($objOptionalClauses = null)
    {
        if (func_num_args() > 1) {
            throw new Caller("LoadAll must be called with an array of optional clauses as a single argument");
        }
        // Call Log::queryArray to perform the LoadAll query
        try {
            return Log::queryArray(QQ::All(), $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count all Logs
     * @return int
     */
    public static function countAll()
    {
        // Call Log::queryCount to perform the CountAll query
        return Log::queryCount(QQ::All());
    }


    /**
     * Static Qcubed Query method to query for a single Log object.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return Log the queried object
     */
    public static function querySingle(iCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null)
    {
        return static::_QuerySingle($objConditions, $objOptionalClauses, $mixParameterArray);
    }

    /**
     * Static Qcubed Query method to query for an array of Log objects.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return Log[] the queried objects as an array
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
        $clauses[] = QQ::Select(QQN::Log()->Id);
        $objLogs = self::QueryArray($objConditions, $clauses);
        $pks = [];
        foreach ($objLogs as $objLog) {
            $pks[] = $objLog->intId;
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
    * @return Log the queried object
    */
    public static function getFromCache($key)
    {
        return static::_GetFromCache($key);
    }


    /**
     * Instantiate a Log from a Database Row.
     * Takes in an optional strAliasPrefix, used in case another Object::instantiateDbRow
     * is calling this Log::instantiateDbRow in order to perform
     * early binding on referenced objects.
     * @param \QCubed\Database\RowBase $objDbRow
     * @param string $strAliasPrefix
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param array|null $objPreviousItemArray Used by expansion code to aid in expanding arrays
     * @param string[] $strColumnAliasArray Array of column aliases mapping names in the query to items in the object
     * @param boolean $blnCheckDuplicate Used by ExpandArray to indicate we should not create a new object if this is a duplicate of a previoius object
     * @param string $strParentExpansionKey If this is part of an expansion, indicates what the parent item is
     * @param mixed $objExpansionParent If this is part of an expansion, is the object corresponding to the key so that we can refer back to the parent object
     * @return mixed Either a Log, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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
            // Create a new instance of the Log object
            $objToReturn = new Log(false);
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
            $strAlias = $strAliasPrefix . 'user_id';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = (integer)$mixVal;
                }
                $objToReturn->intUserId = $mixVal;
                $objToReturn->__blnValid[self::USER_ID_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'action';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strAction = $mixVal;
                $objToReturn->__blnValid[self::ACTION_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'value';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strValue = $mixVal;
                $objToReturn->__blnValid[self::VALUE_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'datetime';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = new \QCubed\QDateTime($mixVal);
                }
                $objToReturn->dttDatetime = $mixVal;
                $objToReturn->__blnValid[self::DATETIME_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'ip';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = (integer)$mixVal;
                }
                $objToReturn->intIp = $mixVal;
                $objToReturn->__blnValid[self::IP_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'logcol';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strLogcol = $mixVal;
                $objToReturn->__blnValid[self::LOGCOL_FIELD] = true;
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
            $strAliasPrefix = 'log__';

        // Check for User Early Binding
        $strAlias = $strAliasPrefix . 'user_id__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        if (isset ($strColumns[$strAliasName])) {
            $objExpansionNode = (empty($objExpansionAliasArray['user_id']) ? null : $objExpansionAliasArray['user_id']);
            $objToReturn->objUser = User::instantiateDbRow($objDbRow, $strAliasPrefix . 'user_id__', $objExpansionNode, null, $strColumnAliasArray, false, 'log', $objToReturn);
        }
        elseif ($strParentExpansionKey === 'user_id' && $objExpansionParent) {
            $objToReturn->objUser = $objExpansionParent;
        }




        return $objToReturn;
    }

    /**
     * Instantiate an array of Logs from a Database Result
     * @param \QCubed\Database\ResultBase $objDbResult
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param string[] $strColumnAliasArray
     * @return Log[]
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
                $objItem = Log::instantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
                if ($objItem) {
                    $objToReturn[] = $objItem;
                    $objPrevItemArray[$objItem->intId][] = $objItem;
		
                }
            }
        } else {
            while ($objDbRow = $objDbResult->GetNextRow())
                $objToReturn[] = Log::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
        }

        return $objToReturn;
    }


    /**
     * Instantiate a single Log object from a query cursor (e.g. a DB ResultSet).
     * Cursor is automatically moved to the "next row" of the result set.
     * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
     * @param \QCubed\Database\ResultBase $objDbResult cursor resource
     * @return Log next row resulting from the query
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
        return Log::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
    }



    ///////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Single Load and Array)
    ///////////////////////////////////////////////////

    /**
     * Load a single Log object,
     * by Id Index(es)
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return Log
    */
    public static function loadById($intId, $objOptionalClauses = null)
    {
        return Log::QuerySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::Log()->Id, $intId)
            ),
            $objOptionalClauses
        );
    }

    /**
     * Load an array of Log objects,
     * by UserId Index(es)
     * @param integer $intUserId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return Log[]
    */
    public static function loadArrayByUserId($intUserId, $objOptionalClauses = null)
    {
        // Call Log::QueryArray to perform the LoadArrayByUserId query
        try {
            return Log::QueryArray(
                QQ::Equal(QQN::Log()->UserId, $intUserId),
                $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count Logs
     * by UserId Index(es)
     * @param integer $intUserId
     * @return int
    */
    public static function countByUserId($intUserId)
    {
        // Call Log::QueryCount to perform the CountByUserId query
        return Log::QueryCount(
            QQ::Equal(QQN::Log()->UserId, $intUserId)
        );
    }


    ////////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Array via Many to Many)
    ////////////////////////////////////////////////////




    //////////////////////////
    // SAVE, DELETE AND RELOAD
    //////////////////////////
    

    /**
    * Save this Log
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
     * Insert into Log
     */
    protected function insert()
    {
        $mixToReturn = null;
        $objDatabase = Log::GetDatabase();

        $objDatabase->NonQuery('
            INSERT INTO `log` (
							`user_id`,
							`action`,
							`value`,
							`datetime`,
							`ip`,
							`logcol`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intUserId) . ',
							' . $objDatabase->SqlVariable($this->strAction) . ',
							' . $objDatabase->SqlVariable($this->strValue) . ',
							' . $objDatabase->SqlVariable($this->dttDatetime) . ',
							' . $objDatabase->SqlVariable($this->intIp) . ',
							' . $objDatabase->SqlVariable($this->strLogcol) . '
						)
        ');
        // Update Identity column and return its value
        $mixToReturn = $this->intId = $objDatabase->InsertId('log', 'id');
        $this->__blnValid[self::ID_FIELD] = true;


        static::broadcastInsert($this->PrimaryKey());

        return $mixToReturn;
    }

   /**
    * Update this Log
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
            `log`
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

		if (isset($this->__blnDirty[self::USER_ID_FIELD])) {
			$strCol = '`user_id`';
			$strValue = $objDatabase->sqlVariable($this->intUserId);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::ACTION_FIELD])) {
			$strCol = '`action`';
			$strValue = $objDatabase->sqlVariable($this->strAction);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::VALUE_FIELD])) {
			$strCol = '`value`';
			$strValue = $objDatabase->sqlVariable($this->strValue);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::DATETIME_FIELD])) {
			$strCol = '`datetime`';
			$strValue = $objDatabase->sqlVariable($this->dttDatetime);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::IP_FIELD])) {
			$strCol = '`ip`';
			$strValue = $objDatabase->sqlVariable($this->intIp);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::LOGCOL_FIELD])) {
			$strCol = '`logcol`';
			$strValue = $objDatabase->sqlVariable($this->strLogcol);
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
     * Delete this Log
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
     */
    public function delete()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Cannot delete this Log with an unset primary key.');

        // Get the Database Object for this Class
        $objDatabase = Log::GetDatabase();


        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `log`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($this->intId) . '');

        $this->DeleteFromCache();
        static::BroadcastDelete($this->PrimaryKey());
    }

    /**
     * Delete all Logs
     * @return void
     */
    public static function deleteAll()
    {
        // Get the Database Object for this Class
        $objDatabase = Log::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            DELETE FROM
                `log`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    /**
     * Truncate log table
     * @return void
     */
    public static function truncate()
    {
        // Get the Database Object for this Class
        $objDatabase = Log::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            TRUNCATE `log`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    
    /**
	 * Reload this Log from the database.
     * @param iClause[]|null $clauses
     * @throws Caller
	 * @return void
	 */
	public function reload($clauses = null)
    {
		// Make sure we are actually Restored from the database
		if (!$this->__blnRestored)
			throw new Caller('Cannot call Reload() on a new, unsaved Log object.');

		// throw away all previous state of the object
		$this->DeleteFromCache();
		$this->__blnValid = null;
		$this->__blnDirty = null;

		// Reload the Object
		$objReloaded = Log::Load($this->intId, $clauses);

		// Update $this's local variables to match
		$this->__blnValid[self::ID_FIELD] = true;
		if (isset($objReloaded->__blnValid[self::USER_ID_FIELD])) {
			$this->intUserId = $objReloaded->intUserId;
			$this->objUser = $objReloaded->objUser;
			$this->__blnValid[self::USER_ID_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::ACTION_FIELD])) {
			$this->strAction = $objReloaded->strAction;
			$this->__blnValid[self::ACTION_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::VALUE_FIELD])) {
			$this->strValue = $objReloaded->strValue;
			$this->__blnValid[self::VALUE_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::DATETIME_FIELD])) {
			$this->dttDatetime = $objReloaded->dttDatetime;
			$this->__blnValid[self::DATETIME_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::IP_FIELD])) {
			$this->intIp = $objReloaded->intIp;
			$this->__blnValid[self::IP_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::LOGCOL_FIELD])) {
			$this->strLogcol = $objReloaded->strLogcol;
			$this->__blnValid[self::LOGCOL_FIELD] = true;
		}
	}
    ////////////////////
    // UTILITIES
    ////////////////////
    
    /**
     *  Return an array of Logs keyed by the unique Id property.
     *	@param Log[]
     *	@return Log[]
     **/
    public static function keyLogsById($logs) {
        if (empty($logs)) {
            return $logs;
        }
        $ret = [];
        foreach ($logs as $log) {
            $ret[$log->intId] = $log;
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
	* Gets the value of intUserId 
	* @throws Caller
	* @return integer
	*/
	public function getUserId()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::USER_ID_FIELD])) {
			throw new Caller("UserId was not selected in the most recent query and is not valid.");
		}
		return $this->intUserId;
	}


    /**
     * Gets the value of the User object referenced by intUserId 
     * If the object is not loaded, will load the object (caching it) before returning it.
     * @throws Caller
     * @return User
     */
     public function getUser()
     {
 		if ($this->__blnRestored && empty($this->__blnValid[self::USER_ID_FIELD])) {
			throw new Caller("UserId was not selected in the most recent query and is not valid.");
		}
        if ((!$this->objUser) && (!is_null($this->intUserId))) {
            $this->objUser = User::Load($this->intUserId);
        }
        return $this->objUser;
     }



   /**
	* Sets the value of intUserId 
	* Returns $this to allow chaining of setters.
	* @param integer|null $intUserId
    * @throws Caller
	* @return Log
	*/
	public function setUserId($intUserId)
    {
		$intUserId = Type::Cast($intUserId, QCubed\Type::INTEGER);

		if ($this->intUserId !== $intUserId) {
			$this->objUser = null; // remove the associated object
			$this->intUserId = $intUserId;
			$this->__blnDirty[self::USER_ID_FIELD] = true;
		}
		$this->__blnValid[self::USER_ID_FIELD] = true;
		return $this; // allows chaining
	}

    /**
     * Sets the value of the User object referenced by intUserId 
     * @param null|User $objUser
     * @throws Caller
     * @return Log
     */
    public function setUser($objUser) {
        if (is_null($objUser)) {
            $this->setUserId(null);
        } else {
            $objUser = Type::Cast($objUser, 'User');

            // Make sure its a SAVED User object
            if (is_null($objUser->Id)) {
                throw new Caller('Unable to set an unsaved User for this Log');
            }

            // Update Local Member Variables
            $this->setUserId($objUser->getId());
            $this->objUser = $objUser;
        }
        return $this;
    }

   /**
	* Gets the value of strAction (Not Null)
	* @throws Caller
	* @return string
	*/
	public function getAction()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::ACTION_FIELD])) {
			throw new Caller("Action was not selected in the most recent query and is not valid.");
		}
		return $this->strAction;
	}




   /**
	* Sets the value of strAction (Not Null)
	* Returns $this to allow chaining of setters.
	* @param string $strAction
    * @throws Caller
	* @return Log
	*/
	public function setAction($strAction)
    {
        if ($strAction === null) {
             // invalidate
             $strAction = null;
             $this->__blnValid[self::ACTION_FIELD] = false;
            return $this; // allows chaining
        }
		$strAction = Type::Cast($strAction, QCubed\Type::STRING);

		if ($this->strAction !== $strAction) {
			$this->strAction = $strAction;
			$this->__blnDirty[self::ACTION_FIELD] = true;
		}
		$this->__blnValid[self::ACTION_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strValue 
	* @throws Caller
	* @return string
	*/
	public function getValue()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::VALUE_FIELD])) {
			throw new Caller("Value was not selected in the most recent query and is not valid.");
		}
		return $this->strValue;
	}




   /**
	* Sets the value of strValue 
	* Returns $this to allow chaining of setters.
	* @param string|null $strValue
    * @throws Caller
	* @return Log
	*/
	public function setValue($strValue)
    {
		$strValue = Type::Cast($strValue, QCubed\Type::STRING);

		if ($this->strValue !== $strValue) {
			$this->strValue = $strValue;
			$this->__blnDirty[self::VALUE_FIELD] = true;
		}
		$this->__blnValid[self::VALUE_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of dttDatetime 
	* @throws Caller
	* @return \QCubed\QDateTime
	*/
	public function getDatetime()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::DATETIME_FIELD])) {
			throw new Caller("Datetime was not selected in the most recent query and is not valid.");
		}
		return $this->dttDatetime;
	}




   /**
	* Sets the value of dttDatetime 
	* Returns $this to allow chaining of setters.
	* @param \QCubed\QDateTime|null $dttDatetime
    * @throws Caller
	* @return Log
	*/
	public function setDatetime($dttDatetime)
    {
		$dttDatetime = Type::Cast($dttDatetime, QCubed\Type::DATE_TIME);

		if ($this->dttDatetime !== $dttDatetime) {
			$this->dttDatetime = $dttDatetime;
			$this->__blnDirty[self::DATETIME_FIELD] = true;
		}
		$this->__blnValid[self::DATETIME_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of intIp 
	* @throws Caller
	* @return integer
	*/
	public function getIp()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::IP_FIELD])) {
			throw new Caller("Ip was not selected in the most recent query and is not valid.");
		}
		return $this->intIp;
	}




   /**
	* Sets the value of intIp 
	* Returns $this to allow chaining of setters.
	* @param integer|null $intIp
    * @throws Caller
	* @return Log
	*/
	public function setIp($intIp)
    {
		$intIp = Type::Cast($intIp, QCubed\Type::INTEGER);

		if ($this->intIp !== $intIp) {
			$this->intIp = $intIp;
			$this->__blnDirty[self::IP_FIELD] = true;
		}
		$this->__blnValid[self::IP_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strLogcol 
	* @throws Caller
	* @return string
	*/
	public function getLogcol()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::LOGCOL_FIELD])) {
			throw new Caller("Logcol was not selected in the most recent query and is not valid.");
		}
		return $this->strLogcol;
	}




   /**
	* Sets the value of strLogcol 
	* Returns $this to allow chaining of setters.
	* @param string|null $strLogcol
    * @throws Caller
	* @return Log
	*/
	public function setLogcol($strLogcol)
    {
		$strLogcol = Type::Cast($strLogcol, QCubed\Type::STRING);

		if ($this->strLogcol !== $strLogcol) {
			$this->strLogcol = $strLogcol;
			$this->__blnDirty[self::LOGCOL_FIELD] = true;
		}
		$this->__blnValid[self::LOGCOL_FIELD] = true;
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
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'log');
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
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'log');
        }
	}

   /**
	* The current record has just been deleted. Let everyone know.
	* @param integer	$pk Primary key of record just deleted.
	*/
	protected static function broadcastDelete($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'log');
        }
	}

   /**
	* All records have just been deleted. Let everyone know.
	*/
	protected static function broadcastDeleteAll()
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'log');
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
        return "log";
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
     * @return NodeLog
     */
    public static function baseNode()
    {
        return QQN::Log();
    }

    
    ////////////////////////////////////////
    // METHODS for SOAP-BASED WEB SERVICES
    ////////////////////////////////////////

    public static function getSoapComplexTypeXml()
    {
        $strToReturn = '<complexType name="Log"><sequence>';
        $strToReturn .= '<element name="Id" type="xsd:int"/>';
        $strToReturn .= '<element name="User" type="xsd1:User"/>';
        $strToReturn .= '<element name="Action" type="xsd:string"/>';
        $strToReturn .= '<element name="Value" type="xsd:string"/>';
        $strToReturn .= '<element name="Datetime" type="xsd:dateTime"/>';
        $strToReturn .= '<element name="Ip" type="xsd:int"/>';
        $strToReturn .= '<element name="Logcol" type="xsd:string"/>';
        $strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
        $strToReturn .= '</sequence></complexType>';
        return $strToReturn;
    }

    public static function alterSoapComplexTypeArray(&$strComplexTypeArray)
    {
        if (!array_key_exists('Log', $strComplexTypeArray)) {
            $strComplexTypeArray['Log'] = Log::GetSoapComplexTypeXml();
            User::AlterSoapComplexTypeArray($strComplexTypeArray);
        }
    }

    public static function getArrayFromSoapArray($objSoapArray)
    {
        $objArrayToReturn = array();

        foreach ($objSoapArray as $objSoapObject)
            array_push($objArrayToReturn, Log::GetObjectFromSoapObject($objSoapObject));

        return $objArrayToReturn;
    }

    public static function getObjectFromSoapObject($objSoapObject)
    {
        $objToReturn = new Log();
        if (property_exists($objSoapObject, 'Id'))
            $objToReturn->intId = $objSoapObject->Id;
        if ((property_exists($objSoapObject, 'User')) &&
            ($objSoapObject->User))
            $objToReturn->User = User::GetObjectFromSoapObject($objSoapObject->User);
        if (property_exists($objSoapObject, 'Action'))
            $objToReturn->strAction = $objSoapObject->Action;
        if (property_exists($objSoapObject, 'Value'))
            $objToReturn->strValue = $objSoapObject->Value;
        if (property_exists($objSoapObject, 'Datetime'))
            $objToReturn->dttDatetime = new QDateTime($objSoapObject->Datetime);
        if (property_exists($objSoapObject, 'Ip'))
            $objToReturn->intIp = $objSoapObject->Ip;
        if (property_exists($objSoapObject, 'Logcol'))
            $objToReturn->strLogcol = $objSoapObject->Logcol;
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
            array_push($objArrayToReturn, Log::GetSoapObjectFromObject($objObject, true));

        return unserialize(serialize($objArrayToReturn));
    }

    public static function getSoapObjectFromObject($objObject, $blnBindRelatedObjects)
    {
        if ($objObject->objUser)
            $objObject->objUser = User::GetSoapObjectFromObject($objObject->objUser, false);
        else if (!$blnBindRelatedObjects)
            $objObject->intUserId = null;
        if ($objObject->dttDatetime)
            $objObject->dttDatetime = $objObject->dttDatetime->qFormat(QDateTime::FormatSoap);
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
        if (isset($this->__blnValid[self::USER_ID_FIELD])) {
            $iArray['UserId'] = $this->intUserId;
        }
        if (isset($this->__blnValid[self::ACTION_FIELD])) {
            $iArray['Action'] = $this->strAction;
        }
        if (isset($this->__blnValid[self::VALUE_FIELD])) {
            $iArray['Value'] = $this->strValue;
        }
        if (isset($this->__blnValid[self::DATETIME_FIELD])) {
            $iArray['Datetime'] = $this->dttDatetime;
        }
        if (isset($this->__blnValid[self::IP_FIELD])) {
            $iArray['Ip'] = $this->intIp;
        }
        if (isset($this->__blnValid[self::LOGCOL_FIELD])) {
            $iArray['Logcol'] = $this->strLogcol;
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
     * any query calls (like Load or QueryArray), with a call to Log::ClearCache()
     *
     * @return array An array that is json serializable
     */
    public function jsonSerialize ()
    {
        $a = [];
        if (isset($this->__blnValid[self::ID_FIELD])) {
            $a['id'] = $this->intId;
        }
        if (isset($this->objUser)) {
            $a['user'] = $this->objUser;
        } elseif (isset($this->__blnValid[self::USER_ID_FIELD])) {
            $a['user_id'] = $this->intUserId;
        }
        if (isset($this->__blnValid[self::ACTION_FIELD])) {
            $a['action'] = $this->strAction;
        }
        if (isset($this->__blnValid[self::VALUE_FIELD])) {
            $a['value'] = $this->strValue;
        }
        if (isset($this->__blnValid[self::DATETIME_FIELD])) {
            $a['datetime'] = $this->dttDatetime;
        }
        if (isset($this->__blnValid[self::IP_FIELD])) {
            $a['ip'] = $this->intIp;
        }
        if (isset($this->__blnValid[self::LOGCOL_FIELD])) {
            $a['logcol'] = $this->strLogcol;
        }
        return $a;
    }



    

}



/////////////////////////////////////
// ADDITIONAL CLASSES for QCubed QUERY
/////////////////////////////////////

/**
 * @property-read Node\Column $Id
 * @property-read Node\Column $UserId
 * @property-read NodeUser $User
 * @property-read Node\Column $Action
 * @property-read Node\Column $Value
 * @property-read Node\Column $Datetime
 * @property-read Node\Column $Ip
 * @property-read Node\Column $Logcol
 * @property-read Node\Column $_PrimaryKeyNode
 **/
class NodeLog extends Node\Table {
    protected $strTableName = 'log';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'Log';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "user_id",
            "action",
            "value",
            "datetime",
            "ip",
            "logcol",
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
            case 'UserId':
                return new Node\Column('user_id', 'UserId', 'Integer', $this);
            case 'User':
                return new NodeUser('user_id', 'User', 'Integer', $this);
            case 'Action':
                return new Node\Column('action', 'Action', 'VarChar', $this);
            case 'Value':
                return new Node\Column('value', 'Value', 'VarChar', $this);
            case 'Datetime':
                return new Node\Column('datetime', 'Datetime', 'DateTime', $this);
            case 'Ip':
                return new Node\Column('ip', 'Ip', 'Integer', $this);
            case 'Logcol':
                return new Node\Column('logcol', 'Logcol', 'VarChar', $this);

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
 * @property-read Node\Column $UserId
 * @property-read NodeUser $User
 * @property-read Node\Column $Action
 * @property-read Node\Column $Value
 * @property-read Node\Column $Datetime
 * @property-read Node\Column $Ip
 * @property-read Node\Column $Logcol

 * @property-read Node\Column $_PrimaryKeyNode
 **/
class ReverseReferenceNodeLog extends Node\ReverseReference {
    protected $strTableName = 'log';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'Log';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "user_id",
            "action",
            "value",
            "datetime",
            "ip",
            "logcol",
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
            case 'UserId':
                return new Node\Column('user_id', 'UserId', 'Integer', $this);
            case 'User':
                return new NodeUser('user_id', 'User', 'Integer', $this);
            case 'Action':
                return new Node\Column('action', 'Action', 'VarChar', $this);
            case 'Value':
                return new Node\Column('value', 'Value', 'VarChar', $this);
            case 'Datetime':
                return new Node\Column('datetime', 'Datetime', 'DateTime', $this);
            case 'Ip':
                return new Node\Column('ip', 'Ip', 'Integer', $this);
            case 'Logcol':
                return new Node\Column('logcol', 'Logcol', 'VarChar', $this);

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
