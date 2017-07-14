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
use lwops\lwops\Horticultureproducedetail as ChildHorticultureproducedetail;
use lwops\lwops\HorticultureproducedetailQuery as ChildHorticultureproducedetailQuery;
use lwops\lwops\Map\HorticultureproducedetailTableMap;

/**
 * Base class that represents a query for the 'horticultureproducedetail' table.
 *
 *
 *
 * @method     ChildHorticultureproducedetailQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildHorticultureproducedetailQuery orderByHorticultureproduceparentoid($order = Criteria::ASC) Order by the horticultureProduceParentoid column
 * @method     ChildHorticultureproducedetailQuery orderByBrand($order = Criteria::ASC) Order by the brand column
 * @method     ChildHorticultureproducedetailQuery orderByVariety($order = Criteria::ASC) Order by the variety column
 * @method     ChildHorticultureproducedetailQuery orderByDirectplanting($order = Criteria::ASC) Order by the directPlanting column
 * @method     ChildHorticultureproducedetailQuery orderByNurseryduration($order = Criteria::ASC) Order by the nurseryDuration column
 * @method     ChildHorticultureproducedetailQuery orderByAvgmaturitydays($order = Criteria::ASC) Order by the avgMaturityDays column
 * @method     ChildHorticultureproducedetailQuery orderByHarvestdurationdays($order = Criteria::ASC) Order by the harvestDurationDays column
 * @method     ChildHorticultureproducedetailQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildHorticultureproducedetailQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildHorticultureproducedetailQuery groupByOid() Group by the oid column
 * @method     ChildHorticultureproducedetailQuery groupByHorticultureproduceparentoid() Group by the horticultureProduceParentoid column
 * @method     ChildHorticultureproducedetailQuery groupByBrand() Group by the brand column
 * @method     ChildHorticultureproducedetailQuery groupByVariety() Group by the variety column
 * @method     ChildHorticultureproducedetailQuery groupByDirectplanting() Group by the directPlanting column
 * @method     ChildHorticultureproducedetailQuery groupByNurseryduration() Group by the nurseryDuration column
 * @method     ChildHorticultureproducedetailQuery groupByAvgmaturitydays() Group by the avgMaturityDays column
 * @method     ChildHorticultureproducedetailQuery groupByHarvestdurationdays() Group by the harvestDurationDays column
 * @method     ChildHorticultureproducedetailQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildHorticultureproducedetailQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildHorticultureproducedetailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHorticultureproducedetailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHorticultureproducedetailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHorticultureproducedetailQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHorticultureproducedetailQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHorticultureproducedetailQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHorticultureproducedetailQuery leftJoinHorticultureproduceparent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticultureproduceparent relation
 * @method     ChildHorticultureproducedetailQuery rightJoinHorticultureproduceparent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticultureproduceparent relation
 * @method     ChildHorticultureproducedetailQuery innerJoinHorticultureproduceparent($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticultureproduceparent relation
 *
 * @method     ChildHorticultureproducedetailQuery joinWithHorticultureproduceparent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticultureproduceparent relation
 *
 * @method     ChildHorticultureproducedetailQuery leftJoinWithHorticultureproduceparent() Adds a LEFT JOIN clause and with to the query using the Horticultureproduceparent relation
 * @method     ChildHorticultureproducedetailQuery rightJoinWithHorticultureproduceparent() Adds a RIGHT JOIN clause and with to the query using the Horticultureproduceparent relation
 * @method     ChildHorticultureproducedetailQuery innerJoinWithHorticultureproduceparent() Adds a INNER JOIN clause and with to the query using the Horticultureproduceparent relation
 *
 * @method     ChildHorticultureproducedetailQuery leftJoinHorticultureproducebrand($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticultureproducebrand relation
 * @method     ChildHorticultureproducedetailQuery rightJoinHorticultureproducebrand($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticultureproducebrand relation
 * @method     ChildHorticultureproducedetailQuery innerJoinHorticultureproducebrand($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticultureproducebrand relation
 *
 * @method     ChildHorticultureproducedetailQuery joinWithHorticultureproducebrand($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticultureproducebrand relation
 *
 * @method     ChildHorticultureproducedetailQuery leftJoinWithHorticultureproducebrand() Adds a LEFT JOIN clause and with to the query using the Horticultureproducebrand relation
 * @method     ChildHorticultureproducedetailQuery rightJoinWithHorticultureproducebrand() Adds a RIGHT JOIN clause and with to the query using the Horticultureproducebrand relation
 * @method     ChildHorticultureproducedetailQuery innerJoinWithHorticultureproducebrand() Adds a INNER JOIN clause and with to the query using the Horticultureproducebrand relation
 *
 * @method     ChildHorticultureproducedetailQuery leftJoinHorticultureproducebed($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticultureproducebed relation
 * @method     ChildHorticultureproducedetailQuery rightJoinHorticultureproducebed($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticultureproducebed relation
 * @method     ChildHorticultureproducedetailQuery innerJoinHorticultureproducebed($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticultureproducebed relation
 *
 * @method     ChildHorticultureproducedetailQuery joinWithHorticultureproducebed($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticultureproducebed relation
 *
 * @method     ChildHorticultureproducedetailQuery leftJoinWithHorticultureproducebed() Adds a LEFT JOIN clause and with to the query using the Horticultureproducebed relation
 * @method     ChildHorticultureproducedetailQuery rightJoinWithHorticultureproducebed() Adds a RIGHT JOIN clause and with to the query using the Horticultureproducebed relation
 * @method     ChildHorticultureproducedetailQuery innerJoinWithHorticultureproducebed() Adds a INNER JOIN clause and with to the query using the Horticultureproducebed relation
 *
 * @method     ChildHorticultureproducedetailQuery leftJoinHorticultureproducestock($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticultureproducestock relation
 * @method     ChildHorticultureproducedetailQuery rightJoinHorticultureproducestock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticultureproducestock relation
 * @method     ChildHorticultureproducedetailQuery innerJoinHorticultureproducestock($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticultureproducestock relation
 *
 * @method     ChildHorticultureproducedetailQuery joinWithHorticultureproducestock($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticultureproducestock relation
 *
 * @method     ChildHorticultureproducedetailQuery leftJoinWithHorticultureproducestock() Adds a LEFT JOIN clause and with to the query using the Horticultureproducestock relation
 * @method     ChildHorticultureproducedetailQuery rightJoinWithHorticultureproducestock() Adds a RIGHT JOIN clause and with to the query using the Horticultureproducestock relation
 * @method     ChildHorticultureproducedetailQuery innerJoinWithHorticultureproducestock() Adds a INNER JOIN clause and with to the query using the Horticultureproducestock relation
 *
 * @method     \lwops\lwops\HorticultureproduceparentQuery|\lwops\lwops\HorticultureproducebrandQuery|\lwops\lwops\HorticultureproducebedQuery|\lwops\lwops\HorticultureproducestockQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHorticultureproducedetail findOne(ConnectionInterface $con = null) Return the first ChildHorticultureproducedetail matching the query
 * @method     ChildHorticultureproducedetail findOneOrCreate(ConnectionInterface $con = null) Return the first ChildHorticultureproducedetail matching the query, or a new ChildHorticultureproducedetail object populated from the query conditions when no match is found
 *
 * @method     ChildHorticultureproducedetail findOneByOid(int $oid) Return the first ChildHorticultureproducedetail filtered by the oid column
 * @method     ChildHorticultureproducedetail findOneByHorticultureproduceparentoid(int $horticultureProduceParentoid) Return the first ChildHorticultureproducedetail filtered by the horticultureProduceParentoid column
 * @method     ChildHorticultureproducedetail findOneByBrand(string $brand) Return the first ChildHorticultureproducedetail filtered by the brand column
 * @method     ChildHorticultureproducedetail findOneByVariety(string $variety) Return the first ChildHorticultureproducedetail filtered by the variety column
 * @method     ChildHorticultureproducedetail findOneByDirectplanting(int $directPlanting) Return the first ChildHorticultureproducedetail filtered by the directPlanting column
 * @method     ChildHorticultureproducedetail findOneByNurseryduration(int $nurseryDuration) Return the first ChildHorticultureproducedetail filtered by the nurseryDuration column
 * @method     ChildHorticultureproducedetail findOneByAvgmaturitydays(int $avgMaturityDays) Return the first ChildHorticultureproducedetail filtered by the avgMaturityDays column
 * @method     ChildHorticultureproducedetail findOneByHarvestdurationdays(int $harvestDurationDays) Return the first ChildHorticultureproducedetail filtered by the harvestDurationDays column
 * @method     ChildHorticultureproducedetail findOneByCreatetmstp(string $createTmstp) Return the first ChildHorticultureproducedetail filtered by the createTmstp column
 * @method     ChildHorticultureproducedetail findOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticultureproducedetail filtered by the updtTmstp column *

 * @method     ChildHorticultureproducedetail requirePk($key, ConnectionInterface $con = null) Return the ChildHorticultureproducedetail by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducedetail requireOne(ConnectionInterface $con = null) Return the first ChildHorticultureproducedetail matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticultureproducedetail requireOneByOid(int $oid) Return the first ChildHorticultureproducedetail filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducedetail requireOneByHorticultureproduceparentoid(int $horticultureProduceParentoid) Return the first ChildHorticultureproducedetail filtered by the horticultureProduceParentoid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducedetail requireOneByBrand(string $brand) Return the first ChildHorticultureproducedetail filtered by the brand column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducedetail requireOneByVariety(string $variety) Return the first ChildHorticultureproducedetail filtered by the variety column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducedetail requireOneByDirectplanting(int $directPlanting) Return the first ChildHorticultureproducedetail filtered by the directPlanting column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducedetail requireOneByNurseryduration(int $nurseryDuration) Return the first ChildHorticultureproducedetail filtered by the nurseryDuration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducedetail requireOneByAvgmaturitydays(int $avgMaturityDays) Return the first ChildHorticultureproducedetail filtered by the avgMaturityDays column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducedetail requireOneByHarvestdurationdays(int $harvestDurationDays) Return the first ChildHorticultureproducedetail filtered by the harvestDurationDays column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducedetail requireOneByCreatetmstp(string $createTmstp) Return the first ChildHorticultureproducedetail filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducedetail requireOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticultureproducedetail filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticultureproducedetail[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildHorticultureproducedetail objects based on current ModelCriteria
 * @method     ChildHorticultureproducedetail[]|ObjectCollection findByOid(int $oid) Return ChildHorticultureproducedetail objects filtered by the oid column
 * @method     ChildHorticultureproducedetail[]|ObjectCollection findByHorticultureproduceparentoid(int $horticultureProduceParentoid) Return ChildHorticultureproducedetail objects filtered by the horticultureProduceParentoid column
 * @method     ChildHorticultureproducedetail[]|ObjectCollection findByBrand(string $brand) Return ChildHorticultureproducedetail objects filtered by the brand column
 * @method     ChildHorticultureproducedetail[]|ObjectCollection findByVariety(string $variety) Return ChildHorticultureproducedetail objects filtered by the variety column
 * @method     ChildHorticultureproducedetail[]|ObjectCollection findByDirectplanting(int $directPlanting) Return ChildHorticultureproducedetail objects filtered by the directPlanting column
 * @method     ChildHorticultureproducedetail[]|ObjectCollection findByNurseryduration(int $nurseryDuration) Return ChildHorticultureproducedetail objects filtered by the nurseryDuration column
 * @method     ChildHorticultureproducedetail[]|ObjectCollection findByAvgmaturitydays(int $avgMaturityDays) Return ChildHorticultureproducedetail objects filtered by the avgMaturityDays column
 * @method     ChildHorticultureproducedetail[]|ObjectCollection findByHarvestdurationdays(int $harvestDurationDays) Return ChildHorticultureproducedetail objects filtered by the harvestDurationDays column
 * @method     ChildHorticultureproducedetail[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildHorticultureproducedetail objects filtered by the createTmstp column
 * @method     ChildHorticultureproducedetail[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildHorticultureproducedetail objects filtered by the updtTmstp column
 * @method     ChildHorticultureproducedetail[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HorticultureproducedetailQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\HorticultureproducedetailQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Horticultureproducedetail', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHorticultureproducedetailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHorticultureproducedetailQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildHorticultureproducedetailQuery) {
            return $criteria;
        }
        $query = new ChildHorticultureproducedetailQuery();
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
     * @return ChildHorticultureproducedetail|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HorticultureproducedetailTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HorticultureproducedetailTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHorticultureproducedetail A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, horticultureProduceParentoid, brand, variety, directPlanting, nurseryDuration, avgMaturityDays, harvestDurationDays, createTmstp, updtTmstp FROM horticultureproducedetail WHERE oid = :p0';
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
            /** @var ChildHorticultureproducedetail $obj */
            $obj = new ChildHorticultureproducedetail();
            $obj->hydrate($row);
            HorticultureproducedetailTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHorticultureproducedetail|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HorticultureproducedetailTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HorticultureproducedetailTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducedetailTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the horticultureProduceParentoid column
     *
     * Example usage:
     * <code>
     * $query->filterByHorticultureproduceparentoid(1234); // WHERE horticultureProduceParentoid = 1234
     * $query->filterByHorticultureproduceparentoid(array(12, 34)); // WHERE horticultureProduceParentoid IN (12, 34)
     * $query->filterByHorticultureproduceparentoid(array('min' => 12)); // WHERE horticultureProduceParentoid > 12
     * </code>
     *
     * @see       filterByHorticultureproduceparent()
     *
     * @param     mixed $horticultureproduceparentoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByHorticultureproduceparentoid($horticultureproduceparentoid = null, $comparison = null)
    {
        if (is_array($horticultureproduceparentoid)) {
            $useMinMax = false;
            if (isset($horticultureproduceparentoid['min'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_HORTICULTUREPRODUCEPARENTOID, $horticultureproduceparentoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($horticultureproduceparentoid['max'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_HORTICULTUREPRODUCEPARENTOID, $horticultureproduceparentoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducedetailTableMap::COL_HORTICULTUREPRODUCEPARENTOID, $horticultureproduceparentoid, $comparison);
    }

    /**
     * Filter the query on the brand column
     *
     * Example usage:
     * <code>
     * $query->filterByBrand('fooValue');   // WHERE brand = 'fooValue'
     * $query->filterByBrand('%fooValue%', Criteria::LIKE); // WHERE brand LIKE '%fooValue%'
     * </code>
     *
     * @param     string $brand The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByBrand($brand = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brand)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducedetailTableMap::COL_BRAND, $brand, $comparison);
    }

    /**
     * Filter the query on the variety column
     *
     * Example usage:
     * <code>
     * $query->filterByVariety('fooValue');   // WHERE variety = 'fooValue'
     * $query->filterByVariety('%fooValue%', Criteria::LIKE); // WHERE variety LIKE '%fooValue%'
     * </code>
     *
     * @param     string $variety The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByVariety($variety = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($variety)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducedetailTableMap::COL_VARIETY, $variety, $comparison);
    }

    /**
     * Filter the query on the directPlanting column
     *
     * Example usage:
     * <code>
     * $query->filterByDirectplanting(1234); // WHERE directPlanting = 1234
     * $query->filterByDirectplanting(array(12, 34)); // WHERE directPlanting IN (12, 34)
     * $query->filterByDirectplanting(array('min' => 12)); // WHERE directPlanting > 12
     * </code>
     *
     * @param     mixed $directplanting The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByDirectplanting($directplanting = null, $comparison = null)
    {
        if (is_array($directplanting)) {
            $useMinMax = false;
            if (isset($directplanting['min'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_DIRECTPLANTING, $directplanting['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($directplanting['max'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_DIRECTPLANTING, $directplanting['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducedetailTableMap::COL_DIRECTPLANTING, $directplanting, $comparison);
    }

    /**
     * Filter the query on the nurseryDuration column
     *
     * Example usage:
     * <code>
     * $query->filterByNurseryduration(1234); // WHERE nurseryDuration = 1234
     * $query->filterByNurseryduration(array(12, 34)); // WHERE nurseryDuration IN (12, 34)
     * $query->filterByNurseryduration(array('min' => 12)); // WHERE nurseryDuration > 12
     * </code>
     *
     * @param     mixed $nurseryduration The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByNurseryduration($nurseryduration = null, $comparison = null)
    {
        if (is_array($nurseryduration)) {
            $useMinMax = false;
            if (isset($nurseryduration['min'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_NURSERYDURATION, $nurseryduration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nurseryduration['max'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_NURSERYDURATION, $nurseryduration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducedetailTableMap::COL_NURSERYDURATION, $nurseryduration, $comparison);
    }

    /**
     * Filter the query on the avgMaturityDays column
     *
     * Example usage:
     * <code>
     * $query->filterByAvgmaturitydays(1234); // WHERE avgMaturityDays = 1234
     * $query->filterByAvgmaturitydays(array(12, 34)); // WHERE avgMaturityDays IN (12, 34)
     * $query->filterByAvgmaturitydays(array('min' => 12)); // WHERE avgMaturityDays > 12
     * </code>
     *
     * @param     mixed $avgmaturitydays The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByAvgmaturitydays($avgmaturitydays = null, $comparison = null)
    {
        if (is_array($avgmaturitydays)) {
            $useMinMax = false;
            if (isset($avgmaturitydays['min'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_AVGMATURITYDAYS, $avgmaturitydays['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($avgmaturitydays['max'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_AVGMATURITYDAYS, $avgmaturitydays['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducedetailTableMap::COL_AVGMATURITYDAYS, $avgmaturitydays, $comparison);
    }

    /**
     * Filter the query on the harvestDurationDays column
     *
     * Example usage:
     * <code>
     * $query->filterByHarvestdurationdays(1234); // WHERE harvestDurationDays = 1234
     * $query->filterByHarvestdurationdays(array(12, 34)); // WHERE harvestDurationDays IN (12, 34)
     * $query->filterByHarvestdurationdays(array('min' => 12)); // WHERE harvestDurationDays > 12
     * </code>
     *
     * @param     mixed $harvestdurationdays The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByHarvestdurationdays($harvestdurationdays = null, $comparison = null)
    {
        if (is_array($harvestdurationdays)) {
            $useMinMax = false;
            if (isset($harvestdurationdays['min'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_HARVESTDURATIONDAYS, $harvestdurationdays['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($harvestdurationdays['max'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_HARVESTDURATIONDAYS, $harvestdurationdays['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducedetailTableMap::COL_HARVESTDURATIONDAYS, $harvestdurationdays, $comparison);
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
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducedetailTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(HorticultureproducedetailTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducedetailTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Horticultureproduceparent object
     *
     * @param \lwops\lwops\Horticultureproduceparent|ObjectCollection $horticultureproduceparent The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByHorticultureproduceparent($horticultureproduceparent, $comparison = null)
    {
        if ($horticultureproduceparent instanceof \lwops\lwops\Horticultureproduceparent) {
            return $this
                ->addUsingAlias(HorticultureproducedetailTableMap::COL_HORTICULTUREPRODUCEPARENTOID, $horticultureproduceparent->getOid(), $comparison);
        } elseif ($horticultureproduceparent instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(HorticultureproducedetailTableMap::COL_HORTICULTUREPRODUCEPARENTOID, $horticultureproduceparent->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByHorticultureproduceparent() only accepts arguments of type \lwops\lwops\Horticultureproduceparent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Horticultureproduceparent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function joinHorticultureproduceparent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Horticultureproduceparent');

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
            $this->addJoinObject($join, 'Horticultureproduceparent');
        }

        return $this;
    }

    /**
     * Use the Horticultureproduceparent relation Horticultureproduceparent object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\HorticultureproduceparentQuery A secondary query class using the current class as primary query
     */
    public function useHorticultureproduceparentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHorticultureproduceparent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Horticultureproduceparent', '\lwops\lwops\HorticultureproduceparentQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Horticultureproducebrand object
     *
     * @param \lwops\lwops\Horticultureproducebrand|ObjectCollection $horticultureproducebrand The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByHorticultureproducebrand($horticultureproducebrand, $comparison = null)
    {
        if ($horticultureproducebrand instanceof \lwops\lwops\Horticultureproducebrand) {
            return $this
                ->addUsingAlias(HorticultureproducedetailTableMap::COL_BRAND, $horticultureproducebrand->getName(), $comparison);
        } elseif ($horticultureproducebrand instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(HorticultureproducedetailTableMap::COL_BRAND, $horticultureproducebrand->toKeyValue('PrimaryKey', 'Name'), $comparison);
        } else {
            throw new PropelException('filterByHorticultureproducebrand() only accepts arguments of type \lwops\lwops\Horticultureproducebrand or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Horticultureproducebrand relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function joinHorticultureproducebrand($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Horticultureproducebrand');

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
            $this->addJoinObject($join, 'Horticultureproducebrand');
        }

        return $this;
    }

    /**
     * Use the Horticultureproducebrand relation Horticultureproducebrand object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\HorticultureproducebrandQuery A secondary query class using the current class as primary query
     */
    public function useHorticultureproducebrandQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHorticultureproducebrand($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Horticultureproducebrand', '\lwops\lwops\HorticultureproducebrandQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Horticultureproducebed object
     *
     * @param \lwops\lwops\Horticultureproducebed|ObjectCollection $horticultureproducebed the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByHorticultureproducebed($horticultureproducebed, $comparison = null)
    {
        if ($horticultureproducebed instanceof \lwops\lwops\Horticultureproducebed) {
            return $this
                ->addUsingAlias(HorticultureproducedetailTableMap::COL_OID, $horticultureproducebed->getProducetypeoid(), $comparison);
        } elseif ($horticultureproducebed instanceof ObjectCollection) {
            return $this
                ->useHorticultureproducebedQuery()
                ->filterByPrimaryKeys($horticultureproducebed->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByHorticultureproducebed() only accepts arguments of type \lwops\lwops\Horticultureproducebed or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Horticultureproducebed relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function joinHorticultureproducebed($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Horticultureproducebed');

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
            $this->addJoinObject($join, 'Horticultureproducebed');
        }

        return $this;
    }

    /**
     * Use the Horticultureproducebed relation Horticultureproducebed object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\HorticultureproducebedQuery A secondary query class using the current class as primary query
     */
    public function useHorticultureproducebedQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHorticultureproducebed($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Horticultureproducebed', '\lwops\lwops\HorticultureproducebedQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Horticultureproducestock object
     *
     * @param \lwops\lwops\Horticultureproducestock|ObjectCollection $horticultureproducestock the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function filterByHorticultureproducestock($horticultureproducestock, $comparison = null)
    {
        if ($horticultureproducestock instanceof \lwops\lwops\Horticultureproducestock) {
            return $this
                ->addUsingAlias(HorticultureproducedetailTableMap::COL_OID, $horticultureproducestock->getProducetypeoid(), $comparison);
        } elseif ($horticultureproducestock instanceof ObjectCollection) {
            return $this
                ->useHorticultureproducestockQuery()
                ->filterByPrimaryKeys($horticultureproducestock->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByHorticultureproducestock() only accepts arguments of type \lwops\lwops\Horticultureproducestock or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Horticultureproducestock relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function joinHorticultureproducestock($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Horticultureproducestock');

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
            $this->addJoinObject($join, 'Horticultureproducestock');
        }

        return $this;
    }

    /**
     * Use the Horticultureproducestock relation Horticultureproducestock object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\HorticultureproducestockQuery A secondary query class using the current class as primary query
     */
    public function useHorticultureproducestockQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHorticultureproducestock($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Horticultureproducestock', '\lwops\lwops\HorticultureproducestockQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildHorticultureproducedetail $horticultureproducedetail Object to remove from the list of results
     *
     * @return $this|ChildHorticultureproducedetailQuery The current query, for fluid interface
     */
    public function prune($horticultureproducedetail = null)
    {
        if ($horticultureproducedetail) {
            $this->addUsingAlias(HorticultureproducedetailTableMap::COL_OID, $horticultureproducedetail->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the horticultureproducedetail table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducedetailTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HorticultureproducedetailTableMap::clearInstancePool();
            HorticultureproducedetailTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducedetailTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HorticultureproducedetailTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HorticultureproducedetailTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HorticultureproducedetailTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // HorticultureproducedetailQuery
