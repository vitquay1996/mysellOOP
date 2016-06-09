<?php

/*** begin our session ***/
session_start();

/*** set a form token ***/
$form_token = md5(uniqid(microtime(), true));

/*** set the session form token ***/
$_SESSION['form_token'] = $form_token;


?>

<!DOCTYPE html>
<html>
<?php
include_once('include/header.php');
?>
<body> 
	<!--header-->
	<?php
	include_once('include/navbar.php');
	?>
	<div class="content">
		<div class="account-in register-top">
			<h2>Register</h2>
			<div class=" account-top register">
				<form action="signUpSubmit.php" method="post">
					<?php 
					if (isset($_GET['message'])) {?>
					<div class="alert alert-warning">
						<strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_GET['message'];?></strong>
					</div>
					<?php
				}
				?>
				<div>
					<span>Full Name*</span>
					<input type="text" name="name">
				</div>
				<div> 	
					<span>Username*</span>
					<input type="text" name="username"> 
				</div>
				<div> 	
					<span>Email*</span>
					<input type="text" name="email"> 
				</div>
				<div> 
					<span  class="pass">Password*</span>
					<input type="password" name="password">
					<input type="hidden" name="form_token" value="<?php echo $form_token;?>"/>
				</div>				
				<input type="submit" value="Submit"> 
			</form>
		</div>

	</div>	


</div>
<!---->
<div class="footer">
	<p class="footer-class">© 2015 Mihstore All Rights Reserved | Template by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>

	<a href="#home" class="scroll to-Top" >  GO TO TOP!</a>
	<div class="clearfix"> </div>
</div>
</div>

<!---->
</body>
</html>