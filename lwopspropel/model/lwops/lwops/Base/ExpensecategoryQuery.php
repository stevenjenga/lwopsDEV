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
use lwops\lwops\Expensecategory as ChildExpensecategory;
use lwops\lwops\ExpensecategoryQuery as ChildExpensecategoryQuery;
use lwops\lwops\Map\ExpensecategoryTableMap;

/**
 * Base class that represents a query for the 'expensecategory' table.
 *
 *
 *
 * @method     ChildExpensecategoryQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildExpensecategoryQuery orderByCogs($order = Criteria::ASC) Order by the COGS column
 * @method     ChildExpensecategoryQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildExpensecategoryQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildExpensecategoryQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildExpensecategoryQuery groupByOid() Group by the oid column
 * @method     ChildExpensecategoryQuery groupByCogs() Group by the COGS column
 * @method     ChildExpensecategoryQuery groupByDescription() Group by the description column
 * @method     ChildExpensecategoryQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildExpensecategoryQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildExpensecategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExpensecategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExpensecategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExpensecategoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExpensecategoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExpensecategoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExpensecategoryQuery leftJoinExpenses($relationAlias = null) Adds a LEFT JOIN clause to the query using the Expenses relation
 * @method     ChildExpensecategoryQuery rightJoinExpenses($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Expenses relation
 * @method     ChildExpensecategoryQuery innerJoinExpenses($relationAlias = null) Adds a INNER JOIN clause to the query using the Expenses relation
 *
 * @method     ChildExpensecategoryQuery joinWithExpenses($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Expenses relation
 *
 * @method     ChildExpensecategoryQuery leftJoinWithExpenses() Adds a LEFT JOIN clause and with to the query using the Expenses relation
 * @method     ChildExpensecategoryQuery rightJoinWithExpenses() Adds a RIGHT JOIN clause and with to the query using the Expenses relation
 * @method     ChildExpensecategoryQuery innerJoinWithExpenses() Adds a INNER JOIN clause and with to the query using the Expenses relation
 *
 * @method     ChildExpensecategoryQuery leftJoinVehicleexpense($relationAlias = null) Adds a LEFT JOIN clause to the query using the Vehicleexpense relation
 * @method     ChildExpensecategoryQuery rightJoinVehicleexpense($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Vehicleexpense relation
 * @method     ChildExpensecategoryQuery innerJoinVehicleexpense($relationAlias = null) Adds a INNER JOIN clause to the query using the Vehicleexpense relation
 *
 * @method     ChildExpensecategoryQuery joinWithVehicleexpense($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Vehicleexpense relation
 *
 * @method     ChildExpensecategoryQuery leftJoinWithVehicleexpense() Adds a LEFT JOIN clause and with to the query using the Vehicleexpense relation
 * @method     ChildExpensecategoryQuery rightJoinWithVehicleexpense() Adds a RIGHT JOIN clause and with to the query using the Vehicleexpense relation
 * @method     ChildExpensecategoryQuery innerJoinWithVehicleexpense() Adds a INNER JOIN clause and with to the query using the Vehicleexpense relation
 *
 * @method     \lwops\lwops\ExpensesQuery|\lwops\lwops\VehicleexpenseQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildExpensecategory findOne(ConnectionInterface $con = null) Return the first ChildExpensecategory matching the query
 * @method     ChildExpensecategory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildExpensecategory matching the query, or a new ChildExpensecategory object populated from the query conditions when no match is found
 *
 * @method     ChildExpensecategory findOneByOid(int $oid) Return the first ChildExpensecategory filtered by the oid column
 * @method     ChildExpensecategory findOneByCogs(int $COGS) Return the first ChildExpensecategory filtered by the COGS column
 * @method     ChildExpensecategory findOneByDescription(string $description) Return the first ChildExpensecategory filtered by the description column
 * @method     ChildExpensecategory findOneByCreatetmstp(string $createTmstp) Return the first ChildExpensecategory filtered by the createTmstp column
 * @method     ChildExpensecategory findOneByUpdttmstp(string $updtTmstp) Return the first ChildExpensecategory filtered by the updtTmstp column *

 * @method     ChildExpensecategory requirePk($key, ConnectionInterface $con = null) Return the ChildExpensecategory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpensecategory requireOne(ConnectionInterface $con = null) Return the first ChildExpensecategory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpensecategory requireOneByOid(int $oid) Return the first ChildExpensecategory filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpensecategory requireOneByCogs(int $COGS) Return the first ChildExpensecategory filtered by the COGS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpensecategory requireOneByDescription(string $description) Return the first ChildExpensecategory filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpensecategory requireOneByCreatetmstp(string $createTmstp) Return the first ChildExpensecategory filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpensecategory requireOneByUpdttmstp(string $updtTmstp) Return the first ChildExpensecategory filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpensecategory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildExpensecategory objects based on current ModelCriteria
 * @method     ChildExpensecategory[]|ObjectCollection findByOid(int $oid) Return ChildExpensecategory objects filtered by the oid column
 * @method     ChildExpensecategory[]|ObjectCollection findByCogs(int $COGS) Return ChildExpensecategory objects filtered by the COGS column
 * @method     ChildExpensecategory[]|ObjectCollection findByDescription(string $description) Return ChildExpensecategory objects filtered by the description column
 * @method     ChildExpensecategory[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildExpensecategory objects filtered by the createTmstp column
 * @method     ChildExpensecategory[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildExpensecategory objects filtered by the updtTmstp column
 * @method     ChildExpensecategory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ExpensecategoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\ExpensecategoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Expensecategory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExpensecategoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExpensecategoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildExpensecategoryQuery) {
            return $criteria;
        }
        $query = new ChildExpensecategoryQuery();
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
     * @return ChildExpensecategory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExpensecategoryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExpensecategoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildExpensecategory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, COGS, description, createTmstp, updtTmstp FROM expensecategory WHERE oid = :p0';
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
            /** @var ChildExpensecategory $obj */
            $obj = new ChildExpensecategory();
            $obj->hydrate($row);
            ExpensecategoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildExpensecategory|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildExpensecategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ExpensecategoryTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildExpensecategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ExpensecategoryTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildExpensecategoryQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(ExpensecategoryTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(ExpensecategoryTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensecategoryTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the COGS column
     *
     * Example usage:
     * <code>
     * $query->filterByCogs(1234); // WHERE COGS = 1234
     * $query->filterByCogs(array(12, 34)); // WHERE COGS IN (12, 34)
     * $query->filterByCogs(array('min' => 12)); // WHERE COGS > 12
     * </code>
     *
     * @param     mixed $cogs The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExpensecategoryQuery The current query, for fluid interface
     */
    public function filterByCogs($cogs = null, $comparison = null)
    {
        if (is_array($cogs)) {
            $useMinMax = false;
            if (isset($cogs['min'])) {
                $this->addUsingAlias(ExpensecategoryTableMap::COL_COGS, $cogs['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cogs['max'])) {
                $this->addUsingAlias(ExpensecategoryTableMap::COL_COGS, $cogs['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensecategoryTableMap::COL_COGS, $cogs, $comparison);
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
     * @return $this|ChildExpensecategoryQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensecategoryTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildExpensecategoryQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(ExpensecategoryTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(ExpensecategoryTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensecategoryTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildExpensecategoryQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(ExpensecategoryTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(ExpensecategoryTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensecategoryTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Expenses object
     *
     * @param \lwops\lwops\Expenses|ObjectCollection $expenses the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildExpensecategoryQuery The current query, for fluid interface
     */
    public function filterByExpenses($expenses, $comparison = null)
    {
        if ($expenses instanceof \lwops\lwops\Expenses) {
            return $this
                ->addUsingAlias(ExpensecategoryTableMap::COL_OID, $expenses->getCategoryoid(), $comparison);
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
     * @return $this|ChildExpensecategoryQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Vehicleexpense object
     *
     * @param \lwops\lwops\Vehicleexpense|ObjectCollection $vehicleexpense the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildExpensecategoryQuery The current query, for fluid interface
     */
    public function filterByVehicleexpense($vehicleexpense, $comparison = null)
    {
        if ($vehicleexpense instanceof \lwops\lwops\Vehicleexpense) {
            return $this
                ->addUsingAlias(ExpensecategoryTableMap::COL_OID, $vehicleexpense->getExpensecategoryoid(), $comparison);
        } elseif ($vehicleexpense instanceof ObjectCollection) {
            return $this
                ->useVehicleexpenseQuery()
                ->filterByPrimaryKeys($vehicleexpense->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVehicleexpense() only accepts arguments of type \lwops\lwops\Vehicleexpense or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Vehicleexpense relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildExpensecategoryQuery The current query, for fluid interface
     */
    public function joinVehicleexpense($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Vehicleexpense');

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
            $this->addJoinObject($join, 'Vehicleexpense');
        }

        return $this;
    }

    /**
     * Use the Vehicleexpense relation Vehicleexpense object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\VehicleexpenseQuery A secondary query class using the current class as primary query
     */
    public function useVehicleexpenseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVehicleexpense($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Vehicleexpense', '\lwops\lwops\VehicleexpenseQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildExpensecategory $expensecategory Object to remove from the list of results
     *
     * @return $this|ChildExpensecategoryQuery The current query, for fluid interface
     */
    public function prune($expensecategory = null)
    {
        if ($expensecategory) {
            $this->addUsingAlias(ExpensecategoryTableMap::COL_OID, $expensecategory->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the expensecategory table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpensecategoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ExpensecategoryTableMap::clearInstancePool();
            ExpensecategoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpensecategoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ExpensecategoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ExpensecategoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ExpensecategoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ExpensecategoryQuery
