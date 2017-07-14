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
use lwops\lwops\Lineofbusiness as ChildLineofbusiness;
use lwops\lwops\LineofbusinessQuery as ChildLineofbusinessQuery;
use lwops\lwops\Map\LineofbusinessTableMap;

/**
 * Base class that represents a query for the 'lineofbusiness' table.
 *
 *
 *
 * @method     ChildLineofbusinessQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildLineofbusinessQuery orderByDepartment($order = Criteria::ASC) Order by the department column
 * @method     ChildLineofbusinessQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildLineofbusinessQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildLineofbusinessQuery groupByOid() Group by the oid column
 * @method     ChildLineofbusinessQuery groupByDepartment() Group by the department column
 * @method     ChildLineofbusinessQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildLineofbusinessQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildLineofbusinessQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLineofbusinessQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLineofbusinessQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLineofbusinessQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLineofbusinessQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLineofbusinessQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLineofbusinessQuery leftJoinDairypandl($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dairypandl relation
 * @method     ChildLineofbusinessQuery rightJoinDairypandl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dairypandl relation
 * @method     ChildLineofbusinessQuery innerJoinDairypandl($relationAlias = null) Adds a INNER JOIN clause to the query using the Dairypandl relation
 *
 * @method     ChildLineofbusinessQuery joinWithDairypandl($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dairypandl relation
 *
 * @method     ChildLineofbusinessQuery leftJoinWithDairypandl() Adds a LEFT JOIN clause and with to the query using the Dairypandl relation
 * @method     ChildLineofbusinessQuery rightJoinWithDairypandl() Adds a RIGHT JOIN clause and with to the query using the Dairypandl relation
 * @method     ChildLineofbusinessQuery innerJoinWithDairypandl() Adds a INNER JOIN clause and with to the query using the Dairypandl relation
 *
 * @method     ChildLineofbusinessQuery leftJoinElectricityallocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Electricityallocation relation
 * @method     ChildLineofbusinessQuery rightJoinElectricityallocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Electricityallocation relation
 * @method     ChildLineofbusinessQuery innerJoinElectricityallocation($relationAlias = null) Adds a INNER JOIN clause to the query using the Electricityallocation relation
 *
 * @method     ChildLineofbusinessQuery joinWithElectricityallocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Electricityallocation relation
 *
 * @method     ChildLineofbusinessQuery leftJoinWithElectricityallocation() Adds a LEFT JOIN clause and with to the query using the Electricityallocation relation
 * @method     ChildLineofbusinessQuery rightJoinWithElectricityallocation() Adds a RIGHT JOIN clause and with to the query using the Electricityallocation relation
 * @method     ChildLineofbusinessQuery innerJoinWithElectricityallocation() Adds a INNER JOIN clause and with to the query using the Electricityallocation relation
 *
 * @method     ChildLineofbusinessQuery leftJoinEmployeepurchases($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeepurchases relation
 * @method     ChildLineofbusinessQuery rightJoinEmployeepurchases($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeepurchases relation
 * @method     ChildLineofbusinessQuery innerJoinEmployeepurchases($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeepurchases relation
 *
 * @method     ChildLineofbusinessQuery joinWithEmployeepurchases($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeepurchases relation
 *
 * @method     ChildLineofbusinessQuery leftJoinWithEmployeepurchases() Adds a LEFT JOIN clause and with to the query using the Employeepurchases relation
 * @method     ChildLineofbusinessQuery rightJoinWithEmployeepurchases() Adds a RIGHT JOIN clause and with to the query using the Employeepurchases relation
 * @method     ChildLineofbusinessQuery innerJoinWithEmployeepurchases() Adds a INNER JOIN clause and with to the query using the Employeepurchases relation
 *
 * @method     ChildLineofbusinessQuery leftJoinEmployeesalaryexpenseallocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeesalaryexpenseallocation relation
 * @method     ChildLineofbusinessQuery rightJoinEmployeesalaryexpenseallocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeesalaryexpenseallocation relation
 * @method     ChildLineofbusinessQuery innerJoinEmployeesalaryexpenseallocation($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeesalaryexpenseallocation relation
 *
 * @method     ChildLineofbusinessQuery joinWithEmployeesalaryexpenseallocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeesalaryexpenseallocation relation
 *
 * @method     ChildLineofbusinessQuery leftJoinWithEmployeesalaryexpenseallocation() Adds a LEFT JOIN clause and with to the query using the Employeesalaryexpenseallocation relation
 * @method     ChildLineofbusinessQuery rightJoinWithEmployeesalaryexpenseallocation() Adds a RIGHT JOIN clause and with to the query using the Employeesalaryexpenseallocation relation
 * @method     ChildLineofbusinessQuery innerJoinWithEmployeesalaryexpenseallocation() Adds a INNER JOIN clause and with to the query using the Employeesalaryexpenseallocation relation
 *
 * @method     ChildLineofbusinessQuery leftJoinExpenses($relationAlias = null) Adds a LEFT JOIN clause to the query using the Expenses relation
 * @method     ChildLineofbusinessQuery rightJoinExpenses($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Expenses relation
 * @method     ChildLineofbusinessQuery innerJoinExpenses($relationAlias = null) Adds a INNER JOIN clause to the query using the Expenses relation
 *
 * @method     ChildLineofbusinessQuery joinWithExpenses($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Expenses relation
 *
 * @method     ChildLineofbusinessQuery leftJoinWithExpenses() Adds a LEFT JOIN clause and with to the query using the Expenses relation
 * @method     ChildLineofbusinessQuery rightJoinWithExpenses() Adds a RIGHT JOIN clause and with to the query using the Expenses relation
 * @method     ChildLineofbusinessQuery innerJoinWithExpenses() Adds a INNER JOIN clause and with to the query using the Expenses relation
 *
 * @method     ChildLineofbusinessQuery leftJoinFishpandl($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fishpandl relation
 * @method     ChildLineofbusinessQuery rightJoinFishpandl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fishpandl relation
 * @method     ChildLineofbusinessQuery innerJoinFishpandl($relationAlias = null) Adds a INNER JOIN clause to the query using the Fishpandl relation
 *
 * @method     ChildLineofbusinessQuery joinWithFishpandl($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fishpandl relation
 *
 * @method     ChildLineofbusinessQuery leftJoinWithFishpandl() Adds a LEFT JOIN clause and with to the query using the Fishpandl relation
 * @method     ChildLineofbusinessQuery rightJoinWithFishpandl() Adds a RIGHT JOIN clause and with to the query using the Fishpandl relation
 * @method     ChildLineofbusinessQuery innerJoinWithFishpandl() Adds a INNER JOIN clause and with to the query using the Fishpandl relation
 *
 * @method     ChildLineofbusinessQuery leftJoinOtherworkassigned($relationAlias = null) Adds a LEFT JOIN clause to the query using the Otherworkassigned relation
 * @method     ChildLineofbusinessQuery rightJoinOtherworkassigned($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Otherworkassigned relation
 * @method     ChildLineofbusinessQuery innerJoinOtherworkassigned($relationAlias = null) Adds a INNER JOIN clause to the query using the Otherworkassigned relation
 *
 * @method     ChildLineofbusinessQuery joinWithOtherworkassigned($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Otherworkassigned relation
 *
 * @method     ChildLineofbusinessQuery leftJoinWithOtherworkassigned() Adds a LEFT JOIN clause and with to the query using the Otherworkassigned relation
 * @method     ChildLineofbusinessQuery rightJoinWithOtherworkassigned() Adds a RIGHT JOIN clause and with to the query using the Otherworkassigned relation
 * @method     ChildLineofbusinessQuery innerJoinWithOtherworkassigned() Adds a INNER JOIN clause and with to the query using the Otherworkassigned relation
 *
 * @method     ChildLineofbusinessQuery leftJoinParttimedetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the Parttimedetail relation
 * @method     ChildLineofbusinessQuery rightJoinParttimedetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Parttimedetail relation
 * @method     ChildLineofbusinessQuery innerJoinParttimedetail($relationAlias = null) Adds a INNER JOIN clause to the query using the Parttimedetail relation
 *
 * @method     ChildLineofbusinessQuery joinWithParttimedetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Parttimedetail relation
 *
 * @method     ChildLineofbusinessQuery leftJoinWithParttimedetail() Adds a LEFT JOIN clause and with to the query using the Parttimedetail relation
 * @method     ChildLineofbusinessQuery rightJoinWithParttimedetail() Adds a RIGHT JOIN clause and with to the query using the Parttimedetail relation
 * @method     ChildLineofbusinessQuery innerJoinWithParttimedetail() Adds a INNER JOIN clause and with to the query using the Parttimedetail relation
 *
 * @method     ChildLineofbusinessQuery leftJoinTeapandl($relationAlias = null) Adds a LEFT JOIN clause to the query using the Teapandl relation
 * @method     ChildLineofbusinessQuery rightJoinTeapandl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Teapandl relation
 * @method     ChildLineofbusinessQuery innerJoinTeapandl($relationAlias = null) Adds a INNER JOIN clause to the query using the Teapandl relation
 *
 * @method     ChildLineofbusinessQuery joinWithTeapandl($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Teapandl relation
 *
 * @method     ChildLineofbusinessQuery leftJoinWithTeapandl() Adds a LEFT JOIN clause and with to the query using the Teapandl relation
 * @method     ChildLineofbusinessQuery rightJoinWithTeapandl() Adds a RIGHT JOIN clause and with to the query using the Teapandl relation
 * @method     ChildLineofbusinessQuery innerJoinWithTeapandl() Adds a INNER JOIN clause and with to the query using the Teapandl relation
 *
 * @method     ChildLineofbusinessQuery leftJoinVehicleexpenseallocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Vehicleexpenseallocation relation
 * @method     ChildLineofbusinessQuery rightJoinVehicleexpenseallocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Vehicleexpenseallocation relation
 * @method     ChildLineofbusinessQuery innerJoinVehicleexpenseallocation($relationAlias = null) Adds a INNER JOIN clause to the query using the Vehicleexpenseallocation relation
 *
 * @method     ChildLineofbusinessQuery joinWithVehicleexpenseallocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Vehicleexpenseallocation relation
 *
 * @method     ChildLineofbusinessQuery leftJoinWithVehicleexpenseallocation() Adds a LEFT JOIN clause and with to the query using the Vehicleexpenseallocation relation
 * @method     ChildLineofbusinessQuery rightJoinWithVehicleexpenseallocation() Adds a RIGHT JOIN clause and with to the query using the Vehicleexpenseallocation relation
 * @method     ChildLineofbusinessQuery innerJoinWithVehicleexpenseallocation() Adds a INNER JOIN clause and with to the query using the Vehicleexpenseallocation relation
 *
 * @method     \lwops\lwops\DairypandlQuery|\lwops\lwops\ElectricityallocationQuery|\lwops\lwops\EmployeepurchasesQuery|\lwops\lwops\EmployeesalaryexpenseallocationQuery|\lwops\lwops\ExpensesQuery|\lwops\lwops\FishpandlQuery|\lwops\lwops\OtherworkassignedQuery|\lwops\lwops\ParttimedetailQuery|\lwops\lwops\TeapandlQuery|\lwops\lwops\VehicleexpenseallocationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLineofbusiness findOne(ConnectionInterface $con = null) Return the first ChildLineofbusiness matching the query
 * @method     ChildLineofbusiness findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLineofbusiness matching the query, or a new ChildLineofbusiness object populated from the query conditions when no match is found
 *
 * @method     ChildLineofbusiness findOneByOid(int $oid) Return the first ChildLineofbusiness filtered by the oid column
 * @method     ChildLineofbusiness findOneByDepartment(string $department) Return the first ChildLineofbusiness filtered by the department column
 * @method     ChildLineofbusiness findOneByCreatetmstp(string $createTmstp) Return the first ChildLineofbusiness filtered by the createTmstp column
 * @method     ChildLineofbusiness findOneByUpdttmstp(string $updtTmstp) Return the first ChildLineofbusiness filtered by the updtTmstp column *

 * @method     ChildLineofbusiness requirePk($key, ConnectionInterface $con = null) Return the ChildLineofbusiness by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLineofbusiness requireOne(ConnectionInterface $con = null) Return the first ChildLineofbusiness matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLineofbusiness requireOneByOid(int $oid) Return the first ChildLineofbusiness filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLineofbusiness requireOneByDepartment(string $department) Return the first ChildLineofbusiness filtered by the department column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLineofbusiness requireOneByCreatetmstp(string $createTmstp) Return the first ChildLineofbusiness filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLineofbusiness requireOneByUpdttmstp(string $updtTmstp) Return the first ChildLineofbusiness filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLineofbusiness[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLineofbusiness objects based on current ModelCriteria
 * @method     ChildLineofbusiness[]|ObjectCollection findByOid(int $oid) Return ChildLineofbusiness objects filtered by the oid column
 * @method     ChildLineofbusiness[]|ObjectCollection findByDepartment(string $department) Return ChildLineofbusiness objects filtered by the department column
 * @method     ChildLineofbusiness[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildLineofbusiness objects filtered by the createTmstp column
 * @method     ChildLineofbusiness[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildLineofbusiness objects filtered by the updtTmstp column
 * @method     ChildLineofbusiness[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LineofbusinessQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\LineofbusinessQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Lineofbusiness', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLineofbusinessQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLineofbusinessQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLineofbusinessQuery) {
            return $criteria;
        }
        $query = new ChildLineofbusinessQuery();
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
     * @return ChildLineofbusiness|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LineofbusinessTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LineofbusinessTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLineofbusiness A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, department, createTmstp, updtTmstp FROM lineofbusiness WHERE oid = :p0';
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
            /** @var ChildLineofbusiness $obj */
            $obj = new ChildLineofbusiness();
            $obj->hydrate($row);
            LineofbusinessTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLineofbusiness|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LineofbusinessTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LineofbusinessTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(LineofbusinessTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(LineofbusinessTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LineofbusinessTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the department column
     *
     * Example usage:
     * <code>
     * $query->filterByDepartment('fooValue');   // WHERE department = 'fooValue'
     * $query->filterByDepartment('%fooValue%', Criteria::LIKE); // WHERE department LIKE '%fooValue%'
     * </code>
     *
     * @param     string $department The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByDepartment($department = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($department)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LineofbusinessTableMap::COL_DEPARTMENT, $department, $comparison);
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
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(LineofbusinessTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(LineofbusinessTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LineofbusinessTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(LineofbusinessTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(LineofbusinessTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LineofbusinessTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Dairypandl object
     *
     * @param \lwops\lwops\Dairypandl|ObjectCollection $dairypandl the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByDairypandl($dairypandl, $comparison = null)
    {
        if ($dairypandl instanceof \lwops\lwops\Dairypandl) {
            return $this
                ->addUsingAlias(LineofbusinessTableMap::COL_OID, $dairypandl->getLineofbusinessoid(), $comparison);
        } elseif ($dairypandl instanceof ObjectCollection) {
            return $this
                ->useDairypandlQuery()
                ->filterByPrimaryKeys($dairypandl->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Electricityallocation object
     *
     * @param \lwops\lwops\Electricityallocation|ObjectCollection $electricityallocation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByElectricityallocation($electricityallocation, $comparison = null)
    {
        if ($electricityallocation instanceof \lwops\lwops\Electricityallocation) {
            return $this
                ->addUsingAlias(LineofbusinessTableMap::COL_OID, $electricityallocation->getLineofbusinessoid(), $comparison);
        } elseif ($electricityallocation instanceof ObjectCollection) {
            return $this
                ->useElectricityallocationQuery()
                ->filterByPrimaryKeys($electricityallocation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByElectricityallocation() only accepts arguments of type \lwops\lwops\Electricityallocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Electricityallocation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function joinElectricityallocation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Electricityallocation');

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
            $this->addJoinObject($join, 'Electricityallocation');
        }

        return $this;
    }

    /**
     * Use the Electricityallocation relation Electricityallocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\ElectricityallocationQuery A secondary query class using the current class as primary query
     */
    public function useElectricityallocationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinElectricityallocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Electricityallocation', '\lwops\lwops\ElectricityallocationQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeepurchases object
     *
     * @param \lwops\lwops\Employeepurchases|ObjectCollection $employeepurchases the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByEmployeepurchases($employeepurchases, $comparison = null)
    {
        if ($employeepurchases instanceof \lwops\lwops\Employeepurchases) {
            return $this
                ->addUsingAlias(LineofbusinessTableMap::COL_OID, $employeepurchases->getLineofbusinessoid(), $comparison);
        } elseif ($employeepurchases instanceof ObjectCollection) {
            return $this
                ->useEmployeepurchasesQuery()
                ->filterByPrimaryKeys($employeepurchases->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEmployeepurchases() only accepts arguments of type \lwops\lwops\Employeepurchases or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employeepurchases relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function joinEmployeepurchases($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employeepurchases');

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
            $this->addJoinObject($join, 'Employeepurchases');
        }

        return $this;
    }

    /**
     * Use the Employeepurchases relation Employeepurchases object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeepurchasesQuery A secondary query class using the current class as primary query
     */
    public function useEmployeepurchasesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeepurchases($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employeepurchases', '\lwops\lwops\EmployeepurchasesQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeesalaryexpenseallocation object
     *
     * @param \lwops\lwops\Employeesalaryexpenseallocation|ObjectCollection $employeesalaryexpenseallocation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByEmployeesalaryexpenseallocation($employeesalaryexpenseallocation, $comparison = null)
    {
        if ($employeesalaryexpenseallocation instanceof \lwops\lwops\Employeesalaryexpenseallocation) {
            return $this
                ->addUsingAlias(LineofbusinessTableMap::COL_OID, $employeesalaryexpenseallocation->getLineofbusinessoid(), $comparison);
        } elseif ($employeesalaryexpenseallocation instanceof ObjectCollection) {
            return $this
                ->useEmployeesalaryexpenseallocationQuery()
                ->filterByPrimaryKeys($employeesalaryexpenseallocation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEmployeesalaryexpenseallocation() only accepts arguments of type \lwops\lwops\Employeesalaryexpenseallocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employeesalaryexpenseallocation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function joinEmployeesalaryexpenseallocation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employeesalaryexpenseallocation');

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
            $this->addJoinObject($join, 'Employeesalaryexpenseallocation');
        }

        return $this;
    }

    /**
     * Use the Employeesalaryexpenseallocation relation Employeesalaryexpenseallocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeesalaryexpenseallocationQuery A secondary query class using the current class as primary query
     */
    public function useEmployeesalaryexpenseallocationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeesalaryexpenseallocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employeesalaryexpenseallocation', '\lwops\lwops\EmployeesalaryexpenseallocationQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Expenses object
     *
     * @param \lwops\lwops\Expenses|ObjectCollection $expenses the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByExpenses($expenses, $comparison = null)
    {
        if ($expenses instanceof \lwops\lwops\Expenses) {
            return $this
                ->addUsingAlias(LineofbusinessTableMap::COL_OID, $expenses->getLineofbusinessoid(), $comparison);
        } elseif ($expenses instanceof ObjectCollection) {
            return $this
                ->useExpensesQuery()
                ->filterByPrimaryKeys($expenses->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByExpenses() only accepts arguments of type \lwops\lwops\Expenses or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Expenses relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function joinExpenses($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Expenses');

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
            $this->addJoinObject($join, 'Expenses');
        }

        return $this;
    }

    /**
     * Use the Expenses relation Expenses object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\ExpensesQuery A secondary query class using the current class as primary query
     */
    public function useExpensesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenses($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Expenses', '\lwops\lwops\ExpensesQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Fishpandl object
     *
     * @param \lwops\lwops\Fishpandl|ObjectCollection $fishpandl the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByFishpandl($fishpandl, $comparison = null)
    {
        if ($fishpandl instanceof \lwops\lwops\Fishpandl) {
            return $this
                ->addUsingAlias(LineofbusinessTableMap::COL_OID, $fishpandl->getLineofbusinessoid(), $comparison);
        } elseif ($fishpandl instanceof ObjectCollection) {
            return $this
                ->useFishpandlQuery()
                ->filterByPrimaryKeys($fishpandl->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Otherworkassigned object
     *
     * @param \lwops\lwops\Otherworkassigned|ObjectCollection $otherworkassigned the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByOtherworkassigned($otherworkassigned, $comparison = null)
    {
        if ($otherworkassigned instanceof \lwops\lwops\Otherworkassigned) {
            return $this
                ->addUsingAlias(LineofbusinessTableMap::COL_OID, $otherworkassigned->getLineofbusinessoid(), $comparison);
        } elseif ($otherworkassigned instanceof ObjectCollection) {
            return $this
                ->useOtherworkassignedQuery()
                ->filterByPrimaryKeys($otherworkassigned->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOtherworkassigned() only accepts arguments of type \lwops\lwops\Otherworkassigned or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Otherworkassigned relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function joinOtherworkassigned($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Otherworkassigned');

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
            $this->addJoinObject($join, 'Otherworkassigned');
        }

        return $this;
    }

    /**
     * Use the Otherworkassigned relation Otherworkassigned object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\OtherworkassignedQuery A secondary query class using the current class as primary query
     */
    public function useOtherworkassignedQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOtherworkassigned($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Otherworkassigned', '\lwops\lwops\OtherworkassignedQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Parttimedetail object
     *
     * @param \lwops\lwops\Parttimedetail|ObjectCollection $parttimedetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByParttimedetail($parttimedetail, $comparison = null)
    {
        if ($parttimedetail instanceof \lwops\lwops\Parttimedetail) {
            return $this
                ->addUsingAlias(LineofbusinessTableMap::COL_OID, $parttimedetail->getLineofbussinessoid(), $comparison);
        } elseif ($parttimedetail instanceof ObjectCollection) {
            return $this
                ->useParttimedetailQuery()
                ->filterByPrimaryKeys($parttimedetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByParttimedetail() only accepts arguments of type \lwops\lwops\Parttimedetail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Parttimedetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function joinParttimedetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Parttimedetail');

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
            $this->addJoinObject($join, 'Parttimedetail');
        }

        return $this;
    }

    /**
     * Use the Parttimedetail relation Parttimedetail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\ParttimedetailQuery A secondary query class using the current class as primary query
     */
    public function useParttimedetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinParttimedetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Parttimedetail', '\lwops\lwops\ParttimedetailQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Teapandl object
     *
     * @param \lwops\lwops\Teapandl|ObjectCollection $teapandl the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByTeapandl($teapandl, $comparison = null)
    {
        if ($teapandl instanceof \lwops\lwops\Teapandl) {
            return $this
                ->addUsingAlias(LineofbusinessTableMap::COL_OID, $teapandl->getLineofbusinessoid(), $comparison);
        } elseif ($teapandl instanceof ObjectCollection) {
            return $this
                ->useTeapandlQuery()
                ->filterByPrimaryKeys($teapandl->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTeapandl() only accepts arguments of type \lwops\lwops\Teapandl or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Teapandl relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function joinTeapandl($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Teapandl');

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
            $this->addJoinObject($join, 'Teapandl');
        }

        return $this;
    }

    /**
     * Use the Teapandl relation Teapandl object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\TeapandlQuery A secondary query class using the current class as primary query
     */
    public function useTeapandlQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTeapandl($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Teapandl', '\lwops\lwops\TeapandlQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Vehicleexpenseallocation object
     *
     * @param \lwops\lwops\Vehicleexpenseallocation|ObjectCollection $vehicleexpenseallocation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function filterByVehicleexpenseallocation($vehicleexpenseallocation, $comparison = null)
    {
        if ($vehicleexpenseallocation instanceof \lwops\lwops\Vehicleexpenseallocation) {
            return $this
                ->addUsingAlias(LineofbusinessTableMap::COL_OID, $vehicleexpenseallocation->getLineofbusinessoid(), $comparison);
        } elseif ($vehicleexpenseallocation instanceof ObjectCollection) {
            return $this
                ->useVehicleexpenseallocationQuery()
                ->filterByPrimaryKeys($vehicleexpenseallocation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVehicleexpenseallocation() only accepts arguments of type \lwops\lwops\Vehicleexpenseallocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Vehicleexpenseallocation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function joinVehicleexpenseallocation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Vehicleexpenseallocation');

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
            $this->addJoinObject($join, 'Vehicleexpenseallocation');
        }

        return $this;
    }

    /**
     * Use the Vehicleexpenseallocation relation Vehicleexpenseallocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\VehicleexpenseallocationQuery A secondary query class using the current class as primary query
     */
    public function useVehicleexpenseallocationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVehicleexpenseallocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Vehicleexpenseallocation', '\lwops\lwops\VehicleexpenseallocationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLineofbusiness $lineofbusiness Object to remove from the list of results
     *
     * @return $this|ChildLineofbusinessQuery The current query, for fluid interface
     */
    public function prune($lineofbusiness = null)
    {
        if ($lineofbusiness) {
            $this->addUsingAlias(LineofbusinessTableMap::COL_OID, $lineofbusiness->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the lineofbusiness table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LineofbusinessTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LineofbusinessTableMap::clearInstancePool();
            LineofbusinessTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LineofbusinessTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LineofbusinessTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LineofbusinessTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LineofbusinessTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LineofbusinessQuery
