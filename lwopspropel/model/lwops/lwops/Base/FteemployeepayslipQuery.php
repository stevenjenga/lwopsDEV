<?php

namespace lwops\lwops\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use lwops\lwops\Fteemployeepayslip as ChildFteemployeepayslip;
use lwops\lwops\FteemployeepayslipQuery as ChildFteemployeepayslipQuery;
use lwops\lwops\Map\FteemployeepayslipTableMap;

/**
 * Base class that represents a query for the 'fteemployeepayslip' table.
 *
 *
 *
 * @method     ChildFteemployeepayslipQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildFteemployeepayslipQuery orderByOpsmonthlycalendaroid($order = Criteria::ASC) Order by the opsMonthlyCalendarOid column
 * @method     ChildFteemployeepayslipQuery orderByEmployeeoid($order = Criteria::ASC) Order by the employeeOid column
 * @method     ChildFteemployeepayslipQuery orderBySalaryamount($order = Criteria::ASC) Order by the salaryAmount column
 * @method     ChildFteemployeepayslipQuery orderByDailyrate($order = Criteria::ASC) Order by the dailyRate column
 * @method     ChildFteemployeepayslipQuery orderByHourlyrate($order = Criteria::ASC) Order by the hourlyRate column
 * @method     ChildFteemployeepayslipQuery orderByDaysmissed($order = Criteria::ASC) Order by the daysMissed column
 * @method     ChildFteemployeepayslipQuery orderByTotalparttimehrs($order = Criteria::ASC) Order by the totalParttimeHrs column
 * @method     ChildFteemployeepayslipQuery orderByParttimepay($order = Criteria::ASC) Order by the parttimePay column
 * @method     ChildFteemployeepayslipQuery orderByOtherdaysworked($order = Criteria::ASC) Order by the otherDaysWorked column
 * @method     ChildFteemployeepayslipQuery orderByOtherdayspayrate($order = Criteria::ASC) Order by the otherDaysPayRate column
 * @method     ChildFteemployeepayslipQuery orderByOtherworkpay($order = Criteria::ASC) Order by the otherworkPay column
 * @method     ChildFteemployeepayslipQuery orderByMedicaldeduction($order = Criteria::ASC) Order by the medicalDeduction column
 * @method     ChildFteemployeepayslipQuery orderByNssfdeduction($order = Criteria::ASC) Order by the NSSFdeduction column
 * @method     ChildFteemployeepayslipQuery orderByLoandeduction($order = Criteria::ASC) Order by the loanDeduction column
 * @method     ChildFteemployeepayslipQuery orderByLoanbalance($order = Criteria::ASC) Order by the loanBalance column
 * @method     ChildFteemployeepayslipQuery orderByAdvance($order = Criteria::ASC) Order by the advance column
 * @method     ChildFteemployeepayslipQuery orderByElecdeduction($order = Criteria::ASC) Order by the elecDeduction column
 * @method     ChildFteemployeepayslipQuery orderByPurchasesdeduction($order = Criteria::ASC) Order by the purchasesDeduction column
 * @method     ChildFteemployeepayslipQuery orderByOtherdeduction($order = Criteria::ASC) Order by the otherDeduction column
 * @method     ChildFteemployeepayslipQuery orderByOtherdeductiondescr($order = Criteria::ASC) Order by the otherDeductionDescr column
 * @method     ChildFteemployeepayslipQuery orderByBonus($order = Criteria::ASC) Order by the bonus column
 * @method     ChildFteemployeepayslipQuery orderByPayslipnbr($order = Criteria::ASC) Order by the payslipNbr column
 * @method     ChildFteemployeepayslipQuery orderByLockdt($order = Criteria::ASC) Order by the lockDt column
 * @method     ChildFteemployeepayslipQuery orderByLockedflg($order = Criteria::ASC) Order by the lockedFlg column
 * @method     ChildFteemployeepayslipQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 * @method     ChildFteemployeepayslipQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 *
 * @method     ChildFteemployeepayslipQuery groupByOid() Group by the oid column
 * @method     ChildFteemployeepayslipQuery groupByOpsmonthlycalendaroid() Group by the opsMonthlyCalendarOid column
 * @method     ChildFteemployeepayslipQuery groupByEmployeeoid() Group by the employeeOid column
 * @method     ChildFteemployeepayslipQuery groupBySalaryamount() Group by the salaryAmount column
 * @method     ChildFteemployeepayslipQuery groupByDailyrate() Group by the dailyRate column
 * @method     ChildFteemployeepayslipQuery groupByHourlyrate() Group by the hourlyRate column
 * @method     ChildFteemployeepayslipQuery groupByDaysmissed() Group by the daysMissed column
 * @method     ChildFteemployeepayslipQuery groupByTotalparttimehrs() Group by the totalParttimeHrs column
 * @method     ChildFteemployeepayslipQuery groupByParttimepay() Group by the parttimePay column
 * @method     ChildFteemployeepayslipQuery groupByOtherdaysworked() Group by the otherDaysWorked column
 * @method     ChildFteemployeepayslipQuery groupByOtherdayspayrate() Group by the otherDaysPayRate column
 * @method     ChildFteemployeepayslipQuery groupByOtherworkpay() Group by the otherworkPay column
 * @method     ChildFteemployeepayslipQuery groupByMedicaldeduction() Group by the medicalDeduction column
 * @method     ChildFteemployeepayslipQuery groupByNssfdeduction() Group by the NSSFdeduction column
 * @method     ChildFteemployeepayslipQuery groupByLoandeduction() Group by the loanDeduction column
 * @method     ChildFteemployeepayslipQuery groupByLoanbalance() Group by the loanBalance column
 * @method     ChildFteemployeepayslipQuery groupByAdvance() Group by the advance column
 * @method     ChildFteemployeepayslipQuery groupByElecdeduction() Group by the elecDeduction column
 * @method     ChildFteemployeepayslipQuery groupByPurchasesdeduction() Group by the purchasesDeduction column
 * @method     ChildFteemployeepayslipQuery groupByOtherdeduction() Group by the otherDeduction column
 * @method     ChildFteemployeepayslipQuery groupByOtherdeductiondescr() Group by the otherDeductionDescr column
 * @method     ChildFteemployeepayslipQuery groupByBonus() Group by the bonus column
 * @method     ChildFteemployeepayslipQuery groupByPayslipnbr() Group by the payslipNbr column
 * @method     ChildFteemployeepayslipQuery groupByLockdt() Group by the lockDt column
 * @method     ChildFteemployeepayslipQuery groupByLockedflg() Group by the lockedFlg column
 * @method     ChildFteemployeepayslipQuery groupByUpdttmstp() Group by the updtTmstp column
 * @method     ChildFteemployeepayslipQuery groupByCreatetmstp() Group by the createTmstp column
 *
 * @method     ChildFteemployeepayslipQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFteemployeepayslipQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFteemployeepayslipQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFteemployeepayslipQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFteemployeepayslipQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFteemployeepayslipQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFteemployeepayslipQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildFteemployeepayslipQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildFteemployeepayslipQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildFteemployeepayslipQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildFteemployeepayslipQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildFteemployeepayslipQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildFteemployeepayslipQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \lwops\lwops\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFteemployeepayslip findOne(ConnectionInterface $con = null) Return the first ChildFteemployeepayslip matching the query
 * @method     ChildFteemployeepayslip findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFteemployeepayslip matching the query, or a new ChildFteemployeepayslip object populated from the query conditions when no match is found
 *
 * @method     ChildFteemployeepayslip findOneByOid(int $oid) Return the first ChildFteemployeepayslip filtered by the oid column
 * @method     ChildFteemployeepayslip findOneByOpsmonthlycalendaroid(int $opsMonthlyCalendarOid) Return the first ChildFteemployeepayslip filtered by the opsMonthlyCalendarOid column
 * @method     ChildFteemployeepayslip findOneByEmployeeoid(int $employeeOid) Return the first ChildFteemployeepayslip filtered by the employeeOid column
 * @method     ChildFteemployeepayslip findOneBySalaryamount(double $salaryAmount) Return the first ChildFteemployeepayslip filtered by the salaryAmount column
 * @method     ChildFteemployeepayslip findOneByDailyrate(int $dailyRate) Return the first ChildFteemployeepayslip filtered by the dailyRate column
 * @method     ChildFteemployeepayslip findOneByHourlyrate(double $hourlyRate) Return the first ChildFteemployeepayslip filtered by the hourlyRate column
 * @method     ChildFteemployeepayslip findOneByDaysmissed(int $daysMissed) Return the first ChildFteemployeepayslip filtered by the daysMissed column
 * @method     ChildFteemployeepayslip findOneByTotalparttimehrs(double $totalParttimeHrs) Return the first ChildFteemployeepayslip filtered by the totalParttimeHrs column
 * @method     ChildFteemployeepayslip findOneByParttimepay(double $parttimePay) Return the first ChildFteemployeepayslip filtered by the parttimePay column
 * @method     ChildFteemployeepayslip findOneByOtherdaysworked(int $otherDaysWorked) Return the first ChildFteemployeepayslip filtered by the otherDaysWorked column
 * @method     ChildFteemployeepayslip findOneByOtherdayspayrate(double $otherDaysPayRate) Return the first ChildFteemployeepayslip filtered by the otherDaysPayRate column
 * @method     ChildFteemployeepayslip findOneByOtherworkpay(double $otherworkPay) Return the first ChildFteemployeepayslip filtered by the otherworkPay column
 * @method     ChildFteemployeepayslip findOneByMedicaldeduction(double $medicalDeduction) Return the first ChildFteemployeepayslip filtered by the medicalDeduction column
 * @method     ChildFteemployeepayslip findOneByNssfdeduction(double $NSSFdeduction) Return the first ChildFteemployeepayslip filtered by the NSSFdeduction column
 * @method     ChildFteemployeepayslip findOneByLoandeduction(double $loanDeduction) Return the first ChildFteemployeepayslip filtered by the loanDeduction column
 * @method     ChildFteemployeepayslip findOneByLoanbalance(double $loanBalance) Return the first ChildFteemployeepayslip filtered by the loanBalance column
 * @method     ChildFteemployeepayslip findOneByAdvance(double $advance) Return the first ChildFteemployeepayslip filtered by the advance column
 * @method     ChildFteemployeepayslip findOneByElecdeduction(double $elecDeduction) Return the first ChildFteemployeepayslip filtered by the elecDeduction column
 * @method     ChildFteemployeepayslip findOneByPurchasesdeduction(double $purchasesDeduction) Return the first ChildFteemployeepayslip filtered by the purchasesDeduction column
 * @method     ChildFteemployeepayslip findOneByOtherdeduction(double $otherDeduction) Return the first ChildFteemployeepayslip filtered by the otherDeduction column
 * @method     ChildFteemployeepayslip findOneByOtherdeductiondescr(string $otherDeductionDescr) Return the first ChildFteemployeepayslip filtered by the otherDeductionDescr column
 * @method     ChildFteemployeepayslip findOneByBonus(double $bonus) Return the first ChildFteemployeepayslip filtered by the bonus column
 * @method     ChildFteemployeepayslip findOneByPayslipnbr(string $payslipNbr) Return the first ChildFteemployeepayslip filtered by the payslipNbr column
 * @method     ChildFteemployeepayslip findOneByLockdt(string $lockDt) Return the first ChildFteemployeepayslip filtered by the lockDt column
 * @method     ChildFteemployeepayslip findOneByLockedflg(int $lockedFlg) Return the first ChildFteemployeepayslip filtered by the lockedFlg column
 * @method     ChildFteemployeepayslip findOneByUpdttmstp(string $updtTmstp) Return the first ChildFteemployeepayslip filtered by the updtTmstp column
 * @method     ChildFteemployeepayslip findOneByCreatetmstp(string $createTmstp) Return the first ChildFteemployeepayslip filtered by the createTmstp column *

 * @method     ChildFteemployeepayslip requirePk($key, ConnectionInterface $con = null) Return the ChildFteemployeepayslip by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOne(ConnectionInterface $con = null) Return the first ChildFteemployeepayslip matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFteemployeepayslip requireOneByOid(int $oid) Return the first ChildFteemployeepayslip filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByOpsmonthlycalendaroid(int $opsMonthlyCalendarOid) Return the first ChildFteemployeepayslip filtered by the opsMonthlyCalendarOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByEmployeeoid(int $employeeOid) Return the first ChildFteemployeepayslip filtered by the employeeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneBySalaryamount(double $salaryAmount) Return the first ChildFteemployeepayslip filtered by the salaryAmount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByDailyrate(int $dailyRate) Return the first ChildFteemployeepayslip filtered by the dailyRate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByHourlyrate(double $hourlyRate) Return the first ChildFteemployeepayslip filtered by the hourlyRate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByDaysmissed(int $daysMissed) Return the first ChildFteemployeepayslip filtered by the daysMissed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByTotalparttimehrs(double $totalParttimeHrs) Return the first ChildFteemployeepayslip filtered by the totalParttimeHrs column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByParttimepay(double $parttimePay) Return the first ChildFteemployeepayslip filtered by the parttimePay column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByOtherdaysworked(int $otherDaysWorked) Return the first ChildFteemployeepayslip filtered by the otherDaysWorked column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByOtherdayspayrate(double $otherDaysPayRate) Return the first ChildFteemployeepayslip filtered by the otherDaysPayRate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByOtherworkpay(double $otherworkPay) Return the first ChildFteemployeepayslip filtered by the otherworkPay column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByMedicaldeduction(double $medicalDeduction) Return the first ChildFteemployeepayslip filtered by the medicalDeduction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByNssfdeduction(double $NSSFdeduction) Return the first ChildFteemployeepayslip filtered by the NSSFdeduction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByLoandeduction(double $loanDeduction) Return the first ChildFteemployeepayslip filtered by the loanDeduction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByLoanbalance(double $loanBalance) Return the first ChildFteemployeepayslip filtered by the loanBalance column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByAdvance(double $advance) Return the first ChildFteemployeepayslip filtered by the advance column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByElecdeduction(double $elecDeduction) Return the first ChildFteemployeepayslip filtered by the elecDeduction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByPurchasesdeduction(double $purchasesDeduction) Return the first ChildFteemployeepayslip filtered by the purchasesDeduction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByOtherdeduction(double $otherDeduction) Return the first ChildFteemployeepayslip filtered by the otherDeduction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByOtherdeductiondescr(string $otherDeductionDescr) Return the first ChildFteemployeepayslip filtered by the otherDeductionDescr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByBonus(double $bonus) Return the first ChildFteemployeepayslip filtered by the bonus column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByPayslipnbr(string $payslipNbr) Return the first ChildFteemployeepayslip filtered by the payslipNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByLockdt(string $lockDt) Return the first ChildFteemployeepayslip filtered by the lockDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByLockedflg(int $lockedFlg) Return the first ChildFteemployeepayslip filtered by the lockedFlg column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByUpdttmstp(string $updtTmstp) Return the first ChildFteemployeepayslip filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFteemployeepayslip requireOneByCreatetmstp(string $createTmstp) Return the first ChildFteemployeepayslip filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFteemployeepayslip[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFteemployeepayslip objects based on current ModelCriteria
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByOid(int $oid) Return ChildFteemployeepayslip objects filtered by the oid column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByOpsmonthlycalendaroid(int $opsMonthlyCalendarOid) Return ChildFteemployeepayslip objects filtered by the opsMonthlyCalendarOid column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByEmployeeoid(int $employeeOid) Return ChildFteemployeepayslip objects filtered by the employeeOid column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findBySalaryamount(double $salaryAmount) Return ChildFteemployeepayslip objects filtered by the salaryAmount column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByDailyrate(int $dailyRate) Return ChildFteemployeepayslip objects filtered by the dailyRate column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByHourlyrate(double $hourlyRate) Return ChildFteemployeepayslip objects filtered by the hourlyRate column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByDaysmissed(int $daysMissed) Return ChildFteemployeepayslip objects filtered by the daysMissed column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByTotalparttimehrs(double $totalParttimeHrs) Return ChildFteemployeepayslip objects filtered by the totalParttimeHrs column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByParttimepay(double $parttimePay) Return ChildFteemployeepayslip objects filtered by the parttimePay column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByOtherdaysworked(int $otherDaysWorked) Return ChildFteemployeepayslip objects filtered by the otherDaysWorked column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByOtherdayspayrate(double $otherDaysPayRate) Return ChildFteemployeepayslip objects filtered by the otherDaysPayRate column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByOtherworkpay(double $otherworkPay) Return ChildFteemployeepayslip objects filtered by the otherworkPay column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByMedicaldeduction(double $medicalDeduction) Return ChildFteemployeepayslip objects filtered by the medicalDeduction column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByNssfdeduction(double $NSSFdeduction) Return ChildFteemployeepayslip objects filtered by the NSSFdeduction column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByLoandeduction(double $loanDeduction) Return ChildFteemployeepayslip objects filtered by the loanDeduction column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByLoanbalance(double $loanBalance) Return ChildFteemployeepayslip objects filtered by the loanBalance column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByAdvance(double $advance) Return ChildFteemployeepayslip objects filtered by the advance column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByElecdeduction(double $elecDeduction) Return ChildFteemployeepayslip objects filtered by the elecDeduction column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByPurchasesdeduction(double $purchasesDeduction) Return ChildFteemployeepayslip objects filtered by the purchasesDeduction column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByOtherdeduction(double $otherDeduction) Return ChildFteemployeepayslip objects filtered by the otherDeduction column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByOtherdeductiondescr(string $otherDeductionDescr) Return ChildFteemployeepayslip objects filtered by the otherDeductionDescr column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByBonus(double $bonus) Return ChildFteemployeepayslip objects filtered by the bonus column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByPayslipnbr(string $payslipNbr) Return ChildFteemployeepayslip objects filtered by the payslipNbr column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByLockdt(string $lockDt) Return ChildFteemployeepayslip objects filtered by the lockDt column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByLockedflg(int $lockedFlg) Return ChildFteemployeepayslip objects filtered by the lockedFlg column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildFteemployeepayslip objects filtered by the updtTmstp column
 * @method     ChildFteemployeepayslip[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildFteemployeepayslip objects filtered by the createTmstp column
 * @method     ChildFteemployeepayslip[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FteemployeepayslipQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\FteemployeepayslipQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Fteemployeepayslip', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFteemployeepayslipQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFteemployeepayslipQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFteemployeepayslipQuery) {
            return $criteria;
        }
        $query = new ChildFteemployeepayslipQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildFteemployeepayslip|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FteemployeepayslipTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FteemployeepayslipTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFteemployeepayslip A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, opsMonthlyCalendarOid, employeeOid, salaryAmount, dailyRate, hourlyRate, daysMissed, totalParttimeHrs, parttimePay, otherDaysWorked, otherDaysPayRate, otherworkPay, medicalDeduction, NSSFdeduction, loanDeduction, loanBalance, advance, elecDeduction, purchasesDeduction, otherDeduction, otherDeductionDescr, bonus, payslipNbr, lockDt, lockedFlg, updtTmstp, createTmstp FROM fteemployeepayslip WHERE oid = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildFteemployeepayslip $obj */
            $obj = new ChildFteemployeepayslip();
            $obj->hydrate($row);
            FteemployeepayslipTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildFteemployeepayslip|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_OID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the oid column
     *
     * Example usage:
     * <code>
     * $query->filterByOid(1234); // WHERE oid = 1234
     * $query->filterByOid(array(12, 34)); // WHERE oid IN (12, 34)
     * $query->filterByOid(array('min' => 12)); // WHERE oid > 12
     * </code>
     *
     * @param     mixed $oid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the opsMonthlyCalendarOid column
     *
     * Example usage:
     * <code>
     * $query->filterByOpsmonthlycalendaroid(1234); // WHERE opsMonthlyCalendarOid = 1234
     * $query->filterByOpsmonthlycalendaroid(array(12, 34)); // WHERE opsMonthlyCalendarOid IN (12, 34)
     * $query->filterByOpsmonthlycalendaroid(array('min' => 12)); // WHERE opsMonthlyCalendarOid > 12
     * </code>
     *
     * @param     mixed $opsmonthlycalendaroid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOpsmonthlycalendaroid($opsmonthlycalendaroid = null, $comparison = null)
    {
        if (is_array($opsmonthlycalendaroid)) {
            $useMinMax = false;
            if (isset($opsmonthlycalendaroid['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendaroid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($opsmonthlycalendaroid['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendaroid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_OPSMONTHLYCALENDAROID, $opsmonthlycalendaroid, $comparison);
    }

    /**
     * Filter the query on the employeeOid column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeoid(1234); // WHERE employeeOid = 1234
     * $query->filterByEmployeeoid(array(12, 34)); // WHERE employeeOid IN (12, 34)
     * $query->filterByEmployeeoid(array('min' => 12)); // WHERE employeeOid > 12
     * </code>
     *
     * @see       filterByEmployee()
     *
     * @param     mixed $employeeoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByEmployeeoid($employeeoid = null, $comparison = null)
    {
        if (is_array($employeeoid)) {
            $useMinMax = false;
            if (isset($employeeoid['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_EMPLOYEEOID, $employeeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeoid['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_EMPLOYEEOID, $employeeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_EMPLOYEEOID, $employeeoid, $comparison);
    }

    /**
     * Filter the query on the salaryAmount column
     *
     * Example usage:
     * <code>
     * $query->filterBySalaryamount(1234); // WHERE salaryAmount = 1234
     * $query->filterBySalaryamount(array(12, 34)); // WHERE salaryAmount IN (12, 34)
     * $query->filterBySalaryamount(array('min' => 12)); // WHERE salaryAmount > 12
     * </code>
     *
     * @param     mixed $salaryamount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterBySalaryamount($salaryamount = null, $comparison = null)
    {
        if (is_array($salaryamount)) {
            $useMinMax = false;
            if (isset($salaryamount['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_SALARYAMOUNT, $salaryamount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($salaryamount['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_SALARYAMOUNT, $salaryamount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_SALARYAMOUNT, $salaryamount, $comparison);
    }

    /**
     * Filter the query on the dailyRate column
     *
     * Example usage:
     * <code>
     * $query->filterByDailyrate(1234); // WHERE dailyRate = 1234
     * $query->filterByDailyrate(array(12, 34)); // WHERE dailyRate IN (12, 34)
     * $query->filterByDailyrate(array('min' => 12)); // WHERE dailyRate > 12
     * </code>
     *
     * @param     mixed $dailyrate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByDailyrate($dailyrate = null, $comparison = null)
    {
        if (is_array($dailyrate)) {
            $useMinMax = false;
            if (isset($dailyrate['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_DAILYRATE, $dailyrate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dailyrate['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_DAILYRATE, $dailyrate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_DAILYRATE, $dailyrate, $comparison);
    }

    /**
     * Filter the query on the hourlyRate column
     *
     * Example usage:
     * <code>
     * $query->filterByHourlyrate(1234); // WHERE hourlyRate = 1234
     * $query->filterByHourlyrate(array(12, 34)); // WHERE hourlyRate IN (12, 34)
     * $query->filterByHourlyrate(array('min' => 12)); // WHERE hourlyRate > 12
     * </code>
     *
     * @param     mixed $hourlyrate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByHourlyrate($hourlyrate = null, $comparison = null)
    {
        if (is_array($hourlyrate)) {
            $useMinMax = false;
            if (isset($hourlyrate['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_HOURLYRATE, $hourlyrate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hourlyrate['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_HOURLYRATE, $hourlyrate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_HOURLYRATE, $hourlyrate, $comparison);
    }

    /**
     * Filter the query on the daysMissed column
     *
     * Example usage:
     * <code>
     * $query->filterByDaysmissed(1234); // WHERE daysMissed = 1234
     * $query->filterByDaysmissed(array(12, 34)); // WHERE daysMissed IN (12, 34)
     * $query->filterByDaysmissed(array('min' => 12)); // WHERE daysMissed > 12
     * </code>
     *
     * @param     mixed $daysmissed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByDaysmissed($daysmissed = null, $comparison = null)
    {
        if (is_array($daysmissed)) {
            $useMinMax = false;
            if (isset($daysmissed['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_DAYSMISSED, $daysmissed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($daysmissed['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_DAYSMISSED, $daysmissed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_DAYSMISSED, $daysmissed, $comparison);
    }

    /**
     * Filter the query on the totalParttimeHrs column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalparttimehrs(1234); // WHERE totalParttimeHrs = 1234
     * $query->filterByTotalparttimehrs(array(12, 34)); // WHERE totalParttimeHrs IN (12, 34)
     * $query->filterByTotalparttimehrs(array('min' => 12)); // WHERE totalParttimeHrs > 12
     * </code>
     *
     * @param     mixed $totalparttimehrs The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByTotalparttimehrs($totalparttimehrs = null, $comparison = null)
    {
        if (is_array($totalparttimehrs)) {
            $useMinMax = false;
            if (isset($totalparttimehrs['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_TOTALPARTTIMEHRS, $totalparttimehrs['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalparttimehrs['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_TOTALPARTTIMEHRS, $totalparttimehrs['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_TOTALPARTTIMEHRS, $totalparttimehrs, $comparison);
    }

    /**
     * Filter the query on the parttimePay column
     *
     * Example usage:
     * <code>
     * $query->filterByParttimepay(1234); // WHERE parttimePay = 1234
     * $query->filterByParttimepay(array(12, 34)); // WHERE parttimePay IN (12, 34)
     * $query->filterByParttimepay(array('min' => 12)); // WHERE parttimePay > 12
     * </code>
     *
     * @param     mixed $parttimepay The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByParttimepay($parttimepay = null, $comparison = null)
    {
        if (is_array($parttimepay)) {
            $useMinMax = false;
            if (isset($parttimepay['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_PARTTIMEPAY, $parttimepay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parttimepay['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_PARTTIMEPAY, $parttimepay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_PARTTIMEPAY, $parttimepay, $comparison);
    }

    /**
     * Filter the query on the otherDaysWorked column
     *
     * Example usage:
     * <code>
     * $query->filterByOtherdaysworked(1234); // WHERE otherDaysWorked = 1234
     * $query->filterByOtherdaysworked(array(12, 34)); // WHERE otherDaysWorked IN (12, 34)
     * $query->filterByOtherdaysworked(array('min' => 12)); // WHERE otherDaysWorked > 12
     * </code>
     *
     * @param     mixed $otherdaysworked The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOtherdaysworked($otherdaysworked = null, $comparison = null)
    {
        if (is_array($otherdaysworked)) {
            $useMinMax = false;
            if (isset($otherdaysworked['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_OTHERDAYSWORKED, $otherdaysworked['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otherdaysworked['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_OTHERDAYSWORKED, $otherdaysworked['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_OTHERDAYSWORKED, $otherdaysworked, $comparison);
    }

    /**
     * Filter the query on the otherDaysPayRate column
     *
     * Example usage:
     * <code>
     * $query->filterByOtherdayspayrate(1234); // WHERE otherDaysPayRate = 1234
     * $query->filterByOtherdayspayrate(array(12, 34)); // WHERE otherDaysPayRate IN (12, 34)
     * $query->filterByOtherdayspayrate(array('min' => 12)); // WHERE otherDaysPayRate > 12
     * </code>
     *
     * @param     mixed $otherdayspayrate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOtherdayspayrate($otherdayspayrate = null, $comparison = null)
    {
        if (is_array($otherdayspayrate)) {
            $useMinMax = false;
            if (isset($otherdayspayrate['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_OTHERDAYSPAYRATE, $otherdayspayrate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otherdayspayrate['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_OTHERDAYSPAYRATE, $otherdayspayrate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_OTHERDAYSPAYRATE, $otherdayspayrate, $comparison);
    }

    /**
     * Filter the query on the otherworkPay column
     *
     * Example usage:
     * <code>
     * $query->filterByOtherworkpay(1234); // WHERE otherworkPay = 1234
     * $query->filterByOtherworkpay(array(12, 34)); // WHERE otherworkPay IN (12, 34)
     * $query->filterByOtherworkpay(array('min' => 12)); // WHERE otherworkPay > 12
     * </code>
     *
     * @param     mixed $otherworkpay The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOtherworkpay($otherworkpay = null, $comparison = null)
    {
        if (is_array($otherworkpay)) {
            $useMinMax = false;
            if (isset($otherworkpay['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_OTHERWORKPAY, $otherworkpay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otherworkpay['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_OTHERWORKPAY, $otherworkpay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_OTHERWORKPAY, $otherworkpay, $comparison);
    }

    /**
     * Filter the query on the medicalDeduction column
     *
     * Example usage:
     * <code>
     * $query->filterByMedicaldeduction(1234); // WHERE medicalDeduction = 1234
     * $query->filterByMedicaldeduction(array(12, 34)); // WHERE medicalDeduction IN (12, 34)
     * $query->filterByMedicaldeduction(array('min' => 12)); // WHERE medicalDeduction > 12
     * </code>
     *
     * @param     mixed $medicaldeduction The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByMedicaldeduction($medicaldeduction = null, $comparison = null)
    {
        if (is_array($medicaldeduction)) {
            $useMinMax = false;
            if (isset($medicaldeduction['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_MEDICALDEDUCTION, $medicaldeduction['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($medicaldeduction['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_MEDICALDEDUCTION, $medicaldeduction['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_MEDICALDEDUCTION, $medicaldeduction, $comparison);
    }

    /**
     * Filter the query on the NSSFdeduction column
     *
     * Example usage:
     * <code>
     * $query->filterByNssfdeduction(1234); // WHERE NSSFdeduction = 1234
     * $query->filterByNssfdeduction(array(12, 34)); // WHERE NSSFdeduction IN (12, 34)
     * $query->filterByNssfdeduction(array('min' => 12)); // WHERE NSSFdeduction > 12
     * </code>
     *
     * @param     mixed $nssfdeduction The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByNssfdeduction($nssfdeduction = null, $comparison = null)
    {
        if (is_array($nssfdeduction)) {
            $useMinMax = false;
            if (isset($nssfdeduction['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_NSSFDEDUCTION, $nssfdeduction['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nssfdeduction['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_NSSFDEDUCTION, $nssfdeduction['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_NSSFDEDUCTION, $nssfdeduction, $comparison);
    }

    /**
     * Filter the query on the loanDeduction column
     *
     * Example usage:
     * <code>
     * $query->filterByLoandeduction(1234); // WHERE loanDeduction = 1234
     * $query->filterByLoandeduction(array(12, 34)); // WHERE loanDeduction IN (12, 34)
     * $query->filterByLoandeduction(array('min' => 12)); // WHERE loanDeduction > 12
     * </code>
     *
     * @param     mixed $loandeduction The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByLoandeduction($loandeduction = null, $comparison = null)
    {
        if (is_array($loandeduction)) {
            $useMinMax = false;
            if (isset($loandeduction['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_LOANDEDUCTION, $loandeduction['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($loandeduction['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_LOANDEDUCTION, $loandeduction['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_LOANDEDUCTION, $loandeduction, $comparison);
    }

    /**
     * Filter the query on the loanBalance column
     *
     * Example usage:
     * <code>
     * $query->filterByLoanbalance(1234); // WHERE loanBalance = 1234
     * $query->filterByLoanbalance(array(12, 34)); // WHERE loanBalance IN (12, 34)
     * $query->filterByLoanbalance(array('min' => 12)); // WHERE loanBalance > 12
     * </code>
     *
     * @param     mixed $loanbalance The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByLoanbalance($loanbalance = null, $comparison = null)
    {
        if (is_array($loanbalance)) {
            $useMinMax = false;
            if (isset($loanbalance['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_LOANBALANCE, $loanbalance['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($loanbalance['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_LOANBALANCE, $loanbalance['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_LOANBALANCE, $loanbalance, $comparison);
    }

    /**
     * Filter the query on the advance column
     *
     * Example usage:
     * <code>
     * $query->filterByAdvance(1234); // WHERE advance = 1234
     * $query->filterByAdvance(array(12, 34)); // WHERE advance IN (12, 34)
     * $query->filterByAdvance(array('min' => 12)); // WHERE advance > 12
     * </code>
     *
     * @param     mixed $advance The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByAdvance($advance = null, $comparison = null)
    {
        if (is_array($advance)) {
            $useMinMax = false;
            if (isset($advance['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_ADVANCE, $advance['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($advance['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_ADVANCE, $advance['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_ADVANCE, $advance, $comparison);
    }

    /**
     * Filter the query on the elecDeduction column
     *
     * Example usage:
     * <code>
     * $query->filterByElecdeduction(1234); // WHERE elecDeduction = 1234
     * $query->filterByElecdeduction(array(12, 34)); // WHERE elecDeduction IN (12, 34)
     * $query->filterByElecdeduction(array('min' => 12)); // WHERE elecDeduction > 12
     * </code>
     *
     * @param     mixed $elecdeduction The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByElecdeduction($elecdeduction = null, $comparison = null)
    {
        if (is_array($elecdeduction)) {
            $useMinMax = false;
            if (isset($elecdeduction['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_ELECDEDUCTION, $elecdeduction['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($elecdeduction['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_ELECDEDUCTION, $elecdeduction['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_ELECDEDUCTION, $elecdeduction, $comparison);
    }

    /**
     * Filter the query on the purchasesDeduction column
     *
     * Example usage:
     * <code>
     * $query->filterByPurchasesdeduction(1234); // WHERE purchasesDeduction = 1234
     * $query->filterByPurchasesdeduction(array(12, 34)); // WHERE purchasesDeduction IN (12, 34)
     * $query->filterByPurchasesdeduction(array('min' => 12)); // WHERE purchasesDeduction > 12
     * </code>
     *
     * @param     mixed $purchasesdeduction The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByPurchasesdeduction($purchasesdeduction = null, $comparison = null)
    {
        if (is_array($purchasesdeduction)) {
            $useMinMax = false;
            if (isset($purchasesdeduction['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_PURCHASESDEDUCTION, $purchasesdeduction['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($purchasesdeduction['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_PURCHASESDEDUCTION, $purchasesdeduction['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_PURCHASESDEDUCTION, $purchasesdeduction, $comparison);
    }

    /**
     * Filter the query on the otherDeduction column
     *
     * Example usage:
     * <code>
     * $query->filterByOtherdeduction(1234); // WHERE otherDeduction = 1234
     * $query->filterByOtherdeduction(array(12, 34)); // WHERE otherDeduction IN (12, 34)
     * $query->filterByOtherdeduction(array('min' => 12)); // WHERE otherDeduction > 12
     * </code>
     *
     * @param     mixed $otherdeduction The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOtherdeduction($otherdeduction = null, $comparison = null)
    {
        if (is_array($otherdeduction)) {
            $useMinMax = false;
            if (isset($otherdeduction['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_OTHERDEDUCTION, $otherdeduction['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otherdeduction['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_OTHERDEDUCTION, $otherdeduction['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_OTHERDEDUCTION, $otherdeduction, $comparison);
    }

    /**
     * Filter the query on the otherDeductionDescr column
     *
     * Example usage:
     * <code>
     * $query->filterByOtherdeductiondescr('fooValue');   // WHERE otherDeductionDescr = 'fooValue'
     * $query->filterByOtherdeductiondescr('%fooValue%', Criteria::LIKE); // WHERE otherDeductionDescr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $otherdeductiondescr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOtherdeductiondescr($otherdeductiondescr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($otherdeductiondescr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_OTHERDEDUCTIONDESCR, $otherdeductiondescr, $comparison);
    }

    /**
     * Filter the query on the bonus column
     *
     * Example usage:
     * <code>
     * $query->filterByBonus(1234); // WHERE bonus = 1234
     * $query->filterByBonus(array(12, 34)); // WHERE bonus IN (12, 34)
     * $query->filterByBonus(array('min' => 12)); // WHERE bonus > 12
     * </code>
     *
     * @param     mixed $bonus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByBonus($bonus = null, $comparison = null)
    {
        if (is_array($bonus)) {
            $useMinMax = false;
            if (isset($bonus['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_BONUS, $bonus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bonus['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_BONUS, $bonus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_BONUS, $bonus, $comparison);
    }

    /**
     * Filter the query on the payslipNbr column
     *
     * Example usage:
     * <code>
     * $query->filterByPayslipnbr('fooValue');   // WHERE payslipNbr = 'fooValue'
     * $query->filterByPayslipnbr('%fooValue%', Criteria::LIKE); // WHERE payslipNbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $payslipnbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByPayslipnbr($payslipnbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($payslipnbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_PAYSLIPNBR, $payslipnbr, $comparison);
    }

    /**
     * Filter the query on the lockDt column
     *
     * Example usage:
     * <code>
     * $query->filterByLockdt('2011-03-14'); // WHERE lockDt = '2011-03-14'
     * $query->filterByLockdt('now'); // WHERE lockDt = '2011-03-14'
     * $query->filterByLockdt(array('max' => 'yesterday')); // WHERE lockDt > '2011-03-13'
     * </code>
     *
     * @param     mixed $lockdt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByLockdt($lockdt = null, $comparison = null)
    {
        if (is_array($lockdt)) {
            $useMinMax = false;
            if (isset($lockdt['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_LOCKDT, $lockdt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lockdt['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_LOCKDT, $lockdt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_LOCKDT, $lockdt, $comparison);
    }

    /**
     * Filter the query on the lockedFlg column
     *
     * Example usage:
     * <code>
     * $query->filterByLockedflg(1234); // WHERE lockedFlg = 1234
     * $query->filterByLockedflg(array(12, 34)); // WHERE lockedFlg IN (12, 34)
     * $query->filterByLockedflg(array('min' => 12)); // WHERE lockedFlg > 12
     * </code>
     *
     * @param     mixed $lockedflg The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByLockedflg($lockedflg = null, $comparison = null)
    {
        if (is_array($lockedflg)) {
            $useMinMax = false;
            if (isset($lockedflg['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_LOCKEDFLG, $lockedflg['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lockedflg['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_LOCKEDFLG, $lockedflg['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_LOCKEDFLG, $lockedflg, $comparison);
    }

    /**
     * Filter the query on the updtTmstp column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdttmstp('2011-03-14'); // WHERE updtTmstp = '2011-03-14'
     * $query->filterByUpdttmstp('now'); // WHERE updtTmstp = '2011-03-14'
     * $query->filterByUpdttmstp(array('max' => 'yesterday')); // WHERE updtTmstp > '2011-03-13'
     * </code>
     *
     * @param     mixed $updttmstp The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query on the createTmstp column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatetmstp('2011-03-14'); // WHERE createTmstp = '2011-03-14'
     * $query->filterByCreatetmstp('now'); // WHERE createTmstp = '2011-03-14'
     * $query->filterByCreatetmstp(array('max' => 'yesterday')); // WHERE createTmstp > '2011-03-13'
     * </code>
     *
     * @param     mixed $createtmstp The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(FteemployeepayslipTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FteemployeepayslipTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Employee object
     *
     * @param \lwops\lwops\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \lwops\lwops\Employee) {
            return $this
                ->addUsingAlias(FteemployeepayslipTableMap::COL_EMPLOYEEOID, $employee->getOid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FteemployeepayslipTableMap::COL_EMPLOYEEOID, $employee->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByEmployee() only accepts arguments of type \lwops\lwops\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employee relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function joinEmployee($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employee');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Employee');
        }

        return $this;
    }

    /**
     * Use the Employee relation Employee object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employee', '\lwops\lwops\EmployeeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFteemployeepayslip $fteemployeepayslip Object to remove from the list of results
     *
     * @return $this|ChildFteemployeepayslipQuery The current query, for fluid interface
     */
    public function prune($fteemployeepayslip = null)
    {
        if ($fteemployeepayslip) {
            $this->addUsingAlias(FteemployeepayslipTableMap::COL_OID, $fteemployeepayslip->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the fteemployeepayslip table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FteemployeepayslipTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FteemployeepayslipTableMap::clearInstancePool();
            FteemployeepayslipTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FteemployeepayslipTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FteemployeepayslipTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FteemployeepayslipTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FteemployeepayslipTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FteemployeepayslipQuery
