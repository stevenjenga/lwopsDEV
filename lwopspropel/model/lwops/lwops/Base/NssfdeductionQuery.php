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
use lwops\lwops\Nssfdeduction as ChildNssfdeduction;
use lwops\lwops\NssfdeductionQuery as ChildNssfdeductionQuery;
use lwops\lwops\Map\NssfdeductionTableMap;

/**
 * Base class that represents a query for the 'nssfdeduction' table.
 *
 *
 *
 * @method     ChildNssfdeductionQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildNssfdeductionQuery orderByEmployeeoid($order = Criteria::ASC) Order by the employeeOid column
 * @method     ChildNssfdeductionQuery orderByDeductionflg($order = Criteria::ASC) Order by the deductionFlg column
 * @method     ChildNssfdeductionQuery orderByEffectivedt($order = Criteria::ASC) Order by the effectiveDt column
 * @method     ChildNssfdeductionQuery orderByEnddt($order = Criteria::ASC) Order by the endDt column
 * @method     ChildNssfdeductionQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildNssfdeductionQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildNssfdeductionQuery groupByOid() Group by the oid column
 * @method     ChildNssfdeductionQuery groupByEmployeeoid() Group by the employeeOid column
 * @method     ChildNssfdeductionQuery groupByDeductionflg() Group by the deductionFlg column
 * @method     ChildNssfdeductionQuery groupByEffectivedt() Group by the effectiveDt column
 * @method     ChildNssfdeductionQuery groupByEnddt() Group by the endDt column
 * @method     ChildNssfdeductionQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildNssfdeductionQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildNssfdeductionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNssfdeductionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNssfdeductionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNssfdeductionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildNssfdeductionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildNssfdeductionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildNssfdeductionQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildNssfdeductionQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildNssfdeductionQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildNssfdeductionQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildNssfdeductionQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildNssfdeductionQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildNssfdeductionQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \lwops\lwops\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildNssfdeduction findOne(ConnectionInterface $con = null) Return the first ChildNssfdeduction matching the query
 * @method     ChildNssfdeduction findOneOrCreate(ConnectionInterface $con = null) Return the first ChildNssfdeduction matching the query, or a new ChildNssfdeduction object populated from the query conditions when no match is found
 *
 * @method     ChildNssfdeduction findOneByOid(int $oid) Return the first ChildNssfdeduction filtered by the oid column
 * @method     ChildNssfdeduction findOneByEmployeeoid(int $employeeOid) Return the first ChildNssfdeduction filtered by the employeeOid column
 * @method     ChildNssfdeduction findOneByDeductionflg(boolean $deductionFlg) Return the first ChildNssfdeduction filtered by the deductionFlg column
 * @method     ChildNssfdeduction findOneByEffectivedt(string $effectiveDt) Return the first ChildNssfdeduction filtered by the effectiveDt column
 * @method     ChildNssfdeduction findOneByEnddt(string $endDt) Return the first ChildNssfdeduction filtered by the endDt column
 * @method     ChildNssfdeduction findOneByCreatetmstp(string $createTmstp) Return the first ChildNssfdeduction filtered by the createTmstp column
 * @method     ChildNssfdeduction findOneByUpdttmstp(string $updtTmstp) Return the first ChildNssfdeduction filtered by the updtTmstp column *

 * @method     ChildNssfdeduction requirePk($key, ConnectionInterface $con = null) Return the ChildNssfdeduction by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNssfdeduction requireOne(ConnectionInterface $con = null) Return the first ChildNssfdeduction matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNssfdeduction requireOneByOid(int $oid) Return the first ChildNssfdeduction filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNssfdeduction requireOneByEmployeeoid(int $employeeOid) Return the first ChildNssfdeduction filtered by the employeeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNssfdeduction requireOneByDeductionflg(boolean $deductionFlg) Return the first ChildNssfdeduction filtered by the deductionFlg column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNssfdeduction requireOneByEffectivedt(string $effectiveDt) Return the first ChildNssfdeduction filtered by the effectiveDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNssfdeduction requireOneByEnddt(string $endDt) Return the first ChildNssfdeduction filtered by the endDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNssfdeduction requireOneByCreatetmstp(string $createTmstp) Return the first ChildNssfdeduction filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNssfdeduction requireOneByUpdttmstp(string $updtTmstp) Return the first ChildNssfdeduction filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNssfdeduction[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildNssfdeduction objects based on current ModelCriteria
 * @method     ChildNssfdeduction[]|ObjectCollection findByOid(int $oid) Return ChildNssfdeduction objects filtered by the oid column
 * @method     ChildNssfdeduction[]|ObjectCollection findByEmployeeoid(int $employeeOid) Return ChildNssfdeduction objects filtered by the employeeOid column
 * @method     ChildNssfdeduction[]|ObjectCollection findByDeductionflg(boolean $deductionFlg) Return ChildNssfdeduction objects filtered by the deductionFlg column
 * @method     ChildNssfdeduction[]|ObjectCollection findByEffectivedt(string $effectiveDt) Return ChildNssfdeduction objects filtered by the effectiveDt column
 * @method     ChildNssfdeduction[]|ObjectCollection findByEnddt(string $endDt) Return ChildNssfdeduction objects filtered by the endDt column
 * @method     ChildNssfdeduction[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildNssfdeduction objects filtered by the createTmstp column
 * @method     ChildNssfdeduction[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildNssfdeduction objects filtered by the updtTmstp column
 * @method     ChildNssfdeduction[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class NssfdeductionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\NssfdeductionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Nssfdeduction', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNssfdeductionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNssfdeductionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildNssfdeductionQuery) {
            return $criteria;
        }
        $query = new ChildNssfdeductionQuery();
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
     * @return ChildNssfdeduction|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NssfdeductionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = NssfdeductionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildNssfdeduction A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, employeeOid, deductionFlg, effectiveDt, endDt, createTmstp, updtTmstp FROM nssfdeduction WHERE oid = :p0';
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
            /** @var ChildNssfdeduction $obj */
            $obj = new ChildNssfdeduction();
            $obj->hydrate($row);
            NssfdeductionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildNssfdeduction|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildNssfdeductionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NssfdeductionTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildNssfdeductionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NssfdeductionTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildNssfdeductionQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(NssfdeductionTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(NssfdeductionTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NssfdeductionTableMap::COL_OID, $oid, $comparison);
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
     * @return $this|ChildNssfdeductionQuery The current query, for fluid interface
     */
    public function filterByEmployeeoid($employeeoid = null, $comparison = null)
    {
        if (is_array($employeeoid)) {
            $useMinMax = false;
            if (isset($employeeoid['min'])) {
                $this->addUsingAlias(NssfdeductionTableMap::COL_EMPLOYEEOID, $employeeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeoid['max'])) {
                $this->addUsingAlias(NssfdeductionTableMap::COL_EMPLOYEEOID, $employeeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NssfdeductionTableMap::COL_EMPLOYEEOID, $employeeoid, $comparison);
    }

    /**
     * Filter the query on the deductionFlg column
     *
     * Example usage:
     * <code>
     * $query->filterByDeductionflg(true); // WHERE deductionFlg = true
     * $query->filterByDeductionflg('yes'); // WHERE deductionFlg = true
     * </code>
     *
     * @param     boolean|string $deductionflg The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNssfdeductionQuery The current query, for fluid interface
     */
    public function filterByDeductionflg($deductionflg = null, $comparison = null)
    {
        if (is_string($deductionflg)) {
            $deductionflg = in_array(strtolower($deductionflg), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(NssfdeductionTableMap::COL_DEDUCTIONFLG, $deductionflg, $comparison);
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
     * @return $this|ChildNssfdeductionQuery The current query, for fluid interface
     */
    public function filterByEffectivedt($effectivedt = null, $comparison = null)
    {
        if (is_array($effectivedt)) {
            $useMinMax = false;
            if (isset($effectivedt['min'])) {
                $this->addUsingAlias(NssfdeductionTableMap::COL_EFFECTIVEDT, $effectivedt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($effectivedt['max'])) {
                $this->addUsingAlias(NssfdeductionTableMap::COL_EFFECTIVEDT, $effectivedt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NssfdeductionTableMap::COL_EFFECTIVEDT, $effectivedt, $comparison);
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
     * @return $this|ChildNssfdeductionQuery The current query, for fluid interface
     */
    public function filterByEnddt($enddt = null, $comparison = null)
    {
        if (is_array($enddt)) {
            $useMinMax = false;
            if (isset($enddt['min'])) {
                $this->addUsingAlias(NssfdeductionTableMap::COL_ENDDT, $enddt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($enddt['max'])) {
                $this->addUsingAlias(NssfdeductionTableMap::COL_ENDDT, $enddt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NssfdeductionTableMap::COL_ENDDT, $enddt, $comparison);
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
     * @return $this|ChildNssfdeductionQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(NssfdeductionTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(NssfdeductionTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NssfdeductionTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildNssfdeductionQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(NssfdeductionTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(NssfdeductionTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NssfdeductionTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Employee object
     *
     * @param \lwops\lwops\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildNssfdeductionQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \lwops\lwops\Employee) {
            return $this
                ->addUsingAlias(NssfdeductionTableMap::COL_EMPLOYEEOID, $employee->getOid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NssfdeductionTableMap::COL_EMPLOYEEOID, $employee->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildNssfdeductionQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildNssfdeduction $nssfdeduction Object to remove from the list of results
     *
     * @return $this|ChildNssfdeductionQuery The current query, for fluid interface
     */
    public function prune($nssfdeduction = null)
    {
        if ($nssfdeduction) {
            $this->addUsingAlias(NssfdeductionTableMap::COL_OID, $nssfdeduction->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the nssfdeduction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NssfdeductionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NssfdeductionTableMap::clearInstancePool();
            NssfdeductionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(NssfdeductionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NssfdeductionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NssfdeductionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NssfdeductionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // NssfdeductionQuery
