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
use lwops\lwops\Fishsales as ChildFishsales;
use lwops\lwops\FishsalesQuery as ChildFishsalesQuery;
use lwops\lwops\Map\FishsalesTableMap;

/**
 * Base class that represents a query for the 'fishsales' table.
 *
 *
 *
 * @method     ChildFishsalesQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildFishsalesQuery orderBySalesdt($order = Criteria::ASC) Order by the salesDt column
 * @method     ChildFishsalesQuery orderByCustomeroid($order = Criteria::ASC) Order by the customerOid column
 * @method     ChildFishsalesQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildFishsalesQuery orderByWeight($order = Criteria::ASC) Order by the weight column
 * @method     ChildFishsalesQuery orderByPriceperkg($order = Criteria::ASC) Order by the pricePerKg column
 * @method     ChildFishsalesQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildFishsalesQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildFishsalesQuery groupByOid() Group by the oid column
 * @method     ChildFishsalesQuery groupBySalesdt() Group by the salesDt column
 * @method     ChildFishsalesQuery groupByCustomeroid() Group by the customerOid column
 * @method     ChildFishsalesQuery groupByType() Group by the type column
 * @method     ChildFishsalesQuery groupByWeight() Group by the weight column
 * @method     ChildFishsalesQuery groupByPriceperkg() Group by the pricePerKg column
 * @method     ChildFishsalesQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildFishsalesQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildFishsalesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFishsalesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFishsalesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFishsalesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFishsalesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFishsalesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFishsalesQuery leftJoinCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Customer relation
 * @method     ChildFishsalesQuery rightJoinCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Customer relation
 * @method     ChildFishsalesQuery innerJoinCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the Customer relation
 *
 * @method     ChildFishsalesQuery joinWithCustomer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Customer relation
 *
 * @method     ChildFishsalesQuery leftJoinWithCustomer() Adds a LEFT JOIN clause and with to the query using the Customer relation
 * @method     ChildFishsalesQuery rightJoinWithCustomer() Adds a RIGHT JOIN clause and with to the query using the Customer relation
 * @method     ChildFishsalesQuery innerJoinWithCustomer() Adds a INNER JOIN clause and with to the query using the Customer relation
 *
 * @method     ChildFishsalesQuery leftJoinFishtype($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fishtype relation
 * @method     ChildFishsalesQuery rightJoinFishtype($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fishtype relation
 * @method     ChildFishsalesQuery innerJoinFishtype($relationAlias = null) Adds a INNER JOIN clause to the query using the Fishtype relation
 *
 * @method     ChildFishsalesQuery joinWithFishtype($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fishtype relation
 *
 * @method     ChildFishsalesQuery leftJoinWithFishtype() Adds a LEFT JOIN clause and with to the query using the Fishtype relation
 * @method     ChildFishsalesQuery rightJoinWithFishtype() Adds a RIGHT JOIN clause and with to the query using the Fishtype relation
 * @method     ChildFishsalesQuery innerJoinWithFishtype() Adds a INNER JOIN clause and with to the query using the Fishtype relation
 *
 * @method     \lwops\lwops\CustomerQuery|\lwops\lwops\FishtypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFishsales findOne(ConnectionInterface $con = null) Return the first ChildFishsales matching the query
 * @method     ChildFishsales findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFishsales matching the query, or a new ChildFishsales object populated from the query conditions when no match is found
 *
 * @method     ChildFishsales findOneByOid(int $oid) Return the first ChildFishsales filtered by the oid column
 * @method     ChildFishsales findOneBySalesdt(string $salesDt) Return the first ChildFishsales filtered by the salesDt column
 * @method     ChildFishsales findOneByCustomeroid(int $customerOid) Return the first ChildFishsales filtered by the customerOid column
 * @method     ChildFishsales findOneByType(string $type) Return the first ChildFishsales filtered by the type column
 * @method     ChildFishsales findOneByWeight(double $weight) Return the first ChildFishsales filtered by the weight column
 * @method     ChildFishsales findOneByPriceperkg(double $pricePerKg) Return the first ChildFishsales filtered by the pricePerKg column
 * @method     ChildFishsales findOneByCreatetmstp(string $createTmstp) Return the first ChildFishsales filtered by the createTmstp column
 * @method     ChildFishsales findOneByUpdttmstp(string $updtTmstp) Return the first ChildFishsales filtered by the updtTmstp column *

 * @method     ChildFishsales requirePk($key, ConnectionInterface $con = null) Return the ChildFishsales by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishsales requireOne(ConnectionInterface $con = null) Return the first ChildFishsales matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFishsales requireOneByOid(int $oid) Return the first ChildFishsales filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishsales requireOneBySalesdt(string $salesDt) Return the first ChildFishsales filtered by the salesDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishsales requireOneByCustomeroid(int $customerOid) Return the first ChildFishsales filtered by the customerOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishsales requireOneByType(string $type) Return the first ChildFishsales filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishsales requireOneByWeight(double $weight) Return the first ChildFishsales filtered by the weight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishsales requireOneByPriceperkg(double $pricePerKg) Return the first ChildFishsales filtered by the pricePerKg column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishsales requireOneByCreatetmstp(string $createTmstp) Return the first ChildFishsales filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishsales requireOneByUpdttmstp(string $updtTmstp) Return the first ChildFishsales filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFishsales[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFishsales objects based on current ModelCriteria
 * @method     ChildFishsales[]|ObjectCollection findByOid(int $oid) Return ChildFishsales objects filtered by the oid column
 * @method     ChildFishsales[]|ObjectCollection findBySalesdt(string $salesDt) Return ChildFishsales objects filtered by the salesDt column
 * @method     ChildFishsales[]|ObjectCollection findByCustomeroid(int $customerOid) Return ChildFishsales objects filtered by the customerOid column
 * @method     ChildFishsales[]|ObjectCollection findByType(string $type) Return ChildFishsales objects filtered by the type column
 * @method     ChildFishsales[]|ObjectCollection findByWeight(double $weight) Return ChildFishsales objects filtered by the weight column
 * @method     ChildFishsales[]|ObjectCollection findByPriceperkg(double $pricePerKg) Return ChildFishsales objects filtered by the pricePerKg column
 * @method     ChildFishsales[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildFishsales objects filtered by the createTmstp column
 * @method     ChildFishsales[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildFishsales objects filtered by the updtTmstp column
 * @method     ChildFishsales[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FishsalesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\FishsalesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Fishsales', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFishsalesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFishsalesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFishsalesQuery) {
            return $criteria;
        }
        $query = new ChildFishsalesQuery();
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
     * @return ChildFishsales|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FishsalesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FishsalesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFishsales A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, salesDt, customerOid, type, weight, pricePerKg, createTmstp, updtTmstp FROM fishsales WHERE oid = :p0';
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
            /** @var ChildFishsales $obj */
            $obj = new ChildFishsales();
            $obj->hydrate($row);
            FishsalesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFishsales|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFishsalesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FishsalesTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFishsalesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FishsalesTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildFishsalesQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(FishsalesTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(FishsalesTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishsalesTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the salesDt column
     *
     * Example usage:
     * <code>
     * $query->filterBySalesdt('2011-03-14'); // WHERE salesDt = '2011-03-14'
     * $query->filterBySalesdt('now'); // WHERE salesDt = '2011-03-14'
     * $query->filterBySalesdt(array('max' => 'yesterday')); // WHERE salesDt > '2011-03-13'
     * </code>
     *
     * @param     mixed $salesdt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishsalesQuery The current query, for fluid interface
     */
    public function filterBySalesdt($salesdt = null, $comparison = null)
    {
        if (is_array($salesdt)) {
            $useMinMax = false;
            if (isset($salesdt['min'])) {
                $this->addUsingAlias(FishsalesTableMap::COL_SALESDT, $salesdt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($salesdt['max'])) {
                $this->addUsingAlias(FishsalesTableMap::COL_SALESDT, $salesdt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishsalesTableMap::COL_SALESDT, $salesdt, $comparison);
    }

    /**
     * Filter the query on the customerOid column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomeroid(1234); // WHERE customerOid = 1234
     * $query->filterByCustomeroid(array(12, 34)); // WHERE customerOid IN (12, 34)
     * $query->filterByCustomeroid(array('min' => 12)); // WHERE customerOid > 12
     * </code>
     *
     * @see       filterByCustomer()
     *
     * @param     mixed $customeroid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishsalesQuery The current query, for fluid interface
     */
    public function filterByCustomeroid($customeroid = null, $comparison = null)
    {
        if (is_array($customeroid)) {
            $useMinMax = false;
            if (isset($customeroid['min'])) {
                $this->addUsingAlias(FishsalesTableMap::COL_CUSTOMEROID, $customeroid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($customeroid['max'])) {
                $this->addUsingAlias(FishsalesTableMap::COL_CUSTOMEROID, $customeroid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishsalesTableMap::COL_CUSTOMEROID, $customeroid, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishsalesQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishsalesTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the weight column
     *
     * Example usage:
     * <code>
     * $query->filterByWeight(1234); // WHERE weight = 1234
     * $query->filterByWeight(array(12, 34)); // WHERE weight IN (12, 34)
     * $query->filterByWeight(array('min' => 12)); // WHERE weight > 12
     * </code>
     *
     * @param     mixed $weight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishsalesQuery The current query, for fluid interface
     */
    public function filterByWeight($weight = null, $comparison = null)
    {
        if (is_array($weight)) {
            $useMinMax = false;
            if (isset($weight['min'])) {
                $this->addUsingAlias(FishsalesTableMap::COL_WEIGHT, $weight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($weight['max'])) {
                $this->addUsingAlias(FishsalesTableMap::COL_WEIGHT, $weight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishsalesTableMap::COL_WEIGHT, $weight, $comparison);
    }

    /**
     * Filter the query on the pricePerKg column
     *
     * Example usage:
     * <code>
     * $query->filterByPriceperkg(1234); // WHERE pricePerKg = 1234
     * $query->filterByPriceperkg(array(12, 34)); // WHERE pricePerKg IN (12, 34)
     * $query->filterByPriceperkg(array('min' => 12)); // WHERE pricePerKg > 12
     * </code>
     *
     * @param     mixed $priceperkg The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishsalesQuery The current query, for fluid interface
     */
    public function filterByPriceperkg($priceperkg = null, $comparison = null)
    {
        if (is_array($priceperkg)) {
            $useMinMax = false;
            if (isset($priceperkg['min'])) {
                $this->addUsingAlias(FishsalesTableMap::COL_PRICEPERKG, $priceperkg['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($priceperkg['max'])) {
                $this->addUsingAlias(FishsalesTableMap::COL_PRICEPERKG, $priceperkg['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishsalesTableMap::COL_PRICEPERKG, $priceperkg, $comparison);
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
     * @return $this|ChildFishsalesQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(FishsalesTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(FishsalesTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishsalesTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildFishsalesQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(FishsalesTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(FishsalesTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishsalesTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Customer object
     *
     * @param \lwops\lwops\Customer|ObjectCollection $customer The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFishsalesQuery The current query, for fluid interface
     */
    public function filterByCustomer($customer, $comparison = null)
    {
        if ($customer instanceof \lwops\lwops\Customer) {
            return $this
                ->addUsingAlias(FishsalesTableMap::COL_CUSTOMEROID, $customer->getOid(), $comparison);
        } elseif ($customer instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FishsalesTableMap::COL_CUSTOMEROID, $customer->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByCustomer() only accepts arguments of type \lwops\lwops\Customer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Customer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFishsalesQuery The current query, for fluid interface
     */
    public function joinCustomer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Customer');

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
            $this->addJoinObject($join, 'Customer');
        }

        return $this;
    }

    /**
     * Use the Customer relation Customer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\CustomerQuery A secondary query class using the current class as primary query
     */
    public function useCustomerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCustomer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Customer', '\lwops\lwops\CustomerQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Fishtype object
     *
     * @param \lwops\lwops\Fishtype|ObjectCollection $fishtype The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFishsalesQuery The current query, for fluid interface
     */
    public function filterByFishtype($fishtype, $comparison = null)
    {
        if ($fishtype instanceof \lwops\lwops\Fishtype) {
            return $this
                ->addUsingAlias(FishsalesTableMap::COL_TYPE, $fishtype->getFishtype(), $comparison);
        } elseif ($fishtype instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FishsalesTableMap::COL_TYPE, $fishtype->toKeyValue('PrimaryKey', 'Fishtype'), $comparison);
        } else {
            throw new PropelException('filterByFishtype() only accepts arguments of type \lwops\lwops\Fishtype or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fishtype relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFishsalesQuery The current query, for fluid interface
     */
    public function joinFishtype($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fishtype');

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
            $this->addJoinObject($join, 'Fishtype');
        }

        return $this;
    }

    /**
     * Use the Fishtype relation Fishtype object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\FishtypeQuery A secondary query class using the current class as primary query
     */
    public function useFishtypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFishtype($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fishtype', '\lwops\lwops\FishtypeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFishsales $fishsales Object to remove from the list of results
     *
     * @return $this|ChildFishsalesQuery The current query, for fluid interface
     */
    public function prune($fishsales = null)
    {
        if ($fishsales) {
            $this->addUsingAlias(FishsalesTableMap::COL_OID, $fishsales->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the fishsales table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FishsalesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FishsalesTableMap::clearInstancePool();
            FishsalesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FishsalesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FishsalesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FishsalesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FishsalesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FishsalesQuery
