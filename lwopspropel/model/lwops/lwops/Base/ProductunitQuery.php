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
use lwops\lwops\Productunit as ChildProductunit;
use lwops\lwops\ProductunitQuery as ChildProductunitQuery;
use lwops\lwops\Map\ProductunitTableMap;

/**
 * Base class that represents a query for the 'productunit' table.
 *
 *
 *
 * @method     ChildProductunitQuery orderByUnit($order = Criteria::ASC) Order by the unit column
 * @method     ChildProductunitQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildProductunitQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildProductunitQuery groupByUnit() Group by the unit column
 * @method     ChildProductunitQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildProductunitQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildProductunitQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductunitQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductunitQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductunitQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductunitQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductunitQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductunitQuery leftJoinEmployeepurchases($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeepurchases relation
 * @method     ChildProductunitQuery rightJoinEmployeepurchases($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeepurchases relation
 * @method     ChildProductunitQuery innerJoinEmployeepurchases($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeepurchases relation
 *
 * @method     ChildProductunitQuery joinWithEmployeepurchases($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeepurchases relation
 *
 * @method     ChildProductunitQuery leftJoinWithEmployeepurchases() Adds a LEFT JOIN clause and with to the query using the Employeepurchases relation
 * @method     ChildProductunitQuery rightJoinWithEmployeepurchases() Adds a RIGHT JOIN clause and with to the query using the Employeepurchases relation
 * @method     ChildProductunitQuery innerJoinWithEmployeepurchases() Adds a INNER JOIN clause and with to the query using the Employeepurchases relation
 *
 * @method     \lwops\lwops\EmployeepurchasesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProductunit findOne(ConnectionInterface $con = null) Return the first ChildProductunit matching the query
 * @method     ChildProductunit findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProductunit matching the query, or a new ChildProductunit object populated from the query conditions when no match is found
 *
 * @method     ChildProductunit findOneByUnit(string $unit) Return the first ChildProductunit filtered by the unit column
 * @method     ChildProductunit findOneByCreatetmstp(string $createTmstp) Return the first ChildProductunit filtered by the createTmstp column
 * @method     ChildProductunit findOneByUpdttmstp(string $updtTmstp) Return the first ChildProductunit filtered by the updtTmstp column *

 * @method     ChildProductunit requirePk($key, ConnectionInterface $con = null) Return the ChildProductunit by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductunit requireOne(ConnectionInterface $con = null) Return the first ChildProductunit matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductunit requireOneByUnit(string $unit) Return the first ChildProductunit filtered by the unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductunit requireOneByCreatetmstp(string $createTmstp) Return the first ChildProductunit filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductunit requireOneByUpdttmstp(string $updtTmstp) Return the first ChildProductunit filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductunit[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProductunit objects based on current ModelCriteria
 * @method     ChildProductunit[]|ObjectCollection findByUnit(string $unit) Return ChildProductunit objects filtered by the unit column
 * @method     ChildProductunit[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildProductunit objects filtered by the createTmstp column
 * @method     ChildProductunit[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildProductunit objects filtered by the updtTmstp column
 * @method     ChildProductunit[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductunitQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\ProductunitQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Productunit', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductunitQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductunitQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductunitQuery) {
            return $criteria;
        }
        $query = new ChildProductunitQuery();
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
     * @return ChildProductunit|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductunitTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductunitTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProductunit A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT unit, createTmstp, updtTmstp FROM productunit WHERE unit = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildProductunit $obj */
            $obj = new ChildProductunit();
            $obj->hydrate($row);
            ProductunitTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProductunit|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProductunitQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductunitTableMap::COL_UNIT, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductunitQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductunitTableMap::COL_UNIT, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the unit column
     *
     * Example usage:
     * <code>
     * $query->filterByUnit('fooValue');   // WHERE unit = 'fooValue'
     * $query->filterByUnit('%fooValue%', Criteria::LIKE); // WHERE unit LIKE '%fooValue%'
     * </code>
     *
     * @param     string $unit The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductunitQuery The current query, for fluid interface
     */
    public function filterByUnit($unit = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($unit)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductunitTableMap::COL_UNIT, $unit, $comparison);
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
     * @return $this|ChildProductunitQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(ProductunitTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(ProductunitTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductunitTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildProductunitQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(ProductunitTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(ProductunitTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductunitTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeepurchases object
     *
     * @param \lwops\lwops\Employeepurchases|ObjectCollection $employeepurchases the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductunitQuery The current query, for fluid interface
     */
    public function filterByEmployeepurchases($employeepurchases, $comparison = null)
    {
        if ($employeepurchases instanceof \lwops\lwops\Employeepurchases) {
            return $this
                ->addUsingAlias(ProductunitTableMap::COL_UNIT, $employeepurchases->getProductunittype(), $comparison);
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
     * @return $this|ChildProductunitQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildProductunit $productunit Object to remove from the list of results
     *
     * @return $this|ChildProductunitQuery The current query, for fluid interface
     */
    public function prune($productunit = null)
    {
        if ($productunit) {
            $this->addUsingAlias(ProductunitTableMap::COL_UNIT, $productunit->getUnit(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the productunit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductunitTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductunitTableMap::clearInstancePool();
            ProductunitTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductunitTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductunitTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductunitTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductunitTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProductunitQuery
