<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include_once 'include/checkUser.php';
include_once 'models/Post.php';
if(isset($_GET['delpost'])){ 
	try
	{
		$Post=new Post();
		$Post->delete($_GET['delpost']);
	}
	catch(DeleteException $e)
	{
      //handle exception
	}


	header('Location: user.php');
	exit;
}
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
<?php include_once 'include/header.php';
include_once 'models/Post.php';
include_once 'models/Upload.php';
?>

<body> 
	<!--header-->
	<?php include_once 'include/navbar.php';?>

	<div class="content-bottom store">
		<h3>products</h3>
		<div class="bottom-grid">
			<?php 
			try
			{
				$Post = new Post();
				if (!isset($_GET['user'])) {
					$Post = $Post->findByUsername($User->username);
				}
				else {
					$Post = $Post->findByUsername($_GET['user']);
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
					if ($iter % 4 == 1) {?>
					<div class="bottom-grid">
						<?php }
						try {
							$Upload = new Upload();
							$Upload = $Upload->findByPostID($Post[$iter2]->id);
						}
						catch (Exception $e) {
							echo "Yes error";
						}
						?>
						<div class="col-md-3 store-top">
							<div class="bottom-grid-top">
								<a href="userview.php?id=<?php echo $Post[$iter2]->id;?>"><img class="img-responsive" src="images/<?php echo $Upload->id.'.'.$Upload->type;?>" alt="" >
									<?php if ($Post[$iter2]->status == 0) {?>
									<div class="five">
										<h6 class="one">SOLD</h6>
									</div>
									<?php }?>
									<div class="pre">
										<p><?php echo $Post[$iter2]->title;?></p>
										<span><?php echo $Post[$iter2]->price.' vnd';?></span>
										<div class="clearfix"> </div>
									</div>
								</a>
							</div>
						</div>
						<?php if ($iter % 4 == 0) {?>
						<div class="clearfix"> </div>
					</div>
					<?php }
					$iter = $iter + 1;
					$iter2 = $iter2 +1;
				}

				if (($iter % 4) != 1) {
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
	</br>
</br>
</br>
</br>
<div class="container">
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
<div class="footer">
	<p class="footer-class">© 2015 Mihstore All Rights Reserved | Template by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
	<div class="clearfix"> </div>
</div>		
</body>
</html>