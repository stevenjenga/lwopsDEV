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
use lwops\lwops\Employeerole;
use lwops\lwops\EmployeeroleQuery;


/**
 * This class defines the structure of the 'employeerole' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class EmployeeroleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.EmployeeroleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'employeerole';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Employeerole';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Employeerole';

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
    const COL_OID = 'employeerole.oid';

    /**
     * the column name for the employeeOid field
     */
    const COL_EMPLOYEEOID = 'employeerole.employeeOid';

    /**
     * the column name for the employeeRoleTypeOid field
     */
    const COL_EMPLOYEEROLETYPEOID = 'employeerole.employeeRoleTypeOid';

    /**
     * the column name for the effectiveDt field
     */
    const COL_EFFECTIVEDT = 'employeerole.effectiveDt';

    /**
     * the column name for the endDt field
     */
    const COL_ENDDT = 'employeerole.endDt';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'employeerole.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'employeerole.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Employeeoid', 'Employeeroletypeoid', 'Effectivedt', 'Enddt', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'employeeoid', 'employeeroletypeoid', 'effectivedt', 'enddt', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(EmployeeroleTableMap::COL_OID, EmployeeroleTableMap::COL_EMPLOYEEOID, EmployeeroleTableMap::COL_EMPLOYEEROLETYPEOID, EmployeeroleTableMap::COL_EFFECTIVEDT, EmployeeroleTableMap::COL_ENDDT, EmployeeroleTableMap::COL_CREATETMSTP, EmployeeroleTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'employeeOid', 'employeeRoleTypeOid', 'effectiveDt', 'endDt', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Employeeoid' => 1, 'Employeeroletypeoid' => 2, 'Effectivedt' => 3, 'Enddt' => 4, 'Createtmstp' => 5, 'Updttmstp' => 6, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'employeeoid' => 1, 'employeeroletypeoid' => 2, 'effectivedt' => 3, 'enddt' => 4, 'createtmstp' => 5, 'updttmstp' => 6, ),
        self::TYPE_COLNAME       => array(EmployeeroleTableMap::COL_OID => 0, EmployeeroleTableMap::COL_EMPLOYEEOID => 1, EmployeeroleTableMap::COL_EMPLOYEEROLETYPEOID => 2, EmployeeroleTableMap::COL_EFFECTIVEDT => 3, EmployeeroleTableMap::COL_ENDDT => 4, EmployeeroleTableMap::COL_CREATETMSTP => 5, EmployeeroleTableMap::COL_UPDTTMSTP => 6, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'employeeOid' => 1, 'employeeRoleTypeOid' => 2, 'effectiveDt' => 3, 'endDt' => 4, 'createTmstp' => 5, 'updtTmstp' => 6, ),
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
        $this->setName('employeerole');
        $this->setPhpName('Employeerole');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Employeerole');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addForeignKey('employeeOid', 'Employeeoid', 'INTEGER', 'employee', 'oid', true, null, null);
        $this->addForeignKey('employeeRoleTypeOid', 'Employeeroletypeoid', 'INTEGER', 'employeeroletype', 'oid', true, null, null);
        $this->addColumn('effectiveDt', 'Effectivedt', 'DATE', true, null, null);
        $this->addColumn('endDt', 'Enddt', 'DATE', false, null, null);
        $this->addColumn('createTmstp', 'Createtmstp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updtTmstp', 'Updttmstp', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Employee', '\\lwops\\lwops\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, null, false);
        $this->addRelation('Employeeroletype', '\\lwops\\lwops\\Employeeroletype', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employeeRoleTypeOid',
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
        return $withPrefix ? EmployeeroleTableMap::CLASS_DEFAULT : EmployeeroleTableMap::OM_CLASS;
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
     * @return array           (Employeerole object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EmployeeroleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmployeeroleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmployeeroleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmployeeroleTableMap::OM_CLASS;
            /** @var Employeerole $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmployeeroleTableMap::addInstanceToPool($obj, $key);
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
            $key = EmployeeroleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmployeeroleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Employeerole $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmployeeroleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmployeeroleTableMap::COL_OID);
            $criteria->addSelectColumn(EmployeeroleTableMap::COL_EMPLOYEEOID);
            $criteria->addSelectColumn(EmployeeroleTableMap::COL_EMPLOYEEROLETYPEOID);
            $criteria->addSelectColumn(EmployeeroleTableMap::COL_EFFECTIVEDT);
            $criteria->addSelectColumn(EmployeeroleTableMap::COL_ENDDT);
            $criteria->addSelectColumn(EmployeeroleTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(EmployeeroleTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.employeeOid');
            $criteria->addSelectColumn($alias . '.employeeRoleTypeOid');
            $criteria->addSelectColumn($alias . '.effectiveDt');
            $criteria->addSelectColumn($alias . '.endDt');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmployeeroleTableMap::DATABASE_NAME)->getTable(EmployeeroleTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EmployeeroleTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EmployeeroleTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EmployeeroleTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Employeerole or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Employeerole object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeroleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Employeerole) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmployeeroleTableMap::DATABASE_NAME);
            $criteria->add(EmployeeroleTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = EmployeeroleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmployeeroleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmployeeroleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the employeerole table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EmployeeroleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Employeerole or Criteria object.
     *
     * @param mixed               $criteria Criteria or Employeerole object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeroleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Employeerole object
        }

        if ($criteria->containsKey(EmployeeroleTableMap::COL_OID) && $criteria->keyContainsValue(EmployeeroleTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmployeeroleTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = EmployeeroleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EmployeeroleTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EmployeeroleTableMap::buildTableMap();
