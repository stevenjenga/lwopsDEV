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
use lwops\lwops\Employeetermination as ChildEmployeetermination;
use lwops\lwops\EmployeeterminationQuery as ChildEmployeeterminationQuery;
use lwops\lwops\Map\EmployeeterminationTableMap;

/**
 * Base class that represents a query for the 'employeetermination' table.
 *
 *
 *
 * @method     ChildEmployeeterminationQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildEmployeeterminationQuery orderByEmployeeoid($order = Criteria::ASC) Order by the employeeOid column
 * @method     ChildEmployeeterminationQuery orderByEmployeeterminationtypeoid($order = Criteria::ASC) Order by the employeeTerminationTypeOid column
 * @method     ChildEmployeeterminationQuery orderByTerminationdate($order = Criteria::ASC) Order by the terminationDate column
 * @method     ChildEmployeeterminationQuery orderByComments($order = Criteria::ASC) Order by the comments column
 * @method     ChildEmployeeterminationQuery orderByGratuityamt($order = Criteria::ASC) Order by the gratuityAmt column
 * @method     ChildEmployeeterminationQuery orderByGratuitycomments($order = Criteria::ASC) Order by the gratuityComments column
 * @method     ChildEmployeeterminationQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildEmployeeterminationQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildEmployeeterminationQuery groupByOid() Group by the oid column
 * @method     ChildEmployeeterminationQuery groupByEmployeeoid() Group by the employeeOid column
 * @method     ChildEmployeeterminationQuery groupByEmployeeterminationtypeoid() Group by the employeeTerminationTypeOid column
 * @method     ChildEmployeeterminationQuery groupByTerminationdate() Group by the terminationDate column
 * @method     ChildEmployeeterminationQuery groupByComments() Group by the comments column
 * @method     ChildEmployeeterminationQuery groupByGratuityamt() Group by the gratuityAmt column
 * @method     ChildEmployeeterminationQuery groupByGratuitycomments() Group by the gratuityComments column
 * @method     ChildEmployeeterminationQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildEmployeeterminationQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildEmployeeterminationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeeterminationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeeterminationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeeterminationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeeterminationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeeterminationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeeterminationQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildEmployeeterminationQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildEmployeeterminationQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildEmployeeterminationQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildEmployeeterminationQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildEmployeeterminationQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildEmployeeterminationQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildEmployeeterminationQuery leftJoinEmployeeterminationtype($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeeterminationtype relation
 * @method     ChildEmployeeterminationQuery rightJoinEmployeeterminationtype($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeeterminationtype relation
 * @method     ChildEmployeeterminationQuery innerJoinEmployeeterminationtype($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeeterminationtype relation
 *
 * @method     ChildEmployeeterminationQuery joinWithEmployeeterminationtype($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeeterminationtype relation
 *
 * @method     ChildEmployeeterminationQuery leftJoinWithEmployeeterminationtype() Adds a LEFT JOIN clause and with to the query using the Employeeterminationtype relation
 * @method     ChildEmployeeterminationQuery rightJoinWithEmployeeterminationtype() Adds a RIGHT JOIN clause and with to the query using the Employeeterminationtype relation
 * @method     ChildEmployeeterminationQuery innerJoinWithEmployeeterminationtype() Adds a INNER JOIN clause and with to the query using the Employeeterminationtype relation
 *
 * @method     \lwops\lwops\EmployeeQuery|\lwops\lwops\EmployeeterminationtypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployeetermination findOne(ConnectionInterface $con = null) Return the first ChildEmployeetermination matching the query
 * @method     ChildEmployeetermination findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmployeetermination matching the query, or a new ChildEmployeetermination object populated from the query conditions when no match is found
 *
 * @method     ChildEmployeetermination findOneByOid(int $oid) Return the first ChildEmployeetermination filtered by the oid column
 * @method     ChildEmployeetermination findOneByEmployeeoid(int $employeeOid) Return the first ChildEmployeetermination filtered by the employeeOid column
 * @method     ChildEmployeetermination findOneByEmployeeterminationtypeoid(int $employeeTerminationTypeOid) Return the first ChildEmployeetermination filtered by the employeeTerminationTypeOid column
 * @method     ChildEmployeetermination findOneByTerminationdate(string $terminationDate) Return the first ChildEmployeetermination filtered by the terminationDate column
 * @method     ChildEmployeetermination findOneByComments(string $comments) Return the first ChildEmployeetermination filtered by the comments column
 * @method     ChildEmployeetermination findOneByGratuityamt(double $gratuityAmt) Return the first ChildEmployeetermination filtered by the gratuityAmt column
 * @method     ChildEmployeetermination findOneByGratuitycomments(string $gratuityComments) Return the first ChildEmployeetermination filtered by the gratuityComments column
 * @method     ChildEmployeetermination findOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeetermination filtered by the createTmstp column
 * @method     ChildEmployeetermination findOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeetermination filtered by the updtTmstp column *

 * @method     ChildEmployeetermination requirePk($key, ConnectionInterface $con = null) Return the ChildEmployeetermination by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeetermination requireOne(ConnectionInterface $con = null) Return the first ChildEmployeetermination matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeetermination requireOneByOid(int $oid) Return the first ChildEmployeetermination filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeetermination requireOneByEmployeeoid(int $employeeOid) Return the first ChildEmployeetermination filtered by the employeeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeetermination requireOneByEmployeeterminationtypeoid(int $employeeTerminationTypeOid) Return the first ChildEmployeetermination filtered by the employeeTerminationTypeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeetermination requireOneByTerminationdate(string $terminationDate) Return the first ChildEmployeetermination filtered by the terminationDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeetermination requireOneByComments(string $comments) Return the first ChildEmployeetermination filtered by the comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeetermination requireOneByGratuityamt(double $gratuityAmt) Return the first ChildEmployeetermination filtered by the gratuityAmt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeetermination requireOneByGratuitycomments(string $gratuityComments) Return the first ChildEmployeetermination filtered by the gratuityComments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeetermination requireOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeetermination filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeetermination requireOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeetermination filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeetermination[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmployeetermination objects based on current ModelCriteria
 * @method     ChildEmployeetermination[]|ObjectCollection findByOid(int $oid) Return ChildEmployeetermination objects filtered by the oid column
 * @method     ChildEmployeetermination[]|ObjectCollection findByEmployeeoid(int $employeeOid) Return ChildEmployeetermination objects filtered by the employeeOid column
 * @method     ChildEmployeetermination[]|ObjectCollection findByEmployeeterminationtypeoid(int $employeeTerminationTypeOid) Return ChildEmployeetermination objects filtered by the employeeTerminationTypeOid column
 * @method     ChildEmployeetermination[]|ObjectCollection findByTerminationdate(string $terminationDate) Return ChildEmployeetermination objects filtered by the terminationDate column
 * @method     ChildEmployeetermination[]|ObjectCollection findByComments(string $comments) Return ChildEmployeetermination objects filtered by the comments column
 * @method     ChildEmployeetermination[]|ObjectCollection findByGratuityamt(double $gratuityAmt) Return ChildEmployeetermination objects filtered by the gratuityAmt column
 * @method     ChildEmployeetermination[]|ObjectCollection findByGratuitycomments(string $gratuityComments) Return ChildEmployeetermination objects filtered by the gratuityComments column
 * @method     ChildEmployeetermination[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildEmployeetermination objects filtered by the createTmstp column
 * @method     ChildEmployeetermination[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildEmployeetermination objects filtered by the updtTmstp column
 * @method     ChildEmployeetermination[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmployeeterminationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\EmployeeterminationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Employeetermination', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeeterminationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeeterminationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmployeeterminationQuery) {
            return $criteria;
        }
        $query = new ChildEmployeeterminationQuery();
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
     * @return ChildEmployeetermination|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeterminationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeeterminationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployeetermination A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, employeeOid, employeeTerminationTypeOid, terminationDate, comments, gratuityAmt, gratuityComments, createTmstp, updtTmstp FROM employeetermination WHERE oid = :p0';
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
            /** @var ChildEmployeetermination $obj */
            $obj = new ChildEmployeetermination();
            $obj->hydrate($row);
            EmployeeterminationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployeetermination|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmployeeterminationTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmployeeterminationTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(EmployeeterminationTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(EmployeeterminationTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeterminationTableMap::COL_OID, $oid, $comparison);
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
     * @return $this|ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function filterByEmployeeoid($employeeoid = null, $comparison = null)
    {
        if (is_array($employeeoid)) {
            $useMinMax = false;
            if (isset($employeeoid['min'])) {
                $this->addUsingAlias(EmployeeterminationTableMap::COL_EMPLOYEEOID, $employeeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeoid['max'])) {
                $this->addUsingAlias(EmployeeterminationTableMap::COL_EMPLOYEEOID, $employeeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeterminationTableMap::COL_EMPLOYEEOID, $employeeoid, $comparison);
    }

    /**
     * Filter the query on the employeeTerminationTypeOid column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeterminationtypeoid(1234); // WHERE employeeTerminationTypeOid = 1234
     * $query->filterByEmployeeterminationtypeoid(array(12, 34)); // WHERE employeeTerminationTypeOid IN (12, 34)
     * $query->filterByEmployeeterminationtypeoid(array('min' => 12)); // WHERE employeeTerminationTypeOid > 12
     * </code>
     *
     * @see       filterByEmployeeterminationtype()
     *
     * @param     mixed $employeeterminationtypeoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function filterByEmployeeterminationtypeoid($employeeterminationtypeoid = null, $comparison = null)
    {
        if (is_array($employeeterminationtypeoid)) {
            $useMinMax = false;
            if (isset($employeeterminationtypeoid['min'])) {
                $this->addUsingAlias(EmployeeterminationTableMap::COL_EMPLOYEETERMINATIONTYPEOID, $employeeterminationtypeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeterminationtypeoid['max'])) {
                $this->addUsingAlias(EmployeeterminationTableMap::COL_EMPLOYEETERMINATIONTYPEOID, $employeeterminationtypeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeterminationTableMap::COL_EMPLOYEETERMINATIONTYPEOID, $employeeterminationtypeoid, $comparison);
    }

    /**
     * Filter the query on the terminationDate column
     *
     * Example usage:
     * <code>
     * $query->filterByTerminationdate('2011-03-14'); // WHERE terminationDate = '2011-03-14'
     * $query->filterByTerminationdate('now'); // WHERE terminationDate = '2011-03-14'
     * $query->filterByTerminationdate(array('max' => 'yesterday')); // WHERE terminationDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $terminationdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function filterByTerminationdate($terminationdate = null, $comparison = null)
    {
        if (is_array($terminationdate)) {
            $useMinMax = false;
            if (isset($terminationdate['min'])) {
                $this->addUsingAlias(EmployeeterminationTableMap::COL_TERMINATIONDATE, $terminationdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($terminationdate['max'])) {
                $this->addUsingAlias(EmployeeterminationTableMap::COL_TERMINATIONDATE, $terminationdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeterminationTableMap::COL_TERMINATIONDATE, $terminationdate, $comparison);
    }

    /**
     * Filter the query on the comments column
     *
     * Example usage:
     * <code>
     * $query->filterByComments('fooValue');   // WHERE comments = 'fooValue'
     * $query->filterByComments('%fooValue%', Criteria::LIKE); // WHERE comments LIKE '%fooValue%'
     * </code>
     *
     * @param     string $comments The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function filterByComments($comments = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comments)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeterminationTableMap::COL_COMMENTS, $comments, $comparison);
    }

    /**
     * Filter the query on the gratuityAmt column
     *
     * Example usage:
     * <code>
     * $query->filterByGratuityamt(1234); // WHERE gratuityAmt = 1234
     * $query->filterByGratuityamt(array(12, 34)); // WHERE gratuityAmt IN (12, 34)
     * $query->filterByGratuityamt(array('min' => 12)); // WHERE gratuityAmt > 12
     * </code>
     *
     * @param     mixed $gratuityamt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function filterByGratuityamt($gratuityamt = null, $comparison = null)
    {
        if (is_array($gratuityamt)) {
            $useMinMax = false;
            if (isset($gratuityamt['min'])) {
                $this->addUsingAlias(EmployeeterminationTableMap::COL_GRATUITYAMT, $gratuityamt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gratuityamt['max'])) {
                $this->addUsingAlias(EmployeeterminationTableMap::COL_GRATUITYAMT, $gratuityamt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeterminationTableMap::COL_GRATUITYAMT, $gratuityamt, $comparison);
    }

    /**
     * Filter the query on the gratuityComments column
     *
     * Example usage:
     * <code>
     * $query->filterByGratuitycomments('fooValue');   // WHERE gratuityComments = 'fooValue'
     * $query->filterByGratuitycomments('%fooValue%', Criteria::LIKE); // WHERE gratuityComments LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gratuitycomments The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function filterByGratuitycomments($gratuitycomments = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gratuitycomments)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeterminationTableMap::COL_GRATUITYCOMMENTS, $gratuitycomments, $comparison);
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
     * @return $this|ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(EmployeeterminationTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(EmployeeterminationTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeterminationTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(EmployeeterminationTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(EmployeeterminationTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeterminationTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Employee object
     *
     * @param \lwops\lwops\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \lwops\lwops\Employee) {
            return $this
                ->addUsingAlias(EmployeeterminationTableMap::COL_EMPLOYEEOID, $employee->getOid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeeterminationTableMap::COL_EMPLOYEEOID, $employee->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildEmployeeterminationQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Employeeterminationtype object
     *
     * @param \lwops\lwops\Employeeterminationtype|ObjectCollection $employeeterminationtype The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function filterByEmployeeterminationtype($employeeterminationtype, $comparison = null)
    {
        if ($employeeterminationtype instanceof \lwops\lwops\Employeeterminationtype) {
            return $this
                ->addUsingAlias(EmployeeterminationTableMap::COL_EMPLOYEETERMINATIONTYPEOID, $employeeterminationtype->getOid(), $comparison);
        } elseif ($employeeterminationtype instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeeterminationTableMap::COL_EMPLOYEETERMINATIONTYPEOID, $employeeterminationtype->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByEmployeeterminationtype() only accepts arguments of type \lwops\lwops\Employeeterminationtype or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employeeterminationtype relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function joinEmployeeterminationtype($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employeeterminationtype');

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
            $this->addJoinObject($join, 'Employeeterminationtype');
        }

        return $this;
    }

    /**
     * Use the Employeeterminationtype relation Employeeterminationtype object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeeterminationtypeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeterminationtypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeeterminationtype($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employeeterminationtype', '\lwops\lwops\EmployeeterminationtypeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEmployeetermination $employeetermination Object to remove from the list of results
     *
     * @return $this|ChildEmployeeterminationQuery The current query, for fluid interface
     */
    public function prune($employeetermination = null)
    {
        if ($employeetermination) {
            $this->addUsingAlias(EmployeeterminationTableMap::COL_OID, $employeetermination->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employeetermination table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeterminationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeeterminationTableMap::clearInstancePool();
            EmployeeterminationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeterminationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeeterminationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeeterminationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeeterminationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmployeeterminationQuery
