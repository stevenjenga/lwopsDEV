<?php

namespace lwops\lwops\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use lwops\lwops\Employee;
use lwops\lwops\EmployeeQuery;


/**
 * This class defines the structure of the 'employee' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class EmployeeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.EmployeeTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'employee';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Employee';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Employee';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 34;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 34;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'employee.oid';

    /**
     * the column name for the firstName field
     */
    const COL_FIRSTNAME = 'employee.firstName';

    /**
     * the column name for the middleInitial field
     */
    const COL_MIDDLEINITIAL = 'employee.middleInitial';

    /**
     * the column name for the lastName field
     */
    const COL_LASTNAME = 'employee.lastName';

    /**
     * the column name for the nationalID field
     */
    const COL_NATIONALID = 'employee.nationalID';

    /**
     * the column name for the mobileNbr field
     */
    const COL_MOBILENBR = 'employee.mobileNbr';

    /**
     * the column name for the resident field
     */
    const COL_RESIDENT = 'employee.resident';

    /**
     * the column name for the elecDeduction field
     */
    const COL_ELECDEDUCTION = 'employee.elecDeduction';

    /**
     * the column name for the ePayment field
     */
    const COL_EPAYMENT = 'employee.ePayment';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'employee.active';

    /**
     * the column name for the startDt field
     */
    const COL_STARTDT = 'employee.startDt';

    /**
     * the column name for the gender field
     */
    const COL_GENDER = 'employee.gender';

    /**
     * the column name for the terminated field
     */
    const COL_TERMINATED = 'employee.terminated';

    /**
     * the column name for the dateOfBirth field
     */
    const COL_DATEOFBIRTH = 'employee.dateOfBirth';

    /**
     * the column name for the maritalStatus field
     */
    const COL_MARITALSTATUS = 'employee.maritalStatus';

    /**
     * the column name for the spouseFirstNm field
     */
    const COL_SPOUSEFIRSTNM = 'employee.spouseFirstNm';

    /**
     * the column name for the spouseLastNm field
     */
    const COL_SPOUSELASTNM = 'employee.spouseLastNm';

    /**
     * the column name for the spouseMobNbr field
     */
    const COL_SPOUSEMOBNBR = 'employee.spouseMobNbr';

    /**
     * the column name for the prevEmployerName field
     */
    const COL_PREVEMPLOYERNAME = 'employee.prevEmployerName';

    /**
     * the column name for the prevEmployerTelNbr field
     */
    const COL_PREVEMPLOYERTELNBR = 'employee.prevEmployerTelNbr';

    /**
     * the column name for the prevEmployerStartDt field
     */
    const COL_PREVEMPLOYERSTARTDT = 'employee.prevEmployerStartDt';

    /**
     * the column name for the prevEmployerEndDt field
     */
    const COL_PREVEMPLOYERENDDT = 'employee.prevEmployerEndDt';

    /**
     * the column name for the prevEmployerLeavingReason field
     */
    const COL_PREVEMPLOYERLEAVINGREASON = 'employee.prevEmployerLeavingReason';

    /**
     * the column name for the prevEmployerLocation field
     */
    const COL_PREVEMPLOYERLOCATION = 'employee.prevEmployerLocation';

    /**
     * the column name for the workDoneAtPrevEmployer field
     */
    const COL_WORKDONEATPREVEMPLOYER = 'employee.workDoneAtPrevEmployer';

    /**
     * the column name for the nxtOfKinFirstNm field
     */
    const COL_NXTOFKINFIRSTNM = 'employee.nxtOfKinFirstNm';

    /**
     * the column name for the nxtOfKinLastNm field
     */
    const COL_NXTOFKINLASTNM = 'employee.nxtOfKinLastNm';

    /**
     * the column name for the nxtOfKinMobileNbr field
     */
    const COL_NXTOFKINMOBILENBR = 'employee.nxtOfKinMobileNbr';

    /**
     * the column name for the nxtOfKinResidence field
     */
    const COL_NXTOFKINRESIDENCE = 'employee.nxtOfKinResidence';

    /**
     * the column name for the nxtOfKinRelationship field
     */
    const COL_NXTOFKINRELATIONSHIP = 'employee.nxtOfKinRelationship';

    /**
     * the column name for the nxtOfKinPlaceOfWork field
     */
    const COL_NXTOFKINPLACEOFWORK = 'employee.nxtOfKinPlaceOfWork';

    /**
     * the column name for the comment field
     */
    const COL_COMMENT = 'employee.comment';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'employee.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'employee.updtTmstp';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Oid', 'Firstname', 'Middleinitial', 'Lastname', 'Nationalid', 'Mobilenbr', 'Resident', 'Elecdeduction', 'Epayment', 'Active', 'Startdt', 'Gender', 'Terminated', 'Dateofbirth', 'Maritalstatus', 'Spousefirstnm', 'Spouselastnm', 'Spousemobnbr', 'Prevemployername', 'Prevemployertelnbr', 'Prevemployerstartdt', 'Prevemployerenddt', 'Prevemployerleavingreason', 'Prevemployerlocation', 'Workdoneatprevemployer', 'Nxtofkinfirstnm', 'Nxtofkinlastnm', 'Nxtofkinmobilenbr', 'Nxtofkinresidence', 'Nxtofkinrelationship', 'Nxtofkinplaceofwork', 'Comment', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'firstname', 'middleinitial', 'lastname', 'nationalid', 'mobilenbr', 'resident', 'elecdeduction', 'epayment', 'active', 'startdt', 'gender', 'terminated', 'dateofbirth', 'maritalstatus', 'spousefirstnm', 'spouselastnm', 'spousemobnbr', 'prevemployername', 'prevemployertelnbr', 'prevemployerstartdt', 'prevemployerenddt', 'prevemployerleavingreason', 'prevemployerlocation', 'workdoneatprevemployer', 'nxtofkinfirstnm', 'nxtofkinlastnm', 'nxtofkinmobilenbr', 'nxtofkinresidence', 'nxtofkinrelationship', 'nxtofkinplaceofwork', 'comment', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(EmployeeTableMap::COL_OID, EmployeeTableMap::COL_FIRSTNAME, EmployeeTableMap::COL_MIDDLEINITIAL, EmployeeTableMap::COL_LASTNAME, EmployeeTableMap::COL_NATIONALID, EmployeeTableMap::COL_MOBILENBR, EmployeeTableMap::COL_RESIDENT, EmployeeTableMap::COL_ELECDEDUCTION, EmployeeTableMap::COL_EPAYMENT, EmployeeTableMap::COL_ACTIVE, EmployeeTableMap::COL_STARTDT, EmployeeTableMap::COL_GENDER, EmployeeTableMap::COL_TERMINATED, EmployeeTableMap::COL_DATEOFBIRTH, EmployeeTableMap::COL_MARITALSTATUS, EmployeeTableMap::COL_SPOUSEFIRSTNM, EmployeeTableMap::COL_SPOUSELASTNM, EmployeeTableMap::COL_SPOUSEMOBNBR, EmployeeTableMap::COL_PREVEMPLOYERNAME, EmployeeTableMap::COL_PREVEMPLOYERTELNBR, EmployeeTableMap::COL_PREVEMPLOYERSTARTDT, EmployeeTableMap::COL_PREVEMPLOYERENDDT, EmployeeTableMap::COL_PREVEMPLOYERLEAVINGREASON, EmployeeTableMap::COL_PREVEMPLOYERLOCATION, EmployeeTableMap::COL_WORKDONEATPREVEMPLOYER, EmployeeTableMap::COL_NXTOFKINFIRSTNM, EmployeeTableMap::COL_NXTOFKINLASTNM, EmployeeTableMap::COL_NXTOFKINMOBILENBR, EmployeeTableMap::COL_NXTOFKINRESIDENCE, EmployeeTableMap::COL_NXTOFKINRELATIONSHIP, EmployeeTableMap::COL_NXTOFKINPLACEOFWORK, EmployeeTableMap::COL_COMMENT, EmployeeTableMap::COL_CREATETMSTP, EmployeeTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'firstName', 'middleInitial', 'lastName', 'nationalID', 'mobileNbr', 'resident', 'elecDeduction', 'ePayment', 'active', 'startDt', 'gender', 'terminated', 'dateOfBirth', 'maritalStatus', 'spouseFirstNm', 'spouseLastNm', 'spouseMobNbr', 'prevEmployerName', 'prevEmployerTelNbr', 'prevEmployerStartDt', 'prevEmployerEndDt', 'prevEmployerLeavingReason', 'prevEmployerLocation', 'workDoneAtPrevEmployer', 'nxtOfKinFirstNm', 'nxtOfKinLastNm', 'nxtOfKinMobileNbr', 'nxtOfKinResidence', 'nxtOfKinRelationship', 'nxtOfKinPlaceOfWork', 'comment', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Firstname' => 1, 'Middleinitial' => 2, 'Lastname' => 3, 'Nationalid' => 4, 'Mobilenbr' => 5, 'Resident' => 6, 'Elecdeduction' => 7, 'Epayment' => 8, 'Active' => 9, 'Startdt' => 10, 'Gender' => 11, 'Terminated' => 12, 'Dateofbirth' => 13, 'Maritalstatus' => 14, 'Spousefirstnm' => 15, 'Spouselastnm' => 16, 'Spousemobnbr' => 17, 'Prevemployername' => 18, 'Prevemployertelnbr' => 19, 'Prevemployerstartdt' => 20, 'Prevemployerenddt' => 21, 'Prevemployerleavingreason' => 22, 'Prevemployerlocation' => 23, 'Workdoneatprevemployer' => 24, 'Nxtofkinfirstnm' => 25, 'Nxtofkinlastnm' => 26, 'Nxtofkinmobilenbr' => 27, 'Nxtofkinresidence' => 28, 'Nxtofkinrelationship' => 29, 'Nxtofkinplaceofwork' => 30, 'Comment' => 31, 'Createtmstp' => 32, 'Updttmstp' => 33, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'firstname' => 1, 'middleinitial' => 2, 'lastname' => 3, 'nationalid' => 4, 'mobilenbr' => 5, 'resident' => 6, 'elecdeduction' => 7, 'epayment' => 8, 'active' => 9, 'startdt' => 10, 'gender' => 11, 'terminated' => 12, 'dateofbirth' => 13, 'maritalstatus' => 14, 'spousefirstnm' => 15, 'spouselastnm' => 16, 'spousemobnbr' => 17, 'prevemployername' => 18, 'prevemployertelnbr' => 19, 'prevemployerstartdt' => 20, 'prevemployerenddt' => 21, 'prevemployerleavingreason' => 22, 'prevemployerlocation' => 23, 'workdoneatprevemployer' => 24, 'nxtofkinfirstnm' => 25, 'nxtofkinlastnm' => 26, 'nxtofkinmobilenbr' => 27, 'nxtofkinresidence' => 28, 'nxtofkinrelationship' => 29, 'nxtofkinplaceofwork' => 30, 'comment' => 31, 'createtmstp' => 32, 'updttmstp' => 33, ),
        self::TYPE_COLNAME       => array(EmployeeTableMap::COL_OID => 0, EmployeeTableMap::COL_FIRSTNAME => 1, EmployeeTableMap::COL_MIDDLEINITIAL => 2, EmployeeTableMap::COL_LASTNAME => 3, EmployeeTableMap::COL_NATIONALID => 4, EmployeeTableMap::COL_MOBILENBR => 5, EmployeeTableMap::COL_RESIDENT => 6, EmployeeTableMap::COL_ELECDEDUCTION => 7, EmployeeTableMap::COL_EPAYMENT => 8, EmployeeTableMap::COL_ACTIVE => 9, EmployeeTableMap::COL_STARTDT => 10, EmployeeTableMap::COL_GENDER => 11, EmployeeTableMap::COL_TERMINATED => 12, EmployeeTableMap::COL_DATEOFBIRTH => 13, EmployeeTableMap::COL_MARITALSTATUS => 14, EmployeeTableMap::COL_SPOUSEFIRSTNM => 15, EmployeeTableMap::COL_SPOUSELASTNM => 16, EmployeeTableMap::COL_SPOUSEMOBNBR => 17, EmployeeTableMap::COL_PREVEMPLOYERNAME => 18, EmployeeTableMap::COL_PREVEMPLOYERTELNBR => 19, EmployeeTableMap::COL_PREVEMPLOYERSTARTDT => 20, EmployeeTableMap::COL_PREVEMPLOYERENDDT => 21, EmployeeTableMap::COL_PREVEMPLOYERLEAVINGREASON => 22, EmployeeTableMap::COL_PREVEMPLOYERLOCATION => 23, EmployeeTableMap::COL_WORKDONEATPREVEMPLOYER => 24, EmployeeTableMap::COL_NXTOFKINFIRSTNM => 25, EmployeeTableMap::COL_NXTOFKINLASTNM => 26, EmployeeTableMap::COL_NXTOFKINMOBILENBR => 27, EmployeeTableMap::COL_NXTOFKINRESIDENCE => 28, EmployeeTableMap::COL_NXTOFKINRELATIONSHIP => 29, EmployeeTableMap::COL_NXTOFKINPLACEOFWORK => 30, EmployeeTableMap::COL_COMMENT => 31, EmployeeTableMap::COL_CREATETMSTP => 32, EmployeeTableMap::COL_UPDTTMSTP => 33, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'firstName' => 1, 'middleInitial' => 2, 'lastName' => 3, 'nationalID' => 4, 'mobileNbr' => 5, 'resident' => 6, 'elecDeduction' => 7, 'ePayment' => 8, 'active' => 9, 'startDt' => 10, 'gender' => 11, 'terminated' => 12, 'dateOfBirth' => 13, 'maritalStatus' => 14, 'spouseFirstNm' => 15, 'spouseLastNm' => 16, 'spouseMobNbr' => 17, 'prevEmployerName' => 18, 'prevEmployerTelNbr' => 19, 'prevEmployerStartDt' => 20, 'prevEmployerEndDt' => 21, 'prevEmployerLeavingReason' => 22, 'prevEmployerLocation' => 23, 'workDoneAtPrevEmployer' => 24, 'nxtOfKinFirstNm' => 25, 'nxtOfKinLastNm' => 26, 'nxtOfKinMobileNbr' => 27, 'nxtOfKinResidence' => 28, 'nxtOfKinRelationship' => 29, 'nxtOfKinPlaceOfWork' => 30, 'comment' => 31, 'createTmstp' => 32, 'updtTmstp' => 33, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('employee');
        $this->setPhpName('Employee');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Employee');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addColumn('firstName', 'Firstname', 'VARCHAR', true, 20, null);
        $this->addColumn('middleInitial', 'Middleinitial', 'VARCHAR', false, 1, 'X');
        $this->addColumn('lastName', 'Lastname', 'VARCHAR', true, 20, null);
        $this->addColumn('nationalID', 'Nationalid', 'CHAR', true, 10, '1000000001');
        $this->addColumn('mobileNbr', 'Mobilenbr', 'CHAR', true, 10, '0720000000');
        $this->addColumn('resident', 'Resident', 'BOOLEAN', true, 1, false);
        $this->addColumn('elecDeduction', 'Elecdeduction', 'BOOLEAN', true, 1, true);
        $this->addColumn('ePayment', 'Epayment', 'BOOLEAN', true, 1, false);
        $this->addColumn('active', 'Active', 'BOOLEAN', true, 1, true);
        $this->addColumn('startDt', 'Startdt', 'DATE', true, null, null);
        $this->addColumn('gender', 'Gender', 'CHAR', true, null, 'M');
        $this->addColumn('terminated', 'Terminated', 'BOOLEAN', true, 1, false);
        $this->addColumn('dateOfBirth', 'Dateofbirth', 'DATE', true, null, null);
        $this->addColumn('maritalStatus', 'Maritalstatus', 'VARCHAR', true, 1, null);
        $this->addColumn('spouseFirstNm', 'Spousefirstnm', 'VARCHAR', false, 45, null);
        $this->addColumn('spouseLastNm', 'Spouselastnm', 'VARCHAR', false, 45, null);
        $this->addColumn('spouseMobNbr', 'Spousemobnbr', 'VARCHAR', false, 10, null);
        $this->addColumn('prevEmployerName', 'Prevemployername', 'VARCHAR', true, 45, null);
        $this->addColumn('prevEmployerTelNbr', 'Prevemployertelnbr', 'VARCHAR', true, 45, null);
        $this->addColumn('prevEmployerStartDt', 'Prevemployerstartdt', 'DATE', true, null, null);
        $this->addColumn('prevEmployerEndDt', 'Prevemployerenddt', 'DATE', true, null, null);
        $this->addColumn('prevEmployerLeavingReason', 'Prevemployerleavingreason', 'VARCHAR', true, 100, null);
        $this->addColumn('prevEmployerLocation', 'Prevemployerlocation', 'VARCHAR', true, 100, null);
        $this->addColumn('workDoneAtPrevEmployer', 'Workdoneatprevemployer', 'VARCHAR', true, 150, null);
        $this->addColumn('nxtOfKinFirstNm', 'Nxtofkinfirstnm', 'VARCHAR', true, 45, null);
        $this->addColumn('nxtOfKinLastNm', 'Nxtofkinlastnm', 'VARCHAR', true, 45, null);
        $this->addColumn('nxtOfKinMobileNbr', 'Nxtofkinmobilenbr', 'VARCHAR', true, 10, null);
        $this->addColumn('nxtOfKinResidence', 'Nxtofkinresidence', 'VARCHAR', true, 45, null);
        $this->addColumn('nxtOfKinRelationship', 'Nxtofkinrelationship', 'VARCHAR', true, 10, null);
        $this->addColumn('nxtOfKinPlaceOfWork', 'Nxtofkinplaceofwork', 'VARCHAR', true, 75, null);
        $this->addColumn('comment', 'Comment', 'VARCHAR', false, 255, null);
        $this->addColumn('createTmstp', 'Createtmstp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updtTmstp', 'Updttmstp', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Attendance', '\\lwops\\lwops\\Attendance', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, 'Attendances', false);
        $this->addRelation('Casualemployeepayslip', '\\lwops\\lwops\\Casualemployeepayslip', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, 'Casualemployeepayslips', false);
        $this->addRelation('Employeeloan', '\\lwops\\lwops\\Employeeloan', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, 'Employeeloans', false);
        $this->addRelation('Employeeotherdeduction', '\\lwops\\lwops\\Employeeotherdeduction', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, 'Employeeotherdeductions', false);
        $this->addRelation('Employeepurchases', '\\lwops\\lwops\\Employeepurchases', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, 'Employeepurchasess', false);
        $this->addRelation('Employeerole', '\\lwops\\lwops\\Employeerole', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, 'Employeeroles', false);
        $this->addRelation('Employeesalaryexpenseallocation', '\\lwops\\lwops\\Employeesalaryexpenseallocation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, 'Employeesalaryexpenseallocations', false);
        $this->addRelation('Employeetermination', '\\lwops\\lwops\\Employeetermination', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, 'Employeeterminations', false);
        $this->addRelation('Fteemployeepayslip', '\\lwops\\lwops\\Fteemployeepayslip', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, 'Fteemployeepayslips', false);
        $this->addRelation('Ftesalaryadvance', '\\lwops\\lwops\\Ftesalaryadvance', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, 'Ftesalaryadvances', false);
        $this->addRelation('Medicaldeduction', '\\lwops\\lwops\\Medicaldeduction', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, 'Medicaldeductions', false);
        $this->addRelation('Nssfdeduction', '\\lwops\\lwops\\Nssfdeduction', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, 'Nssfdeductions', false);
        $this->addRelation('Parttimedetail', '\\lwops\\lwops\\Parttimedetail', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, 'Parttimedetails', false);
        $this->addRelation('Salary', '\\lwops\\lwops\\Salary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, 'Salaries', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? EmployeeTableMap::CLASS_DEFAULT : EmployeeTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Employee object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EmployeeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmployeeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmployeeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmployeeTableMap::OM_CLASS;
            /** @var Employee $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmployeeTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = EmployeeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmployeeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Employee $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmployeeTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(EmployeeTableMap::COL_OID);
            $criteria->addSelectColumn(EmployeeTableMap::COL_FIRSTNAME);
            $criteria->addSelectColumn(EmployeeTableMap::COL_MIDDLEINITIAL);
            $criteria->addSelectColumn(EmployeeTableMap::COL_LASTNAME);
            $criteria->addSelectColumn(EmployeeTableMap::COL_NATIONALID);
            $criteria->addSelectColumn(EmployeeTableMap::COL_MOBILENBR);
            $criteria->addSelectColumn(EmployeeTableMap::COL_RESIDENT);
            $criteria->addSelectColumn(EmployeeTableMap::COL_ELECDEDUCTION);
            $criteria->addSelectColumn(EmployeeTableMap::COL_EPAYMENT);
            $criteria->addSelectColumn(EmployeeTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(EmployeeTableMap::COL_STARTDT);
            $criteria->addSelectColumn(EmployeeTableMap::COL_GENDER);
            $criteria->addSelectColumn(EmployeeTableMap::COL_TERMINATED);
            $criteria->addSelectColumn(EmployeeTableMap::COL_DATEOFBIRTH);
            $criteria->addSelectColumn(EmployeeTableMap::COL_MARITALSTATUS);
            $criteria->addSelectColumn(EmployeeTableMap::COL_SPOUSEFIRSTNM);
            $criteria->addSelectColumn(EmployeeTableMap::COL_SPOUSELASTNM);
            $criteria->addSelectColumn(EmployeeTableMap::COL_SPOUSEMOBNBR);
            $criteria->addSelectColumn(EmployeeTableMap::COL_PREVEMPLOYERNAME);
            $criteria->addSelectColumn(EmployeeTableMap::COL_PREVEMPLOYERTELNBR);
            $criteria->addSelectColumn(EmployeeTableMap::COL_PREVEMPLOYERSTARTDT);
            $criteria->addSelectColumn(EmployeeTableMap::COL_PREVEMPLOYERENDDT);
            $criteria->addSelectColumn(EmployeeTableMap::COL_PREVEMPLOYERLEAVINGREASON);
            $criteria->addSelectColumn(EmployeeTableMap::COL_PREVEMPLOYERLOCATION);
            $criteria->addSelectColumn(EmployeeTableMap::COL_WORKDONEATPREVEMPLOYER);
            $criteria->addSelectColumn(EmployeeTableMap::COL_NXTOFKINFIRSTNM);
            $criteria->addSelectColumn(EmployeeTableMap::COL_NXTOFKINLASTNM);
            $criteria->addSelectColumn(EmployeeTableMap::COL_NXTOFKINMOBILENBR);
            $criteria->addSelectColumn(EmployeeTableMap::COL_NXTOFKINRESIDENCE);
            $criteria->addSelectColumn(EmployeeTableMap::COL_NXTOFKINRELATIONSHIP);
            $criteria->addSelectColumn(EmployeeTableMap::COL_NXTOFKINPLACEOFWORK);
            $criteria->addSelectColumn(EmployeeTableMap::COL_COMMENT);
            $criteria->addSelectColumn(EmployeeTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(EmployeeTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.firstName');
            $criteria->addSelectColumn($alias . '.middleInitial');
            $criteria->addSelectColumn($alias . '.lastName');
            $criteria->addSelectColumn($alias . '.nationalID');
            $criteria->addSelectColumn($alias . '.mobileNbr');
            $criteria->addSelectColumn($alias . '.resident');
            $criteria->addSelectColumn($alias . '.elecDeduction');
            $criteria->addSelectColumn($alias . '.ePayment');
            $criteria->addSelectColumn($alias . '.active');
            $criteria->addSelectColumn($alias . '.startDt');
            $criteria->addSelectColumn($alias . '.gender');
            $criteria->addSelectColumn($alias . '.terminated');
            $criteria->addSelectColumn($alias . '.dateOfBirth');
            $criteria->addSelectColumn($alias . '.maritalStatus');
            $criteria->addSelectColumn($alias . '.spouseFirstNm');
            $criteria->addSelectColumn($alias . '.spouseLastNm');
            $criteria->addSelectColumn($alias . '.spouseMobNbr');
            $criteria->addSelectColumn($alias . '.prevEmployerName');
            $criteria->addSelectColumn($alias . '.prevEmployerTelNbr');
            $criteria->addSelectColumn($alias . '.prevEmployerStartDt');
            $criteria->addSelectColumn($alias . '.prevEmployerEndDt');
            $criteria->addSelectColumn($alias . '.prevEmployerLeavingReason');
            $criteria->addSelectColumn($alias . '.prevEmployerLocation');
            $criteria->addSelectColumn($alias . '.workDoneAtPrevEmployer');
            $criteria->addSelectColumn($alias . '.nxtOfKinFirstNm');
            $criteria->addSelectColumn($alias . '.nxtOfKinLastNm');
            $criteria->addSelectColumn($alias . '.nxtOfKinMobileNbr');
            $criteria->addSelectColumn($alias . '.nxtOfKinResidence');
            $criteria->addSelectColumn($alias . '.nxtOfKinRelationship');
            $criteria->addSelectColumn($alias . '.nxtOfKinPlaceOfWork');
            $criteria->addSelectColumn($alias . '.comment');
            $criteria->addSelectColumn($alias . '.createTmstp');
            $criteria->addSelectColumn($alias . '.updtTmstp');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(EmployeeTableMap::DATABASE_NAME)->getTable(EmployeeTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EmployeeTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EmployeeTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EmployeeTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Employee or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Employee object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Employee) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmployeeTableMap::DATABASE_NAME);
            $criteria->add(EmployeeTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = EmployeeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmployeeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmployeeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the employee table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EmployeeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Employee or Criteria object.
     *
     * @param mixed               $criteria Criteria or Employee object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Employee object
        }

        if ($criteria->containsKey(EmployeeTableMap::COL_OID) && $criteria->keyContainsValue(EmployeeTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmployeeTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = EmployeeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EmployeeTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EmployeeTableMap::buildTableMap();
