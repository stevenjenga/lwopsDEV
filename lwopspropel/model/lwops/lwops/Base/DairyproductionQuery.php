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
use lwops\lwops\Dairyproduction as ChildDairyproduction;
use lwops\lwops\DairyproductionQuery as ChildDairyproductionQuery;
use lwops\lwops\Map\DairyproductionTableMap;

/**
 * Base class that represents a query for the 'dairyproduction' table.
 *
 *
 *
 * @method     ChildDairyproductionQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildDairyproductionQuery orderByGrId($order = Criteria::ASC) Order by the gr_id column
 * @method     ChildDairyproductionQuery orderByDairycownameoid($order = Criteria::ASC) Order by the DairyCowNameOid column
 * @method     ChildDairyproductionQuery orderByProddate($order = Criteria::ASC) Order by the prodDate column
 * @method     ChildDairyproductionQuery orderByAmvolume($order = Criteria::ASC) Order by the amVolume column
 * @method     ChildDairyproductionQuery orderByMdvolume($order = Criteria::ASC) Order by the mdVolume column
 * @method     ChildDairyproductionQuery orderByPmvolume($order = Criteria::ASC) Order by the pmVolume column
 * @method     ChildDairyproductionQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildDairyproductionQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildDairyproductionQuery groupByOid() Group by the oid column
 * @method     ChildDairyproductionQuery groupByGrId() Group by the gr_id column
 * @method     ChildDairyproductionQuery groupByDairycownameoid() Group by the DairyCowNameOid column
 * @method     ChildDairyproductionQuery groupByProddate() Group by the prodDate column
 * @method     ChildDairyproductionQuery groupByAmvolume() Group by the amVolume column
 * @method     ChildDairyproductionQuery groupByMdvolume() Group by the mdVolume column
 * @method     ChildDairyproductionQuery groupByPmvolume() Group by the pmVolume column
 * @method     ChildDairyproductionQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildDairyproductionQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildDairyproductionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDairyproductionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDairyproductionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDairyproductionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDairyproductionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDairyproductionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDairyproductionQuery leftJoinDairycowname($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dairycowname relation
 * @method     ChildDairyproductionQuery rightJoinDairycowname($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dairycowname relation
 * @method     ChildDairyproductionQuery innerJoinDairycowname($relationAlias = null) Adds a INNER JOIN clause to the query using the Dairycowname relation
 *
 * @method     ChildDairyproductionQuery joinWithDairycowname($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dairycowname relation
 *
 * @method     ChildDairyproductionQuery leftJoinWithDairycowname() Adds a LEFT JOIN clause and with to the query using the Dairycowname relation
 * @method     ChildDairyproductionQuery rightJoinWithDairycowname() Adds a RIGHT JOIN clause and with to the query using the Dairycowname relation
 * @method     ChildDairyproductionQuery innerJoinWithDairycowname() Adds a INNER JOIN clause and with to the query using the Dairycowname relation
 *
 * @method     \lwops\lwops\DairycownameQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDairyproduction findOne(ConnectionInterface $con = null) Return the first ChildDairyproduction matching the query
 * @method     ChildDairyproduction findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDairyproduction matching the query, or a new ChildDairyproduction object populated from the query conditions when no match is found
 *
 * @method     ChildDairyproduction findOneByOid(int $oid) Return the first ChildDairyproduction filtered by the oid column
 * @method     ChildDairyproduction findOneByGrId(string $gr_id) Return the first ChildDairyproduction filtered by the gr_id column
 * @method     ChildDairyproduction findOneByDairycownameoid(int $DairyCowNameOid) Return the first ChildDairyproduction filtered by the DairyCowNameOid column
 * @method     ChildDairyproduction findOneByProddate(string $prodDate) Return the first ChildDairyproduction filtered by the prodDate column
 * @method     ChildDairyproduction findOneByAmvolume(double $amVolume) Return the first ChildDairyproduction filtered by the amVolume column
 * @method     ChildDairyproduction findOneByMdvolume(double $mdVolume) Return the first ChildDairyproduction filtered by the mdVolume column
 * @method     ChildDairyproduction findOneByPmvolume(double $pmVolume) Return the first ChildDairyproduction filtered by the pmVolume column
 * @method     ChildDairyproduction findOneByCreatetmstp(string $createTmstp) Return the first ChildDairyproduction filtered by the createTmstp column
 * @method     ChildDairyproduction findOneByUpdttmstp(string $updtTmstp) Return the first ChildDairyproduction filtered by the updtTmstp column *

 * @method     ChildDairyproduction requirePk($key, ConnectionInterface $con = null) Return the ChildDairyproduction by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairyproduction requireOne(ConnectionInterface $con = null) Return the first ChildDairyproduction matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDairyproduction requireOneByOid(int $oid) Return the first ChildDairyproduction filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairyproduction requireOneByGrId(string $gr_id) Return the first ChildDairyproduction filtered by the gr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairyproduction requireOneByDairycownameoid(int $DairyCowNameOid) Return the first ChildDairyproduction filtered by the DairyCowNameOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairyproduction requireOneByProddate(string $prodDate) Return the first ChildDairyproduction filtered by the prodDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairyproduction requireOneByAmvolume(double $amVolume) Return the first ChildDairyproduction filtered by the amVolume column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairyproduction requireOneByMdvolume(double $mdVolume) Return the first ChildDairyproduction filtered by the mdVolume column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairyproduction requireOneByPmvolume(double $pmVolume) Return the first ChildDairyproduction filtered by the pmVolume column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairyproduction requireOneByCreatetmstp(string $createTmstp) Return the first ChildDairyproduction filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDairyproduction requireOneByUpdttmstp(string $updtTmstp) Return the first ChildDairyproduction filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDairyproduction[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDairyproduction objects based on current ModelCriteria
 * @method     ChildDairyproduction[]|ObjectCollection findByOid(int $oid) Return ChildDairyproduction objects filtered by the oid column
 * @method     ChildDairyproduction[]|ObjectCollection findByGrId(string $gr_id) Return ChildDairyproduction objects filtered by the gr_id column
 * @method     ChildDairyproduction[]|ObjectCollection findByDairycownameoid(int $DairyCowNameOid) Return ChildDairyproduction objects filtered by the DairyCowNameOid column
 * @method     ChildDairyproduction[]|ObjectCollection findByProddate(string $prodDate) Return ChildDairyproduction objects filtered by the prodDate column
 * @method     ChildDairyproduction[]|ObjectCollection findByAmvolume(double $amVolume) Return ChildDairyproduction objects filtered by the amVolume column
 * @method     ChildDairyproduction[]|ObjectCollection findByMdvolume(double $mdVolume) Return ChildDairyproduction objects filtered by the mdVolume column
 * @method     ChildDairyproduction[]|ObjectCollection findByPmvolume(double $pmVolume) Return ChildDairyproduction objects filtered by the pmVolume column
 * @method     ChildDairyproduction[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildDairyproduction objects filtered by the createTmstp column
 * @method     ChildDairyproduction[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildDairyproduction objects filtered by the updtTmstp column
 * @method     ChildDairyproduction[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DairyproductionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\DairyproductionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Dairyproduction', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDairyproductionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDairyproductionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDairyproductionQuery) {
            return $criteria;
        }
        $query = new ChildDairyproductionQuery();
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
     * @return ChildDairyproduction|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DairyproductionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DairyproductionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDairyproduction A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, gr_id, DairyCowNameOid, prodDate, amVolume, mdVolume, pmVolume, createTmstp, updtTmstp FROM dairyproduction WHERE oid = :p0';
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
            /** @var ChildDairyproduction $obj */
            $obj = new ChildDairyproduction();
            $obj->hydrate($row);
            DairyproductionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDairyproduction|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDairyproductionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DairyproductionTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDairyproductionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DairyproductionTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildDairyproductionQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairyproductionTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the gr_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGrId('fooValue');   // WHERE gr_id = 'fooValue'
     * $query->filterByGrId('%fooValue%', Criteria::LIKE); // WHERE gr_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $grId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDairyproductionQuery The current query, for fluid interface
     */
    public function filterByGrId($grId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($grId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairyproductionTableMap::COL_GR_ID, $grId, $comparison);
    }

    /**
     * Filter the query on the DairyCowNameOid column
     *
     * Example usage:
     * <code>
     * $query->filterByDairycownameoid(1234); // WHERE DairyCowNameOid = 1234
     * $query->filterByDairycownameoid(array(12, 34)); // WHERE DairyCowNameOid IN (12, 34)
     * $query->filterByDairycownameoid(array('min' => 12)); // WHERE DairyCowNameOid > 12
     * </code>
     *
     * @see       filterByDairycowname()
     *
     * @param     mixed $dairycownameoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDairyproductionQuery The current query, for fluid interface
     */
    public function filterByDairycownameoid($dairycownameoid = null, $comparison = null)
    {
        if (is_array($dairycownameoid)) {
            $useMinMax = false;
            if (isset($dairycownameoid['min'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_DAIRYCOWNAMEOID, $dairycownameoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dairycownameoid['max'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_DAIRYCOWNAMEOID, $dairycownameoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairyproductionTableMap::COL_DAIRYCOWNAMEOID, $dairycownameoid, $comparison);
    }

    /**
     * Filter the query on the prodDate column
     *
     * Example usage:
     * <code>
     * $query->filterByProddate('2011-03-14'); // WHERE prodDate = '2011-03-14'
     * $query->filterByProddate('now'); // WHERE prodDate = '2011-03-14'
     * $query->filterByProddate(array('max' => 'yesterday')); // WHERE prodDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $proddate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDairyproductionQuery The current query, for fluid interface
     */
    public function filterByProddate($proddate = null, $comparison = null)
    {
        if (is_array($proddate)) {
            $useMinMax = false;
            if (isset($proddate['min'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_PRODDATE, $proddate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($proddate['max'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_PRODDATE, $proddate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairyproductionTableMap::COL_PRODDATE, $proddate, $comparison);
    }

    /**
     * Filter the query on the amVolume column
     *
     * Example usage:
     * <code>
     * $query->filterByAmvolume(1234); // WHERE amVolume = 1234
     * $query->filterByAmvolume(array(12, 34)); // WHERE amVolume IN (12, 34)
     * $query->filterByAmvolume(array('min' => 12)); // WHERE amVolume > 12
     * </code>
     *
     * @param     mixed $amvolume The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDairyproductionQuery The current query, for fluid interface
     */
    public function filterByAmvolume($amvolume = null, $comparison = null)
    {
        if (is_array($amvolume)) {
            $useMinMax = false;
            if (isset($amvolume['min'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_AMVOLUME, $amvolume['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amvolume['max'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_AMVOLUME, $amvolume['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairyproductionTableMap::COL_AMVOLUME, $amvolume, $comparison);
    }

    /**
     * Filter the query on the mdVolume column
     *
     * Example usage:
     * <code>
     * $query->filterByMdvolume(1234); // WHERE mdVolume = 1234
     * $query->filterByMdvolume(array(12, 34)); // WHERE mdVolume IN (12, 34)
     * $query->filterByMdvolume(array('min' => 12)); // WHERE mdVolume > 12
     * </code>
     *
     * @param     mixed $mdvolume The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDairyproductionQuery The current query, for fluid interface
     */
    public function filterByMdvolume($mdvolume = null, $comparison = null)
    {
        if (is_array($mdvolume)) {
            $useMinMax = false;
            if (isset($mdvolume['min'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_MDVOLUME, $mdvolume['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mdvolume['max'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_MDVOLUME, $mdvolume['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairyproductionTableMap::COL_MDVOLUME, $mdvolume, $comparison);
    }

    /**
     * Filter the query on the pmVolume column
     *
     * Example usage:
     * <code>
     * $query->filterByPmvolume(1234); // WHERE pmVolume = 1234
     * $query->filterByPmvolume(array(12, 34)); // WHERE pmVolume IN (12, 34)
     * $query->filterByPmvolume(array('min' => 12)); // WHERE pmVolume > 12
     * </code>
     *
     * @param     mixed $pmvolume The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDairyproductionQuery The current query, for fluid interface
     */
    public function filterByPmvolume($pmvolume = null, $comparison = null)
    {
        if (is_array($pmvolume)) {
            $useMinMax = false;
            if (isset($pmvolume['min'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_PMVOLUME, $pmvolume['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pmvolume['max'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_PMVOLUME, $pmvolume['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairyproductionTableMap::COL_PMVOLUME, $pmvolume, $comparison);
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
     * @return $this|ChildDairyproductionQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairyproductionTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildDairyproductionQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(DairyproductionTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DairyproductionTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Dairycowname object
     *
     * @param \lwops\lwops\Dairycowname|ObjectCollection $dairycowname The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDairyproductionQuery The current query, for fluid interface
     */
    public function filterByDairycowname($dairycowname, $comparison = null)
    {
        if ($dairycowname instanceof \lwops\lwops\Dairycowname) {
            return $this
                ->addUsingAlias(DairyproductionTableMap::COL_DAIRYCOWNAMEOID, $dairycowname->getOid(), $comparison);
        } elseif ($dairycowname instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DairyproductionTableMap::COL_DAIRYCOWNAMEOID, $dairycowname->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByDairycowname() only accepts arguments of type \lwops\lwops\Dairycowname or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dairycowname relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDairyproductionQuery The current query, for fluid interface
     */
    public function joinDairycowname($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dairycowname');

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
            $this->addJoinObject($join, 'Dairycowname');
        }

        return $this;
    }

    /**
     * Use the Dairycowname relation Dairycowname object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\DairycownameQuery A secondary query class using the current class as primary query
     */
    public function useDairycownameQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDairycowname($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dairycowname', '\lwops\lwops\DairycownameQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDairyproduction $dairyproduction Object to remove from the list of results
     *
     * @return $this|ChildDairyproductionQuery The current query, for fluid interface
     */
    public function prune($dairyproduction = null)
    {
        if ($dairyproduction) {
            $this->addUsingAlias(DairyproductionTableMap::COL_OID, $dairyproduction->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the dairyproduction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DairyproductionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DairyproductionTableMap::clearInstancePool();
            DairyproductionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DairyproductionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DairyproductionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DairyproductionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DairyproductionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DairyproductionQuery
