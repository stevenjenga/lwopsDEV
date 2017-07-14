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
use lwops\lwops\Fishproduction as ChildFishproduction;
use lwops\lwops\FishproductionQuery as ChildFishproductionQuery;
use lwops\lwops\Map\FishproductionTableMap;

/**
 * Base class that represents a query for the 'fishproduction' table.
 *
 *
 *
 * @method     ChildFishproductionQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildFishproductionQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildFishproductionQuery orderByHarvestdt($order = Criteria::ASC) Order by the harvestDt column
 * @method     ChildFishproductionQuery orderByPondnbr($order = Criteria::ASC) Order by the pondNbr column
 * @method     ChildFishproductionQuery orderByWeight($order = Criteria::ASC) Order by the weight column
 * @method     ChildFishproductionQuery orderByCount($order = Criteria::ASC) Order by the count column
 * @method     ChildFishproductionQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildFishproductionQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildFishproductionQuery groupByOid() Group by the oid column
 * @method     ChildFishproductionQuery groupByType() Group by the type column
 * @method     ChildFishproductionQuery groupByHarvestdt() Group by the harvestDt column
 * @method     ChildFishproductionQuery groupByPondnbr() Group by the pondNbr column
 * @method     ChildFishproductionQuery groupByWeight() Group by the weight column
 * @method     ChildFishproductionQuery groupByCount() Group by the count column
 * @method     ChildFishproductionQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildFishproductionQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildFishproductionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFishproductionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFishproductionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFishproductionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFishproductionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFishproductionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFishproductionQuery leftJoinFishtype($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fishtype relation
 * @method     ChildFishproductionQuery rightJoinFishtype($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fishtype relation
 * @method     ChildFishproductionQuery innerJoinFishtype($relationAlias = null) Adds a INNER JOIN clause to the query using the Fishtype relation
 *
 * @method     ChildFishproductionQuery joinWithFishtype($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fishtype relation
 *
 * @method     ChildFishproductionQuery leftJoinWithFishtype() Adds a LEFT JOIN clause and with to the query using the Fishtype relation
 * @method     ChildFishproductionQuery rightJoinWithFishtype() Adds a RIGHT JOIN clause and with to the query using the Fishtype relation
 * @method     ChildFishproductionQuery innerJoinWithFishtype() Adds a INNER JOIN clause and with to the query using the Fishtype relation
 *
 * @method     \lwops\lwops\FishtypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFishproduction findOne(ConnectionInterface $con = null) Return the first ChildFishproduction matching the query
 * @method     ChildFishproduction findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFishproduction matching the query, or a new ChildFishproduction object populated from the query conditions when no match is found
 *
 * @method     ChildFishproduction findOneByOid(int $oid) Return the first ChildFishproduction filtered by the oid column
 * @method     ChildFishproduction findOneByType(string $type) Return the first ChildFishproduction filtered by the type column
 * @method     ChildFishproduction findOneByHarvestdt(string $harvestDt) Return the first ChildFishproduction filtered by the harvestDt column
 * @method     ChildFishproduction findOneByPondnbr(int $pondNbr) Return the first ChildFishproduction filtered by the pondNbr column
 * @method     ChildFishproduction findOneByWeight(double $weight) Return the first ChildFishproduction filtered by the weight column
 * @method     ChildFishproduction findOneByCount(int $count) Return the first ChildFishproduction filtered by the count column
 * @method     ChildFishproduction findOneByCreatetmstp(string $createTmstp) Return the first ChildFishproduction filtered by the createTmstp column
 * @method     ChildFishproduction findOneByUpdttmstp(string $updtTmstp) Return the first ChildFishproduction filtered by the updtTmstp column *

 * @method     ChildFishproduction requirePk($key, ConnectionInterface $con = null) Return the ChildFishproduction by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishproduction requireOne(ConnectionInterface $con = null) Return the first ChildFishproduction matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFishproduction requireOneByOid(int $oid) Return the first ChildFishproduction filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishproduction requireOneByType(string $type) Return the first ChildFishproduction filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishproduction requireOneByHarvestdt(string $harvestDt) Return the first ChildFishproduction filtered by the harvestDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishproduction requireOneByPondnbr(int $pondNbr) Return the first ChildFishproduction filtered by the pondNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishproduction requireOneByWeight(double $weight) Return the first ChildFishproduction filtered by the weight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishproduction requireOneByCount(int $count) Return the first ChildFishproduction filtered by the count column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishproduction requireOneByCreatetmstp(string $createTmstp) Return the first ChildFishproduction filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishproduction requireOneByUpdttmstp(string $updtTmstp) Return the first ChildFishproduction filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFishproduction[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFishproduction objects based on current ModelCriteria
 * @method     ChildFishproduction[]|ObjectCollection findByOid(int $oid) Return ChildFishproduction objects filtered by the oid column
 * @method     ChildFishproduction[]|ObjectCollection findByType(string $type) Return ChildFishproduction objects filtered by the type column
 * @method     ChildFishproduction[]|ObjectCollection findByHarvestdt(string $harvestDt) Return ChildFishproduction objects filtered by the harvestDt column
 * @method     ChildFishproduction[]|ObjectCollection findByPondnbr(int $pondNbr) Return ChildFishproduction objects filtered by the pondNbr column
 * @method     ChildFishproduction[]|ObjectCollection findByWeight(double $weight) Return ChildFishproduction objects filtered by the weight column
 * @method     ChildFishproduction[]|ObjectCollection findByCount(int $count) Return ChildFishproduction objects filtered by the count column
 * @method     ChildFishproduction[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildFishproduction objects filtered by the createTmstp column
 * @method     ChildFishproduction[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildFishproduction objects filtered by the updtTmstp column
 * @method     ChildFishproduction[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FishproductionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\FishproductionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Fishproduction', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFishproductionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFishproductionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFishproductionQuery) {
            return $criteria;
        }
        $query = new ChildFishproductionQuery();
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
     * @return ChildFishproduction|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FishproductionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FishproductionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFishproduction A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, type, harvestDt, pondNbr, weight, count, createTmstp, updtTmstp FROM fishproduction WHERE oid = :p0';
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
            /** @var ChildFishproduction $obj */
            $obj = new ChildFishproduction();
            $obj->hydrate($row);
            FishproductionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFishproduction|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFishproductionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FishproductionTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFishproductionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FishproductionTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildFishproductionQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(FishproductionTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(FishproductionTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishproductionTableMap::COL_OID, $oid, $comparison);
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
     * @return $this|ChildFishproductionQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishproductionTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the harvestDt column
     *
     * Example usage:
     * <code>
     * $query->filterByHarvestdt('2011-03-14'); // WHERE harvestDt = '2011-03-14'
     * $query->filterByHarvestdt('now'); // WHERE harvestDt = '2011-03-14'
     * $query->filterByHarvestdt(array('max' => 'yesterday')); // WHERE harvestDt > '2011-03-13'
     * </code>
     *
     * @param     mixed $harvestdt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishproductionQuery The current query, for fluid interface
     */
    public function filterByHarvestdt($harvestdt = null, $comparison = null)
    {
        if (is_array($harvestdt)) {
            $useMinMax = false;
            if (isset($harvestdt['min'])) {
                $this->addUsingAlias(FishproductionTableMap::COL_HARVESTDT, $harvestdt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($harvestdt['max'])) {
                $this->addUsingAlias(FishproductionTableMap::COL_HARVESTDT, $harvestdt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishproductionTableMap::COL_HARVESTDT, $harvestdt, $comparison);
    }

    /**
     * Filter the query on the pondNbr column
     *
     * Example usage:
     * <code>
     * $query->filterByPondnbr(1234); // WHERE pondNbr = 1234
     * $query->filterByPondnbr(array(12, 34)); // WHERE pondNbr IN (12, 34)
     * $query->filterByPondnbr(array('min' => 12)); // WHERE pondNbr > 12
     * </code>
     *
     * @param     mixed $pondnbr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishproductionQuery The current query, for fluid interface
     */
    public function filterByPondnbr($pondnbr = null, $comparison = null)
    {
        if (is_array($pondnbr)) {
            $useMinMax = false;
            if (isset($pondnbr['min'])) {
                $this->addUsingAlias(FishproductionTableMap::COL_PONDNBR, $pondnbr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pondnbr['max'])) {
                $this->addUsingAlias(FishproductionTableMap::COL_PONDNBR, $pondnbr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishproductionTableMap::COL_PONDNBR, $pondnbr, $comparison);
    }

    /**
     * Filter the query on the weight column
     *
     * Example usage:
     * <code>
     * $query->filterByWeight(1234); // WHERE weight = 1234
     * $query->filterByWeight(array(12, 34)); // WHERE weight IN (12, 34)
     * $query->filterByWeight(array('min' => 12)); // WHERE weight > 12
     * </code>
     *
     * @param     mixed $weight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishproductionQuery The current query, for fluid interface
     */
    public function filterByWeight($weight = null, $comparison = null)
    {
        if (is_array($weight)) {
            $useMinMax = false;
            if (isset($weight['min'])) {
                $this->addUsingAlias(FishproductionTableMap::COL_WEIGHT, $weight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($weight['max'])) {
                $this->addUsingAlias(FishproductionTableMap::COL_WEIGHT, $weight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishproductionTableMap::COL_WEIGHT, $weight, $comparison);
    }

    /**
     * Filter the query on the count column
     *
     * Example usage:
     * <code>
     * $query->filterByCount(1234); // WHERE count = 1234
     * $query->filterByCount(array(12, 34)); // WHERE count IN (12, 34)
     * $query->filterByCount(array('min' => 12)); // WHERE count > 12
     * </code>
     *
     * @param     mixed $count The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishproductionQuery The current query, for fluid interface
     */
    public function filterByCount($count = null, $comparison = null)
    {
        if (is_array($count)) {
            $useMinMax = false;
            if (isset($count['min'])) {
                $this->addUsingAlias(FishproductionTableMap::COL_COUNT, $count['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($count['max'])) {
                $this->addUsingAlias(FishproductionTableMap::COL_COUNT, $count['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishproductionTableMap::COL_COUNT, $count, $comparison);
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
     * @return $this|ChildFishproductionQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(FishproductionTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(FishproductionTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishproductionTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildFishproductionQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(FishproductionTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(FishproductionTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishproductionTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Fishtype object
     *
     * @param \lwops\lwops\Fishtype|ObjectCollection $fishtype The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFishproductionQuery The current query, for fluid interface
     */
    public function filterByFishtype($fishtype, $comparison = null)
    {
        if ($fishtype instanceof \lwops\lwops\Fishtype) {
            return $this
                ->addUsingAlias(FishproductionTableMap::COL_TYPE, $fishtype->getFishtype(), $comparison);
        } elseif ($fishtype instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FishproductionTableMap::COL_TYPE, $fishtype->toKeyValue('PrimaryKey', 'Fishtype'), $comparison);
        } else {
            throw new PropelException('filterByFishtype() only accepts arguments of type \lwops\lwops\Fishtype or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fishtype relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFishproductionQuery The current query, for fluid interface
     */
    public function joinFishtype($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fishtype');

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
            $this->addJoinObject($join, 'Fishtype');
        }

        return $this;
    }

    /**
     * Use the Fishtype relation Fishtype object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\FishtypeQuery A secondary query class using the current class as primary query
     */
    public function useFishtypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFishtype($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fishtype', '\lwops\lwops\FishtypeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFishproduction $fishproduction Object to remove from the list of results
     *
     * @return $this|ChildFishproductionQuery The current query, for fluid interface
     */
    public function prune($fishproduction = null)
    {
        if ($fishproduction) {
            $this->addUsingAlias(FishproductionTableMap::COL_OID, $fishproduction->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the fishproduction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FishproductionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FishproductionTableMap::clearInstancePool();
            FishproductionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FishproductionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FishproductionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FishproductionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FishproductionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FishproductionQuery
