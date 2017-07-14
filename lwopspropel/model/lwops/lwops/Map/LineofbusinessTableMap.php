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
use lwops\lwops\Lineofbusiness;
use lwops\lwops\LineofbusinessQuery;


/**
 * This class defines the structure of the 'lineofbusiness' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class LineofbusinessTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.LineofbusinessTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'lineofbusiness';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Lineofbusiness';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Lineofbusiness';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'lineofbusiness.oid';

    /**
     * the column name for the department field
     */
    const COL_DEPARTMENT = 'lineofbusiness.department';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'lineofbusiness.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'lineofbusiness.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Department', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'department', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(LineofbusinessTableMap::COL_OID, LineofbusinessTableMap::COL_DEPARTMENT, LineofbusinessTableMap::COL_CREATETMSTP, LineofbusinessTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'department', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Department' => 1, 'Createtmstp' => 2, 'Updttmstp' => 3, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'department' => 1, 'createtmstp' => 2, 'updttmstp' => 3, ),
        self::TYPE_COLNAME       => array(LineofbusinessTableMap::COL_OID => 0, LineofbusinessTableMap::COL_DEPARTMENT => 1, LineofbusinessTableMap::COL_CREATETMSTP => 2, LineofbusinessTableMap::COL_UPDTTMSTP => 3, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'department' => 1, 'createTmstp' => 2, 'updtTmstp' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
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
        $this->setName('lineofbusiness');
        $this->setPhpName('Lineofbusiness');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Lineofbusiness');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addColumn('department', 'Department', 'VARCHAR', true, 45, null);
        $this->addColumn('createTmstp', 'Createtmstp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updtTmstp', 'Updttmstp', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Dairypandl', '\\lwops\\lwops\\Dairypandl', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':lineOfBusinessOid',
    1 => ':oid',
  ),
), null, null, 'Dairypandls', false);
        $this->addRelation('Electricityallocation', '\\lwops\\lwops\\Electricityallocation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':lineOfBusinessOid',
    1 => ':oid',
  ),
), null, null, 'Electricityallocations', false);
        $this->addRelation('Employeepurchases', '\\lwops\\lwops\\Employeepurchases', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':lineOfBusinessOid',
    1 => ':oid',
  ),
), null, null, 'Employeepurchasess', false);
        $this->addRelation('Employeesalaryexpenseallocation', '\\lwops\\lwops\\Employeesalaryexpenseallocation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':lineOfBusinessOid',
    1 => ':oid',
  ),
), null, null, 'Employeesalaryexpenseallocations', false);
        $this->addRelation('Expenses', '\\lwops\\lwops\\Expenses', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':lineOfBusinessOid',
    1 => ':oid',
  ),
), null, null, 'Expensess', false);
        $this->addRelation('Fishpandl', '\\lwops\\lwops\\Fishpandl', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':lineOfBusinessOid',
    1 => ':oid',
  ),
), null, null, 'Fishpandls', false);
        $this->addRelation('Otherworkassigned', '\\lwops\\lwops\\Otherworkassigned', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':lineOfBusinessOid',
    1 => ':oid',
  ),
), null, null, 'Otherworkassigneds', false);
        $this->addRelation('Parttimedetail', '\\lwops\\lwops\\Parttimedetail', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':lineOfBussinessOid',
    1 => ':oid',
  ),
), null, null, 'Parttimedetails', false);
        $this->addRelation('Teapandl', '\\lwops\\lwops\\Teapandl', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':lineOfBusinessOid',
    1 => ':oid',
  ),
), null, null, 'Teapandls', false);
        $this->addRelation('Vehicleexpenseallocation', '\\lwops\\lwops\\Vehicleexpenseallocation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':lineOfBusinessOid',
    1 => ':oid',
  ),
), null, null, 'Vehicleexpenseallocations', false);
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
        return $withPrefix ? LineofbusinessTableMap::CLASS_DEFAULT : LineofbusinessTableMap::OM_CLASS;
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
     * @return array           (Lineofbusiness object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = LineofbusinessTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LineofbusinessTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LineofbusinessTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LineofbusinessTableMap::OM_CLASS;
            /** @var Lineofbusiness $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LineofbusinessTableMap::addInstanceToPool($obj, $key);
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
            $key = LineofbusinessTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LineofbusinessTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Lineofbusiness $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LineofbusinessTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LineofbusinessTableMap::COL_OID);
            $criteria->addSelectColumn(LineofbusinessTableMap::COL_DEPARTMENT);
            $criteria->addSelectColumn(LineofbusinessTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(LineofbusinessTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.department');
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
        return Propel::getServiceContainer()->getDatabaseMap(LineofbusinessTableMap::DATABASE_NAME)->getTable(LineofbusinessTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(LineofbusinessTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(LineofbusinessTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new LineofbusinessTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Lineofbusiness or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Lineofbusiness object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LineofbusinessTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Lineofbusiness) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LineofbusinessTableMap::DATABASE_NAME);
            $criteria->add(LineofbusinessTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = LineofbusinessQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LineofbusinessTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LineofbusinessTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the lineofbusiness table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LineofbusinessQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Lineofbusiness or Criteria object.
     *
     * @param mixed               $criteria Criteria or Lineofbusiness object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LineofbusinessTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Lineofbusiness object
        }

        if ($criteria->containsKey(LineofbusinessTableMap::COL_OID) && $criteria->keyContainsValue(LineofbusinessTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LineofbusinessTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = LineofbusinessQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // LineofbusinessTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
LineofbusinessTableMap::buildTableMap();
