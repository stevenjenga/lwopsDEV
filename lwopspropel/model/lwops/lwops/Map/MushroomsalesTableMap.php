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
use lwops\lwops\Mushroomsales;
use lwops\lwops\MushroomsalesQuery;


/**
 * This class defines the structure of the 'mushroomsales' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class MushroomsalesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.MushroomsalesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'mushroomsales';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Mushroomsales';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Mushroomsales';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'mushroomsales.oid';

    /**
     * the column name for the customerOid field
     */
    const COL_CUSTOMEROID = 'mushroomsales.customerOid';

    /**
     * the column name for the salesDt field
     */
    const COL_SALESDT = 'mushroomsales.salesDt';

    /**
     * the column name for the weightSold field
     */
    const COL_WEIGHTSOLD = 'mushroomsales.weightSold';

    /**
     * the column name for the pricePerKg field
     */
    const COL_PRICEPERKG = 'mushroomsales.pricePerKg';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'mushroomsales.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'mushroomsales.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Customeroid', 'Salesdt', 'Weightsold', 'Priceperkg', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'customeroid', 'salesdt', 'weightsold', 'priceperkg', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(MushroomsalesTableMap::COL_OID, MushroomsalesTableMap::COL_CUSTOMEROID, MushroomsalesTableMap::COL_SALESDT, MushroomsalesTableMap::COL_WEIGHTSOLD, MushroomsalesTableMap::COL_PRICEPERKG, MushroomsalesTableMap::COL_CREATETMSTP, MushroomsalesTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'customerOid', 'salesDt', 'weightSold', 'pricePerKg', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Customeroid' => 1, 'Salesdt' => 2, 'Weightsold' => 3, 'Priceperkg' => 4, 'Createtmstp' => 5, 'Updttmstp' => 6, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'customeroid' => 1, 'salesdt' => 2, 'weightsold' => 3, 'priceperkg' => 4, 'createtmstp' => 5, 'updttmstp' => 6, ),
        self::TYPE_COLNAME       => array(MushroomsalesTableMap::COL_OID => 0, MushroomsalesTableMap::COL_CUSTOMEROID => 1, MushroomsalesTableMap::COL_SALESDT => 2, MushroomsalesTableMap::COL_WEIGHTSOLD => 3, MushroomsalesTableMap::COL_PRICEPERKG => 4, MushroomsalesTableMap::COL_CREATETMSTP => 5, MushroomsalesTableMap::COL_UPDTTMSTP => 6, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'customerOid' => 1, 'salesDt' => 2, 'weightSold' => 3, 'pricePerKg' => 4, 'createTmstp' => 5, 'updtTmstp' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
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
        $this->setName('mushroomsales');
        $this->setPhpName('Mushroomsales');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Mushroomsales');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addForeignKey('customerOid', 'Customeroid', 'INTEGER', 'customer', 'oid', true, null, null);
        $this->addColumn('salesDt', 'Salesdt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('weightSold', 'Weightsold', 'FLOAT', true, null, 0);
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
        return $withPrefix ? MushroomsalesTableMap::CLASS_DEFAULT : MushroomsalesTableMap::OM_CLASS;
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
     * @return array           (Mushroomsales object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = MushroomsalesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MushroomsalesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MushroomsalesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MushroomsalesTableMap::OM_CLASS;
            /** @var Mushroomsales $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MushroomsalesTableMap::addInstanceToPool($obj, $key);
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
            $key = MushroomsalesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MushroomsalesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Mushroomsales $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MushroomsalesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MushroomsalesTableMap::COL_OID);
            $criteria->addSelectColumn(MushroomsalesTableMap::COL_CUSTOMEROID);
            $criteria->addSelectColumn(MushroomsalesTableMap::COL_SALESDT);
            $criteria->addSelectColumn(MushroomsalesTableMap::COL_WEIGHTSOLD);
            $criteria->addSelectColumn(MushroomsalesTableMap::COL_PRICEPERKG);
            $criteria->addSelectColumn(MushroomsalesTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(MushroomsalesTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.customerOid');
            $criteria->addSelectColumn($alias . '.salesDt');
            $criteria->addSelectColumn($alias . '.weightSold');
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
        return Propel::getServiceContainer()->getDatabaseMap(MushroomsalesTableMap::DATABASE_NAME)->getTable(MushroomsalesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(MushroomsalesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(MushroomsalesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new MushroomsalesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Mushroomsales or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Mushroomsales object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MushroomsalesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Mushroomsales) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MushroomsalesTableMap::DATABASE_NAME);
            $criteria->add(MushroomsalesTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = MushroomsalesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MushroomsalesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MushroomsalesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the mushroomsales table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return MushroomsalesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Mushroomsales or Criteria object.
     *
     * @param mixed               $criteria Criteria or Mushroomsales object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MushroomsalesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Mushroomsales object
        }

        if ($criteria->containsKey(MushroomsalesTableMap::COL_OID) && $criteria->keyContainsValue(MushroomsalesTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MushroomsalesTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = MushroomsalesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // MushroomsalesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
MushroomsalesTableMap::buildTableMap();
