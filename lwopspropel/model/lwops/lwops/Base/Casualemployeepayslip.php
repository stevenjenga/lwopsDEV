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
use lwops\lwops\CasualemployeepayslipQuery as ChildCasualemployeepayslipQuery;
use lwops\lwops\Employee as ChildEmployee;
use lwops\lwops\EmployeeQuery as ChildEmployeeQuery;
use lwops\lwops\Opsbiweeklycalendar as ChildOpsbiweeklycalendar;
use lwops\lwops\OpsbiweeklycalendarQuery as ChildOpsbiweeklycalendarQuery;
use lwops\lwops\Map\CasualemployeepayslipTableMap;

/**
 * Base class that represents a row from the 'casualemployeepayslip' table.
 *
 *
 *
 * @package    propel.generator.lwops.lwops.Base
 */
abstract class Casualemployeepayslip implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\lwops\\lwops\\Map\\CasualemployeepayslipTableMap';


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
     * The value for the opsbiweeklycalendaroid field.
     *
     * @var        int
     */
    protected $opsbiweeklycalendaroid;

    /**
     * The value for the employeeoid field.
     *
     * @var        int
     */
    protected $employeeoid;

    /**
     * The value for the dailyrate field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $dailyrate;

    /**
     * The value for the totalteaweight field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $totalteaweight;

    /**
     * The value for the teapayrate field.
     *
     * @var        double
     */
    protected $teapayrate;

    /**
     * The value for the teapay field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $teapay;

    /**
     * The value for the totalparttimehrs field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $totalparttimehrs;

    /**
     * The value for the parttimepayrate field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $parttimepayrate;

    /**
     * The value for the parttimepay field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $parttimepay;

    /**
     * The value for the otherdaysworked field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $otherdaysworked;

    /**
     * The value for the otherhoursworked field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $otherhoursworked;

    /**
     * The value for the otherworkpay field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $otherworkpay;

    /**
     * The value for the elecdeduction field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $elecdeduction;

    /**
     * The value for the medicaldeduction field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $medicaldeduction;

    /**
     * The value for the nssfdeduction field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $nssfdeduction;

    /**
     * The value for the purchasesdeduction field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $purchasesdeduction;

    /**
     * The value for the otherdeduction field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $otherdeduction;

    /**
     * The value for the otherdeductiondescr field.
     *
     * @var        string
     */
    protected $otherdeductiondescr;

    /**
     * The value for the bonus field.
     *
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $bonus;

    /**
     * The value for the lockdt field.
     *
     * @var        DateTime
     */
    protected $lockdt;

    /**
     * The value for the payslipnbr field.
     *
     * Note: this column has a database default value of: 'F-PS-0000000000'
     * @var        string
     */
    protected $payslipnbr;

    /**
     * The value for the lockedflg field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $lockedflg;

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
     * @var        ChildOpsbiweeklycalendar
     */
    protected $aOpsbiweeklycalendar;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployee;

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
        $this->dailyrate = 0;
        $this->totalteaweight = 0;
        $this->teapay = 0;
        $this->totalparttimehrs = 0;
        $this->parttimepayrate = 0;
        $this->parttimepay = 0;
        $this->otherdaysworked = 0;
        $this->otherhoursworked = 0;
        $this->otherworkpay = 0;
        $this->elecdeduction = 0;
        $this->medicaldeduction = 0;
        $this->nssfdeduction = 0;
        $this->purchasesdeduction = 0;
        $this->otherdeduction = 0;
        $this->bonus = 0;
        $this->payslipnbr = 'F-PS-0000000000';
        $this->lockedflg = 0;
    }

    /**
     * Initializes internal state of lwops\lwops\Base\Casualemployeepayslip object.
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
     * Compares this with another <code>Casualemployeepayslip</code> instance.  If
     * <code>obj</code> is an instance of <code>Casualemployeepayslip</code>, delegates to
     * <code>equals(Casualemployeepayslip)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Casualemployeepayslip The current object, for fluid interface
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
     * Get the [opsbiweeklycalendaroid] column value.
     *
     * @return int
     */
    public function getOpsbiweeklycalendaroid()
    {
        return $this->opsbiweeklycalendaroid;
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
     * Get the [dailyrate] column value.
     *
     * @return double
     */
    public function getDailyrate()
    {
        return $this->dailyrate;
    }

    /**
     * Get the [totalteaweight] column value.
     *
     * @return double
     */
    public function getTotalteaweight()
    {
        return $this->totalteaweight;
    }

    /**
     * Get the [teapayrate] column value.
     *
     * @return double
     */
    public function getTeapayrate()
    {
        return $this->teapayrate;
    }

    /**
     * Get the [teapay] column value.
     *
     * @return double
     */
    public function getTeapay()
    {
        return $this->teapay;
    }

    /**
     * Get the [totalparttimehrs] column value.
     *
     * @return double
     */
    public function getTotalparttimehrs()
    {
        return $this->totalparttimehrs;
    }

    /**
     * Get the [parttimepayrate] column value.
     *
     * @return double
     */
    public function getParttimepayrate()
    {
        return $this->parttimepayrate;
    }

    /**
     * Get the [parttimepay] column value.
     *
     * @return double
     */
    public function getParttimepay()
    {
        return $this->parttimepay;
    }

    /**
     * Get the [otherdaysworked] column value.
     *
     * @return int
     */
    public function getOtherdaysworked()
    {
        return $this->otherdaysworked;
    }

    /**
     * Get the [otherhoursworked] column value.
     *
     * @return double
     */
    public function getOtherhoursworked()
    {
        return $this->otherhoursworked;
    }

    /**
     * Get the [otherworkpay] column value.
     *
     * @return double
     */
    public function getOtherworkpay()
    {
        return $this->otherworkpay;
    }

    /**
     * Get the [elecdeduction] column value.
     *
     * @return double
     */
    public function getElecdeduction()
    {
        return $this->elecdeduction;
    }

    /**
     * Get the [medicaldeduction] column value.
     *
     * @return double
     */
    public function getMedicaldeduction()
    {
        return $this->medicaldeduction;
    }

    /**
     * Get the [nssfdeduction] column value.
     *
     * @return double
     */
    public function getNssfdeduction()
    {
        return $this->nssfdeduction;
    }

    /**
     * Get the [purchasesdeduction] column value.
     *
     * @return double
     */
    public function getPurchasesdeduction()
    {
        return $this->purchasesdeduction;
    }

    /**
     * Get the [otherdeduction] column value.
     *
     * @return double
     */
    public function getOtherdeduction()
    {
        return $this->otherdeduction;
    }

    /**
     * Get the [otherdeductiondescr] column value.
     *
     * @return string
     */
    public function getOtherdeductiondescr()
    {
        return $this->otherdeductiondescr;
    }

    /**
     * Get the [bonus] column value.
     *
     * @return double
     */
    public function getBonus()
    {
        return $this->bonus;
    }

    /**
     * Get the [optionally formatted] temporal [lockdt] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLockdt($format = NULL)
    {
        if ($format === null) {
            return $this->lockdt;
        } else {
            return $this->lockdt instanceof \DateTimeInterface ? $this->lockdt->format($format) : null;
        }
    }

    /**
     * Get the [payslipnbr] column value.
     *
     * @return string
     */
    public function getPayslipnbr()
    {
        return $this->payslipnbr;
    }

    /**
     * Get the [lockedflg] column value.
     *
     * @return int
     */
    public function getLockedflg()
    {
        return $this->lockedflg;
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
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setOid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oid !== $v) {
            $this->oid = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_OID] = true;
        }

        return $this;
    } // setOid()

    /**
     * Set the value of [opsbiweeklycalendaroid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setOpsbiweeklycalendaroid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->opsbiweeklycalendaroid !== $v) {
            $this->opsbiweeklycalendaroid = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_OPSBIWEEKLYCALENDAROID] = true;
        }

        if ($this->aOpsbiweeklycalendar !== null && $this->aOpsbiweeklycalendar->getOid() !== $v) {
            $this->aOpsbiweeklycalendar = null;
        }

        return $this;
    } // setOpsbiweeklycalendaroid()

    /**
     * Set the value of [employeeoid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setEmployeeoid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employeeoid !== $v) {
            $this->employeeoid = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_EMPLOYEEOID] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getOid() !== $v) {
            $this->aEmployee = null;
        }

        return $this;
    } // setEmployeeoid()

    /**
     * Set the value of [dailyrate] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setDailyrate($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->dailyrate !== $v) {
            $this->dailyrate = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_DAILYRATE] = true;
        }

        return $this;
    } // setDailyrate()

    /**
     * Set the value of [totalteaweight] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setTotalteaweight($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->totalteaweight !== $v) {
            $this->totalteaweight = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_TOTALTEAWEIGHT] = true;
        }

        return $this;
    } // setTotalteaweight()

    /**
     * Set the value of [teapayrate] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setTeapayrate($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->teapayrate !== $v) {
            $this->teapayrate = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_TEAPAYRATE] = true;
        }

        return $this;
    } // setTeapayrate()

    /**
     * Set the value of [teapay] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setTeapay($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->teapay !== $v) {
            $this->teapay = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_TEAPAY] = true;
        }

        return $this;
    } // setTeapay()

    /**
     * Set the value of [totalparttimehrs] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setTotalparttimehrs($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->totalparttimehrs !== $v) {
            $this->totalparttimehrs = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_TOTALPARTTIMEHRS] = true;
        }

        return $this;
    } // setTotalparttimehrs()

    /**
     * Set the value of [parttimepayrate] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setParttimepayrate($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->parttimepayrate !== $v) {
            $this->parttimepayrate = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_PARTTIMEPAYRATE] = true;
        }

        return $this;
    } // setParttimepayrate()

    /**
     * Set the value of [parttimepay] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setParttimepay($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->parttimepay !== $v) {
            $this->parttimepay = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_PARTTIMEPAY] = true;
        }

        return $this;
    } // setParttimepay()

    /**
     * Set the value of [otherdaysworked] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setOtherdaysworked($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->otherdaysworked !== $v) {
            $this->otherdaysworked = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_OTHERDAYSWORKED] = true;
        }

        return $this;
    } // setOtherdaysworked()

    /**
     * Set the value of [otherhoursworked] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setOtherhoursworked($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->otherhoursworked !== $v) {
            $this->otherhoursworked = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_OTHERHOURSWORKED] = true;
        }

        return $this;
    } // setOtherhoursworked()

    /**
     * Set the value of [otherworkpay] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setOtherworkpay($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->otherworkpay !== $v) {
            $this->otherworkpay = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_OTHERWORKPAY] = true;
        }

        return $this;
    } // setOtherworkpay()

    /**
     * Set the value of [elecdeduction] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setElecdeduction($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->elecdeduction !== $v) {
            $this->elecdeduction = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_ELECDEDUCTION] = true;
        }

        return $this;
    } // setElecdeduction()

    /**
     * Set the value of [medicaldeduction] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setMedicaldeduction($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->medicaldeduction !== $v) {
            $this->medicaldeduction = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_MEDICALDEDUCTION] = true;
        }

        return $this;
    } // setMedicaldeduction()

    /**
     * Set the value of [nssfdeduction] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setNssfdeduction($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->nssfdeduction !== $v) {
            $this->nssfdeduction = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_NSSFDEDUCTION] = true;
        }

        return $this;
    } // setNssfdeduction()

    /**
     * Set the value of [purchasesdeduction] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setPurchasesdeduction($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->purchasesdeduction !== $v) {
            $this->purchasesdeduction = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_PURCHASESDEDUCTION] = true;
        }

        return $this;
    } // setPurchasesdeduction()

    /**
     * Set the value of [otherdeduction] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setOtherdeduction($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->otherdeduction !== $v) {
            $this->otherdeduction = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_OTHERDEDUCTION] = true;
        }

        return $this;
    } // setOtherdeduction()

    /**
     * Set the value of [otherdeductiondescr] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setOtherdeductiondescr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->otherdeductiondescr !== $v) {
            $this->otherdeductiondescr = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_OTHERDEDUCTIONDESCR] = true;
        }

        return $this;
    } // setOtherdeductiondescr()

    /**
     * Set the value of [bonus] column.
     *
     * @param double $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setBonus($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->bonus !== $v) {
            $this->bonus = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_BONUS] = true;
        }

        return $this;
    } // setBonus()

    /**
     * Sets the value of [lockdt] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setLockdt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->lockdt !== null || $dt !== null) {
            if ($this->lockdt === null || $dt === null || $dt->format("Y-m-d") !== $this->lockdt->format("Y-m-d")) {
                $this->lockdt = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CasualemployeepayslipTableMap::COL_LOCKDT] = true;
            }
        } // if either are not null

        return $this;
    } // setLockdt()

    /**
     * Set the value of [payslipnbr] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setPayslipnbr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->payslipnbr !== $v) {
            $this->payslipnbr = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_PAYSLIPNBR] = true;
        }

        return $this;
    } // setPayslipnbr()

    /**
     * Set the value of [lockedflg] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setLockedflg($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->lockedflg !== $v) {
            $this->lockedflg = $v;
            $this->modifiedColumns[CasualemployeepayslipTableMap::COL_LOCKEDFLG] = true;
        }

        return $this;
    } // setLockedflg()

    /**
     * Sets the value of [createtmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setCreatetmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->createtmstp !== null || $dt !== null) {
            if ($this->createtmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->createtmstp->format("Y-m-d H:i:s.u")) {
                $this->createtmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CasualemployeepayslipTableMap::COL_CREATETMSTP] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatetmstp()

    /**
     * Sets the value of [updttmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     */
    public function setUpdttmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updttmstp !== null || $dt !== null) {
            if ($this->updttmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updttmstp->format("Y-m-d H:i:s.u")) {
                $this->updttmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CasualemployeepayslipTableMap::COL_UPDTTMSTP] = true;
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
            if ($this->dailyrate !== 0) {
                return false;
            }

            if ($this->totalteaweight !== 0) {
                return false;
            }

            if ($this->teapay !== 0) {
                return false;
            }

            if ($this->totalparttimehrs !== 0) {
                return false;
            }

            if ($this->parttimepayrate !== 0) {
                return false;
            }

            if ($this->parttimepay !== 0) {
                return false;
            }

            if ($this->otherdaysworked !== 0) {
                return false;
            }

            if ($this->otherhoursworked !== 0) {
                return false;
            }

            if ($this->otherworkpay !== 0) {
                return false;
            }

            if ($this->elecdeduction !== 0) {
                return false;
            }

            if ($this->medicaldeduction !== 0) {
                return false;
            }

            if ($this->nssfdeduction !== 0) {
                return false;
            }

            if ($this->purchasesdeduction !== 0) {
                return false;
            }

            if ($this->otherdeduction !== 0) {
                return false;
            }

            if ($this->bonus !== 0) {
                return false;
            }

            if ($this->payslipnbr !== 'F-PS-0000000000') {
                return false;
            }

            if ($this->lockedflg !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->oid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Opsbiweeklycalendaroid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->opsbiweeklycalendaroid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Employeeoid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employeeoid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Dailyrate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dailyrate = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Totalteaweight', TableMap::TYPE_PHPNAME, $indexType)];
            $this->totalteaweight = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Teapayrate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->teapayrate = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Teapay', TableMap::TYPE_PHPNAME, $indexType)];
            $this->teapay = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Totalparttimehrs', TableMap::TYPE_PHPNAME, $indexType)];
            $this->totalparttimehrs = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Parttimepayrate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->parttimepayrate = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Parttimepay', TableMap::TYPE_PHPNAME, $indexType)];
            $this->parttimepay = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Otherdaysworked', TableMap::TYPE_PHPNAME, $indexType)];
            $this->otherdaysworked = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Otherhoursworked', TableMap::TYPE_PHPNAME, $indexType)];
            $this->otherhoursworked = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Otherworkpay', TableMap::TYPE_PHPNAME, $indexType)];
            $this->otherworkpay = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Elecdeduction', TableMap::TYPE_PHPNAME, $indexType)];
            $this->elecdeduction = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Medicaldeduction', TableMap::TYPE_PHPNAME, $indexType)];
            $this->medicaldeduction = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Nssfdeduction', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nssfdeduction = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Purchasesdeduction', TableMap::TYPE_PHPNAME, $indexType)];
            $this->purchasesdeduction = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Otherdeduction', TableMap::TYPE_PHPNAME, $indexType)];
            $this->otherdeduction = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Otherdeductiondescr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->otherdeductiondescr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Bonus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bonus = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Lockdt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->lockdt = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Payslipnbr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->payslipnbr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Lockedflg', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lockedflg = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Createtmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->createtmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : CasualemployeepayslipTableMap::translateFieldName('Updttmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updttmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 25; // 25 = CasualemployeepayslipTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\lwops\\lwops\\Casualemployeepayslip'), 0, $e);
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
        if ($this->aOpsbiweeklycalendar !== null && $this->opsbiweeklycalendaroid !== $this->aOpsbiweeklycalendar->getOid()) {
            $this->aOpsbiweeklycalendar = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(CasualemployeepayslipTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCasualemployeepayslipQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aOpsbiweeklycalendar = null;
            $this->aEmployee = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Casualemployeepayslip::setDeleted()
     * @see Casualemployeepayslip::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CasualemployeepayslipTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCasualemployeepayslipQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CasualemployeepayslipTableMap::DATABASE_NAME);
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
                CasualemployeepayslipTableMap::addInstanceToPool($this);
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

            if ($this->aOpsbiweeklycalendar !== null) {
                if ($this->aOpsbiweeklycalendar->isModified() || $this->aOpsbiweeklycalendar->isNew()) {
                    $affectedRows += $this->aOpsbiweeklycalendar->save($con);
                }
                $this->setOpsbiweeklycalendar($this->aOpsbiweeklycalendar);
            }

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

        $this->modifiedColumns[CasualemployeepayslipTableMap::COL_OID] = true;
        if (null !== $this->oid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CasualemployeepayslipTableMap::COL_OID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_OID)) {
            $modifiedColumns[':p' . $index++]  = 'oid';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_OPSBIWEEKLYCALENDAROID)) {
            $modifiedColumns[':p' . $index++]  = 'opsBiWeeklyCalendarOid';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_EMPLOYEEOID)) {
            $modifiedColumns[':p' . $index++]  = 'employeeOid';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_DAILYRATE)) {
            $modifiedColumns[':p' . $index++]  = 'dailyRate';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_TOTALTEAWEIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'totalTeaWeight';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_TEAPAYRATE)) {
            $modifiedColumns[':p' . $index++]  = 'teaPayRate';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_TEAPAY)) {
            $modifiedColumns[':p' . $index++]  = 'teaPay';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_TOTALPARTTIMEHRS)) {
            $modifiedColumns[':p' . $index++]  = 'totalParttimeHrs';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_PARTTIMEPAYRATE)) {
            $modifiedColumns[':p' . $index++]  = 'parttimePayRate';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_PARTTIMEPAY)) {
            $modifiedColumns[':p' . $index++]  = 'parttimePay';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_OTHERDAYSWORKED)) {
            $modifiedColumns[':p' . $index++]  = 'otherDaysWorked';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_OTHERHOURSWORKED)) {
            $modifiedColumns[':p' . $index++]  = 'otherHoursWorked';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_OTHERWORKPAY)) {
            $modifiedColumns[':p' . $index++]  = 'otherworkPay';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_ELECDEDUCTION)) {
            $modifiedColumns[':p' . $index++]  = 'elecDeduction';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_MEDICALDEDUCTION)) {
            $modifiedColumns[':p' . $index++]  = 'medicalDeduction';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_NSSFDEDUCTION)) {
            $modifiedColumns[':p' . $index++]  = 'NSSFdeduction';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_PURCHASESDEDUCTION)) {
            $modifiedColumns[':p' . $index++]  = 'purchasesDeduction';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_OTHERDEDUCTION)) {
            $modifiedColumns[':p' . $index++]  = 'otherDeduction';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_OTHERDEDUCTIONDESCR)) {
            $modifiedColumns[':p' . $index++]  = 'otherDeductionDescr';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_BONUS)) {
            $modifiedColumns[':p' . $index++]  = 'bonus';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_LOCKDT)) {
            $modifiedColumns[':p' . $index++]  = 'lockDt';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_PAYSLIPNBR)) {
            $modifiedColumns[':p' . $index++]  = 'payslipNbr';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_LOCKEDFLG)) {
            $modifiedColumns[':p' . $index++]  = 'lockedFlg';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_CREATETMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'createTmstp';
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_UPDTTMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'updtTmstp';
        }

        $sql = sprintf(
            'INSERT INTO casualemployeepayslip (%s) VALUES (%s)',
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
                    case 'opsBiWeeklyCalendarOid':
                        $stmt->bindValue($identifier, $this->opsbiweeklycalendaroid, PDO::PARAM_INT);
                        break;
                    case 'employeeOid':
                        $stmt->bindValue($identifier, $this->employeeoid, PDO::PARAM_INT);
                        break;
                    case 'dailyRate':
                        $stmt->bindValue($identifier, $this->dailyrate, PDO::PARAM_STR);
                        break;
                    case 'totalTeaWeight':
                        $stmt->bindValue($identifier, $this->totalteaweight, PDO::PARAM_STR);
                        break;
                    case 'teaPayRate':
                        $stmt->bindValue($identifier, $this->teapayrate, PDO::PARAM_STR);
                        break;
                    case 'teaPay':
                        $stmt->bindValue($identifier, $this->teapay, PDO::PARAM_STR);
                        break;
                    case 'totalParttimeHrs':
                        $stmt->bindValue($identifier, $this->totalparttimehrs, PDO::PARAM_STR);
                        break;
                    case 'parttimePayRate':
                        $stmt->bindValue($identifier, $this->parttimepayrate, PDO::PARAM_STR);
                        break;
                    case 'parttimePay':
                        $stmt->bindValue($identifier, $this->parttimepay, PDO::PARAM_STR);
                        break;
                    case 'otherDaysWorked':
                        $stmt->bindValue($identifier, $this->otherdaysworked, PDO::PARAM_INT);
                        break;
                    case 'otherHoursWorked':
                        $stmt->bindValue($identifier, $this->otherhoursworked, PDO::PARAM_STR);
                        break;
                    case 'otherworkPay':
                        $stmt->bindValue($identifier, $this->otherworkpay, PDO::PARAM_STR);
                        break;
                    case 'elecDeduction':
                        $stmt->bindValue($identifier, $this->elecdeduction, PDO::PARAM_STR);
                        break;
                    case 'medicalDeduction':
                        $stmt->bindValue($identifier, $this->medicaldeduction, PDO::PARAM_STR);
                        break;
                    case 'NSSFdeduction':
                        $stmt->bindValue($identifier, $this->nssfdeduction, PDO::PARAM_STR);
                        break;
                    case 'purchasesDeduction':
                        $stmt->bindValue($identifier, $this->purchasesdeduction, PDO::PARAM_STR);
                        break;
                    case 'otherDeduction':
                        $stmt->bindValue($identifier, $this->otherdeduction, PDO::PARAM_STR);
                        break;
                    case 'otherDeductionDescr':
                        $stmt->bindValue($identifier, $this->otherdeductiondescr, PDO::PARAM_STR);
                        break;
                    case 'bonus':
                        $stmt->bindValue($identifier, $this->bonus, PDO::PARAM_STR);
                        break;
                    case 'lockDt':
                        $stmt->bindValue($identifier, $this->lockdt ? $this->lockdt->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'payslipNbr':
                        $stmt->bindValue($identifier, $this->payslipnbr, PDO::PARAM_STR);
                        break;
                    case 'lockedFlg':
                        $stmt->bindValue($identifier, $this->lockedflg, PDO::PARAM_INT);
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
        $pos = CasualemployeepayslipTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOpsbiweeklycalendaroid();
                break;
            case 2:
                return $this->getEmployeeoid();
                break;
            case 3:
                return $this->getDailyrate();
                break;
            case 4:
                return $this->getTotalteaweight();
                break;
            case 5:
                return $this->getTeapayrate();
                break;
            case 6:
                return $this->getTeapay();
                break;
            case 7:
                return $this->getTotalparttimehrs();
                break;
            case 8:
                return $this->getParttimepayrate();
                break;
            case 9:
                return $this->getParttimepay();
                break;
            case 10:
                return $this->getOtherdaysworked();
                break;
            case 11:
                return $this->getOtherhoursworked();
                break;
            case 12:
                return $this->getOtherworkpay();
                break;
            case 13:
                return $this->getElecdeduction();
                break;
            case 14:
                return $this->getMedicaldeduction();
                break;
            case 15:
                return $this->getNssfdeduction();
                break;
            case 16:
                return $this->getPurchasesdeduction();
                break;
            case 17:
                return $this->getOtherdeduction();
                break;
            case 18:
                return $this->getOtherdeductiondescr();
                break;
            case 19:
                return $this->getBonus();
                break;
            case 20:
                return $this->getLockdt();
                break;
            case 21:
                return $this->getPayslipnbr();
                break;
            case 22:
                return $this->getLockedflg();
                break;
            case 23:
                return $this->getCreatetmstp();
                break;
            case 24:
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

        if (isset($alreadyDumpedObjects['Casualemployeepayslip'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Casualemployeepayslip'][$this->hashCode()] = true;
        $keys = CasualemployeepayslipTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOid(),
            $keys[1] => $this->getOpsbiweeklycalendaroid(),
            $keys[2] => $this->getEmployeeoid(),
            $keys[3] => $this->getDailyrate(),
            $keys[4] => $this->getTotalteaweight(),
            $keys[5] => $this->getTeapayrate(),
            $keys[6] => $this->getTeapay(),
            $keys[7] => $this->getTotalparttimehrs(),
            $keys[8] => $this->getParttimepayrate(),
            $keys[9] => $this->getParttimepay(),
            $keys[10] => $this->getOtherdaysworked(),
            $keys[11] => $this->getOtherhoursworked(),
            $keys[12] => $this->getOtherworkpay(),
            $keys[13] => $this->getElecdeduction(),
            $keys[14] => $this->getMedicaldeduction(),
            $keys[15] => $this->getNssfdeduction(),
            $keys[16] => $this->getPurchasesdeduction(),
            $keys[17] => $this->getOtherdeduction(),
            $keys[18] => $this->getOtherdeductiondescr(),
            $keys[19] => $this->getBonus(),
            $keys[20] => $this->getLockdt(),
            $keys[21] => $this->getPayslipnbr(),
            $keys[22] => $this->getLockedflg(),
            $keys[23] => $this->getCreatetmstp(),
            $keys[24] => $this->getUpdttmstp(),
        );
        if ($result[$keys[20]] instanceof \DateTimeInterface) {
            $result[$keys[20]] = $result[$keys[20]]->format('c');
        }

        if ($result[$keys[23]] instanceof \DateTimeInterface) {
            $result[$keys[23]] = $result[$keys[23]]->format('c');
        }

        if ($result[$keys[24]] instanceof \DateTimeInterface) {
            $result[$keys[24]] = $result[$keys[24]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aOpsbiweeklycalendar) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'opsbiweeklycalendar';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'opsbiweeklycalendar';
                        break;
                    default:
                        $key = 'Opsbiweeklycalendar';
                }

                $result[$key] = $this->aOpsbiweeklycalendar->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\lwops\lwops\Casualemployeepayslip
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CasualemployeepayslipTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\lwops\lwops\Casualemployeepayslip
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setOid($value);
                break;
            case 1:
                $this->setOpsbiweeklycalendaroid($value);
                break;
            case 2:
                $this->setEmployeeoid($value);
                break;
            case 3:
                $this->setDailyrate($value);
                break;
            case 4:
                $this->setTotalteaweight($value);
                break;
            case 5:
                $this->setTeapayrate($value);
                break;
            case 6:
                $this->setTeapay($value);
                break;
            case 7:
                $this->setTotalparttimehrs($value);
                break;
            case 8:
                $this->setParttimepayrate($value);
                break;
            case 9:
                $this->setParttimepay($value);
                break;
            case 10:
                $this->setOtherdaysworked($value);
                break;
            case 11:
                $this->setOtherhoursworked($value);
                break;
            case 12:
                $this->setOtherworkpay($value);
                break;
            case 13:
                $this->setElecdeduction($value);
                break;
            case 14:
                $this->setMedicaldeduction($value);
                break;
            case 15:
                $this->setNssfdeduction($value);
                break;
            case 16:
                $this->setPurchasesdeduction($value);
                break;
            case 17:
                $this->setOtherdeduction($value);
                break;
            case 18:
                $this->setOtherdeductiondescr($value);
                break;
            case 19:
                $this->setBonus($value);
                break;
            case 20:
                $this->setLockdt($value);
                break;
            case 21:
                $this->setPayslipnbr($value);
                break;
            case 22:
                $this->setLockedflg($value);
                break;
            case 23:
                $this->setCreatetmstp($value);
                break;
            case 24:
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
        $keys = CasualemployeepayslipTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOpsbiweeklycalendaroid($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEmployeeoid($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDailyrate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTotalteaweight($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setTeapayrate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setTeapay($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setTotalparttimehrs($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setParttimepayrate($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setParttimepay($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setOtherdaysworked($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setOtherhoursworked($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setOtherworkpay($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setElecdeduction($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setMedicaldeduction($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setNssfdeduction($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setPurchasesdeduction($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setOtherdeduction($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setOtherdeductiondescr($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setBonus($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setLockdt($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setPayslipnbr($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setLockedflg($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setCreatetmstp($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setUpdttmstp($arr[$keys[24]]);
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
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object, for fluid interface
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
        $criteria = new Criteria(CasualemployeepayslipTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_OID)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_OID, $this->oid);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_OPSBIWEEKLYCALENDAROID)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_OPSBIWEEKLYCALENDAROID, $this->opsbiweeklycalendaroid);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_EMPLOYEEOID)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_EMPLOYEEOID, $this->employeeoid);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_DAILYRATE)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_DAILYRATE, $this->dailyrate);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_TOTALTEAWEIGHT)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_TOTALTEAWEIGHT, $this->totalteaweight);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_TEAPAYRATE)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_TEAPAYRATE, $this->teapayrate);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_TEAPAY)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_TEAPAY, $this->teapay);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_TOTALPARTTIMEHRS)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_TOTALPARTTIMEHRS, $this->totalparttimehrs);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_PARTTIMEPAYRATE)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_PARTTIMEPAYRATE, $this->parttimepayrate);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_PARTTIMEPAY)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_PARTTIMEPAY, $this->parttimepay);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_OTHERDAYSWORKED)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_OTHERDAYSWORKED, $this->otherdaysworked);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_OTHERHOURSWORKED)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_OTHERHOURSWORKED, $this->otherhoursworked);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_OTHERWORKPAY)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_OTHERWORKPAY, $this->otherworkpay);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_ELECDEDUCTION)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_ELECDEDUCTION, $this->elecdeduction);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_MEDICALDEDUCTION)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_MEDICALDEDUCTION, $this->medicaldeduction);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_NSSFDEDUCTION)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_NSSFDEDUCTION, $this->nssfdeduction);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_PURCHASESDEDUCTION)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_PURCHASESDEDUCTION, $this->purchasesdeduction);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_OTHERDEDUCTION)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_OTHERDEDUCTION, $this->otherdeduction);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_OTHERDEDUCTIONDESCR)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_OTHERDEDUCTIONDESCR, $this->otherdeductiondescr);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_BONUS)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_BONUS, $this->bonus);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_LOCKDT)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_LOCKDT, $this->lockdt);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_PAYSLIPNBR)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_PAYSLIPNBR, $this->payslipnbr);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_LOCKEDFLG)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_LOCKEDFLG, $this->lockedflg);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_CREATETMSTP)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_CREATETMSTP, $this->createtmstp);
        }
        if ($this->isColumnModified(CasualemployeepayslipTableMap::COL_UPDTTMSTP)) {
            $criteria->add(CasualemployeepayslipTableMap::COL_UPDTTMSTP, $this->updttmstp);
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
        $criteria = ChildCasualemployeepayslipQuery::create();
        $criteria->add(CasualemployeepayslipTableMap::COL_OID, $this->oid);

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
     * @param      object $copyObj An object of \lwops\lwops\Casualemployeepayslip (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setOpsbiweeklycalendaroid($this->getOpsbiweeklycalendaroid());
        $copyObj->setEmployeeoid($this->getEmployeeoid());
        $copyObj->setDailyrate($this->getDailyrate());
        $copyObj->setTotalteaweight($this->getTotalteaweight());
        $copyObj->setTeapayrate($this->getTeapayrate());
        $copyObj->setTeapay($this->getTeapay());
        $copyObj->setTotalparttimehrs($this->getTotalparttimehrs());
        $copyObj->setParttimepayrate($this->getParttimepayrate());
        $copyObj->setParttimepay($this->getParttimepay());
        $copyObj->setOtherdaysworked($this->getOtherdaysworked());
        $copyObj->setOtherhoursworked($this->getOtherhoursworked());
        $copyObj->setOtherworkpay($this->getOtherworkpay());
        $copyObj->setElecdeduction($this->getElecdeduction());
        $copyObj->setMedicaldeduction($this->getMedicaldeduction());
        $copyObj->setNssfdeduction($this->getNssfdeduction());
        $copyObj->setPurchasesdeduction($this->getPurchasesdeduction());
        $copyObj->setOtherdeduction($this->getOtherdeduction());
        $copyObj->setOtherdeductiondescr($this->getOtherdeductiondescr());
        $copyObj->setBonus($this->getBonus());
        $copyObj->setLockdt($this->getLockdt());
        $copyObj->setPayslipnbr($this->getPayslipnbr());
        $copyObj->setLockedflg($this->getLockedflg());
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
     * @return \lwops\lwops\Casualemployeepayslip Clone of current object.
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
     * Declares an association between this object and a ChildOpsbiweeklycalendar object.
     *
     * @param  ChildOpsbiweeklycalendar $v
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
     * @throws PropelException
     */
    public function setOpsbiweeklycalendar(ChildOpsbiweeklycalendar $v = null)
    {
        if ($v === null) {
            $this->setOpsbiweeklycalendaroid(NULL);
        } else {
            $this->setOpsbiweeklycalendaroid($v->getOid());
        }

        $this->aOpsbiweeklycalendar = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOpsbiweeklycalendar object, it will not be re-added.
        if ($v !== null) {
            $v->addCasualemployeepayslip($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOpsbiweeklycalendar object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildOpsbiweeklycalendar The associated ChildOpsbiweeklycalendar object.
     * @throws PropelException
     */
    public function getOpsbiweeklycalendar(ConnectionInterface $con = null)
    {
        if ($this->aOpsbiweeklycalendar === null && ($this->opsbiweeklycalendaroid !== null)) {
            $this->aOpsbiweeklycalendar = ChildOpsbiweeklycalendarQuery::create()->findPk($this->opsbiweeklycalendaroid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOpsbiweeklycalendar->addCasualemployeepayslips($this);
             */
        }

        return $this->aOpsbiweeklycalendar;
    }

    /**
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param  ChildEmployee $v
     * @return $this|\lwops\lwops\Casualemployeepayslip The current object (for fluent API support)
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
            $v->addCasualemployeepayslip($this);
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
                $this->aEmployee->addCasualemployeepayslips($this);
             */
        }

        return $this->aEmployee;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aOpsbiweeklycalendar) {
            $this->aOpsbiweeklycalendar->removeCasualemployeepayslip($this);
        }
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeCasualemployeepayslip($this);
        }
        $this->oid = null;
        $this->opsbiweeklycalendaroid = null;
        $this->employeeoid = null;
        $this->dailyrate = null;
        $this->totalteaweight = null;
        $this->teapayrate = null;
        $this->teapay = null;
        $this->totalparttimehrs = null;
        $this->parttimepayrate = null;
        $this->parttimepay = null;
        $this->otherdaysworked = null;
        $this->otherhoursworked = null;
        $this->otherworkpay = null;
        $this->elecdeduction = null;
        $this->medicaldeduction = null;
        $this->nssfdeduction = null;
        $this->purchasesdeduction = null;
        $this->otherdeduction = null;
        $this->otherdeductiondescr = null;
        $this->bonus = null;
        $this->lockdt = null;
        $this->payslipnbr = null;
        $this->lockedflg = null;
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

        $this->aOpsbiweeklycalendar = null;
        $this->aEmployee = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CasualemployeepayslipTableMap::DEFAULT_STRING_FORMAT);
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
