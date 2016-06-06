<?php

session_start();

if(isset($_POST['dotables']))
{
  $_SESSION['tables']=$_POST['tables'];
  $_SESSION['tableobject']=$_POST['tableobject'];
  $_SESSION['tableobjects']=$_POST['tableobjects'];
  header('Location: dao-columns.php');
  exit;
}

require 'Engine.php';

$Engine=new Engine();

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Tables</title>
    <link type="text/css" rel="stylesheet" href="dao.css">
  </head>
  <body>

    <div align="center">

      <h1>TABLES</h1>

      <form method="post">

        <table>
          <tr>
            <th>DAO</th>
            <th>TABLE NAME</th>
            <th>TABLE COMMENT</th>
            <th>OBJECT NAME (singular)</th>
            <th>OBJECTS NAMES (plural)</th>
          </tr>
<?php

$tables=$Engine->getTables();

foreach($tables as $table)
{
  $English=new English($table['TABLE_NAME']);
?>
          <tr>
            <td align="center"><input type="checkbox" name="tables[<?= $table['TABLE_NAME'] ?>]" checked></td>
            <td><?= $table['TABLE_NAME'] ?></td>
            <td><?= $table['TABLE_COMMENT'] ?></td>
            <td><input type="text" name="tableobject[<?= $table['TABLE_NAME'] ?>]" value="<?= $English->singular ?>"></td>
            <td><input type="text" name="tableobjects[<?= $table['TABLE_NAME'] ?>]" value="<?= $English->plural ?>"></td>
          </tr>
<?php
}
?>
        </table>

        <input type="submit" name="dotables" value="Proceed">

      </form>

    </div>

  </body>
</html>
