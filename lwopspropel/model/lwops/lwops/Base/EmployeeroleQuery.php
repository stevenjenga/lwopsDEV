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
use lwops\lwops\Employeerole as ChildEmployeerole;
use lwops\lwops\EmployeeroleQuery as ChildEmployeeroleQuery;
use lwops\lwops\Map\EmployeeroleTableMap;

/**
 * Base class that represents a query for the 'employeerole' table.
 *
 *
 *
 * @method     ChildEmployeeroleQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildEmployeeroleQuery orderByEmployeeoid($order = Criteria::ASC) Order by the employeeOid column
 * @method     ChildEmployeeroleQuery orderByEmployeeroletypeoid($order = Criteria::ASC) Order by the employeeRoleTypeOid column
 * @method     ChildEmployeeroleQuery orderByEffectivedt($order = Criteria::ASC) Order by the effectiveDt column
 * @method     ChildEmployeeroleQuery orderByEnddt($order = Criteria::ASC) Order by the endDt column
 * @method     ChildEmployeeroleQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildEmployeeroleQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildEmployeeroleQuery groupByOid() Group by the oid column
 * @method     ChildEmployeeroleQuery groupByEmployeeoid() Group by the employeeOid column
 * @method     ChildEmployeeroleQuery groupByEmployeeroletypeoid() Group by the employeeRoleTypeOid column
 * @method     ChildEmployeeroleQuery groupByEffectivedt() Group by the effectiveDt column
 * @method     ChildEmployeeroleQuery groupByEnddt() Group by the endDt column
 * @method     ChildEmployeeroleQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildEmployeeroleQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildEmployeeroleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeeroleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeeroleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeeroleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeeroleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeeroleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeeroleQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildEmployeeroleQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildEmployeeroleQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildEmployeeroleQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildEmployeeroleQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildEmployeeroleQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildEmployeeroleQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildEmployeeroleQuery leftJoinEmployeeroletype($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeeroletype relation
 * @method     ChildEmployeeroleQuery rightJoinEmployeeroletype($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeeroletype relation
 * @method     ChildEmployeeroleQuery innerJoinEmployeeroletype($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeeroletype relation
 *
 * @method     ChildEmployeeroleQuery joinWithEmployeeroletype($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeeroletype relation
 *
 * @method     ChildEmployeeroleQuery leftJoinWithEmployeeroletype() Adds a LEFT JOIN clause and with to the query using the Employeeroletype relation
 * @method     ChildEmployeeroleQuery rightJoinWithEmployeeroletype() Adds a RIGHT JOIN clause and with to the query using the Employeeroletype relation
 * @method     ChildEmployeeroleQuery innerJoinWithEmployeeroletype() Adds a INNER JOIN clause and with to the query using the Employeeroletype relation
 *
 * @method     \lwops\lwops\EmployeeQuery|\lwops\lwops\EmployeeroletypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployeerole findOne(ConnectionInterface $con = null) Return the first ChildEmployeerole matching the query
 * @method     ChildEmployeerole findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmployeerole matching the query, or a new ChildEmployeerole object populated from the query conditions when no match is found
 *
 * @method     ChildEmployeerole findOneByOid(int $oid) Return the first ChildEmployeerole filtered by the oid column
 * @method     ChildEmployeerole findOneByEmployeeoid(int $employeeOid) Return the first ChildEmployeerole filtered by the employeeOid column
 * @method     ChildEmployeerole findOneByEmployeeroletypeoid(int $employeeRoleTypeOid) Return the first ChildEmployeerole filtered by the employeeRoleTypeOid column
 * @method     ChildEmployeerole findOneByEffectivedt(string $effectiveDt) Return the first ChildEmployeerole filtered by the effectiveDt column
 * @method     ChildEmployeerole findOneByEnddt(string $endDt) Return the first ChildEmployeerole filtered by the endDt column
 * @method     ChildEmployeerole findOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeerole filtered by the createTmstp column
 * @method     ChildEmployeerole findOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeerole filtered by the updtTmstp column *

 * @method     ChildEmployeerole requirePk($key, ConnectionInterface $con = null) Return the ChildEmployeerole by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeerole requireOne(ConnectionInterface $con = null) Return the first ChildEmployeerole matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeerole requireOneByOid(int $oid) Return the first ChildEmployeerole filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeerole requireOneByEmployeeoid(int $employeeOid) Return the first ChildEmployeerole filtered by the employeeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeerole requireOneByEmployeeroletypeoid(int $employeeRoleTypeOid) Return the first ChildEmployeerole filtered by the employeeRoleTypeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeerole requireOneByEffectivedt(string $effectiveDt) Return the first ChildEmployeerole filtered by the effectiveDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeerole requireOneByEnddt(string $endDt) Return the first ChildEmployeerole filtered by the endDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeerole requireOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeerole filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeerole requireOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeerole filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeerole[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmployeerole objects based on current ModelCriteria
 * @method     ChildEmployeerole[]|ObjectCollection findByOid(int $oid) Return ChildEmployeerole objects filtered by the oid column
 * @method     ChildEmployeerole[]|ObjectCollection findByEmployeeoid(int $employeeOid) Return ChildEmployeerole objects filtered by the employeeOid column
 * @method     ChildEmployeerole[]|ObjectCollection findByEmployeeroletypeoid(int $employeeRoleTypeOid) Return ChildEmployeerole objects filtered by the employeeRoleTypeOid column
 * @method     ChildEmployeerole[]|ObjectCollection findByEffectivedt(string $effectiveDt) Return ChildEmployeerole objects filtered by the effectiveDt column
 * @method     ChildEmployeerole[]|ObjectCollection findByEnddt(string $endDt) Return ChildEmployeerole objects filtered by the endDt column
 * @method     ChildEmployeerole[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildEmployeerole objects filtered by the createTmstp column
 * @method     ChildEmployeerole[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildEmployeerole objects filtered by the updtTmstp column
 * @method     ChildEmployeerole[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmployeeroleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\EmployeeroleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Employeerole', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeeroleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeeroleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmployeeroleQuery) {
            return $criteria;
        }
        $query = new ChildEmployeeroleQuery();
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
     * @return ChildEmployeerole|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeroleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeeroleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployeerole A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, employeeOid, employeeRoleTypeOid, effectiveDt, endDt, createTmstp, updtTmstp FROM employeerole WHERE oid = :p0';
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
            /** @var ChildEmployeerole $obj */
            $obj = new ChildEmployeerole();
            $obj->hydrate($row);
            EmployeeroleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployeerole|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmployeeroleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmployeeroleTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmployeeroleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmployeeroleTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildEmployeeroleQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(EmployeeroleTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(EmployeeroleTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeroleTableMap::COL_OID, $oid, $comparison);
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
     * @return $this|ChildEmployeeroleQuery The current query, for fluid interface
     */
    public function filterByEmployeeoid($employeeoid = null, $comparison = null)
    {
        if (is_array($employeeoid)) {
            $useMinMax = false;
            if (isset($employeeoid['min'])) {
                $this->addUsingAlias(EmployeeroleTableMap::COL_EMPLOYEEOID, $employeeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeoid['max'])) {
                $this->addUsingAlias(EmployeeroleTableMap::COL_EMPLOYEEOID, $employeeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeroleTableMap::COL_EMPLOYEEOID, $employeeoid, $comparison);
    }

    /**
     * Filter the query on the employeeRoleTypeOid column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeroletypeoid(1234); // WHERE employeeRoleTypeOid = 1234
     * $query->filterByEmployeeroletypeoid(array(12, 34)); // WHERE employeeRoleTypeOid IN (12, 34)
     * $query->filterByEmployeeroletypeoid(array('min' => 12)); // WHERE employeeRoleTypeOid > 12
     * </code>
     *
     * @see       filterByEmployeeroletype()
     *
     * @param     mixed $employeeroletypeoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeroleQuery The current query, for fluid interface
     */
    public function filterByEmployeeroletypeoid($employeeroletypeoid = null, $comparison = null)
    {
        if (is_array($employeeroletypeoid)) {
            $useMinMax = false;
            if (isset($employeeroletypeoid['min'])) {
                $this->addUsingAlias(EmployeeroleTableMap::COL_EMPLOYEEROLETYPEOID, $employeeroletypeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeroletypeoid['max'])) {
                $this->addUsingAlias(EmployeeroleTableMap::COL_EMPLOYEEROLETYPEOID, $employeeroletypeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeroleTableMap::COL_EMPLOYEEROLETYPEOID, $employeeroletypeoid, $comparison);
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
     * @return $this|ChildEmployeeroleQuery The current query, for fluid interface
     */
    public function filterByEffectivedt($effectivedt = null, $comparison = null)
    {
        if (is_array($effectivedt)) {
            $useMinMax = false;
            if (isset($effectivedt['min'])) {
                $this->addUsingAlias(EmployeeroleTableMap::COL_EFFECTIVEDT, $effectivedt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($effectivedt['max'])) {
                $this->addUsingAlias(EmployeeroleTableMap::COL_EFFECTIVEDT, $effectivedt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeroleTableMap::COL_EFFECTIVEDT, $effectivedt, $comparison);
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
     * @return $this|ChildEmployeeroleQuery The current query, for fluid interface
     */
    public function filterByEnddt($enddt = null, $comparison = null)
    {
        if (is_array($enddt)) {
            $useMinMax = false;
            if (isset($enddt['min'])) {
                $this->addUsingAlias(EmployeeroleTableMap::COL_ENDDT, $enddt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($enddt['max'])) {
                $this->addUsingAlias(EmployeeroleTableMap::COL_ENDDT, $enddt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeroleTableMap::COL_ENDDT, $enddt, $comparison);
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
     * @return $this|ChildEmployeeroleQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(EmployeeroleTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(EmployeeroleTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeroleTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildEmployeeroleQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(EmployeeroleTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(EmployeeroleTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeroleTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Employee object
     *
     * @param \lwops\lwops\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeeroleQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \lwops\lwops\Employee) {
            return $this
                ->addUsingAlias(EmployeeroleTableMap::COL_EMPLOYEEOID, $employee->getOid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeeroleTableMap::COL_EMPLOYEEOID, $employee->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildEmployeeroleQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Employeeroletype object
     *
     * @param \lwops\lwops\Employeeroletype|ObjectCollection $employeeroletype The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeeroleQuery The current query, for fluid interface
     */
    public function filterByEmployeeroletype($employeeroletype, $comparison = null)
    {
        if ($employeeroletype instanceof \lwops\lwops\Employeeroletype) {
            return $this
                ->addUsingAlias(EmployeeroleTableMap::COL_EMPLOYEEROLETYPEOID, $employeeroletype->getOid(), $comparison);
        } elseif ($employeeroletype instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeeroleTableMap::COL_EMPLOYEEROLETYPEOID, $employeeroletype->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByEmployeeroletype() only accepts arguments of type \lwops\lwops\Employeeroletype or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employeeroletype relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeroleQuery The current query, for fluid interface
     */
    public function joinEmployeeroletype($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employeeroletype');

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
            $this->addJoinObject($join, 'Employeeroletype');
        }

        return $this;
    }

    /**
     * Use the Employeeroletype relation Employeeroletype object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeeroletypeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeroletypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeeroletype($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employeeroletype', '\lwops\lwops\EmployeeroletypeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEmployeerole $employeerole Object to remove from the list of results
     *
     * @return $this|ChildEmployeeroleQuery The current query, for fluid interface
     */
    public function prune($employeerole = null)
    {
        if ($employeerole) {
            $this->addUsingAlias(EmployeeroleTableMap::COL_OID, $employeerole->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employeerole table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeroleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeeroleTableMap::clearInstancePool();
            EmployeeroleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeroleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeeroleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeeroleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeeroleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmployeeroleQuery
