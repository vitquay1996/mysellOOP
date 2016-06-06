<?php

session_start();

function getCamelCase($input)
{
  return implode(array_map('ucfirst',explode('_',$input)));
}

if(!isset($_SESSION['properties']))
{
  header('Location: dao-columns.php');
  exit;
}
else
{
  //selected tables (on/off)
  $tables=$_SESSION['tables']; //1D array

  //object names in singular
  $tableobject=$_SESSION['tableobject']; //1D array

  //object names in plural
  $tableobjects=$_SESSION['tableobjects']; //1D array

  //column setter/getter (on/off)
  $properties=$_SESSION['properties']; //2D array

  //column finder (on/off)
  $finders=$_SESSION['finders']; //2D array
}

//------------------------------------------------------------------------------

require 'Engine.php';

$Engine=new Engine();

////////////////////////////////////////////////////////////////////////////////

if(!is_dir('../models'))
{
  mkdir('../models',0777) or die('Cannot create models folder!');
}

if(!is_dir('../models/DAO'))
{
  mkdir('../models/DAO',0777) or die('Cannot create models/DAO subfolder!');
}

//------------------------------------------------------------------------------

$file=fopen('../models/DAO/DA.php',"w");
$da=
"<?php

const DB_HOST='{$_SESSION['DB_HOST']}';
const DB_NAME='{$_SESSION['DB_NAME']}';
const DB_USER='{$_SESSION['DB_USER']}';
const DB_PASS='{$_SESSION['DB_PASS']}';

";
fwrite($file,$da);
fclose($file);

//------------------------------------------------------------------------------

copy("DAO.php","../models/DAO/DAO.php") or die('Unable to write file!');

//

