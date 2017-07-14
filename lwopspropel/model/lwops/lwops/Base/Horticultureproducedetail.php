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
use lwops\lwops\Horticultureproducebed as ChildHorticultureproducebed;
use lwops\lwops\HorticultureproducebedQuery as ChildHorticultureproducebedQuery;
use lwops\lwops\Horticultureproducebrand as ChildHorticultureproducebrand;
use lwops\lwops\HorticultureproducebrandQuery as ChildHorticultureproducebrandQuery;
use lwops\lwops\Horticultureproducedetail as ChildHorticultureproducedetail;
use lwops\lwops\HorticultureproducedetailQuery as ChildHorticultureproducedetailQuery;
use lwops\lwops\Horticultureproduceparent as ChildHorticultureproduceparent;
use lwops\lwops\HorticultureproduceparentQuery as ChildHorticultureproduceparentQuery;
use lwops\lwops\Horticultureproducestock as ChildHorticultureproducestock;
use lwops\lwops\HorticultureproducestockQuery as ChildHorticultureproducestockQuery;
use lwops\lwops\Map\HorticultureproducebedTableMap;
use lwops\lwops\Map\HorticultureproducedetailTableMap;
use lwops\lwops\Map\HorticultureproducestockTableMap;

/**
 * Base class that represents a row from the 'horticultureproducedetail' table.
 *
 *
 *
 * @package    propel.generator.lwops.lwops.Base
 */
