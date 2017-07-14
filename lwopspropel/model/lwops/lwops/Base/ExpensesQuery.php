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
use lwops\lwops\Expenses as ChildExpenses;
use lwops\lwops\ExpensesQuery as ChildExpensesQuery;
use lwops\lwops\Map\ExpensesTableMap;

/**
 * Base class that represents a query for the 'expenses' table.
 *
 *
 *
 * @method     ChildExpensesQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildExpensesQuery orderByExpensedate($order = Criteria::ASC) Order by the expenseDate column
 * @method     ChildExpensesQuery orderByPayee($order = Criteria::ASC) Order by the payee column
 * @method     ChildExpensesQuery orderByNarration($order = Criteria::ASC) Order by the narration column
 * @method     ChildExpensesQuery orderByActivityoid($order = Criteria::ASC) Order by the activityOid column
 * @method     ChildExpensesQuery orderByLineofbusinessoid($order = Criteria::ASC) Order by the lineOfBusinessOid column
 * @method     ChildExpensesQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildExpensesQuery orderByCategoryoid($order = Criteria::ASC) Order by the categoryOid column
 * @method     ChildExpensesQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildExpensesQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildExpensesQuery groupByOid() Group by the oid column
 * @method     ChildExpensesQuery groupByExpensedate() Group by the expenseDate column
 * @method     ChildExpensesQuery groupByPayee() Group by the payee column
 * @method     ChildExpensesQuery groupByNarration() Group by the narration column
 * @method     ChildExpensesQuery groupByActivityoid() Group by the activityOid column
 * @method     ChildExpensesQuery groupByLineofbusinessoid() Group by the lineOfBusinessOid column
 * @method     ChildExpensesQuery groupByAmount() Group by the amount column
 * @method     ChildExpensesQuery groupByCategoryoid() Group by the categoryOid column
 * @method     ChildExpensesQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildExpensesQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildExpensesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExpensesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExpensesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExpensesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExpensesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExpensesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExpensesQuery leftJoinExpenseactivity($relationAlias = null) Adds a LEFT JOIN clause to the query using the Expenseactivity relation
 * @method     ChildExpensesQuery rightJoinExpenseactivity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Expenseactivity relation
 * @method     ChildExpensesQuery innerJoinExpenseactivity($relationAlias = null) Adds a INNER JOIN clause to the query using the Expenseactivity relation
 *
 * @method     ChildExpensesQuery joinWithExpenseactivity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Expenseactivity relation
 *
 * @method     ChildExpensesQuery leftJoinWithExpenseactivity() Adds a LEFT JOIN clause and with to the query using the Expenseactivity relation
 * @method     ChildExpensesQuery rightJoinWithExpenseactivity() Adds a RIGHT JOIN clause and with to the query using the Expenseactivity relation
 * @method     ChildExpensesQuery innerJoinWithExpenseactivity() Adds a INNER JOIN clause and with to the query using the Expenseactivity relation
 *
 * @method     ChildExpensesQuery leftJoinLineofbusiness($relationAlias = null) Adds a LEFT JOIN clause to the query using the Lineofbusiness relation
 * @method     ChildExpensesQuery rightJoinLineofbusiness($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Lineofbusiness relation
 * @method     ChildExpensesQuery innerJoinLineofbusiness($relationAlias = null) Adds a INNER JOIN clause to the query using the Lineofbusiness relation
 *
 * @method     ChildExpensesQuery joinWithLineofbusiness($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Lineofbusiness relation
 *
 * @method     ChildExpensesQuery leftJoinWithLineofbusiness() Adds a LEFT JOIN clause and with to the query using the Lineofbusiness relation
 * @method     ChildExpensesQuery rightJoinWithLineofbusiness() Adds a RIGHT JOIN clause and with to the query using the Lineofbusiness relation
 * @method     ChildExpensesQuery innerJoinWithLineofbusiness() Adds a INNER JOIN clause and with to the query using the Lineofbusiness relation
 *
 * @method     ChildExpensesQuery leftJoinExpensecategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Expensecategory relation
 * @method     ChildExpensesQuery rightJoinExpensecategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Expensecategory relation
 * @method     ChildExpensesQuery innerJoinExpensecategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Expensecategory relation
 *
 * @method     ChildExpensesQuery joinWithExpensecategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Expensecategory relation
 *
 * @method     ChildExpensesQuery leftJoinWithExpensecategory() Adds a LEFT JOIN clause and with to the query using the Expensecategory relation
 * @method     ChildExpensesQuery rightJoinWithExpensecategory() Adds a RIGHT JOIN clause and with to the query using the Expensecategory relation
 * @method     ChildExpensesQuery innerJoinWithExpensecategory() Adds a INNER JOIN clause and with to the query using the Expensecategory relation
 *
 * @method     \lwops\lwops\ExpenseactivityQuery|\lwops\lwops\LineofbusinessQuery|\lwops\lwops\ExpensecategoryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildExpenses findOne(ConnectionInterface $con = null) Return the first ChildExpenses matching the query
 * @method     ChildExpenses findOneOrCreate(ConnectionInterface $con = null) Return the first ChildExpenses matching the query, or a new ChildExpenses object populated from the query conditions when no match is found
 *
 * @method     ChildExpenses findOneByOid(int $oid) Return the first ChildExpenses filtered by the oid column
 * @method     ChildExpenses findOneByExpensedate(string $expenseDate) Return the first ChildExpenses filtered by the expenseDate column
 * @method     ChildExpenses findOneByPayee(string $payee) Return the first ChildExpenses filtered by the payee column
 * @method     ChildExpenses findOneByNarration(string $narration) Return the first ChildExpenses filtered by the narration column
 * @method     ChildExpenses findOneByActivityoid(int $activityOid) Return the first ChildExpenses filtered by the activityOid column
 * @method     ChildExpenses findOneByLineofbusinessoid(int $lineOfBusinessOid) Return the first ChildExpenses filtered by the lineOfBusinessOid column
 * @method     ChildExpenses findOneByAmount(double $amount) Return the first ChildExpenses filtered by the amount column
 * @method     ChildExpenses findOneByCategoryoid(int $categoryOid) Return the first ChildExpenses filtered by the categoryOid column
 * @method     ChildExpenses findOneByCreatetmstp(string $createTmstp) Return the first ChildExpenses filtered by the createTmstp column
 * @method     ChildExpenses findOneByUpdttmstp(string $updtTmstp) Return the first ChildExpenses filtered by the updtTmstp column *

 * @method     ChildExpenses requirePk($key, ConnectionInterface $con = null) Return the ChildExpenses by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOne(ConnectionInterface $con = null) Return the first ChildExpenses matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenses requireOneByOid(int $oid) Return the first ChildExpenses filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByExpensedate(string $expenseDate) Return the first ChildExpenses filtered by the expenseDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByPayee(string $payee) Return the first ChildExpenses filtered by the payee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByNarration(string $narration) Return the first ChildExpenses filtered by the narration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByActivityoid(int $activityOid) Return the first ChildExpenses filtered by the activityOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByLineofbusinessoid(int $lineOfBusinessOid) Return the first ChildExpenses filtered by the lineOfBusinessOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByAmount(double $amount) Return the first ChildExpenses filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByCategoryoid(int $categoryOid) Return the first ChildExpenses filtered by the categoryOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByCreatetmstp(string $createTmstp) Return the first ChildExpenses filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByUpdttmstp(string $updtTmstp) Return the first ChildExpenses filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenses[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildExpenses objects based on current ModelCriteria
 * @method     ChildExpenses[]|ObjectCollection findByOid(int $oid) Return ChildExpenses objects filtered by the oid column
 * @method     ChildExpenses[]|ObjectCollection findByExpensedate(string $expenseDate) Return ChildExpenses objects filtered by the expenseDate column
 * @method     ChildExpenses[]|ObjectCollection findByPayee(string $payee) Return ChildExpenses objects filtered by the payee column
 * @method     ChildExpenses[]|ObjectCollection findByNarration(string $narration) Return ChildExpenses objects filtered by the narration column
 * @method     ChildExpenses[]|ObjectCollection findByActivityoid(int $activityOid) Return ChildExpenses objects filtered by the activityOid column
 * @method     ChildExpenses[]|ObjectCollection findByLineofbusinessoid(int $lineOfBusinessOid) Return ChildExpenses objects filtered by the lineOfBusinessOid column
 * @method     ChildExpenses[]|ObjectCollection findByAmount(double $amount) Return ChildExpenses objects filtered by the amount column
 * @method     ChildExpenses[]|ObjectCollection findByCategoryoid(int $categoryOid) Return ChildExpenses objects filtered by the categoryOid column
 * @method     ChildExpenses[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildExpenses objects filtered by the createTmstp column
 * @method     ChildExpenses[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildExpenses objects filtered by the updtTmstp column
 * @method     ChildExpenses[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ExpensesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\ExpensesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Expenses', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExpensesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExpensesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildExpensesQuery) {
            return $criteria;
        }
        $query = new ChildExpensesQuery();
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
     * @return ChildExpenses|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExpensesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExpensesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildExpenses A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, expenseDate, payee, narration, activityOid, lineOfBusinessOid, amount, categoryOid, createTmstp, updtTmstp FROM expenses WHERE oid = :p0';
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
            /** @var ChildExpenses $obj */
            $obj = new ChildExpenses();
            $obj->hydrate($row);
            ExpensesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildExpenses|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ExpensesTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ExpensesTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensesTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the expenseDate column
     *
     * Example usage:
     * <code>
     * $query->filterByExpensedate('2011-03-14'); // WHERE expenseDate = '2011-03-14'
     * $query->filterByExpensedate('now'); // WHERE expenseDate = '2011-03-14'
     * $query->filterByExpensedate(array('max' => 'yesterday')); // WHERE expenseDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $expensedate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByExpensedate($expensedate = null, $comparison = null)
    {
        if (is_array($expensedate)) {
            $useMinMax = false;
            if (isset($expensedate['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSEDATE, $expensedate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expensedate['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSEDATE, $expensedate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensesTableMap::COL_EXPENSEDATE, $expensedate, $comparison);
    }

    /**
     * Filter the query on the payee column
     *
     * Example usage:
     * <code>
     * $query->filterByPayee('fooValue');   // WHERE payee = 'fooValue'
     * $query->filterByPayee('%fooValue%', Criteria::LIKE); // WHERE payee LIKE '%fooValue%'
     * </code>
     *
     * @param     string $payee The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByPayee($payee = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($payee)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensesTableMap::COL_PAYEE, $payee, $comparison);
    }

    /**
     * Filter the query on the narration column
     *
     * Example usage:
     * <code>
     * $query->filterByNarration('fooValue');   // WHERE narration = 'fooValue'
     * $query->filterByNarration('%fooValue%', Criteria::LIKE); // WHERE narration LIKE '%fooValue%'
     * </code>
     *
     * @param     string $narration The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByNarration($narration = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($narration)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensesTableMap::COL_NARRATION, $narration, $comparison);
    }

    /**
     * Filter the query on the activityOid column
     *
     * Example usage:
     * <code>
     * $query->filterByActivityoid(1234); // WHERE activityOid = 1234
     * $query->filterByActivityoid(array(12, 34)); // WHERE activityOid IN (12, 34)
     * $query->filterByActivityoid(array('min' => 12)); // WHERE activityOid > 12
     * </code>
     *
     * @see       filterByExpenseactivity()
     *
     * @param     mixed $activityoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByActivityoid($activityoid = null, $comparison = null)
    {
        if (is_array($activityoid)) {
            $useMinMax = false;
            if (isset($activityoid['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_ACTIVITYOID, $activityoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($activityoid['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_ACTIVITYOID, $activityoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensesTableMap::COL_ACTIVITYOID, $activityoid, $comparison);
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
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByLineofbusinessoid($lineofbusinessoid = null, $comparison = null)
    {
        if (is_array($lineofbusinessoid)) {
            $useMinMax = false;
            if (isset($lineofbusinessoid['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lineofbusinessoid['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensesTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid, $comparison);
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount > 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensesTableMap::COL_AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query on the categoryOid column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryoid(1234); // WHERE categoryOid = 1234
     * $query->filterByCategoryoid(array(12, 34)); // WHERE categoryOid IN (12, 34)
     * $query->filterByCategoryoid(array('min' => 12)); // WHERE categoryOid > 12
     * </code>
     *
     * @see       filterByExpensecategory()
     *
     * @param     mixed $categoryoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByCategoryoid($categoryoid = null, $comparison = null)
    {
        if (is_array($categoryoid)) {
            $useMinMax = false;
            if (isset($categoryoid['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_CATEGORYOID, $categoryoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryoid['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_CATEGORYOID, $categoryoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensesTableMap::COL_CATEGORYOID, $categoryoid, $comparison);
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
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensesTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensesTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Expenseactivity object
     *
     * @param \lwops\lwops\Expenseactivity|ObjectCollection $expenseactivity The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByExpenseactivity($expenseactivity, $comparison = null)
    {
        if ($expenseactivity instanceof \lwops\lwops\Expenseactivity) {
            return $this
                ->addUsingAlias(ExpensesTableMap::COL_ACTIVITYOID, $expenseactivity->getOid(), $comparison);
        } elseif ($expenseactivity instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpensesTableMap::COL_ACTIVITYOID, $expenseactivity->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByExpenseactivity() only accepts arguments of type \lwops\lwops\Expenseactivity or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Expenseactivity relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function joinExpenseactivity($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Expenseactivity');

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
            $this->addJoinObject($join, 'Expenseactivity');
        }

        return $this;
    }

    /**
     * Use the Expenseactivity relation Expenseactivity object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\ExpenseactivityQuery A secondary query class using the current class as primary query
     */
    public function useExpenseactivityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenseactivity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Expenseactivity', '\lwops\lwops\ExpenseactivityQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Lineofbusiness object
     *
     * @param \lwops\lwops\Lineofbusiness|ObjectCollection $lineofbusiness The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByLineofbusiness($lineofbusiness, $comparison = null)
    {
        if ($lineofbusiness instanceof \lwops\lwops\Lineofbusiness) {
            return $this
                ->addUsingAlias(ExpensesTableMap::COL_LINEOFBUSINESSOID, $lineofbusiness->getOid(), $comparison);
        } elseif ($lineofbusiness instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpensesTableMap::COL_LINEOFBUSINESSOID, $lineofbusiness->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildExpensesQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Expensecategory object
     *
     * @param \lwops\lwops\Expensecategory|ObjectCollection $expensecategory The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildExpensesQuery The current query, for fluid interface
     */
    public function filterByExpensecategory($expensecategory, $comparison = null)
    {
        if ($expensecategory instanceof \lwops\lwops\Expensecategory) {
            return $this
                ->addUsingAlias(ExpensesTableMap::COL_CATEGORYOID, $expensecategory->getOid(), $comparison);
        } elseif ($expensecategory instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpensesTableMap::COL_CATEGORYOID, $expensecategory->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByExpensecategory() only accepts arguments of type \lwops\lwops\Expensecategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Expensecategory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function joinExpensecategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Expensecategory');

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
            $this->addJoinObject($join, 'Expensecategory');
        }

        return $this;
    }

    /**
     * Use the Expensecategory relation Expensecategory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\ExpensecategoryQuery A secondary query class using the current class as primary query
     */
    public function useExpensecategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpensecategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Expensecategory', '\lwops\lwops\ExpensecategoryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildExpenses $expenses Object to remove from the list of results
     *
     * @return $this|ChildExpensesQuery The current query, for fluid interface
     */
    public function prune($expenses = null)
    {
        if ($expenses) {
            $this->addUsingAlias(ExpensesTableMap::COL_OID, $expenses->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the expenses table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpensesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ExpensesTableMap::clearInstancePool();
            ExpensesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpensesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ExpensesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ExpensesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ExpensesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ExpensesQuery
