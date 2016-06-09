<?php

require_once 'DAO/DAO.php';

/**
/* Class DateCount
*/
Class DateCount extends EntityBase
{

  public $date;
  public $count;

  //Constructor
  public function __construct()
  {
    parent::__construct();
    $this->fields=array('date','count');
  }

  public function postPerDay()
  {
    $sql="SELECT `date`, COUNT('id') AS count FROM mysell_posts GROUP BY `date`";
    return $this->getSelfObjects($sql);
  }
}
?>