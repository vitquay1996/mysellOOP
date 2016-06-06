<?php
session_start();
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
			<h2>Sign In</h2>
			<div class=" account-top register">
				<form action="login.php" method="post">
					<div> 	
						<span>Email*</span>
						<input type="text" name="email"> 
					</div>
					<div> 
						<span  class="pass">Password*</span>
						<input type="password" name="password">
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