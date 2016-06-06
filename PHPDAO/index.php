<?php

session_start();

if(isset($_POST['do']))
{
  $_SESSION['DB_HOST']=$_POST['DB_HOST'];
  $_SESSION['DB_NAME']=$_POST['DB_NAME'];
  $_SESSION['DB_USER']=$_POST['DB_USER'];
  $_SESSION['DB_PASS']=$_POST['DB_PASS'];
  header('Location: dao-tables.php');
  exit;
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>PHPDAO</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="dao.css">
  </head>
  <body>

    <div align="center">

      <h1>DATABASE</h1>

      <form method="post">

        <table>
          <tr>
            <td>DB_HOST</td>
            <td><input type="text" name="DB_HOST" value="localhost"></td>
          </tr>
          <tr>
            <td>DB_NAME</td>
            <td><input type="text" name="DB_NAME"></td>
          </tr>
          <tr>
            <td>DB_USER</td>
            <td><input type="text" name="DB_USER"></td>
          </tr>
          <tr>
            <td>DB_PASS</td>
            <td><input type="password" name="DB_PASS"></td>
          </tr>
        </table>

        <input type="submit" name="do" value="Proceed">

      </form>

    </div>

  </body>
</html>
