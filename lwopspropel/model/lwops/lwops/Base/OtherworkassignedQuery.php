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
use lwops\lwops\Otherworkassigned as ChildOtherworkassigned;
use lwops\lwops\OtherworkassignedQuery as ChildOtherworkassignedQuery;
use lwops\lwops\Map\OtherworkassignedTableMap;

/**
 * Base class that represents a query for the 'otherworkassigned' table.
 *
 *
 *
 * @method     ChildOtherworkassignedQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildOtherworkassignedQuery orderByAttendanceoid($order = Criteria::ASC) Order by the attendanceOid column
 * @method     ChildOtherworkassignedQuery orderByLineofbusinessoid($order = Criteria::ASC) Order by the lineOfBusinessOid column
 * @method     ChildOtherworkassignedQuery orderByStarttm($order = Criteria::ASC) Order by the startTm column
 * @method     ChildOtherworkassignedQuery orderByEndtm($order = Criteria::ASC) Order by the endTm column
 * @method     ChildOtherworkassignedQuery orderByHours($order = Criteria::ASC) Order by the hours column
 * @method     ChildOtherworkassignedQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildOtherworkassignedQuery orderByRemarks($order = Criteria::ASC) Order by the remarks column
 * @method     ChildOtherworkassignedQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildOtherworkassignedQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildOtherworkassignedQuery groupByOid() Group by the oid column
 * @method     ChildOtherworkassignedQuery groupByAttendanceoid() Group by the attendanceOid column
 * @method     ChildOtherworkassignedQuery groupByLineofbusinessoid() Group by the lineOfBusinessOid column
 * @method     ChildOtherworkassignedQuery groupByStarttm() Group by the startTm column
 * @method     ChildOtherworkassignedQuery groupByEndtm() Group by the endTm column
 * @method     ChildOtherworkassignedQuery groupByHours() Group by the hours column
 * @method     ChildOtherworkassignedQuery groupByDescription() Group by the description column
 * @method     ChildOtherworkassignedQuery groupByRemarks() Group by the remarks column
 * @method     ChildOtherworkassignedQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildOtherworkassignedQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildOtherworkassignedQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOtherworkassignedQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOtherworkassignedQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOtherworkassignedQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOtherworkassignedQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOtherworkassignedQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOtherworkassignedQuery leftJoinAttendance($relationAlias = null) Adds a LEFT JOIN clause to the query using the Attendance relation
 * @method     ChildOtherworkassignedQuery rightJoinAttendance($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Attendance relation
 * @method     ChildOtherworkassignedQuery innerJoinAttendance($relationAlias = null) Adds a INNER JOIN clause to the query using the Attendance relation
 *
 * @method     ChildOtherworkassignedQuery joinWithAttendance($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Attendance relation
 *
 * @method     ChildOtherworkassignedQuery leftJoinWithAttendance() Adds a LEFT JOIN clause and with to the query using the Attendance relation
 * @method     ChildOtherworkassignedQuery rightJoinWithAttendance() Adds a RIGHT JOIN clause and with to the query using the Attendance relation
 * @method     ChildOtherworkassignedQuery innerJoinWithAttendance() Adds a INNER JOIN clause and with to the query using the Attendance relation
 *
 * @method     ChildOtherworkassignedQuery leftJoinLineofbusiness($relationAlias = null) Adds a LEFT JOIN clause to the query using the Lineofbusiness relation
 * @method     ChildOtherworkassignedQuery rightJoinLineofbusiness($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Lineofbusiness relation
 * @method     ChildOtherworkassignedQuery innerJoinLineofbusiness($relationAlias = null) Adds a INNER JOIN clause to the query using the Lineofbusiness relation
 *
 * @method     ChildOtherworkassignedQuery joinWithLineofbusiness($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Lineofbusiness relation
 *
 * @method     ChildOtherworkassignedQuery leftJoinWithLineofbusiness() Adds a LEFT JOIN clause and with to the query using the Lineofbusiness relation
 * @method     ChildOtherworkassignedQuery rightJoinWithLineofbusiness() Adds a RIGHT JOIN clause and with to the query using the Lineofbusiness relation
 * @method     ChildOtherworkassignedQuery innerJoinWithLineofbusiness() Adds a INNER JOIN clause and with to the query using the Lineofbusiness relation
 *
 * @method     \lwops\lwops\AttendanceQuery|\lwops\lwops\LineofbusinessQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOtherworkassigned findOne(ConnectionInterface $con = null) Return the first ChildOtherworkassigned matching the query
 * @method     ChildOtherworkassigned findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOtherworkassigned matching the query, or a new ChildOtherworkassigned object populated from the query conditions when no match is found
 *
 * @method     ChildOtherworkassigned findOneByOid(int $oid) Return the first ChildOtherworkassigned filtered by the oid column
 * @method     ChildOtherworkassigned findOneByAttendanceoid(int $attendanceOid) Return the first ChildOtherworkassigned filtered by the attendanceOid column
 * @method     ChildOtherworkassigned findOneByLineofbusinessoid(int $lineOfBusinessOid) Return the first ChildOtherworkassigned filtered by the lineOfBusinessOid column
 * @method     ChildOtherworkassigned findOneByStarttm(string $startTm) Return the first ChildOtherworkassigned filtered by the startTm column
 * @method     ChildOtherworkassigned findOneByEndtm(string $endTm) Return the first ChildOtherworkassigned filtered by the endTm column
 * @method     ChildOtherworkassigned findOneByHours(int $hours) Return the first ChildOtherworkassigned filtered by the hours column
 * @method     ChildOtherworkassigned findOneByDescription(string $description) Return the first ChildOtherworkassigned filtered by the description column
 * @method     ChildOtherworkassigned findOneByRemarks(string $remarks) Return the first ChildOtherworkassigned filtered by the remarks column
 * @method     ChildOtherworkassigned findOneByCreatetmstp(string $createTmstp) Return the first ChildOtherworkassigned filtered by the createTmstp column
 * @method     ChildOtherworkassigned findOneByUpdttmstp(string $updtTmstp) Return the first ChildOtherworkassigned filtered by the updtTmstp column *

 * @method     ChildOtherworkassigned requirePk($key, ConnectionInterface $con = null) Return the ChildOtherworkassigned by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtherworkassigned requireOne(ConnectionInterface $con = null) Return the first ChildOtherworkassigned matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOtherworkassigned requireOneByOid(int $oid) Return the first ChildOtherworkassigned filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtherworkassigned requireOneByAttendanceoid(int $attendanceOid) Return the first ChildOtherworkassigned filtered by the attendanceOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtherworkassigned requireOneByLineofbusinessoid(int $lineOfBusinessOid) Return the first ChildOtherworkassigned filtered by the lineOfBusinessOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtherworkassigned requireOneByStarttm(string $startTm) Return the first ChildOtherworkassigned filtered by the startTm column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtherworkassigned requireOneByEndtm(string $endTm) Return the first ChildOtherworkassigned filtered by the endTm column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtherworkassigned requireOneByHours(int $hours) Return the first ChildOtherworkassigned filtered by the hours column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtherworkassigned requireOneByDescription(string $description) Return the first ChildOtherworkassigned filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtherworkassigned requireOneByRemarks(string $remarks) Return the first ChildOtherworkassigned filtered by the remarks column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtherworkassigned requireOneByCreatetmstp(string $createTmstp) Return the first ChildOtherworkassigned filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtherworkassigned requireOneByUpdttmstp(string $updtTmstp) Return the first ChildOtherworkassigned filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOtherworkassigned[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOtherworkassigned objects based on current ModelCriteria
 * @method     ChildOtherworkassigned[]|ObjectCollection findByOid(int $oid) Return ChildOtherworkassigned objects filtered by the oid column
 * @method     ChildOtherworkassigned[]|ObjectCollection findByAttendanceoid(int $attendanceOid) Return ChildOtherworkassigned objects filtered by the attendanceOid column
 * @method     ChildOtherworkassigned[]|ObjectCollection findByLineofbusinessoid(int $lineOfBusinessOid) Return ChildOtherworkassigned objects filtered by the lineOfBusinessOid column
 * @method     ChildOtherworkassigned[]|ObjectCollection findByStarttm(string $startTm) Return ChildOtherworkassigned objects filtered by the startTm column
 * @method     ChildOtherworkassigned[]|ObjectCollection findByEndtm(string $endTm) Return ChildOtherworkassigned objects filtered by the endTm column
 * @method     ChildOtherworkassigned[]|ObjectCollection findByHours(int $hours) Return ChildOtherworkassigned objects filtered by the hours column
 * @method     ChildOtherworkassigned[]|ObjectCollection findByDescription(string $description) Return ChildOtherworkassigned objects filtered by the description column
 * @method     ChildOtherworkassigned[]|ObjectCollection findByRemarks(string $remarks) Return ChildOtherworkassigned objects filtered by the remarks column
 * @method     ChildOtherworkassigned[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildOtherworkassigned objects filtered by the createTmstp column
 * @method     ChildOtherworkassigned[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildOtherworkassigned objects filtered by the updtTmstp column
 * @method     ChildOtherworkassigned[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OtherworkassignedQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\OtherworkassignedQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Otherworkassigned', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOtherworkassignedQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOtherworkassignedQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOtherworkassignedQuery) {
            return $criteria;
        }
        $query = new ChildOtherworkassignedQuery();
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
     * @return ChildOtherworkassigned|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OtherworkassignedTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OtherworkassignedTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOtherworkassigned A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, attendanceOid, lineOfBusinessOid, startTm, endTm, hours, description, remarks, createTmstp, updtTmstp FROM otherworkassigned WHERE oid = :p0';
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
            /** @var ChildOtherworkassigned $obj */
            $obj = new ChildOtherworkassigned();
            $obj->hydrate($row);
            OtherworkassignedTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOtherworkassigned|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OtherworkassignedTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OtherworkassignedTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtherworkassignedTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the attendanceOid column
     *
     * Example usage:
     * <code>
     * $query->filterByAttendanceoid(1234); // WHERE attendanceOid = 1234
     * $query->filterByAttendanceoid(array(12, 34)); // WHERE attendanceOid IN (12, 34)
     * $query->filterByAttendanceoid(array('min' => 12)); // WHERE attendanceOid > 12
     * </code>
     *
     * @see       filterByAttendance()
     *
     * @param     mixed $attendanceoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function filterByAttendanceoid($attendanceoid = null, $comparison = null)
    {
        if (is_array($attendanceoid)) {
            $useMinMax = false;
            if (isset($attendanceoid['min'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_ATTENDANCEOID, $attendanceoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($attendanceoid['max'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_ATTENDANCEOID, $attendanceoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtherworkassignedTableMap::COL_ATTENDANCEOID, $attendanceoid, $comparison);
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
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function filterByLineofbusinessoid($lineofbusinessoid = null, $comparison = null)
    {
        if (is_array($lineofbusinessoid)) {
            $useMinMax = false;
            if (isset($lineofbusinessoid['min'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lineofbusinessoid['max'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtherworkassignedTableMap::COL_LINEOFBUSINESSOID, $lineofbusinessoid, $comparison);
    }

    /**
     * Filter the query on the startTm column
     *
     * Example usage:
     * <code>
     * $query->filterByStarttm('2011-03-14'); // WHERE startTm = '2011-03-14'
     * $query->filterByStarttm('now'); // WHERE startTm = '2011-03-14'
     * $query->filterByStarttm(array('max' => 'yesterday')); // WHERE startTm > '2011-03-13'
     * </code>
     *
     * @param     mixed $starttm The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function filterByStarttm($starttm = null, $comparison = null)
    {
        if (is_array($starttm)) {
            $useMinMax = false;
            if (isset($starttm['min'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_STARTTM, $starttm['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($starttm['max'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_STARTTM, $starttm['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtherworkassignedTableMap::COL_STARTTM, $starttm, $comparison);
    }

    /**
     * Filter the query on the endTm column
     *
     * Example usage:
     * <code>
     * $query->filterByEndtm('2011-03-14'); // WHERE endTm = '2011-03-14'
     * $query->filterByEndtm('now'); // WHERE endTm = '2011-03-14'
     * $query->filterByEndtm(array('max' => 'yesterday')); // WHERE endTm > '2011-03-13'
     * </code>
     *
     * @param     mixed $endtm The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function filterByEndtm($endtm = null, $comparison = null)
    {
        if (is_array($endtm)) {
            $useMinMax = false;
            if (isset($endtm['min'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_ENDTM, $endtm['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endtm['max'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_ENDTM, $endtm['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtherworkassignedTableMap::COL_ENDTM, $endtm, $comparison);
    }

    /**
     * Filter the query on the hours column
     *
     * Example usage:
     * <code>
     * $query->filterByHours(1234); // WHERE hours = 1234
     * $query->filterByHours(array(12, 34)); // WHERE hours IN (12, 34)
     * $query->filterByHours(array('min' => 12)); // WHERE hours > 12
     * </code>
     *
     * @param     mixed $hours The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function filterByHours($hours = null, $comparison = null)
    {
        if (is_array($hours)) {
            $useMinMax = false;
            if (isset($hours['min'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_HOURS, $hours['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hours['max'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_HOURS, $hours['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtherworkassignedTableMap::COL_HOURS, $hours, $comparison);
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
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtherworkassignedTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the remarks column
     *
     * Example usage:
     * <code>
     * $query->filterByRemarks('fooValue');   // WHERE remarks = 'fooValue'
     * $query->filterByRemarks('%fooValue%', Criteria::LIKE); // WHERE remarks LIKE '%fooValue%'
     * </code>
     *
     * @param     string $remarks The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function filterByRemarks($remarks = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($remarks)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtherworkassignedTableMap::COL_REMARKS, $remarks, $comparison);
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
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtherworkassignedTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(OtherworkassignedTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OtherworkassignedTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Attendance object
     *
     * @param \lwops\lwops\Attendance|ObjectCollection $attendance The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function filterByAttendance($attendance, $comparison = null)
    {
        if ($attendance instanceof \lwops\lwops\Attendance) {
            return $this
                ->addUsingAlias(OtherworkassignedTableMap::COL_ATTENDANCEOID, $attendance->getOid(), $comparison);
        } elseif ($attendance instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OtherworkassignedTableMap::COL_ATTENDANCEOID, $attendance->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByAttendance() only accepts arguments of type \lwops\lwops\Attendance or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Attendance relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function joinAttendance($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Attendance');

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
            $this->addJoinObject($join, 'Attendance');
        }

        return $this;
    }

    /**
     * Use the Attendance relation Attendance object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\AttendanceQuery A secondary query class using the current class as primary query
     */
    public function useAttendanceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAttendance($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Attendance', '\lwops\lwops\AttendanceQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Lineofbusiness object
     *
     * @param \lwops\lwops\Lineofbusiness|ObjectCollection $lineofbusiness The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function filterByLineofbusiness($lineofbusiness, $comparison = null)
    {
        if ($lineofbusiness instanceof \lwops\lwops\Lineofbusiness) {
            return $this
                ->addUsingAlias(OtherworkassignedTableMap::COL_LINEOFBUSINESSOID, $lineofbusiness->getOid(), $comparison);
        } elseif ($lineofbusiness instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OtherworkassignedTableMap::COL_LINEOFBUSINESSOID, $lineofbusiness->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildOtherworkassigned $otherworkassigned Object to remove from the list of results
     *
     * @return $this|ChildOtherworkassignedQuery The current query, for fluid interface
     */
    public function prune($otherworkassigned = null)
    {
        if ($otherworkassigned) {
            $this->addUsingAlias(OtherworkassignedTableMap::COL_OID, $otherworkassigned->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the otherworkassigned table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OtherworkassignedTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OtherworkassignedTableMap::clearInstancePool();
            OtherworkassignedTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OtherworkassignedTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OtherworkassignedTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OtherworkassignedTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OtherworkassignedTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OtherworkassignedQuery
