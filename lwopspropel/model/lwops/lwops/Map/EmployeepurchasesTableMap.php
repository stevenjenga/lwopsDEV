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
use lwops\lwops\Employeepurchases;
use lwops\lwops\EmployeepurchasesQuery;


/**
 * This class defines the structure of the 'employeepurchases' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class EmployeepurchasesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.EmployeepurchasesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'employeepurchases';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Employeepurchases';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Employeepurchases';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'employeepurchases.oid';

    /**
     * the column name for the purchaseDt field
     */
    const COL_PURCHASEDT = 'employeepurchases.purchaseDt';

    /**
     * the column name for the employeeOid field
     */
    const COL_EMPLOYEEOID = 'employeepurchases.employeeOid';

    /**
     * the column name for the quantity field
     */
    const COL_QUANTITY = 'employeepurchases.quantity';

    /**
     * the column name for the productUnitType field
     */
    const COL_PRODUCTUNITTYPE = 'employeepurchases.productUnitType';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'employeepurchases.description';

    /**
     * the column name for the unitPrice field
     */
    const COL_UNITPRICE = 'employeepurchases.unitPrice';

    /**
     * the column name for the lineOfBusinessOid field
     */
    const COL_LINEOFBUSINESSOID = 'employeepurchases.lineOfBusinessOid';

    /**
     * the column name for the paidFlg field
     */
    const COL_PAIDFLG = 'employeepurchases.paidFlg';

    /**
     * the column name for the payslipNbr field
     */
    const COL_PAYSLIPNBR = 'employeepurchases.payslipNbr';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'employeepurchases.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'employeepurchases.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Purchasedt', 'Employeeoid', 'Quantity', 'Productunittype', 'Description', 'Unitprice', 'Lineofbusinessoid', 'Paidflg', 'Payslipnbr', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'purchasedt', 'employeeoid', 'quantity', 'productunittype', 'description', 'unitprice', 'lineofbusinessoid', 'paidflg', 'payslipnbr', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(EmployeepurchasesTableMap::COL_OID, EmployeepurchasesTableMap::COL_PURCHASEDT, EmployeepurchasesTableMap::COL_EMPLOYEEOID, EmployeepurchasesTableMap::COL_QUANTITY, EmployeepurchasesTableMap::COL_PRODUCTUNITTYPE, EmployeepurchasesTableMap::COL_DESCRIPTION, EmployeepurchasesTableMap::COL_UNITPRICE, EmployeepurchasesTableMap::COL_LINEOFBUSINESSOID, EmployeepurchasesTableMap::COL_PAIDFLG, EmployeepurchasesTableMap::COL_PAYSLIPNBR, EmployeepurchasesTableMap::COL_CREATETMSTP, EmployeepurchasesTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'purchaseDt', 'employeeOid', 'quantity', 'productUnitType', 'description', 'unitPrice', 'lineOfBusinessOid', 'paidFlg', 'payslipNbr', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Purchasedt' => 1, 'Employeeoid' => 2, 'Quantity' => 3, 'Productunittype' => 4, 'Description' => 5, 'Unitprice' => 6, 'Lineofbusinessoid' => 7, 'Paidflg' => 8, 'Payslipnbr' => 9, 'Createtmstp' => 10, 'Updttmstp' => 11, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'purchasedt' => 1, 'employeeoid' => 2, 'quantity' => 3, 'productunittype' => 4, 'description' => 5, 'unitprice' => 6, 'lineofbusinessoid' => 7, 'paidflg' => 8, 'payslipnbr' => 9, 'createtmstp' => 10, 'updttmstp' => 11, ),
        self::TYPE_COLNAME       => array(EmployeepurchasesTableMap::COL_OID => 0, EmployeepurchasesTableMap::COL_PURCHASEDT => 1, EmployeepurchasesTableMap::COL_EMPLOYEEOID => 2, EmployeepurchasesTableMap::COL_QUANTITY => 3, EmployeepurchasesTableMap::COL_PRODUCTUNITTYPE => 4, EmployeepurchasesTableMap::COL_DESCRIPTION => 5, EmployeepurchasesTableMap::COL_UNITPRICE => 6, EmployeepurchasesTableMap::COL_LINEOFBUSINESSOID => 7, EmployeepurchasesTableMap::COL_PAIDFLG => 8, EmployeepurchasesTableMap::COL_PAYSLIPNBR => 9, EmployeepurchasesTableMap::COL_CREATETMSTP => 10, EmployeepurchasesTableMap::COL_UPDTTMSTP => 11, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'purchaseDt' => 1, 'employeeOid' => 2, 'quantity' => 3, 'productUnitType' => 4, 'description' => 5, 'unitPrice' => 6, 'lineOfBusinessOid' => 7, 'paidFlg' => 8, 'payslipNbr' => 9, 'createTmstp' => 10, 'updtTmstp' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
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
        $this->setName('employeepurchases');
        $this->setPhpName('Employeepurchases');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Employeepurchases');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addColumn('purchaseDt', 'Purchasedt', 'TIMESTAMP', true, null, null);
        $this->addForeignKey('employeeOid', 'Employeeoid', 'INTEGER', 'employee', 'oid', true, null, null);
        $this->addColumn('quantity', 'Quantity', 'INTEGER', true, null, 0);
        $this->addForeignKey('productUnitType', 'Productunittype', 'CHAR', 'productunit', 'unit', true, 2, null);
        $this->addColumn('description', 'Description', 'VARCHAR', true, 128, null);
        $this->addColumn('unitPrice', 'Unitprice', 'FLOAT', true, null, 0);
        $this->addForeignKey('lineOfBusinessOid', 'Lineofbusinessoid', 'INTEGER', 'lineofbusiness', 'oid', true, null, 6);
        $this->addColumn('paidFlg', 'Paidflg', 'TINYINT', true, null, 0);
        $this->addColumn('payslipNbr', 'Payslipnbr', 'VARCHAR', false, 45, null);
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
        $this->addRelation('Lineofbusiness', '\\lwops\\lwops\\Lineofbusiness', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':lineOfBusinessOid',
    1 => ':oid',
  ),
), null, null, null, false);
        $this->addRelation('Productunit', '\\lwops\\lwops\\Productunit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':productUnitType',
    1 => ':unit',
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
        return $withPrefix ? EmployeepurchasesTableMap::CLASS_DEFAULT : EmployeepurchasesTableMap::OM_CLASS;
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
     * @return array           (Employeepurchases object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EmployeepurchasesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmployeepurchasesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmployeepurchasesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmployeepurchasesTableMap::OM_CLASS;
            /** @var Employeepurchases $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmployeepurchasesTableMap::addInstanceToPool($obj, $key);
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
            $key = EmployeepurchasesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmployeepurchasesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Employeepurchases $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmployeepurchasesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmployeepurchasesTableMap::COL_OID);
            $criteria->addSelectColumn(EmployeepurchasesTableMap::COL_PURCHASEDT);
            $criteria->addSelectColumn(EmployeepurchasesTableMap::COL_EMPLOYEEOID);
            $criteria->addSelectColumn(EmployeepurchasesTableMap::COL_QUANTITY);
            $criteria->addSelectColumn(EmployeepurchasesTableMap::COL_PRODUCTUNITTYPE);
            $criteria->addSelectColumn(EmployeepurchasesTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(EmployeepurchasesTableMap::COL_UNITPRICE);
            $criteria->addSelectColumn(EmployeepurchasesTableMap::COL_LINEOFBUSINESSOID);
            $criteria->addSelectColumn(EmployeepurchasesTableMap::COL_PAIDFLG);
            $criteria->addSelectColumn(EmployeepurchasesTableMap::COL_PAYSLIPNBR);
            $criteria->addSelectColumn(EmployeepurchasesTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(EmployeepurchasesTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.purchaseDt');
            $criteria->addSelectColumn($alias . '.employeeOid');
            $criteria->addSelectColumn($alias . '.quantity');
            $criteria->addSelectColumn($alias . '.productUnitType');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.unitPrice');
            $criteria->addSelectColumn($alias . '.lineOfBusinessOid');
            $criteria->addSelectColumn($alias . '.paidFlg');
            $criteria->addSelectColumn($alias . '.payslipNbr');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmployeepurchasesTableMap::DATABASE_NAME)->getTable(EmployeepurchasesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EmployeepurchasesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EmployeepurchasesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EmployeepurchasesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Employeepurchases or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Employeepurchases object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeepurchasesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Employeepurchases) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmployeepurchasesTableMap::DATABASE_NAME);
            $criteria->add(EmployeepurchasesTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = EmployeepurchasesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmployeepurchasesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmployeepurchasesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the employeepurchases table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EmployeepurchasesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Employeepurchases or Criteria object.
     *
     * @param mixed               $criteria Criteria or Employeepurchases object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeepurchasesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Employeepurchases object
        }

        if ($criteria->containsKey(EmployeepurchasesTableMap::COL_OID) && $criteria->keyContainsValue(EmployeepurchasesTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmployeepurchasesTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = EmployeepurchasesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EmployeepurchasesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EmployeepurchasesTableMap::buildTableMap();
