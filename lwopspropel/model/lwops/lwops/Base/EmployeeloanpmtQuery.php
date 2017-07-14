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
use lwops\lwops\Employeeloanpmt as ChildEmployeeloanpmt;
use lwops\lwops\EmployeeloanpmtQuery as ChildEmployeeloanpmtQuery;
use lwops\lwops\Map\EmployeeloanpmtTableMap;

/**
 * Base class that represents a query for the 'employeeloanpmt' table.
 *
 *
 *
 * @method     ChildEmployeeloanpmtQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildEmployeeloanpmtQuery orderByEmployeeloanoid($order = Criteria::ASC) Order by the employeeLoanOid column
 * @method     ChildEmployeeloanpmtQuery orderByDeductionamt($order = Criteria::ASC) Order by the deductionAmt column
 * @method     ChildEmployeeloanpmtQuery orderByBalanceamount($order = Criteria::ASC) Order by the balanceAmount column
 * @method     ChildEmployeeloanpmtQuery orderByPaid($order = Criteria::ASC) Order by the paid column
 * @method     ChildEmployeeloanpmtQuery orderByPayslipnbr($order = Criteria::ASC) Order by the payslipNbr column
 * @method     ChildEmployeeloanpmtQuery orderByDatededucted($order = Criteria::ASC) Order by the dateDeducted column
 * @method     ChildEmployeeloanpmtQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildEmployeeloanpmtQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildEmployeeloanpmtQuery groupByOid() Group by the oid column
 * @method     ChildEmployeeloanpmtQuery groupByEmployeeloanoid() Group by the employeeLoanOid column
 * @method     ChildEmployeeloanpmtQuery groupByDeductionamt() Group by the deductionAmt column
 * @method     ChildEmployeeloanpmtQuery groupByBalanceamount() Group by the balanceAmount column
 * @method     ChildEmployeeloanpmtQuery groupByPaid() Group by the paid column
 * @method     ChildEmployeeloanpmtQuery groupByPayslipnbr() Group by the payslipNbr column
 * @method     ChildEmployeeloanpmtQuery groupByDatededucted() Group by the dateDeducted column
 * @method     ChildEmployeeloanpmtQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildEmployeeloanpmtQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildEmployeeloanpmtQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeeloanpmtQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeeloanpmtQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeeloanpmtQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeeloanpmtQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeeloanpmtQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeeloanpmtQuery leftJoinEmployeeloan($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeeloan relation
 * @method     ChildEmployeeloanpmtQuery rightJoinEmployeeloan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeeloan relation
 * @method     ChildEmployeeloanpmtQuery innerJoinEmployeeloan($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeeloan relation
 *
 * @method     ChildEmployeeloanpmtQuery joinWithEmployeeloan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeeloan relation
 *
 * @method     ChildEmployeeloanpmtQuery leftJoinWithEmployeeloan() Adds a LEFT JOIN clause and with to the query using the Employeeloan relation
 * @method     ChildEmployeeloanpmtQuery rightJoinWithEmployeeloan() Adds a RIGHT JOIN clause and with to the query using the Employeeloan relation
 * @method     ChildEmployeeloanpmtQuery innerJoinWithEmployeeloan() Adds a INNER JOIN clause and with to the query using the Employeeloan relation
 *
 * @method     \lwops\lwops\EmployeeloanQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployeeloanpmt findOne(ConnectionInterface $con = null) Return the first ChildEmployeeloanpmt matching the query
 * @method     ChildEmployeeloanpmt findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmployeeloanpmt matching the query, or a new ChildEmployeeloanpmt object populated from the query conditions when no match is found
 *
 * @method     ChildEmployeeloanpmt findOneByOid(int $oid) Return the first ChildEmployeeloanpmt filtered by the oid column
 * @method     ChildEmployeeloanpmt findOneByEmployeeloanoid(int $employeeLoanOid) Return the first ChildEmployeeloanpmt filtered by the employeeLoanOid column
 * @method     ChildEmployeeloanpmt findOneByDeductionamt(double $deductionAmt) Return the first ChildEmployeeloanpmt filtered by the deductionAmt column
 * @method     ChildEmployeeloanpmt findOneByBalanceamount(double $balanceAmount) Return the first ChildEmployeeloanpmt filtered by the balanceAmount column
 * @method     ChildEmployeeloanpmt findOneByPaid(string $paid) Return the first ChildEmployeeloanpmt filtered by the paid column
 * @method     ChildEmployeeloanpmt findOneByPayslipnbr(string $payslipNbr) Return the first ChildEmployeeloanpmt filtered by the payslipNbr column
 * @method     ChildEmployeeloanpmt findOneByDatededucted(string $dateDeducted) Return the first ChildEmployeeloanpmt filtered by the dateDeducted column
 * @method     ChildEmployeeloanpmt findOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeeloanpmt filtered by the createTmstp column
 * @method     ChildEmployeeloanpmt findOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeeloanpmt filtered by the updtTmstp column *

 * @method     ChildEmployeeloanpmt requirePk($key, ConnectionInterface $con = null) Return the ChildEmployeeloanpmt by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloanpmt requireOne(ConnectionInterface $con = null) Return the first ChildEmployeeloanpmt matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeloanpmt requireOneByOid(int $oid) Return the first ChildEmployeeloanpmt filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloanpmt requireOneByEmployeeloanoid(int $employeeLoanOid) Return the first ChildEmployeeloanpmt filtered by the employeeLoanOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloanpmt requireOneByDeductionamt(double $deductionAmt) Return the first ChildEmployeeloanpmt filtered by the deductionAmt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloanpmt requireOneByBalanceamount(double $balanceAmount) Return the first ChildEmployeeloanpmt filtered by the balanceAmount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloanpmt requireOneByPaid(string $paid) Return the first ChildEmployeeloanpmt filtered by the paid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloanpmt requireOneByPayslipnbr(string $payslipNbr) Return the first ChildEmployeeloanpmt filtered by the payslipNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloanpmt requireOneByDatededucted(string $dateDeducted) Return the first ChildEmployeeloanpmt filtered by the dateDeducted column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloanpmt requireOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeeloanpmt filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeloanpmt requireOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeeloanpmt filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeloanpmt[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmployeeloanpmt objects based on current ModelCriteria
 * @method     ChildEmployeeloanpmt[]|ObjectCollection findByOid(int $oid) Return ChildEmployeeloanpmt objects filtered by the oid column
 * @method     ChildEmployeeloanpmt[]|ObjectCollection findByEmployeeloanoid(int $employeeLoanOid) Return ChildEmployeeloanpmt objects filtered by the employeeLoanOid column
 * @method     ChildEmployeeloanpmt[]|ObjectCollection findByDeductionamt(double $deductionAmt) Return ChildEmployeeloanpmt objects filtered by the deductionAmt column
 * @method     ChildEmployeeloanpmt[]|ObjectCollection findByBalanceamount(double $balanceAmount) Return ChildEmployeeloanpmt objects filtered by the balanceAmount column
 * @method     ChildEmployeeloanpmt[]|ObjectCollection findByPaid(string $paid) Return ChildEmployeeloanpmt objects filtered by the paid column
 * @method     ChildEmployeeloanpmt[]|ObjectCollection findByPayslipnbr(string $payslipNbr) Return ChildEmployeeloanpmt objects filtered by the payslipNbr column
 * @method     ChildEmployeeloanpmt[]|ObjectCollection findByDatededucted(string $dateDeducted) Return ChildEmployeeloanpmt objects filtered by the dateDeducted column
 * @method     ChildEmployeeloanpmt[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildEmployeeloanpmt objects filtered by the createTmstp column
 * @method     ChildEmployeeloanpmt[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildEmployeeloanpmt objects filtered by the updtTmstp column
 * @method     ChildEmployeeloanpmt[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmployeeloanpmtQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\EmployeeloanpmtQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Employeeloanpmt', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeeloanpmtQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeeloanpmtQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmployeeloanpmtQuery) {
            return $criteria;
        }
        $query = new ChildEmployeeloanpmtQuery();
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
     * @return ChildEmployeeloanpmt|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeloanpmtTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeeloanpmtTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployeeloanpmt A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, employeeLoanOid, deductionAmt, balanceAmount, paid, payslipNbr, dateDeducted, createTmstp, updtTmstp FROM employeeloanpmt WHERE oid = :p0';
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
            /** @var ChildEmployeeloanpmt $obj */
            $obj = new ChildEmployeeloanpmt();
            $obj->hydrate($row);
            EmployeeloanpmtTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployeeloanpmt|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmployeeloanpmtQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmployeeloanpmtTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmployeeloanpmtQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmployeeloanpmtTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildEmployeeloanpmtQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(EmployeeloanpmtTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(EmployeeloanpmtTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanpmtTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the employeeLoanOid column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeloanoid(1234); // WHERE employeeLoanOid = 1234
     * $query->filterByEmployeeloanoid(array(12, 34)); // WHERE employeeLoanOid IN (12, 34)
     * $query->filterByEmployeeloanoid(array('min' => 12)); // WHERE employeeLoanOid > 12
     * </code>
     *
     * @see       filterByEmployeeloan()
     *
     * @param     mixed $employeeloanoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeloanpmtQuery The current query, for fluid interface
     */
    public function filterByEmployeeloanoid($employeeloanoid = null, $comparison = null)
    {
        if (is_array($employeeloanoid)) {
            $useMinMax = false;
            if (isset($employeeloanoid['min'])) {
                $this->addUsingAlias(EmployeeloanpmtTableMap::COL_EMPLOYEELOANOID, $employeeloanoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeloanoid['max'])) {
                $this->addUsingAlias(EmployeeloanpmtTableMap::COL_EMPLOYEELOANOID, $employeeloanoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanpmtTableMap::COL_EMPLOYEELOANOID, $employeeloanoid, $comparison);
    }

    /**
     * Filter the query on the deductionAmt column
     *
     * Example usage:
     * <code>
     * $query->filterByDeductionamt(1234); // WHERE deductionAmt = 1234
     * $query->filterByDeductionamt(array(12, 34)); // WHERE deductionAmt IN (12, 34)
     * $query->filterByDeductionamt(array('min' => 12)); // WHERE deductionAmt > 12
     * </code>
     *
     * @param     mixed $deductionamt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeloanpmtQuery The current query, for fluid interface
     */
    public function filterByDeductionamt($deductionamt = null, $comparison = null)
    {
        if (is_array($deductionamt)) {
            $useMinMax = false;
            if (isset($deductionamt['min'])) {
                $this->addUsingAlias(EmployeeloanpmtTableMap::COL_DEDUCTIONAMT, $deductionamt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deductionamt['max'])) {
                $this->addUsingAlias(EmployeeloanpmtTableMap::COL_DEDUCTIONAMT, $deductionamt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanpmtTableMap::COL_DEDUCTIONAMT, $deductionamt, $comparison);
    }

    /**
     * Filter the query on the balanceAmount column
     *
     * Example usage:
     * <code>
     * $query->filterByBalanceamount(1234); // WHERE balanceAmount = 1234
     * $query->filterByBalanceamount(array(12, 34)); // WHERE balanceAmount IN (12, 34)
     * $query->filterByBalanceamount(array('min' => 12)); // WHERE balanceAmount > 12
     * </code>
     *
     * @param     mixed $balanceamount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeloanpmtQuery The current query, for fluid interface
     */
    public function filterByBalanceamount($balanceamount = null, $comparison = null)
    {
        if (is_array($balanceamount)) {
            $useMinMax = false;
            if (isset($balanceamount['min'])) {
                $this->addUsingAlias(EmployeeloanpmtTableMap::COL_BALANCEAMOUNT, $balanceamount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($balanceamount['max'])) {
                $this->addUsingAlias(EmployeeloanpmtTableMap::COL_BALANCEAMOUNT, $balanceamount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanpmtTableMap::COL_BALANCEAMOUNT, $balanceamount, $comparison);
    }

    /**
     * Filter the query on the paid column
     *
     * Example usage:
     * <code>
     * $query->filterByPaid('fooValue');   // WHERE paid = 'fooValue'
     * $query->filterByPaid('%fooValue%', Criteria::LIKE); // WHERE paid LIKE '%fooValue%'
     * </code>
     *
     * @param     string $paid The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeloanpmtQuery The current query, for fluid interface
     */
    public function filterByPaid($paid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($paid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanpmtTableMap::COL_PAID, $paid, $comparison);
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
     * @return $this|ChildEmployeeloanpmtQuery The current query, for fluid interface
     */
    public function filterByPayslipnbr($payslipnbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($payslipnbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanpmtTableMap::COL_PAYSLIPNBR, $payslipnbr, $comparison);
    }

    /**
     * Filter the query on the dateDeducted column
     *
     * Example usage:
     * <code>
     * $query->filterByDatededucted('2011-03-14'); // WHERE dateDeducted = '2011-03-14'
     * $query->filterByDatededucted('now'); // WHERE dateDeducted = '2011-03-14'
     * $query->filterByDatededucted(array('max' => 'yesterday')); // WHERE dateDeducted > '2011-03-13'
     * </code>
     *
     * @param     mixed $datededucted The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeloanpmtQuery The current query, for fluid interface
     */
    public function filterByDatededucted($datededucted = null, $comparison = null)
    {
        if (is_array($datededucted)) {
            $useMinMax = false;
            if (isset($datededucted['min'])) {
                $this->addUsingAlias(EmployeeloanpmtTableMap::COL_DATEDEDUCTED, $datededucted['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datededucted['max'])) {
                $this->addUsingAlias(EmployeeloanpmtTableMap::COL_DATEDEDUCTED, $datededucted['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanpmtTableMap::COL_DATEDEDUCTED, $datededucted, $comparison);
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
     * @return $this|ChildEmployeeloanpmtQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(EmployeeloanpmtTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(EmployeeloanpmtTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanpmtTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildEmployeeloanpmtQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(EmployeeloanpmtTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(EmployeeloanpmtTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeloanpmtTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeeloan object
     *
     * @param \lwops\lwops\Employeeloan|ObjectCollection $employeeloan The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeeloanpmtQuery The current query, for fluid interface
     */
    public function filterByEmployeeloan($employeeloan, $comparison = null)
    {
        if ($employeeloan instanceof \lwops\lwops\Employeeloan) {
            return $this
                ->addUsingAlias(EmployeeloanpmtTableMap::COL_EMPLOYEELOANOID, $employeeloan->getOid(), $comparison);
        } elseif ($employeeloan instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeeloanpmtTableMap::COL_EMPLOYEELOANOID, $employeeloan->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByEmployeeloan() only accepts arguments of type \lwops\lwops\Employeeloan or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employeeloan relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeloanpmtQuery The current query, for fluid interface
     */
    public function joinEmployeeloan($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employeeloan');

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
            $this->addJoinObject($join, 'Employeeloan');
        }

        return $this;
    }

    /**
     * Use the Employeeloan relation Employeeloan object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeeloanQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeloanQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeeloan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employeeloan', '\lwops\lwops\EmployeeloanQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEmployeeloanpmt $employeeloanpmt Object to remove from the list of results
     *
     * @return $this|ChildEmployeeloanpmtQuery The current query, for fluid interface
     */
    public function prune($employeeloanpmt = null)
    {
        if ($employeeloanpmt) {
            $this->addUsingAlias(EmployeeloanpmtTableMap::COL_OID, $employeeloanpmt->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employeeloanpmt table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeloanpmtTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeeloanpmtTableMap::clearInstancePool();
            EmployeeloanpmtTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeloanpmtTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeeloanpmtTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeeloanpmtTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeeloanpmtTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmployeeloanpmtQuery
