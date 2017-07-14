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
use lwops\lwops\Electricityallocation as ChildElectricityallocation;
use lwops\lwops\ElectricityallocationQuery as ChildElectricityallocationQuery;
use lwops\lwops\Map\ElectricityallocationTableMap;

/**
 * Base class that represents a query for the 'electricityallocation' table.
 *
 *
 *
 * @method     ChildElectricityallocationQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildElectricityallocationQuery orderByLineofbusinessoid($order = Criteria::ASC) Order by the lineOfBusinessOid column
 * @method     ChildElectricityallocationQuery orderByElectricityaccountoid($order = Criteria::ASC) Order by the electricityAccountOid column
 * @method     ChildElectricityallocationQuery orderByAllocation($order = Criteria::ASC) Order by the allocation column
 * @method     ChildElectricityallocationQuery orderByStartopsmonthlycalendaroid($order = Criteria::ASC) Order by the startOpsMonthlyCalendarOid column
 * @method     ChildElectricityallocationQuery orderByEndtopsmonthlycalendaroid($order = Criteria::ASC) Order by the endtOpsMonthlyCalendarOid column
 * @method     ChildElectricityallocationQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildElectricityallocationQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildElectricityallocationQuery groupByOid() Group by the oid column
 * @method     ChildElectricityallocationQuery groupByLineofbusinessoid() Group by the lineOfBusinessOid column
 * @method     ChildElectricityallocationQuery groupByElectricityaccountoid() Group by the electricityAccountOid column
 * @method     ChildElectricityallocationQuery groupByAllocation() Group by the allocation column
 * @method     ChildElectricityallocationQuery groupByStartopsmonthlycalendaroid() Group by the startOpsMonthlyCalendarOid column
 * @method     ChildElectricityallocationQuery groupByEndtopsmonthlycalendaroid() Group by the endtOpsMonthlyCalendarOid column
 * @method     ChildElectricityallocationQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildElectricityallocationQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildElectricityallocationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildElectricityallocationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildElectricityallocationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildElectricityallocationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildElectricityallocationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildElectricityallocationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildElectricityallocationQuery leftJoinElectricityaccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Electricityaccount relation
 * @method     ChildElectricityallocationQuery rightJoinElectricityaccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Electricityaccount relation
 * @method     ChildElectricityallocationQuery innerJoinElectricityaccount($relationAlias = null) Adds a INNER JOIN clause to the query using the Electricityaccount relation
 *
 * @method     ChildElectricityallocationQuery joinWithElectricityaccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Electricityaccount relation
 *
 * @method     ChildElectricityallocationQuery leftJoinWithElectricityaccount() Adds a LEFT JOIN clause and with to the query using the Electricityaccount relation
 * @method     ChildElectricityallocationQuery rightJoinWithElectricityaccount() Adds a RIGHT JOIN clause and with to the query using the Electricityaccount relation
 * @method     ChildElectricityallocationQuery innerJoinWithElectricityaccount() Adds a INNER JOIN clause and with to the query using the Electricityaccount relation
 *
 * @method     ChildElectricityallocationQuery leftJoinLineofbusiness($relationAlias = null) Adds a LEFT JOIN clause to the query using the Lineofbusiness relation
 * @method     ChildElectricityallocationQuery rightJoinLineofbusiness($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Lineofbusiness relation
 * @method     ChildElectricityallocationQuery innerJoinLineofbusiness($relationAlias = null) Adds a INNER JOIN clause to the query using the Lineofbusiness relation
 *
 * @method     ChildElectricityallocationQuery joinWithLineofbusiness($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Lineofbusiness relation
 *
 * @method     ChildElectricityallocationQuery leftJoinWithLineofbusiness() Adds a LEFT JOIN clause and with to the query using the Lineofbusiness relation
 * @method     ChildElectricityallocationQuery rightJoinWithLineofbusiness() Adds a RIGHT JOIN clause and with to the query using the Lineofbusiness relation
 * @method     ChildElectricityallocationQuery innerJoinWithLineofbusiness() Adds a INNER JOIN clause and with to the query using the Lineofbusiness relation
 *
 * @method     ChildElectricityallocationQuery leftJoinOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a LEFT JOIN clause to the query using the OpsmonthlycalendarRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildElectricityallocationQuery rightJoinOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OpsmonthlycalendarRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildElectricityallocationQuery innerJoinOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a INNER JOIN clause to the query using the OpsmonthlycalendarRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildElectricityallocationQuery joinWithOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OpsmonthlycalendarRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildElectricityallocationQuery leftJoinWithOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid() Adds a LEFT JOIN clause and with to the query using the OpsmonthlycalendarRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildElectricityallocationQuery rightJoinWithOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid() Adds a RIGHT JOIN clause and with to the query using the OpsmonthlycalendarRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildElectricityallocationQuery innerJoinWithOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid() Adds a INNER JOIN clause and with to the query using the OpsmonthlycalendarRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildElectricityallocationQuery leftJoinOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid($relationAlias = null) Adds a LEFT JOIN clause to the query using the OpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid relation
 * @method     ChildElectricityallocationQuery rightJoinOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid relation
 * @method     ChildElectricityallocationQuery innerJoinOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid($relationAlias = null) Adds a INNER JOIN clause to the query using the OpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid relation
 *
 * @method     ChildElectricityallocationQuery joinWithOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid relation
 *
 * @method     ChildElectricityallocationQuery leftJoinWithOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid() Adds a LEFT JOIN clause and with to the query using the OpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid relation
 * @method     ChildElectricityallocationQuery rightJoinWithOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid() Adds a RIGHT JOIN clause and with to the query using the OpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid relation
 * @method     ChildElectricityallocationQuery innerJoinWithOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid() Adds a INNER JOIN clause and with to the query using the OpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid relation
 *
 * @method     \lwops\lwops\ElectricityaccountQuery|\lwops\lwops\LineofbusinessQuery|\lwops\lwops\OpsmonthlycalendarQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildElectricityallocation findOne(ConnectionInterface $con = null) Return the first ChildElectricityallocation matching the query
 * @method     ChildElectricityallocation findOneOrCreate(ConnectionInterface $con = null) Return the first ChildElectricityallocation matching the query, or a new ChildElectricityallocation object populated from the query conditions when no match is found
 *
 * @method     ChildElectricityallocation findOneByOid(int $oid) Return the first ChildElectricityallocation filtered by the oid column
 * @method     ChildElectricityallocation findOneByLineofbusinessoid(int $lineOfBusinessOid) Return the first ChildElectricityallocation filtered by the lineOfBusinessOid column
 * @method     ChildElectricityallocation findOneByElectricityaccountoid(int $electricityAccountOid) Return the first ChildElectricityallocation filtered by the electricityAccountOid column
 * @method     ChildElectricityallocation findOneByAllocation(int $allocation) Return the first ChildElectricityallocation filtered by the allocation column
 * @method     ChildElectricityallocation findOneByStartopsmonthlycalendaroid(int $startOpsMonthlyCalendarOid) Return the first ChildElectricityallocation filtered by the startOpsMonthlyCalendarOid column
 * @method     ChildElectricityallocation findOneByEndtopsmonthlycalendaroid(int $endtOpsMonthlyCalendarOid) Return the first ChildElectricityallocation filtered by the endtOpsMonthlyCalendarOid column
 * @method     ChildElectricityallocation findOneByCreatetmstp(string $createTmstp) Return the first ChildElectricityallocation filtered by the createTmstp column
 * @method     ChildElectricityallocation findOneByUpdttmstp(string $updtTmstp) Return the first ChildElectricityallocation filtered by the updtTmstp column *

 * @method     ChildElectricityallocation requirePk($key, ConnectionInterface $con = null) Return the ChildElectricityallocation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityallocation requireOne(ConnectionInterface $con = null) Return the first ChildElectricityallocation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildElectricityallocation requireOneByOid(int $oid) Return the first ChildElectricityallocation filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityallocation requireOneByLineofbusinessoid(int $lineOfBusinessOid) Return the first ChildElectricityallocation filtered by the lineOfBusinessOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityallocation requireOneByElectricityaccountoid(int $electricityAccountOid) Return the first ChildElectricityallocation filtered by the electricityAccountOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityallocation requireOneByAllocation(int $allocation) Return the first ChildElectricityallocation filtered by the allocation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityallocation requireOneByStartopsmonthlycalendaroid(int $startOpsMonthlyCalendarOid) Return the first ChildElectricityallocation filtered by the startOpsMonthlyCalendarOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityallocation requireOneByEndtopsmonthlycalendaroid(int $endtOpsMonthlyCalendarOid) Return the first ChildElectricityallocation filtered by the endtOpsMonthlyCalendarOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityallocation requireOneByCreatetmstp(string $createTmstp) Return the first ChildElectricityallocation filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityallocation requireOneByUpdttmstp(string $updtTmstp) Return the first ChildElectricityallocation filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildElectricityallocation[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildElectricityallocation objects based on current ModelCriteria
 * @method     ChildElectricityallocation[]|ObjectCollection findByOid(int $oid) Return ChildElectricityallocation objects filtered by the oid column
 * @method     ChildElectricityallocation[]|ObjectCollection findByLineofbusinessoid(int $lineOfBusinessOid) Return ChildElectricityallocation objects filtered by the lineOfBusinessOid column
 * @method     ChildElectricityallocation[]|ObjectCollection findByElectricityaccountoid(int $electricityAccountOid) Return ChildElectricityallocation objects filtered by the electricityAccountOid column
 * @method     ChildElectricityallocation[]|ObjectCollection findByAllocation(int $allocation) Return ChildElectricityallocation objects filtered by the allocation column
 * @method     ChildElectricityallocation[]|ObjectCollection findByStartopsmonthlycalendaroid(int $startOpsMonthlyCalendarOid) Return ChildElectricityallocation objects filtered by the startOpsMonthlyCalendarOid column
 * @method     ChildElectricityallocation[]|ObjectCollection findByEndtopsmonthlycalendaroid(int $endtOpsMonthlyCalendarOid) Return ChildElectricityallocation objects filtered by the endtOpsMonthlyCalendarOid column
 * @method     ChildElectricityallocation[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildElectricityallocation objects filtered by the createTmstp column
 * @method     ChildElectricityallocation[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildElectricityallocation objects filtered by the updtTmstp column
 * @method     ChildElectricityallocation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ElectricityallocationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\ElectricityallocationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Electricityallocation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildElectricityallocationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildElectricityallocationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildElectricityallocationQuery) {
            return $criteria;
        }
        $query = new ChildElectricityallocationQuery();
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
     * @return ChildElectricityallocation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ElectricityallocationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ElectricityallocationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildElectricityallocation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, lineOfBusinessOid, electricityAccountOid, allocation, startOpsMonthlyCalendarOid, endtOpsMonthlyCalendarOid, createTmstp, updtTmstp FROM electricityallocation WHERE oid = :p0';
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
            /** @var ChildElectricityallocation $obj */
            $obj = new ChildElectricityallocation();
            $obj->hydrate($row);
            ElectricityallocationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildElectricityallocation|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ElectricityallocationTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ElectricityallocationTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityallocationTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the lineOfBusinessOid column
     *
     * Example usage:
     * <code>
     * $query->filterByLineofbusinessoid(1234); // WHERE lineOfBusinessOid = 1234
     * $query->filterByLineofbusinessoid(array(12, 34)); // WHERE lineOfBusinessOid IN (12, 34)
     * $query->filterByLineofbusinessoid(array('min' => 12)); // WHERE lineOfBusinessOid > 12
     * </code>
     *
     * @see       filterByLineofbusiness()
     *
     * @param     mixed $lineofbusinessoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function filterByLineofbusinessoid($lineofbusinessoid = null, $comparison = null)
    {
        if (is_array($lineofbusinessoid)) {
            $useMinMax = false;
            if (isset($lineofbusinessoid['min'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lineofbusinessoid['max'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityallocationTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid, $comparison);
    }

    /**
     * Filter the query on the electricityAccountOid column
     *
     * Example usage:
     * <code>
     * $query->filterByElectricityaccountoid(1234); // WHERE electricityAccountOid = 1234
     * $query->filterByElectricityaccountoid(array(12, 34)); // WHERE electricityAccountOid IN (12, 34)
     * $query->filterByElectricityaccountoid(array('min' => 12)); // WHERE electricityAccountOid > 12
     * </code>
     *
     * @see       filterByElectricityaccount()
     *
     * @param     mixed $electricityaccountoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function filterByElectricityaccountoid($electricityaccountoid = null, $comparison = null)
    {
        if (is_array($electricityaccountoid)) {
            $useMinMax = false;
            if (isset($electricityaccountoid['min'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_ELECTRICITYACCOUNTOID, $electricityaccountoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($electricityaccountoid['max'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_ELECTRICITYACCOUNTOID, $electricityaccountoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityallocationTableMap::COL_ELECTRICITYACCOUNTOID, $electricityaccountoid, $comparison);
    }

    /**
     * Filter the query on the allocation column
     *
     * Example usage:
     * <code>
     * $query->filterByAllocation(1234); // WHERE allocation = 1234
     * $query->filterByAllocation(array(12, 34)); // WHERE allocation IN (12, 34)
     * $query->filterByAllocation(array('min' => 12)); // WHERE allocation > 12
     * </code>
     *
     * @param     mixed $allocation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function filterByAllocation($allocation = null, $comparison = null)
    {
        if (is_array($allocation)) {
            $useMinMax = false;
            if (isset($allocation['min'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_ALLOCATION, $allocation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($allocation['max'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_ALLOCATION, $allocation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityallocationTableMap::COL_ALLOCATION, $allocation, $comparison);
    }

    /**
     * Filter the query on the startOpsMonthlyCalendarOid column
     *
     * Example usage:
     * <code>
     * $query->filterByStartopsmonthlycalendaroid(1234); // WHERE startOpsMonthlyCalendarOid = 1234
     * $query->filterByStartopsmonthlycalendaroid(array(12, 34)); // WHERE startOpsMonthlyCalendarOid IN (12, 34)
     * $query->filterByStartopsmonthlycalendaroid(array('min' => 12)); // WHERE startOpsMonthlyCalendarOid > 12
     * </code>
     *
     * @see       filterByOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid()
     *
     * @param     mixed $startopsmonthlycalendaroid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function filterByStartopsmonthlycalendaroid($startopsmonthlycalendaroid = null, $comparison = null)
    {
        if (is_array($startopsmonthlycalendaroid)) {
            $useMinMax = false;
            if (isset($startopsmonthlycalendaroid['min'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_STARTOPSMONTHLYCALENDAROID, $startopsmonthlycalendaroid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startopsmonthlycalendaroid['max'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_STARTOPSMONTHLYCALENDAROID, $startopsmonthlycalendaroid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityallocationTableMap::COL_STARTOPSMONTHLYCALENDAROID, $startopsmonthlycalendaroid, $comparison);
    }

    /**
     * Filter the query on the endtOpsMonthlyCalendarOid column
     *
     * Example usage:
     * <code>
     * $query->filterByEndtopsmonthlycalendaroid(1234); // WHERE endtOpsMonthlyCalendarOid = 1234
     * $query->filterByEndtopsmonthlycalendaroid(array(12, 34)); // WHERE endtOpsMonthlyCalendarOid IN (12, 34)
     * $query->filterByEndtopsmonthlycalendaroid(array('min' => 12)); // WHERE endtOpsMonthlyCalendarOid > 12
     * </code>
     *
     * @see       filterByOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid()
     *
     * @param     mixed $endtopsmonthlycalendaroid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function filterByEndtopsmonthlycalendaroid($endtopsmonthlycalendaroid = null, $comparison = null)
    {
        if (is_array($endtopsmonthlycalendaroid)) {
            $useMinMax = false;
            if (isset($endtopsmonthlycalendaroid['min'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_ENDTOPSMONTHLYCALENDAROID, $endtopsmonthlycalendaroid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endtopsmonthlycalendaroid['max'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_ENDTOPSMONTHLYCALENDAROID, $endtopsmonthlycalendaroid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityallocationTableMap::COL_ENDTOPSMONTHLYCALENDAROID, $endtopsmonthlycalendaroid, $comparison);
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
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityallocationTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(ElectricityallocationTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityallocationTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Electricityaccount object
     *
     * @param \lwops\lwops\Electricityaccount|ObjectCollection $electricityaccount The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function filterByElectricityaccount($electricityaccount, $comparison = null)
    {
        if ($electricityaccount instanceof \lwops\lwops\Electricityaccount) {
            return $this
                ->addUsingAlias(ElectricityallocationTableMap::COL_ELECTRICITYACCOUNTOID, $electricityaccount->getOid(), $comparison);
        } elseif ($electricityaccount instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ElectricityallocationTableMap::COL_ELECTRICITYACCOUNTOID, $electricityaccount->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Lineofbusiness object
     *
     * @param \lwops\lwops\Lineofbusiness|ObjectCollection $lineofbusiness The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function filterByLineofbusiness($lineofbusiness, $comparison = null)
    {
        if ($lineofbusiness instanceof \lwops\lwops\Lineofbusiness) {
            return $this
                ->addUsingAlias(ElectricityallocationTableMap::COL_LINEOFBUSINESSOID, $lineofbusiness->getOid(), $comparison);
        } elseif ($lineofbusiness instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ElectricityallocationTableMap::COL_LINEOFBUSINESSOID, $lineofbusiness->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByLineofbusiness() only accepts arguments of type \lwops\lwops\Lineofbusiness or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Lineofbusiness relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function joinLineofbusiness($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Lineofbusiness');

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
            $this->addJoinObject($join, 'Lineofbusiness');
        }

        return $this;
    }

    /**
     * Use the Lineofbusiness relation Lineofbusiness object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\LineofbusinessQuery A secondary query class using the current class as primary query
     */
    public function useLineofbusinessQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLineofbusiness($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Lineofbusiness', '\lwops\lwops\LineofbusinessQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Opsmonthlycalendar object
     *
     * @param \lwops\lwops\Opsmonthlycalendar|ObjectCollection $opsmonthlycalendar The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function filterByOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($opsmonthlycalendar, $comparison = null)
    {
        if ($opsmonthlycalendar instanceof \lwops\lwops\Opsmonthlycalendar) {
            return $this
                ->addUsingAlias(ElectricityallocationTableMap::COL_STARTOPSMONTHLYCALENDAROID, $opsmonthlycalendar->getOid(), $comparison);
        } elseif ($opsmonthlycalendar instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ElectricityallocationTableMap::COL_STARTOPSMONTHLYCALENDAROID, $opsmonthlycalendar->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid() only accepts arguments of type \lwops\lwops\Opsmonthlycalendar or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OpsmonthlycalendarRelatedByStartopsmonthlycalendaroid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function joinOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OpsmonthlycalendarRelatedByStartopsmonthlycalendaroid');

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
            $this->addJoinObject($join, 'OpsmonthlycalendarRelatedByStartopsmonthlycalendaroid');
        }

        return $this;
    }

    /**
     * Use the OpsmonthlycalendarRelatedByStartopsmonthlycalendaroid relation Opsmonthlycalendar object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\OpsmonthlycalendarQuery A secondary query class using the current class as primary query
     */
    public function useOpsmonthlycalendarRelatedByStartopsmonthlycalendaroidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OpsmonthlycalendarRelatedByStartopsmonthlycalendaroid', '\lwops\lwops\OpsmonthlycalendarQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Opsmonthlycalendar object
     *
     * @param \lwops\lwops\Opsmonthlycalendar|ObjectCollection $opsmonthlycalendar The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function filterByOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid($opsmonthlycalendar, $comparison = null)
    {
        if ($opsmonthlycalendar instanceof \lwops\lwops\Opsmonthlycalendar) {
            return $this
                ->addUsingAlias(ElectricityallocationTableMap::COL_ENDTOPSMONTHLYCALENDAROID, $opsmonthlycalendar->getOid(), $comparison);
        } elseif ($opsmonthlycalendar instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ElectricityallocationTableMap::COL_ENDTOPSMONTHLYCALENDAROID, $opsmonthlycalendar->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid() only accepts arguments of type \lwops\lwops\Opsmonthlycalendar or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function joinOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid');

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
            $this->addJoinObject($join, 'OpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid');
        }

        return $this;
    }

    /**
     * Use the OpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid relation Opsmonthlycalendar object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\OpsmonthlycalendarQuery A secondary query class using the current class as primary query
     */
    public function useOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroidQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid', '\lwops\lwops\OpsmonthlycalendarQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildElectricityallocation $electricityallocation Object to remove from the list of results
     *
     * @return $this|ChildElectricityallocationQuery The current query, for fluid interface
     */
    public function prune($electricityallocation = null)
    {
        if ($electricityallocation) {
            $this->addUsingAlias(ElectricityallocationTableMap::COL_OID, $electricityallocation->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the electricityallocation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ElectricityallocationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ElectricityallocationTableMap::clearInstancePool();
            ElectricityallocationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ElectricityallocationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ElectricityallocationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ElectricityallocationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ElectricityallocationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ElectricityallocationQuery
