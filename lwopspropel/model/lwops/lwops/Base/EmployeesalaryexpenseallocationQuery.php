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
use lwops\lwops\Employeesalaryexpenseallocation as ChildEmployeesalaryexpenseallocation;
use lwops\lwops\EmployeesalaryexpenseallocationQuery as ChildEmployeesalaryexpenseallocationQuery;
use lwops\lwops\Map\EmployeesalaryexpenseallocationTableMap;

/**
 * Base class that represents a query for the 'employeesalaryexpenseallocation' table.
 *
 *
 *
 * @method     ChildEmployeesalaryexpenseallocationQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildEmployeesalaryexpenseallocationQuery orderByEmployeeoid($order = Criteria::ASC) Order by the employeeOid column
 * @method     ChildEmployeesalaryexpenseallocationQuery orderByLineofbusinessoid($order = Criteria::ASC) Order by the lineOfBusinessOid column
 * @method     ChildEmployeesalaryexpenseallocationQuery orderByAllocation($order = Criteria::ASC) Order by the allocation column
 * @method     ChildEmployeesalaryexpenseallocationQuery orderByEffectivedt($order = Criteria::ASC) Order by the effectiveDt column
 * @method     ChildEmployeesalaryexpenseallocationQuery orderByEnddt($order = Criteria::ASC) Order by the endDt column
 * @method     ChildEmployeesalaryexpenseallocationQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildEmployeesalaryexpenseallocationQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildEmployeesalaryexpenseallocationQuery groupByOid() Group by the oid column
 * @method     ChildEmployeesalaryexpenseallocationQuery groupByEmployeeoid() Group by the employeeOid column
 * @method     ChildEmployeesalaryexpenseallocationQuery groupByLineofbusinessoid() Group by the lineOfBusinessOid column
 * @method     ChildEmployeesalaryexpenseallocationQuery groupByAllocation() Group by the allocation column
 * @method     ChildEmployeesalaryexpenseallocationQuery groupByEffectivedt() Group by the effectiveDt column
 * @method     ChildEmployeesalaryexpenseallocationQuery groupByEnddt() Group by the endDt column
 * @method     ChildEmployeesalaryexpenseallocationQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildEmployeesalaryexpenseallocationQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildEmployeesalaryexpenseallocationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeesalaryexpenseallocationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeesalaryexpenseallocationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeesalaryexpenseallocationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeesalaryexpenseallocationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeesalaryexpenseallocationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeesalaryexpenseallocationQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildEmployeesalaryexpenseallocationQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildEmployeesalaryexpenseallocationQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildEmployeesalaryexpenseallocationQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildEmployeesalaryexpenseallocationQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildEmployeesalaryexpenseallocationQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildEmployeesalaryexpenseallocationQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildEmployeesalaryexpenseallocationQuery leftJoinLineofbusiness($relationAlias = null) Adds a LEFT JOIN clause to the query using the Lineofbusiness relation
 * @method     ChildEmployeesalaryexpenseallocationQuery rightJoinLineofbusiness($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Lineofbusiness relation
 * @method     ChildEmployeesalaryexpenseallocationQuery innerJoinLineofbusiness($relationAlias = null) Adds a INNER JOIN clause to the query using the Lineofbusiness relation
 *
 * @method     ChildEmployeesalaryexpenseallocationQuery joinWithLineofbusiness($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Lineofbusiness relation
 *
 * @method     ChildEmployeesalaryexpenseallocationQuery leftJoinWithLineofbusiness() Adds a LEFT JOIN clause and with to the query using the Lineofbusiness relation
 * @method     ChildEmployeesalaryexpenseallocationQuery rightJoinWithLineofbusiness() Adds a RIGHT JOIN clause and with to the query using the Lineofbusiness relation
 * @method     ChildEmployeesalaryexpenseallocationQuery innerJoinWithLineofbusiness() Adds a INNER JOIN clause and with to the query using the Lineofbusiness relation
 *
 * @method     \lwops\lwops\EmployeeQuery|\lwops\lwops\LineofbusinessQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployeesalaryexpenseallocation findOne(ConnectionInterface $con = null) Return the first ChildEmployeesalaryexpenseallocation matching the query
 * @method     ChildEmployeesalaryexpenseallocation findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmployeesalaryexpenseallocation matching the query, or a new ChildEmployeesalaryexpenseallocation object populated from the query conditions when no match is found
 *
 * @method     ChildEmployeesalaryexpenseallocation findOneByOid(int $oid) Return the first ChildEmployeesalaryexpenseallocation filtered by the oid column
 * @method     ChildEmployeesalaryexpenseallocation findOneByEmployeeoid(int $employeeOid) Return the first ChildEmployeesalaryexpenseallocation filtered by the employeeOid column
 * @method     ChildEmployeesalaryexpenseallocation findOneByLineofbusinessoid(int $lineOfBusinessOid) Return the first ChildEmployeesalaryexpenseallocation filtered by the lineOfBusinessOid column
 * @method     ChildEmployeesalaryexpenseallocation findOneByAllocation(double $allocation) Return the first ChildEmployeesalaryexpenseallocation filtered by the allocation column
 * @method     ChildEmployeesalaryexpenseallocation findOneByEffectivedt(string $effectiveDt) Return the first ChildEmployeesalaryexpenseallocation filtered by the effectiveDt column
 * @method     ChildEmployeesalaryexpenseallocation findOneByEnddt(string $endDt) Return the first ChildEmployeesalaryexpenseallocation filtered by the endDt column
 * @method     ChildEmployeesalaryexpenseallocation findOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeesalaryexpenseallocation filtered by the createTmstp column
 * @method     ChildEmployeesalaryexpenseallocation findOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeesalaryexpenseallocation filtered by the updtTmstp column *

 * @method     ChildEmployeesalaryexpenseallocation requirePk($key, ConnectionInterface $con = null) Return the ChildEmployeesalaryexpenseallocation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeesalaryexpenseallocation requireOne(ConnectionInterface $con = null) Return the first ChildEmployeesalaryexpenseallocation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeesalaryexpenseallocation requireOneByOid(int $oid) Return the first ChildEmployeesalaryexpenseallocation filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeesalaryexpenseallocation requireOneByEmployeeoid(int $employeeOid) Return the first ChildEmployeesalaryexpenseallocation filtered by the employeeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeesalaryexpenseallocation requireOneByLineofbusinessoid(int $lineOfBusinessOid) Return the first ChildEmployeesalaryexpenseallocation filtered by the lineOfBusinessOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeesalaryexpenseallocation requireOneByAllocation(double $allocation) Return the first ChildEmployeesalaryexpenseallocation filtered by the allocation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeesalaryexpenseallocation requireOneByEffectivedt(string $effectiveDt) Return the first ChildEmployeesalaryexpenseallocation filtered by the effectiveDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeesalaryexpenseallocation requireOneByEnddt(string $endDt) Return the first ChildEmployeesalaryexpenseallocation filtered by the endDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeesalaryexpenseallocation requireOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeesalaryexpenseallocation filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeesalaryexpenseallocation requireOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeesalaryexpenseallocation filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeesalaryexpenseallocation[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmployeesalaryexpenseallocation objects based on current ModelCriteria
 * @method     ChildEmployeesalaryexpenseallocation[]|ObjectCollection findByOid(int $oid) Return ChildEmployeesalaryexpenseallocation objects filtered by the oid column
 * @method     ChildEmployeesalaryexpenseallocation[]|ObjectCollection findByEmployeeoid(int $employeeOid) Return ChildEmployeesalaryexpenseallocation objects filtered by the employeeOid column
 * @method     ChildEmployeesalaryexpenseallocation[]|ObjectCollection findByLineofbusinessoid(int $lineOfBusinessOid) Return ChildEmployeesalaryexpenseallocation objects filtered by the lineOfBusinessOid column
 * @method     ChildEmployeesalaryexpenseallocation[]|ObjectCollection findByAllocation(double $allocation) Return ChildEmployeesalaryexpenseallocation objects filtered by the allocation column
 * @method     ChildEmployeesalaryexpenseallocation[]|ObjectCollection findByEffectivedt(string $effectiveDt) Return ChildEmployeesalaryexpenseallocation objects filtered by the effectiveDt column
 * @method     ChildEmployeesalaryexpenseallocation[]|ObjectCollection findByEnddt(string $endDt) Return ChildEmployeesalaryexpenseallocation objects filtered by the endDt column
 * @method     ChildEmployeesalaryexpenseallocation[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildEmployeesalaryexpenseallocation objects filtered by the createTmstp column
 * @method     ChildEmployeesalaryexpenseallocation[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildEmployeesalaryexpenseallocation objects filtered by the updtTmstp column
 * @method     ChildEmployeesalaryexpenseallocation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmployeesalaryexpenseallocationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\EmployeesalaryexpenseallocationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Employeesalaryexpenseallocation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeesalaryexpenseallocationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeesalaryexpenseallocationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmployeesalaryexpenseallocationQuery) {
            return $criteria;
        }
        $query = new ChildEmployeesalaryexpenseallocationQuery();
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
     * @return ChildEmployeesalaryexpenseallocation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeesalaryexpenseallocationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeesalaryexpenseallocationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployeesalaryexpenseallocation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, employeeOid, lineOfBusinessOid, allocation, effectiveDt, endDt, createTmstp, updtTmstp FROM employeesalaryexpenseallocation WHERE oid = :p0';
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
            /** @var ChildEmployeesalaryexpenseallocation $obj */
            $obj = new ChildEmployeesalaryexpenseallocation();
            $obj->hydrate($row);
            EmployeesalaryexpenseallocationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployeesalaryexpenseallocation|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the employeeOid column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeoid(1234); // WHERE employeeOid = 1234
     * $query->filterByEmployeeoid(array(12, 34)); // WHERE employeeOid IN (12, 34)
     * $query->filterByEmployeeoid(array('min' => 12)); // WHERE employeeOid > 12
     * </code>
     *
     * @see       filterByEmployee()
     *
     * @param     mixed $employeeoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
     */
    public function filterByEmployeeoid($employeeoid = null, $comparison = null)
    {
        if (is_array($employeeoid)) {
            $useMinMax = false;
            if (isset($employeeoid['min'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_EMPLOYEEOID, $employeeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeoid['max'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_EMPLOYEEOID, $employeeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_EMPLOYEEOID, $employeeoid, $comparison);
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
     * @return $this|ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
     */
    public function filterByLineofbusinessoid($lineofbusinessoid = null, $comparison = null)
    {
        if (is_array($lineofbusinessoid)) {
            $useMinMax = false;
            if (isset($lineofbusinessoid['min'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lineofbusinessoid['max'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid, $comparison);
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
     * @return $this|ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
     */
    public function filterByAllocation($allocation = null, $comparison = null)
    {
        if (is_array($allocation)) {
            $useMinMax = false;
            if (isset($allocation['min'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_ALLOCATION, $allocation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($allocation['max'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_ALLOCATION, $allocation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_ALLOCATION, $allocation, $comparison);
    }

    /**
     * Filter the query on the effectiveDt column
     *
     * Example usage:
     * <code>
     * $query->filterByEffectivedt('2011-03-14'); // WHERE effectiveDt = '2011-03-14'
     * $query->filterByEffectivedt('now'); // WHERE effectiveDt = '2011-03-14'
     * $query->filterByEffectivedt(array('max' => 'yesterday')); // WHERE effectiveDt > '2011-03-13'
     * </code>
     *
     * @param     mixed $effectivedt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
     */
    public function filterByEffectivedt($effectivedt = null, $comparison = null)
    {
        if (is_array($effectivedt)) {
            $useMinMax = false;
            if (isset($effectivedt['min'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_EFFECTIVEDT, $effectivedt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($effectivedt['max'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_EFFECTIVEDT, $effectivedt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_EFFECTIVEDT, $effectivedt, $comparison);
    }

    /**
     * Filter the query on the endDt column
     *
     * Example usage:
     * <code>
     * $query->filterByEnddt('2011-03-14'); // WHERE endDt = '2011-03-14'
     * $query->filterByEnddt('now'); // WHERE endDt = '2011-03-14'
     * $query->filterByEnddt(array('max' => 'yesterday')); // WHERE endDt > '2011-03-13'
     * </code>
     *
     * @param     mixed $enddt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
     */
    public function filterByEnddt($enddt = null, $comparison = null)
    {
        if (is_array($enddt)) {
            $useMinMax = false;
            if (isset($enddt['min'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_ENDDT, $enddt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($enddt['max'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_ENDDT, $enddt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_ENDDT, $enddt, $comparison);
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
     * @return $this|ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Employee object
     *
     * @param \lwops\lwops\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \lwops\lwops\Employee) {
            return $this
                ->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_EMPLOYEEOID, $employee->getOid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_EMPLOYEEOID, $employee->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByEmployee() only accepts arguments of type \lwops\lwops\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employee relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
     */
    public function joinEmployee($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employee');

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
            $this->addJoinObject($join, 'Employee');
        }

        return $this;
    }

    /**
     * Use the Employee relation Employee object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employee', '\lwops\lwops\EmployeeQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Lineofbusiness object
     *
     * @param \lwops\lwops\Lineofbusiness|ObjectCollection $lineofbusiness The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
     */
    public function filterByLineofbusiness($lineofbusiness, $comparison = null)
    {
        if ($lineofbusiness instanceof \lwops\lwops\Lineofbusiness) {
            return $this
                ->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_LINEOFBUSINESSOID, $lineofbusiness->getOid(), $comparison);
        } elseif ($lineofbusiness instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_LINEOFBUSINESSOID, $lineofbusiness->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildEmployeesalaryexpenseallocation $employeesalaryexpenseallocation Object to remove from the list of results
     *
     * @return $this|ChildEmployeesalaryexpenseallocationQuery The current query, for fluid interface
     */
    public function prune($employeesalaryexpenseallocation = null)
    {
        if ($employeesalaryexpenseallocation) {
            $this->addUsingAlias(EmployeesalaryexpenseallocationTableMap::COL_OID, $employeesalaryexpenseallocation->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employeesalaryexpenseallocation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeesalaryexpenseallocationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeesalaryexpenseallocationTableMap::clearInstancePool();
            EmployeesalaryexpenseallocationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeesalaryexpenseallocationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeesalaryexpenseallocationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeesalaryexpenseallocationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeesalaryexpenseallocationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmployeesalaryexpenseallocationQuery
