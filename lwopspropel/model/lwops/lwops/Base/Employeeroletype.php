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
use lwops\lwops\Dairypandllabourexpensedetail as ChildDairypandllabourexpensedetail;
use lwops\lwops\DairypandllabourexpensedetailQuery as ChildDairypandllabourexpensedetailQuery;
use lwops\lwops\Employeerole as ChildEmployeerole;
use lwops\lwops\EmployeeroleQuery as ChildEmployeeroleQuery;
use lwops\lwops\Employeeroletype as ChildEmployeeroletype;
use lwops\lwops\EmployeeroletypeQuery as ChildEmployeeroletypeQuery;
use lwops\lwops\Fishpandllabourexpensedetail as ChildFishpandllabourexpensedetail;
use lwops\lwops\FishpandllabourexpensedetailQuery as ChildFishpandllabourexpensedetailQuery;
use lwops\lwops\Teapandllabourexpensedetail as ChildTeapandllabourexpensedetail;
use lwops\lwops\TeapandllabourexpensedetailQuery as ChildTeapandllabourexpensedetailQuery;
use lwops\lwops\Map\DairypandllabourexpensedetailTableMap;
use lwops\lwops\Map\EmployeeroleTableMap;
use lwops\lwops\Map\EmployeeroletypeTableMap;
use lwops\lwops\Map\FishpandllabourexpensedetailTableMap;
use lwops\lwops\Map\TeapandllabourexpensedetailTableMap;

/**
 * Base class that represents a row from the 'employeeroletype' table.
 *
 *
 *
 * @package    propel.generator.lwops.lwops.Base
 */
abstract class Employeeroletype implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\lwops\\lwops\\Map\\EmployeeroletypeTableMap';


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
     * The value for the role field.
     *
     * Note: this column has a database default value of: 'TEA PICKER'
     * @var        string
     */
    protected $role;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

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
     * @var        ObjectCollection|ChildDairypandllabourexpensedetail[] Collection to store aggregation of ChildDairypandllabourexpensedetail objects.
     */
    protected $collDairypandllabourexpensedetails;
    protected $collDairypandllabourexpensedetailsPartial;

    /**
     * @var        ObjectCollection|ChildEmployeerole[] Collection to store aggregation of ChildEmployeerole objects.
     */
    protected $collEmployeeroles;
    protected $collEmployeerolesPartial;

    /**
     * @var        ObjectCollection|ChildFishpandllabourexpensedetail[] Collection to store aggregation of ChildFishpandllabourexpensedetail objects.
     */
    protected $collFishpandllabourexpensedetails;
    protected $collFishpandllabourexpensedetailsPartial;

    /**
     * @var        ObjectCollection|ChildTeapandllabourexpensedetail[] Collection to store aggregation of ChildTeapandllabourexpensedetail objects.
     */
    protected $collTeapandllabourexpensedetails;
    protected $collTeapandllabourexpensedetailsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDairypandllabourexpensedetail[]
     */
    protected $dairypandllabourexpensedetailsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeerole[]
     */
    protected $employeerolesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFishpandllabourexpensedetail[]
     */
    protected $fishpandllabourexpensedetailsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTeapandllabourexpensedetail[]
     */
    protected $teapandllabourexpensedetailsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->role = 'TEA PICKER';
    }

    /**
     * Initializes internal state of lwops\lwops\Base\Employeeroletype object.
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
     * Compares this with another <code>Employeeroletype</code> instance.  If
     * <code>obj</code> is an instance of <code>Employeeroletype</code>, delegates to
     * <code>equals(Employeeroletype)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Employeeroletype The current object, for fluid interface
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
     * Get the [role] column value.
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * @return $this|\lwops\lwops\Employeeroletype The current object (for fluent API support)
     */
    public function setOid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oid !== $v) {
            $this->oid = $v;
            $this->modifiedColumns[EmployeeroletypeTableMap::COL_OID] = true;
        }

        return $this;
    } // setOid()

    /**
     * Set the value of [role] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employeeroletype The current object (for fluent API support)
     */
    public function setRole($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->role !== $v) {
            $this->role = $v;
            $this->modifiedColumns[EmployeeroletypeTableMap::COL_ROLE] = true;
        }

        return $this;
    } // setRole()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employeeroletype The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[EmployeeroletypeTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Sets the value of [createtmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Employeeroletype The current object (for fluent API support)
     */
    public function setCreatetmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->createtmstp !== null || $dt !== null) {
            if ($this->createtmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->createtmstp->format("Y-m-d H:i:s.u")) {
                $this->createtmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EmployeeroletypeTableMap::COL_CREATETMSTP] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatetmstp()

    /**
     * Sets the value of [updttmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Employeeroletype The current object (for fluent API support)
     */
    public function setUpdttmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updttmstp !== null || $dt !== null) {
            if ($this->updttmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updttmstp->format("Y-m-d H:i:s.u")) {
                $this->updttmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EmployeeroletypeTableMap::COL_UPDTTMSTP] = true;
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
            if ($this->role !== 'TEA PICKER') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : EmployeeroletypeTableMap::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->oid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : EmployeeroletypeTableMap::translateFieldName('Role', TableMap::TYPE_PHPNAME, $indexType)];
            $this->role = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : EmployeeroletypeTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : EmployeeroletypeTableMap::translateFieldName('Createtmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->createtmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : EmployeeroletypeTableMap::translateFieldName('Updttmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updttmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = EmployeeroletypeTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\lwops\\lwops\\Employeeroletype'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeroletypeTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildEmployeeroletypeQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collDairypandllabourexpensedetails = null;

            $this->collEmployeeroles = null;

            $this->collFishpandllabourexpensedetails = null;

            $this->collTeapandllabourexpensedetails = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Employeeroletype::setDeleted()
     * @see Employeeroletype::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeroletypeTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildEmployeeroletypeQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeroletypeTableMap::DATABASE_NAME);
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
                EmployeeroletypeTableMap::addInstanceToPool($this);
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

            if ($this->dairypandllabourexpensedetailsScheduledForDeletion !== null) {
                if (!$this->dairypandllabourexpensedetailsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\DairypandllabourexpensedetailQuery::create()
                        ->filterByPrimaryKeys($this->dairypandllabourexpensedetailsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->dairypandllabourexpensedetailsScheduledForDeletion = null;
                }
            }

            if ($this->collDairypandllabourexpensedetails !== null) {
                foreach ($this->collDairypandllabourexpensedetails as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->employeerolesScheduledForDeletion !== null) {
                if (!$this->employeerolesScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\EmployeeroleQuery::create()
                        ->filterByPrimaryKeys($this->employeerolesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->employeerolesScheduledForDeletion = null;
                }
            }

            if ($this->collEmployeeroles !== null) {
                foreach ($this->collEmployeeroles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->fishpandllabourexpensedetailsScheduledForDeletion !== null) {
                if (!$this->fishpandllabourexpensedetailsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\FishpandllabourexpensedetailQuery::create()
                        ->filterByPrimaryKeys($this->fishpandllabourexpensedetailsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->fishpandllabourexpensedetailsScheduledForDeletion = null;
                }
            }

            if ($this->collFishpandllabourexpensedetails !== null) {
                foreach ($this->collFishpandllabourexpensedetails as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->teapandllabourexpensedetailsScheduledForDeletion !== null) {
                if (!$this->teapandllabourexpensedetailsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\TeapandllabourexpensedetailQuery::create()
                        ->filterByPrimaryKeys($this->teapandllabourexpensedetailsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->teapandllabourexpensedetailsScheduledForDeletion = null;
                }
            }

            if ($this->collTeapandllabourexpensedetails !== null) {
                foreach ($this->collTeapandllabourexpensedetails as $referrerFK) {
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

        $this->modifiedColumns[EmployeeroletypeTableMap::COL_OID] = true;
        if (null !== $this->oid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EmployeeroletypeTableMap::COL_OID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EmployeeroletypeTableMap::COL_OID)) {
            $modifiedColumns[':p' . $index++]  = 'oid';
        }
        if ($this->isColumnModified(EmployeeroletypeTableMap::COL_ROLE)) {
            $modifiedColumns[':p' . $index++]  = 'role';
        }
        if ($this->isColumnModified(EmployeeroletypeTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(EmployeeroletypeTableMap::COL_CREATETMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'createTmstp';
        }
        if ($this->isColumnModified(EmployeeroletypeTableMap::COL_UPDTTMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'updtTmstp';
        }

        $sql = sprintf(
            'INSERT INTO employeeroletype (%s) VALUES (%s)',
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
                    case 'role':
                        $stmt->bindValue($identifier, $this->role, PDO::PARAM_STR);
                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
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
        $pos = EmployeeroletypeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getRole();
                break;
            case 2:
                return $this->getDescription();
                break;
            case 3:
                return $this->getCreatetmstp();
                break;
            case 4:
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

        if (isset($alreadyDumpedObjects['Employeeroletype'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Employeeroletype'][$this->hashCode()] = true;
        $keys = EmployeeroletypeTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOid(),
            $keys[1] => $this->getRole(),
            $keys[2] => $this->getDescription(),
            $keys[3] => $this->getCreatetmstp(),
            $keys[4] => $this->getUpdttmstp(),
        );
        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('c');
        }

        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collDairypandllabourexpensedetails) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dairypandllabourexpensedetails';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'dairypandllabourexpensedetails';
                        break;
                    default:
                        $key = 'Dairypandllabourexpensedetails';
                }

                $result[$key] = $this->collDairypandllabourexpensedetails->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEmployeeroles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employeeroles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employeeroles';
                        break;
                    default:
                        $key = 'Employeeroles';
                }

                $result[$key] = $this->collEmployeeroles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collFishpandllabourexpensedetails) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'fishpandllabourexpensedetails';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'fishpandllabourexpensedetails';
                        break;
                    default:
                        $key = 'Fishpandllabourexpensedetails';
                }

                $result[$key] = $this->collFishpandllabourexpensedetails->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTeapandllabourexpensedetails) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'teapandllabourexpensedetails';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'teapandllabourexpensedetails';
                        break;
                    default:
                        $key = 'Teapandllabourexpensedetails';
                }

                $result[$key] = $this->collTeapandllabourexpensedetails->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\lwops\lwops\Employeeroletype
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = EmployeeroletypeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\lwops\lwops\Employeeroletype
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setOid($value);
                break;
            case 1:
                $this->setRole($value);
                break;
            case 2:
                $this->setDescription($value);
                break;
            case 3:
                $this->setCreatetmstp($value);
                break;
            case 4:
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
        $keys = EmployeeroletypeTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setRole($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDescription($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCreatetmstp($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setUpdttmstp($arr[$keys[4]]);
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
     * @return $this|\lwops\lwops\Employeeroletype The current object, for fluid interface
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
        $criteria = new Criteria(EmployeeroletypeTableMap::DATABASE_NAME);

        if ($this->isColumnModified(EmployeeroletypeTableMap::COL_OID)) {
            $criteria->add(EmployeeroletypeTableMap::COL_OID, $this->oid);
        }
        if ($this->isColumnModified(EmployeeroletypeTableMap::COL_ROLE)) {
            $criteria->add(EmployeeroletypeTableMap::COL_ROLE, $this->role);
        }
        if ($this->isColumnModified(EmployeeroletypeTableMap::COL_DESCRIPTION)) {
            $criteria->add(EmployeeroletypeTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(EmployeeroletypeTableMap::COL_CREATETMSTP)) {
            $criteria->add(EmployeeroletypeTableMap::COL_CREATETMSTP, $this->createtmstp);
        }
        if ($this->isColumnModified(EmployeeroletypeTableMap::COL_UPDTTMSTP)) {
            $criteria->add(EmployeeroletypeTableMap::COL_UPDTTMSTP, $this->updttmstp);
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
        $criteria = ChildEmployeeroletypeQuery::create();
        $criteria->add(EmployeeroletypeTableMap::COL_OID, $this->oid);

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
     * @param      object $copyObj An object of \lwops\lwops\Employeeroletype (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setRole($this->getRole());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setCreatetmstp($this->getCreatetmstp());
        $copyObj->setUpdttmstp($this->getUpdttmstp());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getDairypandllabourexpensedetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDairypandllabourexpensedetail($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeeroles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeerole($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getFishpandllabourexpensedetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFishpandllabourexpensedetail($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTeapandllabourexpensedetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTeapandllabourexpensedetail($relObj->copy($deepCopy));
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
     * @return \lwops\lwops\Employeeroletype Clone of current object.
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
        if ('Dairypandllabourexpensedetail' == $relationName) {
            $this->initDairypandllabourexpensedetails();
            return;
        }
        if ('Employeerole' == $relationName) {
            $this->initEmployeeroles();
            return;
        }
        if ('Fishpandllabourexpensedetail' == $relationName) {
            $this->initFishpandllabourexpensedetails();
            return;
        }
        if ('Teapandllabourexpensedetail' == $relationName) {
            $this->initTeapandllabourexpensedetails();
            return;
        }
    }

    /**
     * Clears out the collDairypandllabourexpensedetails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDairypandllabourexpensedetails()
     */
    public function clearDairypandllabourexpensedetails()
    {
        $this->collDairypandllabourexpensedetails = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collDairypandllabourexpensedetails collection loaded partially.
     */
    public function resetPartialDairypandllabourexpensedetails($v = true)
    {
        $this->collDairypandllabourexpensedetailsPartial = $v;
    }

    /**
     * Initializes the collDairypandllabourexpensedetails collection.
     *
     * By default this just sets the collDairypandllabourexpensedetails collection to an empty array (like clearcollDairypandllabourexpensedetails());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDairypandllabourexpensedetails($overrideExisting = true)
    {
        if (null !== $this->collDairypandllabourexpensedetails && !$overrideExisting) {
            return;
        }

        $collectionClassName = DairypandllabourexpensedetailTableMap::getTableMap()->getCollectionClassName();

        $this->collDairypandllabourexpensedetails = new $collectionClassName;
        $this->collDairypandllabourexpensedetails->setModel('\lwops\lwops\Dairypandllabourexpensedetail');
    }

    /**
     * Gets an array of ChildDairypandllabourexpensedetail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployeeroletype is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDairypandllabourexpensedetail[] List of ChildDairypandllabourexpensedetail objects
     * @throws PropelException
     */
    public function getDairypandllabourexpensedetails(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collDairypandllabourexpensedetailsPartial && !$this->isNew();
        if (null === $this->collDairypandllabourexpensedetails || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDairypandllabourexpensedetails) {
                // return empty collection
                $this->initDairypandllabourexpensedetails();
            } else {
                $collDairypandllabourexpensedetails = ChildDairypandllabourexpensedetailQuery::create(null, $criteria)
                    ->filterByEmployeeroletype($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDairypandllabourexpensedetailsPartial && count($collDairypandllabourexpensedetails)) {
                        $this->initDairypandllabourexpensedetails(false);

                        foreach ($collDairypandllabourexpensedetails as $obj) {
                            if (false == $this->collDairypandllabourexpensedetails->contains($obj)) {
                                $this->collDairypandllabourexpensedetails->append($obj);
                            }
                        }

                        $this->collDairypandllabourexpensedetailsPartial = true;
                    }

                    return $collDairypandllabourexpensedetails;
                }

                if ($partial && $this->collDairypandllabourexpensedetails) {
                    foreach ($this->collDairypandllabourexpensedetails as $obj) {
                        if ($obj->isNew()) {
                            $collDairypandllabourexpensedetails[] = $obj;
                        }
                    }
                }

                $this->collDairypandllabourexpensedetails = $collDairypandllabourexpensedetails;
                $this->collDairypandllabourexpensedetailsPartial = false;
            }
        }

        return $this->collDairypandllabourexpensedetails;
    }

    /**
     * Sets a collection of ChildDairypandllabourexpensedetail objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $dairypandllabourexpensedetails A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployeeroletype The current object (for fluent API support)
     */
    public function setDairypandllabourexpensedetails(Collection $dairypandllabourexpensedetails, ConnectionInterface $con = null)
    {
        /** @var ChildDairypandllabourexpensedetail[] $dairypandllabourexpensedetailsToDelete */
        $dairypandllabourexpensedetailsToDelete = $this->getDairypandllabourexpensedetails(new Criteria(), $con)->diff($dairypandllabourexpensedetails);


        $this->dairypandllabourexpensedetailsScheduledForDeletion = $dairypandllabourexpensedetailsToDelete;

        foreach ($dairypandllabourexpensedetailsToDelete as $dairypandllabourexpensedetailRemoved) {
            $dairypandllabourexpensedetailRemoved->setEmployeeroletype(null);
        }

        $this->collDairypandllabourexpensedetails = null;
        foreach ($dairypandllabourexpensedetails as $dairypandllabourexpensedetail) {
            $this->addDairypandllabourexpensedetail($dairypandllabourexpensedetail);
        }

        $this->collDairypandllabourexpensedetails = $dairypandllabourexpensedetails;
        $this->collDairypandllabourexpensedetailsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Dairypandllabourexpensedetail objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Dairypandllabourexpensedetail objects.
     * @throws PropelException
     */
    public function countDairypandllabourexpensedetails(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collDairypandllabourexpensedetailsPartial && !$this->isNew();
        if (null === $this->collDairypandllabourexpensedetails || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDairypandllabourexpensedetails) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDairypandllabourexpensedetails());
            }

            $query = ChildDairypandllabourexpensedetailQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployeeroletype($this)
                ->count($con);
        }

        return count($this->collDairypandllabourexpensedetails);
    }

    /**
     * Method called to associate a ChildDairypandllabourexpensedetail object to this object
     * through the ChildDairypandllabourexpensedetail foreign key attribute.
     *
     * @param  ChildDairypandllabourexpensedetail $l ChildDairypandllabourexpensedetail
     * @return $this|\lwops\lwops\Employeeroletype The current object (for fluent API support)
     */
    public function addDairypandllabourexpensedetail(ChildDairypandllabourexpensedetail $l)
    {
        if ($this->collDairypandllabourexpensedetails === null) {
            $this->initDairypandllabourexpensedetails();
            $this->collDairypandllabourexpensedetailsPartial = true;
        }

        if (!$this->collDairypandllabourexpensedetails->contains($l)) {
            $this->doAddDairypandllabourexpensedetail($l);

            if ($this->dairypandllabourexpensedetailsScheduledForDeletion and $this->dairypandllabourexpensedetailsScheduledForDeletion->contains($l)) {
                $this->dairypandllabourexpensedetailsScheduledForDeletion->remove($this->dairypandllabourexpensedetailsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDairypandllabourexpensedetail $dairypandllabourexpensedetail The ChildDairypandllabourexpensedetail object to add.
     */
    protected function doAddDairypandllabourexpensedetail(ChildDairypandllabourexpensedetail $dairypandllabourexpensedetail)
    {
        $this->collDairypandllabourexpensedetails[]= $dairypandllabourexpensedetail;
        $dairypandllabourexpensedetail->setEmployeeroletype($this);
    }

    /**
     * @param  ChildDairypandllabourexpensedetail $dairypandllabourexpensedetail The ChildDairypandllabourexpensedetail object to remove.
     * @return $this|ChildEmployeeroletype The current object (for fluent API support)
     */
    public function removeDairypandllabourexpensedetail(ChildDairypandllabourexpensedetail $dairypandllabourexpensedetail)
    {
        if ($this->getDairypandllabourexpensedetails()->contains($dairypandllabourexpensedetail)) {
            $pos = $this->collDairypandllabourexpensedetails->search($dairypandllabourexpensedetail);
            $this->collDairypandllabourexpensedetails->remove($pos);
            if (null === $this->dairypandllabourexpensedetailsScheduledForDeletion) {
                $this->dairypandllabourexpensedetailsScheduledForDeletion = clone $this->collDairypandllabourexpensedetails;
                $this->dairypandllabourexpensedetailsScheduledForDeletion->clear();
            }
            $this->dairypandllabourexpensedetailsScheduledForDeletion[]= clone $dairypandllabourexpensedetail;
            $dairypandllabourexpensedetail->setEmployeeroletype(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employeeroletype is new, it will return
     * an empty collection; or if this Employeeroletype has previously
     * been saved, it will retrieve related Dairypandllabourexpensedetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employeeroletype.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDairypandllabourexpensedetail[] List of ChildDairypandllabourexpensedetail objects
     */
    public function getDairypandllabourexpensedetailsJoinDairypandl(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDairypandllabourexpensedetailQuery::create(null, $criteria);
        $query->joinWith('Dairypandl', $joinBehavior);

        return $this->getDairypandllabourexpensedetails($query, $con);
    }

    /**
     * Clears out the collEmployeeroles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEmployeeroles()
     */
    public function clearEmployeeroles()
    {
        $this->collEmployeeroles = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEmployeeroles collection loaded partially.
     */
    public function resetPartialEmployeeroles($v = true)
    {
        $this->collEmployeerolesPartial = $v;
    }

    /**
     * Initializes the collEmployeeroles collection.
     *
     * By default this just sets the collEmployeeroles collection to an empty array (like clearcollEmployeeroles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployeeroles($overrideExisting = true)
    {
        if (null !== $this->collEmployeeroles && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeeroleTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployeeroles = new $collectionClassName;
        $this->collEmployeeroles->setModel('\lwops\lwops\Employeerole');
    }

    /**
     * Gets an array of ChildEmployeerole objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployeeroletype is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployeerole[] List of ChildEmployeerole objects
     * @throws PropelException
     */
    public function getEmployeeroles(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeerolesPartial && !$this->isNew();
        if (null === $this->collEmployeeroles || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEmployeeroles) {
                // return empty collection
                $this->initEmployeeroles();
            } else {
                $collEmployeeroles = ChildEmployeeroleQuery::create(null, $criteria)
                    ->filterByEmployeeroletype($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeerolesPartial && count($collEmployeeroles)) {
                        $this->initEmployeeroles(false);

                        foreach ($collEmployeeroles as $obj) {
                            if (false == $this->collEmployeeroles->contains($obj)) {
                                $this->collEmployeeroles->append($obj);
                            }
                        }

                        $this->collEmployeerolesPartial = true;
                    }

                    return $collEmployeeroles;
                }

                if ($partial && $this->collEmployeeroles) {
                    foreach ($this->collEmployeeroles as $obj) {
                        if ($obj->isNew()) {
                            $collEmployeeroles[] = $obj;
                        }
                    }
                }

                $this->collEmployeeroles = $collEmployeeroles;
                $this->collEmployeerolesPartial = false;
            }
        }

        return $this->collEmployeeroles;
    }

    /**
     * Sets a collection of ChildEmployeerole objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $employeeroles A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployeeroletype The current object (for fluent API support)
     */
    public function setEmployeeroles(Collection $employeeroles, ConnectionInterface $con = null)
    {
        /** @var ChildEmployeerole[] $employeerolesToDelete */
        $employeerolesToDelete = $this->getEmployeeroles(new Criteria(), $con)->diff($employeeroles);


        $this->employeerolesScheduledForDeletion = $employeerolesToDelete;

        foreach ($employeerolesToDelete as $employeeroleRemoved) {
            $employeeroleRemoved->setEmployeeroletype(null);
        }

        $this->collEmployeeroles = null;
        foreach ($employeeroles as $employeerole) {
            $this->addEmployeerole($employeerole);
        }

        $this->collEmployeeroles = $employeeroles;
        $this->collEmployeerolesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Employeerole objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Employeerole objects.
     * @throws PropelException
     */
    public function countEmployeeroles(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeerolesPartial && !$this->isNew();
        if (null === $this->collEmployeeroles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployeeroles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployeeroles());
            }

            $query = ChildEmployeeroleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployeeroletype($this)
                ->count($con);
        }

        return count($this->collEmployeeroles);
    }

    /**
     * Method called to associate a ChildEmployeerole object to this object
     * through the ChildEmployeerole foreign key attribute.
     *
     * @param  ChildEmployeerole $l ChildEmployeerole
     * @return $this|\lwops\lwops\Employeeroletype The current object (for fluent API support)
     */
    public function addEmployeerole(ChildEmployeerole $l)
    {
        if ($this->collEmployeeroles === null) {
            $this->initEmployeeroles();
            $this->collEmployeerolesPartial = true;
        }

        if (!$this->collEmployeeroles->contains($l)) {
            $this->doAddEmployeerole($l);

            if ($this->employeerolesScheduledForDeletion and $this->employeerolesScheduledForDeletion->contains($l)) {
                $this->employeerolesScheduledForDeletion->remove($this->employeerolesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployeerole $employeerole The ChildEmployeerole object to add.
     */
    protected function doAddEmployeerole(ChildEmployeerole $employeerole)
    {
        $this->collEmployeeroles[]= $employeerole;
        $employeerole->setEmployeeroletype($this);
    }

    /**
     * @param  ChildEmployeerole $employeerole The ChildEmployeerole object to remove.
     * @return $this|ChildEmployeeroletype The current object (for fluent API support)
     */
    public function removeEmployeerole(ChildEmployeerole $employeerole)
    {
        if ($this->getEmployeeroles()->contains($employeerole)) {
            $pos = $this->collEmployeeroles->search($employeerole);
            $this->collEmployeeroles->remove($pos);
            if (null === $this->employeerolesScheduledForDeletion) {
                $this->employeerolesScheduledForDeletion = clone $this->collEmployeeroles;
                $this->employeerolesScheduledForDeletion->clear();
            }
            $this->employeerolesScheduledForDeletion[]= clone $employeerole;
            $employeerole->setEmployeeroletype(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employeeroletype is new, it will return
     * an empty collection; or if this Employeeroletype has previously
     * been saved, it will retrieve related Employeeroles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employeeroletype.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployeerole[] List of ChildEmployeerole objects
     */
    public function getEmployeerolesJoinEmployee(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeroleQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getEmployeeroles($query, $con);
    }

    /**
     * Clears out the collFishpandllabourexpensedetails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFishpandllabourexpensedetails()
     */
    public function clearFishpandllabourexpensedetails()
    {
        $this->collFishpandllabourexpensedetails = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collFishpandllabourexpensedetails collection loaded partially.
     */
    public function resetPartialFishpandllabourexpensedetails($v = true)
    {
        $this->collFishpandllabourexpensedetailsPartial = $v;
    }

    /**
     * Initializes the collFishpandllabourexpensedetails collection.
     *
     * By default this just sets the collFishpandllabourexpensedetails collection to an empty array (like clearcollFishpandllabourexpensedetails());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFishpandllabourexpensedetails($overrideExisting = true)
    {
        if (null !== $this->collFishpandllabourexpensedetails && !$overrideExisting) {
            return;
        }

        $collectionClassName = FishpandllabourexpensedetailTableMap::getTableMap()->getCollectionClassName();

        $this->collFishpandllabourexpensedetails = new $collectionClassName;
        $this->collFishpandllabourexpensedetails->setModel('\lwops\lwops\Fishpandllabourexpensedetail');
    }

    /**
     * Gets an array of ChildFishpandllabourexpensedetail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployeeroletype is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildFishpandllabourexpensedetail[] List of ChildFishpandllabourexpensedetail objects
     * @throws PropelException
     */
    public function getFishpandllabourexpensedetails(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFishpandllabourexpensedetailsPartial && !$this->isNew();
        if (null === $this->collFishpandllabourexpensedetails || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFishpandllabourexpensedetails) {
                // return empty collection
                $this->initFishpandllabourexpensedetails();
            } else {
                $collFishpandllabourexpensedetails = ChildFishpandllabourexpensedetailQuery::create(null, $criteria)
                    ->filterByEmployeeroletype($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFishpandllabourexpensedetailsPartial && count($collFishpandllabourexpensedetails)) {
                        $this->initFishpandllabourexpensedetails(false);

                        foreach ($collFishpandllabourexpensedetails as $obj) {
                            if (false == $this->collFishpandllabourexpensedetails->contains($obj)) {
                                $this->collFishpandllabourexpensedetails->append($obj);
                            }
                        }

                        $this->collFishpandllabourexpensedetailsPartial = true;
                    }

                    return $collFishpandllabourexpensedetails;
                }

                if ($partial && $this->collFishpandllabourexpensedetails) {
                    foreach ($this->collFishpandllabourexpensedetails as $obj) {
                        if ($obj->isNew()) {
                            $collFishpandllabourexpensedetails[] = $obj;
                        }
                    }
                }

                $this->collFishpandllabourexpensedetails = $collFishpandllabourexpensedetails;
                $this->collFishpandllabourexpensedetailsPartial = false;
            }
        }

        return $this->collFishpandllabourexpensedetails;
    }

    /**
     * Sets a collection of ChildFishpandllabourexpensedetail objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $fishpandllabourexpensedetails A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployeeroletype The current object (for fluent API support)
     */
    public function setFishpandllabourexpensedetails(Collection $fishpandllabourexpensedetails, ConnectionInterface $con = null)
    {
        /** @var ChildFishpandllabourexpensedetail[] $fishpandllabourexpensedetailsToDelete */
        $fishpandllabourexpensedetailsToDelete = $this->getFishpandllabourexpensedetails(new Criteria(), $con)->diff($fishpandllabourexpensedetails);


        $this->fishpandllabourexpensedetailsScheduledForDeletion = $fishpandllabourexpensedetailsToDelete;

        foreach ($fishpandllabourexpensedetailsToDelete as $fishpandllabourexpensedetailRemoved) {
            $fishpandllabourexpensedetailRemoved->setEmployeeroletype(null);
        }

        $this->collFishpandllabourexpensedetails = null;
        foreach ($fishpandllabourexpensedetails as $fishpandllabourexpensedetail) {
            $this->addFishpandllabourexpensedetail($fishpandllabourexpensedetail);
        }

        $this->collFishpandllabourexpensedetails = $fishpandllabourexpensedetails;
        $this->collFishpandllabourexpensedetailsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Fishpandllabourexpensedetail objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Fishpandllabourexpensedetail objects.
     * @throws PropelException
     */
    public function countFishpandllabourexpensedetails(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFishpandllabourexpensedetailsPartial && !$this->isNew();
        if (null === $this->collFishpandllabourexpensedetails || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFishpandllabourexpensedetails) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFishpandllabourexpensedetails());
            }

            $query = ChildFishpandllabourexpensedetailQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployeeroletype($this)
                ->count($con);
        }

        return count($this->collFishpandllabourexpensedetails);
    }

    /**
     * Method called to associate a ChildFishpandllabourexpensedetail object to this object
     * through the ChildFishpandllabourexpensedetail foreign key attribute.
     *
     * @param  ChildFishpandllabourexpensedetail $l ChildFishpandllabourexpensedetail
     * @return $this|\lwops\lwops\Employeeroletype The current object (for fluent API support)
     */
    public function addFishpandllabourexpensedetail(ChildFishpandllabourexpensedetail $l)
    {
        if ($this->collFishpandllabourexpensedetails === null) {
            $this->initFishpandllabourexpensedetails();
            $this->collFishpandllabourexpensedetailsPartial = true;
        }

        if (!$this->collFishpandllabourexpensedetails->contains($l)) {
            $this->doAddFishpandllabourexpensedetail($l);

            if ($this->fishpandllabourexpensedetailsScheduledForDeletion and $this->fishpandllabourexpensedetailsScheduledForDeletion->contains($l)) {
                $this->fishpandllabourexpensedetailsScheduledForDeletion->remove($this->fishpandllabourexpensedetailsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildFishpandllabourexpensedetail $fishpandllabourexpensedetail The ChildFishpandllabourexpensedetail object to add.
     */
    protected function doAddFishpandllabourexpensedetail(ChildFishpandllabourexpensedetail $fishpandllabourexpensedetail)
    {
        $this->collFishpandllabourexpensedetails[]= $fishpandllabourexpensedetail;
        $fishpandllabourexpensedetail->setEmployeeroletype($this);
    }

    /**
     * @param  ChildFishpandllabourexpensedetail $fishpandllabourexpensedetail The ChildFishpandllabourexpensedetail object to remove.
     * @return $this|ChildEmployeeroletype The current object (for fluent API support)
     */
    public function removeFishpandllabourexpensedetail(ChildFishpandllabourexpensedetail $fishpandllabourexpensedetail)
    {
        if ($this->getFishpandllabourexpensedetails()->contains($fishpandllabourexpensedetail)) {
            $pos = $this->collFishpandllabourexpensedetails->search($fishpandllabourexpensedetail);
            $this->collFishpandllabourexpensedetails->remove($pos);
            if (null === $this->fishpandllabourexpensedetailsScheduledForDeletion) {
                $this->fishpandllabourexpensedetailsScheduledForDeletion = clone $this->collFishpandllabourexpensedetails;
                $this->fishpandllabourexpensedetailsScheduledForDeletion->clear();
            }
            $this->fishpandllabourexpensedetailsScheduledForDeletion[]= clone $fishpandllabourexpensedetail;
            $fishpandllabourexpensedetail->setEmployeeroletype(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employeeroletype is new, it will return
     * an empty collection; or if this Employeeroletype has previously
     * been saved, it will retrieve related Fishpandllabourexpensedetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employeeroletype.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFishpandllabourexpensedetail[] List of ChildFishpandllabourexpensedetail objects
     */
    public function getFishpandllabourexpensedetailsJoinFishpandl(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFishpandllabourexpensedetailQuery::create(null, $criteria);
        $query->joinWith('Fishpandl', $joinBehavior);

        return $this->getFishpandllabourexpensedetails($query, $con);
    }

    /**
     * Clears out the collTeapandllabourexpensedetails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTeapandllabourexpensedetails()
     */
    public function clearTeapandllabourexpensedetails()
    {
        $this->collTeapandllabourexpensedetails = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTeapandllabourexpensedetails collection loaded partially.
     */
    public function resetPartialTeapandllabourexpensedetails($v = true)
    {
        $this->collTeapandllabourexpensedetailsPartial = $v;
    }

    /**
     * Initializes the collTeapandllabourexpensedetails collection.
     *
     * By default this just sets the collTeapandllabourexpensedetails collection to an empty array (like clearcollTeapandllabourexpensedetails());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTeapandllabourexpensedetails($overrideExisting = true)
    {
        if (null !== $this->collTeapandllabourexpensedetails && !$overrideExisting) {
            return;
        }

        $collectionClassName = TeapandllabourexpensedetailTableMap::getTableMap()->getCollectionClassName();

        $this->collTeapandllabourexpensedetails = new $collectionClassName;
        $this->collTeapandllabourexpensedetails->setModel('\lwops\lwops\Teapandllabourexpensedetail');
    }

    /**
     * Gets an array of ChildTeapandllabourexpensedetail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployeeroletype is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTeapandllabourexpensedetail[] List of ChildTeapandllabourexpensedetail objects
     * @throws PropelException
     */
    public function getTeapandllabourexpensedetails(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTeapandllabourexpensedetailsPartial && !$this->isNew();
        if (null === $this->collTeapandllabourexpensedetails || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTeapandllabourexpensedetails) {
                // return empty collection
                $this->initTeapandllabourexpensedetails();
            } else {
                $collTeapandllabourexpensedetails = ChildTeapandllabourexpensedetailQuery::create(null, $criteria)
                    ->filterByEmployeeroletype($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTeapandllabourexpensedetailsPartial && count($collTeapandllabourexpensedetails)) {
                        $this->initTeapandllabourexpensedetails(false);

                        foreach ($collTeapandllabourexpensedetails as $obj) {
                            if (false == $this->collTeapandllabourexpensedetails->contains($obj)) {
                                $this->collTeapandllabourexpensedetails->append($obj);
                            }
                        }

                        $this->collTeapandllabourexpensedetailsPartial = true;
                    }

                    return $collTeapandllabourexpensedetails;
                }

                if ($partial && $this->collTeapandllabourexpensedetails) {
                    foreach ($this->collTeapandllabourexpensedetails as $obj) {
                        if ($obj->isNew()) {
                            $collTeapandllabourexpensedetails[] = $obj;
                        }
                    }
                }

                $this->collTeapandllabourexpensedetails = $collTeapandllabourexpensedetails;
                $this->collTeapandllabourexpensedetailsPartial = false;
            }
        }

        return $this->collTeapandllabourexpensedetails;
    }

    /**
     * Sets a collection of ChildTeapandllabourexpensedetail objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $teapandllabourexpensedetails A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployeeroletype The current object (for fluent API support)
     */
    public function setTeapandllabourexpensedetails(Collection $teapandllabourexpensedetails, ConnectionInterface $con = null)
    {
        /** @var ChildTeapandllabourexpensedetail[] $teapandllabourexpensedetailsToDelete */
        $teapandllabourexpensedetailsToDelete = $this->getTeapandllabourexpensedetails(new Criteria(), $con)->diff($teapandllabourexpensedetails);


        $this->teapandllabourexpensedetailsScheduledForDeletion = $teapandllabourexpensedetailsToDelete;

        foreach ($teapandllabourexpensedetailsToDelete as $teapandllabourexpensedetailRemoved) {
            $teapandllabourexpensedetailRemoved->setEmployeeroletype(null);
        }

        $this->collTeapandllabourexpensedetails = null;
        foreach ($teapandllabourexpensedetails as $teapandllabourexpensedetail) {
            $this->addTeapandllabourexpensedetail($teapandllabourexpensedetail);
        }

        $this->collTeapandllabourexpensedetails = $teapandllabourexpensedetails;
        $this->collTeapandllabourexpensedetailsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Teapandllabourexpensedetail objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Teapandllabourexpensedetail objects.
     * @throws PropelException
     */
    public function countTeapandllabourexpensedetails(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTeapandllabourexpensedetailsPartial && !$this->isNew();
        if (null === $this->collTeapandllabourexpensedetails || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTeapandllabourexpensedetails) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTeapandllabourexpensedetails());
            }

            $query = ChildTeapandllabourexpensedetailQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployeeroletype($this)
                ->count($con);
        }

        return count($this->collTeapandllabourexpensedetails);
    }

    /**
     * Method called to associate a ChildTeapandllabourexpensedetail object to this object
     * through the ChildTeapandllabourexpensedetail foreign key attribute.
     *
     * @param  ChildTeapandllabourexpensedetail $l ChildTeapandllabourexpensedetail
     * @return $this|\lwops\lwops\Employeeroletype The current object (for fluent API support)
     */
    public function addTeapandllabourexpensedetail(ChildTeapandllabourexpensedetail $l)
    {
        if ($this->collTeapandllabourexpensedetails === null) {
            $this->initTeapandllabourexpensedetails();
            $this->collTeapandllabourexpensedetailsPartial = true;
        }

        if (!$this->collTeapandllabourexpensedetails->contains($l)) {
            $this->doAddTeapandllabourexpensedetail($l);

            if ($this->teapandllabourexpensedetailsScheduledForDeletion and $this->teapandllabourexpensedetailsScheduledForDeletion->contains($l)) {
                $this->teapandllabourexpensedetailsScheduledForDeletion->remove($this->teapandllabourexpensedetailsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTeapandllabourexpensedetail $teapandllabourexpensedetail The ChildTeapandllabourexpensedetail object to add.
     */
    protected function doAddTeapandllabourexpensedetail(ChildTeapandllabourexpensedetail $teapandllabourexpensedetail)
    {
        $this->collTeapandllabourexpensedetails[]= $teapandllabourexpensedetail;
        $teapandllabourexpensedetail->setEmployeeroletype($this);
    }

    /**
     * @param  ChildTeapandllabourexpensedetail $teapandllabourexpensedetail The ChildTeapandllabourexpensedetail object to remove.
     * @return $this|ChildEmployeeroletype The current object (for fluent API support)
     */
    public function removeTeapandllabourexpensedetail(ChildTeapandllabourexpensedetail $teapandllabourexpensedetail)
    {
        if ($this->getTeapandllabourexpensedetails()->contains($teapandllabourexpensedetail)) {
            $pos = $this->collTeapandllabourexpensedetails->search($teapandllabourexpensedetail);
            $this->collTeapandllabourexpensedetails->remove($pos);
            if (null === $this->teapandllabourexpensedetailsScheduledForDeletion) {
                $this->teapandllabourexpensedetailsScheduledForDeletion = clone $this->collTeapandllabourexpensedetails;
                $this->teapandllabourexpensedetailsScheduledForDeletion->clear();
            }
            $this->teapandllabourexpensedetailsScheduledForDeletion[]= clone $teapandllabourexpensedetail;
            $teapandllabourexpensedetail->setEmployeeroletype(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employeeroletype is new, it will return
     * an empty collection; or if this Employeeroletype has previously
     * been saved, it will retrieve related Teapandllabourexpensedetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employeeroletype.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTeapandllabourexpensedetail[] List of ChildTeapandllabourexpensedetail objects
     */
    public function getTeapandllabourexpensedetailsJoinTeapandl(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTeapandllabourexpensedetailQuery::create(null, $criteria);
        $query->joinWith('Teapandl', $joinBehavior);

        return $this->getTeapandllabourexpensedetails($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->oid = null;
        $this->role = null;
        $this->description = null;
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
            if ($this->collDairypandllabourexpensedetails) {
                foreach ($this->collDairypandllabourexpensedetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeeroles) {
                foreach ($this->collEmployeeroles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFishpandllabourexpensedetails) {
                foreach ($this->collFishpandllabourexpensedetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTeapandllabourexpensedetails) {
                foreach ($this->collTeapandllabourexpensedetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collDairypandllabourexpensedetails = null;
        $this->collEmployeeroles = null;
        $this->collFishpandllabourexpensedetails = null;
        $this->collTeapandllabourexpensedetails = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EmployeeroletypeTableMap::DEFAULT_STRING_FORMAT);
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
