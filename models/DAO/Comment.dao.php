<?php

require_once 'DAO.php';

/**
/* Class CommentDAO
*/
abstract class CommentDAO extends EntityBase
{
  /**
  /*  (PK)
  /* @var int $id
   */
  public $id;

  /**
  /* 
  /* @var text $username
   */
  public $username;

  /**
  /* 
  /* @var int $postID
   */
  public $postID;

  /**
  /* 
  /* @var text $content
   */
  public $content;

  /**
  /* 
  /* @var date $date
   */
  public $date;


  /**
  /* Constructor
  /* @var mixed $id
   */
  public function __construct($id=0)
  {
    parent::__construct();
    $this->table='mysell_comments';
    $this->primkeys=array('id');
    $this->fields=array('id','username','postID','content','date');
    $this->sql="SELECT * FROM {$this->table}";
    if($id) $this->read($id);
  }

  /**
  /* Primary Key Finder
  /* @return object
   */
  public function findById($id)
  {
    $sql="SELECT * FROM mysell_comments WHERE id='$id' LIMIT 1";
    return $this->getSelfObject($sql);
  }

  /**
  /* Column postID Finder
  /* @return object[]
   */
  public function findByPostID($postID)
  {
    $sql="SELECT * FROM mysell_comments WHERE postID='$postID'";
    return $this->getSelfObjects($sql);
  }

  // ==========!!!DO NOT PUT YOUR OWN CODE (BUSINESS LOGIC) HERE!!!==========
  // EXTEND THIS DAO CLASS WITH YOUR ONW CLASS CONTAINING YOUR BUSINESS LOGIC
  // BECAUSE THIS CLASS WILL BE !!RECREATED--OVERWRITTEN!! ON NEXT PHPDAO RUN
}

