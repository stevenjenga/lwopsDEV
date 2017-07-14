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
use lwops\lwops\Employee as ChildEmployee;
use lwops\lwops\EmployeeQuery as ChildEmployeeQuery;
use lwops\lwops\Map\EmployeeTableMap;

/**
 * Base class that represents a query for the 'employee' table.
 *
 *
 *
 * @method     ChildEmployeeQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildEmployeeQuery orderByFirstname($order = Criteria::ASC) Order by the firstName column
 * @method     ChildEmployeeQuery orderByMiddleinitial($order = Criteria::ASC) Order by the middleInitial column
 * @method     ChildEmployeeQuery orderByLastname($order = Criteria::ASC) Order by the lastName column
 * @method     ChildEmployeeQuery orderByNationalid($order = Criteria::ASC) Order by the nationalID column
 * @method     ChildEmployeeQuery orderByMobilenbr($order = Criteria::ASC) Order by the mobileNbr column
 * @method     ChildEmployeeQuery orderByResident($order = Criteria::ASC) Order by the resident column
 * @method     ChildEmployeeQuery orderByElecdeduction($order = Criteria::ASC) Order by the elecDeduction column
 * @method     ChildEmployeeQuery orderByEpayment($order = Criteria::ASC) Order by the ePayment column
 * @method     ChildEmployeeQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildEmployeeQuery orderByStartdt($order = Criteria::ASC) Order by the startDt column
 * @method     ChildEmployeeQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method     ChildEmployeeQuery orderByTerminated($order = Criteria::ASC) Order by the terminated column
 * @method     ChildEmployeeQuery orderByDateofbirth($order = Criteria::ASC) Order by the dateOfBirth column
 * @method     ChildEmployeeQuery orderByMaritalstatus($order = Criteria::ASC) Order by the maritalStatus column
 * @method     ChildEmployeeQuery orderBySpousefirstnm($order = Criteria::ASC) Order by the spouseFirstNm column
 * @method     ChildEmployeeQuery orderBySpouselastnm($order = Criteria::ASC) Order by the spouseLastNm column
 * @method     ChildEmployeeQuery orderBySpousemobnbr($order = Criteria::ASC) Order by the spouseMobNbr column
 * @method     ChildEmployeeQuery orderByPrevemployername($order = Criteria::ASC) Order by the prevEmployerName column
 * @method     ChildEmployeeQuery orderByPrevemployertelnbr($order = Criteria::ASC) Order by the prevEmployerTelNbr column
 * @method     ChildEmployeeQuery orderByPrevemployerstartdt($order = Criteria::ASC) Order by the prevEmployerStartDt column
 * @method     ChildEmployeeQuery orderByPrevemployerenddt($order = Criteria::ASC) Order by the prevEmployerEndDt column
 * @method     ChildEmployeeQuery orderByPrevemployerleavingreason($order = Criteria::ASC) Order by the prevEmployerLeavingReason column
 * @method     ChildEmployeeQuery orderByPrevemployerlocation($order = Criteria::ASC) Order by the prevEmployerLocation column
 * @method     ChildEmployeeQuery orderByWorkdoneatprevemployer($order = Criteria::ASC) Order by the workDoneAtPrevEmployer column
 * @method     ChildEmployeeQuery orderByNxtofkinfirstnm($order = Criteria::ASC) Order by the nxtOfKinFirstNm column
 * @method     ChildEmployeeQuery orderByNxtofkinlastnm($order = Criteria::ASC) Order by the nxtOfKinLastNm column
 * @method     ChildEmployeeQuery orderByNxtofkinmobilenbr($order = Criteria::ASC) Order by the nxtOfKinMobileNbr column
 * @method     ChildEmployeeQuery orderByNxtofkinresidence($order = Criteria::ASC) Order by the nxtOfKinResidence column
 * @method     ChildEmployeeQuery orderByNxtofkinrelationship($order = Criteria::ASC) Order by the nxtOfKinRelationship column
 * @method     ChildEmployeeQuery orderByNxtofkinplaceofwork($order = Criteria::ASC) Order by the nxtOfKinPlaceOfWork column
 * @method     ChildEmployeeQuery orderByComment($order = Criteria::ASC) Order by the comment column
 * @method     ChildEmployeeQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildEmployeeQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildEmployeeQuery groupByOid() Group by the oid column
 * @method     ChildEmployeeQuery groupByFirstname() Group by the firstName column
 * @method     ChildEmployeeQuery groupByMiddleinitial() Group by the middleInitial column
 * @method     ChildEmployeeQuery groupByLastname() Group by the lastName column
 * @method     ChildEmployeeQuery groupByNationalid() Group by the nationalID column
 * @method     ChildEmployeeQuery groupByMobilenbr() Group by the mobileNbr column
 * @method     ChildEmployeeQuery groupByResident() Group by the resident column
 * @method     ChildEmployeeQuery groupByElecdeduction() Group by the elecDeduction column
 * @method     ChildEmployeeQuery groupByEpayment() Group by the ePayment column
 * @method     ChildEmployeeQuery groupByActive() Group by the active column
 * @method     ChildEmployeeQuery groupByStartdt() Group by the startDt column
 * @method     ChildEmployeeQuery groupByGender() Group by the gender column
 * @method     ChildEmployeeQuery groupByTerminated() Group by the terminated column
 * @method     ChildEmployeeQuery groupByDateofbirth() Group by the dateOfBirth column
 * @method     ChildEmployeeQuery groupByMaritalstatus() Group by the maritalStatus column
 * @method     ChildEmployeeQuery groupBySpousefirstnm() Group by the spouseFirstNm column
 * @method     ChildEmployeeQuery groupBySpouselastnm() Group by the spouseLastNm column
 * @method     ChildEmployeeQuery groupBySpousemobnbr() Group by the spouseMobNbr column
 * @method     ChildEmployeeQuery groupByPrevemployername() Group by the prevEmployerName column
 * @method     ChildEmployeeQuery groupByPrevemployertelnbr() Group by the prevEmployerTelNbr column
 * @method     ChildEmployeeQuery groupByPrevemployerstartdt() Group by the prevEmployerStartDt column
 * @method     ChildEmployeeQuery groupByPrevemployerenddt() Group by the prevEmployerEndDt column
 * @method     ChildEmployeeQuery groupByPrevemployerleavingreason() Group by the prevEmployerLeavingReason column
 * @method     ChildEmployeeQuery groupByPrevemployerlocation() Group by the prevEmployerLocation column
 * @method     ChildEmployeeQuery groupByWorkdoneatprevemployer() Group by the workDoneAtPrevEmployer column
 * @method     ChildEmployeeQuery groupByNxtofkinfirstnm() Group by the nxtOfKinFirstNm column
 * @method     ChildEmployeeQuery groupByNxtofkinlastnm() Group by the nxtOfKinLastNm column
 * @method     ChildEmployeeQuery groupByNxtofkinmobilenbr() Group by the nxtOfKinMobileNbr column
 * @method     ChildEmployeeQuery groupByNxtofkinresidence() Group by the nxtOfKinResidence column
 * @method     ChildEmployeeQuery groupByNxtofkinrelationship() Group by the nxtOfKinRelationship column
 * @method     ChildEmployeeQuery groupByNxtofkinplaceofwork() Group by the nxtOfKinPlaceOfWork column
 * @method     ChildEmployeeQuery groupByComment() Group by the comment column
 * @method     ChildEmployeeQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildEmployeeQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildEmployeeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeeQuery leftJoinAttendance($relationAlias = null) Adds a LEFT JOIN clause to the query using the Attendance relation
 * @method     ChildEmployeeQuery rightJoinAttendance($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Attendance relation
 * @method     ChildEmployeeQuery innerJoinAttendance($relationAlias = null) Adds a INNER JOIN clause to the query using the Attendance relation
 *
 * @method     ChildEmployeeQuery joinWithAttendance($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Attendance relation
 *
 * @method     ChildEmployeeQuery leftJoinWithAttendance() Adds a LEFT JOIN clause and with to the query using the Attendance relation
 * @method     ChildEmployeeQuery rightJoinWithAttendance() Adds a RIGHT JOIN clause and with to the query using the Attendance relation
 * @method     ChildEmployeeQuery innerJoinWithAttendance() Adds a INNER JOIN clause and with to the query using the Attendance relation
 *
 * @method     ChildEmployeeQuery leftJoinCasualemployeepayslip($relationAlias = null) Adds a LEFT JOIN clause to the query using the Casualemployeepayslip relation
 * @method     ChildEmployeeQuery rightJoinCasualemployeepayslip($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Casualemployeepayslip relation
 * @method     ChildEmployeeQuery innerJoinCasualemployeepayslip($relationAlias = null) Adds a INNER JOIN clause to the query using the Casualemployeepayslip relation
 *
 * @method     ChildEmployeeQuery joinWithCasualemployeepayslip($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Casualemployeepayslip relation
 *
 * @method     ChildEmployeeQuery leftJoinWithCasualemployeepayslip() Adds a LEFT JOIN clause and with to the query using the Casualemployeepayslip relation
 * @method     ChildEmployeeQuery rightJoinWithCasualemployeepayslip() Adds a RIGHT JOIN clause and with to the query using the Casualemployeepayslip relation
 * @method     ChildEmployeeQuery innerJoinWithCasualemployeepayslip() Adds a INNER JOIN clause and with to the query using the Casualemployeepayslip relation
 *
 * @method     ChildEmployeeQuery leftJoinEmployeeloan($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeeloan relation
 * @method     ChildEmployeeQuery rightJoinEmployeeloan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeeloan relation
 * @method     ChildEmployeeQuery innerJoinEmployeeloan($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeeloan relation
 *
 * @method     ChildEmployeeQuery joinWithEmployeeloan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeeloan relation
 *
 * @method     ChildEmployeeQuery leftJoinWithEmployeeloan() Adds a LEFT JOIN clause and with to the query using the Employeeloan relation
 * @method     ChildEmployeeQuery rightJoinWithEmployeeloan() Adds a RIGHT JOIN clause and with to the query using the Employeeloan relation
 * @method     ChildEmployeeQuery innerJoinWithEmployeeloan() Adds a INNER JOIN clause and with to the query using the Employeeloan relation
 *
 * @method     ChildEmployeeQuery leftJoinEmployeeotherdeduction($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeeotherdeduction relation
 * @method     ChildEmployeeQuery rightJoinEmployeeotherdeduction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeeotherdeduction relation
 * @method     ChildEmployeeQuery innerJoinEmployeeotherdeduction($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeeotherdeduction relation
 *
 * @method     ChildEmployeeQuery joinWithEmployeeotherdeduction($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeeotherdeduction relation
 *
 * @method     ChildEmployeeQuery leftJoinWithEmployeeotherdeduction() Adds a LEFT JOIN clause and with to the query using the Employeeotherdeduction relation
 * @method     ChildEmployeeQuery rightJoinWithEmployeeotherdeduction() Adds a RIGHT JOIN clause and with to the query using the Employeeotherdeduction relation
 * @method     ChildEmployeeQuery innerJoinWithEmployeeotherdeduction() Adds a INNER JOIN clause and with to the query using the Employeeotherdeduction relation
 *
 * @method     ChildEmployeeQuery leftJoinEmployeepurchases($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeepurchases relation
 * @method     ChildEmployeeQuery rightJoinEmployeepurchases($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeepurchases relation
 * @method     ChildEmployeeQuery innerJoinEmployeepurchases($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeepurchases relation
 *
 * @method     ChildEmployeeQuery joinWithEmployeepurchases($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeepurchases relation
 *
 * @method     ChildEmployeeQuery leftJoinWithEmployeepurchases() Adds a LEFT JOIN clause and with to the query using the Employeepurchases relation
 * @method     ChildEmployeeQuery rightJoinWithEmployeepurchases() Adds a RIGHT JOIN clause and with to the query using the Employeepurchases relation
 * @method     ChildEmployeeQuery innerJoinWithEmployeepurchases() Adds a INNER JOIN clause and with to the query using the Employeepurchases relation
 *
 * @method     ChildEmployeeQuery leftJoinEmployeerole($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeerole relation
 * @method     ChildEmployeeQuery rightJoinEmployeerole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeerole relation
 * @method     ChildEmployeeQuery innerJoinEmployeerole($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeerole relation
 *
 * @method     ChildEmployeeQuery joinWithEmployeerole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeerole relation
 *
 * @method     ChildEmployeeQuery leftJoinWithEmployeerole() Adds a LEFT JOIN clause and with to the query using the Employeerole relation
 * @method     ChildEmployeeQuery rightJoinWithEmployeerole() Adds a RIGHT JOIN clause and with to the query using the Employeerole relation
 * @method     ChildEmployeeQuery innerJoinWithEmployeerole() Adds a INNER JOIN clause and with to the query using the Employeerole relation
 *
 * @method     ChildEmployeeQuery leftJoinEmployeesalaryexpenseallocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeesalaryexpenseallocation relation
 * @method     ChildEmployeeQuery rightJoinEmployeesalaryexpenseallocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeesalaryexpenseallocation relation
 * @method     ChildEmployeeQuery innerJoinEmployeesalaryexpenseallocation($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeesalaryexpenseallocation relation
 *
 * @method     ChildEmployeeQuery joinWithEmployeesalaryexpenseallocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeesalaryexpenseallocation relation
 *
 * @method     ChildEmployeeQuery leftJoinWithEmployeesalaryexpenseallocation() Adds a LEFT JOIN clause and with to the query using the Employeesalaryexpenseallocation relation
 * @method     ChildEmployeeQuery rightJoinWithEmployeesalaryexpenseallocation() Adds a RIGHT JOIN clause and with to the query using the Employeesalaryexpenseallocation relation
 * @method     ChildEmployeeQuery innerJoinWithEmployeesalaryexpenseallocation() Adds a INNER JOIN clause and with to the query using the Employeesalaryexpenseallocation relation
 *
 * @method     ChildEmployeeQuery leftJoinEmployeetermination($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeetermination relation
 * @method     ChildEmployeeQuery rightJoinEmployeetermination($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeetermination relation
 * @method     ChildEmployeeQuery innerJoinEmployeetermination($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeetermination relation
 *
 * @method     ChildEmployeeQuery joinWithEmployeetermination($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeetermination relation
 *
 * @method     ChildEmployeeQuery leftJoinWithEmployeetermination() Adds a LEFT JOIN clause and with to the query using the Employeetermination relation
 * @method     ChildEmployeeQuery rightJoinWithEmployeetermination() Adds a RIGHT JOIN clause and with to the query using the Employeetermination relation
 * @method     ChildEmployeeQuery innerJoinWithEmployeetermination() Adds a INNER JOIN clause and with to the query using the Employeetermination relation
 *
 * @method     ChildEmployeeQuery leftJoinFteemployeepayslip($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fteemployeepayslip relation
 * @method     ChildEmployeeQuery rightJoinFteemployeepayslip($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fteemployeepayslip relation
 * @method     ChildEmployeeQuery innerJoinFteemployeepayslip($relationAlias = null) Adds a INNER JOIN clause to the query using the Fteemployeepayslip relation
 *
 * @method     ChildEmployeeQuery joinWithFteemployeepayslip($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fteemployeepayslip relation
 *
 * @method     ChildEmployeeQuery leftJoinWithFteemployeepayslip() Adds a LEFT JOIN clause and with to the query using the Fteemployeepayslip relation
 * @method     ChildEmployeeQuery rightJoinWithFteemployeepayslip() Adds a RIGHT JOIN clause and with to the query using the Fteemployeepayslip relation
 * @method     ChildEmployeeQuery innerJoinWithFteemployeepayslip() Adds a INNER JOIN clause and with to the query using the Fteemployeepayslip relation
 *
 * @method     ChildEmployeeQuery leftJoinFtesalaryadvance($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ftesalaryadvance relation
 * @method     ChildEmployeeQuery rightJoinFtesalaryadvance($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ftesalaryadvance relation
 * @method     ChildEmployeeQuery innerJoinFtesalaryadvance($relationAlias = null) Adds a INNER JOIN clause to the query using the Ftesalaryadvance relation
 *
 * @method     ChildEmployeeQuery joinWithFtesalaryadvance($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ftesalaryadvance relation
 *
 * @method     ChildEmployeeQuery leftJoinWithFtesalaryadvance() Adds a LEFT JOIN clause and with to the query using the Ftesalaryadvance relation
 * @method     ChildEmployeeQuery rightJoinWithFtesalaryadvance() Adds a RIGHT JOIN clause and with to the query using the Ftesalaryadvance relation
 * @method     ChildEmployeeQuery innerJoinWithFtesalaryadvance() Adds a INNER JOIN clause and with to the query using the Ftesalaryadvance relation
 *
 * @method     ChildEmployeeQuery leftJoinMedicaldeduction($relationAlias = null) Adds a LEFT JOIN clause to the query using the Medicaldeduction relation
 * @method     ChildEmployeeQuery rightJoinMedicaldeduction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Medicaldeduction relation
 * @method     ChildEmployeeQuery innerJoinMedicaldeduction($relationAlias = null) Adds a INNER JOIN clause to the query using the Medicaldeduction relation
 *
 * @method     ChildEmployeeQuery joinWithMedicaldeduction($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Medicaldeduction relation
 *
 * @method     ChildEmployeeQuery leftJoinWithMedicaldeduction() Adds a LEFT JOIN clause and with to the query using the Medicaldeduction relation
 * @method     ChildEmployeeQuery rightJoinWithMedicaldeduction() Adds a RIGHT JOIN clause and with to the query using the Medicaldeduction relation
 * @method     ChildEmployeeQuery innerJoinWithMedicaldeduction() Adds a INNER JOIN clause and with to the query using the Medicaldeduction relation
 *
 * @method     ChildEmployeeQuery leftJoinNssfdeduction($relationAlias = null) Adds a LEFT JOIN clause to the query using the Nssfdeduction relation
 * @method     ChildEmployeeQuery rightJoinNssfdeduction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Nssfdeduction relation
 * @method     ChildEmployeeQuery innerJoinNssfdeduction($relationAlias = null) Adds a INNER JOIN clause to the query using the Nssfdeduction relation
 *
 * @method     ChildEmployeeQuery joinWithNssfdeduction($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Nssfdeduction relation
 *
 * @method     ChildEmployeeQuery leftJoinWithNssfdeduction() Adds a LEFT JOIN clause and with to the query using the Nssfdeduction relation
 * @method     ChildEmployeeQuery rightJoinWithNssfdeduction() Adds a RIGHT JOIN clause and with to the query using the Nssfdeduction relation
 * @method     ChildEmployeeQuery innerJoinWithNssfdeduction() Adds a INNER JOIN clause and with to the query using the Nssfdeduction relation
 *
 * @method     ChildEmployeeQuery leftJoinParttimedetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the Parttimedetail relation
 * @method     ChildEmployeeQuery rightJoinParttimedetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Parttimedetail relation
 * @method     ChildEmployeeQuery innerJoinParttimedetail($relationAlias = null) Adds a INNER JOIN clause to the query using the Parttimedetail relation
 *
 * @method     ChildEmployeeQuery joinWithParttimedetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Parttimedetail relation
 *
 * @method     ChildEmployeeQuery leftJoinWithParttimedetail() Adds a LEFT JOIN clause and with to the query using the Parttimedetail relation
 * @method     ChildEmployeeQuery rightJoinWithParttimedetail() Adds a RIGHT JOIN clause and with to the query using the Parttimedetail relation
 * @method     ChildEmployeeQuery innerJoinWithParttimedetail() Adds a INNER JOIN clause and with to the query using the Parttimedetail relation
 *
 * @method     ChildEmployeeQuery leftJoinSalary($relationAlias = null) Adds a LEFT JOIN clause to the query using the Salary relation
 * @method     ChildEmployeeQuery rightJoinSalary($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Salary relation
 * @method     ChildEmployeeQuery innerJoinSalary($relationAlias = null) Adds a INNER JOIN clause to the query using the Salary relation
 *
 * @method     ChildEmployeeQuery joinWithSalary($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Salary relation
 *
 * @method     ChildEmployeeQuery leftJoinWithSalary() Adds a LEFT JOIN clause and with to the query using the Salary relation
 * @method     ChildEmployeeQuery rightJoinWithSalary() Adds a RIGHT JOIN clause and with to the query using the Salary relation
 * @method     ChildEmployeeQuery innerJoinWithSalary() Adds a INNER JOIN clause and with to the query using the Salary relation
 *
 * @method     \lwops\lwops\AttendanceQuery|\lwops\lwops\CasualemployeepayslipQuery|\lwops\lwops\EmployeeloanQuery|\lwops\lwops\EmployeeotherdeductionQuery|\lwops\lwops\EmployeepurchasesQuery|\lwops\lwops\EmployeeroleQuery|\lwops\lwops\EmployeesalaryexpenseallocationQuery|\lwops\lwops\EmployeeterminationQuery|\lwops\lwops\FteemployeepayslipQuery|\lwops\lwops\FtesalaryadvanceQuery|\lwops\lwops\MedicaldeductionQuery|\lwops\lwops\NssfdeductionQuery|\lwops\lwops\ParttimedetailQuery|\lwops\lwops\SalaryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployee findOne(ConnectionInterface $con = null) Return the first ChildEmployee matching the query
 * @method     ChildEmployee findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmployee matching the query, or a new ChildEmployee object populated from the query conditions when no match is found
 *
 * @method     ChildEmployee findOneByOid(int $oid) Return the first ChildEmployee filtered by the oid column
 * @method     ChildEmployee findOneByFirstname(string $firstName) Return the first ChildEmployee filtered by the firstName column
 * @method     ChildEmployee findOneByMiddleinitial(string $middleInitial) Return the first ChildEmployee filtered by the middleInitial column
 * @method     ChildEmployee findOneByLastname(string $lastName) Return the first ChildEmployee filtered by the lastName column
 * @method     ChildEmployee findOneByNationalid(string $nationalID) Return the first ChildEmployee filtered by the nationalID column
 * @method     ChildEmployee findOneByMobilenbr(string $mobileNbr) Return the first ChildEmployee filtered by the mobileNbr column
 * @method     ChildEmployee findOneByResident(boolean $resident) Return the first ChildEmployee filtered by the resident column
 * @method     ChildEmployee findOneByElecdeduction(boolean $elecDeduction) Return the first ChildEmployee filtered by the elecDeduction column
 * @method     ChildEmployee findOneByEpayment(boolean $ePayment) Return the first ChildEmployee filtered by the ePayment column
 * @method     ChildEmployee findOneByActive(boolean $active) Return the first ChildEmployee filtered by the active column
 * @method     ChildEmployee findOneByStartdt(string $startDt) Return the first ChildEmployee filtered by the startDt column
 * @method     ChildEmployee findOneByGender(string $gender) Return the first ChildEmployee filtered by the gender column
 * @method     ChildEmployee findOneByTerminated(boolean $terminated) Return the first ChildEmployee filtered by the terminated column
 * @method     ChildEmployee findOneByDateofbirth(string $dateOfBirth) Return the first ChildEmployee filtered by the dateOfBirth column
 * @method     ChildEmployee findOneByMaritalstatus(string $maritalStatus) Return the first ChildEmployee filtered by the maritalStatus column
 * @method     ChildEmployee findOneBySpousefirstnm(string $spouseFirstNm) Return the first ChildEmployee filtered by the spouseFirstNm column
 * @method     ChildEmployee findOneBySpouselastnm(string $spouseLastNm) Return the first ChildEmployee filtered by the spouseLastNm column
 * @method     ChildEmployee findOneBySpousemobnbr(string $spouseMobNbr) Return the first ChildEmployee filtered by the spouseMobNbr column
 * @method     ChildEmployee findOneByPrevemployername(string $prevEmployerName) Return the first ChildEmployee filtered by the prevEmployerName column
 * @method     ChildEmployee findOneByPrevemployertelnbr(string $prevEmployerTelNbr) Return the first ChildEmployee filtered by the prevEmployerTelNbr column
 * @method     ChildEmployee findOneByPrevemployerstartdt(string $prevEmployerStartDt) Return the first ChildEmployee filtered by the prevEmployerStartDt column
 * @method     ChildEmployee findOneByPrevemployerenddt(string $prevEmployerEndDt) Return the first ChildEmployee filtered by the prevEmployerEndDt column
 * @method     ChildEmployee findOneByPrevemployerleavingreason(string $prevEmployerLeavingReason) Return the first ChildEmployee filtered by the prevEmployerLeavingReason column
 * @method     ChildEmployee findOneByPrevemployerlocation(string $prevEmployerLocation) Return the first ChildEmployee filtered by the prevEmployerLocation column
 * @method     ChildEmployee findOneByWorkdoneatprevemployer(string $workDoneAtPrevEmployer) Return the first ChildEmployee filtered by the workDoneAtPrevEmployer column
 * @method     ChildEmployee findOneByNxtofkinfirstnm(string $nxtOfKinFirstNm) Return the first ChildEmployee filtered by the nxtOfKinFirstNm column
 * @method     ChildEmployee findOneByNxtofkinlastnm(string $nxtOfKinLastNm) Return the first ChildEmployee filtered by the nxtOfKinLastNm column
 * @method     ChildEmployee findOneByNxtofkinmobilenbr(string $nxtOfKinMobileNbr) Return the first ChildEmployee filtered by the nxtOfKinMobileNbr column
 * @method     ChildEmployee findOneByNxtofkinresidence(string $nxtOfKinResidence) Return the first ChildEmployee filtered by the nxtOfKinResidence column
 * @method     ChildEmployee findOneByNxtofkinrelationship(string $nxtOfKinRelationship) Return the first ChildEmployee filtered by the nxtOfKinRelationship column
 * @method     ChildEmployee findOneByNxtofkinplaceofwork(string $nxtOfKinPlaceOfWork) Return the first ChildEmployee filtered by the nxtOfKinPlaceOfWork column
 * @method     ChildEmployee findOneByComment(string $comment) Return the first ChildEmployee filtered by the comment column
 * @method     ChildEmployee findOneByCreatetmstp(string $createTmstp) Return the first ChildEmployee filtered by the createTmstp column
 * @method     ChildEmployee findOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployee filtered by the updtTmstp column *

 * @method     ChildEmployee requirePk($key, ConnectionInterface $con = null) Return the ChildEmployee by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOne(ConnectionInterface $con = null) Return the first ChildEmployee matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployee requireOneByOid(int $oid) Return the first ChildEmployee filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByFirstname(string $firstName) Return the first ChildEmployee filtered by the firstName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByMiddleinitial(string $middleInitial) Return the first ChildEmployee filtered by the middleInitial column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByLastname(string $lastName) Return the first ChildEmployee filtered by the lastName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByNationalid(string $nationalID) Return the first ChildEmployee filtered by the nationalID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByMobilenbr(string $mobileNbr) Return the first ChildEmployee filtered by the mobileNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByResident(boolean $resident) Return the first ChildEmployee filtered by the resident column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByElecdeduction(boolean $elecDeduction) Return the first ChildEmployee filtered by the elecDeduction column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByEpayment(boolean $ePayment) Return the first ChildEmployee filtered by the ePayment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByActive(boolean $active) Return the first ChildEmployee filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByStartdt(string $startDt) Return the first ChildEmployee filtered by the startDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByGender(string $gender) Return the first ChildEmployee filtered by the gender column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByTerminated(boolean $terminated) Return the first ChildEmployee filtered by the terminated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByDateofbirth(string $dateOfBirth) Return the first ChildEmployee filtered by the dateOfBirth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByMaritalstatus(string $maritalStatus) Return the first ChildEmployee filtered by the maritalStatus column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneBySpousefirstnm(string $spouseFirstNm) Return the first ChildEmployee filtered by the spouseFirstNm column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneBySpouselastnm(string $spouseLastNm) Return the first ChildEmployee filtered by the spouseLastNm column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneBySpousemobnbr(string $spouseMobNbr) Return the first ChildEmployee filtered by the spouseMobNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByPrevemployername(string $prevEmployerName) Return the first ChildEmployee filtered by the prevEmployerName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByPrevemployertelnbr(string $prevEmployerTelNbr) Return the first ChildEmployee filtered by the prevEmployerTelNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByPrevemployerstartdt(string $prevEmployerStartDt) Return the first ChildEmployee filtered by the prevEmployerStartDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByPrevemployerenddt(string $prevEmployerEndDt) Return the first ChildEmployee filtered by the prevEmployerEndDt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByPrevemployerleavingreason(string $prevEmployerLeavingReason) Return the first ChildEmployee filtered by the prevEmployerLeavingReason column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByPrevemployerlocation(string $prevEmployerLocation) Return the first ChildEmployee filtered by the prevEmployerLocation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByWorkdoneatprevemployer(string $workDoneAtPrevEmployer) Return the first ChildEmployee filtered by the workDoneAtPrevEmployer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByNxtofkinfirstnm(string $nxtOfKinFirstNm) Return the first ChildEmployee filtered by the nxtOfKinFirstNm column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByNxtofkinlastnm(string $nxtOfKinLastNm) Return the first ChildEmployee filtered by the nxtOfKinLastNm column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByNxtofkinmobilenbr(string $nxtOfKinMobileNbr) Return the first ChildEmployee filtered by the nxtOfKinMobileNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByNxtofkinresidence(string $nxtOfKinResidence) Return the first ChildEmployee filtered by the nxtOfKinResidence column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByNxtofkinrelationship(string $nxtOfKinRelationship) Return the first ChildEmployee filtered by the nxtOfKinRelationship column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByNxtofkinplaceofwork(string $nxtOfKinPlaceOfWork) Return the first ChildEmployee filtered by the nxtOfKinPlaceOfWork column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByComment(string $comment) Return the first ChildEmployee filtered by the comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByCreatetmstp(string $createTmstp) Return the first ChildEmployee filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByUpdttmstp(string $updtTmstp) Return the first ChildEmployee filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployee[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmployee objects based on current ModelCriteria
 * @method     ChildEmployee[]|ObjectCollection findByOid(int $oid) Return ChildEmployee objects filtered by the oid column
 * @method     ChildEmployee[]|ObjectCollection findByFirstname(string $firstName) Return ChildEmployee objects filtered by the firstName column
 * @method     ChildEmployee[]|ObjectCollection findByMiddleinitial(string $middleInitial) Return ChildEmployee objects filtered by the middleInitial column
 * @method     ChildEmployee[]|ObjectCollection findByLastname(string $lastName) Return ChildEmployee objects filtered by the lastName column
 * @method     ChildEmployee[]|ObjectCollection findByNationalid(string $nationalID) Return ChildEmployee objects filtered by the nationalID column
 * @method     ChildEmployee[]|ObjectCollection findByMobilenbr(string $mobileNbr) Return ChildEmployee objects filtered by the mobileNbr column
 * @method     ChildEmployee[]|ObjectCollection findByResident(boolean $resident) Return ChildEmployee objects filtered by the resident column
 * @method     ChildEmployee[]|ObjectCollection findByElecdeduction(boolean $elecDeduction) Return ChildEmployee objects filtered by the elecDeduction column
 * @method     ChildEmployee[]|ObjectCollection findByEpayment(boolean $ePayment) Return ChildEmployee objects filtered by the ePayment column
 * @method     ChildEmployee[]|ObjectCollection findByActive(boolean $active) Return ChildEmployee objects filtered by the active column
 * @method     ChildEmployee[]|ObjectCollection findByStartdt(string $startDt) Return ChildEmployee objects filtered by the startDt column
 * @method     ChildEmployee[]|ObjectCollection findByGender(string $gender) Return ChildEmployee objects filtered by the gender column
 * @method     ChildEmployee[]|ObjectCollection findByTerminated(boolean $terminated) Return ChildEmployee objects filtered by the terminated column
 * @method     ChildEmployee[]|ObjectCollection findByDateofbirth(string $dateOfBirth) Return ChildEmployee objects filtered by the dateOfBirth column
 * @method     ChildEmployee[]|ObjectCollection findByMaritalstatus(string $maritalStatus) Return ChildEmployee objects filtered by the maritalStatus column
 * @method     ChildEmployee[]|ObjectCollection findBySpousefirstnm(string $spouseFirstNm) Return ChildEmployee objects filtered by the spouseFirstNm column
 * @method     ChildEmployee[]|ObjectCollection findBySpouselastnm(string $spouseLastNm) Return ChildEmployee objects filtered by the spouseLastNm column
 * @method     ChildEmployee[]|ObjectCollection findBySpousemobnbr(string $spouseMobNbr) Return ChildEmployee objects filtered by the spouseMobNbr column
 * @method     ChildEmployee[]|ObjectCollection findByPrevemployername(string $prevEmployerName) Return ChildEmployee objects filtered by the prevEmployerName column
 * @method     ChildEmployee[]|ObjectCollection findByPrevemployertelnbr(string $prevEmployerTelNbr) Return ChildEmployee objects filtered by the prevEmployerTelNbr column
 * @method     ChildEmployee[]|ObjectCollection findByPrevemployerstartdt(string $prevEmployerStartDt) Return ChildEmployee objects filtered by the prevEmployerStartDt column
 * @method     ChildEmployee[]|ObjectCollection findByPrevemployerenddt(string $prevEmployerEndDt) Return ChildEmployee objects filtered by the prevEmployerEndDt column
 * @method     ChildEmployee[]|ObjectCollection findByPrevemployerleavingreason(string $prevEmployerLeavingReason) Return ChildEmployee objects filtered by the prevEmployerLeavingReason column
 * @method     ChildEmployee[]|ObjectCollection findByPrevemployerlocation(string $prevEmployerLocation) Return ChildEmployee objects filtered by the prevEmployerLocation column
 * @method     ChildEmployee[]|ObjectCollection findByWorkdoneatprevemployer(string $workDoneAtPrevEmployer) Return ChildEmployee objects filtered by the workDoneAtPrevEmployer column
 * @method     ChildEmployee[]|ObjectCollection findByNxtofkinfirstnm(string $nxtOfKinFirstNm) Return ChildEmployee objects filtered by the nxtOfKinFirstNm column
 * @method     ChildEmployee[]|ObjectCollection findByNxtofkinlastnm(string $nxtOfKinLastNm) Return ChildEmployee objects filtered by the nxtOfKinLastNm column
 * @method     ChildEmployee[]|ObjectCollection findByNxtofkinmobilenbr(string $nxtOfKinMobileNbr) Return ChildEmployee objects filtered by the nxtOfKinMobileNbr column
 * @method     ChildEmployee[]|ObjectCollection findByNxtofkinresidence(string $nxtOfKinResidence) Return ChildEmployee objects filtered by the nxtOfKinResidence column
 * @method     ChildEmployee[]|ObjectCollection findByNxtofkinrelationship(string $nxtOfKinRelationship) Return ChildEmployee objects filtered by the nxtOfKinRelationship column
 * @method     ChildEmployee[]|ObjectCollection findByNxtofkinplaceofwork(string $nxtOfKinPlaceOfWork) Return ChildEmployee objects filtered by the nxtOfKinPlaceOfWork column
 * @method     ChildEmployee[]|ObjectCollection findByComment(string $comment) Return ChildEmployee objects filtered by the comment column
 * @method     ChildEmployee[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildEmployee objects filtered by the createTmstp column
 * @method     ChildEmployee[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildEmployee objects filtered by the updtTmstp column
 * @method     ChildEmployee[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmployeeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\EmployeeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Employee', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmployeeQuery) {
            return $criteria;
        }
        $query = new ChildEmployeeQuery();
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
     * @return ChildEmployee|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployee A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, firstName, middleInitial, lastName, nationalID, mobileNbr, resident, elecDeduction, ePayment, active, startDt, gender, terminated, dateOfBirth, maritalStatus, spouseFirstNm, spouseLastNm, spouseMobNbr, prevEmployerName, prevEmployerTelNbr, prevEmployerStartDt, prevEmployerEndDt, prevEmployerLeavingReason, prevEmployerLocation, workDoneAtPrevEmployer, nxtOfKinFirstNm, nxtOfKinLastNm, nxtOfKinMobileNbr, nxtOfKinResidence, nxtOfKinRelationship, nxtOfKinPlaceOfWork, comment, createTmstp, updtTmstp FROM employee WHERE oid = :p0';
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
            /** @var ChildEmployee $obj */
            $obj = new ChildEmployee();
            $obj->hydrate($row);
            EmployeeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployee|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmployeeTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmployeeTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the firstName column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstname('fooValue');   // WHERE firstName = 'fooValue'
     * $query->filterByFirstname('%fooValue%', Criteria::LIKE); // WHERE firstName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByFirstname($firstname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_FIRSTNAME, $firstname, $comparison);
    }

    /**
     * Filter the query on the middleInitial column
     *
     * Example usage:
     * <code>
     * $query->filterByMiddleinitial('fooValue');   // WHERE middleInitial = 'fooValue'
     * $query->filterByMiddleinitial('%fooValue%', Criteria::LIKE); // WHERE middleInitial LIKE '%fooValue%'
     * </code>
     *
     * @param     string $middleinitial The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByMiddleinitial($middleinitial = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($middleinitial)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_MIDDLEINITIAL, $middleinitial, $comparison);
    }

    /**
     * Filter the query on the lastName column
     *
     * Example usage:
     * <code>
     * $query->filterByLastname('fooValue');   // WHERE lastName = 'fooValue'
     * $query->filterByLastname('%fooValue%', Criteria::LIKE); // WHERE lastName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByLastname($lastname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_LASTNAME, $lastname, $comparison);
    }

    /**
     * Filter the query on the nationalID column
     *
     * Example usage:
     * <code>
     * $query->filterByNationalid('fooValue');   // WHERE nationalID = 'fooValue'
     * $query->filterByNationalid('%fooValue%', Criteria::LIKE); // WHERE nationalID LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nationalid The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByNationalid($nationalid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nationalid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_NATIONALID, $nationalid, $comparison);
    }

    /**
     * Filter the query on the mobileNbr column
     *
     * Example usage:
     * <code>
     * $query->filterByMobilenbr('fooValue');   // WHERE mobileNbr = 'fooValue'
     * $query->filterByMobilenbr('%fooValue%', Criteria::LIKE); // WHERE mobileNbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mobilenbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByMobilenbr($mobilenbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mobilenbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_MOBILENBR, $mobilenbr, $comparison);
    }

    /**
     * Filter the query on the resident column
     *
     * Example usage:
     * <code>
     * $query->filterByResident(true); // WHERE resident = true
     * $query->filterByResident('yes'); // WHERE resident = true
     * </code>
     *
     * @param     boolean|string $resident The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByResident($resident = null, $comparison = null)
    {
        if (is_string($resident)) {
            $resident = in_array(strtolower($resident), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_RESIDENT, $resident, $comparison);
    }

    /**
     * Filter the query on the elecDeduction column
     *
     * Example usage:
     * <code>
     * $query->filterByElecdeduction(true); // WHERE elecDeduction = true
     * $query->filterByElecdeduction('yes'); // WHERE elecDeduction = true
     * </code>
     *
     * @param     boolean|string $elecdeduction The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByElecdeduction($elecdeduction = null, $comparison = null)
    {
        if (is_string($elecdeduction)) {
            $elecdeduction = in_array(strtolower($elecdeduction), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_ELECDEDUCTION, $elecdeduction, $comparison);
    }

    /**
     * Filter the query on the ePayment column
     *
     * Example usage:
     * <code>
     * $query->filterByEpayment(true); // WHERE ePayment = true
     * $query->filterByEpayment('yes'); // WHERE ePayment = true
     * </code>
     *
     * @param     boolean|string $epayment The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByEpayment($epayment = null, $comparison = null)
    {
        if (is_string($epayment)) {
            $epayment = in_array(strtolower($epayment), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_EPAYMENT, $epayment, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the startDt column
     *
     * Example usage:
     * <code>
     * $query->filterByStartdt('2011-03-14'); // WHERE startDt = '2011-03-14'
     * $query->filterByStartdt('now'); // WHERE startDt = '2011-03-14'
     * $query->filterByStartdt(array('max' => 'yesterday')); // WHERE startDt > '2011-03-13'
     * </code>
     *
     * @param     mixed $startdt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByStartdt($startdt = null, $comparison = null)
    {
        if (is_array($startdt)) {
            $useMinMax = false;
            if (isset($startdt['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_STARTDT, $startdt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startdt['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_STARTDT, $startdt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_STARTDT, $startdt, $comparison);
    }

    /**
     * Filter the query on the gender column
     *
     * Example usage:
     * <code>
     * $query->filterByGender('fooValue');   // WHERE gender = 'fooValue'
     * $query->filterByGender('%fooValue%', Criteria::LIKE); // WHERE gender LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gender The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByGender($gender = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_GENDER, $gender, $comparison);
    }

    /**
     * Filter the query on the terminated column
     *
     * Example usage:
     * <code>
     * $query->filterByTerminated(true); // WHERE terminated = true
     * $query->filterByTerminated('yes'); // WHERE terminated = true
     * </code>
     *
     * @param     boolean|string $terminated The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByTerminated($terminated = null, $comparison = null)
    {
        if (is_string($terminated)) {
            $terminated = in_array(strtolower($terminated), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_TERMINATED, $terminated, $comparison);
    }

    /**
     * Filter the query on the dateOfBirth column
     *
     * Example usage:
     * <code>
     * $query->filterByDateofbirth('2011-03-14'); // WHERE dateOfBirth = '2011-03-14'
     * $query->filterByDateofbirth('now'); // WHERE dateOfBirth = '2011-03-14'
     * $query->filterByDateofbirth(array('max' => 'yesterday')); // WHERE dateOfBirth > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateofbirth The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByDateofbirth($dateofbirth = null, $comparison = null)
    {
        if (is_array($dateofbirth)) {
            $useMinMax = false;
            if (isset($dateofbirth['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_DATEOFBIRTH, $dateofbirth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateofbirth['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_DATEOFBIRTH, $dateofbirth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_DATEOFBIRTH, $dateofbirth, $comparison);
    }

    /**
     * Filter the query on the maritalStatus column
     *
     * Example usage:
     * <code>
     * $query->filterByMaritalstatus('fooValue');   // WHERE maritalStatus = 'fooValue'
     * $query->filterByMaritalstatus('%fooValue%', Criteria::LIKE); // WHERE maritalStatus LIKE '%fooValue%'
     * </code>
     *
     * @param     string $maritalstatus The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByMaritalstatus($maritalstatus = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($maritalstatus)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_MARITALSTATUS, $maritalstatus, $comparison);
    }

    /**
     * Filter the query on the spouseFirstNm column
     *
     * Example usage:
     * <code>
     * $query->filterBySpousefirstnm('fooValue');   // WHERE spouseFirstNm = 'fooValue'
     * $query->filterBySpousefirstnm('%fooValue%', Criteria::LIKE); // WHERE spouseFirstNm LIKE '%fooValue%'
     * </code>
     *
     * @param     string $spousefirstnm The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterBySpousefirstnm($spousefirstnm = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($spousefirstnm)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_SPOUSEFIRSTNM, $spousefirstnm, $comparison);
    }

    /**
     * Filter the query on the spouseLastNm column
     *
     * Example usage:
     * <code>
     * $query->filterBySpouselastnm('fooValue');   // WHERE spouseLastNm = 'fooValue'
     * $query->filterBySpouselastnm('%fooValue%', Criteria::LIKE); // WHERE spouseLastNm LIKE '%fooValue%'
     * </code>
     *
     * @param     string $spouselastnm The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterBySpouselastnm($spouselastnm = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($spouselastnm)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_SPOUSELASTNM, $spouselastnm, $comparison);
    }

    /**
     * Filter the query on the spouseMobNbr column
     *
     * Example usage:
     * <code>
     * $query->filterBySpousemobnbr('fooValue');   // WHERE spouseMobNbr = 'fooValue'
     * $query->filterBySpousemobnbr('%fooValue%', Criteria::LIKE); // WHERE spouseMobNbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $spousemobnbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterBySpousemobnbr($spousemobnbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($spousemobnbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_SPOUSEMOBNBR, $spousemobnbr, $comparison);
    }

    /**
     * Filter the query on the prevEmployerName column
     *
     * Example usage:
     * <code>
     * $query->filterByPrevemployername('fooValue');   // WHERE prevEmployerName = 'fooValue'
     * $query->filterByPrevemployername('%fooValue%', Criteria::LIKE); // WHERE prevEmployerName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $prevemployername The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByPrevemployername($prevemployername = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($prevemployername)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_PREVEMPLOYERNAME, $prevemployername, $comparison);
    }

    /**
     * Filter the query on the prevEmployerTelNbr column
     *
     * Example usage:
     * <code>
     * $query->filterByPrevemployertelnbr('fooValue');   // WHERE prevEmployerTelNbr = 'fooValue'
     * $query->filterByPrevemployertelnbr('%fooValue%', Criteria::LIKE); // WHERE prevEmployerTelNbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $prevemployertelnbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByPrevemployertelnbr($prevemployertelnbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($prevemployertelnbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_PREVEMPLOYERTELNBR, $prevemployertelnbr, $comparison);
    }

    /**
     * Filter the query on the prevEmployerStartDt column
     *
     * Example usage:
     * <code>
     * $query->filterByPrevemployerstartdt('2011-03-14'); // WHERE prevEmployerStartDt = '2011-03-14'
     * $query->filterByPrevemployerstartdt('now'); // WHERE prevEmployerStartDt = '2011-03-14'
     * $query->filterByPrevemployerstartdt(array('max' => 'yesterday')); // WHERE prevEmployerStartDt > '2011-03-13'
     * </code>
     *
     * @param     mixed $prevemployerstartdt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByPrevemployerstartdt($prevemployerstartdt = null, $comparison = null)
    {
        if (is_array($prevemployerstartdt)) {
            $useMinMax = false;
            if (isset($prevemployerstartdt['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_PREVEMPLOYERSTARTDT, $prevemployerstartdt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prevemployerstartdt['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_PREVEMPLOYERSTARTDT, $prevemployerstartdt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_PREVEMPLOYERSTARTDT, $prevemployerstartdt, $comparison);
    }

    /**
     * Filter the query on the prevEmployerEndDt column
     *
     * Example usage:
     * <code>
     * $query->filterByPrevemployerenddt('2011-03-14'); // WHERE prevEmployerEndDt = '2011-03-14'
     * $query->filterByPrevemployerenddt('now'); // WHERE prevEmployerEndDt = '2011-03-14'
     * $query->filterByPrevemployerenddt(array('max' => 'yesterday')); // WHERE prevEmployerEndDt > '2011-03-13'
     * </code>
     *
     * @param     mixed $prevemployerenddt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByPrevemployerenddt($prevemployerenddt = null, $comparison = null)
    {
        if (is_array($prevemployerenddt)) {
            $useMinMax = false;
            if (isset($prevemployerenddt['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_PREVEMPLOYERENDDT, $prevemployerenddt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prevemployerenddt['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_PREVEMPLOYERENDDT, $prevemployerenddt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_PREVEMPLOYERENDDT, $prevemployerenddt, $comparison);
    }

    /**
     * Filter the query on the prevEmployerLeavingReason column
     *
     * Example usage:
     * <code>
     * $query->filterByPrevemployerleavingreason('fooValue');   // WHERE prevEmployerLeavingReason = 'fooValue'
     * $query->filterByPrevemployerleavingreason('%fooValue%', Criteria::LIKE); // WHERE prevEmployerLeavingReason LIKE '%fooValue%'
     * </code>
     *
     * @param     string $prevemployerleavingreason The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByPrevemployerleavingreason($prevemployerleavingreason = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($prevemployerleavingreason)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_PREVEMPLOYERLEAVINGREASON, $prevemployerleavingreason, $comparison);
    }

    /**
     * Filter the query on the prevEmployerLocation column
     *
     * Example usage:
     * <code>
     * $query->filterByPrevemployerlocation('fooValue');   // WHERE prevEmployerLocation = 'fooValue'
     * $query->filterByPrevemployerlocation('%fooValue%', Criteria::LIKE); // WHERE prevEmployerLocation LIKE '%fooValue%'
     * </code>
     *
     * @param     string $prevemployerlocation The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByPrevemployerlocation($prevemployerlocation = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($prevemployerlocation)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_PREVEMPLOYERLOCATION, $prevemployerlocation, $comparison);
    }

    /**
     * Filter the query on the workDoneAtPrevEmployer column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkdoneatprevemployer('fooValue');   // WHERE workDoneAtPrevEmployer = 'fooValue'
     * $query->filterByWorkdoneatprevemployer('%fooValue%', Criteria::LIKE); // WHERE workDoneAtPrevEmployer LIKE '%fooValue%'
     * </code>
     *
     * @param     string $workdoneatprevemployer The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByWorkdoneatprevemployer($workdoneatprevemployer = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($workdoneatprevemployer)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_WORKDONEATPREVEMPLOYER, $workdoneatprevemployer, $comparison);
    }

    /**
     * Filter the query on the nxtOfKinFirstNm column
     *
     * Example usage:
     * <code>
     * $query->filterByNxtofkinfirstnm('fooValue');   // WHERE nxtOfKinFirstNm = 'fooValue'
     * $query->filterByNxtofkinfirstnm('%fooValue%', Criteria::LIKE); // WHERE nxtOfKinFirstNm LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nxtofkinfirstnm The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByNxtofkinfirstnm($nxtofkinfirstnm = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nxtofkinfirstnm)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_NXTOFKINFIRSTNM, $nxtofkinfirstnm, $comparison);
    }

    /**
     * Filter the query on the nxtOfKinLastNm column
     *
     * Example usage:
     * <code>
     * $query->filterByNxtofkinlastnm('fooValue');   // WHERE nxtOfKinLastNm = 'fooValue'
     * $query->filterByNxtofkinlastnm('%fooValue%', Criteria::LIKE); // WHERE nxtOfKinLastNm LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nxtofkinlastnm The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByNxtofkinlastnm($nxtofkinlastnm = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nxtofkinlastnm)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_NXTOFKINLASTNM, $nxtofkinlastnm, $comparison);
    }

    /**
     * Filter the query on the nxtOfKinMobileNbr column
     *
     * Example usage:
     * <code>
     * $query->filterByNxtofkinmobilenbr('fooValue');   // WHERE nxtOfKinMobileNbr = 'fooValue'
     * $query->filterByNxtofkinmobilenbr('%fooValue%', Criteria::LIKE); // WHERE nxtOfKinMobileNbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nxtofkinmobilenbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByNxtofkinmobilenbr($nxtofkinmobilenbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nxtofkinmobilenbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_NXTOFKINMOBILENBR, $nxtofkinmobilenbr, $comparison);
    }

    /**
     * Filter the query on the nxtOfKinResidence column
     *
     * Example usage:
     * <code>
     * $query->filterByNxtofkinresidence('fooValue');   // WHERE nxtOfKinResidence = 'fooValue'
     * $query->filterByNxtofkinresidence('%fooValue%', Criteria::LIKE); // WHERE nxtOfKinResidence LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nxtofkinresidence The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByNxtofkinresidence($nxtofkinresidence = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nxtofkinresidence)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_NXTOFKINRESIDENCE, $nxtofkinresidence, $comparison);
    }

    /**
     * Filter the query on the nxtOfKinRelationship column
     *
     * Example usage:
     * <code>
     * $query->filterByNxtofkinrelationship('fooValue');   // WHERE nxtOfKinRelationship = 'fooValue'
     * $query->filterByNxtofkinrelationship('%fooValue%', Criteria::LIKE); // WHERE nxtOfKinRelationship LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nxtofkinrelationship The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByNxtofkinrelationship($nxtofkinrelationship = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nxtofkinrelationship)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_NXTOFKINRELATIONSHIP, $nxtofkinrelationship, $comparison);
    }

    /**
     * Filter the query on the nxtOfKinPlaceOfWork column
     *
     * Example usage:
     * <code>
     * $query->filterByNxtofkinplaceofwork('fooValue');   // WHERE nxtOfKinPlaceOfWork = 'fooValue'
     * $query->filterByNxtofkinplaceofwork('%fooValue%', Criteria::LIKE); // WHERE nxtOfKinPlaceOfWork LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nxtofkinplaceofwork The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByNxtofkinplaceofwork($nxtofkinplaceofwork = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nxtofkinplaceofwork)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_NXTOFKINPLACEOFWORK, $nxtofkinplaceofwork, $comparison);
    }

    /**
     * Filter the query on the comment column
     *
     * Example usage:
     * <code>
     * $query->filterByComment('fooValue');   // WHERE comment = 'fooValue'
     * $query->filterByComment('%fooValue%', Criteria::LIKE); // WHERE comment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $comment The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByComment($comment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comment)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_COMMENT, $comment, $comparison);
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
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Attendance object
     *
     * @param \lwops\lwops\Attendance|ObjectCollection $attendance the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByAttendance($attendance, $comparison = null)
    {
        if ($attendance instanceof \lwops\lwops\Attendance) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_OID, $attendance->getEmployeeoid(), $comparison);
        } elseif ($attendance instanceof ObjectCollection) {
            return $this
                ->useAttendanceQuery()
                ->filterByPrimaryKeys($attendance->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAttendance() only accepts arguments of type \lwops\lwops\Attendance or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Attendance relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinAttendance($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Attendance');

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
            $this->addJoinObject($join, 'Attendance');
        }

        return $this;
    }

    /**
     * Use the Attendance relation Attendance object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\AttendanceQuery A secondary query class using the current class as primary query
     */
    public function useAttendanceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAttendance($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Attendance', '\lwops\lwops\AttendanceQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Casualemployeepayslip object
     *
     * @param \lwops\lwops\Casualemployeepayslip|ObjectCollection $casualemployeepayslip the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByCasualemployeepayslip($casualemployeepayslip, $comparison = null)
    {
        if ($casualemployeepayslip instanceof \lwops\lwops\Casualemployeepayslip) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_OID, $casualemployeepayslip->getEmployeeoid(), $comparison);
        } elseif ($casualemployeepayslip instanceof ObjectCollection) {
            return $this
                ->useCasualemployeepayslipQuery()
                ->filterByPrimaryKeys($casualemployeepayslip->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCasualemployeepayslip() only accepts arguments of type \lwops\lwops\Casualemployeepayslip or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Casualemployeepayslip relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinCasualemployeepayslip($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Casualemployeepayslip');

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
            $this->addJoinObject($join, 'Casualemployeepayslip');
        }

        return $this;
    }

    /**
     * Use the Casualemployeepayslip relation Casualemployeepayslip object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\CasualemployeepayslipQuery A secondary query class using the current class as primary query
     */
    public function useCasualemployeepayslipQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCasualemployeepayslip($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Casualemployeepayslip', '\lwops\lwops\CasualemployeepayslipQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeeloan object
     *
     * @param \lwops\lwops\Employeeloan|ObjectCollection $employeeloan the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByEmployeeloan($employeeloan, $comparison = null)
    {
        if ($employeeloan instanceof \lwops\lwops\Employeeloan) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_OID, $employeeloan->getEmployeeoid(), $comparison);
        } elseif ($employeeloan instanceof ObjectCollection) {
            return $this
                ->useEmployeeloanQuery()
                ->filterByPrimaryKeys($employeeloan->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEmployeeloan() only accepts arguments of type \lwops\lwops\Employeeloan or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employeeloan relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinEmployeeloan($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employeeloan');

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
            $this->addJoinObject($join, 'Employeeloan');
        }

        return $this;
    }

    /**
     * Use the Employeeloan relation Employeeloan object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeeloanQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeloanQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeeloan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employeeloan', '\lwops\lwops\EmployeeloanQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeeotherdeduction object
     *
     * @param \lwops\lwops\Employeeotherdeduction|ObjectCollection $employeeotherdeduction the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByEmployeeotherdeduction($employeeotherdeduction, $comparison = null)
    {
        if ($employeeotherdeduction instanceof \lwops\lwops\Employeeotherdeduction) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_OID, $employeeotherdeduction->getEmployeeoid(), $comparison);
        } elseif ($employeeotherdeduction instanceof ObjectCollection) {
            return $this
                ->useEmployeeotherdeductionQuery()
                ->filterByPrimaryKeys($employeeotherdeduction->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEmployeeotherdeduction() only accepts arguments of type \lwops\lwops\Employeeotherdeduction or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employeeotherdeduction relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinEmployeeotherdeduction($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employeeotherdeduction');

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
            $this->addJoinObject($join, 'Employeeotherdeduction');
        }

        return $this;
    }

    /**
     * Use the Employeeotherdeduction relation Employeeotherdeduction object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeeotherdeductionQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeotherdeductionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeeotherdeduction($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employeeotherdeduction', '\lwops\lwops\EmployeeotherdeductionQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeepurchases object
     *
     * @param \lwops\lwops\Employeepurchases|ObjectCollection $employeepurchases the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByEmployeepurchases($employeepurchases, $comparison = null)
    {
        if ($employeepurchases instanceof \lwops\lwops\Employeepurchases) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_OID, $employeepurchases->getEmployeeoid(), $comparison);
        } elseif ($employeepurchases instanceof ObjectCollection) {
            return $this
                ->useEmployeepurchasesQuery()
                ->filterByPrimaryKeys($employeepurchases->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEmployeepurchases() only accepts arguments of type \lwops\lwops\Employeepurchases or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employeepurchases relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinEmployeepurchases($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employeepurchases');

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
            $this->addJoinObject($join, 'Employeepurchases');
        }

        return $this;
    }

    /**
     * Use the Employeepurchases relation Employeepurchases object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeepurchasesQuery A secondary query class using the current class as primary query
     */
    public function useEmployeepurchasesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeepurchases($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employeepurchases', '\lwops\lwops\EmployeepurchasesQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeerole object
     *
     * @param \lwops\lwops\Employeerole|ObjectCollection $employeerole the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByEmployeerole($employeerole, $comparison = null)
    {
        if ($employeerole instanceof \lwops\lwops\Employeerole) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_OID, $employeerole->getEmployeeoid(), $comparison);
        } elseif ($employeerole instanceof ObjectCollection) {
            return $this
                ->useEmployeeroleQuery()
                ->filterByPrimaryKeys($employeerole->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEmployeerole() only accepts arguments of type \lwops\lwops\Employeerole or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employeerole relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinEmployeerole($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employeerole');

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
            $this->addJoinObject($join, 'Employeerole');
        }

        return $this;
    }

    /**
     * Use the Employeerole relation Employeerole object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeeroleQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeroleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeerole($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employeerole', '\lwops\lwops\EmployeeroleQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeesalaryexpenseallocation object
     *
     * @param \lwops\lwops\Employeesalaryexpenseallocation|ObjectCollection $employeesalaryexpenseallocation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByEmployeesalaryexpenseallocation($employeesalaryexpenseallocation, $comparison = null)
    {
        if ($employeesalaryexpenseallocation instanceof \lwops\lwops\Employeesalaryexpenseallocation) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_OID, $employeesalaryexpenseallocation->getEmployeeoid(), $comparison);
        } elseif ($employeesalaryexpenseallocation instanceof ObjectCollection) {
            return $this
                ->useEmployeesalaryexpenseallocationQuery()
                ->filterByPrimaryKeys($employeesalaryexpenseallocation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEmployeesalaryexpenseallocation() only accepts arguments of type \lwops\lwops\Employeesalaryexpenseallocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employeesalaryexpenseallocation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinEmployeesalaryexpenseallocation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employeesalaryexpenseallocation');

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
            $this->addJoinObject($join, 'Employeesalaryexpenseallocation');
        }

        return $this;
    }

    /**
     * Use the Employeesalaryexpenseallocation relation Employeesalaryexpenseallocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeesalaryexpenseallocationQuery A secondary query class using the current class as primary query
     */
    public function useEmployeesalaryexpenseallocationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeesalaryexpenseallocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employeesalaryexpenseallocation', '\lwops\lwops\EmployeesalaryexpenseallocationQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeetermination object
     *
     * @param \lwops\lwops\Employeetermination|ObjectCollection $employeetermination the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByEmployeetermination($employeetermination, $comparison = null)
    {
        if ($employeetermination instanceof \lwops\lwops\Employeetermination) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_OID, $employeetermination->getEmployeeoid(), $comparison);
        } elseif ($employeetermination instanceof ObjectCollection) {
            return $this
                ->useEmployeeterminationQuery()
                ->filterByPrimaryKeys($employeetermination->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEmployeetermination() only accepts arguments of type \lwops\lwops\Employeetermination or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employeetermination relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinEmployeetermination($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employeetermination');

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
            $this->addJoinObject($join, 'Employeetermination');
        }

        return $this;
    }

    /**
     * Use the Employeetermination relation Employeetermination object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\EmployeeterminationQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeterminationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeetermination($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employeetermination', '\lwops\lwops\EmployeeterminationQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Fteemployeepayslip object
     *
     * @param \lwops\lwops\Fteemployeepayslip|ObjectCollection $fteemployeepayslip the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByFteemployeepayslip($fteemployeepayslip, $comparison = null)
    {
        if ($fteemployeepayslip instanceof \lwops\lwops\Fteemployeepayslip) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_OID, $fteemployeepayslip->getEmployeeoid(), $comparison);
        } elseif ($fteemployeepayslip instanceof ObjectCollection) {
            return $this
                ->useFteemployeepayslipQuery()
                ->filterByPrimaryKeys($fteemployeepayslip->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFteemployeepayslip() only accepts arguments of type \lwops\lwops\Fteemployeepayslip or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fteemployeepayslip relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinFteemployeepayslip($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fteemployeepayslip');

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
            $this->addJoinObject($join, 'Fteemployeepayslip');
        }

        return $this;
    }

    /**
     * Use the Fteemployeepayslip relation Fteemployeepayslip object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\FteemployeepayslipQuery A secondary query class using the current class as primary query
     */
    public function useFteemployeepayslipQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFteemployeepayslip($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fteemployeepayslip', '\lwops\lwops\FteemployeepayslipQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Ftesalaryadvance object
     *
     * @param \lwops\lwops\Ftesalaryadvance|ObjectCollection $ftesalaryadvance the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByFtesalaryadvance($ftesalaryadvance, $comparison = null)
    {
        if ($ftesalaryadvance instanceof \lwops\lwops\Ftesalaryadvance) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_OID, $ftesalaryadvance->getEmployeeoid(), $comparison);
        } elseif ($ftesalaryadvance instanceof ObjectCollection) {
            return $this
                ->useFtesalaryadvanceQuery()
                ->filterByPrimaryKeys($ftesalaryadvance->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFtesalaryadvance() only accepts arguments of type \lwops\lwops\Ftesalaryadvance or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ftesalaryadvance relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinFtesalaryadvance($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ftesalaryadvance');

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
            $this->addJoinObject($join, 'Ftesalaryadvance');
        }

        return $this;
    }

    /**
     * Use the Ftesalaryadvance relation Ftesalaryadvance object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\FtesalaryadvanceQuery A secondary query class using the current class as primary query
     */
    public function useFtesalaryadvanceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFtesalaryadvance($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ftesalaryadvance', '\lwops\lwops\FtesalaryadvanceQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Medicaldeduction object
     *
     * @param \lwops\lwops\Medicaldeduction|ObjectCollection $medicaldeduction the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByMedicaldeduction($medicaldeduction, $comparison = null)
    {
        if ($medicaldeduction instanceof \lwops\lwops\Medicaldeduction) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_OID, $medicaldeduction->getEmployeeoid(), $comparison);
        } elseif ($medicaldeduction instanceof ObjectCollection) {
            return $this
                ->useMedicaldeductionQuery()
                ->filterByPrimaryKeys($medicaldeduction->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMedicaldeduction() only accepts arguments of type \lwops\lwops\Medicaldeduction or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Medicaldeduction relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinMedicaldeduction($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Medicaldeduction');

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
            $this->addJoinObject($join, 'Medicaldeduction');
        }

        return $this;
    }

    /**
     * Use the Medicaldeduction relation Medicaldeduction object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\MedicaldeductionQuery A secondary query class using the current class as primary query
     */
    public function useMedicaldeductionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMedicaldeduction($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Medicaldeduction', '\lwops\lwops\MedicaldeductionQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Nssfdeduction object
     *
     * @param \lwops\lwops\Nssfdeduction|ObjectCollection $nssfdeduction the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByNssfdeduction($nssfdeduction, $comparison = null)
    {
        if ($nssfdeduction instanceof \lwops\lwops\Nssfdeduction) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_OID, $nssfdeduction->getEmployeeoid(), $comparison);
        } elseif ($nssfdeduction instanceof ObjectCollection) {
            return $this
                ->useNssfdeductionQuery()
                ->filterByPrimaryKeys($nssfdeduction->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNssfdeduction() only accepts arguments of type \lwops\lwops\Nssfdeduction or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Nssfdeduction relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinNssfdeduction($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Nssfdeduction');

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
            $this->addJoinObject($join, 'Nssfdeduction');
        }

        return $this;
    }

    /**
     * Use the Nssfdeduction relation Nssfdeduction object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\NssfdeductionQuery A secondary query class using the current class as primary query
     */
    public function useNssfdeductionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNssfdeduction($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Nssfdeduction', '\lwops\lwops\NssfdeductionQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Parttimedetail object
     *
     * @param \lwops\lwops\Parttimedetail|ObjectCollection $parttimedetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByParttimedetail($parttimedetail, $comparison = null)
    {
        if ($parttimedetail instanceof \lwops\lwops\Parttimedetail) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_OID, $parttimedetail->getEmployeeoid(), $comparison);
        } elseif ($parttimedetail instanceof ObjectCollection) {
            return $this
                ->useParttimedetailQuery()
                ->filterByPrimaryKeys($parttimedetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByParttimedetail() only accepts arguments of type \lwops\lwops\Parttimedetail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Parttimedetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinParttimedetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Parttimedetail');

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
            $this->addJoinObject($join, 'Parttimedetail');
        }

        return $this;
    }

    /**
     * Use the Parttimedetail relation Parttimedetail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\ParttimedetailQuery A secondary query class using the current class as primary query
     */
    public function useParttimedetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinParttimedetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Parttimedetail', '\lwops\lwops\ParttimedetailQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Salary object
     *
     * @param \lwops\lwops\Salary|ObjectCollection $salary the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterBySalary($salary, $comparison = null)
    {
        if ($salary instanceof \lwops\lwops\Salary) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_OID, $salary->getEmployeeoid(), $comparison);
        } elseif ($salary instanceof ObjectCollection) {
            return $this
                ->useSalaryQuery()
                ->filterByPrimaryKeys($salary->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySalary() only accepts arguments of type \lwops\lwops\Salary or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Salary relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinSalary($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Salary');

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
            $this->addJoinObject($join, 'Salary');
        }

        return $this;
    }

    /**
     * Use the Salary relation Salary object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\SalaryQuery A secondary query class using the current class as primary query
     */
    public function useSalaryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSalary($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Salary', '\lwops\lwops\SalaryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEmployee $employee Object to remove from the list of results
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function prune($employee = null)
    {
        if ($employee) {
            $this->addUsingAlias(EmployeeTableMap::COL_OID, $employee->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employee table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeeTableMap::clearInstancePool();
            EmployeeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmployeeQuery
