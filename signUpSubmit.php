<?php
/*** begin our session ***/
session_start();
include_once('models/User.php');

include_once 'include/checkPassword.php';

/*** if we are here the data is valid and we can insert it into database ***/
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
/*** now we can encrypt the password ***/
$password = sha1( $password );

try
{
    $User = new User();
    $User->username = $username;
    $User->password = $password;
    $User->name = $name;
    $User->email = $email;
    $User->date = date('Y-m-d');
    $User->admin = 0;
    $User->create();

    $message = 'New user added! Please Sign In!';
    echo "<script type='text/javascript'>alert('$message');
    window.location.replace(\"index.php\");</script>";
}
catch(Exception $e)
{
    /*** check if the username already exists ***/
    if( $e->getCode() == 23000)
    {
        $message = 'Username already exists! Please try again';
        echo "<script type='text/javascript'>alert('$message');
        window.location.replace(\"signin.php\");</script>";
    }
    else
    {
        /*** if we are here, something has gone wrong with the database ***/
        $message = 'We are unable to process your request. Please try again later"';
        echo $e->getMessage();
            // echo "<script type='text/javascript'>alert('$message');
            // window.location.replace(\"index.html\");</script>";
    }
}

?>

<html>
<head>
    <title>PHPRO Login</title>
</head>
<body>
    <p><?php echo $message; ?></p>
</body>
</html>