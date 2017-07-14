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
use lwops\lwops\Fishsales;
use lwops\lwops\FishsalesQuery;


/**
 * This class defines the structure of the 'fishsales' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FishsalesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.FishsalesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'fishsales';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Fishsales';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Fishsales';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'fishsales.oid';

    /**
     * the column name for the salesDt field
     */
    const COL_SALESDT = 'fishsales.salesDt';

    /**
     * the column name for the customerOid field
     */
    const COL_CUSTOMEROID = 'fishsales.customerOid';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'fishsales.type';

    /**
     * the column name for the weight field
     */
    const COL_WEIGHT = 'fishsales.weight';

    /**
     * the column name for the pricePerKg field
     */
    const COL_PRICEPERKG = 'fishsales.pricePerKg';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'fishsales.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'fishsales.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Salesdt', 'Customeroid', 'Type', 'Weight', 'Priceperkg', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'salesdt', 'customeroid', 'type', 'weight', 'priceperkg', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(FishsalesTableMap::COL_OID, FishsalesTableMap::COL_SALESDT, FishsalesTableMap::COL_CUSTOMEROID, FishsalesTableMap::COL_TYPE, FishsalesTableMap::COL_WEIGHT, FishsalesTableMap::COL_PRICEPERKG, FishsalesTableMap::COL_CREATETMSTP, FishsalesTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'salesDt', 'customerOid', 'type', 'weight', 'pricePerKg', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Salesdt' => 1, 'Customeroid' => 2, 'Type' => 3, 'Weight' => 4, 'Priceperkg' => 5, 'Createtmstp' => 6, 'Updttmstp' => 7, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'salesdt' => 1, 'customeroid' => 2, 'type' => 3, 'weight' => 4, 'priceperkg' => 5, 'createtmstp' => 6, 'updttmstp' => 7, ),
        self::TYPE_COLNAME       => array(FishsalesTableMap::COL_OID => 0, FishsalesTableMap::COL_SALESDT => 1, FishsalesTableMap::COL_CUSTOMEROID => 2, FishsalesTableMap::COL_TYPE => 3, FishsalesTableMap::COL_WEIGHT => 4, FishsalesTableMap::COL_PRICEPERKG => 5, FishsalesTableMap::COL_CREATETMSTP => 6, FishsalesTableMap::COL_UPDTTMSTP => 7, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'salesDt' => 1, 'customerOid' => 2, 'type' => 3, 'weight' => 4, 'pricePerKg' => 5, 'createTmstp' => 6, 'updtTmstp' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('fishsales');
        $this->setPhpName('Fishsales');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Fishsales');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addColumn('salesDt', 'Salesdt', 'DATE', true, null, null);
        $this->addForeignKey('customerOid', 'Customeroid', 'INTEGER', 'customer', 'oid', true, null, null);
        $this->addForeignKey('type', 'Type', 'VARCHAR', 'fishtype', 'fishType', true, 15, null);
        $this->addColumn('weight', 'Weight', 'FLOAT', true, null, 0);
        $this->addColumn('pricePerKg', 'Priceperkg', 'FLOAT', true, null, 0);
        $this->addColumn('createTmstp', 'Createtmstp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updtTmstp', 'Updttmstp', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Customer', '\\lwops\\lwops\\Customer', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':customerOid',
    1 => ':oid',
  ),
), null, null, null, false);
        $this->addRelation('Fishtype', '\\lwops\\lwops\\Fishtype', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':type',
    1 => ':fishType',
  ),
), null, null, null, false);
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
        return $withPrefix ? FishsalesTableMap::CLASS_DEFAULT : FishsalesTableMap::OM_CLASS;
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
     * @return array           (Fishsales object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FishsalesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FishsalesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FishsalesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FishsalesTableMap::OM_CLASS;
            /** @var Fishsales $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FishsalesTableMap::addInstanceToPool($obj, $key);
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
            $key = FishsalesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FishsalesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Fishsales $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FishsalesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FishsalesTableMap::COL_OID);
            $criteria->addSelectColumn(FishsalesTableMap::COL_SALESDT);
            $criteria->addSelectColumn(FishsalesTableMap::COL_CUSTOMEROID);
            $criteria->addSelectColumn(FishsalesTableMap::COL_TYPE);
            $criteria->addSelectColumn(FishsalesTableMap::COL_WEIGHT);
            $criteria->addSelectColumn(FishsalesTableMap::COL_PRICEPERKG);
            $criteria->addSelectColumn(FishsalesTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(FishsalesTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.salesDt');
            $criteria->addSelectColumn($alias . '.customerOid');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.weight');
            $criteria->addSelectColumn($alias . '.pricePerKg');
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
        return Propel::getServiceContainer()->getDatabaseMap(FishsalesTableMap::DATABASE_NAME)->getTable(FishsalesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FishsalesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FishsalesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FishsalesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Fishsales or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Fishsales object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FishsalesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Fishsales) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FishsalesTableMap::DATABASE_NAME);
            $criteria->add(FishsalesTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = FishsalesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FishsalesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FishsalesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the fishsales table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FishsalesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Fishsales or Criteria object.
     *
     * @param mixed               $criteria Criteria or Fishsales object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FishsalesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Fishsales object
        }

        if ($criteria->containsKey(FishsalesTableMap::COL_OID) && $criteria->keyContainsValue(FishsalesTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FishsalesTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = FishsalesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FishsalesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FishsalesTableMap::buildTableMap();
