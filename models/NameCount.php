<?php

require_once 'DAO/DAO.php';

/**
/* Class NameCount
*/
Class NameCount extends EntityBase
{

  public $name;
  public $count;

  //Constructor
  public function __construct()
  {
    parent::__construct();
    $this->fields=array('username','count');
  }

  public function bestSeller()
  {
    $sql="SELECT `username`,COUNT(id) AS count FROM mysell_posts WHERE `status`='0' GROUP BY `username` ORDER BY count DESC";
    return $this->getSelfObjects($sql);
  }
}
?>