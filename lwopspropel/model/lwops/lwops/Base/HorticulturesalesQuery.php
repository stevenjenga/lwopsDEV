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
use lwops\lwops\Horticulturesales as ChildHorticulturesales;
use lwops\lwops\HorticulturesalesQuery as ChildHorticulturesalesQuery;
use lwops\lwops\Map\HorticulturesalesTableMap;

/**
 * Base class that represents a query for the 'horticulturesales' table.
 *
 *
 *
 * @method     ChildHorticulturesalesQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildHorticulturesalesQuery orderBySalesdt($order = Criteria::ASC) Order by the salesDt column
 * @method     ChildHorticulturesalesQuery orderByCustomeroid($order = Criteria::ASC) Order by the customerOid column
 * @method     ChildHorticulturesalesQuery orderByHorticultureproduceparentoid($order = Criteria::ASC) Order by the horticultureProduceParentOid column
 * @method     ChildHorticulturesalesQuery orderByUnit($order = Criteria::ASC) Order by the unit column
 * @method     ChildHorticulturesalesQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 * @method     ChildHorticulturesalesQuery orderByUnitprice($order = Criteria::ASC) Order by the unitPrice column
 * @method     ChildHorticulturesalesQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildHorticulturesalesQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildHorticulturesalesQuery groupByOid() Group by the oid column
 * @method     ChildHorticulturesalesQuery groupBySalesdt() Group by the salesDt column
 * @method     ChildHorticulturesalesQuery groupByCustomeroid() Group by the customerOid column
 * @method     ChildHorticulturesalesQuery groupByHorticultureproduceparentoid() Group by the horticultureProduceParentOid column
 * @method     ChildHorticulturesalesQuery groupByUnit() Group by the unit column
 * @method     ChildHorticulturesalesQuery groupByQuantity() Group by the quantity column
 * @method     ChildHorticulturesalesQuery groupByUnitprice() Group by the unitPrice column
 * @method     ChildHorticulturesalesQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildHorticulturesalesQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildHorticulturesalesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHorticulturesalesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHorticulturesalesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHorticulturesalesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHorticulturesalesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHorticulturesalesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHorticulturesalesQuery leftJoinCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Customer relation
 * @method     ChildHorticulturesalesQuery rightJoinCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Customer relation
 * @method     ChildHorticulturesalesQuery innerJoinCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the Customer relation
 *
 * @method     ChildHorticulturesalesQuery joinWithCustomer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Customer relation
 *
 * @method     ChildHorticulturesalesQuery leftJoinWithCustomer() Adds a LEFT JOIN clause and with to the query using the Customer relation
 * @method     ChildHorticulturesalesQuery rightJoinWithCustomer() Adds a RIGHT JOIN clause and with to the query using the Customer relation
 * @method     ChildHorticulturesalesQuery innerJoinWithCustomer() Adds a INNER JOIN clause and with to the query using the Customer relation
 *
 * @method     ChildHorticulturesalesQuery leftJoinHorticultureproduceparent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticultureproduceparent relation
 * @method     ChildHorticulturesalesQuery rightJoinHorticultureproduceparent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticultureproduceparent relation
 * @method     ChildHorticulturesalesQuery innerJoinHorticultureproduceparent($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticultureproduceparent relation
 *
 * @method     ChildHorticulturesalesQuery joinWithHorticultureproduceparent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticultureproduceparent relation
 *
 * @method     ChildHorticulturesalesQuery leftJoinWithHorticultureproduceparent() Adds a LEFT JOIN clause and with to the query using the Horticultureproduceparent relation
 * @method     ChildHorticulturesalesQuery rightJoinWithHorticultureproduceparent() Adds a RIGHT JOIN clause and with to the query using the Horticultureproduceparent relation
 * @method     ChildHorticulturesalesQuery innerJoinWithHorticultureproduceparent() Adds a INNER JOIN clause and with to the query using the Horticultureproduceparent relation
 *
 * @method     ChildHorticulturesalesQuery leftJoinHorticulturesellunit($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticulturesellunit relation
 * @method     ChildHorticulturesalesQuery rightJoinHorticulturesellunit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticulturesellunit relation
 * @method     ChildHorticulturesalesQuery innerJoinHorticulturesellunit($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticulturesellunit relation
 *
 * @method     ChildHorticulturesalesQuery joinWithHorticulturesellunit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticulturesellunit relation
 *
 * @method     ChildHorticulturesalesQuery leftJoinWithHorticulturesellunit() Adds a LEFT JOIN clause and with to the query using the Horticulturesellunit relation
 * @method     ChildHorticulturesalesQuery rightJoinWithHorticulturesellunit() Adds a RIGHT JOIN clause and with to the query using the Horticulturesellunit relation
 * @method     ChildHorticulturesalesQuery innerJoinWithHorticulturesellunit() Adds a INNER JOIN clause and with to the query using the Horticulturesellunit relation
 *
 * @method     \lwops\lwops\CustomerQuery|\lwops\lwops\HorticultureproduceparentQuery|\lwops\lwops\HorticulturesellunitQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHorticulturesales findOne(ConnectionInterface $con = null) Return the first ChildHorticulturesales matching the query
 * @method     ChildHorticulturesales findOneOrCreate(ConnectionInterface $con = null) Return the first ChildHorticulturesales matching the query, or a new ChildHorticulturesales object populated from the query conditions when no match is found
 *
 * @method     ChildHorticulturesales findOneByOid(int $oid) Return the first ChildHorticulturesales filtered by the oid column
 * @method     ChildHorticulturesales findOneBySalesdt(string $salesDt) Return the first ChildHorticulturesales filtered by the salesDt column
 * @method     ChildHorticulturesales findOneByCustomeroid(int $customerOid) Return the first ChildHorticulturesales filtered by the customerOid column
 * @method     ChildHorticulturesales findOneByHorticultureproduceparentoid(int $horticultureProduceParentOid) Return the first ChildHorticulturesales filtered by the horticultureProduceParentOid column
 * @method     ChildHorticulturesales findOneByUnit(string $unit) Return the first ChildHorticulturesales filtered by the unit column
 * @method     ChildHorticulturesales findOneByQuantity(int $quantity) Return the first ChildHorticulturesales filtered by the quantity column
 * @method     ChildHorticulturesales findOneByUnitprice(double $unitPrice) Return the first ChildHorticulturesales filtered by the unitPrice column
 * @method     ChildHorticulturesales findOneByCreatetmstp(string $createTmstp) Return the first ChildHorticulturesales filtered by the createTmstp column
 * @method     ChildHorticulturesales findOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticulturesales filtered by the updtTmstp column *

 * @method     ChildHorticulturesales requirePk($key, ConnectionInterface $con = null) Return the ChildHorticulturesales by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturesales requireOne(ConnectionInterface $con = null) Return the first ChildHorticulturesales matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticulturesales requireOneByOid(int $oid) Return the first ChildHorticulturesales filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturesales requireOneBySalesdt(string $salesDt) Return the first ChildHorticulturesales filtered by the salesDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturesales requireOneByCustomeroid(int $customerOid) Return the first ChildHorticulturesales filtered by the customerOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturesales requireOneByHorticultureproduceparentoid(int $horticultureProduceParentOid) Return the first ChildHorticulturesales filtered by the horticultureProduceParentOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturesales requireOneByUnit(string $unit) Return the first ChildHorticulturesales filtered by the unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturesales requireOneByQuantity(int $quantity) Return the first ChildHorticulturesales filtered by the quantity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturesales requireOneByUnitprice(double $unitPrice) Return the first ChildHorticulturesales filtered by the unitPrice column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturesales requireOneByCreatetmstp(string $createTmstp) Return the first ChildHorticulturesales filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturesales requireOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticulturesales filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticulturesales[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildHorticulturesales objects based on current ModelCriteria
 * @method     ChildHorticulturesales[]|ObjectCollection findByOid(int $oid) Return ChildHorticulturesales objects filtered by the oid column
 * @method     ChildHorticulturesales[]|ObjectCollection findBySalesdt(string $salesDt) Return ChildHorticulturesales objects filtered by the salesDt column
 * @method     ChildHorticulturesales[]|ObjectCollection findByCustomeroid(int $customerOid) Return ChildHorticulturesales objects filtered by the customerOid column
 * @method     ChildHorticulturesales[]|ObjectCollection findByHorticultureproduceparentoid(int $horticultureProduceParentOid) Return ChildHorticulturesales objects filtered by the horticultureProduceParentOid column
 * @method     ChildHorticulturesales[]|ObjectCollection findByUnit(string $unit) Return ChildHorticulturesales objects filtered by the unit column
 * @method     ChildHorticulturesales[]|ObjectCollection findByQuantity(int $quantity) Return ChildHorticulturesales objects filtered by the quantity column
 * @method     ChildHorticulturesales[]|ObjectCollection findByUnitprice(double $unitPrice) Return ChildHorticulturesales objects filtered by the unitPrice column
 * @method     ChildHorticulturesales[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildHorticulturesales objects filtered by the createTmstp column
 * @method     ChildHorticulturesales[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildHorticulturesales objects filtered by the updtTmstp column
 * @method     ChildHorticulturesales[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HorticulturesalesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\HorticulturesalesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Horticulturesales', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHorticulturesalesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHorticulturesalesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildHorticulturesalesQuery) {
            return $criteria;
        }
        $query = new ChildHorticulturesalesQuery();
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
     * @return ChildHorticulturesales|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HorticulturesalesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HorticulturesalesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHorticulturesales A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, salesDt, customerOid, horticultureProduceParentOid, unit, quantity, unitPrice, createTmstp, updtTmstp FROM horticulturesales WHERE oid = :p0';
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
            /** @var ChildHorticulturesales $obj */
            $obj = new ChildHorticulturesales();
            $obj->hydrate($row);
            HorticulturesalesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHorticulturesales|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HorticulturesalesTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HorticulturesalesTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturesalesTableMap::COL_OID, $oid, $comparison);
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
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function filterBySalesdt($salesdt = null, $comparison = null)
    {
        if (is_array($salesdt)) {
            $useMinMax = false;
            if (isset($salesdt['min'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_SALESDT, $salesdt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($salesdt['max'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_SALESDT, $salesdt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturesalesTableMap::COL_SALESDT, $salesdt, $comparison);
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
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function filterByCustomeroid($customeroid = null, $comparison = null)
    {
        if (is_array($customeroid)) {
            $useMinMax = false;
            if (isset($customeroid['min'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_CUSTOMEROID, $customeroid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($customeroid['max'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_CUSTOMEROID, $customeroid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturesalesTableMap::COL_CUSTOMEROID, $customeroid, $comparison);
    }

    /**
     * Filter the query on the horticultureProduceParentOid column
     *
     * Example usage:
     * <code>
     * $query->filterByHorticultureproduceparentoid(1234); // WHERE horticultureProduceParentOid = 1234
     * $query->filterByHorticultureproduceparentoid(array(12, 34)); // WHERE horticultureProduceParentOid IN (12, 34)
     * $query->filterByHorticultureproduceparentoid(array('min' => 12)); // WHERE horticultureProduceParentOid > 12
     * </code>
     *
     * @see       filterByHorticultureproduceparent()
     *
     * @param     mixed $horticultureproduceparentoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function filterByHorticultureproduceparentoid($horticultureproduceparentoid = null, $comparison = null)
    {
        if (is_array($horticultureproduceparentoid)) {
            $useMinMax = false;
            if (isset($horticultureproduceparentoid['min'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_HORTICULTUREPRODUCEPARENTOID, $horticultureproduceparentoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($horticultureproduceparentoid['max'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_HORTICULTUREPRODUCEPARENTOID, $horticultureproduceparentoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturesalesTableMap::COL_HORTICULTUREPRODUCEPARENTOID, $horticultureproduceparentoid, $comparison);
    }

    /**
     * Filter the query on the unit column
     *
     * Example usage:
     * <code>
     * $query->filterByUnit('fooValue');   // WHERE unit = 'fooValue'
     * $query->filterByUnit('%fooValue%', Criteria::LIKE); // WHERE unit LIKE '%fooValue%'
     * </code>
     *
     * @param     string $unit The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function filterByUnit($unit = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($unit)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturesalesTableMap::COL_UNIT, $unit, $comparison);
    }

    /**
     * Filter the query on the quantity column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantity(1234); // WHERE quantity = 1234
     * $query->filterByQuantity(array(12, 34)); // WHERE quantity IN (12, 34)
     * $query->filterByQuantity(array('min' => 12)); // WHERE quantity > 12
     * </code>
     *
     * @param     mixed $quantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function filterByQuantity($quantity = null, $comparison = null)
    {
        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturesalesTableMap::COL_QUANTITY, $quantity, $comparison);
    }

    /**
     * Filter the query on the unitPrice column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitprice(1234); // WHERE unitPrice = 1234
     * $query->filterByUnitprice(array(12, 34)); // WHERE unitPrice IN (12, 34)
     * $query->filterByUnitprice(array('min' => 12)); // WHERE unitPrice > 12
     * </code>
     *
     * @param     mixed $unitprice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function filterByUnitprice($unitprice = null, $comparison = null)
    {
        if (is_array($unitprice)) {
            $useMinMax = false;
            if (isset($unitprice['min'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_UNITPRICE, $unitprice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitprice['max'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_UNITPRICE, $unitprice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturesalesTableMap::COL_UNITPRICE, $unitprice, $comparison);
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
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturesalesTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(HorticulturesalesTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturesalesTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Customer object
     *
     * @param \lwops\lwops\Customer|ObjectCollection $customer The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function filterByCustomer($customer, $comparison = null)
    {
        if ($customer instanceof \lwops\lwops\Customer) {
            return $this
                ->addUsingAlias(HorticulturesalesTableMap::COL_CUSTOMEROID, $customer->getOid(), $comparison);
        } elseif ($customer instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(HorticulturesalesTableMap::COL_CUSTOMEROID, $customer->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Horticultureproduceparent object
     *
     * @param \lwops\lwops\Horticultureproduceparent|ObjectCollection $horticultureproduceparent The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function filterByHorticultureproduceparent($horticultureproduceparent, $comparison = null)
    {
        if ($horticultureproduceparent instanceof \lwops\lwops\Horticultureproduceparent) {
            return $this
                ->addUsingAlias(HorticulturesalesTableMap::COL_HORTICULTUREPRODUCEPARENTOID, $horticultureproduceparent->getOid(), $comparison);
        } elseif ($horticultureproduceparent instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(HorticulturesalesTableMap::COL_HORTICULTUREPRODUCEPARENTOID, $horticultureproduceparent->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByHorticultureproduceparent() only accepts arguments of type \lwops\lwops\Horticultureproduceparent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Horticultureproduceparent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function joinHorticultureproduceparent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Horticultureproduceparent');

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
            $this->addJoinObject($join, 'Horticultureproduceparent');
        }

        return $this;
    }

    /**
     * Use the Horticultureproduceparent relation Horticultureproduceparent object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\HorticultureproduceparentQuery A secondary query class using the current class as primary query
     */
    public function useHorticultureproduceparentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHorticultureproduceparent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Horticultureproduceparent', '\lwops\lwops\HorticultureproduceparentQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Horticulturesellunit object
     *
     * @param \lwops\lwops\Horticulturesellunit|ObjectCollection $horticulturesellunit The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function filterByHorticulturesellunit($horticulturesellunit, $comparison = null)
    {
        if ($horticulturesellunit instanceof \lwops\lwops\Horticulturesellunit) {
            return $this
                ->addUsingAlias(HorticulturesalesTableMap::COL_UNIT, $horticulturesellunit->getUnit(), $comparison);
        } elseif ($horticulturesellunit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(HorticulturesalesTableMap::COL_UNIT, $horticulturesellunit->toKeyValue('PrimaryKey', 'Unit'), $comparison);
        } else {
            throw new PropelException('filterByHorticulturesellunit() only accepts arguments of type \lwops\lwops\Horticulturesellunit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Horticulturesellunit relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function joinHorticulturesellunit($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Horticulturesellunit');

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
            $this->addJoinObject($join, 'Horticulturesellunit');
        }

        return $this;
    }

    /**
     * Use the Horticulturesellunit relation Horticulturesellunit object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\HorticulturesellunitQuery A secondary query class using the current class as primary query
     */
    public function useHorticulturesellunitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHorticulturesellunit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Horticulturesellunit', '\lwops\lwops\HorticulturesellunitQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildHorticulturesales $horticulturesales Object to remove from the list of results
     *
     * @return $this|ChildHorticulturesalesQuery The current query, for fluid interface
     */
    public function prune($horticulturesales = null)
    {
        if ($horticulturesales) {
            $this->addUsingAlias(HorticulturesalesTableMap::COL_OID, $horticulturesales->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the horticulturesales table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HorticulturesalesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HorticulturesalesTableMap::clearInstancePool();
            HorticulturesalesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HorticulturesalesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HorticulturesalesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HorticulturesalesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HorticulturesalesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // HorticulturesalesQuery
