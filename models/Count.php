<?php

require_once 'DAO/DAO.php';

/**
/* Class Count
*/
Class Count extends EntityBase
{

  public $count;

  //Constructor
  public function __construct()
  {
    parent::__construct();
    $this->fields=array('count');
  }
  //Count total number of users
  public function totalUser()
  {
    $sql="SELECT COUNT('id') AS count FROM mysell_users";
    return $this->getSelfObject($sql);
  }

  public function userLastWeek()
  {
    $sql="SELECT COUNT('id') AS count FROM mysell_users WHERE `date` < now() - interval 7 day";
    return $this->getSelfObject($sql);
  }

  public function totalPost()
  {
    $sql="SELECT COUNT('id') AS count FROM mysell_posts";
    return $this->getSelfObject($sql);
  }

  public function postLastWeek()
  {
    $sql="SELECT COUNT('id') AS count FROM mysell_posts WHERE `date` < now() - interval 7 day";
    return $this->getSelfObject($sql);
  }

  public function postThisWeek()
  {
    $sql="SELECT COUNT('id') AS count FROM mysell_posts WHERE `date` >= now() - interval 7 day";
    return $this->getSelfObject($sql);
  }

  public function postPerLastWeek()
  {
    $sql="SELECT COUNT('id') AS count FROM mysell_posts WHERE `date` < now() - interval 7 day AND `date` >= now() - interval 14 day";
    return $this->getSelfObject($sql);
  }

  public function userThisWeek()
  {
    $sql="SELECT COUNT('id') AS count FROM mysell_users WHERE `date` >= now() - interval 7 day";
    return $this->getSelfObject($sql);
  }

  public function userPerLastWeek()
  {
    $sql="SELECT COUNT('id') AS count FROM mysell_users WHERE `date` < now() - interval 7 day AND `date` >= now() - interval 14 day";
    return $this->getSelfObject($sql);
  }



  // ==========!!!DO NOT PUT YOUR OWN CODE (BUSINESS LOGIC) HERE!!!==========
  // EXTEND THIS DAO CLASS WITH YOUR ONW CLASS CONTAINING YOUR BUSINESS LOGIC
  // BECAUSE THIS CLASS WILL BE !!RECREATED--OVERWRITTEN!! ON NEXT PHPDAO RUN
}

