<?php

require_once 'DAO.php';

/**
/* Class OpstimedimensionDAO
*/
abstract class OpstimedimensionDAO extends EntityBase
{
  /**
  /*  (PK)
  /* @var int $oid
   */
  public $oid;

  /**
  /* 
  /* @var date $db_date
   */
  public $db_date;

  /**
  /* 
  /* @var int $year
   */
  public $year;

  /**
  /* 
  /* @var int $month
   */
  public $month;

  /**
  /* 
  /* @var int $day
   */
  public $day;

  /**
  /* 
  /* @var int $quarter
   */
  public $quarter;

  /**
  /* 
  /* @var int $week
   */
  public $week;

  /**
  /* 
  /* @var varchar $day_name
   */
  public $day_name;

  /**
  /* 
  /* @var varchar $month_name
   */
  public $month_name;

  /**
  /* 
  /* @var char $holiday_flag
   */
  public $holiday_flag;

  /**
  /* 
  /* @var char $weekend_flag
   */
  public $weekend_flag;

  /**
  /* 
  /* @var varchar $event
   */
  public $event;


  /**
  /* Constructor
  /* @var mixed $id
   */
  public function __construct($id=0)
  {
    parent::__construct();
    $this->table='opstimedimension';
    $this->primkeys=array('oid');
    $this->fields=array('db_date','year','month','day','quarter','week','day_name','month_name','holiday_flag','weekend_flag','event');
    $this->sql="SELECT * FROM {$this->table}";
    if($id) $this->read($id);
  }

  /**
  /* Primary Key Finder
  /* @return object
   */
  public function findByOid($oid)
  {
    $sql="SELECT * FROM opstimedimension WHERE oid='$oid' LIMIT 1";
    return $this->getSelfObject($sql);
  }

  /**
  /* Column db_date Finder
  /* @return object[]
   */
  public function findByDbDate($db_date)
  {
    $sql="SELECT * FROM opstimedimension WHERE db_date='$db_date'";
    return $this->getSelfObjects($sql);
  }

  /**
  /* Column year Finder
  /* @return object[]
   */
  public function findByYear($year)
  {
    $sql="SELECT * FROM opstimedimension WHERE year='$year'";
    return $this->getSelfObjects($sql);
  }

  /**
  /* Column month Finder
  /* @return object[]
   */
  public function findByMonth($month)
  {
    $sql="SELECT * FROM opstimedimension WHERE month='$month'";
    return $this->getSelfObjects($sql);
  }

  /**
  /* Column day Finder
  /* @return object[]
   */
  public function findByDay($day)
  {
    $sql="SELECT * FROM opstimedimension WHERE day='$day'";
    return $this->getSelfObjects($sql);
  }

  /**
  /* Column quarter Finder
  /* @return object[]
   */
  public function findByQuarter($quarter)
  {
    $sql="SELECT * FROM opstimedimension WHERE quarter='$quarter'";
    return $this->getSelfObjects($sql);
  }

  /**
  /* Column week Finder
  /* @return object[]
   */
  public function findByWeek($week)
  {
    $sql="SELECT * FROM opstimedimension WHERE week='$week'";
    return $this->getSelfObjects($sql);
  }

  /**
  /* Column day_name Finder
  /* @return object[]
   */
  public function findByDayName($day_name)
  {
    $sql="SELECT * FROM opstimedimension WHERE day_name='$day_name'";
    return $this->getSelfObjects($sql);
  }

  /**
  /* Column month_name Finder
  /* @return object[]
   */
  public function findByMonthName($month_name)
  {
    $sql="SELECT * FROM opstimedimension WHERE month_name='$month_name'";
    return $this->getSelfObjects($sql);
  }

  /**
  /* Column holiday_flag Finder
  /* @return object[]
   */
  public function findByHolidayFlag($holiday_flag)
  {
    $sql="SELECT * FROM opstimedimension WHERE holiday_flag='$holiday_flag'";
    return $this->getSelfObjects($sql);
  }

  /**
  /* Column weekend_flag Finder
  /* @return object[]
   */
  public function findByWeekendFlag($weekend_flag)
  {
    $sql="SELECT * FROM opstimedimension WHERE weekend_flag='$weekend_flag'";
    return $this->getSelfObjects($sql);
  }

  /**
  /* Column event Finder
  /* @return object[]
   */
  public function findByEvent($event)
  {
    $sql="SELECT * FROM opstimedimension WHERE event='$event'";
    return $this->getSelfObjects($sql);
  }

  // ==========!!!DO NOT PUT YOUR OWN CODE (BUSINESS LOGIC) HERE!!!==========
  // EXTEND THIS DAO CLASS WITH YOUR ONW CLASS CONTAINING YOUR BUSINESS LOGIC
  // BECAUSE THIS CLASS WILL BE !!RECREATED--OVERWRITTEN!! ON NEXT PHPDAO RUN
}

