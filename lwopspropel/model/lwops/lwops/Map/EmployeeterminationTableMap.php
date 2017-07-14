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
use lwops\lwops\Employeetermination;
use lwops\lwops\EmployeeterminationQuery;


/**
 * This class defines the structure of the 'employeetermination' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class EmployeeterminationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.EmployeeterminationTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'employeetermination';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Employeetermination';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Employeetermination';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'employeetermination.oid';

    /**
     * the column name for the employeeOid field
     */
    const COL_EMPLOYEEOID = 'employeetermination.employeeOid';

    /**
     * the column name for the employeeTerminationTypeOid field
     */
    const COL_EMPLOYEETERMINATIONTYPEOID = 'employeetermination.employeeTerminationTypeOid';

    /**
     * the column name for the terminationDate field
     */
    const COL_TERMINATIONDATE = 'employeetermination.terminationDate';

    /**
     * the column name for the comments field
     */
    const COL_COMMENTS = 'employeetermination.comments';

    /**
     * the column name for the gratuityAmt field
     */
    const COL_GRATUITYAMT = 'employeetermination.gratuityAmt';

    /**
     * the column name for the gratuityComments field
     */
    const COL_GRATUITYCOMMENTS = 'employeetermination.gratuityComments';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'employeetermination.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'employeetermination.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Employeeoid', 'Employeeterminationtypeoid', 'Terminationdate', 'Comments', 'Gratuityamt', 'Gratuitycomments', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'employeeoid', 'employeeterminationtypeoid', 'terminationdate', 'comments', 'gratuityamt', 'gratuitycomments', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(EmployeeterminationTableMap::COL_OID, EmployeeterminationTableMap::COL_EMPLOYEEOID, EmployeeterminationTableMap::COL_EMPLOYEETERMINATIONTYPEOID, EmployeeterminationTableMap::COL_TERMINATIONDATE, EmployeeterminationTableMap::COL_COMMENTS, EmployeeterminationTableMap::COL_GRATUITYAMT, EmployeeterminationTableMap::COL_GRATUITYCOMMENTS, EmployeeterminationTableMap::COL_CREATETMSTP, EmployeeterminationTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'employeeOid', 'employeeTerminationTypeOid', 'terminationDate', 'comments', 'gratuityAmt', 'gratuityComments', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Employeeoid' => 1, 'Employeeterminationtypeoid' => 2, 'Terminationdate' => 3, 'Comments' => 4, 'Gratuityamt' => 5, 'Gratuitycomments' => 6, 'Createtmstp' => 7, 'Updttmstp' => 8, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'employeeoid' => 1, 'employeeterminationtypeoid' => 2, 'terminationdate' => 3, 'comments' => 4, 'gratuityamt' => 5, 'gratuitycomments' => 6, 'createtmstp' => 7, 'updttmstp' => 8, ),
        self::TYPE_COLNAME       => array(EmployeeterminationTableMap::COL_OID => 0, EmployeeterminationTableMap::COL_EMPLOYEEOID => 1, EmployeeterminationTableMap::COL_EMPLOYEETERMINATIONTYPEOID => 2, EmployeeterminationTableMap::COL_TERMINATIONDATE => 3, EmployeeterminationTableMap::COL_COMMENTS => 4, EmployeeterminationTableMap::COL_GRATUITYAMT => 5, EmployeeterminationTableMap::COL_GRATUITYCOMMENTS => 6, EmployeeterminationTableMap::COL_CREATETMSTP => 7, EmployeeterminationTableMap::COL_UPDTTMSTP => 8, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'employeeOid' => 1, 'employeeTerminationTypeOid' => 2, 'terminationDate' => 3, 'comments' => 4, 'gratuityAmt' => 5, 'gratuityComments' => 6, 'createTmstp' => 7, 'updtTmstp' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
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
        $this->setName('employeetermination');
        $this->setPhpName('Employeetermination');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Employeetermination');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addForeignKey('employeeOid', 'Employeeoid', 'INTEGER', 'employee', 'oid', true, null, null);
        $this->addForeignKey('employeeTerminationTypeOid', 'Employeeterminationtypeoid', 'INTEGER', 'employeeterminationtype', 'oid', true, null, null);
        $this->addColumn('terminationDate', 'Terminationdate', 'DATE', true, null, null);
        $this->addColumn('comments', 'Comments', 'VARCHAR', true, 200, null);
        $this->addColumn('gratuityAmt', 'Gratuityamt', 'FLOAT', true, null, 0);
        $this->addColumn('gratuityComments', 'Gratuitycomments', 'VARCHAR', false, 254, null);
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
        $this->addRelation('Employeeterminationtype', '\\lwops\\lwops\\Employeeterminationtype', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employeeTerminationTypeOid',
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
        return $withPrefix ? EmployeeterminationTableMap::CLASS_DEFAULT : EmployeeterminationTableMap::OM_CLASS;
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
     * @return array           (Employeetermination object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EmployeeterminationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmployeeterminationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmployeeterminationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmployeeterminationTableMap::OM_CLASS;
            /** @var Employeetermination $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmployeeterminationTableMap::addInstanceToPool($obj, $key);
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
            $key = EmployeeterminationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmployeeterminationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Employeetermination $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmployeeterminationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmployeeterminationTableMap::COL_OID);
            $criteria->addSelectColumn(EmployeeterminationTableMap::COL_EMPLOYEEOID);
            $criteria->addSelectColumn(EmployeeterminationTableMap::COL_EMPLOYEETERMINATIONTYPEOID);
            $criteria->addSelectColumn(EmployeeterminationTableMap::COL_TERMINATIONDATE);
            $criteria->addSelectColumn(EmployeeterminationTableMap::COL_COMMENTS);
            $criteria->addSelectColumn(EmployeeterminationTableMap::COL_GRATUITYAMT);
            $criteria->addSelectColumn(EmployeeterminationTableMap::COL_GRATUITYCOMMENTS);
            $criteria->addSelectColumn(EmployeeterminationTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(EmployeeterminationTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.employeeOid');
            $criteria->addSelectColumn($alias . '.employeeTerminationTypeOid');
            $criteria->addSelectColumn($alias . '.terminationDate');
            $criteria->addSelectColumn($alias . '.comments');
            $criteria->addSelectColumn($alias . '.gratuityAmt');
            $criteria->addSelectColumn($alias . '.gratuityComments');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmployeeterminationTableMap::DATABASE_NAME)->getTable(EmployeeterminationTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EmployeeterminationTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EmployeeterminationTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EmployeeterminationTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Employeetermination or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Employeetermination object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeterminationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Employeetermination) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmployeeterminationTableMap::DATABASE_NAME);
            $criteria->add(EmployeeterminationTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = EmployeeterminationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmployeeterminationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmployeeterminationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the employeetermination table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EmployeeterminationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Employeetermination or Criteria object.
     *
     * @param mixed               $criteria Criteria or Employeetermination object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeterminationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Employeetermination object
        }

        if ($criteria->containsKey(EmployeeterminationTableMap::COL_OID) && $criteria->keyContainsValue(EmployeeterminationTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmployeeterminationTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = EmployeeterminationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EmployeeterminationTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EmployeeterminationTableMap::buildTableMap();
