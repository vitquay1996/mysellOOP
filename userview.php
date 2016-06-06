<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php function dateformat($date1){
	$date = new DateTime($date1);
 // $day = $date->format("d");
 // $month = $date->format("m");
 // $year = $date->format("Y");

	return $date;
}
?>
<?php include_once 'include/checkUser.php';
include_once 'models/Upload.php';
include_once 'models/Post.php';
include_once 'models/Comment.php'?>
<!DOCTYPE html>
<html>
<?php include_once 'include/userviewnavbar.php';?>
<body> 
	<!--header-->
	<?php include_once 'include/navbar.php';?>
	<div class="content">
		<div class="col-md-11">
			<div class="col-md-5 single-top">	
				<ul id="etalage">
					<li>
						<?php
						$Upload = new Upload();
						$Upload = $Upload->findByPostID($_GET['id']);
						?>
						<img class="etalage_thumb_image img-responsive" src="images/<?php echo $Upload->id.'.'.$Upload->type;?>" alt="" >
						<img class="etalage_source_image img-responsive" src="images/<?php echo $Upload->id.'.'.$Upload->type;?>" alt="" >

					</li>

				</ul>

			</div>	
			<div class="col-md-7 single-top-in">
				<div class="single-para">
					<?php
					try
					{
						$Post = new Post($_GET['id']);
					}
					catch (Exception $e) {
						echo $e->getMessage();
					}

					?>
					<h1><?php echo $Post->title;?></h1>
					<?php if (isset($_SESSION['user_id']) && ($User->username == $Post->username)){?>
					<br/>
					<a href="javascript:delpost('<?php echo $_GET['id'];?>','<?php echo $Post->title;?>')" class="btn btn-danger">
						<span class="glyphicon glyphicon-trash"></span> Delete 
					</a>
					<a href="edit.php?id=<?php echo $_GET['id'];?>" class="btn btn-success">
						<span class="glyphicon glyphicon-pencil"></span> Edit 
					</a>
					<a href="sold.php?id=<?php echo $_GET['id'];?>" class="btn btn-warning">
						<span class="glyphicon glyphicon-shopping-cart"></span> Sold 
					</a>

					<?php }?>
					<div class="para-grid">
						<span  class="add-to"><?php echo $Post->price.' vnd';?></span> 

						<div class="clearfix"></div>
					</div>
					<h5><?php echo $Post->description;?></h5>
					<br/>

					<?php
					if ($Post->status == 1) {
						echo '<h4>Item Available</h4>';
					}
					else {
						echo '<h4>Item Sold</h4>';
					}
					?>
					<!-- COMMENT SECTION -->

					<br/>
					<?php
					$Comment = new Comment();
					$Comment = $Comment->findByPostID($_GET['id']);
					foreach ($Comment as $Comment1) {
						$todayDate = date('Y-m-d');
						$todayDate = dateformat($todayDate);
						$commentDate = dateformat($Comment1->date);
						$dateDiff = date_diff($commentDate,$todayDate);
						?>
						<div class="container">
							<div class="row">
								<div class="col-sm-6">
									<div class="panel panel-default">
										<div class="panel-heading">
											<strong><?php echo $Comment1->username;?></strong> <span class="text-muted">commented <?php echo $dateDiff->format("%a days").' ago';?></span>
										</div>
										<div class="panel-body">
											<?php echo $Comment1->content;?>
										</div><!-- /panel-body -->
									</div><!-- /panel panel-default -->
								</div><!-- /col-sm-5 -->
							</div><!-- /row -->
						</div>
						<?php } ?>

						<!-- COMMENT BOX -->
						<?php if (isset($_SESSION['user_id'])) {
							?>
						
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<div class="widget-area no-padding blank">
										<div class="status-upload">
											<form action="submitComment.php" method="post">
												<textarea name="comment" placeholder="Write a public comment..." ></textarea>
												<input type="hidden" name="postID" value="<?php echo $_GET['id'];?>">
												<button type="submit" class="btn btn-success green"><i class="fa fa-share"></i>Comment</button>
											</form>
										</div><!-- Status Upload  -->
									</div><!-- Widget Area -->
								</div>

							</div>
						</div>
						<?php }?>
						<div class="share">
							<h4>Share Product :</h4>
							<ul class="share_nav">
								<li><a href="#"><img src="images/facebook.png" title="facebook"></a></li>
								<li><a href="#"><img src="images/twitter.png" title="Twiiter"></a></li>
								<li><a href="#"><img src="images/rss.png" title="Rss"></a></li>
								<li><a href="#"><img src="images/gpluse.png" title="Google+"></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>

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

<!---->
</body>
</html>