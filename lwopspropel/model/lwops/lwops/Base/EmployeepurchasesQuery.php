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
use lwops\lwops\Employeepurchases as ChildEmployeepurchases;
use lwops\lwops\EmployeepurchasesQuery as ChildEmployeepurchasesQuery;
use lwops\lwops\Map\EmployeepurchasesTableMap;

/**
 * Base class that represents a query for the 'employeepurchases' table.
 *
 *
 *
 * @method     ChildEmployeepurchasesQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildEmployeepurchasesQuery orderByPurchasedt($order = Criteria::ASC) Order by the purchaseDt column
 * @method     ChildEmployeepurchasesQuery orderByEmployeeoid($order = Criteria::ASC) Order by the employeeOid column
 * @method     ChildEmployeepurchasesQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 * @method     ChildEmployeepurchasesQuery orderByProductunittype($order = Criteria::ASC) Order by the productUnitType column
 * @method     ChildEmployeepurchasesQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildEmployeepurchasesQuery orderByUnitprice($order = Criteria::ASC) Order by the unitPrice column
 * @method     ChildEmployeepurchasesQuery orderByLineofbusinessoid($order = Criteria::ASC) Order by the lineOfBusinessOid column
 * @method     ChildEmployeepurchasesQuery orderByPaidflg($order = Criteria::ASC) Order by the paidFlg column
 * @method     ChildEmployeepurchasesQuery orderByPayslipnbr($order = Criteria::ASC) Order by the payslipNbr column
 * @method     ChildEmployeepurchasesQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildEmployeepurchasesQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildEmployeepurchasesQuery groupByOid() Group by the oid column
 * @method     ChildEmployeepurchasesQuery groupByPurchasedt() Group by the purchaseDt column
 * @method     ChildEmployeepurchasesQuery groupByEmployeeoid() Group by the employeeOid column
 * @method     ChildEmployeepurchasesQuery groupByQuantity() Group by the quantity column
 * @method     ChildEmployeepurchasesQuery groupByProductunittype() Group by the productUnitType column
 * @method     ChildEmployeepurchasesQuery groupByDescription() Group by the description column
 * @method     ChildEmployeepurchasesQuery groupByUnitprice() Group by the unitPrice column
 * @method     ChildEmployeepurchasesQuery groupByLineofbusinessoid() Group by the lineOfBusinessOid column
 * @method     ChildEmployeepurchasesQuery groupByPaidflg() Group by the paidFlg column
 * @method     ChildEmployeepurchasesQuery groupByPayslipnbr() Group by the payslipNbr column
 * @method     ChildEmployeepurchasesQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildEmployeepurchasesQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildEmployeepurchasesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeepurchasesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeepurchasesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeepurchasesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeepurchasesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeepurchasesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeepurchasesQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildEmployeepurchasesQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildEmployeepurchasesQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildEmployeepurchasesQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildEmployeepurchasesQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildEmployeepurchasesQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildEmployeepurchasesQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildEmployeepurchasesQuery leftJoinLineofbusiness($relationAlias = null) Adds a LEFT JOIN clause to the query using the Lineofbusiness relation
 * @method     ChildEmployeepurchasesQuery rightJoinLineofbusiness($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Lineofbusiness relation
 * @method     ChildEmployeepurchasesQuery innerJoinLineofbusiness($relationAlias = null) Adds a INNER JOIN clause to the query using the Lineofbusiness relation
 *
 * @method     ChildEmployeepurchasesQuery joinWithLineofbusiness($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Lineofbusiness relation
 *
 * @method     ChildEmployeepurchasesQuery leftJoinWithLineofbusiness() Adds a LEFT JOIN clause and with to the query using the Lineofbusiness relation
 * @method     ChildEmployeepurchasesQuery rightJoinWithLineofbusiness() Adds a RIGHT JOIN clause and with to the query using the Lineofbusiness relation
 * @method     ChildEmployeepurchasesQuery innerJoinWithLineofbusiness() Adds a INNER JOIN clause and with to the query using the Lineofbusiness relation
 *
 * @method     ChildEmployeepurchasesQuery leftJoinProductunit($relationAlias = null) Adds a LEFT JOIN clause to the query using the Productunit relation
 * @method     ChildEmployeepurchasesQuery rightJoinProductunit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Productunit relation
 * @method     ChildEmployeepurchasesQuery innerJoinProductunit($relationAlias = null) Adds a INNER JOIN clause to the query using the Productunit relation
 *
 * @method     ChildEmployeepurchasesQuery joinWithProductunit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Productunit relation
 *
 * @method     ChildEmployeepurchasesQuery leftJoinWithProductunit() Adds a LEFT JOIN clause and with to the query using the Productunit relation
 * @method     ChildEmployeepurchasesQuery rightJoinWithProductunit() Adds a RIGHT JOIN clause and with to the query using the Productunit relation
 * @method     ChildEmployeepurchasesQuery innerJoinWithProductunit() Adds a INNER JOIN clause and with to the query using the Productunit relation
 *
 * @method     \lwops\lwops\EmployeeQuery|\lwops\lwops\LineofbusinessQuery|\lwops\lwops\ProductunitQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployeepurchases findOne(ConnectionInterface $con = null) Return the first ChildEmployeepurchases matching the query
 * @method     ChildEmployeepurchases findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmployeepurchases matching the query, or a new ChildEmployeepurchases object populated from the query conditions when no match is found
 *
 * @method     ChildEmployeepurchases findOneByOid(int $oid) Return the first ChildEmployeepurchases filtered by the oid column
 * @method     ChildEmployeepurchases findOneByPurchasedt(string $purchaseDt) Return the first ChildEmployeepurchases filtered by the purchaseDt column
 * @method     ChildEmployeepurchases findOneByEmployeeoid(int $employeeOid) Return the first ChildEmployeepurchases filtered by the employeeOid column
 * @method     ChildEmployeepurchases findOneByQuantity(int $quantity) Return the first ChildEmployeepurchases filtered by the quantity column
 * @method     ChildEmployeepurchases findOneByProductunittype(string $productUnitType) Return the first ChildEmployeepurchases filtered by the productUnitType column
 * @method     ChildEmployeepurchases findOneByDescription(string $description) Return the first ChildEmployeepurchases filtered by the description column
 * @method     ChildEmployeepurchases findOneByUnitprice(double $unitPrice) Return the first ChildEmployeepurchases filtered by the unitPrice column
 * @method     ChildEmployeepurchases findOneByLineofbusinessoid(int $lineOfBusinessOid) Return the first ChildEmployeepurchases filtered by the lineOfBusinessOid column
 * @method     ChildEmployeepurchases findOneByPaidflg(int $paidFlg) Return the first ChildEmployeepurchases filtered by the paidFlg column
 * @method     ChildEmployeepurchases findOneByPayslipnbr(string $payslipNbr) Return the first ChildEmployeepurchases filtered by the payslipNbr column
 * @method     ChildEmployeepurchases findOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeepurchases filtered by the createTmstp column
 * @method     ChildEmployeepurchases findOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeepurchases filtered by the updtTmstp column *

 * @method     ChildEmployeepurchases requirePk($key, ConnectionInterface $con = null) Return the ChildEmployeepurchases by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeepurchases requireOne(ConnectionInterface $con = null) Return the first ChildEmployeepurchases matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeepurchases requireOneByOid(int $oid) Return the first ChildEmployeepurchases filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeepurchases requireOneByPurchasedt(string $purchaseDt) Return the first ChildEmployeepurchases filtered by the purchaseDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeepurchases requireOneByEmployeeoid(int $employeeOid) Return the first ChildEmployeepurchases filtered by the employeeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeepurchases requireOneByQuantity(int $quantity) Return the first ChildEmployeepurchases filtered by the quantity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeepurchases requireOneByProductunittype(string $productUnitType) Return the first ChildEmployeepurchases filtered by the productUnitType column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeepurchases requireOneByDescription(string $description) Return the first ChildEmployeepurchases filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeepurchases requireOneByUnitprice(double $unitPrice) Return the first ChildEmployeepurchases filtered by the unitPrice column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeepurchases requireOneByLineofbusinessoid(int $lineOfBusinessOid) Return the first ChildEmployeepurchases filtered by the lineOfBusinessOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeepurchases requireOneByPaidflg(int $paidFlg) Return the first ChildEmployeepurchases filtered by the paidFlg column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeepurchases requireOneByPayslipnbr(string $payslipNbr) Return the first ChildEmployeepurchases filtered by the payslipNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeepurchases requireOneByCreatetmstp(string $createTmstp) Return the first ChildEmployeepurchases filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeepurchases requireOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployeepurchases filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeepurchases[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmployeepurchases objects based on current ModelCriteria
 * @method     ChildEmployeepurchases[]|ObjectCollection findByOid(int $oid) Return ChildEmployeepurchases objects filtered by the oid column
 * @method     ChildEmployeepurchases[]|ObjectCollection findByPurchasedt(string $purchaseDt) Return ChildEmployeepurchases objects filtered by the purchaseDt column
 * @method     ChildEmployeepurchases[]|ObjectCollection findByEmployeeoid(int $employeeOid) Return ChildEmployeepurchases objects filtered by the employeeOid column
 * @method     ChildEmployeepurchases[]|ObjectCollection findByQuantity(int $quantity) Return ChildEmployeepurchases objects filtered by the quantity column
 * @method     ChildEmployeepurchases[]|ObjectCollection findByProductunittype(string $productUnitType) Return ChildEmployeepurchases objects filtered by the productUnitType column
 * @method     ChildEmployeepurchases[]|ObjectCollection findByDescription(string $description) Return ChildEmployeepurchases objects filtered by the description column
 * @method     ChildEmployeepurchases[]|ObjectCollection findByUnitprice(double $unitPrice) Return ChildEmployeepurchases objects filtered by the unitPrice column
 * @method     ChildEmployeepurchases[]|ObjectCollection findByLineofbusinessoid(int $lineOfBusinessOid) Return ChildEmployeepurchases objects filtered by the lineOfBusinessOid column
 * @method     ChildEmployeepurchases[]|ObjectCollection findByPaidflg(int $paidFlg) Return ChildEmployeepurchases objects filtered by the paidFlg column
 * @method     ChildEmployeepurchases[]|ObjectCollection findByPayslipnbr(string $payslipNbr) Return ChildEmployeepurchases objects filtered by the payslipNbr column
 * @method     ChildEmployeepurchases[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildEmployeepurchases objects filtered by the createTmstp column
 * @method     ChildEmployeepurchases[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildEmployeepurchases objects filtered by the updtTmstp column
 * @method     ChildEmployeepurchases[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmployeepurchasesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\EmployeepurchasesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Employeepurchases', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeepurchasesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeepurchasesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmployeepurchasesQuery) {
            return $criteria;
        }
        $query = new ChildEmployeepurchasesQuery();
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
     * @return ChildEmployeepurchases|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeepurchasesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeepurchasesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployeepurchases A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, purchaseDt, employeeOid, quantity, productUnitType, description, unitPrice, lineOfBusinessOid, paidFlg, payslipNbr, createTmstp, updtTmstp FROM employeepurchases WHERE oid = :p0';
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
            /** @var ChildEmployeepurchases $obj */
            $obj = new ChildEmployeepurchases();
            $obj->hydrate($row);
            EmployeepurchasesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployeepurchases|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmployeepurchasesTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmployeepurchasesTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeepurchasesTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the purchaseDt column
     *
     * Example usage:
     * <code>
     * $query->filterByPurchasedt('2011-03-14'); // WHERE purchaseDt = '2011-03-14'
     * $query->filterByPurchasedt('now'); // WHERE purchaseDt = '2011-03-14'
     * $query->filterByPurchasedt(array('max' => 'yesterday')); // WHERE purchaseDt > '2011-03-13'
     * </code>
     *
     * @param     mixed $purchasedt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByPurchasedt($purchasedt = null, $comparison = null)
    {
        if (is_array($purchasedt)) {
            $useMinMax = false;
            if (isset($purchasedt['min'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_PURCHASEDT, $purchasedt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($purchasedt['max'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_PURCHASEDT, $purchasedt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeepurchasesTableMap::COL_PURCHASEDT, $purchasedt, $comparison);
    }

    /**
     * Filter the query on the employeeOid column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeoid(1234); // WHERE employeeOid = 1234
     * $query->filterByEmployeeoid(array(12, 34)); // WHERE employeeOid IN (12, 34)
     * $query->filterByEmployeeoid(array('min' => 12)); // WHERE employeeOid > 12
     * </code>
     *
     * @see       filterByEmployee()
     *
     * @param     mixed $employeeoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByEmployeeoid($employeeoid = null, $comparison = null)
    {
        if (is_array($employeeoid)) {
            $useMinMax = false;
            if (isset($employeeoid['min'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_EMPLOYEEOID, $employeeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeoid['max'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_EMPLOYEEOID, $employeeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeepurchasesTableMap::COL_EMPLOYEEOID, $employeeoid, $comparison);
    }

    /**
     * Filter the query on the quantity column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantity(1234); // WHERE quantity = 1234
     * $query->filterByQuantity(array(12, 34)); // WHERE quantity IN (12, 34)
     * $query->filterByQuantity(array('min' => 12)); // WHERE quantity > 12
     * </code>
     *
     * @param     mixed $quantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByQuantity($quantity = null, $comparison = null)
    {
        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeepurchasesTableMap::COL_QUANTITY, $quantity, $comparison);
    }

    /**
     * Filter the query on the productUnitType column
     *
     * Example usage:
     * <code>
     * $query->filterByProductunittype('fooValue');   // WHERE productUnitType = 'fooValue'
     * $query->filterByProductunittype('%fooValue%', Criteria::LIKE); // WHERE productUnitType LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productunittype The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByProductunittype($productunittype = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productunittype)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeepurchasesTableMap::COL_PRODUCTUNITTYPE, $productunittype, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeepurchasesTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the unitPrice column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitprice(1234); // WHERE unitPrice = 1234
     * $query->filterByUnitprice(array(12, 34)); // WHERE unitPrice IN (12, 34)
     * $query->filterByUnitprice(array('min' => 12)); // WHERE unitPrice > 12
     * </code>
     *
     * @param     mixed $unitprice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByUnitprice($unitprice = null, $comparison = null)
    {
        if (is_array($unitprice)) {
            $useMinMax = false;
            if (isset($unitprice['min'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_UNITPRICE, $unitprice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitprice['max'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_UNITPRICE, $unitprice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeepurchasesTableMap::COL_UNITPRICE, $unitprice, $comparison);
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
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByLineofbusinessoid($lineofbusinessoid = null, $comparison = null)
    {
        if (is_array($lineofbusinessoid)) {
            $useMinMax = false;
            if (isset($lineofbusinessoid['min'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lineofbusinessoid['max'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeepurchasesTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid, $comparison);
    }

    /**
     * Filter the query on the paidFlg column
     *
     * Example usage:
     * <code>
     * $query->filterByPaidflg(1234); // WHERE paidFlg = 1234
     * $query->filterByPaidflg(array(12, 34)); // WHERE paidFlg IN (12, 34)
     * $query->filterByPaidflg(array('min' => 12)); // WHERE paidFlg > 12
     * </code>
     *
     * @param     mixed $paidflg The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByPaidflg($paidflg = null, $comparison = null)
    {
        if (is_array($paidflg)) {
            $useMinMax = false;
            if (isset($paidflg['min'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_PAIDFLG, $paidflg['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($paidflg['max'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_PAIDFLG, $paidflg['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeepurchasesTableMap::COL_PAIDFLG, $paidflg, $comparison);
    }

    /**
     * Filter the query on the payslipNbr column
     *
     * Example usage:
     * <code>
     * $query->filterByPayslipnbr('fooValue');   // WHERE payslipNbr = 'fooValue'
     * $query->filterByPayslipnbr('%fooValue%', Criteria::LIKE); // WHERE payslipNbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $payslipnbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByPayslipnbr($payslipnbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($payslipnbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeepurchasesTableMap::COL_PAYSLIPNBR, $payslipnbr, $comparison);
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
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeepurchasesTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(EmployeepurchasesTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeepurchasesTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Employee object
     *
     * @param \lwops\lwops\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \lwops\lwops\Employee) {
            return $this
                ->addUsingAlias(EmployeepurchasesTableMap::COL_EMPLOYEEOID, $employee->getOid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeepurchasesTableMap::COL_EMPLOYEEOID, $employee->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByEmployee() only accepts arguments of type \lwops\lwops\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employee relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function joinEmployee($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employee');

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
            $this->addJoinObject($join, 'Employee');
        }

        return $this;
    }

    /**
     * Use the Employee relation Employee object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employee', '\lwops\lwops\EmployeeQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Lineofbusiness object
     *
     * @param \lwops\lwops\Lineofbusiness|ObjectCollection $lineofbusiness The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByLineofbusiness($lineofbusiness, $comparison = null)
    {
        if ($lineofbusiness instanceof \lwops\lwops\Lineofbusiness) {
            return $this
                ->addUsingAlias(EmployeepurchasesTableMap::COL_LINEOFBUSINESSOID, $lineofbusiness->getOid(), $comparison);
        } elseif ($lineofbusiness instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeepurchasesTableMap::COL_LINEOFBUSINESSOID, $lineofbusiness->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Productunit object
     *
     * @param \lwops\lwops\Productunit|ObjectCollection $productunit The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function filterByProductunit($productunit, $comparison = null)
    {
        if ($productunit instanceof \lwops\lwops\Productunit) {
            return $this
                ->addUsingAlias(EmployeepurchasesTableMap::COL_PRODUCTUNITTYPE, $productunit->getUnit(), $comparison);
        } elseif ($productunit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeepurchasesTableMap::COL_PRODUCTUNITTYPE, $productunit->toKeyValue('PrimaryKey', 'Unit'), $comparison);
        } else {
            throw new PropelException('filterByProductunit() only accepts arguments of type \lwops\lwops\Productunit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Productunit relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function joinProductunit($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Productunit');

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
            $this->addJoinObject($join, 'Productunit');
        }

        return $this;
    }

    /**
     * Use the Productunit relation Productunit object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\ProductunitQuery A secondary query class using the current class as primary query
     */
    public function useProductunitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductunit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Productunit', '\lwops\lwops\ProductunitQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEmployeepurchases $employeepurchases Object to remove from the list of results
     *
     * @return $this|ChildEmployeepurchasesQuery The current query, for fluid interface
     */
    public function prune($employeepurchases = null)
    {
        if ($employeepurchases) {
            $this->addUsingAlias(EmployeepurchasesTableMap::COL_OID, $employeepurchases->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employeepurchases table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeepurchasesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeepurchasesTableMap::clearInstancePool();
            EmployeepurchasesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeepurchasesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeepurchasesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeepurchasesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeepurchasesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmployeepurchasesQuery
