<?php

require_once 'DAO.php';

/**
/* Class CategoryDAO
*/
abstract class CategoryDAO extends EntityBase
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
  /* @var varchar $id2
   */
  public $id2;


  /**
  /* Constructor
  /* @var mixed $id
   */
  public function __construct($id=0)
  {
    parent::__construct();
    $this->table='mysell_cat';
    $this->primkeys=array('id');
    $this->fields=array('id','name','id2');
    $this->sql="SELECT * FROM {$this->table}";
    if($id) $this->read($id);
  }

  /**
  /* Primary Key Finder
  /* @return object
   */
  public function findById($id)
  {
    $sql="SELECT * FROM mysell_cat WHERE id='$id' LIMIT 1";
    return $this->getSelfObject($sql);
  }

  // ==========!!!DO NOT PUT YOUR OWN CODE (BUSINESS LOGIC) HERE!!!==========
  // EXTEND THIS DAO CLASS WITH YOUR ONW CLASS CONTAINING YOUR BUSINESS LOGIC
  // BECAUSE THIS CLASS WILL BE !!RECREATED--OVERWRITTEN!! ON NEXT PHPDAO RUN
}

