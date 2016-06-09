<?php	
	if($title == ''){
		$error = 'Please enter the title.';
	}

	elseif($description == ''){
		$error = 'Please enter the description.';
	}

	elseif($price == ''){
		$error = 'Please enter the price.';
	}

	elseif($category == ''){
		$error = 'Please select category';
	}

	elseif($_FILES["image"]["tmp_name"] == ''){
		$error= 'Please upload an image';
	}
	?>