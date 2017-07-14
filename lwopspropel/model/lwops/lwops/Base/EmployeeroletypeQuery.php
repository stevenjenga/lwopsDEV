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
use lwops\lwops\Employeeroletype as ChildEmployeeroletype;
use lwops\lwops\EmployeeroletypeQuery as ChildEmployeeroletypeQuery;
use lwops\lwops\Map\EmployeeroletypeTableMap;

/**
 * Base class that represents a query for the 'employeeroletype' table.
 *
 *
 *
 * @method     ChildEmployeeroletypeQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildEmployeeroletypeQuery orderByRole($order = Criteria::ASC) Order by the role column
 * @method     ChildEmployeeroletypeQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildEmployeeroletypeQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildEmployeeroletypeQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildEmployeeroletypeQuery groupByOid() Group by the oid column
 * @method     ChildEmployeeroletypeQuery groupByRole() Group by the role column
 * @method     ChildEmployeeroletypeQuery groupByDescription() Group by the description column
 * @method     ChildEmployeeroletypeQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildEmployeeroletypeQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildEmployeeroletypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeeroletypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeeroletypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeeroletypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeeroletypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeeroletypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeeroletypeQuery leftJoinDairypandllabourexpensedetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dairypandllabourexpensedetail relation
 * @method     ChildEmployeeroletypeQuery rightJoinDairypandllabourexpensedetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dairypandllabourexpensedetail relation
 * @method     ChildEmployeeroletypeQuery innerJoinDairypandllabourexpensedetail($relationAlias = null) Adds a INNER JOIN clause to the query using the Dairypandllabourexpensedetail relation
 *
 * @method     ChildEmployeeroletypeQuery joinWithDairypandllabourexpensedetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dairypandllabourexpensedetail relation
 *
 * @method     ChildEmployeeroletypeQuery leftJoinWithDairypandllabourexpensedetail() Adds a LEFT JOIN clause and with to the query using the Dairypandllabourexpensedetail relation
 * @method     ChildEmployeeroletypeQuery rightJoinWithDairypandllabourexpensedetail() Adds a RIGHT JOIN clause and with to the query using the Dairypandllabourexpensedetail relation
 * @method     ChildEmployeeroletypeQuery innerJoinWithDairypandllabourexpensedetail() Adds a INNER JOIN clause and with to the query using the Dairypandllabourexpensedetail relation
 *
 * @method     ChildEmployeeroletypeQuery leftJoinEmployeerole($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeerole relation
 * @method     ChildEmployeeroletypeQuery rightJoinEmployeerole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeerole relation
 * @method     ChildEmployeeroletypeQuery innerJoinEmployeerole($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeerole relation
 *
 * @method     ChildEmployeeroletypeQuery joinWithEmployeerole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeerole relation
 *
 * @method     ChildEmployeeroletypeQuery leftJoinWithEmployeerole() Adds a LEFT JOIN clause and with to the query using the Employeerole relation
 * @method     ChildEmployeeroletypeQuery rightJoinWithEmployeerole() Adds a RIGHT JOIN clause and with to the query using the Employeerole relation
 * @method     ChildEmployeeroletypeQuery innerJoinWithEmployeerole() Adds a INNER JOIN clause and with to the query using the Employeerole relation
 *
 * @method     ChildEmployeeroletypeQuery leftJoinFishpandllabourexpensedetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fishpandllabourexpensedetail relation
 * @method     ChildEmployeeroletypeQuery rightJoinFishpandllabourexpensedetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fishpandllabourexpensedetail relation
 * @method     ChildEmployeeroletypeQuery innerJoinFishpandllabourexpensedetail($relationAlias = null) Adds a INNER JOIN clause to the query using the Fishpandllabourexpensedetail relation
 *
 * @method     ChildEmployeeroletypeQuery joinWithFishpandllabourexpensedetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fishpandllabourexpensedetail relation
 *
 * @method     ChildEmployeeroletypeQuery leftJoinWithFishpandllabourexpensedetail() Adds a LEFT JOIN clause and with to the query using the Fishpandllabourexpensedetail relation
 * @method     ChildEmployeeroletypeQuery rightJoinWithFishpandllabourexpensedetail() Adds a RIGHT JOIN clause and with to the query using the Fishpandllabourexpensedetail relation
 * @method     ChildEmployeeroletypeQuery innerJoinWithFishpandllabourexpensedetail() Adds a INNER JOIN clause and with to the query using the Fishpandllabourexpensedetail relation
 *
 * @method     ChildEmployeeroletypeQuery leftJoinTeapandllabourexpensedetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the Teapandllabourexpensedetail relation
 * @method     ChildEmployeeroletypeQuery rightJoinTeapandllabourexpensedetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Teapandllabourexpensedetail relation
 * @method     ChildEmployeeroletypeQuery innerJoinTeapandllabourexpensedetail($relationAlias = null) Adds a INNER JOIN clause to the query using the Teapandllabourexpensedetail relation
 *
 * @method     ChildEmployeeroletypeQuery joinWithTeapandllabourexpensedetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Teapandllabourexpensedetail relation
 *
 * @method     ChildEmployeeroletypeQuery leftJoinWithTeapandllabourexpensedetail() Adds a LEFT JOIN clause and with to the query using the Teapandllabourexpensedetail relation
 * @method     ChildEmployeeroletypeQuery rightJoinWithTeapandllabourexpensedetail() Adds a RIGHT JOIN clause and with to the query using the Teapandllabourexpensedetail relation
 * @method     ChildEmployeeroletypeQuery innerJoinWithTeapandllabourexpensedetail() Adds a INNER JOIN clause and with to the query using the Teapandllabourexpensedetail relation
 *
 * @method     \lwops\lwops\DairypandllabourexpensedetailQuery|\lwops\lwops\EmployeeroleQuery|\lwops\lwops\FishpandllabourexpensedetailQuery|\lwops\lwops\TeapandllabourexpensedetailQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployeeroletype findOne(ConnectionInterface $con = null) Return the first ChildEmployeeroletype matching the query
 * @method     ChildEmployeeroletype findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmployeeroletype matching the query, or a new ChildEmployeeroletype object populated from the query conditions when no match is found
 *
 * @method     ChildEmployeeroletype findOneByOid(int $oid) Return the first ChildEmployeeroletype filtered by the oid column
 * @method     ChildEmployeeroletype findOneByRole(string $role) Return the first ChildEmployeeroletype filtered by the role column
 * @method     ChildEmployeeroletype findOneByDescription(string $description) Return the first ChildEmployeeroletype filtered by the description column
 * @method     ChildEmployeeroletype findOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeeroletype filtered by the createTmstp column
 * @method     ChildEmployeeroletype findOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeeroletype filtered by the updtTmstp column *

 * @method     ChildEmployeeroletype requirePk($key, ConnectionInterface $con = null) Return the ChildEmployeeroletype by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeroletype requireOne(ConnectionInterface $con = null) Return the first ChildEmployeeroletype matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeroletype requireOneByOid(int $oid) Return the first ChildEmployeeroletype filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeroletype requireOneByRole(string $role) Return the first ChildEmployeeroletype filtered by the role column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeroletype requireOneByDescription(string $description) Return the first ChildEmployeeroletype filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeroletype requireOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeeroletype filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeroletype requireOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeeroletype filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeroletype[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmployeeroletype objects based on current ModelCriteria
 * @method     ChildEmployeeroletype[]|ObjectCollection findByOid(int $oid) Return ChildEmployeeroletype objects filtered by the oid column
 * @method     ChildEmployeeroletype[]|ObjectCollection findByRole(string $role) Return ChildEmployeeroletype objects filtered by the role column
 * @method     ChildEmployeeroletype[]|ObjectCollection findByDescription(string $description) Return ChildEmployeeroletype objects filtered by the description column
 * @method     ChildEmployeeroletype[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildEmployeeroletype objects filtered by the createTmstp column
 * @method     ChildEmployeeroletype[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildEmployeeroletype objects filtered by the updtTmstp column
 * @method     ChildEmployeeroletype[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmployeeroletypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\EmployeeroletypeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Employeeroletype', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeeroletypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeeroletypeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmployeeroletypeQuery) {
            return $criteria;
        }
        $query = new ChildEmployeeroletypeQuery();
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
     * @return ChildEmployeeroletype|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeroletypeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeeroletypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployeeroletype A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, role, description, createTmstp, updtTmstp FROM employeeroletype WHERE oid = :p0';
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
            /** @var ChildEmployeeroletype $obj */
            $obj = new ChildEmployeeroletype();
            $obj->hydrate($row);
            EmployeeroletypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployeeroletype|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmployeeroletypeTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmployeeroletypeTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(EmployeeroletypeTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(EmployeeroletypeTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeroletypeTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the role column
     *
     * Example usage:
     * <code>
     * $query->filterByRole('fooValue');   // WHERE role = 'fooValue'
     * $query->filterByRole('%fooValue%', Criteria::LIKE); // WHERE role LIKE '%fooValue%'
     * </code>
     *
     * @param     string $role The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function filterByRole($role = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($role)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeroletypeTableMap::COL_ROLE, $role, $comparison);
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
     * @return $this|ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeroletypeTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(EmployeeroletypeTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(EmployeeroletypeTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeroletypeTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(EmployeeroletypeTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(EmployeeroletypeTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeroletypeTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Dairypandllabourexpensedetail object
     *
     * @param \lwops\lwops\Dairypandllabourexpensedetail|ObjectCollection $dairypandllabourexpensedetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function filterByDairypandllabourexpensedetail($dairypandllabourexpensedetail, $comparison = null)
    {
        if ($dairypandllabourexpensedetail instanceof \lwops\lwops\Dairypandllabourexpensedetail) {
            return $this
                ->addUsingAlias(EmployeeroletypeTableMap::COL_OID, $dairypandllabourexpensedetail->getEmployeeroleoid(), $comparison);
        } elseif ($dairypandllabourexpensedetail instanceof ObjectCollection) {
            return $this
                ->useDairypandllabourexpensedetailQuery()
                ->filterByPrimaryKeys($dairypandllabourexpensedetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDairypandllabourexpensedetail() only accepts arguments of type \lwops\lwops\Dairypandllabourexpensedetail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dairypandllabourexpensedetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function joinDairypandllabourexpensedetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dairypandllabourexpensedetail');

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
            $this->addJoinObject($join, 'Dairypandllabourexpensedetail');
        }

        return $this;
    }

    /**
     * Use the Dairypandllabourexpensedetail relation Dairypandllabourexpensedetail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\DairypandllabourexpensedetailQuery A secondary query class using the current class as primary query
     */
    public function useDairypandllabourexpensedetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDairypandllabourexpensedetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dairypandllabourexpensedetail', '\lwops\lwops\DairypandllabourexpensedetailQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeerole object
     *
     * @param \lwops\lwops\Employeerole|ObjectCollection $employeerole the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function filterByEmployeerole($employeerole, $comparison = null)
    {
        if ($employeerole instanceof \lwops\lwops\Employeerole) {
            return $this
                ->addUsingAlias(EmployeeroletypeTableMap::COL_OID, $employeerole->getEmployeeroletypeoid(), $comparison);
        } elseif ($employeerole instanceof ObjectCollection) {
            return $this
                ->useEmployeeroleQuery()
                ->filterByPrimaryKeys($employeerole->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEmployeerole() only accepts arguments of type \lwops\lwops\Employeerole or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employeerole relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function joinEmployeerole($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employeerole');

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
            $this->addJoinObject($join, 'Employeerole');
        }

        return $this;
    }

    /**
     * Use the Employeerole relation Employeerole object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeeroleQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeroleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeerole($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employeerole', '\lwops\lwops\EmployeeroleQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Fishpandllabourexpensedetail object
     *
     * @param \lwops\lwops\Fishpandllabourexpensedetail|ObjectCollection $fishpandllabourexpensedetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function filterByFishpandllabourexpensedetail($fishpandllabourexpensedetail, $comparison = null)
    {
        if ($fishpandllabourexpensedetail instanceof \lwops\lwops\Fishpandllabourexpensedetail) {
            return $this
                ->addUsingAlias(EmployeeroletypeTableMap::COL_OID, $fishpandllabourexpensedetail->getEmployeeroleoid(), $comparison);
        } elseif ($fishpandllabourexpensedetail instanceof ObjectCollection) {
            return $this
                ->useFishpandllabourexpensedetailQuery()
                ->filterByPrimaryKeys($fishpandllabourexpensedetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFishpandllabourexpensedetail() only accepts arguments of type \lwops\lwops\Fishpandllabourexpensedetail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fishpandllabourexpensedetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function joinFishpandllabourexpensedetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fishpandllabourexpensedetail');

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
            $this->addJoinObject($join, 'Fishpandllabourexpensedetail');
        }

        return $this;
    }

    /**
     * Use the Fishpandllabourexpensedetail relation Fishpandllabourexpensedetail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\FishpandllabourexpensedetailQuery A secondary query class using the current class as primary query
     */
    public function useFishpandllabourexpensedetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFishpandllabourexpensedetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fishpandllabourexpensedetail', '\lwops\lwops\FishpandllabourexpensedetailQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Teapandllabourexpensedetail object
     *
     * @param \lwops\lwops\Teapandllabourexpensedetail|ObjectCollection $teapandllabourexpensedetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function filterByTeapandllabourexpensedetail($teapandllabourexpensedetail, $comparison = null)
    {
        if ($teapandllabourexpensedetail instanceof \lwops\lwops\Teapandllabourexpensedetail) {
            return $this
                ->addUsingAlias(EmployeeroletypeTableMap::COL_OID, $teapandllabourexpensedetail->getEmployeeroleoid(), $comparison);
        } elseif ($teapandllabourexpensedetail instanceof ObjectCollection) {
            return $this
                ->useTeapandllabourexpensedetailQuery()
                ->filterByPrimaryKeys($teapandllabourexpensedetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTeapandllabourexpensedetail() only accepts arguments of type \lwops\lwops\Teapandllabourexpensedetail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Teapandllabourexpensedetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function joinTeapandllabourexpensedetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Teapandllabourexpensedetail');

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
            $this->addJoinObject($join, 'Teapandllabourexpensedetail');
        }

        return $this;
    }

    /**
     * Use the Teapandllabourexpensedetail relation Teapandllabourexpensedetail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\TeapandllabourexpensedetailQuery A secondary query class using the current class as primary query
     */
    public function useTeapandllabourexpensedetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTeapandllabourexpensedetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Teapandllabourexpensedetail', '\lwops\lwops\TeapandllabourexpensedetailQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEmployeeroletype $employeeroletype Object to remove from the list of results
     *
     * @return $this|ChildEmployeeroletypeQuery The current query, for fluid interface
     */
    public function prune($employeeroletype = null)
    {
        if ($employeeroletype) {
            $this->addUsingAlias(EmployeeroletypeTableMap::COL_OID, $employeeroletype->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employeeroletype table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeroletypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeeroletypeTableMap::clearInstancePool();
            EmployeeroletypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeroletypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeeroletypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeeroletypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeeroletypeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmployeeroletypeQuery
