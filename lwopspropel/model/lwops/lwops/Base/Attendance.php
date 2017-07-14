<?php

namespace lwops\lwops\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use lwops\lwops\Attendance as ChildAttendance;
use lwops\lwops\AttendanceQuery as ChildAttendanceQuery;
use lwops\lwops\Employee as ChildEmployee;
use lwops\lwops\EmployeeQuery as ChildEmployeeQuery;
use lwops\lwops\Otherworkassigned as ChildOtherworkassigned;
use lwops\lwops\OtherworkassignedQuery as ChildOtherworkassignedQuery;
use lwops\lwops\Parttimedetail as ChildParttimedetail;
use lwops\lwops\ParttimedetailQuery as ChildParttimedetailQuery;
use lwops\lwops\Teapicking as ChildTeapicking;
use lwops\lwops\TeapickingQuery as ChildTeapickingQuery;
use lwops\lwops\Teapruning as ChildTeapruning;
use lwops\lwops\TeapruningQuery as ChildTeapruningQuery;
use lwops\lwops\Map\AttendanceTableMap;
use lwops\lwops\Map\OtherworkassignedTableMap;
use lwops\lwops\Map\ParttimedetailTableMap;
use lwops\lwops\Map\TeapickingTableMap;
use lwops\lwops\Map\TeapruningTableMap;

/**
 * Base class that represents a row from the 'attendance' table.
 *
 *
 *
 * @package    propel.generator.lwops.lwops.Base
 */
