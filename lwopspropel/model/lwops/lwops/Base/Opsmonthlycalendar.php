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
use lwops\lwops\Dairypandl as ChildDairypandl;
use lwops\lwops\DairypandlQuery as ChildDairypandlQuery;
use lwops\lwops\Electricityallocation as ChildElectricityallocation;
use lwops\lwops\ElectricityallocationQuery as ChildElectricityallocationQuery;
use lwops\lwops\Electricityexpense as ChildElectricityexpense;
use lwops\lwops\ElectricityexpenseQuery as ChildElectricityexpenseQuery;
use lwops\lwops\Employeeloan as ChildEmployeeloan;
use lwops\lwops\EmployeeloanQuery as ChildEmployeeloanQuery;
use lwops\lwops\Fishpandl as ChildFishpandl;
use lwops\lwops\FishpandlQuery as ChildFishpandlQuery;
use lwops\lwops\Ftesalaryadvance as ChildFtesalaryadvance;
use lwops\lwops\FtesalaryadvanceQuery as ChildFtesalaryadvanceQuery;
use lwops\lwops\Kiambaadairy as ChildKiambaadairy;
use lwops\lwops\KiambaadairyQuery as ChildKiambaadairyQuery;
use lwops\lwops\Opsmonthlycalendar as ChildOpsmonthlycalendar;
use lwops\lwops\OpsmonthlycalendarQuery as ChildOpsmonthlycalendarQuery;
use lwops\lwops\Teabonus as ChildTeabonus;
use lwops\lwops\TeabonusQuery as ChildTeabonusQuery;
use lwops\lwops\Teafactoryrate as ChildTeafactoryrate;
use lwops\lwops\TeafactoryrateQuery as ChildTeafactoryrateQuery;
use lwops\lwops\Teafactorytriprate as ChildTeafactorytriprate;
use lwops\lwops\TeafactorytriprateQuery as ChildTeafactorytriprateQuery;
use lwops\lwops\Teapandl as ChildTeapandl;
use lwops\lwops\TeapandlQuery as ChildTeapandlQuery;
use lwops\lwops\Vehicleexpenseallocation as ChildVehicleexpenseallocation;
use lwops\lwops\VehicleexpenseallocationQuery as ChildVehicleexpenseallocationQuery;
use lwops\lwops\Map\DairypandlTableMap;
use lwops\lwops\Map\ElectricityallocationTableMap;
use lwops\lwops\Map\ElectricityexpenseTableMap;
use lwops\lwops\Map\EmployeeloanTableMap;
use lwops\lwops\Map\FishpandlTableMap;
use lwops\lwops\Map\FtesalaryadvanceTableMap;
use lwops\lwops\Map\KiambaadairyTableMap;
use lwops\lwops\Map\OpsmonthlycalendarTableMap;
use lwops\lwops\Map\TeabonusTableMap;
use lwops\lwops\Map\TeafactoryrateTableMap;
use lwops\lwops\Map\TeafactorytriprateTableMap;
use lwops\lwops\Map\TeapandlTableMap;
use lwops\lwops\Map\VehicleexpenseallocationTableMap;

/**
 * Base class that represents a row from the 'opsmonthlycalendar' table.
 *
 *
 *
 * @package    propel.generator.lwops.lwops.Base
 */
