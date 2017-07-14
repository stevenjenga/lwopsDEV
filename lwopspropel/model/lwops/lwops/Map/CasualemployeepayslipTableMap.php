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
use lwops\lwops\Casualemployeepayslip;
use lwops\lwops\CasualemployeepayslipQuery;


/**
 * This class defines the structure of the 'casualemployeepayslip' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CasualemployeepayslipTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'lwops.lwops.Map.CasualemployeepayslipTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'casualemployeepayslip';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\lwops\\lwops\\Casualemployeepayslip';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'lwops.lwops.Casualemployeepayslip';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 25;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 25;

    /**
     * the column name for the oid field
     */
    const COL_OID = 'casualemployeepayslip.oid';

    /**
     * the column name for the opsBiWeeklyCalendarOid field
     */
    const COL_OPSBIWEEKLYCALENDAROID = 'casualemployeepayslip.opsBiWeeklyCalendarOid';

    /**
     * the column name for the employeeOid field
     */
    const COL_EMPLOYEEOID = 'casualemployeepayslip.employeeOid';

    /**
     * the column name for the dailyRate field
     */
    const COL_DAILYRATE = 'casualemployeepayslip.dailyRate';

    /**
     * the column name for the totalTeaWeight field
     */
    const COL_TOTALTEAWEIGHT = 'casualemployeepayslip.totalTeaWeight';

    /**
     * the column name for the teaPayRate field
     */
    const COL_TEAPAYRATE = 'casualemployeepayslip.teaPayRate';

    /**
     * the column name for the teaPay field
     */
    const COL_TEAPAY = 'casualemployeepayslip.teaPay';

    /**
     * the column name for the totalParttimeHrs field
     */
    const COL_TOTALPARTTIMEHRS = 'casualemployeepayslip.totalParttimeHrs';

    /**
     * the column name for the parttimePayRate field
     */
    const COL_PARTTIMEPAYRATE = 'casualemployeepayslip.parttimePayRate';

    /**
     * the column name for the parttimePay field
     */
    const COL_PARTTIMEPAY = 'casualemployeepayslip.parttimePay';

    /**
     * the column name for the otherDaysWorked field
     */
    const COL_OTHERDAYSWORKED = 'casualemployeepayslip.otherDaysWorked';

    /**
     * the column name for the otherHoursWorked field
     */
    const COL_OTHERHOURSWORKED = 'casualemployeepayslip.otherHoursWorked';

    /**
     * the column name for the otherworkPay field
     */
    const COL_OTHERWORKPAY = 'casualemployeepayslip.otherworkPay';

    /**
     * the column name for the elecDeduction field
     */
    const COL_ELECDEDUCTION = 'casualemployeepayslip.elecDeduction';

    /**
     * the column name for the medicalDeduction field
     */
    const COL_MEDICALDEDUCTION = 'casualemployeepayslip.medicalDeduction';

    /**
     * the column name for the NSSFdeduction field
     */
    const COL_NSSFDEDUCTION = 'casualemployeepayslip.NSSFdeduction';

    /**
     * the column name for the purchasesDeduction field
     */
    const COL_PURCHASESDEDUCTION = 'casualemployeepayslip.purchasesDeduction';

    /**
     * the column name for the otherDeduction field
     */
    const COL_OTHERDEDUCTION = 'casualemployeepayslip.otherDeduction';

    /**
     * the column name for the otherDeductionDescr field
     */
    const COL_OTHERDEDUCTIONDESCR = 'casualemployeepayslip.otherDeductionDescr';

    /**
     * the column name for the bonus field
     */
    const COL_BONUS = 'casualemployeepayslip.bonus';

    /**
     * the column name for the lockDt field
     */
    const COL_LOCKDT = 'casualemployeepayslip.lockDt';

    /**
     * the column name for the payslipNbr field
     */
    const COL_PAYSLIPNBR = 'casualemployeepayslip.payslipNbr';

    /**
     * the column name for the lockedFlg field
     */
    const COL_LOCKEDFLG = 'casualemployeepayslip.lockedFlg';

    /**
     * the column name for the createTmstp field
     */
    const COL_CREATETMSTP = 'casualemployeepayslip.createTmstp';

    /**
     * the column name for the updtTmstp field
     */
    const COL_UPDTTMSTP = 'casualemployeepayslip.updtTmstp';

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
        self::TYPE_PHPNAME       => array('Oid', 'Opsbiweeklycalendaroid', 'Employeeoid', 'Dailyrate', 'Totalteaweight', 'Teapayrate', 'Teapay', 'Totalparttimehrs', 'Parttimepayrate', 'Parttimepay', 'Otherdaysworked', 'Otherhoursworked', 'Otherworkpay', 'Elecdeduction', 'Medicaldeduction', 'Nssfdeduction', 'Purchasesdeduction', 'Otherdeduction', 'Otherdeductiondescr', 'Bonus', 'Lockdt', 'Payslipnbr', 'Lockedflg', 'Createtmstp', 'Updttmstp', ),
        self::TYPE_CAMELNAME     => array('oid', 'opsbiweeklycalendaroid', 'employeeoid', 'dailyrate', 'totalteaweight', 'teapayrate', 'teapay', 'totalparttimehrs', 'parttimepayrate', 'parttimepay', 'otherdaysworked', 'otherhoursworked', 'otherworkpay', 'elecdeduction', 'medicaldeduction', 'nssfdeduction', 'purchasesdeduction', 'otherdeduction', 'otherdeductiondescr', 'bonus', 'lockdt', 'payslipnbr', 'lockedflg', 'createtmstp', 'updttmstp', ),
        self::TYPE_COLNAME       => array(CasualemployeepayslipTableMap::COL_OID, CasualemployeepayslipTableMap::COL_OPSBIWEEKLYCALENDAROID, CasualemployeepayslipTableMap::COL_EMPLOYEEOID, CasualemployeepayslipTableMap::COL_DAILYRATE, CasualemployeepayslipTableMap::COL_TOTALTEAWEIGHT, CasualemployeepayslipTableMap::COL_TEAPAYRATE, CasualemployeepayslipTableMap::COL_TEAPAY, CasualemployeepayslipTableMap::COL_TOTALPARTTIMEHRS, CasualemployeepayslipTableMap::COL_PARTTIMEPAYRATE, CasualemployeepayslipTableMap::COL_PARTTIMEPAY, CasualemployeepayslipTableMap::COL_OTHERDAYSWORKED, CasualemployeepayslipTableMap::COL_OTHERHOURSWORKED, CasualemployeepayslipTableMap::COL_OTHERWORKPAY, CasualemployeepayslipTableMap::COL_ELECDEDUCTION, CasualemployeepayslipTableMap::COL_MEDICALDEDUCTION, CasualemployeepayslipTableMap::COL_NSSFDEDUCTION, CasualemployeepayslipTableMap::COL_PURCHASESDEDUCTION, CasualemployeepayslipTableMap::COL_OTHERDEDUCTION, CasualemployeepayslipTableMap::COL_OTHERDEDUCTIONDESCR, CasualemployeepayslipTableMap::COL_BONUS, CasualemployeepayslipTableMap::COL_LOCKDT, CasualemployeepayslipTableMap::COL_PAYSLIPNBR, CasualemployeepayslipTableMap::COL_LOCKEDFLG, CasualemployeepayslipTableMap::COL_CREATETMSTP, CasualemployeepayslipTableMap::COL_UPDTTMSTP, ),
        self::TYPE_FIELDNAME     => array('oid', 'opsBiWeeklyCalendarOid', 'employeeOid', 'dailyRate', 'totalTeaWeight', 'teaPayRate', 'teaPay', 'totalParttimeHrs', 'parttimePayRate', 'parttimePay', 'otherDaysWorked', 'otherHoursWorked', 'otherworkPay', 'elecDeduction', 'medicalDeduction', 'NSSFdeduction', 'purchasesDeduction', 'otherDeduction', 'otherDeductionDescr', 'bonus', 'lockDt', 'payslipNbr', 'lockedFlg', 'createTmstp', 'updtTmstp', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Oid' => 0, 'Opsbiweeklycalendaroid' => 1, 'Employeeoid' => 2, 'Dailyrate' => 3, 'Totalteaweight' => 4, 'Teapayrate' => 5, 'Teapay' => 6, 'Totalparttimehrs' => 7, 'Parttimepayrate' => 8, 'Parttimepay' => 9, 'Otherdaysworked' => 10, 'Otherhoursworked' => 11, 'Otherworkpay' => 12, 'Elecdeduction' => 13, 'Medicaldeduction' => 14, 'Nssfdeduction' => 15, 'Purchasesdeduction' => 16, 'Otherdeduction' => 17, 'Otherdeductiondescr' => 18, 'Bonus' => 19, 'Lockdt' => 20, 'Payslipnbr' => 21, 'Lockedflg' => 22, 'Createtmstp' => 23, 'Updttmstp' => 24, ),
        self::TYPE_CAMELNAME     => array('oid' => 0, 'opsbiweeklycalendaroid' => 1, 'employeeoid' => 2, 'dailyrate' => 3, 'totalteaweight' => 4, 'teapayrate' => 5, 'teapay' => 6, 'totalparttimehrs' => 7, 'parttimepayrate' => 8, 'parttimepay' => 9, 'otherdaysworked' => 10, 'otherhoursworked' => 11, 'otherworkpay' => 12, 'elecdeduction' => 13, 'medicaldeduction' => 14, 'nssfdeduction' => 15, 'purchasesdeduction' => 16, 'otherdeduction' => 17, 'otherdeductiondescr' => 18, 'bonus' => 19, 'lockdt' => 20, 'payslipnbr' => 21, 'lockedflg' => 22, 'createtmstp' => 23, 'updttmstp' => 24, ),
        self::TYPE_COLNAME       => array(CasualemployeepayslipTableMap::COL_OID => 0, CasualemployeepayslipTableMap::COL_OPSBIWEEKLYCALENDAROID => 1, CasualemployeepayslipTableMap::COL_EMPLOYEEOID => 2, CasualemployeepayslipTableMap::COL_DAILYRATE => 3, CasualemployeepayslipTableMap::COL_TOTALTEAWEIGHT => 4, CasualemployeepayslipTableMap::COL_TEAPAYRATE => 5, CasualemployeepayslipTableMap::COL_TEAPAY => 6, CasualemployeepayslipTableMap::COL_TOTALPARTTIMEHRS => 7, CasualemployeepayslipTableMap::COL_PARTTIMEPAYRATE => 8, CasualemployeepayslipTableMap::COL_PARTTIMEPAY => 9, CasualemployeepayslipTableMap::COL_OTHERDAYSWORKED => 10, CasualemployeepayslipTableMap::COL_OTHERHOURSWORKED => 11, CasualemployeepayslipTableMap::COL_OTHERWORKPAY => 12, CasualemployeepayslipTableMap::COL_ELECDEDUCTION => 13, CasualemployeepayslipTableMap::COL_MEDICALDEDUCTION => 14, CasualemployeepayslipTableMap::COL_NSSFDEDUCTION => 15, CasualemployeepayslipTableMap::COL_PURCHASESDEDUCTION => 16, CasualemployeepayslipTableMap::COL_OTHERDEDUCTION => 17, CasualemployeepayslipTableMap::COL_OTHERDEDUCTIONDESCR => 18, CasualemployeepayslipTableMap::COL_BONUS => 19, CasualemployeepayslipTableMap::COL_LOCKDT => 20, CasualemployeepayslipTableMap::COL_PAYSLIPNBR => 21, CasualemployeepayslipTableMap::COL_LOCKEDFLG => 22, CasualemployeepayslipTableMap::COL_CREATETMSTP => 23, CasualemployeepayslipTableMap::COL_UPDTTMSTP => 24, ),
        self::TYPE_FIELDNAME     => array('oid' => 0, 'opsBiWeeklyCalendarOid' => 1, 'employeeOid' => 2, 'dailyRate' => 3, 'totalTeaWeight' => 4, 'teaPayRate' => 5, 'teaPay' => 6, 'totalParttimeHrs' => 7, 'parttimePayRate' => 8, 'parttimePay' => 9, 'otherDaysWorked' => 10, 'otherHoursWorked' => 11, 'otherworkPay' => 12, 'elecDeduction' => 13, 'medicalDeduction' => 14, 'NSSFdeduction' => 15, 'purchasesDeduction' => 16, 'otherDeduction' => 17, 'otherDeductionDescr' => 18, 'bonus' => 19, 'lockDt' => 20, 'payslipNbr' => 21, 'lockedFlg' => 22, 'createTmstp' => 23, 'updtTmstp' => 24, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
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
        $this->setName('casualemployeepayslip');
        $this->setPhpName('Casualemployeepayslip');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\lwops\\lwops\\Casualemployeepayslip');
        $this->setPackage('lwops.lwops');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('oid', 'Oid', 'INTEGER', true, null, null);
        $this->addForeignKey('opsBiWeeklyCalendarOid', 'Opsbiweeklycalendaroid', 'INTEGER', 'opsbiweeklycalendar', 'oid', true, null, null);
        $this->addForeignKey('employeeOid', 'Employeeoid', 'INTEGER', 'employee', 'oid', true, null, null);
        $this->addColumn('dailyRate', 'Dailyrate', 'FLOAT', true, null, 0);
        $this->addColumn('totalTeaWeight', 'Totalteaweight', 'FLOAT', true, null, 0);
        $this->addColumn('teaPayRate', 'Teapayrate', 'FLOAT', true, null, null);
        $this->addColumn('teaPay', 'Teapay', 'FLOAT', true, null, 0);
        $this->addColumn('totalParttimeHrs', 'Totalparttimehrs', 'FLOAT', true, null, 0);
        $this->addColumn('parttimePayRate', 'Parttimepayrate', 'FLOAT', true, null, 0);
        $this->addColumn('parttimePay', 'Parttimepay', 'FLOAT', true, null, 0);
        $this->addColumn('otherDaysWorked', 'Otherdaysworked', 'INTEGER', true, 2, 0);
        $this->addColumn('otherHoursWorked', 'Otherhoursworked', 'FLOAT', true, null, 0);
        $this->addColumn('otherworkPay', 'Otherworkpay', 'FLOAT', true, null, 0);
        $this->addColumn('elecDeduction', 'Elecdeduction', 'FLOAT', true, null, 0);
        $this->addColumn('medicalDeduction', 'Medicaldeduction', 'FLOAT', true, null, 0);
        $this->addColumn('NSSFdeduction', 'Nssfdeduction', 'FLOAT', true, null, 0);
        $this->addColumn('purchasesDeduction', 'Purchasesdeduction', 'FLOAT', true, null, 0);
        $this->addColumn('otherDeduction', 'Otherdeduction', 'FLOAT', true, null, 0);
        $this->addColumn('otherDeductionDescr', 'Otherdeductiondescr', 'VARCHAR', false, 100, null);
        $this->addColumn('bonus', 'Bonus', 'FLOAT', true, null, 0);
        $this->addColumn('lockDt', 'Lockdt', 'DATE', false, null, null);
        $this->addColumn('payslipNbr', 'Payslipnbr', 'VARCHAR', true, 15, 'F-PS-0000000000');
        $this->addColumn('lockedFlg', 'Lockedflg', 'TINYINT', true, null, 0);
        $this->addColumn('createTmstp', 'Createtmstp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updtTmstp', 'Updttmstp', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Opsbiweeklycalendar', '\\lwops\\lwops\\Opsbiweeklycalendar', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':opsBiWeeklyCalendarOid',
    1 => ':oid',
  ),
), null, null, null, false);
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
        return $withPrefix ? CasualemployeepayslipTableMap::CLASS_DEFAULT : CasualemployeepayslipTableMap::OM_CLASS;
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
     * @return array           (Casualemployeepayslip object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CasualemployeepayslipTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CasualemployeepayslipTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CasualemployeepayslipTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CasualemployeepayslipTableMap::OM_CLASS;
            /** @var Casualemployeepayslip $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CasualemployeepayslipTableMap::addInstanceToPool($obj, $key);
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
            $key = CasualemployeepayslipTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CasualemployeepayslipTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Casualemployeepayslip $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CasualemployeepayslipTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_OID);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_OPSBIWEEKLYCALENDAROID);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_EMPLOYEEOID);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_DAILYRATE);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_TOTALTEAWEIGHT);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_TEAPAYRATE);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_TEAPAY);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_TOTALPARTTIMEHRS);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_PARTTIMEPAYRATE);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_PARTTIMEPAY);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_OTHERDAYSWORKED);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_OTHERHOURSWORKED);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_OTHERWORKPAY);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_ELECDEDUCTION);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_MEDICALDEDUCTION);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_NSSFDEDUCTION);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_PURCHASESDEDUCTION);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_OTHERDEDUCTION);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_OTHERDEDUCTIONDESCR);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_BONUS);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_LOCKDT);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_PAYSLIPNBR);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_LOCKEDFLG);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_CREATETMSTP);
            $criteria->addSelectColumn(CasualemployeepayslipTableMap::COL_UPDTTMSTP);
        } else {
            $criteria->addSelectColumn($alias . '.oid');
            $criteria->addSelectColumn($alias . '.opsBiWeeklyCalendarOid');
            $criteria->addSelectColumn($alias . '.employeeOid');
            $criteria->addSelectColumn($alias . '.dailyRate');
            $criteria->addSelectColumn($alias . '.totalTeaWeight');
            $criteria->addSelectColumn($alias . '.teaPayRate');
            $criteria->addSelectColumn($alias . '.teaPay');
            $criteria->addSelectColumn($alias . '.totalParttimeHrs');
            $criteria->addSelectColumn($alias . '.parttimePayRate');
            $criteria->addSelectColumn($alias . '.parttimePay');
            $criteria->addSelectColumn($alias . '.otherDaysWorked');
            $criteria->addSelectColumn($alias . '.otherHoursWorked');
            $criteria->addSelectColumn($alias . '.otherworkPay');
            $criteria->addSelectColumn($alias . '.elecDeduction');
            $criteria->addSelectColumn($alias . '.medicalDeduction');
            $criteria->addSelectColumn($alias . '.NSSFdeduction');
            $criteria->addSelectColumn($alias . '.purchasesDeduction');
            $criteria->addSelectColumn($alias . '.otherDeduction');
            $criteria->addSelectColumn($alias . '.otherDeductionDescr');
            $criteria->addSelectColumn($alias . '.bonus');
            $criteria->addSelectColumn($alias . '.lockDt');
            $criteria->addSelectColumn($alias . '.payslipNbr');
            $criteria->addSelectColumn($alias . '.lockedFlg');
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
        return Propel::getServiceContainer()->getDatabaseMap(CasualemployeepayslipTableMap::DATABASE_NAME)->getTable(CasualemployeepayslipTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CasualemployeepayslipTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CasualemployeepayslipTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CasualemployeepayslipTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Casualemployeepayslip or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Casualemployeepayslip object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CasualemployeepayslipTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \lwops\lwops\Casualemployeepayslip) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CasualemployeepayslipTableMap::DATABASE_NAME);
            $criteria->add(CasualemployeepayslipTableMap::COL_OID, (array) $values, Criteria::IN);
        }

        $query = CasualemployeepayslipQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CasualemployeepayslipTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CasualemployeepayslipTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the casualemployeepayslip table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CasualemployeepayslipQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Casualemployeepayslip or Criteria object.
     *
     * @param mixed               $criteria Criteria or Casualemployeepayslip object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CasualemployeepayslipTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Casualemployeepayslip object
        }

        if ($criteria->containsKey(CasualemployeepayslipTableMap::COL_OID) && $criteria->keyContainsValue(CasualemployeepayslipTableMap::COL_OID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CasualemployeepayslipTableMap::COL_OID.')');
        }


        // Set the correct dbName
        $query = CasualemployeepayslipQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CasualemployeepayslipTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CasualemployeepayslipTableMap::buildTableMap();
