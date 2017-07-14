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
use lwops\lwops\Parttimedetail as ChildParttimedetail;
use lwops\lwops\ParttimedetailQuery as ChildParttimedetailQuery;
use lwops\lwops\Map\ParttimedetailTableMap;

/**
 * Base class that represents a query for the 'parttimedetail' table.
 *
 *
 *
 * @method     ChildParttimedetailQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildParttimedetailQuery orderByEmployeeoid($order = Criteria::ASC) Order by the employeeOid column
 * @method     ChildParttimedetailQuery orderByAttendanceoid($order = Criteria::ASC) Order by the attendanceOid column
 * @method     ChildParttimedetailQuery orderByStarttm($order = Criteria::ASC) Order by the startTm column
 * @method     ChildParttimedetailQuery orderByEndtm($order = Criteria::ASC) Order by the endTm column
 * @method     ChildParttimedetailQuery orderByHours($order = Criteria::ASC) Order by the hours column
 * @method     ChildParttimedetailQuery orderByWorkdescription($order = Criteria::ASC) Order by the workDescription column
 * @method     ChildParttimedetailQuery orderByLineofbussinessoid($order = Criteria::ASC) Order by the lineOfBussinessOid column
 * @method     ChildParttimedetailQuery orderByAllocatedby($order = Criteria::ASC) Order by the allocatedBy column
 * @method     ChildParttimedetailQuery orderByRemarks($order = Criteria::ASC) Order by the remarks column
 * @method     ChildParttimedetailQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildParttimedetailQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 * @method     ChildParttimedetailQuery orderByGrId($order = Criteria::ASC) Order by the gr_id column
 *
 * @method     ChildParttimedetailQuery groupByOid() Group by the oid column
 * @method     ChildParttimedetailQuery groupByEmployeeoid() Group by the employeeOid column
 * @method     ChildParttimedetailQuery groupByAttendanceoid() Group by the attendanceOid column
 * @method     ChildParttimedetailQuery groupByStarttm() Group by the startTm column
 * @method     ChildParttimedetailQuery groupByEndtm() Group by the endTm column
 * @method     ChildParttimedetailQuery groupByHours() Group by the hours column
 * @method     ChildParttimedetailQuery groupByWorkdescription() Group by the workDescription column
 * @method     ChildParttimedetailQuery groupByLineofbussinessoid() Group by the lineOfBussinessOid column
 * @method     ChildParttimedetailQuery groupByAllocatedby() Group by the allocatedBy column
 * @method     ChildParttimedetailQuery groupByRemarks() Group by the remarks column
 * @method     ChildParttimedetailQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildParttimedetailQuery groupByUpdttmstp() Group by the updtTmstp column
 * @method     ChildParttimedetailQuery groupByGrId() Group by the gr_id column
 *
 * @method     ChildParttimedetailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildParttimedetailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildParttimedetailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildParttimedetailQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildParttimedetailQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildParttimedetailQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildParttimedetailQuery leftJoinAttendance($relationAlias = null) Adds a LEFT JOIN clause to the query using the Attendance relation
 * @method     ChildParttimedetailQuery rightJoinAttendance($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Attendance relation
 * @method     ChildParttimedetailQuery innerJoinAttendance($relationAlias = null) Adds a INNER JOIN clause to the query using the Attendance relation
 *
 * @method     ChildParttimedetailQuery joinWithAttendance($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Attendance relation
 *
 * @method     ChildParttimedetailQuery leftJoinWithAttendance() Adds a LEFT JOIN clause and with to the query using the Attendance relation
 * @method     ChildParttimedetailQuery rightJoinWithAttendance() Adds a RIGHT JOIN clause and with to the query using the Attendance relation
 * @method     ChildParttimedetailQuery innerJoinWithAttendance() Adds a INNER JOIN clause and with to the query using the Attendance relation
 *
 * @method     ChildParttimedetailQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildParttimedetailQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildParttimedetailQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildParttimedetailQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildParttimedetailQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildParttimedetailQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildParttimedetailQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildParttimedetailQuery leftJoinLineofbusiness($relationAlias = null) Adds a LEFT JOIN clause to the query using the Lineofbusiness relation
 * @method     ChildParttimedetailQuery rightJoinLineofbusiness($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Lineofbusiness relation
 * @method     ChildParttimedetailQuery innerJoinLineofbusiness($relationAlias = null) Adds a INNER JOIN clause to the query using the Lineofbusiness relation
 *
 * @method     ChildParttimedetailQuery joinWithLineofbusiness($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Lineofbusiness relation
 *
 * @method     ChildParttimedetailQuery leftJoinWithLineofbusiness() Adds a LEFT JOIN clause and with to the query using the Lineofbusiness relation
 * @method     ChildParttimedetailQuery rightJoinWithLineofbusiness() Adds a RIGHT JOIN clause and with to the query using the Lineofbusiness relation
 * @method     ChildParttimedetailQuery innerJoinWithLineofbusiness() Adds a INNER JOIN clause and with to the query using the Lineofbusiness relation
 *
 * @method     \lwops\lwops\AttendanceQuery|\lwops\lwops\EmployeeQuery|\lwops\lwops\LineofbusinessQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildParttimedetail findOne(ConnectionInterface $con = null) Return the first ChildParttimedetail matching the query
 * @method     ChildParttimedetail findOneOrCreate(ConnectionInterface $con = null) Return the first ChildParttimedetail matching the query, or a new ChildParttimedetail object populated from the query conditions when no match is found
 *
 * @method     ChildParttimedetail findOneByOid(int $oid) Return the first ChildParttimedetail filtered by the oid column
 * @method     ChildParttimedetail findOneByEmployeeoid(int $employeeOid) Return the first ChildParttimedetail filtered by the employeeOid column
 * @method     ChildParttimedetail findOneByAttendanceoid(int $attendanceOid) Return the first ChildParttimedetail filtered by the attendanceOid column
 * @method     ChildParttimedetail findOneByStarttm(string $startTm) Return the first ChildParttimedetail filtered by the startTm column
 * @method     ChildParttimedetail findOneByEndtm(string $endTm) Return the first ChildParttimedetail filtered by the endTm column
 * @method     ChildParttimedetail findOneByHours(double $hours) Return the first ChildParttimedetail filtered by the hours column
 * @method     ChildParttimedetail findOneByWorkdescription(string $workDescription) Return the first ChildParttimedetail filtered by the workDescription column
 * @method     ChildParttimedetail findOneByLineofbussinessoid(int $lineOfBussinessOid) Return the first ChildParttimedetail filtered by the lineOfBussinessOid column
 * @method     ChildParttimedetail findOneByAllocatedby(string $allocatedBy) Return the first ChildParttimedetail filtered by the allocatedBy column
 * @method     ChildParttimedetail findOneByRemarks(string $remarks) Return the first ChildParttimedetail filtered by the remarks column
 * @method     ChildParttimedetail findOneByCreatetmstp(string $createTmstp) Return the first ChildParttimedetail filtered by the createTmstp column
 * @method     ChildParttimedetail findOneByUpdttmstp(string $updtTmstp) Return the first ChildParttimedetail filtered by the updtTmstp column
 * @method     ChildParttimedetail findOneByGrId(string $gr_id) Return the first ChildParttimedetail filtered by the gr_id column *

 * @method     ChildParttimedetail requirePk($key, ConnectionInterface $con = null) Return the ChildParttimedetail by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildParttimedetail requireOne(ConnectionInterface $con = null) Return the first ChildParttimedetail matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildParttimedetail requireOneByOid(int $oid) Return the first ChildParttimedetail filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildParttimedetail requireOneByEmployeeoid(int $employeeOid) Return the first ChildParttimedetail filtered by the employeeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildParttimedetail requireOneByAttendanceoid(int $attendanceOid) Return the first ChildParttimedetail filtered by the attendanceOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildParttimedetail requireOneByStarttm(string $startTm) Return the first ChildParttimedetail filtered by the startTm column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildParttimedetail requireOneByEndtm(string $endTm) Return the first ChildParttimedetail filtered by the endTm column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildParttimedetail requireOneByHours(double $hours) Return the first ChildParttimedetail filtered by the hours column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildParttimedetail requireOneByWorkdescription(string $workDescription) Return the first ChildParttimedetail filtered by the workDescription column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildParttimedetail requireOneByLineofbussinessoid(int $lineOfBussinessOid) Return the first ChildParttimedetail filtered by the lineOfBussinessOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildParttimedetail requireOneByAllocatedby(string $allocatedBy) Return the first ChildParttimedetail filtered by the allocatedBy column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildParttimedetail requireOneByRemarks(string $remarks) Return the first ChildParttimedetail filtered by the remarks column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildParttimedetail requireOneByCreatetmstp(string $createTmstp) Return the first ChildParttimedetail filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildParttimedetail requireOneByUpdttmstp(string $updtTmstp) Return the first ChildParttimedetail filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildParttimedetail requireOneByGrId(string $gr_id) Return the first ChildParttimedetail filtered by the gr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildParttimedetail[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildParttimedetail objects based on current ModelCriteria
 * @method     ChildParttimedetail[]|ObjectCollection findByOid(int $oid) Return ChildParttimedetail objects filtered by the oid column
 * @method     ChildParttimedetail[]|ObjectCollection findByEmployeeoid(int $employeeOid) Return ChildParttimedetail objects filtered by the employeeOid column
 * @method     ChildParttimedetail[]|ObjectCollection findByAttendanceoid(int $attendanceOid) Return ChildParttimedetail objects filtered by the attendanceOid column
 * @method     ChildParttimedetail[]|ObjectCollection findByStarttm(string $startTm) Return ChildParttimedetail objects filtered by the startTm column
 * @method     ChildParttimedetail[]|ObjectCollection findByEndtm(string $endTm) Return ChildParttimedetail objects filtered by the endTm column
 * @method     ChildParttimedetail[]|ObjectCollection findByHours(double $hours) Return ChildParttimedetail objects filtered by the hours column
 * @method     ChildParttimedetail[]|ObjectCollection findByWorkdescription(string $workDescription) Return ChildParttimedetail objects filtered by the workDescription column
 * @method     ChildParttimedetail[]|ObjectCollection findByLineofbussinessoid(int $lineOfBussinessOid) Return ChildParttimedetail objects filtered by the lineOfBussinessOid column
 * @method     ChildParttimedetail[]|ObjectCollection findByAllocatedby(string $allocatedBy) Return ChildParttimedetail objects filtered by the allocatedBy column
 * @method     ChildParttimedetail[]|ObjectCollection findByRemarks(string $remarks) Return ChildParttimedetail objects filtered by the remarks column
 * @method     ChildParttimedetail[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildParttimedetail objects filtered by the createTmstp column
 * @method     ChildParttimedetail[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildParttimedetail objects filtered by the updtTmstp column
 * @method     ChildParttimedetail[]|ObjectCollection findByGrId(string $gr_id) Return ChildParttimedetail objects filtered by the gr_id column
 * @method     ChildParttimedetail[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ParttimedetailQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\ParttimedetailQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Parttimedetail', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildParttimedetailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildParttimedetailQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildParttimedetailQuery) {
            return $criteria;
        }
        $query = new ChildParttimedetailQuery();
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
     * @return ChildParttimedetail|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ParttimedetailTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ParttimedetailTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildParttimedetail A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, employeeOid, attendanceOid, startTm, endTm, hours, workDescription, lineOfBussinessOid, allocatedBy, remarks, createTmstp, updtTmstp, gr_id FROM parttimedetail WHERE oid = :p0';
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
            /** @var ChildParttimedetail $obj */
            $obj = new ChildParttimedetail();
            $obj->hydrate($row);
            ParttimedetailTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildParttimedetail|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ParttimedetailTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ParttimedetailTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ParttimedetailTableMap::COL_OID, $oid, $comparison);
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
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByEmployeeoid($employeeoid = null, $comparison = null)
    {
        if (is_array($employeeoid)) {
            $useMinMax = false;
            if (isset($employeeoid['min'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_EMPLOYEEOID, $employeeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeoid['max'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_EMPLOYEEOID, $employeeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ParttimedetailTableMap::COL_EMPLOYEEOID, $employeeoid, $comparison);
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
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByAttendanceoid($attendanceoid = null, $comparison = null)
    {
        if (is_array($attendanceoid)) {
            $useMinMax = false;
            if (isset($attendanceoid['min'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_ATTENDANCEOID, $attendanceoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($attendanceoid['max'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_ATTENDANCEOID, $attendanceoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ParttimedetailTableMap::COL_ATTENDANCEOID, $attendanceoid, $comparison);
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
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByStarttm($starttm = null, $comparison = null)
    {
        if (is_array($starttm)) {
            $useMinMax = false;
            if (isset($starttm['min'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_STARTTM, $starttm['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($starttm['max'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_STARTTM, $starttm['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ParttimedetailTableMap::COL_STARTTM, $starttm, $comparison);
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
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByEndtm($endtm = null, $comparison = null)
    {
        if (is_array($endtm)) {
            $useMinMax = false;
            if (isset($endtm['min'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_ENDTM, $endtm['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endtm['max'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_ENDTM, $endtm['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ParttimedetailTableMap::COL_ENDTM, $endtm, $comparison);
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
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByHours($hours = null, $comparison = null)
    {
        if (is_array($hours)) {
            $useMinMax = false;
            if (isset($hours['min'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_HOURS, $hours['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hours['max'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_HOURS, $hours['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ParttimedetailTableMap::COL_HOURS, $hours, $comparison);
    }

    /**
     * Filter the query on the workDescription column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkdescription('fooValue');   // WHERE workDescription = 'fooValue'
     * $query->filterByWorkdescription('%fooValue%', Criteria::LIKE); // WHERE workDescription LIKE '%fooValue%'
     * </code>
     *
     * @param     string $workdescription The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByWorkdescription($workdescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($workdescription)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ParttimedetailTableMap::COL_WORKDESCRIPTION, $workdescription, $comparison);
    }

    /**
     * Filter the query on the lineOfBussinessOid column
     *
     * Example usage:
     * <code>
     * $query->filterByLineofbussinessoid(1234); // WHERE lineOfBussinessOid = 1234
     * $query->filterByLineofbussinessoid(array(12, 34)); // WHERE lineOfBussinessOid IN (12, 34)
     * $query->filterByLineofbussinessoid(array('min' => 12)); // WHERE lineOfBussinessOid > 12
     * </code>
     *
     * @see       filterByLineofbusiness()
     *
     * @param     mixed $lineofbussinessoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByLineofbussinessoid($lineofbussinessoid = null, $comparison = null)
    {
        if (is_array($lineofbussinessoid)) {
            $useMinMax = false;
            if (isset($lineofbussinessoid['min'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_LINEOFBUSSINESSOID, $lineofbussinessoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lineofbussinessoid['max'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_LINEOFBUSSINESSOID, $lineofbussinessoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ParttimedetailTableMap::COL_LINEOFBUSSINESSOID, $lineofbussinessoid, $comparison);
    }

    /**
     * Filter the query on the allocatedBy column
     *
     * Example usage:
     * <code>
     * $query->filterByAllocatedby('fooValue');   // WHERE allocatedBy = 'fooValue'
     * $query->filterByAllocatedby('%fooValue%', Criteria::LIKE); // WHERE allocatedBy LIKE '%fooValue%'
     * </code>
     *
     * @param     string $allocatedby The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByAllocatedby($allocatedby = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($allocatedby)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ParttimedetailTableMap::COL_ALLOCATEDBY, $allocatedby, $comparison);
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
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByRemarks($remarks = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($remarks)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ParttimedetailTableMap::COL_REMARKS, $remarks, $comparison);
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
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ParttimedetailTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(ParttimedetailTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ParttimedetailTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
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
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByGrId($grId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($grId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ParttimedetailTableMap::COL_GR_ID, $grId, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Attendance object
     *
     * @param \lwops\lwops\Attendance|ObjectCollection $attendance The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByAttendance($attendance, $comparison = null)
    {
        if ($attendance instanceof \lwops\lwops\Attendance) {
            return $this
                ->addUsingAlias(ParttimedetailTableMap::COL_ATTENDANCEOID, $attendance->getOid(), $comparison);
        } elseif ($attendance instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ParttimedetailTableMap::COL_ATTENDANCEOID, $attendance->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Employee object
     *
     * @param \lwops\lwops\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \lwops\lwops\Employee) {
            return $this
                ->addUsingAlias(ParttimedetailTableMap::COL_EMPLOYEEOID, $employee->getOid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ParttimedetailTableMap::COL_EMPLOYEEOID, $employee->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
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
     * @return ChildParttimedetailQuery The current query, for fluid interface
     */
    public function filterByLineofbusiness($lineofbusiness, $comparison = null)
    {
        if ($lineofbusiness instanceof \lwops\lwops\Lineofbusiness) {
            return $this
                ->addUsingAlias(ParttimedetailTableMap::COL_LINEOFBUSSINESSOID, $lineofbusiness->getOid(), $comparison);
        } elseif ($lineofbusiness instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ParttimedetailTableMap::COL_LINEOFBUSSINESSOID, $lineofbusiness->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
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
     * @param   ChildParttimedetail $parttimedetail Object to remove from the list of results
     *
     * @return $this|ChildParttimedetailQuery The current query, for fluid interface
     */
    public function prune($parttimedetail = null)
    {
        if ($parttimedetail) {
            $this->addUsingAlias(ParttimedetailTableMap::COL_OID, $parttimedetail->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the parttimedetail table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ParttimedetailTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ParttimedetailTableMap::clearInstancePool();
            ParttimedetailTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ParttimedetailTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ParttimedetailTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ParttimedetailTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ParttimedetailTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ParttimedetailQuery
