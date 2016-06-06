<?php

echo '<head>
	<title>MySell</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
	<script src="js/jquery.min.js"></script>
	<!-- Custom Theme files -->
	<!--theme-style-->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
	<!--//theme-style-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="buy, sell" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!--fonts-->
	<link href=\'http://fonts.googleapis.com/css?family=Cabin:400,500,600,700\' rel=\'stylesheet\' type=\'text/css\'>
	<!--//fonts-->
	<!--//slider-script-->
	<script>$(document).ready(function(c) {
		$(\'.alert-close\').on(\'click\', function(c){
			$(\'.message\').fadeOut(\'slow\', function(c){
				$(\'.message\').remove();
			});
		});	  
	});
	</script>
	<script>$(document).ready(function(c) {
		$(\'.alert-close1\').on(\'click\', function(c){
			$(\'.message1\').fadeOut(\'slow\', function(c){
				$(\'.message1\').remove();
			});
		});	  
	});
	</script>
	<script>$(document).ready(function(c) {
		$(\'.alert-close2\').on(\'click\', function(c){
			$(\'.message2\').fadeOut(\'slow\', function(c){
				$(\'.message2\').remove();
			});
		});	  
	});
	</script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$(\'html,body\').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
	</script>	
	<!-- start menu -->
	<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/megamenu.js"></script>
	<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>		
	<script src="//tinymce.cachefly.net/4.0/tinymce.min.js">
    </script>
    <script>
    tinymce.init({
    	selector: "textarea",
    	plugins: [
    	"advlist autolink lists link image charmap print preview anchor",
    	"searchreplace visualblocks code fullscreen",
    	"insertdatetime media table contextmenu paste"
    	],
    	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
    </script>   

    <script src="vendors/dropzone/dist/min/dropzone.min.js"></script>
<script>
Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

  // The configuration we\'ve talked about above
  autoProcessQueue: false,
  uploadMultiple: true,
  parallelUploads: 100,
  maxFiles: 100,

  // The setting up of the dropzone
  init: function() {
    var myDropzone = this;

    // First change the button to actually tell Dropzone to process the queue.
    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
      // Make sure that the form isn\'t actually being sent.
      e.preventDefault();
      e.stopPropagation();
      myDropzone.processQueue();
    });

    // Listen to the sendingmultiple event. In this case, it\'s the sendingmultiple event instead
    // of the sending event because uploadMultiple is set to true.
    this.on("sendingmultiple", function() {
      // Gets triggered when the form is actually being sent.
      // Hide the success button or the complete form.
    });
    this.on("successmultiple", function(files, response) {
      // Gets triggered when the files have successfully been sent.
      // Redirect user or notify of success.
    });
    this.on("errormultiple", function(files, response) {
      // Gets triggered when there was an error sending the files.
      // Maybe show form again, and notify user of error
    });
  }

}
</script>
<link href="vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">		

</head>';
?>