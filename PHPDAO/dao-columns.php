<?php

session_start();

if(isset($_POST['docolumns']))
{
  $_SESSION['properties']=$_POST['properties'];
  $_SESSION['finders']=$_POST['finders'];
  header('Location: dao-builder.php');
  exit;
}

if(!isset($_SESSION['tables']))
{
  header('Location: dao-tables.php');
  exit;
}
else
{
  $tables=$_SESSION['tables'];
  $tableobject=$_SESSION['tableobject'];
  $tableobjects=$_SESSION['tableobjects'];
}

require 'Engine.php';

$Engine=new Engine();

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Columns</title>
    <link type="text/css" rel="stylesheet" href="dao.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script>
    $(function() {
      $( "#accordion" ).accordion();
    });
    </script>
  </head>
  <body>

    <div align="center">

      <h1>COLUMNS</h1>

      <form method="post">

        <div id="accordion">

<?php

foreach($_SESSION['tables'] as $tablename=>$tablecheck)
{

?>
        <h3><?= $tablename ?></h3>

        <div>

        <table>
          <tr>
            <th>property</th>
            <th>finder</th>
            <th>COLUMN</th>
            <th>TYPE</th>
            <th width="30" title="Primary Key">PK</th>
            <th width="30" title="Unique Key">UQ</th>
            <th width="30" title="Foreign Key">FK</th>
            <th width="30" title="Not NULL">NN</th>
            <th width="30" title="Auto increment">AI</th>
            <th width="30" title="Has indexes">IDX</th>
            <th>REFERENCE</th>
            <th>COLUMN COMMENT</th>
          </tr>
<?php

  $columns=$Engine->getColumns($tablename);

  foreach($columns as $column)
  {
    $columnname=$column['COLUMN_NAME'];
?>
          <tr>
<?php
    $readonly = $column['PK'] ? ' readonly' : '';
?>
            <td align="center"><input type="checkbox" name="properties[<?= $tablename ?>][<?= $columnname ?>]" checked<?= $readonly ?>></td>
            <td align="center"><input type="checkbox" name="finders[<?= $tablename ?>][<?= $columnname ?>]"<?php if($column['IDX']) echo ' checked'; ?>></td>
            <td><?= $columnname ?></td>
            <td title="<?= $column['COLUMN_TYPE'] ?>"><?= $column['DATA_TYPE'] ?></td>
            <td align="center"><?= $column['PK'] ?></td>
            <td align="center"><?= $column['UQ'] ?></td>
            <td align="center"><?= $column['FK'] ?></td>
            <td align="center"><?= $column['NN'] ?></td>
            <td align="center"><?= $column['AI'] ?></td>
            <td align="center"><?= $column['IDX'] ?></td>
            <td><?php echo $column['REFERENCED_TABLE_NAME'].'.'.$column['REFERENCED_COLUMN_NAME'] ?></td>
            <td><?= $column['COLUMN_COMMENT'] ?></td>
          </tr>
<?php

  }

?>
        </table>

        </div>

<?php

}

?>
        </div><!-- accordion -->

        <input type="submit" name="docolumns" value="Proceed">

      </form>

    </div>

  </body>
</html>
