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
use lwops\lwops\Elecdeductionrate as ChildElecdeductionrate;
use lwops\lwops\ElecdeductionrateQuery as ChildElecdeductionrateQuery;
use lwops\lwops\Map\ElecdeductionrateTableMap;

/**
 * Base class that represents a query for the 'elecdeductionrate' table.
 *
 *
 *
 * @method     ChildElecdeductionrateQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildElecdeductionrateQuery orderByRate($order = Criteria::ASC) Order by the rate column
 * @method     ChildElecdeductionrateQuery orderByStartdt($order = Criteria::ASC) Order by the startDt column
 * @method     ChildElecdeductionrateQuery orderByEnddt($order = Criteria::ASC) Order by the endDt column
 * @method     ChildElecdeductionrateQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildElecdeductionrateQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildElecdeductionrateQuery groupByOid() Group by the oid column
 * @method     ChildElecdeductionrateQuery groupByRate() Group by the rate column
 * @method     ChildElecdeductionrateQuery groupByStartdt() Group by the startDt column
 * @method     ChildElecdeductionrateQuery groupByEnddt() Group by the endDt column
 * @method     ChildElecdeductionrateQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildElecdeductionrateQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildElecdeductionrateQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildElecdeductionrateQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildElecdeductionrateQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildElecdeductionrateQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildElecdeductionrateQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildElecdeductionrateQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildElecdeductionrate findOne(ConnectionInterface $con = null) Return the first ChildElecdeductionrate matching the query
 * @method     ChildElecdeductionrate findOneOrCreate(ConnectionInterface $con = null) Return the first ChildElecdeductionrate matching the query, or a new ChildElecdeductionrate object populated from the query conditions when no match is found
 *
 * @method     ChildElecdeductionrate findOneByOid(int $oid) Return the first ChildElecdeductionrate filtered by the oid column
 * @method     ChildElecdeductionrate findOneByRate(double $rate) Return the first ChildElecdeductionrate filtered by the rate column
 * @method     ChildElecdeductionrate findOneByStartdt(string $startDt) Return the first ChildElecdeductionrate filtered by the startDt column
 * @method     ChildElecdeductionrate findOneByEnddt(string $endDt) Return the first ChildElecdeductionrate filtered by the endDt column
 * @method     ChildElecdeductionrate findOneByCreatetmstp(string $createTmstp) Return the first ChildElecdeductionrate filtered by the createTmstp column
 * @method     ChildElecdeductionrate findOneByUpdttmstp(string $updtTmstp) Return the first ChildElecdeductionrate filtered by the updtTmstp column *

 * @method     ChildElecdeductionrate requirePk($key, ConnectionInterface $con = null) Return the ChildElecdeductionrate by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElecdeductionrate requireOne(ConnectionInterface $con = null) Return the first ChildElecdeductionrate matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildElecdeductionrate requireOneByOid(int $oid) Return the first ChildElecdeductionrate filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElecdeductionrate requireOneByRate(double $rate) Return the first ChildElecdeductionrate filtered by the rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElecdeductionrate requireOneByStartdt(string $startDt) Return the first ChildElecdeductionrate filtered by the startDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElecdeductionrate requireOneByEnddt(string $endDt) Return the first ChildElecdeductionrate filtered by the endDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElecdeductionrate requireOneByCreatetmstp(string $createTmstp) Return the first ChildElecdeductionrate filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElecdeductionrate requireOneByUpdttmstp(string $updtTmstp) Return the first ChildElecdeductionrate filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildElecdeductionrate[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildElecdeductionrate objects based on current ModelCriteria
 * @method     ChildElecdeductionrate[]|ObjectCollection findByOid(int $oid) Return ChildElecdeductionrate objects filtered by the oid column
 * @method     ChildElecdeductionrate[]|ObjectCollection findByRate(double $rate) Return ChildElecdeductionrate objects filtered by the rate column
 * @method     ChildElecdeductionrate[]|ObjectCollection findByStartdt(string $startDt) Return ChildElecdeductionrate objects filtered by the startDt column
 * @method     ChildElecdeductionrate[]|ObjectCollection findByEnddt(string $endDt) Return ChildElecdeductionrate objects filtered by the endDt column
 * @method     ChildElecdeductionrate[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildElecdeductionrate objects filtered by the createTmstp column
 * @method     ChildElecdeductionrate[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildElecdeductionrate objects filtered by the updtTmstp column
 * @method     ChildElecdeductionrate[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ElecdeductionrateQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\ElecdeductionrateQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Elecdeductionrate', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildElecdeductionrateQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildElecdeductionrateQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildElecdeductionrateQuery) {
            return $criteria;
        }
        $query = new ChildElecdeductionrateQuery();
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
     * @return ChildElecdeductionrate|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ElecdeductionrateTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ElecdeductionrateTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildElecdeductionrate A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, rate, startDt, endDt, createTmstp, updtTmstp FROM elecdeductionrate WHERE oid = :p0';
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
            /** @var ChildElecdeductionrate $obj */
            $obj = new ChildElecdeductionrate();
            $obj->hydrate($row);
            ElecdeductionrateTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildElecdeductionrate|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildElecdeductionrateQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ElecdeductionrateTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildElecdeductionrateQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ElecdeductionrateTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildElecdeductionrateQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(ElecdeductionrateTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(ElecdeductionrateTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElecdeductionrateTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the rate column
     *
     * Example usage:
     * <code>
     * $query->filterByRate(1234); // WHERE rate = 1234
     * $query->filterByRate(array(12, 34)); // WHERE rate IN (12, 34)
     * $query->filterByRate(array('min' => 12)); // WHERE rate > 12
     * </code>
     *
     * @param     mixed $rate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElecdeductionrateQuery The current query, for fluid interface
     */
    public function filterByRate($rate = null, $comparison = null)
    {
        if (is_array($rate)) {
            $useMinMax = false;
            if (isset($rate['min'])) {
                $this->addUsingAlias(ElecdeductionrateTableMap::COL_RATE, $rate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rate['max'])) {
                $this->addUsingAlias(ElecdeductionrateTableMap::COL_RATE, $rate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElecdeductionrateTableMap::COL_RATE, $rate, $comparison);
    }

    /**
     * Filter the query on the startDt column
     *
     * Example usage:
     * <code>
     * $query->filterByStartdt('2011-03-14'); // WHERE startDt = '2011-03-14'
     * $query->filterByStartdt('now'); // WHERE startDt = '2011-03-14'
     * $query->filterByStartdt(array('max' => 'yesterday')); // WHERE startDt > '2011-03-13'
     * </code>
     *
     * @param     mixed $startdt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElecdeductionrateQuery The current query, for fluid interface
     */
    public function filterByStartdt($startdt = null, $comparison = null)
    {
        if (is_array($startdt)) {
            $useMinMax = false;
            if (isset($startdt['min'])) {
                $this->addUsingAlias(ElecdeductionrateTableMap::COL_STARTDT, $startdt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startdt['max'])) {
                $this->addUsingAlias(ElecdeductionrateTableMap::COL_STARTDT, $startdt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElecdeductionrateTableMap::COL_STARTDT, $startdt, $comparison);
    }

    /**
     * Filter the query on the endDt column
     *
     * Example usage:
     * <code>
     * $query->filterByEnddt('2011-03-14'); // WHERE endDt = '2011-03-14'
     * $query->filterByEnddt('now'); // WHERE endDt = '2011-03-14'
     * $query->filterByEnddt(array('max' => 'yesterday')); // WHERE endDt > '2011-03-13'
     * </code>
     *
     * @param     mixed $enddt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElecdeductionrateQuery The current query, for fluid interface
     */
    public function filterByEnddt($enddt = null, $comparison = null)
    {
        if (is_array($enddt)) {
            $useMinMax = false;
            if (isset($enddt['min'])) {
                $this->addUsingAlias(ElecdeductionrateTableMap::COL_ENDDT, $enddt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($enddt['max'])) {
                $this->addUsingAlias(ElecdeductionrateTableMap::COL_ENDDT, $enddt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElecdeductionrateTableMap::COL_ENDDT, $enddt, $comparison);
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
     * @return $this|ChildElecdeductionrateQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(ElecdeductionrateTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(ElecdeductionrateTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElecdeductionrateTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildElecdeductionrateQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(ElecdeductionrateTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(ElecdeductionrateTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElecdeductionrateTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildElecdeductionrate $elecdeductionrate Object to remove from the list of results
     *
     * @return $this|ChildElecdeductionrateQuery The current query, for fluid interface
     */
    public function prune($elecdeductionrate = null)
    {
        if ($elecdeductionrate) {
            $this->addUsingAlias(ElecdeductionrateTableMap::COL_OID, $elecdeductionrate->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the elecdeductionrate table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ElecdeductionrateTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ElecdeductionrateTableMap::clearInstancePool();
            ElecdeductionrateTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ElecdeductionrateTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ElecdeductionrateTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ElecdeductionrateTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ElecdeductionrateTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ElecdeductionrateQuery
