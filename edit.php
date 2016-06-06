<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include_once 'include/checkUser.php';
include_once 'models/Category.php';
include_once 'models/Post.php';?>
<?php
if(isset($_POST['submit'])){
//Apply stripslashes to all elements in array
	$_POST = array_map('stripslashes', $_POST);

//collect form data so we have $postTitle, $postDesc, $postCont
	extract($_POST);

//very basic validation
	include_once 'include/checkEdit.php';

	$status = 1;
	if (isset($error)){
		try
		{
			$Post = new Post($_GET['id']); 
			$Post->title = $postTitle;
			$Post->description = $postDescription;
			$Post->catID = $category;
			$Post->price = $postPrice;

      		$Post->update(); //update new data

      		header('Location: user.php');
      		exit;
      	}
      	catch(UpdateException $e)
      	{
      		$e->errorMessage();
      	}
      }
      else{
      	foreach($error as $error){
      		echo '<p class="error">'.$error.'</p>';
      	}
      }

  }
  ?>
  <!DOCTYPE html>
  <html>
  <?php include_once 'include/header.php';?>

  <body> 
  	<!--header-->
  	<?php include_once 'include/navbar.php'; ?>
  	<div class="row">
  		<div class="col-sm-1">
  		</div>
  		<div class="col-sm-10">
  			<form action='' method='post'>
  				<?php 
  				$Post = new Post($_GET['id']);
  				?>

  				<p><label>Title</label><br />
  					<input type='text' name='postTitle' value='<?php if(isset($error)){ echo $_POST['post.title'];} else { echo $Post->title;}?>'>
  				</p>

  				<p><label>Description</label><br />
  					<textarea name='postDescription' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['post.description'];} else { echo $Post->description;}?></textarea>
  				</p>

  				<p><label>Category</label><br />
  					<select name="category">
						<?php 
						try
						{
							$Cat = new Category();
							$Cat = $Cat->findAllCategory();
							foreach ($Cat as $Cat1) {
								if (strlen($Cat1->id2) == 3) {								
									echo '<option value="'.$Cat1->id.'">'.$Cat1->name.'</option>';
								}
								else if (strlen($Cat1->id2) == 7) {
									echo '<option value="'.$Cat1->id.'">&emsp;'.$Cat1->name.'</option>';
								}
								else if (strlen($Cat1->id2) == 11) {
									echo '<option value="'.$Cat1->id.'">&emsp;----'.$Cat1->name.'</option>';
								}
							}
						}
						catch(Exception $e)
						{
							/*** if we are here, something has gone wrong with the database ***/
							$message = 'We are unable to process your request. Please try again later"';

						}
						?>
  					</select>

  					<p><label>Price</label><br />
  						<input type="number" name='postPrice' value='<?php if(isset($error)){ echo $_POST['post.price'];} else { echo $Post->price;}?>'>vnd</input>
  					</p>

  					<p><button type='submit' class="btn btn-success" name='submit'>Submit</button></p>

  				</form>
  			</div>
  			<div class="col-sm-1">
  			</div>
  		</div>



  		<div class="clearfix"> </div>
  	</div>


  	<!---->
  </body>
  </html>

