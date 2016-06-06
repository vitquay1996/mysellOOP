<?php
include_once 'models/User.php';

/*** begin the session ***/
session_start();

if(isset($_SESSION['user_id']))
{	
	try
	{
		
		/*** select the users name from the database ***/
		$User = new User($_SESSION['user_id']);

		/*** if we have no something is wrong ***/
		if($User == false)
		{
			$message = 'Access Error! Pls re-enter username and password';
			echo "<script type='text/javascript'>alert('$message');
			window.location.replace(\"signin.php\");</script>";
		}

		if ($User->admin != 1) {
			$message = 'Only admin can access this page!!!';
			echo "<script type='text/javascript'>alert('$message');
			window.location.replace(\"index.php\");</script>";
		}
	}
	catch (Exception $e)
	{
		/*** if we are here, something is wrong in the database ***/
		echo $e->getMessage();
	}
}
else {
	$message = 'You must be admin to access this page!!!';
			echo "<script type='text/javascript'>alert('$message');
			window.location.replace(\"signin.php\");</script>";
}
// echo $_SESSION['user_id'];
// echo $username[0]['user.name'];

date_default_timezone_set('Asia/Ho_Chi_Minh');
?>