abstract class Opsmonthlycalendar implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\lwops\\lwops\\Map\\OpsmonthlycalendarTableMap';


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
     * The value for the monthnbr field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $monthnbr;

    /**
     * The value for the month field.
     *
     * Note: this column has a database default value of: 'JAN'
     * @var        string
     */
    protected $month;

    /**
     * The value for the year field.
     *
     * Note: this column has a database default value of: 2017
     * @var        int
     */
    protected $year;

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
     * @var        ObjectCollection|ChildDairypandl[] Collection to store aggregation of ChildDairypandl objects.
     */
    protected $collDairypandls;
    protected $collDairypandlsPartial;

    /**
     * @var        ObjectCollection|ChildElectricityallocation[] Collection to store aggregation of ChildElectricityallocation objects.
     */
    protected $collElectricityallocationsRelatedByStartopsmonthlycalendaroid;
    protected $collElectricityallocationsRelatedByStartopsmonthlycalendaroidPartial;

    /**
     * @var        ObjectCollection|ChildElectricityallocation[] Collection to store aggregation of ChildElectricityallocation objects.
     */
    protected $collElectricityallocationsRelatedByEndtopsmonthlycalendaroid;
    protected $collElectricityallocationsRelatedByEndtopsmonthlycalendaroidPartial;

    /**
     * @var        ObjectCollection|ChildElectricityexpense[] Collection to store aggregation of ChildElectricityexpense objects.
     */
    protected $collElectricityexpenses;
    protected $collElectricityexpensesPartial;

    /**
     * @var        ObjectCollection|ChildEmployeeloan[] Collection to store aggregation of ChildEmployeeloan objects.
     */
    protected $collEmployeeloans;
    protected $collEmployeeloansPartial;

    /**
     * @var        ObjectCollection|ChildFishpandl[] Collection to store aggregation of ChildFishpandl objects.
     */
    protected $collFishpandls;
    protected $collFishpandlsPartial;

    /**
     * @var        ObjectCollection|ChildFtesalaryadvance[] Collection to store aggregation of ChildFtesalaryadvance objects.
     */
    protected $collFtesalaryadvances;
    protected $collFtesalaryadvancesPartial;

    /**
     * @var        ObjectCollection|ChildKiambaadairy[] Collection to store aggregation of ChildKiambaadairy objects.
     */
    protected $collKiambaadairies;
    protected $collKiambaadairiesPartial;

    /**
     * @var        ObjectCollection|ChildTeabonus[] Collection to store aggregation of ChildTeabonus objects.
     */
    protected $collTeabonuses;
    protected $collTeabonusesPartial;

    /**
     * @var        ObjectCollection|ChildTeafactoryrate[] Collection to store aggregation of ChildTeafactoryrate objects.
     */
    protected $collTeafactoryratesRelatedByStartopsmonthlycalendaroid;
    protected $collTeafactoryratesRelatedByStartopsmonthlycalendaroidPartial;

    /**
     * @var        ObjectCollection|ChildTeafactoryrate[] Collection to store aggregation of ChildTeafactoryrate objects.
     */
    protected $collTeafactoryratesRelatedByEndopsmonthlycalendaroid;
    protected $collTeafactoryratesRelatedByEndopsmonthlycalendaroidPartial;

    /**
     * @var        ObjectCollection|ChildTeafactorytriprate[] Collection to store aggregation of ChildTeafactorytriprate objects.
     */
    protected $collTeafactorytripratesRelatedByStartopsmonthlycalendaroid;
    protected $collTeafactorytripratesRelatedByStartopsmonthlycalendaroidPartial;

    /**
     * @var        ObjectCollection|ChildTeafactorytriprate[] Collection to store aggregation of ChildTeafactorytriprate objects.
     */
    protected $collTeafactorytripratesRelatedByEndopsmonthlycalendaroid;
    protected $collTeafactorytripratesRelatedByEndopsmonthlycalendaroidPartial;

    /**
     * @var        ObjectCollection|ChildTeapandl[] Collection to store aggregation of ChildTeapandl objects.
     */
    protected $collTeapandls;
    protected $collTeapandlsPartial;

    /**
     * @var        ObjectCollection|ChildVehicleexpenseallocation[] Collection to store aggregation of ChildVehicleexpenseallocation objects.
     */
    protected $collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid;
    protected $collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidPartial;

    /**
     * @var        ObjectCollection|ChildVehicleexpenseallocation[] Collection to store aggregation of ChildVehicleexpenseallocation objects.
     */
    protected $collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid;
    protected $collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDairypandl[]
     */
    protected $dairypandlsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildElectricityallocation[]
     */
    protected $electricityallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildElectricityallocation[]
     */
    protected $electricityallocationsRelatedByEndtopsmonthlycalendaroidScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildElectricityexpense[]
     */
    protected $electricityexpensesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeeloan[]
     */
    protected $employeeloansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFishpandl[]
     */
    protected $fishpandlsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFtesalaryadvance[]
     */
    protected $ftesalaryadvancesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildKiambaadairy[]
     */
    protected $kiambaadairiesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTeabonus[]
     */
    protected $teabonusesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTeafactoryrate[]
     */
    protected $teafactoryratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTeafactoryrate[]
     */
    protected $teafactoryratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTeafactorytriprate[]
     */
    protected $teafactorytripratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTeafactorytriprate[]
     */
    protected $teafactorytripratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTeapandl[]
     */
    protected $teapandlsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVehicleexpenseallocation[]
     */
    protected $vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVehicleexpenseallocation[]
     */
    protected $vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->monthnbr = 1;
        $this->month = 'JAN';
        $this->year = 2017;
    }

    /**
     * Initializes internal state of lwops\lwops\Base\Opsmonthlycalendar object.
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
     * Compares this with another <code>Opsmonthlycalendar</code> instance.  If
     * <code>obj</code> is an instance of <code>Opsmonthlycalendar</code>, delegates to
     * <code>equals(Opsmonthlycalendar)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Opsmonthlycalendar The current object, for fluid interface
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
     * Get the [monthnbr] column value.
     *
     * @return int
     */
    public function getMonthnbr()
    {
        return $this->monthnbr;
    }

    /**
     * Get the [month] column value.
     *
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Get the [year] column value.
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
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
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function setOid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oid !== $v) {
            $this->oid = $v;
            $this->modifiedColumns[OpsmonthlycalendarTableMap::COL_OID] = true;
        }

        return $this;
    } // setOid()

    /**
     * Set the value of [monthnbr] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function setMonthnbr($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->monthnbr !== $v) {
            $this->monthnbr = $v;
            $this->modifiedColumns[OpsmonthlycalendarTableMap::COL_MONTHNBR] = true;
        }

        return $this;
    } // setMonthnbr()

    /**
     * Set the value of [month] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function setMonth($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->month !== $v) {
            $this->month = $v;
            $this->modifiedColumns[OpsmonthlycalendarTableMap::COL_MONTH] = true;
        }

        return $this;
    } // setMonth()

    /**
     * Set the value of [year] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function setYear($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->year !== $v) {
            $this->year = $v;
            $this->modifiedColumns[OpsmonthlycalendarTableMap::COL_YEAR] = true;
        }

        return $this;
    } // setYear()

    /**
     * Sets the value of [createtmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function setCreatetmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->createtmstp !== null || $dt !== null) {
            if ($this->createtmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->createtmstp->format("Y-m-d H:i:s.u")) {
                $this->createtmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OpsmonthlycalendarTableMap::COL_CREATETMSTP] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatetmstp()

    /**
     * Sets the value of [updttmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function setUpdttmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updttmstp !== null || $dt !== null) {
            if ($this->updttmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updttmstp->format("Y-m-d H:i:s.u")) {
                $this->updttmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OpsmonthlycalendarTableMap::COL_UPDTTMSTP] = true;
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
            if ($this->monthnbr !== 1) {
                return false;
            }

            if ($this->month !== 'JAN') {
                return false;
            }

            if ($this->year !== 2017) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OpsmonthlycalendarTableMap::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->oid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OpsmonthlycalendarTableMap::translateFieldName('Monthnbr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->monthnbr = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OpsmonthlycalendarTableMap::translateFieldName('Month', TableMap::TYPE_PHPNAME, $indexType)];
            $this->month = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OpsmonthlycalendarTableMap::translateFieldName('Year', TableMap::TYPE_PHPNAME, $indexType)];
            $this->year = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OpsmonthlycalendarTableMap::translateFieldName('Createtmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->createtmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OpsmonthlycalendarTableMap::translateFieldName('Updttmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updttmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = OpsmonthlycalendarTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\lwops\\lwops\\Opsmonthlycalendar'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(OpsmonthlycalendarTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOpsmonthlycalendarQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collDairypandls = null;

            $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid = null;

            $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid = null;

            $this->collElectricityexpenses = null;

            $this->collEmployeeloans = null;

            $this->collFishpandls = null;

            $this->collFtesalaryadvances = null;

            $this->collKiambaadairies = null;

            $this->collTeabonuses = null;

            $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid = null;

            $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid = null;

            $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid = null;

            $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid = null;

            $this->collTeapandls = null;

            $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid = null;

            $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Opsmonthlycalendar::setDeleted()
     * @see Opsmonthlycalendar::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OpsmonthlycalendarTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOpsmonthlycalendarQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OpsmonthlycalendarTableMap::DATABASE_NAME);
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
                OpsmonthlycalendarTableMap::addInstanceToPool($this);
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

            if ($this->dairypandlsScheduledForDeletion !== null) {
                if (!$this->dairypandlsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\DairypandlQuery::create()
                        ->filterByPrimaryKeys($this->dairypandlsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->dairypandlsScheduledForDeletion = null;
                }
            }

            if ($this->collDairypandls !== null) {
                foreach ($this->collDairypandls as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->electricityallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion !== null) {
                if (!$this->electricityallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\ElectricityallocationQuery::create()
                        ->filterByPrimaryKeys($this->electricityallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->electricityallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion = null;
                }
            }

            if ($this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid !== null) {
                foreach ($this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->electricityallocationsRelatedByEndtopsmonthlycalendaroidScheduledForDeletion !== null) {
                if (!$this->electricityallocationsRelatedByEndtopsmonthlycalendaroidScheduledForDeletion->isEmpty()) {
                    foreach ($this->electricityallocationsRelatedByEndtopsmonthlycalendaroidScheduledForDeletion as $electricityallocationRelatedByEndtopsmonthlycalendaroid) {
                        // need to save related object because we set the relation to null
                        $electricityallocationRelatedByEndtopsmonthlycalendaroid->save($con);
                    }
                    $this->electricityallocationsRelatedByEndtopsmonthlycalendaroidScheduledForDeletion = null;
                }
            }

            if ($this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid !== null) {
                foreach ($this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->electricityexpensesScheduledForDeletion !== null) {
                if (!$this->electricityexpensesScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\ElectricityexpenseQuery::create()
                        ->filterByPrimaryKeys($this->electricityexpensesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->electricityexpensesScheduledForDeletion = null;
                }
            }

            if ($this->collElectricityexpenses !== null) {
                foreach ($this->collElectricityexpenses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->employeeloansScheduledForDeletion !== null) {
                if (!$this->employeeloansScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\EmployeeloanQuery::create()
                        ->filterByPrimaryKeys($this->employeeloansScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->employeeloansScheduledForDeletion = null;
                }
            }

            if ($this->collEmployeeloans !== null) {
                foreach ($this->collEmployeeloans as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->fishpandlsScheduledForDeletion !== null) {
                if (!$this->fishpandlsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\FishpandlQuery::create()
                        ->filterByPrimaryKeys($this->fishpandlsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->fishpandlsScheduledForDeletion = null;
                }
            }

            if ($this->collFishpandls !== null) {
                foreach ($this->collFishpandls as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ftesalaryadvancesScheduledForDeletion !== null) {
                if (!$this->ftesalaryadvancesScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\FtesalaryadvanceQuery::create()
                        ->filterByPrimaryKeys($this->ftesalaryadvancesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ftesalaryadvancesScheduledForDeletion = null;
                }
            }

            if ($this->collFtesalaryadvances !== null) {
                foreach ($this->collFtesalaryadvances as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->kiambaadairiesScheduledForDeletion !== null) {
                if (!$this->kiambaadairiesScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\KiambaadairyQuery::create()
                        ->filterByPrimaryKeys($this->kiambaadairiesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->kiambaadairiesScheduledForDeletion = null;
                }
            }

            if ($this->collKiambaadairies !== null) {
                foreach ($this->collKiambaadairies as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->teabonusesScheduledForDeletion !== null) {
                if (!$this->teabonusesScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\TeabonusQuery::create()
                        ->filterByPrimaryKeys($this->teabonusesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->teabonusesScheduledForDeletion = null;
                }
            }

            if ($this->collTeabonuses !== null) {
                foreach ($this->collTeabonuses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->teafactoryratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion !== null) {
                if (!$this->teafactoryratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\TeafactoryrateQuery::create()
                        ->filterByPrimaryKeys($this->teafactoryratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->teafactoryratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion = null;
                }
            }

            if ($this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid !== null) {
                foreach ($this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->teafactoryratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion !== null) {
                if (!$this->teafactoryratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion->isEmpty()) {
                    foreach ($this->teafactoryratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion as $teafactoryrateRelatedByEndopsmonthlycalendaroid) {
                        // need to save related object because we set the relation to null
                        $teafactoryrateRelatedByEndopsmonthlycalendaroid->save($con);
                    }
                    $this->teafactoryratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion = null;
                }
            }

            if ($this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid !== null) {
                foreach ($this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->teafactorytripratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion !== null) {
                if (!$this->teafactorytripratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\TeafactorytriprateQuery::create()
                        ->filterByPrimaryKeys($this->teafactorytripratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->teafactorytripratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion = null;
                }
            }

            if ($this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid !== null) {
                foreach ($this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->teafactorytripratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion !== null) {
                if (!$this->teafactorytripratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion->isEmpty()) {
                    foreach ($this->teafactorytripratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion as $teafactorytriprateRelatedByEndopsmonthlycalendaroid) {
                        // need to save related object because we set the relation to null
                        $teafactorytriprateRelatedByEndopsmonthlycalendaroid->save($con);
                    }
                    $this->teafactorytripratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion = null;
                }
            }

            if ($this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid !== null) {
                foreach ($this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->teapandlsScheduledForDeletion !== null) {
                if (!$this->teapandlsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\TeapandlQuery::create()
                        ->filterByPrimaryKeys($this->teapandlsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->teapandlsScheduledForDeletion = null;
                }
            }

            if ($this->collTeapandls !== null) {
                foreach ($this->collTeapandls as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion !== null) {
                if (!$this->vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\VehicleexpenseallocationQuery::create()
                        ->filterByPrimaryKeys($this->vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion = null;
                }
            }

            if ($this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid !== null) {
                foreach ($this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidScheduledForDeletion !== null) {
                if (!$this->vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\VehicleexpenseallocationQuery::create()
                        ->filterByPrimaryKeys($this->vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidScheduledForDeletion = null;
                }
            }

            if ($this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid !== null) {
                foreach ($this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid as $referrerFK) {
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

        $this->modifiedColumns[OpsmonthlycalendarTableMap::COL_OID] = true;
        if (null !== $this->oid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OpsmonthlycalendarTableMap::COL_OID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OpsmonthlycalendarTableMap::COL_OID)) {
            $modifiedColumns[':p' . $index++]  = 'oid';
        }
        if ($this->isColumnModified(OpsmonthlycalendarTableMap::COL_MONTHNBR)) {
            $modifiedColumns[':p' . $index++]  = 'monthNbr';
        }
        if ($this->isColumnModified(OpsmonthlycalendarTableMap::COL_MONTH)) {
            $modifiedColumns[':p' . $index++]  = 'month';
        }
        if ($this->isColumnModified(OpsmonthlycalendarTableMap::COL_YEAR)) {
            $modifiedColumns[':p' . $index++]  = 'year';
        }
        if ($this->isColumnModified(OpsmonthlycalendarTableMap::COL_CREATETMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'createTmstp';
        }
        if ($this->isColumnModified(OpsmonthlycalendarTableMap::COL_UPDTTMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'updtTmstp';
        }

        $sql = sprintf(
            'INSERT INTO opsmonthlycalendar (%s) VALUES (%s)',
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
                    case 'monthNbr':
                        $stmt->bindValue($identifier, $this->monthnbr, PDO::PARAM_INT);
                        break;
                    case 'month':
                        $stmt->bindValue($identifier, $this->month, PDO::PARAM_STR);
                        break;
                    case 'year':
                        $stmt->bindValue($identifier, $this->year, PDO::PARAM_INT);
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
        $pos = OpsmonthlycalendarTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getMonthnbr();
                break;
            case 2:
                return $this->getMonth();
                break;
            case 3:
                return $this->getYear();
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

        if (isset($alreadyDumpedObjects['Opsmonthlycalendar'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Opsmonthlycalendar'][$this->hashCode()] = true;
        $keys = OpsmonthlycalendarTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOid(),
            $keys[1] => $this->getMonthnbr(),
            $keys[2] => $this->getMonth(),
            $keys[3] => $this->getYear(),
            $keys[4] => $this->getCreatetmstp(),
            $keys[5] => $this->getUpdttmstp(),
        );
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
            if (null !== $this->collDairypandls) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dairypandls';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'dairypandls';
                        break;
                    default:
                        $key = 'Dairypandls';
                }

                $result[$key] = $this->collDairypandls->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'electricityallocations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'electricityallocations';
                        break;
                    default:
                        $key = 'Electricityallocations';
                }

                $result[$key] = $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'electricityallocations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'electricityallocations';
                        break;
                    default:
                        $key = 'Electricityallocations';
                }

                $result[$key] = $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collElectricityexpenses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'electricityexpenses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'electricityexpenses';
                        break;
                    default:
                        $key = 'Electricityexpenses';
                }

                $result[$key] = $this->collElectricityexpenses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEmployeeloans) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employeeloans';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employeeloans';
                        break;
                    default:
                        $key = 'Employeeloans';
                }

                $result[$key] = $this->collEmployeeloans->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collFishpandls) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'fishpandls';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'fishpandls';
                        break;
                    default:
                        $key = 'Fishpandls';
                }

                $result[$key] = $this->collFishpandls->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collFtesalaryadvances) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ftesalaryadvances';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ftesalaryadvances';
                        break;
                    default:
                        $key = 'Ftesalaryadvances';
                }

                $result[$key] = $this->collFtesalaryadvances->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collKiambaadairies) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'kiambaadairies';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kiambaadairies';
                        break;
                    default:
                        $key = 'Kiambaadairies';
                }

                $result[$key] = $this->collKiambaadairies->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTeabonuses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'teabonuses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'teabonuses';
                        break;
                    default:
                        $key = 'Teabonuses';
                }

                $result[$key] = $this->collTeabonuses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'teafactoryrates';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'teafactoryrates';
                        break;
                    default:
                        $key = 'Teafactoryrates';
                }

                $result[$key] = $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'teafactoryrates';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'teafactoryrates';
                        break;
                    default:
                        $key = 'Teafactoryrates';
                }

                $result[$key] = $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'teafactorytriprates';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'teafactorytriprates';
                        break;
                    default:
                        $key = 'Teafactorytriprates';
                }

                $result[$key] = $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'teafactorytriprates';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'teafactorytriprates';
                        break;
                    default:
                        $key = 'Teafactorytriprates';
                }

                $result[$key] = $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTeapandls) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'teapandls';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'teapandls';
                        break;
                    default:
                        $key = 'Teapandls';
                }

                $result[$key] = $this->collTeapandls->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'vehicleexpenseallocations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'vehicleexpenseallocations';
                        break;
                    default:
                        $key = 'Vehicleexpenseallocations';
                }

                $result[$key] = $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'vehicleexpenseallocations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'vehicleexpenseallocations';
                        break;
                    default:
                        $key = 'Vehicleexpenseallocations';
                }

                $result[$key] = $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\lwops\lwops\Opsmonthlycalendar
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = OpsmonthlycalendarTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\lwops\lwops\Opsmonthlycalendar
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setOid($value);
                break;
            case 1:
                $this->setMonthnbr($value);
                break;
            case 2:
                $this->setMonth($value);
                break;
            case 3:
                $this->setYear($value);
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
        $keys = OpsmonthlycalendarTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setMonthnbr($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setMonth($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setYear($arr[$keys[3]]);
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
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object, for fluid interface
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
        $criteria = new Criteria(OpsmonthlycalendarTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OpsmonthlycalendarTableMap::COL_OID)) {
            $criteria->add(OpsmonthlycalendarTableMap::COL_OID, $this->oid);
        }
        if ($this->isColumnModified(OpsmonthlycalendarTableMap::COL_MONTHNBR)) {
            $criteria->add(OpsmonthlycalendarTableMap::COL_MONTHNBR, $this->monthnbr);
        }
        if ($this->isColumnModified(OpsmonthlycalendarTableMap::COL_MONTH)) {
            $criteria->add(OpsmonthlycalendarTableMap::COL_MONTH, $this->month);
        }
        if ($this->isColumnModified(OpsmonthlycalendarTableMap::COL_YEAR)) {
            $criteria->add(OpsmonthlycalendarTableMap::COL_YEAR, $this->year);
        }
        if ($this->isColumnModified(OpsmonthlycalendarTableMap::COL_CREATETMSTP)) {
            $criteria->add(OpsmonthlycalendarTableMap::COL_CREATETMSTP, $this->createtmstp);
        }
        if ($this->isColumnModified(OpsmonthlycalendarTableMap::COL_UPDTTMSTP)) {
            $criteria->add(OpsmonthlycalendarTableMap::COL_UPDTTMSTP, $this->updttmstp);
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
        $criteria = ChildOpsmonthlycalendarQuery::create();
        $criteria->add(OpsmonthlycalendarTableMap::COL_OID, $this->oid);

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
     * @param      object $copyObj An object of \lwops\lwops\Opsmonthlycalendar (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setMonthnbr($this->getMonthnbr());
        $copyObj->setMonth($this->getMonth());
        $copyObj->setYear($this->getYear());
        $copyObj->setCreatetmstp($this->getCreatetmstp());
        $copyObj->setUpdttmstp($this->getUpdttmstp());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getDairypandls() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDairypandl($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getElectricityallocationsRelatedByStartopsmonthlycalendaroid() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addElectricityallocationRelatedByStartopsmonthlycalendaroid($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getElectricityallocationsRelatedByEndtopsmonthlycalendaroid() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addElectricityallocationRelatedByEndtopsmonthlycalendaroid($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getElectricityexpenses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addElectricityexpense($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeeloans() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeeloan($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getFishpandls() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFishpandl($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getFtesalaryadvances() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFtesalaryadvance($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getKiambaadairies() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addKiambaadairy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTeabonuses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTeabonus($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTeafactoryratesRelatedByStartopsmonthlycalendaroid() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTeafactoryrateRelatedByStartopsmonthlycalendaroid($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTeafactoryratesRelatedByEndopsmonthlycalendaroid() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTeafactoryrateRelatedByEndopsmonthlycalendaroid($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTeafactorytripratesRelatedByStartopsmonthlycalendaroid() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTeafactorytriprateRelatedByStartopsmonthlycalendaroid($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTeafactorytripratesRelatedByEndopsmonthlycalendaroid() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTeafactorytriprateRelatedByEndopsmonthlycalendaroid($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTeapandls() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTeapandl($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid($relObj->copy($deepCopy));
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
     * @return \lwops\lwops\Opsmonthlycalendar Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Dairypandl' == $relationName) {
            $this->initDairypandls();
            return;
        }
        if ('ElectricityallocationRelatedByStartopsmonthlycalendaroid' == $relationName) {
            $this->initElectricityallocationsRelatedByStartopsmonthlycalendaroid();
            return;
        }
        if ('ElectricityallocationRelatedByEndtopsmonthlycalendaroid' == $relationName) {
            $this->initElectricityallocationsRelatedByEndtopsmonthlycalendaroid();
            return;
        }
        if ('Electricityexpense' == $relationName) {
            $this->initElectricityexpenses();
            return;
        }
        if ('Employeeloan' == $relationName) {
            $this->initEmployeeloans();
            return;
        }
        if ('Fishpandl' == $relationName) {
            $this->initFishpandls();
            return;
        }
        if ('Ftesalaryadvance' == $relationName) {
            $this->initFtesalaryadvances();
            return;
        }
        if ('Kiambaadairy' == $relationName) {
            $this->initKiambaadairies();
            return;
        }
        if ('Teabonus' == $relationName) {
            $this->initTeabonuses();
            return;
        }
        if ('TeafactoryrateRelatedByStartopsmonthlycalendaroid' == $relationName) {
            $this->initTeafactoryratesRelatedByStartopsmonthlycalendaroid();
            return;
        }
        if ('TeafactoryrateRelatedByEndopsmonthlycalendaroid' == $relationName) {
            $this->initTeafactoryratesRelatedByEndopsmonthlycalendaroid();
            return;
        }
        if ('TeafactorytriprateRelatedByStartopsmonthlycalendaroid' == $relationName) {
            $this->initTeafactorytripratesRelatedByStartopsmonthlycalendaroid();
            return;
        }
        if ('TeafactorytriprateRelatedByEndopsmonthlycalendaroid' == $relationName) {
            $this->initTeafactorytripratesRelatedByEndopsmonthlycalendaroid();
            return;
        }
        if ('Teapandl' == $relationName) {
            $this->initTeapandls();
            return;
        }
        if ('VehicleexpenseallocationRelatedByStartopsmonthlycalendaroid' == $relationName) {
            $this->initVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid();
            return;
        }
        if ('VehicleexpenseallocationRelatedByEndopsmonthlycalendaroid' == $relationName) {
            $this->initVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid();
            return;
        }
    }

    /**
     * Clears out the collDairypandls collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDairypandls()
     */
    public function clearDairypandls()
    {
        $this->collDairypandls = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collDairypandls collection loaded partially.
     */
    public function resetPartialDairypandls($v = true)
    {
        $this->collDairypandlsPartial = $v;
    }

    /**
     * Initializes the collDairypandls collection.
     *
     * By default this just sets the collDairypandls collection to an empty array (like clearcollDairypandls());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDairypandls($overrideExisting = true)
    {
        if (null !== $this->collDairypandls && !$overrideExisting) {
            return;
        }

        $collectionClassName = DairypandlTableMap::getTableMap()->getCollectionClassName();

        $this->collDairypandls = new $collectionClassName;
        $this->collDairypandls->setModel('\lwops\lwops\Dairypandl');
    }

    /**
     * Gets an array of ChildDairypandl objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDairypandl[] List of ChildDairypandl objects
     * @throws PropelException
     */
    public function getDairypandls(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collDairypandlsPartial && !$this->isNew();
        if (null === $this->collDairypandls || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDairypandls) {
                // return empty collection
                $this->initDairypandls();
            } else {
                $collDairypandls = ChildDairypandlQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendar($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDairypandlsPartial && count($collDairypandls)) {
                        $this->initDairypandls(false);

                        foreach ($collDairypandls as $obj) {
                            if (false == $this->collDairypandls->contains($obj)) {
                                $this->collDairypandls->append($obj);
                            }
                        }

                        $this->collDairypandlsPartial = true;
                    }

                    return $collDairypandls;
                }

                if ($partial && $this->collDairypandls) {
                    foreach ($this->collDairypandls as $obj) {
                        if ($obj->isNew()) {
                            $collDairypandls[] = $obj;
                        }
                    }
                }

                $this->collDairypandls = $collDairypandls;
                $this->collDairypandlsPartial = false;
            }
        }

        return $this->collDairypandls;
    }

    /**
     * Sets a collection of ChildDairypandl objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $dairypandls A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setDairypandls(Collection $dairypandls, ConnectionInterface $con = null)
    {
        /** @var ChildDairypandl[] $dairypandlsToDelete */
        $dairypandlsToDelete = $this->getDairypandls(new Criteria(), $con)->diff($dairypandls);


        $this->dairypandlsScheduledForDeletion = $dairypandlsToDelete;

        foreach ($dairypandlsToDelete as $dairypandlRemoved) {
            $dairypandlRemoved->setOpsmonthlycalendar(null);
        }

        $this->collDairypandls = null;
        foreach ($dairypandls as $dairypandl) {
            $this->addDairypandl($dairypandl);
        }

        $this->collDairypandls = $dairypandls;
        $this->collDairypandlsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Dairypandl objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Dairypandl objects.
     * @throws PropelException
     */
    public function countDairypandls(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collDairypandlsPartial && !$this->isNew();
        if (null === $this->collDairypandls || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDairypandls) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDairypandls());
            }

            $query = ChildDairypandlQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendar($this)
                ->count($con);
        }

        return count($this->collDairypandls);
    }

    /**
     * Method called to associate a ChildDairypandl object to this object
     * through the ChildDairypandl foreign key attribute.
     *
     * @param  ChildDairypandl $l ChildDairypandl
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addDairypandl(ChildDairypandl $l)
    {
        if ($this->collDairypandls === null) {
            $this->initDairypandls();
            $this->collDairypandlsPartial = true;
        }

        if (!$this->collDairypandls->contains($l)) {
            $this->doAddDairypandl($l);

            if ($this->dairypandlsScheduledForDeletion and $this->dairypandlsScheduledForDeletion->contains($l)) {
                $this->dairypandlsScheduledForDeletion->remove($this->dairypandlsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDairypandl $dairypandl The ChildDairypandl object to add.
     */
    protected function doAddDairypandl(ChildDairypandl $dairypandl)
    {
        $this->collDairypandls[]= $dairypandl;
        $dairypandl->setOpsmonthlycalendar($this);
    }

    /**
     * @param  ChildDairypandl $dairypandl The ChildDairypandl object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeDairypandl(ChildDairypandl $dairypandl)
    {
        if ($this->getDairypandls()->contains($dairypandl)) {
            $pos = $this->collDairypandls->search($dairypandl);
            $this->collDairypandls->remove($pos);
            if (null === $this->dairypandlsScheduledForDeletion) {
                $this->dairypandlsScheduledForDeletion = clone $this->collDairypandls;
                $this->dairypandlsScheduledForDeletion->clear();
            }
            $this->dairypandlsScheduledForDeletion[]= clone $dairypandl;
            $dairypandl->setOpsmonthlycalendar(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Opsmonthlycalendar is new, it will return
     * an empty collection; or if this Opsmonthlycalendar has previously
     * been saved, it will retrieve related Dairypandls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Opsmonthlycalendar.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDairypandl[] List of ChildDairypandl objects
     */
    public function getDairypandlsJoinLineofbusiness(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDairypandlQuery::create(null, $criteria);
        $query->joinWith('Lineofbusiness', $joinBehavior);

        return $this->getDairypandls($query, $con);
    }

    /**
     * Clears out the collElectricityallocationsRelatedByStartopsmonthlycalendaroid collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addElectricityallocationsRelatedByStartopsmonthlycalendaroid()
     */
    public function clearElectricityallocationsRelatedByStartopsmonthlycalendaroid()
    {
        $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collElectricityallocationsRelatedByStartopsmonthlycalendaroid collection loaded partially.
     */
    public function resetPartialElectricityallocationsRelatedByStartopsmonthlycalendaroid($v = true)
    {
        $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroidPartial = $v;
    }

    /**
     * Initializes the collElectricityallocationsRelatedByStartopsmonthlycalendaroid collection.
     *
     * By default this just sets the collElectricityallocationsRelatedByStartopsmonthlycalendaroid collection to an empty array (like clearcollElectricityallocationsRelatedByStartopsmonthlycalendaroid());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initElectricityallocationsRelatedByStartopsmonthlycalendaroid($overrideExisting = true)
    {
        if (null !== $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid && !$overrideExisting) {
            return;
        }

        $collectionClassName = ElectricityallocationTableMap::getTableMap()->getCollectionClassName();

        $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid = new $collectionClassName;
        $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid->setModel('\lwops\lwops\Electricityallocation');
    }

    /**
     * Gets an array of ChildElectricityallocation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildElectricityallocation[] List of ChildElectricityallocation objects
     * @throws PropelException
     */
    public function getElectricityallocationsRelatedByStartopsmonthlycalendaroid(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid) {
                // return empty collection
                $this->initElectricityallocationsRelatedByStartopsmonthlycalendaroid();
            } else {
                $collElectricityallocationsRelatedByStartopsmonthlycalendaroid = ChildElectricityallocationQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroidPartial && count($collElectricityallocationsRelatedByStartopsmonthlycalendaroid)) {
                        $this->initElectricityallocationsRelatedByStartopsmonthlycalendaroid(false);

                        foreach ($collElectricityallocationsRelatedByStartopsmonthlycalendaroid as $obj) {
                            if (false == $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid->contains($obj)) {
                                $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid->append($obj);
                            }
                        }

                        $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroidPartial = true;
                    }

                    return $collElectricityallocationsRelatedByStartopsmonthlycalendaroid;
                }

                if ($partial && $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid) {
                    foreach ($this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid as $obj) {
                        if ($obj->isNew()) {
                            $collElectricityallocationsRelatedByStartopsmonthlycalendaroid[] = $obj;
                        }
                    }
                }

                $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid = $collElectricityallocationsRelatedByStartopsmonthlycalendaroid;
                $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroidPartial = false;
            }
        }

        return $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid;
    }

    /**
     * Sets a collection of ChildElectricityallocation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $electricityallocationsRelatedByStartopsmonthlycalendaroid A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setElectricityallocationsRelatedByStartopsmonthlycalendaroid(Collection $electricityallocationsRelatedByStartopsmonthlycalendaroid, ConnectionInterface $con = null)
    {
        /** @var ChildElectricityallocation[] $electricityallocationsRelatedByStartopsmonthlycalendaroidToDelete */
        $electricityallocationsRelatedByStartopsmonthlycalendaroidToDelete = $this->getElectricityallocationsRelatedByStartopsmonthlycalendaroid(new Criteria(), $con)->diff($electricityallocationsRelatedByStartopsmonthlycalendaroid);


        $this->electricityallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion = $electricityallocationsRelatedByStartopsmonthlycalendaroidToDelete;

        foreach ($electricityallocationsRelatedByStartopsmonthlycalendaroidToDelete as $electricityallocationRelatedByStartopsmonthlycalendaroidRemoved) {
            $electricityallocationRelatedByStartopsmonthlycalendaroidRemoved->setOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid(null);
        }

        $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid = null;
        foreach ($electricityallocationsRelatedByStartopsmonthlycalendaroid as $electricityallocationRelatedByStartopsmonthlycalendaroid) {
            $this->addElectricityallocationRelatedByStartopsmonthlycalendaroid($electricityallocationRelatedByStartopsmonthlycalendaroid);
        }

        $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid = $electricityallocationsRelatedByStartopsmonthlycalendaroid;
        $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroidPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Electricityallocation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Electricityallocation objects.
     * @throws PropelException
     */
    public function countElectricityallocationsRelatedByStartopsmonthlycalendaroid(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getElectricityallocationsRelatedByStartopsmonthlycalendaroid());
            }

            $query = ChildElectricityallocationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($this)
                ->count($con);
        }

        return count($this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid);
    }

    /**
     * Method called to associate a ChildElectricityallocation object to this object
     * through the ChildElectricityallocation foreign key attribute.
     *
     * @param  ChildElectricityallocation $l ChildElectricityallocation
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addElectricityallocationRelatedByStartopsmonthlycalendaroid(ChildElectricityallocation $l)
    {
        if ($this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid === null) {
            $this->initElectricityallocationsRelatedByStartopsmonthlycalendaroid();
            $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroidPartial = true;
        }

        if (!$this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid->contains($l)) {
            $this->doAddElectricityallocationRelatedByStartopsmonthlycalendaroid($l);

            if ($this->electricityallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion and $this->electricityallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion->contains($l)) {
                $this->electricityallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion->remove($this->electricityallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildElectricityallocation $electricityallocationRelatedByStartopsmonthlycalendaroid The ChildElectricityallocation object to add.
     */
    protected function doAddElectricityallocationRelatedByStartopsmonthlycalendaroid(ChildElectricityallocation $electricityallocationRelatedByStartopsmonthlycalendaroid)
    {
        $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid[]= $electricityallocationRelatedByStartopsmonthlycalendaroid;
        $electricityallocationRelatedByStartopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($this);
    }

    /**
     * @param  ChildElectricityallocation $electricityallocationRelatedByStartopsmonthlycalendaroid The ChildElectricityallocation object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeElectricityallocationRelatedByStartopsmonthlycalendaroid(ChildElectricityallocation $electricityallocationRelatedByStartopsmonthlycalendaroid)
    {
        if ($this->getElectricityallocationsRelatedByStartopsmonthlycalendaroid()->contains($electricityallocationRelatedByStartopsmonthlycalendaroid)) {
            $pos = $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid->search($electricityallocationRelatedByStartopsmonthlycalendaroid);
            $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid->remove($pos);
            if (null === $this->electricityallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion) {
                $this->electricityallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion = clone $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid;
                $this->electricityallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion->clear();
            }
            $this->electricityallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion[]= clone $electricityallocationRelatedByStartopsmonthlycalendaroid;
            $electricityallocationRelatedByStartopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Opsmonthlycalendar is new, it will return
     * an empty collection; or if this Opsmonthlycalendar has previously
     * been saved, it will retrieve related ElectricityallocationsRelatedByStartopsmonthlycalendaroid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Opsmonthlycalendar.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildElectricityallocation[] List of ChildElectricityallocation objects
     */
    public function getElectricityallocationsRelatedByStartopsmonthlycalendaroidJoinElectricityaccount(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildElectricityallocationQuery::create(null, $criteria);
        $query->joinWith('Electricityaccount', $joinBehavior);

        return $this->getElectricityallocationsRelatedByStartopsmonthlycalendaroid($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Opsmonthlycalendar is new, it will return
     * an empty collection; or if this Opsmonthlycalendar has previously
     * been saved, it will retrieve related ElectricityallocationsRelatedByStartopsmonthlycalendaroid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Opsmonthlycalendar.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildElectricityallocation[] List of ChildElectricityallocation objects
     */
    public function getElectricityallocationsRelatedByStartopsmonthlycalendaroidJoinLineofbusiness(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildElectricityallocationQuery::create(null, $criteria);
        $query->joinWith('Lineofbusiness', $joinBehavior);

        return $this->getElectricityallocationsRelatedByStartopsmonthlycalendaroid($query, $con);
    }

    /**
     * Clears out the collElectricityallocationsRelatedByEndtopsmonthlycalendaroid collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addElectricityallocationsRelatedByEndtopsmonthlycalendaroid()
     */
    public function clearElectricityallocationsRelatedByEndtopsmonthlycalendaroid()
    {
        $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collElectricityallocationsRelatedByEndtopsmonthlycalendaroid collection loaded partially.
     */
    public function resetPartialElectricityallocationsRelatedByEndtopsmonthlycalendaroid($v = true)
    {
        $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroidPartial = $v;
    }

    /**
     * Initializes the collElectricityallocationsRelatedByEndtopsmonthlycalendaroid collection.
     *
     * By default this just sets the collElectricityallocationsRelatedByEndtopsmonthlycalendaroid collection to an empty array (like clearcollElectricityallocationsRelatedByEndtopsmonthlycalendaroid());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initElectricityallocationsRelatedByEndtopsmonthlycalendaroid($overrideExisting = true)
    {
        if (null !== $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid && !$overrideExisting) {
            return;
        }

        $collectionClassName = ElectricityallocationTableMap::getTableMap()->getCollectionClassName();

        $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid = new $collectionClassName;
        $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid->setModel('\lwops\lwops\Electricityallocation');
    }

    /**
     * Gets an array of ChildElectricityallocation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildElectricityallocation[] List of ChildElectricityallocation objects
     * @throws PropelException
     */
    public function getElectricityallocationsRelatedByEndtopsmonthlycalendaroid(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid) {
                // return empty collection
                $this->initElectricityallocationsRelatedByEndtopsmonthlycalendaroid();
            } else {
                $collElectricityallocationsRelatedByEndtopsmonthlycalendaroid = ChildElectricityallocationQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroidPartial && count($collElectricityallocationsRelatedByEndtopsmonthlycalendaroid)) {
                        $this->initElectricityallocationsRelatedByEndtopsmonthlycalendaroid(false);

                        foreach ($collElectricityallocationsRelatedByEndtopsmonthlycalendaroid as $obj) {
                            if (false == $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid->contains($obj)) {
                                $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid->append($obj);
                            }
                        }

                        $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroidPartial = true;
                    }

                    return $collElectricityallocationsRelatedByEndtopsmonthlycalendaroid;
                }

                if ($partial && $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid) {
                    foreach ($this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid as $obj) {
                        if ($obj->isNew()) {
                            $collElectricityallocationsRelatedByEndtopsmonthlycalendaroid[] = $obj;
                        }
                    }
                }

                $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid = $collElectricityallocationsRelatedByEndtopsmonthlycalendaroid;
                $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroidPartial = false;
            }
        }

        return $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid;
    }

    /**
     * Sets a collection of ChildElectricityallocation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $electricityallocationsRelatedByEndtopsmonthlycalendaroid A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setElectricityallocationsRelatedByEndtopsmonthlycalendaroid(Collection $electricityallocationsRelatedByEndtopsmonthlycalendaroid, ConnectionInterface $con = null)
    {
        /** @var ChildElectricityallocation[] $electricityallocationsRelatedByEndtopsmonthlycalendaroidToDelete */
        $electricityallocationsRelatedByEndtopsmonthlycalendaroidToDelete = $this->getElectricityallocationsRelatedByEndtopsmonthlycalendaroid(new Criteria(), $con)->diff($electricityallocationsRelatedByEndtopsmonthlycalendaroid);


        $this->electricityallocationsRelatedByEndtopsmonthlycalendaroidScheduledForDeletion = $electricityallocationsRelatedByEndtopsmonthlycalendaroidToDelete;

        foreach ($electricityallocationsRelatedByEndtopsmonthlycalendaroidToDelete as $electricityallocationRelatedByEndtopsmonthlycalendaroidRemoved) {
            $electricityallocationRelatedByEndtopsmonthlycalendaroidRemoved->setOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid(null);
        }

        $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid = null;
        foreach ($electricityallocationsRelatedByEndtopsmonthlycalendaroid as $electricityallocationRelatedByEndtopsmonthlycalendaroid) {
            $this->addElectricityallocationRelatedByEndtopsmonthlycalendaroid($electricityallocationRelatedByEndtopsmonthlycalendaroid);
        }

        $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid = $electricityallocationsRelatedByEndtopsmonthlycalendaroid;
        $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroidPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Electricityallocation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Electricityallocation objects.
     * @throws PropelException
     */
    public function countElectricityallocationsRelatedByEndtopsmonthlycalendaroid(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getElectricityallocationsRelatedByEndtopsmonthlycalendaroid());
            }

            $query = ChildElectricityallocationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid($this)
                ->count($con);
        }

        return count($this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid);
    }

    /**
     * Method called to associate a ChildElectricityallocation object to this object
     * through the ChildElectricityallocation foreign key attribute.
     *
     * @param  ChildElectricityallocation $l ChildElectricityallocation
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addElectricityallocationRelatedByEndtopsmonthlycalendaroid(ChildElectricityallocation $l)
    {
        if ($this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid === null) {
            $this->initElectricityallocationsRelatedByEndtopsmonthlycalendaroid();
            $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroidPartial = true;
        }

        if (!$this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid->contains($l)) {
            $this->doAddElectricityallocationRelatedByEndtopsmonthlycalendaroid($l);

            if ($this->electricityallocationsRelatedByEndtopsmonthlycalendaroidScheduledForDeletion and $this->electricityallocationsRelatedByEndtopsmonthlycalendaroidScheduledForDeletion->contains($l)) {
                $this->electricityallocationsRelatedByEndtopsmonthlycalendaroidScheduledForDeletion->remove($this->electricityallocationsRelatedByEndtopsmonthlycalendaroidScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildElectricityallocation $electricityallocationRelatedByEndtopsmonthlycalendaroid The ChildElectricityallocation object to add.
     */
    protected function doAddElectricityallocationRelatedByEndtopsmonthlycalendaroid(ChildElectricityallocation $electricityallocationRelatedByEndtopsmonthlycalendaroid)
    {
        $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid[]= $electricityallocationRelatedByEndtopsmonthlycalendaroid;
        $electricityallocationRelatedByEndtopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid($this);
    }

    /**
     * @param  ChildElectricityallocation $electricityallocationRelatedByEndtopsmonthlycalendaroid The ChildElectricityallocation object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeElectricityallocationRelatedByEndtopsmonthlycalendaroid(ChildElectricityallocation $electricityallocationRelatedByEndtopsmonthlycalendaroid)
    {
        if ($this->getElectricityallocationsRelatedByEndtopsmonthlycalendaroid()->contains($electricityallocationRelatedByEndtopsmonthlycalendaroid)) {
            $pos = $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid->search($electricityallocationRelatedByEndtopsmonthlycalendaroid);
            $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid->remove($pos);
            if (null === $this->electricityallocationsRelatedByEndtopsmonthlycalendaroidScheduledForDeletion) {
                $this->electricityallocationsRelatedByEndtopsmonthlycalendaroidScheduledForDeletion = clone $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid;
                $this->electricityallocationsRelatedByEndtopsmonthlycalendaroidScheduledForDeletion->clear();
            }
            $this->electricityallocationsRelatedByEndtopsmonthlycalendaroidScheduledForDeletion[]= $electricityallocationRelatedByEndtopsmonthlycalendaroid;
            $electricityallocationRelatedByEndtopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Opsmonthlycalendar is new, it will return
     * an empty collection; or if this Opsmonthlycalendar has previously
     * been saved, it will retrieve related ElectricityallocationsRelatedByEndtopsmonthlycalendaroid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Opsmonthlycalendar.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildElectricityallocation[] List of ChildElectricityallocation objects
     */
    public function getElectricityallocationsRelatedByEndtopsmonthlycalendaroidJoinElectricityaccount(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildElectricityallocationQuery::create(null, $criteria);
        $query->joinWith('Electricityaccount', $joinBehavior);

        return $this->getElectricityallocationsRelatedByEndtopsmonthlycalendaroid($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Opsmonthlycalendar is new, it will return
     * an empty collection; or if this Opsmonthlycalendar has previously
     * been saved, it will retrieve related ElectricityallocationsRelatedByEndtopsmonthlycalendaroid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Opsmonthlycalendar.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildElectricityallocation[] List of ChildElectricityallocation objects
     */
    public function getElectricityallocationsRelatedByEndtopsmonthlycalendaroidJoinLineofbusiness(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildElectricityallocationQuery::create(null, $criteria);
        $query->joinWith('Lineofbusiness', $joinBehavior);

        return $this->getElectricityallocationsRelatedByEndtopsmonthlycalendaroid($query, $con);
    }

    /**
     * Clears out the collElectricityexpenses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addElectricityexpenses()
     */
    public function clearElectricityexpenses()
    {
        $this->collElectricityexpenses = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collElectricityexpenses collection loaded partially.
     */
    public function resetPartialElectricityexpenses($v = true)
    {
        $this->collElectricityexpensesPartial = $v;
    }

    /**
     * Initializes the collElectricityexpenses collection.
     *
     * By default this just sets the collElectricityexpenses collection to an empty array (like clearcollElectricityexpenses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initElectricityexpenses($overrideExisting = true)
    {
        if (null !== $this->collElectricityexpenses && !$overrideExisting) {
            return;
        }

        $collectionClassName = ElectricityexpenseTableMap::getTableMap()->getCollectionClassName();

        $this->collElectricityexpenses = new $collectionClassName;
        $this->collElectricityexpenses->setModel('\lwops\lwops\Electricityexpense');
    }

    /**
     * Gets an array of ChildElectricityexpense objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildElectricityexpense[] List of ChildElectricityexpense objects
     * @throws PropelException
     */
    public function getElectricityexpenses(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collElectricityexpensesPartial && !$this->isNew();
        if (null === $this->collElectricityexpenses || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collElectricityexpenses) {
                // return empty collection
                $this->initElectricityexpenses();
            } else {
                $collElectricityexpenses = ChildElectricityexpenseQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendar($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collElectricityexpensesPartial && count($collElectricityexpenses)) {
                        $this->initElectricityexpenses(false);

                        foreach ($collElectricityexpenses as $obj) {
                            if (false == $this->collElectricityexpenses->contains($obj)) {
                                $this->collElectricityexpenses->append($obj);
                            }
                        }

                        $this->collElectricityexpensesPartial = true;
                    }

                    return $collElectricityexpenses;
                }

                if ($partial && $this->collElectricityexpenses) {
                    foreach ($this->collElectricityexpenses as $obj) {
                        if ($obj->isNew()) {
                            $collElectricityexpenses[] = $obj;
                        }
                    }
                }

                $this->collElectricityexpenses = $collElectricityexpenses;
                $this->collElectricityexpensesPartial = false;
            }
        }

        return $this->collElectricityexpenses;
    }

    /**
     * Sets a collection of ChildElectricityexpense objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $electricityexpenses A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setElectricityexpenses(Collection $electricityexpenses, ConnectionInterface $con = null)
    {
        /** @var ChildElectricityexpense[] $electricityexpensesToDelete */
        $electricityexpensesToDelete = $this->getElectricityexpenses(new Criteria(), $con)->diff($electricityexpenses);


        $this->electricityexpensesScheduledForDeletion = $electricityexpensesToDelete;

        foreach ($electricityexpensesToDelete as $electricityexpenseRemoved) {
            $electricityexpenseRemoved->setOpsmonthlycalendar(null);
        }

        $this->collElectricityexpenses = null;
        foreach ($electricityexpenses as $electricityexpense) {
            $this->addElectricityexpense($electricityexpense);
        }

        $this->collElectricityexpenses = $electricityexpenses;
        $this->collElectricityexpensesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Electricityexpense objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Electricityexpense objects.
     * @throws PropelException
     */
    public function countElectricityexpenses(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collElectricityexpensesPartial && !$this->isNew();
        if (null === $this->collElectricityexpenses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collElectricityexpenses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getElectricityexpenses());
            }

            $query = ChildElectricityexpenseQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendar($this)
                ->count($con);
        }

        return count($this->collElectricityexpenses);
    }

    /**
     * Method called to associate a ChildElectricityexpense object to this object
     * through the ChildElectricityexpense foreign key attribute.
     *
     * @param  ChildElectricityexpense $l ChildElectricityexpense
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addElectricityexpense(ChildElectricityexpense $l)
    {
        if ($this->collElectricityexpenses === null) {
            $this->initElectricityexpenses();
            $this->collElectricityexpensesPartial = true;
        }

        if (!$this->collElectricityexpenses->contains($l)) {
            $this->doAddElectricityexpense($l);

            if ($this->electricityexpensesScheduledForDeletion and $this->electricityexpensesScheduledForDeletion->contains($l)) {
                $this->electricityexpensesScheduledForDeletion->remove($this->electricityexpensesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildElectricityexpense $electricityexpense The ChildElectricityexpense object to add.
     */
    protected function doAddElectricityexpense(ChildElectricityexpense $electricityexpense)
    {
        $this->collElectricityexpenses[]= $electricityexpense;
        $electricityexpense->setOpsmonthlycalendar($this);
    }

    /**
     * @param  ChildElectricityexpense $electricityexpense The ChildElectricityexpense object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeElectricityexpense(ChildElectricityexpense $electricityexpense)
    {
        if ($this->getElectricityexpenses()->contains($electricityexpense)) {
            $pos = $this->collElectricityexpenses->search($electricityexpense);
            $this->collElectricityexpenses->remove($pos);
            if (null === $this->electricityexpensesScheduledForDeletion) {
                $this->electricityexpensesScheduledForDeletion = clone $this->collElectricityexpenses;
                $this->electricityexpensesScheduledForDeletion->clear();
            }
            $this->electricityexpensesScheduledForDeletion[]= clone $electricityexpense;
            $electricityexpense->setOpsmonthlycalendar(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Opsmonthlycalendar is new, it will return
     * an empty collection; or if this Opsmonthlycalendar has previously
     * been saved, it will retrieve related Electricityexpenses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Opsmonthlycalendar.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildElectricityexpense[] List of ChildElectricityexpense objects
     */
    public function getElectricityexpensesJoinElectricityaccount(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildElectricityexpenseQuery::create(null, $criteria);
        $query->joinWith('Electricityaccount', $joinBehavior);

        return $this->getElectricityexpenses($query, $con);
    }

    /**
     * Clears out the collEmployeeloans collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEmployeeloans()
     */
    public function clearEmployeeloans()
    {
        $this->collEmployeeloans = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEmployeeloans collection loaded partially.
     */
    public function resetPartialEmployeeloans($v = true)
    {
        $this->collEmployeeloansPartial = $v;
    }

    /**
     * Initializes the collEmployeeloans collection.
     *
     * By default this just sets the collEmployeeloans collection to an empty array (like clearcollEmployeeloans());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployeeloans($overrideExisting = true)
    {
        if (null !== $this->collEmployeeloans && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeeloanTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployeeloans = new $collectionClassName;
        $this->collEmployeeloans->setModel('\lwops\lwops\Employeeloan');
    }

    /**
     * Gets an array of ChildEmployeeloan objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployeeloan[] List of ChildEmployeeloan objects
     * @throws PropelException
     */
    public function getEmployeeloans(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeeloansPartial && !$this->isNew();
        if (null === $this->collEmployeeloans || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEmployeeloans) {
                // return empty collection
                $this->initEmployeeloans();
            } else {
                $collEmployeeloans = ChildEmployeeloanQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendar($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeeloansPartial && count($collEmployeeloans)) {
                        $this->initEmployeeloans(false);

                        foreach ($collEmployeeloans as $obj) {
                            if (false == $this->collEmployeeloans->contains($obj)) {
                                $this->collEmployeeloans->append($obj);
                            }
                        }

                        $this->collEmployeeloansPartial = true;
                    }

                    return $collEmployeeloans;
                }

                if ($partial && $this->collEmployeeloans) {
                    foreach ($this->collEmployeeloans as $obj) {
                        if ($obj->isNew()) {
                            $collEmployeeloans[] = $obj;
                        }
                    }
                }

                $this->collEmployeeloans = $collEmployeeloans;
                $this->collEmployeeloansPartial = false;
            }
        }

        return $this->collEmployeeloans;
    }

    /**
     * Sets a collection of ChildEmployeeloan objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $employeeloans A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setEmployeeloans(Collection $employeeloans, ConnectionInterface $con = null)
    {
        /** @var ChildEmployeeloan[] $employeeloansToDelete */
        $employeeloansToDelete = $this->getEmployeeloans(new Criteria(), $con)->diff($employeeloans);


        $this->employeeloansScheduledForDeletion = $employeeloansToDelete;

        foreach ($employeeloansToDelete as $employeeloanRemoved) {
            $employeeloanRemoved->setOpsmonthlycalendar(null);
        }

        $this->collEmployeeloans = null;
        foreach ($employeeloans as $employeeloan) {
            $this->addEmployeeloan($employeeloan);
        }

        $this->collEmployeeloans = $employeeloans;
        $this->collEmployeeloansPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Employeeloan objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Employeeloan objects.
     * @throws PropelException
     */
    public function countEmployeeloans(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeeloansPartial && !$this->isNew();
        if (null === $this->collEmployeeloans || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployeeloans) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployeeloans());
            }

            $query = ChildEmployeeloanQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendar($this)
                ->count($con);
        }

        return count($this->collEmployeeloans);
    }

    /**
     * Method called to associate a ChildEmployeeloan object to this object
     * through the ChildEmployeeloan foreign key attribute.
     *
     * @param  ChildEmployeeloan $l ChildEmployeeloan
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addEmployeeloan(ChildEmployeeloan $l)
    {
        if ($this->collEmployeeloans === null) {
            $this->initEmployeeloans();
            $this->collEmployeeloansPartial = true;
        }

        if (!$this->collEmployeeloans->contains($l)) {
            $this->doAddEmployeeloan($l);

            if ($this->employeeloansScheduledForDeletion and $this->employeeloansScheduledForDeletion->contains($l)) {
                $this->employeeloansScheduledForDeletion->remove($this->employeeloansScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployeeloan $employeeloan The ChildEmployeeloan object to add.
     */
    protected function doAddEmployeeloan(ChildEmployeeloan $employeeloan)
    {
        $this->collEmployeeloans[]= $employeeloan;
        $employeeloan->setOpsmonthlycalendar($this);
    }

    /**
     * @param  ChildEmployeeloan $employeeloan The ChildEmployeeloan object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeEmployeeloan(ChildEmployeeloan $employeeloan)
    {
        if ($this->getEmployeeloans()->contains($employeeloan)) {
            $pos = $this->collEmployeeloans->search($employeeloan);
            $this->collEmployeeloans->remove($pos);
            if (null === $this->employeeloansScheduledForDeletion) {
                $this->employeeloansScheduledForDeletion = clone $this->collEmployeeloans;
                $this->employeeloansScheduledForDeletion->clear();
            }
            $this->employeeloansScheduledForDeletion[]= clone $employeeloan;
            $employeeloan->setOpsmonthlycalendar(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Opsmonthlycalendar is new, it will return
     * an empty collection; or if this Opsmonthlycalendar has previously
     * been saved, it will retrieve related Employeeloans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Opsmonthlycalendar.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployeeloan[] List of ChildEmployeeloan objects
     */
    public function getEmployeeloansJoinEmployee(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeloanQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getEmployeeloans($query, $con);
    }

    /**
     * Clears out the collFishpandls collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFishpandls()
     */
    public function clearFishpandls()
    {
        $this->collFishpandls = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collFishpandls collection loaded partially.
     */
    public function resetPartialFishpandls($v = true)
    {
        $this->collFishpandlsPartial = $v;
    }

    /**
     * Initializes the collFishpandls collection.
     *
     * By default this just sets the collFishpandls collection to an empty array (like clearcollFishpandls());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFishpandls($overrideExisting = true)
    {
        if (null !== $this->collFishpandls && !$overrideExisting) {
            return;
        }

        $collectionClassName = FishpandlTableMap::getTableMap()->getCollectionClassName();

        $this->collFishpandls = new $collectionClassName;
        $this->collFishpandls->setModel('\lwops\lwops\Fishpandl');
    }

    /**
     * Gets an array of ChildFishpandl objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildFishpandl[] List of ChildFishpandl objects
     * @throws PropelException
     */
    public function getFishpandls(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFishpandlsPartial && !$this->isNew();
        if (null === $this->collFishpandls || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFishpandls) {
                // return empty collection
                $this->initFishpandls();
            } else {
                $collFishpandls = ChildFishpandlQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendar($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFishpandlsPartial && count($collFishpandls)) {
                        $this->initFishpandls(false);

                        foreach ($collFishpandls as $obj) {
                            if (false == $this->collFishpandls->contains($obj)) {
                                $this->collFishpandls->append($obj);
                            }
                        }

                        $this->collFishpandlsPartial = true;
                    }

                    return $collFishpandls;
                }

                if ($partial && $this->collFishpandls) {
                    foreach ($this->collFishpandls as $obj) {
                        if ($obj->isNew()) {
                            $collFishpandls[] = $obj;
                        }
                    }
                }

                $this->collFishpandls = $collFishpandls;
                $this->collFishpandlsPartial = false;
            }
        }

        return $this->collFishpandls;
    }

    /**
     * Sets a collection of ChildFishpandl objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $fishpandls A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setFishpandls(Collection $fishpandls, ConnectionInterface $con = null)
    {
        /** @var ChildFishpandl[] $fishpandlsToDelete */
        $fishpandlsToDelete = $this->getFishpandls(new Criteria(), $con)->diff($fishpandls);


        $this->fishpandlsScheduledForDeletion = $fishpandlsToDelete;

        foreach ($fishpandlsToDelete as $fishpandlRemoved) {
            $fishpandlRemoved->setOpsmonthlycalendar(null);
        }

        $this->collFishpandls = null;
        foreach ($fishpandls as $fishpandl) {
            $this->addFishpandl($fishpandl);
        }

        $this->collFishpandls = $fishpandls;
        $this->collFishpandlsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Fishpandl objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Fishpandl objects.
     * @throws PropelException
     */
    public function countFishpandls(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFishpandlsPartial && !$this->isNew();
        if (null === $this->collFishpandls || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFishpandls) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFishpandls());
            }

            $query = ChildFishpandlQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendar($this)
                ->count($con);
        }

        return count($this->collFishpandls);
    }

    /**
     * Method called to associate a ChildFishpandl object to this object
     * through the ChildFishpandl foreign key attribute.
     *
     * @param  ChildFishpandl $l ChildFishpandl
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addFishpandl(ChildFishpandl $l)
    {
        if ($this->collFishpandls === null) {
            $this->initFishpandls();
            $this->collFishpandlsPartial = true;
        }

        if (!$this->collFishpandls->contains($l)) {
            $this->doAddFishpandl($l);

            if ($this->fishpandlsScheduledForDeletion and $this->fishpandlsScheduledForDeletion->contains($l)) {
                $this->fishpandlsScheduledForDeletion->remove($this->fishpandlsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildFishpandl $fishpandl The ChildFishpandl object to add.
     */
    protected function doAddFishpandl(ChildFishpandl $fishpandl)
    {
        $this->collFishpandls[]= $fishpandl;
        $fishpandl->setOpsmonthlycalendar($this);
    }

    /**
     * @param  ChildFishpandl $fishpandl The ChildFishpandl object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeFishpandl(ChildFishpandl $fishpandl)
    {
        if ($this->getFishpandls()->contains($fishpandl)) {
            $pos = $this->collFishpandls->search($fishpandl);
            $this->collFishpandls->remove($pos);
            if (null === $this->fishpandlsScheduledForDeletion) {
                $this->fishpandlsScheduledForDeletion = clone $this->collFishpandls;
                $this->fishpandlsScheduledForDeletion->clear();
            }
            $this->fishpandlsScheduledForDeletion[]= clone $fishpandl;
            $fishpandl->setOpsmonthlycalendar(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Opsmonthlycalendar is new, it will return
     * an empty collection; or if this Opsmonthlycalendar has previously
     * been saved, it will retrieve related Fishpandls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Opsmonthlycalendar.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFishpandl[] List of ChildFishpandl objects
     */
    public function getFishpandlsJoinLineofbusiness(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFishpandlQuery::create(null, $criteria);
        $query->joinWith('Lineofbusiness', $joinBehavior);

        return $this->getFishpandls($query, $con);
    }

    /**
     * Clears out the collFtesalaryadvances collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFtesalaryadvances()
     */
    public function clearFtesalaryadvances()
    {
        $this->collFtesalaryadvances = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collFtesalaryadvances collection loaded partially.
     */
    public function resetPartialFtesalaryadvances($v = true)
    {
        $this->collFtesalaryadvancesPartial = $v;
    }

    /**
     * Initializes the collFtesalaryadvances collection.
     *
     * By default this just sets the collFtesalaryadvances collection to an empty array (like clearcollFtesalaryadvances());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFtesalaryadvances($overrideExisting = true)
    {
        if (null !== $this->collFtesalaryadvances && !$overrideExisting) {
            return;
        }

        $collectionClassName = FtesalaryadvanceTableMap::getTableMap()->getCollectionClassName();

        $this->collFtesalaryadvances = new $collectionClassName;
        $this->collFtesalaryadvances->setModel('\lwops\lwops\Ftesalaryadvance');
    }

    /**
     * Gets an array of ChildFtesalaryadvance objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildFtesalaryadvance[] List of ChildFtesalaryadvance objects
     * @throws PropelException
     */
    public function getFtesalaryadvances(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFtesalaryadvancesPartial && !$this->isNew();
        if (null === $this->collFtesalaryadvances || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFtesalaryadvances) {
                // return empty collection
                $this->initFtesalaryadvances();
            } else {
                $collFtesalaryadvances = ChildFtesalaryadvanceQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendar($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFtesalaryadvancesPartial && count($collFtesalaryadvances)) {
                        $this->initFtesalaryadvances(false);

                        foreach ($collFtesalaryadvances as $obj) {
                            if (false == $this->collFtesalaryadvances->contains($obj)) {
                                $this->collFtesalaryadvances->append($obj);
                            }
                        }

                        $this->collFtesalaryadvancesPartial = true;
                    }

                    return $collFtesalaryadvances;
                }

                if ($partial && $this->collFtesalaryadvances) {
                    foreach ($this->collFtesalaryadvances as $obj) {
                        if ($obj->isNew()) {
                            $collFtesalaryadvances[] = $obj;
                        }
                    }
                }

                $this->collFtesalaryadvances = $collFtesalaryadvances;
                $this->collFtesalaryadvancesPartial = false;
            }
        }

        return $this->collFtesalaryadvances;
    }

    /**
     * Sets a collection of ChildFtesalaryadvance objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $ftesalaryadvances A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setFtesalaryadvances(Collection $ftesalaryadvances, ConnectionInterface $con = null)
    {
        /** @var ChildFtesalaryadvance[] $ftesalaryadvancesToDelete */
        $ftesalaryadvancesToDelete = $this->getFtesalaryadvances(new Criteria(), $con)->diff($ftesalaryadvances);


        $this->ftesalaryadvancesScheduledForDeletion = $ftesalaryadvancesToDelete;

        foreach ($ftesalaryadvancesToDelete as $ftesalaryadvanceRemoved) {
            $ftesalaryadvanceRemoved->setOpsmonthlycalendar(null);
        }

        $this->collFtesalaryadvances = null;
        foreach ($ftesalaryadvances as $ftesalaryadvance) {
            $this->addFtesalaryadvance($ftesalaryadvance);
        }

        $this->collFtesalaryadvances = $ftesalaryadvances;
        $this->collFtesalaryadvancesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Ftesalaryadvance objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Ftesalaryadvance objects.
     * @throws PropelException
     */
    public function countFtesalaryadvances(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFtesalaryadvancesPartial && !$this->isNew();
        if (null === $this->collFtesalaryadvances || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFtesalaryadvances) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFtesalaryadvances());
            }

            $query = ChildFtesalaryadvanceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendar($this)
                ->count($con);
        }

        return count($this->collFtesalaryadvances);
    }

    /**
     * Method called to associate a ChildFtesalaryadvance object to this object
     * through the ChildFtesalaryadvance foreign key attribute.
     *
     * @param  ChildFtesalaryadvance $l ChildFtesalaryadvance
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addFtesalaryadvance(ChildFtesalaryadvance $l)
    {
        if ($this->collFtesalaryadvances === null) {
            $this->initFtesalaryadvances();
            $this->collFtesalaryadvancesPartial = true;
        }

        if (!$this->collFtesalaryadvances->contains($l)) {
            $this->doAddFtesalaryadvance($l);

            if ($this->ftesalaryadvancesScheduledForDeletion and $this->ftesalaryadvancesScheduledForDeletion->contains($l)) {
                $this->ftesalaryadvancesScheduledForDeletion->remove($this->ftesalaryadvancesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildFtesalaryadvance $ftesalaryadvance The ChildFtesalaryadvance object to add.
     */
    protected function doAddFtesalaryadvance(ChildFtesalaryadvance $ftesalaryadvance)
    {
        $this->collFtesalaryadvances[]= $ftesalaryadvance;
        $ftesalaryadvance->setOpsmonthlycalendar($this);
    }

    /**
     * @param  ChildFtesalaryadvance $ftesalaryadvance The ChildFtesalaryadvance object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeFtesalaryadvance(ChildFtesalaryadvance $ftesalaryadvance)
    {
        if ($this->getFtesalaryadvances()->contains($ftesalaryadvance)) {
            $pos = $this->collFtesalaryadvances->search($ftesalaryadvance);
            $this->collFtesalaryadvances->remove($pos);
            if (null === $this->ftesalaryadvancesScheduledForDeletion) {
                $this->ftesalaryadvancesScheduledForDeletion = clone $this->collFtesalaryadvances;
                $this->ftesalaryadvancesScheduledForDeletion->clear();
            }
            $this->ftesalaryadvancesScheduledForDeletion[]= clone $ftesalaryadvance;
            $ftesalaryadvance->setOpsmonthlycalendar(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Opsmonthlycalendar is new, it will return
     * an empty collection; or if this Opsmonthlycalendar has previously
     * been saved, it will retrieve related Ftesalaryadvances from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Opsmonthlycalendar.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFtesalaryadvance[] List of ChildFtesalaryadvance objects
     */
    public function getFtesalaryadvancesJoinEmployee(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFtesalaryadvanceQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getFtesalaryadvances($query, $con);
    }

    /**
     * Clears out the collKiambaadairies collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addKiambaadairies()
     */
    public function clearKiambaadairies()
    {
        $this->collKiambaadairies = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collKiambaadairies collection loaded partially.
     */
    public function resetPartialKiambaadairies($v = true)
    {
        $this->collKiambaadairiesPartial = $v;
    }

    /**
     * Initializes the collKiambaadairies collection.
     *
     * By default this just sets the collKiambaadairies collection to an empty array (like clearcollKiambaadairies());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initKiambaadairies($overrideExisting = true)
    {
        if (null !== $this->collKiambaadairies && !$overrideExisting) {
            return;
        }

        $collectionClassName = KiambaadairyTableMap::getTableMap()->getCollectionClassName();

        $this->collKiambaadairies = new $collectionClassName;
        $this->collKiambaadairies->setModel('\lwops\lwops\Kiambaadairy');
    }

    /**
     * Gets an array of ChildKiambaadairy objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildKiambaadairy[] List of ChildKiambaadairy objects
     * @throws PropelException
     */
    public function getKiambaadairies(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collKiambaadairiesPartial && !$this->isNew();
        if (null === $this->collKiambaadairies || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collKiambaadairies) {
                // return empty collection
                $this->initKiambaadairies();
            } else {
                $collKiambaadairies = ChildKiambaadairyQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendar($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collKiambaadairiesPartial && count($collKiambaadairies)) {
                        $this->initKiambaadairies(false);

                        foreach ($collKiambaadairies as $obj) {
                            if (false == $this->collKiambaadairies->contains($obj)) {
                                $this->collKiambaadairies->append($obj);
                            }
                        }

                        $this->collKiambaadairiesPartial = true;
                    }

                    return $collKiambaadairies;
                }

                if ($partial && $this->collKiambaadairies) {
                    foreach ($this->collKiambaadairies as $obj) {
                        if ($obj->isNew()) {
                            $collKiambaadairies[] = $obj;
                        }
                    }
                }

                $this->collKiambaadairies = $collKiambaadairies;
                $this->collKiambaadairiesPartial = false;
            }
        }

        return $this->collKiambaadairies;
    }

    /**
     * Sets a collection of ChildKiambaadairy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $kiambaadairies A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setKiambaadairies(Collection $kiambaadairies, ConnectionInterface $con = null)
    {
        /** @var ChildKiambaadairy[] $kiambaadairiesToDelete */
        $kiambaadairiesToDelete = $this->getKiambaadairies(new Criteria(), $con)->diff($kiambaadairies);


        $this->kiambaadairiesScheduledForDeletion = $kiambaadairiesToDelete;

        foreach ($kiambaadairiesToDelete as $kiambaadairyRemoved) {
            $kiambaadairyRemoved->setOpsmonthlycalendar(null);
        }

        $this->collKiambaadairies = null;
        foreach ($kiambaadairies as $kiambaadairy) {
            $this->addKiambaadairy($kiambaadairy);
        }

        $this->collKiambaadairies = $kiambaadairies;
        $this->collKiambaadairiesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Kiambaadairy objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Kiambaadairy objects.
     * @throws PropelException
     */
    public function countKiambaadairies(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collKiambaadairiesPartial && !$this->isNew();
        if (null === $this->collKiambaadairies || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collKiambaadairies) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getKiambaadairies());
            }

            $query = ChildKiambaadairyQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendar($this)
                ->count($con);
        }

        return count($this->collKiambaadairies);
    }

    /**
     * Method called to associate a ChildKiambaadairy object to this object
     * through the ChildKiambaadairy foreign key attribute.
     *
     * @param  ChildKiambaadairy $l ChildKiambaadairy
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addKiambaadairy(ChildKiambaadairy $l)
    {
        if ($this->collKiambaadairies === null) {
            $this->initKiambaadairies();
            $this->collKiambaadairiesPartial = true;
        }

        if (!$this->collKiambaadairies->contains($l)) {
            $this->doAddKiambaadairy($l);

            if ($this->kiambaadairiesScheduledForDeletion and $this->kiambaadairiesScheduledForDeletion->contains($l)) {
                $this->kiambaadairiesScheduledForDeletion->remove($this->kiambaadairiesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildKiambaadairy $kiambaadairy The ChildKiambaadairy object to add.
     */
    protected function doAddKiambaadairy(ChildKiambaadairy $kiambaadairy)
    {
        $this->collKiambaadairies[]= $kiambaadairy;
        $kiambaadairy->setOpsmonthlycalendar($this);
    }

    /**
     * @param  ChildKiambaadairy $kiambaadairy The ChildKiambaadairy object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeKiambaadairy(ChildKiambaadairy $kiambaadairy)
    {
        if ($this->getKiambaadairies()->contains($kiambaadairy)) {
            $pos = $this->collKiambaadairies->search($kiambaadairy);
            $this->collKiambaadairies->remove($pos);
            if (null === $this->kiambaadairiesScheduledForDeletion) {
                $this->kiambaadairiesScheduledForDeletion = clone $this->collKiambaadairies;
                $this->kiambaadairiesScheduledForDeletion->clear();
            }
            $this->kiambaadairiesScheduledForDeletion[]= clone $kiambaadairy;
            $kiambaadairy->setOpsmonthlycalendar(null);
        }

        return $this;
    }

    /**
     * Clears out the collTeabonuses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTeabonuses()
     */
    public function clearTeabonuses()
    {
        $this->collTeabonuses = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTeabonuses collection loaded partially.
     */
    public function resetPartialTeabonuses($v = true)
    {
        $this->collTeabonusesPartial = $v;
    }

    /**
     * Initializes the collTeabonuses collection.
     *
     * By default this just sets the collTeabonuses collection to an empty array (like clearcollTeabonuses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTeabonuses($overrideExisting = true)
    {
        if (null !== $this->collTeabonuses && !$overrideExisting) {
            return;
        }

        $collectionClassName = TeabonusTableMap::getTableMap()->getCollectionClassName();

        $this->collTeabonuses = new $collectionClassName;
        $this->collTeabonuses->setModel('\lwops\lwops\Teabonus');
    }

    /**
     * Gets an array of ChildTeabonus objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTeabonus[] List of ChildTeabonus objects
     * @throws PropelException
     */
    public function getTeabonuses(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTeabonusesPartial && !$this->isNew();
        if (null === $this->collTeabonuses || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTeabonuses) {
                // return empty collection
                $this->initTeabonuses();
            } else {
                $collTeabonuses = ChildTeabonusQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendar($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTeabonusesPartial && count($collTeabonuses)) {
                        $this->initTeabonuses(false);

                        foreach ($collTeabonuses as $obj) {
                            if (false == $this->collTeabonuses->contains($obj)) {
                                $this->collTeabonuses->append($obj);
                            }
                        }

                        $this->collTeabonusesPartial = true;
                    }

                    return $collTeabonuses;
                }

                if ($partial && $this->collTeabonuses) {
                    foreach ($this->collTeabonuses as $obj) {
                        if ($obj->isNew()) {
                            $collTeabonuses[] = $obj;
                        }
                    }
                }

                $this->collTeabonuses = $collTeabonuses;
                $this->collTeabonusesPartial = false;
            }
        }

        return $this->collTeabonuses;
    }

    /**
     * Sets a collection of ChildTeabonus objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $teabonuses A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setTeabonuses(Collection $teabonuses, ConnectionInterface $con = null)
    {
        /** @var ChildTeabonus[] $teabonusesToDelete */
        $teabonusesToDelete = $this->getTeabonuses(new Criteria(), $con)->diff($teabonuses);


        $this->teabonusesScheduledForDeletion = $teabonusesToDelete;

        foreach ($teabonusesToDelete as $teabonusRemoved) {
            $teabonusRemoved->setOpsmonthlycalendar(null);
        }

        $this->collTeabonuses = null;
        foreach ($teabonuses as $teabonus) {
            $this->addTeabonus($teabonus);
        }

        $this->collTeabonuses = $teabonuses;
        $this->collTeabonusesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Teabonus objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Teabonus objects.
     * @throws PropelException
     */
    public function countTeabonuses(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTeabonusesPartial && !$this->isNew();
        if (null === $this->collTeabonuses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTeabonuses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTeabonuses());
            }

            $query = ChildTeabonusQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendar($this)
                ->count($con);
        }

        return count($this->collTeabonuses);
    }

    /**
     * Method called to associate a ChildTeabonus object to this object
     * through the ChildTeabonus foreign key attribute.
     *
     * @param  ChildTeabonus $l ChildTeabonus
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addTeabonus(ChildTeabonus $l)
    {
        if ($this->collTeabonuses === null) {
            $this->initTeabonuses();
            $this->collTeabonusesPartial = true;
        }

        if (!$this->collTeabonuses->contains($l)) {
            $this->doAddTeabonus($l);

            if ($this->teabonusesScheduledForDeletion and $this->teabonusesScheduledForDeletion->contains($l)) {
                $this->teabonusesScheduledForDeletion->remove($this->teabonusesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTeabonus $teabonus The ChildTeabonus object to add.
     */
    protected function doAddTeabonus(ChildTeabonus $teabonus)
    {
        $this->collTeabonuses[]= $teabonus;
        $teabonus->setOpsmonthlycalendar($this);
    }

    /**
     * @param  ChildTeabonus $teabonus The ChildTeabonus object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeTeabonus(ChildTeabonus $teabonus)
    {
        if ($this->getTeabonuses()->contains($teabonus)) {
            $pos = $this->collTeabonuses->search($teabonus);
            $this->collTeabonuses->remove($pos);
            if (null === $this->teabonusesScheduledForDeletion) {
                $this->teabonusesScheduledForDeletion = clone $this->collTeabonuses;
                $this->teabonusesScheduledForDeletion->clear();
            }
            $this->teabonusesScheduledForDeletion[]= clone $teabonus;
            $teabonus->setOpsmonthlycalendar(null);
        }

        return $this;
    }

    /**
     * Clears out the collTeafactoryratesRelatedByStartopsmonthlycalendaroid collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTeafactoryratesRelatedByStartopsmonthlycalendaroid()
     */
    public function clearTeafactoryratesRelatedByStartopsmonthlycalendaroid()
    {
        $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTeafactoryratesRelatedByStartopsmonthlycalendaroid collection loaded partially.
     */
    public function resetPartialTeafactoryratesRelatedByStartopsmonthlycalendaroid($v = true)
    {
        $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroidPartial = $v;
    }

    /**
     * Initializes the collTeafactoryratesRelatedByStartopsmonthlycalendaroid collection.
     *
     * By default this just sets the collTeafactoryratesRelatedByStartopsmonthlycalendaroid collection to an empty array (like clearcollTeafactoryratesRelatedByStartopsmonthlycalendaroid());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTeafactoryratesRelatedByStartopsmonthlycalendaroid($overrideExisting = true)
    {
        if (null !== $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid && !$overrideExisting) {
            return;
        }

        $collectionClassName = TeafactoryrateTableMap::getTableMap()->getCollectionClassName();

        $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid = new $collectionClassName;
        $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid->setModel('\lwops\lwops\Teafactoryrate');
    }

    /**
     * Gets an array of ChildTeafactoryrate objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTeafactoryrate[] List of ChildTeafactoryrate objects
     * @throws PropelException
     */
    public function getTeafactoryratesRelatedByStartopsmonthlycalendaroid(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid) {
                // return empty collection
                $this->initTeafactoryratesRelatedByStartopsmonthlycalendaroid();
            } else {
                $collTeafactoryratesRelatedByStartopsmonthlycalendaroid = ChildTeafactoryrateQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroidPartial && count($collTeafactoryratesRelatedByStartopsmonthlycalendaroid)) {
                        $this->initTeafactoryratesRelatedByStartopsmonthlycalendaroid(false);

                        foreach ($collTeafactoryratesRelatedByStartopsmonthlycalendaroid as $obj) {
                            if (false == $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid->contains($obj)) {
                                $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid->append($obj);
                            }
                        }

                        $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroidPartial = true;
                    }

                    return $collTeafactoryratesRelatedByStartopsmonthlycalendaroid;
                }

                if ($partial && $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid) {
                    foreach ($this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid as $obj) {
                        if ($obj->isNew()) {
                            $collTeafactoryratesRelatedByStartopsmonthlycalendaroid[] = $obj;
                        }
                    }
                }

                $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid = $collTeafactoryratesRelatedByStartopsmonthlycalendaroid;
                $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroidPartial = false;
            }
        }

        return $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid;
    }

    /**
     * Sets a collection of ChildTeafactoryrate objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $teafactoryratesRelatedByStartopsmonthlycalendaroid A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setTeafactoryratesRelatedByStartopsmonthlycalendaroid(Collection $teafactoryratesRelatedByStartopsmonthlycalendaroid, ConnectionInterface $con = null)
    {
        /** @var ChildTeafactoryrate[] $teafactoryratesRelatedByStartopsmonthlycalendaroidToDelete */
        $teafactoryratesRelatedByStartopsmonthlycalendaroidToDelete = $this->getTeafactoryratesRelatedByStartopsmonthlycalendaroid(new Criteria(), $con)->diff($teafactoryratesRelatedByStartopsmonthlycalendaroid);


        $this->teafactoryratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion = $teafactoryratesRelatedByStartopsmonthlycalendaroidToDelete;

        foreach ($teafactoryratesRelatedByStartopsmonthlycalendaroidToDelete as $teafactoryrateRelatedByStartopsmonthlycalendaroidRemoved) {
            $teafactoryrateRelatedByStartopsmonthlycalendaroidRemoved->setOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid(null);
        }

        $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid = null;
        foreach ($teafactoryratesRelatedByStartopsmonthlycalendaroid as $teafactoryrateRelatedByStartopsmonthlycalendaroid) {
            $this->addTeafactoryrateRelatedByStartopsmonthlycalendaroid($teafactoryrateRelatedByStartopsmonthlycalendaroid);
        }

        $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid = $teafactoryratesRelatedByStartopsmonthlycalendaroid;
        $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroidPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Teafactoryrate objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Teafactoryrate objects.
     * @throws PropelException
     */
    public function countTeafactoryratesRelatedByStartopsmonthlycalendaroid(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTeafactoryratesRelatedByStartopsmonthlycalendaroid());
            }

            $query = ChildTeafactoryrateQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($this)
                ->count($con);
        }

        return count($this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid);
    }

    /**
     * Method called to associate a ChildTeafactoryrate object to this object
     * through the ChildTeafactoryrate foreign key attribute.
     *
     * @param  ChildTeafactoryrate $l ChildTeafactoryrate
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addTeafactoryrateRelatedByStartopsmonthlycalendaroid(ChildTeafactoryrate $l)
    {
        if ($this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid === null) {
            $this->initTeafactoryratesRelatedByStartopsmonthlycalendaroid();
            $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroidPartial = true;
        }

        if (!$this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid->contains($l)) {
            $this->doAddTeafactoryrateRelatedByStartopsmonthlycalendaroid($l);

            if ($this->teafactoryratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion and $this->teafactoryratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion->contains($l)) {
                $this->teafactoryratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion->remove($this->teafactoryratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTeafactoryrate $teafactoryrateRelatedByStartopsmonthlycalendaroid The ChildTeafactoryrate object to add.
     */
    protected function doAddTeafactoryrateRelatedByStartopsmonthlycalendaroid(ChildTeafactoryrate $teafactoryrateRelatedByStartopsmonthlycalendaroid)
    {
        $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid[]= $teafactoryrateRelatedByStartopsmonthlycalendaroid;
        $teafactoryrateRelatedByStartopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($this);
    }

    /**
     * @param  ChildTeafactoryrate $teafactoryrateRelatedByStartopsmonthlycalendaroid The ChildTeafactoryrate object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeTeafactoryrateRelatedByStartopsmonthlycalendaroid(ChildTeafactoryrate $teafactoryrateRelatedByStartopsmonthlycalendaroid)
    {
        if ($this->getTeafactoryratesRelatedByStartopsmonthlycalendaroid()->contains($teafactoryrateRelatedByStartopsmonthlycalendaroid)) {
            $pos = $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid->search($teafactoryrateRelatedByStartopsmonthlycalendaroid);
            $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid->remove($pos);
            if (null === $this->teafactoryratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion) {
                $this->teafactoryratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion = clone $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid;
                $this->teafactoryratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion->clear();
            }
            $this->teafactoryratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion[]= clone $teafactoryrateRelatedByStartopsmonthlycalendaroid;
            $teafactoryrateRelatedByStartopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid(null);
        }

        return $this;
    }

    /**
     * Clears out the collTeafactoryratesRelatedByEndopsmonthlycalendaroid collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTeafactoryratesRelatedByEndopsmonthlycalendaroid()
     */
    public function clearTeafactoryratesRelatedByEndopsmonthlycalendaroid()
    {
        $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTeafactoryratesRelatedByEndopsmonthlycalendaroid collection loaded partially.
     */
    public function resetPartialTeafactoryratesRelatedByEndopsmonthlycalendaroid($v = true)
    {
        $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroidPartial = $v;
    }

    /**
     * Initializes the collTeafactoryratesRelatedByEndopsmonthlycalendaroid collection.
     *
     * By default this just sets the collTeafactoryratesRelatedByEndopsmonthlycalendaroid collection to an empty array (like clearcollTeafactoryratesRelatedByEndopsmonthlycalendaroid());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTeafactoryratesRelatedByEndopsmonthlycalendaroid($overrideExisting = true)
    {
        if (null !== $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid && !$overrideExisting) {
            return;
        }

        $collectionClassName = TeafactoryrateTableMap::getTableMap()->getCollectionClassName();

        $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid = new $collectionClassName;
        $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid->setModel('\lwops\lwops\Teafactoryrate');
    }

    /**
     * Gets an array of ChildTeafactoryrate objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTeafactoryrate[] List of ChildTeafactoryrate objects
     * @throws PropelException
     */
    public function getTeafactoryratesRelatedByEndopsmonthlycalendaroid(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid) {
                // return empty collection
                $this->initTeafactoryratesRelatedByEndopsmonthlycalendaroid();
            } else {
                $collTeafactoryratesRelatedByEndopsmonthlycalendaroid = ChildTeafactoryrateQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroidPartial && count($collTeafactoryratesRelatedByEndopsmonthlycalendaroid)) {
                        $this->initTeafactoryratesRelatedByEndopsmonthlycalendaroid(false);

                        foreach ($collTeafactoryratesRelatedByEndopsmonthlycalendaroid as $obj) {
                            if (false == $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid->contains($obj)) {
                                $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid->append($obj);
                            }
                        }

                        $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroidPartial = true;
                    }

                    return $collTeafactoryratesRelatedByEndopsmonthlycalendaroid;
                }

                if ($partial && $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid) {
                    foreach ($this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid as $obj) {
                        if ($obj->isNew()) {
                            $collTeafactoryratesRelatedByEndopsmonthlycalendaroid[] = $obj;
                        }
                    }
                }

                $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid = $collTeafactoryratesRelatedByEndopsmonthlycalendaroid;
                $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroidPartial = false;
            }
        }

        return $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid;
    }

    /**
     * Sets a collection of ChildTeafactoryrate objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $teafactoryratesRelatedByEndopsmonthlycalendaroid A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setTeafactoryratesRelatedByEndopsmonthlycalendaroid(Collection $teafactoryratesRelatedByEndopsmonthlycalendaroid, ConnectionInterface $con = null)
    {
        /** @var ChildTeafactoryrate[] $teafactoryratesRelatedByEndopsmonthlycalendaroidToDelete */
        $teafactoryratesRelatedByEndopsmonthlycalendaroidToDelete = $this->getTeafactoryratesRelatedByEndopsmonthlycalendaroid(new Criteria(), $con)->diff($teafactoryratesRelatedByEndopsmonthlycalendaroid);


        $this->teafactoryratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion = $teafactoryratesRelatedByEndopsmonthlycalendaroidToDelete;

        foreach ($teafactoryratesRelatedByEndopsmonthlycalendaroidToDelete as $teafactoryrateRelatedByEndopsmonthlycalendaroidRemoved) {
            $teafactoryrateRelatedByEndopsmonthlycalendaroidRemoved->setOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid(null);
        }

        $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid = null;
        foreach ($teafactoryratesRelatedByEndopsmonthlycalendaroid as $teafactoryrateRelatedByEndopsmonthlycalendaroid) {
            $this->addTeafactoryrateRelatedByEndopsmonthlycalendaroid($teafactoryrateRelatedByEndopsmonthlycalendaroid);
        }

        $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid = $teafactoryratesRelatedByEndopsmonthlycalendaroid;
        $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroidPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Teafactoryrate objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Teafactoryrate objects.
     * @throws PropelException
     */
    public function countTeafactoryratesRelatedByEndopsmonthlycalendaroid(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTeafactoryratesRelatedByEndopsmonthlycalendaroid());
            }

            $query = ChildTeafactoryrateQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid($this)
                ->count($con);
        }

        return count($this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid);
    }

    /**
     * Method called to associate a ChildTeafactoryrate object to this object
     * through the ChildTeafactoryrate foreign key attribute.
     *
     * @param  ChildTeafactoryrate $l ChildTeafactoryrate
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addTeafactoryrateRelatedByEndopsmonthlycalendaroid(ChildTeafactoryrate $l)
    {
        if ($this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid === null) {
            $this->initTeafactoryratesRelatedByEndopsmonthlycalendaroid();
            $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroidPartial = true;
        }

        if (!$this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid->contains($l)) {
            $this->doAddTeafactoryrateRelatedByEndopsmonthlycalendaroid($l);

            if ($this->teafactoryratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion and $this->teafactoryratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion->contains($l)) {
                $this->teafactoryratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion->remove($this->teafactoryratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTeafactoryrate $teafactoryrateRelatedByEndopsmonthlycalendaroid The ChildTeafactoryrate object to add.
     */
    protected function doAddTeafactoryrateRelatedByEndopsmonthlycalendaroid(ChildTeafactoryrate $teafactoryrateRelatedByEndopsmonthlycalendaroid)
    {
        $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid[]= $teafactoryrateRelatedByEndopsmonthlycalendaroid;
        $teafactoryrateRelatedByEndopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid($this);
    }

    /**
     * @param  ChildTeafactoryrate $teafactoryrateRelatedByEndopsmonthlycalendaroid The ChildTeafactoryrate object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeTeafactoryrateRelatedByEndopsmonthlycalendaroid(ChildTeafactoryrate $teafactoryrateRelatedByEndopsmonthlycalendaroid)
    {
        if ($this->getTeafactoryratesRelatedByEndopsmonthlycalendaroid()->contains($teafactoryrateRelatedByEndopsmonthlycalendaroid)) {
            $pos = $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid->search($teafactoryrateRelatedByEndopsmonthlycalendaroid);
            $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid->remove($pos);
            if (null === $this->teafactoryratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion) {
                $this->teafactoryratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion = clone $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid;
                $this->teafactoryratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion->clear();
            }
            $this->teafactoryratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion[]= $teafactoryrateRelatedByEndopsmonthlycalendaroid;
            $teafactoryrateRelatedByEndopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid(null);
        }

        return $this;
    }

    /**
     * Clears out the collTeafactorytripratesRelatedByStartopsmonthlycalendaroid collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTeafactorytripratesRelatedByStartopsmonthlycalendaroid()
     */
    public function clearTeafactorytripratesRelatedByStartopsmonthlycalendaroid()
    {
        $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTeafactorytripratesRelatedByStartopsmonthlycalendaroid collection loaded partially.
     */
    public function resetPartialTeafactorytripratesRelatedByStartopsmonthlycalendaroid($v = true)
    {
        $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroidPartial = $v;
    }

    /**
     * Initializes the collTeafactorytripratesRelatedByStartopsmonthlycalendaroid collection.
     *
     * By default this just sets the collTeafactorytripratesRelatedByStartopsmonthlycalendaroid collection to an empty array (like clearcollTeafactorytripratesRelatedByStartopsmonthlycalendaroid());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTeafactorytripratesRelatedByStartopsmonthlycalendaroid($overrideExisting = true)
    {
        if (null !== $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid && !$overrideExisting) {
            return;
        }

        $collectionClassName = TeafactorytriprateTableMap::getTableMap()->getCollectionClassName();

        $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid = new $collectionClassName;
        $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid->setModel('\lwops\lwops\Teafactorytriprate');
    }

    /**
     * Gets an array of ChildTeafactorytriprate objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTeafactorytriprate[] List of ChildTeafactorytriprate objects
     * @throws PropelException
     */
    public function getTeafactorytripratesRelatedByStartopsmonthlycalendaroid(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid) {
                // return empty collection
                $this->initTeafactorytripratesRelatedByStartopsmonthlycalendaroid();
            } else {
                $collTeafactorytripratesRelatedByStartopsmonthlycalendaroid = ChildTeafactorytriprateQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroidPartial && count($collTeafactorytripratesRelatedByStartopsmonthlycalendaroid)) {
                        $this->initTeafactorytripratesRelatedByStartopsmonthlycalendaroid(false);

                        foreach ($collTeafactorytripratesRelatedByStartopsmonthlycalendaroid as $obj) {
                            if (false == $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid->contains($obj)) {
                                $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid->append($obj);
                            }
                        }

                        $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroidPartial = true;
                    }

                    return $collTeafactorytripratesRelatedByStartopsmonthlycalendaroid;
                }

                if ($partial && $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid) {
                    foreach ($this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid as $obj) {
                        if ($obj->isNew()) {
                            $collTeafactorytripratesRelatedByStartopsmonthlycalendaroid[] = $obj;
                        }
                    }
                }

                $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid = $collTeafactorytripratesRelatedByStartopsmonthlycalendaroid;
                $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroidPartial = false;
            }
        }

        return $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid;
    }

    /**
     * Sets a collection of ChildTeafactorytriprate objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $teafactorytripratesRelatedByStartopsmonthlycalendaroid A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setTeafactorytripratesRelatedByStartopsmonthlycalendaroid(Collection $teafactorytripratesRelatedByStartopsmonthlycalendaroid, ConnectionInterface $con = null)
    {
        /** @var ChildTeafactorytriprate[] $teafactorytripratesRelatedByStartopsmonthlycalendaroidToDelete */
        $teafactorytripratesRelatedByStartopsmonthlycalendaroidToDelete = $this->getTeafactorytripratesRelatedByStartopsmonthlycalendaroid(new Criteria(), $con)->diff($teafactorytripratesRelatedByStartopsmonthlycalendaroid);


        $this->teafactorytripratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion = $teafactorytripratesRelatedByStartopsmonthlycalendaroidToDelete;

        foreach ($teafactorytripratesRelatedByStartopsmonthlycalendaroidToDelete as $teafactorytriprateRelatedByStartopsmonthlycalendaroidRemoved) {
            $teafactorytriprateRelatedByStartopsmonthlycalendaroidRemoved->setOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid(null);
        }

        $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid = null;
        foreach ($teafactorytripratesRelatedByStartopsmonthlycalendaroid as $teafactorytriprateRelatedByStartopsmonthlycalendaroid) {
            $this->addTeafactorytriprateRelatedByStartopsmonthlycalendaroid($teafactorytriprateRelatedByStartopsmonthlycalendaroid);
        }

        $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid = $teafactorytripratesRelatedByStartopsmonthlycalendaroid;
        $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroidPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Teafactorytriprate objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Teafactorytriprate objects.
     * @throws PropelException
     */
    public function countTeafactorytripratesRelatedByStartopsmonthlycalendaroid(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTeafactorytripratesRelatedByStartopsmonthlycalendaroid());
            }

            $query = ChildTeafactorytriprateQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($this)
                ->count($con);
        }

        return count($this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid);
    }

    /**
     * Method called to associate a ChildTeafactorytriprate object to this object
     * through the ChildTeafactorytriprate foreign key attribute.
     *
     * @param  ChildTeafactorytriprate $l ChildTeafactorytriprate
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addTeafactorytriprateRelatedByStartopsmonthlycalendaroid(ChildTeafactorytriprate $l)
    {
        if ($this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid === null) {
            $this->initTeafactorytripratesRelatedByStartopsmonthlycalendaroid();
            $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroidPartial = true;
        }

        if (!$this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid->contains($l)) {
            $this->doAddTeafactorytriprateRelatedByStartopsmonthlycalendaroid($l);

            if ($this->teafactorytripratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion and $this->teafactorytripratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion->contains($l)) {
                $this->teafactorytripratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion->remove($this->teafactorytripratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTeafactorytriprate $teafactorytriprateRelatedByStartopsmonthlycalendaroid The ChildTeafactorytriprate object to add.
     */
    protected function doAddTeafactorytriprateRelatedByStartopsmonthlycalendaroid(ChildTeafactorytriprate $teafactorytriprateRelatedByStartopsmonthlycalendaroid)
    {
        $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid[]= $teafactorytriprateRelatedByStartopsmonthlycalendaroid;
        $teafactorytriprateRelatedByStartopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($this);
    }

    /**
     * @param  ChildTeafactorytriprate $teafactorytriprateRelatedByStartopsmonthlycalendaroid The ChildTeafactorytriprate object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeTeafactorytriprateRelatedByStartopsmonthlycalendaroid(ChildTeafactorytriprate $teafactorytriprateRelatedByStartopsmonthlycalendaroid)
    {
        if ($this->getTeafactorytripratesRelatedByStartopsmonthlycalendaroid()->contains($teafactorytriprateRelatedByStartopsmonthlycalendaroid)) {
            $pos = $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid->search($teafactorytriprateRelatedByStartopsmonthlycalendaroid);
            $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid->remove($pos);
            if (null === $this->teafactorytripratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion) {
                $this->teafactorytripratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion = clone $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid;
                $this->teafactorytripratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion->clear();
            }
            $this->teafactorytripratesRelatedByStartopsmonthlycalendaroidScheduledForDeletion[]= clone $teafactorytriprateRelatedByStartopsmonthlycalendaroid;
            $teafactorytriprateRelatedByStartopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid(null);
        }

        return $this;
    }

    /**
     * Clears out the collTeafactorytripratesRelatedByEndopsmonthlycalendaroid collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTeafactorytripratesRelatedByEndopsmonthlycalendaroid()
     */
    public function clearTeafactorytripratesRelatedByEndopsmonthlycalendaroid()
    {
        $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTeafactorytripratesRelatedByEndopsmonthlycalendaroid collection loaded partially.
     */
    public function resetPartialTeafactorytripratesRelatedByEndopsmonthlycalendaroid($v = true)
    {
        $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroidPartial = $v;
    }

    /**
     * Initializes the collTeafactorytripratesRelatedByEndopsmonthlycalendaroid collection.
     *
     * By default this just sets the collTeafactorytripratesRelatedByEndopsmonthlycalendaroid collection to an empty array (like clearcollTeafactorytripratesRelatedByEndopsmonthlycalendaroid());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTeafactorytripratesRelatedByEndopsmonthlycalendaroid($overrideExisting = true)
    {
        if (null !== $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid && !$overrideExisting) {
            return;
        }

        $collectionClassName = TeafactorytriprateTableMap::getTableMap()->getCollectionClassName();

        $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid = new $collectionClassName;
        $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid->setModel('\lwops\lwops\Teafactorytriprate');
    }

    /**
     * Gets an array of ChildTeafactorytriprate objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTeafactorytriprate[] List of ChildTeafactorytriprate objects
     * @throws PropelException
     */
    public function getTeafactorytripratesRelatedByEndopsmonthlycalendaroid(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid) {
                // return empty collection
                $this->initTeafactorytripratesRelatedByEndopsmonthlycalendaroid();
            } else {
                $collTeafactorytripratesRelatedByEndopsmonthlycalendaroid = ChildTeafactorytriprateQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroidPartial && count($collTeafactorytripratesRelatedByEndopsmonthlycalendaroid)) {
                        $this->initTeafactorytripratesRelatedByEndopsmonthlycalendaroid(false);

                        foreach ($collTeafactorytripratesRelatedByEndopsmonthlycalendaroid as $obj) {
                            if (false == $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid->contains($obj)) {
                                $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid->append($obj);
                            }
                        }

                        $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroidPartial = true;
                    }

                    return $collTeafactorytripratesRelatedByEndopsmonthlycalendaroid;
                }

                if ($partial && $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid) {
                    foreach ($this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid as $obj) {
                        if ($obj->isNew()) {
                            $collTeafactorytripratesRelatedByEndopsmonthlycalendaroid[] = $obj;
                        }
                    }
                }

                $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid = $collTeafactorytripratesRelatedByEndopsmonthlycalendaroid;
                $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroidPartial = false;
            }
        }

        return $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid;
    }

    /**
     * Sets a collection of ChildTeafactorytriprate objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $teafactorytripratesRelatedByEndopsmonthlycalendaroid A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setTeafactorytripratesRelatedByEndopsmonthlycalendaroid(Collection $teafactorytripratesRelatedByEndopsmonthlycalendaroid, ConnectionInterface $con = null)
    {
        /** @var ChildTeafactorytriprate[] $teafactorytripratesRelatedByEndopsmonthlycalendaroidToDelete */
        $teafactorytripratesRelatedByEndopsmonthlycalendaroidToDelete = $this->getTeafactorytripratesRelatedByEndopsmonthlycalendaroid(new Criteria(), $con)->diff($teafactorytripratesRelatedByEndopsmonthlycalendaroid);


        $this->teafactorytripratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion = $teafactorytripratesRelatedByEndopsmonthlycalendaroidToDelete;

        foreach ($teafactorytripratesRelatedByEndopsmonthlycalendaroidToDelete as $teafactorytriprateRelatedByEndopsmonthlycalendaroidRemoved) {
            $teafactorytriprateRelatedByEndopsmonthlycalendaroidRemoved->setOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid(null);
        }

        $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid = null;
        foreach ($teafactorytripratesRelatedByEndopsmonthlycalendaroid as $teafactorytriprateRelatedByEndopsmonthlycalendaroid) {
            $this->addTeafactorytriprateRelatedByEndopsmonthlycalendaroid($teafactorytriprateRelatedByEndopsmonthlycalendaroid);
        }

        $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid = $teafactorytripratesRelatedByEndopsmonthlycalendaroid;
        $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroidPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Teafactorytriprate objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Teafactorytriprate objects.
     * @throws PropelException
     */
    public function countTeafactorytripratesRelatedByEndopsmonthlycalendaroid(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTeafactorytripratesRelatedByEndopsmonthlycalendaroid());
            }

            $query = ChildTeafactorytriprateQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid($this)
                ->count($con);
        }

        return count($this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid);
    }

    /**
     * Method called to associate a ChildTeafactorytriprate object to this object
     * through the ChildTeafactorytriprate foreign key attribute.
     *
     * @param  ChildTeafactorytriprate $l ChildTeafactorytriprate
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addTeafactorytriprateRelatedByEndopsmonthlycalendaroid(ChildTeafactorytriprate $l)
    {
        if ($this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid === null) {
            $this->initTeafactorytripratesRelatedByEndopsmonthlycalendaroid();
            $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroidPartial = true;
        }

        if (!$this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid->contains($l)) {
            $this->doAddTeafactorytriprateRelatedByEndopsmonthlycalendaroid($l);

            if ($this->teafactorytripratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion and $this->teafactorytripratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion->contains($l)) {
                $this->teafactorytripratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion->remove($this->teafactorytripratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTeafactorytriprate $teafactorytriprateRelatedByEndopsmonthlycalendaroid The ChildTeafactorytriprate object to add.
     */
    protected function doAddTeafactorytriprateRelatedByEndopsmonthlycalendaroid(ChildTeafactorytriprate $teafactorytriprateRelatedByEndopsmonthlycalendaroid)
    {
        $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid[]= $teafactorytriprateRelatedByEndopsmonthlycalendaroid;
        $teafactorytriprateRelatedByEndopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid($this);
    }

    /**
     * @param  ChildTeafactorytriprate $teafactorytriprateRelatedByEndopsmonthlycalendaroid The ChildTeafactorytriprate object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeTeafactorytriprateRelatedByEndopsmonthlycalendaroid(ChildTeafactorytriprate $teafactorytriprateRelatedByEndopsmonthlycalendaroid)
    {
        if ($this->getTeafactorytripratesRelatedByEndopsmonthlycalendaroid()->contains($teafactorytriprateRelatedByEndopsmonthlycalendaroid)) {
            $pos = $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid->search($teafactorytriprateRelatedByEndopsmonthlycalendaroid);
            $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid->remove($pos);
            if (null === $this->teafactorytripratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion) {
                $this->teafactorytripratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion = clone $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid;
                $this->teafactorytripratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion->clear();
            }
            $this->teafactorytripratesRelatedByEndopsmonthlycalendaroidScheduledForDeletion[]= $teafactorytriprateRelatedByEndopsmonthlycalendaroid;
            $teafactorytriprateRelatedByEndopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid(null);
        }

        return $this;
    }

    /**
     * Clears out the collTeapandls collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTeapandls()
     */
    public function clearTeapandls()
    {
        $this->collTeapandls = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTeapandls collection loaded partially.
     */
    public function resetPartialTeapandls($v = true)
    {
        $this->collTeapandlsPartial = $v;
    }

    /**
     * Initializes the collTeapandls collection.
     *
     * By default this just sets the collTeapandls collection to an empty array (like clearcollTeapandls());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTeapandls($overrideExisting = true)
    {
        if (null !== $this->collTeapandls && !$overrideExisting) {
            return;
        }

        $collectionClassName = TeapandlTableMap::getTableMap()->getCollectionClassName();

        $this->collTeapandls = new $collectionClassName;
        $this->collTeapandls->setModel('\lwops\lwops\Teapandl');
    }

    /**
     * Gets an array of ChildTeapandl objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTeapandl[] List of ChildTeapandl objects
     * @throws PropelException
     */
    public function getTeapandls(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTeapandlsPartial && !$this->isNew();
        if (null === $this->collTeapandls || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTeapandls) {
                // return empty collection
                $this->initTeapandls();
            } else {
                $collTeapandls = ChildTeapandlQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendar($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTeapandlsPartial && count($collTeapandls)) {
                        $this->initTeapandls(false);

                        foreach ($collTeapandls as $obj) {
                            if (false == $this->collTeapandls->contains($obj)) {
                                $this->collTeapandls->append($obj);
                            }
                        }

                        $this->collTeapandlsPartial = true;
                    }

                    return $collTeapandls;
                }

                if ($partial && $this->collTeapandls) {
                    foreach ($this->collTeapandls as $obj) {
                        if ($obj->isNew()) {
                            $collTeapandls[] = $obj;
                        }
                    }
                }

                $this->collTeapandls = $collTeapandls;
                $this->collTeapandlsPartial = false;
            }
        }

        return $this->collTeapandls;
    }

    /**
     * Sets a collection of ChildTeapandl objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $teapandls A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setTeapandls(Collection $teapandls, ConnectionInterface $con = null)
    {
        /** @var ChildTeapandl[] $teapandlsToDelete */
        $teapandlsToDelete = $this->getTeapandls(new Criteria(), $con)->diff($teapandls);


        $this->teapandlsScheduledForDeletion = $teapandlsToDelete;

        foreach ($teapandlsToDelete as $teapandlRemoved) {
            $teapandlRemoved->setOpsmonthlycalendar(null);
        }

        $this->collTeapandls = null;
        foreach ($teapandls as $teapandl) {
            $this->addTeapandl($teapandl);
        }

        $this->collTeapandls = $teapandls;
        $this->collTeapandlsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Teapandl objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Teapandl objects.
     * @throws PropelException
     */
    public function countTeapandls(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTeapandlsPartial && !$this->isNew();
        if (null === $this->collTeapandls || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTeapandls) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTeapandls());
            }

            $query = ChildTeapandlQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendar($this)
                ->count($con);
        }

        return count($this->collTeapandls);
    }

    /**
     * Method called to associate a ChildTeapandl object to this object
     * through the ChildTeapandl foreign key attribute.
     *
     * @param  ChildTeapandl $l ChildTeapandl
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addTeapandl(ChildTeapandl $l)
    {
        if ($this->collTeapandls === null) {
            $this->initTeapandls();
            $this->collTeapandlsPartial = true;
        }

        if (!$this->collTeapandls->contains($l)) {
            $this->doAddTeapandl($l);

            if ($this->teapandlsScheduledForDeletion and $this->teapandlsScheduledForDeletion->contains($l)) {
                $this->teapandlsScheduledForDeletion->remove($this->teapandlsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTeapandl $teapandl The ChildTeapandl object to add.
     */
    protected function doAddTeapandl(ChildTeapandl $teapandl)
    {
        $this->collTeapandls[]= $teapandl;
        $teapandl->setOpsmonthlycalendar($this);
    }

    /**
     * @param  ChildTeapandl $teapandl The ChildTeapandl object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeTeapandl(ChildTeapandl $teapandl)
    {
        if ($this->getTeapandls()->contains($teapandl)) {
            $pos = $this->collTeapandls->search($teapandl);
            $this->collTeapandls->remove($pos);
            if (null === $this->teapandlsScheduledForDeletion) {
                $this->teapandlsScheduledForDeletion = clone $this->collTeapandls;
                $this->teapandlsScheduledForDeletion->clear();
            }
            $this->teapandlsScheduledForDeletion[]= clone $teapandl;
            $teapandl->setOpsmonthlycalendar(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Opsmonthlycalendar is new, it will return
     * an empty collection; or if this Opsmonthlycalendar has previously
     * been saved, it will retrieve related Teapandls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Opsmonthlycalendar.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTeapandl[] List of ChildTeapandl objects
     */
    public function getTeapandlsJoinLineofbusiness(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTeapandlQuery::create(null, $criteria);
        $query->joinWith('Lineofbusiness', $joinBehavior);

        return $this->getTeapandls($query, $con);
    }

    /**
     * Clears out the collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid()
     */
    public function clearVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid()
    {
        $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid collection loaded partially.
     */
    public function resetPartialVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid($v = true)
    {
        $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidPartial = $v;
    }

    /**
     * Initializes the collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid collection.
     *
     * By default this just sets the collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid collection to an empty array (like clearcollVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid($overrideExisting = true)
    {
        if (null !== $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid && !$overrideExisting) {
            return;
        }

        $collectionClassName = VehicleexpenseallocationTableMap::getTableMap()->getCollectionClassName();

        $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid = new $collectionClassName;
        $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid->setModel('\lwops\lwops\Vehicleexpenseallocation');
    }

    /**
     * Gets an array of ChildVehicleexpenseallocation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVehicleexpenseallocation[] List of ChildVehicleexpenseallocation objects
     * @throws PropelException
     */
    public function getVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid) {
                // return empty collection
                $this->initVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid();
            } else {
                $collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid = ChildVehicleexpenseallocationQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidPartial && count($collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid)) {
                        $this->initVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid(false);

                        foreach ($collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid as $obj) {
                            if (false == $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid->contains($obj)) {
                                $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid->append($obj);
                            }
                        }

                        $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidPartial = true;
                    }

                    return $collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid;
                }

                if ($partial && $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid) {
                    foreach ($this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid as $obj) {
                        if ($obj->isNew()) {
                            $collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid[] = $obj;
                        }
                    }
                }

                $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid = $collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid;
                $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidPartial = false;
            }
        }

        return $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid;
    }

    /**
     * Sets a collection of ChildVehicleexpenseallocation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid(Collection $vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid, ConnectionInterface $con = null)
    {
        /** @var ChildVehicleexpenseallocation[] $vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidToDelete */
        $vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidToDelete = $this->getVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid(new Criteria(), $con)->diff($vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid);


        $this->vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion = $vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidToDelete;

        foreach ($vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidToDelete as $vehicleexpenseallocationRelatedByStartopsmonthlycalendaroidRemoved) {
            $vehicleexpenseallocationRelatedByStartopsmonthlycalendaroidRemoved->setOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid(null);
        }

        $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid = null;
        foreach ($vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid as $vehicleexpenseallocationRelatedByStartopsmonthlycalendaroid) {
            $this->addVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid($vehicleexpenseallocationRelatedByStartopsmonthlycalendaroid);
        }

        $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid = $vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid;
        $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Vehicleexpenseallocation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Vehicleexpenseallocation objects.
     * @throws PropelException
     */
    public function countVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid());
            }

            $query = ChildVehicleexpenseallocationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($this)
                ->count($con);
        }

        return count($this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid);
    }

    /**
     * Method called to associate a ChildVehicleexpenseallocation object to this object
     * through the ChildVehicleexpenseallocation foreign key attribute.
     *
     * @param  ChildVehicleexpenseallocation $l ChildVehicleexpenseallocation
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid(ChildVehicleexpenseallocation $l)
    {
        if ($this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid === null) {
            $this->initVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid();
            $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidPartial = true;
        }

        if (!$this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid->contains($l)) {
            $this->doAddVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid($l);

            if ($this->vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion and $this->vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion->contains($l)) {
                $this->vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion->remove($this->vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVehicleexpenseallocation $vehicleexpenseallocationRelatedByStartopsmonthlycalendaroid The ChildVehicleexpenseallocation object to add.
     */
    protected function doAddVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid(ChildVehicleexpenseallocation $vehicleexpenseallocationRelatedByStartopsmonthlycalendaroid)
    {
        $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid[]= $vehicleexpenseallocationRelatedByStartopsmonthlycalendaroid;
        $vehicleexpenseallocationRelatedByStartopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid($this);
    }

    /**
     * @param  ChildVehicleexpenseallocation $vehicleexpenseallocationRelatedByStartopsmonthlycalendaroid The ChildVehicleexpenseallocation object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid(ChildVehicleexpenseallocation $vehicleexpenseallocationRelatedByStartopsmonthlycalendaroid)
    {
        if ($this->getVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid()->contains($vehicleexpenseallocationRelatedByStartopsmonthlycalendaroid)) {
            $pos = $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid->search($vehicleexpenseallocationRelatedByStartopsmonthlycalendaroid);
            $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid->remove($pos);
            if (null === $this->vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion) {
                $this->vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion = clone $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid;
                $this->vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion->clear();
            }
            $this->vehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidScheduledForDeletion[]= clone $vehicleexpenseallocationRelatedByStartopsmonthlycalendaroid;
            $vehicleexpenseallocationRelatedByStartopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Opsmonthlycalendar is new, it will return
     * an empty collection; or if this Opsmonthlycalendar has previously
     * been saved, it will retrieve related VehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Opsmonthlycalendar.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVehicleexpenseallocation[] List of ChildVehicleexpenseallocation objects
     */
    public function getVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidJoinLineofbusiness(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVehicleexpenseallocationQuery::create(null, $criteria);
        $query->joinWith('Lineofbusiness', $joinBehavior);

        return $this->getVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Opsmonthlycalendar is new, it will return
     * an empty collection; or if this Opsmonthlycalendar has previously
     * been saved, it will retrieve related VehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Opsmonthlycalendar.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVehicleexpenseallocation[] List of ChildVehicleexpenseallocation objects
     */
    public function getVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroidJoinVehicle(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVehicleexpenseallocationQuery::create(null, $criteria);
        $query->joinWith('Vehicle', $joinBehavior);

        return $this->getVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid($query, $con);
    }

    /**
     * Clears out the collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid()
     */
    public function clearVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid()
    {
        $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid collection loaded partially.
     */
    public function resetPartialVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid($v = true)
    {
        $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidPartial = $v;
    }

    /**
     * Initializes the collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid collection.
     *
     * By default this just sets the collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid collection to an empty array (like clearcollVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid($overrideExisting = true)
    {
        if (null !== $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid && !$overrideExisting) {
            return;
        }

        $collectionClassName = VehicleexpenseallocationTableMap::getTableMap()->getCollectionClassName();

        $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid = new $collectionClassName;
        $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid->setModel('\lwops\lwops\Vehicleexpenseallocation');
    }

    /**
     * Gets an array of ChildVehicleexpenseallocation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOpsmonthlycalendar is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVehicleexpenseallocation[] List of ChildVehicleexpenseallocation objects
     * @throws PropelException
     */
    public function getVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid) {
                // return empty collection
                $this->initVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid();
            } else {
                $collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid = ChildVehicleexpenseallocationQuery::create(null, $criteria)
                    ->filterByOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidPartial && count($collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid)) {
                        $this->initVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid(false);

                        foreach ($collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid as $obj) {
                            if (false == $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid->contains($obj)) {
                                $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid->append($obj);
                            }
                        }

                        $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidPartial = true;
                    }

                    return $collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid;
                }

                if ($partial && $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid) {
                    foreach ($this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid as $obj) {
                        if ($obj->isNew()) {
                            $collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid[] = $obj;
                        }
                    }
                }

                $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid = $collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid;
                $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidPartial = false;
            }
        }

        return $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid;
    }

    /**
     * Sets a collection of ChildVehicleexpenseallocation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function setVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid(Collection $vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid, ConnectionInterface $con = null)
    {
        /** @var ChildVehicleexpenseallocation[] $vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidToDelete */
        $vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidToDelete = $this->getVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid(new Criteria(), $con)->diff($vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid);


        $this->vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidScheduledForDeletion = $vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidToDelete;

        foreach ($vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidToDelete as $vehicleexpenseallocationRelatedByEndopsmonthlycalendaroidRemoved) {
            $vehicleexpenseallocationRelatedByEndopsmonthlycalendaroidRemoved->setOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid(null);
        }

        $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid = null;
        foreach ($vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid as $vehicleexpenseallocationRelatedByEndopsmonthlycalendaroid) {
            $this->addVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid($vehicleexpenseallocationRelatedByEndopsmonthlycalendaroid);
        }

        $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid = $vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid;
        $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Vehicleexpenseallocation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Vehicleexpenseallocation objects.
     * @throws PropelException
     */
    public function countVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidPartial && !$this->isNew();
        if (null === $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid());
            }

            $query = ChildVehicleexpenseallocationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid($this)
                ->count($con);
        }

        return count($this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid);
    }

    /**
     * Method called to associate a ChildVehicleexpenseallocation object to this object
     * through the ChildVehicleexpenseallocation foreign key attribute.
     *
     * @param  ChildVehicleexpenseallocation $l ChildVehicleexpenseallocation
     * @return $this|\lwops\lwops\Opsmonthlycalendar The current object (for fluent API support)
     */
    public function addVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid(ChildVehicleexpenseallocation $l)
    {
        if ($this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid === null) {
            $this->initVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid();
            $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidPartial = true;
        }

        if (!$this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid->contains($l)) {
            $this->doAddVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid($l);

            if ($this->vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidScheduledForDeletion and $this->vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidScheduledForDeletion->contains($l)) {
                $this->vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidScheduledForDeletion->remove($this->vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVehicleexpenseallocation $vehicleexpenseallocationRelatedByEndopsmonthlycalendaroid The ChildVehicleexpenseallocation object to add.
     */
    protected function doAddVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid(ChildVehicleexpenseallocation $vehicleexpenseallocationRelatedByEndopsmonthlycalendaroid)
    {
        $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid[]= $vehicleexpenseallocationRelatedByEndopsmonthlycalendaroid;
        $vehicleexpenseallocationRelatedByEndopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid($this);
    }

    /**
     * @param  ChildVehicleexpenseallocation $vehicleexpenseallocationRelatedByEndopsmonthlycalendaroid The ChildVehicleexpenseallocation object to remove.
     * @return $this|ChildOpsmonthlycalendar The current object (for fluent API support)
     */
    public function removeVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid(ChildVehicleexpenseallocation $vehicleexpenseallocationRelatedByEndopsmonthlycalendaroid)
    {
        if ($this->getVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid()->contains($vehicleexpenseallocationRelatedByEndopsmonthlycalendaroid)) {
            $pos = $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid->search($vehicleexpenseallocationRelatedByEndopsmonthlycalendaroid);
            $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid->remove($pos);
            if (null === $this->vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidScheduledForDeletion) {
                $this->vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidScheduledForDeletion = clone $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid;
                $this->vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidScheduledForDeletion->clear();
            }
            $this->vehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidScheduledForDeletion[]= clone $vehicleexpenseallocationRelatedByEndopsmonthlycalendaroid;
            $vehicleexpenseallocationRelatedByEndopsmonthlycalendaroid->setOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Opsmonthlycalendar is new, it will return
     * an empty collection; or if this Opsmonthlycalendar has previously
     * been saved, it will retrieve related VehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Opsmonthlycalendar.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVehicleexpenseallocation[] List of ChildVehicleexpenseallocation objects
     */
    public function getVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidJoinLineofbusiness(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVehicleexpenseallocationQuery::create(null, $criteria);
        $query->joinWith('Lineofbusiness', $joinBehavior);

        return $this->getVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Opsmonthlycalendar is new, it will return
     * an empty collection; or if this Opsmonthlycalendar has previously
     * been saved, it will retrieve related VehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Opsmonthlycalendar.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVehicleexpenseallocation[] List of ChildVehicleexpenseallocation objects
     */
    public function getVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroidJoinVehicle(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVehicleexpenseallocationQuery::create(null, $criteria);
        $query->joinWith('Vehicle', $joinBehavior);

        return $this->getVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->oid = null;
        $this->monthnbr = null;
        $this->month = null;
        $this->year = null;
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
            if ($this->collDairypandls) {
                foreach ($this->collDairypandls as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid) {
                foreach ($this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid) {
                foreach ($this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collElectricityexpenses) {
                foreach ($this->collElectricityexpenses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeeloans) {
                foreach ($this->collEmployeeloans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFishpandls) {
                foreach ($this->collFishpandls as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFtesalaryadvances) {
                foreach ($this->collFtesalaryadvances as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collKiambaadairies) {
                foreach ($this->collKiambaadairies as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTeabonuses) {
                foreach ($this->collTeabonuses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid) {
                foreach ($this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid) {
                foreach ($this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid) {
                foreach ($this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid) {
                foreach ($this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTeapandls) {
                foreach ($this->collTeapandls as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid) {
                foreach ($this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid) {
                foreach ($this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collDairypandls = null;
        $this->collElectricityallocationsRelatedByStartopsmonthlycalendaroid = null;
        $this->collElectricityallocationsRelatedByEndtopsmonthlycalendaroid = null;
        $this->collElectricityexpenses = null;
        $this->collEmployeeloans = null;
        $this->collFishpandls = null;
        $this->collFtesalaryadvances = null;
        $this->collKiambaadairies = null;
        $this->collTeabonuses = null;
        $this->collTeafactoryratesRelatedByStartopsmonthlycalendaroid = null;
        $this->collTeafactoryratesRelatedByEndopsmonthlycalendaroid = null;
        $this->collTeafactorytripratesRelatedByStartopsmonthlycalendaroid = null;
        $this->collTeafactorytripratesRelatedByEndopsmonthlycalendaroid = null;
        $this->collTeapandls = null;
        $this->collVehicleexpenseallocationsRelatedByStartopsmonthlycalendaroid = null;
        $this->collVehicleexpenseallocationsRelatedByEndopsmonthlycalendaroid = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OpsmonthlycalendarTableMap::DEFAULT_STRING_FORMAT);
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
