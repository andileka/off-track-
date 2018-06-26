<?php
/**
 * Generated City base class file
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
 * Class CityGen
 *
 * The abstract CityGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the City subclass which
 * extends this CityGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the City class.
 *
 * @package My QCubed Application
 * @subpackage ModelGen
 * @property integer $Id the value of the id column (PK)
 * @property integer $CountryId the value of the country_id column (Not Null)
 * @property string $PostalCode the value of the postal_code column 
 * @property string $Name the value of the name column 
 * @property string $AdminName1 the value of the admin_name1 column 
 * @property string $AdminCode1 the value of the admin_code1 column 
 * @property string $AdminName2 the value of the admin_name2 column 
 * @property string $AdminCode2 the value of the admin_code2 column 
 * @property string $AdminName3 the value of the admin_name3 column 
 * @property string $AdminCode3 the value of the admin_code3 column 
 * @property string $Latitude the value of the latitude column 
 * @property string $Longitude the value of the longitude column 
 * @property integer $Accuracy the value of the accuracy column 
 * @property-read Tourist $_Tourist the value of the protected _objTourist (Read-Only) if set due to an expansion on the tourist.city_id reverse relationship
 * @property-read Tourist $Tourist the value of the protected _objTourist (Read-Only) if set due to an expansion on the tourist.city_id reverse relationship
 * @property-read Tourist[] $_TouristArray the value of the protected _objTouristArray (Read-Only) if set due to an ExpandAsArray on the tourist.city_id reverse relationship
 * @property-read Tourist[] $TouristArray the value of the protected _objTouristArray (Read-Only) if set due to an ExpandAsArray on the tourist.city_id reverse relationship
 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
 */
abstract class CityGen extends \QCubed\ObjectBase implements IteratorAggregate, JsonSerializable {

    use ModelTrait;

    /** @var boolean Set to false in superclass to save a little time if this db object should not be watched for changes. */
    public static $blnWatchChanges = true;

    /** @var City[] Short term cached City objects */
    protected static $objCacheArray = array();

    ///////////////////////////////////////////////////////////////////////
    // PROTECTED AND PRIVATE MEMBER VARIABLES and CONSTS
    ///////////////////////////////////////////////////////////////////////

    /**
     * Protected member variable that maps to the database PK column city.id
     * @var integer intId
     */
    private $intId;

    const ID_DEFAULT = null;
    const ID_FIELD = 'id';


    /**
     * Protected internal member variable that stores the original version of the PK column value (if restored)
     * Used by Save() to update a PK column during UPDATE and Reload() to reload the PK.
     * @var integer __intId;
     */
    protected $__intId;

    /**
     * Protected member variable that maps to the database column city.country_id
     * @var integer intCountryId
     */
    private $intCountryId;

    const COUNTRY_ID_DEFAULT = null;
    const COUNTRY_ID_FIELD = 'country_id';


    /**
     * Protected member variable that maps to the database column city.postal_code
     * @var string strPostalCode
     */
    private $strPostalCode;
    const PostalCodeMaxLength = 20; // Deprecated
    const POSTAL_CODE_MAX_LENGTH = 20;

    const POSTAL_CODE_DEFAULT = null;
    const POSTAL_CODE_FIELD = 'postal_code';


    /**
     * Protected member variable that maps to the database column city.name
     * @var string strName
     */
    private $strName;
    const NameMaxLength = 100; // Deprecated
    const NAME_MAX_LENGTH = 100;

    const NAME_DEFAULT = null;
    const NAME_FIELD = 'name';


    /**
     * Protected member variable that maps to the database column city.admin_name1
     * @var string strAdminName1
     */
    private $strAdminName1;
    const AdminName1MaxLength = 100; // Deprecated
    const ADMIN_NAME1_MAX_LENGTH = 100;

    const ADMIN_NAME1_DEFAULT = null;
    const ADMIN_NAME1_FIELD = 'admin_name1';


    /**
     * Protected member variable that maps to the database column city.admin_code1
     * @var string strAdminCode1
     */
    private $strAdminCode1;
    const AdminCode1MaxLength = 20; // Deprecated
    const ADMIN_CODE1_MAX_LENGTH = 20;

    const ADMIN_CODE1_DEFAULT = null;
    const ADMIN_CODE1_FIELD = 'admin_code1';


    /**
     * Protected member variable that maps to the database column city.admin_name2
     * @var string strAdminName2
     */
    private $strAdminName2;
    const AdminName2MaxLength = 100; // Deprecated
    const ADMIN_NAME2_MAX_LENGTH = 100;

    const ADMIN_NAME2_DEFAULT = null;
    const ADMIN_NAME2_FIELD = 'admin_name2';


    /**
     * Protected member variable that maps to the database column city.admin_code2
     * @var string strAdminCode2
     */
    private $strAdminCode2;
    const AdminCode2MaxLength = 20; // Deprecated
    const ADMIN_CODE2_MAX_LENGTH = 20;

    const ADMIN_CODE2_DEFAULT = null;
    const ADMIN_CODE2_FIELD = 'admin_code2';


    /**
     * Protected member variable that maps to the database column city.admin_name3
     * @var string strAdminName3
     */
    private $strAdminName3;
    const AdminName3MaxLength = 100; // Deprecated
    const ADMIN_NAME3_MAX_LENGTH = 100;

    const ADMIN_NAME3_DEFAULT = null;
    const ADMIN_NAME3_FIELD = 'admin_name3';


    /**
     * Protected member variable that maps to the database column city.admin_code3
     * @var string strAdminCode3
     */
    private $strAdminCode3;
    const AdminCode3MaxLength = 20; // Deprecated
    const ADMIN_CODE3_MAX_LENGTH = 20;

    const ADMIN_CODE3_DEFAULT = null;
    const ADMIN_CODE3_FIELD = 'admin_code3';


    /**
     * Protected member variable that maps to the database column city.latitude
     * @var string strLatitude
     */
    private $strLatitude;
    const LatitudeMaxLength = 12; // Deprecated
    const LATITUDE_MAX_LENGTH = 12;

    const LATITUDE_DEFAULT = null;
    const LATITUDE_FIELD = 'latitude';


    /**
     * Protected member variable that maps to the database column city.longitude
     * @var string strLongitude
     */
    private $strLongitude;
    const LongitudeMaxLength = 12; // Deprecated
    const LONGITUDE_MAX_LENGTH = 12;

    const LONGITUDE_DEFAULT = null;
    const LONGITUDE_FIELD = 'longitude';


    /**
     * Protected member variable that maps to the database column city.accuracy
     * @var integer intAccuracy
     */
    private $intAccuracy;

