<?php
include_once 'include/checkUser.php';
include_once 'models/Post.php';
include_once 'models/Upload.php';

if(isset($_POST['submit'])){
//Apply stripslashes to all elements in array
	$_POST = array_map('stripslashes', $_POST);

//collect form data so we have $postTitle, $postDesc, $postCont
	extract($_POST);

//very basic validation
	include_once 'include/checkPost.php';
	$status = 1;
	if (!isset($error)){
		//insert info into mysell_posts
		try
		{
			$Post = new Post();
			$Post->title = $title;
			$Post->description = $description;
			$Post->username = $User->username;
			$Post->catID = $category;
			$Post->price = $price;
			$Post->date = date('Y-m-d');
			$Post->status = 1;
			$Post->create();

			$imageFileType = pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);
			$imageSize = $_FILES['image']['size'];

			//Insert into mysell_upload
			$Upload = new Upload();
			$Upload->postID = $Post->id;
			$Upload->type = $imageFileType;
			$Upload->size = $imageSize;
			$Upload->create();

			//Find newUploadID to name file in directory

		}
		catch(CreateException $e) {
			$e->errorMessage();
		}
	}
	else{
		header("Location: post.php?message=".$error);
		exit;
	}

	//Check file
	$target_dir = "images/";
	
	$target_file = $target_dir . $Upload->id . '.' . 	$imageFileType;
	$uploadOk = 1;
	
// Check if image file is a actual image or fake image

	$imageSize = getimagesize($_FILES["image"]["tmp_name"]);
	if($imageSize !== false) {
		echo "File is an image - " . $imageSize["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}	

// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	echo $_FILES["image"]["tmp_name"];
// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
			print_r($_FILES);
		}
	}
	header('Location: user.php');
			exit;
}
?>