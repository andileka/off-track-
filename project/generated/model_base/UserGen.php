<?php
/**
 * Generated User base class file
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
 * Class UserGen
 *
 * The abstract UserGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the User subclass which
 * extends this UserGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the User class.
 *
 * @package My QCubed Application
 * @subpackage ModelGen
 * @property-read integer $Id the value of the id column (Read-Only PK)
 * @property integer $CompanyId the value of the company_id column (Not Null)
 * @property string $Email the value of the email column (Unique)
 * @property string $Password the value of the password column 
 * @property string $Salt the value of the salt column 
 * @property Company $Company the value of the Company object referenced by intCompanyId (Not Null)
 * @property-read Log $_Log the value of the protected _objLog (Read-Only) if set due to an expansion on the log.user_id reverse relationship
 * @property-read Log $Log the value of the protected _objLog (Read-Only) if set due to an expansion on the log.user_id reverse relationship
 * @property-read Log[] $_LogArray the value of the protected _objLogArray (Read-Only) if set due to an ExpandAsArray on the log.user_id reverse relationship
 * @property-read Log[] $LogArray the value of the protected _objLogArray (Read-Only) if set due to an ExpandAsArray on the log.user_id reverse relationship
 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
 */
abstract class UserGen extends \QCubed\ObjectBase implements IteratorAggregate, JsonSerializable {

    use ModelTrait;

    /** @var boolean Set to false in superclass to save a little time if this db object should not be watched for changes. */
    public static $blnWatchChanges = true;

    /** @var User[] Short term cached User objects */
    protected static $objCacheArray = array();

    ///////////////////////////////////////////////////////////////////////
    // PROTECTED AND PRIVATE MEMBER VARIABLES and CONSTS
    ///////////////////////////////////////////////////////////////////////

    /**
     * Protected member variable that maps to the database PK Identity column user.id
     * @var integer intId
     */
    private $intId;

    const ID_DEFAULT = null;
    const ID_FIELD = 'id';


    /**
     * Protected member variable that maps to the database column user.company_id
     * @var integer intCompanyId
     */
    private $intCompanyId;

    const COMPANY_ID_DEFAULT = null;
    const COMPANY_ID_FIELD = 'company_id';


    /**
     * Protected member variable that maps to the database column user.email
     * @var string strEmail
     */
    private $strEmail;
    const EmailMaxLength = 255; // Deprecated
    const EMAIL_MAX_LENGTH = 255;

    const EMAIL_DEFAULT = null;
    const EMAIL_FIELD = 'email';


    /**
     * Protected member variable that maps to the database column user.password
     * @var string strPassword
     */
    private $strPassword;
    const PasswordMaxLength = 45; // Deprecated
    const PASSWORD_MAX_LENGTH = 45;

    const PASSWORD_DEFAULT = null;
    const PASSWORD_FIELD = 'password';


    /**
     * Protected member variable that maps to the database column user.salt
     * @var string strSalt
     */
    private $strSalt;
    const SaltMaxLength = 45; // Deprecated
    const SALT_MAX_LENGTH = 45;

    const SALT_DEFAULT = null;
    const SALT_FIELD = 'salt';


    /**
     * Protected member variable that stores a reference to a single Log object
     * (of type Log), if this User object was restored with
     * an expansion on the log association table.
     * @var Log _objLog;
     */
    protected $_objLog;

    /**
     * Protected member variable that stores a reference to an array of Log objects
     * (of type Log[]), if this User object was restored with
     * an ExpandAsArray on the log association table.
     * @var Log[] _objLogArray;
     */
    protected $_objLogArray = null;

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
     * in the database column user.company_id.
     *
     * NOTE: Always use the Company property getter to correctly retrieve this Company object.
     * (Because this class implements late binding, this variable reference MAY be null.)
     * @var Company objCompany
     */
    protected $objCompany;



    /**
     * Construct a new User object.
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
        $this->intCompanyId = User::COMPANY_ID_DEFAULT;
        $this->__blnValid[self::COMPANY_ID_FIELD] = true;
        $this->strEmail = User::EMAIL_DEFAULT;
        $this->__blnValid[self::EMAIL_FIELD] = true;
        $this->strPassword = User::PASSWORD_DEFAULT;
        $this->__blnValid[self::PASSWORD_FIELD] = true;
        $this->strSalt = User::SALT_DEFAULT;
        $this->__blnValid[self::SALT_FIELD] = true;
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
     * Load a User from PK Info
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return User
     */
    public static function load($intId, $objOptionalClauses = null)
    {
        if (!$objOptionalClauses) {
            $objCachedObject = static::getFromCache ($intId);
            if ($objCachedObject) return $objCachedObject;
        }

        // Use QuerySingle to Perform the Query
        $objToReturn = User::querySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::User()->Id, $intId)
            ),
            $objOptionalClauses
        );
        return $objToReturn;
    }


    /**
     * Load all Users
     * @param iClause[]|null $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return User[]
     * @throws Caller
     */
    public static function loadAll($objOptionalClauses = null)
    {
        if (func_num_args() > 1) {
            throw new Caller("LoadAll must be called with an array of optional clauses as a single argument");
        }
        // Call User::queryArray to perform the LoadAll query
        try {
            return User::queryArray(QQ::All(), $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count all Users
     * @return int
     */
    public static function countAll()
    {
        // Call User::queryCount to perform the CountAll query
        return User::queryCount(QQ::All());
    }


    /**
     * Static Qcubed Query method to query for a single User object.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return User the queried object
     */
    public static function querySingle(iCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null)
    {
        return static::_QuerySingle($objConditions, $objOptionalClauses, $mixParameterArray);
    }

    /**
     * Static Qcubed Query method to query for an array of User objects.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return User[] the queried objects as an array
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
        $clauses[] = QQ::Select(QQN::User()->Id);
        $objUsers = self::QueryArray($objConditions, $clauses);
        $pks = [];
        foreach ($objUsers as $objUser) {
            $pks[] = $objUser->intId;
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
    * @return User the queried object
    */
    public static function getFromCache($key)
    {
        return static::_GetFromCache($key);
    }


    /**
     * Instantiate a User from a Database Row.
     * Takes in an optional strAliasPrefix, used in case another Object::instantiateDbRow
     * is calling this User::instantiateDbRow in order to perform
     * early binding on referenced objects.
     * @param \QCubed\Database\RowBase $objDbRow
     * @param string $strAliasPrefix
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param array|null $objPreviousItemArray Used by expansion code to aid in expanding arrays
     * @param string[] $strColumnAliasArray Array of column aliases mapping names in the query to items in the object
     * @param boolean $blnCheckDuplicate Used by ExpandArray to indicate we should not create a new object if this is a duplicate of a previoius object
     * @param string $strParentExpansionKey If this is part of an expansion, indicates what the parent item is
     * @param mixed $objExpansionParent If this is part of an expansion, is the object corresponding to the key so that we can refer back to the parent object
     * @return mixed Either a User, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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
            // Create a new instance of the User object
            $objToReturn = new User(false);
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
            $strAlias = $strAliasPrefix . 'company_id';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = (integer)$mixVal;
                }
                $objToReturn->intCompanyId = $mixVal;
                $objToReturn->__blnValid[self::COMPANY_ID_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'email';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strEmail = $mixVal;
                $objToReturn->__blnValid[self::EMAIL_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'password';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strPassword = $mixVal;
                $objToReturn->__blnValid[self::PASSWORD_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'salt';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strSalt = $mixVal;
                $objToReturn->__blnValid[self::SALT_FIELD] = true;
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
            $strAliasPrefix = 'user__';

        // Check for Company Early Binding
        $strAlias = $strAliasPrefix . 'company_id__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        if (isset ($strColumns[$strAliasName])) {
            $objExpansionNode = (empty($objExpansionAliasArray['company_id']) ? null : $objExpansionAliasArray['company_id']);
            $objToReturn->objCompany = Company::instantiateDbRow($objDbRow, $strAliasPrefix . 'company_id__', $objExpansionNode, null, $strColumnAliasArray, false, 'user', $objToReturn);
        }
        elseif ($strParentExpansionKey === 'company_id' && $objExpansionParent) {
            $objToReturn->objCompany = $objExpansionParent;
        }




        // Check for Log Virtual Binding
        $strAlias = $strAliasPrefix . 'log__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        $objExpansionNode = (empty($objExpansionAliasArray['log']) ? null : $objExpansionAliasArray['log']);
        $blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
        if ($blnExpanded && null === $objToReturn->_objLogArray)
            $objToReturn->_objLogArray = array();
        if (isset ($strColumns[$strAliasName])) {
            if ($blnExpanded) {
                $objToReturn->_objLogArray[] = Log::instantiateDbRow($objDbRow, $strAliasPrefix . 'log__', $objExpansionNode, null, $strColumnAliasArray, false, 'user_id', $objToReturn);
            } elseif (is_null($objToReturn->_objLog)) {
                $objToReturn->_objLog = Log::instantiateDbRow($objDbRow, $strAliasPrefix . 'log__', $objExpansionNode, null, $strColumnAliasArray, false, 'user_id', $objToReturn);
            }
        }
        elseif ($strParentExpansionKey === 'log' && $objExpansionParent) {
            $objToReturn->_objLog = $objExpansionParent;
        }

        return $objToReturn;
    }

    /**
     * Instantiate an array of Users from a Database Result
     * @param \QCubed\Database\ResultBase $objDbResult
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param string[] $strColumnAliasArray
     * @return User[]
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
                $objItem = User::instantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
                if ($objItem) {
                    $objToReturn[] = $objItem;
                    $objPrevItemArray[$objItem->intId][] = $objItem;
		
                }
            }
        } else {
            while ($objDbRow = $objDbResult->GetNextRow())
                $objToReturn[] = User::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
        }

        return $objToReturn;
    }


    /**
     * Instantiate a single User object from a query cursor (e.g. a DB ResultSet).
     * Cursor is automatically moved to the "next row" of the result set.
     * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
     * @param \QCubed\Database\ResultBase $objDbResult cursor resource
     * @return User next row resulting from the query
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
        return User::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
    }



    ///////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Single Load and Array)
    ///////////////////////////////////////////////////

    /**
     * Load a single User object,
     * by Id Index(es)
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return User
    */
    public static function loadById($intId, $objOptionalClauses = null)
    {
        return User::QuerySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::User()->Id, $intId)
            ),
            $objOptionalClauses
        );
    }

    /**
     * Load a single User object,
     * by Email Index(es)
     * @param string $strEmail
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return User
    */
    public static function loadByEmail($strEmail, $objOptionalClauses = null)
    {
        return User::QuerySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::User()->Email, $strEmail)
            ),
            $objOptionalClauses
        );
    }

    /**
     * Load an array of User objects,
     * by CompanyId Index(es)
     * @param integer $intCompanyId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return User[]
    */
    public static function loadArrayByCompanyId($intCompanyId, $objOptionalClauses = null)
    {
        // Call User::QueryArray to perform the LoadArrayByCompanyId query
        try {
            return User::QueryArray(
                QQ::Equal(QQN::User()->CompanyId, $intCompanyId),
                $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count Users
     * by CompanyId Index(es)
     * @param integer $intCompanyId
     * @return int
    */
    public static function countByCompanyId($intCompanyId)
    {
        // Call User::QueryCount to perform the CountByCompanyId query
        return User::QueryCount(
            QQ::Equal(QQN::User()->CompanyId, $intCompanyId)
        );
    }


    ////////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Array via Many to Many)
    ////////////////////////////////////////////////////




    //////////////////////////
    // SAVE, DELETE AND RELOAD
    //////////////////////////
    

    /**
    * Save this User
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
     * Insert into User
     */
    protected function insert()
    {
        $mixToReturn = null;
        $objDatabase = User::GetDatabase();

        $objDatabase->NonQuery('
            INSERT INTO `user` (
							`company_id`,
							`email`,
							`password`,
							`salt`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intCompanyId) . ',
							' . $objDatabase->SqlVariable($this->strEmail) . ',
							' . $objDatabase->SqlVariable($this->strPassword) . ',
							' . $objDatabase->SqlVariable($this->strSalt) . '
						)
        ');
        // Update Identity column and return its value
        $mixToReturn = $this->intId = $objDatabase->InsertId('user', 'id');
        $this->__blnValid[self::ID_FIELD] = true;


        static::broadcastInsert($this->PrimaryKey());

        return $mixToReturn;
    }

   /**
    * Update this User
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
            `user`
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

		if (isset($this->__blnDirty[self::COMPANY_ID_FIELD])) {
			$strCol = '`company_id`';
			$strValue = $objDatabase->sqlVariable($this->intCompanyId);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::EMAIL_FIELD])) {
			$strCol = '`email`';
			$strValue = $objDatabase->sqlVariable($this->strEmail);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::PASSWORD_FIELD])) {
			$strCol = '`password`';
			$strValue = $objDatabase->sqlVariable($this->strPassword);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::SALT_FIELD])) {
			$strCol = '`salt`';
			$strValue = $objDatabase->sqlVariable($this->strSalt);
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
     * Delete this User
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
     */
    public function delete()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Cannot delete this User with an unset primary key.');

        // Get the Database Object for this Class
        $objDatabase = User::GetDatabase();


        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `user`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($this->intId) . '');

        $this->DeleteFromCache();
        static::BroadcastDelete($this->PrimaryKey());
    }

    /**
     * Delete all Users
     * @return void
     */
    public static function deleteAll()
    {
        // Get the Database Object for this Class
        $objDatabase = User::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            DELETE FROM
                `user`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    /**
     * Truncate user table
     * @return void
     */
    public static function truncate()
    {
        // Get the Database Object for this Class
        $objDatabase = User::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            TRUNCATE `user`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    
    /**
	 * Reload this User from the database.
     * @param iClause[]|null $clauses
     * @throws Caller
	 * @return void
	 */
	public function reload($clauses = null)
    {
		// Make sure we are actually Restored from the database
		if (!$this->__blnRestored)
			throw new Caller('Cannot call Reload() on a new, unsaved User object.');

		// throw away all previous state of the object
		$this->DeleteFromCache();
		$this->__blnValid = null;
		$this->__blnDirty = null;

		// Reload the Object
		$objReloaded = User::Load($this->intId, $clauses);

		// Update $this's local variables to match
		$this->__blnValid[self::ID_FIELD] = true;
		if (isset($objReloaded->__blnValid[self::COMPANY_ID_FIELD])) {
			$this->intCompanyId = $objReloaded->intCompanyId;
			$this->objCompany = $objReloaded->objCompany;
			$this->__blnValid[self::COMPANY_ID_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::EMAIL_FIELD])) {
			$this->strEmail = $objReloaded->strEmail;
			$this->__blnValid[self::EMAIL_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::PASSWORD_FIELD])) {
			$this->strPassword = $objReloaded->strPassword;
			$this->__blnValid[self::PASSWORD_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::SALT_FIELD])) {
			$this->strSalt = $objReloaded->strSalt;
			$this->__blnValid[self::SALT_FIELD] = true;
		}
	}
    ////////////////////
    // UTILITIES
    ////////////////////
    
    /**
     *  Return an array of Users keyed by the unique Id property.
     *	@param User[]
     *	@return User[]
     **/
    public static function keyUsersById($users) {
        if (empty($users)) {
            return $users;
        }
        $ret = [];
        foreach ($users as $user) {
            $ret[$user->intId] = $user;
        }
        return $ret;
    }

    /**
     *  Return an array of Users keyed by the unique Email property.
     *	@param User[]
     *	@return User[]
     **/
    public static function keyUsersByEmail($users) {
        if (empty($users)) {
            return $users;
        }
        $ret = [];
        foreach ($users as $user) {
            $ret[$user->strEmail] = $user;
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
	* Gets the value of intCompanyId (Not Null)
	* @throws Caller
	* @return integer
	*/
	public function getCompanyId()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::COMPANY_ID_FIELD])) {
			throw new Caller("CompanyId was not selected in the most recent query and is not valid.");
		}
		return $this->intCompanyId;
	}


    /**
     * Gets the value of the Company object referenced by intCompanyId (Not Null)
     * If the object is not loaded, will load the object (caching it) before returning it.
     * @throws Caller
     * @return Company
     */
     public function getCompany()
     {
 		if ($this->__blnRestored && empty($this->__blnValid[self::COMPANY_ID_FIELD])) {
			throw new Caller("CompanyId was not selected in the most recent query and is not valid.");
		}
        if ((!$this->objCompany) && (!is_null($this->intCompanyId))) {
            $this->objCompany = Company::Load($this->intCompanyId);
        }
        return $this->objCompany;
     }



   /**
	* Sets the value of intCompanyId (Not Null)
	* Returns $this to allow chaining of setters.
	* @param integer $intCompanyId
    * @throws Caller
	* @return User
	*/
	public function setCompanyId($intCompanyId)
    {
        if ($intCompanyId === null) {
             // invalidate
             $intCompanyId = null;
             $this->__blnValid[self::COMPANY_ID_FIELD] = false;
            return $this; // allows chaining
        }
		$intCompanyId = Type::Cast($intCompanyId, QCubed\Type::INTEGER);

		if ($this->intCompanyId !== $intCompanyId) {
			$this->objCompany = null; // remove the associated object
			$this->intCompanyId = $intCompanyId;
			$this->__blnDirty[self::COMPANY_ID_FIELD] = true;
		}
		$this->__blnValid[self::COMPANY_ID_FIELD] = true;
		return $this; // allows chaining
	}

    /**
     * Sets the value of the Company object referenced by intCompanyId (Not Null)
     * @param null|Company $objCompany
     * @throws Caller
     * @return User
     */
    public function setCompany($objCompany) {
        if (is_null($objCompany)) {
            $this->setCompanyId(null);
        } else {
            $objCompany = Type::Cast($objCompany, 'Company');

            // Make sure its a SAVED Company object
            if (is_null($objCompany->Id)) {
                throw new Caller('Unable to set an unsaved Company for this User');
            }

            // Update Local Member Variables
            $this->setCompanyId($objCompany->getId());
            $this->objCompany = $objCompany;
        }
        return $this;
    }

   /**
	* Gets the value of strEmail (Unique)
	* @throws Caller
	* @return string
	*/
	public function getEmail()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::EMAIL_FIELD])) {
			throw new Caller("Email was not selected in the most recent query and is not valid.");
		}
		return $this->strEmail;
	}




   /**
	* Sets the value of strEmail (Unique)
	* Returns $this to allow chaining of setters.
	* @param string $strEmail
    * @throws Caller
	* @return User
	*/
	public function setEmail($strEmail)
    {
        if ($strEmail === null) {
             // invalidate
             $strEmail = null;
             $this->__blnValid[self::EMAIL_FIELD] = false;
            return $this; // allows chaining
        }
		$strEmail = Type::Cast($strEmail, QCubed\Type::STRING);

		if ($this->strEmail !== $strEmail) {
			$this->strEmail = $strEmail;
			$this->__blnDirty[self::EMAIL_FIELD] = true;
		}
		$this->__blnValid[self::EMAIL_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strPassword 
	* @throws Caller
	* @return string
	*/
	public function getPassword()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::PASSWORD_FIELD])) {
			throw new Caller("Password was not selected in the most recent query and is not valid.");
		}
		return $this->strPassword;
	}




   /**
	* Sets the value of strPassword 
	* Returns $this to allow chaining of setters.
	* @param string|null $strPassword
    * @throws Caller
	* @return User
	*/
	public function setPassword($strPassword)
    {
		$strPassword = Type::Cast($strPassword, QCubed\Type::STRING);

		if ($this->strPassword !== $strPassword) {
			$this->strPassword = $strPassword;
			$this->__blnDirty[self::PASSWORD_FIELD] = true;
		}
		$this->__blnValid[self::PASSWORD_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strSalt 
	* @throws Caller
	* @return string
	*/
	public function getSalt()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::SALT_FIELD])) {
			throw new Caller("Salt was not selected in the most recent query and is not valid.");
		}
		return $this->strSalt;
	}




   /**
	* Sets the value of strSalt 
	* Returns $this to allow chaining of setters.
	* @param string|null $strSalt
    * @throws Caller
	* @return User
	*/
	public function setSalt($strSalt)
    {
		$strSalt = Type::Cast($strSalt, QCubed\Type::STRING);

		if ($this->strSalt !== $strSalt) {
			$this->strSalt = $strSalt;
			$this->__blnDirty[self::SALT_FIELD] = true;
		}
		$this->__blnValid[self::SALT_FIELD] = true;
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



   		// Reverse references
		$objCopy->_objLog = null;
		$objCopy->_objLogArray = null;

		return $objCopy;
	}

    
   /**
	* The current record has just been inserted into the table. Let everyone know.
	* @param integer	$pk Primary key of record just inserted.
	*/
	protected static function broadcastInsert($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'user');
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
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'user');
        }
	}

   /**
	* The current record has just been deleted. Let everyone know.
	* @param integer	$pk Primary key of record just deleted.
	*/
	protected static function broadcastDelete($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'user');
        }
	}

   /**
	* All records have just been deleted. Let everyone know.
	*/
	protected static function broadcastDeleteAll()
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'user');
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

            case 'Log':
            case '_Log':
                /**
                 * Gets the value of the protected _objLog (Read-Only)
                 * if set due to an expansion on the log.user_id reverse relationship
                 * @return Log
                 */
                return $this->_objLog;

            case 'LogArray':
            case '_LogArray':
                /**
                 * Gets the value of the protected _objLogArray (Read-Only)
                 * if set due to an ExpandAsArray on the log.user_id reverse relationship
                 * @return Log[]
                 */
                return $this->_objLogArray;


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



    // Related Objects' Methods for Log
    //-------------------------------------------------------------------

    /**
     * Gets all associated Logs as an array of Log objects
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return Log[]
     * @throws Caller
     */
    public function getLogArray($objOptionalClauses = null)
    {
        if ((is_null($this->intId)))
            return array();

        try {
            return Log::LoadArrayByUserId($this->intId, $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Counts all associated Logs
     * @return int
    */
    public function countLogs()
    {
        if ((is_null($this->intId)))
            return 0;

        return Log::CountByUserId($this->intId);
    }

    /**
     * Associates a Log
     * @param Log $objLog
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
    */
    public function associateLog(Log $objLog)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateLog on this unsaved User.');
        if ((is_null($objLog->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateLog on this User with an unsaved Log.');

        // Get the Database Object for this Class
        $objDatabase = User::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `log`
            SET
                `user_id` = ' . $objDatabase->SqlVariable($this->intId) . '
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objLog->Id) . '
        ');
    }

    /**
     * Unassociates a Log
     * @param Log $objLog
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
    */
    public function unassociateLog(Log $objLog)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateLog on this unsaved User.');
        if ((is_null($objLog->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateLog on this User with an unsaved Log.');

        // Get the Database Object for this Class
        $objDatabase = User::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `log`
            SET
                `user_id` = null
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objLog->Id) . ' AND
                `user_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Unassociates all Logs
     * @return void
    */
    public function unassociateAllLogs()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateLog on this unsaved User.');

        // Get the Database Object for this Class
        $objDatabase = User::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `log`
            SET
                `user_id` = null
            WHERE
                `user_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Deletes an associated Log
     * @param Log $objLog
     * @return void
    */
    public function deleteAssociatedLog(Log $objLog)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateLog on this unsaved User.');
        if ((is_null($objLog->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateLog on this User with an unsaved Log.');

        // Get the Database Object for this Class
        $objDatabase = User::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `log`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objLog->Id) . ' AND
                `user_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Deletes all associated Logs
     * @return void
    */
    public function deleteAllLogs()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateLog on this unsaved User.');

        // Get the Database Object for this Class
        $objDatabase = User::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `log`
            WHERE
                `user_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }


    
    ///////////////////////////////
    // METHODS TO EXTRACT INFO ABOUT THE CLASS
    ///////////////////////////////

    /**
     * Static method to retrieve the Table name that owns this class.
     * @return string Name of the table from which this class has been created.
     */
    public static function getTableName()
    {
        return "user";
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
     * @return NodeUser
     */
    public static function baseNode()
    {
        return QQN::User();
    }

    
    ////////////////////////////////////////
    // METHODS for SOAP-BASED WEB SERVICES
    ////////////////////////////////////////

    public static function getSoapComplexTypeXml()
    {
        $strToReturn = '<complexType name="User"><sequence>';
        $strToReturn .= '<element name="Id" type="xsd:int"/>';
        $strToReturn .= '<element name="Company" type="xsd1:Company"/>';
        $strToReturn .= '<element name="Email" type="xsd:string"/>';
        $strToReturn .= '<element name="Password" type="xsd:string"/>';
        $strToReturn .= '<element name="Salt" type="xsd:string"/>';
        $strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
        $strToReturn .= '</sequence></complexType>';
        return $strToReturn;
    }

    public static function alterSoapComplexTypeArray(&$strComplexTypeArray)
    {
        if (!array_key_exists('User', $strComplexTypeArray)) {
            $strComplexTypeArray['User'] = User::GetSoapComplexTypeXml();
            Company::AlterSoapComplexTypeArray($strComplexTypeArray);
        }
    }

    public static function getArrayFromSoapArray($objSoapArray)
    {
        $objArrayToReturn = array();

        foreach ($objSoapArray as $objSoapObject)
            array_push($objArrayToReturn, User::GetObjectFromSoapObject($objSoapObject));

        return $objArrayToReturn;
    }

    public static function getObjectFromSoapObject($objSoapObject)
    {
        $objToReturn = new User();
        if (property_exists($objSoapObject, 'Id'))
            $objToReturn->intId = $objSoapObject->Id;
        if ((property_exists($objSoapObject, 'Company')) &&
            ($objSoapObject->Company))
            $objToReturn->Company = Company::GetObjectFromSoapObject($objSoapObject->Company);
        if (property_exists($objSoapObject, 'Email'))
            $objToReturn->strEmail = $objSoapObject->Email;
        if (property_exists($objSoapObject, 'Password'))
            $objToReturn->strPassword = $objSoapObject->Password;
        if (property_exists($objSoapObject, 'Salt'))
            $objToReturn->strSalt = $objSoapObject->Salt;
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
            array_push($objArrayToReturn, User::GetSoapObjectFromObject($objObject, true));

        return unserialize(serialize($objArrayToReturn));
    }

    public static function getSoapObjectFromObject($objObject, $blnBindRelatedObjects)
    {
        if ($objObject->objCompany)
            $objObject->objCompany = Company::GetSoapObjectFromObject($objObject->objCompany, false);
        else if (!$blnBindRelatedObjects)
            $objObject->intCompanyId = null;
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
        if (isset($this->__blnValid[self::COMPANY_ID_FIELD])) {
            $iArray['CompanyId'] = $this->intCompanyId;
        }
        if (isset($this->__blnValid[self::EMAIL_FIELD])) {
            $iArray['Email'] = $this->strEmail;
        }
        if (isset($this->__blnValid[self::PASSWORD_FIELD])) {
            $iArray['Password'] = $this->strPassword;
        }
        if (isset($this->__blnValid[self::SALT_FIELD])) {
            $iArray['Salt'] = $this->strSalt;
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
     * any query calls (like Load or QueryArray), with a call to User::ClearCache()
     *
     * @return array An array that is json serializable
     */
    public function jsonSerialize ()
    {
        $a = [];
        if (isset($this->__blnValid[self::ID_FIELD])) {
            $a['id'] = $this->intId;
        }
        if (isset($this->objCompany)) {
            $a['company'] = $this->objCompany;
        } elseif (isset($this->__blnValid[self::COMPANY_ID_FIELD])) {
            $a['company_id'] = $this->intCompanyId;
        }
        if (isset($this->__blnValid[self::EMAIL_FIELD])) {
            $a['email'] = $this->strEmail;
        }
        if (isset($this->__blnValid[self::PASSWORD_FIELD])) {
            $a['password'] = $this->strPassword;
        }
        if (isset($this->__blnValid[self::SALT_FIELD])) {
            $a['salt'] = $this->strSalt;
        }
        if (isset($this->_objLog)) {
            $a['log'] = $this->_objLog;
        } elseif (isset($this->_objLogArray)) {
            $a['log'] = $this->_objLogArray;
        }
        return $a;
    }



    

}



/////////////////////////////////////
// ADDITIONAL CLASSES for QCubed QUERY
/////////////////////////////////////

/**
 * @property-read Node\Column $Id
 * @property-read Node\Column $CompanyId
 * @property-read NodeCompany $Company
 * @property-read Node\Column $Email
 * @property-read Node\Column $Password
 * @property-read Node\Column $Salt
 * @property-read ReverseReferenceNodeLog $Log
 * @property-read Node\Column $_PrimaryKeyNode
 **/
class NodeUser extends Node\Table {
    protected $strTableName = 'user';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'User';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "company_id",
            "email",
            "password",
            "salt",
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
            case 'CompanyId':
                return new Node\Column('company_id', 'CompanyId', 'Integer', $this);
            case 'Company':
                return new NodeCompany('company_id', 'Company', 'Integer', $this);
            case 'Email':
                return new Node\Column('email', 'Email', 'VarChar', $this);
            case 'Password':
                return new Node\Column('password', 'Password', 'VarChar', $this);
            case 'Salt':
                return new Node\Column('salt', 'Salt', 'VarChar', $this);
            case 'Log':
                return new ReverseReferenceNodeLog($this, 'log', \QCubed\Type::REVERSE_REFERENCE, 'user_id', 'Log');

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
 * @property-read Node\Column $CompanyId
 * @property-read NodeCompany $Company
 * @property-read Node\Column $Email
 * @property-read Node\Column $Password
 * @property-read Node\Column $Salt
 * @property-read ReverseReferenceNodeLog $Log

 * @property-read Node\Column $_PrimaryKeyNode
 **/
class ReverseReferenceNodeUser extends Node\ReverseReference {
    protected $strTableName = 'user';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'User';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "company_id",
            "email",
            "password",
            "salt",
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
            case 'CompanyId':
                return new Node\Column('company_id', 'CompanyId', 'Integer', $this);
            case 'Company':
                return new NodeCompany('company_id', 'Company', 'Integer', $this);
            case 'Email':
                return new Node\Column('email', 'Email', 'VarChar', $this);
            case 'Password':
                return new Node\Column('password', 'Password', 'VarChar', $this);
            case 'Salt':
                return new Node\Column('salt', 'Salt', 'VarChar', $this);
            case 'Log':
                return new ReverseReferenceNodeLog($this, 'log', \QCubed\Type::REVERSE_REFERENCE, 'user_id', 'Log');

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
