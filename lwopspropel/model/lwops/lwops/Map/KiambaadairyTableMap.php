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
use lwops\lwops\Kiambaadairy;
use lwops\lwops\KiambaadairyQuery;


/**
 * This class defines the structure of the 'kiambaadairy' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class KiambaadairyTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.KiambaadairyTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'kiambaadairy';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Kiambaadairy';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Kiambaadairy';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'kiambaadairy.oid';

    /**
     * the column name for the opsMonthlyCalendaOid field
     */
    const COL_OPSMONTHLYCALENDAOID = 'kiambaadairy.opsMonthlyCalendaOid';

    /**
     * the column name for the societyShares field
     */
    const COL_SOCIETYSHARES = 'kiambaadairy.societyShares';

    /**
     * the column name for the packingShares field
     */
    const COL_PACKINGSHARES = 'kiambaadairy.packingShares';

    /**
     * the column name for the feedExpense field
     */
    const COL_FEEDEXPENSE = 'kiambaadairy.feedExpense';

    /**
     * the column name for the totalDeductions field
     */
    const COL_TOTALDEDUCTIONS = 'kiambaadairy.totalDeductions';

    /**
     * the column name for the rate field
     */
    const COL_RATE = 'kiambaadairy.rate';

    /**
     * the column name for the deliveredQty field
     */
    const COL_DELIVEREDQTY = 'kiambaadairy.deliveredQty';

    /**
     * the column name for the rejectedQty field
     */
    const COL_REJECTEDQTY = 'kiambaadairy.rejectedQty';

    /**
     * the column name for the acceptedQty field
     */
    const COL_ACCEPTEDQTY = 'kiambaadairy.acceptedQty';

    /**
     * the column name for the grossPay field
     */
    const COL_GROSSPAY = 'kiambaadairy.grossPay';

    /**
     * the column name for the netPay field
     */
    const COL_NETPAY = 'kiambaadairy.netPay';

    /**
     * the column name for the society field
     */
    const COL_SOCIETY = 'kiambaadairy.society';

    /**
     * the column name for the packing field
     */
    const COL_PACKING = 'kiambaadairy.packing';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'kiambaadairy.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'kiambaadairy.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Opsmonthlycalendaoid', 'Societyshares', 'Packingshares', 'Feedexpense', 'Totaldeductions', 'Rate', 'Deliveredqty', 'Rejectedqty', 'Acceptedqty', 'Grosspay', 'Netpay', 'Society', 'Packing', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'opsmonthlycalendaoid', 'societyshares', 'packingshares', 'feedexpense', 'totaldeductions', 'rate', 'deliveredqty', 'rejectedqty', 'acceptedqty', 'grosspay', 'netpay', 'society', 'packing', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(KiambaadairyTableMap::COL_OID, KiambaadairyTableMap::COL_OPSMONTHLYCALENDAOID, KiambaadairyTableMap::COL_SOCIETYSHARES, KiambaadairyTableMap::COL_PACKINGSHARES, KiambaadairyTableMap::COL_FEEDEXPENSE, KiambaadairyTableMap::COL_TOTALDEDUCTIONS, KiambaadairyTableMap::COL_RATE, KiambaadairyTableMap::COL_DELIVEREDQTY, KiambaadairyTableMap::COL_REJECTEDQTY, KiambaadairyTableMap::COL_ACCEPTEDQTY, KiambaadairyTableMap::COL_GROSSPAY, KiambaadairyTableMap::COL_NETPAY, KiambaadairyTableMap::COL_SOCIETY, KiambaadairyTableMap::COL_PACKING, KiambaadairyTableMap::COL_CREATETMSTP, KiambaadairyTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'opsMonthlyCalendaOid', 'societyShares', 'packingShares', 'feedExpense', 'totalDeductions', 'rate', 'deliveredQty', 'rejectedQty', 'acceptedQty', 'grossPay', 'netPay', 'society', 'packing', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Opsmonthlycalendaoid' => 1, 'Societyshares' => 2, 'Packingshares' => 3, 'Feedexpense' => 4, 'Totaldeductions' => 5, 'Rate' => 6, 'Deliveredqty' => 7, 'Rejectedqty' => 8, 'Acceptedqty' => 9, 'Grosspay' => 10, 'Netpay' => 11, 'Society' => 12, 'Packing' => 13, 'Createtmstp' => 14, 'Updttmstp' => 15, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'opsmonthlycalendaoid' => 1, 'societyshares' => 2, 'packingshares' => 3, 'feedexpense' => 4, 'totaldeductions' => 5, 'rate' => 6, 'deliveredqty' => 7, 'rejectedqty' => 8, 'acceptedqty' => 9, 'grosspay' => 10, 'netpay' => 11, 'society' => 12, 'packing' => 13, 'createtmstp' => 14, 'updttmstp' => 15, ),
        self::TYPE_COLNAME       => array(KiambaadairyTableMap::COL_OID => 0, KiambaadairyTableMap::COL_OPSMONTHLYCALENDAOID => 1, KiambaadairyTableMap::COL_SOCIETYSHARES => 2, KiambaadairyTableMap::COL_PACKINGSHARES => 3, KiambaadairyTableMap::COL_FEEDEXPENSE => 4, KiambaadairyTableMap::COL_TOTALDEDUCTIONS => 5, KiambaadairyTableMap::COL_RATE => 6, KiambaadairyTableMap::COL_DELIVEREDQTY => 7, KiambaadairyTableMap::COL_REJECTEDQTY => 8, KiambaadairyTableMap::COL_ACCEPTEDQTY => 9, KiambaadairyTableMap::COL_GROSSPAY => 10, KiambaadairyTableMap::COL_NETPAY => 11, KiambaadairyTableMap::COL_SOCIETY => 12, KiambaadairyTableMap::COL_PACKING => 13, KiambaadairyTableMap::COL_CREATETMSTP => 14, KiambaadairyTableMap::COL_UPDTTMSTP => 15, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'opsMonthlyCalendaOid' => 1, 'societyShares' => 2, 'packingShares' => 3, 'feedExpense' => 4, 'totalDeductions' => 5, 'rate' => 6, 'deliveredQty' => 7, 'rejectedQty' => 8, 'acceptedQty' => 9, 'grossPay' => 10, 'netPay' => 11, 'society' => 12, 'packing' => 13, 'createTmstp' => 14, 'updtTmstp' => 15, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
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
        $this->setName('kiambaadairy');
        $this->setPhpName('Kiambaadairy');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Kiambaadairy');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addForeignKey('opsMonthlyCalendaOid', 'Opsmonthlycalendaoid', 'INTEGER', 'opsmonthlycalendar', 'oid', true, null, null);
        $this->addColumn('societyShares', 'Societyshares', 'FLOAT', true, null, 0);
        $this->addColumn('packingShares', 'Packingshares', 'FLOAT', true, null, 0);
        $this->addColumn('feedExpense', 'Feedexpense', 'FLOAT', true, null, 0);
        $this->addColumn('totalDeductions', 'Totaldeductions', 'FLOAT', true, null, 0);
        $this->addColumn('rate', 'Rate', 'FLOAT', true, null, 0);
        $this->addColumn('deliveredQty', 'Deliveredqty', 'FLOAT', true, null, 0);
        $this->addColumn('rejectedQty', 'Rejectedqty', 'FLOAT', true, null, 0);
        $this->addColumn('acceptedQty', 'Acceptedqty', 'FLOAT', true, null, 0);
        $this->addColumn('grossPay', 'Grosspay', 'FLOAT', true, null, 0);
        $this->addColumn('netPay', 'Netpay', 'FLOAT', true, null, 0);
        $this->addColumn('society', 'Society', 'INTEGER', true, null, 0);
        $this->addColumn('packing', 'Packing', 'INTEGER', true, null, 0);
        $this->addColumn('createTmstp', 'Createtmstp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updtTmstp', 'Updttmstp', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Opsmonthlycalendar', '\\lwops\\lwops\\Opsmonthlycalendar', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':opsMonthlyCalendaOid',
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
        return $withPrefix ? KiambaadairyTableMap::CLASS_DEFAULT : KiambaadairyTableMap::OM_CLASS;
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
     * @return array           (Kiambaadairy object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = KiambaadairyTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = KiambaadairyTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + KiambaadairyTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = KiambaadairyTableMap::OM_CLASS;
            /** @var Kiambaadairy $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            KiambaadairyTableMap::addInstanceToPool($obj, $key);
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
            $key = KiambaadairyTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = KiambaadairyTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Kiambaadairy $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                KiambaadairyTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_OID);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_OPSMONTHLYCALENDAOID);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_SOCIETYSHARES);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_PACKINGSHARES);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_FEEDEXPENSE);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_TOTALDEDUCTIONS);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_RATE);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_DELIVEREDQTY);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_REJECTEDQTY);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_ACCEPTEDQTY);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_GROSSPAY);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_NETPAY);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_SOCIETY);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_PACKING);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(KiambaadairyTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.opsMonthlyCalendaOid');
            $criteria->addSelectColumn($alias . '.societyShares');
            $criteria->addSelectColumn($alias . '.packingShares');
            $criteria->addSelectColumn($alias . '.feedExpense');
            $criteria->addSelectColumn($alias . '.totalDeductions');
            $criteria->addSelectColumn($alias . '.rate');
            $criteria->addSelectColumn($alias . '.deliveredQty');
            $criteria->addSelectColumn($alias . '.rejectedQty');
            $criteria->addSelectColumn($alias . '.acceptedQty');
            $criteria->addSelectColumn($alias . '.grossPay');
            $criteria->addSelectColumn($alias . '.netPay');
            $criteria->addSelectColumn($alias . '.society');
            $criteria->addSelectColumn($alias . '.packing');
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
        return Propel::getServiceContainer()->getDatabaseMap(KiambaadairyTableMap::DATABASE_NAME)->getTable(KiambaadairyTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(KiambaadairyTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(KiambaadairyTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new KiambaadairyTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Kiambaadairy or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Kiambaadairy object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(KiambaadairyTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Kiambaadairy) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(KiambaadairyTableMap::DATABASE_NAME);
            $criteria->add(KiambaadairyTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = KiambaadairyQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            KiambaadairyTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                KiambaadairyTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the kiambaadairy table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return KiambaadairyQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Kiambaadairy or Criteria object.
     *
     * @param mixed               $criteria Criteria or Kiambaadairy object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(KiambaadairyTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Kiambaadairy object
        }

        if ($criteria->containsKey(KiambaadairyTableMap::COL_OID) && $criteria->keyContainsValue(KiambaadairyTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.KiambaadairyTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = KiambaadairyQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // KiambaadairyTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
KiambaadairyTableMap::buildTableMap();
