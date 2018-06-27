<?php
/**
 * Generated Position base class file
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
 * Class PositionGen
 *
 * The abstract PositionGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the Position subclass which
 * extends this PositionGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the Position class.
 *
 * @package My QCubed Application
 * @subpackage ModelGen
 * @property-read integer $Id the value of the id column (Read-Only PK)
 * @property string $Lat the value of the lat column 
 * @property string $Long the value of the long column 
 * @property integer $Height the value of the height column 
 * @property-read Event $_Event the value of the protected _objEvent (Read-Only) if set due to an expansion on the event.position_id reverse relationship
 * @property-read Event $Event the value of the protected _objEvent (Read-Only) if set due to an expansion on the event.position_id reverse relationship
 * @property-read Event[] $_EventArray the value of the protected _objEventArray (Read-Only) if set due to an ExpandAsArray on the event.position_id reverse relationship
 * @property-read Event[] $EventArray the value of the protected _objEventArray (Read-Only) if set due to an ExpandAsArray on the event.position_id reverse relationship
 * @property-read Tourist $_Tourist the value of the protected _objTourist (Read-Only) if set due to an expansion on the tourist.position_id reverse relationship
 * @property-read Tourist $Tourist the value of the protected _objTourist (Read-Only) if set due to an expansion on the tourist.position_id reverse relationship
 * @property-read Tourist[] $_TouristArray the value of the protected _objTouristArray (Read-Only) if set due to an ExpandAsArray on the tourist.position_id reverse relationship
 * @property-read Tourist[] $TouristArray the value of the protected _objTouristArray (Read-Only) if set due to an ExpandAsArray on the tourist.position_id reverse relationship
 * @property-read TrackPoint $_TrackPoint the value of the protected _objTrackPoint (Read-Only) if set due to an expansion on the track_point.position_id reverse relationship
 * @property-read TrackPoint $TrackPoint the value of the protected _objTrackPoint (Read-Only) if set due to an expansion on the track_point.position_id reverse relationship
 * @property-read TrackPoint[] $_TrackPointArray the value of the protected _objTrackPointArray (Read-Only) if set due to an ExpandAsArray on the track_point.position_id reverse relationship
 * @property-read TrackPoint[] $TrackPointArray the value of the protected _objTrackPointArray (Read-Only) if set due to an ExpandAsArray on the track_point.position_id reverse relationship
 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
 */
abstract class PositionGen extends \QCubed\ObjectBase implements IteratorAggregate, JsonSerializable {

    use ModelTrait;

    /** @var boolean Set to false in superclass to save a little time if this db object should not be watched for changes. */
    public static $blnWatchChanges = true;

    /** @var Position[] Short term cached Position objects */
    protected static $objCacheArray = array();

    ///////////////////////////////////////////////////////////////////////
    // PROTECTED AND PRIVATE MEMBER VARIABLES and CONSTS
    ///////////////////////////////////////////////////////////////////////

    /**
     * Protected member variable that maps to the database PK Identity column position.id
     * @var integer intId
     */
    private $intId;

    const ID_DEFAULT = null;
    const ID_FIELD = 'id';


    /**
     * Protected member variable that maps to the database column position.lat
     * @var string strLat
     */
    private $strLat;
    const LatMaxLength = 11; // Deprecated
    const LAT_MAX_LENGTH = 11;

    const LAT_DEFAULT = null;
    const LAT_FIELD = 'lat';


    /**
     * Protected member variable that maps to the database column position.long
     * @var string strLong
     */
    private $strLong;
    const LongMaxLength = 11; // Deprecated
    const LONG_MAX_LENGTH = 11;

    const LONG_DEFAULT = null;
    const LONG_FIELD = 'long';


    /**
     * Protected member variable that maps to the database column position.height
     * @var integer intHeight
     */
    private $intHeight;

    const HEIGHT_DEFAULT = null;
    const HEIGHT_FIELD = 'height';


    /**
     * Protected member variable that stores a reference to a single Event object
     * (of type Event), if this Position object was restored with
     * an expansion on the event association table.
     * @var Event _objEvent;
     */
    protected $_objEvent;

    /**
     * Protected member variable that stores a reference to an array of Event objects
     * (of type Event[]), if this Position object was restored with
     * an ExpandAsArray on the event association table.
     * @var Event[] _objEventArray;
     */
    protected $_objEventArray = null;

    /**
     * Protected member variable that stores a reference to a single Tourist object
     * (of type Tourist), if this Position object was restored with
     * an expansion on the tourist association table.
     * @var Tourist _objTourist;
     */
    protected $_objTourist;

    /**
     * Protected member variable that stores a reference to an array of Tourist objects
     * (of type Tourist[]), if this Position object was restored with
     * an ExpandAsArray on the tourist association table.
     * @var Tourist[] _objTouristArray;
     */
    protected $_objTouristArray = null;

    /**
     * Protected member variable that stores a reference to a single TrackPoint object
     * (of type TrackPoint), if this Position object was restored with
     * an expansion on the track_point association table.
     * @var TrackPoint _objTrackPoint;
     */
    protected $_objTrackPoint;

    /**
     * Protected member variable that stores a reference to an array of TrackPoint objects
     * (of type TrackPoint[]), if this Position object was restored with
     * an ExpandAsArray on the track_point association table.
     * @var TrackPoint[] _objTrackPointArray;
     */
    protected $_objTrackPointArray = null;

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
     * Construct a new Position object.
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
        $this->strLat = Position::LAT_DEFAULT;
        $this->__blnValid[self::LAT_FIELD] = true;
        $this->strLong = Position::LONG_DEFAULT;
        $this->__blnValid[self::LONG_FIELD] = true;
        $this->intHeight = Position::HEIGHT_DEFAULT;
        $this->__blnValid[self::HEIGHT_FIELD] = true;
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
     * Load a Position from PK Info
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return Position
     */
    public static function load($intId, $objOptionalClauses = null)
    {
        if (!$objOptionalClauses) {
            $objCachedObject = static::getFromCache ($intId);
            if ($objCachedObject) return $objCachedObject;
        }

        // Use QuerySingle to Perform the Query
        $objToReturn = Position::querySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::Position()->Id, $intId)
            ),
            $objOptionalClauses
        );
        return $objToReturn;
    }


    /**
     * Load all Positions
     * @param iClause[]|null $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return Position[]
     * @throws Caller
     */
    public static function loadAll($objOptionalClauses = null)
    {
        if (func_num_args() > 1) {
            throw new Caller("LoadAll must be called with an array of optional clauses as a single argument");
        }
        // Call Position::queryArray to perform the LoadAll query
        try {
            return Position::queryArray(QQ::All(), $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count all Positions
     * @return int
     */
    public static function countAll()
    {
        // Call Position::queryCount to perform the CountAll query
        return Position::queryCount(QQ::All());
    }


    /**
     * Static Qcubed Query method to query for a single Position object.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return Position the queried object
     */
    public static function querySingle(iCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null)
    {
        return static::_QuerySingle($objConditions, $objOptionalClauses, $mixParameterArray);
    }

    /**
     * Static Qcubed Query method to query for an array of Position objects.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return Position[] the queried objects as an array
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
        $clauses[] = QQ::Select(QQN::Position()->Id);
        $objPositions = self::QueryArray($objConditions, $clauses);
        $pks = [];
        foreach ($objPositions as $objPosition) {
            $pks[] = $objPosition->intId;
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
    * @return Position the queried object
    */
    public static function getFromCache($key)
    {
        return static::_GetFromCache($key);
    }


    /**
     * Instantiate a Position from a Database Row.
     * Takes in an optional strAliasPrefix, used in case another Object::instantiateDbRow
     * is calling this Position::instantiateDbRow in order to perform
     * early binding on referenced objects.
     * @param \QCubed\Database\RowBase $objDbRow
     * @param string $strAliasPrefix
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param array|null $objPreviousItemArray Used by expansion code to aid in expanding arrays
     * @param string[] $strColumnAliasArray Array of column aliases mapping names in the query to items in the object
     * @param boolean $blnCheckDuplicate Used by ExpandArray to indicate we should not create a new object if this is a duplicate of a previoius object
     * @param string $strParentExpansionKey If this is part of an expansion, indicates what the parent item is
     * @param mixed $objExpansionParent If this is part of an expansion, is the object corresponding to the key so that we can refer back to the parent object
     * @return mixed Either a Position, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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
            // Create a new instance of the Position object
            $objToReturn = new Position(false);
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
            $strAlias = $strAliasPrefix . 'lat';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strLat = $mixVal;
                $objToReturn->__blnValid[self::LAT_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'long';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                $objToReturn->strLong = $mixVal;
                $objToReturn->__blnValid[self::LONG_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'height';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = (integer)$mixVal;
                }
                $objToReturn->intHeight = $mixVal;
                $objToReturn->__blnValid[self::HEIGHT_FIELD] = true;
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
            $strAliasPrefix = 'position__';




        // Check for Event Virtual Binding
        $strAlias = $strAliasPrefix . 'event__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        $objExpansionNode = (empty($objExpansionAliasArray['event']) ? null : $objExpansionAliasArray['event']);
        $blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
        if ($blnExpanded && null === $objToReturn->_objEventArray)
            $objToReturn->_objEventArray = array();
        if (isset ($strColumns[$strAliasName])) {
            if ($blnExpanded) {
                $objToReturn->_objEventArray[] = Event::instantiateDbRow($objDbRow, $strAliasPrefix . 'event__', $objExpansionNode, null, $strColumnAliasArray, false, 'position_id', $objToReturn);
            } elseif (is_null($objToReturn->_objEvent)) {
                $objToReturn->_objEvent = Event::instantiateDbRow($objDbRow, $strAliasPrefix . 'event__', $objExpansionNode, null, $strColumnAliasArray, false, 'position_id', $objToReturn);
            }
        }
        elseif ($strParentExpansionKey === 'event' && $objExpansionParent) {
            $objToReturn->_objEvent = $objExpansionParent;
        }

        // Check for Tourist Virtual Binding
        $strAlias = $strAliasPrefix . 'tourist__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        $objExpansionNode = (empty($objExpansionAliasArray['tourist']) ? null : $objExpansionAliasArray['tourist']);
        $blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
        if ($blnExpanded && null === $objToReturn->_objTouristArray)
            $objToReturn->_objTouristArray = array();
        if (isset ($strColumns[$strAliasName])) {
            if ($blnExpanded) {
                $objToReturn->_objTouristArray[] = Tourist::instantiateDbRow($objDbRow, $strAliasPrefix . 'tourist__', $objExpansionNode, null, $strColumnAliasArray, false, 'position_id', $objToReturn);
            } elseif (is_null($objToReturn->_objTourist)) {
                $objToReturn->_objTourist = Tourist::instantiateDbRow($objDbRow, $strAliasPrefix . 'tourist__', $objExpansionNode, null, $strColumnAliasArray, false, 'position_id', $objToReturn);
            }
        }
        elseif ($strParentExpansionKey === 'tourist' && $objExpansionParent) {
            $objToReturn->_objTourist = $objExpansionParent;
        }

        // Check for TrackPoint Virtual Binding
        $strAlias = $strAliasPrefix . 'trackpoint__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        $objExpansionNode = (empty($objExpansionAliasArray['trackpoint']) ? null : $objExpansionAliasArray['trackpoint']);
        $blnExpanded = ($objExpansionNode && $objExpansionNode->ExpandAsArray);
        if ($blnExpanded && null === $objToReturn->_objTrackPointArray)
            $objToReturn->_objTrackPointArray = array();
        if (isset ($strColumns[$strAliasName])) {
            if ($blnExpanded) {
                $objToReturn->_objTrackPointArray[] = TrackPoint::instantiateDbRow($objDbRow, $strAliasPrefix . 'trackpoint__', $objExpansionNode, null, $strColumnAliasArray, false, 'position_id', $objToReturn);
            } elseif (is_null($objToReturn->_objTrackPoint)) {
                $objToReturn->_objTrackPoint = TrackPoint::instantiateDbRow($objDbRow, $strAliasPrefix . 'trackpoint__', $objExpansionNode, null, $strColumnAliasArray, false, 'position_id', $objToReturn);
            }
        }
        elseif ($strParentExpansionKey === 'trackpoint' && $objExpansionParent) {
            $objToReturn->_objTrackPoint = $objExpansionParent;
        }

        return $objToReturn;
    }

    /**
     * Instantiate an array of Positions from a Database Result
     * @param \QCubed\Database\ResultBase $objDbResult
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param string[] $strColumnAliasArray
     * @return Position[]
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
                $objItem = Position::instantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
                if ($objItem) {
                    $objToReturn[] = $objItem;
                    $objPrevItemArray[$objItem->intId][] = $objItem;
		
                }
            }
        } else {
            while ($objDbRow = $objDbResult->GetNextRow())
                $objToReturn[] = Position::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
        }

        return $objToReturn;
    }


    /**
     * Instantiate a single Position object from a query cursor (e.g. a DB ResultSet).
     * Cursor is automatically moved to the "next row" of the result set.
     * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
     * @param \QCubed\Database\ResultBase $objDbResult cursor resource
     * @return Position next row resulting from the query
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
        return Position::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
    }



    ///////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Single Load and Array)
    ///////////////////////////////////////////////////

    /**
     * Load a single Position object,
     * by Id Index(es)
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return Position
    */
    public static function loadById($intId, $objOptionalClauses = null)
    {
        return Position::QuerySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::Position()->Id, $intId)
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
    * Save this Position
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
     * Insert into Position
     */
    protected function insert()
    {
        $mixToReturn = null;
        $objDatabase = Position::GetDatabase();

        $objDatabase->NonQuery('
            INSERT INTO `position` (
							`lat`,
							`long`,
							`height`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strLat) . ',
							' . $objDatabase->SqlVariable($this->strLong) . ',
							' . $objDatabase->SqlVariable($this->intHeight) . '
						)
        ');
        // Update Identity column and return its value
        $mixToReturn = $this->intId = $objDatabase->InsertId('position', 'id');
        $this->__blnValid[self::ID_FIELD] = true;


        static::broadcastInsert($this->PrimaryKey());

        return $mixToReturn;
    }

   /**
    * Update this Position
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
            `position`
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

		if (isset($this->__blnDirty[self::LAT_FIELD])) {
			$strCol = '`lat`';
			$strValue = $objDatabase->sqlVariable($this->strLat);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::LONG_FIELD])) {
			$strCol = '`long`';
			$strValue = $objDatabase->sqlVariable($this->strLong);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::HEIGHT_FIELD])) {
			$strCol = '`height`';
			$strValue = $objDatabase->sqlVariable($this->intHeight);
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
     * Delete this Position
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
     */
    public function delete()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Cannot delete this Position with an unset primary key.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();


        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `position`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($this->intId) . '');

        $this->DeleteFromCache();
        static::BroadcastDelete($this->PrimaryKey());
    }

    /**
     * Delete all Positions
     * @return void
     */
    public static function deleteAll()
    {
        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            DELETE FROM
                `position`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    /**
     * Truncate position table
     * @return void
     */
    public static function truncate()
    {
        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            TRUNCATE `position`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    
    /**
	 * Reload this Position from the database.
     * @param iClause[]|null $clauses
     * @throws Caller
	 * @return void
	 */
	public function reload($clauses = null)
    {
		// Make sure we are actually Restored from the database
		if (!$this->__blnRestored)
			throw new Caller('Cannot call Reload() on a new, unsaved Position object.');

		// throw away all previous state of the object
		$this->DeleteFromCache();
		$this->__blnValid = null;
		$this->__blnDirty = null;

		// Reload the Object
		$objReloaded = Position::Load($this->intId, $clauses);

		// Update $this's local variables to match
		$this->__blnValid[self::ID_FIELD] = true;
		if (isset($objReloaded->__blnValid[self::LAT_FIELD])) {
			$this->strLat = $objReloaded->strLat;
			$this->__blnValid[self::LAT_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::LONG_FIELD])) {
			$this->strLong = $objReloaded->strLong;
			$this->__blnValid[self::LONG_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::HEIGHT_FIELD])) {
			$this->intHeight = $objReloaded->intHeight;
			$this->__blnValid[self::HEIGHT_FIELD] = true;
		}
	}
    ////////////////////
    // UTILITIES
    ////////////////////
    
    /**
     *  Return an array of Positions keyed by the unique Id property.
     *	@param Position[]
     *	@return Position[]
     **/
    public static function keyPositionsById($positions) {
        if (empty($positions)) {
            return $positions;
        }
        $ret = [];
        foreach ($positions as $position) {
            $ret[$position->intId] = $position;
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
	* Gets the value of strLat 
	* @throws Caller
	* @return string
	*/
	public function getLat()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::LAT_FIELD])) {
			throw new Caller("Lat was not selected in the most recent query and is not valid.");
		}
		return $this->strLat;
	}




   /**
	* Sets the value of strLat 
	* Returns $this to allow chaining of setters.
	* @param string|null $strLat
    * @throws Caller
	* @return Position
	*/
	public function setLat($strLat)
    {
		$strLat = Type::Cast($strLat, QCubed\Type::STRING);

		if ($this->strLat !== $strLat) {
			$this->strLat = $strLat;
			$this->__blnDirty[self::LAT_FIELD] = true;
		}
		$this->__blnValid[self::LAT_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of strLong 
	* @throws Caller
	* @return string
	*/
	public function getLong()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::LONG_FIELD])) {
			throw new Caller("Long was not selected in the most recent query and is not valid.");
		}
		return $this->strLong;
	}




   /**
	* Sets the value of strLong 
	* Returns $this to allow chaining of setters.
	* @param string|null $strLong
    * @throws Caller
	* @return Position
	*/
	public function setLong($strLong)
    {
		$strLong = Type::Cast($strLong, QCubed\Type::STRING);

		if ($this->strLong !== $strLong) {
			$this->strLong = $strLong;
			$this->__blnDirty[self::LONG_FIELD] = true;
		}
		$this->__blnValid[self::LONG_FIELD] = true;
		return $this; // allows chaining
	}

   /**
	* Gets the value of intHeight 
	* @throws Caller
	* @return integer
	*/
	public function getHeight()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::HEIGHT_FIELD])) {
			throw new Caller("Height was not selected in the most recent query and is not valid.");
		}
		return $this->intHeight;
	}




   /**
	* Sets the value of intHeight 
	* Returns $this to allow chaining of setters.
	* @param integer|null $intHeight
    * @throws Caller
	* @return Position
	*/
	public function setHeight($intHeight)
    {
		$intHeight = Type::Cast($intHeight, QCubed\Type::INTEGER);

		if ($this->intHeight !== $intHeight) {
			$this->intHeight = $intHeight;
			$this->__blnDirty[self::HEIGHT_FIELD] = true;
		}
		$this->__blnValid[self::HEIGHT_FIELD] = true;
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
		$objCopy->_objEvent = null;
		$objCopy->_objEventArray = null;
		$objCopy->_objTourist = null;
		$objCopy->_objTouristArray = null;
		$objCopy->_objTrackPoint = null;
		$objCopy->_objTrackPointArray = null;

		return $objCopy;
	}

    
   /**
	* The current record has just been inserted into the table. Let everyone know.
	* @param integer	$pk Primary key of record just inserted.
	*/
	protected static function broadcastInsert($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'position');
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
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'position');
        }
	}

   /**
	* The current record has just been deleted. Let everyone know.
	* @param integer	$pk Primary key of record just deleted.
	*/
	protected static function broadcastDelete($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'position');
        }
	}

   /**
	* All records have just been deleted. Let everyone know.
	*/
	protected static function broadcastDeleteAll()
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'position');
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

            case 'Event':
            case '_Event':
                /**
                 * Gets the value of the protected _objEvent (Read-Only)
                 * if set due to an expansion on the event.position_id reverse relationship
                 * @return Event
                 */
                return $this->_objEvent;

            case 'EventArray':
            case '_EventArray':
                /**
                 * Gets the value of the protected _objEventArray (Read-Only)
                 * if set due to an ExpandAsArray on the event.position_id reverse relationship
                 * @return Event[]
                 */
                return $this->_objEventArray;

            case 'Tourist':
            case '_Tourist':
                /**
                 * Gets the value of the protected _objTourist (Read-Only)
                 * if set due to an expansion on the tourist.position_id reverse relationship
                 * @return Tourist
                 */
                return $this->_objTourist;

            case 'TouristArray':
            case '_TouristArray':
                /**
                 * Gets the value of the protected _objTouristArray (Read-Only)
                 * if set due to an ExpandAsArray on the tourist.position_id reverse relationship
                 * @return Tourist[]
                 */
                return $this->_objTouristArray;

            case 'TrackPoint':
            case '_TrackPoint':
                /**
                 * Gets the value of the protected _objTrackPoint (Read-Only)
                 * if set due to an expansion on the track_point.position_id reverse relationship
                 * @return TrackPoint
                 */
                return $this->_objTrackPoint;

            case 'TrackPointArray':
            case '_TrackPointArray':
                /**
                 * Gets the value of the protected _objTrackPointArray (Read-Only)
                 * if set due to an ExpandAsArray on the track_point.position_id reverse relationship
                 * @return TrackPoint[]
                 */
                return $this->_objTrackPointArray;


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
            return Event::LoadArrayByPositionId($this->intId, $objOptionalClauses);
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

        return Event::CountByPositionId($this->intId);
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
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateEvent on this unsaved Position.');
        if ((is_null($objEvent->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateEvent on this Position with an unsaved Event.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `event`
            SET
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateEvent on this unsaved Position.');
        if ((is_null($objEvent->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateEvent on this Position with an unsaved Event.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `event`
            SET
                `position_id` = null
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objEvent->Id) . ' AND
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Unassociates all Events
     * @return void
    */
    public function unassociateAllEvents()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateEvent on this unsaved Position.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `event`
            SET
                `position_id` = null
            WHERE
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateEvent on this unsaved Position.');
        if ((is_null($objEvent->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateEvent on this Position with an unsaved Event.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `event`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objEvent->Id) . ' AND
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Deletes all associated Events
     * @return void
    */
    public function deleteAllEvents()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateEvent on this unsaved Position.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `event`
            WHERE
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }


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
            return Tourist::LoadArrayByPositionId($this->intId, $objOptionalClauses);
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

        return Tourist::CountByPositionId($this->intId);
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
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateTourist on this unsaved Position.');
        if ((is_null($objTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateTourist on this Position with an unsaved Tourist.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `tourist`
            SET
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this unsaved Position.');
        if ((is_null($objTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this Position with an unsaved Tourist.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `tourist`
            SET
                `position_id` = null
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objTourist->Id) . ' AND
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Unassociates all Tourists
     * @return void
    */
    public function unassociateAllTourists()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this unsaved Position.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `tourist`
            SET
                `position_id` = null
            WHERE
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this unsaved Position.');
        if ((is_null($objTourist->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this Position with an unsaved Tourist.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `tourist`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objTourist->Id) . ' AND
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Deletes all associated Tourists
     * @return void
    */
    public function deleteAllTourists()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTourist on this unsaved Position.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `tourist`
            WHERE
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }


    // Related Objects' Methods for TrackPoint
    //-------------------------------------------------------------------

    /**
     * Gets all associated TrackPoints as an array of TrackPoint objects
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return TrackPoint[]
     * @throws Caller
     */
    public function getTrackPointArray($objOptionalClauses = null)
    {
        if ((is_null($this->intId)))
            return array();

        try {
            return TrackPoint::LoadArrayByPositionId($this->intId, $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Counts all associated TrackPoints
     * @return int
    */
    public function countTrackPoints()
    {
        if ((is_null($this->intId)))
            return 0;

        return TrackPoint::CountByPositionId($this->intId);
    }

    /**
     * Associates a TrackPoint
     * @param TrackPoint $objTrackPoint
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
    */
    public function associateTrackPoint(TrackPoint $objTrackPoint)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateTrackPoint on this unsaved Position.');
        if ((is_null($objTrackPoint->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call AssociateTrackPoint on this Position with an unsaved TrackPoint.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `track_point`
            SET
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objTrackPoint->Id) . '
        ');
    }

    /**
     * Unassociates a TrackPoint
     * @param TrackPoint $objTrackPoint
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
    */
    public function unassociateTrackPoint(TrackPoint $objTrackPoint)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTrackPoint on this unsaved Position.');
        if ((is_null($objTrackPoint->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTrackPoint on this Position with an unsaved TrackPoint.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `track_point`
            SET
                `position_id` = null
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objTrackPoint->Id) . ' AND
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Unassociates all TrackPoints
     * @return void
    */
    public function unassociateAllTrackPoints()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTrackPoint on this unsaved Position.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            UPDATE
                `track_point`
            SET
                `position_id` = null
            WHERE
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Deletes an associated TrackPoint
     * @param TrackPoint $objTrackPoint
     * @return void
    */
    public function deleteAssociatedTrackPoint(TrackPoint $objTrackPoint)
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTrackPoint on this unsaved Position.');
        if ((is_null($objTrackPoint->Id)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTrackPoint on this Position with an unsaved TrackPoint.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `track_point`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($objTrackPoint->Id) . ' AND
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
        ');
    }

    /**
     * Deletes all associated TrackPoints
     * @return void
    */
    public function deleteAllTrackPoints()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Unable to call UnassociateTrackPoint on this unsaved Position.');

        // Get the Database Object for this Class
        $objDatabase = Position::GetDatabase();

        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `track_point`
            WHERE
                `position_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
        return "position";
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
     * @return NodePosition
     */
    public static function baseNode()
    {
        return QQN::Position();
    }

    
    ////////////////////////////////////////
    // METHODS for SOAP-BASED WEB SERVICES
    ////////////////////////////////////////

    public static function getSoapComplexTypeXml()
    {
        $strToReturn = '<complexType name="Position"><sequence>';
        $strToReturn .= '<element name="Id" type="xsd:int"/>';
        $strToReturn .= '<element name="Lat" type="xsd:string"/>';
        $strToReturn .= '<element name="Long" type="xsd:string"/>';
        $strToReturn .= '<element name="Height" type="xsd:int"/>';
        $strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
        $strToReturn .= '</sequence></complexType>';
        return $strToReturn;
    }

    public static function alterSoapComplexTypeArray(&$strComplexTypeArray)
    {
        if (!array_key_exists('Position', $strComplexTypeArray)) {
            $strComplexTypeArray['Position'] = Position::GetSoapComplexTypeXml();
        }
    }

    public static function getArrayFromSoapArray($objSoapArray)
    {
        $objArrayToReturn = array();

        foreach ($objSoapArray as $objSoapObject)
            array_push($objArrayToReturn, Position::GetObjectFromSoapObject($objSoapObject));

        return $objArrayToReturn;
    }

    public static function getObjectFromSoapObject($objSoapObject)
    {
        $objToReturn = new Position();
        if (property_exists($objSoapObject, 'Id'))
            $objToReturn->intId = $objSoapObject->Id;
        if (property_exists($objSoapObject, 'Lat'))
            $objToReturn->strLat = $objSoapObject->Lat;
        if (property_exists($objSoapObject, 'Long'))
            $objToReturn->strLong = $objSoapObject->Long;
        if (property_exists($objSoapObject, 'Height'))
            $objToReturn->intHeight = $objSoapObject->Height;
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
            array_push($objArrayToReturn, Position::GetSoapObjectFromObject($objObject, true));

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
        if (isset($this->__blnValid[self::LAT_FIELD])) {
            $iArray['Lat'] = $this->strLat;
        }
        if (isset($this->__blnValid[self::LONG_FIELD])) {
            $iArray['Long'] = $this->strLong;
        }
        if (isset($this->__blnValid[self::HEIGHT_FIELD])) {
            $iArray['Height'] = $this->intHeight;
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
     * any query calls (like Load or QueryArray), with a call to Position::ClearCache()
     *
     * @return array An array that is json serializable
     */
    public function jsonSerialize ()
    {
        $a = [];
        if (isset($this->__blnValid[self::ID_FIELD])) {
            $a['id'] = $this->intId;
        }
        if (isset($this->__blnValid[self::LAT_FIELD])) {
            $a['lat'] = $this->strLat;
        }
        if (isset($this->__blnValid[self::LONG_FIELD])) {
            $a['long'] = $this->strLong;
        }
        if (isset($this->__blnValid[self::HEIGHT_FIELD])) {
            $a['height'] = $this->intHeight;
        }
        if (isset($this->_objEvent)) {
            $a['event'] = $this->_objEvent;
        } elseif (isset($this->_objEventArray)) {
            $a['event'] = $this->_objEventArray;
        }
        if (isset($this->_objTourist)) {
            $a['tourist'] = $this->_objTourist;
        } elseif (isset($this->_objTouristArray)) {
            $a['tourist'] = $this->_objTouristArray;
        }
        if (isset($this->_objTrackPoint)) {
            $a['track_point'] = $this->_objTrackPoint;
        } elseif (isset($this->_objTrackPointArray)) {
            $a['track_point'] = $this->_objTrackPointArray;
        }
        return $a;
    }



    

}



/////////////////////////////////////
// ADDITIONAL CLASSES for QCubed QUERY
/////////////////////////////////////

/**
 * @property-read Node\Column $Id
 * @property-read Node\Column $Lat
 * @property-read Node\Column $Long
 * @property-read Node\Column $Height
 * @property-read ReverseReferenceNodeEvent $Event
 * @property-read ReverseReferenceNodeTourist $Tourist
 * @property-read ReverseReferenceNodeTrackPoint $TrackPoint
 * @property-read Node\Column $_PrimaryKeyNode
 **/
class NodePosition extends Node\Table {
    protected $strTableName = 'position';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'Position';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "lat",
            "long",
            "height",
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
            case 'Lat':
                return new Node\Column('lat', 'Lat', 'VarChar', $this);
            case 'Long':
                return new Node\Column('long', 'Long', 'VarChar', $this);
            case 'Height':
                return new Node\Column('height', 'Height', 'Integer', $this);
            case 'Event':
                return new ReverseReferenceNodeEvent($this, 'event', \QCubed\Type::REVERSE_REFERENCE, 'position_id', 'Event');
            case 'Tourist':
                return new ReverseReferenceNodeTourist($this, 'tourist', \QCubed\Type::REVERSE_REFERENCE, 'position_id', 'Tourist');
            case 'TrackPoint':
                return new ReverseReferenceNodeTrackPoint($this, 'trackpoint', \QCubed\Type::REVERSE_REFERENCE, 'position_id', 'TrackPoint');

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
 * @property-read Node\Column $Lat
 * @property-read Node\Column $Long
 * @property-read Node\Column $Height
 * @property-read ReverseReferenceNodeEvent $Event
 * @property-read ReverseReferenceNodeTourist $Tourist
 * @property-read ReverseReferenceNodeTrackPoint $TrackPoint

 * @property-read Node\Column $_PrimaryKeyNode
 **/
class ReverseReferenceNodePosition extends Node\ReverseReference {
    protected $strTableName = 'position';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'Position';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "lat",
            "long",
            "height",
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
            case 'Lat':
                return new Node\Column('lat', 'Lat', 'VarChar', $this);
            case 'Long':
                return new Node\Column('long', 'Long', 'VarChar', $this);
            case 'Height':
                return new Node\Column('height', 'Height', 'Integer', $this);
            case 'Event':
                return new ReverseReferenceNodeEvent($this, 'event', \QCubed\Type::REVERSE_REFERENCE, 'position_id', 'Event');
            case 'Tourist':
                return new ReverseReferenceNodeTourist($this, 'tourist', \QCubed\Type::REVERSE_REFERENCE, 'position_id', 'Tourist');
            case 'TrackPoint':
                return new ReverseReferenceNodeTrackPoint($this, 'trackpoint', \QCubed\Type::REVERSE_REFERENCE, 'position_id', 'TrackPoint');

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
