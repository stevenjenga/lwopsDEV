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
use lwops\lwops\Horticulturebed as ChildHorticulturebed;
use lwops\lwops\HorticulturebedQuery as ChildHorticulturebedQuery;
use lwops\lwops\HorticultureproducebedQuery as ChildHorticultureproducebedQuery;
use lwops\lwops\Horticultureproducedetail as ChildHorticultureproducedetail;
use lwops\lwops\HorticultureproducedetailQuery as ChildHorticultureproducedetailQuery;
use lwops\lwops\Map\HorticultureproducebedTableMap;

/**
 * Base class that represents a row from the 'horticultureproducebed' table.
 *
 *
 *
 * @package    propel.generator.lwops.lwops.Base
 */
abstract class Horticultureproducebed implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\lwops\\lwops\\Map\\HorticultureproducebedTableMap';


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
     * The value for the producetypeoid field.
     *
     * @var        int
     */
    protected $producetypeoid;

    /**
     * The value for the bedoid field.
     *
     * @var        int
     */
    protected $bedoid;

    /**
     * The value for the planteddt field.
     *
     * @var        DateTime
     */
    protected $planteddt;

    /**
     * The value for the harvestdt field.
     *
     * @var        DateTime
     */
    protected $harvestdt;

    /**
     * The value for the enddt field.
     *
     * @var        DateTime
     */
    protected $enddt;

    /**
     * The value for the ganttparentoid field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $ganttparentoid;

    /**
     * The value for the notes field.
     *
     * @var        string
     */
    protected $notes;

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
     * @var        ChildHorticultureproducedetail
     */
    protected $aHorticultureproducedetail;

    /**
     * @var        ChildHorticulturebed
     */
    protected $aHorticulturebed;

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
        $this->ganttparentoid = 0;
    }

    /**
     * Initializes internal state of lwops\lwops\Base\Horticultureproducebed object.
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
     * Compares this with another <code>Horticultureproducebed</code> instance.  If
     * <code>obj</code> is an instance of <code>Horticultureproducebed</code>, delegates to
     * <code>equals(Horticultureproducebed)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Horticultureproducebed The current object, for fluid interface
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
     * Get the [producetypeoid] column value.
     *
     * @return int
     */
    public function getProducetypeoid()
    {
        return $this->producetypeoid;
    }

    /**
     * Get the [bedoid] column value.
     *
     * @return int
     */
    public function getBedoid()
    {
        return $this->bedoid;
    }

    /**
     * Get the [optionally formatted] temporal [planteddt] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPlanteddt($format = NULL)
    {
        if ($format === null) {
            return $this->planteddt;
        } else {
            return $this->planteddt instanceof \DateTimeInterface ? $this->planteddt->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [harvestdt] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getHarvestdt($format = NULL)
    {
        if ($format === null) {
            return $this->harvestdt;
        } else {
            return $this->harvestdt instanceof \DateTimeInterface ? $this->harvestdt->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [enddt] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getEnddt($format = NULL)
    {
        if ($format === null) {
            return $this->enddt;
        } else {
            return $this->enddt instanceof \DateTimeInterface ? $this->enddt->format($format) : null;
        }
    }

    /**
     * Get the [ganttparentoid] column value.
     *
     * @return int
     */
    public function getGanttparentoid()
    {
        return $this->ganttparentoid;
    }

    /**
     * Get the [notes] column value.
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
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
     * @return $this|\lwops\lwops\Horticultureproducebed The current object (for fluent API support)
     */
    public function setOid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oid !== $v) {
            $this->oid = $v;
            $this->modifiedColumns[HorticultureproducebedTableMap::COL_OID] = true;
        }

        return $this;
    } // setOid()

    /**
     * Set the value of [producetypeoid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Horticultureproducebed The current object (for fluent API support)
     */
    public function setProducetypeoid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->producetypeoid !== $v) {
            $this->producetypeoid = $v;
            $this->modifiedColumns[HorticultureproducebedTableMap::COL_PRODUCETYPEOID] = true;
        }

        if ($this->aHorticultureproducedetail !== null && $this->aHorticultureproducedetail->getOid() !== $v) {
            $this->aHorticultureproducedetail = null;
        }

        return $this;
    } // setProducetypeoid()

    /**
     * Set the value of [bedoid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Horticultureproducebed The current object (for fluent API support)
     */
    public function setBedoid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->bedoid !== $v) {
            $this->bedoid = $v;
            $this->modifiedColumns[HorticultureproducebedTableMap::COL_BEDOID] = true;
        }

        if ($this->aHorticulturebed !== null && $this->aHorticulturebed->getOid() !== $v) {
            $this->aHorticulturebed = null;
        }

        return $this;
    } // setBedoid()

    /**
     * Sets the value of [planteddt] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Horticultureproducebed The current object (for fluent API support)
     */
    public function setPlanteddt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->planteddt !== null || $dt !== null) {
            if ($this->planteddt === null || $dt === null || $dt->format("Y-m-d") !== $this->planteddt->format("Y-m-d")) {
                $this->planteddt = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HorticultureproducebedTableMap::COL_PLANTEDDT] = true;
            }
        } // if either are not null

        return $this;
    } // setPlanteddt()

    /**
     * Sets the value of [harvestdt] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Horticultureproducebed The current object (for fluent API support)
     */
    public function setHarvestdt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->harvestdt !== null || $dt !== null) {
            if ($this->harvestdt === null || $dt === null || $dt->format("Y-m-d") !== $this->harvestdt->format("Y-m-d")) {
                $this->harvestdt = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HorticultureproducebedTableMap::COL_HARVESTDT] = true;
            }
        } // if either are not null

        return $this;
    } // setHarvestdt()

    /**
     * Sets the value of [enddt] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Horticultureproducebed The current object (for fluent API support)
     */
    public function setEnddt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->enddt !== null || $dt !== null) {
            if ($this->enddt === null || $dt === null || $dt->format("Y-m-d") !== $this->enddt->format("Y-m-d")) {
                $this->enddt = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HorticultureproducebedTableMap::COL_ENDDT] = true;
            }
        } // if either are not null

        return $this;
    } // setEnddt()

    /**
     * Set the value of [ganttparentoid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Horticultureproducebed The current object (for fluent API support)
     */
    public function setGanttparentoid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ganttparentoid !== $v) {
            $this->ganttparentoid = $v;
            $this->modifiedColumns[HorticultureproducebedTableMap::COL_GANTTPARENTOID] = true;
        }

        return $this;
    } // setGanttparentoid()

    /**
     * Set the value of [notes] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Horticultureproducebed The current object (for fluent API support)
     */
    public function setNotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->notes !== $v) {
            $this->notes = $v;
            $this->modifiedColumns[HorticultureproducebedTableMap::COL_NOTES] = true;
        }

        return $this;
    } // setNotes()

    /**
     * Sets the value of [createtmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Horticultureproducebed The current object (for fluent API support)
     */
    public function setCreatetmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->createtmstp !== null || $dt !== null) {
            if ($this->createtmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->createtmstp->format("Y-m-d H:i:s.u")) {
                $this->createtmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HorticultureproducebedTableMap::COL_CREATETMSTP] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatetmstp()

    /**
     * Sets the value of [updttmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Horticultureproducebed The current object (for fluent API support)
     */
    public function setUpdttmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updttmstp !== null || $dt !== null) {
            if ($this->updttmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updttmstp->format("Y-m-d H:i:s.u")) {
                $this->updttmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HorticultureproducebedTableMap::COL_UPDTTMSTP] = true;
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
            if ($this->ganttparentoid !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : HorticultureproducebedTableMap::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->oid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : HorticultureproducebedTableMap::translateFieldName('Producetypeoid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->producetypeoid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : HorticultureproducebedTableMap::translateFieldName('Bedoid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bedoid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : HorticultureproducebedTableMap::translateFieldName('Planteddt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->planteddt = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : HorticultureproducebedTableMap::translateFieldName('Harvestdt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->harvestdt = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : HorticultureproducebedTableMap::translateFieldName('Enddt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->enddt = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : HorticultureproducebedTableMap::translateFieldName('Ganttparentoid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ganttparentoid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : HorticultureproducebedTableMap::translateFieldName('Notes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->notes = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : HorticultureproducebedTableMap::translateFieldName('Createtmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->createtmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : HorticultureproducebedTableMap::translateFieldName('Updttmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updttmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = HorticultureproducebedTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\lwops\\lwops\\Horticultureproducebed'), 0, $e);
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
        if ($this->aHorticultureproducedetail !== null && $this->producetypeoid !== $this->aHorticultureproducedetail->getOid()) {
            $this->aHorticultureproducedetail = null;
        }
        if ($this->aHorticulturebed !== null && $this->bedoid !== $this->aHorticulturebed->getOid()) {
            $this->aHorticulturebed = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(HorticultureproducebedTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildHorticultureproducebedQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aHorticultureproducedetail = null;
            $this->aHorticulturebed = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Horticultureproducebed::setDeleted()
     * @see Horticultureproducebed::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducebedTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildHorticultureproducebedQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(HorticultureproducebedTableMap::DATABASE_NAME);
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
                HorticultureproducebedTableMap::addInstanceToPool($this);
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

            if ($this->aHorticultureproducedetail !== null) {
                if ($this->aHorticultureproducedetail->isModified() || $this->aHorticultureproducedetail->isNew()) {
                    $affectedRows += $this->aHorticultureproducedetail->save($con);
                }
                $this->setHorticultureproducedetail($this->aHorticultureproducedetail);
            }

            if ($this->aHorticulturebed !== null) {
                if ($this->aHorticulturebed->isModified() || $this->aHorticulturebed->isNew()) {
                    $affectedRows += $this->aHorticulturebed->save($con);
                }
                $this->setHorticulturebed($this->aHorticulturebed);
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

        $this->modifiedColumns[HorticultureproducebedTableMap::COL_OID] = true;
        if (null !== $this->oid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . HorticultureproducebedTableMap::COL_OID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_OID)) {
            $modifiedColumns[':p' . $index++]  = 'oid';
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_PRODUCETYPEOID)) {
            $modifiedColumns[':p' . $index++]  = 'produceTypeOid';
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_BEDOID)) {
            $modifiedColumns[':p' . $index++]  = 'bedOid';
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_PLANTEDDT)) {
            $modifiedColumns[':p' . $index++]  = 'plantedDt';
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_HARVESTDT)) {
            $modifiedColumns[':p' . $index++]  = 'harvestDt';
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_ENDDT)) {
            $modifiedColumns[':p' . $index++]  = 'endDt';
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_GANTTPARENTOID)) {
            $modifiedColumns[':p' . $index++]  = 'ganttParentOid';
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_NOTES)) {
            $modifiedColumns[':p' . $index++]  = 'notes';
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_CREATETMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'createTmstp';
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_UPDTTMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'updtTmstp';
        }

        $sql = sprintf(
            'INSERT INTO horticultureproducebed (%s) VALUES (%s)',
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
                    case 'produceTypeOid':
                        $stmt->bindValue($identifier, $this->producetypeoid, PDO::PARAM_INT);
                        break;
                    case 'bedOid':
                        $stmt->bindValue($identifier, $this->bedoid, PDO::PARAM_INT);
                        break;
                    case 'plantedDt':
                        $stmt->bindValue($identifier, $this->planteddt ? $this->planteddt->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'harvestDt':
                        $stmt->bindValue($identifier, $this->harvestdt ? $this->harvestdt->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'endDt':
                        $stmt->bindValue($identifier, $this->enddt ? $this->enddt->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'ganttParentOid':
                        $stmt->bindValue($identifier, $this->ganttparentoid, PDO::PARAM_INT);
                        break;
                    case 'notes':
                        $stmt->bindValue($identifier, $this->notes, PDO::PARAM_STR);
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
        $pos = HorticultureproducebedTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getProducetypeoid();
                break;
            case 2:
                return $this->getBedoid();
                break;
            case 3:
                return $this->getPlanteddt();
                break;
            case 4:
                return $this->getHarvestdt();
                break;
            case 5:
                return $this->getEnddt();
                break;
            case 6:
                return $this->getGanttparentoid();
                break;
            case 7:
                return $this->getNotes();
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

        if (isset($alreadyDumpedObjects['Horticultureproducebed'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Horticultureproducebed'][$this->hashCode()] = true;
        $keys = HorticultureproducebedTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOid(),
            $keys[1] => $this->getProducetypeoid(),
            $keys[2] => $this->getBedoid(),
            $keys[3] => $this->getPlanteddt(),
            $keys[4] => $this->getHarvestdt(),
            $keys[5] => $this->getEnddt(),
            $keys[6] => $this->getGanttparentoid(),
            $keys[7] => $this->getNotes(),
            $keys[8] => $this->getCreatetmstp(),
            $keys[9] => $this->getUpdttmstp(),
        );
        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('c');
        }

        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('c');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

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
            if (null !== $this->aHorticultureproducedetail) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'horticultureproducedetail';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'horticultureproducedetail';
                        break;
                    default:
                        $key = 'Horticultureproducedetail';
                }

                $result[$key] = $this->aHorticultureproducedetail->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aHorticulturebed) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'horticulturebed';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'horticulturebed';
                        break;
                    default:
                        $key = 'Horticulturebed';
                }

                $result[$key] = $this->aHorticulturebed->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\lwops\lwops\Horticultureproducebed
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = HorticultureproducebedTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\lwops\lwops\Horticultureproducebed
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setOid($value);
                break;
            case 1:
                $this->setProducetypeoid($value);
                break;
            case 2:
                $this->setBedoid($value);
                break;
            case 3:
                $this->setPlanteddt($value);
                break;
            case 4:
                $this->setHarvestdt($value);
                break;
            case 5:
                $this->setEnddt($value);
                break;
            case 6:
                $this->setGanttparentoid($value);
                break;
            case 7:
                $this->setNotes($value);
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
        $keys = HorticultureproducebedTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setProducetypeoid($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setBedoid($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPlanteddt($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setHarvestdt($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setEnddt($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setGanttparentoid($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setNotes($arr[$keys[7]]);
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
     * @return $this|\lwops\lwops\Horticultureproducebed The current object, for fluid interface
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
        $criteria = new Criteria(HorticultureproducebedTableMap::DATABASE_NAME);

        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_OID)) {
            $criteria->add(HorticultureproducebedTableMap::COL_OID, $this->oid);
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_PRODUCETYPEOID)) {
            $criteria->add(HorticultureproducebedTableMap::COL_PRODUCETYPEOID, $this->producetypeoid);
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_BEDOID)) {
            $criteria->add(HorticultureproducebedTableMap::COL_BEDOID, $this->bedoid);
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_PLANTEDDT)) {
            $criteria->add(HorticultureproducebedTableMap::COL_PLANTEDDT, $this->planteddt);
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_HARVESTDT)) {
            $criteria->add(HorticultureproducebedTableMap::COL_HARVESTDT, $this->harvestdt);
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_ENDDT)) {
            $criteria->add(HorticultureproducebedTableMap::COL_ENDDT, $this->enddt);
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_GANTTPARENTOID)) {
            $criteria->add(HorticultureproducebedTableMap::COL_GANTTPARENTOID, $this->ganttparentoid);
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_NOTES)) {
            $criteria->add(HorticultureproducebedTableMap::COL_NOTES, $this->notes);
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_CREATETMSTP)) {
            $criteria->add(HorticultureproducebedTableMap::COL_CREATETMSTP, $this->createtmstp);
        }
        if ($this->isColumnModified(HorticultureproducebedTableMap::COL_UPDTTMSTP)) {
            $criteria->add(HorticultureproducebedTableMap::COL_UPDTTMSTP, $this->updttmstp);
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
        $criteria = ChildHorticultureproducebedQuery::create();
        $criteria->add(HorticultureproducebedTableMap::COL_OID, $this->oid);

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
     * @param      object $copyObj An object of \lwops\lwops\Horticultureproducebed (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setProducetypeoid($this->getProducetypeoid());
        $copyObj->setBedoid($this->getBedoid());
        $copyObj->setPlanteddt($this->getPlanteddt());
        $copyObj->setHarvestdt($this->getHarvestdt());
        $copyObj->setEnddt($this->getEnddt());
        $copyObj->setGanttparentoid($this->getGanttparentoid());
        $copyObj->setNotes($this->getNotes());
        $copyObj->setCreatetmstp($this->getCreatetmstp());
        $copyObj->setUpdttmstp($this->getUpdttmstp());
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
     * @return \lwops\lwops\Horticultureproducebed Clone of current object.
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
     * Declares an association between this object and a ChildHorticultureproducedetail object.
     *
     * @param  ChildHorticultureproducedetail $v
     * @return $this|\lwops\lwops\Horticultureproducebed The current object (for fluent API support)
     * @throws PropelException
     */
    public function setHorticultureproducedetail(ChildHorticultureproducedetail $v = null)
    {
        if ($v === null) {
            $this->setProducetypeoid(NULL);
        } else {
            $this->setProducetypeoid($v->getOid());
        }

        $this->aHorticultureproducedetail = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildHorticultureproducedetail object, it will not be re-added.
        if ($v !== null) {
            $v->addHorticultureproducebed($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildHorticultureproducedetail object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildHorticultureproducedetail The associated ChildHorticultureproducedetail object.
     * @throws PropelException
     */
    public function getHorticultureproducedetail(ConnectionInterface $con = null)
    {
        if ($this->aHorticultureproducedetail === null && ($this->producetypeoid !== null)) {
            $this->aHorticultureproducedetail = ChildHorticultureproducedetailQuery::create()->findPk($this->producetypeoid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aHorticultureproducedetail->addHorticultureproducebeds($this);
             */
        }

        return $this->aHorticultureproducedetail;
    }

    /**
     * Declares an association between this object and a ChildHorticulturebed object.
     *
     * @param  ChildHorticulturebed $v
     * @return $this|\lwops\lwops\Horticultureproducebed The current object (for fluent API support)
     * @throws PropelException
     */
    public function setHorticulturebed(ChildHorticulturebed $v = null)
    {
        if ($v === null) {
            $this->setBedoid(NULL);
        } else {
            $this->setBedoid($v->getOid());
        }

        $this->aHorticulturebed = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildHorticulturebed object, it will not be re-added.
        if ($v !== null) {
            $v->addHorticultureproducebed($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildHorticulturebed object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildHorticulturebed The associated ChildHorticulturebed object.
     * @throws PropelException
     */
    public function getHorticulturebed(ConnectionInterface $con = null)
    {
        if ($this->aHorticulturebed === null && ($this->bedoid !== null)) {
            $this->aHorticulturebed = ChildHorticulturebedQuery::create()->findPk($this->bedoid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aHorticulturebed->addHorticultureproducebeds($this);
             */
        }

        return $this->aHorticulturebed;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aHorticultureproducedetail) {
            $this->aHorticultureproducedetail->removeHorticultureproducebed($this);
        }
        if (null !== $this->aHorticulturebed) {
            $this->aHorticulturebed->removeHorticultureproducebed($this);
        }
        $this->oid = null;
        $this->producetypeoid = null;
        $this->bedoid = null;
        $this->planteddt = null;
        $this->harvestdt = null;
        $this->enddt = null;
        $this->ganttparentoid = null;
        $this->notes = null;
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
        } // if ($deep)

        $this->aHorticultureproducedetail = null;
        $this->aHorticulturebed = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(HorticultureproducebedTableMap::DEFAULT_STRING_FORMAT);
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
