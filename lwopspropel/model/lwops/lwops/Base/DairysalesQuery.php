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
use lwops\lwops\Dairysales as ChildDairysales;
use lwops\lwops\DairysalesQuery as ChildDairysalesQuery;
use lwops\lwops\Map\DairysalesTableMap;

/**
 * Base class that represents a query for the 'dairysales' table.
 *
 *
 *
 * @method     ChildDairysalesQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildDairysalesQuery orderBySalesdt($order = Criteria::ASC) Order by the salesDt column
 * @method     ChildDairysalesQuery orderByCustomeroid($order = Criteria::ASC) Order by the customerOid column
 * @method     ChildDairysalesQuery orderByVolume($order = Criteria::ASC) Order by the volume column
 * @method     ChildDairysalesQuery orderByPriceperliter($order = Criteria::ASC) Order by the pricePerLiter column
 * @method     ChildDairysalesQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildDairysalesQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildDairysalesQuery groupByOid() Group by the oid column
 * @method     ChildDairysalesQuery groupBySalesdt() Group by the salesDt column
 * @method     ChildDairysalesQuery groupByCustomeroid() Group by the customerOid column
 * @method     ChildDairysalesQuery groupByVolume() Group by the volume column
 * @method     ChildDairysalesQuery groupByPriceperliter() Group by the pricePerLiter column
 * @method     ChildDairysalesQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildDairysalesQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildDairysalesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDairysalesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDairysalesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDairysalesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDairysalesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDairysalesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDairysalesQuery leftJoinCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Customer relation
 * @method     ChildDairysalesQuery rightJoinCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Customer relation
 * @method     ChildDairysalesQuery innerJoinCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the Customer relation
 *
 * @method     ChildDairysalesQuery joinWithCustomer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Customer relation
 *
 * @method     ChildDairysalesQuery leftJoinWithCustomer() Adds a LEFT JOIN clause and with to the query using the Customer relation
 * @method     ChildDairysalesQuery rightJoinWithCustomer() Adds a RIGHT JOIN clause and with to the query using the Customer relation
 * @method     ChildDairysalesQuery innerJoinWithCustomer() Adds a INNER JOIN clause and with to the query using the Customer relation
 *
 * @method     \lwops\lwops\CustomerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDairysales findOne(ConnectionInterface $con = null) Return the first ChildDairysales matching the query
 * @method     ChildDairysales findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDairysales matching the query, or a new ChildDairysales object populated from the query conditions when no match is found
 *
 * @method     ChildDairysales findOneByOid(int $oid) Return the first ChildDairysales filtered by the oid column
 * @method     ChildDairysales findOneBySalesdt(string $salesDt) Return the first ChildDairysales filtered by the salesDt column
 * @method     ChildDairysales findOneByCustomeroid(int $customerOid) Return the first ChildDairysales filtered by the customerOid column
 * @method     ChildDairysales findOneByVolume(string $volume) Return the first ChildDairysales filtered by the volume column
 * @method     ChildDairysales findOneByPriceperliter(double $pricePerLiter) Return the first ChildDairysales filtered by the pricePerLiter column
 * @method     ChildDairysales findOneByCreatetmstp(string $createTmstp) Return the first ChildDairysales filtered by the createTmstp column
 * @method     ChildDairysales findOneByUpdttmstp(string $updtTmstp) Return the first ChildDairysales filtered by the updtTmstp column *

 * @method     ChildDairysales requirePk($key, ConnectionInterface $con = null) Return the ChildDairysales by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairysales requireOne(ConnectionInterface $con = null) Return the first ChildDairysales matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDairysales requireOneByOid(int $oid) Return the first ChildDairysales filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairysales requireOneBySalesdt(string $salesDt) Return the first ChildDairysales filtered by the salesDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairysales requireOneByCustomeroid(int $customerOid) Return the first ChildDairysales filtered by the customerOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairysales requireOneByVolume(string $volume) Return the first ChildDairysales filtered by the volume column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairysales requireOneByPriceperliter(double $pricePerLiter) Return the first ChildDairysales filtered by the pricePerLiter column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairysales requireOneByCreatetmstp(string $createTmstp) Return the first ChildDairysales filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairysales requireOneByUpdttmstp(string $updtTmstp) Return the first ChildDairysales filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDairysales[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDairysales objects based on current ModelCriteria
 * @method     ChildDairysales[]|ObjectCollection findByOid(int $oid) Return ChildDairysales objects filtered by the oid column
 * @method     ChildDairysales[]|ObjectCollection findBySalesdt(string $salesDt) Return ChildDairysales objects filtered by the salesDt column
 * @method     ChildDairysales[]|ObjectCollection findByCustomeroid(int $customerOid) Return ChildDairysales objects filtered by the customerOid column
 * @method     ChildDairysales[]|ObjectCollection findByVolume(string $volume) Return ChildDairysales objects filtered by the volume column
 * @method     ChildDairysales[]|ObjectCollection findByPriceperliter(double $pricePerLiter) Return ChildDairysales objects filtered by the pricePerLiter column
 * @method     ChildDairysales[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildDairysales objects filtered by the createTmstp column
 * @method     ChildDairysales[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildDairysales objects filtered by the updtTmstp column
 * @method     ChildDairysales[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DairysalesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\DairysalesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Dairysales', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDairysalesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDairysalesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDairysalesQuery) {
            return $criteria;
        }
        $query = new ChildDairysalesQuery();
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
     * @return ChildDairysales|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DairysalesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DairysalesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDairysales A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, salesDt, customerOid, volume, pricePerLiter, createTmstp, updtTmstp FROM dairysales WHERE oid = :p0';
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
            /** @var ChildDairysales $obj */
            $obj = new ChildDairysales();
            $obj->hydrate($row);
            DairysalesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDairysales|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDairysalesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DairysalesTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDairysalesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DairysalesTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildDairysalesQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(DairysalesTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(DairysalesTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairysalesTableMap::COL_OID, $oid, $comparison);
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
     * @return $this|ChildDairysalesQuery The current query, for fluid interface
     */
    public function filterBySalesdt($salesdt = null, $comparison = null)
    {
        if (is_array($salesdt)) {
            $useMinMax = false;
            if (isset($salesdt['min'])) {
                $this->addUsingAlias(DairysalesTableMap::COL_SALESDT, $salesdt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($salesdt['max'])) {
                $this->addUsingAlias(DairysalesTableMap::COL_SALESDT, $salesdt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairysalesTableMap::COL_SALESDT, $salesdt, $comparison);
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
     * @return $this|ChildDairysalesQuery The current query, for fluid interface
     */
    public function filterByCustomeroid($customeroid = null, $comparison = null)
    {
        if (is_array($customeroid)) {
            $useMinMax = false;
            if (isset($customeroid['min'])) {
                $this->addUsingAlias(DairysalesTableMap::COL_CUSTOMEROID, $customeroid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($customeroid['max'])) {
                $this->addUsingAlias(DairysalesTableMap::COL_CUSTOMEROID, $customeroid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairysalesTableMap::COL_CUSTOMEROID, $customeroid, $comparison);
    }

    /**
     * Filter the query on the volume column
     *
     * Example usage:
     * <code>
     * $query->filterByVolume('fooValue');   // WHERE volume = 'fooValue'
     * $query->filterByVolume('%fooValue%', Criteria::LIKE); // WHERE volume LIKE '%fooValue%'
     * </code>
     *
     * @param     string $volume The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDairysalesQuery The current query, for fluid interface
     */
    public function filterByVolume($volume = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($volume)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairysalesTableMap::COL_VOLUME, $volume, $comparison);
    }

    /**
     * Filter the query on the pricePerLiter column
     *
     * Example usage:
     * <code>
     * $query->filterByPriceperliter(1234); // WHERE pricePerLiter = 1234
     * $query->filterByPriceperliter(array(12, 34)); // WHERE pricePerLiter IN (12, 34)
     * $query->filterByPriceperliter(array('min' => 12)); // WHERE pricePerLiter > 12
     * </code>
     *
     * @param     mixed $priceperliter The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDairysalesQuery The current query, for fluid interface
     */
    public function filterByPriceperliter($priceperliter = null, $comparison = null)
    {
        if (is_array($priceperliter)) {
            $useMinMax = false;
            if (isset($priceperliter['min'])) {
                $this->addUsingAlias(DairysalesTableMap::COL_PRICEPERLITER, $priceperliter['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($priceperliter['max'])) {
                $this->addUsingAlias(DairysalesTableMap::COL_PRICEPERLITER, $priceperliter['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairysalesTableMap::COL_PRICEPERLITER, $priceperliter, $comparison);
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
     * @return $this|ChildDairysalesQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(DairysalesTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(DairysalesTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairysalesTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildDairysalesQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(DairysalesTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(DairysalesTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairysalesTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Customer object
     *
     * @param \lwops\lwops\Customer|ObjectCollection $customer The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDairysalesQuery The current query, for fluid interface
     */
    public function filterByCustomer($customer, $comparison = null)
    {
        if ($customer instanceof \lwops\lwops\Customer) {
            return $this
                ->addUsingAlias(DairysalesTableMap::COL_CUSTOMEROID, $customer->getOid(), $comparison);
        } elseif ($customer instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DairysalesTableMap::COL_CUSTOMEROID, $customer->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildDairysalesQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildDairysales $dairysales Object to remove from the list of results
     *
     * @return $this|ChildDairysalesQuery The current query, for fluid interface
     */
    public function prune($dairysales = null)
    {
        if ($dairysales) {
            $this->addUsingAlias(DairysalesTableMap::COL_OID, $dairysales->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the dairysales table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DairysalesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DairysalesTableMap::clearInstancePool();
            DairysalesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DairysalesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DairysalesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DairysalesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DairysalesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DairysalesQuery
