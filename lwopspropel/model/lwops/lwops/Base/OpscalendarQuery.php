<?php

namespace lwops\lwops\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use lwops\lwops\Opscalendar as ChildOpscalendar;
use lwops\lwops\OpscalendarQuery as ChildOpscalendarQuery;
use lwops\lwops\Map\OpscalendarTableMap;

/**
 * Base class that represents a query for the 'opscalendar' table.
 *
 *
 *
 * @method     ChildOpscalendarQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildOpscalendarQuery orderByOpsdate($order = Criteria::ASC) Order by the opsDate column
 * @method     ChildOpscalendarQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildOpscalendarQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildOpscalendarQuery groupByOid() Group by the oid column
 * @method     ChildOpscalendarQuery groupByOpsdate() Group by the opsDate column
 * @method     ChildOpscalendarQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildOpscalendarQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildOpscalendarQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOpscalendarQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOpscalendarQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOpscalendarQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOpscalendarQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOpscalendarQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOpscalendar findOne(ConnectionInterface $con = null) Return the first ChildOpscalendar matching the query
 * @method     ChildOpscalendar findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOpscalendar matching the query, or a new ChildOpscalendar object populated from the query conditions when no match is found
 *
 * @method     ChildOpscalendar findOneByOid(int $oid) Return the first ChildOpscalendar filtered by the oid column
 * @method     ChildOpscalendar findOneByOpsdate(string $opsDate) Return the first ChildOpscalendar filtered by the opsDate column
 * @method     ChildOpscalendar findOneByCreatetmstp(string $createTmstp) Return the first ChildOpscalendar filtered by the createTmstp column
 * @method     ChildOpscalendar findOneByUpdttmstp(string $updtTmstp) Return the first ChildOpscalendar filtered by the updtTmstp column *

 * @method     ChildOpscalendar requirePk($key, ConnectionInterface $con = null) Return the ChildOpscalendar by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpscalendar requireOne(ConnectionInterface $con = null) Return the first ChildOpscalendar matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOpscalendar requireOneByOid(int $oid) Return the first ChildOpscalendar filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpscalendar requireOneByOpsdate(string $opsDate) Return the first ChildOpscalendar filtered by the opsDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpscalendar requireOneByCreatetmstp(string $createTmstp) Return the first ChildOpscalendar filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpscalendar requireOneByUpdttmstp(string $updtTmstp) Return the first ChildOpscalendar filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOpscalendar[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOpscalendar objects based on current ModelCriteria
 * @method     ChildOpscalendar[]|ObjectCollection findByOid(int $oid) Return ChildOpscalendar objects filtered by the oid column
 * @method     ChildOpscalendar[]|ObjectCollection findByOpsdate(string $opsDate) Return ChildOpscalendar objects filtered by the opsDate column
 * @method     ChildOpscalendar[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildOpscalendar objects filtered by the createTmstp column
 * @method     ChildOpscalendar[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildOpscalendar objects filtered by the updtTmstp column
 * @method     ChildOpscalendar[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OpscalendarQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\OpscalendarQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Opscalendar', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOpscalendarQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOpscalendarQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOpscalendarQuery) {
            return $criteria;
        }
        $query = new ChildOpscalendarQuery();
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
     * @return ChildOpscalendar|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OpscalendarTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OpscalendarTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOpscalendar A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, opsDate, createTmstp, updtTmstp FROM opscalendar WHERE oid = :p0';
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
            /** @var ChildOpscalendar $obj */
            $obj = new ChildOpscalendar();
            $obj->hydrate($row);
            OpscalendarTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOpscalendar|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOpscalendarQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OpscalendarTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOpscalendarQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OpscalendarTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildOpscalendarQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(OpscalendarTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(OpscalendarTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpscalendarTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the opsDate column
     *
     * Example usage:
     * <code>
     * $query->filterByOpsdate('2011-03-14'); // WHERE opsDate = '2011-03-14'
     * $query->filterByOpsdate('now'); // WHERE opsDate = '2011-03-14'
     * $query->filterByOpsdate(array('max' => 'yesterday')); // WHERE opsDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $opsdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpscalendarQuery The current query, for fluid interface
     */
    public function filterByOpsdate($opsdate = null, $comparison = null)
    {
        if (is_array($opsdate)) {
            $useMinMax = false;
            if (isset($opsdate['min'])) {
                $this->addUsingAlias(OpscalendarTableMap::COL_OPSDATE, $opsdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($opsdate['max'])) {
                $this->addUsingAlias(OpscalendarTableMap::COL_OPSDATE, $opsdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpscalendarTableMap::COL_OPSDATE, $opsdate, $comparison);
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
     * @return $this|ChildOpscalendarQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(OpscalendarTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(OpscalendarTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpscalendarTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildOpscalendarQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(OpscalendarTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(OpscalendarTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpscalendarTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildOpscalendar $opscalendar Object to remove from the list of results
     *
     * @return $this|ChildOpscalendarQuery The current query, for fluid interface
     */
    public function prune($opscalendar = null)
    {
        if ($opscalendar) {
            $this->addUsingAlias(OpscalendarTableMap::COL_OID, $opscalendar->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the opscalendar table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OpscalendarTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OpscalendarTableMap::clearInstancePool();
            OpscalendarTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OpscalendarTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OpscalendarTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OpscalendarTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OpscalendarTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OpscalendarQuery
