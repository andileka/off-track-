<?php
/**
 * Generated Country base class file
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
 * Class CountryGen
 *
 * The abstract CountryGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the Country subclass which
 * extends this CountryGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the Country class.
 *
 * @package My QCubed Application
 * @subpackage ModelGen
 * @property-read integer $Id the value of the id column (Read-Only PK)
 * @property string $IsoCode the value of the iso_code column (Unique)
 * @property integer $TelCode the value of the tel_code column 
 * @property boolean $EuropeanUnion the value of the european_union column (Not Null)
 * @property string $NameEn the value of the name_en column (Not Null)
 * @property string $NameNl the value of the name_nl column 
 * @property string $NameFr the value of the name_fr column 
 * @property string $NameEs the value of the name_es column 
 * @property string $NameIt the value of the name_it column 
 * @property string $NameDe the value of the name_de column 
 * @property string $NamePl the value of the name_pl column 
 * @property-read Tourist $_Tourist the value of the protected _objTourist (Read-Only) if set due to an expansion on the tourist.country_id reverse relationship
 * @property-read Tourist $Tourist the value of the protected _objTourist (Read-Only) if set due to an expansion on the tourist.country_id reverse relationship
 * @property-read Tourist[] $_TouristArray the value of the protected _objTouristArray (Read-Only) if set due to an ExpandAsArray on the tourist.country_id reverse relationship
 * @property-read Tourist[] $TouristArray the value of the protected _objTouristArray (Read-Only) if set due to an ExpandAsArray on the tourist.country_id reverse relationship
 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
 */
abstract class CountryGen extends \QCubed\ObjectBase implements IteratorAggregate, JsonSerializable {

    use ModelTrait;

    /** @var boolean Set to false in superclass to save a little time if this db object should not be watched for changes. */
    public static $blnWatchChanges = true;

    /** @var Country[] Short term cached Country objects */
    protected static $objCacheArray = array();

    ///////////////////////////////////////////////////////////////////////
    // PROTECTED AND PRIVATE MEMBER VARIABLES and CONSTS
    ///////////////////////////////////////////////////////////////////////

    /**
     * Protected member variable that maps to the database PK Identity column country.id
     * @var integer intId
     */
    private $intId;

    const ID_DEFAULT = null;
    const ID_FIELD = 'id';


    /**
     * Protected member variable that maps to the database column country.iso_code
     * @var string strIsoCode
     */
    private $strIsoCode;
    const IsoCodeMaxLength = 2; // Deprecated
    const ISO_CODE_MAX_LENGTH = 2;

    const ISO_CODE_DEFAULT = null;
    const ISO_CODE_FIELD = 'iso_code';


    /**
     * Protected member variable that maps to the database column country.tel_code
     * @var integer intTelCode
     */
    private $intTelCode;

    const TEL_CODE_DEFAULT = null;
    const TEL_CODE_FIELD = 'tel_code';


    /**
     * Protected member variable that maps to the database column country.european_union
     * @var boolean blnEuropeanUnion
     */
    private $blnEuropeanUnion;

    const EUROPEAN_UNION_DEFAULT = false;
    const EUROPEAN_UNION_FIELD = 'european_union';


    /**
     * Protected member variable that maps to the database column country.name_en
     * @var string strNameEn
     */
    private $strNameEn;
    const NameEnMaxLength = 52; // Deprecated
    const NAME_EN_MAX_LENGTH = 52;

    const NAME_EN_DEFAULT = null;
    const NAME_EN_FIELD = 'name_en';


    /**
     * Protected member variable that maps to the database column country.name_nl
     * @var string strNameNl
     */
    private $strNameNl;
    const NameNlMaxLength = 52; // Deprecated
    const NAME_NL_MAX_LENGTH = 52;

    const NAME_NL_DEFAULT = null;
    const NAME_NL_FIELD = 'name_nl';


    /**
     * Protected member variable that maps to the database column country.name_fr
     * @var string strNameFr
     */
    private $strNameFr;
    const NameFrMaxLength = 52; // Deprecated
    const NAME_FR_MAX_LENGTH = 52;

    const NAME_FR_DEFAULT = null;
    const NAME_FR_FIELD = 'name_fr';


    /**
     * Protected member variable that maps to the database column country.name_es
     * @var string strNameEs
     */
    private $strNameEs;
    const NameEsMaxLength = 52; // Deprecated
    const NAME_ES_MAX_LENGTH = 52;

    const NAME_ES_DEFAULT = null;
    const NAME_ES_FIELD = 'name_es';


    /**
     * Protected member variable that maps to the database column country.name_it
     * @var string strNameIt
     */
    private $strNameIt;
    const NameItMaxLength = 52; // Deprecated
    const NAME_IT_MAX_LENGTH = 52;

    const NAME_IT_DEFAULT = null;
    const NAME_IT_FIELD = 'name_it';


    /**
     * Protected member variable that maps to the database column country.name_de
     * @var string strNameDe
     */
    private $strNameDe;
    const NameDeMaxLength = 52; // Deprecated
    const NAME_DE_MAX_LENGTH = 52;

    const NAME_DE_DEFAULT = null;
    const NAME_DE_FIELD = 'name_de';


    /**
     * Protected member variable that maps to the database column country.name_pl
     * @var string strNamePl
     */
    private $strNamePl;
    const NamePlMaxLength = 52; // Deprecated
    const NAME_PL_MAX_LENGTH = 52;

