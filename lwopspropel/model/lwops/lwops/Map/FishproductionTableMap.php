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
use lwops\lwops\Fishproduction;
use lwops\lwops\FishproductionQuery;


/**
 * This class defines the structure of the 'fishproduction' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FishproductionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.FishproductionTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'fishproduction';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Fishproduction';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Fishproduction';

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
    const COL_OID = 'fishproduction.oid';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'fishproduction.type';

    /**
     * the column name for the harvestDt field
     */
    const COL_HARVESTDT = 'fishproduction.harvestDt';

    /**
     * the column name for the pondNbr field
     */
    const COL_PONDNBR = 'fishproduction.pondNbr';

    /**
     * the column name for the weight field
     */
    const COL_WEIGHT = 'fishproduction.weight';

    /**
     * the column name for the count field
     */
    const COL_COUNT = 'fishproduction.count';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'fishproduction.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'fishproduction.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Type', 'Harvestdt', 'Pondnbr', 'Weight', 'Count', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'type', 'harvestdt', 'pondnbr', 'weight', 'count', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(FishproductionTableMap::COL_OID, FishproductionTableMap::COL_TYPE, FishproductionTableMap::COL_HARVESTDT, FishproductionTableMap::COL_PONDNBR, FishproductionTableMap::COL_WEIGHT, FishproductionTableMap::COL_COUNT, FishproductionTableMap::COL_CREATETMSTP, FishproductionTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'type', 'harvestDt', 'pondNbr', 'weight', 'count', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Type' => 1, 'Harvestdt' => 2, 'Pondnbr' => 3, 'Weight' => 4, 'Count' => 5, 'Createtmstp' => 6, 'Updttmstp' => 7, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'type' => 1, 'harvestdt' => 2, 'pondnbr' => 3, 'weight' => 4, 'count' => 5, 'createtmstp' => 6, 'updttmstp' => 7, ),
        self::TYPE_COLNAME       => array(FishproductionTableMap::COL_OID => 0, FishproductionTableMap::COL_TYPE => 1, FishproductionTableMap::COL_HARVESTDT => 2, FishproductionTableMap::COL_PONDNBR => 3, FishproductionTableMap::COL_WEIGHT => 4, FishproductionTableMap::COL_COUNT => 5, FishproductionTableMap::COL_CREATETMSTP => 6, FishproductionTableMap::COL_UPDTTMSTP => 7, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'type' => 1, 'harvestDt' => 2, 'pondNbr' => 3, 'weight' => 4, 'count' => 5, 'createTmstp' => 6, 'updtTmstp' => 7, ),
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
        $this->setName('fishproduction');
        $this->setPhpName('Fishproduction');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Fishproduction');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addForeignKey('type', 'Type', 'VARCHAR', 'fishtype', 'fishType', true, 15, null);
        $this->addColumn('harvestDt', 'Harvestdt', 'TIMESTAMP', true, null, null);
        $this->addColumn('pondNbr', 'Pondnbr', 'INTEGER', true, 1, null);
        $this->addColumn('weight', 'Weight', 'FLOAT', true, null, null);
        $this->addColumn('count', 'Count', 'INTEGER', true, null, null);
        $this->addColumn('createTmstp', 'Createtmstp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updtTmstp', 'Updttmstp', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
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
        return $withPrefix ? FishproductionTableMap::CLASS_DEFAULT : FishproductionTableMap::OM_CLASS;
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
     * @return array           (Fishproduction object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FishproductionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FishproductionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FishproductionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FishproductionTableMap::OM_CLASS;
            /** @var Fishproduction $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FishproductionTableMap::addInstanceToPool($obj, $key);
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
            $key = FishproductionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FishproductionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Fishproduction $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FishproductionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FishproductionTableMap::COL_OID);
            $criteria->addSelectColumn(FishproductionTableMap::COL_TYPE);
            $criteria->addSelectColumn(FishproductionTableMap::COL_HARVESTDT);
            $criteria->addSelectColumn(FishproductionTableMap::COL_PONDNBR);
            $criteria->addSelectColumn(FishproductionTableMap::COL_WEIGHT);
            $criteria->addSelectColumn(FishproductionTableMap::COL_COUNT);
            $criteria->addSelectColumn(FishproductionTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(FishproductionTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.harvestDt');
            $criteria->addSelectColumn($alias . '.pondNbr');
            $criteria->addSelectColumn($alias . '.weight');
            $criteria->addSelectColumn($alias . '.count');
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
        return Propel::getServiceContainer()->getDatabaseMap(FishproductionTableMap::DATABASE_NAME)->getTable(FishproductionTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FishproductionTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FishproductionTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FishproductionTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Fishproduction or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Fishproduction object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FishproductionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Fishproduction) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FishproductionTableMap::DATABASE_NAME);
            $criteria->add(FishproductionTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = FishproductionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FishproductionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FishproductionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the fishproduction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FishproductionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Fishproduction or Criteria object.
     *
     * @param mixed               $criteria Criteria or Fishproduction object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FishproductionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Fishproduction object
        }

        if ($criteria->containsKey(FishproductionTableMap::COL_OID) && $criteria->keyContainsValue(FishproductionTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FishproductionTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = FishproductionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FishproductionTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FishproductionTableMap::buildTableMap();