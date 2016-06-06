<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include_once 'include/checkUser.php';
if (!isset($_GET['key'])) {
	header('Location: index.php');
	exit;
}
include_once 'models/Post.php';
include_once 'models/Upload.php';

//Add GET variable without losing previous ones
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
	<?php include_once 'include/navbar.php'; ?>
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
				<br/>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
	<div class="content-bottom store">
		<div class="col-md-9">
			<h3>products</h3>
			<div class="bottom-grid">
				<?php 
				try
				{
					$Post = new Post();
					/*** prepare the select statement ***/
					if (!isset($_GET['price'])) {
						$Post = $Post->search($_GET['key']);
					}
					else {
						if ($_GET['price'] == 'increase') {
							$Post = $Post->searchPriceUp($_GET['key']);
						}
						else {
							$Post = $Post->searchPriceDown($_GET['key']);
						}
					}
				$iter = 1; //looping variable to make space between row
				foreach ($Post as $Post1) {
					if ($iter % 3 == 1) {?>
					<div class="bottom-grid">
						<?php }
						$Upload = new Upload();
						$Upload = $Upload->findByPostID($Post1->id);
						?>
						<div class="col-md-4 store-top">
							<div class="bottom-grid-top">
								<a href="userview.php?id=<?php echo $Post1->id;?>"><img class="img-responsive" src="images/<?php echo $Upload->id.'.'.$Upload->type;?>" alt="" >
									<?php if ($Post1->status == 0) {?>
									<div class="five">
										<h6 class="one">SOLD</h6>
									</div>
									<?php }?>
									<div class="pre">
										<p><?php echo $Post1->title;?></p>
										<span><?php echo $Post1->price.' vnd';?></span>
										<div class="clearfix"> </div>
									</div>
								</a>
							</div>
						</div>
						<?php if ($iter % 3 == 0) {?>
						<div class	="clearfix"> </div>
					</div>
					<?php }
					$iter = $iter + 1;
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
			

		</div>
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

			</div>
			
			<div class="tab4">
				<ul class="place">

					<li class="sort">Sort by <span>category</span> </li>
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
</div>
</body>
</html>