    const ACCURACY_DEFAULT = 4;
    const ACCURACY_FIELD = 'accuracy';


    /**
     * Protected member variable that stores a reference to a single Tourist object
     * (of type Tourist), if this City object was restored with
     * an expansion on the tourist association table.
     * @var Tourist _objTourist;
     */
    protected $_objTourist;

    /**
     * Protected member variable that stores a reference to an array of Tourist objects
     * (of type Tourist[]), if this City object was restored with
     * an ExpandAsArray on the tourist association table.
     * @var Tourist[] _objTouristArray;
     */
    protected $_objTouristArray = null;

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
     * Construct a new City object.
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
        $this->intId = City::ID_DEFAULT;
        $this->__blnValid[self::ID_FIELD] = true;
        $this->intCountryId = City::COUNTRY_ID_DEFAULT;
        $this->__blnValid[self::COUNTRY_ID_FIELD] = true;
        $this->strPostalCode = City::POSTAL_CODE_DEFAULT;
        $this->__blnValid[self::POSTAL_CODE_FIELD] = true;
        $this->strName = City::NAME_DEFAULT;
        $this->__blnValid[self::NAME_FIELD] = true;
        $this->strAdminName1 = City::ADMIN_NAME1_DEFAULT;
        $this->__blnValid[self::ADMIN_NAME1_FIELD] = true;
        $this->strAdminCode1 = City::ADMIN_CODE1_DEFAULT;
        $this->__blnValid[self::ADMIN_CODE1_FIELD] = true;
        $this->strAdminName2 = City::ADMIN_NAME2_DEFAULT;
        $this->__blnValid[self::ADMIN_NAME2_FIELD] = true;
        $this->strAdminCode2 = City::ADMIN_CODE2_DEFAULT;
        $this->__blnValid[self::ADMIN_CODE2_FIELD] = true;
        $this->strAdminName3 = City::ADMIN_NAME3_DEFAULT;
        $this->__blnValid[self::ADMIN_NAME3_FIELD] = true;
        $this->strAdminCode3 = City::ADMIN_CODE3_DEFAULT;
        $this->__blnValid[self::ADMIN_CODE3_FIELD] = true;
        $this->strLatitude = City::LATITUDE_DEFAULT;
        $this->__blnValid[self::LATITUDE_FIELD] = true;
        $this->strLongitude = City::LONGITUDE_DEFAULT;
        $this->__blnValid[self::LONGITUDE_FIELD] = true;
        $this->intAccuracy = City::ACCURACY_DEFAULT;
        $this->__blnValid[self::ACCURACY_FIELD] = true;
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
     * Load a City from PK Info
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return City
     */
    public static function load($intId, $objOptionalClauses = null)
    {
        if (!$objOptionalClauses) {
            $objCachedObject = static::getFromCache ($intId);
            if ($objCachedObject) return $objCachedObject;
        }

        // Use QuerySingle to Perform the Query
        $objToReturn = City::querySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::City()->Id, $intId)
            ),
            $objOptionalClauses
        );
        return $objToReturn;
    }


    /**
     * Load all Cities
     * @param iClause[]|null $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return City[]
     * @throws Caller
     */
    public static function loadAll($objOptionalClauses = null)
    {
        if (func_num_args() > 1) {
            throw new Caller("LoadAll must be called with an array of optional clauses as a single argument");
        }
        // Call City::queryArray to perform the LoadAll query
        try {
            return City::queryArray(QQ::All(), $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count all Cities
     * @return int
     */
    public static function countAll()
    {
        // Call City::queryCount to perform the CountAll query
        return City::queryCount(QQ::All());
    }


    /**
     * Static Qcubed Query method to query for a single City object.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return City the queried object
     */
    public static function querySingle(iCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null)
    {
        return static::_QuerySingle($objConditions, $objOptionalClauses, $mixParameterArray);
    }

    /**
     * Static Qcubed Query method to query for an array of City objects.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return City[] the queried objects as an array
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
        $clauses[] = QQ::Select(QQN::City()->Id);
        $objCities = self::QueryArray($objConditions, $clauses);
        $pks = [];
        foreach ($objCities as $objCity) {
            $pks[] = $objCity->intId;
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
    * @return City the queried object
    */
    public static function getFromCache($key)
    {
        return static::_GetFromCache($key);
    }


    /**
     * Instantiate a City from a Database Row.
     * Takes in an optional strAliasPrefix, used in case another Object::instantiateDbRow
     * is calling this City::instantiateDbRow in order to perform
     * early binding on referenced objects.
     * @param \QCubed\Database\RowBase $objDbRow
     * @param string $strAliasPrefix
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param array|null $objPreviousItemArray Used by expansion code to aid in expanding arrays
     * @param string[] $strColumnAliasArray Array of column aliases mapping names in the query to items in the object
     * @param boolean $blnCheckDuplicate Used by ExpandArray to indicate we should not create a new object if this is a duplicate of a previoius object
     * @param string $strParentExpansionKey If this is part of an expansion, indicates what the parent item is
     * @param mixed $objExpansionParent If this is part of an expansion, is the object corresponding to the key so that we can refer back to the parent object
     * @return mixed Either a City, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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
            // Create a new instance of the City object
            $objToReturn = new City(false);
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
                $objToReturn->__intId = $mixVal;
                $objToReturn->__blnValid[self::ID_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'country_id';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = (integer)$mixVal;
                }
                $objToReturn->intCountryId = $mixVal;
                $objToReturn->__blnValid[self::COUNTRY_ID_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'postal_code';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strPostalCode = $mixVal;
                $objToReturn->__blnValid[self::POSTAL_CODE_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'name';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strName = $mixVal;
                $objToReturn->__blnValid[self::NAME_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'admin_name1';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strAdminName1 = $mixVal;
                $objToReturn->__blnValid[self::ADMIN_NAME1_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'admin_code1';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strAdminCode1 = $mixVal;
                $objToReturn->__blnValid[self::ADMIN_CODE1_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'admin_name2';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strAdminName2 = $mixVal;
                $objToReturn->__blnValid[self::ADMIN_NAME2_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'admin_code2';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strAdminCode2 = $mixVal;
                $objToReturn->__blnValid[self::ADMIN_CODE2_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'admin_name3';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strAdminName3 = $mixVal;
                $objToReturn->__blnValid[self::ADMIN_NAME3_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'admin_code3';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strAdminCode3 = $mixVal;
                $objToReturn->__blnValid[self::ADMIN_CODE3_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'latitude';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strLatitude = $mixVal;
                $objToReturn->__blnValid[self::LATITUDE_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'longitude';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strLongitude = $mixVal;
                $objToReturn->__blnValid[self::LONGITUDE_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'accuracy';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = (integer)$mixVal;
                }
                $objToReturn->intAccuracy = $mixVal;
                $objToReturn->__blnValid[self::ACCURACY_FIELD] = true;
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
            $strAliasPrefix = 'city__';




        // Check for Tourist Virtual Binding
        $strAlias = $strAliasPrefix . 'tourist__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        $objExpansionNode = (empty($objExpansionAliasArray['tourist']) ? null : $objExpansionAliasArray['tourist']);
        $blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
        if ($blnExpanded && null === $objToReturn->_objTouristArray)
            $objToReturn->_objTouristArray = array();
        if (isset ($strColumns[$strAliasName])) {
            if ($blnExpanded) {
                $objToReturn->_objTouristArray[] = Tourist::instantiateDbRow($objDbRow, $strAliasPrefix . 'tourist__', $objExpansionNode, null, $strColumnAliasArray, false, 'city_id', $objToReturn);
            } elseif (is_null($objToReturn->_objTourist)) {
                $objToReturn->_objTourist = Tourist::instantiateDbRow($objDbRow, $strAliasPrefix . 'tourist__', $objExpansionNode, null, $strColumnAliasArray, false, 'city_id', $objToReturn);
            }
        }
        elseif ($strParentExpansionKey === 'tourist' && $objExpansionParent) {
            $objToReturn->_objTourist = $objExpansionParent;
        }

        return $objToReturn;
    }

    /**
     * Instantiate an array of Cities from a Database Result
     * @param \QCubed\Database\ResultBase $objDbResult
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param string[] $strColumnAliasArray
     * @return City[]
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
                $objItem = City::instantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
                if ($objItem) {
                    $objToReturn[] = $objItem;
                    $objPrevItemArray[$objItem->intId][] = $objItem;
		
                }
            }
        } else {
            while ($objDbRow = $objDbResult->GetNextRow())
                $objToReturn[] = City::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
        }

        return $objToReturn;
    }


    /**
     * Instantiate a single City object from a query cursor (e.g. a DB ResultSet).
     * Cursor is automatically moved to the "next row" of the result set.
     * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
     * @param \QCubed\Database\ResultBase $objDbResult cursor resource
     * @return City next row resulting from the query
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
        return City::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
    }



    ///////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Single Load and Array)
    ///////////////////////////////////////////////////

    /**
     * Load a single City object,
     * by Id Index(es)
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return City
    */
    public static function loadById($intId, $objOptionalClauses = null)
    {
        return City::QuerySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::City()->Id, $intId)
            ),
            $objOptionalClauses
        );
    }

    /**
     * Load an array of City objects,
     * by CountryId Index(es)
     * @param integer $intCountryId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return City[]
    */
    public static function loadArrayByCountryId($intCountryId, $objOptionalClauses = null)
    {
        // Call City::QueryArray to perform the LoadArrayByCountryId query
        try {
            return City::QueryArray(
                QQ::Equal(QQN::City()->CountryId, $intCountryId),
                $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count Cities
     * by CountryId Index(es)
     * @param integer $intCountryId
     * @return int
    */
    public static function countByCountryId($intCountryId)
    {
        // Call City::QueryCount to perform the CountByCountryId query
        return City::QueryCount(
            QQ::Equal(QQN::City()->CountryId, $intCountryId)
        );
    }


    ////////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Array via Many to Many)
    ////////////////////////////////////////////////////




    //////////////////////////
    // SAVE, DELETE AND RELOAD
    //////////////////////////
    

    /**
    * Save this City
    * @param bool $blnForceInsert
    * @param bool $blnForceUpdate
    * @throws Caller
    * @return void
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
        $this->__intId = $this->intId;

        $this->deleteFromCache();

        $this->__blnDirty = null; // reset dirty values

        return $mixToReturn;
    }

    /**
     * Insert into City
     */
    protected function insert()
    {
        $mixToReturn = null;
        $objDatabase = City::GetDatabase();

        $objDatabase->NonQuery('
            INSERT INTO `city` (
							`id`,
							`country_id`,
							`postal_code`,
							`name`,
							`admin_name1`,
							`admin_code1`,
							`admin_name2`,
							`admin_code2`,
							`admin_name3`,
							`admin_code3`,
							`latitude`,
							`longitude`,
							`accuracy`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intId) . ',
							' . $objDatabase->SqlVariable($this->intCountryId) . ',
							' . $objDatabase->SqlVariable($this->strPostalCode) . ',
							' . $objDatabase->SqlVariable($this->strName) . ',
							' . $objDatabase->SqlVariable($this->strAdminName1) . ',
							' . $objDatabase->SqlVariable($this->strAdminCode1) . ',
							' . $objDatabase->SqlVariable($this->strAdminName2) . ',
							' . $objDatabase->SqlVariable($this->strAdminCode2) . ',
							' . $objDatabase->SqlVariable($this->strAdminName3) . ',
							' . $objDatabase->SqlVariable($this->strAdminCode3) . ',
							' . $objDatabase->SqlVariable($this->strLatitude) . ',
							' . $objDatabase->SqlVariable($this->strLongitude) . ',
							' . $objDatabase->SqlVariable($this->intAccuracy) . '
						)
        ');


        static::broadcastInsert($this->PrimaryKey());

        return $mixToReturn;
    }

   /**
    * Update this City
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
            `city`
        SET
        ' . $strValues . '

        WHERE
                `id` = ' . $objDatabase->SqlVariable($this->__intId);
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

		if (isset($this->__blnDirty[self::ID_FIELD])) {
			$strCol = '`id`';
			$strValue = $objDatabase->sqlVariable($this->intId);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::COUNTRY_ID_FIELD])) {
			$strCol = '`country_id`';
			$strValue = $objDatabase->sqlVariable($this->intCountryId);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::POSTAL_CODE_FIELD])) {
			$strCol = '`postal_code`';
			$strValue = $objDatabase->sqlVariable($this->strPostalCode);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::NAME_FIELD])) {
			$strCol = '`name`';
			$strValue = $objDatabase->sqlVariable($this->strName);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::ADMIN_NAME1_FIELD])) {
			$strCol = '`admin_name1`';
			$strValue = $objDatabase->sqlVariable($this->strAdminName1);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::ADMIN_CODE1_FIELD])) {
			$strCol = '`admin_code1`';
			$strValue = $objDatabase->sqlVariable($this->strAdminCode1);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::ADMIN_NAME2_FIELD])) {
			$strCol = '`admin_name2`';
			$strValue = $objDatabase->sqlVariable($this->strAdminName2);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::ADMIN_CODE2_FIELD])) {
			$strCol = '`admin_code2`';
			$strValue = $objDatabase->sqlVariable($this->strAdminCode2);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::ADMIN_NAME3_FIELD])) {
			$strCol = '`admin_name3`';
			$strValue = $objDatabase->sqlVariable($this->strAdminName3);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::ADMIN_CODE3_FIELD])) {
			$strCol = '`admin_code3`';
			$strValue = $objDatabase->sqlVariable($this->strAdminCode3);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::LATITUDE_FIELD])) {
			$strCol = '`latitude`';
			$strValue = $objDatabase->sqlVariable($this->strLatitude);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::LONGITUDE_FIELD])) {
			$strCol = '`longitude`';
			$strValue = $objDatabase->sqlVariable($this->strLongitude);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::ACCURACY_FIELD])) {
			$strCol = '`accuracy`';
			$strValue = $objDatabase->sqlVariable($this->intAccuracy);
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
     * Delete this City
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
     */
    public function delete()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Cannot delete this City with an unset primary key.');

        // Get the Database Object for this Class
        $objDatabase = City::GetDatabase();


        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `city`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($this->intId) . '');

        $this->DeleteFromCache();
        static::BroadcastDelete($this->PrimaryKey());
    }

    /**
     * Delete all Cities
     * @return void
     */
    public static function deleteAll()
    {
        // Get the Database Object for this Class
        $objDatabase = City::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            DELETE FROM
                `city`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    /**
     * Truncate city table
     * @return void
     */
    public static function truncate()
    {
        // Get the Database Object for this Class
        $objDatabase = City::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            TRUNCATE `city`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    
    /**
	 * Reload this City from the database.
     * @param iClause[]|null $clauses
     * @throws Caller
	 * @return void
	 */
	public function reload($clauses = null)
    {
		// Make sure we are actually Restored from the database
		if (!$this->__blnRestored)
			throw new Caller('Cannot call Reload() on a new, unsaved City object.');

		// throw away all previous state of the object
		$this->DeleteFromCache();
		$this->__blnValid = null;
		$this->__blnDirty = null;

		// Reload the Object
		$objReloaded = City::Load($this->__intId, $clauses);

		// Update $this's local variables to match
		$this->intId = $objReloaded->intId;
		$this->__blnValid[self::ID_FIELD] = true;
		if (isset($objReloaded->__blnValid[self::COUNTRY_ID_FIELD])) {
			$this->intCountryId = $objReloaded->intCountryId;
			$this->__blnValid[self::COUNTRY_ID_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::POSTAL_CODE_FIELD])) {
			$this->strPostalCode = $objReloaded->strPostalCode;
			$this->__blnValid[self::POSTAL_CODE_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::NAME_FIELD])) {
			$this->strName = $objReloaded->strName;
			$this->__blnValid[self::NAME_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::ADMIN_NAME1_FIELD])) {
			$this->strAdminName1 = $objReloaded->strAdminName1;
			$this->__blnValid[self::ADMIN_NAME1_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::ADMIN_CODE1_FIELD])) {
			$this->strAdminCode1 = $objReloaded->strAdminCode1;
			$this->__blnValid[self::ADMIN_CODE1_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::ADMIN_NAME2_FIELD])) {
			$this->strAdminName2 = $objReloaded->strAdminName2;
			$this->__blnValid[self::ADMIN_NAME2_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::ADMIN_CODE2_FIELD])) {
			$this->strAdminCode2 = $objReloaded->strAdminCode2;
			$this->__blnValid[self::ADMIN_CODE2_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::ADMIN_NAME3_FIELD])) {
			$this->strAdminName3 = $objReloaded->strAdminName3;
			$this->__blnValid[self::ADMIN_NAME3_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::ADMIN_CODE3_FIELD])) {
			$this->strAdminCode3 = $objReloaded->strAdminCode3;
			$this->__blnValid[self::ADMIN_CODE3_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::LATITUDE_FIELD])) {
			$this->strLatitude = $objReloaded->strLatitude;
			$this->__blnValid[self::LATITUDE_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::LONGITUDE_FIELD])) {
			$this->strLongitude = $objReloaded->strLongitude;
			$this->__blnValid[self::LONGITUDE_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::ACCURACY_FIELD])) {
			$this->intAccuracy = $objReloaded->intAccuracy;
			$this->__blnValid[self::ACCURACY_FIELD] = true;
		}
	}
    ////////////////////
    // UTILITIES
    ////////////////////
    
    /**
     *  Return an array of Cities keyed by the unique Id property.
     *	@param City[]
     *	@return City[]
     **/
    public static function keyCitiesById($cities) {
        if (empty($cities)) {
            return $cities;
        }
        $ret = [];
        foreach ($cities as $city) {
            $ret[$city->intId] = $city;
        }
        return $ret;
    }

    
    //////////////////////////////////////////////////////////////
    //															//
    //				GETTERS and SETTERS  						//
    //															//
    //////////////////////////////////////////////////////////////

   /**
	* Gets the value of intId (PK)
	* @throws Caller
	* @return integer
	*/
	public function getId()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::ID_FIELD])) {
			throw new Caller("Id was not selected in the most recent query and is not valid.");
		}
		return $this->intId;
	}




   /**
	* Sets the value of intId (PK)
	* Returns $this to allow chaining of setters.
	* @param integer $intId
    * @throws Caller
	* @return City
	*/
	public function setId($intId)
    {
        if ($intId === null) {
             // invalidate
             $intId = null;
             $this->__blnValid[self::ID_FIELD] = false;
            return $this; // allows chaining
        }
		$intId = Type::Cast($intId, QCubed\Type::INTEGER);

		if ($this->intId !== $intId) {
			$this->intId = $intId;
			$this->__blnDirty[self::ID_FIELD] = true;
		}
		$this->__blnValid[self::ID_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of intCountryId (Not Null)
	* @throws Caller
	* @return integer
	*/
	public function getCountryId()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::COUNTRY_ID_FIELD])) {
			throw new Caller("CountryId was not selected in the most recent query and is not valid.");
		}
		return $this->intCountryId;
	}




   /**
	* Sets the value of intCountryId (Not Null)
	* Returns $this to allow chaining of setters.
	* @param integer $intCountryId
    * @throws Caller
	* @return City
	*/
	public function setCountryId($intCountryId)
    {
        if ($intCountryId === null) {
             // invalidate
             $intCountryId = null;
             $this->__blnValid[self::COUNTRY_ID_FIELD] = false;
            return $this; // allows chaining
        }
		$intCountryId = Type::Cast($intCountryId, QCubed\Type::INTEGER);

		if ($this->intCountryId !== $intCountryId) {
			$this->intCountryId = $intCountryId;
			$this->__blnDirty[self::COUNTRY_ID_FIELD] = true;
		}
		$this->__blnValid[self::COUNTRY_ID_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strPostalCode 
	* @throws Caller
	* @return string
	*/
	public function getPostalCode()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::POSTAL_CODE_FIELD])) {
			throw new Caller("PostalCode was not selected in the most recent query and is not valid.");
		}
		return $this->strPostalCode;
	}




   /**
	* Sets the value of strPostalCode 
	* Returns $this to allow chaining of setters.
	* @param string|null $strPostalCode
    * @throws Caller
	* @return City
	*/
	public function setPostalCode($strPostalCode)
    {
		$strPostalCode = Type::Cast($strPostalCode, QCubed\Type::STRING);

		if ($this->strPostalCode !== $strPostalCode) {
			$this->strPostalCode = $strPostalCode;
			$this->__blnDirty[self::POSTAL_CODE_FIELD] = true;
		}
		$this->__blnValid[self::POSTAL_CODE_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strName 
	* @throws Caller
	* @return string
	*/
	public function getName()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::NAME_FIELD])) {
			throw new Caller("Name was not selected in the most recent query and is not valid.");
		}
		return $this->strName;
	}




   /**
	* Sets the value of strName 
	* Returns $this to allow chaining of setters.
	* @param string|null $strName
    * @throws Caller
	* @return City
	*/
	public function setName($strName)
    {
		$strName = Type::Cast($strName, QCubed\Type::STRING);

		if ($this->strName !== $strName) {
			$this->strName = $strName;
			$this->__blnDirty[self::NAME_FIELD] = true;
		}
		$this->__blnValid[self::NAME_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strAdminName1 
	* @throws Caller
	* @return string
	*/
	public function getAdminName1()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::ADMIN_NAME1_FIELD])) {
			throw new Caller("AdminName1 was not selected in the most recent query and is not valid.");
		}
		return $this->strAdminName1;
	}




   /**
	* Sets the value of strAdminName1 
	* Returns $this to allow chaining of setters.
	* @param string|null $strAdminName1
    * @throws Caller
	* @return City
	*/
	public function setAdminName1($strAdminName1)
    {
		$strAdminName1 = Type::Cast($strAdminName1, QCubed\Type::STRING);

		if ($this->strAdminName1 !== $strAdminName1) {
			$this->strAdminName1 = $strAdminName1;
			$this->__blnDirty[self::ADMIN_NAME1_FIELD] = true;
		}
		$this->__blnValid[self::ADMIN_NAME1_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strAdminCode1 
	* @throws Caller
	* @return string
	*/
	public function getAdminCode1()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::ADMIN_CODE1_FIELD])) {
			throw new Caller("AdminCode1 was not selected in the most recent query and is not valid.");
		}
		return $this->strAdminCode1;
	}




   /**
	* Sets the value of strAdminCode1 
	* Returns $this to allow chaining of setters.
	* @param string|null $strAdminCode1
    * @throws Caller
	* @return City
	*/
	public function setAdminCode1($strAdminCode1)
    {
		$strAdminCode1 = Type::Cast($strAdminCode1, QCubed\Type::STRING);

		if ($this->strAdminCode1 !== $strAdminCode1) {
			$this->strAdminCode1 = $strAdminCode1;
			$this->__blnDirty[self::ADMIN_CODE1_FIELD] = true;
		}
		$this->__blnValid[self::ADMIN_CODE1_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strAdminName2 
	* @throws Caller
	* @return string
	*/
	public function getAdminName2()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::ADMIN_NAME2_FIELD])) {
			throw new Caller("AdminName2 was not selected in the most recent query and is not valid.");
		}
		return $this->strAdminName2;
	}




   /**
	* Sets the value of strAdminName2 
	* Returns $this to allow chaining of setters.
	* @param string|null $strAdminName2
    * @throws Caller
	* @return City
	*/
	public function setAdminName2($strAdminName2)
    {
		$strAdminName2 = Type::Cast($strAdminName2, QCubed\Type::STRING);

		if ($this->strAdminName2 !== $strAdminName2) {
			$this->strAdminName2 = $strAdminName2;
			$this->__blnDirty[self::ADMIN_NAME2_FIELD] = true;
		}
		$this->__blnValid[self::ADMIN_NAME2_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strAdminCode2 
	* @throws Caller
	* @return string
	*/
	public function getAdminCode2()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::ADMIN_CODE2_FIELD])) {
			throw new Caller("AdminCode2 was not selected in the most recent query and is not valid.");
		}
		return $this->strAdminCode2;
	}




   /**
	* Sets the value of strAdminCode2 
	* Returns $this to allow chaining of setters.
	* @param string|null $strAdminCode2
    * @throws Caller
	* @return City
	*/
	public function setAdminCode2($strAdminCode2)
    {
		$strAdminCode2 = Type::Cast($strAdminCode2, QCubed\Type::STRING);

		if ($this->strAdminCode2 !== $strAdminCode2) {
			$this->strAdminCode2 = $strAdminCode2;
			$this->__blnDirty[self::ADMIN_CODE2_FIELD] = true;
		}
		$this->__blnValid[self::ADMIN_CODE2_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strAdminName3 
	* @throws Caller
	* @return string
	*/
	public function getAdminName3()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::ADMIN_NAME3_FIELD])) {
			throw new Caller("AdminName3 was not selected in the most recent query and is not valid.");
		}
		return $this->strAdminName3;
	}




   /**
	* Sets the value of strAdminName3 
	* Returns $this to allow chaining of setters.
	* @param string|null $strAdminName3
    * @throws Caller
	* @return City
	*/
	public function setAdminName3($strAdminName3)
    {
		$strAdminName3 = Type::Cast($strAdminName3, QCubed\Type::STRING);

		if ($this->strAdminName3 !== $strAdminName3) {
			$this->strAdminName3 = $strAdminName3;
			$this->__blnDirty[self::ADMIN_NAME3_FIELD] = true;
		}
		$this->__blnValid[self::ADMIN_NAME3_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strAdminCode3 
	* @throws Caller
	* @return string
	*/
	public function getAdminCode3()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::ADMIN_CODE3_FIELD])) {
			throw new Caller("AdminCode3 was not selected in the most recent query and is not valid.");
		}
		return $this->strAdminCode3;
	}




   /**
	* Sets the value of strAdminCode3 
	* Returns $this to allow chaining of setters.
	* @param string|null $strAdminCode3
    * @throws Caller
	* @return City
	*/
	public function setAdminCode3($strAdminCode3)
    {
		$strAdminCode3 = Type::Cast($strAdminCode3, QCubed\Type::STRING);

		if ($this->strAdminCode3 !== $strAdminCode3) {
			$this->strAdminCode3 = $strAdminCode3;
			$this->__blnDirty[self::ADMIN_CODE3_FIELD] = true;
		}
		$this->__blnValid[self::ADMIN_CODE3_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strLatitude 
	* @throws Caller
	* @return string
	*/
	public function getLatitude()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::LATITUDE_FIELD])) {
			throw new Caller("Latitude was not selected in the most recent query and is not valid.");
		}
		return $this->strLatitude;
	}




   /**
	* Sets the value of strLatitude 
	* Returns $this to allow chaining of setters.
	* @param string|null $strLatitude
    * @throws Caller
	* @return City
	*/
	public function setLatitude($strLatitude)
    {
		$strLatitude = Type::Cast($strLatitude, QCubed\Type::STRING);

		if ($this->strLatitude !== $strLatitude) {
			$this->strLatitude = $strLatitude;
			$this->__blnDirty[self::LATITUDE_FIELD] = true;
		}
		$this->__blnValid[self::LATITUDE_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strLongitude 
	* @throws Caller
	* @return string
	*/
	public function getLongitude()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::LONGITUDE_FIELD])) {
			throw new Caller("Longitude was not selected in the most recent query and is not valid.");
		}
		return $this->strLongitude;
	}




   /**
	* Sets the value of strLongitude 
	* Returns $this to allow chaining of setters.
	* @param string|null $strLongitude
    * @throws Caller
	* @return City
	*/
	public function setLongitude($strLongitude)
    {
		$strLongitude = Type::Cast($strLongitude, QCubed\Type::STRING);

		if ($this->strLongitude !== $strLongitude) {
			$this->strLongitude = $strLongitude;
			$this->__blnDirty[self::LONGITUDE_FIELD] = true;
		}
		$this->__blnValid[self::LONGITUDE_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of intAccuracy 
	* @throws Caller
	* @return integer
	*/
	public function getAccuracy()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::ACCURACY_FIELD])) {
			throw new Caller("Accuracy was not selected in the most recent query and is not valid.");
		}
		return $this->intAccuracy;
	}




   /**
	* Sets the value of intAccuracy 
	* Returns $this to allow chaining of setters.
	* @param integer|null $intAccuracy
    * @throws Caller
	* @return City
	*/
	public function setAccuracy($intAccuracy)
    {
		$intAccuracy = Type::Cast($intAccuracy, QCubed\Type::INTEGER);

		if ($this->intAccuracy !== $intAccuracy) {
			$this->intAccuracy = $intAccuracy;
			$this->__blnDirty[self::ACCURACY_FIELD] = true;
		}
		$this->__blnValid[self::ACCURACY_FIELD] = true;
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
		$objCopy->_objTourist = null;
		$objCopy->_objTouristArray = null;

		return $objCopy;
	}

    
   /**
	* The current record has just been inserted into the table. Let everyone know.
	* @param integer	$pk Primary key of record just inserted.
	*/
	protected static function broadcastInsert($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'city');
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
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'city');
        }
	}

   /**
	* The current record has just been deleted. Let everyone know.
	* @param integer	$pk Primary key of record just deleted.
	*/
	protected static function broadcastDelete($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'city');
        }
	}

   /**
	* All records have just been deleted. Let everyone know.
	*/
	protected static function broadcastDeleteAll()
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'city');
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

            case 'Tourist':
            case '_Tourist':
                /**
                 * Gets the value of the protected _objTourist (Read-Only)
                 * if set due to an expansion on the tourist.city_id reverse relationship
                 * @return Tourist
                 */
                return $this->_objTourist;

            case 'TouristArray':
            case '_TouristArray':
                /**
                 * Gets the value of the protected _objTouristArray (Read-Only)
                 * if set due to an ExpandAsArray on the tourist.city_id reverse relationship
                 * @return Tourist[]
                 */
                return $this->_objTouristArray;


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



    // Related Objects' Methods for Tourist
    //-------------------------------------------------------------------

    /**
     * Gets all associated Tourists as an array of Tourist objects
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return Tourist[]
     * @throws Caller
     */
    public function getTouristArray($objOptionalClauses = null)
    {
        if ((is_null($this->intId)))
            return array();

        try {
            return Tourist::LoadArrayByCityId($this->intId, $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Counts all associated Tourists
     * @return int
    */
    public function countTourists()
    {
        if ((is_null($this->intId)))
            return 0;

        return Tourist::CountByCityId($this->intId);
    }

    /**
     * Associates a Tourist
     * @param Tourist $objTourist
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
    */
    public function associateTourist(Tourist $objTourist)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateTourist on this unsaved City.');
        if ((is_null($objTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateTourist on this City with an unsaved Tourist.');

        // Get the Database Object for this Class
        $objDatabase = City::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `tourist`
            SET
                `city_id` = ' . $objDatabase->SqlVariable($this->intId) . '
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objTourist->Id) . '
        ');
    }

    /**
     * Unassociates a Tourist
     * @param Tourist $objTourist
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
    */
    public function unassociateTourist(Tourist $objTourist)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this unsaved City.');
        if ((is_null($objTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this City with an unsaved Tourist.');

        // Get the Database Object for this Class
        $objDatabase = City::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `tourist`
            SET
                `city_id` = null
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objTourist->Id) . ' AND
                `city_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Unassociates all Tourists
     * @return void
    */
    public function unassociateAllTourists()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this unsaved City.');

        // Get the Database Object for this Class
        $objDatabase = City::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `tourist`
            SET
                `city_id` = null
            WHERE
                `city_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Deletes an associated Tourist
     * @param Tourist $objTourist
     * @return void
    */
    public function deleteAssociatedTourist(Tourist $objTourist)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this unsaved City.');
        if ((is_null($objTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this City with an unsaved Tourist.');

        // Get the Database Object for this Class
        $objDatabase = City::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `tourist`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objTourist->Id) . ' AND
                `city_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Deletes all associated Tourists
     * @return void
    */
    public function deleteAllTourists()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this unsaved City.');

        // Get the Database Object for this Class
        $objDatabase = City::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `tourist`
            WHERE
                `city_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
        return "city";
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
     * @return NodeCity
     */
    public static function baseNode()
    {
        return QQN::City();
    }

    
    ////////////////////////////////////////
    // METHODS for SOAP-BASED WEB SERVICES
    ////////////////////////////////////////

    public static function getSoapComplexTypeXml()
    {
        $strToReturn = '<complexType name="City"><sequence>';
        $strToReturn .= '<element name="Id" type="xsd:int"/>';
        $strToReturn .= '<element name="CountryId" type="xsd:int"/>';
        $strToReturn .= '<element name="PostalCode" type="xsd:string"/>';
        $strToReturn .= '<element name="Name" type="xsd:string"/>';
        $strToReturn .= '<element name="AdminName1" type="xsd:string"/>';
        $strToReturn .= '<element name="AdminCode1" type="xsd:string"/>';
        $strToReturn .= '<element name="AdminName2" type="xsd:string"/>';
        $strToReturn .= '<element name="AdminCode2" type="xsd:string"/>';
        $strToReturn .= '<element name="AdminName3" type="xsd:string"/>';
        $strToReturn .= '<element name="AdminCode3" type="xsd:string"/>';
        $strToReturn .= '<element name="Latitude" type="xsd:string"/>';
        $strToReturn .= '<element name="Longitude" type="xsd:string"/>';
        $strToReturn .= '<element name="Accuracy" type="xsd:int"/>';
        $strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
        $strToReturn .= '</sequence></complexType>';
        return $strToReturn;
    }

    public static function alterSoapComplexTypeArray(&$strComplexTypeArray)
    {
        if (!array_key_exists('City', $strComplexTypeArray)) {
            $strComplexTypeArray['City'] = City::GetSoapComplexTypeXml();
        }
    }

    public static function getArrayFromSoapArray($objSoapArray)
    {
        $objArrayToReturn = array();

        foreach ($objSoapArray as $objSoapObject)
            array_push($objArrayToReturn, City::GetObjectFromSoapObject($objSoapObject));

        return $objArrayToReturn;
    }

    public static function getObjectFromSoapObject($objSoapObject)
    {
        $objToReturn = new City();
        if (property_exists($objSoapObject, 'Id'))
            $objToReturn->intId = $objSoapObject->Id;
        if (property_exists($objSoapObject, 'CountryId'))
            $objToReturn->intCountryId = $objSoapObject->CountryId;
        if (property_exists($objSoapObject, 'PostalCode'))
            $objToReturn->strPostalCode = $objSoapObject->PostalCode;
        if (property_exists($objSoapObject, 'Name'))
            $objToReturn->strName = $objSoapObject->Name;
        if (property_exists($objSoapObject, 'AdminName1'))
            $objToReturn->strAdminName1 = $objSoapObject->AdminName1;
        if (property_exists($objSoapObject, 'AdminCode1'))
            $objToReturn->strAdminCode1 = $objSoapObject->AdminCode1;
        if (property_exists($objSoapObject, 'AdminName2'))
            $objToReturn->strAdminName2 = $objSoapObject->AdminName2;
        if (property_exists($objSoapObject, 'AdminCode2'))
            $objToReturn->strAdminCode2 = $objSoapObject->AdminCode2;
        if (property_exists($objSoapObject, 'AdminName3'))
            $objToReturn->strAdminName3 = $objSoapObject->AdminName3;
        if (property_exists($objSoapObject, 'AdminCode3'))
            $objToReturn->strAdminCode3 = $objSoapObject->AdminCode3;
        if (property_exists($objSoapObject, 'Latitude'))
            $objToReturn->strLatitude = $objSoapObject->Latitude;
        if (property_exists($objSoapObject, 'Longitude'))
            $objToReturn->strLongitude = $objSoapObject->Longitude;
        if (property_exists($objSoapObject, 'Accuracy'))
            $objToReturn->intAccuracy = $objSoapObject->Accuracy;
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
            array_push($objArrayToReturn, City::GetSoapObjectFromObject($objObject, true));

        return unserialize(serialize($objArrayToReturn));
    }

    public static function getSoapObjectFromObject($objObject, $blnBindRelatedObjects)
    {
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
        if (isset($this->__blnValid[self::COUNTRY_ID_FIELD])) {
            $iArray['CountryId'] = $this->intCountryId;
        }
        if (isset($this->__blnValid[self::POSTAL_CODE_FIELD])) {
            $iArray['PostalCode'] = $this->strPostalCode;
        }
        if (isset($this->__blnValid[self::NAME_FIELD])) {
            $iArray['Name'] = $this->strName;
        }
        if (isset($this->__blnValid[self::ADMIN_NAME1_FIELD])) {
            $iArray['AdminName1'] = $this->strAdminName1;
        }
        if (isset($this->__blnValid[self::ADMIN_CODE1_FIELD])) {
            $iArray['AdminCode1'] = $this->strAdminCode1;
        }
        if (isset($this->__blnValid[self::ADMIN_NAME2_FIELD])) {
            $iArray['AdminName2'] = $this->strAdminName2;
        }
        if (isset($this->__blnValid[self::ADMIN_CODE2_FIELD])) {
            $iArray['AdminCode2'] = $this->strAdminCode2;
        }
        if (isset($this->__blnValid[self::ADMIN_NAME3_FIELD])) {
            $iArray['AdminName3'] = $this->strAdminName3;
        }
        if (isset($this->__blnValid[self::ADMIN_CODE3_FIELD])) {
            $iArray['AdminCode3'] = $this->strAdminCode3;
        }
        if (isset($this->__blnValid[self::LATITUDE_FIELD])) {
            $iArray['Latitude'] = $this->strLatitude;
        }
        if (isset($this->__blnValid[self::LONGITUDE_FIELD])) {
            $iArray['Longitude'] = $this->strLongitude;
        }
        if (isset($this->__blnValid[self::ACCURACY_FIELD])) {
            $iArray['Accuracy'] = $this->intAccuracy;
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
     * any query calls (like Load or QueryArray), with a call to City::ClearCache()
     *
     * @return array An array that is json serializable
     */
    public function jsonSerialize ()
    {
        $a = [];
        if (isset($this->__blnValid[self::ID_FIELD])) {
            $a['id'] = $this->intId;
        }
        if (isset($this->__blnValid[self::COUNTRY_ID_FIELD])) {
            $a['country_id'] = $this->intCountryId;
        }
        if (isset($this->__blnValid[self::POSTAL_CODE_FIELD])) {
            $a['postal_code'] = $this->strPostalCode;
        }
        if (isset($this->__blnValid[self::NAME_FIELD])) {
            $a['name'] = $this->strName;
        }
        if (isset($this->__blnValid[self::ADMIN_NAME1_FIELD])) {
            $a['admin_name1'] = $this->strAdminName1;
        }
        if (isset($this->__blnValid[self::ADMIN_CODE1_FIELD])) {
            $a['admin_code1'] = $this->strAdminCode1;
        }
        if (isset($this->__blnValid[self::ADMIN_NAME2_FIELD])) {
            $a['admin_name2'] = $this->strAdminName2;
        }
        if (isset($this->__blnValid[self::ADMIN_CODE2_FIELD])) {
            $a['admin_code2'] = $this->strAdminCode2;
        }
        if (isset($this->__blnValid[self::ADMIN_NAME3_FIELD])) {
            $a['admin_name3'] = $this->strAdminName3;
        }
        if (isset($this->__blnValid[self::ADMIN_CODE3_FIELD])) {
            $a['admin_code3'] = $this->strAdminCode3;
        }
        if (isset($this->__blnValid[self::LATITUDE_FIELD])) {
            $a['latitude'] = $this->strLatitude;
        }
        if (isset($this->__blnValid[self::LONGITUDE_FIELD])) {
            $a['longitude'] = $this->strLongitude;
        }
        if (isset($this->__blnValid[self::ACCURACY_FIELD])) {
            $a['accuracy'] = $this->intAccuracy;
        }
        if (isset($this->_objTourist)) {
            $a['tourist'] = $this->_objTourist;
        } elseif (isset($this->_objTouristArray)) {
            $a['tourist'] = $this->_objTouristArray;
        }
        return $a;
    }



    

}



/////////////////////////////////////
// ADDITIONAL CLASSES for QCubed QUERY
/////////////////////////////////////

/**
 * @property-read Node\Column $Id
 * @property-read Node\Column $CountryId
 * @property-read Node\Column $PostalCode
 * @property-read Node\Column $Name
 * @property-read Node\Column $AdminName1
 * @property-read Node\Column $AdminCode1
 * @property-read Node\Column $AdminName2
 * @property-read Node\Column $AdminCode2
 * @property-read Node\Column $AdminName3
 * @property-read Node\Column $AdminCode3
 * @property-read Node\Column $Latitude
 * @property-read Node\Column $Longitude
 * @property-read Node\Column $Accuracy
 * @property-read ReverseReferenceNodeTourist $Tourist
 * @property-read Node\Column $_PrimaryKeyNode
 **/
class NodeCity extends Node\Table {
    protected $strTableName = 'city';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'City';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "country_id",
            "postal_code",
            "name",
            "admin_name1",
            "admin_code1",
            "admin_name2",
            "admin_code2",
            "admin_name3",
            "admin_code3",
            "latitude",
            "longitude",
            "accuracy",
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
            case 'CountryId':
                return new Node\Column('country_id', 'CountryId', 'Integer', $this);
            case 'PostalCode':
                return new Node\Column('postal_code', 'PostalCode', 'VarChar', $this);
            case 'Name':
                return new Node\Column('name', 'Name', 'VarChar', $this);
            case 'AdminName1':
                return new Node\Column('admin_name1', 'AdminName1', 'VarChar', $this);
            case 'AdminCode1':
                return new Node\Column('admin_code1', 'AdminCode1', 'VarChar', $this);
            case 'AdminName2':
                return new Node\Column('admin_name2', 'AdminName2', 'VarChar', $this);
            case 'AdminCode2':
                return new Node\Column('admin_code2', 'AdminCode2', 'VarChar', $this);
            case 'AdminName3':
                return new Node\Column('admin_name3', 'AdminName3', 'VarChar', $this);
            case 'AdminCode3':
                return new Node\Column('admin_code3', 'AdminCode3', 'VarChar', $this);
            case 'Latitude':
                return new Node\Column('latitude', 'Latitude', 'VarChar', $this);
            case 'Longitude':
                return new Node\Column('longitude', 'Longitude', 'VarChar', $this);
            case 'Accuracy':
                return new Node\Column('accuracy', 'Accuracy', 'Integer', $this);
            case 'Tourist':
                return new ReverseReferenceNodeTourist($this, 'tourist', \QCubed\Type::REVERSE_REFERENCE, 'city_id', 'Tourist');

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
 * @property-read Node\Column $CountryId
 * @property-read Node\Column $PostalCode
 * @property-read Node\Column $Name
 * @property-read Node\Column $AdminName1
 * @property-read Node\Column $AdminCode1
 * @property-read Node\Column $AdminName2
 * @property-read Node\Column $AdminCode2
 * @property-read Node\Column $AdminName3
 * @property-read Node\Column $AdminCode3
 * @property-read Node\Column $Latitude
 * @property-read Node\Column $Longitude
 * @property-read Node\Column $Accuracy
 * @property-read ReverseReferenceNodeTourist $Tourist

 * @property-read Node\Column $_PrimaryKeyNode
 **/
class ReverseReferenceNodeCity extends Node\ReverseReference {
    protected $strTableName = 'city';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'City';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "country_id",
            "postal_code",
            "name",
            "admin_name1",
            "admin_code1",
            "admin_name2",
            "admin_code2",
            "admin_name3",
            "admin_code3",
            "latitude",
            "longitude",
            "accuracy",
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
            case 'CountryId':
                return new Node\Column('country_id', 'CountryId', 'Integer', $this);
            case 'PostalCode':
                return new Node\Column('postal_code', 'PostalCode', 'VarChar', $this);
            case 'Name':
                return new Node\Column('name', 'Name', 'VarChar', $this);
            case 'AdminName1':
                return new Node\Column('admin_name1', 'AdminName1', 'VarChar', $this);
            case 'AdminCode1':
                return new Node\Column('admin_code1', 'AdminCode1', 'VarChar', $this);
            case 'AdminName2':
                return new Node\Column('admin_name2', 'AdminName2', 'VarChar', $this);
            case 'AdminCode2':
                return new Node\Column('admin_code2', 'AdminCode2', 'VarChar', $this);
            case 'AdminName3':
                return new Node\Column('admin_name3', 'AdminName3', 'VarChar', $this);
            case 'AdminCode3':
                return new Node\Column('admin_code3', 'AdminCode3', 'VarChar', $this);
            case 'Latitude':
                return new Node\Column('latitude', 'Latitude', 'VarChar', $this);
            case 'Longitude':
                return new Node\Column('longitude', 'Longitude', 'VarChar', $this);
            case 'Accuracy':
                return new Node\Column('accuracy', 'Accuracy', 'Integer', $this);
            case 'Tourist':
                return new ReverseReferenceNodeTourist($this, 'tourist', \QCubed\Type::REVERSE_REFERENCE, 'city_id', 'Tourist');

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