abstract class Horticultureproducedetail implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\lwops\\lwops\\Map\\HorticultureproducedetailTableMap';


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
     * The value for the horticultureproduceparentoid field.
     *
     * @var        int
     */
    protected $horticultureproduceparentoid;

    /**
     * The value for the brand field.
     *
     * @var        string
     */
    protected $brand;

    /**
     * The value for the variety field.
     *
     * @var        string
     */
    protected $variety;

    /**
     * The value for the directplanting field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $directplanting;

    /**
     * The value for the nurseryduration field.
     *
     * @var        int
     */
    protected $nurseryduration;

    /**
     * The value for the avgmaturitydays field.
     *
     * @var        int
     */
    protected $avgmaturitydays;

    /**
     * The value for the harvestdurationdays field.
     *
     * @var        int
     */
    protected $harvestdurationdays;

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
     * @var        ChildHorticultureproduceparent
     */
    protected $aHorticultureproduceparent;

    /**
     * @var        ChildHorticultureproducebrand
     */
    protected $aHorticultureproducebrand;

    /**
     * @var        ObjectCollection|ChildHorticultureproducebed[] Collection to store aggregation of ChildHorticultureproducebed objects.
     */
    protected $collHorticultureproducebeds;
    protected $collHorticultureproducebedsPartial;

    /**
     * @var        ObjectCollection|ChildHorticultureproducestock[] Collection to store aggregation of ChildHorticultureproducestock objects.
     */
    protected $collHorticultureproducestocks;
    protected $collHorticultureproducestocksPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildHorticultureproducebed[]
     */
    protected $horticultureproducebedsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildHorticultureproducestock[]
     */
    protected $horticultureproducestocksScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->directplanting = 0;
    }

    /**
     * Initializes internal state of lwops\lwops\Base\Horticultureproducedetail object.
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
     * Compares this with another <code>Horticultureproducedetail</code> instance.  If
     * <code>obj</code> is an instance of <code>Horticultureproducedetail</code>, delegates to
     * <code>equals(Horticultureproducedetail)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Horticultureproducedetail The current object, for fluid interface
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
     * Get the [horticultureproduceparentoid] column value.
     *
     * @return int
     */
    public function getHorticultureproduceparentoid()
    {
        return $this->horticultureproduceparentoid;
    }

    /**
     * Get the [brand] column value.
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Get the [variety] column value.
     *
     * @return string
     */
    public function getVariety()
    {
        return $this->variety;
    }

    /**
     * Get the [directplanting] column value.
     *
     * @return int
     */
    public function getDirectplanting()
    {
        return $this->directplanting;
    }

    /**
     * Get the [nurseryduration] column value.
     *
     * @return int
     */
    public function getNurseryduration()
    {
        return $this->nurseryduration;
    }

    /**
     * Get the [avgmaturitydays] column value.
     *
     * @return int
     */
    public function getAvgmaturitydays()
    {
        return $this->avgmaturitydays;
    }

    /**
     * Get the [harvestdurationdays] column value.
     *
     * @return int
     */
    public function getHarvestdurationdays()
    {
        return $this->harvestdurationdays;
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
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object (for fluent API support)
     */
    public function setOid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oid !== $v) {
            $this->oid = $v;
            $this->modifiedColumns[HorticultureproducedetailTableMap::COL_OID] = true;
        }

        return $this;
    } // setOid()

    /**
     * Set the value of [horticultureproduceparentoid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object (for fluent API support)
     */
    public function setHorticultureproduceparentoid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->horticultureproduceparentoid !== $v) {
            $this->horticultureproduceparentoid = $v;
            $this->modifiedColumns[HorticultureproducedetailTableMap::COL_HORTICULTUREPRODUCEPARENTOID] = true;
        }

        if ($this->aHorticultureproduceparent !== null && $this->aHorticultureproduceparent->getOid() !== $v) {
            $this->aHorticultureproduceparent = null;
        }

        return $this;
    } // setHorticultureproduceparentoid()

    /**
     * Set the value of [brand] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object (for fluent API support)
     */
    public function setBrand($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand !== $v) {
            $this->brand = $v;
            $this->modifiedColumns[HorticultureproducedetailTableMap::COL_BRAND] = true;
        }

        if ($this->aHorticultureproducebrand !== null && $this->aHorticultureproducebrand->getName() !== $v) {
            $this->aHorticultureproducebrand = null;
        }

        return $this;
    } // setBrand()

    /**
     * Set the value of [variety] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object (for fluent API support)
     */
    public function setVariety($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->variety !== $v) {
            $this->variety = $v;
            $this->modifiedColumns[HorticultureproducedetailTableMap::COL_VARIETY] = true;
        }

        return $this;
    } // setVariety()

    /**
     * Set the value of [directplanting] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object (for fluent API support)
     */
    public function setDirectplanting($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->directplanting !== $v) {
            $this->directplanting = $v;
            $this->modifiedColumns[HorticultureproducedetailTableMap::COL_DIRECTPLANTING] = true;
        }

        return $this;
    } // setDirectplanting()

    /**
     * Set the value of [nurseryduration] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object (for fluent API support)
     */
    public function setNurseryduration($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->nurseryduration !== $v) {
            $this->nurseryduration = $v;
            $this->modifiedColumns[HorticultureproducedetailTableMap::COL_NURSERYDURATION] = true;
        }

        return $this;
    } // setNurseryduration()

    /**
     * Set the value of [avgmaturitydays] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object (for fluent API support)
     */
    public function setAvgmaturitydays($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->avgmaturitydays !== $v) {
            $this->avgmaturitydays = $v;
            $this->modifiedColumns[HorticultureproducedetailTableMap::COL_AVGMATURITYDAYS] = true;
        }

        return $this;
    } // setAvgmaturitydays()

    /**
     * Set the value of [harvestdurationdays] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object (for fluent API support)
     */
    public function setHarvestdurationdays($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->harvestdurationdays !== $v) {
            $this->harvestdurationdays = $v;
            $this->modifiedColumns[HorticultureproducedetailTableMap::COL_HARVESTDURATIONDAYS] = true;
        }

        return $this;
    } // setHarvestdurationdays()

    /**
     * Sets the value of [createtmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object (for fluent API support)
     */
    public function setCreatetmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->createtmstp !== null || $dt !== null) {
            if ($this->createtmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->createtmstp->format("Y-m-d H:i:s.u")) {
                $this->createtmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HorticultureproducedetailTableMap::COL_CREATETMSTP] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatetmstp()

    /**
     * Sets the value of [updttmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object (for fluent API support)
     */
    public function setUpdttmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updttmstp !== null || $dt !== null) {
            if ($this->updttmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updttmstp->format("Y-m-d H:i:s.u")) {
                $this->updttmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HorticultureproducedetailTableMap::COL_UPDTTMSTP] = true;
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
            if ($this->directplanting !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : HorticultureproducedetailTableMap::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->oid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : HorticultureproducedetailTableMap::translateFieldName('Horticultureproduceparentoid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->horticultureproduceparentoid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : HorticultureproducedetailTableMap::translateFieldName('Brand', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : HorticultureproducedetailTableMap::translateFieldName('Variety', TableMap::TYPE_PHPNAME, $indexType)];
            $this->variety = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : HorticultureproducedetailTableMap::translateFieldName('Directplanting', TableMap::TYPE_PHPNAME, $indexType)];
            $this->directplanting = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : HorticultureproducedetailTableMap::translateFieldName('Nurseryduration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nurseryduration = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : HorticultureproducedetailTableMap::translateFieldName('Avgmaturitydays', TableMap::TYPE_PHPNAME, $indexType)];
            $this->avgmaturitydays = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : HorticultureproducedetailTableMap::translateFieldName('Harvestdurationdays', TableMap::TYPE_PHPNAME, $indexType)];
            $this->harvestdurationdays = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : HorticultureproducedetailTableMap::translateFieldName('Createtmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->createtmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : HorticultureproducedetailTableMap::translateFieldName('Updttmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updttmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = HorticultureproducedetailTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\lwops\\lwops\\Horticultureproducedetail'), 0, $e);
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
        if ($this->aHorticultureproduceparent !== null && $this->horticultureproduceparentoid !== $this->aHorticultureproduceparent->getOid()) {
            $this->aHorticultureproduceparent = null;
        }
        if ($this->aHorticultureproducebrand !== null && $this->brand !== $this->aHorticultureproducebrand->getName()) {
            $this->aHorticultureproducebrand = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(HorticultureproducedetailTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildHorticultureproducedetailQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aHorticultureproduceparent = null;
            $this->aHorticultureproducebrand = null;
            $this->collHorticultureproducebeds = null;

            $this->collHorticultureproducestocks = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Horticultureproducedetail::setDeleted()
     * @see Horticultureproducedetail::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducedetailTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildHorticultureproducedetailQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducedetailTableMap::DATABASE_NAME);
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
                HorticultureproducedetailTableMap::addInstanceToPool($this);
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

            if ($this->aHorticultureproduceparent !== null) {
                if ($this->aHorticultureproduceparent->isModified() || $this->aHorticultureproduceparent->isNew()) {
                    $affectedRows += $this->aHorticultureproduceparent->save($con);
                }
                $this->setHorticultureproduceparent($this->aHorticultureproduceparent);
            }

            if ($this->aHorticultureproducebrand !== null) {
                if ($this->aHorticultureproducebrand->isModified() || $this->aHorticultureproducebrand->isNew()) {
                    $affectedRows += $this->aHorticultureproducebrand->save($con);
                }
                $this->setHorticultureproducebrand($this->aHorticultureproducebrand);
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

            if ($this->horticultureproducebedsScheduledForDeletion !== null) {
                if (!$this->horticultureproducebedsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\HorticultureproducebedQuery::create()
                        ->filterByPrimaryKeys($this->horticultureproducebedsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->horticultureproducebedsScheduledForDeletion = null;
                }
            }

            if ($this->collHorticultureproducebeds !== null) {
                foreach ($this->collHorticultureproducebeds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->horticultureproducestocksScheduledForDeletion !== null) {
                if (!$this->horticultureproducestocksScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\HorticultureproducestockQuery::create()
                        ->filterByPrimaryKeys($this->horticultureproducestocksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->horticultureproducestocksScheduledForDeletion = null;
                }
            }

            if ($this->collHorticultureproducestocks !== null) {
                foreach ($this->collHorticultureproducestocks as $referrerFK) {
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

        $this->modifiedColumns[HorticultureproducedetailTableMap::COL_OID] = true;
        if (null !== $this->oid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . HorticultureproducedetailTableMap::COL_OID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_OID)) {
            $modifiedColumns[':p' . $index++]  = 'oid';
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_HORTICULTUREPRODUCEPARENTOID)) {
            $modifiedColumns[':p' . $index++]  = 'horticultureProduceParentoid';
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_BRAND)) {
            $modifiedColumns[':p' . $index++]  = 'brand';
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_VARIETY)) {
            $modifiedColumns[':p' . $index++]  = 'variety';
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_DIRECTPLANTING)) {
            $modifiedColumns[':p' . $index++]  = 'directPlanting';
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_NURSERYDURATION)) {
            $modifiedColumns[':p' . $index++]  = 'nurseryDuration';
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_AVGMATURITYDAYS)) {
            $modifiedColumns[':p' . $index++]  = 'avgMaturityDays';
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_HARVESTDURATIONDAYS)) {
            $modifiedColumns[':p' . $index++]  = 'harvestDurationDays';
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_CREATETMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'createTmstp';
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_UPDTTMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'updtTmstp';
        }

        $sql = sprintf(
            'INSERT INTO horticultureproducedetail (%s) VALUES (%s)',
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
                    case 'horticultureProduceParentoid':
                        $stmt->bindValue($identifier, $this->horticultureproduceparentoid, PDO::PARAM_INT);
                        break;
                    case 'brand':
                        $stmt->bindValue($identifier, $this->brand, PDO::PARAM_STR);
                        break;
                    case 'variety':
                        $stmt->bindValue($identifier, $this->variety, PDO::PARAM_STR);
                        break;
                    case 'directPlanting':
                        $stmt->bindValue($identifier, $this->directplanting, PDO::PARAM_INT);
                        break;
                    case 'nurseryDuration':
                        $stmt->bindValue($identifier, $this->nurseryduration, PDO::PARAM_INT);
                        break;
                    case 'avgMaturityDays':
                        $stmt->bindValue($identifier, $this->avgmaturitydays, PDO::PARAM_INT);
                        break;
                    case 'harvestDurationDays':
                        $stmt->bindValue($identifier, $this->harvestdurationdays, PDO::PARAM_INT);
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
        $pos = HorticultureproducedetailTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getHorticultureproduceparentoid();
                break;
            case 2:
                return $this->getBrand();
                break;
            case 3:
                return $this->getVariety();
                break;
            case 4:
                return $this->getDirectplanting();
                break;
            case 5:
                return $this->getNurseryduration();
                break;
            case 6:
                return $this->getAvgmaturitydays();
                break;
            case 7:
                return $this->getHarvestdurationdays();
                break;
            case 8:
                return $this->getCreatetmstp();
                break;
            case 9:
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

        if (isset($alreadyDumpedObjects['Horticultureproducedetail'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Horticultureproducedetail'][$this->hashCode()] = true;
        $keys = HorticultureproducedetailTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOid(),
            $keys[1] => $this->getHorticultureproduceparentoid(),
            $keys[2] => $this->getBrand(),
            $keys[3] => $this->getVariety(),
            $keys[4] => $this->getDirectplanting(),
            $keys[5] => $this->getNurseryduration(),
            $keys[6] => $this->getAvgmaturitydays(),
            $keys[7] => $this->getHarvestdurationdays(),
            $keys[8] => $this->getCreatetmstp(),
            $keys[9] => $this->getUpdttmstp(),
        );
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aHorticultureproduceparent) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'horticultureproduceparent';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'horticultureproduceparent';
                        break;
                    default:
                        $key = 'Horticultureproduceparent';
                }

                $result[$key] = $this->aHorticultureproduceparent->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aHorticultureproducebrand) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'horticultureproducebrand';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'horticultureproducebrand';
                        break;
                    default:
                        $key = 'Horticultureproducebrand';
                }

                $result[$key] = $this->aHorticultureproducebrand->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collHorticultureproducebeds) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'horticultureproducebeds';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'horticultureproducebeds';
                        break;
                    default:
                        $key = 'Horticultureproducebeds';
                }

                $result[$key] = $this->collHorticultureproducebeds->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collHorticultureproducestocks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'horticultureproducestocks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'horticultureproducestocks';
                        break;
                    default:
                        $key = 'Horticultureproducestocks';
                }

                $result[$key] = $this->collHorticultureproducestocks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\lwops\lwops\Horticultureproducedetail
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = HorticultureproducedetailTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\lwops\lwops\Horticultureproducedetail
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setOid($value);
                break;
            case 1:
                $this->setHorticultureproduceparentoid($value);
                break;
            case 2:
                $this->setBrand($value);
                break;
            case 3:
                $this->setVariety($value);
                break;
            case 4:
                $this->setDirectplanting($value);
                break;
            case 5:
                $this->setNurseryduration($value);
                break;
            case 6:
                $this->setAvgmaturitydays($value);
                break;
            case 7:
                $this->setHarvestdurationdays($value);
                break;
            case 8:
                $this->setCreatetmstp($value);
                break;
            case 9:
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
        $keys = HorticultureproducedetailTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setHorticultureproduceparentoid($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setBrand($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setVariety($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDirectplanting($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setNurseryduration($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAvgmaturitydays($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setHarvestdurationdays($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCreatetmstp($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUpdttmstp($arr[$keys[9]]);
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
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object, for fluid interface
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
        $criteria = new Criteria(HorticultureproducedetailTableMap::DATABASE_NAME);

        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_OID)) {
            $criteria->add(HorticultureproducedetailTableMap::COL_OID, $this->oid);
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_HORTICULTUREPRODUCEPARENTOID)) {
            $criteria->add(HorticultureproducedetailTableMap::COL_HORTICULTUREPRODUCEPARENTOID, $this->horticultureproduceparentoid);
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_BRAND)) {
            $criteria->add(HorticultureproducedetailTableMap::COL_BRAND, $this->brand);
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_VARIETY)) {
            $criteria->add(HorticultureproducedetailTableMap::COL_VARIETY, $this->variety);
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_DIRECTPLANTING)) {
            $criteria->add(HorticultureproducedetailTableMap::COL_DIRECTPLANTING, $this->directplanting);
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_NURSERYDURATION)) {
            $criteria->add(HorticultureproducedetailTableMap::COL_NURSERYDURATION, $this->nurseryduration);
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_AVGMATURITYDAYS)) {
            $criteria->add(HorticultureproducedetailTableMap::COL_AVGMATURITYDAYS, $this->avgmaturitydays);
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_HARVESTDURATIONDAYS)) {
            $criteria->add(HorticultureproducedetailTableMap::COL_HARVESTDURATIONDAYS, $this->harvestdurationdays);
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_CREATETMSTP)) {
            $criteria->add(HorticultureproducedetailTableMap::COL_CREATETMSTP, $this->createtmstp);
        }
        if ($this->isColumnModified(HorticultureproducedetailTableMap::COL_UPDTTMSTP)) {
            $criteria->add(HorticultureproducedetailTableMap::COL_UPDTTMSTP, $this->updttmstp);
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
        $criteria = ChildHorticultureproducedetailQuery::create();
        $criteria->add(HorticultureproducedetailTableMap::COL_OID, $this->oid);

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
     * @param      object $copyObj An object of \lwops\lwops\Horticultureproducedetail (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setHorticultureproduceparentoid($this->getHorticultureproduceparentoid());
        $copyObj->setBrand($this->getBrand());
        $copyObj->setVariety($this->getVariety());
        $copyObj->setDirectplanting($this->getDirectplanting());
        $copyObj->setNurseryduration($this->getNurseryduration());
        $copyObj->setAvgmaturitydays($this->getAvgmaturitydays());
        $copyObj->setHarvestdurationdays($this->getHarvestdurationdays());
        $copyObj->setCreatetmstp($this->getCreatetmstp());
        $copyObj->setUpdttmstp($this->getUpdttmstp());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getHorticultureproducebeds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHorticultureproducebed($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getHorticultureproducestocks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHorticultureproducestock($relObj->copy($deepCopy));
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
     * @return \lwops\lwops\Horticultureproducedetail Clone of current object.
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
     * Declares an association between this object and a ChildHorticultureproduceparent object.
     *
     * @param  ChildHorticultureproduceparent $v
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object (for fluent API support)
     * @throws PropelException
     */
    public function setHorticultureproduceparent(ChildHorticultureproduceparent $v = null)
    {
        if ($v === null) {
            $this->setHorticultureproduceparentoid(NULL);
        } else {
            $this->setHorticultureproduceparentoid($v->getOid());
        }

        $this->aHorticultureproduceparent = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildHorticultureproduceparent object, it will not be re-added.
        if ($v !== null) {
            $v->addHorticultureproducedetail($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildHorticultureproduceparent object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildHorticultureproduceparent The associated ChildHorticultureproduceparent object.
     * @throws PropelException
     */
    public function getHorticultureproduceparent(ConnectionInterface $con = null)
    {
        if ($this->aHorticultureproduceparent === null && ($this->horticultureproduceparentoid !== null)) {
            $this->aHorticultureproduceparent = ChildHorticultureproduceparentQuery::create()->findPk($this->horticultureproduceparentoid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aHorticultureproduceparent->addHorticultureproducedetails($this);
             */
        }

        return $this->aHorticultureproduceparent;
    }

    /**
     * Declares an association between this object and a ChildHorticultureproducebrand object.
     *
     * @param  ChildHorticultureproducebrand $v
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object (for fluent API support)
     * @throws PropelException
     */
    public function setHorticultureproducebrand(ChildHorticultureproducebrand $v = null)
    {
        if ($v === null) {
            $this->setBrand(NULL);
        } else {
            $this->setBrand($v->getName());
        }

        $this->aHorticultureproducebrand = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildHorticultureproducebrand object, it will not be re-added.
        if ($v !== null) {
            $v->addHorticultureproducedetail($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildHorticultureproducebrand object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildHorticultureproducebrand The associated ChildHorticultureproducebrand object.
     * @throws PropelException
     */
    public function getHorticultureproducebrand(ConnectionInterface $con = null)
    {
        if ($this->aHorticultureproducebrand === null && (($this->brand !== "" && $this->brand !== null))) {
            $this->aHorticultureproducebrand = ChildHorticultureproducebrandQuery::create()->findPk($this->brand, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aHorticultureproducebrand->addHorticultureproducedetails($this);
             */
        }

        return $this->aHorticultureproducebrand;
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
        if ('Horticultureproducebed' == $relationName) {
            $this->initHorticultureproducebeds();
            return;
        }
        if ('Horticultureproducestock' == $relationName) {
            $this->initHorticultureproducestocks();
            return;
        }
    }

    /**
     * Clears out the collHorticultureproducebeds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addHorticultureproducebeds()
     */
    public function clearHorticultureproducebeds()
    {
        $this->collHorticultureproducebeds = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collHorticultureproducebeds collection loaded partially.
     */
    public function resetPartialHorticultureproducebeds($v = true)
    {
        $this->collHorticultureproducebedsPartial = $v;
    }

    /**
     * Initializes the collHorticultureproducebeds collection.
     *
     * By default this just sets the collHorticultureproducebeds collection to an empty array (like clearcollHorticultureproducebeds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initHorticultureproducebeds($overrideExisting = true)
    {
        if (null !== $this->collHorticultureproducebeds && !$overrideExisting) {
            return;
        }

        $collectionClassName = HorticultureproducebedTableMap::getTableMap()->getCollectionClassName();

        $this->collHorticultureproducebeds = new $collectionClassName;
        $this->collHorticultureproducebeds->setModel('\lwops\lwops\Horticultureproducebed');
    }

    /**
     * Gets an array of ChildHorticultureproducebed objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildHorticultureproducedetail is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildHorticultureproducebed[] List of ChildHorticultureproducebed objects
     * @throws PropelException
     */
    public function getHorticultureproducebeds(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collHorticultureproducebedsPartial && !$this->isNew();
        if (null === $this->collHorticultureproducebeds || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collHorticultureproducebeds) {
                // return empty collection
                $this->initHorticultureproducebeds();
            } else {
                $collHorticultureproducebeds = ChildHorticultureproducebedQuery::create(null, $criteria)
                    ->filterByHorticultureproducedetail($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collHorticultureproducebedsPartial && count($collHorticultureproducebeds)) {
                        $this->initHorticultureproducebeds(false);

                        foreach ($collHorticultureproducebeds as $obj) {
                            if (false == $this->collHorticultureproducebeds->contains($obj)) {
                                $this->collHorticultureproducebeds->append($obj);
                            }
                        }

                        $this->collHorticultureproducebedsPartial = true;
                    }

                    return $collHorticultureproducebeds;
                }

                if ($partial && $this->collHorticultureproducebeds) {
                    foreach ($this->collHorticultureproducebeds as $obj) {
                        if ($obj->isNew()) {
                            $collHorticultureproducebeds[] = $obj;
                        }
                    }
                }

                $this->collHorticultureproducebeds = $collHorticultureproducebeds;
                $this->collHorticultureproducebedsPartial = false;
            }
        }

        return $this->collHorticultureproducebeds;
    }

    /**
     * Sets a collection of ChildHorticultureproducebed objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $horticultureproducebeds A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildHorticultureproducedetail The current object (for fluent API support)
     */
    public function setHorticultureproducebeds(Collection $horticultureproducebeds, ConnectionInterface $con = null)
    {
        /** @var ChildHorticultureproducebed[] $horticultureproducebedsToDelete */
        $horticultureproducebedsToDelete = $this->getHorticultureproducebeds(new Criteria(), $con)->diff($horticultureproducebeds);


        $this->horticultureproducebedsScheduledForDeletion = $horticultureproducebedsToDelete;

        foreach ($horticultureproducebedsToDelete as $horticultureproducebedRemoved) {
            $horticultureproducebedRemoved->setHorticultureproducedetail(null);
        }

        $this->collHorticultureproducebeds = null;
        foreach ($horticultureproducebeds as $horticultureproducebed) {
            $this->addHorticultureproducebed($horticultureproducebed);
        }

        $this->collHorticultureproducebeds = $horticultureproducebeds;
        $this->collHorticultureproducebedsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Horticultureproducebed objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Horticultureproducebed objects.
     * @throws PropelException
     */
    public function countHorticultureproducebeds(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collHorticultureproducebedsPartial && !$this->isNew();
        if (null === $this->collHorticultureproducebeds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collHorticultureproducebeds) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getHorticultureproducebeds());
            }

            $query = ChildHorticultureproducebedQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByHorticultureproducedetail($this)
                ->count($con);
        }

        return count($this->collHorticultureproducebeds);
    }

    /**
     * Method called to associate a ChildHorticultureproducebed object to this object
     * through the ChildHorticultureproducebed foreign key attribute.
     *
     * @param  ChildHorticultureproducebed $l ChildHorticultureproducebed
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object (for fluent API support)
     */
    public function addHorticultureproducebed(ChildHorticultureproducebed $l)
    {
        if ($this->collHorticultureproducebeds === null) {
            $this->initHorticultureproducebeds();
            $this->collHorticultureproducebedsPartial = true;
        }

        if (!$this->collHorticultureproducebeds->contains($l)) {
            $this->doAddHorticultureproducebed($l);

            if ($this->horticultureproducebedsScheduledForDeletion and $this->horticultureproducebedsScheduledForDeletion->contains($l)) {
                $this->horticultureproducebedsScheduledForDeletion->remove($this->horticultureproducebedsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildHorticultureproducebed $horticultureproducebed The ChildHorticultureproducebed object to add.
     */
    protected function doAddHorticultureproducebed(ChildHorticultureproducebed $horticultureproducebed)
    {
        $this->collHorticultureproducebeds[]= $horticultureproducebed;
        $horticultureproducebed->setHorticultureproducedetail($this);
    }

    /**
     * @param  ChildHorticultureproducebed $horticultureproducebed The ChildHorticultureproducebed object to remove.
     * @return $this|ChildHorticultureproducedetail The current object (for fluent API support)
     */
    public function removeHorticultureproducebed(ChildHorticultureproducebed $horticultureproducebed)
    {
        if ($this->getHorticultureproducebeds()->contains($horticultureproducebed)) {
            $pos = $this->collHorticultureproducebeds->search($horticultureproducebed);
            $this->collHorticultureproducebeds->remove($pos);
            if (null === $this->horticultureproducebedsScheduledForDeletion) {
                $this->horticultureproducebedsScheduledForDeletion = clone $this->collHorticultureproducebeds;
                $this->horticultureproducebedsScheduledForDeletion->clear();
            }
            $this->horticultureproducebedsScheduledForDeletion[]= clone $horticultureproducebed;
            $horticultureproducebed->setHorticultureproducedetail(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Horticultureproducedetail is new, it will return
     * an empty collection; or if this Horticultureproducedetail has previously
     * been saved, it will retrieve related Horticultureproducebeds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Horticultureproducedetail.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildHorticultureproducebed[] List of ChildHorticultureproducebed objects
     */
    public function getHorticultureproducebedsJoinHorticulturebed(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildHorticultureproducebedQuery::create(null, $criteria);
        $query->joinWith('Horticulturebed', $joinBehavior);

        return $this->getHorticultureproducebeds($query, $con);
    }

    /**
     * Clears out the collHorticultureproducestocks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addHorticultureproducestocks()
     */
    public function clearHorticultureproducestocks()
    {
        $this->collHorticultureproducestocks = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collHorticultureproducestocks collection loaded partially.
     */
    public function resetPartialHorticultureproducestocks($v = true)
    {
        $this->collHorticultureproducestocksPartial = $v;
    }

    /**
     * Initializes the collHorticultureproducestocks collection.
     *
     * By default this just sets the collHorticultureproducestocks collection to an empty array (like clearcollHorticultureproducestocks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initHorticultureproducestocks($overrideExisting = true)
    {
        if (null !== $this->collHorticultureproducestocks && !$overrideExisting) {
            return;
        }

        $collectionClassName = HorticultureproducestockTableMap::getTableMap()->getCollectionClassName();

        $this->collHorticultureproducestocks = new $collectionClassName;
        $this->collHorticultureproducestocks->setModel('\lwops\lwops\Horticultureproducestock');
    }

    /**
     * Gets an array of ChildHorticultureproducestock objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildHorticultureproducedetail is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildHorticultureproducestock[] List of ChildHorticultureproducestock objects
     * @throws PropelException
     */
    public function getHorticultureproducestocks(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collHorticultureproducestocksPartial && !$this->isNew();
        if (null === $this->collHorticultureproducestocks || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collHorticultureproducestocks) {
                // return empty collection
                $this->initHorticultureproducestocks();
            } else {
                $collHorticultureproducestocks = ChildHorticultureproducestockQuery::create(null, $criteria)
                    ->filterByHorticultureproducedetail($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collHorticultureproducestocksPartial && count($collHorticultureproducestocks)) {
                        $this->initHorticultureproducestocks(false);

                        foreach ($collHorticultureproducestocks as $obj) {
                            if (false == $this->collHorticultureproducestocks->contains($obj)) {
                                $this->collHorticultureproducestocks->append($obj);
                            }
                        }

                        $this->collHorticultureproducestocksPartial = true;
                    }

                    return $collHorticultureproducestocks;
                }

                if ($partial && $this->collHorticultureproducestocks) {
                    foreach ($this->collHorticultureproducestocks as $obj) {
                        if ($obj->isNew()) {
                            $collHorticultureproducestocks[] = $obj;
                        }
                    }
                }

                $this->collHorticultureproducestocks = $collHorticultureproducestocks;
                $this->collHorticultureproducestocksPartial = false;
            }
        }

        return $this->collHorticultureproducestocks;
    }

    /**
     * Sets a collection of ChildHorticultureproducestock objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $horticultureproducestocks A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildHorticultureproducedetail The current object (for fluent API support)
     */
    public function setHorticultureproducestocks(Collection $horticultureproducestocks, ConnectionInterface $con = null)
    {
        /** @var ChildHorticultureproducestock[] $horticultureproducestocksToDelete */
        $horticultureproducestocksToDelete = $this->getHorticultureproducestocks(new Criteria(), $con)->diff($horticultureproducestocks);


        $this->horticultureproducestocksScheduledForDeletion = $horticultureproducestocksToDelete;

        foreach ($horticultureproducestocksToDelete as $horticultureproducestockRemoved) {
            $horticultureproducestockRemoved->setHorticultureproducedetail(null);
        }

        $this->collHorticultureproducestocks = null;
        foreach ($horticultureproducestocks as $horticultureproducestock) {
            $this->addHorticultureproducestock($horticultureproducestock);
        }

        $this->collHorticultureproducestocks = $horticultureproducestocks;
        $this->collHorticultureproducestocksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Horticultureproducestock objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Horticultureproducestock objects.
     * @throws PropelException
     */
    public function countHorticultureproducestocks(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collHorticultureproducestocksPartial && !$this->isNew();
        if (null === $this->collHorticultureproducestocks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collHorticultureproducestocks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getHorticultureproducestocks());
            }

            $query = ChildHorticultureproducestockQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByHorticultureproducedetail($this)
                ->count($con);
        }

        return count($this->collHorticultureproducestocks);
    }

    /**
     * Method called to associate a ChildHorticultureproducestock object to this object
     * through the ChildHorticultureproducestock foreign key attribute.
     *
     * @param  ChildHorticultureproducestock $l ChildHorticultureproducestock
     * @return $this|\lwops\lwops\Horticultureproducedetail The current object (for fluent API support)
     */
    public function addHorticultureproducestock(ChildHorticultureproducestock $l)
    {
        if ($this->collHorticultureproducestocks === null) {
            $this->initHorticultureproducestocks();
            $this->collHorticultureproducestocksPartial = true;
        }

        if (!$this->collHorticultureproducestocks->contains($l)) {
            $this->doAddHorticultureproducestock($l);

            if ($this->horticultureproducestocksScheduledForDeletion and $this->horticultureproducestocksScheduledForDeletion->contains($l)) {
                $this->horticultureproducestocksScheduledForDeletion->remove($this->horticultureproducestocksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildHorticultureproducestock $horticultureproducestock The ChildHorticultureproducestock object to add.
     */
    protected function doAddHorticultureproducestock(ChildHorticultureproducestock $horticultureproducestock)
    {
        $this->collHorticultureproducestocks[]= $horticultureproducestock;
        $horticultureproducestock->setHorticultureproducedetail($this);
    }

    /**
     * @param  ChildHorticultureproducestock $horticultureproducestock The ChildHorticultureproducestock object to remove.
     * @return $this|ChildHorticultureproducedetail The current object (for fluent API support)
     */
    public function removeHorticultureproducestock(ChildHorticultureproducestock $horticultureproducestock)
    {
        if ($this->getHorticultureproducestocks()->contains($horticultureproducestock)) {
            $pos = $this->collHorticultureproducestocks->search($horticultureproducestock);
            $this->collHorticultureproducestocks->remove($pos);
            if (null === $this->horticultureproducestocksScheduledForDeletion) {
                $this->horticultureproducestocksScheduledForDeletion = clone $this->collHorticultureproducestocks;
                $this->horticultureproducestocksScheduledForDeletion->clear();
            }
            $this->horticultureproducestocksScheduledForDeletion[]= clone $horticultureproducestock;
            $horticultureproducestock->setHorticultureproducedetail(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aHorticultureproduceparent) {
            $this->aHorticultureproduceparent->removeHorticultureproducedetail($this);
        }
        if (null !== $this->aHorticultureproducebrand) {
            $this->aHorticultureproducebrand->removeHorticultureproducedetail($this);
        }
        $this->oid = null;
        $this->horticultureproduceparentoid = null;
        $this->brand = null;
        $this->variety = null;
        $this->directplanting = null;
        $this->nurseryduration = null;
        $this->avgmaturitydays = null;
        $this->harvestdurationdays = null;
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
            if ($this->collHorticultureproducebeds) {
                foreach ($this->collHorticultureproducebeds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collHorticultureproducestocks) {
                foreach ($this->collHorticultureproducestocks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collHorticultureproducebeds = null;
        $this->collHorticultureproducestocks = null;
        $this->aHorticultureproduceparent = null;
        $this->aHorticultureproducebrand = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(HorticultureproducedetailTableMap::DEFAULT_STRING_FORMAT);
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
