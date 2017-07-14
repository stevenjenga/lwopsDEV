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
use lwops\lwops\Horticultureproducebed as ChildHorticultureproducebed;
use lwops\lwops\HorticultureproducebedQuery as ChildHorticultureproducebedQuery;
use lwops\lwops\Map\HorticultureproducebedTableMap;

/**
 * Base class that represents a query for the 'horticultureproducebed' table.
 *
 *
 *
 * @method     ChildHorticultureproducebedQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildHorticultureproducebedQuery orderByProducetypeoid($order = Criteria::ASC) Order by the produceTypeOid column
 * @method     ChildHorticultureproducebedQuery orderByBedoid($order = Criteria::ASC) Order by the bedOid column
 * @method     ChildHorticultureproducebedQuery orderByPlanteddt($order = Criteria::ASC) Order by the plantedDt column
 * @method     ChildHorticultureproducebedQuery orderByHarvestdt($order = Criteria::ASC) Order by the harvestDt column
 * @method     ChildHorticultureproducebedQuery orderByEnddt($order = Criteria::ASC) Order by the endDt column
 * @method     ChildHorticultureproducebedQuery orderByGanttparentoid($order = Criteria::ASC) Order by the ganttParentOid column
 * @method     ChildHorticultureproducebedQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method     ChildHorticultureproducebedQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildHorticultureproducebedQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildHorticultureproducebedQuery groupByOid() Group by the oid column
 * @method     ChildHorticultureproducebedQuery groupByProducetypeoid() Group by the produceTypeOid column
 * @method     ChildHorticultureproducebedQuery groupByBedoid() Group by the bedOid column
 * @method     ChildHorticultureproducebedQuery groupByPlanteddt() Group by the plantedDt column
 * @method     ChildHorticultureproducebedQuery groupByHarvestdt() Group by the harvestDt column
 * @method     ChildHorticultureproducebedQuery groupByEnddt() Group by the endDt column
 * @method     ChildHorticultureproducebedQuery groupByGanttparentoid() Group by the ganttParentOid column
 * @method     ChildHorticultureproducebedQuery groupByNotes() Group by the notes column
 * @method     ChildHorticultureproducebedQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildHorticultureproducebedQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildHorticultureproducebedQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHorticultureproducebedQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHorticultureproducebedQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHorticultureproducebedQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHorticultureproducebedQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHorticultureproducebedQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHorticultureproducebedQuery leftJoinHorticultureproducedetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproducebedQuery rightJoinHorticultureproducedetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproducebedQuery innerJoinHorticultureproducedetail($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticultureproducedetail relation
 *
 * @method     ChildHorticultureproducebedQuery joinWithHorticultureproducedetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticultureproducedetail relation
 *
 * @method     ChildHorticultureproducebedQuery leftJoinWithHorticultureproducedetail() Adds a LEFT JOIN clause and with to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproducebedQuery rightJoinWithHorticultureproducedetail() Adds a RIGHT JOIN clause and with to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproducebedQuery innerJoinWithHorticultureproducedetail() Adds a INNER JOIN clause and with to the query using the Horticultureproducedetail relation
 *
 * @method     ChildHorticultureproducebedQuery leftJoinHorticulturebed($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticulturebed relation
 * @method     ChildHorticultureproducebedQuery rightJoinHorticulturebed($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticulturebed relation
 * @method     ChildHorticultureproducebedQuery innerJoinHorticulturebed($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticulturebed relation
 *
 * @method     ChildHorticultureproducebedQuery joinWithHorticulturebed($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticulturebed relation
 *
 * @method     ChildHorticultureproducebedQuery leftJoinWithHorticulturebed() Adds a LEFT JOIN clause and with to the query using the Horticulturebed relation
 * @method     ChildHorticultureproducebedQuery rightJoinWithHorticulturebed() Adds a RIGHT JOIN clause and with to the query using the Horticulturebed relation
 * @method     ChildHorticultureproducebedQuery innerJoinWithHorticulturebed() Adds a INNER JOIN clause and with to the query using the Horticulturebed relation
 *
 * @method     \lwops\lwops\HorticultureproducedetailQuery|\lwops\lwops\HorticulturebedQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHorticultureproducebed findOne(ConnectionInterface $con = null) Return the first ChildHorticultureproducebed matching the query
 * @method     ChildHorticultureproducebed findOneOrCreate(ConnectionInterface $con = null) Return the first ChildHorticultureproducebed matching the query, or a new ChildHorticultureproducebed object populated from the query conditions when no match is found
 *
 * @method     ChildHorticultureproducebed findOneByOid(int $oid) Return the first ChildHorticultureproducebed filtered by the oid column
 * @method     ChildHorticultureproducebed findOneByProducetypeoid(int $produceTypeOid) Return the first ChildHorticultureproducebed filtered by the produceTypeOid column
 * @method     ChildHorticultureproducebed findOneByBedoid(int $bedOid) Return the first ChildHorticultureproducebed filtered by the bedOid column
 * @method     ChildHorticultureproducebed findOneByPlanteddt(string $plantedDt) Return the first ChildHorticultureproducebed filtered by the plantedDt column
 * @method     ChildHorticultureproducebed findOneByHarvestdt(string $harvestDt) Return the first ChildHorticultureproducebed filtered by the harvestDt column
 * @method     ChildHorticultureproducebed findOneByEnddt(string $endDt) Return the first ChildHorticultureproducebed filtered by the endDt column
 * @method     ChildHorticultureproducebed findOneByGanttparentoid(int $ganttParentOid) Return the first ChildHorticultureproducebed filtered by the ganttParentOid column
 * @method     ChildHorticultureproducebed findOneByNotes(string $notes) Return the first ChildHorticultureproducebed filtered by the notes column
 * @method     ChildHorticultureproducebed findOneByCreatetmstp(string $createTmstp) Return the first ChildHorticultureproducebed filtered by the createTmstp column
 * @method     ChildHorticultureproducebed findOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticultureproducebed filtered by the updtTmstp column *

 * @method     ChildHorticultureproducebed requirePk($key, ConnectionInterface $con = null) Return the ChildHorticultureproducebed by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducebed requireOne(ConnectionInterface $con = null) Return the first ChildHorticultureproducebed matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticultureproducebed requireOneByOid(int $oid) Return the first ChildHorticultureproducebed filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducebed requireOneByProducetypeoid(int $produceTypeOid) Return the first ChildHorticultureproducebed filtered by the produceTypeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducebed requireOneByBedoid(int $bedOid) Return the first ChildHorticultureproducebed filtered by the bedOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducebed requireOneByPlanteddt(string $plantedDt) Return the first ChildHorticultureproducebed filtered by the plantedDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducebed requireOneByHarvestdt(string $harvestDt) Return the first ChildHorticultureproducebed filtered by the harvestDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducebed requireOneByEnddt(string $endDt) Return the first ChildHorticultureproducebed filtered by the endDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducebed requireOneByGanttparentoid(int $ganttParentOid) Return the first ChildHorticultureproducebed filtered by the ganttParentOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducebed requireOneByNotes(string $notes) Return the first ChildHorticultureproducebed filtered by the notes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducebed requireOneByCreatetmstp(string $createTmstp) Return the first ChildHorticultureproducebed filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducebed requireOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticultureproducebed filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticultureproducebed[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildHorticultureproducebed objects based on current ModelCriteria
 * @method     ChildHorticultureproducebed[]|ObjectCollection findByOid(int $oid) Return ChildHorticultureproducebed objects filtered by the oid column
 * @method     ChildHorticultureproducebed[]|ObjectCollection findByProducetypeoid(int $produceTypeOid) Return ChildHorticultureproducebed objects filtered by the produceTypeOid column
 * @method     ChildHorticultureproducebed[]|ObjectCollection findByBedoid(int $bedOid) Return ChildHorticultureproducebed objects filtered by the bedOid column
 * @method     ChildHorticultureproducebed[]|ObjectCollection findByPlanteddt(string $plantedDt) Return ChildHorticultureproducebed objects filtered by the plantedDt column
 * @method     ChildHorticultureproducebed[]|ObjectCollection findByHarvestdt(string $harvestDt) Return ChildHorticultureproducebed objects filtered by the harvestDt column
 * @method     ChildHorticultureproducebed[]|ObjectCollection findByEnddt(string $endDt) Return ChildHorticultureproducebed objects filtered by the endDt column
 * @method     ChildHorticultureproducebed[]|ObjectCollection findByGanttparentoid(int $ganttParentOid) Return ChildHorticultureproducebed objects filtered by the ganttParentOid column
 * @method     ChildHorticultureproducebed[]|ObjectCollection findByNotes(string $notes) Return ChildHorticultureproducebed objects filtered by the notes column
 * @method     ChildHorticultureproducebed[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildHorticultureproducebed objects filtered by the createTmstp column
 * @method     ChildHorticultureproducebed[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildHorticultureproducebed objects filtered by the updtTmstp column
 * @method     ChildHorticultureproducebed[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HorticultureproducebedQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\HorticultureproducebedQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Horticultureproducebed', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHorticultureproducebedQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHorticultureproducebedQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildHorticultureproducebedQuery) {
            return $criteria;
        }
        $query = new ChildHorticultureproducebedQuery();
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
     * @return ChildHorticultureproducebed|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HorticultureproducebedTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HorticultureproducebedTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHorticultureproducebed A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, produceTypeOid, bedOid, plantedDt, harvestDt, endDt, ganttParentOid, notes, createTmstp, updtTmstp FROM horticultureproducebed WHERE oid = :p0';
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
            /** @var ChildHorticultureproducebed $obj */
            $obj = new ChildHorticultureproducebed();
            $obj->hydrate($row);
            HorticultureproducebedTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHorticultureproducebed|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HorticultureproducebedTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HorticultureproducebedTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducebedTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the produceTypeOid column
     *
     * Example usage:
     * <code>
     * $query->filterByProducetypeoid(1234); // WHERE produceTypeOid = 1234
     * $query->filterByProducetypeoid(array(12, 34)); // WHERE produceTypeOid IN (12, 34)
     * $query->filterByProducetypeoid(array('min' => 12)); // WHERE produceTypeOid > 12
     * </code>
     *
     * @see       filterByHorticultureproducedetail()
     *
     * @param     mixed $producetypeoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function filterByProducetypeoid($producetypeoid = null, $comparison = null)
    {
        if (is_array($producetypeoid)) {
            $useMinMax = false;
            if (isset($producetypeoid['min'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_PRODUCETYPEOID, $producetypeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($producetypeoid['max'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_PRODUCETYPEOID, $producetypeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducebedTableMap::COL_PRODUCETYPEOID, $producetypeoid, $comparison);
    }

    /**
     * Filter the query on the bedOid column
     *
     * Example usage:
     * <code>
     * $query->filterByBedoid(1234); // WHERE bedOid = 1234
     * $query->filterByBedoid(array(12, 34)); // WHERE bedOid IN (12, 34)
     * $query->filterByBedoid(array('min' => 12)); // WHERE bedOid > 12
     * </code>
     *
     * @see       filterByHorticulturebed()
     *
     * @param     mixed $bedoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function filterByBedoid($bedoid = null, $comparison = null)
    {
        if (is_array($bedoid)) {
            $useMinMax = false;
            if (isset($bedoid['min'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_BEDOID, $bedoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bedoid['max'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_BEDOID, $bedoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducebedTableMap::COL_BEDOID, $bedoid, $comparison);
    }

    /**
     * Filter the query on the plantedDt column
     *
     * Example usage:
     * <code>
     * $query->filterByPlanteddt('2011-03-14'); // WHERE plantedDt = '2011-03-14'
     * $query->filterByPlanteddt('now'); // WHERE plantedDt = '2011-03-14'
     * $query->filterByPlanteddt(array('max' => 'yesterday')); // WHERE plantedDt > '2011-03-13'
     * </code>
     *
     * @param     mixed $planteddt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function filterByPlanteddt($planteddt = null, $comparison = null)
    {
        if (is_array($planteddt)) {
            $useMinMax = false;
            if (isset($planteddt['min'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_PLANTEDDT, $planteddt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($planteddt['max'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_PLANTEDDT, $planteddt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducebedTableMap::COL_PLANTEDDT, $planteddt, $comparison);
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
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function filterByHarvestdt($harvestdt = null, $comparison = null)
    {
        if (is_array($harvestdt)) {
            $useMinMax = false;
            if (isset($harvestdt['min'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_HARVESTDT, $harvestdt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($harvestdt['max'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_HARVESTDT, $harvestdt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducebedTableMap::COL_HARVESTDT, $harvestdt, $comparison);
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
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function filterByEnddt($enddt = null, $comparison = null)
    {
        if (is_array($enddt)) {
            $useMinMax = false;
            if (isset($enddt['min'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_ENDDT, $enddt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($enddt['max'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_ENDDT, $enddt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducebedTableMap::COL_ENDDT, $enddt, $comparison);
    }

    /**
     * Filter the query on the ganttParentOid column
     *
     * Example usage:
     * <code>
     * $query->filterByGanttparentoid(1234); // WHERE ganttParentOid = 1234
     * $query->filterByGanttparentoid(array(12, 34)); // WHERE ganttParentOid IN (12, 34)
     * $query->filterByGanttparentoid(array('min' => 12)); // WHERE ganttParentOid > 12
     * </code>
     *
     * @param     mixed $ganttparentoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function filterByGanttparentoid($ganttparentoid = null, $comparison = null)
    {
        if (is_array($ganttparentoid)) {
            $useMinMax = false;
            if (isset($ganttparentoid['min'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_GANTTPARENTOID, $ganttparentoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ganttparentoid['max'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_GANTTPARENTOID, $ganttparentoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducebedTableMap::COL_GANTTPARENTOID, $ganttparentoid, $comparison);
    }

    /**
     * Filter the query on the notes column
     *
     * Example usage:
     * <code>
     * $query->filterByNotes('fooValue');   // WHERE notes = 'fooValue'
     * $query->filterByNotes('%fooValue%', Criteria::LIKE); // WHERE notes LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notes The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function filterByNotes($notes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notes)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducebedTableMap::COL_NOTES, $notes, $comparison);
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
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducebedTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(HorticultureproducebedTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducebedTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Horticultureproducedetail object
     *
     * @param \lwops\lwops\Horticultureproducedetail|ObjectCollection $horticultureproducedetail The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function filterByHorticultureproducedetail($horticultureproducedetail, $comparison = null)
    {
        if ($horticultureproducedetail instanceof \lwops\lwops\Horticultureproducedetail) {
            return $this
                ->addUsingAlias(HorticultureproducebedTableMap::COL_PRODUCETYPEOID, $horticultureproducedetail->getOid(), $comparison);
        } elseif ($horticultureproducedetail instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(HorticultureproducebedTableMap::COL_PRODUCETYPEOID, $horticultureproducedetail->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Horticulturebed object
     *
     * @param \lwops\lwops\Horticulturebed|ObjectCollection $horticulturebed The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function filterByHorticulturebed($horticulturebed, $comparison = null)
    {
        if ($horticulturebed instanceof \lwops\lwops\Horticulturebed) {
            return $this
                ->addUsingAlias(HorticultureproducebedTableMap::COL_BEDOID, $horticulturebed->getOid(), $comparison);
        } elseif ($horticulturebed instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(HorticultureproducebedTableMap::COL_BEDOID, $horticulturebed->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByHorticulturebed() only accepts arguments of type \lwops\lwops\Horticulturebed or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Horticulturebed relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function joinHorticulturebed($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Horticulturebed');

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
            $this->addJoinObject($join, 'Horticulturebed');
        }

        return $this;
    }

    /**
     * Use the Horticulturebed relation Horticulturebed object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\HorticulturebedQuery A secondary query class using the current class as primary query
     */
    public function useHorticulturebedQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHorticulturebed($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Horticulturebed', '\lwops\lwops\HorticulturebedQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildHorticultureproducebed $horticultureproducebed Object to remove from the list of results
     *
     * @return $this|ChildHorticultureproducebedQuery The current query, for fluid interface
     */
    public function prune($horticultureproducebed = null)
    {
        if ($horticultureproducebed) {
            $this->addUsingAlias(HorticultureproducebedTableMap::COL_OID, $horticultureproducebed->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the horticultureproducebed table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducebedTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HorticultureproducebedTableMap::clearInstancePool();
            HorticultureproducebedTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducebedTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HorticultureproducebedTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HorticultureproducebedTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HorticultureproducebedTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // HorticultureproducebedQuery
