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
use lwops\lwops\Mushroomproduction as ChildMushroomproduction;
use lwops\lwops\MushroomproductionQuery as ChildMushroomproductionQuery;
use lwops\lwops\Map\MushroomproductionTableMap;

/**
 * Base class that represents a query for the 'mushroomproduction' table.
 *
 *
 *
 * @method     ChildMushroomproductionQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildMushroomproductionQuery orderByGrId($order = Criteria::ASC) Order by the gr_id column
 * @method     ChildMushroomproductionQuery orderByHarvestdt($order = Criteria::ASC) Order by the harvestDt column
 * @method     ChildMushroomproductionQuery orderByRoomnbr($order = Criteria::ASC) Order by the roomNbr column
 * @method     ChildMushroomproductionQuery orderByCropnbr($order = Criteria::ASC) Order by the cropNbr column
 * @method     ChildMushroomproductionQuery orderByHarvestedweight($order = Criteria::ASC) Order by the harvestedWeight column
 * @method     ChildMushroomproductionQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildMushroomproductionQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildMushroomproductionQuery groupByOid() Group by the oid column
 * @method     ChildMushroomproductionQuery groupByGrId() Group by the gr_id column
 * @method     ChildMushroomproductionQuery groupByHarvestdt() Group by the harvestDt column
 * @method     ChildMushroomproductionQuery groupByRoomnbr() Group by the roomNbr column
 * @method     ChildMushroomproductionQuery groupByCropnbr() Group by the cropNbr column
 * @method     ChildMushroomproductionQuery groupByHarvestedweight() Group by the harvestedWeight column
 * @method     ChildMushroomproductionQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildMushroomproductionQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildMushroomproductionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMushroomproductionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMushroomproductionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMushroomproductionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMushroomproductionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMushroomproductionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMushroomproduction findOne(ConnectionInterface $con = null) Return the first ChildMushroomproduction matching the query
 * @method     ChildMushroomproduction findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMushroomproduction matching the query, or a new ChildMushroomproduction object populated from the query conditions when no match is found
 *
 * @method     ChildMushroomproduction findOneByOid(int $oid) Return the first ChildMushroomproduction filtered by the oid column
 * @method     ChildMushroomproduction findOneByGrId(string $gr_id) Return the first ChildMushroomproduction filtered by the gr_id column
 * @method     ChildMushroomproduction findOneByHarvestdt(string $harvestDt) Return the first ChildMushroomproduction filtered by the harvestDt column
 * @method     ChildMushroomproduction findOneByRoomnbr(int $roomNbr) Return the first ChildMushroomproduction filtered by the roomNbr column
 * @method     ChildMushroomproduction findOneByCropnbr(int $cropNbr) Return the first ChildMushroomproduction filtered by the cropNbr column
 * @method     ChildMushroomproduction findOneByHarvestedweight(double $harvestedWeight) Return the first ChildMushroomproduction filtered by the harvestedWeight column
 * @method     ChildMushroomproduction findOneByCreatetmstp(string $createTmstp) Return the first ChildMushroomproduction filtered by the createTmstp column
 * @method     ChildMushroomproduction findOneByUpdttmstp(string $updtTmstp) Return the first ChildMushroomproduction filtered by the updtTmstp column *

 * @method     ChildMushroomproduction requirePk($key, ConnectionInterface $con = null) Return the ChildMushroomproduction by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMushroomproduction requireOne(ConnectionInterface $con = null) Return the first ChildMushroomproduction matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMushroomproduction requireOneByOid(int $oid) Return the first ChildMushroomproduction filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMushroomproduction requireOneByGrId(string $gr_id) Return the first ChildMushroomproduction filtered by the gr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMushroomproduction requireOneByHarvestdt(string $harvestDt) Return the first ChildMushroomproduction filtered by the harvestDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMushroomproduction requireOneByRoomnbr(int $roomNbr) Return the first ChildMushroomproduction filtered by the roomNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMushroomproduction requireOneByCropnbr(int $cropNbr) Return the first ChildMushroomproduction filtered by the cropNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMushroomproduction requireOneByHarvestedweight(double $harvestedWeight) Return the first ChildMushroomproduction filtered by the harvestedWeight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMushroomproduction requireOneByCreatetmstp(string $createTmstp) Return the first ChildMushroomproduction filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMushroomproduction requireOneByUpdttmstp(string $updtTmstp) Return the first ChildMushroomproduction filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMushroomproduction[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMushroomproduction objects based on current ModelCriteria
 * @method     ChildMushroomproduction[]|ObjectCollection findByOid(int $oid) Return ChildMushroomproduction objects filtered by the oid column
 * @method     ChildMushroomproduction[]|ObjectCollection findByGrId(string $gr_id) Return ChildMushroomproduction objects filtered by the gr_id column
 * @method     ChildMushroomproduction[]|ObjectCollection findByHarvestdt(string $harvestDt) Return ChildMushroomproduction objects filtered by the harvestDt column
 * @method     ChildMushroomproduction[]|ObjectCollection findByRoomnbr(int $roomNbr) Return ChildMushroomproduction objects filtered by the roomNbr column
 * @method     ChildMushroomproduction[]|ObjectCollection findByCropnbr(int $cropNbr) Return ChildMushroomproduction objects filtered by the cropNbr column
 * @method     ChildMushroomproduction[]|ObjectCollection findByHarvestedweight(double $harvestedWeight) Return ChildMushroomproduction objects filtered by the harvestedWeight column
 * @method     ChildMushroomproduction[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildMushroomproduction objects filtered by the createTmstp column
 * @method     ChildMushroomproduction[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildMushroomproduction objects filtered by the updtTmstp column
 * @method     ChildMushroomproduction[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MushroomproductionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\MushroomproductionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Mushroomproduction', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMushroomproductionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMushroomproductionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMushroomproductionQuery) {
            return $criteria;
        }
        $query = new ChildMushroomproductionQuery();
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
     * @return ChildMushroomproduction|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MushroomproductionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MushroomproductionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMushroomproduction A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, gr_id, harvestDt, roomNbr, cropNbr, harvestedWeight, createTmstp, updtTmstp FROM mushroomproduction WHERE oid = :p0';
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
            /** @var ChildMushroomproduction $obj */
            $obj = new ChildMushroomproduction();
            $obj->hydrate($row);
            MushroomproductionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMushroomproduction|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMushroomproductionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MushroomproductionTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMushroomproductionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MushroomproductionTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildMushroomproductionQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(MushroomproductionTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(MushroomproductionTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MushroomproductionTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the gr_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGrId('fooValue');   // WHERE gr_id = 'fooValue'
     * $query->filterByGrId('%fooValue%', Criteria::LIKE); // WHERE gr_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $grId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMushroomproductionQuery The current query, for fluid interface
     */
    public function filterByGrId($grId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($grId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MushroomproductionTableMap::COL_GR_ID, $grId, $comparison);
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
     * @return $this|ChildMushroomproductionQuery The current query, for fluid interface
     */
    public function filterByHarvestdt($harvestdt = null, $comparison = null)
    {
        if (is_array($harvestdt)) {
            $useMinMax = false;
            if (isset($harvestdt['min'])) {
                $this->addUsingAlias(MushroomproductionTableMap::COL_HARVESTDT, $harvestdt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($harvestdt['max'])) {
                $this->addUsingAlias(MushroomproductionTableMap::COL_HARVESTDT, $harvestdt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MushroomproductionTableMap::COL_HARVESTDT, $harvestdt, $comparison);
    }

    /**
     * Filter the query on the roomNbr column
     *
     * Example usage:
     * <code>
     * $query->filterByRoomnbr(1234); // WHERE roomNbr = 1234
     * $query->filterByRoomnbr(array(12, 34)); // WHERE roomNbr IN (12, 34)
     * $query->filterByRoomnbr(array('min' => 12)); // WHERE roomNbr > 12
     * </code>
     *
     * @param     mixed $roomnbr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMushroomproductionQuery The current query, for fluid interface
     */
    public function filterByRoomnbr($roomnbr = null, $comparison = null)
    {
        if (is_array($roomnbr)) {
            $useMinMax = false;
            if (isset($roomnbr['min'])) {
                $this->addUsingAlias(MushroomproductionTableMap::COL_ROOMNBR, $roomnbr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomnbr['max'])) {
                $this->addUsingAlias(MushroomproductionTableMap::COL_ROOMNBR, $roomnbr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MushroomproductionTableMap::COL_ROOMNBR, $roomnbr, $comparison);
    }

    /**
     * Filter the query on the cropNbr column
     *
     * Example usage:
     * <code>
     * $query->filterByCropnbr(1234); // WHERE cropNbr = 1234
     * $query->filterByCropnbr(array(12, 34)); // WHERE cropNbr IN (12, 34)
     * $query->filterByCropnbr(array('min' => 12)); // WHERE cropNbr > 12
     * </code>
     *
     * @param     mixed $cropnbr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMushroomproductionQuery The current query, for fluid interface
     */
    public function filterByCropnbr($cropnbr = null, $comparison = null)
    {
        if (is_array($cropnbr)) {
            $useMinMax = false;
            if (isset($cropnbr['min'])) {
                $this->addUsingAlias(MushroomproductionTableMap::COL_CROPNBR, $cropnbr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cropnbr['max'])) {
                $this->addUsingAlias(MushroomproductionTableMap::COL_CROPNBR, $cropnbr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MushroomproductionTableMap::COL_CROPNBR, $cropnbr, $comparison);
    }

    /**
     * Filter the query on the harvestedWeight column
     *
     * Example usage:
     * <code>
     * $query->filterByHarvestedweight(1234); // WHERE harvestedWeight = 1234
     * $query->filterByHarvestedweight(array(12, 34)); // WHERE harvestedWeight IN (12, 34)
     * $query->filterByHarvestedweight(array('min' => 12)); // WHERE harvestedWeight > 12
     * </code>
     *
     * @param     mixed $harvestedweight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMushroomproductionQuery The current query, for fluid interface
     */
    public function filterByHarvestedweight($harvestedweight = null, $comparison = null)
    {
        if (is_array($harvestedweight)) {
            $useMinMax = false;
            if (isset($harvestedweight['min'])) {
                $this->addUsingAlias(MushroomproductionTableMap::COL_HARVESTEDWEIGHT, $harvestedweight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($harvestedweight['max'])) {
                $this->addUsingAlias(MushroomproductionTableMap::COL_HARVESTEDWEIGHT, $harvestedweight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MushroomproductionTableMap::COL_HARVESTEDWEIGHT, $harvestedweight, $comparison);
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
     * @return $this|ChildMushroomproductionQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(MushroomproductionTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(MushroomproductionTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MushroomproductionTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildMushroomproductionQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(MushroomproductionTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(MushroomproductionTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MushroomproductionTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMushroomproduction $mushroomproduction Object to remove from the list of results
     *
     * @return $this|ChildMushroomproductionQuery The current query, for fluid interface
     */
    public function prune($mushroomproduction = null)
    {
        if ($mushroomproduction) {
            $this->addUsingAlias(MushroomproductionTableMap::COL_OID, $mushroomproduction->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the mushroomproduction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MushroomproductionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MushroomproductionTableMap::clearInstancePool();
            MushroomproductionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MushroomproductionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MushroomproductionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MushroomproductionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MushroomproductionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MushroomproductionQuery
