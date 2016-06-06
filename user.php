<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include_once 'include/requireUser.php';
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
				$Post = $Post->findByUsername($User->username);
				$iter = 1; //looping variable to make space between row
				foreach ($Post as $Post1) {
					if ($iter % 4 == 1) {?>
					<div class="bottom-grid">
						<?php }
						try {
							$Upload = new Upload();
							$Upload = $Upload->findByPostID($Post1->id);
						}
						catch (Exception $e) {
							echo "Yes error";
						}
						?>
						<div class="col-md-3 store-top">
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
						<?php if ($iter % 4 == 0) {?>
						<div class="clearfix"> </div>
					</div>
					<?php }
					$iter = $iter + 1;
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
	</body>
	</html>