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
use lwops\lwops\Employeeloan as ChildEmployeeloan;
use lwops\lwops\EmployeeloanQuery as ChildEmployeeloanQuery;
use lwops\lwops\Map\EmployeeloanTableMap;

/**
 * Base class that represents a query for the 'employeeloan' table.
 *
 *
 *
 * @method     ChildEmployeeloanQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildEmployeeloanQuery orderByEmployeeoid($order = Criteria::ASC) Order by the employeeOid column
 * @method     ChildEmployeeloanQuery orderByLoannbr($order = Criteria::ASC) Order by the loanNbr column
 * @method     ChildEmployeeloanQuery orderByLoandate($order = Criteria::ASC) Order by the loanDate column
 * @method     ChildEmployeeloanQuery orderByLoanamount($order = Criteria::ASC) Order by the loanAmount column
 * @method     ChildEmployeeloanQuery orderByPurpose($order = Criteria::ASC) Order by the purpose column
 * @method     ChildEmployeeloanQuery orderByNbrofpayperiods($order = Criteria::ASC) Order by the nbrOfPayPeriods column
 * @method     ChildEmployeeloanQuery orderByOpsmonthlycalendaroid($order = Criteria::ASC) Order by the opsMonthlyCalendarOid column
 * @method     ChildEmployeeloanQuery orderByInstallmentamt($order = Criteria::ASC) Order by the installmentAmt column
 * @method     ChildEmployeeloanQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildEmployeeloanQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildEmployeeloanQuery groupByOid() Group by the oid column
 * @method     ChildEmployeeloanQuery groupByEmployeeoid() Group by the employeeOid column
 * @method     ChildEmployeeloanQuery groupByLoannbr() Group by the loanNbr column
 * @method     ChildEmployeeloanQuery groupByLoandate() Group by the loanDate column
 * @method     ChildEmployeeloanQuery groupByLoanamount() Group by the loanAmount column
 * @method     ChildEmployeeloanQuery groupByPurpose() Group by the purpose column
 * @method     ChildEmployeeloanQuery groupByNbrofpayperiods() Group by the nbrOfPayPeriods column
 * @method     ChildEmployeeloanQuery groupByOpsmonthlycalendaroid() Group by the opsMonthlyCalendarOid column
 * @method     ChildEmployeeloanQuery groupByInstallmentamt() Group by the installmentAmt column
 * @method     ChildEmployeeloanQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildEmployeeloanQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildEmployeeloanQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeeloanQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeeloanQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeeloanQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeeloanQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeeloanQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeeloanQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildEmployeeloanQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildEmployeeloanQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildEmployeeloanQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildEmployeeloanQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildEmployeeloanQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildEmployeeloanQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildEmployeeloanQuery leftJoinOpsmonthlycalendar($relationAlias = null) Adds a LEFT JOIN clause to the query using the Opsmonthlycalendar relation
 * @method     ChildEmployeeloanQuery rightJoinOpsmonthlycalendar($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Opsmonthlycalendar relation
 * @method     ChildEmployeeloanQuery innerJoinOpsmonthlycalendar($relationAlias = null) Adds a INNER JOIN clause to the query using the Opsmonthlycalendar relation
 *
 * @method     ChildEmployeeloanQuery joinWithOpsmonthlycalendar($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Opsmonthlycalendar relation
 *
 * @method     ChildEmployeeloanQuery leftJoinWithOpsmonthlycalendar() Adds a LEFT JOIN clause and with to the query using the Opsmonthlycalendar relation
 * @method     ChildEmployeeloanQuery rightJoinWithOpsmonthlycalendar() Adds a RIGHT JOIN clause and with to the query using the Opsmonthlycalendar relation
 * @method     ChildEmployeeloanQuery innerJoinWithOpsmonthlycalendar() Adds a INNER JOIN clause and with to the query using the Opsmonthlycalendar relation
 *
 * @method     ChildEmployeeloanQuery leftJoinEmployeeloanpmt($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeeloanpmt relation
 * @method     ChildEmployeeloanQuery rightJoinEmployeeloanpmt($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeeloanpmt relation
 * @method     ChildEmployeeloanQuery innerJoinEmployeeloanpmt($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeeloanpmt relation
 *
 * @method     ChildEmployeeloanQuery joinWithEmployeeloanpmt($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeeloanpmt relation
 *
 * @method     ChildEmployeeloanQuery leftJoinWithEmployeeloanpmt() Adds a LEFT JOIN clause and with to the query using the Employeeloanpmt relation
 * @method     ChildEmployeeloanQuery rightJoinWithEmployeeloanpmt() Adds a RIGHT JOIN clause and with to the query using the Employeeloanpmt relation
 * @method     ChildEmployeeloanQuery innerJoinWithEmployeeloanpmt() Adds a INNER JOIN clause and with to the query using the Employeeloanpmt relation
 *
 * @method     \lwops\lwops\EmployeeQuery|\lwops\lwops\OpsmonthlycalendarQuery|\lwops\lwops\EmployeeloanpmtQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployeeloan findOne(ConnectionInterface $con = null) Return the first ChildEmployeeloan matching the query
 * @method     ChildEmployeeloan findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmployeeloan matching the query, or a new ChildEmployeeloan object populated from the query conditions when no match is found
 *
 * @method     ChildEmployeeloan findOneByOid(int $oid) Return the first ChildEmployeeloan filtered by the oid column
 * @method     ChildEmployeeloan findOneByEmployeeoid(int $employeeOid) Return the first ChildEmployeeloan filtered by the employeeOid column
 * @method     ChildEmployeeloan findOneByLoannbr(string $loanNbr) Return the first ChildEmployeeloan filtered by the loanNbr column
 * @method     ChildEmployeeloan findOneByLoandate(string $loanDate) Return the first ChildEmployeeloan filtered by the loanDate column
 * @method     ChildEmployeeloan findOneByLoanamount(double $loanAmount) Return the first ChildEmployeeloan filtered by the loanAmount column
 * @method     ChildEmployeeloan findOneByPurpose(string $purpose) Return the first ChildEmployeeloan filtered by the purpose column
 * @method     ChildEmployeeloan findOneByNbrofpayperiods(double $nbrOfPayPeriods) Return the first ChildEmployeeloan filtered by the nbrOfPayPeriods column
 * @method     ChildEmployeeloan findOneByOpsmonthlycalendaroid(int $opsMonthlyCalendarOid) Return the first ChildEmployeeloan filtered by the opsMonthlyCalendarOid column
 * @method     ChildEmployeeloan findOneByInstallmentamt(double $installmentAmt) Return the first ChildEmployeeloan filtered by the installmentAmt column
 * @method     ChildEmployeeloan findOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeeloan filtered by the createTmstp column
 * @method     ChildEmployeeloan findOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeeloan filtered by the updtTmstp column *

 * @method     ChildEmployeeloan requirePk($key, ConnectionInterface $con = null) Return the ChildEmployeeloan by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloan requireOne(ConnectionInterface $con = null) Return the first ChildEmployeeloan matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeloan requireOneByOid(int $oid) Return the first ChildEmployeeloan filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloan requireOneByEmployeeoid(int $employeeOid) Return the first ChildEmployeeloan filtered by the employeeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloan requireOneByLoannbr(string $loanNbr) Return the first ChildEmployeeloan filtered by the loanNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloan requireOneByLoandate(string $loanDate) Return the first ChildEmployeeloan filtered by the loanDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloan requireOneByLoanamount(double $loanAmount) Return the first ChildEmployeeloan filtered by the loanAmount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloan requireOneByPurpose(string $purpose) Return the first ChildEmployeeloan filtered by the purpose column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloan requireOneByNbrofpayperiods(double $nbrOfPayPeriods) Return the first ChildEmployeeloan filtered by the nbrOfPayPeriods column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloan requireOneByOpsmonthlycalendaroid(int $opsMonthlyCalendarOid) Return the first ChildEmployeeloan filtered by the opsMonthlyCalendarOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloan requireOneByInstallmentamt(double $installmentAmt) Return the first ChildEmployeeloan filtered by the installmentAmt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloan requireOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeeloan filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloan requireOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeeloan filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeloan[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmployeeloan objects based on current ModelCriteria
 * @method     ChildEmployeeloan[]|ObjectCollection findByOid(int $oid) Return ChildEmployeeloan objects filtered by the oid column
 * @method     ChildEmployeeloan[]|ObjectCollection findByEmployeeoid(int $employeeOid) Return ChildEmployeeloan objects filtered by the employeeOid column
 * @method     ChildEmployeeloan[]|ObjectCollection findByLoannbr(string $loanNbr) Return ChildEmployeeloan objects filtered by the loanNbr column
 * @method     ChildEmployeeloan[]|ObjectCollection findByLoandate(string $loanDate) Return ChildEmployeeloan objects filtered by the loanDate column
 * @method     ChildEmployeeloan[]|ObjectCollection findByLoanamount(double $loanAmount) Return ChildEmployeeloan objects filtered by the loanAmount column
 * @method     ChildEmployeeloan[]|ObjectCollection findByPurpose(string $purpose) Return ChildEmployeeloan objects filtered by the purpose column
 * @method     ChildEmployeeloan[]|ObjectCollection findByNbrofpayperiods(double $nbrOfPayPeriods) Return ChildEmployeeloan objects filtered by the nbrOfPayPeriods column
 * @method     ChildEmployeeloan[]|ObjectCollection findByOpsmonthlycalendaroid(int $opsMonthlyCalendarOid) Return ChildEmployeeloan objects filtered by the opsMonthlyCalendarOid column
 * @method     ChildEmployeeloan[]|ObjectCollection findByInstallmentamt(double $installmentAmt) Return ChildEmployeeloan objects filtered by the installmentAmt column
 * @method     ChildEmployeeloan[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildEmployeeloan objects filtered by the createTmstp column
 * @method     ChildEmployeeloan[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildEmployeeloan objects filtered by the updtTmstp column
 * @method     ChildEmployeeloan[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmployeeloanQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\EmployeeloanQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Employeeloan', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeeloanQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeeloanQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmployeeloanQuery) {
            return $criteria;
        }
        $query = new ChildEmployeeloanQuery();
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
     * @return ChildEmployeeloan|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeloanTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeeloanTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployeeloan A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, employeeOid, loanNbr, loanDate, loanAmount, purpose, nbrOfPayPeriods, opsMonthlyCalendarOid, installmentAmt, createTmstp, updtTmstp FROM employeeloan WHERE oid = :p0';
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
            /** @var ChildEmployeeloan $obj */
            $obj = new ChildEmployeeloan();
            $obj->hydrate($row);
            EmployeeloanTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployeeloan|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmployeeloanTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmployeeloanTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanTableMap::COL_OID, $oid, $comparison);
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
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByEmployeeoid($employeeoid = null, $comparison = null)
    {
        if (is_array($employeeoid)) {
            $useMinMax = false;
            if (isset($employeeoid['min'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_EMPLOYEEOID, $employeeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeoid['max'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_EMPLOYEEOID, $employeeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanTableMap::COL_EMPLOYEEOID, $employeeoid, $comparison);
    }

    /**
     * Filter the query on the loanNbr column
     *
     * Example usage:
     * <code>
     * $query->filterByLoannbr('fooValue');   // WHERE loanNbr = 'fooValue'
     * $query->filterByLoannbr('%fooValue%', Criteria::LIKE); // WHERE loanNbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $loannbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByLoannbr($loannbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($loannbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanTableMap::COL_LOANNBR, $loannbr, $comparison);
    }

    /**
     * Filter the query on the loanDate column
     *
     * Example usage:
     * <code>
     * $query->filterByLoandate('2011-03-14'); // WHERE loanDate = '2011-03-14'
     * $query->filterByLoandate('now'); // WHERE loanDate = '2011-03-14'
     * $query->filterByLoandate(array('max' => 'yesterday')); // WHERE loanDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $loandate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByLoandate($loandate = null, $comparison = null)
    {
        if (is_array($loandate)) {
            $useMinMax = false;
            if (isset($loandate['min'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_LOANDATE, $loandate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($loandate['max'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_LOANDATE, $loandate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanTableMap::COL_LOANDATE, $loandate, $comparison);
    }

    /**
     * Filter the query on the loanAmount column
     *
     * Example usage:
     * <code>
     * $query->filterByLoanamount(1234); // WHERE loanAmount = 1234
     * $query->filterByLoanamount(array(12, 34)); // WHERE loanAmount IN (12, 34)
     * $query->filterByLoanamount(array('min' => 12)); // WHERE loanAmount > 12
     * </code>
     *
     * @param     mixed $loanamount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByLoanamount($loanamount = null, $comparison = null)
    {
        if (is_array($loanamount)) {
            $useMinMax = false;
            if (isset($loanamount['min'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_LOANAMOUNT, $loanamount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($loanamount['max'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_LOANAMOUNT, $loanamount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanTableMap::COL_LOANAMOUNT, $loanamount, $comparison);
    }

    /**
     * Filter the query on the purpose column
     *
     * Example usage:
     * <code>
     * $query->filterByPurpose('fooValue');   // WHERE purpose = 'fooValue'
     * $query->filterByPurpose('%fooValue%', Criteria::LIKE); // WHERE purpose LIKE '%fooValue%'
     * </code>
     *
     * @param     string $purpose The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByPurpose($purpose = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($purpose)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanTableMap::COL_PURPOSE, $purpose, $comparison);
    }

    /**
     * Filter the query on the nbrOfPayPeriods column
     *
     * Example usage:
     * <code>
     * $query->filterByNbrofpayperiods(1234); // WHERE nbrOfPayPeriods = 1234
     * $query->filterByNbrofpayperiods(array(12, 34)); // WHERE nbrOfPayPeriods IN (12, 34)
     * $query->filterByNbrofpayperiods(array('min' => 12)); // WHERE nbrOfPayPeriods > 12
     * </code>
     *
     * @param     mixed $nbrofpayperiods The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByNbrofpayperiods($nbrofpayperiods = null, $comparison = null)
    {
        if (is_array($nbrofpayperiods)) {
            $useMinMax = false;
            if (isset($nbrofpayperiods['min'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_NBROFPAYPERIODS, $nbrofpayperiods['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nbrofpayperiods['max'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_NBROFPAYPERIODS, $nbrofpayperiods['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanTableMap::COL_NBROFPAYPERIODS, $nbrofpayperiods, $comparison);
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
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByOpsmonthlycalendaroid($opsmonthlycalendaroid = null, $comparison = null)
    {
        if (is_array($opsmonthlycalendaroid)) {
            $useMinMax = false;
            if (isset($opsmonthlycalendaroid['min'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendaroid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($opsmonthlycalendaroid['max'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendaroid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendaroid, $comparison);
    }

    /**
     * Filter the query on the installmentAmt column
     *
     * Example usage:
     * <code>
     * $query->filterByInstallmentamt(1234); // WHERE installmentAmt = 1234
     * $query->filterByInstallmentamt(array(12, 34)); // WHERE installmentAmt IN (12, 34)
     * $query->filterByInstallmentamt(array('min' => 12)); // WHERE installmentAmt > 12
     * </code>
     *
     * @param     mixed $installmentamt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByInstallmentamt($installmentamt = null, $comparison = null)
    {
        if (is_array($installmentamt)) {
            $useMinMax = false;
            if (isset($installmentamt['min'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_INSTALLMENTAMT, $installmentamt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($installmentamt['max'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_INSTALLMENTAMT, $installmentamt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanTableMap::COL_INSTALLMENTAMT, $installmentamt, $comparison);
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
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(EmployeeloanTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Employee object
     *
     * @param \lwops\lwops\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \lwops\lwops\Employee) {
            return $this
                ->addUsingAlias(EmployeeloanTableMap::COL_EMPLOYEEOID, $employee->getOid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeeloanTableMap::COL_EMPLOYEEOID, $employee->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Opsmonthlycalendar object
     *
     * @param \lwops\lwops\Opsmonthlycalendar|ObjectCollection $opsmonthlycalendar The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByOpsmonthlycalendar($opsmonthlycalendar, $comparison = null)
    {
        if ($opsmonthlycalendar instanceof \lwops\lwops\Opsmonthlycalendar) {
            return $this
                ->addUsingAlias(EmployeeloanTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendar->getOid(), $comparison);
        } elseif ($opsmonthlycalendar instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeeloanTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendar->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Employeeloanpmt object
     *
     * @param \lwops\lwops\Employeeloanpmt|ObjectCollection $employeeloanpmt the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function filterByEmployeeloanpmt($employeeloanpmt, $comparison = null)
    {
        if ($employeeloanpmt instanceof \lwops\lwops\Employeeloanpmt) {
            return $this
                ->addUsingAlias(EmployeeloanTableMap::COL_OID, $employeeloanpmt->getEmployeeloanoid(), $comparison);
        } elseif ($employeeloanpmt instanceof ObjectCollection) {
            return $this
                ->useEmployeeloanpmtQuery()
                ->filterByPrimaryKeys($employeeloanpmt->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEmployeeloanpmt() only accepts arguments of type \lwops\lwops\Employeeloanpmt or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employeeloanpmt relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function joinEmployeeloanpmt($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employeeloanpmt');

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
            $this->addJoinObject($join, 'Employeeloanpmt');
        }

        return $this;
    }

    /**
     * Use the Employeeloanpmt relation Employeeloanpmt object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeeloanpmtQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeloanpmtQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeeloanpmt($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employeeloanpmt', '\lwops\lwops\EmployeeloanpmtQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEmployeeloan $employeeloan Object to remove from the list of results
     *
     * @return $this|ChildEmployeeloanQuery The current query, for fluid interface
     */
    public function prune($employeeloan = null)
    {
        if ($employeeloan) {
            $this->addUsingAlias(EmployeeloanTableMap::COL_OID, $employeeloan->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employeeloan table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeloanTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeeloanTableMap::clearInstancePool();
            EmployeeloanTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeloanTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeeloanTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeeloanTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeeloanTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmployeeloanQuery
