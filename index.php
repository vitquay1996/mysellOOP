<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include_once 'include/checkUser.php';
include_once 'models/Post.php';
include_once 'models/Upload.php';
include_once 'models/NameCount.php';
function addOrUpdateUrlParam($name, $value)
{
	$params = $_GET;
	unset($params[$name]);
	$params[$name] = $value;
	return basename($_SERVER['PHP_SELF']).'?'.http_build_query($params);
}

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
					try
					{
						$Post = new Post();
						if (!isset($_GET['cat']) && !isset($_GET['price'])) {
							$Post = $Post->findEveryRecentPost();
						}
						else if (isset($_GET['cat']) && !isset($_GET['price'])) 
						{
							$Post = $Post->findByCat($_GET['cat']);
						}
						else if (!isset($_GET['cat']) && isset($_GET['price']))
						{
							$Post = $Post->findPrice($_GET['price']);
						}
						else if (isset($_GET['cat']) && isset($_GET['price'])) 
						{
							$Post = $Post->findByCatPrice($_GET['cat'], $_GET['price']);
						}

						$iter = 1; //looping variable to make space between row

						//Pagination
						$numEntry = count($Post);
						$numPage = ceil($numEntry/12);
						$numPostPerPage = 12; //set number of post per page here

						if (isset($_GET['page'])) {
							$iter2 = ($_GET['page'] - 1) * $numPostPerPage; 
						}
						else {
							$_GET['page'] = 1;
							$iter2 = 0;
						}
						$limit = $_GET['page']*$numPostPerPage;
						while (($iter2 < $limit) && isset($Post[$iter2])) {
							if ($Post[$iter2]->status == 1) {
								$Upload = new Upload();
								$Upload = $Upload->findByPostID($Post[$iter2]->id);
								if ($iter % 3 == 1) {?>
								<div class="bottom-grid">
									<?php }?>
									<div class="col-md-4 shirt">
										<div class="bottom-grid-top">
											<a href="userview.php?id=<?php echo $Post[$iter2]->id;?>"><img class="img-responsive" src="images/<?php echo $Upload->id.'.'.$Upload->type;?>" alt="" >
												<div class="pre">
													<p><?php echo $Post[$iter2]->title;?></p>
													<span><?php echo $Post[$iter2]->price.' vnd';?></span>
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
							else {
								$limit = $limit + 1;
							}
							$iter2 = $iter2 + 1;

							
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
				
				?>
				<div class="bottom-grid">

					<div class="clearfix"> </div>
				</div>
			</div>
			<ul class="start">
				<?php for($i=1; $i<=$numPage; $i++) {
					$url = addOrUpdateUrlParam('page', $i);
					if ($i == $_GET['page']) { ?>
						<li><span><?php echo $i;?></span></li>
					<?php }
					else { ?>
						<li class="arrow"><a href="<?php echo $url?>"><?php echo $i;?></a></li>
					<?php }
				}?>
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
					<?php
					$url = addOrUpdateUrlParam('price', 'increase');
					?>
					<a href='<?php echo $url;?>'>
						<label for="brand"><span></span><b>Increasing</b></label>
					</a>
					<?php 
					$url = addOrUpdateUrlParam('price', 'decrease');
					?>
					<a href='<?php echo $url;?>'>
						<label for="brand1"><span></span> <b>Decreasing</b></label>
					</a>


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
	
		<?php 
			$Name = new NameCount();
			$Name = $Name->bestSeller();
			$iter = 0;
			while ($iter<3 && isset($Name[$iter])) {
			?>
	<div class="latest-grid">
		<div class="news-in">
			<h6><a href="user.php?user=<?php echo $Name[$iter]->username?>"><?php echo $Name[$iter]->username;?></a></h6>
			<ul>
				<li>Sold: <span><?php echo $Name[$iter]->count;?></span> </li><b>|</b>
			</ul>
		</div>
		<div class="clearfix"> </div>
	</div>
	<?php
		$iter = $iter +1;
	}?>
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
	<div class="clearfix"> </div>
</div>	 	
</div>
</div>
<!---->
</body>
</html>