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
use lwops\lwops\Horticultureproduceparent as ChildHorticultureproduceparent;
use lwops\lwops\HorticultureproduceparentQuery as ChildHorticultureproduceparentQuery;
use lwops\lwops\Map\HorticultureproduceparentTableMap;

/**
 * Base class that represents a query for the 'horticultureproduceparent' table.
 *
 *
 *
 * @method     ChildHorticultureproduceparentQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildHorticultureproduceparentQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildHorticultureproduceparentQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildHorticultureproduceparentQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildHorticultureproduceparentQuery groupByOid() Group by the oid column
 * @method     ChildHorticultureproduceparentQuery groupByName() Group by the name column
 * @method     ChildHorticultureproduceparentQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildHorticultureproduceparentQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildHorticultureproduceparentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHorticultureproduceparentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHorticultureproduceparentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHorticultureproduceparentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHorticultureproduceparentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHorticultureproduceparentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHorticultureproduceparentQuery leftJoinHorticultureproducedetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproduceparentQuery rightJoinHorticultureproducedetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproduceparentQuery innerJoinHorticultureproducedetail($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticultureproducedetail relation
 *
 * @method     ChildHorticultureproduceparentQuery joinWithHorticultureproducedetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticultureproducedetail relation
 *
 * @method     ChildHorticultureproduceparentQuery leftJoinWithHorticultureproducedetail() Adds a LEFT JOIN clause and with to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproduceparentQuery rightJoinWithHorticultureproducedetail() Adds a RIGHT JOIN clause and with to the query using the Horticultureproducedetail relation
 * @method     ChildHorticultureproduceparentQuery innerJoinWithHorticultureproducedetail() Adds a INNER JOIN clause and with to the query using the Horticultureproducedetail relation
 *
 * @method     ChildHorticultureproduceparentQuery leftJoinHorticulturesales($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticulturesales relation
 * @method     ChildHorticultureproduceparentQuery rightJoinHorticulturesales($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticulturesales relation
 * @method     ChildHorticultureproduceparentQuery innerJoinHorticulturesales($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticulturesales relation
 *
 * @method     ChildHorticultureproduceparentQuery joinWithHorticulturesales($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticulturesales relation
 *
 * @method     ChildHorticultureproduceparentQuery leftJoinWithHorticulturesales() Adds a LEFT JOIN clause and with to the query using the Horticulturesales relation
 * @method     ChildHorticultureproduceparentQuery rightJoinWithHorticulturesales() Adds a RIGHT JOIN clause and with to the query using the Horticulturesales relation
 * @method     ChildHorticultureproduceparentQuery innerJoinWithHorticulturesales() Adds a INNER JOIN clause and with to the query using the Horticulturesales relation
 *
 * @method     \lwops\lwops\HorticultureproducedetailQuery|\lwops\lwops\HorticulturesalesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHorticultureproduceparent findOne(ConnectionInterface $con = null) Return the first ChildHorticultureproduceparent matching the query
 * @method     ChildHorticultureproduceparent findOneOrCreate(ConnectionInterface $con = null) Return the first ChildHorticultureproduceparent matching the query, or a new ChildHorticultureproduceparent object populated from the query conditions when no match is found
 *
 * @method     ChildHorticultureproduceparent findOneByOid(int $oid) Return the first ChildHorticultureproduceparent filtered by the oid column
 * @method     ChildHorticultureproduceparent findOneByName(string $name) Return the first ChildHorticultureproduceparent filtered by the name column
 * @method     ChildHorticultureproduceparent findOneByCreatetmstp(string $createTmstp) Return the first ChildHorticultureproduceparent filtered by the createTmstp column
 * @method     ChildHorticultureproduceparent findOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticultureproduceparent filtered by the updtTmstp column *

 * @method     ChildHorticultureproduceparent requirePk($key, ConnectionInterface $con = null) Return the ChildHorticultureproduceparent by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproduceparent requireOne(ConnectionInterface $con = null) Return the first ChildHorticultureproduceparent matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticultureproduceparent requireOneByOid(int $oid) Return the first ChildHorticultureproduceparent filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproduceparent requireOneByName(string $name) Return the first ChildHorticultureproduceparent filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproduceparent requireOneByCreatetmstp(string $createTmstp) Return the first ChildHorticultureproduceparent filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticultureproduceparent requireOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticultureproduceparent filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticultureproduceparent[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildHorticultureproduceparent objects based on current ModelCriteria
 * @method     ChildHorticultureproduceparent[]|ObjectCollection findByOid(int $oid) Return ChildHorticultureproduceparent objects filtered by the oid column
 * @method     ChildHorticultureproduceparent[]|ObjectCollection findByName(string $name) Return ChildHorticultureproduceparent objects filtered by the name column
 * @method     ChildHorticultureproduceparent[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildHorticultureproduceparent objects filtered by the createTmstp column
 * @method     ChildHorticultureproduceparent[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildHorticultureproduceparent objects filtered by the updtTmstp column
 * @method     ChildHorticultureproduceparent[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HorticultureproduceparentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\HorticultureproduceparentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Horticultureproduceparent', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHorticultureproduceparentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHorticultureproduceparentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildHorticultureproduceparentQuery) {
            return $criteria;
        }
        $query = new ChildHorticultureproduceparentQuery();
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
     * @return ChildHorticultureproduceparent|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HorticultureproduceparentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HorticultureproduceparentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHorticultureproduceparent A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, name, createTmstp, updtTmstp FROM horticultureproduceparent WHERE oid = :p0';
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
            /** @var ChildHorticultureproduceparent $obj */
            $obj = new ChildHorticultureproduceparent();
            $obj->hydrate($row);
            HorticultureproduceparentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHorticultureproduceparent|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildHorticultureproduceparentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HorticultureproduceparentTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildHorticultureproduceparentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HorticultureproduceparentTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildHorticultureproduceparentQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(HorticultureproduceparentTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(HorticultureproduceparentTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproduceparentTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticultureproduceparentQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproduceparentTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildHorticultureproduceparentQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(HorticultureproduceparentTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(HorticultureproduceparentTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproduceparentTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildHorticultureproduceparentQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(HorticultureproduceparentTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(HorticultureproduceparentTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticultureproduceparentTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Horticultureproducedetail object
     *
     * @param \lwops\lwops\Horticultureproducedetail|ObjectCollection $horticultureproducedetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHorticultureproduceparentQuery The current query, for fluid interface
     */
    public function filterByHorticultureproducedetail($horticultureproducedetail, $comparison = null)
    {
        if ($horticultureproducedetail instanceof \lwops\lwops\Horticultureproducedetail) {
            return $this
                ->addUsingAlias(HorticultureproduceparentTableMap::COL_OID, $horticultureproducedetail->getHorticultureproduceparentoid(), $comparison);
        } elseif ($horticultureproducedetail instanceof ObjectCollection) {
            return $this
                ->useHorticultureproducedetailQuery()
                ->filterByPrimaryKeys($horticultureproducedetail->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildHorticultureproduceparentQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Horticulturesales object
     *
     * @param \lwops\lwops\Horticulturesales|ObjectCollection $horticulturesales the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHorticultureproduceparentQuery The current query, for fluid interface
     */
    public function filterByHorticulturesales($horticulturesales, $comparison = null)
    {
        if ($horticulturesales instanceof \lwops\lwops\Horticulturesales) {
            return $this
                ->addUsingAlias(HorticultureproduceparentTableMap::COL_OID, $horticulturesales->getHorticultureproduceparentoid(), $comparison);
        } elseif ($horticulturesales instanceof ObjectCollection) {
            return $this
                ->useHorticulturesalesQuery()
                ->filterByPrimaryKeys($horticulturesales->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByHorticulturesales() only accepts arguments of type \lwops\lwops\Horticulturesales or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Horticulturesales relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHorticultureproduceparentQuery The current query, for fluid interface
     */
    public function joinHorticulturesales($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Horticulturesales');

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
            $this->addJoinObject($join, 'Horticulturesales');
        }

        return $this;
    }

    /**
     * Use the Horticulturesales relation Horticulturesales object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\HorticulturesalesQuery A secondary query class using the current class as primary query
     */
    public function useHorticulturesalesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHorticulturesales($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Horticulturesales', '\lwops\lwops\HorticulturesalesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildHorticultureproduceparent $horticultureproduceparent Object to remove from the list of results
     *
     * @return $this|ChildHorticultureproduceparentQuery The current query, for fluid interface
     */
    public function prune($horticultureproduceparent = null)
    {
        if ($horticultureproduceparent) {
            $this->addUsingAlias(HorticultureproduceparentTableMap::COL_OID, $horticultureproduceparent->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the horticultureproduceparent table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproduceparentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HorticultureproduceparentTableMap::clearInstancePool();
            HorticultureproduceparentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproduceparentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HorticultureproduceparentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HorticultureproduceparentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HorticultureproduceparentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // HorticultureproduceparentQuery
