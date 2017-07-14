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
use lwops\lwops\Kiambaadairy as ChildKiambaadairy;
use lwops\lwops\KiambaadairyQuery as ChildKiambaadairyQuery;
use lwops\lwops\Map\KiambaadairyTableMap;

/**
 * Base class that represents a query for the 'kiambaadairy' table.
 *
 *
 *
 * @method     ChildKiambaadairyQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildKiambaadairyQuery orderByOpsmonthlycalendaoid($order = Criteria::ASC) Order by the opsMonthlyCalendaOid column
 * @method     ChildKiambaadairyQuery orderBySocietyshares($order = Criteria::ASC) Order by the societyShares column
 * @method     ChildKiambaadairyQuery orderByPackingshares($order = Criteria::ASC) Order by the packingShares column
 * @method     ChildKiambaadairyQuery orderByFeedexpense($order = Criteria::ASC) Order by the feedExpense column
 * @method     ChildKiambaadairyQuery orderByTotaldeductions($order = Criteria::ASC) Order by the totalDeductions column
 * @method     ChildKiambaadairyQuery orderByRate($order = Criteria::ASC) Order by the rate column
 * @method     ChildKiambaadairyQuery orderByDeliveredqty($order = Criteria::ASC) Order by the deliveredQty column
 * @method     ChildKiambaadairyQuery orderByRejectedqty($order = Criteria::ASC) Order by the rejectedQty column
 * @method     ChildKiambaadairyQuery orderByAcceptedqty($order = Criteria::ASC) Order by the acceptedQty column
 * @method     ChildKiambaadairyQuery orderByGrosspay($order = Criteria::ASC) Order by the grossPay column
 * @method     ChildKiambaadairyQuery orderByNetpay($order = Criteria::ASC) Order by the netPay column
 * @method     ChildKiambaadairyQuery orderBySociety($order = Criteria::ASC) Order by the society column
 * @method     ChildKiambaadairyQuery orderByPacking($order = Criteria::ASC) Order by the packing column
 * @method     ChildKiambaadairyQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildKiambaadairyQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildKiambaadairyQuery groupByOid() Group by the oid column
 * @method     ChildKiambaadairyQuery groupByOpsmonthlycalendaoid() Group by the opsMonthlyCalendaOid column
 * @method     ChildKiambaadairyQuery groupBySocietyshares() Group by the societyShares column
 * @method     ChildKiambaadairyQuery groupByPackingshares() Group by the packingShares column
 * @method     ChildKiambaadairyQuery groupByFeedexpense() Group by the feedExpense column
 * @method     ChildKiambaadairyQuery groupByTotaldeductions() Group by the totalDeductions column
 * @method     ChildKiambaadairyQuery groupByRate() Group by the rate column
 * @method     ChildKiambaadairyQuery groupByDeliveredqty() Group by the deliveredQty column
 * @method     ChildKiambaadairyQuery groupByRejectedqty() Group by the rejectedQty column
 * @method     ChildKiambaadairyQuery groupByAcceptedqty() Group by the acceptedQty column
 * @method     ChildKiambaadairyQuery groupByGrosspay() Group by the grossPay column
 * @method     ChildKiambaadairyQuery groupByNetpay() Group by the netPay column
 * @method     ChildKiambaadairyQuery groupBySociety() Group by the society column
 * @method     ChildKiambaadairyQuery groupByPacking() Group by the packing column
 * @method     ChildKiambaadairyQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildKiambaadairyQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildKiambaadairyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildKiambaadairyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildKiambaadairyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildKiambaadairyQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildKiambaadairyQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildKiambaadairyQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildKiambaadairyQuery leftJoinOpsmonthlycalendar($relationAlias = null) Adds a LEFT JOIN clause to the query using the Opsmonthlycalendar relation
 * @method     ChildKiambaadairyQuery rightJoinOpsmonthlycalendar($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Opsmonthlycalendar relation
 * @method     ChildKiambaadairyQuery innerJoinOpsmonthlycalendar($relationAlias = null) Adds a INNER JOIN clause to the query using the Opsmonthlycalendar relation
 *
 * @method     ChildKiambaadairyQuery joinWithOpsmonthlycalendar($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Opsmonthlycalendar relation
 *
 * @method     ChildKiambaadairyQuery leftJoinWithOpsmonthlycalendar() Adds a LEFT JOIN clause and with to the query using the Opsmonthlycalendar relation
 * @method     ChildKiambaadairyQuery rightJoinWithOpsmonthlycalendar() Adds a RIGHT JOIN clause and with to the query using the Opsmonthlycalendar relation
 * @method     ChildKiambaadairyQuery innerJoinWithOpsmonthlycalendar() Adds a INNER JOIN clause and with to the query using the Opsmonthlycalendar relation
 *
 * @method     \lwops\lwops\OpsmonthlycalendarQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildKiambaadairy findOne(ConnectionInterface $con = null) Return the first ChildKiambaadairy matching the query
 * @method     ChildKiambaadairy findOneOrCreate(ConnectionInterface $con = null) Return the first ChildKiambaadairy matching the query, or a new ChildKiambaadairy object populated from the query conditions when no match is found
 *
 * @method     ChildKiambaadairy findOneByOid(int $oid) Return the first ChildKiambaadairy filtered by the oid column
 * @method     ChildKiambaadairy findOneByOpsmonthlycalendaoid(int $opsMonthlyCalendaOid) Return the first ChildKiambaadairy filtered by the opsMonthlyCalendaOid column
 * @method     ChildKiambaadairy findOneBySocietyshares(double $societyShares) Return the first ChildKiambaadairy filtered by the societyShares column
 * @method     ChildKiambaadairy findOneByPackingshares(double $packingShares) Return the first ChildKiambaadairy filtered by the packingShares column
 * @method     ChildKiambaadairy findOneByFeedexpense(double $feedExpense) Return the first ChildKiambaadairy filtered by the feedExpense column
 * @method     ChildKiambaadairy findOneByTotaldeductions(double $totalDeductions) Return the first ChildKiambaadairy filtered by the totalDeductions column
 * @method     ChildKiambaadairy findOneByRate(double $rate) Return the first ChildKiambaadairy filtered by the rate column
 * @method     ChildKiambaadairy findOneByDeliveredqty(double $deliveredQty) Return the first ChildKiambaadairy filtered by the deliveredQty column
 * @method     ChildKiambaadairy findOneByRejectedqty(double $rejectedQty) Return the first ChildKiambaadairy filtered by the rejectedQty column
 * @method     ChildKiambaadairy findOneByAcceptedqty(double $acceptedQty) Return the first ChildKiambaadairy filtered by the acceptedQty column
 * @method     ChildKiambaadairy findOneByGrosspay(double $grossPay) Return the first ChildKiambaadairy filtered by the grossPay column
 * @method     ChildKiambaadairy findOneByNetpay(double $netPay) Return the first ChildKiambaadairy filtered by the netPay column
 * @method     ChildKiambaadairy findOneBySociety(int $society) Return the first ChildKiambaadairy filtered by the society column
 * @method     ChildKiambaadairy findOneByPacking(int $packing) Return the first ChildKiambaadairy filtered by the packing column
 * @method     ChildKiambaadairy findOneByCreatetmstp(string $createTmstp) Return the first ChildKiambaadairy filtered by the createTmstp column
 * @method     ChildKiambaadairy findOneByUpdttmstp(string $updtTmstp) Return the first ChildKiambaadairy filtered by the updtTmstp column *

 * @method     ChildKiambaadairy requirePk($key, ConnectionInterface $con = null) Return the ChildKiambaadairy by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOne(ConnectionInterface $con = null) Return the first ChildKiambaadairy matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildKiambaadairy requireOneByOid(int $oid) Return the first ChildKiambaadairy filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneByOpsmonthlycalendaoid(int $opsMonthlyCalendaOid) Return the first ChildKiambaadairy filtered by the opsMonthlyCalendaOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneBySocietyshares(double $societyShares) Return the first ChildKiambaadairy filtered by the societyShares column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneByPackingshares(double $packingShares) Return the first ChildKiambaadairy filtered by the packingShares column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneByFeedexpense(double $feedExpense) Return the first ChildKiambaadairy filtered by the feedExpense column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneByTotaldeductions(double $totalDeductions) Return the first ChildKiambaadairy filtered by the totalDeductions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneByRate(double $rate) Return the first ChildKiambaadairy filtered by the rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneByDeliveredqty(double $deliveredQty) Return the first ChildKiambaadairy filtered by the deliveredQty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneByRejectedqty(double $rejectedQty) Return the first ChildKiambaadairy filtered by the rejectedQty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneByAcceptedqty(double $acceptedQty) Return the first ChildKiambaadairy filtered by the acceptedQty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneByGrosspay(double $grossPay) Return the first ChildKiambaadairy filtered by the grossPay column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneByNetpay(double $netPay) Return the first ChildKiambaadairy filtered by the netPay column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneBySociety(int $society) Return the first ChildKiambaadairy filtered by the society column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneByPacking(int $packing) Return the first ChildKiambaadairy filtered by the packing column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneByCreatetmstp(string $createTmstp) Return the first ChildKiambaadairy filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKiambaadairy requireOneByUpdttmstp(string $updtTmstp) Return the first ChildKiambaadairy filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildKiambaadairy[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildKiambaadairy objects based on current ModelCriteria
 * @method     ChildKiambaadairy[]|ObjectCollection findByOid(int $oid) Return ChildKiambaadairy objects filtered by the oid column
 * @method     ChildKiambaadairy[]|ObjectCollection findByOpsmonthlycalendaoid(int $opsMonthlyCalendaOid) Return ChildKiambaadairy objects filtered by the opsMonthlyCalendaOid column
 * @method     ChildKiambaadairy[]|ObjectCollection findBySocietyshares(double $societyShares) Return ChildKiambaadairy objects filtered by the societyShares column
 * @method     ChildKiambaadairy[]|ObjectCollection findByPackingshares(double $packingShares) Return ChildKiambaadairy objects filtered by the packingShares column
 * @method     ChildKiambaadairy[]|ObjectCollection findByFeedexpense(double $feedExpense) Return ChildKiambaadairy objects filtered by the feedExpense column
 * @method     ChildKiambaadairy[]|ObjectCollection findByTotaldeductions(double $totalDeductions) Return ChildKiambaadairy objects filtered by the totalDeductions column
 * @method     ChildKiambaadairy[]|ObjectCollection findByRate(double $rate) Return ChildKiambaadairy objects filtered by the rate column
 * @method     ChildKiambaadairy[]|ObjectCollection findByDeliveredqty(double $deliveredQty) Return ChildKiambaadairy objects filtered by the deliveredQty column
 * @method     ChildKiambaadairy[]|ObjectCollection findByRejectedqty(double $rejectedQty) Return ChildKiambaadairy objects filtered by the rejectedQty column
 * @method     ChildKiambaadairy[]|ObjectCollection findByAcceptedqty(double $acceptedQty) Return ChildKiambaadairy objects filtered by the acceptedQty column
 * @method     ChildKiambaadairy[]|ObjectCollection findByGrosspay(double $grossPay) Return ChildKiambaadairy objects filtered by the grossPay column
 * @method     ChildKiambaadairy[]|ObjectCollection findByNetpay(double $netPay) Return ChildKiambaadairy objects filtered by the netPay column
 * @method     ChildKiambaadairy[]|ObjectCollection findBySociety(int $society) Return ChildKiambaadairy objects filtered by the society column
 * @method     ChildKiambaadairy[]|ObjectCollection findByPacking(int $packing) Return ChildKiambaadairy objects filtered by the packing column
 * @method     ChildKiambaadairy[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildKiambaadairy objects filtered by the createTmstp column
 * @method     ChildKiambaadairy[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildKiambaadairy objects filtered by the updtTmstp column
 * @method     ChildKiambaadairy[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class KiambaadairyQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\KiambaadairyQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Kiambaadairy', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildKiambaadairyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildKiambaadairyQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildKiambaadairyQuery) {
            return $criteria;
        }
        $query = new ChildKiambaadairyQuery();
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
     * @return ChildKiambaadairy|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(KiambaadairyTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = KiambaadairyTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildKiambaadairy A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, opsMonthlyCalendaOid, societyShares, packingShares, feedExpense, totalDeductions, rate, deliveredQty, rejectedQty, acceptedQty, grossPay, netPay, society, packing, createTmstp, updtTmstp FROM kiambaadairy WHERE oid = :p0';
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
            /** @var ChildKiambaadairy $obj */
            $obj = new ChildKiambaadairy();
            $obj->hydrate($row);
            KiambaadairyTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildKiambaadairy|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(KiambaadairyTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(KiambaadairyTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the opsMonthlyCalendaOid column
     *
     * Example usage:
     * <code>
     * $query->filterByOpsmonthlycalendaoid(1234); // WHERE opsMonthlyCalendaOid = 1234
     * $query->filterByOpsmonthlycalendaoid(array(12, 34)); // WHERE opsMonthlyCalendaOid IN (12, 34)
     * $query->filterByOpsmonthlycalendaoid(array('min' => 12)); // WHERE opsMonthlyCalendaOid > 12
     * </code>
     *
     * @see       filterByOpsmonthlycalendar()
     *
     * @param     mixed $opsmonthlycalendaoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByOpsmonthlycalendaoid($opsmonthlycalendaoid = null, $comparison = null)
    {
        if (is_array($opsmonthlycalendaoid)) {
            $useMinMax = false;
            if (isset($opsmonthlycalendaoid['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_OPSMONTHLYCALENDAOID, $opsmonthlycalendaoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($opsmonthlycalendaoid['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_OPSMONTHLYCALENDAOID, $opsmonthlycalendaoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_OPSMONTHLYCALENDAOID, $opsmonthlycalendaoid, $comparison);
    }

    /**
     * Filter the query on the societyShares column
     *
     * Example usage:
     * <code>
     * $query->filterBySocietyshares(1234); // WHERE societyShares = 1234
     * $query->filterBySocietyshares(array(12, 34)); // WHERE societyShares IN (12, 34)
     * $query->filterBySocietyshares(array('min' => 12)); // WHERE societyShares > 12
     * </code>
     *
     * @param     mixed $societyshares The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterBySocietyshares($societyshares = null, $comparison = null)
    {
        if (is_array($societyshares)) {
            $useMinMax = false;
            if (isset($societyshares['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_SOCIETYSHARES, $societyshares['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($societyshares['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_SOCIETYSHARES, $societyshares['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_SOCIETYSHARES, $societyshares, $comparison);
    }

    /**
     * Filter the query on the packingShares column
     *
     * Example usage:
     * <code>
     * $query->filterByPackingshares(1234); // WHERE packingShares = 1234
     * $query->filterByPackingshares(array(12, 34)); // WHERE packingShares IN (12, 34)
     * $query->filterByPackingshares(array('min' => 12)); // WHERE packingShares > 12
     * </code>
     *
     * @param     mixed $packingshares The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByPackingshares($packingshares = null, $comparison = null)
    {
        if (is_array($packingshares)) {
            $useMinMax = false;
            if (isset($packingshares['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_PACKINGSHARES, $packingshares['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($packingshares['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_PACKINGSHARES, $packingshares['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_PACKINGSHARES, $packingshares, $comparison);
    }

    /**
     * Filter the query on the feedExpense column
     *
     * Example usage:
     * <code>
     * $query->filterByFeedexpense(1234); // WHERE feedExpense = 1234
     * $query->filterByFeedexpense(array(12, 34)); // WHERE feedExpense IN (12, 34)
     * $query->filterByFeedexpense(array('min' => 12)); // WHERE feedExpense > 12
     * </code>
     *
     * @param     mixed $feedexpense The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByFeedexpense($feedexpense = null, $comparison = null)
    {
        if (is_array($feedexpense)) {
            $useMinMax = false;
            if (isset($feedexpense['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_FEEDEXPENSE, $feedexpense['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($feedexpense['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_FEEDEXPENSE, $feedexpense['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_FEEDEXPENSE, $feedexpense, $comparison);
    }

    /**
     * Filter the query on the totalDeductions column
     *
     * Example usage:
     * <code>
     * $query->filterByTotaldeductions(1234); // WHERE totalDeductions = 1234
     * $query->filterByTotaldeductions(array(12, 34)); // WHERE totalDeductions IN (12, 34)
     * $query->filterByTotaldeductions(array('min' => 12)); // WHERE totalDeductions > 12
     * </code>
     *
     * @param     mixed $totaldeductions The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByTotaldeductions($totaldeductions = null, $comparison = null)
    {
        if (is_array($totaldeductions)) {
            $useMinMax = false;
            if (isset($totaldeductions['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_TOTALDEDUCTIONS, $totaldeductions['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totaldeductions['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_TOTALDEDUCTIONS, $totaldeductions['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_TOTALDEDUCTIONS, $totaldeductions, $comparison);
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
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByRate($rate = null, $comparison = null)
    {
        if (is_array($rate)) {
            $useMinMax = false;
            if (isset($rate['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_RATE, $rate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rate['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_RATE, $rate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_RATE, $rate, $comparison);
    }

    /**
     * Filter the query on the deliveredQty column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveredqty(1234); // WHERE deliveredQty = 1234
     * $query->filterByDeliveredqty(array(12, 34)); // WHERE deliveredQty IN (12, 34)
     * $query->filterByDeliveredqty(array('min' => 12)); // WHERE deliveredQty > 12
     * </code>
     *
     * @param     mixed $deliveredqty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByDeliveredqty($deliveredqty = null, $comparison = null)
    {
        if (is_array($deliveredqty)) {
            $useMinMax = false;
            if (isset($deliveredqty['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_DELIVEREDQTY, $deliveredqty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deliveredqty['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_DELIVEREDQTY, $deliveredqty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_DELIVEREDQTY, $deliveredqty, $comparison);
    }

    /**
     * Filter the query on the rejectedQty column
     *
     * Example usage:
     * <code>
     * $query->filterByRejectedqty(1234); // WHERE rejectedQty = 1234
     * $query->filterByRejectedqty(array(12, 34)); // WHERE rejectedQty IN (12, 34)
     * $query->filterByRejectedqty(array('min' => 12)); // WHERE rejectedQty > 12
     * </code>
     *
     * @param     mixed $rejectedqty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByRejectedqty($rejectedqty = null, $comparison = null)
    {
        if (is_array($rejectedqty)) {
            $useMinMax = false;
            if (isset($rejectedqty['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_REJECTEDQTY, $rejectedqty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rejectedqty['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_REJECTEDQTY, $rejectedqty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_REJECTEDQTY, $rejectedqty, $comparison);
    }

    /**
     * Filter the query on the acceptedQty column
     *
     * Example usage:
     * <code>
     * $query->filterByAcceptedqty(1234); // WHERE acceptedQty = 1234
     * $query->filterByAcceptedqty(array(12, 34)); // WHERE acceptedQty IN (12, 34)
     * $query->filterByAcceptedqty(array('min' => 12)); // WHERE acceptedQty > 12
     * </code>
     *
     * @param     mixed $acceptedqty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByAcceptedqty($acceptedqty = null, $comparison = null)
    {
        if (is_array($acceptedqty)) {
            $useMinMax = false;
            if (isset($acceptedqty['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_ACCEPTEDQTY, $acceptedqty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($acceptedqty['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_ACCEPTEDQTY, $acceptedqty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_ACCEPTEDQTY, $acceptedqty, $comparison);
    }

    /**
     * Filter the query on the grossPay column
     *
     * Example usage:
     * <code>
     * $query->filterByGrosspay(1234); // WHERE grossPay = 1234
     * $query->filterByGrosspay(array(12, 34)); // WHERE grossPay IN (12, 34)
     * $query->filterByGrosspay(array('min' => 12)); // WHERE grossPay > 12
     * </code>
     *
     * @param     mixed $grosspay The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByGrosspay($grosspay = null, $comparison = null)
    {
        if (is_array($grosspay)) {
            $useMinMax = false;
            if (isset($grosspay['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_GROSSPAY, $grosspay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grosspay['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_GROSSPAY, $grosspay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_GROSSPAY, $grosspay, $comparison);
    }

    /**
     * Filter the query on the netPay column
     *
     * Example usage:
     * <code>
     * $query->filterByNetpay(1234); // WHERE netPay = 1234
     * $query->filterByNetpay(array(12, 34)); // WHERE netPay IN (12, 34)
     * $query->filterByNetpay(array('min' => 12)); // WHERE netPay > 12
     * </code>
     *
     * @param     mixed $netpay The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByNetpay($netpay = null, $comparison = null)
    {
        if (is_array($netpay)) {
            $useMinMax = false;
            if (isset($netpay['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_NETPAY, $netpay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($netpay['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_NETPAY, $netpay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_NETPAY, $netpay, $comparison);
    }

    /**
     * Filter the query on the society column
     *
     * Example usage:
     * <code>
     * $query->filterBySociety(1234); // WHERE society = 1234
     * $query->filterBySociety(array(12, 34)); // WHERE society IN (12, 34)
     * $query->filterBySociety(array('min' => 12)); // WHERE society > 12
     * </code>
     *
     * @param     mixed $society The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterBySociety($society = null, $comparison = null)
    {
        if (is_array($society)) {
            $useMinMax = false;
            if (isset($society['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_SOCIETY, $society['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($society['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_SOCIETY, $society['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_SOCIETY, $society, $comparison);
    }

    /**
     * Filter the query on the packing column
     *
     * Example usage:
     * <code>
     * $query->filterByPacking(1234); // WHERE packing = 1234
     * $query->filterByPacking(array(12, 34)); // WHERE packing IN (12, 34)
     * $query->filterByPacking(array('min' => 12)); // WHERE packing > 12
     * </code>
     *
     * @param     mixed $packing The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByPacking($packing = null, $comparison = null)
    {
        if (is_array($packing)) {
            $useMinMax = false;
            if (isset($packing['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_PACKING, $packing['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($packing['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_PACKING, $packing['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_PACKING, $packing, $comparison);
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
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(KiambaadairyTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KiambaadairyTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Opsmonthlycalendar object
     *
     * @param \lwops\lwops\Opsmonthlycalendar|ObjectCollection $opsmonthlycalendar The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function filterByOpsmonthlycalendar($opsmonthlycalendar, $comparison = null)
    {
        if ($opsmonthlycalendar instanceof \lwops\lwops\Opsmonthlycalendar) {
            return $this
                ->addUsingAlias(KiambaadairyTableMap::COL_OPSMONTHLYCALENDAOID, $opsmonthlycalendar->getOid(), $comparison);
        } elseif ($opsmonthlycalendar instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(KiambaadairyTableMap::COL_OPSMONTHLYCALENDAOID, $opsmonthlycalendar->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByOpsmonthlycalendar() only accepts arguments of type \lwops\lwops\Opsmonthlycalendar or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Opsmonthlycalendar relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function joinOpsmonthlycalendar($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Opsmonthlycalendar');

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
            $this->addJoinObject($join, 'Opsmonthlycalendar');
        }

        return $this;
    }

    /**
     * Use the Opsmonthlycalendar relation Opsmonthlycalendar object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\OpsmonthlycalendarQuery A secondary query class using the current class as primary query
     */
    public function useOpsmonthlycalendarQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOpsmonthlycalendar($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Opsmonthlycalendar', '\lwops\lwops\OpsmonthlycalendarQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildKiambaadairy $kiambaadairy Object to remove from the list of results
     *
     * @return $this|ChildKiambaadairyQuery The current query, for fluid interface
     */
    public function prune($kiambaadairy = null)
    {
        if ($kiambaadairy) {
            $this->addUsingAlias(KiambaadairyTableMap::COL_OID, $kiambaadairy->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kiambaadairy table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(KiambaadairyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            KiambaadairyTableMap::clearInstancePool();
            KiambaadairyTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(KiambaadairyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(KiambaadairyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            KiambaadairyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            KiambaadairyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // KiambaadairyQuery
