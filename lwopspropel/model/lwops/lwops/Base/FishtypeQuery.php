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
use lwops\lwops\Fishtype as ChildFishtype;
use lwops\lwops\FishtypeQuery as ChildFishtypeQuery;
use lwops\lwops\Map\FishtypeTableMap;

/**
 * Base class that represents a query for the 'fishtype' table.
 *
 *
 *
 * @method     ChildFishtypeQuery orderByFishtype($order = Criteria::ASC) Order by the fishType column
 * @method     ChildFishtypeQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildFishtypeQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildFishtypeQuery groupByFishtype() Group by the fishType column
 * @method     ChildFishtypeQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildFishtypeQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildFishtypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFishtypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFishtypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFishtypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFishtypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFishtypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFishtypeQuery leftJoinFishproduction($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fishproduction relation
 * @method     ChildFishtypeQuery rightJoinFishproduction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fishproduction relation
 * @method     ChildFishtypeQuery innerJoinFishproduction($relationAlias = null) Adds a INNER JOIN clause to the query using the Fishproduction relation
 *
 * @method     ChildFishtypeQuery joinWithFishproduction($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fishproduction relation
 *
 * @method     ChildFishtypeQuery leftJoinWithFishproduction() Adds a LEFT JOIN clause and with to the query using the Fishproduction relation
 * @method     ChildFishtypeQuery rightJoinWithFishproduction() Adds a RIGHT JOIN clause and with to the query using the Fishproduction relation
 * @method     ChildFishtypeQuery innerJoinWithFishproduction() Adds a INNER JOIN clause and with to the query using the Fishproduction relation
 *
 * @method     ChildFishtypeQuery leftJoinFishsales($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fishsales relation
 * @method     ChildFishtypeQuery rightJoinFishsales($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fishsales relation
 * @method     ChildFishtypeQuery innerJoinFishsales($relationAlias = null) Adds a INNER JOIN clause to the query using the Fishsales relation
 *
 * @method     ChildFishtypeQuery joinWithFishsales($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fishsales relation
 *
 * @method     ChildFishtypeQuery leftJoinWithFishsales() Adds a LEFT JOIN clause and with to the query using the Fishsales relation
 * @method     ChildFishtypeQuery rightJoinWithFishsales() Adds a RIGHT JOIN clause and with to the query using the Fishsales relation
 * @method     ChildFishtypeQuery innerJoinWithFishsales() Adds a INNER JOIN clause and with to the query using the Fishsales relation
 *
 * @method     \lwops\lwops\FishproductionQuery|\lwops\lwops\FishsalesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFishtype findOne(ConnectionInterface $con = null) Return the first ChildFishtype matching the query
 * @method     ChildFishtype findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFishtype matching the query, or a new ChildFishtype object populated from the query conditions when no match is found
 *
 * @method     ChildFishtype findOneByFishtype(string $fishType) Return the first ChildFishtype filtered by the fishType column
 * @method     ChildFishtype findOneByCreatetmstp(string $createTmstp) Return the first ChildFishtype filtered by the createTmstp column
 * @method     ChildFishtype findOneByUpdttmstp(string $updtTmstp) Return the first ChildFishtype filtered by the updtTmstp column *

 * @method     ChildFishtype requirePk($key, ConnectionInterface $con = null) Return the ChildFishtype by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishtype requireOne(ConnectionInterface $con = null) Return the first ChildFishtype matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFishtype requireOneByFishtype(string $fishType) Return the first ChildFishtype filtered by the fishType column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishtype requireOneByCreatetmstp(string $createTmstp) Return the first ChildFishtype filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishtype requireOneByUpdttmstp(string $updtTmstp) Return the first ChildFishtype filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFishtype[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFishtype objects based on current ModelCriteria
 * @method     ChildFishtype[]|ObjectCollection findByFishtype(string $fishType) Return ChildFishtype objects filtered by the fishType column
 * @method     ChildFishtype[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildFishtype objects filtered by the createTmstp column
 * @method     ChildFishtype[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildFishtype objects filtered by the updtTmstp column
 * @method     ChildFishtype[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FishtypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\FishtypeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Fishtype', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFishtypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFishtypeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFishtypeQuery) {
            return $criteria;
        }
        $query = new ChildFishtypeQuery();
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
     * @return ChildFishtype|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FishtypeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FishtypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFishtype A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT fishType, createTmstp, updtTmstp FROM fishtype WHERE fishType = :p0';
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
            /** @var ChildFishtype $obj */
            $obj = new ChildFishtype();
            $obj->hydrate($row);
            FishtypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFishtype|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFishtypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FishtypeTableMap::COL_FISHTYPE, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFishtypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FishtypeTableMap::COL_FISHTYPE, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the fishType column
     *
     * Example usage:
     * <code>
     * $query->filterByFishtype('fooValue');   // WHERE fishType = 'fooValue'
     * $query->filterByFishtype('%fooValue%', Criteria::LIKE); // WHERE fishType LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fishtype The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishtypeQuery The current query, for fluid interface
     */
    public function filterByFishtype($fishtype = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fishtype)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishtypeTableMap::COL_FISHTYPE, $fishtype, $comparison);
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
     * @return $this|ChildFishtypeQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(FishtypeTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(FishtypeTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishtypeTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildFishtypeQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(FishtypeTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(FishtypeTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishtypeTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Fishproduction object
     *
     * @param \lwops\lwops\Fishproduction|ObjectCollection $fishproduction the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFishtypeQuery The current query, for fluid interface
     */
    public function filterByFishproduction($fishproduction, $comparison = null)
    {
        if ($fishproduction instanceof \lwops\lwops\Fishproduction) {
            return $this
                ->addUsingAlias(FishtypeTableMap::COL_FISHTYPE, $fishproduction->getType(), $comparison);
        } elseif ($fishproduction instanceof ObjectCollection) {
            return $this
                ->useFishproductionQuery()
                ->filterByPrimaryKeys($fishproduction->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFishproduction() only accepts arguments of type \lwops\lwops\Fishproduction or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fishproduction relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFishtypeQuery The current query, for fluid interface
     */
    public function joinFishproduction($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fishproduction');

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
            $this->addJoinObject($join, 'Fishproduction');
        }

        return $this;
    }

    /**
     * Use the Fishproduction relation Fishproduction object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\FishproductionQuery A secondary query class using the current class as primary query
     */
    public function useFishproductionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFishproduction($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fishproduction', '\lwops\lwops\FishproductionQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Fishsales object
     *
     * @param \lwops\lwops\Fishsales|ObjectCollection $fishsales the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFishtypeQuery The current query, for fluid interface
     */
    public function filterByFishsales($fishsales, $comparison = null)
    {
        if ($fishsales instanceof \lwops\lwops\Fishsales) {
            return $this
                ->addUsingAlias(FishtypeTableMap::COL_FISHTYPE, $fishsales->getType(), $comparison);
        } elseif ($fishsales instanceof ObjectCollection) {
            return $this
                ->useFishsalesQuery()
                ->filterByPrimaryKeys($fishsales->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFishsales() only accepts arguments of type \lwops\lwops\Fishsales or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fishsales relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFishtypeQuery The current query, for fluid interface
     */
    public function joinFishsales($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fishsales');

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
            $this->addJoinObject($join, 'Fishsales');
        }

        return $this;
    }

    /**
     * Use the Fishsales relation Fishsales object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\FishsalesQuery A secondary query class using the current class as primary query
     */
    public function useFishsalesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFishsales($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fishsales', '\lwops\lwops\FishsalesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFishtype $fishtype Object to remove from the list of results
     *
     * @return $this|ChildFishtypeQuery The current query, for fluid interface
     */
    public function prune($fishtype = null)
    {
        if ($fishtype) {
            $this->addUsingAlias(FishtypeTableMap::COL_FISHTYPE, $fishtype->getFishtype(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the fishtype table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FishtypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FishtypeTableMap::clearInstancePool();
            FishtypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FishtypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FishtypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FishtypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FishtypeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FishtypeQuery
