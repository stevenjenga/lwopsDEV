<?php

namespace lwops\lwops\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use lwops\lwops\Customer as ChildCustomer;
use lwops\lwops\CustomerQuery as ChildCustomerQuery;
use lwops\lwops\Map\CustomerTableMap;

/**
 * Base class that represents a query for the 'customer' table.
 *
 *
 *
 * @method     ChildCustomerQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildCustomerQuery orderByGrId($order = Criteria::ASC) Order by the gr_id column
 * @method     ChildCustomerQuery orderByBusinessname($order = Criteria::ASC) Order by the businessName column
 * @method     ChildCustomerQuery orderByStorenamenbr($order = Criteria::ASC) Order by the storeNameNbr column
 * @method     ChildCustomerQuery orderByContactfirstname($order = Criteria::ASC) Order by the contactFirstName column
 * @method     ChildCustomerQuery orderByContactlastname($order = Criteria::ASC) Order by the contactLastName column
 * @method     ChildCustomerQuery orderByMobilenbr($order = Criteria::ASC) Order by the mobileNbr column
 * @method     ChildCustomerQuery orderByAddress1($order = Criteria::ASC) Order by the address1 column
 * @method     ChildCustomerQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildCustomerQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildCustomerQuery groupByOid() Group by the oid column
 * @method     ChildCustomerQuery groupByGrId() Group by the gr_id column
 * @method     ChildCustomerQuery groupByBusinessname() Group by the businessName column
 * @method     ChildCustomerQuery groupByStorenamenbr() Group by the storeNameNbr column
 * @method     ChildCustomerQuery groupByContactfirstname() Group by the contactFirstName column
 * @method     ChildCustomerQuery groupByContactlastname() Group by the contactLastName column
 * @method     ChildCustomerQuery groupByMobilenbr() Group by the mobileNbr column
 * @method     ChildCustomerQuery groupByAddress1() Group by the address1 column
 * @method     ChildCustomerQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildCustomerQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildCustomerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCustomerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCustomerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCustomerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCustomerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCustomerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCustomerQuery leftJoinDairysales($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dairysales relation
 * @method     ChildCustomerQuery rightJoinDairysales($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dairysales relation
 * @method     ChildCustomerQuery innerJoinDairysales($relationAlias = null) Adds a INNER JOIN clause to the query using the Dairysales relation
 *
 * @method     ChildCustomerQuery joinWithDairysales($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dairysales relation
 *
 * @method     ChildCustomerQuery leftJoinWithDairysales() Adds a LEFT JOIN clause and with to the query using the Dairysales relation
 * @method     ChildCustomerQuery rightJoinWithDairysales() Adds a RIGHT JOIN clause and with to the query using the Dairysales relation
 * @method     ChildCustomerQuery innerJoinWithDairysales() Adds a INNER JOIN clause and with to the query using the Dairysales relation
 *
 * @method     ChildCustomerQuery leftJoinFishsales($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fishsales relation
 * @method     ChildCustomerQuery rightJoinFishsales($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fishsales relation
 * @method     ChildCustomerQuery innerJoinFishsales($relationAlias = null) Adds a INNER JOIN clause to the query using the Fishsales relation
 *
 * @method     ChildCustomerQuery joinWithFishsales($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fishsales relation
 *
 * @method     ChildCustomerQuery leftJoinWithFishsales() Adds a LEFT JOIN clause and with to the query using the Fishsales relation
 * @method     ChildCustomerQuery rightJoinWithFishsales() Adds a RIGHT JOIN clause and with to the query using the Fishsales relation
 * @method     ChildCustomerQuery innerJoinWithFishsales() Adds a INNER JOIN clause and with to the query using the Fishsales relation
 *
 * @method     ChildCustomerQuery leftJoinHorticulturesales($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticulturesales relation
 * @method     ChildCustomerQuery rightJoinHorticulturesales($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticulturesales relation
 * @method     ChildCustomerQuery innerJoinHorticulturesales($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticulturesales relation
 *
 * @method     ChildCustomerQuery joinWithHorticulturesales($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticulturesales relation
 *
 * @method     ChildCustomerQuery leftJoinWithHorticulturesales() Adds a LEFT JOIN clause and with to the query using the Horticulturesales relation
 * @method     ChildCustomerQuery rightJoinWithHorticulturesales() Adds a RIGHT JOIN clause and with to the query using the Horticulturesales relation
 * @method     ChildCustomerQuery innerJoinWithHorticulturesales() Adds a INNER JOIN clause and with to the query using the Horticulturesales relation
 *
 * @method     ChildCustomerQuery leftJoinMushroomsales($relationAlias = null) Adds a LEFT JOIN clause to the query using the Mushroomsales relation
 * @method     ChildCustomerQuery rightJoinMushroomsales($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Mushroomsales relation
 * @method     ChildCustomerQuery innerJoinMushroomsales($relationAlias = null) Adds a INNER JOIN clause to the query using the Mushroomsales relation
 *
 * @method     ChildCustomerQuery joinWithMushroomsales($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Mushroomsales relation
 *
 * @method     ChildCustomerQuery leftJoinWithMushroomsales() Adds a LEFT JOIN clause and with to the query using the Mushroomsales relation
 * @method     ChildCustomerQuery rightJoinWithMushroomsales() Adds a RIGHT JOIN clause and with to the query using the Mushroomsales relation
 * @method     ChildCustomerQuery innerJoinWithMushroomsales() Adds a INNER JOIN clause and with to the query using the Mushroomsales relation
 *
 * @method     \lwops\lwops\DairysalesQuery|\lwops\lwops\FishsalesQuery|\lwops\lwops\HorticulturesalesQuery|\lwops\lwops\MushroomsalesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCustomer findOne(ConnectionInterface $con = null) Return the first ChildCustomer matching the query
 * @method     ChildCustomer findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCustomer matching the query, or a new ChildCustomer object populated from the query conditions when no match is found
 *
 * @method     ChildCustomer findOneByOid(int $oid) Return the first ChildCustomer filtered by the oid column
 * @method     ChildCustomer findOneByGrId(string $gr_id) Return the first ChildCustomer filtered by the gr_id column
 * @method     ChildCustomer findOneByBusinessname(string $businessName) Return the first ChildCustomer filtered by the businessName column
 * @method     ChildCustomer findOneByStorenamenbr(string $storeNameNbr) Return the first ChildCustomer filtered by the storeNameNbr column
 * @method     ChildCustomer findOneByContactfirstname(string $contactFirstName) Return the first ChildCustomer filtered by the contactFirstName column
 * @method     ChildCustomer findOneByContactlastname(string $contactLastName) Return the first ChildCustomer filtered by the contactLastName column
 * @method     ChildCustomer findOneByMobilenbr(string $mobileNbr) Return the first ChildCustomer filtered by the mobileNbr column
 * @method     ChildCustomer findOneByAddress1(string $address1) Return the first ChildCustomer filtered by the address1 column
 * @method     ChildCustomer findOneByCreatetmstp(string $createTmstp) Return the first ChildCustomer filtered by the createTmstp column
 * @method     ChildCustomer findOneByUpdttmstp(string $updtTmstp) Return the first ChildCustomer filtered by the updtTmstp column *

 * @method     ChildCustomer requirePk($key, ConnectionInterface $con = null) Return the ChildCustomer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOne(ConnectionInterface $con = null) Return the first ChildCustomer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCustomer requireOneByOid(int $oid) Return the first ChildCustomer filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByGrId(string $gr_id) Return the first ChildCustomer filtered by the gr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByBusinessname(string $businessName) Return the first ChildCustomer filtered by the businessName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByStorenamenbr(string $storeNameNbr) Return the first ChildCustomer filtered by the storeNameNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByContactfirstname(string $contactFirstName) Return the first ChildCustomer filtered by the contactFirstName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByContactlastname(string $contactLastName) Return the first ChildCustomer filtered by the contactLastName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByMobilenbr(string $mobileNbr) Return the first ChildCustomer filtered by the mobileNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByAddress1(string $address1) Return the first ChildCustomer filtered by the address1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByCreatetmstp(string $createTmstp) Return the first ChildCustomer filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByUpdttmstp(string $updtTmstp) Return the first ChildCustomer filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCustomer[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCustomer objects based on current ModelCriteria
 * @method     ChildCustomer[]|ObjectCollection findByOid(int $oid) Return ChildCustomer objects filtered by the oid column
 * @method     ChildCustomer[]|ObjectCollection findByGrId(string $gr_id) Return ChildCustomer objects filtered by the gr_id column
 * @method     ChildCustomer[]|ObjectCollection findByBusinessname(string $businessName) Return ChildCustomer objects filtered by the businessName column
 * @method     ChildCustomer[]|ObjectCollection findByStorenamenbr(string $storeNameNbr) Return ChildCustomer objects filtered by the storeNameNbr column
 * @method     ChildCustomer[]|ObjectCollection findByContactfirstname(string $contactFirstName) Return ChildCustomer objects filtered by the contactFirstName column
 * @method     ChildCustomer[]|ObjectCollection findByContactlastname(string $contactLastName) Return ChildCustomer objects filtered by the contactLastName column
 * @method     ChildCustomer[]|ObjectCollection findByMobilenbr(string $mobileNbr) Return ChildCustomer objects filtered by the mobileNbr column
 * @method     ChildCustomer[]|ObjectCollection findByAddress1(string $address1) Return ChildCustomer objects filtered by the address1 column
 * @method     ChildCustomer[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildCustomer objects filtered by the createTmstp column
 * @method     ChildCustomer[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildCustomer objects filtered by the updtTmstp column
 * @method     ChildCustomer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CustomerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\CustomerQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Customer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCustomerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCustomerQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCustomerQuery) {
            return $criteria;
        }
        $query = new ChildCustomerQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCustomer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CustomerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CustomerTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCustomer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, gr_id, businessName, storeNameNbr, contactFirstName, contactLastName, mobileNbr, address1, createTmstp, updtTmstp FROM customer WHERE oid = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCustomer $obj */
            $obj = new ChildCustomer();
            $obj->hydrate($row);
            CustomerTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildCustomer|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CustomerTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CustomerTableMap::COL_OID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the oid column
     *
     * Example usage:
     * <code>
     * $query->filterByOid(1234); // WHERE oid = 1234
     * $query->filterByOid(array(12, 34)); // WHERE oid IN (12, 34)
     * $query->filterByOid(array('min' => 12)); // WHERE oid > 12
     * </code>
     *
     * @param     mixed $oid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(CustomerTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(CustomerTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the gr_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGrId('fooValue');   // WHERE gr_id = 'fooValue'
     * $query->filterByGrId('%fooValue%', Criteria::LIKE); // WHERE gr_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $grId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByGrId($grId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($grId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_GR_ID, $grId, $comparison);
    }

    /**
     * Filter the query on the businessName column
     *
     * Example usage:
     * <code>
     * $query->filterByBusinessname('fooValue');   // WHERE businessName = 'fooValue'
     * $query->filterByBusinessname('%fooValue%', Criteria::LIKE); // WHERE businessName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $businessname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByBusinessname($businessname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($businessname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_BUSINESSNAME, $businessname, $comparison);
    }

    /**
     * Filter the query on the storeNameNbr column
     *
     * Example usage:
     * <code>
     * $query->filterByStorenamenbr('fooValue');   // WHERE storeNameNbr = 'fooValue'
     * $query->filterByStorenamenbr('%fooValue%', Criteria::LIKE); // WHERE storeNameNbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $storenamenbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByStorenamenbr($storenamenbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($storenamenbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_STORENAMENBR, $storenamenbr, $comparison);
    }

    /**
     * Filter the query on the contactFirstName column
     *
     * Example usage:
     * <code>
     * $query->filterByContactfirstname('fooValue');   // WHERE contactFirstName = 'fooValue'
     * $query->filterByContactfirstname('%fooValue%', Criteria::LIKE); // WHERE contactFirstName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contactfirstname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByContactfirstname($contactfirstname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contactfirstname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_CONTACTFIRSTNAME, $contactfirstname, $comparison);
    }

    /**
     * Filter the query on the contactLastName column
     *
     * Example usage:
     * <code>
     * $query->filterByContactlastname('fooValue');   // WHERE contactLastName = 'fooValue'
     * $query->filterByContactlastname('%fooValue%', Criteria::LIKE); // WHERE contactLastName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contactlastname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByContactlastname($contactlastname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contactlastname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_CONTACTLASTNAME, $contactlastname, $comparison);
    }

    /**
     * Filter the query on the mobileNbr column
     *
     * Example usage:
     * <code>
     * $query->filterByMobilenbr('fooValue');   // WHERE mobileNbr = 'fooValue'
     * $query->filterByMobilenbr('%fooValue%', Criteria::LIKE); // WHERE mobileNbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mobilenbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByMobilenbr($mobilenbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mobilenbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_MOBILENBR, $mobilenbr, $comparison);
    }

    /**
     * Filter the query on the address1 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress1('fooValue');   // WHERE address1 = 'fooValue'
     * $query->filterByAddress1('%fooValue%', Criteria::LIKE); // WHERE address1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address1 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByAddress1($address1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address1)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_ADDRESS1, $address1, $comparison);
    }

    /**
     * Filter the query on the createTmstp column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatetmstp('2011-03-14'); // WHERE createTmstp = '2011-03-14'
     * $query->filterByCreatetmstp('now'); // WHERE createTmstp = '2011-03-14'
     * $query->filterByCreatetmstp(array('max' => 'yesterday')); // WHERE createTmstp > '2011-03-13'
     * </code>
     *
     * @param     mixed $createtmstp The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(CustomerTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(CustomerTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
    }

    /**
     * Filter the query on the updtTmstp column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdttmstp('2011-03-14'); // WHERE updtTmstp = '2011-03-14'
     * $query->filterByUpdttmstp('now'); // WHERE updtTmstp = '2011-03-14'
     * $query->filterByUpdttmstp(array('max' => 'yesterday')); // WHERE updtTmstp > '2011-03-13'
     * </code>
     *
     * @param     mixed $updttmstp The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(CustomerTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(CustomerTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Dairysales object
     *
     * @param \lwops\lwops\Dairysales|ObjectCollection $dairysales the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByDairysales($dairysales, $comparison = null)
    {
        if ($dairysales instanceof \lwops\lwops\Dairysales) {
            return $this
                ->addUsingAlias(CustomerTableMap::COL_OID, $dairysales->getCustomeroid(), $comparison);
        } elseif ($dairysales instanceof ObjectCollection) {
            return $this
                ->useDairysalesQuery()
                ->filterByPrimaryKeys($dairysales->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDairysales() only accepts arguments of type \lwops\lwops\Dairysales or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dairysales relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function joinDairysales($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dairysales');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Dairysales');
        }

        return $this;
    }

    /**
     * Use the Dairysales relation Dairysales object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\DairysalesQuery A secondary query class using the current class as primary query
     */
    public function useDairysalesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDairysales($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dairysales', '\lwops\lwops\DairysalesQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Fishsales object
     *
     * @param \lwops\lwops\Fishsales|ObjectCollection $fishsales the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByFishsales($fishsales, $comparison = null)
    {
        if ($fishsales instanceof \lwops\lwops\Fishsales) {
            return $this
                ->addUsingAlias(CustomerTableMap::COL_OID, $fishsales->getCustomeroid(), $comparison);
        } elseif ($fishsales instanceof ObjectCollection) {
            return $this
                ->useFishsalesQuery()
                ->filterByPrimaryKeys($fishsales->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFishsales() only accepts arguments of type \lwops\lwops\Fishsales or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fishsales relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function joinFishsales($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fishsales');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Fishsales');
        }

        return $this;
    }

    /**
     * Use the Fishsales relation Fishsales object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\FishsalesQuery A secondary query class using the current class as primary query
     */
    public function useFishsalesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFishsales($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fishsales', '\lwops\lwops\FishsalesQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Horticulturesales object
     *
     * @param \lwops\lwops\Horticulturesales|ObjectCollection $horticulturesales the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByHorticulturesales($horticulturesales, $comparison = null)
    {
        if ($horticulturesales instanceof \lwops\lwops\Horticulturesales) {
            return $this
                ->addUsingAlias(CustomerTableMap::COL_OID, $horticulturesales->getCustomeroid(), $comparison);
        } elseif ($horticulturesales instanceof ObjectCollection) {
            return $this
                ->useHorticulturesalesQuery()
                ->filterByPrimaryKeys($horticulturesales->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByHorticulturesales() only accepts arguments of type \lwops\lwops\Horticulturesales or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Horticulturesales relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function joinHorticulturesales($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Horticulturesales');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Horticulturesales');
        }

        return $this;
    }

    /**
     * Use the Horticulturesales relation Horticulturesales object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\HorticulturesalesQuery A secondary query class using the current class as primary query
     */
    public function useHorticulturesalesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHorticulturesales($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Horticulturesales', '\lwops\lwops\HorticulturesalesQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Mushroomsales object
     *
     * @param \lwops\lwops\Mushroomsales|ObjectCollection $mushroomsales the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByMushroomsales($mushroomsales, $comparison = null)
    {
        if ($mushroomsales instanceof \lwops\lwops\Mushroomsales) {
            return $this
                ->addUsingAlias(CustomerTableMap::COL_OID, $mushroomsales->getCustomeroid(), $comparison);
        } elseif ($mushroomsales instanceof ObjectCollection) {
            return $this
                ->useMushroomsalesQuery()
                ->filterByPrimaryKeys($mushroomsales->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMushroomsales() only accepts arguments of type \lwops\lwops\Mushroomsales or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Mushroomsales relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function joinMushroomsales($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Mushroomsales');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Mushroomsales');
        }

        return $this;
    }

    /**
     * Use the Mushroomsales relation Mushroomsales object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\MushroomsalesQuery A secondary query class using the current class as primary query
     */
    public function useMushroomsalesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMushroomsales($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Mushroomsales', '\lwops\lwops\MushroomsalesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCustomer $customer Object to remove from the list of results
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function prune($customer = null)
    {
        if ($customer) {
            $this->addUsingAlias(CustomerTableMap::COL_OID, $customer->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the customer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CustomerTableMap::clearInstancePool();
            CustomerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CustomerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CustomerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CustomerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CustomerQuery
