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
use lwops\lwops\Dairypandllabourexpensedetail as ChildDairypandllabourexpensedetail;
use lwops\lwops\DairypandllabourexpensedetailQuery as ChildDairypandllabourexpensedetailQuery;
use lwops\lwops\Lineofbusiness as ChildLineofbusiness;
use lwops\lwops\LineofbusinessQuery as ChildLineofbusinessQuery;
use lwops\lwops\Opsmonthlycalendar as ChildOpsmonthlycalendar;
use lwops\lwops\OpsmonthlycalendarQuery as ChildOpsmonthlycalendarQuery;
use lwops\lwops\Map\DairypandlTableMap;
use lwops\lwops\Map\DairypandllabourexpensedetailTableMap;

/**
 * Base class that represents a row from the 'dairypandl' table.
 *
 *
 *
 * @package    propel.generator.lwops.lwops.Base
 */
abstract class Dairypandl implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\lwops\\lwops\\Map\\DairypandlTableMap';


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
     * The value for the lineofbusinessoid field.
     *
     * @var        int
     */
    protected $lineofbusinessoid;

    /**
     * The value for the opsmonthlycalendaroid field.
     *
     * @var        int
     */
    protected $opsmonthlycalendaroid;

    /**
     * The value for the purchases field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $purchases;

    /**
     * The value for the otherpurchases field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $otherpurchases;

    /**
     * The value for the cooperativedeductions field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $cooperativedeductions;

    /**
     * The value for the labourparttimeexpense field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $labourparttimeexpense;

    /**
     * The value for the generalexpenses field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $generalexpenses;

    /**
     * The value for the elecexpenses field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $elecexpenses;

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
     * @var        ChildLineofbusiness
     */
    protected $aLineofbusiness;

    /**
     * @var        ChildOpsmonthlycalendar
     */
    protected $aOpsmonthlycalendar;

    /**
     * @var        ObjectCollection|ChildDairypandllabourexpensedetail[] Collection to store aggregation of ChildDairypandllabourexpensedetail objects.
     */
    protected $collDairypandllabourexpensedetails;
    protected $collDairypandllabourexpensedetailsPartial;

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
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->purchases = 0;
        $this->otherpurchases = 0;
        $this->cooperativedeductions = 0;
        $this->labourparttimeexpense = 0;
        $this->generalexpenses = 0;
        $this->elecexpenses = 0;
    }

    /**
     * Initializes internal state of lwops\lwops\Base\Dairypandl object.
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
     * Compares this with another <code>Dairypandl</code> instance.  If
     * <code>obj</code> is an instance of <code>Dairypandl</code>, delegates to
     * <code>equals(Dairypandl)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Dairypandl The current object, for fluid interface
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
     * Get the [lineofbusinessoid] column value.
     *
     * @return int
     */
    public function getLineofbusinessoid()
    {
        return $this->lineofbusinessoid;
    }

    /**
     * Get the [opsmonthlycalendaroid] column value.
     *
     * @return int
     */
    public function getOpsmonthlycalendaroid()
    {
        return $this->opsmonthlycalendaroid;
    }

    /**
     * Get the [purchases] column value.
     *
     * @return double
     */
    public function getPurchases()
    {
        return $this->purchases;
    }

    /**
     * Get the [otherpurchases] column value.
     *
     * @return double
     */
    public function getOtherpurchases()
    {
        return $this->otherpurchases;
    }

    /**
     * Get the [cooperativedeductions] column value.
     *
     * @return double
     */
    public function getCooperativedeductions()
    {
        return $this->cooperativedeductions;
    }

    /**
     * Get the [labourparttimeexpense] column value.
     *
     * @return double
     */
    public function getLabourparttimeexpense()
    {
        return $this->labourparttimeexpense;
    }

    /**
     * Get the [generalexpenses] column value.
     *
     * @return double
     */
    public function getGeneralexpenses()
    {
        return $this->generalexpenses;
    }

    /**
     * Get the [elecexpenses] column value.
     *
     * @return double
     */
    public function getElecexpenses()
    {
        return $this->elecexpenses;
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
     * @return $this|\lwops\lwops\Dairypandl The current object (for fluent API support)
     */
    public function setOid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oid !== $v) {
            $this->oid = $v;
            $this->modifiedColumns[DairypandlTableMap::COL_OID] = true;
        }

        return $this;
    } // setOid()

    /**
     * Set the value of [lineofbusinessoid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Dairypandl The current object (for fluent API support)
     */
    public function setLineofbusinessoid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->lineofbusinessoid !== $v) {
            $this->lineofbusinessoid = $v;
            $this->modifiedColumns[DairypandlTableMap::COL_LINEOFBUSINESSOID] = true;
        }

        if ($this->aLineofbusiness !== null && $this->aLineofbusiness->getOid() !== $v) {
            $this->aLineofbusiness = null;
        }

        return $this;
    } // setLineofbusinessoid()

    /**
     * Set the value of [opsmonthlycalendaroid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Dairypandl The current object (for fluent API support)
     */
    public function setOpsmonthlycalendaroid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->opsmonthlycalendaroid !== $v) {
            $this->opsmonthlycalendaroid = $v;
            $this->modifiedColumns[DairypandlTableMap::COL_OPSMONTHLYCALENDAROID] = true;
        }

        if ($this->aOpsmonthlycalendar !== null && $this->aOpsmonthlycalendar->getOid() !== $v) {
            $this->aOpsmonthlycalendar = null;
        }

        return $this;
    } // setOpsmonthlycalendaroid()

    /**
     * Set the value of [purchases] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Dairypandl The current object (for fluent API support)
     */
    public function setPurchases($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->purchases !== $v) {
            $this->purchases = $v;
            $this->modifiedColumns[DairypandlTableMap::COL_PURCHASES] = true;
        }

        return $this;
    } // setPurchases()

    /**
     * Set the value of [otherpurchases] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Dairypandl The current object (for fluent API support)
     */
    public function setOtherpurchases($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->otherpurchases !== $v) {
            $this->otherpurchases = $v;
            $this->modifiedColumns[DairypandlTableMap::COL_OTHERPURCHASES] = true;
        }

        return $this;
    } // setOtherpurchases()

    /**
     * Set the value of [cooperativedeductions] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Dairypandl The current object (for fluent API support)
     */
    public function setCooperativedeductions($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->cooperativedeductions !== $v) {
            $this->cooperativedeductions = $v;
            $this->modifiedColumns[DairypandlTableMap::COL_COOPERATIVEDEDUCTIONS] = true;
        }

        return $this;
    } // setCooperativedeductions()

    /**
     * Set the value of [labourparttimeexpense] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Dairypandl The current object (for fluent API support)
     */
    public function setLabourparttimeexpense($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->labourparttimeexpense !== $v) {
            $this->labourparttimeexpense = $v;
            $this->modifiedColumns[DairypandlTableMap::COL_LABOURPARTTIMEEXPENSE] = true;
        }

        return $this;
    } // setLabourparttimeexpense()

    /**
     * Set the value of [generalexpenses] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Dairypandl The current object (for fluent API support)
     */
    public function setGeneralexpenses($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->generalexpenses !== $v) {
            $this->generalexpenses = $v;
            $this->modifiedColumns[DairypandlTableMap::COL_GENERALEXPENSES] = true;
        }

        return $this;
    } // setGeneralexpenses()

    /**
     * Set the value of [elecexpenses] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Dairypandl The current object (for fluent API support)
     */
    public function setElecexpenses($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->elecexpenses !== $v) {
            $this->elecexpenses = $v;
            $this->modifiedColumns[DairypandlTableMap::COL_ELECEXPENSES] = true;
        }

        return $this;
    } // setElecexpenses()

    /**
     * Sets the value of [createtmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Dairypandl The current object (for fluent API support)
     */
    public function setCreatetmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->createtmstp !== null || $dt !== null) {
            if ($this->createtmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->createtmstp->format("Y-m-d H:i:s.u")) {
                $this->createtmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DairypandlTableMap::COL_CREATETMSTP] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatetmstp()

    /**
     * Sets the value of [updttmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Dairypandl The current object (for fluent API support)
     */
    public function setUpdttmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updttmstp !== null || $dt !== null) {
            if ($this->updttmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updttmstp->format("Y-m-d H:i:s.u")) {
                $this->updttmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DairypandlTableMap::COL_UPDTTMSTP] = true;
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
            if ($this->purchases !== 0) {
                return false;
            }

            if ($this->otherpurchases !== 0) {
                return false;
            }

            if ($this->cooperativedeductions !== 0) {
                return false;
            }

            if ($this->labourparttimeexpense !== 0) {
                return false;
            }

            if ($this->generalexpenses !== 0) {
                return false;
            }

            if ($this->elecexpenses !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DairypandlTableMap::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->oid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DairypandlTableMap::translateFieldName('Lineofbusinessoid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lineofbusinessoid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DairypandlTableMap::translateFieldName('Opsmonthlycalendaroid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->opsmonthlycalendaroid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : DairypandlTableMap::translateFieldName('Purchases', TableMap::TYPE_PHPNAME, $indexType)];
            $this->purchases = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : DairypandlTableMap::translateFieldName('Otherpurchases', TableMap::TYPE_PHPNAME, $indexType)];
            $this->otherpurchases = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : DairypandlTableMap::translateFieldName('Cooperativedeductions', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cooperativedeductions = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : DairypandlTableMap::translateFieldName('Labourparttimeexpense', TableMap::TYPE_PHPNAME, $indexType)];
            $this->labourparttimeexpense = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : DairypandlTableMap::translateFieldName('Generalexpenses', TableMap::TYPE_PHPNAME, $indexType)];
            $this->generalexpenses = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : DairypandlTableMap::translateFieldName('Elecexpenses', TableMap::TYPE_PHPNAME, $indexType)];
            $this->elecexpenses = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : DairypandlTableMap::translateFieldName('Createtmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->createtmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : DairypandlTableMap::translateFieldName('Updttmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updttmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = DairypandlTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\lwops\\lwops\\Dairypandl'), 0, $e);
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
        if ($this->aLineofbusiness !== null && $this->lineofbusinessoid !== $this->aLineofbusiness->getOid()) {
            $this->aLineofbusiness = null;
        }
        if ($this->aOpsmonthlycalendar !== null && $this->opsmonthlycalendaroid !== $this->aOpsmonthlycalendar->getOid()) {
            $this->aOpsmonthlycalendar = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(DairypandlTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildDairypandlQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLineofbusiness = null;
            $this->aOpsmonthlycalendar = null;
            $this->collDairypandllabourexpensedetails = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Dairypandl::setDeleted()
     * @see Dairypandl::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DairypandlTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildDairypandlQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(DairypandlTableMap::DATABASE_NAME);
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
                DairypandlTableMap::addInstanceToPool($this);
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

            if ($this->aLineofbusiness !== null) {
                if ($this->aLineofbusiness->isModified() || $this->aLineofbusiness->isNew()) {
                    $affectedRows += $this->aLineofbusiness->save($con);
                }
                $this->setLineofbusiness($this->aLineofbusiness);
            }

            if ($this->aOpsmonthlycalendar !== null) {
                if ($this->aOpsmonthlycalendar->isModified() || $this->aOpsmonthlycalendar->isNew()) {
                    $affectedRows += $this->aOpsmonthlycalendar->save($con);
                }
                $this->setOpsmonthlycalendar($this->aOpsmonthlycalendar);
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

        $this->modifiedColumns[DairypandlTableMap::COL_OID] = true;
        if (null !== $this->oid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DairypandlTableMap::COL_OID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DairypandlTableMap::COL_OID)) {
            $modifiedColumns[':p' . $index++]  = 'oid';
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_LINEOFBUSINESSOID)) {
            $modifiedColumns[':p' . $index++]  = 'lineOfBusinessOid';
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_OPSMONTHLYCALENDAROID)) {
            $modifiedColumns[':p' . $index++]  = 'opsMonthlyCalendarOid';
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_PURCHASES)) {
            $modifiedColumns[':p' . $index++]  = 'purchases';
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_OTHERPURCHASES)) {
            $modifiedColumns[':p' . $index++]  = 'otherPurchases';
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_COOPERATIVEDEDUCTIONS)) {
            $modifiedColumns[':p' . $index++]  = 'cooperativeDeductions';
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_LABOURPARTTIMEEXPENSE)) {
            $modifiedColumns[':p' . $index++]  = 'labourParttimeExpense';
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_GENERALEXPENSES)) {
            $modifiedColumns[':p' . $index++]  = 'generalExpenses';
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_ELECEXPENSES)) {
            $modifiedColumns[':p' . $index++]  = 'elecExpenses';
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_CREATETMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'createTmstp';
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_UPDTTMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'updtTmstp';
        }

        $sql = sprintf(
            'INSERT INTO dairypandl (%s) VALUES (%s)',
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
                    case 'lineOfBusinessOid':
                        $stmt->bindValue($identifier, $this->lineofbusinessoid, PDO::PARAM_INT);
                        break;
                    case 'opsMonthlyCalendarOid':
                        $stmt->bindValue($identifier, $this->opsmonthlycalendaroid, PDO::PARAM_INT);
                        break;
                    case 'purchases':
                        $stmt->bindValue($identifier, $this->purchases, PDO::PARAM_STR);
                        break;
                    case 'otherPurchases':
                        $stmt->bindValue($identifier, $this->otherpurchases, PDO::PARAM_STR);
                        break;
                    case 'cooperativeDeductions':
                        $stmt->bindValue($identifier, $this->cooperativedeductions, PDO::PARAM_STR);
                        break;
                    case 'labourParttimeExpense':
                        $stmt->bindValue($identifier, $this->labourparttimeexpense, PDO::PARAM_STR);
                        break;
                    case 'generalExpenses':
                        $stmt->bindValue($identifier, $this->generalexpenses, PDO::PARAM_STR);
                        break;
                    case 'elecExpenses':
                        $stmt->bindValue($identifier, $this->elecexpenses, PDO::PARAM_STR);
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
        $pos = DairypandlTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getLineofbusinessoid();
                break;
            case 2:
                return $this->getOpsmonthlycalendaroid();
                break;
            case 3:
                return $this->getPurchases();
                break;
            case 4:
                return $this->getOtherpurchases();
                break;
            case 5:
                return $this->getCooperativedeductions();
                break;
            case 6:
                return $this->getLabourparttimeexpense();
                break;
            case 7:
                return $this->getGeneralexpenses();
                break;
            case 8:
                return $this->getElecexpenses();
                break;
            case 9:
                return $this->getCreatetmstp();
                break;
            case 10:
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

        if (isset($alreadyDumpedObjects['Dairypandl'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Dairypandl'][$this->hashCode()] = true;
        $keys = DairypandlTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOid(),
            $keys[1] => $this->getLineofbusinessoid(),
            $keys[2] => $this->getOpsmonthlycalendaroid(),
            $keys[3] => $this->getPurchases(),
            $keys[4] => $this->getOtherpurchases(),
            $keys[5] => $this->getCooperativedeductions(),
            $keys[6] => $this->getLabourparttimeexpense(),
            $keys[7] => $this->getGeneralexpenses(),
            $keys[8] => $this->getElecexpenses(),
            $keys[9] => $this->getCreatetmstp(),
            $keys[10] => $this->getUpdttmstp(),
        );
        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('c');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->aOpsmonthlycalendar) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'opsmonthlycalendar';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'opsmonthlycalendar';
                        break;
                    default:
                        $key = 'Opsmonthlycalendar';
                }

                $result[$key] = $this->aOpsmonthlycalendar->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
     * @return $this|\lwops\lwops\Dairypandl
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = DairypandlTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\lwops\lwops\Dairypandl
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setOid($value);
                break;
            case 1:
                $this->setLineofbusinessoid($value);
                break;
            case 2:
                $this->setOpsmonthlycalendaroid($value);
                break;
            case 3:
                $this->setPurchases($value);
                break;
            case 4:
                $this->setOtherpurchases($value);
                break;
            case 5:
                $this->setCooperativedeductions($value);
                break;
            case 6:
                $this->setLabourparttimeexpense($value);
                break;
            case 7:
                $this->setGeneralexpenses($value);
                break;
            case 8:
                $this->setElecexpenses($value);
                break;
            case 9:
                $this->setCreatetmstp($value);
                break;
            case 10:
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
        $keys = DairypandlTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setLineofbusinessoid($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setOpsmonthlycalendaroid($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPurchases($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setOtherpurchases($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCooperativedeductions($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setLabourparttimeexpense($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setGeneralexpenses($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setElecexpenses($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCreatetmstp($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setUpdttmstp($arr[$keys[10]]);
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
     * @return $this|\lwops\lwops\Dairypandl The current object, for fluid interface
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
        $criteria = new Criteria(DairypandlTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DairypandlTableMap::COL_OID)) {
            $criteria->add(DairypandlTableMap::COL_OID, $this->oid);
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_LINEOFBUSINESSOID)) {
            $criteria->add(DairypandlTableMap::COL_LINEOFBUSINESSOID, $this->lineofbusinessoid);
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_OPSMONTHLYCALENDAROID)) {
            $criteria->add(DairypandlTableMap::COL_OPSMONTHLYCALENDAROID, $this->opsmonthlycalendaroid);
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_PURCHASES)) {
            $criteria->add(DairypandlTableMap::COL_PURCHASES, $this->purchases);
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_OTHERPURCHASES)) {
            $criteria->add(DairypandlTableMap::COL_OTHERPURCHASES, $this->otherpurchases);
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_COOPERATIVEDEDUCTIONS)) {
            $criteria->add(DairypandlTableMap::COL_COOPERATIVEDEDUCTIONS, $this->cooperativedeductions);
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_LABOURPARTTIMEEXPENSE)) {
            $criteria->add(DairypandlTableMap::COL_LABOURPARTTIMEEXPENSE, $this->labourparttimeexpense);
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_GENERALEXPENSES)) {
            $criteria->add(DairypandlTableMap::COL_GENERALEXPENSES, $this->generalexpenses);
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_ELECEXPENSES)) {
            $criteria->add(DairypandlTableMap::COL_ELECEXPENSES, $this->elecexpenses);
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_CREATETMSTP)) {
            $criteria->add(DairypandlTableMap::COL_CREATETMSTP, $this->createtmstp);
        }
        if ($this->isColumnModified(DairypandlTableMap::COL_UPDTTMSTP)) {
            $criteria->add(DairypandlTableMap::COL_UPDTTMSTP, $this->updttmstp);
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
        $criteria = ChildDairypandlQuery::create();
        $criteria->add(DairypandlTableMap::COL_OID, $this->oid);

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
     * @param      object $copyObj An object of \lwops\lwops\Dairypandl (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setLineofbusinessoid($this->getLineofbusinessoid());
        $copyObj->setOpsmonthlycalendaroid($this->getOpsmonthlycalendaroid());
        $copyObj->setPurchases($this->getPurchases());
        $copyObj->setOtherpurchases($this->getOtherpurchases());
        $copyObj->setCooperativedeductions($this->getCooperativedeductions());
        $copyObj->setLabourparttimeexpense($this->getLabourparttimeexpense());
        $copyObj->setGeneralexpenses($this->getGeneralexpenses());
        $copyObj->setElecexpenses($this->getElecexpenses());
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
     * @return \lwops\lwops\Dairypandl Clone of current object.
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
     * Declares an association between this object and a ChildLineofbusiness object.
     *
     * @param  ChildLineofbusiness $v
     * @return $this|\lwops\lwops\Dairypandl The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLineofbusiness(ChildLineofbusiness $v = null)
    {
        if ($v === null) {
            $this->setLineofbusinessoid(NULL);
        } else {
            $this->setLineofbusinessoid($v->getOid());
        }

        $this->aLineofbusiness = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildLineofbusiness object, it will not be re-added.
        if ($v !== null) {
            $v->addDairypandl($this);
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
        if ($this->aLineofbusiness === null && ($this->lineofbusinessoid !== null)) {
            $this->aLineofbusiness = ChildLineofbusinessQuery::create()->findPk($this->lineofbusinessoid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLineofbusiness->addDairypandls($this);
             */
        }

        return $this->aLineofbusiness;
    }

    /**
     * Declares an association between this object and a ChildOpsmonthlycalendar object.
     *
     * @param  ChildOpsmonthlycalendar $v
     * @return $this|\lwops\lwops\Dairypandl The current object (for fluent API support)
     * @throws PropelException
     */
    public function setOpsmonthlycalendar(ChildOpsmonthlycalendar $v = null)
    {
        if ($v === null) {
            $this->setOpsmonthlycalendaroid(NULL);
        } else {
            $this->setOpsmonthlycalendaroid($v->getOid());
        }

        $this->aOpsmonthlycalendar = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOpsmonthlycalendar object, it will not be re-added.
        if ($v !== null) {
            $v->addDairypandl($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOpsmonthlycalendar object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildOpsmonthlycalendar The associated ChildOpsmonthlycalendar object.
     * @throws PropelException
     */
    public function getOpsmonthlycalendar(ConnectionInterface $con = null)
    {
        if ($this->aOpsmonthlycalendar === null && ($this->opsmonthlycalendaroid !== null)) {
            $this->aOpsmonthlycalendar = ChildOpsmonthlycalendarQuery::create()->findPk($this->opsmonthlycalendaroid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOpsmonthlycalendar->addDairypandls($this);
             */
        }

        return $this->aOpsmonthlycalendar;
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
     * If this ChildDairypandl is new, it will return
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
                    ->filterByDairypandl($this)
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
     * @return $this|ChildDairypandl The current object (for fluent API support)
     */
    public function setDairypandllabourexpensedetails(Collection $dairypandllabourexpensedetails, ConnectionInterface $con = null)
    {
        /** @var ChildDairypandllabourexpensedetail[] $dairypandllabourexpensedetailsToDelete */
        $dairypandllabourexpensedetailsToDelete = $this->getDairypandllabourexpensedetails(new Criteria(), $con)->diff($dairypandllabourexpensedetails);


        $this->dairypandllabourexpensedetailsScheduledForDeletion = $dairypandllabourexpensedetailsToDelete;

        foreach ($dairypandllabourexpensedetailsToDelete as $dairypandllabourexpensedetailRemoved) {
            $dairypandllabourexpensedetailRemoved->setDairypandl(null);
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
                ->filterByDairypandl($this)
                ->count($con);
        }

        return count($this->collDairypandllabourexpensedetails);
    }

    /**
     * Method called to associate a ChildDairypandllabourexpensedetail object to this object
     * through the ChildDairypandllabourexpensedetail foreign key attribute.
     *
     * @param  ChildDairypandllabourexpensedetail $l ChildDairypandllabourexpensedetail
     * @return $this|\lwops\lwops\Dairypandl The current object (for fluent API support)
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
        $dairypandllabourexpensedetail->setDairypandl($this);
    }

    /**
     * @param  ChildDairypandllabourexpensedetail $dairypandllabourexpensedetail The ChildDairypandllabourexpensedetail object to remove.
     * @return $this|ChildDairypandl The current object (for fluent API support)
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
            $dairypandllabourexpensedetail->setDairypandl(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Dairypandl is new, it will return
     * an empty collection; or if this Dairypandl has previously
     * been saved, it will retrieve related Dairypandllabourexpensedetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Dairypandl.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDairypandllabourexpensedetail[] List of ChildDairypandllabourexpensedetail objects
     */
    public function getDairypandllabourexpensedetailsJoinEmployeeroletype(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDairypandllabourexpensedetailQuery::create(null, $criteria);
        $query->joinWith('Employeeroletype', $joinBehavior);

        return $this->getDairypandllabourexpensedetails($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aLineofbusiness) {
            $this->aLineofbusiness->removeDairypandl($this);
        }
        if (null !== $this->aOpsmonthlycalendar) {
            $this->aOpsmonthlycalendar->removeDairypandl($this);
        }
        $this->oid = null;
        $this->lineofbusinessoid = null;
        $this->opsmonthlycalendaroid = null;
        $this->purchases = null;
        $this->otherpurchases = null;
        $this->cooperativedeductions = null;
        $this->labourparttimeexpense = null;
        $this->generalexpenses = null;
        $this->elecexpenses = null;
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
        } // if ($deep)

        $this->collDairypandllabourexpensedetails = null;
        $this->aLineofbusiness = null;
        $this->aOpsmonthlycalendar = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DairypandlTableMap::DEFAULT_STRING_FORMAT);
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
