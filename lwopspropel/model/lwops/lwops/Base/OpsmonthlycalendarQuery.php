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
use lwops\lwops\Opsmonthlycalendar as ChildOpsmonthlycalendar;
use lwops\lwops\OpsmonthlycalendarQuery as ChildOpsmonthlycalendarQuery;
use lwops\lwops\Map\OpsmonthlycalendarTableMap;

/**
 * Base class that represents a query for the 'opsmonthlycalendar' table.
 *
 *
 *
 * @method     ChildOpsmonthlycalendarQuery orderByOid($order = Criteria::ASC) Order by the oid column
 * @method     ChildOpsmonthlycalendarQuery orderByMonthnbr($order = Criteria::ASC) Order by the monthNbr column
 * @method     ChildOpsmonthlycalendarQuery orderByMonth($order = Criteria::ASC) Order by the month column
 * @method     ChildOpsmonthlycalendarQuery orderByYear($order = Criteria::ASC) Order by the year column
 * @method     ChildOpsmonthlycalendarQuery orderByCreatetmstp($order = Criteria::ASC) Order by the createTmstp column
 * @method     ChildOpsmonthlycalendarQuery orderByUpdttmstp($order = Criteria::ASC) Order by the updtTmstp column
 *
 * @method     ChildOpsmonthlycalendarQuery groupByOid() Group by the oid column
 * @method     ChildOpsmonthlycalendarQuery groupByMonthnbr() Group by the monthNbr column
 * @method     ChildOpsmonthlycalendarQuery groupByMonth() Group by the month column
 * @method     ChildOpsmonthlycalendarQuery groupByYear() Group by the year column
 * @method     ChildOpsmonthlycalendarQuery groupByCreatetmstp() Group by the createTmstp column
 * @method     ChildOpsmonthlycalendarQuery groupByUpdttmstp() Group by the updtTmstp column
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOpsmonthlycalendarQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOpsmonthlycalendarQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOpsmonthlycalendarQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOpsmonthlycalendarQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinDairypandl($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dairypandl relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinDairypandl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dairypandl relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinDairypandl($relationAlias = null) Adds a INNER JOIN clause to the query using the Dairypandl relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithDairypandl($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dairypandl relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithDairypandl() Adds a LEFT JOIN clause and with to the query using the Dairypandl relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithDairypandl() Adds a RIGHT JOIN clause and with to the query using the Dairypandl relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithDairypandl() Adds a INNER JOIN clause and with to the query using the Dairypandl relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinElectricityallocationRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a LEFT JOIN clause to the query using the ElectricityallocationRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinElectricityallocationRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ElectricityallocationRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinElectricityallocationRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a INNER JOIN clause to the query using the ElectricityallocationRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithElectricityallocationRelatedByStartopsmonthlycalendaroid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ElectricityallocationRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithElectricityallocationRelatedByStartopsmonthlycalendaroid() Adds a LEFT JOIN clause and with to the query using the ElectricityallocationRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithElectricityallocationRelatedByStartopsmonthlycalendaroid() Adds a RIGHT JOIN clause and with to the query using the ElectricityallocationRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithElectricityallocationRelatedByStartopsmonthlycalendaroid() Adds a INNER JOIN clause and with to the query using the ElectricityallocationRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinElectricityallocationRelatedByEndtopsmonthlycalendaroid($relationAlias = null) Adds a LEFT JOIN clause to the query using the ElectricityallocationRelatedByEndtopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinElectricityallocationRelatedByEndtopsmonthlycalendaroid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ElectricityallocationRelatedByEndtopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinElectricityallocationRelatedByEndtopsmonthlycalendaroid($relationAlias = null) Adds a INNER JOIN clause to the query using the ElectricityallocationRelatedByEndtopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithElectricityallocationRelatedByEndtopsmonthlycalendaroid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ElectricityallocationRelatedByEndtopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithElectricityallocationRelatedByEndtopsmonthlycalendaroid() Adds a LEFT JOIN clause and with to the query using the ElectricityallocationRelatedByEndtopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithElectricityallocationRelatedByEndtopsmonthlycalendaroid() Adds a RIGHT JOIN clause and with to the query using the ElectricityallocationRelatedByEndtopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithElectricityallocationRelatedByEndtopsmonthlycalendaroid() Adds a INNER JOIN clause and with to the query using the ElectricityallocationRelatedByEndtopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinElectricityexpense($relationAlias = null) Adds a LEFT JOIN clause to the query using the Electricityexpense relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinElectricityexpense($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Electricityexpense relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinElectricityexpense($relationAlias = null) Adds a INNER JOIN clause to the query using the Electricityexpense relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithElectricityexpense($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Electricityexpense relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithElectricityexpense() Adds a LEFT JOIN clause and with to the query using the Electricityexpense relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithElectricityexpense() Adds a RIGHT JOIN clause and with to the query using the Electricityexpense relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithElectricityexpense() Adds a INNER JOIN clause and with to the query using the Electricityexpense relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinEmployeeloan($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employeeloan relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinEmployeeloan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employeeloan relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinEmployeeloan($relationAlias = null) Adds a INNER JOIN clause to the query using the Employeeloan relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithEmployeeloan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employeeloan relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithEmployeeloan() Adds a LEFT JOIN clause and with to the query using the Employeeloan relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithEmployeeloan() Adds a RIGHT JOIN clause and with to the query using the Employeeloan relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithEmployeeloan() Adds a INNER JOIN clause and with to the query using the Employeeloan relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinFishpandl($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fishpandl relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinFishpandl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fishpandl relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinFishpandl($relationAlias = null) Adds a INNER JOIN clause to the query using the Fishpandl relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithFishpandl($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fishpandl relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithFishpandl() Adds a LEFT JOIN clause and with to the query using the Fishpandl relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithFishpandl() Adds a RIGHT JOIN clause and with to the query using the Fishpandl relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithFishpandl() Adds a INNER JOIN clause and with to the query using the Fishpandl relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinFtesalaryadvance($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ftesalaryadvance relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinFtesalaryadvance($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ftesalaryadvance relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinFtesalaryadvance($relationAlias = null) Adds a INNER JOIN clause to the query using the Ftesalaryadvance relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithFtesalaryadvance($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ftesalaryadvance relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithFtesalaryadvance() Adds a LEFT JOIN clause and with to the query using the Ftesalaryadvance relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithFtesalaryadvance() Adds a RIGHT JOIN clause and with to the query using the Ftesalaryadvance relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithFtesalaryadvance() Adds a INNER JOIN clause and with to the query using the Ftesalaryadvance relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinKiambaadairy($relationAlias = null) Adds a LEFT JOIN clause to the query using the Kiambaadairy relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinKiambaadairy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Kiambaadairy relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinKiambaadairy($relationAlias = null) Adds a INNER JOIN clause to the query using the Kiambaadairy relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithKiambaadairy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Kiambaadairy relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithKiambaadairy() Adds a LEFT JOIN clause and with to the query using the Kiambaadairy relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithKiambaadairy() Adds a RIGHT JOIN clause and with to the query using the Kiambaadairy relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithKiambaadairy() Adds a INNER JOIN clause and with to the query using the Kiambaadairy relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinTeabonus($relationAlias = null) Adds a LEFT JOIN clause to the query using the Teabonus relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinTeabonus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Teabonus relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinTeabonus($relationAlias = null) Adds a INNER JOIN clause to the query using the Teabonus relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithTeabonus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Teabonus relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithTeabonus() Adds a LEFT JOIN clause and with to the query using the Teabonus relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithTeabonus() Adds a RIGHT JOIN clause and with to the query using the Teabonus relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithTeabonus() Adds a INNER JOIN clause and with to the query using the Teabonus relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinTeafactoryrateRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a LEFT JOIN clause to the query using the TeafactoryrateRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinTeafactoryrateRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TeafactoryrateRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinTeafactoryrateRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a INNER JOIN clause to the query using the TeafactoryrateRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithTeafactoryrateRelatedByStartopsmonthlycalendaroid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TeafactoryrateRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithTeafactoryrateRelatedByStartopsmonthlycalendaroid() Adds a LEFT JOIN clause and with to the query using the TeafactoryrateRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithTeafactoryrateRelatedByStartopsmonthlycalendaroid() Adds a RIGHT JOIN clause and with to the query using the TeafactoryrateRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithTeafactoryrateRelatedByStartopsmonthlycalendaroid() Adds a INNER JOIN clause and with to the query using the TeafactoryrateRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinTeafactoryrateRelatedByEndopsmonthlycalendaroid($relationAlias = null) Adds a LEFT JOIN clause to the query using the TeafactoryrateRelatedByEndopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinTeafactoryrateRelatedByEndopsmonthlycalendaroid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TeafactoryrateRelatedByEndopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinTeafactoryrateRelatedByEndopsmonthlycalendaroid($relationAlias = null) Adds a INNER JOIN clause to the query using the TeafactoryrateRelatedByEndopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithTeafactoryrateRelatedByEndopsmonthlycalendaroid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TeafactoryrateRelatedByEndopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithTeafactoryrateRelatedByEndopsmonthlycalendaroid() Adds a LEFT JOIN clause and with to the query using the TeafactoryrateRelatedByEndopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithTeafactoryrateRelatedByEndopsmonthlycalendaroid() Adds a RIGHT JOIN clause and with to the query using the TeafactoryrateRelatedByEndopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithTeafactoryrateRelatedByEndopsmonthlycalendaroid() Adds a INNER JOIN clause and with to the query using the TeafactoryrateRelatedByEndopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinTeafactorytriprateRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a LEFT JOIN clause to the query using the TeafactorytriprateRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinTeafactorytriprateRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TeafactorytriprateRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinTeafactorytriprateRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a INNER JOIN clause to the query using the TeafactorytriprateRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithTeafactorytriprateRelatedByStartopsmonthlycalendaroid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TeafactorytriprateRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithTeafactorytriprateRelatedByStartopsmonthlycalendaroid() Adds a LEFT JOIN clause and with to the query using the TeafactorytriprateRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithTeafactorytriprateRelatedByStartopsmonthlycalendaroid() Adds a RIGHT JOIN clause and with to the query using the TeafactorytriprateRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithTeafactorytriprateRelatedByStartopsmonthlycalendaroid() Adds a INNER JOIN clause and with to the query using the TeafactorytriprateRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinTeafactorytriprateRelatedByEndopsmonthlycalendaroid($relationAlias = null) Adds a LEFT JOIN clause to the query using the TeafactorytriprateRelatedByEndopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinTeafactorytriprateRelatedByEndopsmonthlycalendaroid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TeafactorytriprateRelatedByEndopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinTeafactorytriprateRelatedByEndopsmonthlycalendaroid($relationAlias = null) Adds a INNER JOIN clause to the query using the TeafactorytriprateRelatedByEndopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithTeafactorytriprateRelatedByEndopsmonthlycalendaroid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TeafactorytriprateRelatedByEndopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithTeafactorytriprateRelatedByEndopsmonthlycalendaroid() Adds a LEFT JOIN clause and with to the query using the TeafactorytriprateRelatedByEndopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithTeafactorytriprateRelatedByEndopsmonthlycalendaroid() Adds a RIGHT JOIN clause and with to the query using the TeafactorytriprateRelatedByEndopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithTeafactorytriprateRelatedByEndopsmonthlycalendaroid() Adds a INNER JOIN clause and with to the query using the TeafactorytriprateRelatedByEndopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinTeapandl($relationAlias = null) Adds a LEFT JOIN clause to the query using the Teapandl relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinTeapandl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Teapandl relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinTeapandl($relationAlias = null) Adds a INNER JOIN clause to the query using the Teapandl relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithTeapandl($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Teapandl relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithTeapandl() Adds a LEFT JOIN clause and with to the query using the Teapandl relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithTeapandl() Adds a RIGHT JOIN clause and with to the query using the Teapandl relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithTeapandl() Adds a INNER JOIN clause and with to the query using the Teapandl relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a LEFT JOIN clause to the query using the VehicleexpenseallocationRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VehicleexpenseallocationRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid($relationAlias = null) Adds a INNER JOIN clause to the query using the VehicleexpenseallocationRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VehicleexpenseallocationRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid() Adds a LEFT JOIN clause and with to the query using the VehicleexpenseallocationRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid() Adds a RIGHT JOIN clause and with to the query using the VehicleexpenseallocationRelatedByStartopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid() Adds a INNER JOIN clause and with to the query using the VehicleexpenseallocationRelatedByStartopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid($relationAlias = null) Adds a LEFT JOIN clause to the query using the VehicleexpenseallocationRelatedByEndopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VehicleexpenseallocationRelatedByEndopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid($relationAlias = null) Adds a INNER JOIN clause to the query using the VehicleexpenseallocationRelatedByEndopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery joinWithVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VehicleexpenseallocationRelatedByEndopsmonthlycalendaroid relation
 *
 * @method     ChildOpsmonthlycalendarQuery leftJoinWithVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid() Adds a LEFT JOIN clause and with to the query using the VehicleexpenseallocationRelatedByEndopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery rightJoinWithVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid() Adds a RIGHT JOIN clause and with to the query using the VehicleexpenseallocationRelatedByEndopsmonthlycalendaroid relation
 * @method     ChildOpsmonthlycalendarQuery innerJoinWithVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid() Adds a INNER JOIN clause and with to the query using the VehicleexpenseallocationRelatedByEndopsmonthlycalendaroid relation
 *
 * @method     \lwops\lwops\DairypandlQuery|\lwops\lwops\ElectricityallocationQuery|\lwops\lwops\ElectricityexpenseQuery|\lwops\lwops\EmployeeloanQuery|\lwops\lwops\FishpandlQuery|\lwops\lwops\FtesalaryadvanceQuery|\lwops\lwops\KiambaadairyQuery|\lwops\lwops\TeabonusQuery|\lwops\lwops\TeafactoryrateQuery|\lwops\lwops\TeafactorytriprateQuery|\lwops\lwops\TeapandlQuery|\lwops\lwops\VehicleexpenseallocationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOpsmonthlycalendar findOne(ConnectionInterface $con = null) Return the first ChildOpsmonthlycalendar matching the query
 * @method     ChildOpsmonthlycalendar findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOpsmonthlycalendar matching the query, or a new ChildOpsmonthlycalendar object populated from the query conditions when no match is found
 *
 * @method     ChildOpsmonthlycalendar findOneByOid(int $oid) Return the first ChildOpsmonthlycalendar filtered by the oid column
 * @method     ChildOpsmonthlycalendar findOneByMonthnbr(int $monthNbr) Return the first ChildOpsmonthlycalendar filtered by the monthNbr column
 * @method     ChildOpsmonthlycalendar findOneByMonth(string $month) Return the first ChildOpsmonthlycalendar filtered by the month column
 * @method     ChildOpsmonthlycalendar findOneByYear(int $year) Return the first ChildOpsmonthlycalendar filtered by the year column
 * @method     ChildOpsmonthlycalendar findOneByCreatetmstp(string $createTmstp) Return the first ChildOpsmonthlycalendar filtered by the createTmstp column
 * @method     ChildOpsmonthlycalendar findOneByUpdttmstp(string $updtTmstp) Return the first ChildOpsmonthlycalendar filtered by the updtTmstp column *

 * @method     ChildOpsmonthlycalendar requirePk($key, ConnectionInterface $con = null) Return the ChildOpsmonthlycalendar by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpsmonthlycalendar requireOne(ConnectionInterface $con = null) Return the first ChildOpsmonthlycalendar matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOpsmonthlycalendar requireOneByOid(int $oid) Return the first ChildOpsmonthlycalendar filtered by the oid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpsmonthlycalendar requireOneByMonthnbr(int $monthNbr) Return the first ChildOpsmonthlycalendar filtered by the monthNbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpsmonthlycalendar requireOneByMonth(string $month) Return the first ChildOpsmonthlycalendar filtered by the month column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpsmonthlycalendar requireOneByYear(int $year) Return the first ChildOpsmonthlycalendar filtered by the year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpsmonthlycalendar requireOneByCreatetmstp(string $createTmstp) Return the first ChildOpsmonthlycalendar filtered by the createTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOpsmonthlycalendar requireOneByUpdttmstp(string $updtTmstp) Return the first ChildOpsmonthlycalendar filtered by the updtTmstp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOpsmonthlycalendar[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOpsmonthlycalendar objects based on current ModelCriteria
 * @method     ChildOpsmonthlycalendar[]|ObjectCollection findByOid(int $oid) Return ChildOpsmonthlycalendar objects filtered by the oid column
 * @method     ChildOpsmonthlycalendar[]|ObjectCollection findByMonthnbr(int $monthNbr) Return ChildOpsmonthlycalendar objects filtered by the monthNbr column
 * @method     ChildOpsmonthlycalendar[]|ObjectCollection findByMonth(string $month) Return ChildOpsmonthlycalendar objects filtered by the month column
 * @method     ChildOpsmonthlycalendar[]|ObjectCollection findByYear(int $year) Return ChildOpsmonthlycalendar objects filtered by the year column
 * @method     ChildOpsmonthlycalendar[]|ObjectCollection findByCreatetmstp(string $createTmstp) Return ChildOpsmonthlycalendar objects filtered by the createTmstp column
 * @method     ChildOpsmonthlycalendar[]|ObjectCollection findByUpdttmstp(string $updtTmstp) Return ChildOpsmonthlycalendar objects filtered by the updtTmstp column
 * @method     ChildOpsmonthlycalendar[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OpsmonthlycalendarQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \lwops\lwops\Base\OpsmonthlycalendarQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\lwops\\lwops\\Opsmonthlycalendar', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOpsmonthlycalendarQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOpsmonthlycalendarQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOpsmonthlycalendarQuery) {
            return $criteria;
        }
        $query = new ChildOpsmonthlycalendarQuery();
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
     * @return ChildOpsmonthlycalendar|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OpsmonthlycalendarTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OpsmonthlycalendarTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOpsmonthlycalendar A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT oid, monthNbr, month, year, createTmstp, updtTmstp FROM opsmonthlycalendar WHERE oid = :p0';
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
            /** @var ChildOpsmonthlycalendar $obj */
            $obj = new ChildOpsmonthlycalendar();
            $obj->hydrate($row);
            OpsmonthlycalendarTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOpsmonthlycalendar|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $keys, Criteria::IN);
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
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByOid($oid = null, $comparison = null)
    {
        if (is_array($oid)) {
            $useMinMax = false;
            if (isset($oid['min'])) {
                $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $oid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oid['max'])) {
                $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $oid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $oid, $comparison);
    }

    /**
     * Filter the query on the monthNbr column
     *
     * Example usage:
     * <code>
     * $query->filterByMonthnbr(1234); // WHERE monthNbr = 1234
     * $query->filterByMonthnbr(array(12, 34)); // WHERE monthNbr IN (12, 34)
     * $query->filterByMonthnbr(array('min' => 12)); // WHERE monthNbr > 12
     * </code>
     *
     * @param     mixed $monthnbr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByMonthnbr($monthnbr = null, $comparison = null)
    {
        if (is_array($monthnbr)) {
            $useMinMax = false;
            if (isset($monthnbr['min'])) {
                $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_MONTHNBR, $monthnbr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($monthnbr['max'])) {
                $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_MONTHNBR, $monthnbr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_MONTHNBR, $monthnbr, $comparison);
    }

    /**
     * Filter the query on the month column
     *
     * Example usage:
     * <code>
     * $query->filterByMonth('fooValue');   // WHERE month = 'fooValue'
     * $query->filterByMonth('%fooValue%', Criteria::LIKE); // WHERE month LIKE '%fooValue%'
     * </code>
     *
     * @param     string $month The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByMonth($month = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($month)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_MONTH, $month, $comparison);
    }

    /**
     * Filter the query on the year column
     *
     * Example usage:
     * <code>
     * $query->filterByYear(1234); // WHERE year = 1234
     * $query->filterByYear(array(12, 34)); // WHERE year IN (12, 34)
     * $query->filterByYear(array('min' => 12)); // WHERE year > 12
     * </code>
     *
     * @param     mixed $year The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByYear($year = null, $comparison = null)
    {
        if (is_array($year)) {
            $useMinMax = false;
            if (isset($year['min'])) {
                $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_YEAR, $year['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($year['max'])) {
                $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_YEAR, $year['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_YEAR, $year, $comparison);
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
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByCreatetmstp($createtmstp = null, $comparison = null)
    {
        if (is_array($createtmstp)) {
            $useMinMax = false;
            if (isset($createtmstp['min'])) {
                $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_CREATETMSTP, $createtmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createtmstp['max'])) {
                $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_CREATETMSTP, $createtmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_CREATETMSTP, $createtmstp, $comparison);
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
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByUpdttmstp($updttmstp = null, $comparison = null)
    {
        if (is_array($updttmstp)) {
            $useMinMax = false;
            if (isset($updttmstp['min'])) {
                $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_UPDTTMSTP, $updttmstp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updttmstp['max'])) {
                $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_UPDTTMSTP, $updttmstp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_UPDTTMSTP, $updttmstp, $comparison);
    }

    /**
     * Filter the query by a related \lwops\lwops\Dairypandl object
     *
     * @param \lwops\lwops\Dairypandl|ObjectCollection $dairypandl the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByDairypandl($dairypandl, $comparison = null)
    {
        if ($dairypandl instanceof \lwops\lwops\Dairypandl) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $dairypandl->getOpsmonthlycalendaroid(), $comparison);
        } elseif ($dairypandl instanceof ObjectCollection) {
            return $this
                ->useDairypandlQuery()
                ->filterByPrimaryKeys($dairypandl->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDairypandl() only accepts arguments of type \lwops\lwops\Dairypandl or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dairypandl relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function joinDairypandl($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dairypandl');

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
            $this->addJoinObject($join, 'Dairypandl');
        }

        return $this;
    }

    /**
     * Use the Dairypandl relation Dairypandl object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\DairypandlQuery A secondary query class using the current class as primary query
     */
    public function useDairypandlQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDairypandl($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dairypandl', '\lwops\lwops\DairypandlQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Electricityallocation object
     *
     * @param \lwops\lwops\Electricityallocation|ObjectCollection $electricityallocation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByElectricityallocationRelatedByStartopsmonthlycalendaroid($electricityallocation, $comparison = null)
    {
        if ($electricityallocation instanceof \lwops\lwops\Electricityallocation) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $electricityallocation->getStartopsmonthlycalendaroid(), $comparison);
        } elseif ($electricityallocation instanceof ObjectCollection) {
            return $this
                ->useElectricityallocationRelatedByStartopsmonthlycalendaroidQuery()
                ->filterByPrimaryKeys($electricityallocation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByElectricityallocationRelatedByStartopsmonthlycalendaroid() only accepts arguments of type \lwops\lwops\Electricityallocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ElectricityallocationRelatedByStartopsmonthlycalendaroid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function joinElectricityallocationRelatedByStartopsmonthlycalendaroid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ElectricityallocationRelatedByStartopsmonthlycalendaroid');

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
            $this->addJoinObject($join, 'ElectricityallocationRelatedByStartopsmonthlycalendaroid');
        }

        return $this;
    }

    /**
     * Use the ElectricityallocationRelatedByStartopsmonthlycalendaroid relation Electricityallocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\ElectricityallocationQuery A secondary query class using the current class as primary query
     */
    public function useElectricityallocationRelatedByStartopsmonthlycalendaroidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinElectricityallocationRelatedByStartopsmonthlycalendaroid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ElectricityallocationRelatedByStartopsmonthlycalendaroid', '\lwops\lwops\ElectricityallocationQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Electricityallocation object
     *
     * @param \lwops\lwops\Electricityallocation|ObjectCollection $electricityallocation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByElectricityallocationRelatedByEndtopsmonthlycalendaroid($electricityallocation, $comparison = null)
    {
        if ($electricityallocation instanceof \lwops\lwops\Electricityallocation) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $electricityallocation->getEndtopsmonthlycalendaroid(), $comparison);
        } elseif ($electricityallocation instanceof ObjectCollection) {
            return $this
                ->useElectricityallocationRelatedByEndtopsmonthlycalendaroidQuery()
                ->filterByPrimaryKeys($electricityallocation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByElectricityallocationRelatedByEndtopsmonthlycalendaroid() only accepts arguments of type \lwops\lwops\Electricityallocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ElectricityallocationRelatedByEndtopsmonthlycalendaroid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function joinElectricityallocationRelatedByEndtopsmonthlycalendaroid($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ElectricityallocationRelatedByEndtopsmonthlycalendaroid');

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
            $this->addJoinObject($join, 'ElectricityallocationRelatedByEndtopsmonthlycalendaroid');
        }

        return $this;
    }

    /**
     * Use the ElectricityallocationRelatedByEndtopsmonthlycalendaroid relation Electricityallocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\ElectricityallocationQuery A secondary query class using the current class as primary query
     */
    public function useElectricityallocationRelatedByEndtopsmonthlycalendaroidQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinElectricityallocationRelatedByEndtopsmonthlycalendaroid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ElectricityallocationRelatedByEndtopsmonthlycalendaroid', '\lwops\lwops\ElectricityallocationQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Electricityexpense object
     *
     * @param \lwops\lwops\Electricityexpense|ObjectCollection $electricityexpense the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByElectricityexpense($electricityexpense, $comparison = null)
    {
        if ($electricityexpense instanceof \lwops\lwops\Electricityexpense) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $electricityexpense->getOpsmonthlycalendaroid(), $comparison);
        } elseif ($electricityexpense instanceof ObjectCollection) {
            return $this
                ->useElectricityexpenseQuery()
                ->filterByPrimaryKeys($electricityexpense->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByElectricityexpense() only accepts arguments of type \lwops\lwops\Electricityexpense or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Electricityexpense relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function joinElectricityexpense($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Electricityexpense');

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
            $this->addJoinObject($join, 'Electricityexpense');
        }

        return $this;
    }

    /**
     * Use the Electricityexpense relation Electricityexpense object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\ElectricityexpenseQuery A secondary query class using the current class as primary query
     */
    public function useElectricityexpenseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinElectricityexpense($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Electricityexpense', '\lwops\lwops\ElectricityexpenseQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Employeeloan object
     *
     * @param \lwops\lwops\Employeeloan|ObjectCollection $employeeloan the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByEmployeeloan($employeeloan, $comparison = null)
    {
        if ($employeeloan instanceof \lwops\lwops\Employeeloan) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $employeeloan->getOpsmonthlycalendaroid(), $comparison);
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
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Fishpandl object
     *
     * @param \lwops\lwops\Fishpandl|ObjectCollection $fishpandl the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByFishpandl($fishpandl, $comparison = null)
    {
        if ($fishpandl instanceof \lwops\lwops\Fishpandl) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $fishpandl->getOpsmonthlycalendaroid(), $comparison);
        } elseif ($fishpandl instanceof ObjectCollection) {
            return $this
                ->useFishpandlQuery()
                ->filterByPrimaryKeys($fishpandl->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFishpandl() only accepts arguments of type \lwops\lwops\Fishpandl or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fishpandl relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function joinFishpandl($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fishpandl');

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
            $this->addJoinObject($join, 'Fishpandl');
        }

        return $this;
    }

    /**
     * Use the Fishpandl relation Fishpandl object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\FishpandlQuery A secondary query class using the current class as primary query
     */
    public function useFishpandlQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFishpandl($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fishpandl', '\lwops\lwops\FishpandlQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Ftesalaryadvance object
     *
     * @param \lwops\lwops\Ftesalaryadvance|ObjectCollection $ftesalaryadvance the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByFtesalaryadvance($ftesalaryadvance, $comparison = null)
    {
        if ($ftesalaryadvance instanceof \lwops\lwops\Ftesalaryadvance) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $ftesalaryadvance->getOpsmonthlycalendaroid(), $comparison);
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
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
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
     * Filter the query by a related \lwops\lwops\Kiambaadairy object
     *
     * @param \lwops\lwops\Kiambaadairy|ObjectCollection $kiambaadairy the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByKiambaadairy($kiambaadairy, $comparison = null)
    {
        if ($kiambaadairy instanceof \lwops\lwops\Kiambaadairy) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $kiambaadairy->getOpsmonthlycalendaoid(), $comparison);
        } elseif ($kiambaadairy instanceof ObjectCollection) {
            return $this
                ->useKiambaadairyQuery()
                ->filterByPrimaryKeys($kiambaadairy->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByKiambaadairy() only accepts arguments of type \lwops\lwops\Kiambaadairy or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Kiambaadairy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function joinKiambaadairy($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Kiambaadairy');

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
            $this->addJoinObject($join, 'Kiambaadairy');
        }

        return $this;
    }

    /**
     * Use the Kiambaadairy relation Kiambaadairy object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\KiambaadairyQuery A secondary query class using the current class as primary query
     */
    public function useKiambaadairyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinKiambaadairy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Kiambaadairy', '\lwops\lwops\KiambaadairyQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Teabonus object
     *
     * @param \lwops\lwops\Teabonus|ObjectCollection $teabonus the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByTeabonus($teabonus, $comparison = null)
    {
        if ($teabonus instanceof \lwops\lwops\Teabonus) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $teabonus->getOpsmonthlycalendaroid(), $comparison);
        } elseif ($teabonus instanceof ObjectCollection) {
            return $this
                ->useTeabonusQuery()
                ->filterByPrimaryKeys($teabonus->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTeabonus() only accepts arguments of type \lwops\lwops\Teabonus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Teabonus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function joinTeabonus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Teabonus');

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
            $this->addJoinObject($join, 'Teabonus');
        }

        return $this;
    }

    /**
     * Use the Teabonus relation Teabonus object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\TeabonusQuery A secondary query class using the current class as primary query
     */
    public function useTeabonusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTeabonus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Teabonus', '\lwops\lwops\TeabonusQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Teafactoryrate object
     *
     * @param \lwops\lwops\Teafactoryrate|ObjectCollection $teafactoryrate the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByTeafactoryrateRelatedByStartopsmonthlycalendaroid($teafactoryrate, $comparison = null)
    {
        if ($teafactoryrate instanceof \lwops\lwops\Teafactoryrate) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $teafactoryrate->getStartopsmonthlycalendaroid(), $comparison);
        } elseif ($teafactoryrate instanceof ObjectCollection) {
            return $this
                ->useTeafactoryrateRelatedByStartopsmonthlycalendaroidQuery()
                ->filterByPrimaryKeys($teafactoryrate->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTeafactoryrateRelatedByStartopsmonthlycalendaroid() only accepts arguments of type \lwops\lwops\Teafactoryrate or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TeafactoryrateRelatedByStartopsmonthlycalendaroid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function joinTeafactoryrateRelatedByStartopsmonthlycalendaroid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TeafactoryrateRelatedByStartopsmonthlycalendaroid');

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
            $this->addJoinObject($join, 'TeafactoryrateRelatedByStartopsmonthlycalendaroid');
        }

        return $this;
    }

    /**
     * Use the TeafactoryrateRelatedByStartopsmonthlycalendaroid relation Teafactoryrate object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\TeafactoryrateQuery A secondary query class using the current class as primary query
     */
    public function useTeafactoryrateRelatedByStartopsmonthlycalendaroidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTeafactoryrateRelatedByStartopsmonthlycalendaroid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TeafactoryrateRelatedByStartopsmonthlycalendaroid', '\lwops\lwops\TeafactoryrateQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Teafactoryrate object
     *
     * @param \lwops\lwops\Teafactoryrate|ObjectCollection $teafactoryrate the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByTeafactoryrateRelatedByEndopsmonthlycalendaroid($teafactoryrate, $comparison = null)
    {
        if ($teafactoryrate instanceof \lwops\lwops\Teafactoryrate) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $teafactoryrate->getEndopsmonthlycalendaroid(), $comparison);
        } elseif ($teafactoryrate instanceof ObjectCollection) {
            return $this
                ->useTeafactoryrateRelatedByEndopsmonthlycalendaroidQuery()
                ->filterByPrimaryKeys($teafactoryrate->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTeafactoryrateRelatedByEndopsmonthlycalendaroid() only accepts arguments of type \lwops\lwops\Teafactoryrate or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TeafactoryrateRelatedByEndopsmonthlycalendaroid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function joinTeafactoryrateRelatedByEndopsmonthlycalendaroid($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TeafactoryrateRelatedByEndopsmonthlycalendaroid');

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
            $this->addJoinObject($join, 'TeafactoryrateRelatedByEndopsmonthlycalendaroid');
        }

        return $this;
    }

    /**
     * Use the TeafactoryrateRelatedByEndopsmonthlycalendaroid relation Teafactoryrate object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\TeafactoryrateQuery A secondary query class using the current class as primary query
     */
    public function useTeafactoryrateRelatedByEndopsmonthlycalendaroidQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTeafactoryrateRelatedByEndopsmonthlycalendaroid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TeafactoryrateRelatedByEndopsmonthlycalendaroid', '\lwops\lwops\TeafactoryrateQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Teafactorytriprate object
     *
     * @param \lwops\lwops\Teafactorytriprate|ObjectCollection $teafactorytriprate the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByTeafactorytriprateRelatedByStartopsmonthlycalendaroid($teafactorytriprate, $comparison = null)
    {
        if ($teafactorytriprate instanceof \lwops\lwops\Teafactorytriprate) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $teafactorytriprate->getStartopsmonthlycalendaroid(), $comparison);
        } elseif ($teafactorytriprate instanceof ObjectCollection) {
            return $this
                ->useTeafactorytriprateRelatedByStartopsmonthlycalendaroidQuery()
                ->filterByPrimaryKeys($teafactorytriprate->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTeafactorytriprateRelatedByStartopsmonthlycalendaroid() only accepts arguments of type \lwops\lwops\Teafactorytriprate or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TeafactorytriprateRelatedByStartopsmonthlycalendaroid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function joinTeafactorytriprateRelatedByStartopsmonthlycalendaroid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TeafactorytriprateRelatedByStartopsmonthlycalendaroid');

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
            $this->addJoinObject($join, 'TeafactorytriprateRelatedByStartopsmonthlycalendaroid');
        }

        return $this;
    }

    /**
     * Use the TeafactorytriprateRelatedByStartopsmonthlycalendaroid relation Teafactorytriprate object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\TeafactorytriprateQuery A secondary query class using the current class as primary query
     */
    public function useTeafactorytriprateRelatedByStartopsmonthlycalendaroidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTeafactorytriprateRelatedByStartopsmonthlycalendaroid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TeafactorytriprateRelatedByStartopsmonthlycalendaroid', '\lwops\lwops\TeafactorytriprateQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Teafactorytriprate object
     *
     * @param \lwops\lwops\Teafactorytriprate|ObjectCollection $teafactorytriprate the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByTeafactorytriprateRelatedByEndopsmonthlycalendaroid($teafactorytriprate, $comparison = null)
    {
        if ($teafactorytriprate instanceof \lwops\lwops\Teafactorytriprate) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $teafactorytriprate->getEndopsmonthlycalendaroid(), $comparison);
        } elseif ($teafactorytriprate instanceof ObjectCollection) {
            return $this
                ->useTeafactorytriprateRelatedByEndopsmonthlycalendaroidQuery()
                ->filterByPrimaryKeys($teafactorytriprate->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTeafactorytriprateRelatedByEndopsmonthlycalendaroid() only accepts arguments of type \lwops\lwops\Teafactorytriprate or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TeafactorytriprateRelatedByEndopsmonthlycalendaroid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function joinTeafactorytriprateRelatedByEndopsmonthlycalendaroid($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TeafactorytriprateRelatedByEndopsmonthlycalendaroid');

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
            $this->addJoinObject($join, 'TeafactorytriprateRelatedByEndopsmonthlycalendaroid');
        }

        return $this;
    }

    /**
     * Use the TeafactorytriprateRelatedByEndopsmonthlycalendaroid relation Teafactorytriprate object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\TeafactorytriprateQuery A secondary query class using the current class as primary query
     */
    public function useTeafactorytriprateRelatedByEndopsmonthlycalendaroidQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTeafactorytriprateRelatedByEndopsmonthlycalendaroid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TeafactorytriprateRelatedByEndopsmonthlycalendaroid', '\lwops\lwops\TeafactorytriprateQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Teapandl object
     *
     * @param \lwops\lwops\Teapandl|ObjectCollection $teapandl the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByTeapandl($teapandl, $comparison = null)
    {
        if ($teapandl instanceof \lwops\lwops\Teapandl) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $teapandl->getOpsmonthlycalendaroid(), $comparison);
        } elseif ($teapandl instanceof ObjectCollection) {
            return $this
                ->useTeapandlQuery()
                ->filterByPrimaryKeys($teapandl->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTeapandl() only accepts arguments of type \lwops\lwops\Teapandl or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Teapandl relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function joinTeapandl($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Teapandl');

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
            $this->addJoinObject($join, 'Teapandl');
        }

        return $this;
    }

    /**
     * Use the Teapandl relation Teapandl object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\TeapandlQuery A secondary query class using the current class as primary query
     */
    public function useTeapandlQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTeapandl($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Teapandl', '\lwops\lwops\TeapandlQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Vehicleexpenseallocation object
     *
     * @param \lwops\lwops\Vehicleexpenseallocation|ObjectCollection $vehicleexpenseallocation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid($vehicleexpenseallocation, $comparison = null)
    {
        if ($vehicleexpenseallocation instanceof \lwops\lwops\Vehicleexpenseallocation) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $vehicleexpenseallocation->getStartopsmonthlycalendaroid(), $comparison);
        } elseif ($vehicleexpenseallocation instanceof ObjectCollection) {
            return $this
                ->useVehicleexpenseallocationRelatedByStartopsmonthlycalendaroidQuery()
                ->filterByPrimaryKeys($vehicleexpenseallocation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid() only accepts arguments of type \lwops\lwops\Vehicleexpenseallocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VehicleexpenseallocationRelatedByStartopsmonthlycalendaroid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function joinVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VehicleexpenseallocationRelatedByStartopsmonthlycalendaroid');

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
            $this->addJoinObject($join, 'VehicleexpenseallocationRelatedByStartopsmonthlycalendaroid');
        }

        return $this;
    }

    /**
     * Use the VehicleexpenseallocationRelatedByStartopsmonthlycalendaroid relation Vehicleexpenseallocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\VehicleexpenseallocationQuery A secondary query class using the current class as primary query
     */
    public function useVehicleexpenseallocationRelatedByStartopsmonthlycalendaroidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVehicleexpenseallocationRelatedByStartopsmonthlycalendaroid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VehicleexpenseallocationRelatedByStartopsmonthlycalendaroid', '\lwops\lwops\VehicleexpenseallocationQuery');
    }

    /**
     * Filter the query by a related \lwops\lwops\Vehicleexpenseallocation object
     *
     * @param \lwops\lwops\Vehicleexpenseallocation|ObjectCollection $vehicleexpenseallocation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function filterByVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid($vehicleexpenseallocation, $comparison = null)
    {
        if ($vehicleexpenseallocation instanceof \lwops\lwops\Vehicleexpenseallocation) {
            return $this
                ->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $vehicleexpenseallocation->getEndopsmonthlycalendaroid(), $comparison);
        } elseif ($vehicleexpenseallocation instanceof ObjectCollection) {
            return $this
                ->useVehicleexpenseallocationRelatedByEndopsmonthlycalendaroidQuery()
                ->filterByPrimaryKeys($vehicleexpenseallocation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid() only accepts arguments of type \lwops\lwops\Vehicleexpenseallocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VehicleexpenseallocationRelatedByEndopsmonthlycalendaroid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function joinVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VehicleexpenseallocationRelatedByEndopsmonthlycalendaroid');

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
            $this->addJoinObject($join, 'VehicleexpenseallocationRelatedByEndopsmonthlycalendaroid');
        }

        return $this;
    }

    /**
     * Use the VehicleexpenseallocationRelatedByEndopsmonthlycalendaroid relation Vehicleexpenseallocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \lwops\lwops\VehicleexpenseallocationQuery A secondary query class using the current class as primary query
     */
    public function useVehicleexpenseallocationRelatedByEndopsmonthlycalendaroidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVehicleexpenseallocationRelatedByEndopsmonthlycalendaroid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VehicleexpenseallocationRelatedByEndopsmonthlycalendaroid', '\lwops\lwops\VehicleexpenseallocationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildOpsmonthlycalendar $opsmonthlycalendar Object to remove from the list of results
     *
     * @return $this|ChildOpsmonthlycalendarQuery The current query, for fluid interface
     */
    public function prune($opsmonthlycalendar = null)
    {
        if ($opsmonthlycalendar) {
            $this->addUsingAlias(OpsmonthlycalendarTableMap::COL_OID, $opsmonthlycalendar->getOid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the opsmonthlycalendar table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OpsmonthlycalendarTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OpsmonthlycalendarTableMap::clearInstancePool();
            OpsmonthlycalendarTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OpsmonthlycalendarTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OpsmonthlycalendarTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OpsmonthlycalendarTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OpsmonthlycalendarTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OpsmonthlycalendarQuery
