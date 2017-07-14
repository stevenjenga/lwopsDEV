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
use lwops\lwops\Dairypandllabourexpensedetail as ChildDairypandllabourexpensedetail;
use lwops\lwops\DairypandllabourexpensedetailQuery as ChildDairypandllabourexpensedetailQuery;
use lwops\lwops\Map\DairypandllabourexpensedetailTableMap;

/**
 * Base class that represents a query for the 'dairypandllabourexpensedetail' table.
 *
 *
 *
 * @method     ChildDairypandllabourexpensedetailQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildDairypandllabourexpensedetailQuery orderByDairypandloid($order = Criteria::ASC) Order by the DairyPandLOid column
 * @method     ChildDairypandllabourexpensedetailQuery orderByEmployeeroleoid($order = Criteria::ASC) Order by the EmployeeRoleOid column
 * @method     ChildDairypandllabourexpensedetailQuery orderByExpenseamount($order = Criteria::ASC) Order by the expenseAmount column
 * @method     ChildDairypandllabourexpensedetailQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildDairypandllabourexpensedetailQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildDairypandllabourexpensedetailQuery groupByOid() Group by the oid column
 * @method     ChildDairypandllabourexpensedetailQuery groupByDairypandloid() Group by the DairyPandLOid column
 * @method     ChildDairypandllabourexpensedetailQuery groupByEmployeeroleoid() Group by the EmployeeRoleOid column
 * @method     ChildDairypandllabourexpensedetailQuery groupByExpenseamount() Group by the expenseAmount column
 * @method     ChildDairypandllabourexpensedetailQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildDairypandllabourexpensedetailQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildDairypandllabourexpensedetailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDairypandllabourexpensedetailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDairypandllabourexpensedetailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDairypandllabourexpensedetailQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDairypandllabourexpensedetailQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDairypandllabourexpensedetailQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDairypandllabourexpensedetailQuery leftJoinDairypandl($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dairypandl relation
 * @method     ChildDairypandllabourexpensedetailQuery rightJoinDairypandl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dairypandl relation
 * @method     ChildDairypandllabourexpensedetailQuery innerJoinDairypandl($relationAlias = null) Adds a INNER JOIN clause to the query using the Dairypandl relation
 *
 * @method     ChildDairypandllabourexpensedetailQuery joinWithDairypandl($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dairypandl relation
 *
 * @method     ChildDairypandllabourexpensedetailQuery leftJoinWithDairypandl() Adds a LEFT JOIN clause and with to the query using the Dairypandl relation
 * @method     ChildDairypandllabourexpensedetailQuery rightJoinWithDairypandl() Adds a RIGHT JOIN clause and with to the query using the Dairypandl relation
 * @method     ChildDairypandllabourexpensedetailQuery innerJoinWithDairypandl() Adds a INNER JOIN clause and with to the query using the Dairypandl relation
 *
 * @method     ChildDairypandllabourexpensedetailQuery leftJoinEmployeeroletype($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeeroletype relation
 * @method     ChildDairypandllabourexpensedetailQuery rightJoinEmployeeroletype($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeeroletype relation
 * @method     ChildDairypandllabourexpensedetailQuery innerJoinEmployeeroletype($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeeroletype relation
 *
 * @method     ChildDairypandllabourexpensedetailQuery joinWithEmployeeroletype($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeeroletype relation
 *
 * @method     ChildDairypandllabourexpensedetailQuery leftJoinWithEmployeeroletype() Adds a LEFT JOIN clause and with to the query using the Employeeroletype relation
 * @method     ChildDairypandllabourexpensedetailQuery rightJoinWithEmployeeroletype() Adds a RIGHT JOIN clause and with to the query using the Employeeroletype relation
 * @method     ChildDairypandllabourexpensedetailQuery innerJoinWithEmployeeroletype() Adds a INNER JOIN clause and with to the query using the Employeeroletype relation
 *
 * @method     \lwops\lwops\DairypandlQuery|\lwops\lwops\EmployeeroletypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDairypandllabourexpensedetail findOne(ConnectionInterface $con = null) Return the first ChildDairypandllabourexpensedetail matching the query
 * @method     ChildDairypandllabourexpensedetail findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDairypandllabourexpensedetail matching the query, or a new ChildDairypandllabourexpensedetail object populated from the query conditions when no match is found
 *
 * @method     ChildDairypandllabourexpensedetail findOneByOid(int $oid) Return the first ChildDairypandllabourexpensedetail filtered by the oid column
 * @method     ChildDairypandllabourexpensedetail findOneByDairypandloid(int $DairyPandLOid) Return the first ChildDairypandllabourexpensedetail filtered by the DairyPandLOid column
 * @method     ChildDairypandllabourexpensedetail findOneByEmployeeroleoid(int $EmployeeRoleOid) Return the first ChildDairypandllabourexpensedetail filtered by the EmployeeRoleOid column
 * @method     ChildDairypandllabourexpensedetail findOneByExpenseamount(double $expenseAmount) Return the first ChildDairypandllabourexpensedetail filtered by the expenseAmount column
 * @method     ChildDairypandllabourexpensedetail findOneByCreatetmstp(string $createTmstp) Return the first ChildDairypandllabourexpensedetail filtered by the createTmstp column
 * @method     ChildDairypandllabourexpensedetail findOneByUpdttmstp(string $updtTmstp) Return the first ChildDairypandllabourexpensedetail filtered by the updtTmstp column *

 * @method     ChildDairypandllabourexpensedetail requirePk($key, ConnectionInterface $con = null) Return the ChildDairypandllabourexpensedetail by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairypandllabourexpensedetail requireOne(ConnectionInterface $con = null) Return the first ChildDairypandllabourexpensedetail matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDairypandllabourexpensedetail requireOneByOid(int $oid) Return the first ChildDairypandllabourexpensedetail filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairypandllabourexpensedetail requireOneByDairypandloid(int $DairyPandLOid) Return the first ChildDairypandllabourexpensedetail filtered by the DairyPandLOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairypandllabourexpensedetail requireOneByEmployeeroleoid(int $EmployeeRoleOid) Return the first ChildDairypandllabourexpensedetail filtered by the EmployeeRoleOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairypandllabourexpensedetail requireOneByExpenseamount(double $expenseAmount) Return the first ChildDairypandllabourexpensedetail filtered by the expenseAmount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairypandllabourexpensedetail requireOneByCreatetmstp(string $createTmstp) Return the first ChildDairypandllabourexpensedetail filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairypandllabourexpensedetail requireOneByUpdttmstp(string $updtTmstp) Return the first ChildDairypandllabourexpensedetail filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDairypandllabourexpensedetail[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDairypandllabourexpensedetail objects based on current ModelCriteria
 * @method     ChildDairypandllabourexpensedetail[]|ObjectCollection findByOid(int $oid) Return ChildDairypandllabourexpensedetail objects filtered by the oid column
 * @method     ChildDairypandllabourexpensedetail[]|ObjectCollection findByDairypandloid(int $DairyPandLOid) Return ChildDairypandllabourexpensedetail objects filtered by the DairyPandLOid column
 * @method     ChildDairypandllabourexpensedetail[]|ObjectCollection findByEmployeeroleoid(int $EmployeeRoleOid) Return ChildDairypandllabourexpensedetail objects filtered by the EmployeeRoleOid column
 * @method     ChildDairypandllabourexpensedetail[]|ObjectCollection findByExpenseamount(double $expenseAmount) Return ChildDairypandllabourexpensedetail objects filtered by the expenseAmount column
 * @method     ChildDairypandllabourexpensedetail[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildDairypandllabourexpensedetail objects filtered by the createTmstp column
 * @method     ChildDairypandllabourexpensedetail[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildDairypandllabourexpensedetail objects filtered by the updtTmstp column
 * @method     ChildDairypandllabourexpensedetail[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DairypandllabourexpensedetailQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\DairypandllabourexpensedetailQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Dairypandllabourexpensedetail', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDairypandllabourexpensedetailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDairypandllabourexpensedetailQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDairypandllabourexpensedetailQuery) {
            return $criteria;
        }
        $query = new ChildDairypandllabourexpensedetailQuery();
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
     * @return ChildDairypandllabourexpensedetail|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DairypandllabourexpensedetailTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DairypandllabourexpensedetailTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDairypandllabourexpensedetail A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, DairyPandLOid, EmployeeRoleOid, expenseAmount, createTmstp, updtTmstp FROM dairypandllabourexpensedetail WHERE oid = :p0';
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
            /** @var ChildDairypandllabourexpensedetail $obj */
            $obj = new ChildDairypandllabourexpensedetail();
            $obj->hydrate($row);
            DairypandllabourexpensedetailTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDairypandllabourexpensedetail|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDairypandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDairypandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildDairypandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the DairyPandLOid column
     *
     * Example usage:
     * <code>
     * $query->filterByDairypandloid(1234); // WHERE DairyPandLOid = 1234
     * $query->filterByDairypandloid(array(12, 34)); // WHERE DairyPandLOid IN (12, 34)
     * $query->filterByDairypandloid(array('min' => 12)); // WHERE DairyPandLOid > 12
     * </code>
     *
     * @see       filterByDairypandl()
     *
     * @param     mixed $dairypandloid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDairypandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByDairypandloid($dairypandloid = null, $comparison = null)
    {
        if (is_array($dairypandloid)) {
            $useMinMax = false;
            if (isset($dairypandloid['min'])) {
                $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_DAIRYPANDLOID, $dairypandloid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dairypandloid['max'])) {
                $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_DAIRYPANDLOID, $dairypandloid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_DAIRYPANDLOID, $dairypandloid, $comparison);
    }

    /**
     * Filter the query on the EmployeeRoleOid column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeroleoid(1234); // WHERE EmployeeRoleOid = 1234
     * $query->filterByEmployeeroleoid(array(12, 34)); // WHERE EmployeeRoleOid IN (12, 34)
     * $query->filterByEmployeeroleoid(array('min' => 12)); // WHERE EmployeeRoleOid > 12
     * </code>
     *
     * @see       filterByEmployeeroletype()
     *
     * @param     mixed $employeeroleoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDairypandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByEmployeeroleoid($employeeroleoid = null, $comparison = null)
    {
        if (is_array($employeeroleoid)) {
            $useMinMax = false;
            if (isset($employeeroleoid['min'])) {
                $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_EMPLOYEEROLEOID, $employeeroleoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeroleoid['max'])) {
                $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_EMPLOYEEROLEOID, $employeeroleoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_EMPLOYEEROLEOID, $employeeroleoid, $comparison);
    }

    /**
     * Filter the query on the expenseAmount column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseamount(1234); // WHERE expenseAmount = 1234
     * $query->filterByExpenseamount(array(12, 34)); // WHERE expenseAmount IN (12, 34)
     * $query->filterByExpenseamount(array('min' => 12)); // WHERE expenseAmount > 12
     * </code>
     *
     * @param     mixed $expenseamount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDairypandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByExpenseamount($expenseamount = null, $comparison = null)
    {
        if (is_array($expenseamount)) {
            $useMinMax = false;
            if (isset($expenseamount['min'])) {
                $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_EXPENSEAMOUNT, $expenseamount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseamount['max'])) {
                $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_EXPENSEAMOUNT, $expenseamount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_EXPENSEAMOUNT, $expenseamount, $comparison);
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
     * @return $this|ChildDairypandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildDairypandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Dairypandl object
     *
     * @param \lwops\lwops\Dairypandl|ObjectCollection $dairypandl The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDairypandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByDairypandl($dairypandl, $comparison = null)
    {
        if ($dairypandl instanceof \lwops\lwops\Dairypandl) {
            return $this
                ->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_DAIRYPANDLOID, $dairypandl->getOid(), $comparison);
        } elseif ($dairypandl instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_DAIRYPANDLOID, $dairypandl->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByDairypandl() only accepts arguments of type \lwops\lwops\Dairypandl or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dairypandl relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDairypandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function joinDairypandl($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dairypandl');

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
            $this->addJoinObject($join, 'Dairypandl');
        }

        return $this;
    }

    /**
     * Use the Dairypandl relation Dairypandl object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\DairypandlQuery A secondary query class using the current class as primary query
     */
    public function useDairypandlQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDairypandl($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dairypandl', '\lwops\lwops\DairypandlQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeeroletype object
     *
     * @param \lwops\lwops\Employeeroletype|ObjectCollection $employeeroletype The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDairypandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByEmployeeroletype($employeeroletype, $comparison = null)
    {
        if ($employeeroletype instanceof \lwops\lwops\Employeeroletype) {
            return $this
                ->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_EMPLOYEEROLEOID, $employeeroletype->getOid(), $comparison);
        } elseif ($employeeroletype instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_EMPLOYEEROLEOID, $employeeroletype->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildDairypandllabourexpensedetailQuery The current query, for fluid interface
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
     * @param   ChildDairypandllabourexpensedetail $dairypandllabourexpensedetail Object to remove from the list of results
     *
     * @return $this|ChildDairypandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function prune($dairypandllabourexpensedetail = null)
    {
        if ($dairypandllabourexpensedetail) {
            $this->addUsingAlias(DairypandllabourexpensedetailTableMap::COL_OID, $dairypandllabourexpensedetail->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the dairypandllabourexpensedetail table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DairypandllabourexpensedetailTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DairypandllabourexpensedetailTableMap::clearInstancePool();
            DairypandllabourexpensedetailTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DairypandllabourexpensedetailTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DairypandllabourexpensedetailTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DairypandllabourexpensedetailTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DairypandllabourexpensedetailTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DairypandllabourexpensedetailQuery
