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
use lwops\lwops\Horticultureproducestock as ChildHorticultureproducestock;
use lwops\lwops\HorticultureproducestockQuery as ChildHorticultureproducestockQuery;
use lwops\lwops\Map\HorticultureproducestockTableMap;

/**
 * Base class that represents a query for the 'horticultureproducestock' table.
 *
 *
 *
 * @method     ChildHorticultureproducestockQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildHorticultureproducestockQuery orderByProducetypeoid($order = Criteria::ASC) Order by the produceTypeOid column
 * @method     ChildHorticultureproducestockQuery orderByStockdate($order = Criteria::ASC) Order by the stockDate column
 * @method     ChildHorticultureproducestockQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildHorticultureproducestockQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildHorticultureproducestockQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildHorticultureproducestockQuery groupByOid() Group by the oid column
 * @method     ChildHorticultureproducestockQuery groupByProducetypeoid() Group by the produceTypeOid column
 * @method     ChildHorticultureproducestockQuery groupByStockdate() Group by the stockDate column
 * @method     ChildHorticultureproducestockQuery groupByQty() Group by the qty column
 * @method     ChildHorticultureproducestockQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildHorticultureproducestockQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildHorticultureproducestockQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHorticultureproducestockQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHorticultureproducestockQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHorticultureproducestockQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHorticultureproducestockQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHorticultureproducestockQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHorticultureproducestockQuery leftJoinHorticultureproducedetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproducestockQuery rightJoinHorticultureproducedetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproducestockQuery innerJoinHorticultureproducedetail($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticultureproducedetail relation
 *
 * @method     ChildHorticultureproducestockQuery joinWithHorticultureproducedetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticultureproducedetail relation
 *
 * @method     ChildHorticultureproducestockQuery leftJoinWithHorticultureproducedetail() Adds a LEFT JOIN clause and with to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproducestockQuery rightJoinWithHorticultureproducedetail() Adds a RIGHT JOIN clause and with to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproducestockQuery innerJoinWithHorticultureproducedetail() Adds a INNER JOIN clause and with to the query using the Horticultureproducedetail relation
 *
 * @method     \lwops\lwops\HorticultureproducedetailQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHorticultureproducestock findOne(ConnectionInterface $con = null) Return the first ChildHorticultureproducestock matching the query
 * @method     ChildHorticultureproducestock findOneOrCreate(ConnectionInterface $con = null) Return the first ChildHorticultureproducestock matching the query, or a new ChildHorticultureproducestock object populated from the query conditions when no match is found
 *
 * @method     ChildHorticultureproducestock findOneByOid(int $oid) Return the first ChildHorticultureproducestock filtered by the oid column
 * @method     ChildHorticultureproducestock findOneByProducetypeoid(int $produceTypeOid) Return the first ChildHorticultureproducestock filtered by the produceTypeOid column
 * @method     ChildHorticultureproducestock findOneByStockdate(string $stockDate) Return the first ChildHorticultureproducestock filtered by the stockDate column
 * @method     ChildHorticultureproducestock findOneByQty(double $qty) Return the first ChildHorticultureproducestock filtered by the qty column
 * @method     ChildHorticultureproducestock findOneByCreatetmstp(string $createTmstp) Return the first ChildHorticultureproducestock filtered by the createTmstp column
 * @method     ChildHorticultureproducestock findOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticultureproducestock filtered by the updtTmstp column *

 * @method     ChildHorticultureproducestock requirePk($key, ConnectionInterface $con = null) Return the ChildHorticultureproducestock by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducestock requireOne(ConnectionInterface $con = null) Return the first ChildHorticultureproducestock matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticultureproducestock requireOneByOid(int $oid) Return the first ChildHorticultureproducestock filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducestock requireOneByProducetypeoid(int $produceTypeOid) Return the first ChildHorticultureproducestock filtered by the produceTypeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducestock requireOneByStockdate(string $stockDate) Return the first ChildHorticultureproducestock filtered by the stockDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducestock requireOneByQty(double $qty) Return the first ChildHorticultureproducestock filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducestock requireOneByCreatetmstp(string $createTmstp) Return the first ChildHorticultureproducestock filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproducestock requireOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticultureproducestock filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticultureproducestock[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildHorticultureproducestock objects based on current ModelCriteria
 * @method     ChildHorticultureproducestock[]|ObjectCollection findByOid(int $oid) Return ChildHorticultureproducestock objects filtered by the oid column
 * @method     ChildHorticultureproducestock[]|ObjectCollection findByProducetypeoid(int $produceTypeOid) Return ChildHorticultureproducestock objects filtered by the produceTypeOid column
 * @method     ChildHorticultureproducestock[]|ObjectCollection findByStockdate(string $stockDate) Return ChildHorticultureproducestock objects filtered by the stockDate column
 * @method     ChildHorticultureproducestock[]|ObjectCollection findByQty(double $qty) Return ChildHorticultureproducestock objects filtered by the qty column
 * @method     ChildHorticultureproducestock[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildHorticultureproducestock objects filtered by the createTmstp column
 * @method     ChildHorticultureproducestock[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildHorticultureproducestock objects filtered by the updtTmstp column
 * @method     ChildHorticultureproducestock[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HorticultureproducestockQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\HorticultureproducestockQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Horticultureproducestock', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHorticultureproducestockQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHorticultureproducestockQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildHorticultureproducestockQuery) {
            return $criteria;
        }
        $query = new ChildHorticultureproducestockQuery();
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
     * @return ChildHorticultureproducestock|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HorticultureproducestockTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HorticultureproducestockTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHorticultureproducestock A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, produceTypeOid, stockDate, qty, createTmstp, updtTmstp FROM horticultureproducestock WHERE oid = :p0';
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
            /** @var ChildHorticultureproducestock $obj */
            $obj = new ChildHorticultureproducestock();
            $obj->hydrate($row);
            HorticultureproducestockTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHorticultureproducestock|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildHorticultureproducestockQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HorticultureproducestockTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildHorticultureproducestockQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HorticultureproducestockTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildHorticultureproducestockQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(HorticultureproducestockTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(HorticultureproducestockTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducestockTableMap::COL_OID, $oid, $comparison);
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
     * @return $this|ChildHorticultureproducestockQuery The current query, for fluid interface
     */
    public function filterByProducetypeoid($producetypeoid = null, $comparison = null)
    {
        if (is_array($producetypeoid)) {
            $useMinMax = false;
            if (isset($producetypeoid['min'])) {
                $this->addUsingAlias(HorticultureproducestockTableMap::COL_PRODUCETYPEOID, $producetypeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($producetypeoid['max'])) {
                $this->addUsingAlias(HorticultureproducestockTableMap::COL_PRODUCETYPEOID, $producetypeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducestockTableMap::COL_PRODUCETYPEOID, $producetypeoid, $comparison);
    }

    /**
     * Filter the query on the stockDate column
     *
     * Example usage:
     * <code>
     * $query->filterByStockdate('2011-03-14'); // WHERE stockDate = '2011-03-14'
     * $query->filterByStockdate('now'); // WHERE stockDate = '2011-03-14'
     * $query->filterByStockdate(array('max' => 'yesterday')); // WHERE stockDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $stockdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducestockQuery The current query, for fluid interface
     */
    public function filterByStockdate($stockdate = null, $comparison = null)
    {
        if (is_array($stockdate)) {
            $useMinMax = false;
            if (isset($stockdate['min'])) {
                $this->addUsingAlias(HorticultureproducestockTableMap::COL_STOCKDATE, $stockdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stockdate['max'])) {
                $this->addUsingAlias(HorticultureproducestockTableMap::COL_STOCKDATE, $stockdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducestockTableMap::COL_STOCKDATE, $stockdate, $comparison);
    }

    /**
     * Filter the query on the qty column
     *
     * Example usage:
     * <code>
     * $query->filterByQty(1234); // WHERE qty = 1234
     * $query->filterByQty(array(12, 34)); // WHERE qty IN (12, 34)
     * $query->filterByQty(array('min' => 12)); // WHERE qty > 12
     * </code>
     *
     * @param     mixed $qty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproducestockQuery The current query, for fluid interface
     */
    public function filterByQty($qty = null, $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(HorticultureproducestockTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(HorticultureproducestockTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducestockTableMap::COL_QTY, $qty, $comparison);
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
     * @return $this|ChildHorticultureproducestockQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(HorticultureproducestockTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(HorticultureproducestockTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducestockTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildHorticultureproducestockQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(HorticultureproducestockTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(HorticultureproducestockTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproducestockTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Horticultureproducedetail object
     *
     * @param \lwops\lwops\Horticultureproducedetail|ObjectCollection $horticultureproducedetail The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHorticultureproducestockQuery The current query, for fluid interface
     */
    public function filterByHorticultureproducedetail($horticultureproducedetail, $comparison = null)
    {
        if ($horticultureproducedetail instanceof \lwops\lwops\Horticultureproducedetail) {
            return $this
                ->addUsingAlias(HorticultureproducestockTableMap::COL_PRODUCETYPEOID, $horticultureproducedetail->getOid(), $comparison);
        } elseif ($horticultureproducedetail instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(HorticultureproducestockTableMap::COL_PRODUCETYPEOID, $horticultureproducedetail->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildHorticultureproducestockQuery The current query, for fluid interface
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
     * @param   ChildHorticultureproducestock $horticultureproducestock Object to remove from the list of results
     *
     * @return $this|ChildHorticultureproducestockQuery The current query, for fluid interface
     */
    public function prune($horticultureproducestock = null)
    {
        if ($horticultureproducestock) {
            $this->addUsingAlias(HorticultureproducestockTableMap::COL_OID, $horticultureproducestock->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the horticultureproducestock table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducestockTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HorticultureproducestockTableMap::clearInstancePool();
            HorticultureproducestockTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducestockTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HorticultureproducestockTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HorticultureproducestockTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HorticultureproducestockTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // HorticultureproducestockQuery
