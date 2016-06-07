<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include_once 'include/checkUser.php';
include_once 'models/Post.php';
include_once 'models/Upload.php';
// phpinfo();

?>
<!DOCTYPE html>
<html>
<?php include_once 'include/header.php';?>

<body> 
	<!--header-->
	<?php 
	include_once 'include/navbar.php';
	?>

	<!-- Search Bar -->
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<br/>
				<div id="custom-search-input">
					<form action="search.php" method="get">
						<div class="input-group col-md-12">
							<input type="text" name="key" class="form-control input-lg" placeholder="Search for an item" />
							<span class="input-group-btn">
								<button class="btn btn-info btn-lg" type="submit" value="Submit">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</span>	
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>

	<div class="content">

		<div class="col-md-9">
			<div class="shoe">
				<img class="img-responsive" src="images/banner.jpg" alt="" >
				<div class="shop">
					<h4>SHOP <span>WOMEN</span></h4>
					<p>SHOES FALL 2014</p>
				</div>
			</div>
			<div class="content-bottom">
				<h3>Most Recent</h3>
				<?php 
				if ((!isset($_GET['cat'])) && (!isset($_GET['catname']))){ //IF there is no chosen category
					try
					{
						$Post = new Post();
						$Post = $Post->findEveryRecentPost();
						$iter = 1; //looping variable to make space between row
						foreach ($Post as $Post) {
							if ($Post->status == 1) {
								$Upload = new Upload();
								$Upload = $Upload->findByPostID($Post->id);
								if ($iter % 3 == 1) {?>
								<div class="bottom-grid">
									<?php }?>
									<div class="col-md-4 shirt">
										<div class="bottom-grid-top">
											<a href="userview.php?id=<?php echo $Post->id;?>"><img class="img-responsive" src="images/<?php echo $Upload->id.'.'.$Upload->type;?>" alt="" >
												<div class="pre">
													<p><?php echo $Post->title;?></p>
													<span><?php echo $Post->price.' vnd';?></span>
													<div class="clearfix"> </div>
												</div>
											</a>
										</div>
									</div>
									<?php if ($iter % 3 == 0) {?>
									<div class="clearfix"> </div>
								</div>
								<?php }
								$iter = $iter + 1;
							}
						}
						if (($iter % 3) != 1) {
							echo '</div>';
						}



					}
					catch(Exception $e)
					{
						/*** if we are here, something has gone wrong with the database ***/
						$message = 'We are unable to process your request. Please try again later"';

					}
				}
				else if (isset($_GET['cat'])){
					try 
					{
						$Post = new Post();
						$Post = $Post->findByCat($_GET['cat']);
						$iter = 1; //looping variable to make space between row
						foreach ($Post as $Post) {
							if ($Post->status == 1) {
								$Upload = new Upload();
								$Upload = $Upload->findByPostId($Post->id);
								if ($iter % 3 == 1) {?>
								<div class="bottom-grid">
									<?php }?>
									<div class="col-md-4 shirt">
										<div class="bottom-grid-top">
											<a href="userview.php?id=<?php echo $Post->id?>"><img class="img-responsive" src="images/<?php echo $Upload->id.'.'.$Upload->type;?>" alt="" >
												<div class="pre">
													<p><?php echo $Post->title;?></p>
													<span><?php echo $Post->price.' vnd';?></span>
													<div class="clearfix"> </div>
												</div>
											</a>
										</div>
									</div>
									<?php if ($iter % 3 == 0) {?>
									<div class="clearfix"> </div>
								</div>
								<?php }
								$iter = $iter + 1;
							}
						}
						if (($iter % 3) != 1) {
							echo '</div>';
						}


					}
					catch(Exception $e)
					{
						/*** if we are here, something has gone wrong with the database ***/
						echo $e->getMessage();

					}




				}
				else if (isset($_GET['catname'])){
					try 
					{
						$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);

						$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

						/*** prepare the select statement ***/
						$stmt = $dbh->prepare("SELECT mysell_posts.`post.id`, mysell_posts.`post.title`, mysell_posts.`post.price`, mysell_posts.`post.status` FROM mysell_posts INNER JOIN mysell_cat ON mysell_posts.`post.cat_id`=mysell_cat.`cat_id` WHERE mysell_cat.`cat_name`=:catname ORDER BY `post.id` DESC");


						$stmt->execute(array(':catname'=>$_GET['catname']));
						$iter = 1; //looping variable to make space between row
						while ($post = $stmt->fetch()) {
							if ($post['post.status'] == 1) {
								if ($iter % 3 == 1) {?>
								<div class="bottom-grid">
									<?php }?>
									<div class="col-md-4 shirt">
										<div class="bottom-grid-top">
											<a href="userview.php?id=<?php echo $post['post.id'];?>"><img class="img-responsive" src="images/sh.png" alt="" >
												<div class="pre">
													<p><?php echo $post['post.title'];?></p>
													<span><?php echo $post['post.price'].' vnd';?></span>
													<div class="clearfix"> </div>
												</div>
											</a>
										</div>
									</div>
									<?php if ($iter % 3 == 0) {?>
									<div class="clearfix"> </div>
								</div>
								<?php }
								$iter = $iter + 1;
							}
						}
						if (($iter % 3) != 1) {
							echo '</div>';
						}


					}
					catch(Exception $e)
					{
						/*** if we are here, something has gone wrong with the database ***/
						$message = 'We are unable to process your request. Please try again later"';

					}




				}
				?>
				<div class="bottom-grid">

					<div class="clearfix"> </div>
				</div>
			</div>
			<ul class="start">
				<li><span>1</span></li>
				<li class="arrow"><a href="#">2</a></li>
				<li class="arrow"><a href="#">3</a></li>
				<li class="arrow"><a href="#">4</a></li>
				<li class="arrow"><a href="#">5</a></li>
				<li class="arrow"><a href="#">6</a></li>
			</ul>
		</div>

		<div class="col-md-3 col-md">
			<div class=" possible-about">
				<h4>Sort Products</h4>
				<div class="tab1">
					<ul class="place">

						<li class="sort">Sort by <span>price</span></li>
						<li class="by"><img src="images/do.png" alt=""></li>
						<div class="clearfix"> </div>
					</ul>
					<div class="single-bottom">


						<a href="#">
							<input type="checkbox"  id="brand" value="">
							<label for="brand"><span></span><b>Rs.3000-Rs.4000</b></label>
						</a>
						<a href="#">
							<input type="checkbox"  id="brand1" value="">
							<label for="brand1"><span></span> <b>Rs.3000-Rs.2000</b></label>
						</a>
						<a href="#">
							<input type="checkbox"  id="brand2" value="">
							<label for="brand2"><span></span> <b>Rs.2000-Rs.1000</b></label>
						</a>
						<a href="#">
							<input type="checkbox"  id="brand3" value="">
							<label for="brand3"><span></span> <b>Rs.1000-Rs.500</b></label>
						</a>
						<a href="#">
							<input type="checkbox"  id="brand4" value="">
							<label for="brand4"><span></span><b>Rs.500-below</b></label>
						</a>

					</div>

				</div>
				<div class="tab2">
					<ul class="place">

						<li class="sort">Sort by <span>brands</span></li>
						<li class="by"><img src="images/do.png" alt=""></li>
						<div class="clearfix"> </div>
					</ul>

					<div class="single-bottom">


						<a href="#">
							<input type="checkbox"  id="nike" value="">
							<label for="nike"><span></span><b>Nike</b></label>
						</a>
						<a href="#">
							<input type="checkbox"  id="nike1" value="">
							<label for="nike1"><span></span> <b>Reebok</b></label>
						</a>
						<a href="#">
							<input type="checkbox"  id="nike2" value="">
							<label for="nike2"><span></span><b> Fila</b></label>
						</a>
						<a href="#">
							<input type="checkbox"  id="nike3" value="">
							<label for="nike3"><span></span> <b>Puma</b></label>
						</a>
						<a href="#">
							<input type="checkbox"  id="nike4" value="">
							<label for="nike4"><span></span><b>Sparx</b></label>
						</a>
					</div>

				</div>
				<div class="tab3">
					<ul class="place">

						<li class="sort">Sort by <span>colour</span> </li>
						<li class="by"><img src="images/do.png" alt=""></li>
						<div class="clearfix"> </div>
					</ul>
					<ul class="w_nav2">
						<li><a class="color1" href="#"></a></li>
						<li><a class="color2" href="#"></a></li>
						<li><a class="color3" href="#"></a></li>
						<li><a class="color4" href="#"></a></li>
						<li><a class="color5" href="#"></a></li>
						<li><a class="color6" href="#"></a></li>
						<li><a class="color7" href="#"></a></li>
						<li><a class="color8" href="#"></a></li>
						<li><a class="color9" href="#"></a></li>
						<li><a class="color10" href="#"></a></li>
						<li><a class="color12" href="#"></a></li>
						<li><a class="color13" href="#"></a></li>
						<li><a class="color14" href="#"></a></li>
						<li><a class="color15" href="#"></a></li>
						<li><a class="color5" href="#"></a></li>
						<li><a class="color6" href="#"></a></li>
						<li><a class="color7" href="#"></a></li>
						<li><a class="color8" href="#"></a></li>
						<li><a class="color9" href="#"></a></li>
						<li><a class="color10" href="#"></a></li>
					</ul>
				</div>
				<div class="tab4">
					<ul class="place">

						<li class="sort">Sort by <span>discount</span> </li>
						<li class="by"><img src="images/do.png" alt=""></li>
						<div class="clearfix"> </div>
					</ul>
					<div class="single-bottom">


						<a href="#">
							<input type="checkbox"  id="up" value="">
							<label for="up"><span></span><b>Upto 10%</b></label>
						</a>
						<a href="#">
							<input type="checkbox"  id="up1" value="">
							<label for="up1"><span></span> <b>10%-20%</b></label>
						</a>
						<a href="#">
							<input type="checkbox"  id="up2" value="">
							<label for="up2"><span></span> <b>20%-30%</b></label>
						</a>
						<a href="#">
							<input type="checkbox"  id="up3" value="">
							<label for="up3"><span></span> <b>30%-40%</b></label>
						</a>
						<a href="#">
							<input type="checkbox"  id="up4" value="">
							<label for="up4"><span></span><b>40%-50%</b></label>
						</a>

					</div>
				</div>
				<div class="tab5">
					<ul class="place">

						<li class="sort">Sort by <span>rating</span> </li>
						<li class="by"><img src="images/do.png" alt=""></li>
						<div class="clearfix"> </div>
					</ul>
					<div class="star-at">
						<div class="two">
							<a href="#"> <i></i>  </a>	
							<a href="#"> <i></i>  </a>
							<a href="#"> <i></i>  </a>
							<a href="#"> <i></i>  </a>
							<a href="#"> <i></i>  </a>
						</div>
						<div class="two">
							<a href="#"> <i></i>  </a>	
							<a href="#"> <i></i>  </a>
							<a href="#"> <i></i>  </a>
							<a href="#"> <i></i>  </a>

						</div>
						<div class="two">
							<a href="#"> <i></i>  </a>	
							<a href="#"> <i></i>  </a>
							<a href="#"> <i></i>  </a>

						</div>
						<div class="two">
							<a href="#"> <i></i>  </a>	
							<a href="#"> <i></i>  </a>

						</div>
					</div>

				</div>

				<!--script-->
				<script>
				$(document).ready(function(){
					$(".tab1 .single-bottom").hide();
					$(".tab2 .single-bottom").hide();
					$(".tab3 .w_nav2").hide();
					$(".tab4 .single-bottom").hide();
					$(".tab5 .star-at").hide();
					$(".tab1 ul").click(function(){
						$(".tab1 .single-bottom").slideToggle(300);
						$(".tab2 .single-bottom").hide();
						$(".tab3 .w_nav2").hide();
						$(".tab4 .single-bottom").hide();
						$(".tab5 .star-at").hide();
					})
					$(".tab2 ul").click(function(){
						$(".tab2 .single-bottom").slideToggle(300);
						$(".tab1 .single-bottom").hide();
						$(".tab3 .w_nav2").hide();
						$(".tab4 .single-bottom").hide();
						$(".tab5 .star-at").hide();
					})
					$(".tab3 ul").click(function(){
						$(".tab3 .w_nav2").slideToggle(300);
						$(".tab4 .single-bottom").hide();
						$(".tab5 .star-at").hide();
						$(".tab2 .single-bottom").hide();
						$(".tab1 .single-bottom").hide();
					})
					$(".tab4 ul").click(function(){
						$(".tab4 .single-bottom").slideToggle(300);
						$(".tab5 .star-at").hide();
						$(".tab3 .w_nav2").hide();
						$(".tab2 .single-bottom").hide();
						$(".tab1 .single-bottom").hide();
					})	
					$(".tab5 ul").click(function(){
						$(".tab5 .star-at").slideToggle(300);
						$(".tab4 .single-bottom").hide();
						$(".tab3 .w_nav2").hide();
						$(".tab2 .single-bottom").hide();
						$(".tab1 .single-bottom").hide();
					})	
				});
