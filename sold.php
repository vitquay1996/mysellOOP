<?php include_once 'include/checkuser.php';
include_once 'models/Post.php';
if(isset($_GET['id'])){ 
	$Post = new Post($_GET['id']);
	$Post->status = 0;
	$Post->update();

	header('Location: user.php');
	exit;
}
?>