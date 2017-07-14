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
use lwops\lwops\Fishpandl;
use lwops\lwops\FishpandlQuery;


/**
 * This class defines the structure of the 'fishpandl' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FishpandlTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.FishpandlTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'fishpandl';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Fishpandl';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Fishpandl';

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
    const COL_OID = 'fishpandl.oid';

    /**
     * the column name for the lineOfBusinessOid field
     */
    const COL_LINEOFBUSINESSOID = 'fishpandl.lineOfBusinessOid';

    /**
     * the column name for the opsMonthlyCalendarOid field
     */
    const COL_OPSMONTHLYCALENDAROID = 'fishpandl.opsMonthlyCalendarOid';

    /**
     * the column name for the salesIncome field
     */
    const COL_SALESINCOME = 'fishpandl.salesIncome';

    /**
     * the column name for the otherIncome field
     */
    const COL_OTHERINCOME = 'fishpandl.otherIncome';

    /**
     * the column name for the purchases field
     */
    const COL_PURCHASES = 'fishpandl.purchases';

    /**
     * the column name for the otherPurchases field
     */
    const COL_OTHERPURCHASES = 'fishpandl.otherPurchases';

    /**
     * the column name for the labourParttimeExpense field
     */
    const COL_LABOURPARTTIMEEXPENSE = 'fishpandl.labourParttimeExpense';

    /**
     * the column name for the generalExpenses field
     */
    const COL_GENERALEXPENSES = 'fishpandl.generalExpenses';

    /**
     * the column name for the elecExpenses field
     */
    const COL_ELECEXPENSES = 'fishpandl.elecExpenses';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'fishpandl.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'fishpandl.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Lineofbusinessoid', 'Opsmonthlycalendaroid', 'Salesincome', 'Otherincome', 'Purchases', 'Otherpurchases', 'Labourparttimeexpense', 'Generalexpenses', 'Elecexpenses', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'lineofbusinessoid', 'opsmonthlycalendaroid', 'salesincome', 'otherincome', 'purchases', 'otherpurchases', 'labourparttimeexpense', 'generalexpenses', 'elecexpenses', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(FishpandlTableMap::COL_OID, FishpandlTableMap::COL_LINEOFBUSINESSOID, FishpandlTableMap::COL_OPSMONTHLYCALENDAROID, FishpandlTableMap::COL_SALESINCOME, FishpandlTableMap::COL_OTHERINCOME, FishpandlTableMap::COL_PURCHASES, FishpandlTableMap::COL_OTHERPURCHASES, FishpandlTableMap::COL_LABOURPARTTIMEEXPENSE, FishpandlTableMap::COL_GENERALEXPENSES, FishpandlTableMap::COL_ELECEXPENSES, FishpandlTableMap::COL_CREATETMSTP, FishpandlTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'lineOfBusinessOid', 'opsMonthlyCalendarOid', 'salesIncome', 'otherIncome', 'purchases', 'otherPurchases', 'labourParttimeExpense', 'generalExpenses', 'elecExpenses', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Lineofbusinessoid' => 1, 'Opsmonthlycalendaroid' => 2, 'Salesincome' => 3, 'Otherincome' => 4, 'Purchases' => 5, 'Otherpurchases' => 6, 'Labourparttimeexpense' => 7, 'Generalexpenses' => 8, 'Elecexpenses' => 9, 'Createtmstp' => 10, 'Updttmstp' => 11, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'lineofbusinessoid' => 1, 'opsmonthlycalendaroid' => 2, 'salesincome' => 3, 'otherincome' => 4, 'purchases' => 5, 'otherpurchases' => 6, 'labourparttimeexpense' => 7, 'generalexpenses' => 8, 'elecexpenses' => 9, 'createtmstp' => 10, 'updttmstp' => 11, ),
        self::TYPE_COLNAME       => array(FishpandlTableMap::COL_OID => 0, FishpandlTableMap::COL_LINEOFBUSINESSOID => 1, FishpandlTableMap::COL_OPSMONTHLYCALENDAROID => 2, FishpandlTableMap::COL_SALESINCOME => 3, FishpandlTableMap::COL_OTHERINCOME => 4, FishpandlTableMap::COL_PURCHASES => 5, FishpandlTableMap::COL_OTHERPURCHASES => 6, FishpandlTableMap::COL_LABOURPARTTIMEEXPENSE => 7, FishpandlTableMap::COL_GENERALEXPENSES => 8, FishpandlTableMap::COL_ELECEXPENSES => 9, FishpandlTableMap::COL_CREATETMSTP => 10, FishpandlTableMap::COL_UPDTTMSTP => 11, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'lineOfBusinessOid' => 1, 'opsMonthlyCalendarOid' => 2, 'salesIncome' => 3, 'otherIncome' => 4, 'purchases' => 5, 'otherPurchases' => 6, 'labourParttimeExpense' => 7, 'generalExpenses' => 8, 'elecExpenses' => 9, 'createTmstp' => 10, 'updtTmstp' => 11, ),
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
        $this->setName('fishpandl');
        $this->setPhpName('Fishpandl');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Fishpandl');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addForeignKey('lineOfBusinessOid', 'Lineofbusinessoid', 'INTEGER', 'lineofbusiness', 'oid', true, null, null);
        $this->addForeignKey('opsMonthlyCalendarOid', 'Opsmonthlycalendaroid', 'INTEGER', 'opsmonthlycalendar', 'oid', true, null, null);
        $this->addColumn('salesIncome', 'Salesincome', 'FLOAT', true, null, 0);
        $this->addColumn('otherIncome', 'Otherincome', 'FLOAT', true, null, 0);
        $this->addColumn('purchases', 'Purchases', 'FLOAT', true, null, 0);
        $this->addColumn('otherPurchases', 'Otherpurchases', 'FLOAT', true, null, 0);
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
        $this->addRelation('Fishpandllabourexpensedetail', '\\lwops\\lwops\\Fishpandllabourexpensedetail', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':FishPandLOid',
    1 => ':oid',
  ),
), null, null, 'Fishpandllabourexpensedetails', false);
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
        return $withPrefix ? FishpandlTableMap::CLASS_DEFAULT : FishpandlTableMap::OM_CLASS;
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
     * @return array           (Fishpandl object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FishpandlTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FishpandlTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FishpandlTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FishpandlTableMap::OM_CLASS;
            /** @var Fishpandl $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FishpandlTableMap::addInstanceToPool($obj, $key);
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
            $key = FishpandlTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FishpandlTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Fishpandl $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FishpandlTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FishpandlTableMap::COL_OID);
            $criteria->addSelectColumn(FishpandlTableMap::COL_LINEOFBUSINESSOID);
            $criteria->addSelectColumn(FishpandlTableMap::COL_OPSMONTHLYCALENDAROID);
            $criteria->addSelectColumn(FishpandlTableMap::COL_SALESINCOME);
            $criteria->addSelectColumn(FishpandlTableMap::COL_OTHERINCOME);
            $criteria->addSelectColumn(FishpandlTableMap::COL_PURCHASES);
            $criteria->addSelectColumn(FishpandlTableMap::COL_OTHERPURCHASES);
            $criteria->addSelectColumn(FishpandlTableMap::COL_LABOURPARTTIMEEXPENSE);
            $criteria->addSelectColumn(FishpandlTableMap::COL_GENERALEXPENSES);
            $criteria->addSelectColumn(FishpandlTableMap::COL_ELECEXPENSES);
            $criteria->addSelectColumn(FishpandlTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(FishpandlTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.lineOfBusinessOid');
            $criteria->addSelectColumn($alias . '.opsMonthlyCalendarOid');
            $criteria->addSelectColumn($alias . '.salesIncome');
            $criteria->addSelectColumn($alias . '.otherIncome');
            $criteria->addSelectColumn($alias . '.purchases');
            $criteria->addSelectColumn($alias . '.otherPurchases');
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
        return Propel::getServiceContainer()->getDatabaseMap(FishpandlTableMap::DATABASE_NAME)->getTable(FishpandlTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FishpandlTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FishpandlTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FishpandlTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Fishpandl or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Fishpandl object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FishpandlTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Fishpandl) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FishpandlTableMap::DATABASE_NAME);
            $criteria->add(FishpandlTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = FishpandlQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FishpandlTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FishpandlTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the fishpandl table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FishpandlQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Fishpandl or Criteria object.
     *
     * @param mixed               $criteria Criteria or Fishpandl object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FishpandlTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Fishpandl object
        }

        if ($criteria->containsKey(FishpandlTableMap::COL_OID) && $criteria->keyContainsValue(FishpandlTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FishpandlTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = FishpandlQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FishpandlTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FishpandlTableMap::buildTableMap();
