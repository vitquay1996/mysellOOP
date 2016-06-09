<?php ?>
<head>
	<title>Userview</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="js/jquery.min.js"></script>
	<!-- Custom Theme files -->
	<!--theme-style-->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
	<!--//theme-style-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Mihstore Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!--fonts-->
	<link href='http://fonts.googleapis.com/css?family=Cabin:400,500,600,700' rel='stylesheet' type='text/css'>
	<!--//fonts-->
	<style>
.dropbtn {
    background-color: white;
    color: black;
    padding: 20px;
    font-size: 20px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
  z-index:10;
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.dropdown-content a {
  z-index:10;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: white}

.dropdown:hover .dropdown-content {
  z-index:10;
    display: block;
}

.dropdown:hover .dropbtn {
  z-index:10;
    background-color: white;
}
</style>
<style>
#SubProductRoad {
    position: relative;
    z-index: 1;
}
#SubProductRoad .road {
    height: 27px;
    margin: 7px 0 0 0;
    position: relative;
    z-index: 2;
}
#SubProductRoad .road a.lv1 {
    font: normal 11px/25px Arial;
    color: #333;
    height: 27px;
    display: inline-block;
}
#SubProductRoad a.arrow {
    padding-left: 16px;
    background: url(http://wetrek.vn/cms/display/Product/SubControls/Hoa/SubProductRoad/arrow.gif.ashx) no-repeat 6px 10px;
}
</style>
	<!--//slider-script-->
	<script>$(document).ready(function(c) {
		$('.alert-close').on('click', function(c){
			$('.message').fadeOut('slow', function(c){
				$('.message').remove();
			});
		});	  
	});
	</script>
	<script>$(document).ready(function(c) {
		$('.alert-close1').on('click', function(c){
			$('.message1').fadeOut('slow', function(c){
				$('.message1').remove();
			});
		});	  
	});
	</script>
	<script>$(document).ready(function(c) {
		$('.alert-close2').on('click', function(c){
			$('.message2').fadeOut('slow', function(c){
				$('.message2').remove();
			});
		});	  
	});
	</script>
	<link rel="stylesheet" href="css/etalage.css">
	<script src="js/jquery.etalage.min.js"></script>
	<script>
	jQuery(document).ready(function($){

		$('#etalage').etalage({
			thumb_image_width: 300,
			thumb_image_height: 400,
			source_image_width: 900,
			source_image_height: 1200,
			show_hint: true,
			click_callback: function(image_anchor, instance_id){
				alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
			}
		});

	});
	</script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
	</script>
	<!-- start menu -->
	<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="js/megamenu.js"></script>
	<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>	
	<!-- ask for confirmation to delete post	 -->
	<script language="JavaScript" type="text/javascript">
	function delpost(id, title)
	{
		if (confirm("Are you sure you want to delete '" + title + "'"))
		{
			window.location.href = 'user.php?delpost=' + id;
		}
	}
	</script>
</head>
<?php ?>