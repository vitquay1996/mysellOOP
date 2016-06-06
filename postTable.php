<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php include_once 'include/checkAdmin.php';
include_once 'models/Post.php';
if(isset($_GET['delpost'])){ 
	$Post3 = new Post($_GET['delpost']);
	$Post3->delete();
	header('Location: postTable.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Post Table</title>

	<!-- Bootstrap -->
	<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- Datatabes -->
	<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
	<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
	<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
	<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="css/custom.css" rel="stylesheet">
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="admin.php" class="site_title"><i class="fa fa-paw"></i> <span>Admin Page</span></a>
					</div>

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
					<div class="profile">
						<div class="profile_pic">
							<img src="images/1.jpg" alt="..." class="img-circle profile_img">
						</div>
						<div class="profile_info">
							<span>Welcome,</span>
							<h2><?php echo $User->username;?></h2>
						</div>
					</div>
					<!-- /menu profile quick info -->

					<br />

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>General</h3>
							<ul class="nav side-menu">
								<li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="admin.php">Dashboard</a></li>
									</ul>
								</li>

								
								<li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="postTable.php">Posts</a></li>
										<li><a href="userTable.php">Users</a></li>
									</ul>
								</li>

							</ul>
						</div>


					</div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<div class="sidebar-footer hidden-small">
						<a href="index.php" data-toggle="tooltip" data-placement="top" title="Lock">
							<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
						</a>
						<a href="logout.php" data-toggle="tooltip" data-placement="top" title="Logout">
							<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
						</a>
					</div>
					<!-- /menu footer buttons -->
				</div>
			</div>



			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>Post</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table id="datatable" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>ID</th>
												<th>Title</th>
												<th>Description</th>
												<th>Author</th>
												<th>Category</th>
												<th>Price</th>
												<th>Date</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>


										<tbody>
											<?php	
											$Post1 = new Post();
											$Post1 = $Post1->postWithCategory();

											foreach ($Post1 as $Post2) {
												?>
												<tr>
													<td><?php echo $Post2->id;?></td>
													<td><?php echo $Post2->title;?></td>
													<td><?php echo $Post2->description;?></td>
													<td><?php echo $Post2->username;?></td>
													<td><?php echo $Post2->catID;?></td>
													<td><?php echo $Post2->price;?></td>
													<td><?php echo $Post2->date;?></td>
													<td><?php echo $Post2->status;?></td>
													<td><a href='postTable.php?delpost=<?php echo $Post2->id;?>' class="btn btn-danger btn-xs" role="button">DELETE</a></td>
												</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>


							<!-- footer content -->
							<footer>
								<div class="pull-right">
									Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
								</div>
								<div class="clearfix"></div>
							</footer>
							<!-- /footer content -->
						</div>
					</div>

					<!-- jQuery -->
					<script src="vendors/jquery/dist/jquery.min.js"></script>
					<!-- Bootstrap -->
					<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
					<!-- FastClick -->
					<script src="vendors/fastclick/lib/fastclick.js"></script>
					<!-- NProgress -->
					<script src="vendors/nprogress/nprogress.js"></script>
					<!-- Datatables -->
					<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
					<script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
					<script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
					<script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
					<script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
					<script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
					<script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
					<script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
					<script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
					<script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
					<script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
					<script src="vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
					<script src="vendors/jszip/dist/jszip.min.js"></script>
					<script src="vendors/pdfmake/build/pdfmake.min.js"></script>
					<script src="vendors/pdfmake/build/vfs_fonts.js"></script>

					<!-- Custom Theme Scripts -->
					<script src="js/custom.js"></script>

					<!-- Datatables -->
					<script>
					$(document).ready(function() {
						var handleDataTableButtons = function() {
							if ($("#datatable-buttons").length) {
								$("#datatable-buttons").DataTable({
									dom: "Bfrtip",
									buttons: [
									{
										extend: "copy",
										className: "btn-sm"
									},
									{
										extend: "csv",
										className: "btn-sm"
									},
									{
										extend: "excel",
										className: "btn-sm"
									},
									{
										extend: "pdfHtml5",
										className: "btn-sm"
									},
									{
										extend: "print",
										className: "btn-sm"
									},
									],
									responsive: true
								});
							}
						};

						TableManageButtons = function() {
							"use strict";
							return {
								init: function() {
									handleDataTableButtons();
								}
							};
						}();

						$('#datatable').dataTable();
						$('#datatable-keytable').DataTable({
							keys: true
						});

						$('#datatable-responsive').DataTable();

						$('#datatable-scroller').DataTable({
							ajax: "js/datatables/json/scroller-demo.json",
							deferRender: true,
							scrollY: 380,
							scrollCollapse: true,
							scroller: true
						});

						var table = $('#datatable-fixed-header').DataTable({
							fixedHeader: true
						});

						TableManageButtons.init();
					});
</script>
<!-- /Datatables -->
</body>
</html>