foreach($tables as $tablename=>$value)
{
  $primkeys=array();

  $columns=$Engine->getColumns($tablename);

  $class=$tableobject[$tablename];

  $daocontent='<?php'.PHP_EOL
              . PHP_EOL
              . "require_once 'DAO.php';".PHP_EOL
              . PHP_EOL
              . '/**'.PHP_EOL
              . "/* Class {$class}DAO".PHP_EOL
              . '*/'.PHP_EOL;

  $daofilename="../models/DAO/{$class}.dao.php";

  $time=date('YmdHis');

  if(file_exists($daofilename))
  {
    copy("../models/DAO/{$class}.dao.php","../models/DAO/{$class}.dao.php.{$time}.bak");
  }

  // variables ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

  $fields=array();

  $daovars='';

  foreach($columns as $columnname=>$column)
  {
    //Primary key variable is always included
    if($column['PK'] || array_key_exists($columnname,$properties[$tablename]))
    {
      $daovars.='  /**'.PHP_EOL
              . '  /* '.$column['COLUMN_COMMENT'];

      if($column['PK'])
      {
        $primkeys[]=$columnname;
        $daovars.= ' (PK)';
      }
      else
      {
        $fields[]=$columnname;
      }

      if($column['FK'])
      {
        $daovars.= '(FK)->'.$column['REFERENCED_TABLE_NAME'].'.'.$column['REFERENCED_COLUMN_NAME'];
      }

      $daovars.=PHP_EOL
              . "  /* @var {$column['DATA_TYPE']} \${$columnname}".PHP_EOL
              . '   */'.PHP_EOL
              . "  public \${$columnname};".PHP_EOL.PHP_EOL;
    }
  }

  // references ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

  $daorefs='';

  $referenced=$Engine->getReferencedTables($tablename);

  foreach($referenced as $reference)
  {
    $reftablename=$reference['REFERENCED_TABLE_NAME'];
    $object=$tableobject[$reftablename];

    if(array_key_exists($reftablename,$tables))
    {
      $daorefs.='  /**'.PHP_EOL
              . "  /* {$object} - referenced table".PHP_EOL
              . '  /* @returns object'.PHP_EOL
              . '   */'.PHP_EOL
              . "  public function get{$object}()".PHP_EOL
              . '  {'.PHP_EOL;

      $wheres=array();
      $referencedcolumns=$Engine->getReferenceColumns($tablename,$reftablename);
      foreach($referencedcolumns as $referencedcolumn)
      {
        $wheres[]="{$referencedcolumn['REFERENCED_COLUMN_NAME']}='{\$this->{$referencedcolumn['COLUMN_NAME']}}'";
      }
      $daorefs.='    $sql="SELECT * FROM '.$reftablename.' WHERE '.implode(' AND ',$wheres).' LIMIT 1";'.PHP_EOL

              . "    return new \$this->getObject(\$sql,'$object');".PHP_EOL
              . '  }'.PHP_EOL.PHP_EOL;
    }
  }

  $referred=$Engine->getReferredTables($tablename);

  foreach($referred as $reference)
  {
    $reftablename=$reference['TABLE_NAME'];
    $object=$tableobject[$reftablename];
    $objects=$tableobjects[$reftablename];

    if(array_key_exists($reftablename,$tables))
    {
      $daorefs.='  /**'.PHP_EOL
              . "  /* {$objects} - referred table".PHP_EOL
              . '  /* @returns object[]'.PHP_EOL
              . '   */'.PHP_EOL
              . "  public function get{$objects}()".PHP_EOL
              . '  {'.PHP_EOL;

      $wheres=array();
      $referredcolumns=$Engine->getReferenceColumns($reftablename,$tablename);
      foreach($referredcolumns as $referredcolumn)
      {
        $wheres[]="{$referredcolumn['COLUMN_NAME']}='{\$this->{$referredcolumn['REFERENCED_COLUMN_NAME']}}'";
      }
      $daorefs.='    $sql="SELECT * FROM '.$reftablename.' WHERE '.implode(' AND ',$wheres).'";'.PHP_EOL

              . "    return new \$this->getObjects(\$sql,'$object');".PHP_EOL
              . '  }'.PHP_EOL.PHP_EOL;
    }
  }

  // finders ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

  $daofinders='';

  foreach($columns as $columnname=>$column)
  {
    if(array_key_exists($columnname,$finders[$tablename]))
    {
      // if it is PK and this table has single PK
      if($column['PK'] && count($primkeys)===1)
      {
        $daofinders.='  /**'.PHP_EOL
                   . '  /* Primary Key Finder'.PHP_EOL
                   . '  /* @return object'.PHP_EOL
                   . '   */'.PHP_EOL
                   . '  public function findBy'.getCamelCase($columnname).'($'.$columnname.')'.PHP_EOL
                   . '  {'.PHP_EOL
                   . '    $sql="SELECT * FROM '.$tablename.' WHERE '.$columnname.'=\'$'.$columnname.'\' LIMIT 1";'.PHP_EOL
                   . '    return $this->getSelfObject($sql);'.PHP_EOL
                   . '  }'.PHP_EOL.PHP_EOL;
      }
      else
      {
        $daofinders.='  /**'.PHP_EOL
                   . '  /* Column '.$columnname.' Finder'.PHP_EOL
                   . '  /* @return object[]'.PHP_EOL
                   . '   */'.PHP_EOL
                   . '  public function findBy'.getCamelCase($columnname).'($'.$columnname.')'.PHP_EOL
                   . '  {'.PHP_EOL
                   . '    $sql="SELECT * FROM '.$tablename.' WHERE '.$columnname.'=\'$'.$columnname.'\'";'.PHP_EOL
                   . '    return $this->getSelfObjects($sql);'.PHP_EOL
                   . '  }'.PHP_EOL.PHP_EOL;
      }
    }
  }

  if(count($primkeys)>1) //always make additional composite primary key Finder
  {
    $name=implode('And',array_map('ucfirst',$primkeys));
    $vars=implode(',',array_map(function($x){return '$'.$x;},$primkeys));
    $where=implode(' AND ',array_map(function($x){return $x."='$".$x."'";},$primkeys));
    $daofinders.='  /**'.PHP_EOL
               . '  /* Composite Primary Key Finder'.PHP_EOL
               . '  /* @return object'.PHP_EOL
               . '   */'.PHP_EOL
               . '  public function findBy'.getCamelCase($name).'('.$vars.')'.PHP_EOL
               . '  {'.PHP_EOL
               . '    $sql="SELECT * FROM '.$tablename.' WHERE '.$where.' LIMIT 1";'.PHP_EOL
               . '    return $this->getSelfObject($sql);'.PHP_EOL
               . '  }'.PHP_EOL.PHP_EOL;
  }

  //

  $daocontent.="abstract class {$class}DAO extends EntityBase".PHP_EOL
             . '{'.PHP_EOL
             . $daovars.PHP_EOL
             . '  /**'.PHP_EOL
             . '  /* Constructor'.PHP_EOL
             . '  /* @var mixed $id'.PHP_EOL
             . '   */'.PHP_EOL
             . '  public function __construct($id=0)'.PHP_EOL
             . '  {'.PHP_EOL
             . '    parent::__construct();'.PHP_EOL
             . "    \$this->table='{$tablename}';".PHP_EOL
             . "    \$this->primkeys=array('".implode("','",$primkeys)."');".PHP_EOL
             . "    \$this->fields=array('".implode("','",$fields)."');".PHP_EOL
             . '    $this->sql="SELECT * FROM {$this->table}";'.PHP_EOL
             . '    if($id) $this->read($id);'.PHP_EOL
             . '  }'.PHP_EOL.PHP_EOL;

  $daocontent.=$daorefs;

  $daocontent.=$daofinders;

  $daocontent.='  // ==========!!!DO NOT PUT YOUR OWN CODE (BUSINESS LOGIC) HERE!!!=========='.PHP_EOL
             . '  // EXTEND THIS DAO CLASS WITH YOUR ONW CLASS CONTAINING YOUR BUSINESS LOGIC'.PHP_EOL
             . '  // BECAUSE THIS CLASS WILL BE !!RECREATED--OVERWRITTEN!! ON NEXT PHPDAO RUN'.PHP_EOL
             . '}'.PHP_EOL.PHP_EOL;

  $daofile=fopen($daofilename,'w');
  fwrite($daofile,$daocontent);
  fclose($daofile);

  // MODELS ////////////////////////////////////////////////////////////////////

  $filename="../models/{$class}.php";
  if(!file_exists($filename))
  {
    $file=fopen($filename,'w');

    $content= '<?php'.PHP_EOL
            . PHP_EOL
            . "require_once 'DAO/{$class}.dao.php';".PHP_EOL
            . PHP_EOL
            . '/**'.PHP_EOL
            . '/* Class '.$class.PHP_EOL
            . ' */'.PHP_EOL
            . 'class '.$class.' extends '.$class.'DAO'.PHP_EOL
            . '{'.PHP_EOL
            . '  // PUT YOUR BUSINESS LOGIC HERE'.PHP_EOL
            . '}'.PHP_EOL
            . PHP_EOL.PHP_EOL;

    fwrite($file,$content);
    fclose($file);
  }

}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>DAO Classes</title>
    <link type="text/css" rel="stylesheet" href="dao.css">
  </head>
  <body>

    <div align="center">

      <h1>CLASSES</h1>

      <table>
        <tr><th>The following DAO classes are created</th></tr>
<?php

foreach($tables as $tablename=>$value)
{
  echo '        <tr><td align="center"><b>'.$tableobject[$tablename].'</b></td></tr>'.PHP_EOL;
}

?>
      </table>

    </div>

  </body>
</html>

