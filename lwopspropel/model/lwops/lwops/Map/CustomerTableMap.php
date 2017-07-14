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
use lwops\lwops\Customer;
use lwops\lwops\CustomerQuery;


/**
 * This class defines the structure of the 'customer' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CustomerTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.CustomerTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'customer';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Customer';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Customer';

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
    const COL_OID = 'customer.oid';

    /**
     * the column name for the gr_id field
     */
    const COL_GR_ID = 'customer.gr_id';

    /**
     * the column name for the businessName field
     */
    const COL_BUSINESSNAME = 'customer.businessName';

    /**
     * the column name for the storeNameNbr field
     */
    const COL_STORENAMENBR = 'customer.storeNameNbr';

    /**
     * the column name for the contactFirstName field
     */
    const COL_CONTACTFIRSTNAME = 'customer.contactFirstName';

    /**
     * the column name for the contactLastName field
     */
    const COL_CONTACTLASTNAME = 'customer.contactLastName';

    /**
     * the column name for the mobileNbr field
     */
    const COL_MOBILENBR = 'customer.mobileNbr';

    /**
     * the column name for the address1 field
     */
    const COL_ADDRESS1 = 'customer.address1';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'customer.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'customer.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'GrId', 'Businessname', 'Storenamenbr', 'Contactfirstname', 'Contactlastname', 'Mobilenbr', 'Address1', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'grId', 'businessname', 'storenamenbr', 'contactfirstname', 'contactlastname', 'mobilenbr', 'address1', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(CustomerTableMap::COL_OID, CustomerTableMap::COL_GR_ID, CustomerTableMap::COL_BUSINESSNAME, CustomerTableMap::COL_STORENAMENBR, CustomerTableMap::COL_CONTACTFIRSTNAME, CustomerTableMap::COL_CONTACTLASTNAME, CustomerTableMap::COL_MOBILENBR, CustomerTableMap::COL_ADDRESS1, CustomerTableMap::COL_CREATETMSTP, CustomerTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'gr_id', 'businessName', 'storeNameNbr', 'contactFirstName', 'contactLastName', 'mobileNbr', 'address1', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'GrId' => 1, 'Businessname' => 2, 'Storenamenbr' => 3, 'Contactfirstname' => 4, 'Contactlastname' => 5, 'Mobilenbr' => 6, 'Address1' => 7, 'Createtmstp' => 8, 'Updttmstp' => 9, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'grId' => 1, 'businessname' => 2, 'storenamenbr' => 3, 'contactfirstname' => 4, 'contactlastname' => 5, 'mobilenbr' => 6, 'address1' => 7, 'createtmstp' => 8, 'updttmstp' => 9, ),
        self::TYPE_COLNAME       => array(CustomerTableMap::COL_OID => 0, CustomerTableMap::COL_GR_ID => 1, CustomerTableMap::COL_BUSINESSNAME => 2, CustomerTableMap::COL_STORENAMENBR => 3, CustomerTableMap::COL_CONTACTFIRSTNAME => 4, CustomerTableMap::COL_CONTACTLASTNAME => 5, CustomerTableMap::COL_MOBILENBR => 6, CustomerTableMap::COL_ADDRESS1 => 7, CustomerTableMap::COL_CREATETMSTP => 8, CustomerTableMap::COL_UPDTTMSTP => 9, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'gr_id' => 1, 'businessName' => 2, 'storeNameNbr' => 3, 'contactFirstName' => 4, 'contactLastName' => 5, 'mobileNbr' => 6, 'address1' => 7, 'createTmstp' => 8, 'updtTmstp' => 9, ),
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
        $this->setName('customer');
        $this->setPhpName('Customer');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Customer');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addColumn('gr_id', 'GrId', 'VARCHAR', true, 255, null);
        $this->addColumn('businessName', 'Businessname', 'VARCHAR', true, 100, 'INDIVIDUAL');
        $this->addColumn('storeNameNbr', 'Storenamenbr', 'VARCHAR', true, 10, '00000');
        $this->addColumn('contactFirstName', 'Contactfirstname', 'VARCHAR', true, 20, null);
        $this->addColumn('contactLastName', 'Contactlastname', 'VARCHAR', true, 20, null);
        $this->addColumn('mobileNbr', 'Mobilenbr', 'VARCHAR', true, 10, '0725551212');
        $this->addColumn('address1', 'Address1', 'VARCHAR', true, 100, 'TBD');
        $this->addColumn('createTmstp', 'Createtmstp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updtTmstp', 'Updttmstp', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Dairysales', '\\lwops\\lwops\\Dairysales', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':customerOid',
    1 => ':oid',
  ),
), null, null, 'Dairysaless', false);
        $this->addRelation('Fishsales', '\\lwops\\lwops\\Fishsales', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':customerOid',
    1 => ':oid',
  ),
), null, null, 'Fishsaless', false);
        $this->addRelation('Horticulturesales', '\\lwops\\lwops\\Horticulturesales', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':customerOid',
    1 => ':oid',
  ),
), null, null, 'Horticulturesaless', false);
        $this->addRelation('Mushroomsales', '\\lwops\\lwops\\Mushroomsales', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':customerOid',
    1 => ':oid',
  ),
), null, null, 'Mushroomsaless', false);
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
        return $withPrefix ? CustomerTableMap::CLASS_DEFAULT : CustomerTableMap::OM_CLASS;
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
     * @return array           (Customer object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CustomerTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CustomerTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CustomerTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CustomerTableMap::OM_CLASS;
            /** @var Customer $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CustomerTableMap::addInstanceToPool($obj, $key);
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
            $key = CustomerTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CustomerTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Customer $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CustomerTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CustomerTableMap::COL_OID);
            $criteria->addSelectColumn(CustomerTableMap::COL_GR_ID);
            $criteria->addSelectColumn(CustomerTableMap::COL_BUSINESSNAME);
            $criteria->addSelectColumn(CustomerTableMap::COL_STORENAMENBR);
            $criteria->addSelectColumn(CustomerTableMap::COL_CONTACTFIRSTNAME);
            $criteria->addSelectColumn(CustomerTableMap::COL_CONTACTLASTNAME);
            $criteria->addSelectColumn(CustomerTableMap::COL_MOBILENBR);
            $criteria->addSelectColumn(CustomerTableMap::COL_ADDRESS1);
            $criteria->addSelectColumn(CustomerTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(CustomerTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.gr_id');
            $criteria->addSelectColumn($alias . '.businessName');
            $criteria->addSelectColumn($alias . '.storeNameNbr');
            $criteria->addSelectColumn($alias . '.contactFirstName');
            $criteria->addSelectColumn($alias . '.contactLastName');
            $criteria->addSelectColumn($alias . '.mobileNbr');
            $criteria->addSelectColumn($alias . '.address1');
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
        return Propel::getServiceContainer()->getDatabaseMap(CustomerTableMap::DATABASE_NAME)->getTable(CustomerTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CustomerTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CustomerTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CustomerTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Customer or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Customer object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CustomerTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Customer) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CustomerTableMap::DATABASE_NAME);
            $criteria->add(CustomerTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = CustomerQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CustomerTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CustomerTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the customer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CustomerQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Customer or Criteria object.
     *
     * @param mixed               $criteria Criteria or Customer object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomerTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Customer object
        }

        if ($criteria->containsKey(CustomerTableMap::COL_OID) && $criteria->keyContainsValue(CustomerTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CustomerTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = CustomerQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CustomerTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CustomerTableMap::buildTableMap();