    const NAME_PL_DEFAULT = null;
    const NAME_PL_FIELD = 'name_pl';


    /**
     * Protected member variable that stores a reference to a single Tourist object
     * (of type Tourist), if this Country object was restored with
     * an expansion on the tourist association table.
     * @var Tourist _objTourist;
     */
    protected $_objTourist;

    /**
     * Protected member variable that stores a reference to an array of Tourist objects
     * (of type Tourist[]), if this Country object was restored with
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
     * Construct a new Country object.
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
        $this->strIsoCode = Country::ISO_CODE_DEFAULT;
        $this->__blnValid[self::ISO_CODE_FIELD] = true;
        $this->intTelCode = Country::TEL_CODE_DEFAULT;
        $this->__blnValid[self::TEL_CODE_FIELD] = true;
        $this->blnEuropeanUnion = Country::EUROPEAN_UNION_DEFAULT;
        $this->__blnValid[self::EUROPEAN_UNION_FIELD] = true;
        $this->strNameEn = Country::NAME_EN_DEFAULT;
        $this->__blnValid[self::NAME_EN_FIELD] = true;
        $this->strNameNl = Country::NAME_NL_DEFAULT;
        $this->__blnValid[self::NAME_NL_FIELD] = true;
        $this->strNameFr = Country::NAME_FR_DEFAULT;
        $this->__blnValid[self::NAME_FR_FIELD] = true;
        $this->strNameEs = Country::NAME_ES_DEFAULT;
        $this->__blnValid[self::NAME_ES_FIELD] = true;
        $this->strNameIt = Country::NAME_IT_DEFAULT;
        $this->__blnValid[self::NAME_IT_FIELD] = true;
        $this->strNameDe = Country::NAME_DE_DEFAULT;
        $this->__blnValid[self::NAME_DE_FIELD] = true;
        $this->strNamePl = Country::NAME_PL_DEFAULT;
        $this->__blnValid[self::NAME_PL_FIELD] = true;
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
     * Load a Country from PK Info
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return Country
     */
    public static function load($intId, $objOptionalClauses = null)
    {
        if (!$objOptionalClauses) {
            $objCachedObject = static::getFromCache ($intId);
            if ($objCachedObject) return $objCachedObject;
        }

        // Use QuerySingle to Perform the Query
        $objToReturn = Country::querySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::Country()->Id, $intId)
            ),
            $objOptionalClauses
        );
        return $objToReturn;
    }


    /**
     * Load all Countries
     * @param iClause[]|null $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return Country[]
     * @throws Caller
     */
    public static function loadAll($objOptionalClauses = null)
    {
        if (func_num_args() > 1) {
            throw new Caller("LoadAll must be called with an array of optional clauses as a single argument");
        }
        // Call Country::queryArray to perform the LoadAll query
        try {
            return Country::queryArray(QQ::All(), $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count all Countries
     * @return int
     */
    public static function countAll()
    {
        // Call Country::queryCount to perform the CountAll query
        return Country::queryCount(QQ::All());
    }


    /**
     * Static Qcubed Query method to query for a single Country object.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return Country the queried object
     */
    public static function querySingle(iCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null)
    {
        return static::_QuerySingle($objConditions, $objOptionalClauses, $mixParameterArray);
    }

    /**
     * Static Qcubed Query method to query for an array of Country objects.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return Country[] the queried objects as an array
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
        $clauses[] = QQ::Select(QQN::Country()->Id);
        $objCountries = self::QueryArray($objConditions, $clauses);
        $pks = [];
        foreach ($objCountries as $objCountry) {
            $pks[] = $objCountry->intId;
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
    * @return Country the queried object
    */
    public static function getFromCache($key)
    {
        return static::_GetFromCache($key);
    }


    /**
     * Instantiate a Country from a Database Row.
     * Takes in an optional strAliasPrefix, used in case another Object::instantiateDbRow
     * is calling this Country::instantiateDbRow in order to perform
     * early binding on referenced objects.
     * @param \QCubed\Database\RowBase $objDbRow
     * @param string $strAliasPrefix
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param array|null $objPreviousItemArray Used by expansion code to aid in expanding arrays
     * @param string[] $strColumnAliasArray Array of column aliases mapping names in the query to items in the object
     * @param boolean $blnCheckDuplicate Used by ExpandArray to indicate we should not create a new object if this is a duplicate of a previoius object
     * @param string $strParentExpansionKey If this is part of an expansion, indicates what the parent item is
     * @param mixed $objExpansionParent If this is part of an expansion, is the object corresponding to the key so that we can refer back to the parent object
     * @return mixed Either a Country, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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
            // Create a new instance of the Country object
            $objToReturn = new Country(false);
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
            $strAlias = $strAliasPrefix . 'iso_code';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strIsoCode = $mixVal;
                $objToReturn->__blnValid[self::ISO_CODE_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'tel_code';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = (integer)$mixVal;
                }
                $objToReturn->intTelCode = $mixVal;
                $objToReturn->__blnValid[self::TEL_CODE_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'european_union';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->blnEuropeanUnion = $objDbRow->ResolveBooleanValue($mixVal);
                $objToReturn->__blnValid[self::EUROPEAN_UNION_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'name_en';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strNameEn = $mixVal;
                $objToReturn->__blnValid[self::NAME_EN_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'name_nl';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strNameNl = $mixVal;
                $objToReturn->__blnValid[self::NAME_NL_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'name_fr';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strNameFr = $mixVal;
                $objToReturn->__blnValid[self::NAME_FR_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'name_es';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strNameEs = $mixVal;
                $objToReturn->__blnValid[self::NAME_ES_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'name_it';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strNameIt = $mixVal;
                $objToReturn->__blnValid[self::NAME_IT_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'name_de';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strNameDe = $mixVal;
                $objToReturn->__blnValid[self::NAME_DE_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'name_pl';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strNamePl = $mixVal;
                $objToReturn->__blnValid[self::NAME_PL_FIELD] = true;
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
            $strAliasPrefix = 'country__';




        // Check for Tourist Virtual Binding
        $strAlias = $strAliasPrefix . 'tourist__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        $objExpansionNode = (empty($objExpansionAliasArray['tourist']) ? null : $objExpansionAliasArray['tourist']);
        $blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
        if ($blnExpanded && null === $objToReturn->_objTouristArray)
            $objToReturn->_objTouristArray = array();
        if (isset ($strColumns[$strAliasName])) {
            if ($blnExpanded) {
                $objToReturn->_objTouristArray[] = Tourist::instantiateDbRow($objDbRow, $strAliasPrefix . 'tourist__', $objExpansionNode, null, $strColumnAliasArray, false, 'country_id', $objToReturn);
            } elseif (is_null($objToReturn->_objTourist)) {
                $objToReturn->_objTourist = Tourist::instantiateDbRow($objDbRow, $strAliasPrefix . 'tourist__', $objExpansionNode, null, $strColumnAliasArray, false, 'country_id', $objToReturn);
            }
        }
        elseif ($strParentExpansionKey === 'tourist' && $objExpansionParent) {
            $objToReturn->_objTourist = $objExpansionParent;
        }

        return $objToReturn;
    }

    /**
     * Instantiate an array of Countries from a Database Result
     * @param \QCubed\Database\ResultBase $objDbResult
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param string[] $strColumnAliasArray
     * @return Country[]
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
                $objItem = Country::instantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
                if ($objItem) {
                    $objToReturn[] = $objItem;
                    $objPrevItemArray[$objItem->intId][] = $objItem;
		
                }
            }
        } else {
            while ($objDbRow = $objDbResult->GetNextRow())
                $objToReturn[] = Country::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
        }

        return $objToReturn;
    }


    /**
     * Instantiate a single Country object from a query cursor (e.g. a DB ResultSet).
     * Cursor is automatically moved to the "next row" of the result set.
     * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
     * @param \QCubed\Database\ResultBase $objDbResult cursor resource
     * @return Country next row resulting from the query
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
        return Country::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
    }



    ///////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Single Load and Array)
    ///////////////////////////////////////////////////

    /**
     * Load a single Country object,
     * by Id Index(es)
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return Country
    */
    public static function loadById($intId, $objOptionalClauses = null)
    {
        return Country::QuerySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::Country()->Id, $intId)
            ),
            $objOptionalClauses
        );
    }

    /**
     * Load a single Country object,
     * by IsoCode Index(es)
     * @param string $strIsoCode
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return Country
    */
    public static function loadByIsoCode($strIsoCode, $objOptionalClauses = null)
    {
        return Country::QuerySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::Country()->IsoCode, $strIsoCode)
            ),
            $objOptionalClauses
        );
    }


    ////////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Array via Many to Many)
    ////////////////////////////////////////////////////




    //////////////////////////
    // SAVE, DELETE AND RELOAD
    //////////////////////////
    

    /**
    * Save this Country
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
     * Insert into Country
     */
    protected function insert()
    {
        $mixToReturn = null;
        $objDatabase = Country::GetDatabase();

        $objDatabase->NonQuery('
            INSERT INTO `country` (
							`iso_code`,
							`tel_code`,
							`european_union`,
							`name_en`,
							`name_nl`,
							`name_fr`,
							`name_es`,
							`name_it`,
							`name_de`,
							`name_pl`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strIsoCode) . ',
							' . $objDatabase->SqlVariable($this->intTelCode) . ',
							' . $objDatabase->SqlVariable($this->blnEuropeanUnion) . ',
							' . $objDatabase->SqlVariable($this->strNameEn) . ',
							' . $objDatabase->SqlVariable($this->strNameNl) . ',
							' . $objDatabase->SqlVariable($this->strNameFr) . ',
							' . $objDatabase->SqlVariable($this->strNameEs) . ',
							' . $objDatabase->SqlVariable($this->strNameIt) . ',
							' . $objDatabase->SqlVariable($this->strNameDe) . ',
							' . $objDatabase->SqlVariable($this->strNamePl) . '
						)
        ');
        // Update Identity column and return its value
        $mixToReturn = $this->intId = $objDatabase->InsertId('country', 'id');
        $this->__blnValid[self::ID_FIELD] = true;


        static::broadcastInsert($this->PrimaryKey());

        return $mixToReturn;
    }

   /**
    * Update this Country
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
            `country`
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

		if (isset($this->__blnDirty[self::ISO_CODE_FIELD])) {
			$strCol = '`iso_code`';
			$strValue = $objDatabase->sqlVariable($this->strIsoCode);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::TEL_CODE_FIELD])) {
			$strCol = '`tel_code`';
			$strValue = $objDatabase->sqlVariable($this->intTelCode);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::EUROPEAN_UNION_FIELD])) {
			$strCol = '`european_union`';
			$strValue = $objDatabase->sqlVariable($this->blnEuropeanUnion);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::NAME_EN_FIELD])) {
			$strCol = '`name_en`';
			$strValue = $objDatabase->sqlVariable($this->strNameEn);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::NAME_NL_FIELD])) {
			$strCol = '`name_nl`';
			$strValue = $objDatabase->sqlVariable($this->strNameNl);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::NAME_FR_FIELD])) {
			$strCol = '`name_fr`';
			$strValue = $objDatabase->sqlVariable($this->strNameFr);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::NAME_ES_FIELD])) {
			$strCol = '`name_es`';
			$strValue = $objDatabase->sqlVariable($this->strNameEs);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::NAME_IT_FIELD])) {
			$strCol = '`name_it`';
			$strValue = $objDatabase->sqlVariable($this->strNameIt);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::NAME_DE_FIELD])) {
			$strCol = '`name_de`';
			$strValue = $objDatabase->sqlVariable($this->strNameDe);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::NAME_PL_FIELD])) {
			$strCol = '`name_pl`';
			$strValue = $objDatabase->sqlVariable($this->strNamePl);
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
     * Delete this Country
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
     */
    public function delete()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Cannot delete this Country with an unset primary key.');

        // Get the Database Object for this Class
        $objDatabase = Country::GetDatabase();


        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `country`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($this->intId) . '');

        $this->DeleteFromCache();
        static::BroadcastDelete($this->PrimaryKey());
    }

    /**
     * Delete all Countries
     * @return void
     */
    public static function deleteAll()
    {
        // Get the Database Object for this Class
        $objDatabase = Country::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            DELETE FROM
                `country`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    /**
     * Truncate country table
     * @return void
     */
    public static function truncate()
    {
        // Get the Database Object for this Class
        $objDatabase = Country::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            TRUNCATE `country`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    
    /**
	 * Reload this Country from the database.
     * @param iClause[]|null $clauses
     * @throws Caller
	 * @return void
	 */
	public function reload($clauses = null)
    {
		// Make sure we are actually Restored from the database
		if (!$this->__blnRestored)
			throw new Caller('Cannot call Reload() on a new, unsaved Country object.');

		// throw away all previous state of the object
		$this->DeleteFromCache();
		$this->__blnValid = null;
		$this->__blnDirty = null;

		// Reload the Object
		$objReloaded = Country::Load($this->intId, $clauses);

		// Update $this's local variables to match
		$this->__blnValid[self::ID_FIELD] = true;
		if (isset($objReloaded->__blnValid[self::ISO_CODE_FIELD])) {
			$this->strIsoCode = $objReloaded->strIsoCode;
			$this->__blnValid[self::ISO_CODE_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::TEL_CODE_FIELD])) {
			$this->intTelCode = $objReloaded->intTelCode;
			$this->__blnValid[self::TEL_CODE_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::EUROPEAN_UNION_FIELD])) {
			$this->blnEuropeanUnion = $objReloaded->blnEuropeanUnion;
			$this->__blnValid[self::EUROPEAN_UNION_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::NAME_EN_FIELD])) {
			$this->strNameEn = $objReloaded->strNameEn;
			$this->__blnValid[self::NAME_EN_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::NAME_NL_FIELD])) {
			$this->strNameNl = $objReloaded->strNameNl;
			$this->__blnValid[self::NAME_NL_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::NAME_FR_FIELD])) {
			$this->strNameFr = $objReloaded->strNameFr;
			$this->__blnValid[self::NAME_FR_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::NAME_ES_FIELD])) {
			$this->strNameEs = $objReloaded->strNameEs;
			$this->__blnValid[self::NAME_ES_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::NAME_IT_FIELD])) {
			$this->strNameIt = $objReloaded->strNameIt;
			$this->__blnValid[self::NAME_IT_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::NAME_DE_FIELD])) {
			$this->strNameDe = $objReloaded->strNameDe;
			$this->__blnValid[self::NAME_DE_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::NAME_PL_FIELD])) {
			$this->strNamePl = $objReloaded->strNamePl;
			$this->__blnValid[self::NAME_PL_FIELD] = true;
		}
	}
    ////////////////////
    // UTILITIES
    ////////////////////
    
    /**
     *  Return an array of Countries keyed by the unique Id property.
     *	@param Country[]
     *	@return Country[]
     **/
    public static function keyCountriesById($countries) {
        if (empty($countries)) {
            return $countries;
        }
        $ret = [];
        foreach ($countries as $country) {
            $ret[$country->intId] = $country;
        }
        return $ret;
    }

    /**
     *  Return an array of Countries keyed by the unique IsoCode property.
     *	@param Country[]
     *	@return Country[]
     **/
    public static function keyCountriesByIsoCode($countries) {
        if (empty($countries)) {
            return $countries;
        }
        $ret = [];
        foreach ($countries as $country) {
            $ret[$country->strIsoCode] = $country;
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
	* Gets the value of strIsoCode (Unique)
	* @throws Caller
	* @return string
	*/
	public function getIsoCode()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::ISO_CODE_FIELD])) {
			throw new Caller("IsoCode was not selected in the most recent query and is not valid.");
		}
		return $this->strIsoCode;
	}




   /**
	* Sets the value of strIsoCode (Unique)
	* Returns $this to allow chaining of setters.
	* @param string $strIsoCode
    * @throws Caller
	* @return Country
	*/
	public function setIsoCode($strIsoCode)
    {
        if ($strIsoCode === null) {
             // invalidate
             $strIsoCode = null;
             $this->__blnValid[self::ISO_CODE_FIELD] = false;
            return $this; // allows chaining
        }
		$strIsoCode = Type::Cast($strIsoCode, QCubed\Type::STRING);

		if ($this->strIsoCode !== $strIsoCode) {
			$this->strIsoCode = $strIsoCode;
			$this->__blnDirty[self::ISO_CODE_FIELD] = true;
		}
		$this->__blnValid[self::ISO_CODE_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of intTelCode 
	* @throws Caller
	* @return integer
	*/
	public function getTelCode()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::TEL_CODE_FIELD])) {
			throw new Caller("TelCode was not selected in the most recent query and is not valid.");
		}
		return $this->intTelCode;
	}




   /**
	* Sets the value of intTelCode 
	* Returns $this to allow chaining of setters.
	* @param integer|null $intTelCode
    * @throws Caller
	* @return Country
	*/
	public function setTelCode($intTelCode)
    {
		$intTelCode = Type::Cast($intTelCode, QCubed\Type::INTEGER);

		if ($this->intTelCode !== $intTelCode) {
			$this->intTelCode = $intTelCode;
			$this->__blnDirty[self::TEL_CODE_FIELD] = true;
		}
		$this->__blnValid[self::TEL_CODE_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of blnEuropeanUnion (Not Null)
	* @throws Caller
	* @return boolean
	*/
	public function getEuropeanUnion()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::EUROPEAN_UNION_FIELD])) {
			throw new Caller("EuropeanUnion was not selected in the most recent query and is not valid.");
		}
		return $this->blnEuropeanUnion;
	}




   /**
	* Sets the value of blnEuropeanUnion (Not Null)
	* Returns $this to allow chaining of setters.
	* @param boolean $blnEuropeanUnion
    * @throws Caller
	* @return Country
	*/
	public function setEuropeanUnion($blnEuropeanUnion)
    {
        if ($blnEuropeanUnion === null) {
             $blnEuropeanUnion = static::EuropeanUnionDefault;
            return $this; // allows chaining
        }
		$blnEuropeanUnion = Type::Cast($blnEuropeanUnion, QCubed\Type::BOOLEAN);

		if ($this->blnEuropeanUnion !== $blnEuropeanUnion) {
			$this->blnEuropeanUnion = $blnEuropeanUnion;
			$this->__blnDirty[self::EUROPEAN_UNION_FIELD] = true;
		}
		$this->__blnValid[self::EUROPEAN_UNION_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strNameEn (Not Null)
	* @throws Caller
	* @return string
	*/
	public function getNameEn()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::NAME_EN_FIELD])) {
			throw new Caller("NameEn was not selected in the most recent query and is not valid.");
		}
		return $this->strNameEn;
	}




   /**
	* Sets the value of strNameEn (Not Null)
	* Returns $this to allow chaining of setters.
	* @param string $strNameEn
    * @throws Caller
	* @return Country
	*/
	public function setNameEn($strNameEn)
    {
        if ($strNameEn === null) {
             // invalidate
             $strNameEn = null;
             $this->__blnValid[self::NAME_EN_FIELD] = false;
            return $this; // allows chaining
        }
		$strNameEn = Type::Cast($strNameEn, QCubed\Type::STRING);

		if ($this->strNameEn !== $strNameEn) {
			$this->strNameEn = $strNameEn;
			$this->__blnDirty[self::NAME_EN_FIELD] = true;
		}
		$this->__blnValid[self::NAME_EN_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strNameNl 
	* @throws Caller
	* @return string
	*/
	public function getNameNl()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::NAME_NL_FIELD])) {
			throw new Caller("NameNl was not selected in the most recent query and is not valid.");
		}
		return $this->strNameNl;
	}




   /**
	* Sets the value of strNameNl 
	* Returns $this to allow chaining of setters.
	* @param string|null $strNameNl
    * @throws Caller
	* @return Country
	*/
	public function setNameNl($strNameNl)
    {
		$strNameNl = Type::Cast($strNameNl, QCubed\Type::STRING);

		if ($this->strNameNl !== $strNameNl) {
			$this->strNameNl = $strNameNl;
			$this->__blnDirty[self::NAME_NL_FIELD] = true;
		}
		$this->__blnValid[self::NAME_NL_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strNameFr 
	* @throws Caller
	* @return string
	*/
	public function getNameFr()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::NAME_FR_FIELD])) {
			throw new Caller("NameFr was not selected in the most recent query and is not valid.");
		}
		return $this->strNameFr;
	}




   /**
	* Sets the value of strNameFr 
	* Returns $this to allow chaining of setters.
	* @param string|null $strNameFr
    * @throws Caller
	* @return Country
	*/
	public function setNameFr($strNameFr)
    {
		$strNameFr = Type::Cast($strNameFr, QCubed\Type::STRING);

		if ($this->strNameFr !== $strNameFr) {
			$this->strNameFr = $strNameFr;
			$this->__blnDirty[self::NAME_FR_FIELD] = true;
		}
		$this->__blnValid[self::NAME_FR_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strNameEs 
	* @throws Caller
	* @return string
	*/
	public function getNameEs()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::NAME_ES_FIELD])) {
			throw new Caller("NameEs was not selected in the most recent query and is not valid.");
		}
		return $this->strNameEs;
	}




   /**
	* Sets the value of strNameEs 
	* Returns $this to allow chaining of setters.
	* @param string|null $strNameEs
    * @throws Caller
	* @return Country
	*/
	public function setNameEs($strNameEs)
    {
		$strNameEs = Type::Cast($strNameEs, QCubed\Type::STRING);

		if ($this->strNameEs !== $strNameEs) {
			$this->strNameEs = $strNameEs;
			$this->__blnDirty[self::NAME_ES_FIELD] = true;
		}
		$this->__blnValid[self::NAME_ES_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strNameIt 
	* @throws Caller
	* @return string
	*/
	public function getNameIt()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::NAME_IT_FIELD])) {
			throw new Caller("NameIt was not selected in the most recent query and is not valid.");
		}
		return $this->strNameIt;
	}




   /**
	* Sets the value of strNameIt 
	* Returns $this to allow chaining of setters.
	* @param string|null $strNameIt
    * @throws Caller
	* @return Country
	*/
	public function setNameIt($strNameIt)
    {
		$strNameIt = Type::Cast($strNameIt, QCubed\Type::STRING);

		if ($this->strNameIt !== $strNameIt) {
			$this->strNameIt = $strNameIt;
			$this->__blnDirty[self::NAME_IT_FIELD] = true;
		}
		$this->__blnValid[self::NAME_IT_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strNameDe 
	* @throws Caller
	* @return string
	*/
	public function getNameDe()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::NAME_DE_FIELD])) {
			throw new Caller("NameDe was not selected in the most recent query and is not valid.");
		}
		return $this->strNameDe;
	}




   /**
	* Sets the value of strNameDe 
	* Returns $this to allow chaining of setters.
	* @param string|null $strNameDe
    * @throws Caller
	* @return Country
	*/
	public function setNameDe($strNameDe)
    {
		$strNameDe = Type::Cast($strNameDe, QCubed\Type::STRING);

		if ($this->strNameDe !== $strNameDe) {
			$this->strNameDe = $strNameDe;
			$this->__blnDirty[self::NAME_DE_FIELD] = true;
		}
		$this->__blnValid[self::NAME_DE_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strNamePl 
	* @throws Caller
	* @return string
	*/
	public function getNamePl()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::NAME_PL_FIELD])) {
			throw new Caller("NamePl was not selected in the most recent query and is not valid.");
		}
		return $this->strNamePl;
	}




   /**
	* Sets the value of strNamePl 
	* Returns $this to allow chaining of setters.
	* @param string|null $strNamePl
    * @throws Caller
	* @return Country
	*/
	public function setNamePl($strNamePl)
    {
		$strNamePl = Type::Cast($strNamePl, QCubed\Type::STRING);

		if ($this->strNamePl !== $strNamePl) {
			$this->strNamePl = $strNamePl;
			$this->__blnDirty[self::NAME_PL_FIELD] = true;
		}
		$this->__blnValid[self::NAME_PL_FIELD] = true;
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
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'country');
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
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'country');
        }
	}

   /**
	* The current record has just been deleted. Let everyone know.
	* @param integer	$pk Primary key of record just deleted.
	*/
	protected static function broadcastDelete($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'country');
        }
	}

   /**
	* All records have just been deleted. Let everyone know.
	*/
	protected static function broadcastDeleteAll()
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'country');
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
                 * if set due to an expansion on the tourist.country_id reverse relationship
                 * @return Tourist
                 */
                return $this->_objTourist;

            case 'TouristArray':
            case '_TouristArray':
                /**
                 * Gets the value of the protected _objTouristArray (Read-Only)
                 * if set due to an ExpandAsArray on the tourist.country_id reverse relationship
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
            return Tourist::LoadArrayByCountryId($this->intId, $objOptionalClauses);
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

        return Tourist::CountByCountryId($this->intId);
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
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateTourist on this unsaved Country.');
        if ((is_null($objTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateTourist on this Country with an unsaved Tourist.');

        // Get the Database Object for this Class
        $objDatabase = Country::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `tourist`
            SET
                `country_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this unsaved Country.');
        if ((is_null($objTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this Country with an unsaved Tourist.');

        // Get the Database Object for this Class
        $objDatabase = Country::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `tourist`
            SET
                `country_id` = null
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objTourist->Id) . ' AND
                `country_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Unassociates all Tourists
     * @return void
    */
    public function unassociateAllTourists()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this unsaved Country.');

        // Get the Database Object for this Class
        $objDatabase = Country::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `tourist`
            SET
                `country_id` = null
            WHERE
                `country_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this unsaved Country.');
        if ((is_null($objTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this Country with an unsaved Tourist.');

        // Get the Database Object for this Class
        $objDatabase = Country::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `tourist`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objTourist->Id) . ' AND
                `country_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Deletes all associated Tourists
     * @return void
    */
    public function deleteAllTourists()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this unsaved Country.');

        // Get the Database Object for this Class
        $objDatabase = Country::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `tourist`
            WHERE
                `country_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
        return "country";
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
     * @return NodeCountry
     */
    public static function baseNode()
    {
        return QQN::Country();
    }

    
    ////////////////////////////////////////
    // METHODS for SOAP-BASED WEB SERVICES
    ////////////////////////////////////////

    public static function getSoapComplexTypeXml()
    {
        $strToReturn = '<complexType name="Country"><sequence>';
        $strToReturn .= '<element name="Id" type="xsd:int"/>';
        $strToReturn .= '<element name="IsoCode" type="xsd:string"/>';
        $strToReturn .= '<element name="TelCode" type="xsd:int"/>';
        $strToReturn .= '<element name="EuropeanUnion" type="xsd:boolean"/>';
        $strToReturn .= '<element name="NameEn" type="xsd:string"/>';
        $strToReturn .= '<element name="NameNl" type="xsd:string"/>';
        $strToReturn .= '<element name="NameFr" type="xsd:string"/>';
        $strToReturn .= '<element name="NameEs" type="xsd:string"/>';
        $strToReturn .= '<element name="NameIt" type="xsd:string"/>';
        $strToReturn .= '<element name="NameDe" type="xsd:string"/>';
        $strToReturn .= '<element name="NamePl" type="xsd:string"/>';
        $strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
        $strToReturn .= '</sequence></complexType>';
        return $strToReturn;
    }

    public static function alterSoapComplexTypeArray(&$strComplexTypeArray)
    {
        if (!array_key_exists('Country', $strComplexTypeArray)) {
            $strComplexTypeArray['Country'] = Country::GetSoapComplexTypeXml();
        }
    }

    public static function getArrayFromSoapArray($objSoapArray)
    {
        $objArrayToReturn = array();

        foreach ($objSoapArray as $objSoapObject)
            array_push($objArrayToReturn, Country::GetObjectFromSoapObject($objSoapObject));

        return $objArrayToReturn;
    }

    public static function getObjectFromSoapObject($objSoapObject)
    {
        $objToReturn = new Country();
        if (property_exists($objSoapObject, 'Id'))
            $objToReturn->intId = $objSoapObject->Id;
        if (property_exists($objSoapObject, 'IsoCode'))
            $objToReturn->strIsoCode = $objSoapObject->IsoCode;
        if (property_exists($objSoapObject, 'TelCode'))
            $objToReturn->intTelCode = $objSoapObject->TelCode;
        if (property_exists($objSoapObject, 'EuropeanUnion'))
            $objToReturn->blnEuropeanUnion = $objSoapObject->EuropeanUnion;
        if (property_exists($objSoapObject, 'NameEn'))
            $objToReturn->strNameEn = $objSoapObject->NameEn;
        if (property_exists($objSoapObject, 'NameNl'))
            $objToReturn->strNameNl = $objSoapObject->NameNl;
        if (property_exists($objSoapObject, 'NameFr'))
            $objToReturn->strNameFr = $objSoapObject->NameFr;
        if (property_exists($objSoapObject, 'NameEs'))
            $objToReturn->strNameEs = $objSoapObject->NameEs;
        if (property_exists($objSoapObject, 'NameIt'))
            $objToReturn->strNameIt = $objSoapObject->NameIt;
        if (property_exists($objSoapObject, 'NameDe'))
            $objToReturn->strNameDe = $objSoapObject->NameDe;
        if (property_exists($objSoapObject, 'NamePl'))
            $objToReturn->strNamePl = $objSoapObject->NamePl;
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
            array_push($objArrayToReturn, Country::GetSoapObjectFromObject($objObject, true));

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
        if (isset($this->__blnValid[self::ISO_CODE_FIELD])) {
            $iArray['IsoCode'] = $this->strIsoCode;
        }
        if (isset($this->__blnValid[self::TEL_CODE_FIELD])) {
            $iArray['TelCode'] = $this->intTelCode;
        }
        if (isset($this->__blnValid[self::EUROPEAN_UNION_FIELD])) {
            $iArray['EuropeanUnion'] = $this->blnEuropeanUnion;
        }
        if (isset($this->__blnValid[self::NAME_EN_FIELD])) {
            $iArray['NameEn'] = $this->strNameEn;
        }
        if (isset($this->__blnValid[self::NAME_NL_FIELD])) {
            $iArray['NameNl'] = $this->strNameNl;
        }
        if (isset($this->__blnValid[self::NAME_FR_FIELD])) {
            $iArray['NameFr'] = $this->strNameFr;
        }
        if (isset($this->__blnValid[self::NAME_ES_FIELD])) {
            $iArray['NameEs'] = $this->strNameEs;
        }
        if (isset($this->__blnValid[self::NAME_IT_FIELD])) {
            $iArray['NameIt'] = $this->strNameIt;
        }
        if (isset($this->__blnValid[self::NAME_DE_FIELD])) {
            $iArray['NameDe'] = $this->strNameDe;
        }
        if (isset($this->__blnValid[self::NAME_PL_FIELD])) {
            $iArray['NamePl'] = $this->strNamePl;
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
     * any query calls (like Load or QueryArray), with a call to Country::ClearCache()
     *
     * @return array An array that is json serializable
     */
    public function jsonSerialize ()
    {
        $a = [];
        if (isset($this->__blnValid[self::ID_FIELD])) {
            $a['id'] = $this->intId;
        }
        if (isset($this->__blnValid[self::ISO_CODE_FIELD])) {
            $a['iso_code'] = $this->strIsoCode;
        }
        if (isset($this->__blnValid[self::TEL_CODE_FIELD])) {
            $a['tel_code'] = $this->intTelCode;
        }
        if (isset($this->__blnValid[self::EUROPEAN_UNION_FIELD])) {
            $a['european_union'] = $this->blnEuropeanUnion;
        }
        if (isset($this->__blnValid[self::NAME_EN_FIELD])) {
            $a['name_en'] = $this->strNameEn;
        }
        if (isset($this->__blnValid[self::NAME_NL_FIELD])) {
            $a['name_nl'] = $this->strNameNl;
        }
        if (isset($this->__blnValid[self::NAME_FR_FIELD])) {
            $a['name_fr'] = $this->strNameFr;
        }
        if (isset($this->__blnValid[self::NAME_ES_FIELD])) {
            $a['name_es'] = $this->strNameEs;
        }
        if (isset($this->__blnValid[self::NAME_IT_FIELD])) {
            $a['name_it'] = $this->strNameIt;
        }
        if (isset($this->__blnValid[self::NAME_DE_FIELD])) {
            $a['name_de'] = $this->strNameDe;
        }
        if (isset($this->__blnValid[self::NAME_PL_FIELD])) {
            $a['name_pl'] = $this->strNamePl;
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
 * @property-read Node\Column $IsoCode
 * @property-read Node\Column $TelCode
 * @property-read Node\Column $EuropeanUnion
 * @property-read Node\Column $NameEn
 * @property-read Node\Column $NameNl
 * @property-read Node\Column $NameFr
 * @property-read Node\Column $NameEs
 * @property-read Node\Column $NameIt
 * @property-read Node\Column $NameDe
 * @property-read Node\Column $NamePl
 * @property-read ReverseReferenceNodeTourist $Tourist
 * @property-read Node\Column $_PrimaryKeyNode
 **/
class NodeCountry extends Node\Table {
    protected $strTableName = 'country';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'Country';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "iso_code",
            "tel_code",
            "european_union",
            "name_en",
            "name_nl",
            "name_fr",
            "name_es",
            "name_it",
            "name_de",
            "name_pl",
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
            case 'IsoCode':
                return new Node\Column('iso_code', 'IsoCode', 'VarChar', $this);
            case 'TelCode':
                return new Node\Column('tel_code', 'TelCode', 'Integer', $this);
            case 'EuropeanUnion':
                return new Node\Column('european_union', 'EuropeanUnion', 'Bit', $this);
            case 'NameEn':
                return new Node\Column('name_en', 'NameEn', 'VarChar', $this);
            case 'NameNl':
                return new Node\Column('name_nl', 'NameNl', 'VarChar', $this);
            case 'NameFr':
                return new Node\Column('name_fr', 'NameFr', 'VarChar', $this);
            case 'NameEs':
                return new Node\Column('name_es', 'NameEs', 'VarChar', $this);
            case 'NameIt':
                return new Node\Column('name_it', 'NameIt', 'VarChar', $this);
            case 'NameDe':
                return new Node\Column('name_de', 'NameDe', 'VarChar', $this);
            case 'NamePl':
                return new Node\Column('name_pl', 'NamePl', 'VarChar', $this);
            case 'Tourist':
                return new ReverseReferenceNodeTourist($this, 'tourist', \QCubed\Type::REVERSE_REFERENCE, 'country_id', 'Tourist');

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
 * @property-read Node\Column $IsoCode
 * @property-read Node\Column $TelCode
 * @property-read Node\Column $EuropeanUnion
 * @property-read Node\Column $NameEn
 * @property-read Node\Column $NameNl
 * @property-read Node\Column $NameFr
 * @property-read Node\Column $NameEs
 * @property-read Node\Column $NameIt
 * @property-read Node\Column $NameDe
 * @property-read Node\Column $NamePl
 * @property-read ReverseReferenceNodeTourist $Tourist

 * @property-read Node\Column $_PrimaryKeyNode
 **/
class ReverseReferenceNodeCountry extends Node\ReverseReference {
    protected $strTableName = 'country';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'Country';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "iso_code",
            "tel_code",
            "european_union",
            "name_en",
            "name_nl",
            "name_fr",
            "name_es",
            "name_it",
            "name_de",
            "name_pl",
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
            case 'IsoCode':
                return new Node\Column('iso_code', 'IsoCode', 'VarChar', $this);
            case 'TelCode':
                return new Node\Column('tel_code', 'TelCode', 'Integer', $this);
            case 'EuropeanUnion':
                return new Node\Column('european_union', 'EuropeanUnion', 'Bit', $this);
            case 'NameEn':
                return new Node\Column('name_en', 'NameEn', 'VarChar', $this);
            case 'NameNl':
                return new Node\Column('name_nl', 'NameNl', 'VarChar', $this);
            case 'NameFr':
                return new Node\Column('name_fr', 'NameFr', 'VarChar', $this);
            case 'NameEs':
                return new Node\Column('name_es', 'NameEs', 'VarChar', $this);
            case 'NameIt':
                return new Node\Column('name_it', 'NameIt', 'VarChar', $this);
            case 'NameDe':
                return new Node\Column('name_de', 'NameDe', 'VarChar', $this);
            case 'NamePl':
                return new Node\Column('name_pl', 'NamePl', 'VarChar', $this);
            case 'Tourist':
                return new ReverseReferenceNodeTourist($this, 'tourist', \QCubed\Type::REVERSE_REFERENCE, 'country_id', 'Tourist');

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
