<?php
/**
 * Generated Tourist base class file
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
 * Class TouristGen
 *
 * The abstract TouristGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the Tourist subclass which
 * extends this TouristGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the Tourist class.
 *
 * @package My QCubed Application
 * @subpackage ModelGen
 * @property-read integer $Id the value of the id column (Read-Only PK)
 * @property string $Name the value of the name column (Not Null)
 * @property string $Passport the value of the passport column (Not Null)
 * @property string $Contactinfo the value of the contactinfo column 
 * @property integer $LanguageId the value of the language_id column 
 * @property integer $CityId the value of the city_id column 
 * @property integer $CountryId the value of the country_id column 
 * @property Language $Language the value of the Language object referenced by intLanguageId 
 * @property City $City the value of the City object referenced by intCityId 
 * @property Country $Country the value of the Country object referenced by intCountryId 
 * @property-read DeviceTourist $_DeviceTourist the value of the protected _objDeviceTourist (Read-Only) if set due to an expansion on the device_tourist.tourist_id reverse relationship
 * @property-read DeviceTourist $DeviceTourist the value of the protected _objDeviceTourist (Read-Only) if set due to an expansion on the device_tourist.tourist_id reverse relationship
 * @property-read DeviceTourist[] $_DeviceTouristArray the value of the protected _objDeviceTouristArray (Read-Only) if set due to an ExpandAsArray on the device_tourist.tourist_id reverse relationship
 * @property-read DeviceTourist[] $DeviceTouristArray the value of the protected _objDeviceTouristArray (Read-Only) if set due to an ExpandAsArray on the device_tourist.tourist_id reverse relationship
 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
 */
abstract class TouristGen extends \QCubed\ObjectBase implements IteratorAggregate, JsonSerializable {

    use ModelTrait;

    /** @var boolean Set to false in superclass to save a little time if this db object should not be watched for changes. */
    public static $blnWatchChanges = true;

    /** @var Tourist[] Short term cached Tourist objects */
    protected static $objCacheArray = array();

    ///////////////////////////////////////////////////////////////////////
    // PROTECTED AND PRIVATE MEMBER VARIABLES and CONSTS
    ///////////////////////////////////////////////////////////////////////

    /**
     * Protected member variable that maps to the database PK Identity column tourist.id
     * @var integer intId
     */
    private $intId;

    const ID_DEFAULT = null;
    const ID_FIELD = 'id';


    /**
     * Protected member variable that maps to the database column tourist.name
     * @var string strName
     */
    private $strName;
    const NameMaxLength = 45; // Deprecated
    const NAME_MAX_LENGTH = 45;

    const NAME_DEFAULT = null;
    const NAME_FIELD = 'name';


    /**
     * Protected member variable that maps to the database column tourist.passport
     * @var string strPassport
     */
    private $strPassport;
    const PassportMaxLength = 45; // Deprecated
    const PASSPORT_MAX_LENGTH = 45;

    const PASSPORT_DEFAULT = null;
    const PASSPORT_FIELD = 'passport';


    /**
     * Protected member variable that maps to the database column tourist.contactinfo
     * @var string strContactinfo
     */
    private $strContactinfo;
    const ContactinfoMaxLength = 45; // Deprecated
    const CONTACTINFO_MAX_LENGTH = 45;

    const CONTACTINFO_DEFAULT = null;
    const CONTACTINFO_FIELD = 'contactinfo';


    /**
     * Protected member variable that maps to the database column tourist.language_id
     * @var integer intLanguageId
     */
    private $intLanguageId;

    const LANGUAGE_ID_DEFAULT = null;
    const LANGUAGE_ID_FIELD = 'language_id';


    /**
     * Protected member variable that maps to the database column tourist.city_id
     * @var integer intCityId
     */
    private $intCityId;

    const CITY_ID_DEFAULT = null;
    const CITY_ID_FIELD = 'city_id';


    /**
     * Protected member variable that maps to the database column tourist.country_id
     * @var integer intCountryId
     */
    private $intCountryId;

    const COUNTRY_ID_DEFAULT = null;
    const COUNTRY_ID_FIELD = 'country_id';


    /**
     * Protected member variable that stores a reference to a single DeviceTourist object
     * (of type DeviceTourist), if this Tourist object was restored with
     * an expansion on the device_tourist association table.
     * @var DeviceTourist _objDeviceTourist;
     */
    protected $_objDeviceTourist;

    /**
     * Protected member variable that stores a reference to an array of DeviceTourist objects
     * (of type DeviceTourist[]), if this Tourist object was restored with
     * an ExpandAsArray on the device_tourist association table.
     * @var DeviceTourist[] _objDeviceTouristArray;
     */
    protected $_objDeviceTouristArray = null;

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
     * in the database column tourist.language_id.
     *
     * NOTE: Always use the Language property getter to correctly retrieve this Language object.
     * (Because this class implements late binding, this variable reference MAY be null.)
     * @var Language objLanguage
     */
    protected $objLanguage;

    /**
     * Protected member variable that contains the object pointed by the reference
     * in the database column tourist.city_id.
     *
     * NOTE: Always use the City property getter to correctly retrieve this City object.
     * (Because this class implements late binding, this variable reference MAY be null.)
     * @var City objCity
     */
    protected $objCity;

    /**
     * Protected member variable that contains the object pointed by the reference
     * in the database column tourist.country_id.
     *
     * NOTE: Always use the Country property getter to correctly retrieve this Country object.
     * (Because this class implements late binding, this variable reference MAY be null.)
     * @var Country objCountry
     */
    protected $objCountry;



