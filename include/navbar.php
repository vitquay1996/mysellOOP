<?php
?>	

<div class="container">
	<div class="header-top">
		<div class="logo">
			<a href="index.php"><img src="images/logo.png" alt="" ></a>
		</div>
		<div class="header-top-on">
			<ul class="social-in">
				<!-- <li><a href="#"><i> </i></a></li>	 -->					
				<!-- <li><a href="#"><i class="ic"> </i></a></li> -->
				<li><a href="#"><i class="ic1"> </i></a></li>

			</ul>
		</div>
		<div class="clearfix"> </div>
	</div>
	<div class="header-bottom">
		<div class="top-nav">

			<ul class="megamenu skyblue">
				<li class="active grid"><a  href="index.php?cat=001">For Him</a>
					<div class="megapanel">
						<div class="row">
							<div class="col1">
								<div class="h_nav">
									<ul>
										<li><a href="index.php?cat=005">Shirt</a></li>

									</ul>	
								</div>							
							</div>

							<div class="col1">
								<div class="h_nav">
									<h4>Popular Brands</h4>
									<ul>
										<li><a href="store.html">Levis</a></li>
										<li><a href="index.php?catname=Lacoste">Lacoste</a></li>
										<li><a href="store.html">Nike</a></li>
										<li><a href="store.html">Edwin</a></li>
										<li><a href="store.html">New Balance</a></li>
										<li><a href="store.html">Jack & Jones</a></li>
										<li><a href="store.html">Paul Smith</a></li>
										<li><a href="store.html">Ray-Ban</a></li>
										<li><a href="store.html">Wood Wood</a></li>
									</ul>	
								</div>												
							</div>
						</div>
					</div>
				</li>
				<li class="active grid"><a  href="index.php">For Her</a>
					<div class="megapanel">
						<div class="row">
							<div class="col1">
								<div class="h_nav">
									<ul>
										<li><a href="store.html">Watches</a></li>

									</ul>	
								</div>							
							</div>

							<div class="col1">
								<div class="h_nav">
									<h4>Popular Brands</h4>
									<ul>
										<li><a href="store.html">Levis</a></li>
										<li><a href="store.html">Persol</a></li>
										<li><a href="store.html">Nike</a></li>
										<li><a href="store.html">Edwin</a></li>
										<li><a href="store.html">New Balance</a></li>
										<li><a href="store.html">Jack & Jones</a></li>
										<li><a href="store.html">Paul Smith</a></li>
										<li><a href="store.html">Ray-Ban</a></li>
										<li><a href="store.html">Wood Wood</a></li>
									</ul>	
								</div>												
							</div>
						</div>
					</div>
				</li>

				<li class="grid"><a  href="#">Lifestyle Gadgets</a>
					<div class="megapanel">
						<div class="row">
							<div class="col1">
								<div class="h_nav">
									<ul>
										<li><a href="store.html">Accessories</a></li>

									</ul>	
								</div>							
							</div>

							<div class="col1">
								<div class="h_nav">
									<h4>Popular Brands</h4>
									<ul>
										<li><a href="store.html">Levis</a></li>
										<li><a href="store.html">Persol</a></li>
										<li><a href="store.html">Nike</a></li>
										<li><a href="store.html">Edwin</a></li>
										<li><a href="store.html">New Balance</a></li>
										<li><a href="store.html">Jack & Jones</a></li>
										<li><a href="store.html">Paul Smith</a></li>
										<li><a href="store.html">Ray-Ban</a></li>
										<li><a href="store.html">Wood Wood</a></li>
									</ul>	
								</div>												
							</div>
						</div>
					</div>
				</li>


						<!-- <li class="grid"><a  href="#">Beauty Products</a>
							<div class="megapanel">
								<div class="row">
									<div class="col1">
										<div class="h_nav">
											<ul>
												<li><a href="store.html">Accessories</a></li>

											</ul>	
										</div>							
									</div>

									<div class="col1">
										<div class="h_nav">
											<h4>Popular Brands</h4>
											<ul>
												<li><a href="store.html">Levis</a></li>
												<li><a href="store.html">Persol</a></li>
												<li><a href="store.html">Nike</a></li>
												<li><a href="store.html">Edwin</a></li>
												<li><a href="store.html">New Balance</a></li>
												<li><a href="store.html">Jack & Jones</a></li>
												<li><a href="store.html">Paul Smith</a></li>
												<li><a href="store.html">Ray-Ban</a></li>
												<li><a href="store.html">Wood Wood</a></li>
											</ul>	
										</div>												
									</div>
								</div>
							</div>
						</li> -->

					</ul> 
				</div>
				<?php if (!isset($_SESSION['user_id'])): ?>
				<ul class="nav navbar-nav navbar-right">
					<a href="signin.php" class="btn btn-default" role="button">Sign In</a>
					<li>
						<a href="register.php">Sign up</a>
					</li>
				</ul>
			<?php else: ?> 
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="user.php">Welcome <?php echo $User->username;?></a>
				</li>
				<?php if ($User->admin == 1) {?>
				<a href="admin.php" class="btn btn-default" role="button">Admin</a>
				<?php }?>
				<a href="post.php" class="btn btn-default" role="button">New Post</a>
				<a href="logout.php" class="btn btn-default" role="button">Sign Out</a>
			</ul>

		<?php endif;?>

		<div class="clearfix"> </div>
	</div>
	<?php
	?>