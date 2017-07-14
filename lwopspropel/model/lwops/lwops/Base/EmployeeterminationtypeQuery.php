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
use lwops\lwops\Employeeterminationtype as ChildEmployeeterminationtype;
use lwops\lwops\EmployeeterminationtypeQuery as ChildEmployeeterminationtypeQuery;
use lwops\lwops\Map\EmployeeterminationtypeTableMap;

/**
 * Base class that represents a query for the 'employeeterminationtype' table.
 *
 *
 *
 * @method     ChildEmployeeterminationtypeQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildEmployeeterminationtypeQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildEmployeeterminationtypeQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildEmployeeterminationtypeQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildEmployeeterminationtypeQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildEmployeeterminationtypeQuery groupByOid() Group by the oid column
 * @method     ChildEmployeeterminationtypeQuery groupByType() Group by the type column
 * @method     ChildEmployeeterminationtypeQuery groupByDescription() Group by the description column
 * @method     ChildEmployeeterminationtypeQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildEmployeeterminationtypeQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildEmployeeterminationtypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeeterminationtypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeeterminationtypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeeterminationtypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeeterminationtypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeeterminationtypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeeterminationtypeQuery leftJoinEmployeetermination($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeetermination relation
 * @method     ChildEmployeeterminationtypeQuery rightJoinEmployeetermination($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeetermination relation
 * @method     ChildEmployeeterminationtypeQuery innerJoinEmployeetermination($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeetermination relation
 *
 * @method     ChildEmployeeterminationtypeQuery joinWithEmployeetermination($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeetermination relation
 *
 * @method     ChildEmployeeterminationtypeQuery leftJoinWithEmployeetermination() Adds a LEFT JOIN clause and with to the query using the Employeetermination relation
 * @method     ChildEmployeeterminationtypeQuery rightJoinWithEmployeetermination() Adds a RIGHT JOIN clause and with to the query using the Employeetermination relation
 * @method     ChildEmployeeterminationtypeQuery innerJoinWithEmployeetermination() Adds a INNER JOIN clause and with to the query using the Employeetermination relation
 *
 * @method     \lwops\lwops\EmployeeterminationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployeeterminationtype findOne(ConnectionInterface $con = null) Return the first ChildEmployeeterminationtype matching the query
 * @method     ChildEmployeeterminationtype findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmployeeterminationtype matching the query, or a new ChildEmployeeterminationtype object populated from the query conditions when no match is found
 *
 * @method     ChildEmployeeterminationtype findOneByOid(int $oid) Return the first ChildEmployeeterminationtype filtered by the oid column
 * @method     ChildEmployeeterminationtype findOneByType(string $type) Return the first ChildEmployeeterminationtype filtered by the type column
 * @method     ChildEmployeeterminationtype findOneByDescription(string $description) Return the first ChildEmployeeterminationtype filtered by the description column
 * @method     ChildEmployeeterminationtype findOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeeterminationtype filtered by the createTmstp column
 * @method     ChildEmployeeterminationtype findOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeeterminationtype filtered by the updtTmstp column *

 * @method     ChildEmployeeterminationtype requirePk($key, ConnectionInterface $con = null) Return the ChildEmployeeterminationtype by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeterminationtype requireOne(ConnectionInterface $con = null) Return the first ChildEmployeeterminationtype matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeterminationtype requireOneByOid(int $oid) Return the first ChildEmployeeterminationtype filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeterminationtype requireOneByType(string $type) Return the first ChildEmployeeterminationtype filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeterminationtype requireOneByDescription(string $description) Return the first ChildEmployeeterminationtype filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeterminationtype requireOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeeterminationtype filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeterminationtype requireOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeeterminationtype filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeterminationtype[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmployeeterminationtype objects based on current ModelCriteria
 * @method     ChildEmployeeterminationtype[]|ObjectCollection findByOid(int $oid) Return ChildEmployeeterminationtype objects filtered by the oid column
 * @method     ChildEmployeeterminationtype[]|ObjectCollection findByType(string $type) Return ChildEmployeeterminationtype objects filtered by the type column
 * @method     ChildEmployeeterminationtype[]|ObjectCollection findByDescription(string $description) Return ChildEmployeeterminationtype objects filtered by the description column
 * @method     ChildEmployeeterminationtype[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildEmployeeterminationtype objects filtered by the createTmstp column
 * @method     ChildEmployeeterminationtype[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildEmployeeterminationtype objects filtered by the updtTmstp column
 * @method     ChildEmployeeterminationtype[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmployeeterminationtypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\EmployeeterminationtypeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Employeeterminationtype', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeeterminationtypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeeterminationtypeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmployeeterminationtypeQuery) {
            return $criteria;
        }
        $query = new ChildEmployeeterminationtypeQuery();
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
     * @return ChildEmployeeterminationtype|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeterminationtypeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeeterminationtypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployeeterminationtype A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, type, description, createTmstp, updtTmstp FROM employeeterminationtype WHERE oid = :p0';
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
            /** @var ChildEmployeeterminationtype $obj */
            $obj = new ChildEmployeeterminationtype();
            $obj->hydrate($row);
            EmployeeterminationtypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployeeterminationtype|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmployeeterminationtypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmployeeterminationtypeTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmployeeterminationtypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmployeeterminationtypeTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildEmployeeterminationtypeQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(EmployeeterminationtypeTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(EmployeeterminationtypeTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeterminationtypeTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeterminationtypeQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeterminationtypeTableMap::COL_TYPE, $type, $comparison);
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
     * @return $this|ChildEmployeeterminationtypeQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeterminationtypeTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildEmployeeterminationtypeQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(EmployeeterminationtypeTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(EmployeeterminationtypeTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeterminationtypeTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildEmployeeterminationtypeQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(EmployeeterminationtypeTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(EmployeeterminationtypeTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeterminationtypeTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeetermination object
     *
     * @param \lwops\lwops\Employeetermination|ObjectCollection $employeetermination the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeterminationtypeQuery The current query, for fluid interface
     */
    public function filterByEmployeetermination($employeetermination, $comparison = null)
    {
        if ($employeetermination instanceof \lwops\lwops\Employeetermination) {
            return $this
                ->addUsingAlias(EmployeeterminationtypeTableMap::COL_OID, $employeetermination->getEmployeeterminationtypeoid(), $comparison);
        } elseif ($employeetermination instanceof ObjectCollection) {
            return $this
                ->useEmployeeterminationQuery()
                ->filterByPrimaryKeys($employeetermination->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEmployeetermination() only accepts arguments of type \lwops\lwops\Employeetermination or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employeetermination relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeterminationtypeQuery The current query, for fluid interface
     */
    public function joinEmployeetermination($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employeetermination');

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
            $this->addJoinObject($join, 'Employeetermination');
        }

        return $this;
    }

    /**
     * Use the Employeetermination relation Employeetermination object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeeterminationQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeterminationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeetermination($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employeetermination', '\lwops\lwops\EmployeeterminationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEmployeeterminationtype $employeeterminationtype Object to remove from the list of results
     *
     * @return $this|ChildEmployeeterminationtypeQuery The current query, for fluid interface
     */
    public function prune($employeeterminationtype = null)
    {
        if ($employeeterminationtype) {
            $this->addUsingAlias(EmployeeterminationtypeTableMap::COL_OID, $employeeterminationtype->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employeeterminationtype table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeterminationtypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeeterminationtypeTableMap::clearInstancePool();
            EmployeeterminationtypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeterminationtypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeeterminationtypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeeterminationtypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeeterminationtypeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmployeeterminationtypeQuery
