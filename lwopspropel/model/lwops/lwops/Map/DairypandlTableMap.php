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
use lwops\lwops\Dairypandl;
use lwops\lwops\DairypandlQuery;


/**
 * This class defines the structure of the 'dairypandl' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class DairypandlTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.DairypandlTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'dairypandl';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Dairypandl';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Dairypandl';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'dairypandl.oid';

    /**
     * the column name for the lineOfBusinessOid field
     */
    const COL_LINEOFBUSINESSOID = 'dairypandl.lineOfBusinessOid';

    /**
     * the column name for the opsMonthlyCalendarOid field
     */
    const COL_OPSMONTHLYCALENDAROID = 'dairypandl.opsMonthlyCalendarOid';

    /**
     * the column name for the purchases field
     */
    const COL_PURCHASES = 'dairypandl.purchases';

    /**
     * the column name for the otherPurchases field
     */
    const COL_OTHERPURCHASES = 'dairypandl.otherPurchases';

    /**
     * the column name for the cooperativeDeductions field
     */
    const COL_COOPERATIVEDEDUCTIONS = 'dairypandl.cooperativeDeductions';

    /**
     * the column name for the labourParttimeExpense field
     */
    const COL_LABOURPARTTIMEEXPENSE = 'dairypandl.labourParttimeExpense';

    /**
     * the column name for the generalExpenses field
     */
    const COL_GENERALEXPENSES = 'dairypandl.generalExpenses';

    /**
     * the column name for the elecExpenses field
     */
    const COL_ELECEXPENSES = 'dairypandl.elecExpenses';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'dairypandl.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'dairypandl.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Lineofbusinessoid', 'Opsmonthlycalendaroid', 'Purchases', 'Otherpurchases', 'Cooperativedeductions', 'Labourparttimeexpense', 'Generalexpenses', 'Elecexpenses', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'lineofbusinessoid', 'opsmonthlycalendaroid', 'purchases', 'otherpurchases', 'cooperativedeductions', 'labourparttimeexpense', 'generalexpenses', 'elecexpenses', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(DairypandlTableMap::COL_OID, DairypandlTableMap::COL_LINEOFBUSINESSOID, DairypandlTableMap::COL_OPSMONTHLYCALENDAROID, DairypandlTableMap::COL_PURCHASES, DairypandlTableMap::COL_OTHERPURCHASES, DairypandlTableMap::COL_COOPERATIVEDEDUCTIONS, DairypandlTableMap::COL_LABOURPARTTIMEEXPENSE, DairypandlTableMap::COL_GENERALEXPENSES, DairypandlTableMap::COL_ELECEXPENSES, DairypandlTableMap::COL_CREATETMSTP, DairypandlTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'lineOfBusinessOid', 'opsMonthlyCalendarOid', 'purchases', 'otherPurchases', 'cooperativeDeductions', 'labourParttimeExpense', 'generalExpenses', 'elecExpenses', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Lineofbusinessoid' => 1, 'Opsmonthlycalendaroid' => 2, 'Purchases' => 3, 'Otherpurchases' => 4, 'Cooperativedeductions' => 5, 'Labourparttimeexpense' => 6, 'Generalexpenses' => 7, 'Elecexpenses' => 8, 'Createtmstp' => 9, 'Updttmstp' => 10, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'lineofbusinessoid' => 1, 'opsmonthlycalendaroid' => 2, 'purchases' => 3, 'otherpurchases' => 4, 'cooperativedeductions' => 5, 'labourparttimeexpense' => 6, 'generalexpenses' => 7, 'elecexpenses' => 8, 'createtmstp' => 9, 'updttmstp' => 10, ),
        self::TYPE_COLNAME       => array(DairypandlTableMap::COL_OID => 0, DairypandlTableMap::COL_LINEOFBUSINESSOID => 1, DairypandlTableMap::COL_OPSMONTHLYCALENDAROID => 2, DairypandlTableMap::COL_PURCHASES => 3, DairypandlTableMap::COL_OTHERPURCHASES => 4, DairypandlTableMap::COL_COOPERATIVEDEDUCTIONS => 5, DairypandlTableMap::COL_LABOURPARTTIMEEXPENSE => 6, DairypandlTableMap::COL_GENERALEXPENSES => 7, DairypandlTableMap::COL_ELECEXPENSES => 8, DairypandlTableMap::COL_CREATETMSTP => 9, DairypandlTableMap::COL_UPDTTMSTP => 10, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'lineOfBusinessOid' => 1, 'opsMonthlyCalendarOid' => 2, 'purchases' => 3, 'otherPurchases' => 4, 'cooperativeDeductions' => 5, 'labourParttimeExpense' => 6, 'generalExpenses' => 7, 'elecExpenses' => 8, 'createTmstp' => 9, 'updtTmstp' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
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
        $this->setName('dairypandl');
        $this->setPhpName('Dairypandl');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Dairypandl');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addForeignKey('lineOfBusinessOid', 'Lineofbusinessoid', 'INTEGER', 'lineofbusiness', 'oid', true, null, null);
        $this->addForeignKey('opsMonthlyCalendarOid', 'Opsmonthlycalendaroid', 'INTEGER', 'opsmonthlycalendar', 'oid', true, null, null);
        $this->addColumn('purchases', 'Purchases', 'FLOAT', true, null, 0);
        $this->addColumn('otherPurchases', 'Otherpurchases', 'FLOAT', true, null, 0);
        $this->addColumn('cooperativeDeductions', 'Cooperativedeductions', 'FLOAT', true, null, 0);
        $this->addColumn('labourParttimeExpense', 'Labourparttimeexpense', 'FLOAT', true, null, 0);
        $this->addColumn('generalExpenses', 'Generalexpenses', 'FLOAT', true, null, 0);
        $this->addColumn('elecExpenses', 'Elecexpenses', 'FLOAT', true, null, 0);
        $this->addColumn('createTmstp', 'Createtmstp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updtTmstp', 'Updttmstp', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Lineofbusiness', '\\lwops\\lwops\\Lineofbusiness', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':lineOfBusinessOid',
    1 => ':oid',
  ),
), null, null, null, false);
        $this->addRelation('Opsmonthlycalendar', '\\lwops\\lwops\\Opsmonthlycalendar', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':opsMonthlyCalendarOid',
    1 => ':oid',
  ),
), null, null, null, false);
        $this->addRelation('Dairypandllabourexpensedetail', '\\lwops\\lwops\\Dairypandllabourexpensedetail', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':DairyPandLOid',
    1 => ':oid',
  ),
), null, null, 'Dairypandllabourexpensedetails', false);
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
        return $withPrefix ? DairypandlTableMap::CLASS_DEFAULT : DairypandlTableMap::OM_CLASS;
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
     * @return array           (Dairypandl object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = DairypandlTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DairypandlTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DairypandlTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DairypandlTableMap::OM_CLASS;
            /** @var Dairypandl $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DairypandlTableMap::addInstanceToPool($obj, $key);
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
            $key = DairypandlTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DairypandlTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Dairypandl $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DairypandlTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DairypandlTableMap::COL_OID);
            $criteria->addSelectColumn(DairypandlTableMap::COL_LINEOFBUSINESSOID);
            $criteria->addSelectColumn(DairypandlTableMap::COL_OPSMONTHLYCALENDAROID);
            $criteria->addSelectColumn(DairypandlTableMap::COL_PURCHASES);
            $criteria->addSelectColumn(DairypandlTableMap::COL_OTHERPURCHASES);
            $criteria->addSelectColumn(DairypandlTableMap::COL_COOPERATIVEDEDUCTIONS);
            $criteria->addSelectColumn(DairypandlTableMap::COL_LABOURPARTTIMEEXPENSE);
            $criteria->addSelectColumn(DairypandlTableMap::COL_GENERALEXPENSES);
            $criteria->addSelectColumn(DairypandlTableMap::COL_ELECEXPENSES);
            $criteria->addSelectColumn(DairypandlTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(DairypandlTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.lineOfBusinessOid');
            $criteria->addSelectColumn($alias . '.opsMonthlyCalendarOid');
            $criteria->addSelectColumn($alias . '.purchases');
            $criteria->addSelectColumn($alias . '.otherPurchases');
            $criteria->addSelectColumn($alias . '.cooperativeDeductions');
            $criteria->addSelectColumn($alias . '.labourParttimeExpense');
            $criteria->addSelectColumn($alias . '.generalExpenses');
            $criteria->addSelectColumn($alias . '.elecExpenses');
            $criteria->addSelectColumn($alias . '.createTmstp');
            $criteria->addSelectColumn($alias . '.updtTmstp');
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
        return Propel::getServiceContainer()->getDatabaseMap(DairypandlTableMap::DATABASE_NAME)->getTable(DairypandlTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(DairypandlTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(DairypandlTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new DairypandlTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Dairypandl or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Dairypandl object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DairypandlTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Dairypandl) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DairypandlTableMap::DATABASE_NAME);
            $criteria->add(DairypandlTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = DairypandlQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DairypandlTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DairypandlTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the dairypandl table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return DairypandlQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Dairypandl or Criteria object.
     *
     * @param mixed               $criteria Criteria or Dairypandl object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DairypandlTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Dairypandl object
        }

        if ($criteria->containsKey(DairypandlTableMap::COL_OID) && $criteria->keyContainsValue(DairypandlTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DairypandlTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = DairypandlQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // DairypandlTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
DairypandlTableMap::buildTableMap();
