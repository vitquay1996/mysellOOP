<?php

include 'DA.php';


////////////////////////////////////////////////////////////////////////////////


/**
 * DataBase singleton class
 * @internal
 * @version 1.0
 */
class DataBase
{
  /*
   * Database variable
   * @var mysqli
   */
  protected static $db; //mysqli

  /**
   * Constructor
   */
  final protected function __construct()
  {
    //no public constructor for singleton class
  }

  /**
   * Instantiator static method
   * As of PHP 5.3.0, PHP implements a feature called late static bindings which
   * can be used to reference the called class in a context of static inheritance.
   * @return MySQLi
   */
  public static function getInstance()
  {
    if (!is_object(self::$db))
    {
      self::$db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }
    return self::$db;
  }

  /**
   * Destructor for garbage collector
   */
  protected function __destruct()
  {
    if (self::$db) self::$db->close();
  }

  /**
   * Forbid cloning in sigleton class
   */
  protected function __clone()
  {
    //no possibility for cloning of singleton class
  }
}


////////////////////////////////////////////////////////////////////////////////


/**
 * Active Record Pattern paradigm
 * Database Entity Wrapper
 * @ignore
 */
abstract class EntityBase
{
  /**
   * Database shared connector
   * @var MySQLi connector
   */
  protected $db;

  //----------------------------------------------------------------------------

  /**
   * Database table name
   * @var string
   */
  protected $table;

  /**
   * Main (table) SQL primary key (field) names
   * @var array
   */
  public $primkeys;

  /**
   * Allowed CRUD fields (table columns)
   * @var array
   */
  protected $fields;

  /**
   * Main (table) SQL query
   * @var string
   */
  protected $sql;

  //////////////////////////////////////////////////////////////////////////////

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->db=DataBase::getInstance();
  }

  //////////////////////////////////////////////////////////////////////////////

  /**
   * Get single primary key value
   * @return mixed
   */
  public function getId()
  {
    $pkfield=$this->primkeys[0];
    return $this->$pkfield;
  }

  /**
   * Returns primary keys in associative array
   * @return array
   */
  public function getIds()
  {
    $ids=array();
    foreach($this->primkeys as $pk)
    {
      $ids[$pk]=$this->$pk;
    }
    return $ids;
  }

  /**
   * Fetches row from database and populates variables
   * @param string $sql
   * @throws NotFoundException
   * @throws ReadException
   */
  public function fetch($sql)
  {
    if($rst=$this->db->query($sql))
    {
      if($rst->num_rows)
      {
        $row=$rst->fetch_assoc();
        $this->populate($row);
        $rst->free();
      }
      else
      {
        throw new NotFoundException($sql);
      }
    }
    else
    {
      throw new ReadException($sql);
    }
  }

  //----------------------------------------------------------------------------

  /**
   * Fills class variables of child object with array elements
   * @param array $array
   */
  public function populate($array)
  {
    foreach($array as $key=>$val)
    {
      if(in_array($key,$this->fields)) //include only allowed fields
      {
        $this->$key=$val;
      }
    }
  }

  /**
   * Sanitizes and fills class variables of child object with array elements
   * @param array $array
   */
  public function sanitize($array)
  {
    foreach($array as $key=>$val)
    {
      if(in_array($key,$this->fields)) //include only allowed fields
      {
        $this->$key=$this->db->real_escape_string($val);
      }
    }
  }

  //----------------------------------------------------------------------------

  /**
   * Adds table fields (columns) to SQL query
   * @param string $sql
   */
  protected function addFields(&$sql)
  {
    $fields=array();
    foreach($this as $var=>$value)
    {

      if(in_array($var,$this->fields)) //include only allowed fields
      {
        if ($var != 'id'){
          $fields[] = (is_null($value) || $value==='NULL') ? "$var=NULL" : "$var='$value'";
        }
      }
    }
    $sql.=implode(',',$fields);
  }

  //----------------------------------------------------------------------------

  /**
   * Returns the object of type given by ClassType variable and dynamically
   * fills only properties that correspond to columns in given SQL query
   * @param string $sql SQL query
   * @param string $Class class (name)
   * @return Object
   * @throws ReadException
   * @throws Exception
   */
  protected function getObject($sql,$Class)
  {
    if(class_exists($Class))
    {
      if($rst=$this->db->query($sql))
      {
        if($row=$rst->fetch_assoc())
        {
          $Object=new $Class; //instantiate a class from a variable class name
          $Object->populate($row);
        }
        $rst->free();
        //If object is undefined then don't return
        if (!empty($Object)){
          return $Object;
        }
      }
      else
      {
        throw new ReadException($sql);
      }
    }
    else
    {
      throw new Exception("Non-existent class: $Class");
    }
  }

  /**
   * Returns the object of self type
   * @param string $sql SQL query
   * @return self
   */
  protected function getSelfObject($sql)
  {
    return $this->getObject($sql,get_class($this));
  }

  /**
   * Returns the array of objects of type given by ClassType variable and
   * dynamically fills only properties that correspond to columns in given SQL query
   * @param string $sql SQL query
   * @param string $Class class (name)
   * @return Object[]
   * @throws ReadException
   * @throws Exception
   */
  protected function getObjects($sql,$Class)
  {
    $Objects=array();

    if(class_exists($Class))
    {
      if($rst=$this->db->query($sql))
      {

        while($row=$rst->fetch_assoc())
        {
          $Object=new $Class; //instantiate a class from a variable class name
          $Object->populate($row);
          $Objects[]=$Object;
        }
        $rst->free();
        //if Objects is undefined, then dont return
        if (is_array($Objects)) {
          return $Objects;
        }
      }
      else
      {
        throw new ReadException($sql);
      }
    }
    else
    {
      throw new Exception("Non-existent class: {$Class}!");
    }
  }

  /**
   * Returns the array of self type objects
   * @param string $sql SQL query
   * @return self[]
   */
  protected function getSelfObjects($sql)
  {
    return $this->getObjects($sql,get_class($this));
  }

  //----------------------------------------------------------------------------

  /**
   * Returns the single number
   * @param string $sql
   * @return number
   */
  protected function getSingleNum($sql)
  {
    if($rst=$this->db->query($sql))
    {
      $row=$rst->fetch_row();
      $rst->free();
      return (int)$row[0];
    }
    else
    {
      return 0;
    }
  }

  //////////////////////////////////////////////////////////////////////////////

  /**
   * Returns the list of all objects
   * @param INTEGER $limit
   * @param INTEGER $offset
   * @return Object[]
   */
  public function getList($limit=100,$offset=0)
  {
    $sql="{$this->sql} LIMIT {$limit} OFFSET {$offset}";
    return $this->getSelfObjects($sql);
  }

  /**
   * Returns the associative array
   * @param string $sql SQL query with two column names in SELECT
   * @return array('id'=>'value')
   * @throws ReadException
   */
  protected function getAssocArray($sql)
  {
    $list=array();

    if($rst=$this->db->query($sql))
    {
      while($row=$rst->fetch_row())
      {
        $list[$row[0]]=$row[1]; //@TODO multidimensional
      }
      $rst->free();
      return $list;
    }
    else
    {
      throw new ReadException($sql);
    }
  }

  /**
   * Returns the total number of records
   * @return INTEGER
   */
  public function getTotalNo()
  {
    $sql="SELECT COUNT(1) FROM {$this->table} LIMIT 1";
    return $this->getSingleNum($sql);
  }


  // ID FUNCTIONS //////////////////////////////////////////////////////////////

  /**
   * Returns the list of IDs and there are three possibilities:
   * @param string $glue
   * @param mixed $ids
   * @return string
   */
  private function getImplodedIds($glue,$ids)
  {
    $where=' ';
    if($ids)
    {
      if(is_array($ids))
      {
        $wheres=array();
        foreach($ids as $id=>$val)
        {
          $wheres[]="{$id}='{$val}'";
        }
        $where=implode($glue,$wheres);
      }
      else
      {
        $where=" {$this->primkeys[0]}='{$ids}'";
      }
    }
    else //if $ids was not given, use object's primary key
    {
      $wheres=array();
      foreach($this->primkeys as $pk)
      {
        $wheres[]=$pk."='".$this->$pk."'";
      }
      $where=implode($glue,$wheres);
    }
    return $where;
  }


  // CRUDS FUNCTIONS ///////////////////////////////////////////////////////////


  /**
   * Reads database row from table and dynamically fills object's variables from row's fields
   * @param mixed $ids single or array of Primary keys
   * @throws ReadException
   */
  public function read($ids=0)
  {
    $sql="{$this->sql} WHERE {$this->getImplodedIds(' AND ',$ids)} LIMIT 1";
    $this->fetch($sql);
  }

  /**
   * Reads given columns only from table and dynamically fills object's variables
   * @param array $columns Array of table columns
   * @param mixed $ids single or array of Primary keys
   * @throws ReadException
   */
  public function readColumns($columns,$ids=0)
  {
    if(is_array($columns))
    {
      $sql='SELECT '.implode(',',$columns).' FROM '.$this->table.' WHERE '.$this->getImplodedIds(' AND ',$ids).' LIMIT 1';
      $this->fetch($sql);
    }
    else
    {
      throw new Exception('No columns defined!');
    }
  }

  /**
   * Dynamically builds INSERT query and creates a record in database
   * @param mixed $ids single or array of Primary keys
   * @throws NotUniqueException
   * @throws CreateException
   */
  public function create($ids=0)
  {
    $sql="INSERT INTO {$this->table} SET ";

    $sql.=$this->getImplodedIds(', ',$ids).', ';


    $this->addFields($sql);

    if($this->db->query($sql))
    {
      if(count($this->primkeys)>1) //composite PK
      {
        foreach($ids as $id=>$val)
        {
          $this->$id=$val;
        }
      }
      else //single PK (could be auto_increment)
      {
        $pkfield=$this->primkeys[0];
        $this->$pkfield=$this->db->insert_id;
      }
    }
    else
    {
      if($this->db->errno===1062) //unique key violation
      {
        throw new NotUniqueException($sql);
      }
      else
      {
        throw new CreateException($sql);
      }
    }
  }

  /**
   * Dynamically builds UPDATE query and updates a record in database
   * @param mixed $ids single or array of Primary keys
   * @throws NotUniqueException
   * @throws UpdateException
   */
  public function update($ids=0)
  {
    $sql="UPDATE {$this->table} SET ";

    $this->addFields($sql);

    $sql.=" WHERE {$this->getImplodedIds(' AND ',$ids)} LIMIT 1";

    if(!$this->db->query($sql))
    {
      if($this->db->errno===1062) //unique key violation
      {
        throw new NotUniqueException($sql);
      }
      else
      {
        throw new UpdateException($sql);
      }
    }
  }

  /**
   * Dynamically builds INSERT+UPDATE query and saves a record in database
   * if record does not exist it will be created, otherwise updated
   * @param mixed $ids single or array of Primary keys
   * @throws SaveException
   */
  public function save($ids=0)
  {
    $sql="INSERT INTO {$this->table} SET ";

    $sql.=$this->getImplodedIds(', ',$ids).', ';

    $this->addFields($sql);

    $sql.=" ON DUPLICATE KEY UPDATE "; // MySQL specific

    $this->addFields($sql);

    if($this->db->query($sql))
    {
      if(count($this->primkeys)>1) //composite PK
      {
        foreach($ids as $id=>$val)
        {
          $this->$id=$val;
        }
      }
      else //single PK (could be auto_increment)
      {
        $pkfield=$this->primkeys[0];
        $this->$pkfield=$this->db->insert_id;
      }
    }
    else
    {
      throw new SaveException($sql);
    }
  }

  /**
   * Dynamically builds DELETE query and deletes a record in database
   * @param mixed $ids single or array of Primary keys
   * @throws DeleteException
   */
  public function delete($ids=0)
  {
    $sql="DELETE FROM {$this->table} WHERE {$this->getImplodedIds(' AND ',$ids)} LIMIT 1";

    if(!$this->db->query($sql))
    {
      throw new DeleteException($sql);
    }
  }

  /**
   * Finds rows from table according to given list of columns/values
   * @param array $conditions Array of table columns=>'vaule' pairs (conditions)
   * @returns object[]
   * @throws Exception
   */
  public function find($conditions=0)
  {
    if(is_array($conditions))
    {
      $sql='SELECT * FROM '.$this->table.' WHERE '.$this->getImplodedIds(' AND ',$conditions);
      return $this->getSelfObjects($sql);
    }
    else
    {
      throw new Exception('No columns defined!');
    }
  }

}



////////////////////////////////////////////////////////////////////////////////



/**
 * Create Exception
 */
class CreateException extends Exception
{
  public function errorMessage()
  {
    return $this->getMessage().$this->getCode()."\n".$this->getTraceAsString();
  }
}

/**
 * Read Exception
 */
class ReadException extends Exception
{
  public function errorMessage()
  {
    return $this->getMessage().$this->getCode()."\n".$this->getTraceAsString();
  }
}

/**
 * Update Exception
 */
class UpdateException extends Exception
{
  public function errorMessage()
  {
    return $this->getMessage().$this->getCode()."\n".$this->getTraceAsString();
  }
}

/**
 * Save Exception
 */
class SaveException extends Exception
{
  public function errorMessage()
  {
    return $this->getMessage().$this->getCode()."\n".$this->getTraceAsString();
  }
}

/**
 * Delete Exception
 */
class DeleteException extends Exception
{
  public function errorMessage()
  {
    return $this->getMessage().$this->getCode()."\n".$this->getTraceAsString();
  }
}

//------------------------------------------------------------------------------

/**
 * Not Unique Exception
 */
class NotUniqueException extends Exception
{
  public function errorMessage()
  {
    return $this->getMessage().$this->getCode()."\n".$this->getTraceAsString();
  }
}

/**
 * Not found exception
 */
class NotFoundException extends Exception
{
  public function errorMessage()
  {
    return $this->getMessage();
  }
}



////////////////////////////////////////////////////////////////////////////////
