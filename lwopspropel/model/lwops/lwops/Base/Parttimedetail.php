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
use lwops\lwops\Lineofbusiness as ChildLineofbusiness;
use lwops\lwops\LineofbusinessQuery as ChildLineofbusinessQuery;
use lwops\lwops\ParttimedetailQuery as ChildParttimedetailQuery;
use lwops\lwops\Map\ParttimedetailTableMap;

/**
 * Base class that represents a row from the 'parttimedetail' table.
 *
 *
 *
 * @package    propel.generator.lwops.lwops.Base
 */
abstract class Parttimedetail implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\lwops\\lwops\\Map\\ParttimedetailTableMap';


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
     * The value for the attendanceoid field.
     *
     * @var        int
     */
    protected $attendanceoid;

    /**
     * The value for the starttm field.
     *
     * Note: this column has a database default value of: '00:00:00.000000'
     * @var        DateTime
     */
    protected $starttm;

    /**
     * The value for the endtm field.
     *
     * Note: this column has a database default value of: '00:00:00.000000'
     * @var        DateTime
     */
    protected $endtm;

    /**
     * The value for the hours field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $hours;

    /**
     * The value for the workdescription field.
     *
     * @var        string
     */
    protected $workdescription;

    /**
     * The value for the lineofbussinessoid field.
     *
     * @var        int
     */
    protected $lineofbussinessoid;

    /**
     * The value for the allocatedby field.
     *
     * Note: this column has a database default value of: 'Select Supervisor'
     * @var        string
     */
    protected $allocatedby;

    /**
     * The value for the remarks field.
     *
     * Note: this column has a database default value of: 'none'
     * @var        string
     */
    protected $remarks;

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
     * The value for the gr_id field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $gr_id;

    /**
     * @var        ChildAttendance
     */
    protected $aAttendance;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployee;

    /**
     * @var        ChildLineofbusiness
     */
    protected $aLineofbusiness;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->starttm = PropelDateTime::newInstance('00:00:00.000000', null, 'DateTime');
        $this->endtm = PropelDateTime::newInstance('00:00:00.000000', null, 'DateTime');
        $this->hours = 0;
        $this->allocatedby = 'Select Supervisor';
        $this->remarks = 'none';
        $this->gr_id = '0';
    }

    /**
     * Initializes internal state of lwops\lwops\Base\Parttimedetail object.
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
     * Compares this with another <code>Parttimedetail</code> instance.  If
     * <code>obj</code> is an instance of <code>Parttimedetail</code>, delegates to
     * <code>equals(Parttimedetail)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Parttimedetail The current object, for fluid interface
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
     * Get the [attendanceoid] column value.
     *
     * @return int
     */
    public function getAttendanceoid()
    {
        return $this->attendanceoid;
    }

    /**
     * Get the [optionally formatted] temporal [starttm] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getStarttm($format = NULL)
    {
        if ($format === null) {
            return $this->starttm;
        } else {
            return $this->starttm instanceof \DateTimeInterface ? $this->starttm->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [endtm] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getEndtm($format = NULL)
    {
        if ($format === null) {
            return $this->endtm;
        } else {
            return $this->endtm instanceof \DateTimeInterface ? $this->endtm->format($format) : null;
        }
    }

    /**
     * Get the [hours] column value.
     *
     * @return double
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Get the [workdescription] column value.
     *
     * @return string
     */
    public function getWorkdescription()
    {
        return $this->workdescription;
    }

    /**
     * Get the [lineofbussinessoid] column value.
     *
     * @return int
     */
    public function getLineofbussinessoid()
    {
        return $this->lineofbussinessoid;
    }

    /**
     * Get the [allocatedby] column value.
     *
     * @return string
     */
    public function getAllocatedby()
    {
        return $this->allocatedby;
    }

    /**
     * Get the [remarks] column value.
     *
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
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
     * Get the [gr_id] column value.
     *
     * @return string
     */
    public function getGrId()
    {
        return $this->gr_id;
    }

    /**
     * Set the value of [oid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     */
    public function setOid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oid !== $v) {
            $this->oid = $v;
            $this->modifiedColumns[ParttimedetailTableMap::COL_OID] = true;
        }

        return $this;
    } // setOid()

    /**
     * Set the value of [employeeoid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     */
    public function setEmployeeoid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employeeoid !== $v) {
            $this->employeeoid = $v;
            $this->modifiedColumns[ParttimedetailTableMap::COL_EMPLOYEEOID] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getOid() !== $v) {
            $this->aEmployee = null;
        }

        return $this;
    } // setEmployeeoid()

    /**
     * Set the value of [attendanceoid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     */
    public function setAttendanceoid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->attendanceoid !== $v) {
            $this->attendanceoid = $v;
            $this->modifiedColumns[ParttimedetailTableMap::COL_ATTENDANCEOID] = true;
        }

        if ($this->aAttendance !== null && $this->aAttendance->getOid() !== $v) {
            $this->aAttendance = null;
        }

        return $this;
    } // setAttendanceoid()

    /**
     * Sets the value of [starttm] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     */
    public function setStarttm($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->starttm !== null || $dt !== null) {
            if ( ($dt != $this->starttm) // normalized values don't match
                || ($dt->format('H:i:s.u') === '00:00:00.000000') // or the entered value matches the default
                 ) {
                $this->starttm = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ParttimedetailTableMap::COL_STARTTM] = true;
            }
        } // if either are not null

        return $this;
    } // setStarttm()

    /**
     * Sets the value of [endtm] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     */
    public function setEndtm($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->endtm !== null || $dt !== null) {
            if ( ($dt != $this->endtm) // normalized values don't match
                || ($dt->format('H:i:s.u') === '00:00:00.000000') // or the entered value matches the default
                 ) {
                $this->endtm = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ParttimedetailTableMap::COL_ENDTM] = true;
            }
        } // if either are not null

        return $this;
    } // setEndtm()

    /**
     * Set the value of [hours] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     */
    public function setHours($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->hours !== $v) {
            $this->hours = $v;
            $this->modifiedColumns[ParttimedetailTableMap::COL_HOURS] = true;
        }

        return $this;
    } // setHours()

    /**
     * Set the value of [workdescription] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     */
    public function setWorkdescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->workdescription !== $v) {
            $this->workdescription = $v;
            $this->modifiedColumns[ParttimedetailTableMap::COL_WORKDESCRIPTION] = true;
        }

        return $this;
    } // setWorkdescription()

    /**
     * Set the value of [lineofbussinessoid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     */
    public function setLineofbussinessoid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->lineofbussinessoid !== $v) {
            $this->lineofbussinessoid = $v;
            $this->modifiedColumns[ParttimedetailTableMap::COL_LINEOFBUSSINESSOID] = true;
        }

        if ($this->aLineofbusiness !== null && $this->aLineofbusiness->getOid() !== $v) {
            $this->aLineofbusiness = null;
        }

        return $this;
    } // setLineofbussinessoid()

    /**
     * Set the value of [allocatedby] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     */
    public function setAllocatedby($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->allocatedby !== $v) {
            $this->allocatedby = $v;
            $this->modifiedColumns[ParttimedetailTableMap::COL_ALLOCATEDBY] = true;
        }

        return $this;
    } // setAllocatedby()

    /**
     * Set the value of [remarks] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     */
    public function setRemarks($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->remarks !== $v) {
            $this->remarks = $v;
            $this->modifiedColumns[ParttimedetailTableMap::COL_REMARKS] = true;
        }

        return $this;
    } // setRemarks()

    /**
     * Sets the value of [createtmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     */
    public function setCreatetmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->createtmstp !== null || $dt !== null) {
            if ($this->createtmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->createtmstp->format("Y-m-d H:i:s.u")) {
                $this->createtmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ParttimedetailTableMap::COL_CREATETMSTP] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatetmstp()

    /**
     * Sets the value of [updttmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     */
    public function setUpdttmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updttmstp !== null || $dt !== null) {
            if ($this->updttmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updttmstp->format("Y-m-d H:i:s.u")) {
                $this->updttmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ParttimedetailTableMap::COL_UPDTTMSTP] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdttmstp()

    /**
     * Set the value of [gr_id] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     */
    public function setGrId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gr_id !== $v) {
            $this->gr_id = $v;
            $this->modifiedColumns[ParttimedetailTableMap::COL_GR_ID] = true;
        }

        return $this;
    } // setGrId()

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
            if ($this->starttm && $this->starttm->format('H:i:s.u') !== '00:00:00.000000') {
                return false;
            }

            if ($this->endtm && $this->endtm->format('H:i:s.u') !== '00:00:00.000000') {
                return false;
            }

            if ($this->hours !== 0) {
                return false;
            }

            if ($this->allocatedby !== 'Select Supervisor') {
                return false;
            }

            if ($this->remarks !== 'none') {
                return false;
            }

            if ($this->gr_id !== '0') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ParttimedetailTableMap::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->oid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ParttimedetailTableMap::translateFieldName('Employeeoid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employeeoid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ParttimedetailTableMap::translateFieldName('Attendanceoid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->attendanceoid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ParttimedetailTableMap::translateFieldName('Starttm', TableMap::TYPE_PHPNAME, $indexType)];
            $this->starttm = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ParttimedetailTableMap::translateFieldName('Endtm', TableMap::TYPE_PHPNAME, $indexType)];
            $this->endtm = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ParttimedetailTableMap::translateFieldName('Hours', TableMap::TYPE_PHPNAME, $indexType)];
            $this->hours = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ParttimedetailTableMap::translateFieldName('Workdescription', TableMap::TYPE_PHPNAME, $indexType)];
            $this->workdescription = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ParttimedetailTableMap::translateFieldName('Lineofbussinessoid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lineofbussinessoid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ParttimedetailTableMap::translateFieldName('Allocatedby', TableMap::TYPE_PHPNAME, $indexType)];
            $this->allocatedby = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ParttimedetailTableMap::translateFieldName('Remarks', TableMap::TYPE_PHPNAME, $indexType)];
            $this->remarks = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ParttimedetailTableMap::translateFieldName('Createtmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->createtmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ParttimedetailTableMap::translateFieldName('Updttmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updttmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ParttimedetailTableMap::translateFieldName('GrId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gr_id = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = ParttimedetailTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\lwops\\lwops\\Parttimedetail'), 0, $e);
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
        if ($this->aAttendance !== null && $this->attendanceoid !== $this->aAttendance->getOid()) {
            $this->aAttendance = null;
        }
        if ($this->aLineofbusiness !== null && $this->lineofbussinessoid !== $this->aLineofbusiness->getOid()) {
            $this->aLineofbusiness = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ParttimedetailTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildParttimedetailQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAttendance = null;
            $this->aEmployee = null;
            $this->aLineofbusiness = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Parttimedetail::setDeleted()
     * @see Parttimedetail::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ParttimedetailTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildParttimedetailQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ParttimedetailTableMap::DATABASE_NAME);
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
                ParttimedetailTableMap::addInstanceToPool($this);
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

            if ($this->aAttendance !== null) {
                if ($this->aAttendance->isModified() || $this->aAttendance->isNew()) {
                    $affectedRows += $this->aAttendance->save($con);
                }
                $this->setAttendance($this->aAttendance);
            }

            if ($this->aEmployee !== null) {
                if ($this->aEmployee->isModified() || $this->aEmployee->isNew()) {
                    $affectedRows += $this->aEmployee->save($con);
                }
                $this->setEmployee($this->aEmployee);
            }

            if ($this->aLineofbusiness !== null) {
                if ($this->aLineofbusiness->isModified() || $this->aLineofbusiness->isNew()) {
                    $affectedRows += $this->aLineofbusiness->save($con);
                }
                $this->setLineofbusiness($this->aLineofbusiness);
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

        $this->modifiedColumns[ParttimedetailTableMap::COL_OID] = true;
        if (null !== $this->oid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ParttimedetailTableMap::COL_OID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ParttimedetailTableMap::COL_OID)) {
            $modifiedColumns[':p' . $index++]  = 'oid';
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_EMPLOYEEOID)) {
            $modifiedColumns[':p' . $index++]  = 'employeeOid';
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_ATTENDANCEOID)) {
            $modifiedColumns[':p' . $index++]  = 'attendanceOid';
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_STARTTM)) {
            $modifiedColumns[':p' . $index++]  = 'startTm';
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_ENDTM)) {
            $modifiedColumns[':p' . $index++]  = 'endTm';
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_HOURS)) {
            $modifiedColumns[':p' . $index++]  = 'hours';
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_WORKDESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'workDescription';
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_LINEOFBUSSINESSOID)) {
            $modifiedColumns[':p' . $index++]  = 'lineOfBussinessOid';
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_ALLOCATEDBY)) {
            $modifiedColumns[':p' . $index++]  = 'allocatedBy';
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_REMARKS)) {
            $modifiedColumns[':p' . $index++]  = 'remarks';
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_CREATETMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'createTmstp';
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_UPDTTMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'updtTmstp';
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_GR_ID)) {
            $modifiedColumns[':p' . $index++]  = 'gr_id';
        }

        $sql = sprintf(
            'INSERT INTO parttimedetail (%s) VALUES (%s)',
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
                    case 'attendanceOid':
                        $stmt->bindValue($identifier, $this->attendanceoid, PDO::PARAM_INT);
                        break;
                    case 'startTm':
                        $stmt->bindValue($identifier, $this->starttm ? $this->starttm->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'endTm':
                        $stmt->bindValue($identifier, $this->endtm ? $this->endtm->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'hours':
                        $stmt->bindValue($identifier, $this->hours, PDO::PARAM_STR);
                        break;
                    case 'workDescription':
                        $stmt->bindValue($identifier, $this->workdescription, PDO::PARAM_STR);
                        break;
                    case 'lineOfBussinessOid':
                        $stmt->bindValue($identifier, $this->lineofbussinessoid, PDO::PARAM_INT);
                        break;
                    case 'allocatedBy':
                        $stmt->bindValue($identifier, $this->allocatedby, PDO::PARAM_STR);
                        break;
                    case 'remarks':
                        $stmt->bindValue($identifier, $this->remarks, PDO::PARAM_STR);
                        break;
                    case 'createTmstp':
                        $stmt->bindValue($identifier, $this->createtmstp ? $this->createtmstp->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updtTmstp':
                        $stmt->bindValue($identifier, $this->updttmstp ? $this->updttmstp->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'gr_id':
                        $stmt->bindValue($identifier, $this->gr_id, PDO::PARAM_STR);
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
        $pos = ParttimedetailTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getAttendanceoid();
                break;
            case 3:
                return $this->getStarttm();
                break;
            case 4:
                return $this->getEndtm();
                break;
            case 5:
                return $this->getHours();
                break;
            case 6:
                return $this->getWorkdescription();
                break;
            case 7:
                return $this->getLineofbussinessoid();
                break;
            case 8:
                return $this->getAllocatedby();
                break;
            case 9:
                return $this->getRemarks();
                break;
            case 10:
                return $this->getCreatetmstp();
                break;
            case 11:
                return $this->getUpdttmstp();
                break;
            case 12:
                return $this->getGrId();
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

        if (isset($alreadyDumpedObjects['Parttimedetail'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Parttimedetail'][$this->hashCode()] = true;
        $keys = ParttimedetailTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOid(),
            $keys[1] => $this->getEmployeeoid(),
            $keys[2] => $this->getAttendanceoid(),
            $keys[3] => $this->getStarttm(),
            $keys[4] => $this->getEndtm(),
            $keys[5] => $this->getHours(),
            $keys[6] => $this->getWorkdescription(),
            $keys[7] => $this->getLineofbussinessoid(),
            $keys[8] => $this->getAllocatedby(),
            $keys[9] => $this->getRemarks(),
            $keys[10] => $this->getCreatetmstp(),
            $keys[11] => $this->getUpdttmstp(),
            $keys[12] => $this->getGrId(),
        );
        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('c');
        }

        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('c');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('c');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aAttendance) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'attendance';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'attendance';
                        break;
                    default:
                        $key = 'Attendance';
                }

                $result[$key] = $this->aAttendance->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
            if (null !== $this->aLineofbusiness) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'lineofbusiness';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'lineofbusiness';
                        break;
                    default:
                        $key = 'Lineofbusiness';
                }

                $result[$key] = $this->aLineofbusiness->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\lwops\lwops\Parttimedetail
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ParttimedetailTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\lwops\lwops\Parttimedetail
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
                $this->setAttendanceoid($value);
                break;
            case 3:
                $this->setStarttm($value);
                break;
            case 4:
                $this->setEndtm($value);
                break;
            case 5:
                $this->setHours($value);
                break;
            case 6:
                $this->setWorkdescription($value);
                break;
            case 7:
                $this->setLineofbussinessoid($value);
                break;
            case 8:
                $this->setAllocatedby($value);
                break;
            case 9:
                $this->setRemarks($value);
                break;
            case 10:
                $this->setCreatetmstp($value);
                break;
            case 11:
                $this->setUpdttmstp($value);
                break;
            case 12:
                $this->setGrId($value);
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
        $keys = ParttimedetailTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmployeeoid($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAttendanceoid($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setStarttm($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEndtm($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setHours($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setWorkdescription($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLineofbussinessoid($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setAllocatedby($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setRemarks($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCreatetmstp($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setUpdttmstp($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setGrId($arr[$keys[12]]);
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
     * @return $this|\lwops\lwops\Parttimedetail The current object, for fluid interface
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
        $criteria = new Criteria(ParttimedetailTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ParttimedetailTableMap::COL_OID)) {
            $criteria->add(ParttimedetailTableMap::COL_OID, $this->oid);
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_EMPLOYEEOID)) {
            $criteria->add(ParttimedetailTableMap::COL_EMPLOYEEOID, $this->employeeoid);
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_ATTENDANCEOID)) {
            $criteria->add(ParttimedetailTableMap::COL_ATTENDANCEOID, $this->attendanceoid);
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_STARTTM)) {
            $criteria->add(ParttimedetailTableMap::COL_STARTTM, $this->starttm);
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_ENDTM)) {
            $criteria->add(ParttimedetailTableMap::COL_ENDTM, $this->endtm);
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_HOURS)) {
            $criteria->add(ParttimedetailTableMap::COL_HOURS, $this->hours);
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_WORKDESCRIPTION)) {
            $criteria->add(ParttimedetailTableMap::COL_WORKDESCRIPTION, $this->workdescription);
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_LINEOFBUSSINESSOID)) {
            $criteria->add(ParttimedetailTableMap::COL_LINEOFBUSSINESSOID, $this->lineofbussinessoid);
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_ALLOCATEDBY)) {
            $criteria->add(ParttimedetailTableMap::COL_ALLOCATEDBY, $this->allocatedby);
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_REMARKS)) {
            $criteria->add(ParttimedetailTableMap::COL_REMARKS, $this->remarks);
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_CREATETMSTP)) {
            $criteria->add(ParttimedetailTableMap::COL_CREATETMSTP, $this->createtmstp);
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_UPDTTMSTP)) {
            $criteria->add(ParttimedetailTableMap::COL_UPDTTMSTP, $this->updttmstp);
        }
        if ($this->isColumnModified(ParttimedetailTableMap::COL_GR_ID)) {
            $criteria->add(ParttimedetailTableMap::COL_GR_ID, $this->gr_id);
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
        $criteria = ChildParttimedetailQuery::create();
        $criteria->add(ParttimedetailTableMap::COL_OID, $this->oid);

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
     * @param      object $copyObj An object of \lwops\lwops\Parttimedetail (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEmployeeoid($this->getEmployeeoid());
        $copyObj->setAttendanceoid($this->getAttendanceoid());
        $copyObj->setStarttm($this->getStarttm());
        $copyObj->setEndtm($this->getEndtm());
        $copyObj->setHours($this->getHours());
        $copyObj->setWorkdescription($this->getWorkdescription());
        $copyObj->setLineofbussinessoid($this->getLineofbussinessoid());
        $copyObj->setAllocatedby($this->getAllocatedby());
        $copyObj->setRemarks($this->getRemarks());
        $copyObj->setCreatetmstp($this->getCreatetmstp());
        $copyObj->setUpdttmstp($this->getUpdttmstp());
        $copyObj->setGrId($this->getGrId());
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
     * @return \lwops\lwops\Parttimedetail Clone of current object.
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
     * Declares an association between this object and a ChildAttendance object.
     *
     * @param  ChildAttendance $v
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAttendance(ChildAttendance $v = null)
    {
        if ($v === null) {
            $this->setAttendanceoid(NULL);
        } else {
            $this->setAttendanceoid($v->getOid());
        }

        $this->aAttendance = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildAttendance object, it will not be re-added.
        if ($v !== null) {
            $v->addParttimedetail($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildAttendance object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildAttendance The associated ChildAttendance object.
     * @throws PropelException
     */
    public function getAttendance(ConnectionInterface $con = null)
    {
        if ($this->aAttendance === null && ($this->attendanceoid !== null)) {
            $this->aAttendance = ChildAttendanceQuery::create()->findPk($this->attendanceoid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAttendance->addParttimedetails($this);
             */
        }

        return $this->aAttendance;
    }

    /**
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param  ChildEmployee $v
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
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
            $v->addParttimedetail($this);
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
                $this->aEmployee->addParttimedetails($this);
             */
        }

        return $this->aEmployee;
    }

    /**
     * Declares an association between this object and a ChildLineofbusiness object.
     *
     * @param  ChildLineofbusiness $v
     * @return $this|\lwops\lwops\Parttimedetail The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLineofbusiness(ChildLineofbusiness $v = null)
    {
        if ($v === null) {
            $this->setLineofbussinessoid(NULL);
        } else {
            $this->setLineofbussinessoid($v->getOid());
        }

        $this->aLineofbusiness = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildLineofbusiness object, it will not be re-added.
        if ($v !== null) {
            $v->addParttimedetail($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildLineofbusiness object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildLineofbusiness The associated ChildLineofbusiness object.
     * @throws PropelException
     */
    public function getLineofbusiness(ConnectionInterface $con = null)
    {
        if ($this->aLineofbusiness === null && ($this->lineofbussinessoid !== null)) {
            $this->aLineofbusiness = ChildLineofbusinessQuery::create()->findPk($this->lineofbussinessoid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLineofbusiness->addParttimedetails($this);
             */
        }

        return $this->aLineofbusiness;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aAttendance) {
            $this->aAttendance->removeParttimedetail($this);
        }
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeParttimedetail($this);
        }
        if (null !== $this->aLineofbusiness) {
            $this->aLineofbusiness->removeParttimedetail($this);
        }
        $this->oid = null;
        $this->employeeoid = null;
        $this->attendanceoid = null;
        $this->starttm = null;
        $this->endtm = null;
        $this->hours = null;
        $this->workdescription = null;
        $this->lineofbussinessoid = null;
        $this->allocatedby = null;
        $this->remarks = null;
        $this->createtmstp = null;
        $this->updttmstp = null;
        $this->gr_id = null;
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
        } // if ($deep)

        $this->aAttendance = null;
        $this->aEmployee = null;
        $this->aLineofbusiness = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ParttimedetailTableMap::DEFAULT_STRING_FORMAT);
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
