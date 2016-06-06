<?php

/**
 * Description of Engine
 *
 * @author sbrbot
 */
class Engine
{
  private $DB_HOST;
  private $DB_NAME;
  private $DB_USER;
  private $DB_PASS;

  private $db;

  //----------------------------------------------------------------------------

  public function __construct()
  {
    $this->DB_HOST=$_SESSION['DB_HOST'];
    $this->DB_NAME=$_SESSION['DB_NAME'];
    $this->DB_USER=$_SESSION['DB_USER'];
    $this->DB_PASS=$_SESSION['DB_PASS'];
    $this->db=new mysqli($this->DB_HOST,$this->DB_USER,$this->DB_PASS,$this->DB_NAME);
  }

  public function __destruct()
  {
    $this->db->close();
  }

  //----------------------------------------------------------------------------

  public function getTables()
  {
    $tables=array();

    $sql="SELECT *
            FROM INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA='{$this->DB_NAME}'";

    $rst=$this->db->query($sql);

    while($table=$rst->fetch_assoc()) $tables[]=$table;

    $rst->free();

    return $tables;
  }

//  public function getViews()
//  {
//    $views=array();
//
//    $sql="SELECT *
//            FROM INFORMATION_SCHEMA.VIEWS
//           WHERE TABLE_SCHEMA='$this->DB_NAME'";
//
//    $rst=$this->db->query($sql);
//
//    while($view=$rst->fetch_assoc()) $views[]=$view;
//
//    $rst->free();
//
//    return $views;
//  }

  public function getColumns($table)
  {
    $entities=array();

    $sql="
SELECT c.COLUMN_NAME,
        IF(EXISTS(SELECT *
                    FROM information_schema.KEY_COLUMN_USAGE k
                    JOIN information_schema.TABLE_CONSTRAINTS tc
                     ON (k.TABLE_SCHEMA=tc.TABLE_SCHEMA
                         AND k.TABLE_NAME=tc.TABLE_NAME
                         AND k.CONSTRAINT_NAME=tc.CONSTRAINT_NAME)
                   WHERE k.TABLE_SCHEMA=c.TABLE_SCHEMA
                         AND k.TABLE_NAME=c.TABLE_NAME
                         AND k.COLUMN_NAME=c.COLUMN_NAME
                         AND tc.CONSTRAINT_TYPE='PRIMARY KEY'),'PK',null) AS `PK`,
        IF(EXISTS(SELECT *
                    FROM information_schema.KEY_COLUMN_USAGE k
                    JOIN information_schema.TABLE_CONSTRAINTS tc
                     ON (k.TABLE_SCHEMA=tc.TABLE_SCHEMA
                         AND k.TABLE_NAME=tc.TABLE_NAME
                         AND k.CONSTRAINT_NAME=tc.CONSTRAINT_NAME)
                   WHERE k.TABLE_SCHEMA=c.TABLE_SCHEMA
                         AND k.TABLE_NAME=c.TABLE_NAME
                         AND k.COLUMN_NAME=c.COLUMN_NAME
                         AND tc.CONSTRAINT_TYPE='UNIQUE'),'UQ',null) AS `UQ`,
        IF(EXISTS(SELECT *
                    FROM information_schema.KEY_COLUMN_USAGE k
                    JOIN information_schema.TABLE_CONSTRAINTS tc
                     ON (k.TABLE_SCHEMA=tc.TABLE_SCHEMA
                         AND k.TABLE_NAME=tc.TABLE_NAME
                         AND k.CONSTRAINT_NAME=tc.CONSTRAINT_NAME)
                   WHERE k.TABLE_SCHEMA=c.TABLE_SCHEMA
                         AND k.TABLE_NAME=c.TABLE_NAME
                         AND k.COLUMN_NAME=c.COLUMN_NAME
                         AND tc.CONSTRAINT_TYPE='FOREIGN KEY'),'FK',null) AS `FK`,
        IF(EXISTS(SELECT *
                    FROM information_schema.STATISTICS s
                   WHERE s.TABLE_SCHEMA=c.TABLE_SCHEMA
                         AND s.TABLE_NAME=c.TABLE_NAME
                         AND s.COLUMN_NAME=c.COLUMN_NAME),'IDX',null) AS `IDX`,
       IF(c.EXTRA='auto_increment','AI',null) AS `AI`,
       IF(c.IS_NULLABLE='YES','NN',null) AS `NN`,
       c.DATA_TYPE,
       c.COLUMN_TYPE,
       c.CHARACTER_MAXIMUM_LENGTH,
       c.COLUMN_COMMENT,
       k.REFERENCED_TABLE_SCHEMA,
       k.REFERENCED_TABLE_NAME,
       k.REFERENCED_COLUMN_NAME
  FROM information_schema.COLUMNS c
  LEFT JOIN information_schema.KEY_COLUMN_USAGE k
       ON (k.TABLE_SCHEMA=c.TABLE_SCHEMA
       AND k.TABLE_NAME=c.TABLE_NAME
       AND k.COLUMN_NAME=c.COLUMN_NAME
       AND k.POSITION_IN_UNIQUE_CONSTRAINT IS NOT NULL)
     WHERE c.TABLE_SCHEMA='{$this->DB_NAME}'
       AND c.TABLE_NAME='{$table}'";

    $rst=$this->db->query($sql);

    while($entity=$rst->fetch_assoc()) $entities[$entity['COLUMN_NAME']]=$entity;

    $rst->free();

    return $entities;
  }

  public function getReferencedTables($table)
  {
    $references=array();

    $sql="SELECT *
            FROM information_schema.REFERENTIAL_CONSTRAINTS
           WHERE CONSTRAINT_SCHEMA='{$this->DB_NAME}'
             AND TABLE_NAME='{$table}'";

    $rst=$this->db->query($sql);

    while($reference=$rst->fetch_assoc()) $references[]=$reference;

    $rst->free();

    return $references;
  }

  public function getReferredTables($table)
  {
    $references=array();

    $sql="SELECT *
            FROM information_schema.REFERENTIAL_CONSTRAINTS
           WHERE CONSTRAINT_SCHEMA='{$this->DB_NAME}'
             AND REFERENCED_TABLE_NAME='{$table}'";

    $rst=$this->db->query($sql);

    while($reference=$rst->fetch_assoc()) $references[]=$reference;

    $rst->free();

    return $references;
  }

  public function getReferenceColumns($table,$reftable)
  {
    $references=array();

    $sql="SELECT rc.CONSTRAINT_NAME,rc.UPDATE_RULE,rc.DELETE_RULE,kcu.TABLE_NAME,kcu.COLUMN_NAME,kcu.REFERENCED_TABLE_NAME,kcu.REFERENCED_COLUMN_NAME
            FROM information_schema.REFERENTIAL_CONSTRAINTS AS rc
            JOIN information_schema.KEY_COLUMN_USAGE AS kcu ON kcu.CONSTRAINT_NAME=rc.CONSTRAINT_NAME
           WHERE rc.TABLE_NAME='{$table}' AND rc.REFERENCED_TABLE_NAME='{$reftable}'
             AND kcu.TABLE_SCHEMA='{$this->DB_NAME}' AND kcu.REFERENCED_TABLE_SCHEMA='{$this->DB_NAME}'";

    $rst=$this->db->query($sql);

    while($reference=$rst->fetch_assoc()) $references[$reference['COLUMN_NAME']]=$reference;

    $rst->free();

    return $references;
  }

}

//------------------------------------------------------------------------------

/**
 * Very simple english grammer class for singular/plural
 */
class English
{
  public $singular,$plural;

  public function __construct($input)
  {
    //split words separated by underscore and capitalize first letter (CamelCase)
    $word=implode(array_map('ucfirst',explode('_',str_replace('s_','_',$input))));

    if(substr($word,-1)==='s') // assume that word is in plural
    {
      $this->plural=$word;
      //
      if(substr($word,-3)==='ies') $this->singular=substr($word,0,-3).'y';
      else $this->singular=substr($word,0,-1);
    }
    else // assume that word is in singular
    {
      $this->singular=$word;
      //
      if(substr($word,-1)==='y' && in_array(substr($word,-2,1),array('a','e','i','o','u'))) $this->plural=substr($word,-2).'ies';
      else $this->plural = $word.'s';
    }
  }

}