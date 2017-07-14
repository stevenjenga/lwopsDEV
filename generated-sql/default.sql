
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- attendance
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `attendance`;

CREATE TABLE `attendance`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `employeeOid` INTEGER NOT NULL,
    `attendanceDt` DATETIME NOT NULL,
    `attendance_in` INTEGER DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    UNIQUE INDEX `attendanceDt_UNIQUE` (`attendanceDt`, `employeeOid`),
    INDEX `employeeOidFK_idx` (`employeeOid`),
    CONSTRAINT `employeeOidFK`
        FOREIGN KEY (`employeeOid`)
        REFERENCES `employee` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- casualemployeepayslip
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `casualemployeepayslip`;

CREATE TABLE `casualemployeepayslip`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `opsBiWeeklyCalendarOid` INTEGER NOT NULL,
    `employeeOid` INTEGER NOT NULL,
    `dailyRate` FLOAT DEFAULT 0 NOT NULL,
    `totalTeaWeight` FLOAT DEFAULT 0 NOT NULL,
    `teaPayRate` FLOAT NOT NULL,
    `teaPay` FLOAT DEFAULT 0 NOT NULL,
    `totalParttimeHrs` FLOAT DEFAULT 0 NOT NULL,
    `parttimePayRate` FLOAT DEFAULT 0 NOT NULL,
    `parttimePay` FLOAT DEFAULT 0 NOT NULL,
    `otherDaysWorked` INTEGER(2) DEFAULT 0 NOT NULL,
    `otherHoursWorked` FLOAT DEFAULT 0 NOT NULL,
    `otherworkPay` FLOAT DEFAULT 0 NOT NULL,
    `elecDeduction` FLOAT DEFAULT 0 NOT NULL,
    `medicalDeduction` FLOAT DEFAULT 0 NOT NULL,
    `NSSFdeduction` FLOAT DEFAULT 0 NOT NULL,
    `purchasesDeduction` FLOAT DEFAULT 0 NOT NULL,
    `otherDeduction` FLOAT DEFAULT 0 NOT NULL,
    `otherDeductionDescr` VARCHAR(100),
    `bonus` FLOAT DEFAULT 0 NOT NULL,
    `lockDt` DATE,
    `payslipNbr` VARCHAR(15) DEFAULT 'F-PS-0000000000' NOT NULL,
    `lockedFlg` TINYINT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_EmployeePayRoll_OpsBiWeeklyCalendar1_idx` (`opsBiWeeklyCalendarOid`),
    INDEX `fk_EmployeePaySlip_Employee1_idx` (`employeeOid`),
    CONSTRAINT `fk_EmployeePayRoll_OpsBiWeeklyCalendar1`
        FOREIGN KEY (`opsBiWeeklyCalendarOid`)
        REFERENCES `opsbiweeklycalendar` (`oid`),
    CONSTRAINT `fk_EmployeePaySlip_Employee1`
        FOREIGN KEY (`employeeOid`)
        REFERENCES `employee` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- customer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `gr_id` VARCHAR(255) NOT NULL,
    `businessName` VARCHAR(100) DEFAULT 'INDIVIDUAL' NOT NULL,
    `storeNameNbr` VARCHAR(10) DEFAULT '00000' NOT NULL,
    `contactFirstName` VARCHAR(20) NOT NULL,
    `contactLastName` VARCHAR(20) NOT NULL,
    `mobileNbr` VARCHAR(10) DEFAULT '0725551212' NOT NULL,
    `address1` VARCHAR(100) DEFAULT 'TBD' NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- dairycowname
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `dairycowname`;

CREATE TABLE `dairycowname`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `birthDt` DATETIME,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- dairypandl
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `dairypandl`;

CREATE TABLE `dairypandl`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `lineOfBusinessOid` INTEGER NOT NULL,
    `opsMonthlyCalendarOid` INTEGER NOT NULL,
    `purchases` FLOAT DEFAULT 0 NOT NULL,
    `otherPurchases` FLOAT DEFAULT 0 NOT NULL,
    `cooperativeDeductions` FLOAT DEFAULT 0 NOT NULL,
    `labourParttimeExpense` FLOAT DEFAULT 0 NOT NULL,
    `generalExpenses` FLOAT DEFAULT 0 NOT NULL,
    `elecExpenses` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_PandL_LineOfBusiness1_idx` (`lineOfBusinessOid`),
    INDEX `fk_PandLincome_OpsMonthlyCalendar1_idx` (`opsMonthlyCalendarOid`),
    CONSTRAINT `fk_PandL_LineOfBusiness10`
        FOREIGN KEY (`lineOfBusinessOid`)
        REFERENCES `lineofbusiness` (`oid`),
    CONSTRAINT `fk_PandLincome_OpsMonthlyCalendar10`
        FOREIGN KEY (`opsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- dairypandllabourexpensedetail
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `dairypandllabourexpensedetail`;

CREATE TABLE `dairypandllabourexpensedetail`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `DairyPandLOid` INTEGER NOT NULL,
    `EmployeeRoleOid` INTEGER NOT NULL,
    `expenseAmount` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_TeaPandLlabourExpenseDetail_EmployeeRole1_idx` (`EmployeeRoleOid`),
    INDEX `fk_DairyPandLlabourExpenseDetail_DairyPandL1_idx` (`DairyPandLOid`),
    CONSTRAINT `fk_DairyPandLlabourExpenseDetail_DairyPandL1`
        FOREIGN KEY (`DairyPandLOid`)
        REFERENCES `dairypandl` (`oid`),
    CONSTRAINT `fk_TeaPandLlabourExpenseDetail_EmployeeRole1`
        FOREIGN KEY (`EmployeeRoleOid`)
        REFERENCES `employeeroletype` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- dairyproduction
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `dairyproduction`;

CREATE TABLE `dairyproduction`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `gr_id` VARCHAR(255) NOT NULL,
    `DairyCowNameOid` INTEGER NOT NULL,
    `prodDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `amVolume` FLOAT DEFAULT 0,
    `mdVolume` FLOAT DEFAULT 0,
    `pmVolume` FLOAT DEFAULT 0,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_DairyProduction_DairyCowNames1_idx` (`DairyCowNameOid`),
    CONSTRAINT `fk_DairyProduction_DairyCowNames1`
        FOREIGN KEY (`DairyCowNameOid`)
        REFERENCES `dairycowname` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- dairysales
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `dairysales`;

CREATE TABLE `dairysales`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `salesDt` DATE NOT NULL,
    `customerOid` INTEGER NOT NULL,
    `volume` VARCHAR(45) NOT NULL,
    `pricePerLiter` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_DairySales_Customer1_idx` (`customerOid`),
    CONSTRAINT `fk_DairySales_Customer1`
        FOREIGN KEY (`customerOid`)
        REFERENCES `customer` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- elecdeductionrate
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `elecdeductionrate`;

CREATE TABLE `elecdeductionrate`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `rate` FLOAT NOT NULL,
    `startDt` DATETIME NOT NULL,
    `endDt` DATETIME,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    UNIQUE INDEX `startDt_UNIQUE` (`startDt`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- electricityaccount
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `electricityaccount`;

CREATE TABLE `electricityaccount`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `accountNbr` VARCHAR(45) DEFAULT '00000',
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    UNIQUE INDEX `accountNbr_UNIQUE` (`accountNbr`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- electricityallocation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `electricityallocation`;

CREATE TABLE `electricityallocation`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `lineOfBusinessOid` INTEGER NOT NULL,
    `electricityAccountOid` INTEGER DEFAULT 1 NOT NULL,
    `allocation` INTEGER(2) DEFAULT 0 NOT NULL,
    `startOpsMonthlyCalendarOid` INTEGER NOT NULL,
    `endtOpsMonthlyCalendarOid` INTEGER,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    UNIQUE INDEX `effectiveDateRange_UNIQUE` (`endtOpsMonthlyCalendarOid`, `startOpsMonthlyCalendarOid`),
    INDEX `fk_ElectricityAllocation_LineOfBusiness1_idx` (`lineOfBusinessOid`),
    INDEX `fk_ElectricityAllocation_ElectricityAccount1_idx` (`electricityAccountOid`),
    INDEX `fk_ElectricityAllocation_OpsMonthlyCalendar2_idx` (`endtOpsMonthlyCalendarOid`),
    INDEX `fk_ElectricityAllocation_OpsMonthlyCalendar1_idx` (`startOpsMonthlyCalendarOid`),
    CONSTRAINT `fk_ElectricityAllocation_ElectricityAccount1`
        FOREIGN KEY (`electricityAccountOid`)
        REFERENCES `electricityaccount` (`oid`),
    CONSTRAINT `fk_ElectricityAllocation_LineOfBusiness1`
        FOREIGN KEY (`lineOfBusinessOid`)
        REFERENCES `lineofbusiness` (`oid`),
    CONSTRAINT `fk_ElectricityAllocation_OpsMonthlyCalendar1`
        FOREIGN KEY (`startOpsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`),
    CONSTRAINT `fk_ElectricityAllocation_OpsMonthlyCalendar2`
        FOREIGN KEY (`endtOpsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- electricityexpense
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `electricityexpense`;

CREATE TABLE `electricityexpense`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `opsMonthlyCalendarOid` INTEGER NOT NULL,
    `electricityAccounOid` INTEGER NOT NULL,
    `amount` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    UNIQUE INDEX `opsMonthlyCalendarOid_UNIQUE` (`opsMonthlyCalendarOid`, `electricityAccounOid`),
    INDEX `fk_ElectricityExpense_ElectricityAccount1_idx` (`electricityAccounOid`),
    INDEX `fk_ElectricityExpense_OpsMonthlyCalendar1_idx` (`opsMonthlyCalendarOid`),
    CONSTRAINT `fk_ElectricityExpense_ElectricityAccount1`
        FOREIGN KEY (`electricityAccounOid`)
        REFERENCES `electricityaccount` (`oid`),
    CONSTRAINT `fk_ElectricityExpense_OpsMonthlyCalendar1`
        FOREIGN KEY (`opsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- employee
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(20) NOT NULL,
    `middleInitial` VARCHAR(1) DEFAULT 'X',
    `lastName` VARCHAR(20) NOT NULL,
    `nationalID` CHAR(10) DEFAULT '1000000001' NOT NULL,
    `mobileNbr` CHAR(10) DEFAULT '0720000000' NOT NULL,
    `resident` TINYINT(1) DEFAULT 0 NOT NULL,
    `elecDeduction` TINYINT(1) DEFAULT 1 NOT NULL,
    `ePayment` TINYINT(1) DEFAULT 0 NOT NULL,
    `active` TINYINT(1) DEFAULT 1 NOT NULL,
    `startDt` DATE NOT NULL,
    `gender` CHAR DEFAULT 'M' NOT NULL,
    `terminated` TINYINT(1) DEFAULT 0 NOT NULL,
    `dateOfBirth` DATE NOT NULL,
    `maritalStatus` VARCHAR(1) NOT NULL,
    `spouseFirstNm` VARCHAR(45),
    `spouseLastNm` VARCHAR(45),
    `spouseMobNbr` VARCHAR(10),
    `prevEmployerName` VARCHAR(45) NOT NULL,
    `prevEmployerTelNbr` VARCHAR(45) NOT NULL,
    `prevEmployerStartDt` DATE NOT NULL,
    `prevEmployerEndDt` DATE NOT NULL,
    `prevEmployerLeavingReason` VARCHAR(100) NOT NULL,
    `prevEmployerLocation` VARCHAR(100) NOT NULL,
    `workDoneAtPrevEmployer` VARCHAR(150) NOT NULL,
    `nxtOfKinFirstNm` VARCHAR(45) NOT NULL,
    `nxtOfKinLastNm` VARCHAR(45) NOT NULL,
    `nxtOfKinMobileNbr` VARCHAR(10) NOT NULL,
    `nxtOfKinResidence` VARCHAR(45) NOT NULL,
    `nxtOfKinRelationship` VARCHAR(10) NOT NULL,
    `nxtOfKinPlaceOfWork` VARCHAR(75) NOT NULL,
    `comment` VARCHAR(255),
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    UNIQUE INDEX `empName_UNIQUE` (`firstName`, `middleInitial`, `lastName`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- employeeloan
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employeeloan`;

CREATE TABLE `employeeloan`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `employeeOid` INTEGER NOT NULL,
    `loanNbr` VARCHAR(15) NOT NULL,
    `loanDate` DATETIME NOT NULL,
    `loanAmount` FLOAT DEFAULT 0 NOT NULL,
    `purpose` VARCHAR(254) DEFAULT 'enter purpose...' NOT NULL,
    `nbrOfPayPeriods` FLOAT DEFAULT 1.5 NOT NULL,
    `opsMonthlyCalendarOid` INTEGER NOT NULL,
    `installmentAmt` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_EmployeeLoan_Employee2_idx` (`employeeOid`),
    INDEX `fk_EmployeeLoan_OpsMonthlyCalendar1_idx` (`opsMonthlyCalendarOid`),
    CONSTRAINT `fk_EmployeeLoan_Employee2`
        FOREIGN KEY (`employeeOid`)
        REFERENCES `employee` (`oid`),
    CONSTRAINT `fk_EmployeeLoan_OpsMonthlyCalendar1`
        FOREIGN KEY (`opsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- employeeloanpmt
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employeeloanpmt`;

CREATE TABLE `employeeloanpmt`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `employeeLoanOid` INTEGER NOT NULL,
    `deductionAmt` FLOAT NOT NULL,
    `balanceAmount` FLOAT DEFAULT 0 NOT NULL,
    `paid` VARCHAR(1) DEFAULT '0' NOT NULL,
    `payslipNbr` VARCHAR(45) DEFAULT '0' NOT NULL,
    `dateDeducted` DATE NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_EmployeeLoanSchedule_EmployeeLoan1_idx` (`employeeLoanOid`),
    CONSTRAINT `fk_EmployeeLoanSchedule_EmployeeLoan1`
        FOREIGN KEY (`employeeLoanOid`)
        REFERENCES `employeeloan` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- employeeotherdeduction
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employeeotherdeduction`;

CREATE TABLE `employeeotherdeduction`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `employeeOid` INTEGER NOT NULL,
    `amount` FLOAT DEFAULT 0 NOT NULL,
    `description` VARCHAR(100) DEFAULT 'none' NOT NULL,
    `paidFlg` TINYINT(1) DEFAULT 0 NOT NULL,
    `payslipNbr` VARCHAR(15) DEFAULT '0000000000' NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_EmployeeotherDeduction_Employee1_idx` (`employeeOid`),
    CONSTRAINT `fk_EmployeeotherDeduction_Employee1`
        FOREIGN KEY (`employeeOid`)
        REFERENCES `employee` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- employeepurchases
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employeepurchases`;

CREATE TABLE `employeepurchases`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `purchaseDt` DATETIME NOT NULL,
    `employeeOid` INTEGER NOT NULL,
    `quantity` INTEGER DEFAULT 0 NOT NULL,
    `productUnitType` CHAR(2) NOT NULL,
    `description` VARCHAR(128) NOT NULL,
    `unitPrice` FLOAT DEFAULT 0 NOT NULL,
    `lineOfBusinessOid` INTEGER DEFAULT 6 NOT NULL,
    `paidFlg` TINYINT DEFAULT 0 NOT NULL,
    `payslipNbr` VARCHAR(45),
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_EmployeePurchases_Employee1_idx` (`employeeOid`),
    INDEX `fk_EmployeePurchases_ProductUnit1_idx` (`productUnitType`),
    INDEX `fk_EmployeePurchases_LineOfBusiness1_idx` (`lineOfBusinessOid`),
    CONSTRAINT `fk_EmployeePurchases_Employee1`
        FOREIGN KEY (`employeeOid`)
        REFERENCES `employee` (`oid`),
    CONSTRAINT `fk_EmployeePurchases_LineOfBusiness1`
        FOREIGN KEY (`lineOfBusinessOid`)
        REFERENCES `lineofbusiness` (`oid`),
    CONSTRAINT `fk_EmployeePurchases_ProductUnit1`
        FOREIGN KEY (`productUnitType`)
        REFERENCES `productunit` (`unit`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- employeerole
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employeerole`;

CREATE TABLE `employeerole`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `employeeOid` INTEGER NOT NULL,
    `employeeRoleTypeOid` INTEGER NOT NULL,
    `effectiveDt` DATE NOT NULL,
    `endDt` DATE,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_EmployeeRole_Employee1_idx` (`employeeOid`),
    INDEX `fk_EmployeeRole_EmployeeRoleType1_idx` (`employeeRoleTypeOid`),
    CONSTRAINT `fk_EmployeeRole_Employee1`
        FOREIGN KEY (`employeeOid`)
        REFERENCES `employee` (`oid`),
    CONSTRAINT `fk_EmployeeRole_EmployeeRoleType1`
        FOREIGN KEY (`employeeRoleTypeOid`)
        REFERENCES `employeeroletype` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- employeeroletype
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employeeroletype`;

CREATE TABLE `employeeroletype`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `role` VARCHAR(45) DEFAULT 'TEA PICKER' NOT NULL,
    `description` VARCHAR(100),
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- employeesalaryexpenseallocation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employeesalaryexpenseallocation`;

CREATE TABLE `employeesalaryexpenseallocation`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `employeeOid` INTEGER NOT NULL,
    `lineOfBusinessOid` INTEGER NOT NULL,
    `allocation` FLOAT DEFAULT 0 NOT NULL,
    `effectiveDt` DATETIME NOT NULL,
    `endDt` DATETIME,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_EmployeeExpenseAllocation_Employee1_idx` (`employeeOid`),
    INDEX `fk_EmployeeExpenseAllocation_LineOfBusiness1_idx` (`lineOfBusinessOid`),
    CONSTRAINT `fk_EmployeeExpenseAllocation_Employee1`
        FOREIGN KEY (`employeeOid`)
        REFERENCES `employee` (`oid`),
    CONSTRAINT `fk_EmployeeExpenseAllocation_LineOfBusiness1`
        FOREIGN KEY (`lineOfBusinessOid`)
        REFERENCES `lineofbusiness` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- employeetermination
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employeetermination`;

CREATE TABLE `employeetermination`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `employeeOid` INTEGER NOT NULL,
    `employeeTerminationTypeOid` INTEGER NOT NULL,
    `terminationDate` DATE NOT NULL,
    `comments` VARCHAR(200) NOT NULL,
    `gratuityAmt` FLOAT DEFAULT 0 NOT NULL,
    `gratuityComments` VARCHAR(254),
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_EmployeeTermination_Employee1_idx` (`employeeOid`),
    INDEX `fk_EmployeeTermination_EmployeeTerminationType1_idx` (`employeeTerminationTypeOid`),
    CONSTRAINT `fk_EmployeeTermination_Employee1`
        FOREIGN KEY (`employeeOid`)
        REFERENCES `employee` (`oid`),
    CONSTRAINT `fk_EmployeeTermination_EmployeeTerminationType1`
        FOREIGN KEY (`employeeTerminationTypeOid`)
        REFERENCES `employeeterminationtype` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- employeeterminationtype
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employeeterminationtype`;

CREATE TABLE `employeeterminationtype`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(20) NOT NULL,
    `description` VARCHAR(100) NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- employeetype
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employeetype`;

CREATE TABLE `employeetype`
(
    `type` VARCHAR(1) DEFAULT 'C' NOT NULL,
    `description` VARCHAR(100) DEFAULT 'Casual Labourer' NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`type`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- expenseactivity
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `expenseactivity`;

CREATE TABLE `expenseactivity`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `activity` VARCHAR(100) DEFAULT '00000' NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- expensecategory
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `expensecategory`;

CREATE TABLE `expensecategory`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `COGS` INTEGER(1) DEFAULT 0 NOT NULL,
    `description` VARCHAR(100) DEFAULT 'GENERAL',
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- expenses
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `expenseDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `payee` VARCHAR(100) NOT NULL,
    `narration` VARCHAR(100) NOT NULL,
    `activityOid` INTEGER NOT NULL,
    `lineOfBusinessOid` INTEGER NOT NULL,
    `amount` FLOAT DEFAULT 0 NOT NULL,
    `categoryOid` INTEGER NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_Expense_ExpenseActivity1_idx` (`activityOid`),
    INDEX `fk_Expense_LineOfBussiness1_idx` (`lineOfBusinessOid`),
    INDEX `fk_Expenses_ExpenseCategory1_idx` (`categoryOid`),
    CONSTRAINT `fk_Expense_ExpenseActivity1`
        FOREIGN KEY (`activityOid`)
        REFERENCES `expenseactivity` (`oid`),
    CONSTRAINT `fk_Expense_LineOfBussiness1`
        FOREIGN KEY (`lineOfBusinessOid`)
        REFERENCES `lineofbusiness` (`oid`),
    CONSTRAINT `fk_Expenses_ExpenseCategory1`
        FOREIGN KEY (`categoryOid`)
        REFERENCES `expensecategory` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- fishpandl
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fishpandl`;

CREATE TABLE `fishpandl`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `lineOfBusinessOid` INTEGER NOT NULL,
    `opsMonthlyCalendarOid` INTEGER NOT NULL,
    `salesIncome` FLOAT DEFAULT 0 NOT NULL,
    `otherIncome` FLOAT DEFAULT 0 NOT NULL,
    `purchases` FLOAT DEFAULT 0 NOT NULL,
    `otherPurchases` FLOAT DEFAULT 0 NOT NULL,
    `labourParttimeExpense` FLOAT DEFAULT 0 NOT NULL,
    `generalExpenses` FLOAT DEFAULT 0 NOT NULL,
    `elecExpenses` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_PandL_LineOfBusiness1_idx` (`lineOfBusinessOid`),
    INDEX `fk_PandLincome_OpsMonthlyCalendar1_idx` (`opsMonthlyCalendarOid`),
    CONSTRAINT `fk_PandL_LineOfBusiness1`
        FOREIGN KEY (`lineOfBusinessOid`)
        REFERENCES `lineofbusiness` (`oid`),
    CONSTRAINT `fk_PandLincome_OpsMonthlyCalendar1`
        FOREIGN KEY (`opsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- fishpandllabourexpensedetail
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fishpandllabourexpensedetail`;

CREATE TABLE `fishpandllabourexpensedetail`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `FishPandLOid` INTEGER NOT NULL,
    `EmployeeRoleOid` INTEGER NOT NULL,
    `expenseAmount` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_FishPandLlabourExpenseDetail_FishPandL1_idx` (`FishPandLOid`),
    INDEX `fk_FishPandLlabourExpenseDetail_EmployeeRole1_idx` (`EmployeeRoleOid`),
    CONSTRAINT `fk_FishPandLlabourExpenseDetail_EmployeeRole1`
        FOREIGN KEY (`EmployeeRoleOid`)
        REFERENCES `employeeroletype` (`oid`),
    CONSTRAINT `fk_FishPandLlabourExpenseDetail_FishPandL1`
        FOREIGN KEY (`FishPandLOid`)
        REFERENCES `fishpandl` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- fishproduction
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fishproduction`;

CREATE TABLE `fishproduction`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(15) NOT NULL,
    `harvestDt` DATETIME NOT NULL,
    `pondNbr` INTEGER(1) NOT NULL,
    `weight` FLOAT NOT NULL,
    `count` INTEGER NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_FishProduction_FishType1_idx` (`type`),
    CONSTRAINT `fk_FishProduction_FishType1`
        FOREIGN KEY (`type`)
        REFERENCES `fishtype` (`fishType`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- fishsales
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fishsales`;

CREATE TABLE `fishsales`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `salesDt` DATE NOT NULL,
    `customerOid` INTEGER NOT NULL,
    `type` VARCHAR(15) NOT NULL,
    `weight` FLOAT DEFAULT 0 NOT NULL,
    `pricePerKg` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_FishSales_Customer1_idx` (`customerOid`),
    INDEX `fk_FishSales_FishType1_idx` (`type`),
    CONSTRAINT `fk_FishSales_Customer1`
        FOREIGN KEY (`customerOid`)
        REFERENCES `customer` (`oid`),
    CONSTRAINT `fk_FishSales_FishType1`
        FOREIGN KEY (`type`)
        REFERENCES `fishtype` (`fishType`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- fishtype
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fishtype`;

CREATE TABLE `fishtype`
(
    `fishType` VARCHAR(15) DEFAULT 'TILAPIA' NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`fishType`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- fteemployeepayslip
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fteemployeepayslip`;

CREATE TABLE `fteemployeepayslip`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `opsMonthlyCalendarOid` INTEGER NOT NULL,
    `employeeOid` INTEGER NOT NULL,
    `salaryAmount` FLOAT DEFAULT 0 NOT NULL,
    `dailyRate` INTEGER DEFAULT 0 NOT NULL,
    `hourlyRate` FLOAT DEFAULT 0 NOT NULL,
    `daysMissed` INTEGER DEFAULT 0 NOT NULL,
    `totalParttimeHrs` FLOAT DEFAULT 0 NOT NULL,
    `parttimePay` FLOAT DEFAULT 0 NOT NULL,
    `otherDaysWorked` INTEGER(2) DEFAULT 0 NOT NULL,
    `otherDaysPayRate` FLOAT DEFAULT 0 NOT NULL,
    `otherworkPay` FLOAT DEFAULT 0 NOT NULL,
    `medicalDeduction` FLOAT DEFAULT 0 NOT NULL,
    `NSSFdeduction` FLOAT DEFAULT 0 NOT NULL,
    `loanDeduction` FLOAT DEFAULT 0 NOT NULL,
    `loanBalance` FLOAT DEFAULT 0 NOT NULL,
    `advance` FLOAT DEFAULT 0 NOT NULL,
    `elecDeduction` FLOAT DEFAULT 0 NOT NULL,
    `purchasesDeduction` FLOAT DEFAULT 0 NOT NULL,
    `otherDeduction` FLOAT DEFAULT 0 NOT NULL,
    `otherDeductionDescr` VARCHAR(250),
    `bonus` FLOAT DEFAULT 0 NOT NULL,
    `payslipNbr` VARCHAR(15) DEFAULT 'F-PS-0000000000' NOT NULL,
    `lockDt` DATE,
    `lockedFlg` TINYINT DEFAULT 0 NOT NULL,
    `updtTmstp` DATETIME,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`oid`),
    INDEX `fk_EmployeePaySlip_Employee1_idx` (`employeeOid`),
    INDEX `fk_fteEmployeePaySlip_OpsMonthlyCalendar1_idx` (`opsMonthlyCalendarOid`),
    CONSTRAINT `fk_EmployeePaySlip_Employee10`
        FOREIGN KEY (`employeeOid`)
        REFERENCES `employee` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ftesalaryadvance
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ftesalaryadvance`;

CREATE TABLE `ftesalaryadvance`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `employeeOid` INTEGER NOT NULL,
    `opsMonthlyCalendarOid` INTEGER NOT NULL,
    `amount` FLOAT DEFAULT 0 NOT NULL,
    `paid` CHAR DEFAULT '0' NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_fteSalaryAdvance_OpsMonthlyCalendar1_idx` (`opsMonthlyCalendarOid`),
    INDEX `fk_fteSalaryAdvance_Employee1_idx` (`employeeOid`),
    CONSTRAINT `fk_fteSalaryAdvance_Employee1`
        FOREIGN KEY (`employeeOid`)
        REFERENCES `employee` (`oid`),
    CONSTRAINT `fk_fteSalaryAdvance_OpsMonthlyCalendar1`
        FOREIGN KEY (`opsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- horticulturebed
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `horticulturebed`;

CREATE TABLE `horticulturebed`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `identifier` INTEGER(3) NOT NULL,
    `type` CHAR DEFAULT 'P' NOT NULL,
    `length` INTEGER(2) DEFAULT 0 NOT NULL,
    `width` INTEGER(2) DEFAULT 0 NOT NULL,
    `updtTmstp` DATETIME,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- horticultureproducebed
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `horticultureproducebed`;

CREATE TABLE `horticultureproducebed`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `produceTypeOid` INTEGER NOT NULL,
    `bedOid` INTEGER NOT NULL,
    `plantedDt` DATE NOT NULL,
    `harvestDt` DATE NOT NULL,
    `endDt` DATE NOT NULL,
    `ganttParentOid` INTEGER DEFAULT 0 NOT NULL,
    `notes` TEXT,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_ProduceBed_Bed1_idx` (`bedOid`),
    INDEX `fk_HorticultureProduceBed_HorticultureProduceType1_idx` (`produceTypeOid`),
    CONSTRAINT `fk_HorticultureProduceBed_HorticultureProduceType1`
        FOREIGN KEY (`produceTypeOid`)
        REFERENCES `horticultureproducedetail` (`oid`),
    CONSTRAINT `fk_ProduceBed_Bed1`
        FOREIGN KEY (`bedOid`)
        REFERENCES `horticulturebed` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- horticultureproducebrand
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `horticultureproducebrand`;

CREATE TABLE `horticultureproducebrand`
(
    `name` VARCHAR(20) DEFAULT 'SIMLAWS' NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- horticultureproducedetail
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `horticultureproducedetail`;

CREATE TABLE `horticultureproducedetail`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `horticultureProduceParentoid` INTEGER NOT NULL,
    `brand` VARCHAR(20) NOT NULL,
    `variety` VARCHAR(45) NOT NULL,
    `directPlanting` INTEGER(1) DEFAULT 0 NOT NULL,
    `nurseryDuration` INTEGER(3) NOT NULL,
    `avgMaturityDays` INTEGER(3) NOT NULL,
    `harvestDurationDays` INTEGER(3) NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_HorticultureProduceType_HorticultureProduceBrand1_idx` (`brand`),
    INDEX `fk_HorticultureProduceDetail_HorticultureProduceParent1_idx` (`horticultureProduceParentoid`),
    CONSTRAINT `fk_HorticultureProduceDetail_HorticultureProduceParent1`
        FOREIGN KEY (`horticultureProduceParentoid`)
        REFERENCES `horticultureproduceparent` (`oid`),
    CONSTRAINT `fk_HorticultureProduceType_HorticultureProduceBrand1`
        FOREIGN KEY (`brand`)
        REFERENCES `horticultureproducebrand` (`name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- horticultureproduceparent
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `horticultureproduceparent`;

CREATE TABLE `horticultureproduceparent`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- horticultureproducestock
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `horticultureproducestock`;

CREATE TABLE `horticultureproducestock`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `produceTypeOid` INTEGER NOT NULL,
    `stockDate` DATETIME NOT NULL,
    `qty` FLOAT NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_HorticultureProduceStock_HorticultureProduceType1_idx` (`produceTypeOid`),
    CONSTRAINT `fk_HorticultureProduceStock_HorticultureProduceType1`
        FOREIGN KEY (`produceTypeOid`)
        REFERENCES `horticultureproducedetail` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- horticulturesales
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `horticulturesales`;

CREATE TABLE `horticulturesales`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `salesDt` DATE NOT NULL,
    `customerOid` INTEGER NOT NULL,
    `horticultureProduceParentOid` INTEGER NOT NULL,
    `unit` VARCHAR(3) NOT NULL,
    `quantity` INTEGER DEFAULT 0 NOT NULL,
    `unitPrice` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_DefaultTable_Customer1_idx` (`customerOid`),
    INDEX `fk_HorticultureSales_horticulturesellunit1_idx` (`unit`),
    INDEX `fk_HorticultureSales_HorticultureProduceParent1_idx1` (`horticultureProduceParentOid`),
    CONSTRAINT `fk_DefaultTable_Customer1`
        FOREIGN KEY (`customerOid`)
        REFERENCES `customer` (`oid`),
    CONSTRAINT `fk_HorticultureSales_HorticultureProduceParent1`
        FOREIGN KEY (`horticultureProduceParentOid`)
        REFERENCES `horticultureproduceparent` (`oid`),
    CONSTRAINT `fk_HorticultureSales_horticulturesellunit1`
        FOREIGN KEY (`unit`)
        REFERENCES `horticulturesellunit` (`unit`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- horticulturesellunit
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `horticulturesellunit`;

CREATE TABLE `horticulturesellunit`
(
    `unit` VARCHAR(3) DEFAULT 'KG' NOT NULL,
    `description` VARCHAR(45) DEFAULT 'Kilogram' NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`unit`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kiambaadairy
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kiambaadairy`;

CREATE TABLE `kiambaadairy`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `opsMonthlyCalendaOid` INTEGER NOT NULL,
    `societyShares` FLOAT DEFAULT 0 NOT NULL,
    `packingShares` FLOAT DEFAULT 0 NOT NULL,
    `feedExpense` FLOAT DEFAULT 0 NOT NULL,
    `totalDeductions` FLOAT DEFAULT 0 NOT NULL,
    `rate` FLOAT DEFAULT 0 NOT NULL,
    `deliveredQty` FLOAT DEFAULT 0 NOT NULL,
    `rejectedQty` FLOAT DEFAULT 0 NOT NULL,
    `acceptedQty` FLOAT DEFAULT 0 NOT NULL,
    `grossPay` FLOAT DEFAULT 0 NOT NULL,
    `netPay` FLOAT DEFAULT 0 NOT NULL,
    `society` INTEGER DEFAULT 0 NOT NULL,
    `packing` INTEGER DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    UNIQUE INDEX `opsMonthlyCalendaOid_UNIQUE` (`opsMonthlyCalendaOid`),
    INDEX `fk_KiambaaDairy_OpsMonthlyCalendar1_idx` (`opsMonthlyCalendaOid`),
    CONSTRAINT `fk_KiambaaDairy_OpsMonthlyCalendar1`
        FOREIGN KEY (`opsMonthlyCalendaOid`)
        REFERENCES `opsmonthlycalendar` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- lineofbusiness
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `lineofbusiness`;

CREATE TABLE `lineofbusiness`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `department` VARCHAR(45) NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- medicaldeduction
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `medicaldeduction`;

CREATE TABLE `medicaldeduction`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `employeeOid` INTEGER NOT NULL,
    `deductionFlg` TINYINT(1) DEFAULT 0 NOT NULL,
    `effectiveDt` DATE NOT NULL,
    `endDt` DATE,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_NSSF_Employee1_idx` (`employeeOid`),
    CONSTRAINT `fk_NSSF_Employee10`
        FOREIGN KEY (`employeeOid`)
        REFERENCES `employee` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- mushroomproduction
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `mushroomproduction`;

CREATE TABLE `mushroomproduction`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `gr_id` VARCHAR(255) NOT NULL,
    `harvestDt` DATE NOT NULL,
    `roomNbr` INTEGER(2) DEFAULT 0 NOT NULL,
    `cropNbr` INTEGER(4) DEFAULT 0 NOT NULL,
    `harvestedWeight` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- mushroomsales
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `mushroomsales`;

CREATE TABLE `mushroomsales`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `customerOid` INTEGER NOT NULL,
    `salesDt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `weightSold` FLOAT DEFAULT 0 NOT NULL,
    `pricePerKg` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_MushroomSales_Customer1_idx` (`customerOid`),
    CONSTRAINT `fk_MushroomSales_Customer1`
        FOREIGN KEY (`customerOid`)
        REFERENCES `customer` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- nssfdeduction
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `nssfdeduction`;

CREATE TABLE `nssfdeduction`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `employeeOid` INTEGER NOT NULL,
    `deductionFlg` TINYINT(1) DEFAULT 0 NOT NULL,
    `effectiveDt` DATE NOT NULL,
    `endDt` DATE,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_NSSF_Employee1_idx` (`employeeOid`),
    CONSTRAINT `fk_NSSF_Employee1`
        FOREIGN KEY (`employeeOid`)
        REFERENCES `employee` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ops24hrtime
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ops24hrtime`;

CREATE TABLE `ops24hrtime`
(
    `timeString` VARCHAR(5) NOT NULL,
    PRIMARY KEY (`timeString`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- opsbiweeklycalendar
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `opsbiweeklycalendar`;

CREATE TABLE `opsbiweeklycalendar`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `periodStartDate` DATETIME NOT NULL,
    `periodEndDt` DATETIME NOT NULL,
    `payDate` DATETIME NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- opscalendar
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `opscalendar`;

CREATE TABLE `opscalendar`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `opsDate` DATE NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- opsmonthlycalendar
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `opsmonthlycalendar`;

CREATE TABLE `opsmonthlycalendar`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `monthNbr` INTEGER(2) DEFAULT 1 NOT NULL,
    `month` VARCHAR(3) DEFAULT 'JAN' NOT NULL,
    `year` INTEGER(4) DEFAULT 2017 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- opstimedimension
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `opstimedimension`;

CREATE TABLE `opstimedimension`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `db_date` DATE NOT NULL,
    `year` INTEGER NOT NULL,
    `month` INTEGER NOT NULL,
    `day` INTEGER NOT NULL,
    `quarter` INTEGER NOT NULL,
    `week` INTEGER NOT NULL,
    `day_name` VARCHAR(9) NOT NULL,
    `month_name` VARCHAR(9) NOT NULL,
    `holiday_flag` CHAR DEFAULT '0',
    `weekend_flag` CHAR DEFAULT '0',
    `event` VARCHAR(50),
    PRIMARY KEY (`oid`),
    UNIQUE INDEX `opsTimeDimension_idx` (`year`, `month`, `day`),
    UNIQUE INDEX `opsTimeDimension_dbdate_idx` (`db_date`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- otherworkassigned
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `otherworkassigned`;

CREATE TABLE `otherworkassigned`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `attendanceOid` INTEGER NOT NULL,
    `lineOfBusinessOid` INTEGER DEFAULT 11 NOT NULL,
    `startTm` TIME DEFAULT '00:00:00' NOT NULL,
    `endTm` TIME DEFAULT '00:00:00' NOT NULL,
    `hours` INTEGER(2) NOT NULL,
    `description` VARCHAR(100) DEFAULT 'TBD' NOT NULL,
    `remarks` VARCHAR(100),
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_DefaultTable_Attendance1_idx` (`attendanceOid`),
    INDEX `fk_DefaultTable_LineOfBusiness1_idx` (`lineOfBusinessOid`),
    CONSTRAINT `fk_DefaultTable_Attendance1`
        FOREIGN KEY (`attendanceOid`)
        REFERENCES `attendance` (`oid`),
    CONSTRAINT `fk_DefaultTable_LineOfBusiness1`
        FOREIGN KEY (`lineOfBusinessOid`)
        REFERENCES `lineofbusiness` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- parttimedetail
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `parttimedetail`;

CREATE TABLE `parttimedetail`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `employeeOid` INTEGER NOT NULL,
    `attendanceOid` INTEGER NOT NULL,
    `startTm` TIME DEFAULT '00:00:00' NOT NULL,
    `endTm` TIME DEFAULT '00:00:00' NOT NULL,
    `hours` FLOAT DEFAULT 0 NOT NULL,
    `workDescription` VARCHAR(100) NOT NULL,
    `lineOfBussinessOid` INTEGER NOT NULL,
    `allocatedBy` VARCHAR(45) DEFAULT 'Select Supervisor' NOT NULL,
    `remarks` VARCHAR(100) DEFAULT 'none' NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    `gr_id` VARCHAR(45) DEFAULT '0' NOT NULL,
    PRIMARY KEY (`oid`),
    INDEX `fk_PartTimeDetail_Employee1_idx` (`employeeOid`),
    INDEX `fk_PartTimeDetail_LineOfBussiness1_idx` (`lineOfBussinessOid`),
    INDEX `fk_PartTimeDetail_Attendance1_idx` (`attendanceOid`),
    CONSTRAINT `fk_PartTimeDetail_Attendance1`
        FOREIGN KEY (`attendanceOid`)
        REFERENCES `attendance` (`oid`),
    CONSTRAINT `fk_PartTimeDetail_Employee1`
        FOREIGN KEY (`employeeOid`)
        REFERENCES `employee` (`oid`),
    CONSTRAINT `fk_PartTimeDetail_LineOfBussiness1`
        FOREIGN KEY (`lineOfBussinessOid`)
        REFERENCES `lineofbusiness` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- productunit
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `productunit`;

CREATE TABLE `productunit`
(
    `unit` CHAR(2) NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`unit`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- salary
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `salary`;

CREATE TABLE `salary`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `employeeOid` INTEGER NOT NULL,
    `employeetype` VARCHAR(1) NOT NULL,
    `amount` FLOAT NOT NULL,
    `salarytype` VARCHAR(1) NOT NULL,
    `effectivetDt` DATE NOT NULL,
    `endDt` DATE,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updateTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `employeeFK_idx` (`employeeOid`),
    INDEX `fk_Salary_EmployeeType1_idx` (`employeetype`),
    INDEX `fk_Salary_SalaryType1_idx` (`salarytype`),
    CONSTRAINT `employeeFK`
        FOREIGN KEY (`employeeOid`)
        REFERENCES `employee` (`oid`),
    CONSTRAINT `fk_Salary_EmployeeType1`
        FOREIGN KEY (`employeetype`)
        REFERENCES `employeetype` (`type`),
    CONSTRAINT `fk_Salary_SalaryType1`
        FOREIGN KEY (`salarytype`)
        REFERENCES `salarytype` (`type`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- salarytype
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `salarytype`;

CREATE TABLE `salarytype`
(
    `type` VARCHAR(1) DEFAULT 'D' NOT NULL,
    `description` VARCHAR(45) DEFAULT 'Daily' NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`type`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- teablock
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `teablock`;

CREATE TABLE `teablock`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `blockNbr` INTEGER NOT NULL,
    `name` VARCHAR(10) NOT NULL,
    `blockSize` FLOAT DEFAULT 0 NOT NULL,
    `nbrOfBushes` INTEGER DEFAULT 0 NOT NULL,
    `lastDatePruned` DATETIME NOT NULL,
    `nextPruneDate` DATETIME NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    UNIQUE INDEX `name_UNIQUE` (`name`),
    UNIQUE INDEX `blockNbr_UNIQUE` (`blockNbr`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- teabonus
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `teabonus`;

CREATE TABLE `teabonus`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `opsMonthlyCalendarOid` INTEGER NOT NULL,
    `amount` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_TeaBonus_OpsMonthlyCalendar1_idx` (`opsMonthlyCalendarOid`),
    CONSTRAINT `fk_TeaBonus_OpsMonthlyCalendar1`
        FOREIGN KEY (`opsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- teafactorydelivery
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `teafactorydelivery`;

CREATE TABLE `teafactorydelivery`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `nbrOfTrips` INTEGER(1) DEFAULT 1 NOT NULL,
    `deliveryDt` DATETIME NOT NULL,
    `factoryWeight` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- teafactorypurchases
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `teafactorypurchases`;

CREATE TABLE `teafactorypurchases`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `purchaseDt` DATE NOT NULL,
    `purchaseType` VARCHAR(20) NOT NULL,
    `quantity` INTEGER(2) DEFAULT 0 NOT NULL,
    `unitPrice` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_TeaFactoryPurchases_TeaFactoryPurchaseType1_idx` (`purchaseType`),
    CONSTRAINT `fk_TeaFactoryPurchases_TeaFactoryPurchaseType1`
        FOREIGN KEY (`purchaseType`)
        REFERENCES `teafactorypurchasetype` (`type`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- teafactorypurchasetype
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `teafactorypurchasetype`;

CREATE TABLE `teafactorypurchasetype`
(
    `type` VARCHAR(20) NOT NULL,
    `unit` VARCHAR(5) DEFAULT 'KG' NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`type`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- teafactoryrate
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `teafactoryrate`;

CREATE TABLE `teafactoryrate`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `rate` FLOAT NOT NULL,
    `startOpsMonthlyCalendarOid` INTEGER NOT NULL,
    `endOpsMonthlyCalendarOid` INTEGER,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_TeaFactoryRate_OpsMonthlyCalendar1_idx` (`startOpsMonthlyCalendarOid`),
    INDEX `fk_TeaFactoryRate_OpsMonthlyCalendar2_idx` (`endOpsMonthlyCalendarOid`),
    CONSTRAINT `fk_TeaFactoryRate_OpsMonthlyCalendar1`
        FOREIGN KEY (`startOpsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`),
    CONSTRAINT `fk_TeaFactoryRate_OpsMonthlyCalendar2`
        FOREIGN KEY (`endOpsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- teafactorytriprate
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `teafactorytriprate`;

CREATE TABLE `teafactorytriprate`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `rate` FLOAT NOT NULL,
    `startOpsMonthlyCalendarOid` INTEGER NOT NULL,
    `endOpsMonthlyCalendarOid` INTEGER,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_TeaFactoryRate_OpsMonthlyCalendar1_idx` (`startOpsMonthlyCalendarOid`),
    INDEX `fk_TeaFactoryRate_OpsMonthlyCalendar2_idx` (`endOpsMonthlyCalendarOid`),
    CONSTRAINT `fk_TeaFactoryRate_OpsMonthlyCalendar10`
        FOREIGN KEY (`startOpsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`),
    CONSTRAINT `fk_TeaFactoryRate_OpsMonthlyCalendar20`
        FOREIGN KEY (`endOpsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- teapandl
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `teapandl`;

CREATE TABLE `teapandl`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `lineOfBusinessOid` INTEGER NOT NULL,
    `opsMonthlyCalendarOid` INTEGER NOT NULL,
    `factoryWeight` FLOAT DEFAULT 0 NOT NULL,
    `factoryPurchaseRate` FLOAT DEFAULT 0 NOT NULL,
    `purchasesRoundup` FLOAT DEFAULT 0 NOT NULL,
    `purchasesFertilizer` FLOAT DEFAULT 0 NOT NULL,
    `purchasesDeliveryBook` FLOAT DEFAULT 0 NOT NULL,
    `otherPurchases` FLOAT DEFAULT 0 NOT NULL,
    `bonus` FLOAT DEFAULT 0 NOT NULL,
    `tripExpenses` FLOAT DEFAULT 0 NOT NULL,
    `labourParttimeExpense` FLOAT DEFAULT 0 NOT NULL,
    `cessRate` FLOAT DEFAULT 0,
    `madeTeaExpenses` FLOAT DEFAULT 0,
    `generalExpenses` FLOAT DEFAULT 0 NOT NULL,
    `elecExpenses` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_PandL_LineOfBusiness1_idx` (`lineOfBusinessOid`),
    INDEX `fk_PandLincome_OpsMonthlyCalendar1_idx` (`opsMonthlyCalendarOid`),
    CONSTRAINT `fk_PandL_LineOfBusiness11`
        FOREIGN KEY (`lineOfBusinessOid`)
        REFERENCES `lineofbusiness` (`oid`),
    CONSTRAINT `fk_PandLincome_OpsMonthlyCalendar11`
        FOREIGN KEY (`opsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- teapandllabourexpensedetail
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `teapandllabourexpensedetail`;

CREATE TABLE `teapandllabourexpensedetail`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `teaPandLOid` INTEGER NOT NULL,
    `employeeRoleOid` INTEGER NOT NULL,
    `otherWorkExpenseAmount` FLOAT DEFAULT 0 NOT NULL,
    `salaryExpenseAllocationAmount` FLOAT DEFAULT 0 NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_TeaPandLlabourExpenseDetail_TeaPandL1_idx` (`teaPandLOid`),
    INDEX `fk_TeaPandLlabourExpenseDetail_EmployeeRole2_idx` (`employeeRoleOid`),
    CONSTRAINT `fk_TeaPandLlabourExpenseDetail_EmployeeRole2`
        FOREIGN KEY (`employeeRoleOid`)
        REFERENCES `employeeroletype` (`oid`),
    CONSTRAINT `fk_TeaPandLlabourExpenseDetail_TeaPandL1`
        FOREIGN KEY (`teaPandLOid`)
        REFERENCES `teapandl` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- teapicking
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `teapicking`;

CREATE TABLE `teapicking`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `attendanceOid` INTEGER NOT NULL,
    `teaBlock_oid` INTEGER NOT NULL,
    `weight` FLOAT NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_TeaPicking_Attendance1_idx` (`attendanceOid`),
    INDEX `fk_TeaPicking_TeaBlock1_idx` (`teaBlock_oid`),
    CONSTRAINT `fk_TeaPicking_Attendance1`
        FOREIGN KEY (`attendanceOid`)
        REFERENCES `attendance` (`oid`),
    CONSTRAINT `fk_TeaPicking_TeaBlock1`
        FOREIGN KEY (`teaBlock_oid`)
        REFERENCES `teablock` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- teapickingrate
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `teapickingrate`;

CREATE TABLE `teapickingrate`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `rate` FLOAT NOT NULL,
    `startDt` DATETIME NOT NULL,
    `endDt` DATETIME,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    UNIQUE INDEX `startDt_UNIQUE` (`startDt`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- teapruning
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `teapruning`;

CREATE TABLE `teapruning`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `attendanceOid` INTEGER NOT NULL,
    `teaBlockOid` INTEGER NOT NULL,
    `teaPruningRateOid` INTEGER NOT NULL,
    `nbrOfBushesPruned` INTEGER NOT NULL,
    `date` DATETIME NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_TeaPruning_TeaPruningRate1_idx` (`teaPruningRateOid`),
    INDEX `fk_TeaPruning_TeaBlock1_idx` (`teaBlockOid`),
    INDEX `fk_TeaPruning_Attendance1_idx` (`attendanceOid`),
    CONSTRAINT `fk_TeaPruning_Attendance1`
        FOREIGN KEY (`attendanceOid`)
        REFERENCES `attendance` (`oid`),
    CONSTRAINT `fk_TeaPruning_TeaBlock1`
        FOREIGN KEY (`teaBlockOid`)
        REFERENCES `teablock` (`oid`),
    CONSTRAINT `fk_TeaPruning_TeaPruningRate1`
        FOREIGN KEY (`teaPruningRateOid`)
        REFERENCES `teapruningrate` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- teapruningrate
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `teapruningrate`;

CREATE TABLE `teapruningrate`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `ratePerBush` FLOAT NOT NULL,
    `startDt` DATETIME NOT NULL,
    `endDt` DATETIME,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vehicle
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vehicle`;

CREATE TABLE `vehicle`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `registration` VARCHAR(45) NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vehicleexpense
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vehicleexpense`;

CREATE TABLE `vehicleexpense`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `date` DATE NOT NULL,
    `vehicleOid` INTEGER NOT NULL,
    `payee` VARCHAR(100) NOT NULL,
    `narration` VARCHAR(100) NOT NULL,
    `amount` FLOAT DEFAULT 0 NOT NULL,
    `expenseCategoryOid` INTEGER NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_VehicleExpense_ExpenseCategory1_idx` (`expenseCategoryOid`),
    INDEX `fk_VehicleExpense_Vehicle1_idx` (`vehicleOid`),
    CONSTRAINT `fk_VehicleExpense_ExpenseCategory1`
        FOREIGN KEY (`expenseCategoryOid`)
        REFERENCES `expensecategory` (`oid`),
    CONSTRAINT `fk_VehicleExpense_Vehicle1`
        FOREIGN KEY (`vehicleOid`)
        REFERENCES `vehicle` (`oid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vehicleexpenseallocation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vehicleexpenseallocation`;

CREATE TABLE `vehicleexpenseallocation`
(
    `oid` INTEGER NOT NULL AUTO_INCREMENT,
    `vehicleOid` INTEGER NOT NULL,
    `lineOfBusinessOid` INTEGER NOT NULL,
    `allocation` FLOAT DEFAULT 0 NOT NULL,
    `startOpsMonthlyCalendarOid` INTEGER NOT NULL,
    `endOpsMonthlyCalendarOid` INTEGER NOT NULL,
    `createTmstp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updtTmstp` DATETIME,
    PRIMARY KEY (`oid`),
    INDEX `fk_VehicleExpenseAllocation_OpsMonthlyCalendar1_idx` (`startOpsMonthlyCalendarOid`),
    INDEX `fk_VehicleExpenseAllocation_OpsMonthlyCalendar2_idx` (`endOpsMonthlyCalendarOid`),
    INDEX `fk_VehicleExpenseAllocation_LineOfBusiness1_idx` (`lineOfBusinessOid`),
    INDEX `fk_VehicleExpenseAllocation_Vehilces1_idx` (`vehicleOid`),
    CONSTRAINT `fk_VehicleExpenseAllocation_LineOfBusiness1`
        FOREIGN KEY (`lineOfBusinessOid`)
        REFERENCES `lineofbusiness` (`oid`),
    CONSTRAINT `fk_VehicleExpenseAllocation_OpsMonthlyCalendar1`
        FOREIGN KEY (`startOpsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`),
    CONSTRAINT `fk_VehicleExpenseAllocation_OpsMonthlyCalendar2`
        FOREIGN KEY (`endOpsMonthlyCalendarOid`)
        REFERENCES `opsmonthlycalendar` (`oid`),
    CONSTRAINT `fk_VehicleExpenseAllocation_Vehilces1`
        FOREIGN KEY (`vehicleOid`)
        REFERENCES `vehicle` (`oid`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
