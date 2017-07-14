<?php

namespace lwops\lwops\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use lwops\lwops\Opstimedimension as ChildOpstimedimension;
use lwops\lwops\OpstimedimensionQuery as ChildOpstimedimensionQuery;
use lwops\lwops\Map\OpstimedimensionTableMap;

/**
 * Base class that represents a query for the 'opstimedimension' table.
 *
 *
 *
 * @method     ChildOpstimedimensionQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildOpstimedimensionQuery orderByDbDate($order = Criteria::ASC) Order by the db_date column
 * @method     ChildOpstimedimensionQuery orderByYear($order = Criteria::ASC) Order by the year column
 * @method     ChildOpstimedimensionQuery orderByMonth($order = Criteria::ASC) Order by the month column
 * @method     ChildOpstimedimensionQuery orderByDay($order = Criteria::ASC) Order by the day column
 * @method     ChildOpstimedimensionQuery orderByQuarter($order = Criteria::ASC) Order by the quarter column
 * @method     ChildOpstimedimensionQuery orderByWeek($order = Criteria::ASC) Order by the week column
 * @method     ChildOpstimedimensionQuery orderByDayName($order = Criteria::ASC) Order by the day_name column
 * @method     ChildOpstimedimensionQuery orderByMonthName($order = Criteria::ASC) Order by the month_name column
 * @method     ChildOpstimedimensionQuery orderByHolidayFlag($order = Criteria::ASC) Order by the holiday_flag column
 * @method     ChildOpstimedimensionQuery orderByWeekendFlag($order = Criteria::ASC) Order by the weekend_flag column
 * @method     ChildOpstimedimensionQuery orderByEvent($order = Criteria::ASC) Order by the event column
 *
 * @method     ChildOpstimedimensionQuery groupByOid() Group by the oid column
 * @method     ChildOpstimedimensionQuery groupByDbDate() Group by the db_date column
 * @method     ChildOpstimedimensionQuery groupByYear() Group by the year column
 * @method     ChildOpstimedimensionQuery groupByMonth() Group by the month column
 * @method     ChildOpstimedimensionQuery groupByDay() Group by the day column
 * @method     ChildOpstimedimensionQuery groupByQuarter() Group by the quarter column
 * @method     ChildOpstimedimensionQuery groupByWeek() Group by the week column
 * @method     ChildOpstimedimensionQuery groupByDayName() Group by the day_name column
 * @method     ChildOpstimedimensionQuery groupByMonthName() Group by the month_name column
 * @method     ChildOpstimedimensionQuery groupByHolidayFlag() Group by the holiday_flag column
 * @method     ChildOpstimedimensionQuery groupByWeekendFlag() Group by the weekend_flag column
 * @method     ChildOpstimedimensionQuery groupByEvent() Group by the event column
 *
 * @method     ChildOpstimedimensionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOpstimedimensionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOpstimedimensionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOpstimedimensionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOpstimedimensionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOpstimedimensionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOpstimedimension findOne(ConnectionInterface $con = null) Return the first ChildOpstimedimension matching the query
 * @method     ChildOpstimedimension findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOpstimedimension matching the query, or a new ChildOpstimedimension object populated from the query conditions when no match is found
 *
 * @method     ChildOpstimedimension findOneByOid(int $oid) Return the first ChildOpstimedimension filtered by the oid column
 * @method     ChildOpstimedimension findOneByDbDate(string $db_date) Return the first ChildOpstimedimension filtered by the db_date column
 * @method     ChildOpstimedimension findOneByYear(int $year) Return the first ChildOpstimedimension filtered by the year column
 * @method     ChildOpstimedimension findOneByMonth(int $month) Return the first ChildOpstimedimension filtered by the month column
 * @method     ChildOpstimedimension findOneByDay(int $day) Return the first ChildOpstimedimension filtered by the day column
 * @method     ChildOpstimedimension findOneByQuarter(int $quarter) Return the first ChildOpstimedimension filtered by the quarter column
 * @method     ChildOpstimedimension findOneByWeek(int $week) Return the first ChildOpstimedimension filtered by the week column
 * @method     ChildOpstimedimension findOneByDayName(string $day_name) Return the first ChildOpstimedimension filtered by the day_name column
 * @method     ChildOpstimedimension findOneByMonthName(string $month_name) Return the first ChildOpstimedimension filtered by the month_name column
 * @method     ChildOpstimedimension findOneByHolidayFlag(string $holiday_flag) Return the first ChildOpstimedimension filtered by the holiday_flag column
 * @method     ChildOpstimedimension findOneByWeekendFlag(string $weekend_flag) Return the first ChildOpstimedimension filtered by the weekend_flag column
 * @method     ChildOpstimedimension findOneByEvent(string $event) Return the first ChildOpstimedimension filtered by the event column *

 * @method     ChildOpstimedimension requirePk($key, ConnectionInterface $con = null) Return the ChildOpstimedimension by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpstimedimension requireOne(ConnectionInterface $con = null) Return the first ChildOpstimedimension matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOpstimedimension requireOneByOid(int $oid) Return the first ChildOpstimedimension filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpstimedimension requireOneByDbDate(string $db_date) Return the first ChildOpstimedimension filtered by the db_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpstimedimension requireOneByYear(int $year) Return the first ChildOpstimedimension filtered by the year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpstimedimension requireOneByMonth(int $month) Return the first ChildOpstimedimension filtered by the month column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpstimedimension requireOneByDay(int $day) Return the first ChildOpstimedimension filtered by the day column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpstimedimension requireOneByQuarter(int $quarter) Return the first ChildOpstimedimension filtered by the quarter column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpstimedimension requireOneByWeek(int $week) Return the first ChildOpstimedimension filtered by the week column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpstimedimension requireOneByDayName(string $day_name) Return the first ChildOpstimedimension filtered by the day_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpstimedimension requireOneByMonthName(string $month_name) Return the first ChildOpstimedimension filtered by the month_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpstimedimension requireOneByHolidayFlag(string $holiday_flag) Return the first ChildOpstimedimension filtered by the holiday_flag column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpstimedimension requireOneByWeekendFlag(string $weekend_flag) Return the first ChildOpstimedimension filtered by the weekend_flag column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpstimedimension requireOneByEvent(string $event) Return the first ChildOpstimedimension filtered by the event column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOpstimedimension[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOpstimedimension objects based on current ModelCriteria
 * @method     ChildOpstimedimension[]|ObjectCollection findByOid(int $oid) Return ChildOpstimedimension objects filtered by the oid column
 * @method     ChildOpstimedimension[]|ObjectCollection findByDbDate(string $db_date) Return ChildOpstimedimension objects filtered by the db_date column
 * @method     ChildOpstimedimension[]|ObjectCollection findByYear(int $year) Return ChildOpstimedimension objects filtered by the year column
 * @method     ChildOpstimedimension[]|ObjectCollection findByMonth(int $month) Return ChildOpstimedimension objects filtered by the month column
 * @method     ChildOpstimedimension[]|ObjectCollection findByDay(int $day) Return ChildOpstimedimension objects filtered by the day column
 * @method     ChildOpstimedimension[]|ObjectCollection findByQuarter(int $quarter) Return ChildOpstimedimension objects filtered by the quarter column
 * @method     ChildOpstimedimension[]|ObjectCollection findByWeek(int $week) Return ChildOpstimedimension objects filtered by the week column
 * @method     ChildOpstimedimension[]|ObjectCollection findByDayName(string $day_name) Return ChildOpstimedimension objects filtered by the day_name column
 * @method     ChildOpstimedimension[]|ObjectCollection findByMonthName(string $month_name) Return ChildOpstimedimension objects filtered by the month_name column
 * @method     ChildOpstimedimension[]|ObjectCollection findByHolidayFlag(string $holiday_flag) Return ChildOpstimedimension objects filtered by the holiday_flag column
 * @method     ChildOpstimedimension[]|ObjectCollection findByWeekendFlag(string $weekend_flag) Return ChildOpstimedimension objects filtered by the weekend_flag column
 * @method     ChildOpstimedimension[]|ObjectCollection findByEvent(string $event) Return ChildOpstimedimension objects filtered by the event column
 * @method     ChildOpstimedimension[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OpstimedimensionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\OpstimedimensionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Opstimedimension', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOpstimedimensionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOpstimedimensionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOpstimedimensionQuery) {
            return $criteria;
        }
        $query = new ChildOpstimedimensionQuery();
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
     * @return ChildOpstimedimension|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OpstimedimensionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OpstimedimensionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOpstimedimension A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, db_date, year, month, day, quarter, week, day_name, month_name, holiday_flag, weekend_flag, event FROM opstimedimension WHERE oid = :p0';
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
            /** @var ChildOpstimedimension $obj */
            $obj = new ChildOpstimedimension();
            $obj->hydrate($row);
            OpstimedimensionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOpstimedimension|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OpstimedimensionTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OpstimedimensionTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(OpstimedimensionTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(OpstimedimensionTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpstimedimensionTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the db_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDbDate('2011-03-14'); // WHERE db_date = '2011-03-14'
     * $query->filterByDbDate('now'); // WHERE db_date = '2011-03-14'
     * $query->filterByDbDate(array('max' => 'yesterday')); // WHERE db_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $dbDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function filterByDbDate($dbDate = null, $comparison = null)
    {
        if (is_array($dbDate)) {
            $useMinMax = false;
            if (isset($dbDate['min'])) {
                $this->addUsingAlias(OpstimedimensionTableMap::COL_DB_DATE, $dbDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dbDate['max'])) {
                $this->addUsingAlias(OpstimedimensionTableMap::COL_DB_DATE, $dbDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpstimedimensionTableMap::COL_DB_DATE, $dbDate, $comparison);
    }

    /**
     * Filter the query on the year column
     *
     * Example usage:
     * <code>
     * $query->filterByYear(1234); // WHERE year = 1234
     * $query->filterByYear(array(12, 34)); // WHERE year IN (12, 34)
     * $query->filterByYear(array('min' => 12)); // WHERE year > 12
     * </code>
     *
     * @param     mixed $year The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function filterByYear($year = null, $comparison = null)
    {
        if (is_array($year)) {
            $useMinMax = false;
            if (isset($year['min'])) {
                $this->addUsingAlias(OpstimedimensionTableMap::COL_YEAR, $year['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($year['max'])) {
                $this->addUsingAlias(OpstimedimensionTableMap::COL_YEAR, $year['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpstimedimensionTableMap::COL_YEAR, $year, $comparison);
    }

    /**
     * Filter the query on the month column
     *
     * Example usage:
     * <code>
     * $query->filterByMonth(1234); // WHERE month = 1234
     * $query->filterByMonth(array(12, 34)); // WHERE month IN (12, 34)
     * $query->filterByMonth(array('min' => 12)); // WHERE month > 12
     * </code>
     *
     * @param     mixed $month The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function filterByMonth($month = null, $comparison = null)
    {
        if (is_array($month)) {
            $useMinMax = false;
            if (isset($month['min'])) {
                $this->addUsingAlias(OpstimedimensionTableMap::COL_MONTH, $month['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($month['max'])) {
                $this->addUsingAlias(OpstimedimensionTableMap::COL_MONTH, $month['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpstimedimensionTableMap::COL_MONTH, $month, $comparison);
    }

    /**
     * Filter the query on the day column
     *
     * Example usage:
     * <code>
     * $query->filterByDay(1234); // WHERE day = 1234
     * $query->filterByDay(array(12, 34)); // WHERE day IN (12, 34)
     * $query->filterByDay(array('min' => 12)); // WHERE day > 12
     * </code>
     *
     * @param     mixed $day The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function filterByDay($day = null, $comparison = null)
    {
        if (is_array($day)) {
            $useMinMax = false;
            if (isset($day['min'])) {
                $this->addUsingAlias(OpstimedimensionTableMap::COL_DAY, $day['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($day['max'])) {
                $this->addUsingAlias(OpstimedimensionTableMap::COL_DAY, $day['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpstimedimensionTableMap::COL_DAY, $day, $comparison);
    }

    /**
     * Filter the query on the quarter column
     *
     * Example usage:
     * <code>
     * $query->filterByQuarter(1234); // WHERE quarter = 1234
     * $query->filterByQuarter(array(12, 34)); // WHERE quarter IN (12, 34)
     * $query->filterByQuarter(array('min' => 12)); // WHERE quarter > 12
     * </code>
     *
     * @param     mixed $quarter The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function filterByQuarter($quarter = null, $comparison = null)
    {
        if (is_array($quarter)) {
            $useMinMax = false;
            if (isset($quarter['min'])) {
                $this->addUsingAlias(OpstimedimensionTableMap::COL_QUARTER, $quarter['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quarter['max'])) {
                $this->addUsingAlias(OpstimedimensionTableMap::COL_QUARTER, $quarter['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpstimedimensionTableMap::COL_QUARTER, $quarter, $comparison);
    }

    /**
     * Filter the query on the week column
     *
     * Example usage:
     * <code>
     * $query->filterByWeek(1234); // WHERE week = 1234
     * $query->filterByWeek(array(12, 34)); // WHERE week IN (12, 34)
     * $query->filterByWeek(array('min' => 12)); // WHERE week > 12
     * </code>
     *
     * @param     mixed $week The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function filterByWeek($week = null, $comparison = null)
    {
        if (is_array($week)) {
            $useMinMax = false;
            if (isset($week['min'])) {
                $this->addUsingAlias(OpstimedimensionTableMap::COL_WEEK, $week['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($week['max'])) {
                $this->addUsingAlias(OpstimedimensionTableMap::COL_WEEK, $week['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpstimedimensionTableMap::COL_WEEK, $week, $comparison);
    }

    /**
     * Filter the query on the day_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDayName('fooValue');   // WHERE day_name = 'fooValue'
     * $query->filterByDayName('%fooValue%', Criteria::LIKE); // WHERE day_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dayName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function filterByDayName($dayName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dayName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpstimedimensionTableMap::COL_DAY_NAME, $dayName, $comparison);
    }

    /**
     * Filter the query on the month_name column
     *
     * Example usage:
     * <code>
     * $query->filterByMonthName('fooValue');   // WHERE month_name = 'fooValue'
     * $query->filterByMonthName('%fooValue%', Criteria::LIKE); // WHERE month_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $monthName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function filterByMonthName($monthName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($monthName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpstimedimensionTableMap::COL_MONTH_NAME, $monthName, $comparison);
    }

    /**
     * Filter the query on the holiday_flag column
     *
     * Example usage:
     * <code>
     * $query->filterByHolidayFlag('fooValue');   // WHERE holiday_flag = 'fooValue'
     * $query->filterByHolidayFlag('%fooValue%', Criteria::LIKE); // WHERE holiday_flag LIKE '%fooValue%'
     * </code>
     *
     * @param     string $holidayFlag The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function filterByHolidayFlag($holidayFlag = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($holidayFlag)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpstimedimensionTableMap::COL_HOLIDAY_FLAG, $holidayFlag, $comparison);
    }

    /**
     * Filter the query on the weekend_flag column
     *
     * Example usage:
     * <code>
     * $query->filterByWeekendFlag('fooValue');   // WHERE weekend_flag = 'fooValue'
     * $query->filterByWeekendFlag('%fooValue%', Criteria::LIKE); // WHERE weekend_flag LIKE '%fooValue%'
     * </code>
     *
     * @param     string $weekendFlag The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function filterByWeekendFlag($weekendFlag = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($weekendFlag)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpstimedimensionTableMap::COL_WEEKEND_FLAG, $weekendFlag, $comparison);
    }

    /**
     * Filter the query on the event column
     *
     * Example usage:
     * <code>
     * $query->filterByEvent('fooValue');   // WHERE event = 'fooValue'
     * $query->filterByEvent('%fooValue%', Criteria::LIKE); // WHERE event LIKE '%fooValue%'
     * </code>
     *
     * @param     string $event The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function filterByEvent($event = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($event)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpstimedimensionTableMap::COL_EVENT, $event, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildOpstimedimension $opstimedimension Object to remove from the list of results
     *
     * @return $this|ChildOpstimedimensionQuery The current query, for fluid interface
     */
    public function prune($opstimedimension = null)
    {
        if ($opstimedimension) {
            $this->addUsingAlias(OpstimedimensionTableMap::COL_OID, $opstimedimension->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the opstimedimension table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OpstimedimensionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OpstimedimensionTableMap::clearInstancePool();
            OpstimedimensionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OpstimedimensionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OpstimedimensionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OpstimedimensionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OpstimedimensionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OpstimedimensionQuery
