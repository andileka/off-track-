<?php
/**
 * Generated TrackPoint base class file
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
 * Class TrackPointGen
 *
 * The abstract TrackPointGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the TrackPoint subclass which
 * extends this TrackPointGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the TrackPoint class.
 *
 * @package My QCubed Application
 * @subpackage ModelGen
 * @property-read integer $Id the value of the id column (Read-Only PK)
 * @property integer $TrackId the value of the track_id column 
 * @property integer $PositionId the value of the position_id column 
 * @property Track $Track the value of the Track object referenced by intTrackId 
 * @property Position $Position the value of the Position object referenced by intPositionId 
 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
 */
abstract class TrackPointGen extends \QCubed\ObjectBase implements IteratorAggregate, JsonSerializable {

    use ModelTrait;

    /** @var boolean Set to false in superclass to save a little time if this db object should not be watched for changes. */
    public static $blnWatchChanges = true;

    /** @var TrackPoint[] Short term cached TrackPoint objects */
    protected static $objCacheArray = array();

    ///////////////////////////////////////////////////////////////////////
    // PROTECTED AND PRIVATE MEMBER VARIABLES and CONSTS
    ///////////////////////////////////////////////////////////////////////

    /**
     * Protected member variable that maps to the database PK Identity column track_point.id
     * @var integer intId
     */
    private $intId;

    const ID_DEFAULT = null;
    const ID_FIELD = 'id';


    /**
     * Protected member variable that maps to the database column track_point.track_id
     * @var integer intTrackId
     */
    private $intTrackId;

    const TRACK_ID_DEFAULT = null;
    const TRACK_ID_FIELD = 'track_id';


    /**
     * Protected member variable that maps to the database column track_point.position_id
     * @var integer intPositionId
     */
    private $intPositionId;

    const POSITION_ID_DEFAULT = null;
    const POSITION_ID_FIELD = 'position_id';


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
     * in the database column track_point.track_id.
     *
     * NOTE: Always use the Track property getter to correctly retrieve this Track object.
     * (Because this class implements late binding, this variable reference MAY be null.)
     * @var Track objTrack
     */
    protected $objTrack;

    /**
     * Protected member variable that contains the object pointed by the reference
     * in the database column track_point.position_id.
     *
     * NOTE: Always use the Position property getter to correctly retrieve this Position object.
     * (Because this class implements late binding, this variable reference MAY be null.)
     * @var Position objPosition
     */
    protected $objPosition;



    /**
     * Construct a new TrackPoint object.
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
        $this->intTrackId = TrackPoint::TRACK_ID_DEFAULT;
        $this->__blnValid[self::TRACK_ID_FIELD] = true;
        $this->intPositionId = TrackPoint::POSITION_ID_DEFAULT;
        $this->__blnValid[self::POSITION_ID_FIELD] = true;
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
     * Load a TrackPoint from PK Info
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return TrackPoint
     */
    public static function load($intId, $objOptionalClauses = null)
    {
        if (!$objOptionalClauses) {
            $objCachedObject = static::getFromCache ($intId);
            if ($objCachedObject) return $objCachedObject;
        }

        // Use QuerySingle to Perform the Query
        $objToReturn = TrackPoint::querySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::TrackPoint()->Id, $intId)
            ),
            $objOptionalClauses
        );
        return $objToReturn;
    }


    /**
     * Load all TrackPoints
     * @param iClause[]|null $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return TrackPoint[]
     * @throws Caller
     */
    public static function loadAll($objOptionalClauses = null)
    {
        if (func_num_args() > 1) {
            throw new Caller("LoadAll must be called with an array of optional clauses as a single argument");
        }
        // Call TrackPoint::queryArray to perform the LoadAll query
        try {
            return TrackPoint::queryArray(QQ::All(), $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count all TrackPoints
     * @return int
     */
    public static function countAll()
    {
        // Call TrackPoint::queryCount to perform the CountAll query
        return TrackPoint::queryCount(QQ::All());
    }


    /**
     * Static Qcubed Query method to query for a single TrackPoint object.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return TrackPoint the queried object
     */
    public static function querySingle(iCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null)
    {
        return static::_QuerySingle($objConditions, $objOptionalClauses, $mixParameterArray);
    }

    /**
     * Static Qcubed Query method to query for an array of TrackPoint objects.
     * Offloads work to QModelTrait.trait.php
     * @param iCondition $objConditions any conditions on the query, itself
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
     * @return TrackPoint[] the queried objects as an array
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
        $clauses[] = QQ::Select(QQN::TrackPoint()->Id);
        $objTrackPoints = self::QueryArray($objConditions, $clauses);
        $pks = [];
        foreach ($objTrackPoints as $objTrackPoint) {
            $pks[] = $objTrackPoint->intId;
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
    * @return TrackPoint the queried object
    */
    public static function getFromCache($key)
    {
        return static::_GetFromCache($key);
    }


    /**
     * Instantiate a TrackPoint from a Database Row.
     * Takes in an optional strAliasPrefix, used in case another Object::instantiateDbRow
     * is calling this TrackPoint::instantiateDbRow in order to perform
     * early binding on referenced objects.
     * @param \QCubed\Database\RowBase $objDbRow
     * @param string $strAliasPrefix
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param array|null $objPreviousItemArray Used by expansion code to aid in expanding arrays
     * @param string[] $strColumnAliasArray Array of column aliases mapping names in the query to items in the object
     * @param boolean $blnCheckDuplicate Used by ExpandArray to indicate we should not create a new object if this is a duplicate of a previoius object
     * @param string $strParentExpansionKey If this is part of an expansion, indicates what the parent item is
     * @param mixed $objExpansionParent If this is part of an expansion, is the object corresponding to the key so that we can refer back to the parent object
     * @return mixed Either a TrackPoint, or false to indicate the dbrow was used in an expansion, or null to indicate that this leaf is a duplicate.
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
            // Create a new instance of the TrackPoint object
            $objToReturn = new TrackPoint(false);
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
            $strAlias = $strAliasPrefix . 'track_id';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = (integer)$mixVal;
                }
                $objToReturn->intTrackId = $mixVal;
                $objToReturn->__blnValid[self::TRACK_ID_FIELD] = true;
            }
            else {
                $blnNoCache = true;
            }
            $strAlias = $strAliasPrefix . 'position_id';
            $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
            if (isset ($strColumnKeys[$strAliasName])) {
                $mixVal = $strColumns[$strAliasName];
                if ($mixVal !== null) {
                    $mixVal = (integer)$mixVal;
                }
                $objToReturn->intPositionId = $mixVal;
                $objToReturn->__blnValid[self::POSITION_ID_FIELD] = true;
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
            $strAliasPrefix = 'track_point__';

        // Check for Track Early Binding
        $strAlias = $strAliasPrefix . 'track_id__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        if (isset ($strColumns[$strAliasName])) {
            $objExpansionNode = (empty($objExpansionAliasArray['track_id']) ? null : $objExpansionAliasArray['track_id']);
            $objToReturn->objTrack = Track::instantiateDbRow($objDbRow, $strAliasPrefix . 'track_id__', $objExpansionNode, null, $strColumnAliasArray, false, 'trackpoint', $objToReturn);
        }
        elseif ($strParentExpansionKey === 'track_id' && $objExpansionParent) {
            $objToReturn->objTrack = $objExpansionParent;
        }

        // Check for Position Early Binding
        $strAlias = $strAliasPrefix . 'position_id__id';
        $strAliasName = !empty($strColumnAliasArray[$strAlias]) ? $strColumnAliasArray[$strAlias] : $strAlias;
        if (isset ($strColumns[$strAliasName])) {
            $objExpansionNode = (empty($objExpansionAliasArray['position_id']) ? null : $objExpansionAliasArray['position_id']);
            $objToReturn->objPosition = Position::instantiateDbRow($objDbRow, $strAliasPrefix . 'position_id__', $objExpansionNode, null, $strColumnAliasArray, false, 'trackpoint', $objToReturn);
        }
        elseif ($strParentExpansionKey === 'position_id' && $objExpansionParent) {
            $objToReturn->objPosition = $objExpansionParent;
        }




        return $objToReturn;
    }

    /**
     * Instantiate an array of TrackPoints from a Database Result
     * @param \QCubed\Database\ResultBase $objDbResult
     * @param Node\NodeBase $objExpandAsArrayNode
     * @param string[] $strColumnAliasArray
     * @return TrackPoint[]
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
                $objItem = TrackPoint::instantiateDbRow($objDbRow, null, $objExpandAsArrayNode, $objPrevItemArray, $strColumnAliasArray);
                if ($objItem) {
                    $objToReturn[] = $objItem;
                    $objPrevItemArray[$objItem->intId][] = $objItem;
		
                }
            }
        } else {
            while ($objDbRow = $objDbResult->GetNextRow())
                $objToReturn[] = TrackPoint::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
        }

        return $objToReturn;
    }


    /**
     * Instantiate a single TrackPoint object from a query cursor (e.g. a DB ResultSet).
     * Cursor is automatically moved to the "next row" of the result set.
     * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
     * @param \QCubed\Database\ResultBase $objDbResult cursor resource
     * @return TrackPoint next row resulting from the query
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
        return TrackPoint::instantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
    }



    ///////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Single Load and Array)
    ///////////////////////////////////////////////////

    /**
     * Load a single TrackPoint object,
     * by Id Index(es)
     * @param integer $intId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @return TrackPoint
    */
    public static function loadById($intId, $objOptionalClauses = null)
    {
        return TrackPoint::QuerySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::TrackPoint()->Id, $intId)
            ),
            $objOptionalClauses
        );
    }

    /**
     * Load an array of TrackPoint objects,
     * by PositionId Index(es)
     * @param integer $intPositionId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return TrackPoint[]
    */
    public static function loadArrayByPositionId($intPositionId, $objOptionalClauses = null)
    {
        // Call TrackPoint::QueryArray to perform the LoadArrayByPositionId query
        try {
            return TrackPoint::QueryArray(
                QQ::Equal(QQN::TrackPoint()->PositionId, $intPositionId),
                $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count TrackPoints
     * by PositionId Index(es)
     * @param integer $intPositionId
     * @return int
    */
    public static function countByPositionId($intPositionId)
    {
        // Call TrackPoint::QueryCount to perform the CountByPositionId query
        return TrackPoint::QueryCount(
            QQ::Equal(QQN::TrackPoint()->PositionId, $intPositionId)
        );
    }

    /**
     * Load an array of TrackPoint objects,
     * by TrackId Index(es)
     * @param integer $intTrackId
     * @param iClause[] $objOptionalClauses additional optional iClause objects for this query
     * @throws Caller
     * @return TrackPoint[]
    */
    public static function loadArrayByTrackId($intTrackId, $objOptionalClauses = null)
    {
        // Call TrackPoint::QueryArray to perform the LoadArrayByTrackId query
        try {
            return TrackPoint::QueryArray(
                QQ::Equal(QQN::TrackPoint()->TrackId, $intTrackId),
                $objOptionalClauses);
        } catch (Caller $objExc) {
            $objExc->incrementOffset();
            throw $objExc;
        }
    }

    /**
     * Count TrackPoints
     * by TrackId Index(es)
     * @param integer $intTrackId
     * @return int
    */
    public static function countByTrackId($intTrackId)
    {
        // Call TrackPoint::QueryCount to perform the CountByTrackId query
        return TrackPoint::QueryCount(
            QQ::Equal(QQN::TrackPoint()->TrackId, $intTrackId)
        );
    }


    ////////////////////////////////////////////////////
    // INDEX-BASED LOAD METHODS (Array via Many to Many)
    ////////////////////////////////////////////////////




    //////////////////////////
    // SAVE, DELETE AND RELOAD
    //////////////////////////
    

    /**
    * Save this TrackPoint
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
     * Insert into TrackPoint
     */
    protected function insert()
    {
        $mixToReturn = null;
        $objDatabase = TrackPoint::GetDatabase();

        $objDatabase->NonQuery('
            INSERT INTO `track_point` (
							`track_id`,
							`position_id`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intTrackId) . ',
							' . $objDatabase->SqlVariable($this->intPositionId) . '
						)
        ');
        // Update Identity column and return its value
        $mixToReturn = $this->intId = $objDatabase->InsertId('track_point', 'id');
        $this->__blnValid[self::ID_FIELD] = true;


        static::broadcastInsert($this->PrimaryKey());

        return $mixToReturn;
    }

   /**
    * Update this TrackPoint
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
            `track_point`
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

		if (isset($this->__blnDirty[self::TRACK_ID_FIELD])) {
			$strCol = '`track_id`';
			$strValue = $objDatabase->sqlVariable($this->intTrackId);
			$values[] = $strCol . ' = ' . $strValue;
		}
		if (isset($this->__blnDirty[self::POSITION_ID_FIELD])) {
			$strCol = '`position_id`';
			$strValue = $objDatabase->sqlVariable($this->intPositionId);
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
     * Delete this TrackPoint
     * @throws \QCubed\Database\Exception\UndefinedPrimaryKey
     * @return void
     */
    public function delete()
    {
        if ((is_null($this->intId)))
            throw new \QCubed\Database\Exception\UndefinedPrimaryKey('Cannot delete this TrackPoint with an unset primary key.');

        // Get the Database Object for this Class
        $objDatabase = TrackPoint::GetDatabase();


        // Perform the SQL Query
        $objDatabase->NonQuery('
            DELETE FROM
                `track_point`
            WHERE
                `id` = ' . $objDatabase->SqlVariable($this->intId) . '');

        $this->DeleteFromCache();
        static::BroadcastDelete($this->PrimaryKey());
    }

    /**
     * Delete all TrackPoints
     * @return void
     */
    public static function deleteAll()
    {
        // Get the Database Object for this Class
        $objDatabase = TrackPoint::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            DELETE FROM
                `track_point`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    /**
     * Truncate track_point table
     * @return void
     */
    public static function truncate()
    {
        // Get the Database Object for this Class
        $objDatabase = TrackPoint::GetDatabase();

        // Perform the Query
        $objDatabase->NonQuery('
            TRUNCATE `track_point`');

        static::ClearCache();
        static::BroadcastDeleteAll();
    }

    
    /**
	 * Reload this TrackPoint from the database.
     * @param iClause[]|null $clauses
     * @throws Caller
	 * @return void
	 */
	public function reload($clauses = null)
    {
		// Make sure we are actually Restored from the database
		if (!$this->__blnRestored)
			throw new Caller('Cannot call Reload() on a new, unsaved TrackPoint object.');

		// throw away all previous state of the object
		$this->DeleteFromCache();
		$this->__blnValid = null;
		$this->__blnDirty = null;

		// Reload the Object
		$objReloaded = TrackPoint::Load($this->intId, $clauses);

		// Update $this's local variables to match
		$this->__blnValid[self::ID_FIELD] = true;
		if (isset($objReloaded->__blnValid[self::TRACK_ID_FIELD])) {
			$this->intTrackId = $objReloaded->intTrackId;
			$this->objTrack = $objReloaded->objTrack;
			$this->__blnValid[self::TRACK_ID_FIELD] = true;
		}
		if (isset($objReloaded->__blnValid[self::POSITION_ID_FIELD])) {
			$this->intPositionId = $objReloaded->intPositionId;
			$this->objPosition = $objReloaded->objPosition;
			$this->__blnValid[self::POSITION_ID_FIELD] = true;
		}
	}
    ////////////////////
    // UTILITIES
    ////////////////////
    
    /**
     *  Return an array of TrackPoints keyed by the unique Id property.
     *	@param TrackPoint[]
     *	@return TrackPoint[]
     **/
    public static function keyTrackPointsById($trackpoints) {
        if (empty($trackpoints)) {
            return $trackpoints;
        }
        $ret = [];
        foreach ($trackpoints as $trackpoint) {
            $ret[$trackpoint->intId] = $trackpoint;
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
	* Gets the value of intTrackId 
	* @throws Caller
	* @return integer
	*/
	public function getTrackId()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::TRACK_ID_FIELD])) {
			throw new Caller("TrackId was not selected in the most recent query and is not valid.");
		}
		return $this->intTrackId;
	}


    /**
     * Gets the value of the Track object referenced by intTrackId 
     * If the object is not loaded, will load the object (caching it) before returning it.
     * @throws Caller
     * @return Track
     */
     public function getTrack()
     {
 		if ($this->__blnRestored && empty($this->__blnValid[self::TRACK_ID_FIELD])) {
			throw new Caller("TrackId was not selected in the most recent query and is not valid.");
		}
        if ((!$this->objTrack) && (!is_null($this->intTrackId))) {
            $this->objTrack = Track::Load($this->intTrackId);
        }
        return $this->objTrack;
     }



   /**
	* Sets the value of intTrackId 
	* Returns $this to allow chaining of setters.
	* @param integer|null $intTrackId
    * @throws Caller
	* @return TrackPoint
	*/
	public function setTrackId($intTrackId)
    {
		$intTrackId = Type::Cast($intTrackId, QCubed\Type::INTEGER);

		if ($this->intTrackId !== $intTrackId) {
			$this->objTrack = null; // remove the associated object
			$this->intTrackId = $intTrackId;
			$this->__blnDirty[self::TRACK_ID_FIELD] = true;
		}
		$this->__blnValid[self::TRACK_ID_FIELD] = true;
		return $this; // allows chaining
	}

    /**
     * Sets the value of the Track object referenced by intTrackId 
     * @param null|Track $objTrack
     * @throws Caller
     * @return TrackPoint
     */
    public function setTrack($objTrack) {
        if (is_null($objTrack)) {
            $this->setTrackId(null);
        } else {
            $objTrack = Type::Cast($objTrack, 'Track');

            // Make sure its a SAVED Track object
            if (is_null($objTrack->Id)) {
                throw new Caller('Unable to set an unsaved Track for this TrackPoint');
            }

            // Update Local Member Variables
            $this->setTrackId($objTrack->getId());
            $this->objTrack = $objTrack;
        }
        return $this;
    }

   /**
	* Gets the value of intPositionId 
	* @throws Caller
	* @return integer
	*/
	public function getPositionId()
    {
		if ($this->__blnRestored && empty($this->__blnValid[self::POSITION_ID_FIELD])) {
			throw new Caller("PositionId was not selected in the most recent query and is not valid.");
		}
		return $this->intPositionId;
	}


    /**
     * Gets the value of the Position object referenced by intPositionId 
     * If the object is not loaded, will load the object (caching it) before returning it.
     * @throws Caller
     * @return Position
     */
     public function getPosition()
     {
 		if ($this->__blnRestored && empty($this->__blnValid[self::POSITION_ID_FIELD])) {
			throw new Caller("PositionId was not selected in the most recent query and is not valid.");
		}
        if ((!$this->objPosition) && (!is_null($this->intPositionId))) {
            $this->objPosition = Position::Load($this->intPositionId);
        }
        return $this->objPosition;
     }



   /**
	* Sets the value of intPositionId 
	* Returns $this to allow chaining of setters.
	* @param integer|null $intPositionId
    * @throws Caller
	* @return TrackPoint
	*/
	public function setPositionId($intPositionId)
    {
		$intPositionId = Type::Cast($intPositionId, QCubed\Type::INTEGER);

		if ($this->intPositionId !== $intPositionId) {
			$this->objPosition = null; // remove the associated object
			$this->intPositionId = $intPositionId;
			$this->__blnDirty[self::POSITION_ID_FIELD] = true;
		}
		$this->__blnValid[self::POSITION_ID_FIELD] = true;
		return $this; // allows chaining
	}

    /**
     * Sets the value of the Position object referenced by intPositionId 
     * @param null|Position $objPosition
     * @throws Caller
     * @return TrackPoint
     */
    public function setPosition($objPosition) {
        if (is_null($objPosition)) {
            $this->setPositionId(null);
        } else {
            $objPosition = Type::Cast($objPosition, 'Position');

            // Make sure its a SAVED Position object
            if (is_null($objPosition->Id)) {
                throw new Caller('Unable to set an unsaved Position for this TrackPoint');
            }

            // Update Local Member Variables
            $this->setPositionId($objPosition->getId());
            $this->objPosition = $objPosition;
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



		return $objCopy;
	}

    
   /**
	* The current record has just been inserted into the table. Let everyone know.
	* @param integer	$pk Primary key of record just inserted.
	*/
	protected static function broadcastInsert($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'track_point');
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
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'track_point');
        }
	}

   /**
	* The current record has just been deleted. Let everyone know.
	* @param integer	$pk Primary key of record just deleted.
	*/
	protected static function broadcastDelete($pk)
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'track_point');
        }
	}

   /**
	* All records have just been deleted. Let everyone know.
	*/
	protected static function broadcastDeleteAll()
    {
        if (static::$blnWatchChanges) {
            \QCubed\Project\Watcher\Watcher::markTableModified (static::getDatabase()->Database, 'track_point');
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
        return "track_point";
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
     * @return NodeTrackPoint
     */
    public static function baseNode()
    {
        return QQN::TrackPoint();
    }

    
    ////////////////////////////////////////
    // METHODS for SOAP-BASED WEB SERVICES
    ////////////////////////////////////////

    public static function getSoapComplexTypeXml()
    {
        $strToReturn = '<complexType name="TrackPoint"><sequence>';
        $strToReturn .= '<element name="Id" type="xsd:int"/>';
        $strToReturn .= '<element name="Track" type="xsd1:Track"/>';
        $strToReturn .= '<element name="Position" type="xsd1:Position"/>';
        $strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
        $strToReturn .= '</sequence></complexType>';
        return $strToReturn;
    }

    public static function alterSoapComplexTypeArray(&$strComplexTypeArray)
    {
        if (!array_key_exists('TrackPoint', $strComplexTypeArray)) {
            $strComplexTypeArray['TrackPoint'] = TrackPoint::GetSoapComplexTypeXml();
            Track::AlterSoapComplexTypeArray($strComplexTypeArray);
            Position::AlterSoapComplexTypeArray($strComplexTypeArray);
        }
    }

    public static function getArrayFromSoapArray($objSoapArray)
    {
        $objArrayToReturn = array();

        foreach ($objSoapArray as $objSoapObject)
            array_push($objArrayToReturn, TrackPoint::GetObjectFromSoapObject($objSoapObject));

        return $objArrayToReturn;
    }

    public static function getObjectFromSoapObject($objSoapObject)
    {
        $objToReturn = new TrackPoint();
        if (property_exists($objSoapObject, 'Id'))
            $objToReturn->intId = $objSoapObject->Id;
        if ((property_exists($objSoapObject, 'Track')) &&
            ($objSoapObject->Track))
            $objToReturn->Track = Track::GetObjectFromSoapObject($objSoapObject->Track);
        if ((property_exists($objSoapObject, 'Position')) &&
            ($objSoapObject->Position))
            $objToReturn->Position = Position::GetObjectFromSoapObject($objSoapObject->Position);
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
            array_push($objArrayToReturn, TrackPoint::GetSoapObjectFromObject($objObject, true));

        return unserialize(serialize($objArrayToReturn));
    }

    public static function getSoapObjectFromObject($objObject, $blnBindRelatedObjects)
    {
        if ($objObject->objTrack)
            $objObject->objTrack = Track::GetSoapObjectFromObject($objObject->objTrack, false);
        else if (!$blnBindRelatedObjects)
            $objObject->intTrackId = null;
        if ($objObject->objPosition)
            $objObject->objPosition = Position::GetSoapObjectFromObject($objObject->objPosition, false);
        else if (!$blnBindRelatedObjects)
            $objObject->intPositionId = null;
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
        if (isset($this->__blnValid[self::TRACK_ID_FIELD])) {
            $iArray['TrackId'] = $this->intTrackId;
        }
        if (isset($this->__blnValid[self::POSITION_ID_FIELD])) {
            $iArray['PositionId'] = $this->intPositionId;
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
     * any query calls (like Load or QueryArray), with a call to TrackPoint::ClearCache()
     *
     * @return array An array that is json serializable
     */
    public function jsonSerialize ()
    {
        $a = [];
        if (isset($this->__blnValid[self::ID_FIELD])) {
            $a['id'] = $this->intId;
        }
        if (isset($this->objTrack)) {
            $a['track'] = $this->objTrack;
        } elseif (isset($this->__blnValid[self::TRACK_ID_FIELD])) {
            $a['track_id'] = $this->intTrackId;
        }
        if (isset($this->objPosition)) {
            $a['position'] = $this->objPosition;
        } elseif (isset($this->__blnValid[self::POSITION_ID_FIELD])) {
            $a['position_id'] = $this->intPositionId;
        }
        return $a;
    }



    

}



/////////////////////////////////////
// ADDITIONAL CLASSES for QCubed QUERY
/////////////////////////////////////

/**
 * @property-read Node\Column $Id
 * @property-read Node\Column $TrackId
 * @property-read NodeTrack $Track
 * @property-read Node\Column $PositionId
 * @property-read NodePosition $Position
 * @property-read Node\Column $_PrimaryKeyNode
 **/
class NodeTrackPoint extends Node\Table {
    protected $strTableName = 'track_point';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'TrackPoint';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "track_id",
            "position_id",
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
            case 'TrackId':
                return new Node\Column('track_id', 'TrackId', 'Integer', $this);
            case 'Track':
                return new NodeTrack('track_id', 'Track', 'Integer', $this);
            case 'PositionId':
                return new Node\Column('position_id', 'PositionId', 'Integer', $this);
            case 'Position':
                return new NodePosition('position_id', 'Position', 'Integer', $this);

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
 * @property-read Node\Column $TrackId
 * @property-read NodeTrack $Track
 * @property-read Node\Column $PositionId
 * @property-read NodePosition $Position

 * @property-read Node\Column $_PrimaryKeyNode
 **/
class ReverseReferenceNodeTrackPoint extends Node\ReverseReference {
    protected $strTableName = 'track_point';
    protected $strPrimaryKey = 'id';
    protected $strClassName = 'TrackPoint';

    /**
    * @return array
    */
    public function fields() {
        return [
            "id",
            "track_id",
            "position_id",
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
            case 'TrackId':
                return new Node\Column('track_id', 'TrackId', 'Integer', $this);
            case 'Track':
                return new NodeTrack('track_id', 'Track', 'Integer', $this);
            case 'PositionId':
                return new Node\Column('position_id', 'PositionId', 'Integer', $this);
            case 'Position':
                return new NodePosition('position_id', 'Position', 'Integer', $this);

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
