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
use lwops\lwops\Employeeloan;
use lwops\lwops\EmployeeloanQuery;


/**
 * This class defines the structure of the 'employeeloan' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class EmployeeloanTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.EmployeeloanTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'employeeloan';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Employeeloan';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Employeeloan';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'employeeloan.oid';

    /**
     * the column name for the employeeOid field
     */
    const COL_EMPLOYEEOID = 'employeeloan.employeeOid';

    /**
     * the column name for the loanNbr field
     */
    const COL_LOANNBR = 'employeeloan.loanNbr';

    /**
     * the column name for the loanDate field
     */
    const COL_LOANDATE = 'employeeloan.loanDate';

    /**
     * the column name for the loanAmount field
     */
    const COL_LOANAMOUNT = 'employeeloan.loanAmount';

    /**
     * the column name for the purpose field
     */
    const COL_PURPOSE = 'employeeloan.purpose';

    /**
     * the column name for the nbrOfPayPeriods field
     */
    const COL_NBROFPAYPERIODS = 'employeeloan.nbrOfPayPeriods';

    /**
     * the column name for the opsMonthlyCalendarOid field
     */
    const COL_OPSMONTHLYCALENDAROID = 'employeeloan.opsMonthlyCalendarOid';

    /**
     * the column name for the installmentAmt field
     */
    const COL_INSTALLMENTAMT = 'employeeloan.installmentAmt';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'employeeloan.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'employeeloan.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Employeeoid', 'Loannbr', 'Loandate', 'Loanamount', 'Purpose', 'Nbrofpayperiods', 'Opsmonthlycalendaroid', 'Installmentamt', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'employeeoid', 'loannbr', 'loandate', 'loanamount', 'purpose', 'nbrofpayperiods', 'opsmonthlycalendaroid', 'installmentamt', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(EmployeeloanTableMap::COL_OID, EmployeeloanTableMap::COL_EMPLOYEEOID, EmployeeloanTableMap::COL_LOANNBR, EmployeeloanTableMap::COL_LOANDATE, EmployeeloanTableMap::COL_LOANAMOUNT, EmployeeloanTableMap::COL_PURPOSE, EmployeeloanTableMap::COL_NBROFPAYPERIODS, EmployeeloanTableMap::COL_OPSMONTHLYCALENDAROID, EmployeeloanTableMap::COL_INSTALLMENTAMT, EmployeeloanTableMap::COL_CREATETMSTP, EmployeeloanTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'employeeOid', 'loanNbr', 'loanDate', 'loanAmount', 'purpose', 'nbrOfPayPeriods', 'opsMonthlyCalendarOid', 'installmentAmt', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Employeeoid' => 1, 'Loannbr' => 2, 'Loandate' => 3, 'Loanamount' => 4, 'Purpose' => 5, 'Nbrofpayperiods' => 6, 'Opsmonthlycalendaroid' => 7, 'Installmentamt' => 8, 'Createtmstp' => 9, 'Updttmstp' => 10, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'employeeoid' => 1, 'loannbr' => 2, 'loandate' => 3, 'loanamount' => 4, 'purpose' => 5, 'nbrofpayperiods' => 6, 'opsmonthlycalendaroid' => 7, 'installmentamt' => 8, 'createtmstp' => 9, 'updttmstp' => 10, ),
        self::TYPE_COLNAME       => array(EmployeeloanTableMap::COL_OID => 0, EmployeeloanTableMap::COL_EMPLOYEEOID => 1, EmployeeloanTableMap::COL_LOANNBR => 2, EmployeeloanTableMap::COL_LOANDATE => 3, EmployeeloanTableMap::COL_LOANAMOUNT => 4, EmployeeloanTableMap::COL_PURPOSE => 5, EmployeeloanTableMap::COL_NBROFPAYPERIODS => 6, EmployeeloanTableMap::COL_OPSMONTHLYCALENDAROID => 7, EmployeeloanTableMap::COL_INSTALLMENTAMT => 8, EmployeeloanTableMap::COL_CREATETMSTP => 9, EmployeeloanTableMap::COL_UPDTTMSTP => 10, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'employeeOid' => 1, 'loanNbr' => 2, 'loanDate' => 3, 'loanAmount' => 4, 'purpose' => 5, 'nbrOfPayPeriods' => 6, 'opsMonthlyCalendarOid' => 7, 'installmentAmt' => 8, 'createTmstp' => 9, 'updtTmstp' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
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
        $this->setName('employeeloan');
        $this->setPhpName('Employeeloan');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Employeeloan');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addForeignKey('employeeOid', 'Employeeoid', 'INTEGER', 'employee', 'oid', true, null, null);
        $this->addColumn('loanNbr', 'Loannbr', 'VARCHAR', true, 15, null);
        $this->addColumn('loanDate', 'Loandate', 'TIMESTAMP', true, null, null);
        $this->addColumn('loanAmount', 'Loanamount', 'FLOAT', true, null, 0);
        $this->addColumn('purpose', 'Purpose', 'VARCHAR', true, 254, 'enter purpose...');
        $this->addColumn('nbrOfPayPeriods', 'Nbrofpayperiods', 'FLOAT', true, null, 1.5);
        $this->addForeignKey('opsMonthlyCalendarOid', 'Opsmonthlycalendaroid', 'INTEGER', 'opsmonthlycalendar', 'oid', true, null, null);
        $this->addColumn('installmentAmt', 'Installmentamt', 'FLOAT', true, null, 0);
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
        $this->addRelation('Opsmonthlycalendar', '\\lwops\\lwops\\Opsmonthlycalendar', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':opsMonthlyCalendarOid',
    1 => ':oid',
  ),
), null, null, null, false);
        $this->addRelation('Employeeloanpmt', '\\lwops\\lwops\\Employeeloanpmt', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeLoanOid',
    1 => ':oid',
  ),
), null, null, 'Employeeloanpmts', false);
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
        return $withPrefix ? EmployeeloanTableMap::CLASS_DEFAULT : EmployeeloanTableMap::OM_CLASS;
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
     * @return array           (Employeeloan object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EmployeeloanTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmployeeloanTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmployeeloanTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmployeeloanTableMap::OM_CLASS;
            /** @var Employeeloan $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmployeeloanTableMap::addInstanceToPool($obj, $key);
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
            $key = EmployeeloanTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmployeeloanTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Employeeloan $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmployeeloanTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmployeeloanTableMap::COL_OID);
            $criteria->addSelectColumn(EmployeeloanTableMap::COL_EMPLOYEEOID);
            $criteria->addSelectColumn(EmployeeloanTableMap::COL_LOANNBR);
            $criteria->addSelectColumn(EmployeeloanTableMap::COL_LOANDATE);
            $criteria->addSelectColumn(EmployeeloanTableMap::COL_LOANAMOUNT);
            $criteria->addSelectColumn(EmployeeloanTableMap::COL_PURPOSE);
            $criteria->addSelectColumn(EmployeeloanTableMap::COL_NBROFPAYPERIODS);
            $criteria->addSelectColumn(EmployeeloanTableMap::COL_OPSMONTHLYCALENDAROID);
            $criteria->addSelectColumn(EmployeeloanTableMap::COL_INSTALLMENTAMT);
            $criteria->addSelectColumn(EmployeeloanTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(EmployeeloanTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.employeeOid');
            $criteria->addSelectColumn($alias . '.loanNbr');
            $criteria->addSelectColumn($alias . '.loanDate');
            $criteria->addSelectColumn($alias . '.loanAmount');
            $criteria->addSelectColumn($alias . '.purpose');
            $criteria->addSelectColumn($alias . '.nbrOfPayPeriods');
            $criteria->addSelectColumn($alias . '.opsMonthlyCalendarOid');
            $criteria->addSelectColumn($alias . '.installmentAmt');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmployeeloanTableMap::DATABASE_NAME)->getTable(EmployeeloanTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EmployeeloanTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EmployeeloanTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EmployeeloanTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Employeeloan or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Employeeloan object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeloanTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Employeeloan) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmployeeloanTableMap::DATABASE_NAME);
            $criteria->add(EmployeeloanTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = EmployeeloanQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmployeeloanTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmployeeloanTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the employeeloan table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EmployeeloanQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Employeeloan or Criteria object.
     *
     * @param mixed               $criteria Criteria or Employeeloan object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeloanTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Employeeloan object
        }

        if ($criteria->containsKey(EmployeeloanTableMap::COL_OID) && $criteria->keyContainsValue(EmployeeloanTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmployeeloanTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = EmployeeloanQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EmployeeloanTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EmployeeloanTableMap::buildTableMap();
