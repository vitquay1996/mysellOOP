<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include_once 'include/checkUser.php';
include_once 'models/Category.php';?>

<!DOCTYPE html>
<html>
<?php include_once 'include/header.php';?>

<body> 
	<!--header-->
	<?php include_once 'include/navbar.php';?>
	<br/>	
	<div class="row">
		<div class="col-sm-1">
		</div>
		<div class="col-sm-10">
			<form action='postSubmit.php' method='post' enctype="multipart/form-data">

				<p><label>Title</label><br />
					<input type='text' name='title' value='<?php if(isset($error)){ echo $_POST['title'];}?>'>
				</p>

				<p><label>Description</label><br />
					<textarea name='description' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['description'];}?></textarea>
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
						<input type="number" name='price' value='<?php if(isset($error)){ echo $_POST['price'];}?>'>vnd</input>
					</p>

					<p><label>Upload Image</label><br />
						<input type="file" name="image" id="image">
					</p>

					
					<p><button type='submit' class="btn btn-success" name='submit'>Post</button></p>

				</form>
			</div>
			<div class="col-sm-1">
			</div>
		</div>



		<div class="clearfix"> </div>
	</div>


	<!---->
</body>
<script src="vendors/dropzone/dist/min/dropzone.min.js"></script>
<link href="vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
</html>


