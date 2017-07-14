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
use lwops\lwops\Fteemployeepayslip;
use lwops\lwops\FteemployeepayslipQuery;


/**
 * This class defines the structure of the 'fteemployeepayslip' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FteemployeepayslipTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.FteemployeepayslipTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'fteemployeepayslip';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Fteemployeepayslip';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Fteemployeepayslip';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 27;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 27;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'fteemployeepayslip.oid';

    /**
     * the column name for the opsMonthlyCalendarOid field
     */
    const COL_OPSMONTHLYCALENDAROID = 'fteemployeepayslip.opsMonthlyCalendarOid';

    /**
     * the column name for the employeeOid field
     */
    const COL_EMPLOYEEOID = 'fteemployeepayslip.employeeOid';

    /**
     * the column name for the salaryAmount field
     */
    const COL_SALARYAMOUNT = 'fteemployeepayslip.salaryAmount';

    /**
     * the column name for the dailyRate field
     */
    const COL_DAILYRATE = 'fteemployeepayslip.dailyRate';

    /**
     * the column name for the hourlyRate field
     */
    const COL_HOURLYRATE = 'fteemployeepayslip.hourlyRate';

    /**
     * the column name for the daysMissed field
     */
    const COL_DAYSMISSED = 'fteemployeepayslip.daysMissed';

    /**
     * the column name for the totalParttimeHrs field
     */
    const COL_TOTALPARTTIMEHRS = 'fteemployeepayslip.totalParttimeHrs';

    /**
     * the column name for the parttimePay field
     */
    const COL_PARTTIMEPAY = 'fteemployeepayslip.parttimePay';

    /**
     * the column name for the otherDaysWorked field
     */
    const COL_OTHERDAYSWORKED = 'fteemployeepayslip.otherDaysWorked';

    /**
     * the column name for the otherDaysPayRate field
     */
    const COL_OTHERDAYSPAYRATE = 'fteemployeepayslip.otherDaysPayRate';

    /**
     * the column name for the otherworkPay field
     */
    const COL_OTHERWORKPAY = 'fteemployeepayslip.otherworkPay';

    /**
     * the column name for the medicalDeduction field
     */
    const COL_MEDICALDEDUCTION = 'fteemployeepayslip.medicalDeduction';

    /**
     * the column name for the NSSFdeduction field
     */
    const COL_NSSFDEDUCTION = 'fteemployeepayslip.NSSFdeduction';

    /**
     * the column name for the loanDeduction field
     */
    const COL_LOANDEDUCTION = 'fteemployeepayslip.loanDeduction';

    /**
     * the column name for the loanBalance field
     */
    const COL_LOANBALANCE = 'fteemployeepayslip.loanBalance';

    /**
     * the column name for the advance field
     */
    const COL_ADVANCE = 'fteemployeepayslip.advance';

    /**
     * the column name for the elecDeduction field
     */
    const COL_ELECDEDUCTION = 'fteemployeepayslip.elecDeduction';

    /**
     * the column name for the purchasesDeduction field
     */
    const COL_PURCHASESDEDUCTION = 'fteemployeepayslip.purchasesDeduction';

    /**
     * the column name for the otherDeduction field
     */
    const COL_OTHERDEDUCTION = 'fteemployeepayslip.otherDeduction';

    /**
     * the column name for the otherDeductionDescr field
     */
    const COL_OTHERDEDUCTIONDESCR = 'fteemployeepayslip.otherDeductionDescr';

    /**
     * the column name for the bonus field
     */
    const COL_BONUS = 'fteemployeepayslip.bonus';

    /**
     * the column name for the payslipNbr field
     */
    const COL_PAYSLIPNBR = 'fteemployeepayslip.payslipNbr';

    /**
     * the column name for the lockDt field
     */
    const COL_LOCKDT = 'fteemployeepayslip.lockDt';

    /**
     * the column name for the lockedFlg field
     */
    const COL_LOCKEDFLG = 'fteemployeepayslip.lockedFlg';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'fteemployeepayslip.updtTmstp';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'fteemployeepayslip.createTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Opsmonthlycalendaroid', 'Employeeoid', 'Salaryamount', 'Dailyrate', 'Hourlyrate', 'Daysmissed', 'Totalparttimehrs', 'Parttimepay', 'Otherdaysworked', 'Otherdayspayrate', 'Otherworkpay', 'Medicaldeduction', 'Nssfdeduction', 'Loandeduction', 'Loanbalance', 'Advance', 'Elecdeduction', 'Purchasesdeduction', 'Otherdeduction', 'Otherdeductiondescr', 'Bonus', 'Payslipnbr', 'Lockdt', 'Lockedflg', 'Updttmstp', 'Createtmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'opsmonthlycalendaroid', 'employeeoid', 'salaryamount', 'dailyrate', 'hourlyrate', 'daysmissed', 'totalparttimehrs', 'parttimepay', 'otherdaysworked', 'otherdayspayrate', 'otherworkpay', 'medicaldeduction', 'nssfdeduction', 'loandeduction', 'loanbalance', 'advance', 'elecdeduction', 'purchasesdeduction', 'otherdeduction', 'otherdeductiondescr', 'bonus', 'payslipnbr', 'lockdt', 'lockedflg', 'updttmstp', 'createtmstp', ),
        self::TYPE_COLNAME       => array(FteemployeepayslipTableMap::COL_OID, FteemployeepayslipTableMap::COL_OPSMONTHLYCALENDAROID, FteemployeepayslipTableMap::COL_EMPLOYEEOID, FteemployeepayslipTableMap::COL_SALARYAMOUNT, FteemployeepayslipTableMap::COL_DAILYRATE, FteemployeepayslipTableMap::COL_HOURLYRATE, FteemployeepayslipTableMap::COL_DAYSMISSED, FteemployeepayslipTableMap::COL_TOTALPARTTIMEHRS, FteemployeepayslipTableMap::COL_PARTTIMEPAY, FteemployeepayslipTableMap::COL_OTHERDAYSWORKED, FteemployeepayslipTableMap::COL_OTHERDAYSPAYRATE, FteemployeepayslipTableMap::COL_OTHERWORKPAY, FteemployeepayslipTableMap::COL_MEDICALDEDUCTION, FteemployeepayslipTableMap::COL_NSSFDEDUCTION, FteemployeepayslipTableMap::COL_LOANDEDUCTION, FteemployeepayslipTableMap::COL_LOANBALANCE, FteemployeepayslipTableMap::COL_ADVANCE, FteemployeepayslipTableMap::COL_ELECDEDUCTION, FteemployeepayslipTableMap::COL_PURCHASESDEDUCTION, FteemployeepayslipTableMap::COL_OTHERDEDUCTION, FteemployeepayslipTableMap::COL_OTHERDEDUCTIONDESCR, FteemployeepayslipTableMap::COL_BONUS, FteemployeepayslipTableMap::COL_PAYSLIPNBR, FteemployeepayslipTableMap::COL_LOCKDT, FteemployeepayslipTableMap::COL_LOCKEDFLG, FteemployeepayslipTableMap::COL_UPDTTMSTP, FteemployeepayslipTableMap::COL_CREATETMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'opsMonthlyCalendarOid', 'employeeOid', 'salaryAmount', 'dailyRate', 'hourlyRate', 'daysMissed', 'totalParttimeHrs', 'parttimePay', 'otherDaysWorked', 'otherDaysPayRate', 'otherworkPay', 'medicalDeduction', 'NSSFdeduction', 'loanDeduction', 'loanBalance', 'advance', 'elecDeduction', 'purchasesDeduction', 'otherDeduction', 'otherDeductionDescr', 'bonus', 'payslipNbr', 'lockDt', 'lockedFlg', 'updtTmstp', 'createTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Opsmonthlycalendaroid' => 1, 'Employeeoid' => 2, 'Salaryamount' => 3, 'Dailyrate' => 4, 'Hourlyrate' => 5, 'Daysmissed' => 6, 'Totalparttimehrs' => 7, 'Parttimepay' => 8, 'Otherdaysworked' => 9, 'Otherdayspayrate' => 10, 'Otherworkpay' => 11, 'Medicaldeduction' => 12, 'Nssfdeduction' => 13, 'Loandeduction' => 14, 'Loanbalance' => 15, 'Advance' => 16, 'Elecdeduction' => 17, 'Purchasesdeduction' => 18, 'Otherdeduction' => 19, 'Otherdeductiondescr' => 20, 'Bonus' => 21, 'Payslipnbr' => 22, 'Lockdt' => 23, 'Lockedflg' => 24, 'Updttmstp' => 25, 'Createtmstp' => 26, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'opsmonthlycalendaroid' => 1, 'employeeoid' => 2, 'salaryamount' => 3, 'dailyrate' => 4, 'hourlyrate' => 5, 'daysmissed' => 6, 'totalparttimehrs' => 7, 'parttimepay' => 8, 'otherdaysworked' => 9, 'otherdayspayrate' => 10, 'otherworkpay' => 11, 'medicaldeduction' => 12, 'nssfdeduction' => 13, 'loandeduction' => 14, 'loanbalance' => 15, 'advance' => 16, 'elecdeduction' => 17, 'purchasesdeduction' => 18, 'otherdeduction' => 19, 'otherdeductiondescr' => 20, 'bonus' => 21, 'payslipnbr' => 22, 'lockdt' => 23, 'lockedflg' => 24, 'updttmstp' => 25, 'createtmstp' => 26, ),
        self::TYPE_COLNAME       => array(FteemployeepayslipTableMap::COL_OID => 0, FteemployeepayslipTableMap::COL_OPSMONTHLYCALENDAROID => 1, FteemployeepayslipTableMap::COL_EMPLOYEEOID => 2, FteemployeepayslipTableMap::COL_SALARYAMOUNT => 3, FteemployeepayslipTableMap::COL_DAILYRATE => 4, FteemployeepayslipTableMap::COL_HOURLYRATE => 5, FteemployeepayslipTableMap::COL_DAYSMISSED => 6, FteemployeepayslipTableMap::COL_TOTALPARTTIMEHRS => 7, FteemployeepayslipTableMap::COL_PARTTIMEPAY => 8, FteemployeepayslipTableMap::COL_OTHERDAYSWORKED => 9, FteemployeepayslipTableMap::COL_OTHERDAYSPAYRATE => 10, FteemployeepayslipTableMap::COL_OTHERWORKPAY => 11, FteemployeepayslipTableMap::COL_MEDICALDEDUCTION => 12, FteemployeepayslipTableMap::COL_NSSFDEDUCTION => 13, FteemployeepayslipTableMap::COL_LOANDEDUCTION => 14, FteemployeepayslipTableMap::COL_LOANBALANCE => 15, FteemployeepayslipTableMap::COL_ADVANCE => 16, FteemployeepayslipTableMap::COL_ELECDEDUCTION => 17, FteemployeepayslipTableMap::COL_PURCHASESDEDUCTION => 18, FteemployeepayslipTableMap::COL_OTHERDEDUCTION => 19, FteemployeepayslipTableMap::COL_OTHERDEDUCTIONDESCR => 20, FteemployeepayslipTableMap::COL_BONUS => 21, FteemployeepayslipTableMap::COL_PAYSLIPNBR => 22, FteemployeepayslipTableMap::COL_LOCKDT => 23, FteemployeepayslipTableMap::COL_LOCKEDFLG => 24, FteemployeepayslipTableMap::COL_UPDTTMSTP => 25, FteemployeepayslipTableMap::COL_CREATETMSTP => 26, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'opsMonthlyCalendarOid' => 1, 'employeeOid' => 2, 'salaryAmount' => 3, 'dailyRate' => 4, 'hourlyRate' => 5, 'daysMissed' => 6, 'totalParttimeHrs' => 7, 'parttimePay' => 8, 'otherDaysWorked' => 9, 'otherDaysPayRate' => 10, 'otherworkPay' => 11, 'medicalDeduction' => 12, 'NSSFdeduction' => 13, 'loanDeduction' => 14, 'loanBalance' => 15, 'advance' => 16, 'elecDeduction' => 17, 'purchasesDeduction' => 18, 'otherDeduction' => 19, 'otherDeductionDescr' => 20, 'bonus' => 21, 'payslipNbr' => 22, 'lockDt' => 23, 'lockedFlg' => 24, 'updtTmstp' => 25, 'createTmstp' => 26, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, )
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
        $this->setName('fteemployeepayslip');
        $this->setPhpName('Fteemployeepayslip');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Fteemployeepayslip');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addColumn('opsMonthlyCalendarOid', 'Opsmonthlycalendaroid', 'INTEGER', true, null, null);
        $this->addForeignKey('employeeOid', 'Employeeoid', 'INTEGER', 'employee', 'oid', true, null, null);
        $this->addColumn('salaryAmount', 'Salaryamount', 'FLOAT', true, null, 0);
        $this->addColumn('dailyRate', 'Dailyrate', 'INTEGER', true, null, 0);
        $this->addColumn('hourlyRate', 'Hourlyrate', 'FLOAT', true, null, 0);
        $this->addColumn('daysMissed', 'Daysmissed', 'INTEGER', true, null, 0);
        $this->addColumn('totalParttimeHrs', 'Totalparttimehrs', 'FLOAT', true, null, 0);
        $this->addColumn('parttimePay', 'Parttimepay', 'FLOAT', true, null, 0);
        $this->addColumn('otherDaysWorked', 'Otherdaysworked', 'INTEGER', true, 2, 0);
        $this->addColumn('otherDaysPayRate', 'Otherdayspayrate', 'FLOAT', true, null, 0);
        $this->addColumn('otherworkPay', 'Otherworkpay', 'FLOAT', true, null, 0);
        $this->addColumn('medicalDeduction', 'Medicaldeduction', 'FLOAT', true, null, 0);
        $this->addColumn('NSSFdeduction', 'Nssfdeduction', 'FLOAT', true, null, 0);
        $this->addColumn('loanDeduction', 'Loandeduction', 'FLOAT', true, null, 0);
        $this->addColumn('loanBalance', 'Loanbalance', 'FLOAT', true, null, 0);
        $this->addColumn('advance', 'Advance', 'FLOAT', true, null, 0);
        $this->addColumn('elecDeduction', 'Elecdeduction', 'FLOAT', true, null, 0);
        $this->addColumn('purchasesDeduction', 'Purchasesdeduction', 'FLOAT', true, null, 0);
        $this->addColumn('otherDeduction', 'Otherdeduction', 'FLOAT', true, null, 0);
        $this->addColumn('otherDeductionDescr', 'Otherdeductiondescr', 'VARCHAR', false, 250, null);
        $this->addColumn('bonus', 'Bonus', 'FLOAT', true, null, 0);
        $this->addColumn('payslipNbr', 'Payslipnbr', 'VARCHAR', true, 15, 'F-PS-0000000000');
        $this->addColumn('lockDt', 'Lockdt', 'DATE', false, null, null);
        $this->addColumn('lockedFlg', 'Lockedflg', 'TINYINT', true, null, 0);
        $this->addColumn('updtTmstp', 'Updttmstp', 'TIMESTAMP', false, null, null);
        $this->addColumn('createTmstp', 'Createtmstp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Employee', '\\lwops\\lwops\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employeeOid',
    1 => ':oid',
  ),
), null, null, null, false);
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
        return $withPrefix ? FteemployeepayslipTableMap::CLASS_DEFAULT : FteemployeepayslipTableMap::OM_CLASS;
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
     * @return array           (Fteemployeepayslip object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FteemployeepayslipTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FteemployeepayslipTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FteemployeepayslipTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FteemployeepayslipTableMap::OM_CLASS;
            /** @var Fteemployeepayslip $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FteemployeepayslipTableMap::addInstanceToPool($obj, $key);
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
            $key = FteemployeepayslipTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FteemployeepayslipTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Fteemployeepayslip $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FteemployeepayslipTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_OID);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_OPSMONTHLYCALENDAROID);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_EMPLOYEEOID);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_SALARYAMOUNT);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_DAILYRATE);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_HOURLYRATE);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_DAYSMISSED);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_TOTALPARTTIMEHRS);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_PARTTIMEPAY);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_OTHERDAYSWORKED);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_OTHERDAYSPAYRATE);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_OTHERWORKPAY);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_MEDICALDEDUCTION);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_NSSFDEDUCTION);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_LOANDEDUCTION);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_LOANBALANCE);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_ADVANCE);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_ELECDEDUCTION);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_PURCHASESDEDUCTION);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_OTHERDEDUCTION);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_OTHERDEDUCTIONDESCR);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_BONUS);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_PAYSLIPNBR);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_LOCKDT);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_LOCKEDFLG);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_UPDTTMSTP);
            $criteria->addSelectColumn(FteemployeepayslipTableMap::COL_CREATETMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.opsMonthlyCalendarOid');
            $criteria->addSelectColumn($alias . '.employeeOid');
            $criteria->addSelectColumn($alias . '.salaryAmount');
            $criteria->addSelectColumn($alias . '.dailyRate');
            $criteria->addSelectColumn($alias . '.hourlyRate');
            $criteria->addSelectColumn($alias . '.daysMissed');
            $criteria->addSelectColumn($alias . '.totalParttimeHrs');
            $criteria->addSelectColumn($alias . '.parttimePay');
            $criteria->addSelectColumn($alias . '.otherDaysWorked');
            $criteria->addSelectColumn($alias . '.otherDaysPayRate');
            $criteria->addSelectColumn($alias . '.otherworkPay');
            $criteria->addSelectColumn($alias . '.medicalDeduction');
            $criteria->addSelectColumn($alias . '.NSSFdeduction');
            $criteria->addSelectColumn($alias . '.loanDeduction');
            $criteria->addSelectColumn($alias . '.loanBalance');
            $criteria->addSelectColumn($alias . '.advance');
            $criteria->addSelectColumn($alias . '.elecDeduction');
            $criteria->addSelectColumn($alias . '.purchasesDeduction');
            $criteria->addSelectColumn($alias . '.otherDeduction');
            $criteria->addSelectColumn($alias . '.otherDeductionDescr');
            $criteria->addSelectColumn($alias . '.bonus');
            $criteria->addSelectColumn($alias . '.payslipNbr');
            $criteria->addSelectColumn($alias . '.lockDt');
            $criteria->addSelectColumn($alias . '.lockedFlg');
            $criteria->addSelectColumn($alias . '.updtTmstp');
            $criteria->addSelectColumn($alias . '.createTmstp');
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
        return Propel::getServiceContainer()->getDatabaseMap(FteemployeepayslipTableMap::DATABASE_NAME)->getTable(FteemployeepayslipTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FteemployeepayslipTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FteemployeepayslipTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FteemployeepayslipTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Fteemployeepayslip or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Fteemployeepayslip object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FteemployeepayslipTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Fteemployeepayslip) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FteemployeepayslipTableMap::DATABASE_NAME);
            $criteria->add(FteemployeepayslipTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = FteemployeepayslipQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FteemployeepayslipTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FteemployeepayslipTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the fteemployeepayslip table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FteemployeepayslipQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Fteemployeepayslip or Criteria object.
     *
     * @param mixed               $criteria Criteria or Fteemployeepayslip object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FteemployeepayslipTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Fteemployeepayslip object
        }

        if ($criteria->containsKey(FteemployeepayslipTableMap::COL_OID) && $criteria->keyContainsValue(FteemployeepayslipTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FteemployeepayslipTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = FteemployeepayslipQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FteemployeepayslipTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FteemployeepayslipTableMap::buildTableMap();
