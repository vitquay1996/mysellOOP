<?php	
	if(`$postTitle` ==''){
		$error[] = 'Please enter the title.';
	}

	if(`$postDescription` ==''){
		$error[] = 'Please enter the description.';
	}

	if(`$postPrice` ==''){
		$error[] = 'Please enter the price.';
	}

	if($category == ''){
		$error[] = 'Please select category';
	}

	if(!isset($_FILES)){
		$error[]= 'Please upload an image';
	}
	?>