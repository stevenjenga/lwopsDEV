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
use lwops\lwops\Fishpandl as ChildFishpandl;
use lwops\lwops\FishpandlQuery as ChildFishpandlQuery;
use lwops\lwops\Map\FishpandlTableMap;

/**
 * Base class that represents a query for the 'fishpandl' table.
 *
 *
 *
 * @method     ChildFishpandlQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildFishpandlQuery orderByLineofbusinessoid($order = Criteria::ASC) Order by the lineOfBusinessOid column
 * @method     ChildFishpandlQuery orderByOpsmonthlycalendaroid($order = Criteria::ASC) Order by the opsMonthlyCalendarOid column
 * @method     ChildFishpandlQuery orderBySalesincome($order = Criteria::ASC) Order by the salesIncome column
 * @method     ChildFishpandlQuery orderByOtherincome($order = Criteria::ASC) Order by the otherIncome column
 * @method     ChildFishpandlQuery orderByPurchases($order = Criteria::ASC) Order by the purchases column
 * @method     ChildFishpandlQuery orderByOtherpurchases($order = Criteria::ASC) Order by the otherPurchases column
 * @method     ChildFishpandlQuery orderByLabourparttimeexpense($order = Criteria::ASC) Order by the labourParttimeExpense column
 * @method     ChildFishpandlQuery orderByGeneralexpenses($order = Criteria::ASC) Order by the generalExpenses column
 * @method     ChildFishpandlQuery orderByElecexpenses($order = Criteria::ASC) Order by the elecExpenses column
 * @method     ChildFishpandlQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildFishpandlQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildFishpandlQuery groupByOid() Group by the oid column
 * @method     ChildFishpandlQuery groupByLineofbusinessoid() Group by the lineOfBusinessOid column
 * @method     ChildFishpandlQuery groupByOpsmonthlycalendaroid() Group by the opsMonthlyCalendarOid column
 * @method     ChildFishpandlQuery groupBySalesincome() Group by the salesIncome column
 * @method     ChildFishpandlQuery groupByOtherincome() Group by the otherIncome column
 * @method     ChildFishpandlQuery groupByPurchases() Group by the purchases column
 * @method     ChildFishpandlQuery groupByOtherpurchases() Group by the otherPurchases column
 * @method     ChildFishpandlQuery groupByLabourparttimeexpense() Group by the labourParttimeExpense column
 * @method     ChildFishpandlQuery groupByGeneralexpenses() Group by the generalExpenses column
 * @method     ChildFishpandlQuery groupByElecexpenses() Group by the elecExpenses column
 * @method     ChildFishpandlQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildFishpandlQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildFishpandlQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFishpandlQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFishpandlQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFishpandlQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFishpandlQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFishpandlQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFishpandlQuery leftJoinLineofbusiness($relationAlias = null) Adds a LEFT JOIN clause to the query using the Lineofbusiness relation
 * @method     ChildFishpandlQuery rightJoinLineofbusiness($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Lineofbusiness relation
 * @method     ChildFishpandlQuery innerJoinLineofbusiness($relationAlias = null) Adds a INNER JOIN clause to the query using the Lineofbusiness relation
 *
 * @method     ChildFishpandlQuery joinWithLineofbusiness($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Lineofbusiness relation
 *
 * @method     ChildFishpandlQuery leftJoinWithLineofbusiness() Adds a LEFT JOIN clause and with to the query using the Lineofbusiness relation
 * @method     ChildFishpandlQuery rightJoinWithLineofbusiness() Adds a RIGHT JOIN clause and with to the query using the Lineofbusiness relation
 * @method     ChildFishpandlQuery innerJoinWithLineofbusiness() Adds a INNER JOIN clause and with to the query using the Lineofbusiness relation
 *
 * @method     ChildFishpandlQuery leftJoinOpsmonthlycalendar($relationAlias = null) Adds a LEFT JOIN clause to the query using the Opsmonthlycalendar relation
 * @method     ChildFishpandlQuery rightJoinOpsmonthlycalendar($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Opsmonthlycalendar relation
 * @method     ChildFishpandlQuery innerJoinOpsmonthlycalendar($relationAlias = null) Adds a INNER JOIN clause to the query using the Opsmonthlycalendar relation
 *
 * @method     ChildFishpandlQuery joinWithOpsmonthlycalendar($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Opsmonthlycalendar relation
 *
 * @method     ChildFishpandlQuery leftJoinWithOpsmonthlycalendar() Adds a LEFT JOIN clause and with to the query using the Opsmonthlycalendar relation
 * @method     ChildFishpandlQuery rightJoinWithOpsmonthlycalendar() Adds a RIGHT JOIN clause and with to the query using the Opsmonthlycalendar relation
 * @method     ChildFishpandlQuery innerJoinWithOpsmonthlycalendar() Adds a INNER JOIN clause and with to the query using the Opsmonthlycalendar relation
 *
 * @method     ChildFishpandlQuery leftJoinFishpandllabourexpensedetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fishpandllabourexpensedetail relation
 * @method     ChildFishpandlQuery rightJoinFishpandllabourexpensedetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fishpandllabourexpensedetail relation
 * @method     ChildFishpandlQuery innerJoinFishpandllabourexpensedetail($relationAlias = null) Adds a INNER JOIN clause to the query using the Fishpandllabourexpensedetail relation
 *
 * @method     ChildFishpandlQuery joinWithFishpandllabourexpensedetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fishpandllabourexpensedetail relation
 *
 * @method     ChildFishpandlQuery leftJoinWithFishpandllabourexpensedetail() Adds a LEFT JOIN clause and with to the query using the Fishpandllabourexpensedetail relation
 * @method     ChildFishpandlQuery rightJoinWithFishpandllabourexpensedetail() Adds a RIGHT JOIN clause and with to the query using the Fishpandllabourexpensedetail relation
 * @method     ChildFishpandlQuery innerJoinWithFishpandllabourexpensedetail() Adds a INNER JOIN clause and with to the query using the Fishpandllabourexpensedetail relation
 *
 * @method     \lwops\lwops\LineofbusinessQuery|\lwops\lwops\OpsmonthlycalendarQuery|\lwops\lwops\FishpandllabourexpensedetailQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFishpandl findOne(ConnectionInterface $con = null) Return the first ChildFishpandl matching the query
 * @method     ChildFishpandl findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFishpandl matching the query, or a new ChildFishpandl object populated from the query conditions when no match is found
 *
 * @method     ChildFishpandl findOneByOid(int $oid) Return the first ChildFishpandl filtered by the oid column
 * @method     ChildFishpandl findOneByLineofbusinessoid(int $lineOfBusinessOid) Return the first ChildFishpandl filtered by the lineOfBusinessOid column
 * @method     ChildFishpandl findOneByOpsmonthlycalendaroid(int $opsMonthlyCalendarOid) Return the first ChildFishpandl filtered by the opsMonthlyCalendarOid column
 * @method     ChildFishpandl findOneBySalesincome(double $salesIncome) Return the first ChildFishpandl filtered by the salesIncome column
 * @method     ChildFishpandl findOneByOtherincome(double $otherIncome) Return the first ChildFishpandl filtered by the otherIncome column
 * @method     ChildFishpandl findOneByPurchases(double $purchases) Return the first ChildFishpandl filtered by the purchases column
 * @method     ChildFishpandl findOneByOtherpurchases(double $otherPurchases) Return the first ChildFishpandl filtered by the otherPurchases column
 * @method     ChildFishpandl findOneByLabourparttimeexpense(double $labourParttimeExpense) Return the first ChildFishpandl filtered by the labourParttimeExpense column
 * @method     ChildFishpandl findOneByGeneralexpenses(double $generalExpenses) Return the first ChildFishpandl filtered by the generalExpenses column
 * @method     ChildFishpandl findOneByElecexpenses(double $elecExpenses) Return the first ChildFishpandl filtered by the elecExpenses column
 * @method     ChildFishpandl findOneByCreatetmstp(string $createTmstp) Return the first ChildFishpandl filtered by the createTmstp column
 * @method     ChildFishpandl findOneByUpdttmstp(string $updtTmstp) Return the first ChildFishpandl filtered by the updtTmstp column *

 * @method     ChildFishpandl requirePk($key, ConnectionInterface $con = null) Return the ChildFishpandl by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandl requireOne(ConnectionInterface $con = null) Return the first ChildFishpandl matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFishpandl requireOneByOid(int $oid) Return the first ChildFishpandl filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandl requireOneByLineofbusinessoid(int $lineOfBusinessOid) Return the first ChildFishpandl filtered by the lineOfBusinessOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandl requireOneByOpsmonthlycalendaroid(int $opsMonthlyCalendarOid) Return the first ChildFishpandl filtered by the opsMonthlyCalendarOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandl requireOneBySalesincome(double $salesIncome) Return the first ChildFishpandl filtered by the salesIncome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandl requireOneByOtherincome(double $otherIncome) Return the first ChildFishpandl filtered by the otherIncome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandl requireOneByPurchases(double $purchases) Return the first ChildFishpandl filtered by the purchases column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandl requireOneByOtherpurchases(double $otherPurchases) Return the first ChildFishpandl filtered by the otherPurchases column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandl requireOneByLabourparttimeexpense(double $labourParttimeExpense) Return the first ChildFishpandl filtered by the labourParttimeExpense column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandl requireOneByGeneralexpenses(double $generalExpenses) Return the first ChildFishpandl filtered by the generalExpenses column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandl requireOneByElecexpenses(double $elecExpenses) Return the first ChildFishpandl filtered by the elecExpenses column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandl requireOneByCreatetmstp(string $createTmstp) Return the first ChildFishpandl filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFishpandl requireOneByUpdttmstp(string $updtTmstp) Return the first ChildFishpandl filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFishpandl[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFishpandl objects based on current ModelCriteria
 * @method     ChildFishpandl[]|ObjectCollection findByOid(int $oid) Return ChildFishpandl objects filtered by the oid column
 * @method     ChildFishpandl[]|ObjectCollection findByLineofbusinessoid(int $lineOfBusinessOid) Return ChildFishpandl objects filtered by the lineOfBusinessOid column
 * @method     ChildFishpandl[]|ObjectCollection findByOpsmonthlycalendaroid(int $opsMonthlyCalendarOid) Return ChildFishpandl objects filtered by the opsMonthlyCalendarOid column
 * @method     ChildFishpandl[]|ObjectCollection findBySalesincome(double $salesIncome) Return ChildFishpandl objects filtered by the salesIncome column
 * @method     ChildFishpandl[]|ObjectCollection findByOtherincome(double $otherIncome) Return ChildFishpandl objects filtered by the otherIncome column
 * @method     ChildFishpandl[]|ObjectCollection findByPurchases(double $purchases) Return ChildFishpandl objects filtered by the purchases column
 * @method     ChildFishpandl[]|ObjectCollection findByOtherpurchases(double $otherPurchases) Return ChildFishpandl objects filtered by the otherPurchases column
 * @method     ChildFishpandl[]|ObjectCollection findByLabourparttimeexpense(double $labourParttimeExpense) Return ChildFishpandl objects filtered by the labourParttimeExpense column
 * @method     ChildFishpandl[]|ObjectCollection findByGeneralexpenses(double $generalExpenses) Return ChildFishpandl objects filtered by the generalExpenses column
 * @method     ChildFishpandl[]|ObjectCollection findByElecexpenses(double $elecExpenses) Return ChildFishpandl objects filtered by the elecExpenses column
 * @method     ChildFishpandl[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildFishpandl objects filtered by the createTmstp column
 * @method     ChildFishpandl[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildFishpandl objects filtered by the updtTmstp column
 * @method     ChildFishpandl[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FishpandlQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\FishpandlQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Fishpandl', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFishpandlQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFishpandlQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFishpandlQuery) {
            return $criteria;
        }
        $query = new ChildFishpandlQuery();
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
     * @return ChildFishpandl|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FishpandlTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FishpandlTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFishpandl A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, lineOfBusinessOid, opsMonthlyCalendarOid, salesIncome, otherIncome, purchases, otherPurchases, labourParttimeExpense, generalExpenses, elecExpenses, createTmstp, updtTmstp FROM fishpandl WHERE oid = :p0';
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
            /** @var ChildFishpandl $obj */
            $obj = new ChildFishpandl();
            $obj->hydrate($row);
            FishpandlTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFishpandl|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FishpandlTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FishpandlTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandlTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the lineOfBusinessOid column
     *
     * Example usage:
     * <code>
     * $query->filterByLineofbusinessoid(1234); // WHERE lineOfBusinessOid = 1234
     * $query->filterByLineofbusinessoid(array(12, 34)); // WHERE lineOfBusinessOid IN (12, 34)
     * $query->filterByLineofbusinessoid(array('min' => 12)); // WHERE lineOfBusinessOid > 12
     * </code>
     *
     * @see       filterByLineofbusiness()
     *
     * @param     mixed $lineofbusinessoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByLineofbusinessoid($lineofbusinessoid = null, $comparison = null)
    {
        if (is_array($lineofbusinessoid)) {
            $useMinMax = false;
            if (isset($lineofbusinessoid['min'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lineofbusinessoid['max'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandlTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid, $comparison);
    }

    /**
     * Filter the query on the opsMonthlyCalendarOid column
     *
     * Example usage:
     * <code>
     * $query->filterByOpsmonthlycalendaroid(1234); // WHERE opsMonthlyCalendarOid = 1234
     * $query->filterByOpsmonthlycalendaroid(array(12, 34)); // WHERE opsMonthlyCalendarOid IN (12, 34)
     * $query->filterByOpsmonthlycalendaroid(array('min' => 12)); // WHERE opsMonthlyCalendarOid > 12
     * </code>
     *
     * @see       filterByOpsmonthlycalendar()
     *
     * @param     mixed $opsmonthlycalendaroid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByOpsmonthlycalendaroid($opsmonthlycalendaroid = null, $comparison = null)
    {
        if (is_array($opsmonthlycalendaroid)) {
            $useMinMax = false;
            if (isset($opsmonthlycalendaroid['min'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendaroid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($opsmonthlycalendaroid['max'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendaroid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandlTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendaroid, $comparison);
    }

    /**
     * Filter the query on the salesIncome column
     *
     * Example usage:
     * <code>
     * $query->filterBySalesincome(1234); // WHERE salesIncome = 1234
     * $query->filterBySalesincome(array(12, 34)); // WHERE salesIncome IN (12, 34)
     * $query->filterBySalesincome(array('min' => 12)); // WHERE salesIncome > 12
     * </code>
     *
     * @param     mixed $salesincome The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterBySalesincome($salesincome = null, $comparison = null)
    {
        if (is_array($salesincome)) {
            $useMinMax = false;
            if (isset($salesincome['min'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_SALESINCOME, $salesincome['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($salesincome['max'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_SALESINCOME, $salesincome['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandlTableMap::COL_SALESINCOME, $salesincome, $comparison);
    }

    /**
     * Filter the query on the otherIncome column
     *
     * Example usage:
     * <code>
     * $query->filterByOtherincome(1234); // WHERE otherIncome = 1234
     * $query->filterByOtherincome(array(12, 34)); // WHERE otherIncome IN (12, 34)
     * $query->filterByOtherincome(array('min' => 12)); // WHERE otherIncome > 12
     * </code>
     *
     * @param     mixed $otherincome The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByOtherincome($otherincome = null, $comparison = null)
    {
        if (is_array($otherincome)) {
            $useMinMax = false;
            if (isset($otherincome['min'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_OTHERINCOME, $otherincome['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otherincome['max'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_OTHERINCOME, $otherincome['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandlTableMap::COL_OTHERINCOME, $otherincome, $comparison);
    }

    /**
     * Filter the query on the purchases column
     *
     * Example usage:
     * <code>
     * $query->filterByPurchases(1234); // WHERE purchases = 1234
     * $query->filterByPurchases(array(12, 34)); // WHERE purchases IN (12, 34)
     * $query->filterByPurchases(array('min' => 12)); // WHERE purchases > 12
     * </code>
     *
     * @param     mixed $purchases The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByPurchases($purchases = null, $comparison = null)
    {
        if (is_array($purchases)) {
            $useMinMax = false;
            if (isset($purchases['min'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_PURCHASES, $purchases['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($purchases['max'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_PURCHASES, $purchases['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandlTableMap::COL_PURCHASES, $purchases, $comparison);
    }

    /**
     * Filter the query on the otherPurchases column
     *
     * Example usage:
     * <code>
     * $query->filterByOtherpurchases(1234); // WHERE otherPurchases = 1234
     * $query->filterByOtherpurchases(array(12, 34)); // WHERE otherPurchases IN (12, 34)
     * $query->filterByOtherpurchases(array('min' => 12)); // WHERE otherPurchases > 12
     * </code>
     *
     * @param     mixed $otherpurchases The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByOtherpurchases($otherpurchases = null, $comparison = null)
    {
        if (is_array($otherpurchases)) {
            $useMinMax = false;
            if (isset($otherpurchases['min'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_OTHERPURCHASES, $otherpurchases['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otherpurchases['max'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_OTHERPURCHASES, $otherpurchases['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandlTableMap::COL_OTHERPURCHASES, $otherpurchases, $comparison);
    }

    /**
     * Filter the query on the labourParttimeExpense column
     *
     * Example usage:
     * <code>
     * $query->filterByLabourparttimeexpense(1234); // WHERE labourParttimeExpense = 1234
     * $query->filterByLabourparttimeexpense(array(12, 34)); // WHERE labourParttimeExpense IN (12, 34)
     * $query->filterByLabourparttimeexpense(array('min' => 12)); // WHERE labourParttimeExpense > 12
     * </code>
     *
     * @param     mixed $labourparttimeexpense The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByLabourparttimeexpense($labourparttimeexpense = null, $comparison = null)
    {
        if (is_array($labourparttimeexpense)) {
            $useMinMax = false;
            if (isset($labourparttimeexpense['min'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_LABOURPARTTIMEEXPENSE, $labourparttimeexpense['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($labourparttimeexpense['max'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_LABOURPARTTIMEEXPENSE, $labourparttimeexpense['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandlTableMap::COL_LABOURPARTTIMEEXPENSE, $labourparttimeexpense, $comparison);
    }

    /**
     * Filter the query on the generalExpenses column
     *
     * Example usage:
     * <code>
     * $query->filterByGeneralexpenses(1234); // WHERE generalExpenses = 1234
     * $query->filterByGeneralexpenses(array(12, 34)); // WHERE generalExpenses IN (12, 34)
     * $query->filterByGeneralexpenses(array('min' => 12)); // WHERE generalExpenses > 12
     * </code>
     *
     * @param     mixed $generalexpenses The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByGeneralexpenses($generalexpenses = null, $comparison = null)
    {
        if (is_array($generalexpenses)) {
            $useMinMax = false;
            if (isset($generalexpenses['min'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_GENERALEXPENSES, $generalexpenses['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($generalexpenses['max'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_GENERALEXPENSES, $generalexpenses['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandlTableMap::COL_GENERALEXPENSES, $generalexpenses, $comparison);
    }

    /**
     * Filter the query on the elecExpenses column
     *
     * Example usage:
     * <code>
     * $query->filterByElecexpenses(1234); // WHERE elecExpenses = 1234
     * $query->filterByElecexpenses(array(12, 34)); // WHERE elecExpenses IN (12, 34)
     * $query->filterByElecexpenses(array('min' => 12)); // WHERE elecExpenses > 12
     * </code>
     *
     * @param     mixed $elecexpenses The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByElecexpenses($elecexpenses = null, $comparison = null)
    {
        if (is_array($elecexpenses)) {
            $useMinMax = false;
            if (isset($elecexpenses['min'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_ELECEXPENSES, $elecexpenses['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($elecexpenses['max'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_ELECEXPENSES, $elecexpenses['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandlTableMap::COL_ELECEXPENSES, $elecexpenses, $comparison);
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
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandlTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(FishpandlTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FishpandlTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Lineofbusiness object
     *
     * @param \lwops\lwops\Lineofbusiness|ObjectCollection $lineofbusiness The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByLineofbusiness($lineofbusiness, $comparison = null)
    {
        if ($lineofbusiness instanceof \lwops\lwops\Lineofbusiness) {
            return $this
                ->addUsingAlias(FishpandlTableMap::COL_LINEOFBUSINESSOID, $lineofbusiness->getOid(), $comparison);
        } elseif ($lineofbusiness instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FishpandlTableMap::COL_LINEOFBUSINESSOID, $lineofbusiness->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByLineofbusiness() only accepts arguments of type \lwops\lwops\Lineofbusiness or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Lineofbusiness relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function joinLineofbusiness($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Lineofbusiness');

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
            $this->addJoinObject($join, 'Lineofbusiness');
        }

        return $this;
    }

    /**
     * Use the Lineofbusiness relation Lineofbusiness object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\LineofbusinessQuery A secondary query class using the current class as primary query
     */
    public function useLineofbusinessQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLineofbusiness($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Lineofbusiness', '\lwops\lwops\LineofbusinessQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Opsmonthlycalendar object
     *
     * @param \lwops\lwops\Opsmonthlycalendar|ObjectCollection $opsmonthlycalendar The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByOpsmonthlycalendar($opsmonthlycalendar, $comparison = null)
    {
        if ($opsmonthlycalendar instanceof \lwops\lwops\Opsmonthlycalendar) {
            return $this
                ->addUsingAlias(FishpandlTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendar->getOid(), $comparison);
        } elseif ($opsmonthlycalendar instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FishpandlTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendar->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Fishpandllabourexpensedetail object
     *
     * @param \lwops\lwops\Fishpandllabourexpensedetail|ObjectCollection $fishpandllabourexpensedetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFishpandlQuery The current query, for fluid interface
     */
    public function filterByFishpandllabourexpensedetail($fishpandllabourexpensedetail, $comparison = null)
    {
        if ($fishpandllabourexpensedetail instanceof \lwops\lwops\Fishpandllabourexpensedetail) {
            return $this
                ->addUsingAlias(FishpandlTableMap::COL_OID, $fishpandllabourexpensedetail->getFishpandloid(), $comparison);
        } elseif ($fishpandllabourexpensedetail instanceof ObjectCollection) {
            return $this
                ->useFishpandllabourexpensedetailQuery()
                ->filterByPrimaryKeys($fishpandllabourexpensedetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFishpandllabourexpensedetail() only accepts arguments of type \lwops\lwops\Fishpandllabourexpensedetail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fishpandllabourexpensedetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function joinFishpandllabourexpensedetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fishpandllabourexpensedetail');

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
            $this->addJoinObject($join, 'Fishpandllabourexpensedetail');
        }

        return $this;
    }

    /**
     * Use the Fishpandllabourexpensedetail relation Fishpandllabourexpensedetail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\FishpandllabourexpensedetailQuery A secondary query class using the current class as primary query
     */
    public function useFishpandllabourexpensedetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFishpandllabourexpensedetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fishpandllabourexpensedetail', '\lwops\lwops\FishpandllabourexpensedetailQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFishpandl $fishpandl Object to remove from the list of results
     *
     * @return $this|ChildFishpandlQuery The current query, for fluid interface
     */
    public function prune($fishpandl = null)
    {
        if ($fishpandl) {
            $this->addUsingAlias(FishpandlTableMap::COL_OID, $fishpandl->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the fishpandl table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FishpandlTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FishpandlTableMap::clearInstancePool();
            FishpandlTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FishpandlTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FishpandlTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FishpandlTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FishpandlTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FishpandlQuery
