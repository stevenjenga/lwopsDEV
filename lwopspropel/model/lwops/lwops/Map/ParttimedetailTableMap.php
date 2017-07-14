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
use lwops\lwops\Parttimedetail;
use lwops\lwops\ParttimedetailQuery;


/**
 * This class defines the structure of the 'parttimedetail' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ParttimedetailTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.ParttimedetailTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'parttimedetail';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Parttimedetail';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Parttimedetail';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'parttimedetail.oid';

    /**
     * the column name for the employeeOid field
     */
    const COL_EMPLOYEEOID = 'parttimedetail.employeeOid';

    /**
     * the column name for the attendanceOid field
     */
    const COL_ATTENDANCEOID = 'parttimedetail.attendanceOid';

    /**
     * the column name for the startTm field
     */
    const COL_STARTTM = 'parttimedetail.startTm';

    /**
     * the column name for the endTm field
     */
    const COL_ENDTM = 'parttimedetail.endTm';

    /**
     * the column name for the hours field
     */
    const COL_HOURS = 'parttimedetail.hours';

    /**
     * the column name for the workDescription field
     */
    const COL_WORKDESCRIPTION = 'parttimedetail.workDescription';

    /**
     * the column name for the lineOfBussinessOid field
     */
    const COL_LINEOFBUSSINESSOID = 'parttimedetail.lineOfBussinessOid';

    /**
     * the column name for the allocatedBy field
     */
    const COL_ALLOCATEDBY = 'parttimedetail.allocatedBy';

    /**
     * the column name for the remarks field
     */
    const COL_REMARKS = 'parttimedetail.remarks';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'parttimedetail.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'parttimedetail.updtTmstp';

    /**
     * the column name for the gr_id field
     */
    const COL_GR_ID = 'parttimedetail.gr_id';

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
        self::TYPE_PHPNAME       => array('Oid', 'Employeeoid', 'Attendanceoid', 'Starttm', 'Endtm', 'Hours', 'Workdescription', 'Lineofbussinessoid', 'Allocatedby', 'Remarks', 'Createtmstp', 'Updttmstp', 'GrId', ),
        self::TYPE_CAMELNAME     => array('oid', 'employeeoid', 'attendanceoid', 'starttm', 'endtm', 'hours', 'workdescription', 'lineofbussinessoid', 'allocatedby', 'remarks', 'createtmstp', 'updttmstp', 'grId', ),
        self::TYPE_COLNAME       => array(ParttimedetailTableMap::COL_OID, ParttimedetailTableMap::COL_EMPLOYEEOID, ParttimedetailTableMap::COL_ATTENDANCEOID, ParttimedetailTableMap::COL_STARTTM, ParttimedetailTableMap::COL_ENDTM, ParttimedetailTableMap::COL_HOURS, ParttimedetailTableMap::COL_WORKDESCRIPTION, ParttimedetailTableMap::COL_LINEOFBUSSINESSOID, ParttimedetailTableMap::COL_ALLOCATEDBY, ParttimedetailTableMap::COL_REMARKS, ParttimedetailTableMap::COL_CREATETMSTP, ParttimedetailTableMap::COL_UPDTTMSTP, ParttimedetailTableMap::COL_GR_ID, ),
        self::TYPE_FIELDNAME     => array('oid', 'employeeOid', 'attendanceOid', 'startTm', 'endTm', 'hours', 'workDescription', 'lineOfBussinessOid', 'allocatedBy', 'remarks', 'createTmstp', 'updtTmstp', 'gr_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Employeeoid' => 1, 'Attendanceoid' => 2, 'Starttm' => 3, 'Endtm' => 4, 'Hours' => 5, 'Workdescription' => 6, 'Lineofbussinessoid' => 7, 'Allocatedby' => 8, 'Remarks' => 9, 'Createtmstp' => 10, 'Updttmstp' => 11, 'GrId' => 12, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'employeeoid' => 1, 'attendanceoid' => 2, 'starttm' => 3, 'endtm' => 4, 'hours' => 5, 'workdescription' => 6, 'lineofbussinessoid' => 7, 'allocatedby' => 8, 'remarks' => 9, 'createtmstp' => 10, 'updttmstp' => 11, 'grId' => 12, ),
        self::TYPE_COLNAME       => array(ParttimedetailTableMap::COL_OID => 0, ParttimedetailTableMap::COL_EMPLOYEEOID => 1, ParttimedetailTableMap::COL_ATTENDANCEOID => 2, ParttimedetailTableMap::COL_STARTTM => 3, ParttimedetailTableMap::COL_ENDTM => 4, ParttimedetailTableMap::COL_HOURS => 5, ParttimedetailTableMap::COL_WORKDESCRIPTION => 6, ParttimedetailTableMap::COL_LINEOFBUSSINESSOID => 7, ParttimedetailTableMap::COL_ALLOCATEDBY => 8, ParttimedetailTableMap::COL_REMARKS => 9, ParttimedetailTableMap::COL_CREATETMSTP => 10, ParttimedetailTableMap::COL_UPDTTMSTP => 11, ParttimedetailTableMap::COL_GR_ID => 12, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'employeeOid' => 1, 'attendanceOid' => 2, 'startTm' => 3, 'endTm' => 4, 'hours' => 5, 'workDescription' => 6, 'lineOfBussinessOid' => 7, 'allocatedBy' => 8, 'remarks' => 9, 'createTmstp' => 10, 'updtTmstp' => 11, 'gr_id' => 12, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
        $this->setName('parttimedetail');
        $this->setPhpName('Parttimedetail');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Parttimedetail');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addForeignKey('employeeOid', 'Employeeoid', 'INTEGER', 'employee', 'oid', true, null, null);
        $this->addForeignKey('attendanceOid', 'Attendanceoid', 'INTEGER', 'attendance', 'oid', true, null, null);
        $this->addColumn('startTm', 'Starttm', 'TIME', true, null, '00:00:00');
        $this->addColumn('endTm', 'Endtm', 'TIME', true, null, '00:00:00');
        $this->addColumn('hours', 'Hours', 'FLOAT', true, null, 0);
        $this->addColumn('workDescription', 'Workdescription', 'VARCHAR', true, 100, null);
        $this->addForeignKey('lineOfBussinessOid', 'Lineofbussinessoid', 'INTEGER', 'lineofbusiness', 'oid', true, null, null);
        $this->addColumn('allocatedBy', 'Allocatedby', 'VARCHAR', true, 45, 'Select Supervisor');
        $this->addColumn('remarks', 'Remarks', 'VARCHAR', true, 100, 'none');
        $this->addColumn('createTmstp', 'Createtmstp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updtTmstp', 'Updttmstp', 'TIMESTAMP', false, null, null);
        $this->addColumn('gr_id', 'GrId', 'VARCHAR', true, 45, '0');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Attendance', '\\lwops\\lwops\\Attendance', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':attendanceOid',
    1 => ':oid',
  ),
), null, null, null, false);
        $this->addRelation('Employee', '\\lwops\\lwops\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, null, false);
        $this->addRelation('Lineofbusiness', '\\lwops\\lwops\\Lineofbusiness', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':lineOfBussinessOid',
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
        return $withPrefix ? ParttimedetailTableMap::CLASS_DEFAULT : ParttimedetailTableMap::OM_CLASS;
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
     * @return array           (Parttimedetail object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ParttimedetailTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ParttimedetailTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ParttimedetailTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ParttimedetailTableMap::OM_CLASS;
            /** @var Parttimedetail $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ParttimedetailTableMap::addInstanceToPool($obj, $key);
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
            $key = ParttimedetailTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ParttimedetailTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Parttimedetail $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ParttimedetailTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ParttimedetailTableMap::COL_OID);
            $criteria->addSelectColumn(ParttimedetailTableMap::COL_EMPLOYEEOID);
            $criteria->addSelectColumn(ParttimedetailTableMap::COL_ATTENDANCEOID);
            $criteria->addSelectColumn(ParttimedetailTableMap::COL_STARTTM);
            $criteria->addSelectColumn(ParttimedetailTableMap::COL_ENDTM);
            $criteria->addSelectColumn(ParttimedetailTableMap::COL_HOURS);
            $criteria->addSelectColumn(ParttimedetailTableMap::COL_WORKDESCRIPTION);
            $criteria->addSelectColumn(ParttimedetailTableMap::COL_LINEOFBUSSINESSOID);
            $criteria->addSelectColumn(ParttimedetailTableMap::COL_ALLOCATEDBY);
            $criteria->addSelectColumn(ParttimedetailTableMap::COL_REMARKS);
            $criteria->addSelectColumn(ParttimedetailTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(ParttimedetailTableMap::COL_UPDTTMSTP);
            $criteria->addSelectColumn(ParttimedetailTableMap::COL_GR_ID);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.employeeOid');
            $criteria->addSelectColumn($alias . '.attendanceOid');
            $criteria->addSelectColumn($alias . '.startTm');
            $criteria->addSelectColumn($alias . '.endTm');
            $criteria->addSelectColumn($alias . '.hours');
            $criteria->addSelectColumn($alias . '.workDescription');
            $criteria->addSelectColumn($alias . '.lineOfBussinessOid');
            $criteria->addSelectColumn($alias . '.allocatedBy');
            $criteria->addSelectColumn($alias . '.remarks');
            $criteria->addSelectColumn($alias . '.createTmstp');
            $criteria->addSelectColumn($alias . '.updtTmstp');
            $criteria->addSelectColumn($alias . '.gr_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(ParttimedetailTableMap::DATABASE_NAME)->getTable(ParttimedetailTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ParttimedetailTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ParttimedetailTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ParttimedetailTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Parttimedetail or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Parttimedetail object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ParttimedetailTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Parttimedetail) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ParttimedetailTableMap::DATABASE_NAME);
            $criteria->add(ParttimedetailTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = ParttimedetailQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ParttimedetailTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ParttimedetailTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the parttimedetail table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ParttimedetailQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Parttimedetail or Criteria object.
     *
     * @param mixed               $criteria Criteria or Parttimedetail object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ParttimedetailTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Parttimedetail object
        }

        if ($criteria->containsKey(ParttimedetailTableMap::COL_OID) && $criteria->keyContainsValue(ParttimedetailTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ParttimedetailTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = ParttimedetailQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ParttimedetailTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ParttimedetailTableMap::buildTableMap();
