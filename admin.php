<?php function dateformat($date1){
  $date = new DateTime($date1);
  $day = $date->format("d");
  $month = $date->format("m");
  $year = $date->format("Y");

  return [$day, $month, $year];
}
?>

<?php include_once 'include/checkAdmin.php';
include_once 'models/Count.php';
include_once 'models/DateCount.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Admin</title>

  <!-- Bootstrap -->
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- bootstrap-progressbar -->
  <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- jVectorMap -->
  <link href="css/maps/jquery-jvectormap-2.0.3.css" rel="stylesheet"/>

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
        <!-- top tiles -->
        <div class="row tile_count">
          <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
        <?php //find total number of users
        $Count = new Count();
        $numberUser = $Count->totalUser();
        $numberUser = $numberUser->count;

        //find number of user last week
        $numberUserLastWeek = $Count->userLastWeek();
        $numberUserLastWeek = $numberUserLastWeek->count;

        $change = round(($numberUser-$numberUserLastWeek) / $numberUserLastWeek * 100);

        ?>
        <div class="count"><?php echo $numberUser;?></div>
        <?php if ($change >=0) {?>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php echo $change;?>% </i> From last Week</span>
        <?php } else {?>
        <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?php echo $change;?>% </i> From last Week</span>
        <?php }?>
      </div>

      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Post</span>
        <?php //find total number of posts
        $numberPost = $Count->totalPost();
        $numberPost = $numberPost->count;
        //find total number of posts lastweek
        $numberPostLastWeek = $Count->postLastWeek();
        $numberPostLastWeek = $numberPostLastWeek->count;

        $change = round(($numberPost-$numberPostLastWeek) / $numberPostLastWeek * 100);        
        ?>
        <div class="count"><?php echo $numberPost;?></div>
        <?php if ($change >=0) {?>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php echo $change;?>% </i> From last Week</span>
        <?php } else {?>
        <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?php echo $change;?>% </i> From last Week</span>
        <?php }?>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Post this week</span>
        <?php //find total number of posts
        $postThisWeek = $Count->postThisWeek();
        $postThisWeek = $postThisWeek->count;

        $postPerLastWeek = $Count->postPerLastWeek();
        $postPerLastWeek = $postPerLastWeek->count;

        $change = round(($postThisWeek-$postPerLastWeek) / $postPerLastWeek * 100);     
        ?>
        <div class="count"><?php echo $postThisWeek;?></div>
        <?php if ($change >=0) {?>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php echo $change;?>% </i> From last Week</span>
        <?php } else {?>
        <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?php echo $change;?>% </i> From last Week</span>
        <?php }?>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i>New user this week</span>
      <?php //find total number of posts
      $userThisWeek = $Count->userThisWeek();
      $userThisWeek = $userThisWeek->count;

      $userPerLastWeek = $Count->userPerLastWeek();
      $userPerLastWeek = $userPerLastWeek->count;

      $change = round(($userThisWeek-$userPerLastWeek) / $userPerLastWeek * 100);
      ?>
      <div class="count"><?php echo $userThisWeek;?></div>
      <?php if ($change >=0) {?>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php echo $change;?>% </i> From last Week</span>
      <?php } else {?>
      <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?php echo $change;?>% </i> From last Week</span>
      <?php }?>
    </div>
  </div>
  <!-- /top tiles -->

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row x_title">
          <div class="col-md-6">
            <h3>Posts Activities</h3>
          </div>
          <div class="col-md-6">
          </div>
        </div>

        <div class="col-md-12 col-sm-9 col-xs-12">
          <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
          <div style="width: 100%;">
            <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
          </div>
        </div>


        <div class="clearfix"></div>
      </div>
    </div>

  </div>
  <br />
</body>


  
  <!-- /page content -->

  <!-- footer content -->
  <footer>
    <div class="pull-right">
      Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
    </div>
    <div class="clearfix"></div>
  </footer>
  <!-- /footer content -->


<!-- jQuery -->
<script src="vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="vendors/Chart.js/dist/Chart.min.js"></script>



<!-- Flot -->
<script src="vendors/Flot/jquery.flot.js"></script>
<script src="vendors/Flot/jquery.flot.pie.js"></script>
<script src="vendors/Flot/jquery.flot.time.js"></script>
<script src="vendors/Flot/jquery.flot.stack.js"></script>
<script src="vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="js/flot/jquery.flot.orderBars.js"></script>
<script src="js/flot/date.js"></script>
<script src="js/flot/jquery.flot.spline.js"></script>
<script src="js/flot/curvedLines.js"></script>

<!-- bootstrap-daterangepicker -->
<script src="js/moment/moment.min.js"></script>
<script src="js/datepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="js/custom.js"></script>

<!-- Flot -->
<script>
$(document).ready(function() {
  <?php 
  $data = new DateCount();
  $data = $data->postPerDay();
                // $data1 = $data->fetch();
                // $date = dateformat($data1['post.date']);
  ?>

  var data1 = [<?php foreach ($data as $data) {
    $date = dateformat($data->date);
    echo '
    [gd('.$date[2].','.$date[1].','.$date[0].'), '.$data->count.'],';
  }?>];


  $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
    data1
    ], {
      series: {
        lines: {
          show: false,
          fill: true
        },
        splines: {
          show: true,
          tension: 0.4,
          lineWidth: 1,
          fill: 0.4
        },
        points: {
          radius: 0,
          show: true
        },
        shadowSize: 2
      },
      grid: {
        verticalLines: true,
        hoverable: true,
        clickable: true,
        tickColor: "#d5d5d5",
        borderWidth: 1,
        color: '#fff'
      },
      colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
      xaxis: {
        tickColor: "rgba(51, 51, 51, 0.06)",
        mode: "time",
        tickSize: [1, "day"],
                      //tickLength: 10,
                      axisLabel: "Date",
                      axisLabelUseCanvas: true,
                      axisLabelFontSizePixels: 12,
                      axisLabelFontFamily: 'Verdana, Arial',
                      axisLabelPadding: 10
                    },
                    yaxis: {
                      ticks: 8,
                      tickColor: "rgba(51, 51, 51, 0.06)",
                    },
                    tooltip: false
                  });

function gd(year, month, day) {
  return new Date(year, month - 1, day).getTime();
}
});
</script>
<!-- /Flot -->
</body>
</html>