abstract class Attendance implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\lwops\\lwops\\Map\\AttendanceTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the oid field.
     *
     * @var        int
     */
    protected $oid;

    /**
     * The value for the employeeoid field.
     *
     * @var        int
     */
    protected $employeeoid;

    /**
     * The value for the attendancedt field.
     *
     * @var        DateTime
     */
    protected $attendancedt;

    /**
     * The value for the attendance_in field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $attendance_in;

    /**
     * The value for the createtmstp field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $createtmstp;

    /**
     * The value for the updttmstp field.
     *
     * @var        DateTime
     */
    protected $updttmstp;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployee;

    /**
     * @var        ObjectCollection|ChildOtherworkassigned[] Collection to store aggregation of ChildOtherworkassigned objects.
     */
    protected $collOtherworkassigneds;
    protected $collOtherworkassignedsPartial;

    /**
     * @var        ObjectCollection|ChildParttimedetail[] Collection to store aggregation of ChildParttimedetail objects.
     */
    protected $collParttimedetails;
    protected $collParttimedetailsPartial;

    /**
     * @var        ObjectCollection|ChildTeapicking[] Collection to store aggregation of ChildTeapicking objects.
     */
    protected $collTeapickings;
    protected $collTeapickingsPartial;

    /**
     * @var        ObjectCollection|ChildTeapruning[] Collection to store aggregation of ChildTeapruning objects.
     */
    protected $collTeaprunings;
    protected $collTeapruningsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOtherworkassigned[]
     */
    protected $otherworkassignedsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildParttimedetail[]
     */
    protected $parttimedetailsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTeapicking[]
     */
    protected $teapickingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTeapruning[]
     */
    protected $teapruningsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->attendance_in = 0;
    }

    /**
     * Initializes internal state of lwops\lwops\Base\Attendance object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Attendance</code> instance.  If
     * <code>obj</code> is an instance of <code>Attendance</code>, delegates to
     * <code>equals(Attendance)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Attendance The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [oid] column value.
     *
     * @return int
     */
    public function getOid()
    {
        return $this->oid;
    }

    /**
     * Get the [employeeoid] column value.
     *
     * @return int
     */
    public function getEmployeeoid()
    {
        return $this->employeeoid;
    }

    /**
     * Get the [optionally formatted] temporal [attendancedt] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getAttendancedt($format = NULL)
    {
        if ($format === null) {
            return $this->attendancedt;
        } else {
            return $this->attendancedt instanceof \DateTimeInterface ? $this->attendancedt->format($format) : null;
        }
    }

    /**
     * Get the [attendance_in] column value.
     *
     * @return int
     */
    public function getAttendanceIn()
    {
        return $this->attendance_in;
    }

    /**
     * Get the [optionally formatted] temporal [createtmstp] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatetmstp($format = NULL)
    {
        if ($format === null) {
            return $this->createtmstp;
        } else {
            return $this->createtmstp instanceof \DateTimeInterface ? $this->createtmstp->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updttmstp] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdttmstp($format = NULL)
    {
        if ($format === null) {
            return $this->updttmstp;
        } else {
            return $this->updttmstp instanceof \DateTimeInterface ? $this->updttmstp->format($format) : null;
        }
    }

    /**
     * Set the value of [oid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Attendance The current object (for fluent API support)
     */
    public function setOid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oid !== $v) {
            $this->oid = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_OID] = true;
        }

        return $this;
    } // setOid()

    /**
     * Set the value of [employeeoid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Attendance The current object (for fluent API support)
     */
    public function setEmployeeoid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employeeoid !== $v) {
            $this->employeeoid = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_EMPLOYEEOID] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getOid() !== $v) {
            $this->aEmployee = null;
        }

        return $this;
    } // setEmployeeoid()

    /**
     * Sets the value of [attendancedt] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Attendance The current object (for fluent API support)
     */
    public function setAttendancedt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->attendancedt !== null || $dt !== null) {
            if ($this->attendancedt === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->attendancedt->format("Y-m-d H:i:s.u")) {
                $this->attendancedt = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AttendanceTableMap::COL_ATTENDANCEDT] = true;
            }
        } // if either are not null

        return $this;
    } // setAttendancedt()

    /**
     * Set the value of [attendance_in] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Attendance The current object (for fluent API support)
     */
    public function setAttendanceIn($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->attendance_in !== $v) {
            $this->attendance_in = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_ATTENDANCE_IN] = true;
        }

        return $this;
    } // setAttendanceIn()

    /**
     * Sets the value of [createtmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Attendance The current object (for fluent API support)
     */
    public function setCreatetmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->createtmstp !== null || $dt !== null) {
            if ($this->createtmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->createtmstp->format("Y-m-d H:i:s.u")) {
                $this->createtmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AttendanceTableMap::COL_CREATETMSTP] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatetmstp()

    /**
     * Sets the value of [updttmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Attendance The current object (for fluent API support)
     */
    public function setUpdttmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updttmstp !== null || $dt !== null) {
            if ($this->updttmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updttmstp->format("Y-m-d H:i:s.u")) {
                $this->updttmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AttendanceTableMap::COL_UPDTTMSTP] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdttmstp()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->attendance_in !== 0) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : AttendanceTableMap::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->oid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : AttendanceTableMap::translateFieldName('Employeeoid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employeeoid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : AttendanceTableMap::translateFieldName('Attendancedt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->attendancedt = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : AttendanceTableMap::translateFieldName('AttendanceIn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->attendance_in = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : AttendanceTableMap::translateFieldName('Createtmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->createtmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : AttendanceTableMap::translateFieldName('Updttmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updttmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = AttendanceTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\lwops\\lwops\\Attendance'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aEmployee !== null && $this->employeeoid !== $this->aEmployee->getOid()) {
            $this->aEmployee = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AttendanceTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildAttendanceQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEmployee = null;
            $this->collOtherworkassigneds = null;

            $this->collParttimedetails = null;

            $this->collTeapickings = null;

            $this->collTeaprunings = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Attendance::setDeleted()
     * @see Attendance::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AttendanceTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildAttendanceQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AttendanceTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                AttendanceTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aEmployee !== null) {
                if ($this->aEmployee->isModified() || $this->aEmployee->isNew()) {
                    $affectedRows += $this->aEmployee->save($con);
                }
                $this->setEmployee($this->aEmployee);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->otherworkassignedsScheduledForDeletion !== null) {
                if (!$this->otherworkassignedsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\OtherworkassignedQuery::create()
                        ->filterByPrimaryKeys($this->otherworkassignedsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->otherworkassignedsScheduledForDeletion = null;
                }
            }

            if ($this->collOtherworkassigneds !== null) {
                foreach ($this->collOtherworkassigneds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->parttimedetailsScheduledForDeletion !== null) {
                if (!$this->parttimedetailsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\ParttimedetailQuery::create()
                        ->filterByPrimaryKeys($this->parttimedetailsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->parttimedetailsScheduledForDeletion = null;
                }
            }

            if ($this->collParttimedetails !== null) {
                foreach ($this->collParttimedetails as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->teapickingsScheduledForDeletion !== null) {
                if (!$this->teapickingsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\TeapickingQuery::create()
                        ->filterByPrimaryKeys($this->teapickingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->teapickingsScheduledForDeletion = null;
                }
            }

            if ($this->collTeapickings !== null) {
                foreach ($this->collTeapickings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->teapruningsScheduledForDeletion !== null) {
                if (!$this->teapruningsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\TeapruningQuery::create()
                        ->filterByPrimaryKeys($this->teapruningsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->teapruningsScheduledForDeletion = null;
                }
            }

            if ($this->collTeaprunings !== null) {
                foreach ($this->collTeaprunings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[AttendanceTableMap::COL_OID] = true;
        if (null !== $this->oid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AttendanceTableMap::COL_OID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AttendanceTableMap::COL_OID)) {
            $modifiedColumns[':p' . $index++]  = 'oid';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_EMPLOYEEOID)) {
            $modifiedColumns[':p' . $index++]  = 'employeeOid';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_ATTENDANCEDT)) {
            $modifiedColumns[':p' . $index++]  = 'attendanceDt';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_ATTENDANCE_IN)) {
            $modifiedColumns[':p' . $index++]  = 'attendance_in';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_CREATETMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'createTmstp';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_UPDTTMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'updtTmstp';
        }

        $sql = sprintf(
            'INSERT INTO attendance (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'oid':
                        $stmt->bindValue($identifier, $this->oid, PDO::PARAM_INT);
                        break;
                    case 'employeeOid':
                        $stmt->bindValue($identifier, $this->employeeoid, PDO::PARAM_INT);
                        break;
                    case 'attendanceDt':
                        $stmt->bindValue($identifier, $this->attendancedt ? $this->attendancedt->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'attendance_in':
                        $stmt->bindValue($identifier, $this->attendance_in, PDO::PARAM_INT);
                        break;
                    case 'createTmstp':
                        $stmt->bindValue($identifier, $this->createtmstp ? $this->createtmstp->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updtTmstp':
                        $stmt->bindValue($identifier, $this->updttmstp ? $this->updttmstp->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setOid($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AttendanceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getOid();
                break;
            case 1:
                return $this->getEmployeeoid();
                break;
            case 2:
                return $this->getAttendancedt();
                break;
            case 3:
                return $this->getAttendanceIn();
                break;
            case 4:
                return $this->getCreatetmstp();
                break;
            case 5:
                return $this->getUpdttmstp();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Attendance'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Attendance'][$this->hashCode()] = true;
        $keys = AttendanceTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOid(),
            $keys[1] => $this->getEmployeeoid(),
            $keys[2] => $this->getAttendancedt(),
            $keys[3] => $this->getAttendanceIn(),
            $keys[4] => $this->getCreatetmstp(),
            $keys[5] => $this->getUpdttmstp(),
        );
        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('c');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aEmployee) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employee';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee';
                        break;
                    default:
                        $key = 'Employee';
                }

                $result[$key] = $this->aEmployee->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collOtherworkassigneds) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'otherworkassigneds';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'otherworkassigneds';
                        break;
                    default:
                        $key = 'Otherworkassigneds';
                }

                $result[$key] = $this->collOtherworkassigneds->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collParttimedetails) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'parttimedetails';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'parttimedetails';
                        break;
                    default:
                        $key = 'Parttimedetails';
                }

                $result[$key] = $this->collParttimedetails->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTeapickings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'teapickings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'teapickings';
                        break;
                    default:
                        $key = 'Teapickings';
                }

                $result[$key] = $this->collTeapickings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTeaprunings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'teaprunings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'teaprunings';
                        break;
                    default:
                        $key = 'Teaprunings';
                }

                $result[$key] = $this->collTeaprunings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\lwops\lwops\Attendance
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AttendanceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\lwops\lwops\Attendance
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setOid($value);
                break;
            case 1:
                $this->setEmployeeoid($value);
                break;
            case 2:
                $this->setAttendancedt($value);
                break;
            case 3:
                $this->setAttendanceIn($value);
                break;
            case 4:
                $this->setCreatetmstp($value);
                break;
            case 5:
                $this->setUpdttmstp($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = AttendanceTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmployeeoid($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAttendancedt($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAttendanceIn($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCreatetmstp($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setUpdttmstp($arr[$keys[5]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\lwops\lwops\Attendance The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(AttendanceTableMap::DATABASE_NAME);

        if ($this->isColumnModified(AttendanceTableMap::COL_OID)) {
            $criteria->add(AttendanceTableMap::COL_OID, $this->oid);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_EMPLOYEEOID)) {
            $criteria->add(AttendanceTableMap::COL_EMPLOYEEOID, $this->employeeoid);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_ATTENDANCEDT)) {
            $criteria->add(AttendanceTableMap::COL_ATTENDANCEDT, $this->attendancedt);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_ATTENDANCE_IN)) {
            $criteria->add(AttendanceTableMap::COL_ATTENDANCE_IN, $this->attendance_in);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_CREATETMSTP)) {
            $criteria->add(AttendanceTableMap::COL_CREATETMSTP, $this->createtmstp);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_UPDTTMSTP)) {
            $criteria->add(AttendanceTableMap::COL_UPDTTMSTP, $this->updttmstp);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildAttendanceQuery::create();
        $criteria->add(AttendanceTableMap::COL_OID, $this->oid);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getOid();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getOid();
    }

    /**
     * Generic method to set the primary key (oid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setOid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getOid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \lwops\lwops\Attendance (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEmployeeoid($this->getEmployeeoid());
        $copyObj->setAttendancedt($this->getAttendancedt());
        $copyObj->setAttendanceIn($this->getAttendanceIn());
        $copyObj->setCreatetmstp($this->getCreatetmstp());
        $copyObj->setUpdttmstp($this->getUpdttmstp());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getOtherworkassigneds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOtherworkassigned($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getParttimedetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addParttimedetail($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTeapickings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTeapicking($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTeaprunings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTeapruning($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setOid(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \lwops\lwops\Attendance Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param  ChildEmployee $v
     * @return $this|\lwops\lwops\Attendance The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEmployee(ChildEmployee $v = null)
    {
        if ($v === null) {
            $this->setEmployeeoid(NULL);
        } else {
            $this->setEmployeeoid($v->getOid());
        }

        $this->aEmployee = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addAttendance($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee The associated ChildEmployee object.
     * @throws PropelException
     */
    public function getEmployee(ConnectionInterface $con = null)
    {
        if ($this->aEmployee === null && ($this->employeeoid !== null)) {
            $this->aEmployee = ChildEmployeeQuery::create()->findPk($this->employeeoid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmployee->addAttendances($this);
             */
        }

        return $this->aEmployee;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Otherworkassigned' == $relationName) {
            $this->initOtherworkassigneds();
            return;
        }
        if ('Parttimedetail' == $relationName) {
            $this->initParttimedetails();
            return;
        }
        if ('Teapicking' == $relationName) {
            $this->initTeapickings();
            return;
        }
        if ('Teapruning' == $relationName) {
            $this->initTeaprunings();
            return;
        }
    }

    /**
     * Clears out the collOtherworkassigneds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOtherworkassigneds()
     */
    public function clearOtherworkassigneds()
    {
        $this->collOtherworkassigneds = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOtherworkassigneds collection loaded partially.
     */
    public function resetPartialOtherworkassigneds($v = true)
    {
        $this->collOtherworkassignedsPartial = $v;
    }

    /**
     * Initializes the collOtherworkassigneds collection.
     *
     * By default this just sets the collOtherworkassigneds collection to an empty array (like clearcollOtherworkassigneds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOtherworkassigneds($overrideExisting = true)
    {
        if (null !== $this->collOtherworkassigneds && !$overrideExisting) {
            return;
        }

        $collectionClassName = OtherworkassignedTableMap::getTableMap()->getCollectionClassName();

        $this->collOtherworkassigneds = new $collectionClassName;
        $this->collOtherworkassigneds->setModel('\lwops\lwops\Otherworkassigned');
    }

    /**
     * Gets an array of ChildOtherworkassigned objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAttendance is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOtherworkassigned[] List of ChildOtherworkassigned objects
     * @throws PropelException
     */
    public function getOtherworkassigneds(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOtherworkassignedsPartial && !$this->isNew();
        if (null === $this->collOtherworkassigneds || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collOtherworkassigneds) {
                // return empty collection
                $this->initOtherworkassigneds();
            } else {
                $collOtherworkassigneds = ChildOtherworkassignedQuery::create(null, $criteria)
                    ->filterByAttendance($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOtherworkassignedsPartial && count($collOtherworkassigneds)) {
                        $this->initOtherworkassigneds(false);

                        foreach ($collOtherworkassigneds as $obj) {
                            if (false == $this->collOtherworkassigneds->contains($obj)) {
                                $this->collOtherworkassigneds->append($obj);
                            }
                        }

                        $this->collOtherworkassignedsPartial = true;
                    }

                    return $collOtherworkassigneds;
                }

                if ($partial && $this->collOtherworkassigneds) {
                    foreach ($this->collOtherworkassigneds as $obj) {
                        if ($obj->isNew()) {
                            $collOtherworkassigneds[] = $obj;
                        }
                    }
                }

                $this->collOtherworkassigneds = $collOtherworkassigneds;
                $this->collOtherworkassignedsPartial = false;
            }
        }

        return $this->collOtherworkassigneds;
    }

    /**
     * Sets a collection of ChildOtherworkassigned objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $otherworkassigneds A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAttendance The current object (for fluent API support)
     */
    public function setOtherworkassigneds(Collection $otherworkassigneds, ConnectionInterface $con = null)
    {
        /** @var ChildOtherworkassigned[] $otherworkassignedsToDelete */
        $otherworkassignedsToDelete = $this->getOtherworkassigneds(new Criteria(), $con)->diff($otherworkassigneds);


        $this->otherworkassignedsScheduledForDeletion = $otherworkassignedsToDelete;

        foreach ($otherworkassignedsToDelete as $otherworkassignedRemoved) {
            $otherworkassignedRemoved->setAttendance(null);
        }

        $this->collOtherworkassigneds = null;
        foreach ($otherworkassigneds as $otherworkassigned) {
            $this->addOtherworkassigned($otherworkassigned);
        }

        $this->collOtherworkassigneds = $otherworkassigneds;
        $this->collOtherworkassignedsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Otherworkassigned objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Otherworkassigned objects.
     * @throws PropelException
     */
    public function countOtherworkassigneds(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOtherworkassignedsPartial && !$this->isNew();
        if (null === $this->collOtherworkassigneds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOtherworkassigneds) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOtherworkassigneds());
            }

            $query = ChildOtherworkassignedQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAttendance($this)
                ->count($con);
        }

        return count($this->collOtherworkassigneds);
    }

    /**
     * Method called to associate a ChildOtherworkassigned object to this object
     * through the ChildOtherworkassigned foreign key attribute.
     *
     * @param  ChildOtherworkassigned $l ChildOtherworkassigned
     * @return $this|\lwops\lwops\Attendance The current object (for fluent API support)
     */
    public function addOtherworkassigned(ChildOtherworkassigned $l)
    {
        if ($this->collOtherworkassigneds === null) {
            $this->initOtherworkassigneds();
            $this->collOtherworkassignedsPartial = true;
        }

        if (!$this->collOtherworkassigneds->contains($l)) {
            $this->doAddOtherworkassigned($l);

            if ($this->otherworkassignedsScheduledForDeletion and $this->otherworkassignedsScheduledForDeletion->contains($l)) {
                $this->otherworkassignedsScheduledForDeletion->remove($this->otherworkassignedsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOtherworkassigned $otherworkassigned The ChildOtherworkassigned object to add.
     */
    protected function doAddOtherworkassigned(ChildOtherworkassigned $otherworkassigned)
    {
        $this->collOtherworkassigneds[]= $otherworkassigned;
        $otherworkassigned->setAttendance($this);
    }

    /**
     * @param  ChildOtherworkassigned $otherworkassigned The ChildOtherworkassigned object to remove.
     * @return $this|ChildAttendance The current object (for fluent API support)
     */
    public function removeOtherworkassigned(ChildOtherworkassigned $otherworkassigned)
    {
        if ($this->getOtherworkassigneds()->contains($otherworkassigned)) {
            $pos = $this->collOtherworkassigneds->search($otherworkassigned);
            $this->collOtherworkassigneds->remove($pos);
            if (null === $this->otherworkassignedsScheduledForDeletion) {
                $this->otherworkassignedsScheduledForDeletion = clone $this->collOtherworkassigneds;
                $this->otherworkassignedsScheduledForDeletion->clear();
            }
            $this->otherworkassignedsScheduledForDeletion[]= clone $otherworkassigned;
            $otherworkassigned->setAttendance(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Attendance is new, it will return
     * an empty collection; or if this Attendance has previously
     * been saved, it will retrieve related Otherworkassigneds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Attendance.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOtherworkassigned[] List of ChildOtherworkassigned objects
     */
    public function getOtherworkassignedsJoinLineofbusiness(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOtherworkassignedQuery::create(null, $criteria);
        $query->joinWith('Lineofbusiness', $joinBehavior);

        return $this->getOtherworkassigneds($query, $con);
    }

    /**
     * Clears out the collParttimedetails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addParttimedetails()
     */
    public function clearParttimedetails()
    {
        $this->collParttimedetails = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collParttimedetails collection loaded partially.
     */
    public function resetPartialParttimedetails($v = true)
    {
        $this->collParttimedetailsPartial = $v;
    }

    /**
     * Initializes the collParttimedetails collection.
     *
     * By default this just sets the collParttimedetails collection to an empty array (like clearcollParttimedetails());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initParttimedetails($overrideExisting = true)
    {
        if (null !== $this->collParttimedetails && !$overrideExisting) {
            return;
        }

        $collectionClassName = ParttimedetailTableMap::getTableMap()->getCollectionClassName();

        $this->collParttimedetails = new $collectionClassName;
        $this->collParttimedetails->setModel('\lwops\lwops\Parttimedetail');
    }

    /**
     * Gets an array of ChildParttimedetail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAttendance is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildParttimedetail[] List of ChildParttimedetail objects
     * @throws PropelException
     */
    public function getParttimedetails(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collParttimedetailsPartial && !$this->isNew();
        if (null === $this->collParttimedetails || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collParttimedetails) {
                // return empty collection
                $this->initParttimedetails();
            } else {
                $collParttimedetails = ChildParttimedetailQuery::create(null, $criteria)
                    ->filterByAttendance($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collParttimedetailsPartial && count($collParttimedetails)) {
                        $this->initParttimedetails(false);

                        foreach ($collParttimedetails as $obj) {
                            if (false == $this->collParttimedetails->contains($obj)) {
                                $this->collParttimedetails->append($obj);
                            }
                        }

                        $this->collParttimedetailsPartial = true;
                    }

                    return $collParttimedetails;
                }

                if ($partial && $this->collParttimedetails) {
                    foreach ($this->collParttimedetails as $obj) {
                        if ($obj->isNew()) {
                            $collParttimedetails[] = $obj;
                        }
                    }
                }

                $this->collParttimedetails = $collParttimedetails;
                $this->collParttimedetailsPartial = false;
            }
        }

        return $this->collParttimedetails;
    }

    /**
     * Sets a collection of ChildParttimedetail objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $parttimedetails A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAttendance The current object (for fluent API support)
     */
    public function setParttimedetails(Collection $parttimedetails, ConnectionInterface $con = null)
    {
        /** @var ChildParttimedetail[] $parttimedetailsToDelete */
        $parttimedetailsToDelete = $this->getParttimedetails(new Criteria(), $con)->diff($parttimedetails);


        $this->parttimedetailsScheduledForDeletion = $parttimedetailsToDelete;

        foreach ($parttimedetailsToDelete as $parttimedetailRemoved) {
            $parttimedetailRemoved->setAttendance(null);
        }

        $this->collParttimedetails = null;
        foreach ($parttimedetails as $parttimedetail) {
            $this->addParttimedetail($parttimedetail);
        }

        $this->collParttimedetails = $parttimedetails;
        $this->collParttimedetailsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Parttimedetail objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Parttimedetail objects.
     * @throws PropelException
     */
    public function countParttimedetails(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collParttimedetailsPartial && !$this->isNew();
        if (null === $this->collParttimedetails || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collParttimedetails) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getParttimedetails());
            }

            $query = ChildParttimedetailQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAttendance($this)
                ->count($con);
        }

        return count($this->collParttimedetails);
    }

    /**
     * Method called to associate a ChildParttimedetail object to this object
     * through the ChildParttimedetail foreign key attribute.
     *
     * @param  ChildParttimedetail $l ChildParttimedetail
     * @return $this|\lwops\lwops\Attendance The current object (for fluent API support)
     */
    public function addParttimedetail(ChildParttimedetail $l)
    {
        if ($this->collParttimedetails === null) {
            $this->initParttimedetails();
            $this->collParttimedetailsPartial = true;
        }

        if (!$this->collParttimedetails->contains($l)) {
            $this->doAddParttimedetail($l);

            if ($this->parttimedetailsScheduledForDeletion and $this->parttimedetailsScheduledForDeletion->contains($l)) {
                $this->parttimedetailsScheduledForDeletion->remove($this->parttimedetailsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildParttimedetail $parttimedetail The ChildParttimedetail object to add.
     */
    protected function doAddParttimedetail(ChildParttimedetail $parttimedetail)
    {
        $this->collParttimedetails[]= $parttimedetail;
        $parttimedetail->setAttendance($this);
    }

    /**
     * @param  ChildParttimedetail $parttimedetail The ChildParttimedetail object to remove.
     * @return $this|ChildAttendance The current object (for fluent API support)
     */
    public function removeParttimedetail(ChildParttimedetail $parttimedetail)
    {
        if ($this->getParttimedetails()->contains($parttimedetail)) {
            $pos = $this->collParttimedetails->search($parttimedetail);
            $this->collParttimedetails->remove($pos);
            if (null === $this->parttimedetailsScheduledForDeletion) {
                $this->parttimedetailsScheduledForDeletion = clone $this->collParttimedetails;
                $this->parttimedetailsScheduledForDeletion->clear();
            }
            $this->parttimedetailsScheduledForDeletion[]= clone $parttimedetail;
            $parttimedetail->setAttendance(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Attendance is new, it will return
     * an empty collection; or if this Attendance has previously
     * been saved, it will retrieve related Parttimedetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Attendance.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildParttimedetail[] List of ChildParttimedetail objects
     */
    public function getParttimedetailsJoinEmployee(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildParttimedetailQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getParttimedetails($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Attendance is new, it will return
     * an empty collection; or if this Attendance has previously
     * been saved, it will retrieve related Parttimedetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Attendance.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildParttimedetail[] List of ChildParttimedetail objects
     */
    public function getParttimedetailsJoinLineofbusiness(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildParttimedetailQuery::create(null, $criteria);
        $query->joinWith('Lineofbusiness', $joinBehavior);

        return $this->getParttimedetails($query, $con);
    }

    /**
     * Clears out the collTeapickings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTeapickings()
     */
    public function clearTeapickings()
    {
        $this->collTeapickings = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTeapickings collection loaded partially.
     */
    public function resetPartialTeapickings($v = true)
    {
        $this->collTeapickingsPartial = $v;
    }

    /**
     * Initializes the collTeapickings collection.
     *
     * By default this just sets the collTeapickings collection to an empty array (like clearcollTeapickings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTeapickings($overrideExisting = true)
    {
        if (null !== $this->collTeapickings && !$overrideExisting) {
            return;
        }

        $collectionClassName = TeapickingTableMap::getTableMap()->getCollectionClassName();

        $this->collTeapickings = new $collectionClassName;
        $this->collTeapickings->setModel('\lwops\lwops\Teapicking');
    }

    /**
     * Gets an array of ChildTeapicking objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAttendance is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTeapicking[] List of ChildTeapicking objects
     * @throws PropelException
     */
    public function getTeapickings(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTeapickingsPartial && !$this->isNew();
        if (null === $this->collTeapickings || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTeapickings) {
                // return empty collection
                $this->initTeapickings();
            } else {
                $collTeapickings = ChildTeapickingQuery::create(null, $criteria)
                    ->filterByAttendance($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTeapickingsPartial && count($collTeapickings)) {
                        $this->initTeapickings(false);

                        foreach ($collTeapickings as $obj) {
                            if (false == $this->collTeapickings->contains($obj)) {
                                $this->collTeapickings->append($obj);
                            }
                        }

                        $this->collTeapickingsPartial = true;
                    }

                    return $collTeapickings;
                }

                if ($partial && $this->collTeapickings) {
                    foreach ($this->collTeapickings as $obj) {
                        if ($obj->isNew()) {
                            $collTeapickings[] = $obj;
                        }
                    }
                }

                $this->collTeapickings = $collTeapickings;
                $this->collTeapickingsPartial = false;
            }
        }

        return $this->collTeapickings;
    }

    /**
     * Sets a collection of ChildTeapicking objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $teapickings A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAttendance The current object (for fluent API support)
     */
    public function setTeapickings(Collection $teapickings, ConnectionInterface $con = null)
    {
        /** @var ChildTeapicking[] $teapickingsToDelete */
        $teapickingsToDelete = $this->getTeapickings(new Criteria(), $con)->diff($teapickings);


        $this->teapickingsScheduledForDeletion = $teapickingsToDelete;

        foreach ($teapickingsToDelete as $teapickingRemoved) {
            $teapickingRemoved->setAttendance(null);
        }

        $this->collTeapickings = null;
        foreach ($teapickings as $teapicking) {
            $this->addTeapicking($teapicking);
        }

        $this->collTeapickings = $teapickings;
        $this->collTeapickingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Teapicking objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Teapicking objects.
     * @throws PropelException
     */
    public function countTeapickings(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTeapickingsPartial && !$this->isNew();
        if (null === $this->collTeapickings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTeapickings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTeapickings());
            }

            $query = ChildTeapickingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAttendance($this)
                ->count($con);
        }

        return count($this->collTeapickings);
    }

    /**
     * Method called to associate a ChildTeapicking object to this object
     * through the ChildTeapicking foreign key attribute.
     *
     * @param  ChildTeapicking $l ChildTeapicking
     * @return $this|\lwops\lwops\Attendance The current object (for fluent API support)
     */
    public function addTeapicking(ChildTeapicking $l)
    {
        if ($this->collTeapickings === null) {
            $this->initTeapickings();
            $this->collTeapickingsPartial = true;
        }

        if (!$this->collTeapickings->contains($l)) {
            $this->doAddTeapicking($l);

            if ($this->teapickingsScheduledForDeletion and $this->teapickingsScheduledForDeletion->contains($l)) {
                $this->teapickingsScheduledForDeletion->remove($this->teapickingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTeapicking $teapicking The ChildTeapicking object to add.
     */
    protected function doAddTeapicking(ChildTeapicking $teapicking)
    {
        $this->collTeapickings[]= $teapicking;
        $teapicking->setAttendance($this);
    }

    /**
     * @param  ChildTeapicking $teapicking The ChildTeapicking object to remove.
     * @return $this|ChildAttendance The current object (for fluent API support)
     */
    public function removeTeapicking(ChildTeapicking $teapicking)
    {
        if ($this->getTeapickings()->contains($teapicking)) {
            $pos = $this->collTeapickings->search($teapicking);
            $this->collTeapickings->remove($pos);
            if (null === $this->teapickingsScheduledForDeletion) {
                $this->teapickingsScheduledForDeletion = clone $this->collTeapickings;
                $this->teapickingsScheduledForDeletion->clear();
            }
            $this->teapickingsScheduledForDeletion[]= clone $teapicking;
            $teapicking->setAttendance(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Attendance is new, it will return
     * an empty collection; or if this Attendance has previously
     * been saved, it will retrieve related Teapickings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Attendance.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTeapicking[] List of ChildTeapicking objects
     */
    public function getTeapickingsJoinTeablock(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTeapickingQuery::create(null, $criteria);
        $query->joinWith('Teablock', $joinBehavior);

        return $this->getTeapickings($query, $con);
    }

    /**
     * Clears out the collTeaprunings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTeaprunings()
     */
    public function clearTeaprunings()
    {
        $this->collTeaprunings = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTeaprunings collection loaded partially.
     */
    public function resetPartialTeaprunings($v = true)
    {
        $this->collTeapruningsPartial = $v;
    }

    /**
     * Initializes the collTeaprunings collection.
     *
     * By default this just sets the collTeaprunings collection to an empty array (like clearcollTeaprunings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTeaprunings($overrideExisting = true)
    {
        if (null !== $this->collTeaprunings && !$overrideExisting) {
            return;
        }

        $collectionClassName = TeapruningTableMap::getTableMap()->getCollectionClassName();

        $this->collTeaprunings = new $collectionClassName;
        $this->collTeaprunings->setModel('\lwops\lwops\Teapruning');
    }

    /**
     * Gets an array of ChildTeapruning objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAttendance is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTeapruning[] List of ChildTeapruning objects
     * @throws PropelException
     */
    public function getTeaprunings(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTeapruningsPartial && !$this->isNew();
        if (null === $this->collTeaprunings || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTeaprunings) {
                // return empty collection
                $this->initTeaprunings();
            } else {
                $collTeaprunings = ChildTeapruningQuery::create(null, $criteria)
                    ->filterByAttendance($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTeapruningsPartial && count($collTeaprunings)) {
                        $this->initTeaprunings(false);

                        foreach ($collTeaprunings as $obj) {
                            if (false == $this->collTeaprunings->contains($obj)) {
                                $this->collTeaprunings->append($obj);
                            }
                        }

                        $this->collTeapruningsPartial = true;
                    }

                    return $collTeaprunings;
                }

                if ($partial && $this->collTeaprunings) {
                    foreach ($this->collTeaprunings as $obj) {
                        if ($obj->isNew()) {
                            $collTeaprunings[] = $obj;
                        }
                    }
                }

                $this->collTeaprunings = $collTeaprunings;
                $this->collTeapruningsPartial = false;
            }
        }

        return $this->collTeaprunings;
    }

    /**
     * Sets a collection of ChildTeapruning objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $teaprunings A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAttendance The current object (for fluent API support)
     */
    public function setTeaprunings(Collection $teaprunings, ConnectionInterface $con = null)
    {
        /** @var ChildTeapruning[] $teapruningsToDelete */
        $teapruningsToDelete = $this->getTeaprunings(new Criteria(), $con)->diff($teaprunings);


        $this->teapruningsScheduledForDeletion = $teapruningsToDelete;

        foreach ($teapruningsToDelete as $teapruningRemoved) {
            $teapruningRemoved->setAttendance(null);
        }

        $this->collTeaprunings = null;
        foreach ($teaprunings as $teapruning) {
            $this->addTeapruning($teapruning);
        }

        $this->collTeaprunings = $teaprunings;
        $this->collTeapruningsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Teapruning objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Teapruning objects.
     * @throws PropelException
     */
    public function countTeaprunings(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTeapruningsPartial && !$this->isNew();
        if (null === $this->collTeaprunings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTeaprunings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTeaprunings());
            }

            $query = ChildTeapruningQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAttendance($this)
                ->count($con);
        }

        return count($this->collTeaprunings);
    }

    /**
     * Method called to associate a ChildTeapruning object to this object
     * through the ChildTeapruning foreign key attribute.
     *
     * @param  ChildTeapruning $l ChildTeapruning
     * @return $this|\lwops\lwops\Attendance The current object (for fluent API support)
     */
    public function addTeapruning(ChildTeapruning $l)
    {
        if ($this->collTeaprunings === null) {
            $this->initTeaprunings();
            $this->collTeapruningsPartial = true;
        }

        if (!$this->collTeaprunings->contains($l)) {
            $this->doAddTeapruning($l);

            if ($this->teapruningsScheduledForDeletion and $this->teapruningsScheduledForDeletion->contains($l)) {
                $this->teapruningsScheduledForDeletion->remove($this->teapruningsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTeapruning $teapruning The ChildTeapruning object to add.
     */
    protected function doAddTeapruning(ChildTeapruning $teapruning)
    {
        $this->collTeaprunings[]= $teapruning;
        $teapruning->setAttendance($this);
    }

    /**
     * @param  ChildTeapruning $teapruning The ChildTeapruning object to remove.
     * @return $this|ChildAttendance The current object (for fluent API support)
     */
    public function removeTeapruning(ChildTeapruning $teapruning)
    {
        if ($this->getTeaprunings()->contains($teapruning)) {
            $pos = $this->collTeaprunings->search($teapruning);
            $this->collTeaprunings->remove($pos);
            if (null === $this->teapruningsScheduledForDeletion) {
                $this->teapruningsScheduledForDeletion = clone $this->collTeaprunings;
                $this->teapruningsScheduledForDeletion->clear();
            }
            $this->teapruningsScheduledForDeletion[]= clone $teapruning;
            $teapruning->setAttendance(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Attendance is new, it will return
     * an empty collection; or if this Attendance has previously
     * been saved, it will retrieve related Teaprunings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Attendance.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTeapruning[] List of ChildTeapruning objects
     */
    public function getTeapruningsJoinTeablock(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTeapruningQuery::create(null, $criteria);
        $query->joinWith('Teablock', $joinBehavior);

        return $this->getTeaprunings($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Attendance is new, it will return
     * an empty collection; or if this Attendance has previously
     * been saved, it will retrieve related Teaprunings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Attendance.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTeapruning[] List of ChildTeapruning objects
     */
    public function getTeapruningsJoinTeapruningrate(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTeapruningQuery::create(null, $criteria);
        $query->joinWith('Teapruningrate', $joinBehavior);

        return $this->getTeaprunings($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeAttendance($this);
        }
        $this->oid = null;
        $this->employeeoid = null;
        $this->attendancedt = null;
        $this->attendance_in = null;
        $this->createtmstp = null;
        $this->updttmstp = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collOtherworkassigneds) {
                foreach ($this->collOtherworkassigneds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collParttimedetails) {
                foreach ($this->collParttimedetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTeapickings) {
                foreach ($this->collTeapickings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTeaprunings) {
                foreach ($this->collTeaprunings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collOtherworkassigneds = null;
        $this->collParttimedetails = null;
        $this->collTeapickings = null;
        $this->collTeaprunings = null;
        $this->aEmployee = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(AttendanceTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
