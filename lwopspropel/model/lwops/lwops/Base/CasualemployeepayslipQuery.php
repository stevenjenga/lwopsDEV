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
use lwops\lwops\Casualemployeepayslip as ChildCasualemployeepayslip;
use lwops\lwops\CasualemployeepayslipQuery as ChildCasualemployeepayslipQuery;
use lwops\lwops\Map\CasualemployeepayslipTableMap;

/**
 * Base class that represents a query for the 'casualemployeepayslip' table.
 *
 *
 *
 * @method     ChildCasualemployeepayslipQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildCasualemployeepayslipQuery orderByOpsbiweeklycalendaroid($order = Criteria::ASC) Order by the opsBiWeeklyCalendarOid column
 * @method     ChildCasualemployeepayslipQuery orderByEmployeeoid($order = Criteria::ASC) Order by the employeeOid column
 * @method     ChildCasualemployeepayslipQuery orderByDailyrate($order = Criteria::ASC) Order by the dailyRate column
 * @method     ChildCasualemployeepayslipQuery orderByTotalteaweight($order = Criteria::ASC) Order by the totalTeaWeight column
 * @method     ChildCasualemployeepayslipQuery orderByTeapayrate($order = Criteria::ASC) Order by the teaPayRate column
 * @method     ChildCasualemployeepayslipQuery orderByTeapay($order = Criteria::ASC) Order by the teaPay column
 * @method     ChildCasualemployeepayslipQuery orderByTotalparttimehrs($order = Criteria::ASC) Order by the totalParttimeHrs column
 * @method     ChildCasualemployeepayslipQuery orderByParttimepayrate($order = Criteria::ASC) Order by the parttimePayRate column
 * @method     ChildCasualemployeepayslipQuery orderByParttimepay($order = Criteria::ASC) Order by the parttimePay column
 * @method     ChildCasualemployeepayslipQuery orderByOtherdaysworked($order = Criteria::ASC) Order by the otherDaysWorked column
 * @method     ChildCasualemployeepayslipQuery orderByOtherhoursworked($order = Criteria::ASC) Order by the otherHoursWorked column
 * @method     ChildCasualemployeepayslipQuery orderByOtherworkpay($order = Criteria::ASC) Order by the otherworkPay column
 * @method     ChildCasualemployeepayslipQuery orderByElecdeduction($order = Criteria::ASC) Order by the elecDeduction column
 * @method     ChildCasualemployeepayslipQuery orderByMedicaldeduction($order = Criteria::ASC) Order by the medicalDeduction column
 * @method     ChildCasualemployeepayslipQuery orderByNssfdeduction($order = Criteria::ASC) Order by the NSSFdeduction column
 * @method     ChildCasualemployeepayslipQuery orderByPurchasesdeduction($order = Criteria::ASC) Order by the purchasesDeduction column
 * @method     ChildCasualemployeepayslipQuery orderByOtherdeduction($order = Criteria::ASC) Order by the otherDeduction column
 * @method     ChildCasualemployeepayslipQuery orderByOtherdeductiondescr($order = Criteria::ASC) Order by the otherDeductionDescr column
 * @method     ChildCasualemployeepayslipQuery orderByBonus($order = Criteria::ASC) Order by the bonus column
 * @method     ChildCasualemployeepayslipQuery orderByLockdt($order = Criteria::ASC) Order by the lockDt column
 * @method     ChildCasualemployeepayslipQuery orderByPayslipnbr($order = Criteria::ASC) Order by the payslipNbr column
 * @method     ChildCasualemployeepayslipQuery orderByLockedflg($order = Criteria::ASC) Order by the lockedFlg column
 * @method     ChildCasualemployeepayslipQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildCasualemployeepayslipQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildCasualemployeepayslipQuery groupByOid() Group by the oid column
 * @method     ChildCasualemployeepayslipQuery groupByOpsbiweeklycalendaroid() Group by the opsBiWeeklyCalendarOid column
 * @method     ChildCasualemployeepayslipQuery groupByEmployeeoid() Group by the employeeOid column
 * @method     ChildCasualemployeepayslipQuery groupByDailyrate() Group by the dailyRate column
 * @method     ChildCasualemployeepayslipQuery groupByTotalteaweight() Group by the totalTeaWeight column
 * @method     ChildCasualemployeepayslipQuery groupByTeapayrate() Group by the teaPayRate column
 * @method     ChildCasualemployeepayslipQuery groupByTeapay() Group by the teaPay column
 * @method     ChildCasualemployeepayslipQuery groupByTotalparttimehrs() Group by the totalParttimeHrs column
 * @method     ChildCasualemployeepayslipQuery groupByParttimepayrate() Group by the parttimePayRate column
 * @method     ChildCasualemployeepayslipQuery groupByParttimepay() Group by the parttimePay column
 * @method     ChildCasualemployeepayslipQuery groupByOtherdaysworked() Group by the otherDaysWorked column
 * @method     ChildCasualemployeepayslipQuery groupByOtherhoursworked() Group by the otherHoursWorked column
 * @method     ChildCasualemployeepayslipQuery groupByOtherworkpay() Group by the otherworkPay column
 * @method     ChildCasualemployeepayslipQuery groupByElecdeduction() Group by the elecDeduction column
 * @method     ChildCasualemployeepayslipQuery groupByMedicaldeduction() Group by the medicalDeduction column
 * @method     ChildCasualemployeepayslipQuery groupByNssfdeduction() Group by the NSSFdeduction column
 * @method     ChildCasualemployeepayslipQuery groupByPurchasesdeduction() Group by the purchasesDeduction column
 * @method     ChildCasualemployeepayslipQuery groupByOtherdeduction() Group by the otherDeduction column
 * @method     ChildCasualemployeepayslipQuery groupByOtherdeductiondescr() Group by the otherDeductionDescr column
 * @method     ChildCasualemployeepayslipQuery groupByBonus() Group by the bonus column
 * @method     ChildCasualemployeepayslipQuery groupByLockdt() Group by the lockDt column
 * @method     ChildCasualemployeepayslipQuery groupByPayslipnbr() Group by the payslipNbr column
 * @method     ChildCasualemployeepayslipQuery groupByLockedflg() Group by the lockedFlg column
 * @method     ChildCasualemployeepayslipQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildCasualemployeepayslipQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildCasualemployeepayslipQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCasualemployeepayslipQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCasualemployeepayslipQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCasualemployeepayslipQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCasualemployeepayslipQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCasualemployeepayslipQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCasualemployeepayslipQuery leftJoinOpsbiweeklycalendar($relationAlias = null) Adds a LEFT JOIN clause to the query using the Opsbiweeklycalendar relation
 * @method     ChildCasualemployeepayslipQuery rightJoinOpsbiweeklycalendar($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Opsbiweeklycalendar relation
 * @method     ChildCasualemployeepayslipQuery innerJoinOpsbiweeklycalendar($relationAlias = null) Adds a INNER JOIN clause to the query using the Opsbiweeklycalendar relation
 *
 * @method     ChildCasualemployeepayslipQuery joinWithOpsbiweeklycalendar($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Opsbiweeklycalendar relation
 *
 * @method     ChildCasualemployeepayslipQuery leftJoinWithOpsbiweeklycalendar() Adds a LEFT JOIN clause and with to the query using the Opsbiweeklycalendar relation
 * @method     ChildCasualemployeepayslipQuery rightJoinWithOpsbiweeklycalendar() Adds a RIGHT JOIN clause and with to the query using the Opsbiweeklycalendar relation
 * @method     ChildCasualemployeepayslipQuery innerJoinWithOpsbiweeklycalendar() Adds a INNER JOIN clause and with to the query using the Opsbiweeklycalendar relation
 *
 * @method     ChildCasualemployeepayslipQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildCasualemployeepayslipQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildCasualemployeepayslipQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildCasualemployeepayslipQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildCasualemployeepayslipQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildCasualemployeepayslipQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildCasualemployeepayslipQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \lwops\lwops\OpsbiweeklycalendarQuery|\lwops\lwops\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCasualemployeepayslip findOne(ConnectionInterface $con = null) Return the first ChildCasualemployeepayslip matching the query
 * @method     ChildCasualemployeepayslip findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCasualemployeepayslip matching the query, or a new ChildCasualemployeepayslip object populated from the query conditions when no match is found
 *
 * @method     ChildCasualemployeepayslip findOneByOid(int $oid) Return the first ChildCasualemployeepayslip filtered by the oid column
 * @method     ChildCasualemployeepayslip findOneByOpsbiweeklycalendaroid(int $opsBiWeeklyCalendarOid) Return the first ChildCasualemployeepayslip filtered by the opsBiWeeklyCalendarOid column
 * @method     ChildCasualemployeepayslip findOneByEmployeeoid(int $employeeOid) Return the first ChildCasualemployeepayslip filtered by the employeeOid column
 * @method     ChildCasualemployeepayslip findOneByDailyrate(double $dailyRate) Return the first ChildCasualemployeepayslip filtered by the dailyRate column
 * @method     ChildCasualemployeepayslip findOneByTotalteaweight(double $totalTeaWeight) Return the first ChildCasualemployeepayslip filtered by the totalTeaWeight column
 * @method     ChildCasualemployeepayslip findOneByTeapayrate(double $teaPayRate) Return the first ChildCasualemployeepayslip filtered by the teaPayRate column
 * @method     ChildCasualemployeepayslip findOneByTeapay(double $teaPay) Return the first ChildCasualemployeepayslip filtered by the teaPay column
 * @method     ChildCasualemployeepayslip findOneByTotalparttimehrs(double $totalParttimeHrs) Return the first ChildCasualemployeepayslip filtered by the totalParttimeHrs column
 * @method     ChildCasualemployeepayslip findOneByParttimepayrate(double $parttimePayRate) Return the first ChildCasualemployeepayslip filtered by the parttimePayRate column
 * @method     ChildCasualemployeepayslip findOneByParttimepay(double $parttimePay) Return the first ChildCasualemployeepayslip filtered by the parttimePay column
 * @method     ChildCasualemployeepayslip findOneByOtherdaysworked(int $otherDaysWorked) Return the first ChildCasualemployeepayslip filtered by the otherDaysWorked column
 * @method     ChildCasualemployeepayslip findOneByOtherhoursworked(double $otherHoursWorked) Return the first ChildCasualemployeepayslip filtered by the otherHoursWorked column
 * @method     ChildCasualemployeepayslip findOneByOtherworkpay(double $otherworkPay) Return the first ChildCasualemployeepayslip filtered by the otherworkPay column
 * @method     ChildCasualemployeepayslip findOneByElecdeduction(double $elecDeduction) Return the first ChildCasualemployeepayslip filtered by the elecDeduction column
 * @method     ChildCasualemployeepayslip findOneByMedicaldeduction(double $medicalDeduction) Return the first ChildCasualemployeepayslip filtered by the medicalDeduction column
 * @method     ChildCasualemployeepayslip findOneByNssfdeduction(double $NSSFdeduction) Return the first ChildCasualemployeepayslip filtered by the NSSFdeduction column
 * @method     ChildCasualemployeepayslip findOneByPurchasesdeduction(double $purchasesDeduction) Return the first ChildCasualemployeepayslip filtered by the purchasesDeduction column
 * @method     ChildCasualemployeepayslip findOneByOtherdeduction(double $otherDeduction) Return the first ChildCasualemployeepayslip filtered by the otherDeduction column
 * @method     ChildCasualemployeepayslip findOneByOtherdeductiondescr(string $otherDeductionDescr) Return the first ChildCasualemployeepayslip filtered by the otherDeductionDescr column
 * @method     ChildCasualemployeepayslip findOneByBonus(double $bonus) Return the first ChildCasualemployeepayslip filtered by the bonus column
 * @method     ChildCasualemployeepayslip findOneByLockdt(string $lockDt) Return the first ChildCasualemployeepayslip filtered by the lockDt column
 * @method     ChildCasualemployeepayslip findOneByPayslipnbr(string $payslipNbr) Return the first ChildCasualemployeepayslip filtered by the payslipNbr column
 * @method     ChildCasualemployeepayslip findOneByLockedflg(int $lockedFlg) Return the first ChildCasualemployeepayslip filtered by the lockedFlg column
 * @method     ChildCasualemployeepayslip findOneByCreatetmstp(string $createTmstp) Return the first ChildCasualemployeepayslip filtered by the createTmstp column
 * @method     ChildCasualemployeepayslip findOneByUpdttmstp(string $updtTmstp) Return the first ChildCasualemployeepayslip filtered by the updtTmstp column *

 * @method     ChildCasualemployeepayslip requirePk($key, ConnectionInterface $con = null) Return the ChildCasualemployeepayslip by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOne(ConnectionInterface $con = null) Return the first ChildCasualemployeepayslip matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCasualemployeepayslip requireOneByOid(int $oid) Return the first ChildCasualemployeepayslip filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByOpsbiweeklycalendaroid(int $opsBiWeeklyCalendarOid) Return the first ChildCasualemployeepayslip filtered by the opsBiWeeklyCalendarOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByEmployeeoid(int $employeeOid) Return the first ChildCasualemployeepayslip filtered by the employeeOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByDailyrate(double $dailyRate) Return the first ChildCasualemployeepayslip filtered by the dailyRate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByTotalteaweight(double $totalTeaWeight) Return the first ChildCasualemployeepayslip filtered by the totalTeaWeight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByTeapayrate(double $teaPayRate) Return the first ChildCasualemployeepayslip filtered by the teaPayRate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByTeapay(double $teaPay) Return the first ChildCasualemployeepayslip filtered by the teaPay column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByTotalparttimehrs(double $totalParttimeHrs) Return the first ChildCasualemployeepayslip filtered by the totalParttimeHrs column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByParttimepayrate(double $parttimePayRate) Return the first ChildCasualemployeepayslip filtered by the parttimePayRate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByParttimepay(double $parttimePay) Return the first ChildCasualemployeepayslip filtered by the parttimePay column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByOtherdaysworked(int $otherDaysWorked) Return the first ChildCasualemployeepayslip filtered by the otherDaysWorked column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByOtherhoursworked(double $otherHoursWorked) Return the first ChildCasualemployeepayslip filtered by the otherHoursWorked column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByOtherworkpay(double $otherworkPay) Return the first ChildCasualemployeepayslip filtered by the otherworkPay column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByElecdeduction(double $elecDeduction) Return the first ChildCasualemployeepayslip filtered by the elecDeduction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByMedicaldeduction(double $medicalDeduction) Return the first ChildCasualemployeepayslip filtered by the medicalDeduction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByNssfdeduction(double $NSSFdeduction) Return the first ChildCasualemployeepayslip filtered by the NSSFdeduction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByPurchasesdeduction(double $purchasesDeduction) Return the first ChildCasualemployeepayslip filtered by the purchasesDeduction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByOtherdeduction(double $otherDeduction) Return the first ChildCasualemployeepayslip filtered by the otherDeduction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByOtherdeductiondescr(string $otherDeductionDescr) Return the first ChildCasualemployeepayslip filtered by the otherDeductionDescr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByBonus(double $bonus) Return the first ChildCasualemployeepayslip filtered by the bonus column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByLockdt(string $lockDt) Return the first ChildCasualemployeepayslip filtered by the lockDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByPayslipnbr(string $payslipNbr) Return the first ChildCasualemployeepayslip filtered by the payslipNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByLockedflg(int $lockedFlg) Return the first ChildCasualemployeepayslip filtered by the lockedFlg column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByCreatetmstp(string $createTmstp) Return the first ChildCasualemployeepayslip filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCasualemployeepayslip requireOneByUpdttmstp(string $updtTmstp) Return the first ChildCasualemployeepayslip filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCasualemployeepayslip[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCasualemployeepayslip objects based on current ModelCriteria
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByOid(int $oid) Return ChildCasualemployeepayslip objects filtered by the oid column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByOpsbiweeklycalendaroid(int $opsBiWeeklyCalendarOid) Return ChildCasualemployeepayslip objects filtered by the opsBiWeeklyCalendarOid column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByEmployeeoid(int $employeeOid) Return ChildCasualemployeepayslip objects filtered by the employeeOid column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByDailyrate(double $dailyRate) Return ChildCasualemployeepayslip objects filtered by the dailyRate column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByTotalteaweight(double $totalTeaWeight) Return ChildCasualemployeepayslip objects filtered by the totalTeaWeight column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByTeapayrate(double $teaPayRate) Return ChildCasualemployeepayslip objects filtered by the teaPayRate column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByTeapay(double $teaPay) Return ChildCasualemployeepayslip objects filtered by the teaPay column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByTotalparttimehrs(double $totalParttimeHrs) Return ChildCasualemployeepayslip objects filtered by the totalParttimeHrs column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByParttimepayrate(double $parttimePayRate) Return ChildCasualemployeepayslip objects filtered by the parttimePayRate column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByParttimepay(double $parttimePay) Return ChildCasualemployeepayslip objects filtered by the parttimePay column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByOtherdaysworked(int $otherDaysWorked) Return ChildCasualemployeepayslip objects filtered by the otherDaysWorked column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByOtherhoursworked(double $otherHoursWorked) Return ChildCasualemployeepayslip objects filtered by the otherHoursWorked column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByOtherworkpay(double $otherworkPay) Return ChildCasualemployeepayslip objects filtered by the otherworkPay column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByElecdeduction(double $elecDeduction) Return ChildCasualemployeepayslip objects filtered by the elecDeduction column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByMedicaldeduction(double $medicalDeduction) Return ChildCasualemployeepayslip objects filtered by the medicalDeduction column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByNssfdeduction(double $NSSFdeduction) Return ChildCasualemployeepayslip objects filtered by the NSSFdeduction column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByPurchasesdeduction(double $purchasesDeduction) Return ChildCasualemployeepayslip objects filtered by the purchasesDeduction column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByOtherdeduction(double $otherDeduction) Return ChildCasualemployeepayslip objects filtered by the otherDeduction column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByOtherdeductiondescr(string $otherDeductionDescr) Return ChildCasualemployeepayslip objects filtered by the otherDeductionDescr column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByBonus(double $bonus) Return ChildCasualemployeepayslip objects filtered by the bonus column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByLockdt(string $lockDt) Return ChildCasualemployeepayslip objects filtered by the lockDt column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByPayslipnbr(string $payslipNbr) Return ChildCasualemployeepayslip objects filtered by the payslipNbr column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByLockedflg(int $lockedFlg) Return ChildCasualemployeepayslip objects filtered by the lockedFlg column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildCasualemployeepayslip objects filtered by the createTmstp column
 * @method     ChildCasualemployeepayslip[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildCasualemployeepayslip objects filtered by the updtTmstp column
 * @method     ChildCasualemployeepayslip[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CasualemployeepayslipQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\CasualemployeepayslipQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Casualemployeepayslip', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCasualemployeepayslipQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCasualemployeepayslipQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCasualemployeepayslipQuery) {
            return $criteria;
        }
        $query = new ChildCasualemployeepayslipQuery();
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
     * @return ChildCasualemployeepayslip|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CasualemployeepayslipTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CasualemployeepayslipTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCasualemployeepayslip A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, opsBiWeeklyCalendarOid, employeeOid, dailyRate, totalTeaWeight, teaPayRate, teaPay, totalParttimeHrs, parttimePayRate, parttimePay, otherDaysWorked, otherHoursWorked, otherworkPay, elecDeduction, medicalDeduction, NSSFdeduction, purchasesDeduction, otherDeduction, otherDeductionDescr, bonus, lockDt, payslipNbr, lockedFlg, createTmstp, updtTmstp FROM casualemployeepayslip WHERE oid = :p0';
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
            /** @var ChildCasualemployeepayslip $obj */
            $obj = new ChildCasualemployeepayslip();
            $obj->hydrate($row);
            CasualemployeepayslipTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCasualemployeepayslip|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the opsBiWeeklyCalendarOid column
     *
     * Example usage:
     * <code>
     * $query->filterByOpsbiweeklycalendaroid(1234); // WHERE opsBiWeeklyCalendarOid = 1234
     * $query->filterByOpsbiweeklycalendaroid(array(12, 34)); // WHERE opsBiWeeklyCalendarOid IN (12, 34)
     * $query->filterByOpsbiweeklycalendaroid(array('min' => 12)); // WHERE opsBiWeeklyCalendarOid > 12
     * </code>
     *
     * @see       filterByOpsbiweeklycalendar()
     *
     * @param     mixed $opsbiweeklycalendaroid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOpsbiweeklycalendaroid($opsbiweeklycalendaroid = null, $comparison = null)
    {
        if (is_array($opsbiweeklycalendaroid)) {
            $useMinMax = false;
            if (isset($opsbiweeklycalendaroid['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OPSBIWEEKLYCALENDAROID, $opsbiweeklycalendaroid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($opsbiweeklycalendaroid['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OPSBIWEEKLYCALENDAROID, $opsbiweeklycalendaroid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OPSBIWEEKLYCALENDAROID, $opsbiweeklycalendaroid, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByEmployeeoid($employeeoid = null, $comparison = null)
    {
        if (is_array($employeeoid)) {
            $useMinMax = false;
            if (isset($employeeoid['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_EMPLOYEEOID, $employeeoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeoid['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_EMPLOYEEOID, $employeeoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_EMPLOYEEOID, $employeeoid, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByDailyrate($dailyrate = null, $comparison = null)
    {
        if (is_array($dailyrate)) {
            $useMinMax = false;
            if (isset($dailyrate['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_DAILYRATE, $dailyrate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dailyrate['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_DAILYRATE, $dailyrate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_DAILYRATE, $dailyrate, $comparison);
    }

    /**
     * Filter the query on the totalTeaWeight column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalteaweight(1234); // WHERE totalTeaWeight = 1234
     * $query->filterByTotalteaweight(array(12, 34)); // WHERE totalTeaWeight IN (12, 34)
     * $query->filterByTotalteaweight(array('min' => 12)); // WHERE totalTeaWeight > 12
     * </code>
     *
     * @param     mixed $totalteaweight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByTotalteaweight($totalteaweight = null, $comparison = null)
    {
        if (is_array($totalteaweight)) {
            $useMinMax = false;
            if (isset($totalteaweight['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_TOTALTEAWEIGHT, $totalteaweight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalteaweight['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_TOTALTEAWEIGHT, $totalteaweight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_TOTALTEAWEIGHT, $totalteaweight, $comparison);
    }

    /**
     * Filter the query on the teaPayRate column
     *
     * Example usage:
     * <code>
     * $query->filterByTeapayrate(1234); // WHERE teaPayRate = 1234
     * $query->filterByTeapayrate(array(12, 34)); // WHERE teaPayRate IN (12, 34)
     * $query->filterByTeapayrate(array('min' => 12)); // WHERE teaPayRate > 12
     * </code>
     *
     * @param     mixed $teapayrate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByTeapayrate($teapayrate = null, $comparison = null)
    {
        if (is_array($teapayrate)) {
            $useMinMax = false;
            if (isset($teapayrate['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_TEAPAYRATE, $teapayrate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($teapayrate['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_TEAPAYRATE, $teapayrate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_TEAPAYRATE, $teapayrate, $comparison);
    }

    /**
     * Filter the query on the teaPay column
     *
     * Example usage:
     * <code>
     * $query->filterByTeapay(1234); // WHERE teaPay = 1234
     * $query->filterByTeapay(array(12, 34)); // WHERE teaPay IN (12, 34)
     * $query->filterByTeapay(array('min' => 12)); // WHERE teaPay > 12
     * </code>
     *
     * @param     mixed $teapay The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByTeapay($teapay = null, $comparison = null)
    {
        if (is_array($teapay)) {
            $useMinMax = false;
            if (isset($teapay['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_TEAPAY, $teapay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($teapay['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_TEAPAY, $teapay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_TEAPAY, $teapay, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByTotalparttimehrs($totalparttimehrs = null, $comparison = null)
    {
        if (is_array($totalparttimehrs)) {
            $useMinMax = false;
            if (isset($totalparttimehrs['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_TOTALPARTTIMEHRS, $totalparttimehrs['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalparttimehrs['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_TOTALPARTTIMEHRS, $totalparttimehrs['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_TOTALPARTTIMEHRS, $totalparttimehrs, $comparison);
    }

    /**
     * Filter the query on the parttimePayRate column
     *
     * Example usage:
     * <code>
     * $query->filterByParttimepayrate(1234); // WHERE parttimePayRate = 1234
     * $query->filterByParttimepayrate(array(12, 34)); // WHERE parttimePayRate IN (12, 34)
     * $query->filterByParttimepayrate(array('min' => 12)); // WHERE parttimePayRate > 12
     * </code>
     *
     * @param     mixed $parttimepayrate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByParttimepayrate($parttimepayrate = null, $comparison = null)
    {
        if (is_array($parttimepayrate)) {
            $useMinMax = false;
            if (isset($parttimepayrate['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_PARTTIMEPAYRATE, $parttimepayrate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parttimepayrate['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_PARTTIMEPAYRATE, $parttimepayrate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_PARTTIMEPAYRATE, $parttimepayrate, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByParttimepay($parttimepay = null, $comparison = null)
    {
        if (is_array($parttimepay)) {
            $useMinMax = false;
            if (isset($parttimepay['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_PARTTIMEPAY, $parttimepay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parttimepay['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_PARTTIMEPAY, $parttimepay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_PARTTIMEPAY, $parttimepay, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOtherdaysworked($otherdaysworked = null, $comparison = null)
    {
        if (is_array($otherdaysworked)) {
            $useMinMax = false;
            if (isset($otherdaysworked['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OTHERDAYSWORKED, $otherdaysworked['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otherdaysworked['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OTHERDAYSWORKED, $otherdaysworked['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OTHERDAYSWORKED, $otherdaysworked, $comparison);
    }

    /**
     * Filter the query on the otherHoursWorked column
     *
     * Example usage:
     * <code>
     * $query->filterByOtherhoursworked(1234); // WHERE otherHoursWorked = 1234
     * $query->filterByOtherhoursworked(array(12, 34)); // WHERE otherHoursWorked IN (12, 34)
     * $query->filterByOtherhoursworked(array('min' => 12)); // WHERE otherHoursWorked > 12
     * </code>
     *
     * @param     mixed $otherhoursworked The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOtherhoursworked($otherhoursworked = null, $comparison = null)
    {
        if (is_array($otherhoursworked)) {
            $useMinMax = false;
            if (isset($otherhoursworked['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OTHERHOURSWORKED, $otherhoursworked['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otherhoursworked['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OTHERHOURSWORKED, $otherhoursworked['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OTHERHOURSWORKED, $otherhoursworked, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOtherworkpay($otherworkpay = null, $comparison = null)
    {
        if (is_array($otherworkpay)) {
            $useMinMax = false;
            if (isset($otherworkpay['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OTHERWORKPAY, $otherworkpay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otherworkpay['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OTHERWORKPAY, $otherworkpay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OTHERWORKPAY, $otherworkpay, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByElecdeduction($elecdeduction = null, $comparison = null)
    {
        if (is_array($elecdeduction)) {
            $useMinMax = false;
            if (isset($elecdeduction['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_ELECDEDUCTION, $elecdeduction['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($elecdeduction['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_ELECDEDUCTION, $elecdeduction['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_ELECDEDUCTION, $elecdeduction, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByMedicaldeduction($medicaldeduction = null, $comparison = null)
    {
        if (is_array($medicaldeduction)) {
            $useMinMax = false;
            if (isset($medicaldeduction['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_MEDICALDEDUCTION, $medicaldeduction['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($medicaldeduction['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_MEDICALDEDUCTION, $medicaldeduction['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_MEDICALDEDUCTION, $medicaldeduction, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByNssfdeduction($nssfdeduction = null, $comparison = null)
    {
        if (is_array($nssfdeduction)) {
            $useMinMax = false;
            if (isset($nssfdeduction['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_NSSFDEDUCTION, $nssfdeduction['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nssfdeduction['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_NSSFDEDUCTION, $nssfdeduction['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_NSSFDEDUCTION, $nssfdeduction, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByPurchasesdeduction($purchasesdeduction = null, $comparison = null)
    {
        if (is_array($purchasesdeduction)) {
            $useMinMax = false;
            if (isset($purchasesdeduction['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_PURCHASESDEDUCTION, $purchasesdeduction['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($purchasesdeduction['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_PURCHASESDEDUCTION, $purchasesdeduction['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_PURCHASESDEDUCTION, $purchasesdeduction, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOtherdeduction($otherdeduction = null, $comparison = null)
    {
        if (is_array($otherdeduction)) {
            $useMinMax = false;
            if (isset($otherdeduction['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OTHERDEDUCTION, $otherdeduction['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otherdeduction['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OTHERDEDUCTION, $otherdeduction['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OTHERDEDUCTION, $otherdeduction, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOtherdeductiondescr($otherdeductiondescr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($otherdeductiondescr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OTHERDEDUCTIONDESCR, $otherdeductiondescr, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByBonus($bonus = null, $comparison = null)
    {
        if (is_array($bonus)) {
            $useMinMax = false;
            if (isset($bonus['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_BONUS, $bonus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bonus['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_BONUS, $bonus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_BONUS, $bonus, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByLockdt($lockdt = null, $comparison = null)
    {
        if (is_array($lockdt)) {
            $useMinMax = false;
            if (isset($lockdt['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_LOCKDT, $lockdt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lockdt['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_LOCKDT, $lockdt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_LOCKDT, $lockdt, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByPayslipnbr($payslipnbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($payslipnbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_PAYSLIPNBR, $payslipnbr, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByLockedflg($lockedflg = null, $comparison = null)
    {
        if (is_array($lockedflg)) {
            $useMinMax = false;
            if (isset($lockedflg['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_LOCKEDFLG, $lockedflg['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lockedflg['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_LOCKEDFLG, $lockedflg['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_LOCKEDFLG, $lockedflg, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(CasualemployeepayslipTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CasualemployeepayslipTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Opsbiweeklycalendar object
     *
     * @param \lwops\lwops\Opsbiweeklycalendar|ObjectCollection $opsbiweeklycalendar The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByOpsbiweeklycalendar($opsbiweeklycalendar, $comparison = null)
    {
        if ($opsbiweeklycalendar instanceof \lwops\lwops\Opsbiweeklycalendar) {
            return $this
                ->addUsingAlias(CasualemployeepayslipTableMap::COL_OPSBIWEEKLYCALENDAROID, $opsbiweeklycalendar->getOid(), $comparison);
        } elseif ($opsbiweeklycalendar instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CasualemployeepayslipTableMap::COL_OPSBIWEEKLYCALENDAROID, $opsbiweeklycalendar->toKeyValue('PrimaryKey', 'Oid'), $comparison);
        } else {
            throw new PropelException('filterByOpsbiweeklycalendar() only accepts arguments of type \lwops\lwops\Opsbiweeklycalendar or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Opsbiweeklycalendar relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function joinOpsbiweeklycalendar($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Opsbiweeklycalendar');

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
            $this->addJoinObject($join, 'Opsbiweeklycalendar');
        }

        return $this;
    }

    /**
     * Use the Opsbiweeklycalendar relation Opsbiweeklycalendar object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\OpsbiweeklycalendarQuery A secondary query class using the current class as primary query
     */
    public function useOpsbiweeklycalendarQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOpsbiweeklycalendar($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Opsbiweeklycalendar', '\lwops\lwops\OpsbiweeklycalendarQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Employee object
     *
     * @param \lwops\lwops\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \lwops\lwops\Employee) {
            return $this
                ->addUsingAlias(CasualemployeepayslipTableMap::COL_EMPLOYEEOID, $employee->getOid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CasualemployeepayslipTableMap::COL_EMPLOYEEOID, $employee->toKeyValue('PrimaryKey', 'Oid'), $comparison);
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
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
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
     * @param   ChildCasualemployeepayslip $casualemployeepayslip Object to remove from the list of results
     *
     * @return $this|ChildCasualemployeepayslipQuery The current query, for fluid interface
     */
    public function prune($casualemployeepayslip = null)
    {
        if ($casualemployeepayslip) {
            $this->addUsingAlias(CasualemployeepayslipTableMap::COL_OID, $casualemployeepayslip->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the casualemployeepayslip table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CasualemployeepayslipTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CasualemployeepayslipTableMap::clearInstancePool();
            CasualemployeepayslipTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CasualemployeepayslipTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CasualemployeepayslipTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CasualemployeepayslipTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CasualemployeepayslipTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CasualemployeepayslipQuery
