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
use lwops\lwops\Horticultureproducedetail;
use lwops\lwops\HorticultureproducedetailQuery;


/**
 * This class defines the structure of the 'horticultureproducedetail' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class HorticultureproducedetailTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.HorticultureproducedetailTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'horticultureproducedetail';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Horticultureproducedetail';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Horticultureproducedetail';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'horticultureproducedetail.oid';

    /**
     * the column name for the horticultureProduceParentoid field
     */
    const COL_HORTICULTUREPRODUCEPARENTOID = 'horticultureproducedetail.horticultureProduceParentoid';

    /**
     * the column name for the brand field
     */
    const COL_BRAND = 'horticultureproducedetail.brand';

    /**
     * the column name for the variety field
     */
    const COL_VARIETY = 'horticultureproducedetail.variety';

    /**
     * the column name for the directPlanting field
     */
    const COL_DIRECTPLANTING = 'horticultureproducedetail.directPlanting';

    /**
     * the column name for the nurseryDuration field
     */
    const COL_NURSERYDURATION = 'horticultureproducedetail.nurseryDuration';

    /**
     * the column name for the avgMaturityDays field
     */
    const COL_AVGMATURITYDAYS = 'horticultureproducedetail.avgMaturityDays';

    /**
     * the column name for the harvestDurationDays field
     */
    const COL_HARVESTDURATIONDAYS = 'horticultureproducedetail.harvestDurationDays';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'horticultureproducedetail.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'horticultureproducedetail.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Horticultureproduceparentoid', 'Brand', 'Variety', 'Directplanting', 'Nurseryduration', 'Avgmaturitydays', 'Harvestdurationdays', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'horticultureproduceparentoid', 'brand', 'variety', 'directplanting', 'nurseryduration', 'avgmaturitydays', 'harvestdurationdays', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(HorticultureproducedetailTableMap::COL_OID, HorticultureproducedetailTableMap::COL_HORTICULTUREPRODUCEPARENTOID, HorticultureproducedetailTableMap::COL_BRAND, HorticultureproducedetailTableMap::COL_VARIETY, HorticultureproducedetailTableMap::COL_DIRECTPLANTING, HorticultureproducedetailTableMap::COL_NURSERYDURATION, HorticultureproducedetailTableMap::COL_AVGMATURITYDAYS, HorticultureproducedetailTableMap::COL_HARVESTDURATIONDAYS, HorticultureproducedetailTableMap::COL_CREATETMSTP, HorticultureproducedetailTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'horticultureProduceParentoid', 'brand', 'variety', 'directPlanting', 'nurseryDuration', 'avgMaturityDays', 'harvestDurationDays', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Horticultureproduceparentoid' => 1, 'Brand' => 2, 'Variety' => 3, 'Directplanting' => 4, 'Nurseryduration' => 5, 'Avgmaturitydays' => 6, 'Harvestdurationdays' => 7, 'Createtmstp' => 8, 'Updttmstp' => 9, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'horticultureproduceparentoid' => 1, 'brand' => 2, 'variety' => 3, 'directplanting' => 4, 'nurseryduration' => 5, 'avgmaturitydays' => 6, 'harvestdurationdays' => 7, 'createtmstp' => 8, 'updttmstp' => 9, ),
        self::TYPE_COLNAME       => array(HorticultureproducedetailTableMap::COL_OID => 0, HorticultureproducedetailTableMap::COL_HORTICULTUREPRODUCEPARENTOID => 1, HorticultureproducedetailTableMap::COL_BRAND => 2, HorticultureproducedetailTableMap::COL_VARIETY => 3, HorticultureproducedetailTableMap::COL_DIRECTPLANTING => 4, HorticultureproducedetailTableMap::COL_NURSERYDURATION => 5, HorticultureproducedetailTableMap::COL_AVGMATURITYDAYS => 6, HorticultureproducedetailTableMap::COL_HARVESTDURATIONDAYS => 7, HorticultureproducedetailTableMap::COL_CREATETMSTP => 8, HorticultureproducedetailTableMap::COL_UPDTTMSTP => 9, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'horticultureProduceParentoid' => 1, 'brand' => 2, 'variety' => 3, 'directPlanting' => 4, 'nurseryDuration' => 5, 'avgMaturityDays' => 6, 'harvestDurationDays' => 7, 'createTmstp' => 8, 'updtTmstp' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('horticultureproducedetail');
        $this->setPhpName('Horticultureproducedetail');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Horticultureproducedetail');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addForeignKey('horticultureProduceParentoid', 'Horticultureproduceparentoid', 'INTEGER', 'horticultureproduceparent', 'oid', true, null, null);
        $this->addForeignKey('brand', 'Brand', 'VARCHAR', 'horticultureproducebrand', 'name', true, 20, null);
        $this->addColumn('variety', 'Variety', 'VARCHAR', true, 45, null);
        $this->addColumn('directPlanting', 'Directplanting', 'INTEGER', true, 1, 0);
        $this->addColumn('nurseryDuration', 'Nurseryduration', 'INTEGER', true, 3, null);
        $this->addColumn('avgMaturityDays', 'Avgmaturitydays', 'INTEGER', true, 3, null);
        $this->addColumn('harvestDurationDays', 'Harvestdurationdays', 'INTEGER', true, 3, null);
        $this->addColumn('createTmstp', 'Createtmstp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updtTmstp', 'Updttmstp', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Horticultureproduceparent', '\\lwops\\lwops\\Horticultureproduceparent', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':horticultureProduceParentoid',
    1 => ':oid',
  ),
), null, null, null, false);
        $this->addRelation('Horticultureproducebrand', '\\lwops\\lwops\\Horticultureproducebrand', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand',
    1 => ':name',
  ),
), null, null, null, false);
        $this->addRelation('Horticultureproducebed', '\\lwops\\lwops\\Horticultureproducebed', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':produceTypeOid',
    1 => ':oid',
  ),
), null, null, 'Horticultureproducebeds', false);
        $this->addRelation('Horticultureproducestock', '\\lwops\\lwops\\Horticultureproducestock', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':produceTypeOid',
    1 => ':oid',
  ),
), null, null, 'Horticultureproducestocks', false);
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
        return $withPrefix ? HorticultureproducedetailTableMap::CLASS_DEFAULT : HorticultureproducedetailTableMap::OM_CLASS;
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
     * @return array           (Horticultureproducedetail object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = HorticultureproducedetailTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = HorticultureproducedetailTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + HorticultureproducedetailTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = HorticultureproducedetailTableMap::OM_CLASS;
            /** @var Horticultureproducedetail $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            HorticultureproducedetailTableMap::addInstanceToPool($obj, $key);
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
            $key = HorticultureproducedetailTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = HorticultureproducedetailTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Horticultureproducedetail $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                HorticultureproducedetailTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(HorticultureproducedetailTableMap::COL_OID);
            $criteria->addSelectColumn(HorticultureproducedetailTableMap::COL_HORTICULTUREPRODUCEPARENTOID);
            $criteria->addSelectColumn(HorticultureproducedetailTableMap::COL_BRAND);
            $criteria->addSelectColumn(HorticultureproducedetailTableMap::COL_VARIETY);
            $criteria->addSelectColumn(HorticultureproducedetailTableMap::COL_DIRECTPLANTING);
            $criteria->addSelectColumn(HorticultureproducedetailTableMap::COL_NURSERYDURATION);
            $criteria->addSelectColumn(HorticultureproducedetailTableMap::COL_AVGMATURITYDAYS);
            $criteria->addSelectColumn(HorticultureproducedetailTableMap::COL_HARVESTDURATIONDAYS);
            $criteria->addSelectColumn(HorticultureproducedetailTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(HorticultureproducedetailTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.horticultureProduceParentoid');
            $criteria->addSelectColumn($alias . '.brand');
            $criteria->addSelectColumn($alias . '.variety');
            $criteria->addSelectColumn($alias . '.directPlanting');
            $criteria->addSelectColumn($alias . '.nurseryDuration');
            $criteria->addSelectColumn($alias . '.avgMaturityDays');
            $criteria->addSelectColumn($alias . '.harvestDurationDays');
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
        return Propel::getServiceContainer()->getDatabaseMap(HorticultureproducedetailTableMap::DATABASE_NAME)->getTable(HorticultureproducedetailTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(HorticultureproducedetailTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(HorticultureproducedetailTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new HorticultureproducedetailTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Horticultureproducedetail or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Horticultureproducedetail object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducedetailTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Horticultureproducedetail) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(HorticultureproducedetailTableMap::DATABASE_NAME);
            $criteria->add(HorticultureproducedetailTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = HorticultureproducedetailQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            HorticultureproducedetailTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                HorticultureproducedetailTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the horticultureproducedetail table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return HorticultureproducedetailQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Horticultureproducedetail or Criteria object.
     *
     * @param mixed               $criteria Criteria or Horticultureproducedetail object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducedetailTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Horticultureproducedetail object
        }

        if ($criteria->containsKey(HorticultureproducedetailTableMap::COL_OID) && $criteria->keyContainsValue(HorticultureproducedetailTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.HorticultureproducedetailTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = HorticultureproducedetailQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // HorticultureproducedetailTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
HorticultureproducedetailTableMap::buildTableMap();