    /**
     * Construct a new Tourist object.
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
        $this->strName = Tourist::NAME_DEFAULT;
        $this->__blnValid[self::NAME_FIELD] = true;
        $this->strPassport = Tourist::PASSPORT_DEFAULT;
        $this->__blnValid[self::PASSPORT_FIELD] = true;
        $this->strContactinfo = Tourist::CONTACTINFO_DEFAULT;
        $this->__blnValid[self::CONTACTINFO_FIELD] = true;
        $this->intLanguageId = Tourist::LANGUAGE_ID_DEFAULT;
        $this->__blnValid[self::LANGUAGE_ID_FIELD] = true;
        $this->intCityId = Tourist::CITY_ID_DEFAULT;
        $this->__blnValid[self::CITY_ID_FIELD] = true;
        $this->intCountryId = Tourist::COUNTRY_ID_DEFAULT;
        $this->__blnValid[self::COUNTRY_ID_FIELD] = true;
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
     * Load a Tourist from PK Info
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return Tourist
     */
    public static function load($intId, $objOptionalClauses = null)
    {
        if (!$objOptionalClauses) {
            $objCachedObject = static::getFromCache ($intId);
            if ($objCachedObject) return $objCachedObject;
        }

        // Use QuerySingle to Perform the Query
        $objToReturn = Tourist::querySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::Tourist()->Id, $intId)
            ),
            $objOptionalClauses
        );
        return $objToReturn;
    }


    /**
     * Load all Tourists
     * @param iClause[]|null $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return Tourist[]
     * @throws Caller
     */
    public static function loadAll($objOptionalClauses = null)
    {
        if (func_num_args() > 1) {
            throw new Caller("LoadAll must be called with an array of optional clauses as a single argument");
        }
        // Call Tourist::queryArray to perform the LoadAll query
        try {
            return Tourist::queryArray(QQ::All(), $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count all Tourists
     * @return int
     */
    public static function countAll()
    {
        // Call Tourist::queryCount to perform the CountAll query
        return Tourist::queryCount(QQ::All());
    }


    /**
     * Static Qcubed Query method to query for a single Tourist object.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return Tourist the queried object
     */
    public static function querySingle(iCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null)
    {
        return static::_QuerySingle($objConditions, $objOptionalClauses, $mixParameterArray);
    }

    /**
     * Static Qcubed Query method to query for an array of Tourist objects.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return Tourist[] the queried objects as an array
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
        $clauses[] = QQ::Select(QQN::Tourist()->Id);
        $objTourists = self::QueryArray($objConditions, $clauses);
        $pks = [];
        foreach ($objTourists as $objTourist) {
            $pks[] = $objTourist->intId;
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
    * @return Tourist the queried object
    */
    public static function getFromCache($key)
    {
        return static::_GetFromCache($key);
    }


    /**
     * Instantiate a Tourist from a Database Row.
     * Takes in an optional strAliasPrefix, used in case another Object::instantiateDbRow
     * is calling this Tourist::instantiateDbRow in order to perform
     * early binding on referenced objects.
     * @param \QCubed\Database\RowBase $objDbRow
     * @param string $strAliasPrefix
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param array|null $objPreviousItemArray Used by expansion code to aid in expanding arrays
     * @param string[] $strColumnAliasArray Array of column aliases mapping names in the query to items in the object
     * @param boolean $blnCheckDuplicate Used by ExpandArray to indicate we should not create a new object if this is a duplicate of a previoius object
     * @param string $strParentExpansionKey If this is part of an expansion, indicates what the parent item is
     * @param mixed $objExpansionParent If this is part of an expansion, is the object corresponding to the key so that we can refer back to the parent object
     * @return mixed Either a Tourist, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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
            // Create a new instance of the Tourist object
            $objToReturn = new Tourist(false);
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
            $strAlias = $strAliasPrefix . 'passport';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strPassport = $mixVal;
                $objToReturn->__blnValid[self::PASSPORT_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'contactinfo';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strContactinfo = $mixVal;
                $objToReturn->__blnValid[self::CONTACTINFO_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'language_id';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = (integer)$mixVal;
                }
                $objToReturn->intLanguageId = $mixVal;
                $objToReturn->__blnValid[self::LANGUAGE_ID_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'city_id';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = (integer)$mixVal;
                }
                $objToReturn->intCityId = $mixVal;
                $objToReturn->__blnValid[self::CITY_ID_FIELD] = true;
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
            $strAliasPrefix = 'tourist__';

        // Check for Language Early Binding
        $strAlias = $strAliasPrefix . 'language_id__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        if (isset ($strColumns[$strAliasName])) {
            $objExpansionNode = (empty($objExpansionAliasArray['language_id']) ? null : $objExpansionAliasArray['language_id']);
            $objToReturn->objLanguage = Language::instantiateDbRow($objDbRow, $strAliasPrefix . 'language_id__', $objExpansionNode, null, $strColumnAliasArray, false, 'tourist', $objToReturn);
        }
        elseif ($strParentExpansionKey === 'language_id' && $objExpansionParent) {
            $objToReturn->objLanguage = $objExpansionParent;
        }

        // Check for City Early Binding
        $strAlias = $strAliasPrefix . 'city_id__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        if (isset ($strColumns[$strAliasName])) {
            $objExpansionNode = (empty($objExpansionAliasArray['city_id']) ? null : $objExpansionAliasArray['city_id']);
            $objToReturn->objCity = City::instantiateDbRow($objDbRow, $strAliasPrefix . 'city_id__', $objExpansionNode, null, $strColumnAliasArray, false, 'tourist', $objToReturn);
        }
        elseif ($strParentExpansionKey === 'city_id' && $objExpansionParent) {
            $objToReturn->objCity = $objExpansionParent;
        }

        // Check for Country Early Binding
        $strAlias = $strAliasPrefix . 'country_id__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        if (isset ($strColumns[$strAliasName])) {
            $objExpansionNode = (empty($objExpansionAliasArray['country_id']) ? null : $objExpansionAliasArray['country_id']);
            $objToReturn->objCountry = Country::instantiateDbRow($objDbRow, $strAliasPrefix . 'country_id__', $objExpansionNode, null, $strColumnAliasArray, false, 'tourist', $objToReturn);
        }
        elseif ($strParentExpansionKey === 'country_id' && $objExpansionParent) {
            $objToReturn->objCountry = $objExpansionParent;
        }




        // Check for DeviceTourist Virtual Binding
        $strAlias = $strAliasPrefix . 'devicetourist__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        $objExpansionNode = (empty($objExpansionAliasArray['devicetourist']) ? null : $objExpansionAliasArray['devicetourist']);
        $blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
        if ($blnExpanded && null === $objToReturn->_objDeviceTouristArray)
            $objToReturn->_objDeviceTouristArray = array();
        if (isset ($strColumns[$strAliasName])) {
            if ($blnExpanded) {
                $objToReturn->_objDeviceTouristArray[] = DeviceTourist::instantiateDbRow($objDbRow, $strAliasPrefix . 'devicetourist__', $objExpansionNode, null, $strColumnAliasArray, false, 'tourist_id', $objToReturn);
            } elseif (is_null($objToReturn->_objDeviceTourist)) {
                $objToReturn->_objDeviceTourist = DeviceTourist::instantiateDbRow($objDbRow, $strAliasPrefix . 'devicetourist__', $objExpansionNode, null, $strColumnAliasArray, false, 'tourist_id', $objToReturn);
            }
        }
        elseif ($strParentExpansionKey === 'devicetourist' && $objExpansionParent) {
            $objToReturn->_objDeviceTourist = $objExpansionParent;
        }

        return $objToReturn;
    }

    /**
     * Instantiate an array of Tourists from a Database Result
     * @param \QCubed\Database\ResultBase $objDbResult
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param string[] $strColumnAliasArray
     * @return Tourist[]
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
                $objItem = Tourist::instantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
                if ($objItem) {
                    $objToReturn[] = $objItem;
                    $objPrevItemArray[$objItem->intId][] = $objItem;
		
                }
            }
        } else {
            while ($objDbRow = $objDbResult->GetNextRow())
                $objToReturn[] = Tourist::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
        }

        return $objToReturn;
    }


    /**
     * Instantiate a single Tourist object from a query cursor (e.g. a DB ResultSet).
     * Cursor is automatically moved to the "next row" of the result set.
     * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
     * @param \QCubed\Database\ResultBase $objDbResult cursor resource
     * @return Tourist next row resulting from the query
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
        return Tourist::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
    }



    ///////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Single Load and Array)
    ///////////////////////////////////////////////////

    /**
     * Load a single Tourist object,
     * by Id Index(es)
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return Tourist
    */
    public static function loadById($intId, $objOptionalClauses = null)
    {
        return Tourist::QuerySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::Tourist()->Id, $intId)
            ),
            $objOptionalClauses
        );
    }

    /**
     * Load an array of Tourist objects,
     * by LanguageId Index(es)
     * @param integer $intLanguageId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return Tourist[]
    */
    public static function loadArrayByLanguageId($intLanguageId, $objOptionalClauses = null)
    {
        // Call Tourist::QueryArray to perform the LoadArrayByLanguageId query
        try {
            return Tourist::QueryArray(
                QQ::Equal(QQN::Tourist()->LanguageId, $intLanguageId),
                $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count Tourists
     * by LanguageId Index(es)
     * @param integer $intLanguageId
     * @return int
    */
    public static function countByLanguageId($intLanguageId)
    {
        // Call Tourist::QueryCount to perform the CountByLanguageId query
        return Tourist::QueryCount(
            QQ::Equal(QQN::Tourist()->LanguageId, $intLanguageId)
        );
    }

    /**
     * Load an array of Tourist objects,
     * by CityId Index(es)
     * @param integer $intCityId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return Tourist[]
    */
    public static function loadArrayByCityId($intCityId, $objOptionalClauses = null)
    {
        // Call Tourist::QueryArray to perform the LoadArrayByCityId query
        try {
            return Tourist::QueryArray(
                QQ::Equal(QQN::Tourist()->CityId, $intCityId),
                $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count Tourists
     * by CityId Index(es)
     * @param integer $intCityId
     * @return int
    */
    public static function countByCityId($intCityId)
    {
        // Call Tourist::QueryCount to perform the CountByCityId query
        return Tourist::QueryCount(
            QQ::Equal(QQN::Tourist()->CityId, $intCityId)
        );
    }

    /**
     * Load an array of Tourist objects,
     * by CountryId Index(es)
     * @param integer $intCountryId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return Tourist[]
    */
    public static function loadArrayByCountryId($intCountryId, $objOptionalClauses = null)
    {
        // Call Tourist::QueryArray to perform the LoadArrayByCountryId query
        try {
            return Tourist::QueryArray(
                QQ::Equal(QQN::Tourist()->CountryId, $intCountryId),
                $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count Tourists
     * by CountryId Index(es)
     * @param integer $intCountryId
     * @return int
    */
    public static function countByCountryId($intCountryId)
    {
        // Call Tourist::QueryCount to perform the CountByCountryId query
        return Tourist::QueryCount(
            QQ::Equal(QQN::Tourist()->CountryId, $intCountryId)
        );
    }


    ////////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Array via Many to Many)
    ////////////////////////////////////////////////////




    //////////////////////////
    // SAVE, DELETE AND RELOAD
    //////////////////////////
    

    /**
    * Save this Tourist
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
     * Insert into Tourist
     */
    protected function insert()
    {
        $mixToReturn = null;
        $objDatabase = Tourist::GetDatabase();

        $objDatabase->NonQuery('
            INSERT INTO `tourist` (
							`name`,
							`passport`,
							`contactinfo`,
							`language_id`,
							`city_id`,
							`country_id`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strName) . ',
							' . $objDatabase->SqlVariable($this->strPassport) . ',
							' . $objDatabase->SqlVariable($this->strContactinfo) . ',
							' . $objDatabase->SqlVariable($this->intLanguageId) . ',
							' . $objDatabase->SqlVariable($this->intCityId) . ',
							' . $objDatabase->SqlVariable($this->intCountryId) . '
						)
        ');
        // Update Identity column and return its value
        $mixToReturn = $this->intId = $objDatabase->InsertId('tourist', 'id');
        $this->__blnValid[self::ID_FIELD] = true;


        static::broadcastInsert($this->PrimaryKey());

        return $mixToReturn;
    }

   /**
    * Update this Tourist
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
            `tourist`
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

		if (isset($this->__blnDirty[self::NAME_FIELD])) {
			$strCol = '`name`';
			$strValue = $objDatabase->sqlVariable($this->strName);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::PASSPORT_FIELD])) {
			$strCol = '`passport`';
			$strValue = $objDatabase->sqlVariable($this->strPassport);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::CONTACTINFO_FIELD])) {
			$strCol = '`contactinfo`';
			$strValue = $objDatabase->sqlVariable($this->strContactinfo);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::LANGUAGE_ID_FIELD])) {
			$strCol = '`language_id`';
			$strValue = $objDatabase->sqlVariable($this->intLanguageId);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::CITY_ID_FIELD])) {
			$strCol = '`city_id`';
			$strValue = $objDatabase->sqlVariable($this->intCityId);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::COUNTRY_ID_FIELD])) {
			$strCol = '`country_id`';
			$strValue = $objDatabase->sqlVariable($this->intCountryId);
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
     * Delete this Tourist
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
     */
    public function delete()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Cannot delete this Tourist with an unset primary key.');

        // Get the Database Object for this Class
        $objDatabase = Tourist::GetDatabase();


        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `tourist`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($this->intId) . '');

        $this->DeleteFromCache();
        static::BroadcastDelete($this->PrimaryKey());
    }

    /**
     * Delete all Tourists
     * @return void
     */
    public static function deleteAll()
    {
        // Get the Database Object for this Class
        $objDatabase = Tourist::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            DELETE FROM
                `tourist`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    /**
     * Truncate tourist table
     * @return void
     */
    public static function truncate()
    {
        // Get the Database Object for this Class
        $objDatabase = Tourist::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            TRUNCATE `tourist`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    
    /**
	 * Reload this Tourist from the database.
     * @param iClause[]|null $clauses
     * @throws Caller
	 * @return void
	 */
	public function reload($clauses = null)
    {
		// Make sure we are actually Restored from the database
		if (!$this->__blnRestored)
			throw new Caller('Cannot call Reload() on a new, unsaved Tourist object.');

		// throw away all previous state of the object
		$this->DeleteFromCache();
		$this->__blnValid = null;
		$this->__blnDirty = null;

		// Reload the Object
		$objReloaded = Tourist::Load($this->intId, $clauses);

		// Update $this's local variables to match
		$this->__blnValid[self::ID_FIELD] = true;
		if (isset($objReloaded->__blnValid[self::NAME_FIELD])) {
			$this->strName = $objReloaded->strName;
			$this->__blnValid[self::NAME_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::PASSPORT_FIELD])) {
			$this->strPassport = $objReloaded->strPassport;
			$this->__blnValid[self::PASSPORT_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::CONTACTINFO_FIELD])) {
			$this->strContactinfo = $objReloaded->strContactinfo;
			$this->__blnValid[self::CONTACTINFO_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::LANGUAGE_ID_FIELD])) {
			$this->intLanguageId = $objReloaded->intLanguageId;
			$this->objLanguage = $objReloaded->objLanguage;
			$this->__blnValid[self::LANGUAGE_ID_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::CITY_ID_FIELD])) {
			$this->intCityId = $objReloaded->intCityId;
			$this->objCity = $objReloaded->objCity;
			$this->__blnValid[self::CITY_ID_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::COUNTRY_ID_FIELD])) {
			$this->intCountryId = $objReloaded->intCountryId;
			$this->objCountry = $objReloaded->objCountry;
			$this->__blnValid[self::COUNTRY_ID_FIELD] = true;
		}
	}
    ////////////////////
    // UTILITIES
    ////////////////////
    
    /**
     *  Return an array of Tourists keyed by the unique Id property.
     *	@param Tourist[]
     *	@return Tourist[]
     **/
    public static function keyTouristsById($tourists) {
        if (empty($tourists)) {
            return $tourists;
        }
        $ret = [];
        foreach ($tourists as $tourist) {
            $ret[$tourist->intId] = $tourist;
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
	* Gets the value of strName (Not Null)
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
	* Sets the value of strName (Not Null)
	* Returns $this to allow chaining of setters.
	* @param string $strName
    * @throws Caller
	* @return Tourist
	*/
	public function setName($strName)
    {
        if ($strName === null) {
             // invalidate
             $strName = null;
             $this->__blnValid[self::NAME_FIELD] = false;
            return $this; // allows chaining
        }
		$strName = Type::Cast($strName, QCubed\Type::STRING);

		if ($this->strName !== $strName) {
			$this->strName = $strName;
			$this->__blnDirty[self::NAME_FIELD] = true;
		}
		$this->__blnValid[self::NAME_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strPassport (Not Null)
	* @throws Caller
	* @return string
	*/
	public function getPassport()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::PASSPORT_FIELD])) {
			throw new Caller("Passport was not selected in the most recent query and is not valid.");
		}
		return $this->strPassport;
	}




   /**
	* Sets the value of strPassport (Not Null)
	* Returns $this to allow chaining of setters.
	* @param string $strPassport
    * @throws Caller
	* @return Tourist
	*/
	public function setPassport($strPassport)
    {
        if ($strPassport === null) {
             // invalidate
             $strPassport = null;
             $this->__blnValid[self::PASSPORT_FIELD] = false;
            return $this; // allows chaining
        }
		$strPassport = Type::Cast($strPassport, QCubed\Type::STRING);

		if ($this->strPassport !== $strPassport) {
			$this->strPassport = $strPassport;
			$this->__blnDirty[self::PASSPORT_FIELD] = true;
		}
		$this->__blnValid[self::PASSPORT_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strContactinfo 
	* @throws Caller
	* @return string
	*/
	public function getContactinfo()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::CONTACTINFO_FIELD])) {
			throw new Caller("Contactinfo was not selected in the most recent query and is not valid.");
		}
		return $this->strContactinfo;
	}




   /**
	* Sets the value of strContactinfo 
	* Returns $this to allow chaining of setters.
	* @param string|null $strContactinfo
    * @throws Caller
	* @return Tourist
	*/
	public function setContactinfo($strContactinfo)
    {
		$strContactinfo = Type::Cast($strContactinfo, QCubed\Type::STRING);

		if ($this->strContactinfo !== $strContactinfo) {
			$this->strContactinfo = $strContactinfo;
			$this->__blnDirty[self::CONTACTINFO_FIELD] = true;
		}
		$this->__blnValid[self::CONTACTINFO_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of intLanguageId 
	* @throws Caller
	* @return integer
	*/
	public function getLanguageId()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::LANGUAGE_ID_FIELD])) {
			throw new Caller("LanguageId was not selected in the most recent query and is not valid.");
		}
		return $this->intLanguageId;
	}


    /**
     * Gets the value of the Language object referenced by intLanguageId 
     * If the object is not loaded, will load the object (caching it) before returning it.
     * @throws Caller
     * @return Language
     */
     public function getLanguage()
     {
 		if ($this->__blnRestored && empty($this->__blnValid[self::LANGUAGE_ID_FIELD])) {
			throw new Caller("LanguageId was not selected in the most recent query and is not valid.");
		}
        if ((!$this->objLanguage) && (!is_null($this->intLanguageId))) {
            $this->objLanguage = Language::Load($this->intLanguageId);
        }
        return $this->objLanguage;
     }



   /**
	* Sets the value of intLanguageId 
	* Returns $this to allow chaining of setters.
	* @param integer|null $intLanguageId
    * @throws Caller
	* @return Tourist
	*/
	public function setLanguageId($intLanguageId)
    {
		$intLanguageId = Type::Cast($intLanguageId, QCubed\Type::INTEGER);

		if ($this->intLanguageId !== $intLanguageId) {
			$this->objLanguage = null; // remove the associated object
			$this->intLanguageId = $intLanguageId;
			$this->__blnDirty[self::LANGUAGE_ID_FIELD] = true;
		}
		$this->__blnValid[self::LANGUAGE_ID_FIELD] = true;
		return $this; // allows chaining
	}

    /**
     * Sets the value of the Language object referenced by intLanguageId 
     * @param null|Language $objLanguage
     * @throws Caller
     * @return Tourist
     */
    public function setLanguage($objLanguage) {
        if (is_null($objLanguage)) {
            $this->setLanguageId(null);
        } else {
            $objLanguage = Type::Cast($objLanguage, 'Language');

            // Make sure its a SAVED Language object
            if (is_null($objLanguage->Id)) {
                throw new Caller('Unable to set an unsaved Language for this Tourist');
            }

            // Update Local Member Variables
            $this->setLanguageId($objLanguage->getId());
            $this->objLanguage = $objLanguage;
        }
        return $this;
    }

   /**
	* Gets the value of intCityId 
	* @throws Caller
	* @return integer
	*/
	public function getCityId()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::CITY_ID_FIELD])) {
			throw new Caller("CityId was not selected in the most recent query and is not valid.");
		}
		return $this->intCityId;
	}


    /**
     * Gets the value of the City object referenced by intCityId 
     * If the object is not loaded, will load the object (caching it) before returning it.
     * @throws Caller
     * @return City
     */
     public function getCity()
     {
 		if ($this->__blnRestored && empty($this->__blnValid[self::CITY_ID_FIELD])) {
			throw new Caller("CityId was not selected in the most recent query and is not valid.");
		}
        if ((!$this->objCity) && (!is_null($this->intCityId))) {
            $this->objCity = City::Load($this->intCityId);
        }
        return $this->objCity;
     }



   /**
	* Sets the value of intCityId 
	* Returns $this to allow chaining of setters.
	* @param integer|null $intCityId
    * @throws Caller
	* @return Tourist
	*/
	public function setCityId($intCityId)
    {
		$intCityId = Type::Cast($intCityId, QCubed\Type::INTEGER);

		if ($this->intCityId !== $intCityId) {
			$this->objCity = null; // remove the associated object
			$this->intCityId = $intCityId;
			$this->__blnDirty[self::CITY_ID_FIELD] = true;
		}
		$this->__blnValid[self::CITY_ID_FIELD] = true;
		return $this; // allows chaining
	}

    /**
     * Sets the value of the City object referenced by intCityId 
     * @param null|City $objCity
     * @throws Caller
     * @return Tourist
     */
    public function setCity($objCity) {
        if (is_null($objCity)) {
            $this->setCityId(null);
        } else {
            $objCity = Type::Cast($objCity, 'City');

            // Make sure its a SAVED City object
            if (is_null($objCity->Id)) {
                throw new Caller('Unable to set an unsaved City for this Tourist');
            }

            // Update Local Member Variables
            $this->setCityId($objCity->getId());
            $this->objCity = $objCity;
        }
        return $this;
    }

   /**
	* Gets the value of intCountryId 
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
     * Gets the value of the Country object referenced by intCountryId 
     * If the object is not loaded, will load the object (caching it) before returning it.
     * @throws Caller
     * @return Country
     */
     public function getCountry()
     {
 		if ($this->__blnRestored && empty($this->__blnValid[self::COUNTRY_ID_FIELD])) {
			throw new Caller("CountryId was not selected in the most recent query and is not valid.");
		}
        if ((!$this->objCountry) && (!is_null($this->intCountryId))) {
            $this->objCountry = Country::Load($this->intCountryId);
        }
        return $this->objCountry;
     }



   /**
	* Sets the value of intCountryId 
	* Returns $this to allow chaining of setters.
	* @param integer|null $intCountryId
    * @throws Caller
	* @return Tourist
	*/
	public function setCountryId($intCountryId)
    {
		$intCountryId = Type::Cast($intCountryId, QCubed\Type::INTEGER);

		if ($this->intCountryId !== $intCountryId) {
			$this->objCountry = null; // remove the associated object
			$this->intCountryId = $intCountryId;
			$this->__blnDirty[self::COUNTRY_ID_FIELD] = true;
		}
		$this->__blnValid[self::COUNTRY_ID_FIELD] = true;
		return $this; // allows chaining
	}

    /**
     * Sets the value of the Country object referenced by intCountryId 
     * @param null|Country $objCountry
     * @throws Caller
     * @return Tourist
     */
    public function setCountry($objCountry) {
        if (is_null($objCountry)) {
            $this->setCountryId(null);
        } else {
            $objCountry = Type::Cast($objCountry, 'Country');

            // Make sure its a SAVED Country object
            if (is_null($objCountry->Id)) {
                throw new Caller('Unable to set an unsaved Country for this Tourist');
            }

            // Update Local Member Variables
            $this->setCountryId($objCountry->getId());
            $this->objCountry = $objCountry;
        }
        return $this;
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
		$objCopy->_objDeviceTourist = null;
		$objCopy->_objDeviceTouristArray = null;

		return $objCopy;
	}

    
   /**
	* The current record has just been inserted into the table. Let everyone know.
	* @param integer	$pk Primary key of record just inserted.
	*/
	protected static function broadcastInsert($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'tourist');
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
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'tourist');
        }
	}

   /**
	* The current record has just been deleted. Let everyone know.
	* @param integer	$pk Primary key of record just deleted.
	*/
	protected static function broadcastDelete($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'tourist');
        }
	}

   /**
	* All records have just been deleted. Let everyone know.
	*/
	protected static function broadcastDeleteAll()
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'tourist');
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

            case 'DeviceTourist':
            case '_DeviceTourist':
                /**
                 * Gets the value of the protected _objDeviceTourist (Read-Only)
                 * if set due to an expansion on the device_tourist.tourist_id reverse relationship
                 * @return DeviceTourist
                 */
                return $this->_objDeviceTourist;

            case 'DeviceTouristArray':
            case '_DeviceTouristArray':
                /**
                 * Gets the value of the protected _objDeviceTouristArray (Read-Only)
                 * if set due to an ExpandAsArray on the device_tourist.tourist_id reverse relationship
                 * @return DeviceTourist[]
                 */
                return $this->_objDeviceTouristArray;


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



    // Related Objects' Methods for DeviceTourist
    //-------------------------------------------------------------------

    /**
     * Gets all associated DeviceTourists as an array of DeviceTourist objects
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return DeviceTourist[]
     * @throws Caller
     */
    public function getDeviceTouristArray($objOptionalClauses = null)
    {
        if ((is_null($this->intId)))
            return array();

        try {
            return DeviceTourist::LoadArrayByTouristId($this->intId, $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Counts all associated DeviceTourists
     * @return int
    */
    public function countDeviceTourists()
    {
        if ((is_null($this->intId)))
            return 0;

        return DeviceTourist::CountByTouristId($this->intId);
    }

    /**
     * Associates a DeviceTourist
     * @param DeviceTourist $objDeviceTourist
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
    */
    public function associateDeviceTourist(DeviceTourist $objDeviceTourist)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateDeviceTourist on this unsaved Tourist.');
        if ((is_null($objDeviceTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateDeviceTourist on this Tourist with an unsaved DeviceTourist.');

        // Get the Database Object for this Class
        $objDatabase = Tourist::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `device_tourist`
            SET
                `tourist_id` = ' . $objDatabase->SqlVariable($this->intId) . '
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objDeviceTourist->Id) . '
        ');
    }

    /**
     * Unassociates a DeviceTourist
     * @param DeviceTourist $objDeviceTourist
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
    */
    public function unassociateDeviceTourist(DeviceTourist $objDeviceTourist)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateDeviceTourist on this unsaved Tourist.');
        if ((is_null($objDeviceTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateDeviceTourist on this Tourist with an unsaved DeviceTourist.');

        // Get the Database Object for this Class
        $objDatabase = Tourist::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `device_tourist`
            SET
                `tourist_id` = null
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objDeviceTourist->Id) . ' AND
                `tourist_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Unassociates all DeviceTourists
     * @return void
    */
    public function unassociateAllDeviceTourists()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateDeviceTourist on this unsaved Tourist.');

        // Get the Database Object for this Class
        $objDatabase = Tourist::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `device_tourist`
            SET
                `tourist_id` = null
            WHERE
                `tourist_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Deletes an associated DeviceTourist
     * @param DeviceTourist $objDeviceTourist
     * @return void
    */
    public function deleteAssociatedDeviceTourist(DeviceTourist $objDeviceTourist)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateDeviceTourist on this unsaved Tourist.');
        if ((is_null($objDeviceTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateDeviceTourist on this Tourist with an unsaved DeviceTourist.');

        // Get the Database Object for this Class
        $objDatabase = Tourist::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `device_tourist`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objDeviceTourist->Id) . ' AND
                `tourist_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Deletes all associated DeviceTourists
     * @return void
    */
    public function deleteAllDeviceTourists()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateDeviceTourist on this unsaved Tourist.');

        // Get the Database Object for this Class
        $objDatabase = Tourist::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `device_tourist`
            WHERE
                `tourist_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
        return "tourist";
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
     * @return NodeTourist
     */
    public static function baseNode()
    {
        return QQN::Tourist();
    }

    
    ////////////////////////////////////////
    // METHODS for SOAP-BASED WEB SERVICES
    ////////////////////////////////////////

    public static function getSoapComplexTypeXml()
    {
        $strToReturn = '<complexType name="Tourist"><sequence>';
        $strToReturn .= '<element name="Id" type="xsd:int"/>';
        $strToReturn .= '<element name="Name" type="xsd:string"/>';
        $strToReturn .= '<element name="Passport" type="xsd:string"/>';
        $strToReturn .= '<element name="Contactinfo" type="xsd:string"/>';
        $strToReturn .= '<element name="Language" type="xsd1:Language"/>';
        $strToReturn .= '<element name="City" type="xsd1:City"/>';
        $strToReturn .= '<element name="Country" type="xsd1:Country"/>';
        $strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
        $strToReturn .= '</sequence></complexType>';
        return $strToReturn;
    }

    public static function alterSoapComplexTypeArray(&$strComplexTypeArray)
    {
        if (!array_key_exists('Tourist', $strComplexTypeArray)) {
            $strComplexTypeArray['Tourist'] = Tourist::GetSoapComplexTypeXml();
            Language::AlterSoapComplexTypeArray($strComplexTypeArray);
            City::AlterSoapComplexTypeArray($strComplexTypeArray);
            Country::AlterSoapComplexTypeArray($strComplexTypeArray);
        }
    }

    public static function getArrayFromSoapArray($objSoapArray)
    {
        $objArrayToReturn = array();

        foreach ($objSoapArray as $objSoapObject)
            array_push($objArrayToReturn, Tourist::GetObjectFromSoapObject($objSoapObject));

        return $objArrayToReturn;
    }

    public static function getObjectFromSoapObject($objSoapObject)
    {
        $objToReturn = new Tourist();
        if (property_exists($objSoapObject, 'Id'))
            $objToReturn->intId = $objSoapObject->Id;
        if (property_exists($objSoapObject, 'Name'))
            $objToReturn->strName = $objSoapObject->Name;
        if (property_exists($objSoapObject, 'Passport'))
            $objToReturn->strPassport = $objSoapObject->Passport;
        if (property_exists($objSoapObject, 'Contactinfo'))
            $objToReturn->strContactinfo = $objSoapObject->Contactinfo;
        if ((property_exists($objSoapObject, 'Language')) &&
            ($objSoapObject->Language))
            $objToReturn->Language = Language::GetObjectFromSoapObject($objSoapObject->Language);
        if ((property_exists($objSoapObject, 'City')) &&
            ($objSoapObject->City))
            $objToReturn->City = City::GetObjectFromSoapObject($objSoapObject->City);
        if ((property_exists($objSoapObject, 'Country')) &&
            ($objSoapObject->Country))
            $objToReturn->Country = Country::GetObjectFromSoapObject($objSoapObject->Country);
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
            array_push($objArrayToReturn, Tourist::GetSoapObjectFromObject($objObject, true));

        return unserialize(serialize($objArrayToReturn));
    }

    public static function getSoapObjectFromObject($objObject, $blnBindRelatedObjects)
    {
        if ($objObject->objLanguage)
            $objObject->objLanguage = Language::GetSoapObjectFromObject($objObject->objLanguage, false);
        else if (!$blnBindRelatedObjects)
            $objObject->intLanguageId = null;
        if ($objObject->objCity)
            $objObject->objCity = City::GetSoapObjectFromObject($objObject->objCity, false);
        else if (!$blnBindRelatedObjects)
            $objObject->intCityId = null;
        if ($objObject->objCountry)
            $objObject->objCountry = Country::GetSoapObjectFromObject($objObject->objCountry, false);
        else if (!$blnBindRelatedObjects)
            $objObject->intCountryId = null;
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
        if (isset($this->__blnValid[self::NAME_FIELD])) {
            $iArray['Name'] = $this->strName;
        }
        if (isset($this->__blnValid[self::PASSPORT_FIELD])) {
            $iArray['Passport'] = $this->strPassport;
        }
        if (isset($this->__blnValid[self::CONTACTINFO_FIELD])) {
            $iArray['Contactinfo'] = $this->strContactinfo;
        }
        if (isset($this->__blnValid[self::LANGUAGE_ID_FIELD])) {
            $iArray['LanguageId'] = $this->intLanguageId;
        }
        if (isset($this->__blnValid[self::CITY_ID_FIELD])) {
            $iArray['CityId'] = $this->intCityId;
        }
        if (isset($this->__blnValid[self::COUNTRY_ID_FIELD])) {
            $iArray['CountryId'] = $this->intCountryId;
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
     * any query calls (like Load or QueryArray), with a call to Tourist::ClearCache()
     *
     * @return array An array that is json serializable
     */
    public function jsonSerialize ()
    {
        $a = [];
        if (isset($this->__blnValid[self::ID_FIELD])) {
            $a['id'] = $this->intId;
        }
        if (isset($this->__blnValid[self::NAME_FIELD])) {
            $a['name'] = $this->strName;
        }
        if (isset($this->__blnValid[self::PASSPORT_FIELD])) {
            $a['passport'] = $this->strPassport;
        }
        if (isset($this->__blnValid[self::CONTACTINFO_FIELD])) {
            $a['contactinfo'] = $this->strContactinfo;
        }
        if (isset($this->objLanguage)) {
            $a['language'] = $this->objLanguage;
        } elseif (isset($this->__blnValid[self::LANGUAGE_ID_FIELD])) {
            $a['language_id'] = $this->intLanguageId;
        }
        if (isset($this->objCity)) {
            $a['city'] = $this->objCity;
        } elseif (isset($this->__blnValid[self::CITY_ID_FIELD])) {
            $a['city_id'] = $this->intCityId;
        }
        if (isset($this->objCountry)) {
            $a['country'] = $this->objCountry;
        } elseif (isset($this->__blnValid[self::COUNTRY_ID_FIELD])) {
            $a['country_id'] = $this->intCountryId;
        }
        if (isset($this->_objDeviceTourist)) {
            $a['device_tourist'] = $this->_objDeviceTourist;
        } elseif (isset($this->_objDeviceTouristArray)) {
            $a['device_tourist'] = $this->_objDeviceTouristArray;
        }
        return $a;
    }



    

}



/////////////////////////////////////
// ADDITIONAL CLASSES for QCubed QUERY
/////////////////////////////////////

/**
 * @property-read Node\Column $Id
 * @property-read Node\Column $Name
 * @property-read Node\Column $Passport
 * @property-read Node\Column $Contactinfo
 * @property-read Node\Column $LanguageId
 * @property-read NodeLanguage $Language
 * @property-read Node\Column $CityId
 * @property-read NodeCity $City
 * @property-read Node\Column $CountryId
 * @property-read NodeCountry $Country
 * @property-read ReverseReferenceNodeDeviceTourist $DeviceTourist
 * @property-read Node\Column $_PrimaryKeyNode
 **/
class NodeTourist extends Node\Table {
    protected $strTableName = 'tourist';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'Tourist';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "name",
            "passport",
            "contactinfo",
            "language_id",
            "city_id",
            "country_id",
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
            case 'Name':
                return new Node\Column('name', 'Name', 'VarChar', $this);
            case 'Passport':
                return new Node\Column('passport', 'Passport', 'VarChar', $this);
            case 'Contactinfo':
                return new Node\Column('contactinfo', 'Contactinfo', 'VarChar', $this);
            case 'LanguageId':
                return new Node\Column('language_id', 'LanguageId', 'Integer', $this);
            case 'Language':
                return new NodeLanguage('language_id', 'Language', 'Integer', $this);
            case 'CityId':
                return new Node\Column('city_id', 'CityId', 'Integer', $this);
            case 'City':
                return new NodeCity('city_id', 'City', 'Integer', $this);
            case 'CountryId':
                return new Node\Column('country_id', 'CountryId', 'Integer', $this);
            case 'Country':
                return new NodeCountry('country_id', 'Country', 'Integer', $this);
            case 'DeviceTourist':
                return new ReverseReferenceNodeDeviceTourist($this, 'devicetourist', \QCubed\Type::REVERSE_REFERENCE, 'tourist_id', 'DeviceTourist');

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
 * @property-read Node\Column $Name
 * @property-read Node\Column $Passport
 * @property-read Node\Column $Contactinfo
 * @property-read Node\Column $LanguageId
 * @property-read NodeLanguage $Language
 * @property-read Node\Column $CityId
 * @property-read NodeCity $City
 * @property-read Node\Column $CountryId
 * @property-read NodeCountry $Country
 * @property-read ReverseReferenceNodeDeviceTourist $DeviceTourist

 * @property-read Node\Column $_PrimaryKeyNode
 **/
class ReverseReferenceNodeTourist extends Node\ReverseReference {
    protected $strTableName = 'tourist';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'Tourist';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "name",
            "passport",
            "contactinfo",
            "language_id",
            "city_id",
            "country_id",
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
            case 'Name':
                return new Node\Column('name', 'Name', 'VarChar', $this);
            case 'Passport':
                return new Node\Column('passport', 'Passport', 'VarChar', $this);
            case 'Contactinfo':
                return new Node\Column('contactinfo', 'Contactinfo', 'VarChar', $this);
            case 'LanguageId':
                return new Node\Column('language_id', 'LanguageId', 'Integer', $this);
            case 'Language':
                return new NodeLanguage('language_id', 'Language', 'Integer', $this);
            case 'CityId':
                return new Node\Column('city_id', 'CityId', 'Integer', $this);
            case 'City':
                return new NodeCity('city_id', 'City', 'Integer', $this);
            case 'CountryId':
                return new Node\Column('country_id', 'CountryId', 'Integer', $this);
            case 'Country':
                return new NodeCountry('country_id', 'Country', 'Integer', $this);
            case 'DeviceTourist':
                return new ReverseReferenceNodeDeviceTourist($this, 'devicetourist', \QCubed\Type::REVERSE_REFERENCE, 'tourist_id', 'DeviceTourist');

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
