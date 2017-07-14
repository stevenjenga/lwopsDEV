<?php

namespace lwops\lwops\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use lwops\lwops\Opstimedimension;
use lwops\lwops\OpstimedimensionQuery;


/**
 * This class defines the structure of the 'opstimedimension' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class OpstimedimensionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.OpstimedimensionTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'opstimedimension';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Opstimedimension';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Opstimedimension';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'opstimedimension.oid';

    /**
     * the column name for the db_date field
     */
    const COL_DB_DATE = 'opstimedimension.db_date';

    /**
     * the column name for the year field
     */
    const COL_YEAR = 'opstimedimension.year';

    /**
     * the column name for the month field
     */
    const COL_MONTH = 'opstimedimension.month';

    /**
     * the column name for the day field
     */
    const COL_DAY = 'opstimedimension.day';

    /**
     * the column name for the quarter field
     */
    const COL_QUARTER = 'opstimedimension.quarter';

    /**
     * the column name for the week field
     */
    const COL_WEEK = 'opstimedimension.week';

    /**
     * the column name for the day_name field
     */
    const COL_DAY_NAME = 'opstimedimension.day_name';

    /**
     * the column name for the month_name field
     */
    const COL_MONTH_NAME = 'opstimedimension.month_name';

    /**
     * the column name for the holiday_flag field
     */
    const COL_HOLIDAY_FLAG = 'opstimedimension.holiday_flag';

    /**
     * the column name for the weekend_flag field
     */
    const COL_WEEKEND_FLAG = 'opstimedimension.weekend_flag';

    /**
     * the column name for the event field
     */
    const COL_EVENT = 'opstimedimension.event';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Oid', 'DbDate', 'Year', 'Month', 'Day', 'Quarter', 'Week', 'DayName', 'MonthName', 'HolidayFlag', 'WeekendFlag', 'Event', ),
        self::TYPE_CAMELNAME     => array('oid', 'dbDate', 'year', 'month', 'day', 'quarter', 'week', 'dayName', 'monthName', 'holidayFlag', 'weekendFlag', 'event', ),
        self::TYPE_COLNAME       => array(OpstimedimensionTableMap::COL_OID, OpstimedimensionTableMap::COL_DB_DATE, OpstimedimensionTableMap::COL_YEAR, OpstimedimensionTableMap::COL_MONTH, OpstimedimensionTableMap::COL_DAY, OpstimedimensionTableMap::COL_QUARTER, OpstimedimensionTableMap::COL_WEEK, OpstimedimensionTableMap::COL_DAY_NAME, OpstimedimensionTableMap::COL_MONTH_NAME, OpstimedimensionTableMap::COL_HOLIDAY_FLAG, OpstimedimensionTableMap::COL_WEEKEND_FLAG, OpstimedimensionTableMap::COL_EVENT, ),
        self::TYPE_FIELDNAME     => array('oid', 'db_date', 'year', 'month', 'day', 'quarter', 'week', 'day_name', 'month_name', 'holiday_flag', 'weekend_flag', 'event', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'DbDate' => 1, 'Year' => 2, 'Month' => 3, 'Day' => 4, 'Quarter' => 5, 'Week' => 6, 'DayName' => 7, 'MonthName' => 8, 'HolidayFlag' => 9, 'WeekendFlag' => 10, 'Event' => 11, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'dbDate' => 1, 'year' => 2, 'month' => 3, 'day' => 4, 'quarter' => 5, 'week' => 6, 'dayName' => 7, 'monthName' => 8, 'holidayFlag' => 9, 'weekendFlag' => 10, 'event' => 11, ),
        self::TYPE_COLNAME       => array(OpstimedimensionTableMap::COL_OID => 0, OpstimedimensionTableMap::COL_DB_DATE => 1, OpstimedimensionTableMap::COL_YEAR => 2, OpstimedimensionTableMap::COL_MONTH => 3, OpstimedimensionTableMap::COL_DAY => 4, OpstimedimensionTableMap::COL_QUARTER => 5, OpstimedimensionTableMap::COL_WEEK => 6, OpstimedimensionTableMap::COL_DAY_NAME => 7, OpstimedimensionTableMap::COL_MONTH_NAME => 8, OpstimedimensionTableMap::COL_HOLIDAY_FLAG => 9, OpstimedimensionTableMap::COL_WEEKEND_FLAG => 10, OpstimedimensionTableMap::COL_EVENT => 11, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'db_date' => 1, 'year' => 2, 'month' => 3, 'day' => 4, 'quarter' => 5, 'week' => 6, 'day_name' => 7, 'month_name' => 8, 'holiday_flag' => 9, 'weekend_flag' => 10, 'event' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('opstimedimension');
        $this->setPhpName('Opstimedimension');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Opstimedimension');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addColumn('db_date', 'DbDate', 'DATE', true, null, null);
        $this->addColumn('year', 'Year', 'INTEGER', true, null, null);
        $this->addColumn('month', 'Month', 'INTEGER', true, null, null);
        $this->addColumn('day', 'Day', 'INTEGER', true, null, null);
        $this->addColumn('quarter', 'Quarter', 'INTEGER', true, null, null);
        $this->addColumn('week', 'Week', 'INTEGER', true, null, null);
        $this->addColumn('day_name', 'DayName', 'VARCHAR', true, 9, null);
        $this->addColumn('month_name', 'MonthName', 'VARCHAR', true, 9, null);
        $this->addColumn('holiday_flag', 'HolidayFlag', 'CHAR', false, null, '0');
        $this->addColumn('weekend_flag', 'WeekendFlag', 'CHAR', false, null, '0');
        $this->addColumn('event', 'Event', 'VARCHAR', false, 50, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? OpstimedimensionTableMap::CLASS_DEFAULT : OpstimedimensionTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Opstimedimension object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = OpstimedimensionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OpstimedimensionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OpstimedimensionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OpstimedimensionTableMap::OM_CLASS;
            /** @var Opstimedimension $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OpstimedimensionTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = OpstimedimensionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OpstimedimensionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Opstimedimension $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OpstimedimensionTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(OpstimedimensionTableMap::COL_OID);
            $criteria->addSelectColumn(OpstimedimensionTableMap::COL_DB_DATE);
            $criteria->addSelectColumn(OpstimedimensionTableMap::COL_YEAR);
            $criteria->addSelectColumn(OpstimedimensionTableMap::COL_MONTH);
            $criteria->addSelectColumn(OpstimedimensionTableMap::COL_DAY);
            $criteria->addSelectColumn(OpstimedimensionTableMap::COL_QUARTER);
            $criteria->addSelectColumn(OpstimedimensionTableMap::COL_WEEK);
            $criteria->addSelectColumn(OpstimedimensionTableMap::COL_DAY_NAME);
            $criteria->addSelectColumn(OpstimedimensionTableMap::COL_MONTH_NAME);
            $criteria->addSelectColumn(OpstimedimensionTableMap::COL_HOLIDAY_FLAG);
            $criteria->addSelectColumn(OpstimedimensionTableMap::COL_WEEKEND_FLAG);
            $criteria->addSelectColumn(OpstimedimensionTableMap::COL_EVENT);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.db_date');
            $criteria->addSelectColumn($alias . '.year');
            $criteria->addSelectColumn($alias . '.month');
            $criteria->addSelectColumn($alias . '.day');
            $criteria->addSelectColumn($alias . '.quarter');
            $criteria->addSelectColumn($alias . '.week');
            $criteria->addSelectColumn($alias . '.day_name');
            $criteria->addSelectColumn($alias . '.month_name');
            $criteria->addSelectColumn($alias . '.holiday_flag');
            $criteria->addSelectColumn($alias . '.weekend_flag');
            $criteria->addSelectColumn($alias . '.event');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(OpstimedimensionTableMap::DATABASE_NAME)->getTable(OpstimedimensionTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(OpstimedimensionTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(OpstimedimensionTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new OpstimedimensionTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Opstimedimension or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Opstimedimension object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OpstimedimensionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Opstimedimension) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OpstimedimensionTableMap::DATABASE_NAME);
            $criteria->add(OpstimedimensionTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = OpstimedimensionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OpstimedimensionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OpstimedimensionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the opstimedimension table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return OpstimedimensionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Opstimedimension or Criteria object.
     *
     * @param mixed               $criteria Criteria or Opstimedimension object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OpstimedimensionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Opstimedimension object
        }

        if ($criteria->containsKey(OpstimedimensionTableMap::COL_OID) && $criteria->keyContainsValue(OpstimedimensionTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OpstimedimensionTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = OpstimedimensionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // OpstimedimensionTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
OpstimedimensionTableMap::buildTableMap();
