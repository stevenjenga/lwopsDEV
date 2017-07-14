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
use lwops\lwops\Employeeotherdeduction as ChildEmployeeotherdeduction;
use lwops\lwops\EmployeeotherdeductionQuery as ChildEmployeeotherdeductionQuery;
use lwops\lwops\Map\EmployeeotherdeductionTableMap;

/**
 * Base class that represents a query for the 'employeeotherdeduction' table.
 *
 *
 *
 * @method     ChildEmployeeotherdeductionQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildEmployeeotherdeductionQuery orderByEmployeeoid($order = Criteria::ASC) Order by the employeeOid column
 * @method     ChildEmployeeotherdeductionQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildEmployeeotherdeductionQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildEmployeeotherdeductionQuery orderByPaidflg($order = Criteria::ASC) Order by the paidFlg column
 * @method     ChildEmployeeotherdeductionQuery orderByPayslipnbr($order = Criteria::ASC) Order by the payslipNbr column
 * @method     ChildEmployeeotherdeductionQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildEmployeeotherdeductionQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildEmployeeotherdeductionQuery groupByOid() Group by the oid column
 * @method     ChildEmployeeotherdeductionQuery groupByEmployeeoid() Group by the employeeOid column
 * @method     ChildEmployeeotherdeductionQuery groupByAmount() Group by the amount column
 * @method     ChildEmployeeotherdeductionQuery groupByDescription() Group by the description column
 * @method     ChildEmployeeotherdeductionQuery groupByPaidflg() Group by the paidFlg column
 * @method     ChildEmployeeotherdeductionQuery groupByPayslipnbr() Group by the payslipNbr column
 * @method     ChildEmployeeotherdeductionQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildEmployeeotherdeductionQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildEmployeeotherdeductionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeeotherdeductionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeeotherdeductionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeeotherdeductionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeeotherdeductionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeeotherdeductionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeeotherdeductionQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildEmployeeotherdeductionQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildEmployeeotherdeductionQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildEmployeeotherdeductionQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildEmployeeotherdeductionQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildEmployeeotherdeductionQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildEmployeeotherdeductionQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \lwops\lwops\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployeeotherdeduction findOne(ConnectionInterface $con = null) Return the first ChildEmployeeotherdeduction matching the query
 * @method     ChildEmployeeotherdeduction findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmployeeotherdeduction matching the query, or a new ChildEmployeeotherdeduction object populated from the query conditions when no match is found
 *
 * @method     ChildEmployeeotherdeduction findOneByOid(int $oid) Return the first ChildEmployeeotherdeduction filtered by the oid column
 * @method     ChildEmployeeotherdeduction findOneByEmployeeoid(int $employeeOid) Return the first ChildEmployeeotherdeduction filtered by the employeeOid column
 * @method     ChildEmployeeotherdeduction findOneByAmount(double $amount) Return the first ChildEmployeeotherdeduction filtered by the amount column
 * @method     ChildEmployeeotherdeduction findOneByDescription(string $description) Return the first ChildEmployeeotherdeduction filtered by the description column
 * @method     ChildEmployeeotherdeduction findOneByPaidflg(boolean $paidFlg) Return the first ChildEmployeeotherdeduction filtered by the paidFlg column
 * @method     ChildEmployeeotherdeduction findOneByPayslipnbr(string $payslipNbr) Return the first ChildEmployeeotherdeduction filtered by the payslipNbr column
 * @method     ChildEmployeeotherdeduction findOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeeotherdeduction filtered by the createTmstp column
 * @method     ChildEmployeeotherdeduction findOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeeotherdeduction filtered by the updtTmstp column *

 * @method     ChildEmployeeotherdeduction requirePk($key, ConnectionInterface $con = null) Return the ChildEmployeeotherdeduction by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeotherdeduction requireOne(ConnectionInterface $con = null) Return the first ChildEmployeeotherdeduction matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeotherdeduction requireOneByOid(int $oid) Return the first ChildEmployeeotherdeduction filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeotherdeduction requireOneByEmployeeoid(int $employeeOid) Return the first ChildEmployeeotherdeduction filtered by the employeeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeotherdeduction requireOneByAmount(double $amount) Return the first ChildEmployeeotherdeduction filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeotherdeduction requireOneByDescription(string $description) Return the first ChildEmployeeotherdeduction filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeotherdeduction requireOneByPaidflg(boolean $paidFlg) Return the first ChildEmployeeotherdeduction filtered by the paidFlg column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeotherdeduction requireOneByPayslipnbr(string $payslipNbr) Return the first ChildEmployeeotherdeduction filtered by the payslipNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeotherdeduction requireOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeeotherdeduction filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeotherdeduction requireOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeeotherdeduction filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeotherdeduction[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmployeeotherdeduction objects based on current ModelCriteria
 * @method     ChildEmployeeotherdeduction[]|ObjectCollection findByOid(int $oid) Return ChildEmployeeotherdeduction objects filtered by the oid column
 * @method     ChildEmployeeotherdeduction[]|ObjectCollection findByEmployeeoid(int $employeeOid) Return ChildEmployeeotherdeduction objects filtered by the employeeOid column
 * @method     ChildEmployeeotherdeduction[]|ObjectCollection findByAmount(double $amount) Return ChildEmployeeotherdeduction objects filtered by the amount column
 * @method     ChildEmployeeotherdeduction[]|ObjectCollection findByDescription(string $description) Return ChildEmployeeotherdeduction objects filtered by the description column
 * @method     ChildEmployeeotherdeduction[]|ObjectCollection findByPaidflg(boolean $paidFlg) Return ChildEmployeeotherdeduction objects filtered by the paidFlg column
 * @method     ChildEmployeeotherdeduction[]|ObjectCollection findByPayslipnbr(string $payslipNbr) Return ChildEmployeeotherdeduction objects filtered by the payslipNbr column
 * @method     ChildEmployeeotherdeduction[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildEmployeeotherdeduction objects filtered by the createTmstp column
 * @method     ChildEmployeeotherdeduction[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildEmployeeotherdeduction objects filtered by the updtTmstp column
 * @method     ChildEmployeeotherdeduction[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmployeeotherdeductionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\EmployeeotherdeductionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Employeeotherdeduction', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeeotherdeductionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeeotherdeductionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmployeeotherdeductionQuery) {
            return $criteria;
        }
        $query = new ChildEmployeeotherdeductionQuery();
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
     * @return ChildEmployeeotherdeduction|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeotherdeductionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeeotherdeductionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployeeotherdeduction A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, employeeOid, amount, description, paidFlg, payslipNbr, createTmstp, updtTmstp FROM employeeotherdeduction WHERE oid = :p0';
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
            /** @var ChildEmployeeotherdeduction $obj */
            $obj = new ChildEmployeeotherdeduction();
            $obj->hydrate($row);
            EmployeeotherdeductionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployeeotherdeduction|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmployeeotherdeductionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmployeeotherdeductionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildEmployeeotherdeductionQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_OID, $oid, $comparison);
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
     * @return $this|ChildEmployeeotherdeductionQuery The current query, for fluid interface
     */
    public function filterByEmployeeoid($employeeoid = null, $comparison = null)
    {
        if (is_array($employeeoid)) {
            $useMinMax = false;
            if (isset($employeeoid['min'])) {
                $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_EMPLOYEEOID, $employeeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeoid['max'])) {
                $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_EMPLOYEEOID, $employeeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_EMPLOYEEOID, $employeeoid, $comparison);
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
     * @return $this|ChildEmployeeotherdeductionQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeotherdeductionQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the paidFlg column
     *
     * Example usage:
     * <code>
     * $query->filterByPaidflg(true); // WHERE paidFlg = true
     * $query->filterByPaidflg('yes'); // WHERE paidFlg = true
     * </code>
     *
     * @param     boolean|string $paidflg The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeotherdeductionQuery The current query, for fluid interface
     */
    public function filterByPaidflg($paidflg = null, $comparison = null)
    {
        if (is_string($paidflg)) {
            $paidflg = in_array(strtolower($paidflg), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_PAIDFLG, $paidflg, $comparison);
    }

    /**
     * Filter the query on the payslipNbr column
     *
     * Example usage:
     * <code>
     * $query->filterByPayslipnbr('fooValue');   // WHERE payslipNbr = 'fooValue'
     * $query->filterByPayslipnbr('%fooValue%', Criteria::LIKE); // WHERE payslipNbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $payslipnbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeotherdeductionQuery The current query, for fluid interface
     */
    public function filterByPayslipnbr($payslipnbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($payslipnbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_PAYSLIPNBR, $payslipnbr, $comparison);
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
     * @return $this|ChildEmployeeotherdeductionQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildEmployeeotherdeductionQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Employee object
     *
     * @param \lwops\lwops\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeeotherdeductionQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \lwops\lwops\Employee) {
            return $this
                ->addUsingAlias(EmployeeotherdeductionTableMap::COL_EMPLOYEEOID, $employee->getOid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeeotherdeductionTableMap::COL_EMPLOYEEOID, $employee->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildEmployeeotherdeductionQuery The current query, for fluid interface
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
     * @param   ChildEmployeeotherdeduction $employeeotherdeduction Object to remove from the list of results
     *
     * @return $this|ChildEmployeeotherdeductionQuery The current query, for fluid interface
     */
    public function prune($employeeotherdeduction = null)
    {
        if ($employeeotherdeduction) {
            $this->addUsingAlias(EmployeeotherdeductionTableMap::COL_OID, $employeeotherdeduction->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employeeotherdeduction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeotherdeductionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeeotherdeductionTableMap::clearInstancePool();
            EmployeeotherdeductionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeotherdeductionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeeotherdeductionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeeotherdeductionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeeotherdeductionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmployeeotherdeductionQuery
