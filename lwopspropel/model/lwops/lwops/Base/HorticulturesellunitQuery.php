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
use lwops\lwops\Horticulturesellunit as ChildHorticulturesellunit;
use lwops\lwops\HorticulturesellunitQuery as ChildHorticulturesellunitQuery;
use lwops\lwops\Map\HorticulturesellunitTableMap;

/**
 * Base class that represents a query for the 'horticulturesellunit' table.
 *
 *
 *
 * @method     ChildHorticulturesellunitQuery orderByUnit($order = Criteria::ASC) Order by the unit column
 * @method     ChildHorticulturesellunitQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildHorticulturesellunitQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildHorticulturesellunitQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildHorticulturesellunitQuery groupByUnit() Group by the unit column
 * @method     ChildHorticulturesellunitQuery groupByDescription() Group by the description column
 * @method     ChildHorticulturesellunitQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildHorticulturesellunitQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildHorticulturesellunitQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHorticulturesellunitQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHorticulturesellunitQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHorticulturesellunitQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHorticulturesellunitQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHorticulturesellunitQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHorticulturesellunitQuery leftJoinHorticulturesales($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticulturesales relation
 * @method     ChildHorticulturesellunitQuery rightJoinHorticulturesales($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticulturesales relation
 * @method     ChildHorticulturesellunitQuery innerJoinHorticulturesales($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticulturesales relation
 *
 * @method     ChildHorticulturesellunitQuery joinWithHorticulturesales($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticulturesales relation
 *
 * @method     ChildHorticulturesellunitQuery leftJoinWithHorticulturesales() Adds a LEFT JOIN clause and with to the query using the Horticulturesales relation
 * @method     ChildHorticulturesellunitQuery rightJoinWithHorticulturesales() Adds a RIGHT JOIN clause and with to the query using the Horticulturesales relation
 * @method     ChildHorticulturesellunitQuery innerJoinWithHorticulturesales() Adds a INNER JOIN clause and with to the query using the Horticulturesales relation
 *
 * @method     \lwops\lwops\HorticulturesalesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHorticulturesellunit findOne(ConnectionInterface $con = null) Return the first ChildHorticulturesellunit matching the query
 * @method     ChildHorticulturesellunit findOneOrCreate(ConnectionInterface $con = null) Return the first ChildHorticulturesellunit matching the query, or a new ChildHorticulturesellunit object populated from the query conditions when no match is found
 *
 * @method     ChildHorticulturesellunit findOneByUnit(string $unit) Return the first ChildHorticulturesellunit filtered by the unit column
 * @method     ChildHorticulturesellunit findOneByDescription(string $description) Return the first ChildHorticulturesellunit filtered by the description column
 * @method     ChildHorticulturesellunit findOneByCreatetmstp(string $createTmstp) Return the first ChildHorticulturesellunit filtered by the createTmstp column
 * @method     ChildHorticulturesellunit findOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticulturesellunit filtered by the updtTmstp column *

 * @method     ChildHorticulturesellunit requirePk($key, ConnectionInterface $con = null) Return the ChildHorticulturesellunit by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturesellunit requireOne(ConnectionInterface $con = null) Return the first ChildHorticulturesellunit matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticulturesellunit requireOneByUnit(string $unit) Return the first ChildHorticulturesellunit filtered by the unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturesellunit requireOneByDescription(string $description) Return the first ChildHorticulturesellunit filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturesellunit requireOneByCreatetmstp(string $createTmstp) Return the first ChildHorticulturesellunit filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturesellunit requireOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticulturesellunit filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticulturesellunit[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildHorticulturesellunit objects based on current ModelCriteria
 * @method     ChildHorticulturesellunit[]|ObjectCollection findByUnit(string $unit) Return ChildHorticulturesellunit objects filtered by the unit column
 * @method     ChildHorticulturesellunit[]|ObjectCollection findByDescription(string $description) Return ChildHorticulturesellunit objects filtered by the description column
 * @method     ChildHorticulturesellunit[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildHorticulturesellunit objects filtered by the createTmstp column
 * @method     ChildHorticulturesellunit[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildHorticulturesellunit objects filtered by the updtTmstp column
 * @method     ChildHorticulturesellunit[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HorticulturesellunitQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\HorticulturesellunitQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Horticulturesellunit', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHorticulturesellunitQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHorticulturesellunitQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildHorticulturesellunitQuery) {
            return $criteria;
        }
        $query = new ChildHorticulturesellunitQuery();
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
     * @return ChildHorticulturesellunit|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HorticulturesellunitTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HorticulturesellunitTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHorticulturesellunit A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT unit, description, createTmstp, updtTmstp FROM horticulturesellunit WHERE unit = :p0';
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
            /** @var ChildHorticulturesellunit $obj */
            $obj = new ChildHorticulturesellunit();
            $obj->hydrate($row);
            HorticulturesellunitTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHorticulturesellunit|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildHorticulturesellunitQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HorticulturesellunitTableMap::COL_UNIT, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildHorticulturesellunitQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HorticulturesellunitTableMap::COL_UNIT, $keys, Criteria::IN);
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
     * @return $this|ChildHorticulturesellunitQuery The current query, for fluid interface
     */
    public function filterByUnit($unit = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($unit)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturesellunitTableMap::COL_UNIT, $unit, $comparison);
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
     * @return $this|ChildHorticulturesellunitQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturesellunitTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildHorticulturesellunitQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(HorticulturesellunitTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(HorticulturesellunitTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturesellunitTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildHorticulturesellunitQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(HorticulturesellunitTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(HorticulturesellunitTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturesellunitTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Horticulturesales object
     *
     * @param \lwops\lwops\Horticulturesales|ObjectCollection $horticulturesales the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHorticulturesellunitQuery The current query, for fluid interface
     */
    public function filterByHorticulturesales($horticulturesales, $comparison = null)
    {
        if ($horticulturesales instanceof \lwops\lwops\Horticulturesales) {
            return $this
                ->addUsingAlias(HorticulturesellunitTableMap::COL_UNIT, $horticulturesales->getUnit(), $comparison);
        } elseif ($horticulturesales instanceof ObjectCollection) {
            return $this
                ->useHorticulturesalesQuery()
                ->filterByPrimaryKeys($horticulturesales->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByHorticulturesales() only accepts arguments of type \lwops\lwops\Horticulturesales or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Horticulturesales relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHorticulturesellunitQuery The current query, for fluid interface
     */
    public function joinHorticulturesales($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Horticulturesales');

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
            $this->addJoinObject($join, 'Horticulturesales');
        }

        return $this;
    }

    /**
     * Use the Horticulturesales relation Horticulturesales object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\HorticulturesalesQuery A secondary query class using the current class as primary query
     */
    public function useHorticulturesalesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHorticulturesales($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Horticulturesales', '\lwops\lwops\HorticulturesalesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildHorticulturesellunit $horticulturesellunit Object to remove from the list of results
     *
     * @return $this|ChildHorticulturesellunitQuery The current query, for fluid interface
     */
    public function prune($horticulturesellunit = null)
    {
        if ($horticulturesellunit) {
            $this->addUsingAlias(HorticulturesellunitTableMap::COL_UNIT, $horticulturesellunit->getUnit(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the horticulturesellunit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HorticulturesellunitTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HorticulturesellunitTableMap::clearInstancePool();
            HorticulturesellunitTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HorticulturesellunitTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HorticulturesellunitTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HorticulturesellunitTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HorticulturesellunitTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // HorticulturesellunitQuery
