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
use lwops\lwops\Attendance as ChildAttendance;
use lwops\lwops\AttendanceQuery as ChildAttendanceQuery;
use lwops\lwops\Map\AttendanceTableMap;

/**
 * Base class that represents a query for the 'attendance' table.
 *
 *
 *
 * @method     ChildAttendanceQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildAttendanceQuery orderByEmployeeoid($order = Criteria::ASC) Order by the employeeOid column
 * @method     ChildAttendanceQuery orderByAttendancedt($order = Criteria::ASC) Order by the attendanceDt column
 * @method     ChildAttendanceQuery orderByAttendanceIn($order = Criteria::ASC) Order by the attendance_in column
 * @method     ChildAttendanceQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildAttendanceQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildAttendanceQuery groupByOid() Group by the oid column
 * @method     ChildAttendanceQuery groupByEmployeeoid() Group by the employeeOid column
 * @method     ChildAttendanceQuery groupByAttendancedt() Group by the attendanceDt column
 * @method     ChildAttendanceQuery groupByAttendanceIn() Group by the attendance_in column
 * @method     ChildAttendanceQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildAttendanceQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildAttendanceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAttendanceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAttendanceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAttendanceQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAttendanceQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAttendanceQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAttendanceQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildAttendanceQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildAttendanceQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildAttendanceQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildAttendanceQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildAttendanceQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildAttendanceQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildAttendanceQuery leftJoinOtherworkassigned($relationAlias = null) Adds a LEFT JOIN clause to the query using the Otherworkassigned relation
 * @method     ChildAttendanceQuery rightJoinOtherworkassigned($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Otherworkassigned relation
 * @method     ChildAttendanceQuery innerJoinOtherworkassigned($relationAlias = null) Adds a INNER JOIN clause to the query using the Otherworkassigned relation
 *
 * @method     ChildAttendanceQuery joinWithOtherworkassigned($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Otherworkassigned relation
 *
 * @method     ChildAttendanceQuery leftJoinWithOtherworkassigned() Adds a LEFT JOIN clause and with to the query using the Otherworkassigned relation
 * @method     ChildAttendanceQuery rightJoinWithOtherworkassigned() Adds a RIGHT JOIN clause and with to the query using the Otherworkassigned relation
 * @method     ChildAttendanceQuery innerJoinWithOtherworkassigned() Adds a INNER JOIN clause and with to the query using the Otherworkassigned relation
 *
 * @method     ChildAttendanceQuery leftJoinParttimedetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the Parttimedetail relation
 * @method     ChildAttendanceQuery rightJoinParttimedetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Parttimedetail relation
 * @method     ChildAttendanceQuery innerJoinParttimedetail($relationAlias = null) Adds a INNER JOIN clause to the query using the Parttimedetail relation
 *
 * @method     ChildAttendanceQuery joinWithParttimedetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Parttimedetail relation
 *
 * @method     ChildAttendanceQuery leftJoinWithParttimedetail() Adds a LEFT JOIN clause and with to the query using the Parttimedetail relation
 * @method     ChildAttendanceQuery rightJoinWithParttimedetail() Adds a RIGHT JOIN clause and with to the query using the Parttimedetail relation
 * @method     ChildAttendanceQuery innerJoinWithParttimedetail() Adds a INNER JOIN clause and with to the query using the Parttimedetail relation
 *
 * @method     ChildAttendanceQuery leftJoinTeapicking($relationAlias = null) Adds a LEFT JOIN clause to the query using the Teapicking relation
 * @method     ChildAttendanceQuery rightJoinTeapicking($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Teapicking relation
 * @method     ChildAttendanceQuery innerJoinTeapicking($relationAlias = null) Adds a INNER JOIN clause to the query using the Teapicking relation
 *
 * @method     ChildAttendanceQuery joinWithTeapicking($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Teapicking relation
 *
 * @method     ChildAttendanceQuery leftJoinWithTeapicking() Adds a LEFT JOIN clause and with to the query using the Teapicking relation
 * @method     ChildAttendanceQuery rightJoinWithTeapicking() Adds a RIGHT JOIN clause and with to the query using the Teapicking relation
 * @method     ChildAttendanceQuery innerJoinWithTeapicking() Adds a INNER JOIN clause and with to the query using the Teapicking relation
 *
 * @method     ChildAttendanceQuery leftJoinTeapruning($relationAlias = null) Adds a LEFT JOIN clause to the query using the Teapruning relation
 * @method     ChildAttendanceQuery rightJoinTeapruning($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Teapruning relation
 * @method     ChildAttendanceQuery innerJoinTeapruning($relationAlias = null) Adds a INNER JOIN clause to the query using the Teapruning relation
 *
 * @method     ChildAttendanceQuery joinWithTeapruning($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Teapruning relation
 *
 * @method     ChildAttendanceQuery leftJoinWithTeapruning() Adds a LEFT JOIN clause and with to the query using the Teapruning relation
 * @method     ChildAttendanceQuery rightJoinWithTeapruning() Adds a RIGHT JOIN clause and with to the query using the Teapruning relation
 * @method     ChildAttendanceQuery innerJoinWithTeapruning() Adds a INNER JOIN clause and with to the query using the Teapruning relation
 *
 * @method     \lwops\lwops\EmployeeQuery|\lwops\lwops\OtherworkassignedQuery|\lwops\lwops\ParttimedetailQuery|\lwops\lwops\TeapickingQuery|\lwops\lwops\TeapruningQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAttendance findOne(ConnectionInterface $con = null) Return the first ChildAttendance matching the query
 * @method     ChildAttendance findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAttendance matching the query, or a new ChildAttendance object populated from the query conditions when no match is found
 *
 * @method     ChildAttendance findOneByOid(int $oid) Return the first ChildAttendance filtered by the oid column
 * @method     ChildAttendance findOneByEmployeeoid(int $employeeOid) Return the first ChildAttendance filtered by the employeeOid column
 * @method     ChildAttendance findOneByAttendancedt(string $attendanceDt) Return the first ChildAttendance filtered by the attendanceDt column
 * @method     ChildAttendance findOneByAttendanceIn(int $attendance_in) Return the first ChildAttendance filtered by the attendance_in column
 * @method     ChildAttendance findOneByCreatetmstp(string $createTmstp) Return the first ChildAttendance filtered by the createTmstp column
 * @method     ChildAttendance findOneByUpdttmstp(string $updtTmstp) Return the first ChildAttendance filtered by the updtTmstp column *

 * @method     ChildAttendance requirePk($key, ConnectionInterface $con = null) Return the ChildAttendance by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOne(ConnectionInterface $con = null) Return the first ChildAttendance matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAttendance requireOneByOid(int $oid) Return the first ChildAttendance filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByEmployeeoid(int $employeeOid) Return the first ChildAttendance filtered by the employeeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByAttendancedt(string $attendanceDt) Return the first ChildAttendance filtered by the attendanceDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByAttendanceIn(int $attendance_in) Return the first ChildAttendance filtered by the attendance_in column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByCreatetmstp(string $createTmstp) Return the first ChildAttendance filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByUpdttmstp(string $updtTmstp) Return the first ChildAttendance filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAttendance[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAttendance objects based on current ModelCriteria
 * @method     ChildAttendance[]|ObjectCollection findByOid(int $oid) Return ChildAttendance objects filtered by the oid column
 * @method     ChildAttendance[]|ObjectCollection findByEmployeeoid(int $employeeOid) Return ChildAttendance objects filtered by the employeeOid column
 * @method     ChildAttendance[]|ObjectCollection findByAttendancedt(string $attendanceDt) Return ChildAttendance objects filtered by the attendanceDt column
 * @method     ChildAttendance[]|ObjectCollection findByAttendanceIn(int $attendance_in) Return ChildAttendance objects filtered by the attendance_in column
 * @method     ChildAttendance[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildAttendance objects filtered by the createTmstp column
 * @method     ChildAttendance[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildAttendance objects filtered by the updtTmstp column
 * @method     ChildAttendance[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AttendanceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\AttendanceQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Attendance', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAttendanceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAttendanceQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAttendanceQuery) {
            return $criteria;
        }
        $query = new ChildAttendanceQuery();
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
     * @return ChildAttendance|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AttendanceTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AttendanceTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAttendance A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, employeeOid, attendanceDt, attendance_in, createTmstp, updtTmstp FROM attendance WHERE oid = :p0';
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
            /** @var ChildAttendance $obj */
            $obj = new ChildAttendance();
            $obj->hydrate($row);
            AttendanceTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAttendance|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AttendanceTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AttendanceTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AttendanceTableMap::COL_OID, $oid, $comparison);
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
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByEmployeeoid($employeeoid = null, $comparison = null)
    {
        if (is_array($employeeoid)) {
            $useMinMax = false;
            if (isset($employeeoid['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_EMPLOYEEOID, $employeeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeoid['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_EMPLOYEEOID, $employeeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AttendanceTableMap::COL_EMPLOYEEOID, $employeeoid, $comparison);
    }

    /**
     * Filter the query on the attendanceDt column
     *
     * Example usage:
     * <code>
     * $query->filterByAttendancedt('2011-03-14'); // WHERE attendanceDt = '2011-03-14'
     * $query->filterByAttendancedt('now'); // WHERE attendanceDt = '2011-03-14'
     * $query->filterByAttendancedt(array('max' => 'yesterday')); // WHERE attendanceDt > '2011-03-13'
     * </code>
     *
     * @param     mixed $attendancedt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByAttendancedt($attendancedt = null, $comparison = null)
    {
        if (is_array($attendancedt)) {
            $useMinMax = false;
            if (isset($attendancedt['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCEDT, $attendancedt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($attendancedt['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCEDT, $attendancedt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCEDT, $attendancedt, $comparison);
    }

    /**
     * Filter the query on the attendance_in column
     *
     * Example usage:
     * <code>
     * $query->filterByAttendanceIn(1234); // WHERE attendance_in = 1234
     * $query->filterByAttendanceIn(array(12, 34)); // WHERE attendance_in IN (12, 34)
     * $query->filterByAttendanceIn(array('min' => 12)); // WHERE attendance_in > 12
     * </code>
     *
     * @param     mixed $attendanceIn The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByAttendanceIn($attendanceIn = null, $comparison = null)
    {
        if (is_array($attendanceIn)) {
            $useMinMax = false;
            if (isset($attendanceIn['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCE_IN, $attendanceIn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($attendanceIn['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCE_IN, $attendanceIn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCE_IN, $attendanceIn, $comparison);
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
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AttendanceTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AttendanceTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Employee object
     *
     * @param \lwops\lwops\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \lwops\lwops\Employee) {
            return $this
                ->addUsingAlias(AttendanceTableMap::COL_EMPLOYEEOID, $employee->getOid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AttendanceTableMap::COL_EMPLOYEEOID, $employee->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Otherworkassigned object
     *
     * @param \lwops\lwops\Otherworkassigned|ObjectCollection $otherworkassigned the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByOtherworkassigned($otherworkassigned, $comparison = null)
    {
        if ($otherworkassigned instanceof \lwops\lwops\Otherworkassigned) {
            return $this
                ->addUsingAlias(AttendanceTableMap::COL_OID, $otherworkassigned->getAttendanceoid(), $comparison);
        } elseif ($otherworkassigned instanceof ObjectCollection) {
            return $this
                ->useOtherworkassignedQuery()
                ->filterByPrimaryKeys($otherworkassigned->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOtherworkassigned() only accepts arguments of type \lwops\lwops\Otherworkassigned or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Otherworkassigned relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function joinOtherworkassigned($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Otherworkassigned');

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
            $this->addJoinObject($join, 'Otherworkassigned');
        }

        return $this;
    }

    /**
     * Use the Otherworkassigned relation Otherworkassigned object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\OtherworkassignedQuery A secondary query class using the current class as primary query
     */
    public function useOtherworkassignedQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOtherworkassigned($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Otherworkassigned', '\lwops\lwops\OtherworkassignedQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Parttimedetail object
     *
     * @param \lwops\lwops\Parttimedetail|ObjectCollection $parttimedetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByParttimedetail($parttimedetail, $comparison = null)
    {
        if ($parttimedetail instanceof \lwops\lwops\Parttimedetail) {
            return $this
                ->addUsingAlias(AttendanceTableMap::COL_OID, $parttimedetail->getAttendanceoid(), $comparison);
        } elseif ($parttimedetail instanceof ObjectCollection) {
            return $this
                ->useParttimedetailQuery()
                ->filterByPrimaryKeys($parttimedetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByParttimedetail() only accepts arguments of type \lwops\lwops\Parttimedetail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Parttimedetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function joinParttimedetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Parttimedetail');

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
            $this->addJoinObject($join, 'Parttimedetail');
        }

        return $this;
    }

    /**
     * Use the Parttimedetail relation Parttimedetail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\ParttimedetailQuery A secondary query class using the current class as primary query
     */
    public function useParttimedetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinParttimedetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Parttimedetail', '\lwops\lwops\ParttimedetailQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Teapicking object
     *
     * @param \lwops\lwops\Teapicking|ObjectCollection $teapicking the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByTeapicking($teapicking, $comparison = null)
    {
        if ($teapicking instanceof \lwops\lwops\Teapicking) {
            return $this
                ->addUsingAlias(AttendanceTableMap::COL_OID, $teapicking->getAttendanceoid(), $comparison);
        } elseif ($teapicking instanceof ObjectCollection) {
            return $this
                ->useTeapickingQuery()
                ->filterByPrimaryKeys($teapicking->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTeapicking() only accepts arguments of type \lwops\lwops\Teapicking or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Teapicking relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function joinTeapicking($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Teapicking');

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
            $this->addJoinObject($join, 'Teapicking');
        }

        return $this;
    }

    /**
     * Use the Teapicking relation Teapicking object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\TeapickingQuery A secondary query class using the current class as primary query
     */
    public function useTeapickingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTeapicking($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Teapicking', '\lwops\lwops\TeapickingQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Teapruning object
     *
     * @param \lwops\lwops\Teapruning|ObjectCollection $teapruning the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAttendanceQuery The current query, for fluid interface
     */
    public function filterByTeapruning($teapruning, $comparison = null)
    {
        if ($teapruning instanceof \lwops\lwops\Teapruning) {
            return $this
                ->addUsingAlias(AttendanceTableMap::COL_OID, $teapruning->getAttendanceoid(), $comparison);
        } elseif ($teapruning instanceof ObjectCollection) {
            return $this
                ->useTeapruningQuery()
                ->filterByPrimaryKeys($teapruning->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTeapruning() only accepts arguments of type \lwops\lwops\Teapruning or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Teapruning relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function joinTeapruning($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Teapruning');

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
            $this->addJoinObject($join, 'Teapruning');
        }

        return $this;
    }

    /**
     * Use the Teapruning relation Teapruning object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\TeapruningQuery A secondary query class using the current class as primary query
     */
    public function useTeapruningQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTeapruning($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Teapruning', '\lwops\lwops\TeapruningQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAttendance $attendance Object to remove from the list of results
     *
     * @return $this|ChildAttendanceQuery The current query, for fluid interface
     */
    public function prune($attendance = null)
    {
        if ($attendance) {
            $this->addUsingAlias(AttendanceTableMap::COL_OID, $attendance->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the attendance table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AttendanceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AttendanceTableMap::clearInstancePool();
            AttendanceTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AttendanceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AttendanceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AttendanceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AttendanceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AttendanceQuery