</script>
<!-- script -->
</div>
<div class="content-bottom-grid">
	<h3>Best Sellers</h3>
	<div class="latest-grid">
		<div class="news">
			<a href="single.html"><img class="img-responsive" src="images/si.jpg" title="name" alt=""></a>
		</div>
		<div class="news-in">
			<h6><a href="single.html">Product name here</a></h6>
			<p>Description Lorem ipsum </p>
			<ul>
				<li>Price: <span>$110</span> </li><b>|</b>
				<li>Country: <span>US</span></li>
			</ul>
		</div>
		<div class="clearfix"> </div>
	</div>
	<div class="latest-grid">
		<div class="news">
			<a href="single.html"><img class="img-responsive" src="images/si1.jpg" title="name" alt=""></a>
		</div>
		<div class="news-in">
			<h6><a href="single.html">Product name here</a></h6>
			<p>Description Lorem ipsum </p>
			<ul>
				<li>Price: <span>$110</span> </li><b>|</b>
				<li>Country: <span>US</span></li>
			</ul>
		</div>
		<div class="clearfix"> </div>
	</div>
	<div class="latest-grid">
		<div class="news">
			<a href="single.html"><img class="img-responsive" src="images/si.jpg" title="name" alt=""></a>
		</div>
		<div class="news-in">
			<h6><a href="single.html">Product name here</a></h6>
			<p>Description Lorem ipsum</p>
			<ul>
				<li>Price: <span>$110</span> </li><b>|</b>
				<li>Country: <span>US</span></li>
			</ul>
		</div>
		<div class="clearfix"> </div>
	</div>
	<div class="latest-grid">
		<div class="news">
			<a href="single.html"><img class="img-responsive" src="images/si1.jpg" title="name" alt=""></a>
		</div>
		<div class="news-in">
			<h6><a href="single.html">Product name here</a></h6>
			<p>Description Lorem ipsum </p>
			<ul>
				<li>Price: <span>$110</span> </li><b>|</b>
				<li>Country: <span>US</span></li>
			</ul>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<!---->
<div class="money">
	<h3>Payment Options</h3>
	<ul class="money-in">
		<li><a href="single.html"><img class="img-responsive" src="images/p1.png" title="name" alt=""></a></li>
		<li><a href="single.html"><img class="img-responsive" src="images/p2.png" title="name" alt=""></a></li>
		<li><a href="single.html"><img class="img-responsive" src="images/p3.png" title="name" alt=""></a></li>
		<li><a href="single.html"><img class="img-responsive" src="images/p4.png" title="name" alt=""></a></li>
		<li><a href="single.html"><img class="img-responsive" src="images/p5.png" title="name" alt=""></a></li>
		<li><a href="single.html"><img class="img-responsive" src="images/p6.png" title="name" alt=""></a></li>
		<li><a href="single.html"><img class="img-responsive" src="images/p1.png" title="name" alt=""></a></li>
		<li><a href="single.html"><img class="img-responsive" src="images/p4.png" title="name" alt=""></a></li>
		<li><a href="single.html"><img class="img-responsive" src="images/p2.png" title="name" alt=""></a></li>

	</ul>
</div>
</div>
<div class="clearfix"> </div>
</div>
<!---->
<div class="footer">
	<p class="footer-class">© 2015 Mihstore All Rights Reserved | Template by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>

	<a href="#home" class="scroll to-Top" >  GO TO TOP!</a>
	<div class="clearfix"> </div>
</div>	 	
</div>
</div>
<!---->
</body>
</html>