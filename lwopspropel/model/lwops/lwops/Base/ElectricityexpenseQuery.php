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
use lwops\lwops\Electricityexpense as ChildElectricityexpense;
use lwops\lwops\ElectricityexpenseQuery as ChildElectricityexpenseQuery;
use lwops\lwops\Map\ElectricityexpenseTableMap;

/**
 * Base class that represents a query for the 'electricityexpense' table.
 *
 *
 *
 * @method     ChildElectricityexpenseQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildElectricityexpenseQuery orderByOpsmonthlycalendaroid($order = Criteria::ASC) Order by the opsMonthlyCalendarOid column
 * @method     ChildElectricityexpenseQuery orderByElectricityaccounoid($order = Criteria::ASC) Order by the electricityAccounOid column
 * @method     ChildElectricityexpenseQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildElectricityexpenseQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildElectricityexpenseQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildElectricityexpenseQuery groupByOid() Group by the oid column
 * @method     ChildElectricityexpenseQuery groupByOpsmonthlycalendaroid() Group by the opsMonthlyCalendarOid column
 * @method     ChildElectricityexpenseQuery groupByElectricityaccounoid() Group by the electricityAccounOid column
 * @method     ChildElectricityexpenseQuery groupByAmount() Group by the amount column
 * @method     ChildElectricityexpenseQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildElectricityexpenseQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildElectricityexpenseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildElectricityexpenseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildElectricityexpenseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildElectricityexpenseQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildElectricityexpenseQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildElectricityexpenseQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildElectricityexpenseQuery leftJoinElectricityaccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Electricityaccount relation
 * @method     ChildElectricityexpenseQuery rightJoinElectricityaccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Electricityaccount relation
 * @method     ChildElectricityexpenseQuery innerJoinElectricityaccount($relationAlias = null) Adds a INNER JOIN clause to the query using the Electricityaccount relation
 *
 * @method     ChildElectricityexpenseQuery joinWithElectricityaccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Electricityaccount relation
 *
 * @method     ChildElectricityexpenseQuery leftJoinWithElectricityaccount() Adds a LEFT JOIN clause and with to the query using the Electricityaccount relation
 * @method     ChildElectricityexpenseQuery rightJoinWithElectricityaccount() Adds a RIGHT JOIN clause and with to the query using the Electricityaccount relation
 * @method     ChildElectricityexpenseQuery innerJoinWithElectricityaccount() Adds a INNER JOIN clause and with to the query using the Electricityaccount relation
 *
 * @method     ChildElectricityexpenseQuery leftJoinOpsmonthlycalendar($relationAlias = null) Adds a LEFT JOIN clause to the query using the Opsmonthlycalendar relation
 * @method     ChildElectricityexpenseQuery rightJoinOpsmonthlycalendar($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Opsmonthlycalendar relation
 * @method     ChildElectricityexpenseQuery innerJoinOpsmonthlycalendar($relationAlias = null) Adds a INNER JOIN clause to the query using the Opsmonthlycalendar relation
 *
 * @method     ChildElectricityexpenseQuery joinWithOpsmonthlycalendar($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Opsmonthlycalendar relation
 *
 * @method     ChildElectricityexpenseQuery leftJoinWithOpsmonthlycalendar() Adds a LEFT JOIN clause and with to the query using the Opsmonthlycalendar relation
 * @method     ChildElectricityexpenseQuery rightJoinWithOpsmonthlycalendar() Adds a RIGHT JOIN clause and with to the query using the Opsmonthlycalendar relation
 * @method     ChildElectricityexpenseQuery innerJoinWithOpsmonthlycalendar() Adds a INNER JOIN clause and with to the query using the Opsmonthlycalendar relation
 *
 * @method     \lwops\lwops\ElectricityaccountQuery|\lwops\lwops\OpsmonthlycalendarQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildElectricityexpense findOne(ConnectionInterface $con = null) Return the first ChildElectricityexpense matching the query
 * @method     ChildElectricityexpense findOneOrCreate(ConnectionInterface $con = null) Return the first ChildElectricityexpense matching the query, or a new ChildElectricityexpense object populated from the query conditions when no match is found
 *
 * @method     ChildElectricityexpense findOneByOid(int $oid) Return the first ChildElectricityexpense filtered by the oid column
 * @method     ChildElectricityexpense findOneByOpsmonthlycalendaroid(int $opsMonthlyCalendarOid) Return the first ChildElectricityexpense filtered by the opsMonthlyCalendarOid column
 * @method     ChildElectricityexpense findOneByElectricityaccounoid(int $electricityAccounOid) Return the first ChildElectricityexpense filtered by the electricityAccounOid column
 * @method     ChildElectricityexpense findOneByAmount(double $amount) Return the first ChildElectricityexpense filtered by the amount column
 * @method     ChildElectricityexpense findOneByCreatetmstp(string $createTmstp) Return the first ChildElectricityexpense filtered by the createTmstp column
 * @method     ChildElectricityexpense findOneByUpdttmstp(string $updtTmstp) Return the first ChildElectricityexpense filtered by the updtTmstp column *

 * @method     ChildElectricityexpense requirePk($key, ConnectionInterface $con = null) Return the ChildElectricityexpense by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityexpense requireOne(ConnectionInterface $con = null) Return the first ChildElectricityexpense matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildElectricityexpense requireOneByOid(int $oid) Return the first ChildElectricityexpense filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityexpense requireOneByOpsmonthlycalendaroid(int $opsMonthlyCalendarOid) Return the first ChildElectricityexpense filtered by the opsMonthlyCalendarOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityexpense requireOneByElectricityaccounoid(int $electricityAccounOid) Return the first ChildElectricityexpense filtered by the electricityAccounOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityexpense requireOneByAmount(double $amount) Return the first ChildElectricityexpense filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityexpense requireOneByCreatetmstp(string $createTmstp) Return the first ChildElectricityexpense filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityexpense requireOneByUpdttmstp(string $updtTmstp) Return the first ChildElectricityexpense filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildElectricityexpense[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildElectricityexpense objects based on current ModelCriteria
 * @method     ChildElectricityexpense[]|ObjectCollection findByOid(int $oid) Return ChildElectricityexpense objects filtered by the oid column
 * @method     ChildElectricityexpense[]|ObjectCollection findByOpsmonthlycalendaroid(int $opsMonthlyCalendarOid) Return ChildElectricityexpense objects filtered by the opsMonthlyCalendarOid column
 * @method     ChildElectricityexpense[]|ObjectCollection findByElectricityaccounoid(int $electricityAccounOid) Return ChildElectricityexpense objects filtered by the electricityAccounOid column
 * @method     ChildElectricityexpense[]|ObjectCollection findByAmount(double $amount) Return ChildElectricityexpense objects filtered by the amount column
 * @method     ChildElectricityexpense[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildElectricityexpense objects filtered by the createTmstp column
 * @method     ChildElectricityexpense[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildElectricityexpense objects filtered by the updtTmstp column
 * @method     ChildElectricityexpense[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ElectricityexpenseQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\ElectricityexpenseQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Electricityexpense', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildElectricityexpenseQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildElectricityexpenseQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildElectricityexpenseQuery) {
            return $criteria;
        }
        $query = new ChildElectricityexpenseQuery();
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
     * @return ChildElectricityexpense|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ElectricityexpenseTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ElectricityexpenseTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildElectricityexpense A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, opsMonthlyCalendarOid, electricityAccounOid, amount, createTmstp, updtTmstp FROM electricityexpense WHERE oid = :p0';
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
            /** @var ChildElectricityexpense $obj */
            $obj = new ChildElectricityexpense();
            $obj->hydrate($row);
            ElectricityexpenseTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildElectricityexpense|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildElectricityexpenseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ElectricityexpenseTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildElectricityexpenseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ElectricityexpenseTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildElectricityexpenseQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(ElectricityexpenseTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(ElectricityexpenseTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityexpenseTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the opsMonthlyCalendarOid column
     *
     * Example usage:
     * <code>
     * $query->filterByOpsmonthlycalendaroid(1234); // WHERE opsMonthlyCalendarOid = 1234
     * $query->filterByOpsmonthlycalendaroid(array(12, 34)); // WHERE opsMonthlyCalendarOid IN (12, 34)
     * $query->filterByOpsmonthlycalendaroid(array('min' => 12)); // WHERE opsMonthlyCalendarOid > 12
     * </code>
     *
     * @see       filterByOpsmonthlycalendar()
     *
     * @param     mixed $opsmonthlycalendaroid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElectricityexpenseQuery The current query, for fluid interface
     */
    public function filterByOpsmonthlycalendaroid($opsmonthlycalendaroid = null, $comparison = null)
    {
        if (is_array($opsmonthlycalendaroid)) {
            $useMinMax = false;
            if (isset($opsmonthlycalendaroid['min'])) {
                $this->addUsingAlias(ElectricityexpenseTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendaroid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($opsmonthlycalendaroid['max'])) {
                $this->addUsingAlias(ElectricityexpenseTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendaroid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityexpenseTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendaroid, $comparison);
    }

    /**
     * Filter the query on the electricityAccounOid column
     *
     * Example usage:
     * <code>
     * $query->filterByElectricityaccounoid(1234); // WHERE electricityAccounOid = 1234
     * $query->filterByElectricityaccounoid(array(12, 34)); // WHERE electricityAccounOid IN (12, 34)
     * $query->filterByElectricityaccounoid(array('min' => 12)); // WHERE electricityAccounOid > 12
     * </code>
     *
     * @see       filterByElectricityaccount()
     *
     * @param     mixed $electricityaccounoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElectricityexpenseQuery The current query, for fluid interface
     */
    public function filterByElectricityaccounoid($electricityaccounoid = null, $comparison = null)
    {
        if (is_array($electricityaccounoid)) {
            $useMinMax = false;
            if (isset($electricityaccounoid['min'])) {
                $this->addUsingAlias(ElectricityexpenseTableMap::COL_ELECTRICITYACCOUNOID, $electricityaccounoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($electricityaccounoid['max'])) {
                $this->addUsingAlias(ElectricityexpenseTableMap::COL_ELECTRICITYACCOUNOID, $electricityaccounoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityexpenseTableMap::COL_ELECTRICITYACCOUNOID, $electricityaccounoid, $comparison);
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount > 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElectricityexpenseQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(ElectricityexpenseTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(ElectricityexpenseTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityexpenseTableMap::COL_AMOUNT, $amount, $comparison);
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
     * @return $this|ChildElectricityexpenseQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(ElectricityexpenseTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(ElectricityexpenseTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityexpenseTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildElectricityexpenseQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(ElectricityexpenseTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(ElectricityexpenseTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityexpenseTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Electricityaccount object
     *
     * @param \lwops\lwops\Electricityaccount|ObjectCollection $electricityaccount The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildElectricityexpenseQuery The current query, for fluid interface
     */
    public function filterByElectricityaccount($electricityaccount, $comparison = null)
    {
        if ($electricityaccount instanceof \lwops\lwops\Electricityaccount) {
            return $this
                ->addUsingAlias(ElectricityexpenseTableMap::COL_ELECTRICITYACCOUNOID, $electricityaccount->getOid(), $comparison);
        } elseif ($electricityaccount instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ElectricityexpenseTableMap::COL_ELECTRICITYACCOUNOID, $electricityaccount->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByElectricityaccount() only accepts arguments of type \lwops\lwops\Electricityaccount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Electricityaccount relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildElectricityexpenseQuery The current query, for fluid interface
     */
    public function joinElectricityaccount($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Electricityaccount');

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
            $this->addJoinObject($join, 'Electricityaccount');
        }

        return $this;
    }

    /**
     * Use the Electricityaccount relation Electricityaccount object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\ElectricityaccountQuery A secondary query class using the current class as primary query
     */
    public function useElectricityaccountQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinElectricityaccount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Electricityaccount', '\lwops\lwops\ElectricityaccountQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Opsmonthlycalendar object
     *
     * @param \lwops\lwops\Opsmonthlycalendar|ObjectCollection $opsmonthlycalendar The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildElectricityexpenseQuery The current query, for fluid interface
     */
    public function filterByOpsmonthlycalendar($opsmonthlycalendar, $comparison = null)
    {
        if ($opsmonthlycalendar instanceof \lwops\lwops\Opsmonthlycalendar) {
            return $this
                ->addUsingAlias(ElectricityexpenseTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendar->getOid(), $comparison);
        } elseif ($opsmonthlycalendar instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ElectricityexpenseTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendar->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByOpsmonthlycalendar() only accepts arguments of type \lwops\lwops\Opsmonthlycalendar or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Opsmonthlycalendar relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildElectricityexpenseQuery The current query, for fluid interface
     */
    public function joinOpsmonthlycalendar($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Opsmonthlycalendar');

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
            $this->addJoinObject($join, 'Opsmonthlycalendar');
        }

        return $this;
    }

    /**
     * Use the Opsmonthlycalendar relation Opsmonthlycalendar object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\OpsmonthlycalendarQuery A secondary query class using the current class as primary query
     */
    public function useOpsmonthlycalendarQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOpsmonthlycalendar($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Opsmonthlycalendar', '\lwops\lwops\OpsmonthlycalendarQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildElectricityexpense $electricityexpense Object to remove from the list of results
     *
     * @return $this|ChildElectricityexpenseQuery The current query, for fluid interface
     */
    public function prune($electricityexpense = null)
    {
        if ($electricityexpense) {
            $this->addUsingAlias(ElectricityexpenseTableMap::COL_OID, $electricityexpense->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the electricityexpense table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ElectricityexpenseTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ElectricityexpenseTableMap::clearInstancePool();
            ElectricityexpenseTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ElectricityexpenseTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ElectricityexpenseTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ElectricityexpenseTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ElectricityexpenseTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ElectricityexpenseQuery
