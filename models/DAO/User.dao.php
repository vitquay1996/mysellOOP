<?php

require_once 'DAO.php';

/**
/* Class UserDAO
*/
abstract class UserDAO extends EntityBase
{
  /**
  /*  (PK)
  /* @var int $id
   */
  public $id;

  /**
  /* 
  /* @var text $name
   */
  public $name;

  /**
  /* 
  /* @var text $username
   */
  public $username;

  /**
  /* 
  /* @var text $password
   */
  public $password;

  /**
  /* 
  /* @var text $email
   */
  public $email;

  /**
  /* 
  /* @var date $date
   */
  public $date;

  /**
  /* 
  /* @var int $admin
   */
  public $admin;


  /**
  /* Constructor
  /* @var mixed $id
   */
  public function __construct($id=0)
  {
    parent::__construct();
    $this->table='mysell_users';
    $this->primkeys=array('id');
    $this->fields=array('id','name','username','password','email','date','admin');
    $this->sql="SELECT * FROM {$this->table}";
    if($id) $this->read($id);
  }

  /**
  /* Primary Key Finder
  /* @return object
   */
  public function findById($id)
  {
    $sql="SELECT * FROM mysell_users WHERE id='$id' LIMIT 1";
    return $this->getSelfObject($sql);
  }

  /**
  /* Column name Finder
  /* @return object[]
   */
  public function findByName($name)
  {
    $sql="SELECT * FROM mysell_users WHERE name='$name'";
    return $this->getSelfObjects($sql);
  }

  // ==========!!!DO NOT PUT YOUR OWN CODE (BUSINESS LOGIC) HERE!!!==========
  // EXTEND THIS DAO CLASS WITH YOUR ONW CLASS CONTAINING YOUR BUSINESS LOGIC
  // BECAUSE THIS CLASS WILL BE !!RECREATED--OVERWRITTEN!! ON NEXT PHPDAO RUN
}

