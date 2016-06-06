<?php
include_once 'models/Post.php';
try
{
	$Post=new Post();
	$Post->title = 'asdfasdf';
	$Post->description = 'asdfasdf';
	$Post->username = 'vitquay1996';
	$Post->catID = 1;
	$Post->price = 10000000;
	$Post->date = date('Y-m-d');
	$Post->status = 1;
	$Post->create();
}
catch(CreateException $e)
{
}
?>