<?php
if(isset( $_SESSION['user_id'] ))
{
	$message = 'Users is already logged in';
}
/*** check that both the username, password have been submitted ***/
if(!isset( $_POST['email'], $_POST['password']))
{
	$message = 'Please enter a valid email and password';
}
/*** check the password has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['password']) != true)
{
	/*** if there is no match ***/
	$message = "Password must be alpha numeric";
}
?>