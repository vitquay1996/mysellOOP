<?php
/*** begin the session ***/
session_start();
include_once('models/User.php');	

if(isset($_SESSION['user_id']))
{	
	try
	{
		$User = new User($_SESSION['user_id']);

		if($User == false)
		{
			$message = 'Access Error! Pls re-enter username and password';
			echo "<script type='text/javascript'>alert('$message');
			window.location.replace(\"signin.php\");</script>";
		}
	}
	catch (PDOException $e)
	{
		/*** if we are here, something is wrong in the database ***/
		echo $e->getMessage();
	}
}
else {
	$message = 'You must sign in to access this page!!!';
	echo "<script type='text/javascript'>alert('$message');
	window.location.replace(\"signin.php\");</script>";
}


date_default_timezone_set('Asia/Ho_Chi_Minh');
?>