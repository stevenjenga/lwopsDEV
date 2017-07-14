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
use lwops\lwops\Horticultureproducebed;
use lwops\lwops\HorticultureproducebedQuery;


/**
 * This class defines the structure of the 'horticultureproducebed' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class HorticultureproducebedTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.HorticultureproducebedTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'horticultureproducebed';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Horticultureproducebed';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Horticultureproducebed';

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
    const COL_OID = 'horticultureproducebed.oid';

    /**
     * the column name for the produceTypeOid field
     */
    const COL_PRODUCETYPEOID = 'horticultureproducebed.produceTypeOid';

    /**
     * the column name for the bedOid field
     */
    const COL_BEDOID = 'horticultureproducebed.bedOid';

    /**
     * the column name for the plantedDt field
     */
    const COL_PLANTEDDT = 'horticultureproducebed.plantedDt';

    /**
     * the column name for the harvestDt field
     */
    const COL_HARVESTDT = 'horticultureproducebed.harvestDt';

    /**
     * the column name for the endDt field
     */
    const COL_ENDDT = 'horticultureproducebed.endDt';

    /**
     * the column name for the ganttParentOid field
     */
    const COL_GANTTPARENTOID = 'horticultureproducebed.ganttParentOid';

    /**
     * the column name for the notes field
     */
    const COL_NOTES = 'horticultureproducebed.notes';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'horticultureproducebed.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'horticultureproducebed.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Producetypeoid', 'Bedoid', 'Planteddt', 'Harvestdt', 'Enddt', 'Ganttparentoid', 'Notes', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'producetypeoid', 'bedoid', 'planteddt', 'harvestdt', 'enddt', 'ganttparentoid', 'notes', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(HorticultureproducebedTableMap::COL_OID, HorticultureproducebedTableMap::COL_PRODUCETYPEOID, HorticultureproducebedTableMap::COL_BEDOID, HorticultureproducebedTableMap::COL_PLANTEDDT, HorticultureproducebedTableMap::COL_HARVESTDT, HorticultureproducebedTableMap::COL_ENDDT, HorticultureproducebedTableMap::COL_GANTTPARENTOID, HorticultureproducebedTableMap::COL_NOTES, HorticultureproducebedTableMap::COL_CREATETMSTP, HorticultureproducebedTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'produceTypeOid', 'bedOid', 'plantedDt', 'harvestDt', 'endDt', 'ganttParentOid', 'notes', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Producetypeoid' => 1, 'Bedoid' => 2, 'Planteddt' => 3, 'Harvestdt' => 4, 'Enddt' => 5, 'Ganttparentoid' => 6, 'Notes' => 7, 'Createtmstp' => 8, 'Updttmstp' => 9, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'producetypeoid' => 1, 'bedoid' => 2, 'planteddt' => 3, 'harvestdt' => 4, 'enddt' => 5, 'ganttparentoid' => 6, 'notes' => 7, 'createtmstp' => 8, 'updttmstp' => 9, ),
        self::TYPE_COLNAME       => array(HorticultureproducebedTableMap::COL_OID => 0, HorticultureproducebedTableMap::COL_PRODUCETYPEOID => 1, HorticultureproducebedTableMap::COL_BEDOID => 2, HorticultureproducebedTableMap::COL_PLANTEDDT => 3, HorticultureproducebedTableMap::COL_HARVESTDT => 4, HorticultureproducebedTableMap::COL_ENDDT => 5, HorticultureproducebedTableMap::COL_GANTTPARENTOID => 6, HorticultureproducebedTableMap::COL_NOTES => 7, HorticultureproducebedTableMap::COL_CREATETMSTP => 8, HorticultureproducebedTableMap::COL_UPDTTMSTP => 9, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'produceTypeOid' => 1, 'bedOid' => 2, 'plantedDt' => 3, 'harvestDt' => 4, 'endDt' => 5, 'ganttParentOid' => 6, 'notes' => 7, 'createTmstp' => 8, 'updtTmstp' => 9, ),
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
        $this->setName('horticultureproducebed');
        $this->setPhpName('Horticultureproducebed');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Horticultureproducebed');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addForeignKey('produceTypeOid', 'Producetypeoid', 'INTEGER', 'horticultureproducedetail', 'oid', true, null, null);
        $this->addForeignKey('bedOid', 'Bedoid', 'INTEGER', 'horticulturebed', 'oid', true, null, null);
        $this->addColumn('plantedDt', 'Planteddt', 'DATE', true, null, null);
        $this->addColumn('harvestDt', 'Harvestdt', 'DATE', true, null, null);
        $this->addColumn('endDt', 'Enddt', 'DATE', true, null, null);
        $this->addColumn('ganttParentOid', 'Ganttparentoid', 'INTEGER', true, null, 0);
        $this->addColumn('notes', 'Notes', 'LONGVARCHAR', false, null, null);
        $this->addColumn('createTmstp', 'Createtmstp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updtTmstp', 'Updttmstp', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Horticultureproducedetail', '\\lwops\\lwops\\Horticultureproducedetail', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':produceTypeOid',
    1 => ':oid',
  ),
), null, null, null, false);
        $this->addRelation('Horticulturebed', '\\lwops\\lwops\\Horticulturebed', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':bedOid',
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
        return $withPrefix ? HorticultureproducebedTableMap::CLASS_DEFAULT : HorticultureproducebedTableMap::OM_CLASS;
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
     * @return array           (Horticultureproducebed object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = HorticultureproducebedTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = HorticultureproducebedTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + HorticultureproducebedTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = HorticultureproducebedTableMap::OM_CLASS;
            /** @var Horticultureproducebed $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            HorticultureproducebedTableMap::addInstanceToPool($obj, $key);
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
            $key = HorticultureproducebedTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = HorticultureproducebedTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Horticultureproducebed $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                HorticultureproducebedTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(HorticultureproducebedTableMap::COL_OID);
            $criteria->addSelectColumn(HorticultureproducebedTableMap::COL_PRODUCETYPEOID);
            $criteria->addSelectColumn(HorticultureproducebedTableMap::COL_BEDOID);
            $criteria->addSelectColumn(HorticultureproducebedTableMap::COL_PLANTEDDT);
            $criteria->addSelectColumn(HorticultureproducebedTableMap::COL_HARVESTDT);
            $criteria->addSelectColumn(HorticultureproducebedTableMap::COL_ENDDT);
            $criteria->addSelectColumn(HorticultureproducebedTableMap::COL_GANTTPARENTOID);
            $criteria->addSelectColumn(HorticultureproducebedTableMap::COL_NOTES);
            $criteria->addSelectColumn(HorticultureproducebedTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(HorticultureproducebedTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.produceTypeOid');
            $criteria->addSelectColumn($alias . '.bedOid');
            $criteria->addSelectColumn($alias . '.plantedDt');
            $criteria->addSelectColumn($alias . '.harvestDt');
            $criteria->addSelectColumn($alias . '.endDt');
            $criteria->addSelectColumn($alias . '.ganttParentOid');
            $criteria->addSelectColumn($alias . '.notes');
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
        return Propel::getServiceContainer()->getDatabaseMap(HorticultureproducebedTableMap::DATABASE_NAME)->getTable(HorticultureproducebedTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(HorticultureproducebedTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(HorticultureproducebedTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new HorticultureproducebedTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Horticultureproducebed or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Horticultureproducebed object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducebedTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Horticultureproducebed) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(HorticultureproducebedTableMap::DATABASE_NAME);
            $criteria->add(HorticultureproducebedTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = HorticultureproducebedQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            HorticultureproducebedTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                HorticultureproducebedTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the horticultureproducebed table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return HorticultureproducebedQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Horticultureproducebed or Criteria object.
     *
     * @param mixed               $criteria Criteria or Horticultureproducebed object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducebedTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Horticultureproducebed object
        }

        if ($criteria->containsKey(HorticultureproducebedTableMap::COL_OID) && $criteria->keyContainsValue(HorticultureproducebedTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.HorticultureproducebedTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = HorticultureproducebedQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // HorticultureproducebedTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
HorticultureproducebedTableMap::buildTableMap();
