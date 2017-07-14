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
use lwops\lwops\Dairypandllabourexpensedetail;
use lwops\lwops\DairypandllabourexpensedetailQuery;


/**
 * This class defines the structure of the 'dairypandllabourexpensedetail' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class DairypandllabourexpensedetailTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.DairypandllabourexpensedetailTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'dairypandllabourexpensedetail';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Dairypandllabourexpensedetail';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Dairypandllabourexpensedetail';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'dairypandllabourexpensedetail.oid';

    /**
     * the column name for the DairyPandLOid field
     */
    const COL_DAIRYPANDLOID = 'dairypandllabourexpensedetail.DairyPandLOid';

    /**
     * the column name for the EmployeeRoleOid field
     */
    const COL_EMPLOYEEROLEOID = 'dairypandllabourexpensedetail.EmployeeRoleOid';

    /**
     * the column name for the expenseAmount field
     */
    const COL_EXPENSEAMOUNT = 'dairypandllabourexpensedetail.expenseAmount';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'dairypandllabourexpensedetail.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'dairypandllabourexpensedetail.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Dairypandloid', 'Employeeroleoid', 'Expenseamount', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'dairypandloid', 'employeeroleoid', 'expenseamount', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(DairypandllabourexpensedetailTableMap::COL_OID, DairypandllabourexpensedetailTableMap::COL_DAIRYPANDLOID, DairypandllabourexpensedetailTableMap::COL_EMPLOYEEROLEOID, DairypandllabourexpensedetailTableMap::COL_EXPENSEAMOUNT, DairypandllabourexpensedetailTableMap::COL_CREATETMSTP, DairypandllabourexpensedetailTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'DairyPandLOid', 'EmployeeRoleOid', 'expenseAmount', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Dairypandloid' => 1, 'Employeeroleoid' => 2, 'Expenseamount' => 3, 'Createtmstp' => 4, 'Updttmstp' => 5, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'dairypandloid' => 1, 'employeeroleoid' => 2, 'expenseamount' => 3, 'createtmstp' => 4, 'updttmstp' => 5, ),
        self::TYPE_COLNAME       => array(DairypandllabourexpensedetailTableMap::COL_OID => 0, DairypandllabourexpensedetailTableMap::COL_DAIRYPANDLOID => 1, DairypandllabourexpensedetailTableMap::COL_EMPLOYEEROLEOID => 2, DairypandllabourexpensedetailTableMap::COL_EXPENSEAMOUNT => 3, DairypandllabourexpensedetailTableMap::COL_CREATETMSTP => 4, DairypandllabourexpensedetailTableMap::COL_UPDTTMSTP => 5, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'DairyPandLOid' => 1, 'EmployeeRoleOid' => 2, 'expenseAmount' => 3, 'createTmstp' => 4, 'updtTmstp' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('dairypandllabourexpensedetail');
        $this->setPhpName('Dairypandllabourexpensedetail');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Dairypandllabourexpensedetail');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addForeignKey('DairyPandLOid', 'Dairypandloid', 'INTEGER', 'dairypandl', 'oid', true, null, null);
        $this->addForeignKey('EmployeeRoleOid', 'Employeeroleoid', 'INTEGER', 'employeeroletype', 'oid', true, null, null);
        $this->addColumn('expenseAmount', 'Expenseamount', 'FLOAT', true, null, 0);
        $this->addColumn('createTmstp', 'Createtmstp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updtTmstp', 'Updttmstp', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Dairypandl', '\\lwops\\lwops\\Dairypandl', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':DairyPandLOid',
    1 => ':oid',
  ),
), null, null, null, false);
        $this->addRelation('Employeeroletype', '\\lwops\\lwops\\Employeeroletype', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':EmployeeRoleOid',
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
        return $withPrefix ? DairypandllabourexpensedetailTableMap::CLASS_DEFAULT : DairypandllabourexpensedetailTableMap::OM_CLASS;
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
     * @return array           (Dairypandllabourexpensedetail object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = DairypandllabourexpensedetailTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DairypandllabourexpensedetailTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DairypandllabourexpensedetailTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DairypandllabourexpensedetailTableMap::OM_CLASS;
            /** @var Dairypandllabourexpensedetail $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DairypandllabourexpensedetailTableMap::addInstanceToPool($obj, $key);
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
            $key = DairypandllabourexpensedetailTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DairypandllabourexpensedetailTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Dairypandllabourexpensedetail $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DairypandllabourexpensedetailTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DairypandllabourexpensedetailTableMap::COL_OID);
            $criteria->addSelectColumn(DairypandllabourexpensedetailTableMap::COL_DAIRYPANDLOID);
            $criteria->addSelectColumn(DairypandllabourexpensedetailTableMap::COL_EMPLOYEEROLEOID);
            $criteria->addSelectColumn(DairypandllabourexpensedetailTableMap::COL_EXPENSEAMOUNT);
            $criteria->addSelectColumn(DairypandllabourexpensedetailTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(DairypandllabourexpensedetailTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.DairyPandLOid');
            $criteria->addSelectColumn($alias . '.EmployeeRoleOid');
            $criteria->addSelectColumn($alias . '.expenseAmount');
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
        return Propel::getServiceContainer()->getDatabaseMap(DairypandllabourexpensedetailTableMap::DATABASE_NAME)->getTable(DairypandllabourexpensedetailTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(DairypandllabourexpensedetailTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(DairypandllabourexpensedetailTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new DairypandllabourexpensedetailTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Dairypandllabourexpensedetail or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Dairypandllabourexpensedetail object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DairypandllabourexpensedetailTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Dairypandllabourexpensedetail) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DairypandllabourexpensedetailTableMap::DATABASE_NAME);
            $criteria->add(DairypandllabourexpensedetailTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = DairypandllabourexpensedetailQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DairypandllabourexpensedetailTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DairypandllabourexpensedetailTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the dairypandllabourexpensedetail table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return DairypandllabourexpensedetailQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Dairypandllabourexpensedetail or Criteria object.
     *
     * @param mixed               $criteria Criteria or Dairypandllabourexpensedetail object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DairypandllabourexpensedetailTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Dairypandllabourexpensedetail object
        }

        if ($criteria->containsKey(DairypandllabourexpensedetailTableMap::COL_OID) && $criteria->keyContainsValue(DairypandllabourexpensedetailTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DairypandllabourexpensedetailTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = DairypandllabourexpensedetailQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // DairypandllabourexpensedetailTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
DairypandllabourexpensedetailTableMap::buildTableMap();
