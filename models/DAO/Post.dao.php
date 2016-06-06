<?php

require_once 'DAO.php';

/**
/* Class PostDAO
*/
abstract class PostDAO extends EntityBase
{
  /**
  /*  (PK)
  /* @var int $id
   */
  public $id;

  /**
  /* 
  /* @var text $title
   */
  public $title;

  /**
  /* 
  /* @var text $description
   */
  public $description;

  /**
  /* 
  /* @var varchar $username
   */
  public $username;

  /**
  /* 
  /* @var text $catID
   */
  public $catID;

  /**
  /* 
  /* @var double $price
   */
  public $price;

  /**
  /* 
  /* @var date $date
   */
  public $date;

  /**
  /* 
  /* @var tinyint $status
   */
  public $status;



  /**
  /* Constructor
  /* @var mixed $id
   */
  public function __construct($id=0)
  {
    parent::__construct();
    $this->table='mysell_posts';
    $this->primkeys=array('id');
    $this->fields=array('id','title','description','username','catID','price','date','status');
    $this->sql="SELECT * FROM {$this->table}";
    if($id) $this->read($id);
  }

  /**
  /* Primary Key Finder
  /* @return object
   */
  public function findById($id)
  {
    $sql="SELECT * FROM mysell_posts WHERE id='$id' LIMIT 1";
    return $this->getSelfObject($sql);
  }

  /**
  /* Column title Finder
  /* @return object[]
   */
  public function findByTitle($title)
  {
    $sql="SELECT * FROM mysell_posts WHERE title='$title'";
    return $this->getSelfObjects($sql);
  }

  /**
  /* Column description Finder
  /* @return object[]
   */
  public function findByDescription($description)
  {
    $sql="SELECT * FROM mysell_posts WHERE description='$description'";
    return $this->getSelfObjects($sql);
  }

  // ==========!!!DO NOT PUT YOUR OWN CODE (BUSINESS LOGIC) HERE!!!==========
  // EXTEND THIS DAO CLASS WITH YOUR ONW CLASS CONTAINING YOUR BUSINESS LOGIC
  // BECAUSE THIS CLASS WILL BE !!RECREATED--OVERWRITTEN!! ON NEXT PHPDAO RUN
}

