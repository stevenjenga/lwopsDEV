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
use lwops\lwops\Horticulturebed as ChildHorticulturebed;
use lwops\lwops\HorticulturebedQuery as ChildHorticulturebedQuery;
use lwops\lwops\Map\HorticulturebedTableMap;

/**
 * Base class that represents a query for the 'horticulturebed' table.
 *
 *
 *
 * @method     ChildHorticulturebedQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildHorticulturebedQuery orderByIdentifier($order = Criteria::ASC) Order by the identifier column
 * @method     ChildHorticulturebedQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildHorticulturebedQuery orderByLength($order = Criteria::ASC) Order by the length column
 * @method     ChildHorticulturebedQuery orderByWidth($order = Criteria::ASC) Order by the width column
 * @method     ChildHorticulturebedQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 * @method     ChildHorticulturebedQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 *
 * @method     ChildHorticulturebedQuery groupByOid() Group by the oid column
 * @method     ChildHorticulturebedQuery groupByIdentifier() Group by the identifier column
 * @method     ChildHorticulturebedQuery groupByType() Group by the type column
 * @method     ChildHorticulturebedQuery groupByLength() Group by the length column
 * @method     ChildHorticulturebedQuery groupByWidth() Group by the width column
 * @method     ChildHorticulturebedQuery groupByUpdttmstp() Group by the updtTmstp column
 * @method     ChildHorticulturebedQuery groupByCreatetmstp() Group by the createTmstp column
 *
 * @method     ChildHorticulturebedQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHorticulturebedQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHorticulturebedQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHorticulturebedQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHorticulturebedQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHorticulturebedQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHorticulturebedQuery leftJoinHorticultureproducebed($relationAlias = null) Adds a LEFT JOIN clause to the query using the Horticultureproducebed relation
 * @method     ChildHorticulturebedQuery rightJoinHorticultureproducebed($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Horticultureproducebed relation
 * @method     ChildHorticulturebedQuery innerJoinHorticultureproducebed($relationAlias = null) Adds a INNER JOIN clause to the query using the Horticultureproducebed relation
 *
 * @method     ChildHorticulturebedQuery joinWithHorticultureproducebed($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Horticultureproducebed relation
 *
 * @method     ChildHorticulturebedQuery leftJoinWithHorticultureproducebed() Adds a LEFT JOIN clause and with to the query using the Horticultureproducebed relation
 * @method     ChildHorticulturebedQuery rightJoinWithHorticultureproducebed() Adds a RIGHT JOIN clause and with to the query using the Horticultureproducebed relation
 * @method     ChildHorticulturebedQuery innerJoinWithHorticultureproducebed() Adds a INNER JOIN clause and with to the query using the Horticultureproducebed relation
 *
 * @method     \lwops\lwops\HorticultureproducebedQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHorticulturebed findOne(ConnectionInterface $con = null) Return the first ChildHorticulturebed matching the query
 * @method     ChildHorticulturebed findOneOrCreate(ConnectionInterface $con = null) Return the first ChildHorticulturebed matching the query, or a new ChildHorticulturebed object populated from the query conditions when no match is found
 *
 * @method     ChildHorticulturebed findOneByOid(int $oid) Return the first ChildHorticulturebed filtered by the oid column
 * @method     ChildHorticulturebed findOneByIdentifier(int $identifier) Return the first ChildHorticulturebed filtered by the identifier column
 * @method     ChildHorticulturebed findOneByType(string $type) Return the first ChildHorticulturebed filtered by the type column
 * @method     ChildHorticulturebed findOneByLength(int $length) Return the first ChildHorticulturebed filtered by the length column
 * @method     ChildHorticulturebed findOneByWidth(int $width) Return the first ChildHorticulturebed filtered by the width column
 * @method     ChildHorticulturebed findOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticulturebed filtered by the updtTmstp column
 * @method     ChildHorticulturebed findOneByCreatetmstp(string $createTmstp) Return the first ChildHorticulturebed filtered by the createTmstp column *

 * @method     ChildHorticulturebed requirePk($key, ConnectionInterface $con = null) Return the ChildHorticulturebed by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturebed requireOne(ConnectionInterface $con = null) Return the first ChildHorticulturebed matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticulturebed requireOneByOid(int $oid) Return the first ChildHorticulturebed filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturebed requireOneByIdentifier(int $identifier) Return the first ChildHorticulturebed filtered by the identifier column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturebed requireOneByType(string $type) Return the first ChildHorticulturebed filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturebed requireOneByLength(int $length) Return the first ChildHorticulturebed filtered by the length column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturebed requireOneByWidth(int $width) Return the first ChildHorticulturebed filtered by the width column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturebed requireOneByUpdttmstp(string $updtTmstp) Return the first ChildHorticulturebed filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHorticulturebed requireOneByCreatetmstp(string $createTmstp) Return the first ChildHorticulturebed filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHorticulturebed[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildHorticulturebed objects based on current ModelCriteria
 * @method     ChildHorticulturebed[]|ObjectCollection findByOid(int $oid) Return ChildHorticulturebed objects filtered by the oid column
 * @method     ChildHorticulturebed[]|ObjectCollection findByIdentifier(int $identifier) Return ChildHorticulturebed objects filtered by the identifier column
 * @method     ChildHorticulturebed[]|ObjectCollection findByType(string $type) Return ChildHorticulturebed objects filtered by the type column
 * @method     ChildHorticulturebed[]|ObjectCollection findByLength(int $length) Return ChildHorticulturebed objects filtered by the length column
 * @method     ChildHorticulturebed[]|ObjectCollection findByWidth(int $width) Return ChildHorticulturebed objects filtered by the width column
 * @method     ChildHorticulturebed[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildHorticulturebed objects filtered by the updtTmstp column
 * @method     ChildHorticulturebed[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildHorticulturebed objects filtered by the createTmstp column
 * @method     ChildHorticulturebed[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HorticulturebedQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\HorticulturebedQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Horticulturebed', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHorticulturebedQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHorticulturebedQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildHorticulturebedQuery) {
            return $criteria;
        }
        $query = new ChildHorticulturebedQuery();
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
     * @return ChildHorticulturebed|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HorticulturebedTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HorticulturebedTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHorticulturebed A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, identifier, type, length, width, updtTmstp, createTmstp FROM horticulturebed WHERE oid = :p0';
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
            /** @var ChildHorticulturebed $obj */
            $obj = new ChildHorticulturebed();
            $obj->hydrate($row);
            HorticulturebedTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHorticulturebed|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildHorticulturebedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HorticulturebedTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildHorticulturebedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HorticulturebedTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildHorticulturebedQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(HorticulturebedTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(HorticulturebedTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturebedTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the identifier column
     *
     * Example usage:
     * <code>
     * $query->filterByIdentifier(1234); // WHERE identifier = 1234
     * $query->filterByIdentifier(array(12, 34)); // WHERE identifier IN (12, 34)
     * $query->filterByIdentifier(array('min' => 12)); // WHERE identifier > 12
     * </code>
     *
     * @param     mixed $identifier The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticulturebedQuery The current query, for fluid interface
     */
    public function filterByIdentifier($identifier = null, $comparison = null)
    {
        if (is_array($identifier)) {
            $useMinMax = false;
            if (isset($identifier['min'])) {
                $this->addUsingAlias(HorticulturebedTableMap::COL_IDENTIFIER, $identifier['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($identifier['max'])) {
                $this->addUsingAlias(HorticulturebedTableMap::COL_IDENTIFIER, $identifier['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturebedTableMap::COL_IDENTIFIER, $identifier, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticulturebedQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturebedTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the length column
     *
     * Example usage:
     * <code>
     * $query->filterByLength(1234); // WHERE length = 1234
     * $query->filterByLength(array(12, 34)); // WHERE length IN (12, 34)
     * $query->filterByLength(array('min' => 12)); // WHERE length > 12
     * </code>
     *
     * @param     mixed $length The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticulturebedQuery The current query, for fluid interface
     */
    public function filterByLength($length = null, $comparison = null)
    {
        if (is_array($length)) {
            $useMinMax = false;
            if (isset($length['min'])) {
                $this->addUsingAlias(HorticulturebedTableMap::COL_LENGTH, $length['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($length['max'])) {
                $this->addUsingAlias(HorticulturebedTableMap::COL_LENGTH, $length['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturebedTableMap::COL_LENGTH, $length, $comparison);
    }

    /**
     * Filter the query on the width column
     *
     * Example usage:
     * <code>
     * $query->filterByWidth(1234); // WHERE width = 1234
     * $query->filterByWidth(array(12, 34)); // WHERE width IN (12, 34)
     * $query->filterByWidth(array('min' => 12)); // WHERE width > 12
     * </code>
     *
     * @param     mixed $width The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHorticulturebedQuery The current query, for fluid interface
     */
    public function filterByWidth($width = null, $comparison = null)
    {
        if (is_array($width)) {
            $useMinMax = false;
            if (isset($width['min'])) {
                $this->addUsingAlias(HorticulturebedTableMap::COL_WIDTH, $width['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($width['max'])) {
                $this->addUsingAlias(HorticulturebedTableMap::COL_WIDTH, $width['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturebedTableMap::COL_WIDTH, $width, $comparison);
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
     * @return $this|ChildHorticulturebedQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(HorticulturebedTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(HorticulturebedTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturebedTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
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
     * @return $this|ChildHorticulturebedQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(HorticulturebedTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(HorticulturebedTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HorticulturebedTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Horticultureproducebed object
     *
     * @param \lwops\lwops\Horticultureproducebed|ObjectCollection $horticultureproducebed the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHorticulturebedQuery The current query, for fluid interface
     */
    public function filterByHorticultureproducebed($horticultureproducebed, $comparison = null)
    {
        if ($horticultureproducebed instanceof \lwops\lwops\Horticultureproducebed) {
            return $this
                ->addUsingAlias(HorticulturebedTableMap::COL_OID, $horticultureproducebed->getBedoid(), $comparison);
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
     * @return $this|ChildHorticulturebedQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildHorticulturebed $horticulturebed Object to remove from the list of results
     *
     * @return $this|ChildHorticulturebedQuery The current query, for fluid interface
     */
    public function prune($horticulturebed = null)
    {
        if ($horticulturebed) {
            $this->addUsingAlias(HorticulturebedTableMap::COL_OID, $horticulturebed->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the horticulturebed table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HorticulturebedTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HorticulturebedTableMap::clearInstancePool();
            HorticulturebedTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HorticulturebedTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HorticulturebedTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HorticulturebedTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HorticulturebedTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // HorticulturebedQuery
