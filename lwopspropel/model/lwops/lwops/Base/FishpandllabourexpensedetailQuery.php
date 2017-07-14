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
use lwops\lwops\Fishpandllabourexpensedetail as ChildFishpandllabourexpensedetail;
use lwops\lwops\FishpandllabourexpensedetailQuery as ChildFishpandllabourexpensedetailQuery;
use lwops\lwops\Map\FishpandllabourexpensedetailTableMap;

/**
 * Base class that represents a query for the 'fishpandllabourexpensedetail' table.
 *
 *
 *
 * @method     ChildFishpandllabourexpensedetailQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildFishpandllabourexpensedetailQuery orderByFishpandloid($order = Criteria::ASC) Order by the FishPandLOid column
 * @method     ChildFishpandllabourexpensedetailQuery orderByEmployeeroleoid($order = Criteria::ASC) Order by the EmployeeRoleOid column
 * @method     ChildFishpandllabourexpensedetailQuery orderByExpenseamount($order = Criteria::ASC) Order by the expenseAmount column
 * @method     ChildFishpandllabourexpensedetailQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildFishpandllabourexpensedetailQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildFishpandllabourexpensedetailQuery groupByOid() Group by the oid column
 * @method     ChildFishpandllabourexpensedetailQuery groupByFishpandloid() Group by the FishPandLOid column
 * @method     ChildFishpandllabourexpensedetailQuery groupByEmployeeroleoid() Group by the EmployeeRoleOid column
 * @method     ChildFishpandllabourexpensedetailQuery groupByExpenseamount() Group by the expenseAmount column
 * @method     ChildFishpandllabourexpensedetailQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildFishpandllabourexpensedetailQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildFishpandllabourexpensedetailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFishpandllabourexpensedetailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFishpandllabourexpensedetailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFishpandllabourexpensedetailQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFishpandllabourexpensedetailQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFishpandllabourexpensedetailQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFishpandllabourexpensedetailQuery leftJoinEmployeeroletype($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeeroletype relation
 * @method     ChildFishpandllabourexpensedetailQuery rightJoinEmployeeroletype($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeeroletype relation
 * @method     ChildFishpandllabourexpensedetailQuery innerJoinEmployeeroletype($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeeroletype relation
 *
 * @method     ChildFishpandllabourexpensedetailQuery joinWithEmployeeroletype($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeeroletype relation
 *
 * @method     ChildFishpandllabourexpensedetailQuery leftJoinWithEmployeeroletype() Adds a LEFT JOIN clause and with to the query using the Employeeroletype relation
 * @method     ChildFishpandllabourexpensedetailQuery rightJoinWithEmployeeroletype() Adds a RIGHT JOIN clause and with to the query using the Employeeroletype relation
 * @method     ChildFishpandllabourexpensedetailQuery innerJoinWithEmployeeroletype() Adds a INNER JOIN clause and with to the query using the Employeeroletype relation
 *
 * @method     ChildFishpandllabourexpensedetailQuery leftJoinFishpandl($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fishpandl relation
 * @method     ChildFishpandllabourexpensedetailQuery rightJoinFishpandl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fishpandl relation
 * @method     ChildFishpandllabourexpensedetailQuery innerJoinFishpandl($relationAlias = null) Adds a INNER JOIN clause to the query using the Fishpandl relation
 *
 * @method     ChildFishpandllabourexpensedetailQuery joinWithFishpandl($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fishpandl relation
 *
 * @method     ChildFishpandllabourexpensedetailQuery leftJoinWithFishpandl() Adds a LEFT JOIN clause and with to the query using the Fishpandl relation
 * @method     ChildFishpandllabourexpensedetailQuery rightJoinWithFishpandl() Adds a RIGHT JOIN clause and with to the query using the Fishpandl relation
 * @method     ChildFishpandllabourexpensedetailQuery innerJoinWithFishpandl() Adds a INNER JOIN clause and with to the query using the Fishpandl relation
 *
 * @method     \lwops\lwops\EmployeeroletypeQuery|\lwops\lwops\FishpandlQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFishpandllabourexpensedetail findOne(ConnectionInterface $con = null) Return the first ChildFishpandllabourexpensedetail matching the query
 * @method     ChildFishpandllabourexpensedetail findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFishpandllabourexpensedetail matching the query, or a new ChildFishpandllabourexpensedetail object populated from the query conditions when no match is found
 *
 * @method     ChildFishpandllabourexpensedetail findOneByOid(int $oid) Return the first ChildFishpandllabourexpensedetail filtered by the oid column
 * @method     ChildFishpandllabourexpensedetail findOneByFishpandloid(int $FishPandLOid) Return the first ChildFishpandllabourexpensedetail filtered by the FishPandLOid column
 * @method     ChildFishpandllabourexpensedetail findOneByEmployeeroleoid(int $EmployeeRoleOid) Return the first ChildFishpandllabourexpensedetail filtered by the EmployeeRoleOid column
 * @method     ChildFishpandllabourexpensedetail findOneByExpenseamount(double $expenseAmount) Return the first ChildFishpandllabourexpensedetail filtered by the expenseAmount column
 * @method     ChildFishpandllabourexpensedetail findOneByCreatetmstp(string $createTmstp) Return the first ChildFishpandllabourexpensedetail filtered by the createTmstp column
 * @method     ChildFishpandllabourexpensedetail findOneByUpdttmstp(string $updtTmstp) Return the first ChildFishpandllabourexpensedetail filtered by the updtTmstp column *

 * @method     ChildFishpandllabourexpensedetail requirePk($key, ConnectionInterface $con = null) Return the ChildFishpandllabourexpensedetail by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandllabourexpensedetail requireOne(ConnectionInterface $con = null) Return the first ChildFishpandllabourexpensedetail matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFishpandllabourexpensedetail requireOneByOid(int $oid) Return the first ChildFishpandllabourexpensedetail filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandllabourexpensedetail requireOneByFishpandloid(int $FishPandLOid) Return the first ChildFishpandllabourexpensedetail filtered by the FishPandLOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandllabourexpensedetail requireOneByEmployeeroleoid(int $EmployeeRoleOid) Return the first ChildFishpandllabourexpensedetail filtered by the EmployeeRoleOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandllabourexpensedetail requireOneByExpenseamount(double $expenseAmount) Return the first ChildFishpandllabourexpensedetail filtered by the expenseAmount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandllabourexpensedetail requireOneByCreatetmstp(string $createTmstp) Return the first ChildFishpandllabourexpensedetail filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandllabourexpensedetail requireOneByUpdttmstp(string $updtTmstp) Return the first ChildFishpandllabourexpensedetail filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFishpandllabourexpensedetail[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFishpandllabourexpensedetail objects based on current ModelCriteria
 * @method     ChildFishpandllabourexpensedetail[]|ObjectCollection findByOid(int $oid) Return ChildFishpandllabourexpensedetail objects filtered by the oid column
 * @method     ChildFishpandllabourexpensedetail[]|ObjectCollection findByFishpandloid(int $FishPandLOid) Return ChildFishpandllabourexpensedetail objects filtered by the FishPandLOid column
 * @method     ChildFishpandllabourexpensedetail[]|ObjectCollection findByEmployeeroleoid(int $EmployeeRoleOid) Return ChildFishpandllabourexpensedetail objects filtered by the EmployeeRoleOid column
 * @method     ChildFishpandllabourexpensedetail[]|ObjectCollection findByExpenseamount(double $expenseAmount) Return ChildFishpandllabourexpensedetail objects filtered by the expenseAmount column
 * @method     ChildFishpandllabourexpensedetail[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildFishpandllabourexpensedetail objects filtered by the createTmstp column
 * @method     ChildFishpandllabourexpensedetail[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildFishpandllabourexpensedetail objects filtered by the updtTmstp column
 * @method     ChildFishpandllabourexpensedetail[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FishpandllabourexpensedetailQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\FishpandllabourexpensedetailQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Fishpandllabourexpensedetail', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFishpandllabourexpensedetailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFishpandllabourexpensedetailQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFishpandllabourexpensedetailQuery) {
            return $criteria;
        }
        $query = new ChildFishpandllabourexpensedetailQuery();
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
     * @return ChildFishpandllabourexpensedetail|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FishpandllabourexpensedetailTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FishpandllabourexpensedetailTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFishpandllabourexpensedetail A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, FishPandLOid, EmployeeRoleOid, expenseAmount, createTmstp, updtTmstp FROM fishpandllabourexpensedetail WHERE oid = :p0';
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
            /** @var ChildFishpandllabourexpensedetail $obj */
            $obj = new ChildFishpandllabourexpensedetail();
            $obj->hydrate($row);
            FishpandllabourexpensedetailTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFishpandllabourexpensedetail|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFishpandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFishpandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildFishpandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the FishPandLOid column
     *
     * Example usage:
     * <code>
     * $query->filterByFishpandloid(1234); // WHERE FishPandLOid = 1234
     * $query->filterByFishpandloid(array(12, 34)); // WHERE FishPandLOid IN (12, 34)
     * $query->filterByFishpandloid(array('min' => 12)); // WHERE FishPandLOid > 12
     * </code>
     *
     * @see       filterByFishpandl()
     *
     * @param     mixed $fishpandloid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishpandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByFishpandloid($fishpandloid = null, $comparison = null)
    {
        if (is_array($fishpandloid)) {
            $useMinMax = false;
            if (isset($fishpandloid['min'])) {
                $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_FISHPANDLOID, $fishpandloid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fishpandloid['max'])) {
                $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_FISHPANDLOID, $fishpandloid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_FISHPANDLOID, $fishpandloid, $comparison);
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
     * @return $this|ChildFishpandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByEmployeeroleoid($employeeroleoid = null, $comparison = null)
    {
        if (is_array($employeeroleoid)) {
            $useMinMax = false;
            if (isset($employeeroleoid['min'])) {
                $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_EMPLOYEEROLEOID, $employeeroleoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeroleoid['max'])) {
                $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_EMPLOYEEROLEOID, $employeeroleoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_EMPLOYEEROLEOID, $employeeroleoid, $comparison);
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
     * @return $this|ChildFishpandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByExpenseamount($expenseamount = null, $comparison = null)
    {
        if (is_array($expenseamount)) {
            $useMinMax = false;
            if (isset($expenseamount['min'])) {
                $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_EXPENSEAMOUNT, $expenseamount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseamount['max'])) {
                $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_EXPENSEAMOUNT, $expenseamount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_EXPENSEAMOUNT, $expenseamount, $comparison);
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
     * @return $this|ChildFishpandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildFishpandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeeroletype object
     *
     * @param \lwops\lwops\Employeeroletype|ObjectCollection $employeeroletype The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFishpandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByEmployeeroletype($employeeroletype, $comparison = null)
    {
        if ($employeeroletype instanceof \lwops\lwops\Employeeroletype) {
            return $this
                ->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_EMPLOYEEROLEOID, $employeeroletype->getOid(), $comparison);
        } elseif ($employeeroletype instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_EMPLOYEEROLEOID, $employeeroletype->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildFishpandllabourexpensedetailQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Fishpandl object
     *
     * @param \lwops\lwops\Fishpandl|ObjectCollection $fishpandl The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFishpandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function filterByFishpandl($fishpandl, $comparison = null)
    {
        if ($fishpandl instanceof \lwops\lwops\Fishpandl) {
            return $this
                ->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_FISHPANDLOID, $fishpandl->getOid(), $comparison);
        } elseif ($fishpandl instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_FISHPANDLOID, $fishpandl->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByFishpandl() only accepts arguments of type \lwops\lwops\Fishpandl or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fishpandl relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFishpandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function joinFishpandl($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fishpandl');

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
            $this->addJoinObject($join, 'Fishpandl');
        }

        return $this;
    }

    /**
     * Use the Fishpandl relation Fishpandl object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\FishpandlQuery A secondary query class using the current class as primary query
     */
    public function useFishpandlQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFishpandl($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fishpandl', '\lwops\lwops\FishpandlQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFishpandllabourexpensedetail $fishpandllabourexpensedetail Object to remove from the list of results
     *
     * @return $this|ChildFishpandllabourexpensedetailQuery The current query, for fluid interface
     */
    public function prune($fishpandllabourexpensedetail = null)
    {
        if ($fishpandllabourexpensedetail) {
            $this->addUsingAlias(FishpandllabourexpensedetailTableMap::COL_OID, $fishpandllabourexpensedetail->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the fishpandllabourexpensedetail table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FishpandllabourexpensedetailTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FishpandllabourexpensedetailTableMap::clearInstancePool();
            FishpandllabourexpensedetailTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FishpandllabourexpensedetailTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FishpandllabourexpensedetailTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FishpandllabourexpensedetailTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FishpandllabourexpensedetailTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FishpandllabourexpensedetailQuery
