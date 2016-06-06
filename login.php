<?php

/*** begin our session ***/
session_start();

include_once('models/User.php');
include_once('include/checkLogin.php');
/*** if we are here the data is valid and we can insert it into database ***/
$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

/*** now we can encrypt the password ***/
$password = sha1( $password );

try
{
	$User = new User();
	$User = $User->find(array('email'=>$email, 'password'=>$password));
	$UserID = $User[0]->id;
	
	if($UserID == false)
	{
		$message = 'Login Failed';
	}
	else
	{
		$_SESSION['user_id'] = $UserID;
		header("Location: index.php");
		exit;
	}


}
catch(Exception $e)
{
	/*** if we are here, something has gone wrong with the database ***/
	echo $e->getMessage();

}

?>

<html>
<head>
	<title>PHPRO Login</title>
</head>
<body>
	<p><?php echo $message; ?>
	</body>
	</html>