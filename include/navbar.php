<?php include_once 'models/Category.php';
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
		

		<ul class="nav navbar-nav navbar-left">
			<li class="dropdown">
				<a href="index.php?cat=001" class="dropbtn">For Him</a>
				<div class="dropdown-content">
					<?php
					$Category = new Category();
					$Category1 = $Category->findByParent('001');
					foreach ($Category1 as $Category1) { ?>
						<a href="index.php?cat=<?php echo $Category1->id2?>"><?php echo $Category1->name;?></a>
					<?php }?>
				</div>
			</li>
			<li class="dropdown">
				<a href="index.php?cat=002" class="dropbtn">For Her</a>
				<div class="dropdown-content">
					<?php
					$Category2 = $Category->findByParent('002');
					foreach ($Category2 as $Category2) { ?>
						<a href="index.php?cat=<?php echo $Category2->id2?>"><?php echo $Category2->name;?></a>
					<?php }?>
				</div>
			</li>
			<li class="dropdown">
				<a href="index.php?cat=003" class="dropbtn">Lifestyle Accesories</a>
				<div class="dropdown-content">
					<?php
					$Category3 = $Category->findByParent('003');
					foreach ($Category3 as $Category3) { ?>
						<a href="index.php?cat=<?php echo $Category3->id2?>"><?php echo $Category3->name;?></a>
					<?php }?>
				</div>
			</li>
			
			<li class="dropdown">
				<a href="index.php?cat=004" class="dropbtn">Beauty Product</a>
				<div class="dropdown-content">
					<?php
					$Category4 = $Category->findByParent('004');
					foreach ($Category4 as $Category4) { ?>
						<a href="index.php?cat=<?php echo $Category4->id2?>"><?php echo $Category4->name;?></a>
					<?php }?>
				</div>
			</li>
		</ul>


		
		<?php if (!isset($_SESSION['user_id'])): ?>
		<ul class="nav navbar-nav navbar-right">
			<a href="signIn.php" class="btn btn-default" role="button">Sign In</a>

			<a href="signUp.php" class="btn btn-default" role="button">Sign up</a>
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