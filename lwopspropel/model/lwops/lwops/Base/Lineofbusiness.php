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
use lwops\lwops\Employeepurchases as ChildEmployeepurchases;
use lwops\lwops\EmployeepurchasesQuery as ChildEmployeepurchasesQuery;
use lwops\lwops\Employeesalaryexpenseallocation as ChildEmployeesalaryexpenseallocation;
use lwops\lwops\EmployeesalaryexpenseallocationQuery as ChildEmployeesalaryexpenseallocationQuery;
use lwops\lwops\Expenses as ChildExpenses;
use lwops\lwops\ExpensesQuery as ChildExpensesQuery;
use lwops\lwops\Fishpandl as ChildFishpandl;
use lwops\lwops\FishpandlQuery as ChildFishpandlQuery;
use lwops\lwops\Lineofbusiness as ChildLineofbusiness;
use lwops\lwops\LineofbusinessQuery as ChildLineofbusinessQuery;
use lwops\lwops\Otherworkassigned as ChildOtherworkassigned;
use lwops\lwops\OtherworkassignedQuery as ChildOtherworkassignedQuery;
use lwops\lwops\Parttimedetail as ChildParttimedetail;
use lwops\lwops\ParttimedetailQuery as ChildParttimedetailQuery;
use lwops\lwops\Teapandl as ChildTeapandl;
use lwops\lwops\TeapandlQuery as ChildTeapandlQuery;
use lwops\lwops\Vehicleexpenseallocation as ChildVehicleexpenseallocation;
use lwops\lwops\VehicleexpenseallocationQuery as ChildVehicleexpenseallocationQuery;
use lwops\lwops\Map\DairypandlTableMap;
use lwops\lwops\Map\ElectricityallocationTableMap;
use lwops\lwops\Map\EmployeepurchasesTableMap;
use lwops\lwops\Map\EmployeesalaryexpenseallocationTableMap;
use lwops\lwops\Map\ExpensesTableMap;
use lwops\lwops\Map\FishpandlTableMap;
use lwops\lwops\Map\LineofbusinessTableMap;
use lwops\lwops\Map\OtherworkassignedTableMap;
use lwops\lwops\Map\ParttimedetailTableMap;
use lwops\lwops\Map\TeapandlTableMap;
use lwops\lwops\Map\VehicleexpenseallocationTableMap;

/**
 * Base class that represents a row from the 'lineofbusiness' table.
 *
 *
 *
 * @package    propel.generator.lwops.lwops.Base
 */
abstract class Lineofbusiness implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\lwops\\lwops\\Map\\LineofbusinessTableMap';


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
     * The value for the department field.
     *
     * @var        string
     */
    protected $department;

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
    protected $collElectricityallocations;
    protected $collElectricityallocationsPartial;

    /**
     * @var        ObjectCollection|ChildEmployeepurchases[] Collection to store aggregation of ChildEmployeepurchases objects.
     */
    protected $collEmployeepurchasess;
    protected $collEmployeepurchasessPartial;

    /**
     * @var        ObjectCollection|ChildEmployeesalaryexpenseallocation[] Collection to store aggregation of ChildEmployeesalaryexpenseallocation objects.
     */
    protected $collEmployeesalaryexpenseallocations;
    protected $collEmployeesalaryexpenseallocationsPartial;

    /**
     * @var        ObjectCollection|ChildExpenses[] Collection to store aggregation of ChildExpenses objects.
     */
    protected $collExpensess;
    protected $collExpensessPartial;

    /**
     * @var        ObjectCollection|ChildFishpandl[] Collection to store aggregation of ChildFishpandl objects.
     */
    protected $collFishpandls;
    protected $collFishpandlsPartial;

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
     * @var        ObjectCollection|ChildTeapandl[] Collection to store aggregation of ChildTeapandl objects.
     */
    protected $collTeapandls;
    protected $collTeapandlsPartial;

    /**
     * @var        ObjectCollection|ChildVehicleexpenseallocation[] Collection to store aggregation of ChildVehicleexpenseallocation objects.
     */
    protected $collVehicleexpenseallocations;
    protected $collVehicleexpenseallocationsPartial;

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
    protected $electricityallocationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeepurchases[]
     */
    protected $employeepurchasessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeesalaryexpenseallocation[]
     */
    protected $employeesalaryexpenseallocationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExpenses[]
     */
    protected $expensessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFishpandl[]
     */
    protected $fishpandlsScheduledForDeletion = null;

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
     * @var ObjectCollection|ChildTeapandl[]
     */
    protected $teapandlsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVehicleexpenseallocation[]
     */
    protected $vehicleexpenseallocationsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
    }

    /**
     * Initializes internal state of lwops\lwops\Base\Lineofbusiness object.
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
     * Compares this with another <code>Lineofbusiness</code> instance.  If
     * <code>obj</code> is an instance of <code>Lineofbusiness</code>, delegates to
     * <code>equals(Lineofbusiness)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Lineofbusiness The current object, for fluid interface
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
     * Get the [department] column value.
     *
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
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
     * @return $this|\lwops\lwops\Lineofbusiness The current object (for fluent API support)
     */
    public function setOid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oid !== $v) {
            $this->oid = $v;
            $this->modifiedColumns[LineofbusinessTableMap::COL_OID] = true;
        }

        return $this;
    } // setOid()

    /**
     * Set the value of [department] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Lineofbusiness The current object (for fluent API support)
     */
    public function setDepartment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->department !== $v) {
            $this->department = $v;
            $this->modifiedColumns[LineofbusinessTableMap::COL_DEPARTMENT] = true;
        }

        return $this;
    } // setDepartment()

    /**
     * Sets the value of [createtmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Lineofbusiness The current object (for fluent API support)
     */
    public function setCreatetmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->createtmstp !== null || $dt !== null) {
            if ($this->createtmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->createtmstp->format("Y-m-d H:i:s.u")) {
                $this->createtmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[LineofbusinessTableMap::COL_CREATETMSTP] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatetmstp()

    /**
     * Sets the value of [updttmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Lineofbusiness The current object (for fluent API support)
     */
    public function setUpdttmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updttmstp !== null || $dt !== null) {
            if ($this->updttmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updttmstp->format("Y-m-d H:i:s.u")) {
                $this->updttmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[LineofbusinessTableMap::COL_UPDTTMSTP] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : LineofbusinessTableMap::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->oid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : LineofbusinessTableMap::translateFieldName('Department', TableMap::TYPE_PHPNAME, $indexType)];
            $this->department = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : LineofbusinessTableMap::translateFieldName('Createtmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->createtmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : LineofbusinessTableMap::translateFieldName('Updttmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updttmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = LineofbusinessTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\lwops\\lwops\\Lineofbusiness'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(LineofbusinessTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildLineofbusinessQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collDairypandls = null;

            $this->collElectricityallocations = null;

            $this->collEmployeepurchasess = null;

            $this->collEmployeesalaryexpenseallocations = null;

            $this->collExpensess = null;

            $this->collFishpandls = null;

            $this->collOtherworkassigneds = null;

            $this->collParttimedetails = null;

            $this->collTeapandls = null;

            $this->collVehicleexpenseallocations = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Lineofbusiness::setDeleted()
     * @see Lineofbusiness::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(LineofbusinessTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildLineofbusinessQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(LineofbusinessTableMap::DATABASE_NAME);
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
                LineofbusinessTableMap::addInstanceToPool($this);
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

            if ($this->electricityallocationsScheduledForDeletion !== null) {
                if (!$this->electricityallocationsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\ElectricityallocationQuery::create()
                        ->filterByPrimaryKeys($this->electricityallocationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->electricityallocationsScheduledForDeletion = null;
                }
            }

            if ($this->collElectricityallocations !== null) {
                foreach ($this->collElectricityallocations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->employeepurchasessScheduledForDeletion !== null) {
                if (!$this->employeepurchasessScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\EmployeepurchasesQuery::create()
                        ->filterByPrimaryKeys($this->employeepurchasessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->employeepurchasessScheduledForDeletion = null;
                }
            }

            if ($this->collEmployeepurchasess !== null) {
                foreach ($this->collEmployeepurchasess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->employeesalaryexpenseallocationsScheduledForDeletion !== null) {
                if (!$this->employeesalaryexpenseallocationsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\EmployeesalaryexpenseallocationQuery::create()
                        ->filterByPrimaryKeys($this->employeesalaryexpenseallocationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->employeesalaryexpenseallocationsScheduledForDeletion = null;
                }
            }

            if ($this->collEmployeesalaryexpenseallocations !== null) {
                foreach ($this->collEmployeesalaryexpenseallocations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->expensessScheduledForDeletion !== null) {
                if (!$this->expensessScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\ExpensesQuery::create()
                        ->filterByPrimaryKeys($this->expensessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->expensessScheduledForDeletion = null;
                }
            }

            if ($this->collExpensess !== null) {
                foreach ($this->collExpensess as $referrerFK) {
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

            if ($this->vehicleexpenseallocationsScheduledForDeletion !== null) {
                if (!$this->vehicleexpenseallocationsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\VehicleexpenseallocationQuery::create()
                        ->filterByPrimaryKeys($this->vehicleexpenseallocationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->vehicleexpenseallocationsScheduledForDeletion = null;
                }
            }

            if ($this->collVehicleexpenseallocations !== null) {
                foreach ($this->collVehicleexpenseallocations as $referrerFK) {
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

        $this->modifiedColumns[LineofbusinessTableMap::COL_OID] = true;
        if (null !== $this->oid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LineofbusinessTableMap::COL_OID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LineofbusinessTableMap::COL_OID)) {
            $modifiedColumns[':p' . $index++]  = 'oid';
        }
        if ($this->isColumnModified(LineofbusinessTableMap::COL_DEPARTMENT)) {
            $modifiedColumns[':p' . $index++]  = 'department';
        }
        if ($this->isColumnModified(LineofbusinessTableMap::COL_CREATETMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'createTmstp';
        }
        if ($this->isColumnModified(LineofbusinessTableMap::COL_UPDTTMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'updtTmstp';
        }

        $sql = sprintf(
            'INSERT INTO lineofbusiness (%s) VALUES (%s)',
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
                    case 'department':
                        $stmt->bindValue($identifier, $this->department, PDO::PARAM_STR);
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
        $pos = LineofbusinessTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getDepartment();
                break;
            case 2:
                return $this->getCreatetmstp();
                break;
            case 3:
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

        if (isset($alreadyDumpedObjects['Lineofbusiness'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Lineofbusiness'][$this->hashCode()] = true;
        $keys = LineofbusinessTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOid(),
            $keys[1] => $this->getDepartment(),
            $keys[2] => $this->getCreatetmstp(),
            $keys[3] => $this->getUpdttmstp(),
        );
        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('c');
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
            if (null !== $this->collElectricityallocations) {

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

                $result[$key] = $this->collElectricityallocations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEmployeepurchasess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employeepurchasess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employeepurchasess';
                        break;
                    default:
                        $key = 'Employeepurchasess';
                }

                $result[$key] = $this->collEmployeepurchasess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEmployeesalaryexpenseallocations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employeesalaryexpenseallocations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employeesalaryexpenseallocations';
                        break;
                    default:
                        $key = 'Employeesalaryexpenseallocations';
                }

                $result[$key] = $this->collEmployeesalaryexpenseallocations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collExpensess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'expensess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'expensess';
                        break;
                    default:
                        $key = 'Expensess';
                }

                $result[$key] = $this->collExpensess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collVehicleexpenseallocations) {

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

                $result[$key] = $this->collVehicleexpenseallocations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\lwops\lwops\Lineofbusiness
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = LineofbusinessTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\lwops\lwops\Lineofbusiness
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setOid($value);
                break;
            case 1:
                $this->setDepartment($value);
                break;
            case 2:
                $this->setCreatetmstp($value);
                break;
            case 3:
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
        $keys = LineofbusinessTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setDepartment($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCreatetmstp($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setUpdttmstp($arr[$keys[3]]);
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
     * @return $this|\lwops\lwops\Lineofbusiness The current object, for fluid interface
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
        $criteria = new Criteria(LineofbusinessTableMap::DATABASE_NAME);

        if ($this->isColumnModified(LineofbusinessTableMap::COL_OID)) {
            $criteria->add(LineofbusinessTableMap::COL_OID, $this->oid);
        }
        if ($this->isColumnModified(LineofbusinessTableMap::COL_DEPARTMENT)) {
            $criteria->add(LineofbusinessTableMap::COL_DEPARTMENT, $this->department);
        }
        if ($this->isColumnModified(LineofbusinessTableMap::COL_CREATETMSTP)) {
            $criteria->add(LineofbusinessTableMap::COL_CREATETMSTP, $this->createtmstp);
        }
        if ($this->isColumnModified(LineofbusinessTableMap::COL_UPDTTMSTP)) {
            $criteria->add(LineofbusinessTableMap::COL_UPDTTMSTP, $this->updttmstp);
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
        $criteria = ChildLineofbusinessQuery::create();
        $criteria->add(LineofbusinessTableMap::COL_OID, $this->oid);

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
     * @param      object $copyObj An object of \lwops\lwops\Lineofbusiness (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDepartment($this->getDepartment());
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

            foreach ($this->getElectricityallocations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addElectricityallocation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeepurchasess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeepurchases($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeesalaryexpenseallocations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeesalaryexpenseallocation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getExpensess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpenses($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getFishpandls() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFishpandl($relObj->copy($deepCopy));
                }
            }

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

            foreach ($this->getTeapandls() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTeapandl($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVehicleexpenseallocations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVehicleexpenseallocation($relObj->copy($deepCopy));
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
     * @return \lwops\lwops\Lineofbusiness Clone of current object.
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
        if ('Electricityallocation' == $relationName) {
            $this->initElectricityallocations();
            return;
        }
        if ('Employeepurchases' == $relationName) {
            $this->initEmployeepurchasess();
            return;
        }
        if ('Employeesalaryexpenseallocation' == $relationName) {
            $this->initEmployeesalaryexpenseallocations();
            return;
        }
        if ('Expenses' == $relationName) {
            $this->initExpensess();
            return;
        }
        if ('Fishpandl' == $relationName) {
            $this->initFishpandls();
            return;
        }
        if ('Otherworkassigned' == $relationName) {
            $this->initOtherworkassigneds();
            return;
        }
        if ('Parttimedetail' == $relationName) {
            $this->initParttimedetails();
            return;
        }
        if ('Teapandl' == $relationName) {
            $this->initTeapandls();
            return;
        }
        if ('Vehicleexpenseallocation' == $relationName) {
            $this->initVehicleexpenseallocations();
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
     * If this ChildLineofbusiness is new, it will return
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
                    ->filterByLineofbusiness($this)
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
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function setDairypandls(Collection $dairypandls, ConnectionInterface $con = null)
    {
        /** @var ChildDairypandl[] $dairypandlsToDelete */
        $dairypandlsToDelete = $this->getDairypandls(new Criteria(), $con)->diff($dairypandls);


        $this->dairypandlsScheduledForDeletion = $dairypandlsToDelete;

        foreach ($dairypandlsToDelete as $dairypandlRemoved) {
            $dairypandlRemoved->setLineofbusiness(null);
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
                ->filterByLineofbusiness($this)
                ->count($con);
        }

        return count($this->collDairypandls);
    }

    /**
     * Method called to associate a ChildDairypandl object to this object
     * through the ChildDairypandl foreign key attribute.
     *
     * @param  ChildDairypandl $l ChildDairypandl
     * @return $this|\lwops\lwops\Lineofbusiness The current object (for fluent API support)
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
        $dairypandl->setLineofbusiness($this);
    }

    /**
     * @param  ChildDairypandl $dairypandl The ChildDairypandl object to remove.
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
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
            $dairypandl->setLineofbusiness(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Dairypandls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDairypandl[] List of ChildDairypandl objects
     */
    public function getDairypandlsJoinOpsmonthlycalendar(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDairypandlQuery::create(null, $criteria);
        $query->joinWith('Opsmonthlycalendar', $joinBehavior);

        return $this->getDairypandls($query, $con);
    }

    /**
     * Clears out the collElectricityallocations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addElectricityallocations()
     */
    public function clearElectricityallocations()
    {
        $this->collElectricityallocations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collElectricityallocations collection loaded partially.
     */
    public function resetPartialElectricityallocations($v = true)
    {
        $this->collElectricityallocationsPartial = $v;
    }

    /**
     * Initializes the collElectricityallocations collection.
     *
     * By default this just sets the collElectricityallocations collection to an empty array (like clearcollElectricityallocations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initElectricityallocations($overrideExisting = true)
    {
        if (null !== $this->collElectricityallocations && !$overrideExisting) {
            return;
        }

        $collectionClassName = ElectricityallocationTableMap::getTableMap()->getCollectionClassName();

        $this->collElectricityallocations = new $collectionClassName;
        $this->collElectricityallocations->setModel('\lwops\lwops\Electricityallocation');
    }

    /**
     * Gets an array of ChildElectricityallocation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLineofbusiness is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildElectricityallocation[] List of ChildElectricityallocation objects
     * @throws PropelException
     */
    public function getElectricityallocations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collElectricityallocationsPartial && !$this->isNew();
        if (null === $this->collElectricityallocations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collElectricityallocations) {
                // return empty collection
                $this->initElectricityallocations();
            } else {
                $collElectricityallocations = ChildElectricityallocationQuery::create(null, $criteria)
                    ->filterByLineofbusiness($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collElectricityallocationsPartial && count($collElectricityallocations)) {
                        $this->initElectricityallocations(false);

                        foreach ($collElectricityallocations as $obj) {
                            if (false == $this->collElectricityallocations->contains($obj)) {
                                $this->collElectricityallocations->append($obj);
                            }
                        }

                        $this->collElectricityallocationsPartial = true;
                    }

                    return $collElectricityallocations;
                }

                if ($partial && $this->collElectricityallocations) {
                    foreach ($this->collElectricityallocations as $obj) {
                        if ($obj->isNew()) {
                            $collElectricityallocations[] = $obj;
                        }
                    }
                }

                $this->collElectricityallocations = $collElectricityallocations;
                $this->collElectricityallocationsPartial = false;
            }
        }

        return $this->collElectricityallocations;
    }

    /**
     * Sets a collection of ChildElectricityallocation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $electricityallocations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function setElectricityallocations(Collection $electricityallocations, ConnectionInterface $con = null)
    {
        /** @var ChildElectricityallocation[] $electricityallocationsToDelete */
        $electricityallocationsToDelete = $this->getElectricityallocations(new Criteria(), $con)->diff($electricityallocations);


        $this->electricityallocationsScheduledForDeletion = $electricityallocationsToDelete;

        foreach ($electricityallocationsToDelete as $electricityallocationRemoved) {
            $electricityallocationRemoved->setLineofbusiness(null);
        }

        $this->collElectricityallocations = null;
        foreach ($electricityallocations as $electricityallocation) {
            $this->addElectricityallocation($electricityallocation);
        }

        $this->collElectricityallocations = $electricityallocations;
        $this->collElectricityallocationsPartial = false;

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
    public function countElectricityallocations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collElectricityallocationsPartial && !$this->isNew();
        if (null === $this->collElectricityallocations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collElectricityallocations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getElectricityallocations());
            }

            $query = ChildElectricityallocationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLineofbusiness($this)
                ->count($con);
        }

        return count($this->collElectricityallocations);
    }

    /**
     * Method called to associate a ChildElectricityallocation object to this object
     * through the ChildElectricityallocation foreign key attribute.
     *
     * @param  ChildElectricityallocation $l ChildElectricityallocation
     * @return $this|\lwops\lwops\Lineofbusiness The current object (for fluent API support)
     */
    public function addElectricityallocation(ChildElectricityallocation $l)
    {
        if ($this->collElectricityallocations === null) {
            $this->initElectricityallocations();
            $this->collElectricityallocationsPartial = true;
        }

        if (!$this->collElectricityallocations->contains($l)) {
            $this->doAddElectricityallocation($l);

            if ($this->electricityallocationsScheduledForDeletion and $this->electricityallocationsScheduledForDeletion->contains($l)) {
                $this->electricityallocationsScheduledForDeletion->remove($this->electricityallocationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildElectricityallocation $electricityallocation The ChildElectricityallocation object to add.
     */
    protected function doAddElectricityallocation(ChildElectricityallocation $electricityallocation)
    {
        $this->collElectricityallocations[]= $electricityallocation;
        $electricityallocation->setLineofbusiness($this);
    }

    /**
     * @param  ChildElectricityallocation $electricityallocation The ChildElectricityallocation object to remove.
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function removeElectricityallocation(ChildElectricityallocation $electricityallocation)
    {
        if ($this->getElectricityallocations()->contains($electricityallocation)) {
            $pos = $this->collElectricityallocations->search($electricityallocation);
            $this->collElectricityallocations->remove($pos);
            if (null === $this->electricityallocationsScheduledForDeletion) {
                $this->electricityallocationsScheduledForDeletion = clone $this->collElectricityallocations;
                $this->electricityallocationsScheduledForDeletion->clear();
            }
            $this->electricityallocationsScheduledForDeletion[]= clone $electricityallocation;
            $electricityallocation->setLineofbusiness(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Electricityallocations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildElectricityallocation[] List of ChildElectricityallocation objects
     */
    public function getElectricityallocationsJoinElectricityaccount(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildElectricityallocationQuery::create(null, $criteria);
        $query->joinWith('Electricityaccount', $joinBehavior);

        return $this->getElectricityallocations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Electricityallocations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildElectricityallocation[] List of ChildElectricityallocation objects
     */
    public function getElectricityallocationsJoinOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildElectricityallocationQuery::create(null, $criteria);
        $query->joinWith('OpsmonthlycalendarRelatedByStartopsmonthlycalendaroid', $joinBehavior);

        return $this->getElectricityallocations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Electricityallocations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildElectricityallocation[] List of ChildElectricityallocation objects
     */
    public function getElectricityallocationsJoinOpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildElectricityallocationQuery::create(null, $criteria);
        $query->joinWith('OpsmonthlycalendarRelatedByEndtopsmonthlycalendaroid', $joinBehavior);

        return $this->getElectricityallocations($query, $con);
    }

    /**
     * Clears out the collEmployeepurchasess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEmployeepurchasess()
     */
    public function clearEmployeepurchasess()
    {
        $this->collEmployeepurchasess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEmployeepurchasess collection loaded partially.
     */
    public function resetPartialEmployeepurchasess($v = true)
    {
        $this->collEmployeepurchasessPartial = $v;
    }

    /**
     * Initializes the collEmployeepurchasess collection.
     *
     * By default this just sets the collEmployeepurchasess collection to an empty array (like clearcollEmployeepurchasess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployeepurchasess($overrideExisting = true)
    {
        if (null !== $this->collEmployeepurchasess && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeepurchasesTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployeepurchasess = new $collectionClassName;
        $this->collEmployeepurchasess->setModel('\lwops\lwops\Employeepurchases');
    }

    /**
     * Gets an array of ChildEmployeepurchases objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLineofbusiness is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployeepurchases[] List of ChildEmployeepurchases objects
     * @throws PropelException
     */
    public function getEmployeepurchasess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeepurchasessPartial && !$this->isNew();
        if (null === $this->collEmployeepurchasess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEmployeepurchasess) {
                // return empty collection
                $this->initEmployeepurchasess();
            } else {
                $collEmployeepurchasess = ChildEmployeepurchasesQuery::create(null, $criteria)
                    ->filterByLineofbusiness($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeepurchasessPartial && count($collEmployeepurchasess)) {
                        $this->initEmployeepurchasess(false);

                        foreach ($collEmployeepurchasess as $obj) {
                            if (false == $this->collEmployeepurchasess->contains($obj)) {
                                $this->collEmployeepurchasess->append($obj);
                            }
                        }

                        $this->collEmployeepurchasessPartial = true;
                    }

                    return $collEmployeepurchasess;
                }

                if ($partial && $this->collEmployeepurchasess) {
                    foreach ($this->collEmployeepurchasess as $obj) {
                        if ($obj->isNew()) {
                            $collEmployeepurchasess[] = $obj;
                        }
                    }
                }

                $this->collEmployeepurchasess = $collEmployeepurchasess;
                $this->collEmployeepurchasessPartial = false;
            }
        }

        return $this->collEmployeepurchasess;
    }

    /**
     * Sets a collection of ChildEmployeepurchases objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $employeepurchasess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function setEmployeepurchasess(Collection $employeepurchasess, ConnectionInterface $con = null)
    {
        /** @var ChildEmployeepurchases[] $employeepurchasessToDelete */
        $employeepurchasessToDelete = $this->getEmployeepurchasess(new Criteria(), $con)->diff($employeepurchasess);


        $this->employeepurchasessScheduledForDeletion = $employeepurchasessToDelete;

        foreach ($employeepurchasessToDelete as $employeepurchasesRemoved) {
            $employeepurchasesRemoved->setLineofbusiness(null);
        }

        $this->collEmployeepurchasess = null;
        foreach ($employeepurchasess as $employeepurchases) {
            $this->addEmployeepurchases($employeepurchases);
        }

        $this->collEmployeepurchasess = $employeepurchasess;
        $this->collEmployeepurchasessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Employeepurchases objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Employeepurchases objects.
     * @throws PropelException
     */
    public function countEmployeepurchasess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeepurchasessPartial && !$this->isNew();
        if (null === $this->collEmployeepurchasess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployeepurchasess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployeepurchasess());
            }

            $query = ChildEmployeepurchasesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLineofbusiness($this)
                ->count($con);
        }

        return count($this->collEmployeepurchasess);
    }

    /**
     * Method called to associate a ChildEmployeepurchases object to this object
     * through the ChildEmployeepurchases foreign key attribute.
     *
     * @param  ChildEmployeepurchases $l ChildEmployeepurchases
     * @return $this|\lwops\lwops\Lineofbusiness The current object (for fluent API support)
     */
    public function addEmployeepurchases(ChildEmployeepurchases $l)
    {
        if ($this->collEmployeepurchasess === null) {
            $this->initEmployeepurchasess();
            $this->collEmployeepurchasessPartial = true;
        }

        if (!$this->collEmployeepurchasess->contains($l)) {
            $this->doAddEmployeepurchases($l);

            if ($this->employeepurchasessScheduledForDeletion and $this->employeepurchasessScheduledForDeletion->contains($l)) {
                $this->employeepurchasessScheduledForDeletion->remove($this->employeepurchasessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployeepurchases $employeepurchases The ChildEmployeepurchases object to add.
     */
    protected function doAddEmployeepurchases(ChildEmployeepurchases $employeepurchases)
    {
        $this->collEmployeepurchasess[]= $employeepurchases;
        $employeepurchases->setLineofbusiness($this);
    }

    /**
     * @param  ChildEmployeepurchases $employeepurchases The ChildEmployeepurchases object to remove.
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function removeEmployeepurchases(ChildEmployeepurchases $employeepurchases)
    {
        if ($this->getEmployeepurchasess()->contains($employeepurchases)) {
            $pos = $this->collEmployeepurchasess->search($employeepurchases);
            $this->collEmployeepurchasess->remove($pos);
            if (null === $this->employeepurchasessScheduledForDeletion) {
                $this->employeepurchasessScheduledForDeletion = clone $this->collEmployeepurchasess;
                $this->employeepurchasessScheduledForDeletion->clear();
            }
            $this->employeepurchasessScheduledForDeletion[]= clone $employeepurchases;
            $employeepurchases->setLineofbusiness(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Employeepurchasess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployeepurchases[] List of ChildEmployeepurchases objects
     */
    public function getEmployeepurchasessJoinEmployee(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeepurchasesQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getEmployeepurchasess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Employeepurchasess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployeepurchases[] List of ChildEmployeepurchases objects
     */
    public function getEmployeepurchasessJoinProductunit(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeepurchasesQuery::create(null, $criteria);
        $query->joinWith('Productunit', $joinBehavior);

        return $this->getEmployeepurchasess($query, $con);
    }

    /**
     * Clears out the collEmployeesalaryexpenseallocations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEmployeesalaryexpenseallocations()
     */
    public function clearEmployeesalaryexpenseallocations()
    {
        $this->collEmployeesalaryexpenseallocations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEmployeesalaryexpenseallocations collection loaded partially.
     */
    public function resetPartialEmployeesalaryexpenseallocations($v = true)
    {
        $this->collEmployeesalaryexpenseallocationsPartial = $v;
    }

    /**
     * Initializes the collEmployeesalaryexpenseallocations collection.
     *
     * By default this just sets the collEmployeesalaryexpenseallocations collection to an empty array (like clearcollEmployeesalaryexpenseallocations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployeesalaryexpenseallocations($overrideExisting = true)
    {
        if (null !== $this->collEmployeesalaryexpenseallocations && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeesalaryexpenseallocationTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployeesalaryexpenseallocations = new $collectionClassName;
        $this->collEmployeesalaryexpenseallocations->setModel('\lwops\lwops\Employeesalaryexpenseallocation');
    }

    /**
     * Gets an array of ChildEmployeesalaryexpenseallocation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLineofbusiness is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployeesalaryexpenseallocation[] List of ChildEmployeesalaryexpenseallocation objects
     * @throws PropelException
     */
    public function getEmployeesalaryexpenseallocations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeesalaryexpenseallocationsPartial && !$this->isNew();
        if (null === $this->collEmployeesalaryexpenseallocations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEmployeesalaryexpenseallocations) {
                // return empty collection
                $this->initEmployeesalaryexpenseallocations();
            } else {
                $collEmployeesalaryexpenseallocations = ChildEmployeesalaryexpenseallocationQuery::create(null, $criteria)
                    ->filterByLineofbusiness($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeesalaryexpenseallocationsPartial && count($collEmployeesalaryexpenseallocations)) {
                        $this->initEmployeesalaryexpenseallocations(false);

                        foreach ($collEmployeesalaryexpenseallocations as $obj) {
                            if (false == $this->collEmployeesalaryexpenseallocations->contains($obj)) {
                                $this->collEmployeesalaryexpenseallocations->append($obj);
                            }
                        }

                        $this->collEmployeesalaryexpenseallocationsPartial = true;
                    }

                    return $collEmployeesalaryexpenseallocations;
                }

                if ($partial && $this->collEmployeesalaryexpenseallocations) {
                    foreach ($this->collEmployeesalaryexpenseallocations as $obj) {
                        if ($obj->isNew()) {
                            $collEmployeesalaryexpenseallocations[] = $obj;
                        }
                    }
                }

                $this->collEmployeesalaryexpenseallocations = $collEmployeesalaryexpenseallocations;
                $this->collEmployeesalaryexpenseallocationsPartial = false;
            }
        }

        return $this->collEmployeesalaryexpenseallocations;
    }

    /**
     * Sets a collection of ChildEmployeesalaryexpenseallocation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $employeesalaryexpenseallocations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function setEmployeesalaryexpenseallocations(Collection $employeesalaryexpenseallocations, ConnectionInterface $con = null)
    {
        /** @var ChildEmployeesalaryexpenseallocation[] $employeesalaryexpenseallocationsToDelete */
        $employeesalaryexpenseallocationsToDelete = $this->getEmployeesalaryexpenseallocations(new Criteria(), $con)->diff($employeesalaryexpenseallocations);


        $this->employeesalaryexpenseallocationsScheduledForDeletion = $employeesalaryexpenseallocationsToDelete;

        foreach ($employeesalaryexpenseallocationsToDelete as $employeesalaryexpenseallocationRemoved) {
            $employeesalaryexpenseallocationRemoved->setLineofbusiness(null);
        }

        $this->collEmployeesalaryexpenseallocations = null;
        foreach ($employeesalaryexpenseallocations as $employeesalaryexpenseallocation) {
            $this->addEmployeesalaryexpenseallocation($employeesalaryexpenseallocation);
        }

        $this->collEmployeesalaryexpenseallocations = $employeesalaryexpenseallocations;
        $this->collEmployeesalaryexpenseallocationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Employeesalaryexpenseallocation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Employeesalaryexpenseallocation objects.
     * @throws PropelException
     */
    public function countEmployeesalaryexpenseallocations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeesalaryexpenseallocationsPartial && !$this->isNew();
        if (null === $this->collEmployeesalaryexpenseallocations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployeesalaryexpenseallocations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployeesalaryexpenseallocations());
            }

            $query = ChildEmployeesalaryexpenseallocationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLineofbusiness($this)
                ->count($con);
        }

        return count($this->collEmployeesalaryexpenseallocations);
    }

    /**
     * Method called to associate a ChildEmployeesalaryexpenseallocation object to this object
     * through the ChildEmployeesalaryexpenseallocation foreign key attribute.
     *
     * @param  ChildEmployeesalaryexpenseallocation $l ChildEmployeesalaryexpenseallocation
     * @return $this|\lwops\lwops\Lineofbusiness The current object (for fluent API support)
     */
    public function addEmployeesalaryexpenseallocation(ChildEmployeesalaryexpenseallocation $l)
    {
        if ($this->collEmployeesalaryexpenseallocations === null) {
            $this->initEmployeesalaryexpenseallocations();
            $this->collEmployeesalaryexpenseallocationsPartial = true;
        }

        if (!$this->collEmployeesalaryexpenseallocations->contains($l)) {
            $this->doAddEmployeesalaryexpenseallocation($l);

            if ($this->employeesalaryexpenseallocationsScheduledForDeletion and $this->employeesalaryexpenseallocationsScheduledForDeletion->contains($l)) {
                $this->employeesalaryexpenseallocationsScheduledForDeletion->remove($this->employeesalaryexpenseallocationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployeesalaryexpenseallocation $employeesalaryexpenseallocation The ChildEmployeesalaryexpenseallocation object to add.
     */
    protected function doAddEmployeesalaryexpenseallocation(ChildEmployeesalaryexpenseallocation $employeesalaryexpenseallocation)
    {
        $this->collEmployeesalaryexpenseallocations[]= $employeesalaryexpenseallocation;
        $employeesalaryexpenseallocation->setLineofbusiness($this);
    }

    /**
     * @param  ChildEmployeesalaryexpenseallocation $employeesalaryexpenseallocation The ChildEmployeesalaryexpenseallocation object to remove.
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function removeEmployeesalaryexpenseallocation(ChildEmployeesalaryexpenseallocation $employeesalaryexpenseallocation)
    {
        if ($this->getEmployeesalaryexpenseallocations()->contains($employeesalaryexpenseallocation)) {
            $pos = $this->collEmployeesalaryexpenseallocations->search($employeesalaryexpenseallocation);
            $this->collEmployeesalaryexpenseallocations->remove($pos);
            if (null === $this->employeesalaryexpenseallocationsScheduledForDeletion) {
                $this->employeesalaryexpenseallocationsScheduledForDeletion = clone $this->collEmployeesalaryexpenseallocations;
                $this->employeesalaryexpenseallocationsScheduledForDeletion->clear();
            }
            $this->employeesalaryexpenseallocationsScheduledForDeletion[]= clone $employeesalaryexpenseallocation;
            $employeesalaryexpenseallocation->setLineofbusiness(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Employeesalaryexpenseallocations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployeesalaryexpenseallocation[] List of ChildEmployeesalaryexpenseallocation objects
     */
    public function getEmployeesalaryexpenseallocationsJoinEmployee(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeesalaryexpenseallocationQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getEmployeesalaryexpenseallocations($query, $con);
    }

    /**
     * Clears out the collExpensess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addExpensess()
     */
    public function clearExpensess()
    {
        $this->collExpensess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collExpensess collection loaded partially.
     */
    public function resetPartialExpensess($v = true)
    {
        $this->collExpensessPartial = $v;
    }

    /**
     * Initializes the collExpensess collection.
     *
     * By default this just sets the collExpensess collection to an empty array (like clearcollExpensess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initExpensess($overrideExisting = true)
    {
        if (null !== $this->collExpensess && !$overrideExisting) {
            return;
        }

        $collectionClassName = ExpensesTableMap::getTableMap()->getCollectionClassName();

        $this->collExpensess = new $collectionClassName;
        $this->collExpensess->setModel('\lwops\lwops\Expenses');
    }

    /**
     * Gets an array of ChildExpenses objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLineofbusiness is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @throws PropelException
     */
    public function getExpensess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collExpensessPartial && !$this->isNew();
        if (null === $this->collExpensess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collExpensess) {
                // return empty collection
                $this->initExpensess();
            } else {
                $collExpensess = ChildExpensesQuery::create(null, $criteria)
                    ->filterByLineofbusiness($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collExpensessPartial && count($collExpensess)) {
                        $this->initExpensess(false);

                        foreach ($collExpensess as $obj) {
                            if (false == $this->collExpensess->contains($obj)) {
                                $this->collExpensess->append($obj);
                            }
                        }

                        $this->collExpensessPartial = true;
                    }

                    return $collExpensess;
                }

                if ($partial && $this->collExpensess) {
                    foreach ($this->collExpensess as $obj) {
                        if ($obj->isNew()) {
                            $collExpensess[] = $obj;
                        }
                    }
                }

                $this->collExpensess = $collExpensess;
                $this->collExpensessPartial = false;
            }
        }

        return $this->collExpensess;
    }

    /**
     * Sets a collection of ChildExpenses objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $expensess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function setExpensess(Collection $expensess, ConnectionInterface $con = null)
    {
        /** @var ChildExpenses[] $expensessToDelete */
        $expensessToDelete = $this->getExpensess(new Criteria(), $con)->diff($expensess);


        $this->expensessScheduledForDeletion = $expensessToDelete;

        foreach ($expensessToDelete as $expensesRemoved) {
            $expensesRemoved->setLineofbusiness(null);
        }

        $this->collExpensess = null;
        foreach ($expensess as $expenses) {
            $this->addExpenses($expenses);
        }

        $this->collExpensess = $expensess;
        $this->collExpensessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Expenses objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Expenses objects.
     * @throws PropelException
     */
    public function countExpensess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collExpensessPartial && !$this->isNew();
        if (null === $this->collExpensess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collExpensess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getExpensess());
            }

            $query = ChildExpensesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLineofbusiness($this)
                ->count($con);
        }

        return count($this->collExpensess);
    }

    /**
     * Method called to associate a ChildExpenses object to this object
     * through the ChildExpenses foreign key attribute.
     *
     * @param  ChildExpenses $l ChildExpenses
     * @return $this|\lwops\lwops\Lineofbusiness The current object (for fluent API support)
     */
    public function addExpenses(ChildExpenses $l)
    {
        if ($this->collExpensess === null) {
            $this->initExpensess();
            $this->collExpensessPartial = true;
        }

        if (!$this->collExpensess->contains($l)) {
            $this->doAddExpenses($l);

            if ($this->expensessScheduledForDeletion and $this->expensessScheduledForDeletion->contains($l)) {
                $this->expensessScheduledForDeletion->remove($this->expensessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildExpenses $expenses The ChildExpenses object to add.
     */
    protected function doAddExpenses(ChildExpenses $expenses)
    {
        $this->collExpensess[]= $expenses;
        $expenses->setLineofbusiness($this);
    }

    /**
     * @param  ChildExpenses $expenses The ChildExpenses object to remove.
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function removeExpenses(ChildExpenses $expenses)
    {
        if ($this->getExpensess()->contains($expenses)) {
            $pos = $this->collExpensess->search($expenses);
            $this->collExpensess->remove($pos);
            if (null === $this->expensessScheduledForDeletion) {
                $this->expensessScheduledForDeletion = clone $this->collExpensess;
                $this->expensessScheduledForDeletion->clear();
            }
            $this->expensessScheduledForDeletion[]= clone $expenses;
            $expenses->setLineofbusiness(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     */
    public function getExpensessJoinExpenseactivity(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('Expenseactivity', $joinBehavior);

        return $this->getExpensess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     */
    public function getExpensessJoinExpensecategory(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('Expensecategory', $joinBehavior);

        return $this->getExpensess($query, $con);
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
     * If this ChildLineofbusiness is new, it will return
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
                    ->filterByLineofbusiness($this)
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
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function setFishpandls(Collection $fishpandls, ConnectionInterface $con = null)
    {
        /** @var ChildFishpandl[] $fishpandlsToDelete */
        $fishpandlsToDelete = $this->getFishpandls(new Criteria(), $con)->diff($fishpandls);


        $this->fishpandlsScheduledForDeletion = $fishpandlsToDelete;

        foreach ($fishpandlsToDelete as $fishpandlRemoved) {
            $fishpandlRemoved->setLineofbusiness(null);
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
                ->filterByLineofbusiness($this)
                ->count($con);
        }

        return count($this->collFishpandls);
    }

    /**
     * Method called to associate a ChildFishpandl object to this object
     * through the ChildFishpandl foreign key attribute.
     *
     * @param  ChildFishpandl $l ChildFishpandl
     * @return $this|\lwops\lwops\Lineofbusiness The current object (for fluent API support)
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
        $fishpandl->setLineofbusiness($this);
    }

    /**
     * @param  ChildFishpandl $fishpandl The ChildFishpandl object to remove.
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
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
            $fishpandl->setLineofbusiness(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Fishpandls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFishpandl[] List of ChildFishpandl objects
     */
    public function getFishpandlsJoinOpsmonthlycalendar(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFishpandlQuery::create(null, $criteria);
        $query->joinWith('Opsmonthlycalendar', $joinBehavior);

        return $this->getFishpandls($query, $con);
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
     * If this ChildLineofbusiness is new, it will return
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
                    ->filterByLineofbusiness($this)
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
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function setOtherworkassigneds(Collection $otherworkassigneds, ConnectionInterface $con = null)
    {
        /** @var ChildOtherworkassigned[] $otherworkassignedsToDelete */
        $otherworkassignedsToDelete = $this->getOtherworkassigneds(new Criteria(), $con)->diff($otherworkassigneds);


        $this->otherworkassignedsScheduledForDeletion = $otherworkassignedsToDelete;

        foreach ($otherworkassignedsToDelete as $otherworkassignedRemoved) {
            $otherworkassignedRemoved->setLineofbusiness(null);
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
                ->filterByLineofbusiness($this)
                ->count($con);
        }

        return count($this->collOtherworkassigneds);
    }

    /**
     * Method called to associate a ChildOtherworkassigned object to this object
     * through the ChildOtherworkassigned foreign key attribute.
     *
     * @param  ChildOtherworkassigned $l ChildOtherworkassigned
     * @return $this|\lwops\lwops\Lineofbusiness The current object (for fluent API support)
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
        $otherworkassigned->setLineofbusiness($this);
    }

    /**
     * @param  ChildOtherworkassigned $otherworkassigned The ChildOtherworkassigned object to remove.
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
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
            $otherworkassigned->setLineofbusiness(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Otherworkassigneds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOtherworkassigned[] List of ChildOtherworkassigned objects
     */
    public function getOtherworkassignedsJoinAttendance(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOtherworkassignedQuery::create(null, $criteria);
        $query->joinWith('Attendance', $joinBehavior);

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
     * If this ChildLineofbusiness is new, it will return
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
                    ->filterByLineofbusiness($this)
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
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function setParttimedetails(Collection $parttimedetails, ConnectionInterface $con = null)
    {
        /** @var ChildParttimedetail[] $parttimedetailsToDelete */
        $parttimedetailsToDelete = $this->getParttimedetails(new Criteria(), $con)->diff($parttimedetails);


        $this->parttimedetailsScheduledForDeletion = $parttimedetailsToDelete;

        foreach ($parttimedetailsToDelete as $parttimedetailRemoved) {
            $parttimedetailRemoved->setLineofbusiness(null);
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
                ->filterByLineofbusiness($this)
                ->count($con);
        }

        return count($this->collParttimedetails);
    }

    /**
     * Method called to associate a ChildParttimedetail object to this object
     * through the ChildParttimedetail foreign key attribute.
     *
     * @param  ChildParttimedetail $l ChildParttimedetail
     * @return $this|\lwops\lwops\Lineofbusiness The current object (for fluent API support)
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
        $parttimedetail->setLineofbusiness($this);
    }

    /**
     * @param  ChildParttimedetail $parttimedetail The ChildParttimedetail object to remove.
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
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
            $parttimedetail->setLineofbusiness(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Parttimedetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildParttimedetail[] List of ChildParttimedetail objects
     */
    public function getParttimedetailsJoinAttendance(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildParttimedetailQuery::create(null, $criteria);
        $query->joinWith('Attendance', $joinBehavior);

        return $this->getParttimedetails($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Parttimedetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
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
     * If this ChildLineofbusiness is new, it will return
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
                    ->filterByLineofbusiness($this)
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
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function setTeapandls(Collection $teapandls, ConnectionInterface $con = null)
    {
        /** @var ChildTeapandl[] $teapandlsToDelete */
        $teapandlsToDelete = $this->getTeapandls(new Criteria(), $con)->diff($teapandls);


        $this->teapandlsScheduledForDeletion = $teapandlsToDelete;

        foreach ($teapandlsToDelete as $teapandlRemoved) {
            $teapandlRemoved->setLineofbusiness(null);
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
                ->filterByLineofbusiness($this)
                ->count($con);
        }

        return count($this->collTeapandls);
    }

    /**
     * Method called to associate a ChildTeapandl object to this object
     * through the ChildTeapandl foreign key attribute.
     *
     * @param  ChildTeapandl $l ChildTeapandl
     * @return $this|\lwops\lwops\Lineofbusiness The current object (for fluent API support)
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
        $teapandl->setLineofbusiness($this);
    }

    /**
     * @param  ChildTeapandl $teapandl The ChildTeapandl object to remove.
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
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
            $teapandl->setLineofbusiness(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Teapandls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTeapandl[] List of ChildTeapandl objects
     */
    public function getTeapandlsJoinOpsmonthlycalendar(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTeapandlQuery::create(null, $criteria);
        $query->joinWith('Opsmonthlycalendar', $joinBehavior);

        return $this->getTeapandls($query, $con);
    }

    /**
     * Clears out the collVehicleexpenseallocations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVehicleexpenseallocations()
     */
    public function clearVehicleexpenseallocations()
    {
        $this->collVehicleexpenseallocations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVehicleexpenseallocations collection loaded partially.
     */
    public function resetPartialVehicleexpenseallocations($v = true)
    {
        $this->collVehicleexpenseallocationsPartial = $v;
    }

    /**
     * Initializes the collVehicleexpenseallocations collection.
     *
     * By default this just sets the collVehicleexpenseallocations collection to an empty array (like clearcollVehicleexpenseallocations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVehicleexpenseallocations($overrideExisting = true)
    {
        if (null !== $this->collVehicleexpenseallocations && !$overrideExisting) {
            return;
        }

        $collectionClassName = VehicleexpenseallocationTableMap::getTableMap()->getCollectionClassName();

        $this->collVehicleexpenseallocations = new $collectionClassName;
        $this->collVehicleexpenseallocations->setModel('\lwops\lwops\Vehicleexpenseallocation');
    }

    /**
     * Gets an array of ChildVehicleexpenseallocation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLineofbusiness is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVehicleexpenseallocation[] List of ChildVehicleexpenseallocation objects
     * @throws PropelException
     */
    public function getVehicleexpenseallocations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVehicleexpenseallocationsPartial && !$this->isNew();
        if (null === $this->collVehicleexpenseallocations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVehicleexpenseallocations) {
                // return empty collection
                $this->initVehicleexpenseallocations();
            } else {
                $collVehicleexpenseallocations = ChildVehicleexpenseallocationQuery::create(null, $criteria)
                    ->filterByLineofbusiness($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVehicleexpenseallocationsPartial && count($collVehicleexpenseallocations)) {
                        $this->initVehicleexpenseallocations(false);

                        foreach ($collVehicleexpenseallocations as $obj) {
                            if (false == $this->collVehicleexpenseallocations->contains($obj)) {
                                $this->collVehicleexpenseallocations->append($obj);
                            }
                        }

                        $this->collVehicleexpenseallocationsPartial = true;
                    }

                    return $collVehicleexpenseallocations;
                }

                if ($partial && $this->collVehicleexpenseallocations) {
                    foreach ($this->collVehicleexpenseallocations as $obj) {
                        if ($obj->isNew()) {
                            $collVehicleexpenseallocations[] = $obj;
                        }
                    }
                }

                $this->collVehicleexpenseallocations = $collVehicleexpenseallocations;
                $this->collVehicleexpenseallocationsPartial = false;
            }
        }

        return $this->collVehicleexpenseallocations;
    }

    /**
     * Sets a collection of ChildVehicleexpenseallocation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $vehicleexpenseallocations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function setVehicleexpenseallocations(Collection $vehicleexpenseallocations, ConnectionInterface $con = null)
    {
        /** @var ChildVehicleexpenseallocation[] $vehicleexpenseallocationsToDelete */
        $vehicleexpenseallocationsToDelete = $this->getVehicleexpenseallocations(new Criteria(), $con)->diff($vehicleexpenseallocations);


        $this->vehicleexpenseallocationsScheduledForDeletion = $vehicleexpenseallocationsToDelete;

        foreach ($vehicleexpenseallocationsToDelete as $vehicleexpenseallocationRemoved) {
            $vehicleexpenseallocationRemoved->setLineofbusiness(null);
        }

        $this->collVehicleexpenseallocations = null;
        foreach ($vehicleexpenseallocations as $vehicleexpenseallocation) {
            $this->addVehicleexpenseallocation($vehicleexpenseallocation);
        }

        $this->collVehicleexpenseallocations = $vehicleexpenseallocations;
        $this->collVehicleexpenseallocationsPartial = false;

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
    public function countVehicleexpenseallocations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVehicleexpenseallocationsPartial && !$this->isNew();
        if (null === $this->collVehicleexpenseallocations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVehicleexpenseallocations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVehicleexpenseallocations());
            }

            $query = ChildVehicleexpenseallocationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLineofbusiness($this)
                ->count($con);
        }

        return count($this->collVehicleexpenseallocations);
    }

    /**
     * Method called to associate a ChildVehicleexpenseallocation object to this object
     * through the ChildVehicleexpenseallocation foreign key attribute.
     *
     * @param  ChildVehicleexpenseallocation $l ChildVehicleexpenseallocation
     * @return $this|\lwops\lwops\Lineofbusiness The current object (for fluent API support)
     */
    public function addVehicleexpenseallocation(ChildVehicleexpenseallocation $l)
    {
        if ($this->collVehicleexpenseallocations === null) {
            $this->initVehicleexpenseallocations();
            $this->collVehicleexpenseallocationsPartial = true;
        }

        if (!$this->collVehicleexpenseallocations->contains($l)) {
            $this->doAddVehicleexpenseallocation($l);

            if ($this->vehicleexpenseallocationsScheduledForDeletion and $this->vehicleexpenseallocationsScheduledForDeletion->contains($l)) {
                $this->vehicleexpenseallocationsScheduledForDeletion->remove($this->vehicleexpenseallocationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVehicleexpenseallocation $vehicleexpenseallocation The ChildVehicleexpenseallocation object to add.
     */
    protected function doAddVehicleexpenseallocation(ChildVehicleexpenseallocation $vehicleexpenseallocation)
    {
        $this->collVehicleexpenseallocations[]= $vehicleexpenseallocation;
        $vehicleexpenseallocation->setLineofbusiness($this);
    }

    /**
     * @param  ChildVehicleexpenseallocation $vehicleexpenseallocation The ChildVehicleexpenseallocation object to remove.
     * @return $this|ChildLineofbusiness The current object (for fluent API support)
     */
    public function removeVehicleexpenseallocation(ChildVehicleexpenseallocation $vehicleexpenseallocation)
    {
        if ($this->getVehicleexpenseallocations()->contains($vehicleexpenseallocation)) {
            $pos = $this->collVehicleexpenseallocations->search($vehicleexpenseallocation);
            $this->collVehicleexpenseallocations->remove($pos);
            if (null === $this->vehicleexpenseallocationsScheduledForDeletion) {
                $this->vehicleexpenseallocationsScheduledForDeletion = clone $this->collVehicleexpenseallocations;
                $this->vehicleexpenseallocationsScheduledForDeletion->clear();
            }
            $this->vehicleexpenseallocationsScheduledForDeletion[]= clone $vehicleexpenseallocation;
            $vehicleexpenseallocation->setLineofbusiness(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Vehicleexpenseallocations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVehicleexpenseallocation[] List of ChildVehicleexpenseallocation objects
     */
    public function getVehicleexpenseallocationsJoinOpsmonthlycalendarRelatedByStartopsmonthlycalendaroid(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVehicleexpenseallocationQuery::create(null, $criteria);
        $query->joinWith('OpsmonthlycalendarRelatedByStartopsmonthlycalendaroid', $joinBehavior);

        return $this->getVehicleexpenseallocations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Vehicleexpenseallocations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVehicleexpenseallocation[] List of ChildVehicleexpenseallocation objects
     */
    public function getVehicleexpenseallocationsJoinOpsmonthlycalendarRelatedByEndopsmonthlycalendaroid(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVehicleexpenseallocationQuery::create(null, $criteria);
        $query->joinWith('OpsmonthlycalendarRelatedByEndopsmonthlycalendaroid', $joinBehavior);

        return $this->getVehicleexpenseallocations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lineofbusiness is new, it will return
     * an empty collection; or if this Lineofbusiness has previously
     * been saved, it will retrieve related Vehicleexpenseallocations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lineofbusiness.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVehicleexpenseallocation[] List of ChildVehicleexpenseallocation objects
     */
    public function getVehicleexpenseallocationsJoinVehicle(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVehicleexpenseallocationQuery::create(null, $criteria);
        $query->joinWith('Vehicle', $joinBehavior);

        return $this->getVehicleexpenseallocations($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->oid = null;
        $this->department = null;
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
            if ($this->collElectricityallocations) {
                foreach ($this->collElectricityallocations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeepurchasess) {
                foreach ($this->collEmployeepurchasess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeesalaryexpenseallocations) {
                foreach ($this->collEmployeesalaryexpenseallocations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collExpensess) {
                foreach ($this->collExpensess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFishpandls) {
                foreach ($this->collFishpandls as $o) {
                    $o->clearAllReferences($deep);
                }
            }
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
            if ($this->collTeapandls) {
                foreach ($this->collTeapandls as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVehicleexpenseallocations) {
                foreach ($this->collVehicleexpenseallocations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collDairypandls = null;
        $this->collElectricityallocations = null;
        $this->collEmployeepurchasess = null;
        $this->collEmployeesalaryexpenseallocations = null;
        $this->collExpensess = null;
        $this->collFishpandls = null;
        $this->collOtherworkassigneds = null;
        $this->collParttimedetails = null;
        $this->collTeapandls = null;
        $this->collVehicleexpenseallocations = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LineofbusinessTableMap::DEFAULT_STRING_FORMAT);
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
