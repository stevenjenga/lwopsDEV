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
use lwops\lwops\Horticultureproducebrand as ChildHorticultureproducebrand;
use lwops\lwops\HorticultureproducebrandQuery as ChildHorticultureproducebrandQuery;
use lwops\lwops\Map\HorticultureproducebrandTableMap;

/**
 * Base class that represents a query for the 'horticultureproducebrand' table.
 *
 *
 *
 * @method     ChildHorticultureproducebrandQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildHorticultureproducebrandQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildHorticultureproducebrandQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildHorticultureproducebrandQuery groupByName() Group by the name column
 * @method     ChildHorticultureproducebrandQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildHorticultureproducebrandQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildHorticultureproducebrandQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHorticultureproducebrandQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHorticultureproducebrandQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHorticultureproducebrandQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHorticultureproducebrandQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHorticultureproducebrandQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHorticultureproducebrandQuery leftJoinHorticultureproducedetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproducebrandQuery rightJoinHorticultureproducedetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproducebrandQuery innerJoinHorticultureproducedetail($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticultureproducedetail relation
 *
 * @method     ChildHorticultureproducebrandQuery joinWithHorticultureproducedetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticultureproducedetail relation
 *
 * @method     ChildHorticultureproducebrandQuery leftJoinWithHorticultureproducedetail() Adds a LEFT JOIN clause and with to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproducebrandQuery rightJoinWithHorticultureproducedetail() Adds a RIGHT JOIN clause and with to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproducebrandQuery innerJoinWithHorticultureproducedetail() Adds a INNER JOIN clause and with to the query using the Horticultureproducedetail relation
 *
 * @method     \lwops\lwops\HorticultureproducedetailQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHorticultureproducebrand findOne(ConnectionInterface $con = null) Return the first ChildHorticultureproducebrand matching the query
 * @method     ChildHorticultureproducebrand findOneOrCreate(ConnectionInterface $con = null) Return the first ChildHorticultureproducebrand matching the query, or a new ChildHorticultureproducebrand object populated from the query conditions when no match is found
 *
 * @method     ChildHorticultureproducebrand findOneByName(string $name) Return the first ChildHorticultureproducebrand filtered by the name column
 * @method     ChildHorticultureproducebrand findOneByCreatetmstp(string $createTmstp) Return the first ChildHorticultureproducebrand filtered by the createTmstp column
 * @method     ChildHorticultureproducebrand findOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticultureproducebrand filtered by the updtTmstp column *

 * @method     ChildHorticultureproducebrand requirePk($key, ConnectionInterface $con = null) Return the ChildHorticultureproducebrand by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducebrand requireOne(ConnectionInterface $con = null) Return the first ChildHorticultureproducebrand matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticultureproducebrand requireOneByName(string $name) Return the first ChildHorticultureproducebrand filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducebrand requireOneByCreatetmstp(string $createTmstp) Return the first ChildHorticultureproducebrand filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducebrand requireOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticultureproducebrand filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticultureproducebrand[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildHorticultureproducebrand objects based on current ModelCriteria
 * @method     ChildHorticultureproducebrand[]|ObjectCollection findByName(string $name) Return ChildHorticultureproducebrand objects filtered by the name column
 * @method     ChildHorticultureproducebrand[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildHorticultureproducebrand objects filtered by the createTmstp column
 * @method     ChildHorticultureproducebrand[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildHorticultureproducebrand objects filtered by the updtTmstp column
 * @method     ChildHorticultureproducebrand[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HorticultureproducebrandQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\HorticultureproducebrandQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Horticultureproducebrand', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHorticultureproducebrandQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHorticultureproducebrandQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildHorticultureproducebrandQuery) {
            return $criteria;
        }
        $query = new ChildHorticultureproducebrandQuery();
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
     * @return ChildHorticultureproducebrand|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HorticultureproducebrandTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HorticultureproducebrandTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHorticultureproducebrand A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT name, createTmstp, updtTmstp FROM horticultureproducebrand WHERE name = :p0';
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
            /** @var ChildHorticultureproducebrand $obj */
            $obj = new ChildHorticultureproducebrand();
            $obj->hydrate($row);
            HorticultureproducebrandTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHorticultureproducebrand|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildHorticultureproducebrandQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HorticultureproducebrandTableMap::COL_NAME, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildHorticultureproducebrandQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HorticultureproducebrandTableMap::COL_NAME, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducebrandQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducebrandTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildHorticultureproducebrandQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(HorticultureproducebrandTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(HorticultureproducebrandTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducebrandTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildHorticultureproducebrandQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(HorticultureproducebrandTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(HorticultureproducebrandTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducebrandTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Horticultureproducedetail object
     *
     * @param \lwops\lwops\Horticultureproducedetail|ObjectCollection $horticultureproducedetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHorticultureproducebrandQuery The current query, for fluid interface
     */
    public function filterByHorticultureproducedetail($horticultureproducedetail, $comparison = null)
    {
        if ($horticultureproducedetail instanceof \lwops\lwops\Horticultureproducedetail) {
            return $this
                ->addUsingAlias(HorticultureproducebrandTableMap::COL_NAME, $horticultureproducedetail->getBrand(), $comparison);
        } elseif ($horticultureproducedetail instanceof ObjectCollection) {
            return $this
                ->useHorticultureproducedetailQuery()
                ->filterByPrimaryKeys($horticultureproducedetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByHorticultureproducedetail() only accepts arguments of type \lwops\lwops\Horticultureproducedetail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Horticultureproducedetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHorticultureproducebrandQuery The current query, for fluid interface
     */
    public function joinHorticultureproducedetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Horticultureproducedetail');

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
            $this->addJoinObject($join, 'Horticultureproducedetail');
        }

        return $this;
    }

    /**
     * Use the Horticultureproducedetail relation Horticultureproducedetail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\HorticultureproducedetailQuery A secondary query class using the current class as primary query
     */
    public function useHorticultureproducedetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHorticultureproducedetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Horticultureproducedetail', '\lwops\lwops\HorticultureproducedetailQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildHorticultureproducebrand $horticultureproducebrand Object to remove from the list of results
     *
     * @return $this|ChildHorticultureproducebrandQuery The current query, for fluid interface
     */
    public function prune($horticultureproducebrand = null)
    {
        if ($horticultureproducebrand) {
            $this->addUsingAlias(HorticultureproducebrandTableMap::COL_NAME, $horticultureproducebrand->getName(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the horticultureproducebrand table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducebrandTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HorticultureproducebrandTableMap::clearInstancePool();
            HorticultureproducebrandTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducebrandTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HorticultureproducebrandTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HorticultureproducebrandTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HorticultureproducebrandTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // HorticultureproducebrandQuery
