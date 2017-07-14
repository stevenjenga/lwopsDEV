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
use lwops\lwops\Electricityaccount as ChildElectricityaccount;
use lwops\lwops\ElectricityaccountQuery as ChildElectricityaccountQuery;
use lwops\lwops\Map\ElectricityaccountTableMap;

/**
 * Base class that represents a query for the 'electricityaccount' table.
 *
 *
 *
 * @method     ChildElectricityaccountQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildElectricityaccountQuery orderByAccountnbr($order = Criteria::ASC) Order by the accountNbr column
 * @method     ChildElectricityaccountQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildElectricityaccountQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildElectricityaccountQuery groupByOid() Group by the oid column
 * @method     ChildElectricityaccountQuery groupByAccountnbr() Group by the accountNbr column
 * @method     ChildElectricityaccountQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildElectricityaccountQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildElectricityaccountQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildElectricityaccountQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildElectricityaccountQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildElectricityaccountQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildElectricityaccountQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildElectricityaccountQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildElectricityaccountQuery leftJoinElectricityallocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Electricityallocation relation
 * @method     ChildElectricityaccountQuery rightJoinElectricityallocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Electricityallocation relation
 * @method     ChildElectricityaccountQuery innerJoinElectricityallocation($relationAlias = null) Adds a INNER JOIN clause to the query using the Electricityallocation relation
 *
 * @method     ChildElectricityaccountQuery joinWithElectricityallocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Electricityallocation relation
 *
 * @method     ChildElectricityaccountQuery leftJoinWithElectricityallocation() Adds a LEFT JOIN clause and with to the query using the Electricityallocation relation
 * @method     ChildElectricityaccountQuery rightJoinWithElectricityallocation() Adds a RIGHT JOIN clause and with to the query using the Electricityallocation relation
 * @method     ChildElectricityaccountQuery innerJoinWithElectricityallocation() Adds a INNER JOIN clause and with to the query using the Electricityallocation relation
 *
 * @method     ChildElectricityaccountQuery leftJoinElectricityexpense($relationAlias = null) Adds a LEFT JOIN clause to the query using the Electricityexpense relation
 * @method     ChildElectricityaccountQuery rightJoinElectricityexpense($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Electricityexpense relation
 * @method     ChildElectricityaccountQuery innerJoinElectricityexpense($relationAlias = null) Adds a INNER JOIN clause to the query using the Electricityexpense relation
 *
 * @method     ChildElectricityaccountQuery joinWithElectricityexpense($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Electricityexpense relation
 *
 * @method     ChildElectricityaccountQuery leftJoinWithElectricityexpense() Adds a LEFT JOIN clause and with to the query using the Electricityexpense relation
 * @method     ChildElectricityaccountQuery rightJoinWithElectricityexpense() Adds a RIGHT JOIN clause and with to the query using the Electricityexpense relation
 * @method     ChildElectricityaccountQuery innerJoinWithElectricityexpense() Adds a INNER JOIN clause and with to the query using the Electricityexpense relation
 *
 * @method     \lwops\lwops\ElectricityallocationQuery|\lwops\lwops\ElectricityexpenseQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildElectricityaccount findOne(ConnectionInterface $con = null) Return the first ChildElectricityaccount matching the query
 * @method     ChildElectricityaccount findOneOrCreate(ConnectionInterface $con = null) Return the first ChildElectricityaccount matching the query, or a new ChildElectricityaccount object populated from the query conditions when no match is found
 *
 * @method     ChildElectricityaccount findOneByOid(int $oid) Return the first ChildElectricityaccount filtered by the oid column
 * @method     ChildElectricityaccount findOneByAccountnbr(string $accountNbr) Return the first ChildElectricityaccount filtered by the accountNbr column
 * @method     ChildElectricityaccount findOneByCreatetmstp(string $createTmstp) Return the first ChildElectricityaccount filtered by the createTmstp column
 * @method     ChildElectricityaccount findOneByUpdttmstp(string $updtTmstp) Return the first ChildElectricityaccount filtered by the updtTmstp column *

 * @method     ChildElectricityaccount requirePk($key, ConnectionInterface $con = null) Return the ChildElectricityaccount by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityaccount requireOne(ConnectionInterface $con = null) Return the first ChildElectricityaccount matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildElectricityaccount requireOneByOid(int $oid) Return the first ChildElectricityaccount filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityaccount requireOneByAccountnbr(string $accountNbr) Return the first ChildElectricityaccount filtered by the accountNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityaccount requireOneByCreatetmstp(string $createTmstp) Return the first ChildElectricityaccount filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectricityaccount requireOneByUpdttmstp(string $updtTmstp) Return the first ChildElectricityaccount filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildElectricityaccount[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildElectricityaccount objects based on current ModelCriteria
 * @method     ChildElectricityaccount[]|ObjectCollection findByOid(int $oid) Return ChildElectricityaccount objects filtered by the oid column
 * @method     ChildElectricityaccount[]|ObjectCollection findByAccountnbr(string $accountNbr) Return ChildElectricityaccount objects filtered by the accountNbr column
 * @method     ChildElectricityaccount[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildElectricityaccount objects filtered by the createTmstp column
 * @method     ChildElectricityaccount[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildElectricityaccount objects filtered by the updtTmstp column
 * @method     ChildElectricityaccount[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ElectricityaccountQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\ElectricityaccountQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Electricityaccount', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildElectricityaccountQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildElectricityaccountQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildElectricityaccountQuery) {
            return $criteria;
        }
        $query = new ChildElectricityaccountQuery();
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
     * @return ChildElectricityaccount|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ElectricityaccountTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ElectricityaccountTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildElectricityaccount A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, accountNbr, createTmstp, updtTmstp FROM electricityaccount WHERE oid = :p0';
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
            /** @var ChildElectricityaccount $obj */
            $obj = new ChildElectricityaccount();
            $obj->hydrate($row);
            ElectricityaccountTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildElectricityaccount|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildElectricityaccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ElectricityaccountTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildElectricityaccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ElectricityaccountTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildElectricityaccountQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(ElectricityaccountTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(ElectricityaccountTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityaccountTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the accountNbr column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountnbr('fooValue');   // WHERE accountNbr = 'fooValue'
     * $query->filterByAccountnbr('%fooValue%', Criteria::LIKE); // WHERE accountNbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accountnbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElectricityaccountQuery The current query, for fluid interface
     */
    public function filterByAccountnbr($accountnbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accountnbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityaccountTableMap::COL_ACCOUNTNBR, $accountnbr, $comparison);
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
     * @return $this|ChildElectricityaccountQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(ElectricityaccountTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(ElectricityaccountTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityaccountTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildElectricityaccountQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(ElectricityaccountTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(ElectricityaccountTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectricityaccountTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Electricityallocation object
     *
     * @param \lwops\lwops\Electricityallocation|ObjectCollection $electricityallocation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildElectricityaccountQuery The current query, for fluid interface
     */
    public function filterByElectricityallocation($electricityallocation, $comparison = null)
    {
        if ($electricityallocation instanceof \lwops\lwops\Electricityallocation) {
            return $this
                ->addUsingAlias(ElectricityaccountTableMap::COL_OID, $electricityallocation->getElectricityaccountoid(), $comparison);
        } elseif ($electricityallocation instanceof ObjectCollection) {
            return $this
                ->useElectricityallocationQuery()
                ->filterByPrimaryKeys($electricityallocation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByElectricityallocation() only accepts arguments of type \lwops\lwops\Electricityallocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Electricityallocation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildElectricityaccountQuery The current query, for fluid interface
     */
    public function joinElectricityallocation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Electricityallocation');

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
            $this->addJoinObject($join, 'Electricityallocation');
        }

        return $this;
    }

    /**
     * Use the Electricityallocation relation Electricityallocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\ElectricityallocationQuery A secondary query class using the current class as primary query
     */
    public function useElectricityallocationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinElectricityallocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Electricityallocation', '\lwops\lwops\ElectricityallocationQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Electricityexpense object
     *
     * @param \lwops\lwops\Electricityexpense|ObjectCollection $electricityexpense the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildElectricityaccountQuery The current query, for fluid interface
     */
    public function filterByElectricityexpense($electricityexpense, $comparison = null)
    {
        if ($electricityexpense instanceof \lwops\lwops\Electricityexpense) {
            return $this
                ->addUsingAlias(ElectricityaccountTableMap::COL_OID, $electricityexpense->getElectricityaccounoid(), $comparison);
        } elseif ($electricityexpense instanceof ObjectCollection) {
            return $this
                ->useElectricityexpenseQuery()
                ->filterByPrimaryKeys($electricityexpense->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByElectricityexpense() only accepts arguments of type \lwops\lwops\Electricityexpense or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Electricityexpense relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildElectricityaccountQuery The current query, for fluid interface
     */
    public function joinElectricityexpense($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Electricityexpense');

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
            $this->addJoinObject($join, 'Electricityexpense');
        }

        return $this;
    }

    /**
     * Use the Electricityexpense relation Electricityexpense object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\ElectricityexpenseQuery A secondary query class using the current class as primary query
     */
    public function useElectricityexpenseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinElectricityexpense($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Electricityexpense', '\lwops\lwops\ElectricityexpenseQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildElectricityaccount $electricityaccount Object to remove from the list of results
     *
     * @return $this|ChildElectricityaccountQuery The current query, for fluid interface
     */
    public function prune($electricityaccount = null)
    {
        if ($electricityaccount) {
            $this->addUsingAlias(ElectricityaccountTableMap::COL_OID, $electricityaccount->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the electricityaccount table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ElectricityaccountTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ElectricityaccountTableMap::clearInstancePool();
            ElectricityaccountTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ElectricityaccountTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ElectricityaccountTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ElectricityaccountTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ElectricityaccountTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ElectricityaccountQuery
