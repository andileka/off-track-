<?php
/**
 * Generated Device base class file
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
 * Class DeviceGen
 *
 * The abstract DeviceGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the Device subclass which
 * extends this DeviceGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the Device class.
 *
 * @package My QCubed Application
 * @subpackage ModelGen
 * @property-read integer $Id the value of the id column (Read-Only PK)
 * @property string $Pac the value of the pac column 
 * @property string $Serial the value of the serial column 
 * @property integer $CompanyId the value of the company_id column 
 * @property Company $Company the value of the Company object referenced by intCompanyId 
 * @property-read DeviceTourist $_DeviceTourist the value of the protected _objDeviceTourist (Read-Only) if set due to an expansion on the device_tourist.device_id reverse relationship
 * @property-read DeviceTourist $DeviceTourist the value of the protected _objDeviceTourist (Read-Only) if set due to an expansion on the device_tourist.device_id reverse relationship
 * @property-read DeviceTourist[] $_DeviceTouristArray the value of the protected _objDeviceTouristArray (Read-Only) if set due to an ExpandAsArray on the device_tourist.device_id reverse relationship
 * @property-read DeviceTourist[] $DeviceTouristArray the value of the protected _objDeviceTouristArray (Read-Only) if set due to an ExpandAsArray on the device_tourist.device_id reverse relationship
 * @property-read Event $_Event the value of the protected _objEvent (Read-Only) if set due to an expansion on the event.device_id reverse relationship
 * @property-read Event $Event the value of the protected _objEvent (Read-Only) if set due to an expansion on the event.device_id reverse relationship
 * @property-read Event[] $_EventArray the value of the protected _objEventArray (Read-Only) if set due to an ExpandAsArray on the event.device_id reverse relationship
 * @property-read Event[] $EventArray the value of the protected _objEventArray (Read-Only) if set due to an ExpandAsArray on the event.device_id reverse relationship
 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
 */
abstract class DeviceGen extends \QCubed\ObjectBase implements IteratorAggregate, JsonSerializable {

    use ModelTrait;

    /** @var boolean Set to false in superclass to save a little time if this db object should not be watched for changes. */
    public static $blnWatchChanges = true;

    /** @var Device[] Short term cached Device objects */
    protected static $objCacheArray = array();

    ///////////////////////////////////////////////////////////////////////
    // PROTECTED AND PRIVATE MEMBER VARIABLES and CONSTS
    ///////////////////////////////////////////////////////////////////////

    /**
     * Protected member variable that maps to the database PK Identity column device.id
     * @var integer intId
     */
    private $intId;

    const ID_DEFAULT = null;
    const ID_FIELD = 'id';


    /**
     * Protected member variable that maps to the database column device.pac
     * @var string strPac
     */
    private $strPac;
    const PacMaxLength = 45; // Deprecated
    const PAC_MAX_LENGTH = 45;

    const PAC_DEFAULT = null;
    const PAC_FIELD = 'pac';


    /**
     * Protected member variable that maps to the database column device.serial
     * @var string strSerial
     */
    private $strSerial;
    const SerialMaxLength = 45; // Deprecated
    const SERIAL_MAX_LENGTH = 45;

    const SERIAL_DEFAULT = null;
    const SERIAL_FIELD = 'serial';


    /**
     * Protected member variable that maps to the database column device.company_id
     * @var integer intCompanyId
     */
    private $intCompanyId;

    const COMPANY_ID_DEFAULT = null;
    const COMPANY_ID_FIELD = 'company_id';


    /**
     * Protected member variable that stores a reference to a single DeviceTourist object
     * (of type DeviceTourist), if this Device object was restored with
     * an expansion on the device_tourist association table.
     * @var DeviceTourist _objDeviceTourist;
     */
    protected $_objDeviceTourist;

    /**
     * Protected member variable that stores a reference to an array of DeviceTourist objects
     * (of type DeviceTourist[]), if this Device object was restored with
     * an ExpandAsArray on the device_tourist association table.
     * @var DeviceTourist[] _objDeviceTouristArray;
     */
    protected $_objDeviceTouristArray = null;

    /**
     * Protected member variable that stores a reference to a single Event object
     * (of type Event), if this Device object was restored with
     * an expansion on the event association table.
     * @var Event _objEvent;
     */
    protected $_objEvent;

    /**
     * Protected member variable that stores a reference to an array of Event objects
     * (of type Event[]), if this Device object was restored with
     * an ExpandAsArray on the event association table.
     * @var Event[] _objEventArray;
     */
    protected $_objEventArray = null;

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
     * in the database column device.company_id.
     *
     * NOTE: Always use the Company property getter to correctly retrieve this Company object.
     * (Because this class implements late binding, this variable reference MAY be null.)
     * @var Company objCompany
     */
    protected $objCompany;



    /**
     * Construct a new Device object.
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
        $this->strPac = Device::PAC_DEFAULT;
        $this->__blnValid[self::PAC_FIELD] = true;
        $this->strSerial = Device::SERIAL_DEFAULT;
        $this->__blnValid[self::SERIAL_FIELD] = true;
        $this->intCompanyId = Device::COMPANY_ID_DEFAULT;
        $this->__blnValid[self::COMPANY_ID_FIELD] = true;
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
     * Load a Device from PK Info
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return Device
     */
    public static function load($intId, $objOptionalClauses = null)
    {
        if (!$objOptionalClauses) {
            $objCachedObject = static::getFromCache ($intId);
            if ($objCachedObject) return $objCachedObject;
        }

        // Use QuerySingle to Perform the Query
        $objToReturn = Device::querySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::Device()->Id, $intId)
            ),
            $objOptionalClauses
        );
        return $objToReturn;
    }


    /**
     * Load all Devices
     * @param iClause[]|null $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return Device[]
     * @throws Caller
     */
    public static function loadAll($objOptionalClauses = null)
    {
        if (func_num_args() > 1) {
            throw new Caller("LoadAll must be called with an array of optional clauses as a single argument");
        }
        // Call Device::queryArray to perform the LoadAll query
        try {
            return Device::queryArray(QQ::All(), $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count all Devices
     * @return int
     */
    public static function countAll()
    {
        // Call Device::queryCount to perform the CountAll query
        return Device::queryCount(QQ::All());
    }


    /**
     * Static Qcubed Query method to query for a single Device object.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return Device the queried object
     */
    public static function querySingle(iCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null)
    {
        return static::_QuerySingle($objConditions, $objOptionalClauses, $mixParameterArray);
    }

    /**
     * Static Qcubed Query method to query for an array of Device objects.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return Device[] the queried objects as an array
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
        $clauses[] = QQ::Select(QQN::Device()->Id);
        $objDevices = self::QueryArray($objConditions, $clauses);
        $pks = [];
        foreach ($objDevices as $objDevice) {
            $pks[] = $objDevice->intId;
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
    * @return Device the queried object
    */
    public static function getFromCache($key)
    {
        return static::_GetFromCache($key);
    }


    /**
     * Instantiate a Device from a Database Row.
     * Takes in an optional strAliasPrefix, used in case another Object::instantiateDbRow
     * is calling this Device::instantiateDbRow in order to perform
     * early binding on referenced objects.
     * @param \QCubed\Database\RowBase $objDbRow
     * @param string $strAliasPrefix
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param array|null $objPreviousItemArray Used by expansion code to aid in expanding arrays
     * @param string[] $strColumnAliasArray Array of column aliases mapping names in the query to items in the object
     * @param boolean $blnCheckDuplicate Used by ExpandArray to indicate we should not create a new object if this is a duplicate of a previoius object
     * @param string $strParentExpansionKey If this is part of an expansion, indicates what the parent item is
     * @param mixed $objExpansionParent If this is part of an expansion, is the object corresponding to the key so that we can refer back to the parent object
     * @return mixed Either a Device, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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
            // Create a new instance of the Device object
            $objToReturn = new Device(false);
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
            $strAlias = $strAliasPrefix . 'pac';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strPac = $mixVal;
                $objToReturn->__blnValid[self::PAC_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'serial';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strSerial = $mixVal;
                $objToReturn->__blnValid[self::SERIAL_FIELD] = true;
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
            $strAliasPrefix = 'device__';

        // Check for Company Early Binding
        $strAlias = $strAliasPrefix . 'company_id__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        if (isset ($strColumns[$strAliasName])) {
            $objExpansionNode = (empty($objExpansionAliasArray['company_id']) ? null : $objExpansionAliasArray['company_id']);
            $objToReturn->objCompany = Company::instantiateDbRow($objDbRow, $strAliasPrefix . 'company_id__', $objExpansionNode, null, $strColumnAliasArray, false, 'device', $objToReturn);
        }
        elseif ($strParentExpansionKey === 'company_id' && $objExpansionParent) {
            $objToReturn->objCompany = $objExpansionParent;
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
                $objToReturn->_objDeviceTouristArray[] = DeviceTourist::instantiateDbRow($objDbRow, $strAliasPrefix . 'devicetourist__', $objExpansionNode, null, $strColumnAliasArray, false, 'device_id', $objToReturn);
            } elseif (is_null($objToReturn->_objDeviceTourist)) {
                $objToReturn->_objDeviceTourist = DeviceTourist::instantiateDbRow($objDbRow, $strAliasPrefix . 'devicetourist__', $objExpansionNode, null, $strColumnAliasArray, false, 'device_id', $objToReturn);
            }
        }
        elseif ($strParentExpansionKey === 'devicetourist' && $objExpansionParent) {
            $objToReturn->_objDeviceTourist = $objExpansionParent;
        }

        // Check for Event Virtual Binding
        $strAlias = $strAliasPrefix . 'event__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        $objExpansionNode = (empty($objExpansionAliasArray['event']) ? null : $objExpansionAliasArray['event']);
        $blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
        if ($blnExpanded && null === $objToReturn->_objEventArray)
            $objToReturn->_objEventArray = array();
        if (isset ($strColumns[$strAliasName])) {
            if ($blnExpanded) {
                $objToReturn->_objEventArray[] = Event::instantiateDbRow($objDbRow, $strAliasPrefix . 'event__', $objExpansionNode, null, $strColumnAliasArray, false, 'device_id', $objToReturn);
            } elseif (is_null($objToReturn->_objEvent)) {
                $objToReturn->_objEvent = Event::instantiateDbRow($objDbRow, $strAliasPrefix . 'event__', $objExpansionNode, null, $strColumnAliasArray, false, 'device_id', $objToReturn);
            }
        }
        elseif ($strParentExpansionKey === 'event' && $objExpansionParent) {
            $objToReturn->_objEvent = $objExpansionParent;
        }

        return $objToReturn;
    }

    /**
     * Instantiate an array of Devices from a Database Result
     * @param \QCubed\Database\ResultBase $objDbResult
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param string[] $strColumnAliasArray
     * @return Device[]
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
                $objItem = Device::instantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
                if ($objItem) {
                    $objToReturn[] = $objItem;
                    $objPrevItemArray[$objItem->intId][] = $objItem;
		
                }
            }
        } else {
            while ($objDbRow = $objDbResult->GetNextRow())
                $objToReturn[] = Device::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
        }

        return $objToReturn;
    }


    /**
     * Instantiate a single Device object from a query cursor (e.g. a DB ResultSet).
     * Cursor is automatically moved to the "next row" of the result set.
     * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
     * @param \QCubed\Database\ResultBase $objDbResult cursor resource
     * @return Device next row resulting from the query
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
        return Device::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
    }



    ///////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Single Load and Array)
    ///////////////////////////////////////////////////

    /**
     * Load a single Device object,
     * by Id Index(es)
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return Device
    */
    public static function loadById($intId, $objOptionalClauses = null)
    {
        return Device::QuerySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::Device()->Id, $intId)
            ),
            $objOptionalClauses
        );
    }

    /**
     * Load an array of Device objects,
     * by CompanyId Index(es)
     * @param integer $intCompanyId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return Device[]
    */
    public static function loadArrayByCompanyId($intCompanyId, $objOptionalClauses = null)
    {
        // Call Device::QueryArray to perform the LoadArrayByCompanyId query
        try {
            return Device::QueryArray(
                QQ::Equal(QQN::Device()->CompanyId, $intCompanyId),
                $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count Devices
     * by CompanyId Index(es)
     * @param integer $intCompanyId
     * @return int
    */
    public static function countByCompanyId($intCompanyId)
    {
        // Call Device::QueryCount to perform the CountByCompanyId query
        return Device::QueryCount(
            QQ::Equal(QQN::Device()->CompanyId, $intCompanyId)
        );
    }


    ////////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Array via Many to Many)
    ////////////////////////////////////////////////////




    //////////////////////////
    // SAVE, DELETE AND RELOAD
    //////////////////////////
    

    /**
    * Save this Device
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
     * Insert into Device
     */
    protected function insert()
    {
        $mixToReturn = null;
        $objDatabase = Device::GetDatabase();

        $objDatabase->NonQuery('
            INSERT INTO `device` (
							`pac`,
							`serial`,
							`company_id`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strPac) . ',
							' . $objDatabase->SqlVariable($this->strSerial) . ',
							' . $objDatabase->SqlVariable($this->intCompanyId) . '
						)
        ');
        // Update Identity column and return its value
        $mixToReturn = $this->intId = $objDatabase->InsertId('device', 'id');
        $this->__blnValid[self::ID_FIELD] = true;


        static::broadcastInsert($this->PrimaryKey());

        return $mixToReturn;
    }

   /**
    * Update this Device
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
            `device`
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

		if (isset($this->__blnDirty[self::PAC_FIELD])) {
			$strCol = '`pac`';
			$strValue = $objDatabase->sqlVariable($this->strPac);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::SERIAL_FIELD])) {
			$strCol = '`serial`';
			$strValue = $objDatabase->sqlVariable($this->strSerial);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::COMPANY_ID_FIELD])) {
			$strCol = '`company_id`';
			$strValue = $objDatabase->sqlVariable($this->intCompanyId);
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
     * Delete this Device
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
     */
    public function delete()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Cannot delete this Device with an unset primary key.');

        // Get the Database Object for this Class
        $objDatabase = Device::GetDatabase();


        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `device`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($this->intId) . '');

        $this->DeleteFromCache();
        static::BroadcastDelete($this->PrimaryKey());
    }

    /**
     * Delete all Devices
     * @return void
     */
    public static function deleteAll()
    {
        // Get the Database Object for this Class
        $objDatabase = Device::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            DELETE FROM
                `device`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    /**
     * Truncate device table
     * @return void
     */
    public static function truncate()
    {
        // Get the Database Object for this Class
        $objDatabase = Device::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            TRUNCATE `device`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    
    /**
	 * Reload this Device from the database.
     * @param iClause[]|null $clauses
     * @throws Caller
	 * @return void
	 */
	public function reload($clauses = null)
    {
		// Make sure we are actually Restored from the database
		if (!$this->__blnRestored)
			throw new Caller('Cannot call Reload() on a new, unsaved Device object.');

		// throw away all previous state of the object
		$this->DeleteFromCache();
		$this->__blnValid = null;
		$this->__blnDirty = null;

		// Reload the Object
		$objReloaded = Device::Load($this->intId, $clauses);

		// Update $this's local variables to match
		$this->__blnValid[self::ID_FIELD] = true;
		if (isset($objReloaded->__blnValid[self::PAC_FIELD])) {
			$this->strPac = $objReloaded->strPac;
			$this->__blnValid[self::PAC_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::SERIAL_FIELD])) {
			$this->strSerial = $objReloaded->strSerial;
			$this->__blnValid[self::SERIAL_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::COMPANY_ID_FIELD])) {
			$this->intCompanyId = $objReloaded->intCompanyId;
			$this->objCompany = $objReloaded->objCompany;
			$this->__blnValid[self::COMPANY_ID_FIELD] = true;
		}
	}
    ////////////////////
    // UTILITIES
    ////////////////////
    
    /**
     *  Return an array of Devices keyed by the unique Id property.
     *	@param Device[]
     *	@return Device[]
     **/
    public static function keyDevicesById($devices) {
        if (empty($devices)) {
            return $devices;
        }
        $ret = [];
        foreach ($devices as $device) {
            $ret[$device->intId] = $device;
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
	* Gets the value of strPac 
	* @throws Caller
	* @return string
	*/
	public function getPac()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::PAC_FIELD])) {
			throw new Caller("Pac was not selected in the most recent query and is not valid.");
		}
		return $this->strPac;
	}




   /**
	* Sets the value of strPac 
	* Returns $this to allow chaining of setters.
	* @param string|null $strPac
    * @throws Caller
	* @return Device
	*/
	public function setPac($strPac)
    {
		$strPac = Type::Cast($strPac, QCubed\Type::STRING);

		if ($this->strPac !== $strPac) {
			$this->strPac = $strPac;
			$this->__blnDirty[self::PAC_FIELD] = true;
		}
		$this->__blnValid[self::PAC_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strSerial 
	* @throws Caller
	* @return string
	*/
	public function getSerial()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::SERIAL_FIELD])) {
			throw new Caller("Serial was not selected in the most recent query and is not valid.");
		}
		return $this->strSerial;
	}




   /**
	* Sets the value of strSerial 
	* Returns $this to allow chaining of setters.
	* @param string|null $strSerial
    * @throws Caller
	* @return Device
	*/
	public function setSerial($strSerial)
    {
		$strSerial = Type::Cast($strSerial, QCubed\Type::STRING);

		if ($this->strSerial !== $strSerial) {
			$this->strSerial = $strSerial;
			$this->__blnDirty[self::SERIAL_FIELD] = true;
		}
		$this->__blnValid[self::SERIAL_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of intCompanyId 
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
     * Gets the value of the Company object referenced by intCompanyId 
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
	* Sets the value of intCompanyId 
	* Returns $this to allow chaining of setters.
	* @param integer|null $intCompanyId
    * @throws Caller
	* @return Device
	*/
	public function setCompanyId($intCompanyId)
    {
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
     * Sets the value of the Company object referenced by intCompanyId 
     * @param null|Company $objCompany
     * @throws Caller
     * @return Device
     */
    public function setCompany($objCompany) {
        if (is_null($objCompany)) {
            $this->setCompanyId(null);
        } else {
            $objCompany = Type::Cast($objCompany, 'Company');

            // Make sure its a SAVED Company object
            if (is_null($objCompany->Id)) {
                throw new Caller('Unable to set an unsaved Company for this Device');
            }

            // Update Local Member Variables
            $this->setCompanyId($objCompany->getId());
            $this->objCompany = $objCompany;
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
		$objCopy->_objEvent = null;
		$objCopy->_objEventArray = null;

		return $objCopy;
	}

    
   /**
	* The current record has just been inserted into the table. Let everyone know.
	* @param integer	$pk Primary key of record just inserted.
	*/
	protected static function broadcastInsert($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'device');
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
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'device');
        }
	}

   /**
	* The current record has just been deleted. Let everyone know.
	* @param integer	$pk Primary key of record just deleted.
	*/
	protected static function broadcastDelete($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'device');
        }
	}

   /**
	* All records have just been deleted. Let everyone know.
	*/
	protected static function broadcastDeleteAll()
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'device');
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
                 * if set due to an expansion on the device_tourist.device_id reverse relationship
                 * @return DeviceTourist
                 */
                return $this->_objDeviceTourist;

            case 'DeviceTouristArray':
            case '_DeviceTouristArray':
                /**
                 * Gets the value of the protected _objDeviceTouristArray (Read-Only)
                 * if set due to an ExpandAsArray on the device_tourist.device_id reverse relationship
                 * @return DeviceTourist[]
                 */
                return $this->_objDeviceTouristArray;

            case 'Event':
            case '_Event':
                /**
                 * Gets the value of the protected _objEvent (Read-Only)
                 * if set due to an expansion on the event.device_id reverse relationship
                 * @return Event
                 */
                return $this->_objEvent;

            case 'EventArray':
            case '_EventArray':
                /**
                 * Gets the value of the protected _objEventArray (Read-Only)
                 * if set due to an ExpandAsArray on the event.device_id reverse relationship
                 * @return Event[]
                 */
                return $this->_objEventArray;


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
            return DeviceTourist::LoadArrayByDeviceId($this->intId, $objOptionalClauses);
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

        return DeviceTourist::CountByDeviceId($this->intId);
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
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateDeviceTourist on this unsaved Device.');
        if ((is_null($objDeviceTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateDeviceTourist on this Device with an unsaved DeviceTourist.');

        // Get the Database Object for this Class
        $objDatabase = Device::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `device_tourist`
            SET
                `device_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateDeviceTourist on this unsaved Device.');
        if ((is_null($objDeviceTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateDeviceTourist on this Device with an unsaved DeviceTourist.');

        // Get the Database Object for this Class
        $objDatabase = Device::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `device_tourist`
            SET
                `device_id` = null
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objDeviceTourist->Id) . ' AND
                `device_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Unassociates all DeviceTourists
     * @return void
    */
    public function unassociateAllDeviceTourists()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateDeviceTourist on this unsaved Device.');

        // Get the Database Object for this Class
        $objDatabase = Device::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `device_tourist`
            SET
                `device_id` = null
            WHERE
                `device_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateDeviceTourist on this unsaved Device.');
        if ((is_null($objDeviceTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateDeviceTourist on this Device with an unsaved DeviceTourist.');

        // Get the Database Object for this Class
        $objDatabase = Device::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `device_tourist`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objDeviceTourist->Id) . ' AND
                `device_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Deletes all associated DeviceTourists
     * @return void
    */
    public function deleteAllDeviceTourists()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateDeviceTourist on this unsaved Device.');

        // Get the Database Object for this Class
        $objDatabase = Device::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `device_tourist`
            WHERE
                `device_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }


    // Related Objects' Methods for Event
    //-------------------------------------------------------------------

    /**
     * Gets all associated Events as an array of Event objects
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return Event[]
     * @throws Caller
     */
    public function getEventArray($objOptionalClauses = null)
    {
        if ((is_null($this->intId)))
            return array();

        try {
            return Event::LoadArrayByDeviceId($this->intId, $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Counts all associated Events
     * @return int
    */
    public function countEvents()
    {
        if ((is_null($this->intId)))
            return 0;

        return Event::CountByDeviceId($this->intId);
    }

    /**
     * Associates a Event
     * @param Event $objEvent
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
    */
    public function associateEvent(Event $objEvent)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateEvent on this unsaved Device.');
        if ((is_null($objEvent->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateEvent on this Device with an unsaved Event.');

        // Get the Database Object for this Class
        $objDatabase = Device::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `event`
            SET
                `device_id` = ' . $objDatabase->SqlVariable($this->intId) . '
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objEvent->Id) . '
        ');
    }

    /**
     * Unassociates a Event
     * @param Event $objEvent
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
    */
    public function unassociateEvent(Event $objEvent)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateEvent on this unsaved Device.');
        if ((is_null($objEvent->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateEvent on this Device with an unsaved Event.');

        // Get the Database Object for this Class
        $objDatabase = Device::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `event`
            SET
                `device_id` = null
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objEvent->Id) . ' AND
                `device_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Unassociates all Events
     * @return void
    */
    public function unassociateAllEvents()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateEvent on this unsaved Device.');

        // Get the Database Object for this Class
        $objDatabase = Device::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `event`
            SET
                `device_id` = null
            WHERE
                `device_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Deletes an associated Event
     * @param Event $objEvent
     * @return void
    */
    public function deleteAssociatedEvent(Event $objEvent)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateEvent on this unsaved Device.');
        if ((is_null($objEvent->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateEvent on this Device with an unsaved Event.');

        // Get the Database Object for this Class
        $objDatabase = Device::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `event`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objEvent->Id) . ' AND
                `device_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Deletes all associated Events
     * @return void
    */
    public function deleteAllEvents()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateEvent on this unsaved Device.');

        // Get the Database Object for this Class
        $objDatabase = Device::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `event`
            WHERE
                `device_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
        return "device";
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
     * @return NodeDevice
     */
    public static function baseNode()
    {
        return QQN::Device();
    }

    
    ////////////////////////////////////////
    // METHODS for SOAP-BASED WEB SERVICES
    ////////////////////////////////////////

    public static function getSoapComplexTypeXml()
    {
        $strToReturn = '<complexType name="Device"><sequence>';
        $strToReturn .= '<element name="Id" type="xsd:int"/>';
        $strToReturn .= '<element name="Pac" type="xsd:string"/>';
        $strToReturn .= '<element name="Serial" type="xsd:string"/>';
        $strToReturn .= '<element name="Company" type="xsd1:Company"/>';
        $strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
        $strToReturn .= '</sequence></complexType>';
        return $strToReturn;
    }

    public static function alterSoapComplexTypeArray(&$strComplexTypeArray)
    {
        if (!array_key_exists('Device', $strComplexTypeArray)) {
            $strComplexTypeArray['Device'] = Device::GetSoapComplexTypeXml();
            Company::AlterSoapComplexTypeArray($strComplexTypeArray);
        }
    }

    public static function getArrayFromSoapArray($objSoapArray)
    {
        $objArrayToReturn = array();

        foreach ($objSoapArray as $objSoapObject)
            array_push($objArrayToReturn, Device::GetObjectFromSoapObject($objSoapObject));

        return $objArrayToReturn;
    }

    public static function getObjectFromSoapObject($objSoapObject)
    {
        $objToReturn = new Device();
        if (property_exists($objSoapObject, 'Id'))
            $objToReturn->intId = $objSoapObject->Id;
        if (property_exists($objSoapObject, 'Pac'))
            $objToReturn->strPac = $objSoapObject->Pac;
        if (property_exists($objSoapObject, 'Serial'))
            $objToReturn->strSerial = $objSoapObject->Serial;
        if ((property_exists($objSoapObject, 'Company')) &&
            ($objSoapObject->Company))
            $objToReturn->Company = Company::GetObjectFromSoapObject($objSoapObject->Company);
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
            array_push($objArrayToReturn, Device::GetSoapObjectFromObject($objObject, true));

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
        if (isset($this->__blnValid[self::PAC_FIELD])) {
            $iArray['Pac'] = $this->strPac;
        }
        if (isset($this->__blnValid[self::SERIAL_FIELD])) {
            $iArray['Serial'] = $this->strSerial;
        }
        if (isset($this->__blnValid[self::COMPANY_ID_FIELD])) {
            $iArray['CompanyId'] = $this->intCompanyId;
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
     * any query calls (like Load or QueryArray), with a call to Device::ClearCache()
     *
     * @return array An array that is json serializable
     */
    public function jsonSerialize ()
    {
        $a = [];
        if (isset($this->__blnValid[self::ID_FIELD])) {
            $a['id'] = $this->intId;
        }
        if (isset($this->__blnValid[self::PAC_FIELD])) {
            $a['pac'] = $this->strPac;
        }
        if (isset($this->__blnValid[self::SERIAL_FIELD])) {
            $a['serial'] = $this->strSerial;
        }
        if (isset($this->objCompany)) {
            $a['company'] = $this->objCompany;
        } elseif (isset($this->__blnValid[self::COMPANY_ID_FIELD])) {
            $a['company_id'] = $this->intCompanyId;
        }
        if (isset($this->_objDeviceTourist)) {
            $a['device_tourist'] = $this->_objDeviceTourist;
        } elseif (isset($this->_objDeviceTouristArray)) {
            $a['device_tourist'] = $this->_objDeviceTouristArray;
        }
        if (isset($this->_objEvent)) {
            $a['event'] = $this->_objEvent;
        } elseif (isset($this->_objEventArray)) {
            $a['event'] = $this->_objEventArray;
        }
        return $a;
    }



    

}



/////////////////////////////////////
// ADDITIONAL CLASSES for QCubed QUERY
/////////////////////////////////////

/**
 * @property-read Node\Column $Id
 * @property-read Node\Column $Pac
 * @property-read Node\Column $Serial
 * @property-read Node\Column $CompanyId
 * @property-read NodeCompany $Company
 * @property-read ReverseReferenceNodeDeviceTourist $DeviceTourist
 * @property-read ReverseReferenceNodeEvent $Event
 * @property-read Node\Column $_PrimaryKeyNode
 **/
class NodeDevice extends Node\Table {
    protected $strTableName = 'device';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'Device';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "pac",
            "serial",
            "company_id",
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
            case 'Pac':
                return new Node\Column('pac', 'Pac', 'VarChar', $this);
            case 'Serial':
                return new Node\Column('serial', 'Serial', 'VarChar', $this);
            case 'CompanyId':
                return new Node\Column('company_id', 'CompanyId', 'Integer', $this);
            case 'Company':
                return new NodeCompany('company_id', 'Company', 'Integer', $this);
            case 'DeviceTourist':
                return new ReverseReferenceNodeDeviceTourist($this, 'devicetourist', \QCubed\Type::REVERSE_REFERENCE, 'device_id', 'DeviceTourist');
            case 'Event':
                return new ReverseReferenceNodeEvent($this, 'event', \QCubed\Type::REVERSE_REFERENCE, 'device_id', 'Event');

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
 * @property-read Node\Column $Pac
 * @property-read Node\Column $Serial
 * @property-read Node\Column $CompanyId
 * @property-read NodeCompany $Company
 * @property-read ReverseReferenceNodeDeviceTourist $DeviceTourist
 * @property-read ReverseReferenceNodeEvent $Event

 * @property-read Node\Column $_PrimaryKeyNode
 **/
class ReverseReferenceNodeDevice extends Node\ReverseReference {
    protected $strTableName = 'device';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'Device';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "pac",
            "serial",
            "company_id",
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
            case 'Pac':
                return new Node\Column('pac', 'Pac', 'VarChar', $this);
            case 'Serial':
                return new Node\Column('serial', 'Serial', 'VarChar', $this);
            case 'CompanyId':
                return new Node\Column('company_id', 'CompanyId', 'Integer', $this);
            case 'Company':
                return new NodeCompany('company_id', 'Company', 'Integer', $this);
            case 'DeviceTourist':
                return new ReverseReferenceNodeDeviceTourist($this, 'devicetourist', \QCubed\Type::REVERSE_REFERENCE, 'device_id', 'DeviceTourist');
            case 'Event':
                return new ReverseReferenceNodeEvent($this, 'event', \QCubed\Type::REVERSE_REFERENCE, 'device_id', 'Event');

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
