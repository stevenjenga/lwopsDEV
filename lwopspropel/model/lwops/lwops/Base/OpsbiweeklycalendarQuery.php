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
use lwops\lwops\Opsbiweeklycalendar as ChildOpsbiweeklycalendar;
use lwops\lwops\OpsbiweeklycalendarQuery as ChildOpsbiweeklycalendarQuery;
use lwops\lwops\Map\OpsbiweeklycalendarTableMap;

/**
 * Base class that represents a query for the 'opsbiweeklycalendar' table.
 *
 *
 *
 * @method     ChildOpsbiweeklycalendarQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildOpsbiweeklycalendarQuery orderByPeriodstartdate($order = Criteria::ASC) Order by the periodStartDate column
 * @method     ChildOpsbiweeklycalendarQuery orderByPeriodenddt($order = Criteria::ASC) Order by the periodEndDt column
 * @method     ChildOpsbiweeklycalendarQuery orderByPaydate($order = Criteria::ASC) Order by the payDate column
 * @method     ChildOpsbiweeklycalendarQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildOpsbiweeklycalendarQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildOpsbiweeklycalendarQuery groupByOid() Group by the oid column
 * @method     ChildOpsbiweeklycalendarQuery groupByPeriodstartdate() Group by the periodStartDate column
 * @method     ChildOpsbiweeklycalendarQuery groupByPeriodenddt() Group by the periodEndDt column
 * @method     ChildOpsbiweeklycalendarQuery groupByPaydate() Group by the payDate column
 * @method     ChildOpsbiweeklycalendarQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildOpsbiweeklycalendarQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildOpsbiweeklycalendarQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOpsbiweeklycalendarQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOpsbiweeklycalendarQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOpsbiweeklycalendarQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOpsbiweeklycalendarQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOpsbiweeklycalendarQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOpsbiweeklycalendarQuery leftJoinCasualemployeepayslip($relationAlias = null) Adds a LEFT JOIN clause to the query using the Casualemployeepayslip relation
 * @method     ChildOpsbiweeklycalendarQuery rightJoinCasualemployeepayslip($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Casualemployeepayslip relation
 * @method     ChildOpsbiweeklycalendarQuery innerJoinCasualemployeepayslip($relationAlias = null) Adds a INNER JOIN clause to the query using the Casualemployeepayslip relation
 *
 * @method     ChildOpsbiweeklycalendarQuery joinWithCasualemployeepayslip($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Casualemployeepayslip relation
 *
 * @method     ChildOpsbiweeklycalendarQuery leftJoinWithCasualemployeepayslip() Adds a LEFT JOIN clause and with to the query using the Casualemployeepayslip relation
 * @method     ChildOpsbiweeklycalendarQuery rightJoinWithCasualemployeepayslip() Adds a RIGHT JOIN clause and with to the query using the Casualemployeepayslip relation
 * @method     ChildOpsbiweeklycalendarQuery innerJoinWithCasualemployeepayslip() Adds a INNER JOIN clause and with to the query using the Casualemployeepayslip relation
 *
 * @method     \lwops\lwops\CasualemployeepayslipQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOpsbiweeklycalendar findOne(ConnectionInterface $con = null) Return the first ChildOpsbiweeklycalendar matching the query
 * @method     ChildOpsbiweeklycalendar findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOpsbiweeklycalendar matching the query, or a new ChildOpsbiweeklycalendar object populated from the query conditions when no match is found
 *
 * @method     ChildOpsbiweeklycalendar findOneByOid(int $oid) Return the first ChildOpsbiweeklycalendar filtered by the oid column
 * @method     ChildOpsbiweeklycalendar findOneByPeriodstartdate(string $periodStartDate) Return the first ChildOpsbiweeklycalendar filtered by the periodStartDate column
 * @method     ChildOpsbiweeklycalendar findOneByPeriodenddt(string $periodEndDt) Return the first ChildOpsbiweeklycalendar filtered by the periodEndDt column
 * @method     ChildOpsbiweeklycalendar findOneByPaydate(string $payDate) Return the first ChildOpsbiweeklycalendar filtered by the payDate column
 * @method     ChildOpsbiweeklycalendar findOneByCreatetmstp(string $createTmstp) Return the first ChildOpsbiweeklycalendar filtered by the createTmstp column
 * @method     ChildOpsbiweeklycalendar findOneByUpdttmstp(string $updtTmstp) Return the first ChildOpsbiweeklycalendar filtered by the updtTmstp column *

 * @method     ChildOpsbiweeklycalendar requirePk($key, ConnectionInterface $con = null) Return the ChildOpsbiweeklycalendar by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpsbiweeklycalendar requireOne(ConnectionInterface $con = null) Return the first ChildOpsbiweeklycalendar matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOpsbiweeklycalendar requireOneByOid(int $oid) Return the first ChildOpsbiweeklycalendar filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpsbiweeklycalendar requireOneByPeriodstartdate(string $periodStartDate) Return the first ChildOpsbiweeklycalendar filtered by the periodStartDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpsbiweeklycalendar requireOneByPeriodenddt(string $periodEndDt) Return the first ChildOpsbiweeklycalendar filtered by the periodEndDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpsbiweeklycalendar requireOneByPaydate(string $payDate) Return the first ChildOpsbiweeklycalendar filtered by the payDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpsbiweeklycalendar requireOneByCreatetmstp(string $createTmstp) Return the first ChildOpsbiweeklycalendar filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpsbiweeklycalendar requireOneByUpdttmstp(string $updtTmstp) Return the first ChildOpsbiweeklycalendar filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOpsbiweeklycalendar[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOpsbiweeklycalendar objects based on current ModelCriteria
 * @method     ChildOpsbiweeklycalendar[]|ObjectCollection findByOid(int $oid) Return ChildOpsbiweeklycalendar objects filtered by the oid column
 * @method     ChildOpsbiweeklycalendar[]|ObjectCollection findByPeriodstartdate(string $periodStartDate) Return ChildOpsbiweeklycalendar objects filtered by the periodStartDate column
 * @method     ChildOpsbiweeklycalendar[]|ObjectCollection findByPeriodenddt(string $periodEndDt) Return ChildOpsbiweeklycalendar objects filtered by the periodEndDt column
 * @method     ChildOpsbiweeklycalendar[]|ObjectCollection findByPaydate(string $payDate) Return ChildOpsbiweeklycalendar objects filtered by the payDate column
 * @method     ChildOpsbiweeklycalendar[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildOpsbiweeklycalendar objects filtered by the createTmstp column
 * @method     ChildOpsbiweeklycalendar[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildOpsbiweeklycalendar objects filtered by the updtTmstp column
 * @method     ChildOpsbiweeklycalendar[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OpsbiweeklycalendarQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\OpsbiweeklycalendarQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Opsbiweeklycalendar', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOpsbiweeklycalendarQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOpsbiweeklycalendarQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOpsbiweeklycalendarQuery) {
            return $criteria;
        }
        $query = new ChildOpsbiweeklycalendarQuery();
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
     * @return ChildOpsbiweeklycalendar|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OpsbiweeklycalendarTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OpsbiweeklycalendarTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOpsbiweeklycalendar A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, periodStartDate, periodEndDt, payDate, createTmstp, updtTmstp FROM opsbiweeklycalendar WHERE oid = :p0';
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
            /** @var ChildOpsbiweeklycalendar $obj */
            $obj = new ChildOpsbiweeklycalendar();
            $obj->hydrate($row);
            OpsbiweeklycalendarTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOpsbiweeklycalendar|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOpsbiweeklycalendarQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOpsbiweeklycalendarQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildOpsbiweeklycalendarQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the periodStartDate column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriodstartdate('2011-03-14'); // WHERE periodStartDate = '2011-03-14'
     * $query->filterByPeriodstartdate('now'); // WHERE periodStartDate = '2011-03-14'
     * $query->filterByPeriodstartdate(array('max' => 'yesterday')); // WHERE periodStartDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $periodstartdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpsbiweeklycalendarQuery The current query, for fluid interface
     */
    public function filterByPeriodstartdate($periodstartdate = null, $comparison = null)
    {
        if (is_array($periodstartdate)) {
            $useMinMax = false;
            if (isset($periodstartdate['min'])) {
                $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_PERIODSTARTDATE, $periodstartdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($periodstartdate['max'])) {
                $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_PERIODSTARTDATE, $periodstartdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_PERIODSTARTDATE, $periodstartdate, $comparison);
    }

    /**
     * Filter the query on the periodEndDt column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriodenddt('2011-03-14'); // WHERE periodEndDt = '2011-03-14'
     * $query->filterByPeriodenddt('now'); // WHERE periodEndDt = '2011-03-14'
     * $query->filterByPeriodenddt(array('max' => 'yesterday')); // WHERE periodEndDt > '2011-03-13'
     * </code>
     *
     * @param     mixed $periodenddt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpsbiweeklycalendarQuery The current query, for fluid interface
     */
    public function filterByPeriodenddt($periodenddt = null, $comparison = null)
    {
        if (is_array($periodenddt)) {
            $useMinMax = false;
            if (isset($periodenddt['min'])) {
                $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_PERIODENDDT, $periodenddt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($periodenddt['max'])) {
                $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_PERIODENDDT, $periodenddt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_PERIODENDDT, $periodenddt, $comparison);
    }

    /**
     * Filter the query on the payDate column
     *
     * Example usage:
     * <code>
     * $query->filterByPaydate('2011-03-14'); // WHERE payDate = '2011-03-14'
     * $query->filterByPaydate('now'); // WHERE payDate = '2011-03-14'
     * $query->filterByPaydate(array('max' => 'yesterday')); // WHERE payDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $paydate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpsbiweeklycalendarQuery The current query, for fluid interface
     */
    public function filterByPaydate($paydate = null, $comparison = null)
    {
        if (is_array($paydate)) {
            $useMinMax = false;
            if (isset($paydate['min'])) {
                $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_PAYDATE, $paydate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($paydate['max'])) {
                $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_PAYDATE, $paydate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_PAYDATE, $paydate, $comparison);
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
     * @return $this|ChildOpsbiweeklycalendarQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildOpsbiweeklycalendarQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Casualemployeepayslip object
     *
     * @param \lwops\lwops\Casualemployeepayslip|ObjectCollection $casualemployeepayslip the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsbiweeklycalendarQuery The current query, for fluid interface
     */
    public function filterByCasualemployeepayslip($casualemployeepayslip, $comparison = null)
    {
        if ($casualemployeepayslip instanceof \lwops\lwops\Casualemployeepayslip) {
            return $this
                ->addUsingAlias(OpsbiweeklycalendarTableMap::COL_OID, $casualemployeepayslip->getOpsbiweeklycalendaroid(), $comparison);
        } elseif ($casualemployeepayslip instanceof ObjectCollection) {
            return $this
                ->useCasualemployeepayslipQuery()
                ->filterByPrimaryKeys($casualemployeepayslip->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCasualemployeepayslip() only accepts arguments of type \lwops\lwops\Casualemployeepayslip or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Casualemployeepayslip relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsbiweeklycalendarQuery The current query, for fluid interface
     */
    public function joinCasualemployeepayslip($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Casualemployeepayslip');

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
            $this->addJoinObject($join, 'Casualemployeepayslip');
        }

        return $this;
    }

    /**
     * Use the Casualemployeepayslip relation Casualemployeepayslip object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\CasualemployeepayslipQuery A secondary query class using the current class as primary query
     */
    public function useCasualemployeepayslipQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCasualemployeepayslip($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Casualemployeepayslip', '\lwops\lwops\CasualemployeepayslipQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildOpsbiweeklycalendar $opsbiweeklycalendar Object to remove from the list of results
     *
     * @return $this|ChildOpsbiweeklycalendarQuery The current query, for fluid interface
     */
    public function prune($opsbiweeklycalendar = null)
    {
        if ($opsbiweeklycalendar) {
            $this->addUsingAlias(OpsbiweeklycalendarTableMap::COL_OID, $opsbiweeklycalendar->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the opsbiweeklycalendar table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OpsbiweeklycalendarTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OpsbiweeklycalendarTableMap::clearInstancePool();
            OpsbiweeklycalendarTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OpsbiweeklycalendarTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OpsbiweeklycalendarTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OpsbiweeklycalendarTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OpsbiweeklycalendarTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OpsbiweeklycalendarQuery
