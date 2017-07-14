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
use lwops\lwops\Casualemployeepayslip as ChildCasualemployeepayslip;
use lwops\lwops\CasualemployeepayslipQuery as ChildCasualemployeepayslipQuery;
use lwops\lwops\Employee as ChildEmployee;
use lwops\lwops\EmployeeQuery as ChildEmployeeQuery;
use lwops\lwops\Employeeloan as ChildEmployeeloan;
use lwops\lwops\EmployeeloanQuery as ChildEmployeeloanQuery;
use lwops\lwops\Employeeotherdeduction as ChildEmployeeotherdeduction;
use lwops\lwops\EmployeeotherdeductionQuery as ChildEmployeeotherdeductionQuery;
use lwops\lwops\Employeepurchases as ChildEmployeepurchases;
use lwops\lwops\EmployeepurchasesQuery as ChildEmployeepurchasesQuery;
use lwops\lwops\Employeerole as ChildEmployeerole;
use lwops\lwops\EmployeeroleQuery as ChildEmployeeroleQuery;
use lwops\lwops\Employeesalaryexpenseallocation as ChildEmployeesalaryexpenseallocation;
use lwops\lwops\EmployeesalaryexpenseallocationQuery as ChildEmployeesalaryexpenseallocationQuery;
use lwops\lwops\Employeetermination as ChildEmployeetermination;
use lwops\lwops\EmployeeterminationQuery as ChildEmployeeterminationQuery;
use lwops\lwops\Fteemployeepayslip as ChildFteemployeepayslip;
use lwops\lwops\FteemployeepayslipQuery as ChildFteemployeepayslipQuery;
use lwops\lwops\Ftesalaryadvance as ChildFtesalaryadvance;
use lwops\lwops\FtesalaryadvanceQuery as ChildFtesalaryadvanceQuery;
use lwops\lwops\Medicaldeduction as ChildMedicaldeduction;
use lwops\lwops\MedicaldeductionQuery as ChildMedicaldeductionQuery;
use lwops\lwops\Nssfdeduction as ChildNssfdeduction;
use lwops\lwops\NssfdeductionQuery as ChildNssfdeductionQuery;
use lwops\lwops\Parttimedetail as ChildParttimedetail;
use lwops\lwops\ParttimedetailQuery as ChildParttimedetailQuery;
use lwops\lwops\Salary as ChildSalary;
use lwops\lwops\SalaryQuery as ChildSalaryQuery;
use lwops\lwops\Map\AttendanceTableMap;
use lwops\lwops\Map\CasualemployeepayslipTableMap;
use lwops\lwops\Map\EmployeeTableMap;
use lwops\lwops\Map\EmployeeloanTableMap;
use lwops\lwops\Map\EmployeeotherdeductionTableMap;
use lwops\lwops\Map\EmployeepurchasesTableMap;
use lwops\lwops\Map\EmployeeroleTableMap;
use lwops\lwops\Map\EmployeesalaryexpenseallocationTableMap;
use lwops\lwops\Map\EmployeeterminationTableMap;
use lwops\lwops\Map\FteemployeepayslipTableMap;
use lwops\lwops\Map\FtesalaryadvanceTableMap;
use lwops\lwops\Map\MedicaldeductionTableMap;
use lwops\lwops\Map\NssfdeductionTableMap;
use lwops\lwops\Map\ParttimedetailTableMap;
use lwops\lwops\Map\SalaryTableMap;

/**
 * Base class that represents a row from the 'employee' table.
 *
 *
 *
 * @package    propel.generator.lwops.lwops.Base
 */
abstract class Employee implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\lwops\\lwops\\Map\\EmployeeTableMap';


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
     * The value for the firstname field.
     *
     * @var        string
     */
    protected $firstname;

    /**
     * The value for the middleinitial field.
     *
     * Note: this column has a database default value of: 'X'
     * @var        string
     */
    protected $middleinitial;

    /**
     * The value for the lastname field.
     *
     * @var        string
     */
    protected $lastname;

    /**
     * The value for the nationalid field.
     *
     * Note: this column has a database default value of: '1000000001'
     * @var        string
     */
    protected $nationalid;

    /**
     * The value for the mobilenbr field.
     *
     * Note: this column has a database default value of: '0720000000'
     * @var        string
     */
    protected $mobilenbr;

    /**
     * The value for the resident field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $resident;

    /**
     * The value for the elecdeduction field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $elecdeduction;

    /**
     * The value for the epayment field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $epayment;

    /**
     * The value for the active field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $active;

    /**
     * The value for the startdt field.
     *
     * @var        DateTime
     */
    protected $startdt;

    /**
     * The value for the gender field.
     *
     * Note: this column has a database default value of: 'M'
     * @var        string
     */
    protected $gender;

    /**
     * The value for the terminated field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $terminated;

    /**
     * The value for the dateofbirth field.
     *
     * @var        DateTime
     */
    protected $dateofbirth;

    /**
     * The value for the maritalstatus field.
     *
     * @var        string
     */
    protected $maritalstatus;

    /**
     * The value for the spousefirstnm field.
     *
     * @var        string
     */
    protected $spousefirstnm;

    /**
     * The value for the spouselastnm field.
     *
     * @var        string
     */
    protected $spouselastnm;

    /**
     * The value for the spousemobnbr field.
     *
     * @var        string
     */
    protected $spousemobnbr;

    /**
     * The value for the prevemployername field.
     *
     * @var        string
     */
    protected $prevemployername;

    /**
     * The value for the prevemployertelnbr field.
     *
     * @var        string
     */
    protected $prevemployertelnbr;

    /**
     * The value for the prevemployerstartdt field.
     *
     * @var        DateTime
     */
    protected $prevemployerstartdt;

    /**
     * The value for the prevemployerenddt field.
     *
     * @var        DateTime
     */
    protected $prevemployerenddt;

    /**
     * The value for the prevemployerleavingreason field.
     *
     * @var        string
     */
    protected $prevemployerleavingreason;

    /**
     * The value for the prevemployerlocation field.
     *
     * @var        string
     */
    protected $prevemployerlocation;

    /**
     * The value for the workdoneatprevemployer field.
     *
     * @var        string
     */
    protected $workdoneatprevemployer;

    /**
     * The value for the nxtofkinfirstnm field.
     *
     * @var        string
     */
    protected $nxtofkinfirstnm;

    /**
     * The value for the nxtofkinlastnm field.
     *
     * @var        string
     */
    protected $nxtofkinlastnm;

    /**
     * The value for the nxtofkinmobilenbr field.
     *
     * @var        string
     */
    protected $nxtofkinmobilenbr;

    /**
     * The value for the nxtofkinresidence field.
     *
     * @var        string
     */
    protected $nxtofkinresidence;

    /**
     * The value for the nxtofkinrelationship field.
     *
     * @var        string
     */
    protected $nxtofkinrelationship;

    /**
     * The value for the nxtofkinplaceofwork field.
     *
     * @var        string
     */
    protected $nxtofkinplaceofwork;

    /**
     * The value for the comment field.
     *
     * @var        string
     */
    protected $comment;

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
     * @var        ObjectCollection|ChildAttendance[] Collection to store aggregation of ChildAttendance objects.
     */
    protected $collAttendances;
    protected $collAttendancesPartial;

    /**
     * @var        ObjectCollection|ChildCasualemployeepayslip[] Collection to store aggregation of ChildCasualemployeepayslip objects.
     */
    protected $collCasualemployeepayslips;
    protected $collCasualemployeepayslipsPartial;

    /**
     * @var        ObjectCollection|ChildEmployeeloan[] Collection to store aggregation of ChildEmployeeloan objects.
     */
    protected $collEmployeeloans;
    protected $collEmployeeloansPartial;

    /**
     * @var        ObjectCollection|ChildEmployeeotherdeduction[] Collection to store aggregation of ChildEmployeeotherdeduction objects.
     */
    protected $collEmployeeotherdeductions;
    protected $collEmployeeotherdeductionsPartial;

    /**
     * @var        ObjectCollection|ChildEmployeepurchases[] Collection to store aggregation of ChildEmployeepurchases objects.
     */
    protected $collEmployeepurchasess;
    protected $collEmployeepurchasessPartial;

    /**
     * @var        ObjectCollection|ChildEmployeerole[] Collection to store aggregation of ChildEmployeerole objects.
     */
    protected $collEmployeeroles;
    protected $collEmployeerolesPartial;

    /**
     * @var        ObjectCollection|ChildEmployeesalaryexpenseallocation[] Collection to store aggregation of ChildEmployeesalaryexpenseallocation objects.
     */
    protected $collEmployeesalaryexpenseallocations;
    protected $collEmployeesalaryexpenseallocationsPartial;

    /**
     * @var        ObjectCollection|ChildEmployeetermination[] Collection to store aggregation of ChildEmployeetermination objects.
     */
    protected $collEmployeeterminations;
    protected $collEmployeeterminationsPartial;

    /**
     * @var        ObjectCollection|ChildFteemployeepayslip[] Collection to store aggregation of ChildFteemployeepayslip objects.
     */
    protected $collFteemployeepayslips;
    protected $collFteemployeepayslipsPartial;

    /**
     * @var        ObjectCollection|ChildFtesalaryadvance[] Collection to store aggregation of ChildFtesalaryadvance objects.
     */
    protected $collFtesalaryadvances;
    protected $collFtesalaryadvancesPartial;

    /**
     * @var        ObjectCollection|ChildMedicaldeduction[] Collection to store aggregation of ChildMedicaldeduction objects.
     */
    protected $collMedicaldeductions;
    protected $collMedicaldeductionsPartial;

    /**
     * @var        ObjectCollection|ChildNssfdeduction[] Collection to store aggregation of ChildNssfdeduction objects.
     */
    protected $collNssfdeductions;
    protected $collNssfdeductionsPartial;

    /**
     * @var        ObjectCollection|ChildParttimedetail[] Collection to store aggregation of ChildParttimedetail objects.
     */
    protected $collParttimedetails;
    protected $collParttimedetailsPartial;

    /**
     * @var        ObjectCollection|ChildSalary[] Collection to store aggregation of ChildSalary objects.
     */
    protected $collSalaries;
    protected $collSalariesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAttendance[]
     */
    protected $attendancesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCasualemployeepayslip[]
     */
    protected $casualemployeepayslipsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeeloan[]
     */
    protected $employeeloansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeeotherdeduction[]
     */
    protected $employeeotherdeductionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeepurchases[]
     */
    protected $employeepurchasessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeerole[]
     */
    protected $employeerolesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeesalaryexpenseallocation[]
     */
    protected $employeesalaryexpenseallocationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeetermination[]
     */
    protected $employeeterminationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFteemployeepayslip[]
     */
    protected $fteemployeepayslipsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFtesalaryadvance[]
     */
    protected $ftesalaryadvancesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMedicaldeduction[]
     */
    protected $medicaldeductionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildNssfdeduction[]
     */
    protected $nssfdeductionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildParttimedetail[]
     */
    protected $parttimedetailsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSalary[]
     */
    protected $salariesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->middleinitial = 'X';
        $this->nationalid = '1000000001';
        $this->mobilenbr = '0720000000';
        $this->resident = false;
        $this->elecdeduction = true;
        $this->epayment = false;
        $this->active = true;
        $this->gender = 'M';
        $this->terminated = false;
    }

    /**
     * Initializes internal state of lwops\lwops\Base\Employee object.
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
     * Compares this with another <code>Employee</code> instance.  If
     * <code>obj</code> is an instance of <code>Employee</code>, delegates to
     * <code>equals(Employee)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Employee The current object, for fluid interface
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
     * Get the [firstname] column value.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Get the [middleinitial] column value.
     *
     * @return string
     */
    public function getMiddleinitial()
    {
        return $this->middleinitial;
    }

    /**
     * Get the [lastname] column value.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Get the [nationalid] column value.
     *
     * @return string
     */
    public function getNationalid()
    {
        return $this->nationalid;
    }

    /**
     * Get the [mobilenbr] column value.
     *
     * @return string
     */
    public function getMobilenbr()
    {
        return $this->mobilenbr;
    }

    /**
     * Get the [resident] column value.
     *
     * @return boolean
     */
    public function getResident()
    {
        return $this->resident;
    }

    /**
     * Get the [resident] column value.
     *
     * @return boolean
     */
    public function isResident()
    {
        return $this->getResident();
    }

    /**
     * Get the [elecdeduction] column value.
     *
     * @return boolean
     */
    public function getElecdeduction()
    {
        return $this->elecdeduction;
    }

    /**
     * Get the [elecdeduction] column value.
     *
     * @return boolean
     */
    public function isElecdeduction()
    {
        return $this->getElecdeduction();
    }

    /**
     * Get the [epayment] column value.
     *
     * @return boolean
     */
    public function getEpayment()
    {
        return $this->epayment;
    }

    /**
     * Get the [epayment] column value.
     *
     * @return boolean
     */
    public function isEpayment()
    {
        return $this->getEpayment();
    }

    /**
     * Get the [active] column value.
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get the [active] column value.
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->getActive();
    }

    /**
     * Get the [optionally formatted] temporal [startdt] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getStartdt($format = NULL)
    {
        if ($format === null) {
            return $this->startdt;
        } else {
            return $this->startdt instanceof \DateTimeInterface ? $this->startdt->format($format) : null;
        }
    }

    /**
     * Get the [gender] column value.
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Get the [terminated] column value.
     *
     * @return boolean
     */
    public function getTerminated()
    {
        return $this->terminated;
    }

    /**
     * Get the [terminated] column value.
     *
     * @return boolean
     */
    public function isTerminated()
    {
        return $this->getTerminated();
    }

    /**
     * Get the [optionally formatted] temporal [dateofbirth] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateofbirth($format = NULL)
    {
        if ($format === null) {
            return $this->dateofbirth;
        } else {
            return $this->dateofbirth instanceof \DateTimeInterface ? $this->dateofbirth->format($format) : null;
        }
    }

    /**
     * Get the [maritalstatus] column value.
     *
     * @return string
     */
    public function getMaritalstatus()
    {
        return $this->maritalstatus;
    }

    /**
     * Get the [spousefirstnm] column value.
     *
     * @return string
     */
    public function getSpousefirstnm()
    {
        return $this->spousefirstnm;
    }

    /**
     * Get the [spouselastnm] column value.
     *
     * @return string
     */
    public function getSpouselastnm()
    {
        return $this->spouselastnm;
    }

    /**
     * Get the [spousemobnbr] column value.
     *
     * @return string
     */
    public function getSpousemobnbr()
    {
        return $this->spousemobnbr;
    }

    /**
     * Get the [prevemployername] column value.
     *
     * @return string
     */
    public function getPrevemployername()
    {
        return $this->prevemployername;
    }

    /**
     * Get the [prevemployertelnbr] column value.
     *
     * @return string
     */
    public function getPrevemployertelnbr()
    {
        return $this->prevemployertelnbr;
    }

    /**
     * Get the [optionally formatted] temporal [prevemployerstartdt] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPrevemployerstartdt($format = NULL)
    {
        if ($format === null) {
            return $this->prevemployerstartdt;
        } else {
            return $this->prevemployerstartdt instanceof \DateTimeInterface ? $this->prevemployerstartdt->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [prevemployerenddt] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPrevemployerenddt($format = NULL)
    {
        if ($format === null) {
            return $this->prevemployerenddt;
        } else {
            return $this->prevemployerenddt instanceof \DateTimeInterface ? $this->prevemployerenddt->format($format) : null;
        }
    }

    /**
     * Get the [prevemployerleavingreason] column value.
     *
     * @return string
     */
    public function getPrevemployerleavingreason()
    {
        return $this->prevemployerleavingreason;
    }

    /**
     * Get the [prevemployerlocation] column value.
     *
     * @return string
     */
    public function getPrevemployerlocation()
    {
        return $this->prevemployerlocation;
    }

    /**
     * Get the [workdoneatprevemployer] column value.
     *
     * @return string
     */
    public function getWorkdoneatprevemployer()
    {
        return $this->workdoneatprevemployer;
    }

    /**
     * Get the [nxtofkinfirstnm] column value.
     *
     * @return string
     */
    public function getNxtofkinfirstnm()
    {
        return $this->nxtofkinfirstnm;
    }

    /**
     * Get the [nxtofkinlastnm] column value.
     *
     * @return string
     */
    public function getNxtofkinlastnm()
    {
        return $this->nxtofkinlastnm;
    }

    /**
     * Get the [nxtofkinmobilenbr] column value.
     *
     * @return string
     */
    public function getNxtofkinmobilenbr()
    {
        return $this->nxtofkinmobilenbr;
    }

    /**
     * Get the [nxtofkinresidence] column value.
     *
     * @return string
     */
    public function getNxtofkinresidence()
    {
        return $this->nxtofkinresidence;
    }

    /**
     * Get the [nxtofkinrelationship] column value.
     *
     * @return string
     */
    public function getNxtofkinrelationship()
    {
        return $this->nxtofkinrelationship;
    }

    /**
     * Get the [nxtofkinplaceofwork] column value.
     *
     * @return string
     */
    public function getNxtofkinplaceofwork()
    {
        return $this->nxtofkinplaceofwork;
    }

    /**
     * Get the [comment] column value.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
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
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setOid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oid !== $v) {
            $this->oid = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_OID] = true;
        }

        return $this;
    } // setOid()

    /**
     * Set the value of [firstname] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setFirstname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->firstname !== $v) {
            $this->firstname = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_FIRSTNAME] = true;
        }

        return $this;
    } // setFirstname()

    /**
     * Set the value of [middleinitial] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setMiddleinitial($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->middleinitial !== $v) {
            $this->middleinitial = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_MIDDLEINITIAL] = true;
        }

        return $this;
    } // setMiddleinitial()

    /**
     * Set the value of [lastname] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setLastname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lastname !== $v) {
            $this->lastname = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_LASTNAME] = true;
        }

        return $this;
    } // setLastname()

    /**
     * Set the value of [nationalid] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setNationalid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nationalid !== $v) {
            $this->nationalid = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_NATIONALID] = true;
        }

        return $this;
    } // setNationalid()

    /**
     * Set the value of [mobilenbr] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setMobilenbr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mobilenbr !== $v) {
            $this->mobilenbr = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_MOBILENBR] = true;
        }

        return $this;
    } // setMobilenbr()

    /**
     * Sets the value of the [resident] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setResident($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->resident !== $v) {
            $this->resident = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_RESIDENT] = true;
        }

        return $this;
    } // setResident()

    /**
     * Sets the value of the [elecdeduction] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setElecdeduction($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->elecdeduction !== $v) {
            $this->elecdeduction = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_ELECDEDUCTION] = true;
        }

        return $this;
    } // setElecdeduction()

    /**
     * Sets the value of the [epayment] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setEpayment($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->epayment !== $v) {
            $this->epayment = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_EPAYMENT] = true;
        }

        return $this;
    } // setEpayment()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_ACTIVE] = true;
        }

        return $this;
    } // setActive()

    /**
     * Sets the value of [startdt] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setStartdt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->startdt !== null || $dt !== null) {
            if ($this->startdt === null || $dt === null || $dt->format("Y-m-d") !== $this->startdt->format("Y-m-d")) {
                $this->startdt = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EmployeeTableMap::COL_STARTDT] = true;
            }
        } // if either are not null

        return $this;
    } // setStartdt()

    /**
     * Set the value of [gender] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setGender($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gender !== $v) {
            $this->gender = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_GENDER] = true;
        }

        return $this;
    } // setGender()

    /**
     * Sets the value of the [terminated] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setTerminated($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->terminated !== $v) {
            $this->terminated = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_TERMINATED] = true;
        }

        return $this;
    } // setTerminated()

    /**
     * Sets the value of [dateofbirth] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setDateofbirth($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->dateofbirth !== null || $dt !== null) {
            if ($this->dateofbirth === null || $dt === null || $dt->format("Y-m-d") !== $this->dateofbirth->format("Y-m-d")) {
                $this->dateofbirth = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EmployeeTableMap::COL_DATEOFBIRTH] = true;
            }
        } // if either are not null

        return $this;
    } // setDateofbirth()

    /**
     * Set the value of [maritalstatus] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setMaritalstatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->maritalstatus !== $v) {
            $this->maritalstatus = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_MARITALSTATUS] = true;
        }

        return $this;
    } // setMaritalstatus()

    /**
     * Set the value of [spousefirstnm] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setSpousefirstnm($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->spousefirstnm !== $v) {
            $this->spousefirstnm = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_SPOUSEFIRSTNM] = true;
        }

        return $this;
    } // setSpousefirstnm()

    /**
     * Set the value of [spouselastnm] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setSpouselastnm($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->spouselastnm !== $v) {
            $this->spouselastnm = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_SPOUSELASTNM] = true;
        }

        return $this;
    } // setSpouselastnm()

    /**
     * Set the value of [spousemobnbr] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setSpousemobnbr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->spousemobnbr !== $v) {
            $this->spousemobnbr = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_SPOUSEMOBNBR] = true;
        }

        return $this;
    } // setSpousemobnbr()

    /**
     * Set the value of [prevemployername] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setPrevemployername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->prevemployername !== $v) {
            $this->prevemployername = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_PREVEMPLOYERNAME] = true;
        }

        return $this;
    } // setPrevemployername()

    /**
     * Set the value of [prevemployertelnbr] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setPrevemployertelnbr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->prevemployertelnbr !== $v) {
            $this->prevemployertelnbr = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_PREVEMPLOYERTELNBR] = true;
        }

        return $this;
    } // setPrevemployertelnbr()

    /**
     * Sets the value of [prevemployerstartdt] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setPrevemployerstartdt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->prevemployerstartdt !== null || $dt !== null) {
            if ($this->prevemployerstartdt === null || $dt === null || $dt->format("Y-m-d") !== $this->prevemployerstartdt->format("Y-m-d")) {
                $this->prevemployerstartdt = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EmployeeTableMap::COL_PREVEMPLOYERSTARTDT] = true;
            }
        } // if either are not null

        return $this;
    } // setPrevemployerstartdt()

    /**
     * Sets the value of [prevemployerenddt] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setPrevemployerenddt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->prevemployerenddt !== null || $dt !== null) {
            if ($this->prevemployerenddt === null || $dt === null || $dt->format("Y-m-d") !== $this->prevemployerenddt->format("Y-m-d")) {
                $this->prevemployerenddt = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EmployeeTableMap::COL_PREVEMPLOYERENDDT] = true;
            }
        } // if either are not null

        return $this;
    } // setPrevemployerenddt()

    /**
     * Set the value of [prevemployerleavingreason] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setPrevemployerleavingreason($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->prevemployerleavingreason !== $v) {
            $this->prevemployerleavingreason = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_PREVEMPLOYERLEAVINGREASON] = true;
        }

        return $this;
    } // setPrevemployerleavingreason()

    /**
     * Set the value of [prevemployerlocation] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setPrevemployerlocation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->prevemployerlocation !== $v) {
            $this->prevemployerlocation = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_PREVEMPLOYERLOCATION] = true;
        }

        return $this;
    } // setPrevemployerlocation()

    /**
     * Set the value of [workdoneatprevemployer] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setWorkdoneatprevemployer($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->workdoneatprevemployer !== $v) {
            $this->workdoneatprevemployer = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_WORKDONEATPREVEMPLOYER] = true;
        }

        return $this;
    } // setWorkdoneatprevemployer()

    /**
     * Set the value of [nxtofkinfirstnm] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setNxtofkinfirstnm($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nxtofkinfirstnm !== $v) {
            $this->nxtofkinfirstnm = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_NXTOFKINFIRSTNM] = true;
        }

        return $this;
    } // setNxtofkinfirstnm()

    /**
     * Set the value of [nxtofkinlastnm] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setNxtofkinlastnm($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nxtofkinlastnm !== $v) {
            $this->nxtofkinlastnm = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_NXTOFKINLASTNM] = true;
        }

        return $this;
    } // setNxtofkinlastnm()

    /**
     * Set the value of [nxtofkinmobilenbr] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setNxtofkinmobilenbr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nxtofkinmobilenbr !== $v) {
            $this->nxtofkinmobilenbr = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_NXTOFKINMOBILENBR] = true;
        }

        return $this;
    } // setNxtofkinmobilenbr()

    /**
     * Set the value of [nxtofkinresidence] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setNxtofkinresidence($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nxtofkinresidence !== $v) {
            $this->nxtofkinresidence = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_NXTOFKINRESIDENCE] = true;
        }

        return $this;
    } // setNxtofkinresidence()

    /**
     * Set the value of [nxtofkinrelationship] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setNxtofkinrelationship($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nxtofkinrelationship !== $v) {
            $this->nxtofkinrelationship = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_NXTOFKINRELATIONSHIP] = true;
        }

        return $this;
    } // setNxtofkinrelationship()

    /**
     * Set the value of [nxtofkinplaceofwork] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setNxtofkinplaceofwork($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nxtofkinplaceofwork !== $v) {
            $this->nxtofkinplaceofwork = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_NXTOFKINPLACEOFWORK] = true;
        }

        return $this;
    } // setNxtofkinplaceofwork()

    /**
     * Set the value of [comment] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setComment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comment !== $v) {
            $this->comment = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_COMMENT] = true;
        }

        return $this;
    } // setComment()

    /**
     * Sets the value of [createtmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setCreatetmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->createtmstp !== null || $dt !== null) {
            if ($this->createtmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->createtmstp->format("Y-m-d H:i:s.u")) {
                $this->createtmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EmployeeTableMap::COL_CREATETMSTP] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatetmstp()

    /**
     * Sets the value of [updttmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function setUpdttmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updttmstp !== null || $dt !== null) {
            if ($this->updttmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updttmstp->format("Y-m-d H:i:s.u")) {
                $this->updttmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EmployeeTableMap::COL_UPDTTMSTP] = true;
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
            if ($this->middleinitial !== 'X') {
                return false;
            }

            if ($this->nationalid !== '1000000001') {
                return false;
            }

            if ($this->mobilenbr !== '0720000000') {
                return false;
            }

            if ($this->resident !== false) {
                return false;
            }

            if ($this->elecdeduction !== true) {
                return false;
            }

            if ($this->epayment !== false) {
                return false;
            }

            if ($this->active !== true) {
                return false;
            }

            if ($this->gender !== 'M') {
                return false;
            }

            if ($this->terminated !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : EmployeeTableMap::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->oid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : EmployeeTableMap::translateFieldName('Firstname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->firstname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : EmployeeTableMap::translateFieldName('Middleinitial', TableMap::TYPE_PHPNAME, $indexType)];
            $this->middleinitial = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : EmployeeTableMap::translateFieldName('Lastname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lastname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : EmployeeTableMap::translateFieldName('Nationalid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nationalid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : EmployeeTableMap::translateFieldName('Mobilenbr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mobilenbr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : EmployeeTableMap::translateFieldName('Resident', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resident = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : EmployeeTableMap::translateFieldName('Elecdeduction', TableMap::TYPE_PHPNAME, $indexType)];
            $this->elecdeduction = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : EmployeeTableMap::translateFieldName('Epayment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->epayment = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : EmployeeTableMap::translateFieldName('Active', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : EmployeeTableMap::translateFieldName('Startdt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->startdt = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : EmployeeTableMap::translateFieldName('Gender', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gender = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : EmployeeTableMap::translateFieldName('Terminated', TableMap::TYPE_PHPNAME, $indexType)];
            $this->terminated = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : EmployeeTableMap::translateFieldName('Dateofbirth', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->dateofbirth = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : EmployeeTableMap::translateFieldName('Maritalstatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->maritalstatus = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : EmployeeTableMap::translateFieldName('Spousefirstnm', TableMap::TYPE_PHPNAME, $indexType)];
            $this->spousefirstnm = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : EmployeeTableMap::translateFieldName('Spouselastnm', TableMap::TYPE_PHPNAME, $indexType)];
            $this->spouselastnm = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : EmployeeTableMap::translateFieldName('Spousemobnbr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->spousemobnbr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : EmployeeTableMap::translateFieldName('Prevemployername', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prevemployername = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : EmployeeTableMap::translateFieldName('Prevemployertelnbr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prevemployertelnbr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : EmployeeTableMap::translateFieldName('Prevemployerstartdt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->prevemployerstartdt = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : EmployeeTableMap::translateFieldName('Prevemployerenddt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->prevemployerenddt = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : EmployeeTableMap::translateFieldName('Prevemployerleavingreason', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prevemployerleavingreason = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : EmployeeTableMap::translateFieldName('Prevemployerlocation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prevemployerlocation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : EmployeeTableMap::translateFieldName('Workdoneatprevemployer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->workdoneatprevemployer = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : EmployeeTableMap::translateFieldName('Nxtofkinfirstnm', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nxtofkinfirstnm = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : EmployeeTableMap::translateFieldName('Nxtofkinlastnm', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nxtofkinlastnm = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : EmployeeTableMap::translateFieldName('Nxtofkinmobilenbr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nxtofkinmobilenbr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : EmployeeTableMap::translateFieldName('Nxtofkinresidence', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nxtofkinresidence = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : EmployeeTableMap::translateFieldName('Nxtofkinrelationship', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nxtofkinrelationship = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : EmployeeTableMap::translateFieldName('Nxtofkinplaceofwork', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nxtofkinplaceofwork = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : EmployeeTableMap::translateFieldName('Comment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comment = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : EmployeeTableMap::translateFieldName('Createtmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->createtmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : EmployeeTableMap::translateFieldName('Updttmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updttmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 34; // 34 = EmployeeTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\lwops\\lwops\\Employee'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildEmployeeQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collAttendances = null;

            $this->collCasualemployeepayslips = null;

            $this->collEmployeeloans = null;

            $this->collEmployeeotherdeductions = null;

            $this->collEmployeepurchasess = null;

            $this->collEmployeeroles = null;

            $this->collEmployeesalaryexpenseallocations = null;

            $this->collEmployeeterminations = null;

            $this->collFteemployeepayslips = null;

            $this->collFtesalaryadvances = null;

            $this->collMedicaldeductions = null;

            $this->collNssfdeductions = null;

            $this->collParttimedetails = null;

            $this->collSalaries = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Employee::setDeleted()
     * @see Employee::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildEmployeeQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
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
                EmployeeTableMap::addInstanceToPool($this);
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

            if ($this->attendancesScheduledForDeletion !== null) {
                if (!$this->attendancesScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\AttendanceQuery::create()
                        ->filterByPrimaryKeys($this->attendancesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->attendancesScheduledForDeletion = null;
                }
            }

            if ($this->collAttendances !== null) {
                foreach ($this->collAttendances as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->casualemployeepayslipsScheduledForDeletion !== null) {
                if (!$this->casualemployeepayslipsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\CasualemployeepayslipQuery::create()
                        ->filterByPrimaryKeys($this->casualemployeepayslipsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->casualemployeepayslipsScheduledForDeletion = null;
                }
            }

            if ($this->collCasualemployeepayslips !== null) {
                foreach ($this->collCasualemployeepayslips as $referrerFK) {
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

            if ($this->employeeotherdeductionsScheduledForDeletion !== null) {
                if (!$this->employeeotherdeductionsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\EmployeeotherdeductionQuery::create()
                        ->filterByPrimaryKeys($this->employeeotherdeductionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->employeeotherdeductionsScheduledForDeletion = null;
                }
            }

            if ($this->collEmployeeotherdeductions !== null) {
                foreach ($this->collEmployeeotherdeductions as $referrerFK) {
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

            if ($this->employeeterminationsScheduledForDeletion !== null) {
                if (!$this->employeeterminationsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\EmployeeterminationQuery::create()
                        ->filterByPrimaryKeys($this->employeeterminationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->employeeterminationsScheduledForDeletion = null;
                }
            }

            if ($this->collEmployeeterminations !== null) {
                foreach ($this->collEmployeeterminations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->fteemployeepayslipsScheduledForDeletion !== null) {
                if (!$this->fteemployeepayslipsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\FteemployeepayslipQuery::create()
                        ->filterByPrimaryKeys($this->fteemployeepayslipsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->fteemployeepayslipsScheduledForDeletion = null;
                }
            }

            if ($this->collFteemployeepayslips !== null) {
                foreach ($this->collFteemployeepayslips as $referrerFK) {
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

            if ($this->medicaldeductionsScheduledForDeletion !== null) {
                if (!$this->medicaldeductionsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\MedicaldeductionQuery::create()
                        ->filterByPrimaryKeys($this->medicaldeductionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->medicaldeductionsScheduledForDeletion = null;
                }
            }

            if ($this->collMedicaldeductions !== null) {
                foreach ($this->collMedicaldeductions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->nssfdeductionsScheduledForDeletion !== null) {
                if (!$this->nssfdeductionsScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\NssfdeductionQuery::create()
                        ->filterByPrimaryKeys($this->nssfdeductionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->nssfdeductionsScheduledForDeletion = null;
                }
            }

            if ($this->collNssfdeductions !== null) {
                foreach ($this->collNssfdeductions as $referrerFK) {
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

            if ($this->salariesScheduledForDeletion !== null) {
                if (!$this->salariesScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\SalaryQuery::create()
                        ->filterByPrimaryKeys($this->salariesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->salariesScheduledForDeletion = null;
                }
            }

            if ($this->collSalaries !== null) {
                foreach ($this->collSalaries as $referrerFK) {
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

        $this->modifiedColumns[EmployeeTableMap::COL_OID] = true;
        if (null !== $this->oid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EmployeeTableMap::COL_OID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EmployeeTableMap::COL_OID)) {
            $modifiedColumns[':p' . $index++]  = 'oid';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_FIRSTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'firstName';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_MIDDLEINITIAL)) {
            $modifiedColumns[':p' . $index++]  = 'middleInitial';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_LASTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'lastName';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NATIONALID)) {
            $modifiedColumns[':p' . $index++]  = 'nationalID';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_MOBILENBR)) {
            $modifiedColumns[':p' . $index++]  = 'mobileNbr';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_RESIDENT)) {
            $modifiedColumns[':p' . $index++]  = 'resident';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ELECDEDUCTION)) {
            $modifiedColumns[':p' . $index++]  = 'elecDeduction';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_EPAYMENT)) {
            $modifiedColumns[':p' . $index++]  = 'ePayment';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'active';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_STARTDT)) {
            $modifiedColumns[':p' . $index++]  = 'startDt';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_GENDER)) {
            $modifiedColumns[':p' . $index++]  = 'gender';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_TERMINATED)) {
            $modifiedColumns[':p' . $index++]  = 'terminated';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_DATEOFBIRTH)) {
            $modifiedColumns[':p' . $index++]  = 'dateOfBirth';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_MARITALSTATUS)) {
            $modifiedColumns[':p' . $index++]  = 'maritalStatus';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_SPOUSEFIRSTNM)) {
            $modifiedColumns[':p' . $index++]  = 'spouseFirstNm';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_SPOUSELASTNM)) {
            $modifiedColumns[':p' . $index++]  = 'spouseLastNm';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_SPOUSEMOBNBR)) {
            $modifiedColumns[':p' . $index++]  = 'spouseMobNbr';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PREVEMPLOYERNAME)) {
            $modifiedColumns[':p' . $index++]  = 'prevEmployerName';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PREVEMPLOYERTELNBR)) {
            $modifiedColumns[':p' . $index++]  = 'prevEmployerTelNbr';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PREVEMPLOYERSTARTDT)) {
            $modifiedColumns[':p' . $index++]  = 'prevEmployerStartDt';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PREVEMPLOYERENDDT)) {
            $modifiedColumns[':p' . $index++]  = 'prevEmployerEndDt';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PREVEMPLOYERLEAVINGREASON)) {
            $modifiedColumns[':p' . $index++]  = 'prevEmployerLeavingReason';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PREVEMPLOYERLOCATION)) {
            $modifiedColumns[':p' . $index++]  = 'prevEmployerLocation';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_WORKDONEATPREVEMPLOYER)) {
            $modifiedColumns[':p' . $index++]  = 'workDoneAtPrevEmployer';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NXTOFKINFIRSTNM)) {
            $modifiedColumns[':p' . $index++]  = 'nxtOfKinFirstNm';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NXTOFKINLASTNM)) {
            $modifiedColumns[':p' . $index++]  = 'nxtOfKinLastNm';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NXTOFKINMOBILENBR)) {
            $modifiedColumns[':p' . $index++]  = 'nxtOfKinMobileNbr';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NXTOFKINRESIDENCE)) {
            $modifiedColumns[':p' . $index++]  = 'nxtOfKinResidence';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NXTOFKINRELATIONSHIP)) {
            $modifiedColumns[':p' . $index++]  = 'nxtOfKinRelationship';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NXTOFKINPLACEOFWORK)) {
            $modifiedColumns[':p' . $index++]  = 'nxtOfKinPlaceOfWork';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = 'comment';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_CREATETMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'createTmstp';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_UPDTTMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'updtTmstp';
        }

        $sql = sprintf(
            'INSERT INTO employee (%s) VALUES (%s)',
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
                    case 'firstName':
                        $stmt->bindValue($identifier, $this->firstname, PDO::PARAM_STR);
                        break;
                    case 'middleInitial':
                        $stmt->bindValue($identifier, $this->middleinitial, PDO::PARAM_STR);
                        break;
                    case 'lastName':
                        $stmt->bindValue($identifier, $this->lastname, PDO::PARAM_STR);
                        break;
                    case 'nationalID':
                        $stmt->bindValue($identifier, $this->nationalid, PDO::PARAM_STR);
                        break;
                    case 'mobileNbr':
                        $stmt->bindValue($identifier, $this->mobilenbr, PDO::PARAM_STR);
                        break;
                    case 'resident':
                        $stmt->bindValue($identifier, (int) $this->resident, PDO::PARAM_INT);
                        break;
                    case 'elecDeduction':
                        $stmt->bindValue($identifier, (int) $this->elecdeduction, PDO::PARAM_INT);
                        break;
                    case 'ePayment':
                        $stmt->bindValue($identifier, (int) $this->epayment, PDO::PARAM_INT);
                        break;
                    case 'active':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
                        break;
                    case 'startDt':
                        $stmt->bindValue($identifier, $this->startdt ? $this->startdt->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'gender':
                        $stmt->bindValue($identifier, $this->gender, PDO::PARAM_STR);
                        break;
                    case 'terminated':
                        $stmt->bindValue($identifier, (int) $this->terminated, PDO::PARAM_INT);
                        break;
                    case 'dateOfBirth':
                        $stmt->bindValue($identifier, $this->dateofbirth ? $this->dateofbirth->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'maritalStatus':
                        $stmt->bindValue($identifier, $this->maritalstatus, PDO::PARAM_STR);
                        break;
                    case 'spouseFirstNm':
                        $stmt->bindValue($identifier, $this->spousefirstnm, PDO::PARAM_STR);
                        break;
                    case 'spouseLastNm':
                        $stmt->bindValue($identifier, $this->spouselastnm, PDO::PARAM_STR);
                        break;
                    case 'spouseMobNbr':
                        $stmt->bindValue($identifier, $this->spousemobnbr, PDO::PARAM_STR);
                        break;
                    case 'prevEmployerName':
                        $stmt->bindValue($identifier, $this->prevemployername, PDO::PARAM_STR);
                        break;
                    case 'prevEmployerTelNbr':
                        $stmt->bindValue($identifier, $this->prevemployertelnbr, PDO::PARAM_STR);
                        break;
                    case 'prevEmployerStartDt':
                        $stmt->bindValue($identifier, $this->prevemployerstartdt ? $this->prevemployerstartdt->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'prevEmployerEndDt':
                        $stmt->bindValue($identifier, $this->prevemployerenddt ? $this->prevemployerenddt->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'prevEmployerLeavingReason':
                        $stmt->bindValue($identifier, $this->prevemployerleavingreason, PDO::PARAM_STR);
                        break;
                    case 'prevEmployerLocation':
                        $stmt->bindValue($identifier, $this->prevemployerlocation, PDO::PARAM_STR);
                        break;
                    case 'workDoneAtPrevEmployer':
                        $stmt->bindValue($identifier, $this->workdoneatprevemployer, PDO::PARAM_STR);
                        break;
                    case 'nxtOfKinFirstNm':
                        $stmt->bindValue($identifier, $this->nxtofkinfirstnm, PDO::PARAM_STR);
                        break;
                    case 'nxtOfKinLastNm':
                        $stmt->bindValue($identifier, $this->nxtofkinlastnm, PDO::PARAM_STR);
                        break;
                    case 'nxtOfKinMobileNbr':
                        $stmt->bindValue($identifier, $this->nxtofkinmobilenbr, PDO::PARAM_STR);
                        break;
                    case 'nxtOfKinResidence':
                        $stmt->bindValue($identifier, $this->nxtofkinresidence, PDO::PARAM_STR);
                        break;
                    case 'nxtOfKinRelationship':
                        $stmt->bindValue($identifier, $this->nxtofkinrelationship, PDO::PARAM_STR);
                        break;
                    case 'nxtOfKinPlaceOfWork':
                        $stmt->bindValue($identifier, $this->nxtofkinplaceofwork, PDO::PARAM_STR);
                        break;
                    case 'comment':
                        $stmt->bindValue($identifier, $this->comment, PDO::PARAM_STR);
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
        $pos = EmployeeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getFirstname();
                break;
            case 2:
                return $this->getMiddleinitial();
                break;
            case 3:
                return $this->getLastname();
                break;
            case 4:
                return $this->getNationalid();
                break;
            case 5:
                return $this->getMobilenbr();
                break;
            case 6:
                return $this->getResident();
                break;
            case 7:
                return $this->getElecdeduction();
                break;
            case 8:
                return $this->getEpayment();
                break;
            case 9:
                return $this->getActive();
                break;
            case 10:
                return $this->getStartdt();
                break;
            case 11:
                return $this->getGender();
                break;
            case 12:
                return $this->getTerminated();
                break;
            case 13:
                return $this->getDateofbirth();
                break;
            case 14:
                return $this->getMaritalstatus();
                break;
            case 15:
                return $this->getSpousefirstnm();
                break;
            case 16:
                return $this->getSpouselastnm();
                break;
            case 17:
                return $this->getSpousemobnbr();
                break;
            case 18:
                return $this->getPrevemployername();
                break;
            case 19:
                return $this->getPrevemployertelnbr();
                break;
            case 20:
                return $this->getPrevemployerstartdt();
                break;
            case 21:
                return $this->getPrevemployerenddt();
                break;
            case 22:
                return $this->getPrevemployerleavingreason();
                break;
            case 23:
                return $this->getPrevemployerlocation();
                break;
            case 24:
                return $this->getWorkdoneatprevemployer();
                break;
            case 25:
                return $this->getNxtofkinfirstnm();
                break;
            case 26:
                return $this->getNxtofkinlastnm();
                break;
            case 27:
                return $this->getNxtofkinmobilenbr();
                break;
            case 28:
                return $this->getNxtofkinresidence();
                break;
            case 29:
                return $this->getNxtofkinrelationship();
                break;
            case 30:
                return $this->getNxtofkinplaceofwork();
                break;
            case 31:
                return $this->getComment();
                break;
            case 32:
                return $this->getCreatetmstp();
                break;
            case 33:
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

        if (isset($alreadyDumpedObjects['Employee'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Employee'][$this->hashCode()] = true;
        $keys = EmployeeTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOid(),
            $keys[1] => $this->getFirstname(),
            $keys[2] => $this->getMiddleinitial(),
            $keys[3] => $this->getLastname(),
            $keys[4] => $this->getNationalid(),
            $keys[5] => $this->getMobilenbr(),
            $keys[6] => $this->getResident(),
            $keys[7] => $this->getElecdeduction(),
            $keys[8] => $this->getEpayment(),
            $keys[9] => $this->getActive(),
            $keys[10] => $this->getStartdt(),
            $keys[11] => $this->getGender(),
            $keys[12] => $this->getTerminated(),
            $keys[13] => $this->getDateofbirth(),
            $keys[14] => $this->getMaritalstatus(),
            $keys[15] => $this->getSpousefirstnm(),
            $keys[16] => $this->getSpouselastnm(),
            $keys[17] => $this->getSpousemobnbr(),
            $keys[18] => $this->getPrevemployername(),
            $keys[19] => $this->getPrevemployertelnbr(),
            $keys[20] => $this->getPrevemployerstartdt(),
            $keys[21] => $this->getPrevemployerenddt(),
            $keys[22] => $this->getPrevemployerleavingreason(),
            $keys[23] => $this->getPrevemployerlocation(),
            $keys[24] => $this->getWorkdoneatprevemployer(),
            $keys[25] => $this->getNxtofkinfirstnm(),
            $keys[26] => $this->getNxtofkinlastnm(),
            $keys[27] => $this->getNxtofkinmobilenbr(),
            $keys[28] => $this->getNxtofkinresidence(),
            $keys[29] => $this->getNxtofkinrelationship(),
            $keys[30] => $this->getNxtofkinplaceofwork(),
            $keys[31] => $this->getComment(),
            $keys[32] => $this->getCreatetmstp(),
            $keys[33] => $this->getUpdttmstp(),
        );
        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('c');
        }

        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('c');
        }

        if ($result[$keys[20]] instanceof \DateTimeInterface) {
            $result[$keys[20]] = $result[$keys[20]]->format('c');
        }

        if ($result[$keys[21]] instanceof \DateTimeInterface) {
            $result[$keys[21]] = $result[$keys[21]]->format('c');
        }

        if ($result[$keys[32]] instanceof \DateTimeInterface) {
            $result[$keys[32]] = $result[$keys[32]]->format('c');
        }

        if ($result[$keys[33]] instanceof \DateTimeInterface) {
            $result[$keys[33]] = $result[$keys[33]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collAttendances) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'attendances';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'attendances';
                        break;
                    default:
                        $key = 'Attendances';
                }

                $result[$key] = $this->collAttendances->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCasualemployeepayslips) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'casualemployeepayslips';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'casualemployeepayslips';
                        break;
                    default:
                        $key = 'Casualemployeepayslips';
                }

                $result[$key] = $this->collCasualemployeepayslips->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collEmployeeotherdeductions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employeeotherdeductions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employeeotherdeductions';
                        break;
                    default:
                        $key = 'Employeeotherdeductions';
                }

                $result[$key] = $this->collEmployeeotherdeductions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collEmployeeterminations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employeeterminations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employeeterminations';
                        break;
                    default:
                        $key = 'Employeeterminations';
                }

                $result[$key] = $this->collEmployeeterminations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collFteemployeepayslips) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'fteemployeepayslips';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'fteemployeepayslips';
                        break;
                    default:
                        $key = 'Fteemployeepayslips';
                }

                $result[$key] = $this->collFteemployeepayslips->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collMedicaldeductions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'medicaldeductions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'medicaldeductions';
                        break;
                    default:
                        $key = 'Medicaldeductions';
                }

                $result[$key] = $this->collMedicaldeductions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNssfdeductions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'nssfdeductions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'nssfdeductions';
                        break;
                    default:
                        $key = 'Nssfdeductions';
                }

                $result[$key] = $this->collNssfdeductions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSalaries) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'salaries';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'salaries';
                        break;
                    default:
                        $key = 'Salaries';
                }

                $result[$key] = $this->collSalaries->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\lwops\lwops\Employee
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = EmployeeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\lwops\lwops\Employee
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setOid($value);
                break;
            case 1:
                $this->setFirstname($value);
                break;
            case 2:
                $this->setMiddleinitial($value);
                break;
            case 3:
                $this->setLastname($value);
                break;
            case 4:
                $this->setNationalid($value);
                break;
            case 5:
                $this->setMobilenbr($value);
                break;
            case 6:
                $this->setResident($value);
                break;
            case 7:
                $this->setElecdeduction($value);
                break;
            case 8:
                $this->setEpayment($value);
                break;
            case 9:
                $this->setActive($value);
                break;
            case 10:
                $this->setStartdt($value);
                break;
            case 11:
                $this->setGender($value);
                break;
            case 12:
                $this->setTerminated($value);
                break;
            case 13:
                $this->setDateofbirth($value);
                break;
            case 14:
                $this->setMaritalstatus($value);
                break;
            case 15:
                $this->setSpousefirstnm($value);
                break;
            case 16:
                $this->setSpouselastnm($value);
                break;
            case 17:
                $this->setSpousemobnbr($value);
                break;
            case 18:
                $this->setPrevemployername($value);
                break;
            case 19:
                $this->setPrevemployertelnbr($value);
                break;
            case 20:
                $this->setPrevemployerstartdt($value);
                break;
            case 21:
                $this->setPrevemployerenddt($value);
                break;
            case 22:
                $this->setPrevemployerleavingreason($value);
                break;
            case 23:
                $this->setPrevemployerlocation($value);
                break;
            case 24:
                $this->setWorkdoneatprevemployer($value);
                break;
            case 25:
                $this->setNxtofkinfirstnm($value);
                break;
            case 26:
                $this->setNxtofkinlastnm($value);
                break;
            case 27:
                $this->setNxtofkinmobilenbr($value);
                break;
            case 28:
                $this->setNxtofkinresidence($value);
                break;
            case 29:
                $this->setNxtofkinrelationship($value);
                break;
            case 30:
                $this->setNxtofkinplaceofwork($value);
                break;
            case 31:
                $this->setComment($value);
                break;
            case 32:
                $this->setCreatetmstp($value);
                break;
            case 33:
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
        $keys = EmployeeTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFirstname($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setMiddleinitial($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setLastname($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setNationalid($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setMobilenbr($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setResident($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setElecdeduction($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setEpayment($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setActive($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setStartdt($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setGender($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setTerminated($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setDateofbirth($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setMaritalstatus($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setSpousefirstnm($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setSpouselastnm($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setSpousemobnbr($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setPrevemployername($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setPrevemployertelnbr($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setPrevemployerstartdt($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setPrevemployerenddt($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setPrevemployerleavingreason($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setPrevemployerlocation($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setWorkdoneatprevemployer($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setNxtofkinfirstnm($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setNxtofkinlastnm($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setNxtofkinmobilenbr($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setNxtofkinresidence($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setNxtofkinrelationship($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setNxtofkinplaceofwork($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setComment($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setCreatetmstp($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setUpdttmstp($arr[$keys[33]]);
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
     * @return $this|\lwops\lwops\Employee The current object, for fluid interface
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
        $criteria = new Criteria(EmployeeTableMap::DATABASE_NAME);

        if ($this->isColumnModified(EmployeeTableMap::COL_OID)) {
            $criteria->add(EmployeeTableMap::COL_OID, $this->oid);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_FIRSTNAME)) {
            $criteria->add(EmployeeTableMap::COL_FIRSTNAME, $this->firstname);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_MIDDLEINITIAL)) {
            $criteria->add(EmployeeTableMap::COL_MIDDLEINITIAL, $this->middleinitial);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_LASTNAME)) {
            $criteria->add(EmployeeTableMap::COL_LASTNAME, $this->lastname);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NATIONALID)) {
            $criteria->add(EmployeeTableMap::COL_NATIONALID, $this->nationalid);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_MOBILENBR)) {
            $criteria->add(EmployeeTableMap::COL_MOBILENBR, $this->mobilenbr);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_RESIDENT)) {
            $criteria->add(EmployeeTableMap::COL_RESIDENT, $this->resident);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ELECDEDUCTION)) {
            $criteria->add(EmployeeTableMap::COL_ELECDEDUCTION, $this->elecdeduction);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_EPAYMENT)) {
            $criteria->add(EmployeeTableMap::COL_EPAYMENT, $this->epayment);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ACTIVE)) {
            $criteria->add(EmployeeTableMap::COL_ACTIVE, $this->active);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_STARTDT)) {
            $criteria->add(EmployeeTableMap::COL_STARTDT, $this->startdt);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_GENDER)) {
            $criteria->add(EmployeeTableMap::COL_GENDER, $this->gender);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_TERMINATED)) {
            $criteria->add(EmployeeTableMap::COL_TERMINATED, $this->terminated);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_DATEOFBIRTH)) {
            $criteria->add(EmployeeTableMap::COL_DATEOFBIRTH, $this->dateofbirth);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_MARITALSTATUS)) {
            $criteria->add(EmployeeTableMap::COL_MARITALSTATUS, $this->maritalstatus);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_SPOUSEFIRSTNM)) {
            $criteria->add(EmployeeTableMap::COL_SPOUSEFIRSTNM, $this->spousefirstnm);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_SPOUSELASTNM)) {
            $criteria->add(EmployeeTableMap::COL_SPOUSELASTNM, $this->spouselastnm);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_SPOUSEMOBNBR)) {
            $criteria->add(EmployeeTableMap::COL_SPOUSEMOBNBR, $this->spousemobnbr);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PREVEMPLOYERNAME)) {
            $criteria->add(EmployeeTableMap::COL_PREVEMPLOYERNAME, $this->prevemployername);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PREVEMPLOYERTELNBR)) {
            $criteria->add(EmployeeTableMap::COL_PREVEMPLOYERTELNBR, $this->prevemployertelnbr);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PREVEMPLOYERSTARTDT)) {
            $criteria->add(EmployeeTableMap::COL_PREVEMPLOYERSTARTDT, $this->prevemployerstartdt);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PREVEMPLOYERENDDT)) {
            $criteria->add(EmployeeTableMap::COL_PREVEMPLOYERENDDT, $this->prevemployerenddt);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PREVEMPLOYERLEAVINGREASON)) {
            $criteria->add(EmployeeTableMap::COL_PREVEMPLOYERLEAVINGREASON, $this->prevemployerleavingreason);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PREVEMPLOYERLOCATION)) {
            $criteria->add(EmployeeTableMap::COL_PREVEMPLOYERLOCATION, $this->prevemployerlocation);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_WORKDONEATPREVEMPLOYER)) {
            $criteria->add(EmployeeTableMap::COL_WORKDONEATPREVEMPLOYER, $this->workdoneatprevemployer);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NXTOFKINFIRSTNM)) {
            $criteria->add(EmployeeTableMap::COL_NXTOFKINFIRSTNM, $this->nxtofkinfirstnm);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NXTOFKINLASTNM)) {
            $criteria->add(EmployeeTableMap::COL_NXTOFKINLASTNM, $this->nxtofkinlastnm);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NXTOFKINMOBILENBR)) {
            $criteria->add(EmployeeTableMap::COL_NXTOFKINMOBILENBR, $this->nxtofkinmobilenbr);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NXTOFKINRESIDENCE)) {
            $criteria->add(EmployeeTableMap::COL_NXTOFKINRESIDENCE, $this->nxtofkinresidence);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NXTOFKINRELATIONSHIP)) {
            $criteria->add(EmployeeTableMap::COL_NXTOFKINRELATIONSHIP, $this->nxtofkinrelationship);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NXTOFKINPLACEOFWORK)) {
            $criteria->add(EmployeeTableMap::COL_NXTOFKINPLACEOFWORK, $this->nxtofkinplaceofwork);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_COMMENT)) {
            $criteria->add(EmployeeTableMap::COL_COMMENT, $this->comment);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_CREATETMSTP)) {
            $criteria->add(EmployeeTableMap::COL_CREATETMSTP, $this->createtmstp);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_UPDTTMSTP)) {
            $criteria->add(EmployeeTableMap::COL_UPDTTMSTP, $this->updttmstp);
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
        $criteria = ChildEmployeeQuery::create();
        $criteria->add(EmployeeTableMap::COL_OID, $this->oid);

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
     * @param      object $copyObj An object of \lwops\lwops\Employee (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFirstname($this->getFirstname());
        $copyObj->setMiddleinitial($this->getMiddleinitial());
        $copyObj->setLastname($this->getLastname());
        $copyObj->setNationalid($this->getNationalid());
        $copyObj->setMobilenbr($this->getMobilenbr());
        $copyObj->setResident($this->getResident());
        $copyObj->setElecdeduction($this->getElecdeduction());
        $copyObj->setEpayment($this->getEpayment());
        $copyObj->setActive($this->getActive());
        $copyObj->setStartdt($this->getStartdt());
        $copyObj->setGender($this->getGender());
        $copyObj->setTerminated($this->getTerminated());
        $copyObj->setDateofbirth($this->getDateofbirth());
        $copyObj->setMaritalstatus($this->getMaritalstatus());
        $copyObj->setSpousefirstnm($this->getSpousefirstnm());
        $copyObj->setSpouselastnm($this->getSpouselastnm());
        $copyObj->setSpousemobnbr($this->getSpousemobnbr());
        $copyObj->setPrevemployername($this->getPrevemployername());
        $copyObj->setPrevemployertelnbr($this->getPrevemployertelnbr());
        $copyObj->setPrevemployerstartdt($this->getPrevemployerstartdt());
        $copyObj->setPrevemployerenddt($this->getPrevemployerenddt());
        $copyObj->setPrevemployerleavingreason($this->getPrevemployerleavingreason());
        $copyObj->setPrevemployerlocation($this->getPrevemployerlocation());
        $copyObj->setWorkdoneatprevemployer($this->getWorkdoneatprevemployer());
        $copyObj->setNxtofkinfirstnm($this->getNxtofkinfirstnm());
        $copyObj->setNxtofkinlastnm($this->getNxtofkinlastnm());
        $copyObj->setNxtofkinmobilenbr($this->getNxtofkinmobilenbr());
        $copyObj->setNxtofkinresidence($this->getNxtofkinresidence());
        $copyObj->setNxtofkinrelationship($this->getNxtofkinrelationship());
        $copyObj->setNxtofkinplaceofwork($this->getNxtofkinplaceofwork());
        $copyObj->setComment($this->getComment());
        $copyObj->setCreatetmstp($this->getCreatetmstp());
        $copyObj->setUpdttmstp($this->getUpdttmstp());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAttendances() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAttendance($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCasualemployeepayslips() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCasualemployeepayslip($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeeloans() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeeloan($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeeotherdeductions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeeotherdeduction($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeepurchasess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeepurchases($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeeroles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeerole($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeesalaryexpenseallocations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeesalaryexpenseallocation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeeterminations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeetermination($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getFteemployeepayslips() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFteemployeepayslip($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getFtesalaryadvances() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFtesalaryadvance($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMedicaldeductions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMedicaldeduction($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNssfdeductions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNssfdeduction($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getParttimedetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addParttimedetail($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSalaries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSalary($relObj->copy($deepCopy));
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
     * @return \lwops\lwops\Employee Clone of current object.
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
        if ('Attendance' == $relationName) {
            $this->initAttendances();
            return;
        }
        if ('Casualemployeepayslip' == $relationName) {
            $this->initCasualemployeepayslips();
            return;
        }
        if ('Employeeloan' == $relationName) {
            $this->initEmployeeloans();
            return;
        }
        if ('Employeeotherdeduction' == $relationName) {
            $this->initEmployeeotherdeductions();
            return;
        }
        if ('Employeepurchases' == $relationName) {
            $this->initEmployeepurchasess();
            return;
        }
        if ('Employeerole' == $relationName) {
            $this->initEmployeeroles();
            return;
        }
        if ('Employeesalaryexpenseallocation' == $relationName) {
            $this->initEmployeesalaryexpenseallocations();
            return;
        }
        if ('Employeetermination' == $relationName) {
            $this->initEmployeeterminations();
            return;
        }
        if ('Fteemployeepayslip' == $relationName) {
            $this->initFteemployeepayslips();
            return;
        }
        if ('Ftesalaryadvance' == $relationName) {
            $this->initFtesalaryadvances();
            return;
        }
        if ('Medicaldeduction' == $relationName) {
            $this->initMedicaldeductions();
            return;
        }
        if ('Nssfdeduction' == $relationName) {
            $this->initNssfdeductions();
            return;
        }
        if ('Parttimedetail' == $relationName) {
            $this->initParttimedetails();
            return;
        }
        if ('Salary' == $relationName) {
            $this->initSalaries();
            return;
        }
    }

    /**
     * Clears out the collAttendances collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAttendances()
     */
    public function clearAttendances()
    {
        $this->collAttendances = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAttendances collection loaded partially.
     */
    public function resetPartialAttendances($v = true)
    {
        $this->collAttendancesPartial = $v;
    }

    /**
     * Initializes the collAttendances collection.
     *
     * By default this just sets the collAttendances collection to an empty array (like clearcollAttendances());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAttendances($overrideExisting = true)
    {
        if (null !== $this->collAttendances && !$overrideExisting) {
            return;
        }

        $collectionClassName = AttendanceTableMap::getTableMap()->getCollectionClassName();

        $this->collAttendances = new $collectionClassName;
        $this->collAttendances->setModel('\lwops\lwops\Attendance');
    }

    /**
     * Gets an array of ChildAttendance objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @throws PropelException
     */
    public function getAttendances(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAttendancesPartial && !$this->isNew();
        if (null === $this->collAttendances || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAttendances) {
                // return empty collection
                $this->initAttendances();
            } else {
                $collAttendances = ChildAttendanceQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAttendancesPartial && count($collAttendances)) {
                        $this->initAttendances(false);

                        foreach ($collAttendances as $obj) {
                            if (false == $this->collAttendances->contains($obj)) {
                                $this->collAttendances->append($obj);
                            }
                        }

                        $this->collAttendancesPartial = true;
                    }

                    return $collAttendances;
                }

                if ($partial && $this->collAttendances) {
                    foreach ($this->collAttendances as $obj) {
                        if ($obj->isNew()) {
                            $collAttendances[] = $obj;
                        }
                    }
                }

                $this->collAttendances = $collAttendances;
                $this->collAttendancesPartial = false;
            }
        }

        return $this->collAttendances;
    }

    /**
     * Sets a collection of ChildAttendance objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $attendances A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setAttendances(Collection $attendances, ConnectionInterface $con = null)
    {
        /** @var ChildAttendance[] $attendancesToDelete */
        $attendancesToDelete = $this->getAttendances(new Criteria(), $con)->diff($attendances);


        $this->attendancesScheduledForDeletion = $attendancesToDelete;

        foreach ($attendancesToDelete as $attendanceRemoved) {
            $attendanceRemoved->setEmployee(null);
        }

        $this->collAttendances = null;
        foreach ($attendances as $attendance) {
            $this->addAttendance($attendance);
        }

        $this->collAttendances = $attendances;
        $this->collAttendancesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Attendance objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Attendance objects.
     * @throws PropelException
     */
    public function countAttendances(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAttendancesPartial && !$this->isNew();
        if (null === $this->collAttendances || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAttendances) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAttendances());
            }

            $query = ChildAttendanceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collAttendances);
    }

    /**
     * Method called to associate a ChildAttendance object to this object
     * through the ChildAttendance foreign key attribute.
     *
     * @param  ChildAttendance $l ChildAttendance
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function addAttendance(ChildAttendance $l)
    {
        if ($this->collAttendances === null) {
            $this->initAttendances();
            $this->collAttendancesPartial = true;
        }

        if (!$this->collAttendances->contains($l)) {
            $this->doAddAttendance($l);

            if ($this->attendancesScheduledForDeletion and $this->attendancesScheduledForDeletion->contains($l)) {
                $this->attendancesScheduledForDeletion->remove($this->attendancesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAttendance $attendance The ChildAttendance object to add.
     */
    protected function doAddAttendance(ChildAttendance $attendance)
    {
        $this->collAttendances[]= $attendance;
        $attendance->setEmployee($this);
    }

    /**
     * @param  ChildAttendance $attendance The ChildAttendance object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function removeAttendance(ChildAttendance $attendance)
    {
        if ($this->getAttendances()->contains($attendance)) {
            $pos = $this->collAttendances->search($attendance);
            $this->collAttendances->remove($pos);
            if (null === $this->attendancesScheduledForDeletion) {
                $this->attendancesScheduledForDeletion = clone $this->collAttendances;
                $this->attendancesScheduledForDeletion->clear();
            }
            $this->attendancesScheduledForDeletion[]= clone $attendance;
            $attendance->setEmployee(null);
        }

        return $this;
    }

    /**
     * Clears out the collCasualemployeepayslips collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCasualemployeepayslips()
     */
    public function clearCasualemployeepayslips()
    {
        $this->collCasualemployeepayslips = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCasualemployeepayslips collection loaded partially.
     */
    public function resetPartialCasualemployeepayslips($v = true)
    {
        $this->collCasualemployeepayslipsPartial = $v;
    }

    /**
     * Initializes the collCasualemployeepayslips collection.
     *
     * By default this just sets the collCasualemployeepayslips collection to an empty array (like clearcollCasualemployeepayslips());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCasualemployeepayslips($overrideExisting = true)
    {
        if (null !== $this->collCasualemployeepayslips && !$overrideExisting) {
            return;
        }

        $collectionClassName = CasualemployeepayslipTableMap::getTableMap()->getCollectionClassName();

        $this->collCasualemployeepayslips = new $collectionClassName;
        $this->collCasualemployeepayslips->setModel('\lwops\lwops\Casualemployeepayslip');
    }

    /**
     * Gets an array of ChildCasualemployeepayslip objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCasualemployeepayslip[] List of ChildCasualemployeepayslip objects
     * @throws PropelException
     */
    public function getCasualemployeepayslips(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCasualemployeepayslipsPartial && !$this->isNew();
        if (null === $this->collCasualemployeepayslips || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCasualemployeepayslips) {
                // return empty collection
                $this->initCasualemployeepayslips();
            } else {
                $collCasualemployeepayslips = ChildCasualemployeepayslipQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCasualemployeepayslipsPartial && count($collCasualemployeepayslips)) {
                        $this->initCasualemployeepayslips(false);

                        foreach ($collCasualemployeepayslips as $obj) {
                            if (false == $this->collCasualemployeepayslips->contains($obj)) {
                                $this->collCasualemployeepayslips->append($obj);
                            }
                        }

                        $this->collCasualemployeepayslipsPartial = true;
                    }

                    return $collCasualemployeepayslips;
                }

                if ($partial && $this->collCasualemployeepayslips) {
                    foreach ($this->collCasualemployeepayslips as $obj) {
                        if ($obj->isNew()) {
                            $collCasualemployeepayslips[] = $obj;
                        }
                    }
                }

                $this->collCasualemployeepayslips = $collCasualemployeepayslips;
                $this->collCasualemployeepayslipsPartial = false;
            }
        }

        return $this->collCasualemployeepayslips;
    }

    /**
     * Sets a collection of ChildCasualemployeepayslip objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $casualemployeepayslips A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setCasualemployeepayslips(Collection $casualemployeepayslips, ConnectionInterface $con = null)
    {
        /** @var ChildCasualemployeepayslip[] $casualemployeepayslipsToDelete */
        $casualemployeepayslipsToDelete = $this->getCasualemployeepayslips(new Criteria(), $con)->diff($casualemployeepayslips);


        $this->casualemployeepayslipsScheduledForDeletion = $casualemployeepayslipsToDelete;

        foreach ($casualemployeepayslipsToDelete as $casualemployeepayslipRemoved) {
            $casualemployeepayslipRemoved->setEmployee(null);
        }

        $this->collCasualemployeepayslips = null;
        foreach ($casualemployeepayslips as $casualemployeepayslip) {
            $this->addCasualemployeepayslip($casualemployeepayslip);
        }

        $this->collCasualemployeepayslips = $casualemployeepayslips;
        $this->collCasualemployeepayslipsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Casualemployeepayslip objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Casualemployeepayslip objects.
     * @throws PropelException
     */
    public function countCasualemployeepayslips(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCasualemployeepayslipsPartial && !$this->isNew();
        if (null === $this->collCasualemployeepayslips || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCasualemployeepayslips) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCasualemployeepayslips());
            }

            $query = ChildCasualemployeepayslipQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collCasualemployeepayslips);
    }

    /**
     * Method called to associate a ChildCasualemployeepayslip object to this object
     * through the ChildCasualemployeepayslip foreign key attribute.
     *
     * @param  ChildCasualemployeepayslip $l ChildCasualemployeepayslip
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function addCasualemployeepayslip(ChildCasualemployeepayslip $l)
    {
        if ($this->collCasualemployeepayslips === null) {
            $this->initCasualemployeepayslips();
            $this->collCasualemployeepayslipsPartial = true;
        }

        if (!$this->collCasualemployeepayslips->contains($l)) {
            $this->doAddCasualemployeepayslip($l);

            if ($this->casualemployeepayslipsScheduledForDeletion and $this->casualemployeepayslipsScheduledForDeletion->contains($l)) {
                $this->casualemployeepayslipsScheduledForDeletion->remove($this->casualemployeepayslipsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCasualemployeepayslip $casualemployeepayslip The ChildCasualemployeepayslip object to add.
     */
    protected function doAddCasualemployeepayslip(ChildCasualemployeepayslip $casualemployeepayslip)
    {
        $this->collCasualemployeepayslips[]= $casualemployeepayslip;
        $casualemployeepayslip->setEmployee($this);
    }

    /**
     * @param  ChildCasualemployeepayslip $casualemployeepayslip The ChildCasualemployeepayslip object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function removeCasualemployeepayslip(ChildCasualemployeepayslip $casualemployeepayslip)
    {
        if ($this->getCasualemployeepayslips()->contains($casualemployeepayslip)) {
            $pos = $this->collCasualemployeepayslips->search($casualemployeepayslip);
            $this->collCasualemployeepayslips->remove($pos);
            if (null === $this->casualemployeepayslipsScheduledForDeletion) {
                $this->casualemployeepayslipsScheduledForDeletion = clone $this->collCasualemployeepayslips;
                $this->casualemployeepayslipsScheduledForDeletion->clear();
            }
            $this->casualemployeepayslipsScheduledForDeletion[]= clone $casualemployeepayslip;
            $casualemployeepayslip->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Casualemployeepayslips from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCasualemployeepayslip[] List of ChildCasualemployeepayslip objects
     */
    public function getCasualemployeepayslipsJoinOpsbiweeklycalendar(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCasualemployeepayslipQuery::create(null, $criteria);
        $query->joinWith('Opsbiweeklycalendar', $joinBehavior);

        return $this->getCasualemployeepayslips($query, $con);
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
     * If this ChildEmployee is new, it will return
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
                    ->filterByEmployee($this)
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
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setEmployeeloans(Collection $employeeloans, ConnectionInterface $con = null)
    {
        /** @var ChildEmployeeloan[] $employeeloansToDelete */
        $employeeloansToDelete = $this->getEmployeeloans(new Criteria(), $con)->diff($employeeloans);


        $this->employeeloansScheduledForDeletion = $employeeloansToDelete;

        foreach ($employeeloansToDelete as $employeeloanRemoved) {
            $employeeloanRemoved->setEmployee(null);
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
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collEmployeeloans);
    }

    /**
     * Method called to associate a ChildEmployeeloan object to this object
     * through the ChildEmployeeloan foreign key attribute.
     *
     * @param  ChildEmployeeloan $l ChildEmployeeloan
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
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
        $employeeloan->setEmployee($this);
    }

    /**
     * @param  ChildEmployeeloan $employeeloan The ChildEmployeeloan object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
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
            $employeeloan->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Employeeloans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployeeloan[] List of ChildEmployeeloan objects
     */
    public function getEmployeeloansJoinOpsmonthlycalendar(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeloanQuery::create(null, $criteria);
        $query->joinWith('Opsmonthlycalendar', $joinBehavior);

        return $this->getEmployeeloans($query, $con);
    }

    /**
     * Clears out the collEmployeeotherdeductions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEmployeeotherdeductions()
     */
    public function clearEmployeeotherdeductions()
    {
        $this->collEmployeeotherdeductions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEmployeeotherdeductions collection loaded partially.
     */
    public function resetPartialEmployeeotherdeductions($v = true)
    {
        $this->collEmployeeotherdeductionsPartial = $v;
    }

    /**
     * Initializes the collEmployeeotherdeductions collection.
     *
     * By default this just sets the collEmployeeotherdeductions collection to an empty array (like clearcollEmployeeotherdeductions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployeeotherdeductions($overrideExisting = true)
    {
        if (null !== $this->collEmployeeotherdeductions && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeeotherdeductionTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployeeotherdeductions = new $collectionClassName;
        $this->collEmployeeotherdeductions->setModel('\lwops\lwops\Employeeotherdeduction');
    }

    /**
     * Gets an array of ChildEmployeeotherdeduction objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployeeotherdeduction[] List of ChildEmployeeotherdeduction objects
     * @throws PropelException
     */
    public function getEmployeeotherdeductions(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeeotherdeductionsPartial && !$this->isNew();
        if (null === $this->collEmployeeotherdeductions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEmployeeotherdeductions) {
                // return empty collection
                $this->initEmployeeotherdeductions();
            } else {
                $collEmployeeotherdeductions = ChildEmployeeotherdeductionQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeeotherdeductionsPartial && count($collEmployeeotherdeductions)) {
                        $this->initEmployeeotherdeductions(false);

                        foreach ($collEmployeeotherdeductions as $obj) {
                            if (false == $this->collEmployeeotherdeductions->contains($obj)) {
                                $this->collEmployeeotherdeductions->append($obj);
                            }
                        }

                        $this->collEmployeeotherdeductionsPartial = true;
                    }

                    return $collEmployeeotherdeductions;
                }

                if ($partial && $this->collEmployeeotherdeductions) {
                    foreach ($this->collEmployeeotherdeductions as $obj) {
                        if ($obj->isNew()) {
                            $collEmployeeotherdeductions[] = $obj;
                        }
                    }
                }

                $this->collEmployeeotherdeductions = $collEmployeeotherdeductions;
                $this->collEmployeeotherdeductionsPartial = false;
            }
        }

        return $this->collEmployeeotherdeductions;
    }

    /**
     * Sets a collection of ChildEmployeeotherdeduction objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $employeeotherdeductions A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setEmployeeotherdeductions(Collection $employeeotherdeductions, ConnectionInterface $con = null)
    {
        /** @var ChildEmployeeotherdeduction[] $employeeotherdeductionsToDelete */
        $employeeotherdeductionsToDelete = $this->getEmployeeotherdeductions(new Criteria(), $con)->diff($employeeotherdeductions);


        $this->employeeotherdeductionsScheduledForDeletion = $employeeotherdeductionsToDelete;

        foreach ($employeeotherdeductionsToDelete as $employeeotherdeductionRemoved) {
            $employeeotherdeductionRemoved->setEmployee(null);
        }

        $this->collEmployeeotherdeductions = null;
        foreach ($employeeotherdeductions as $employeeotherdeduction) {
            $this->addEmployeeotherdeduction($employeeotherdeduction);
        }

        $this->collEmployeeotherdeductions = $employeeotherdeductions;
        $this->collEmployeeotherdeductionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Employeeotherdeduction objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Employeeotherdeduction objects.
     * @throws PropelException
     */
    public function countEmployeeotherdeductions(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeeotherdeductionsPartial && !$this->isNew();
        if (null === $this->collEmployeeotherdeductions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployeeotherdeductions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployeeotherdeductions());
            }

            $query = ChildEmployeeotherdeductionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collEmployeeotherdeductions);
    }

    /**
     * Method called to associate a ChildEmployeeotherdeduction object to this object
     * through the ChildEmployeeotherdeduction foreign key attribute.
     *
     * @param  ChildEmployeeotherdeduction $l ChildEmployeeotherdeduction
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function addEmployeeotherdeduction(ChildEmployeeotherdeduction $l)
    {
        if ($this->collEmployeeotherdeductions === null) {
            $this->initEmployeeotherdeductions();
            $this->collEmployeeotherdeductionsPartial = true;
        }

        if (!$this->collEmployeeotherdeductions->contains($l)) {
            $this->doAddEmployeeotherdeduction($l);

            if ($this->employeeotherdeductionsScheduledForDeletion and $this->employeeotherdeductionsScheduledForDeletion->contains($l)) {
                $this->employeeotherdeductionsScheduledForDeletion->remove($this->employeeotherdeductionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployeeotherdeduction $employeeotherdeduction The ChildEmployeeotherdeduction object to add.
     */
    protected function doAddEmployeeotherdeduction(ChildEmployeeotherdeduction $employeeotherdeduction)
    {
        $this->collEmployeeotherdeductions[]= $employeeotherdeduction;
        $employeeotherdeduction->setEmployee($this);
    }

    /**
     * @param  ChildEmployeeotherdeduction $employeeotherdeduction The ChildEmployeeotherdeduction object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function removeEmployeeotherdeduction(ChildEmployeeotherdeduction $employeeotherdeduction)
    {
        if ($this->getEmployeeotherdeductions()->contains($employeeotherdeduction)) {
            $pos = $this->collEmployeeotherdeductions->search($employeeotherdeduction);
            $this->collEmployeeotherdeductions->remove($pos);
            if (null === $this->employeeotherdeductionsScheduledForDeletion) {
                $this->employeeotherdeductionsScheduledForDeletion = clone $this->collEmployeeotherdeductions;
                $this->employeeotherdeductionsScheduledForDeletion->clear();
            }
            $this->employeeotherdeductionsScheduledForDeletion[]= clone $employeeotherdeduction;
            $employeeotherdeduction->setEmployee(null);
        }

        return $this;
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
     * If this ChildEmployee is new, it will return
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
                    ->filterByEmployee($this)
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
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setEmployeepurchasess(Collection $employeepurchasess, ConnectionInterface $con = null)
    {
        /** @var ChildEmployeepurchases[] $employeepurchasessToDelete */
        $employeepurchasessToDelete = $this->getEmployeepurchasess(new Criteria(), $con)->diff($employeepurchasess);


        $this->employeepurchasessScheduledForDeletion = $employeepurchasessToDelete;

        foreach ($employeepurchasessToDelete as $employeepurchasesRemoved) {
            $employeepurchasesRemoved->setEmployee(null);
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
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collEmployeepurchasess);
    }

    /**
     * Method called to associate a ChildEmployeepurchases object to this object
     * through the ChildEmployeepurchases foreign key attribute.
     *
     * @param  ChildEmployeepurchases $l ChildEmployeepurchases
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
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
        $employeepurchases->setEmployee($this);
    }

    /**
     * @param  ChildEmployeepurchases $employeepurchases The ChildEmployeepurchases object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
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
            $employeepurchases->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Employeepurchasess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployeepurchases[] List of ChildEmployeepurchases objects
     */
    public function getEmployeepurchasessJoinLineofbusiness(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeepurchasesQuery::create(null, $criteria);
        $query->joinWith('Lineofbusiness', $joinBehavior);

        return $this->getEmployeepurchasess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Employeepurchasess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
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
     * If this ChildEmployee is new, it will return
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
                    ->filterByEmployee($this)
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
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setEmployeeroles(Collection $employeeroles, ConnectionInterface $con = null)
    {
        /** @var ChildEmployeerole[] $employeerolesToDelete */
        $employeerolesToDelete = $this->getEmployeeroles(new Criteria(), $con)->diff($employeeroles);


        $this->employeerolesScheduledForDeletion = $employeerolesToDelete;

        foreach ($employeerolesToDelete as $employeeroleRemoved) {
            $employeeroleRemoved->setEmployee(null);
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
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collEmployeeroles);
    }

    /**
     * Method called to associate a ChildEmployeerole object to this object
     * through the ChildEmployeerole foreign key attribute.
     *
     * @param  ChildEmployeerole $l ChildEmployeerole
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
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
        $employeerole->setEmployee($this);
    }

    /**
     * @param  ChildEmployeerole $employeerole The ChildEmployeerole object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
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
            $employeerole->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Employeeroles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployeerole[] List of ChildEmployeerole objects
     */
    public function getEmployeerolesJoinEmployeeroletype(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeroleQuery::create(null, $criteria);
        $query->joinWith('Employeeroletype', $joinBehavior);

        return $this->getEmployeeroles($query, $con);
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
     * If this ChildEmployee is new, it will return
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
                    ->filterByEmployee($this)
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
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setEmployeesalaryexpenseallocations(Collection $employeesalaryexpenseallocations, ConnectionInterface $con = null)
    {
        /** @var ChildEmployeesalaryexpenseallocation[] $employeesalaryexpenseallocationsToDelete */
        $employeesalaryexpenseallocationsToDelete = $this->getEmployeesalaryexpenseallocations(new Criteria(), $con)->diff($employeesalaryexpenseallocations);


        $this->employeesalaryexpenseallocationsScheduledForDeletion = $employeesalaryexpenseallocationsToDelete;

        foreach ($employeesalaryexpenseallocationsToDelete as $employeesalaryexpenseallocationRemoved) {
            $employeesalaryexpenseallocationRemoved->setEmployee(null);
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
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collEmployeesalaryexpenseallocations);
    }

    /**
     * Method called to associate a ChildEmployeesalaryexpenseallocation object to this object
     * through the ChildEmployeesalaryexpenseallocation foreign key attribute.
     *
     * @param  ChildEmployeesalaryexpenseallocation $l ChildEmployeesalaryexpenseallocation
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
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
        $employeesalaryexpenseallocation->setEmployee($this);
    }

    /**
     * @param  ChildEmployeesalaryexpenseallocation $employeesalaryexpenseallocation The ChildEmployeesalaryexpenseallocation object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
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
            $employeesalaryexpenseallocation->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Employeesalaryexpenseallocations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployeesalaryexpenseallocation[] List of ChildEmployeesalaryexpenseallocation objects
     */
    public function getEmployeesalaryexpenseallocationsJoinLineofbusiness(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeesalaryexpenseallocationQuery::create(null, $criteria);
        $query->joinWith('Lineofbusiness', $joinBehavior);

        return $this->getEmployeesalaryexpenseallocations($query, $con);
    }

    /**
     * Clears out the collEmployeeterminations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEmployeeterminations()
     */
    public function clearEmployeeterminations()
    {
        $this->collEmployeeterminations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEmployeeterminations collection loaded partially.
     */
    public function resetPartialEmployeeterminations($v = true)
    {
        $this->collEmployeeterminationsPartial = $v;
    }

    /**
     * Initializes the collEmployeeterminations collection.
     *
     * By default this just sets the collEmployeeterminations collection to an empty array (like clearcollEmployeeterminations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployeeterminations($overrideExisting = true)
    {
        if (null !== $this->collEmployeeterminations && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeeterminationTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployeeterminations = new $collectionClassName;
        $this->collEmployeeterminations->setModel('\lwops\lwops\Employeetermination');
    }

    /**
     * Gets an array of ChildEmployeetermination objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployeetermination[] List of ChildEmployeetermination objects
     * @throws PropelException
     */
    public function getEmployeeterminations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeeterminationsPartial && !$this->isNew();
        if (null === $this->collEmployeeterminations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEmployeeterminations) {
                // return empty collection
                $this->initEmployeeterminations();
            } else {
                $collEmployeeterminations = ChildEmployeeterminationQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeeterminationsPartial && count($collEmployeeterminations)) {
                        $this->initEmployeeterminations(false);

                        foreach ($collEmployeeterminations as $obj) {
                            if (false == $this->collEmployeeterminations->contains($obj)) {
                                $this->collEmployeeterminations->append($obj);
                            }
                        }

                        $this->collEmployeeterminationsPartial = true;
                    }

                    return $collEmployeeterminations;
                }

                if ($partial && $this->collEmployeeterminations) {
                    foreach ($this->collEmployeeterminations as $obj) {
                        if ($obj->isNew()) {
                            $collEmployeeterminations[] = $obj;
                        }
                    }
                }

                $this->collEmployeeterminations = $collEmployeeterminations;
                $this->collEmployeeterminationsPartial = false;
            }
        }

        return $this->collEmployeeterminations;
    }

    /**
     * Sets a collection of ChildEmployeetermination objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $employeeterminations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setEmployeeterminations(Collection $employeeterminations, ConnectionInterface $con = null)
    {
        /** @var ChildEmployeetermination[] $employeeterminationsToDelete */
        $employeeterminationsToDelete = $this->getEmployeeterminations(new Criteria(), $con)->diff($employeeterminations);


        $this->employeeterminationsScheduledForDeletion = $employeeterminationsToDelete;

        foreach ($employeeterminationsToDelete as $employeeterminationRemoved) {
            $employeeterminationRemoved->setEmployee(null);
        }

        $this->collEmployeeterminations = null;
        foreach ($employeeterminations as $employeetermination) {
            $this->addEmployeetermination($employeetermination);
        }

        $this->collEmployeeterminations = $employeeterminations;
        $this->collEmployeeterminationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Employeetermination objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Employeetermination objects.
     * @throws PropelException
     */
    public function countEmployeeterminations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeeterminationsPartial && !$this->isNew();
        if (null === $this->collEmployeeterminations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployeeterminations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployeeterminations());
            }

            $query = ChildEmployeeterminationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collEmployeeterminations);
    }

    /**
     * Method called to associate a ChildEmployeetermination object to this object
     * through the ChildEmployeetermination foreign key attribute.
     *
     * @param  ChildEmployeetermination $l ChildEmployeetermination
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function addEmployeetermination(ChildEmployeetermination $l)
    {
        if ($this->collEmployeeterminations === null) {
            $this->initEmployeeterminations();
            $this->collEmployeeterminationsPartial = true;
        }

        if (!$this->collEmployeeterminations->contains($l)) {
            $this->doAddEmployeetermination($l);

            if ($this->employeeterminationsScheduledForDeletion and $this->employeeterminationsScheduledForDeletion->contains($l)) {
                $this->employeeterminationsScheduledForDeletion->remove($this->employeeterminationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployeetermination $employeetermination The ChildEmployeetermination object to add.
     */
    protected function doAddEmployeetermination(ChildEmployeetermination $employeetermination)
    {
        $this->collEmployeeterminations[]= $employeetermination;
        $employeetermination->setEmployee($this);
    }

    /**
     * @param  ChildEmployeetermination $employeetermination The ChildEmployeetermination object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function removeEmployeetermination(ChildEmployeetermination $employeetermination)
    {
        if ($this->getEmployeeterminations()->contains($employeetermination)) {
            $pos = $this->collEmployeeterminations->search($employeetermination);
            $this->collEmployeeterminations->remove($pos);
            if (null === $this->employeeterminationsScheduledForDeletion) {
                $this->employeeterminationsScheduledForDeletion = clone $this->collEmployeeterminations;
                $this->employeeterminationsScheduledForDeletion->clear();
            }
            $this->employeeterminationsScheduledForDeletion[]= clone $employeetermination;
            $employeetermination->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Employeeterminations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployeetermination[] List of ChildEmployeetermination objects
     */
    public function getEmployeeterminationsJoinEmployeeterminationtype(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeterminationQuery::create(null, $criteria);
        $query->joinWith('Employeeterminationtype', $joinBehavior);

        return $this->getEmployeeterminations($query, $con);
    }

    /**
     * Clears out the collFteemployeepayslips collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFteemployeepayslips()
     */
    public function clearFteemployeepayslips()
    {
        $this->collFteemployeepayslips = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collFteemployeepayslips collection loaded partially.
     */
    public function resetPartialFteemployeepayslips($v = true)
    {
        $this->collFteemployeepayslipsPartial = $v;
    }

    /**
     * Initializes the collFteemployeepayslips collection.
     *
     * By default this just sets the collFteemployeepayslips collection to an empty array (like clearcollFteemployeepayslips());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFteemployeepayslips($overrideExisting = true)
    {
        if (null !== $this->collFteemployeepayslips && !$overrideExisting) {
            return;
        }

        $collectionClassName = FteemployeepayslipTableMap::getTableMap()->getCollectionClassName();

        $this->collFteemployeepayslips = new $collectionClassName;
        $this->collFteemployeepayslips->setModel('\lwops\lwops\Fteemployeepayslip');
    }

    /**
     * Gets an array of ChildFteemployeepayslip objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildFteemployeepayslip[] List of ChildFteemployeepayslip objects
     * @throws PropelException
     */
    public function getFteemployeepayslips(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFteemployeepayslipsPartial && !$this->isNew();
        if (null === $this->collFteemployeepayslips || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFteemployeepayslips) {
                // return empty collection
                $this->initFteemployeepayslips();
            } else {
                $collFteemployeepayslips = ChildFteemployeepayslipQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFteemployeepayslipsPartial && count($collFteemployeepayslips)) {
                        $this->initFteemployeepayslips(false);

                        foreach ($collFteemployeepayslips as $obj) {
                            if (false == $this->collFteemployeepayslips->contains($obj)) {
                                $this->collFteemployeepayslips->append($obj);
                            }
                        }

                        $this->collFteemployeepayslipsPartial = true;
                    }

                    return $collFteemployeepayslips;
                }

                if ($partial && $this->collFteemployeepayslips) {
                    foreach ($this->collFteemployeepayslips as $obj) {
                        if ($obj->isNew()) {
                            $collFteemployeepayslips[] = $obj;
                        }
                    }
                }

                $this->collFteemployeepayslips = $collFteemployeepayslips;
                $this->collFteemployeepayslipsPartial = false;
            }
        }

        return $this->collFteemployeepayslips;
    }

    /**
     * Sets a collection of ChildFteemployeepayslip objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $fteemployeepayslips A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setFteemployeepayslips(Collection $fteemployeepayslips, ConnectionInterface $con = null)
    {
        /** @var ChildFteemployeepayslip[] $fteemployeepayslipsToDelete */
        $fteemployeepayslipsToDelete = $this->getFteemployeepayslips(new Criteria(), $con)->diff($fteemployeepayslips);


        $this->fteemployeepayslipsScheduledForDeletion = $fteemployeepayslipsToDelete;

        foreach ($fteemployeepayslipsToDelete as $fteemployeepayslipRemoved) {
            $fteemployeepayslipRemoved->setEmployee(null);
        }

        $this->collFteemployeepayslips = null;
        foreach ($fteemployeepayslips as $fteemployeepayslip) {
            $this->addFteemployeepayslip($fteemployeepayslip);
        }

        $this->collFteemployeepayslips = $fteemployeepayslips;
        $this->collFteemployeepayslipsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Fteemployeepayslip objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Fteemployeepayslip objects.
     * @throws PropelException
     */
    public function countFteemployeepayslips(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFteemployeepayslipsPartial && !$this->isNew();
        if (null === $this->collFteemployeepayslips || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFteemployeepayslips) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFteemployeepayslips());
            }

            $query = ChildFteemployeepayslipQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collFteemployeepayslips);
    }

    /**
     * Method called to associate a ChildFteemployeepayslip object to this object
     * through the ChildFteemployeepayslip foreign key attribute.
     *
     * @param  ChildFteemployeepayslip $l ChildFteemployeepayslip
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function addFteemployeepayslip(ChildFteemployeepayslip $l)
    {
        if ($this->collFteemployeepayslips === null) {
            $this->initFteemployeepayslips();
            $this->collFteemployeepayslipsPartial = true;
        }

        if (!$this->collFteemployeepayslips->contains($l)) {
            $this->doAddFteemployeepayslip($l);

            if ($this->fteemployeepayslipsScheduledForDeletion and $this->fteemployeepayslipsScheduledForDeletion->contains($l)) {
                $this->fteemployeepayslipsScheduledForDeletion->remove($this->fteemployeepayslipsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildFteemployeepayslip $fteemployeepayslip The ChildFteemployeepayslip object to add.
     */
    protected function doAddFteemployeepayslip(ChildFteemployeepayslip $fteemployeepayslip)
    {
        $this->collFteemployeepayslips[]= $fteemployeepayslip;
        $fteemployeepayslip->setEmployee($this);
    }

    /**
     * @param  ChildFteemployeepayslip $fteemployeepayslip The ChildFteemployeepayslip object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function removeFteemployeepayslip(ChildFteemployeepayslip $fteemployeepayslip)
    {
        if ($this->getFteemployeepayslips()->contains($fteemployeepayslip)) {
            $pos = $this->collFteemployeepayslips->search($fteemployeepayslip);
            $this->collFteemployeepayslips->remove($pos);
            if (null === $this->fteemployeepayslipsScheduledForDeletion) {
                $this->fteemployeepayslipsScheduledForDeletion = clone $this->collFteemployeepayslips;
                $this->fteemployeepayslipsScheduledForDeletion->clear();
            }
            $this->fteemployeepayslipsScheduledForDeletion[]= clone $fteemployeepayslip;
            $fteemployeepayslip->setEmployee(null);
        }

        return $this;
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
     * If this ChildEmployee is new, it will return
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
                    ->filterByEmployee($this)
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
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setFtesalaryadvances(Collection $ftesalaryadvances, ConnectionInterface $con = null)
    {
        /** @var ChildFtesalaryadvance[] $ftesalaryadvancesToDelete */
        $ftesalaryadvancesToDelete = $this->getFtesalaryadvances(new Criteria(), $con)->diff($ftesalaryadvances);


        $this->ftesalaryadvancesScheduledForDeletion = $ftesalaryadvancesToDelete;

        foreach ($ftesalaryadvancesToDelete as $ftesalaryadvanceRemoved) {
            $ftesalaryadvanceRemoved->setEmployee(null);
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
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collFtesalaryadvances);
    }

    /**
     * Method called to associate a ChildFtesalaryadvance object to this object
     * through the ChildFtesalaryadvance foreign key attribute.
     *
     * @param  ChildFtesalaryadvance $l ChildFtesalaryadvance
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
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
        $ftesalaryadvance->setEmployee($this);
    }

    /**
     * @param  ChildFtesalaryadvance $ftesalaryadvance The ChildFtesalaryadvance object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
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
            $ftesalaryadvance->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Ftesalaryadvances from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFtesalaryadvance[] List of ChildFtesalaryadvance objects
     */
    public function getFtesalaryadvancesJoinOpsmonthlycalendar(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFtesalaryadvanceQuery::create(null, $criteria);
        $query->joinWith('Opsmonthlycalendar', $joinBehavior);

        return $this->getFtesalaryadvances($query, $con);
    }

    /**
     * Clears out the collMedicaldeductions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMedicaldeductions()
     */
    public function clearMedicaldeductions()
    {
        $this->collMedicaldeductions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collMedicaldeductions collection loaded partially.
     */
    public function resetPartialMedicaldeductions($v = true)
    {
        $this->collMedicaldeductionsPartial = $v;
    }

    /**
     * Initializes the collMedicaldeductions collection.
     *
     * By default this just sets the collMedicaldeductions collection to an empty array (like clearcollMedicaldeductions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMedicaldeductions($overrideExisting = true)
    {
        if (null !== $this->collMedicaldeductions && !$overrideExisting) {
            return;
        }

        $collectionClassName = MedicaldeductionTableMap::getTableMap()->getCollectionClassName();

        $this->collMedicaldeductions = new $collectionClassName;
        $this->collMedicaldeductions->setModel('\lwops\lwops\Medicaldeduction');
    }

    /**
     * Gets an array of ChildMedicaldeduction objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMedicaldeduction[] List of ChildMedicaldeduction objects
     * @throws PropelException
     */
    public function getMedicaldeductions(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collMedicaldeductionsPartial && !$this->isNew();
        if (null === $this->collMedicaldeductions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMedicaldeductions) {
                // return empty collection
                $this->initMedicaldeductions();
            } else {
                $collMedicaldeductions = ChildMedicaldeductionQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMedicaldeductionsPartial && count($collMedicaldeductions)) {
                        $this->initMedicaldeductions(false);

                        foreach ($collMedicaldeductions as $obj) {
                            if (false == $this->collMedicaldeductions->contains($obj)) {
                                $this->collMedicaldeductions->append($obj);
                            }
                        }

                        $this->collMedicaldeductionsPartial = true;
                    }

                    return $collMedicaldeductions;
                }

                if ($partial && $this->collMedicaldeductions) {
                    foreach ($this->collMedicaldeductions as $obj) {
                        if ($obj->isNew()) {
                            $collMedicaldeductions[] = $obj;
                        }
                    }
                }

                $this->collMedicaldeductions = $collMedicaldeductions;
                $this->collMedicaldeductionsPartial = false;
            }
        }

        return $this->collMedicaldeductions;
    }

    /**
     * Sets a collection of ChildMedicaldeduction objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $medicaldeductions A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setMedicaldeductions(Collection $medicaldeductions, ConnectionInterface $con = null)
    {
        /** @var ChildMedicaldeduction[] $medicaldeductionsToDelete */
        $medicaldeductionsToDelete = $this->getMedicaldeductions(new Criteria(), $con)->diff($medicaldeductions);


        $this->medicaldeductionsScheduledForDeletion = $medicaldeductionsToDelete;

        foreach ($medicaldeductionsToDelete as $medicaldeductionRemoved) {
            $medicaldeductionRemoved->setEmployee(null);
        }

        $this->collMedicaldeductions = null;
        foreach ($medicaldeductions as $medicaldeduction) {
            $this->addMedicaldeduction($medicaldeduction);
        }

        $this->collMedicaldeductions = $medicaldeductions;
        $this->collMedicaldeductionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Medicaldeduction objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Medicaldeduction objects.
     * @throws PropelException
     */
    public function countMedicaldeductions(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collMedicaldeductionsPartial && !$this->isNew();
        if (null === $this->collMedicaldeductions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMedicaldeductions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMedicaldeductions());
            }

            $query = ChildMedicaldeductionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collMedicaldeductions);
    }

    /**
     * Method called to associate a ChildMedicaldeduction object to this object
     * through the ChildMedicaldeduction foreign key attribute.
     *
     * @param  ChildMedicaldeduction $l ChildMedicaldeduction
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function addMedicaldeduction(ChildMedicaldeduction $l)
    {
        if ($this->collMedicaldeductions === null) {
            $this->initMedicaldeductions();
            $this->collMedicaldeductionsPartial = true;
        }

        if (!$this->collMedicaldeductions->contains($l)) {
            $this->doAddMedicaldeduction($l);

            if ($this->medicaldeductionsScheduledForDeletion and $this->medicaldeductionsScheduledForDeletion->contains($l)) {
                $this->medicaldeductionsScheduledForDeletion->remove($this->medicaldeductionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMedicaldeduction $medicaldeduction The ChildMedicaldeduction object to add.
     */
    protected function doAddMedicaldeduction(ChildMedicaldeduction $medicaldeduction)
    {
        $this->collMedicaldeductions[]= $medicaldeduction;
        $medicaldeduction->setEmployee($this);
    }

    /**
     * @param  ChildMedicaldeduction $medicaldeduction The ChildMedicaldeduction object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function removeMedicaldeduction(ChildMedicaldeduction $medicaldeduction)
    {
        if ($this->getMedicaldeductions()->contains($medicaldeduction)) {
            $pos = $this->collMedicaldeductions->search($medicaldeduction);
            $this->collMedicaldeductions->remove($pos);
            if (null === $this->medicaldeductionsScheduledForDeletion) {
                $this->medicaldeductionsScheduledForDeletion = clone $this->collMedicaldeductions;
                $this->medicaldeductionsScheduledForDeletion->clear();
            }
            $this->medicaldeductionsScheduledForDeletion[]= clone $medicaldeduction;
            $medicaldeduction->setEmployee(null);
        }

        return $this;
    }

    /**
     * Clears out the collNssfdeductions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addNssfdeductions()
     */
    public function clearNssfdeductions()
    {
        $this->collNssfdeductions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collNssfdeductions collection loaded partially.
     */
    public function resetPartialNssfdeductions($v = true)
    {
        $this->collNssfdeductionsPartial = $v;
    }

    /**
     * Initializes the collNssfdeductions collection.
     *
     * By default this just sets the collNssfdeductions collection to an empty array (like clearcollNssfdeductions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNssfdeductions($overrideExisting = true)
    {
        if (null !== $this->collNssfdeductions && !$overrideExisting) {
            return;
        }

        $collectionClassName = NssfdeductionTableMap::getTableMap()->getCollectionClassName();

        $this->collNssfdeductions = new $collectionClassName;
        $this->collNssfdeductions->setModel('\lwops\lwops\Nssfdeduction');
    }

    /**
     * Gets an array of ChildNssfdeduction objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildNssfdeduction[] List of ChildNssfdeduction objects
     * @throws PropelException
     */
    public function getNssfdeductions(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collNssfdeductionsPartial && !$this->isNew();
        if (null === $this->collNssfdeductions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNssfdeductions) {
                // return empty collection
                $this->initNssfdeductions();
            } else {
                $collNssfdeductions = ChildNssfdeductionQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collNssfdeductionsPartial && count($collNssfdeductions)) {
                        $this->initNssfdeductions(false);

                        foreach ($collNssfdeductions as $obj) {
                            if (false == $this->collNssfdeductions->contains($obj)) {
                                $this->collNssfdeductions->append($obj);
                            }
                        }

                        $this->collNssfdeductionsPartial = true;
                    }

                    return $collNssfdeductions;
                }

                if ($partial && $this->collNssfdeductions) {
                    foreach ($this->collNssfdeductions as $obj) {
                        if ($obj->isNew()) {
                            $collNssfdeductions[] = $obj;
                        }
                    }
                }

                $this->collNssfdeductions = $collNssfdeductions;
                $this->collNssfdeductionsPartial = false;
            }
        }

        return $this->collNssfdeductions;
    }

    /**
     * Sets a collection of ChildNssfdeduction objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $nssfdeductions A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setNssfdeductions(Collection $nssfdeductions, ConnectionInterface $con = null)
    {
        /** @var ChildNssfdeduction[] $nssfdeductionsToDelete */
        $nssfdeductionsToDelete = $this->getNssfdeductions(new Criteria(), $con)->diff($nssfdeductions);


        $this->nssfdeductionsScheduledForDeletion = $nssfdeductionsToDelete;

        foreach ($nssfdeductionsToDelete as $nssfdeductionRemoved) {
            $nssfdeductionRemoved->setEmployee(null);
        }

        $this->collNssfdeductions = null;
        foreach ($nssfdeductions as $nssfdeduction) {
            $this->addNssfdeduction($nssfdeduction);
        }

        $this->collNssfdeductions = $nssfdeductions;
        $this->collNssfdeductionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Nssfdeduction objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Nssfdeduction objects.
     * @throws PropelException
     */
    public function countNssfdeductions(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collNssfdeductionsPartial && !$this->isNew();
        if (null === $this->collNssfdeductions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNssfdeductions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNssfdeductions());
            }

            $query = ChildNssfdeductionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collNssfdeductions);
    }

    /**
     * Method called to associate a ChildNssfdeduction object to this object
     * through the ChildNssfdeduction foreign key attribute.
     *
     * @param  ChildNssfdeduction $l ChildNssfdeduction
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function addNssfdeduction(ChildNssfdeduction $l)
    {
        if ($this->collNssfdeductions === null) {
            $this->initNssfdeductions();
            $this->collNssfdeductionsPartial = true;
        }

        if (!$this->collNssfdeductions->contains($l)) {
            $this->doAddNssfdeduction($l);

            if ($this->nssfdeductionsScheduledForDeletion and $this->nssfdeductionsScheduledForDeletion->contains($l)) {
                $this->nssfdeductionsScheduledForDeletion->remove($this->nssfdeductionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildNssfdeduction $nssfdeduction The ChildNssfdeduction object to add.
     */
    protected function doAddNssfdeduction(ChildNssfdeduction $nssfdeduction)
    {
        $this->collNssfdeductions[]= $nssfdeduction;
        $nssfdeduction->setEmployee($this);
    }

    /**
     * @param  ChildNssfdeduction $nssfdeduction The ChildNssfdeduction object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function removeNssfdeduction(ChildNssfdeduction $nssfdeduction)
    {
        if ($this->getNssfdeductions()->contains($nssfdeduction)) {
            $pos = $this->collNssfdeductions->search($nssfdeduction);
            $this->collNssfdeductions->remove($pos);
            if (null === $this->nssfdeductionsScheduledForDeletion) {
                $this->nssfdeductionsScheduledForDeletion = clone $this->collNssfdeductions;
                $this->nssfdeductionsScheduledForDeletion->clear();
            }
            $this->nssfdeductionsScheduledForDeletion[]= clone $nssfdeduction;
            $nssfdeduction->setEmployee(null);
        }

        return $this;
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
     * If this ChildEmployee is new, it will return
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
                    ->filterByEmployee($this)
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
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setParttimedetails(Collection $parttimedetails, ConnectionInterface $con = null)
    {
        /** @var ChildParttimedetail[] $parttimedetailsToDelete */
        $parttimedetailsToDelete = $this->getParttimedetails(new Criteria(), $con)->diff($parttimedetails);


        $this->parttimedetailsScheduledForDeletion = $parttimedetailsToDelete;

        foreach ($parttimedetailsToDelete as $parttimedetailRemoved) {
            $parttimedetailRemoved->setEmployee(null);
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
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collParttimedetails);
    }

    /**
     * Method called to associate a ChildParttimedetail object to this object
     * through the ChildParttimedetail foreign key attribute.
     *
     * @param  ChildParttimedetail $l ChildParttimedetail
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
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
        $parttimedetail->setEmployee($this);
    }

    /**
     * @param  ChildParttimedetail $parttimedetail The ChildParttimedetail object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
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
            $parttimedetail->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Parttimedetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
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
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Parttimedetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
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
     * Clears out the collSalaries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSalaries()
     */
    public function clearSalaries()
    {
        $this->collSalaries = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSalaries collection loaded partially.
     */
    public function resetPartialSalaries($v = true)
    {
        $this->collSalariesPartial = $v;
    }

    /**
     * Initializes the collSalaries collection.
     *
     * By default this just sets the collSalaries collection to an empty array (like clearcollSalaries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSalaries($overrideExisting = true)
    {
        if (null !== $this->collSalaries && !$overrideExisting) {
            return;
        }

        $collectionClassName = SalaryTableMap::getTableMap()->getCollectionClassName();

        $this->collSalaries = new $collectionClassName;
        $this->collSalaries->setModel('\lwops\lwops\Salary');
    }

    /**
     * Gets an array of ChildSalary objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSalary[] List of ChildSalary objects
     * @throws PropelException
     */
    public function getSalaries(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSalariesPartial && !$this->isNew();
        if (null === $this->collSalaries || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSalaries) {
                // return empty collection
                $this->initSalaries();
            } else {
                $collSalaries = ChildSalaryQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSalariesPartial && count($collSalaries)) {
                        $this->initSalaries(false);

                        foreach ($collSalaries as $obj) {
                            if (false == $this->collSalaries->contains($obj)) {
                                $this->collSalaries->append($obj);
                            }
                        }

                        $this->collSalariesPartial = true;
                    }

                    return $collSalaries;
                }

                if ($partial && $this->collSalaries) {
                    foreach ($this->collSalaries as $obj) {
                        if ($obj->isNew()) {
                            $collSalaries[] = $obj;
                        }
                    }
                }

                $this->collSalaries = $collSalaries;
                $this->collSalariesPartial = false;
            }
        }

        return $this->collSalaries;
    }

    /**
     * Sets a collection of ChildSalary objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $salaries A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setSalaries(Collection $salaries, ConnectionInterface $con = null)
    {
        /** @var ChildSalary[] $salariesToDelete */
        $salariesToDelete = $this->getSalaries(new Criteria(), $con)->diff($salaries);


        $this->salariesScheduledForDeletion = $salariesToDelete;

        foreach ($salariesToDelete as $salaryRemoved) {
            $salaryRemoved->setEmployee(null);
        }

        $this->collSalaries = null;
        foreach ($salaries as $salary) {
            $this->addSalary($salary);
        }

        $this->collSalaries = $salaries;
        $this->collSalariesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Salary objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Salary objects.
     * @throws PropelException
     */
    public function countSalaries(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSalariesPartial && !$this->isNew();
        if (null === $this->collSalaries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSalaries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSalaries());
            }

            $query = ChildSalaryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collSalaries);
    }

    /**
     * Method called to associate a ChildSalary object to this object
     * through the ChildSalary foreign key attribute.
     *
     * @param  ChildSalary $l ChildSalary
     * @return $this|\lwops\lwops\Employee The current object (for fluent API support)
     */
    public function addSalary(ChildSalary $l)
    {
        if ($this->collSalaries === null) {
            $this->initSalaries();
            $this->collSalariesPartial = true;
        }

        if (!$this->collSalaries->contains($l)) {
            $this->doAddSalary($l);

            if ($this->salariesScheduledForDeletion and $this->salariesScheduledForDeletion->contains($l)) {
                $this->salariesScheduledForDeletion->remove($this->salariesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSalary $salary The ChildSalary object to add.
     */
    protected function doAddSalary(ChildSalary $salary)
    {
        $this->collSalaries[]= $salary;
        $salary->setEmployee($this);
    }

    /**
     * @param  ChildSalary $salary The ChildSalary object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function removeSalary(ChildSalary $salary)
    {
        if ($this->getSalaries()->contains($salary)) {
            $pos = $this->collSalaries->search($salary);
            $this->collSalaries->remove($pos);
            if (null === $this->salariesScheduledForDeletion) {
                $this->salariesScheduledForDeletion = clone $this->collSalaries;
                $this->salariesScheduledForDeletion->clear();
            }
            $this->salariesScheduledForDeletion[]= clone $salary;
            $salary->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Salaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSalary[] List of ChildSalary objects
     */
    public function getSalariesJoinEmployeetype(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSalaryQuery::create(null, $criteria);
        $query->joinWith('Employeetype', $joinBehavior);

        return $this->getSalaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Salaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSalary[] List of ChildSalary objects
     */
    public function getSalariesJoinSalarytype(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSalaryQuery::create(null, $criteria);
        $query->joinWith('Salarytype', $joinBehavior);

        return $this->getSalaries($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->oid = null;
        $this->firstname = null;
        $this->middleinitial = null;
        $this->lastname = null;
        $this->nationalid = null;
        $this->mobilenbr = null;
        $this->resident = null;
        $this->elecdeduction = null;
        $this->epayment = null;
        $this->active = null;
        $this->startdt = null;
        $this->gender = null;
        $this->terminated = null;
        $this->dateofbirth = null;
        $this->maritalstatus = null;
        $this->spousefirstnm = null;
        $this->spouselastnm = null;
        $this->spousemobnbr = null;
        $this->prevemployername = null;
        $this->prevemployertelnbr = null;
        $this->prevemployerstartdt = null;
        $this->prevemployerenddt = null;
        $this->prevemployerleavingreason = null;
        $this->prevemployerlocation = null;
        $this->workdoneatprevemployer = null;
        $this->nxtofkinfirstnm = null;
        $this->nxtofkinlastnm = null;
        $this->nxtofkinmobilenbr = null;
        $this->nxtofkinresidence = null;
        $this->nxtofkinrelationship = null;
        $this->nxtofkinplaceofwork = null;
        $this->comment = null;
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
            if ($this->collAttendances) {
                foreach ($this->collAttendances as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCasualemployeepayslips) {
                foreach ($this->collCasualemployeepayslips as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeeloans) {
                foreach ($this->collEmployeeloans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeeotherdeductions) {
                foreach ($this->collEmployeeotherdeductions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeepurchasess) {
                foreach ($this->collEmployeepurchasess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeeroles) {
                foreach ($this->collEmployeeroles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeesalaryexpenseallocations) {
                foreach ($this->collEmployeesalaryexpenseallocations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeeterminations) {
                foreach ($this->collEmployeeterminations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFteemployeepayslips) {
                foreach ($this->collFteemployeepayslips as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFtesalaryadvances) {
                foreach ($this->collFtesalaryadvances as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMedicaldeductions) {
                foreach ($this->collMedicaldeductions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNssfdeductions) {
                foreach ($this->collNssfdeductions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collParttimedetails) {
                foreach ($this->collParttimedetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSalaries) {
                foreach ($this->collSalaries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAttendances = null;
        $this->collCasualemployeepayslips = null;
        $this->collEmployeeloans = null;
        $this->collEmployeeotherdeductions = null;
        $this->collEmployeepurchasess = null;
        $this->collEmployeeroles = null;
        $this->collEmployeesalaryexpenseallocations = null;
        $this->collEmployeeterminations = null;
        $this->collFteemployeepayslips = null;
        $this->collFtesalaryadvances = null;
        $this->collMedicaldeductions = null;
        $this->collNssfdeductions = null;
        $this->collParttimedetails = null;
        $this->collSalaries = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EmployeeTableMap::DEFAULT_STRING_FORMAT);
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
