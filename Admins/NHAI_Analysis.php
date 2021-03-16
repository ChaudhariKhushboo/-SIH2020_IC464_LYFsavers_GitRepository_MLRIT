<?php
  include('connection.php');
  session_start();
  $role = $_SESSION['admin_role'];

    $nm = $_SESSION['name'];
    $id = $_SESSION['id'];

    $Ambulance = mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as amb from `van_info` Where `owner_id` = '".$_SESSION['id']."'"));
    $Driver = mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as driver from `driver_info` Where `owner_id` = '".$_SESSION['id']."'"));

    $amb=mysqli_query($conn,"SELECT `van_id`,`no_plate_no`,`vehicle_type`,`driver_id` FROM `van_info` WHERE `owner_id` ='".$_SESSION['id']."' ");
    $res_amb = mysqli_num_rows($amb);

    $driv=mysqli_query($conn,"SELECT `email`,`mobile`,`flag` FROM `driver_registration` WHERE `owner_id` = '".$id."'");
    $res_driv =mysqli_num_rows($driv);
?>
<!DOCTYPE html>
<html>
<head>
<script src="/assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="/assets/vendor/chart.js/dist/Chart.extension.js"></script>
<script>
 
    window.history.forward();
    function noBack()
    {
      window.history.forward();
    }
  
</script>
<style>
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 10px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  font-size: 14px;
  display: none;
  position: absolute;
  right: 0;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  font-size: 14px;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1;}
.dropdown:hover .dropdown-content {display: block;}
.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>NHAI Admin - Analysis</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body>
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid" >
      
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
     <a class="navbar-brand">
          <img src="logo_black.png"  />
        </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
               
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="NHAI_Profile.php" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="Login.php" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a>
                <img src="logo_black.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
       
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="NHAI_Home.php">
              <i class="ni ni-tv-2 text-red"></i> Dashboard
            </a>
          </li>
     
      <li class="nav-item">
            <a class="nav-link">
              <i class="ni ni-collection text-primary"></i><label name=" " id=" " onclick="ambulancewise()">Ambulancewise Analysis</label>
            </a>
          </li>
          <div class="dropdown">
            <li class="nav-item">
              <a class="nav-link" > 
                <i class="ni ni-collection text-primary"></i><label name=" " id=" " onclick="emergencywise()">Emergencywise Analysis</label>
                <div class="dropdown-content" style="right:0;">
                  <a class="nav-link"><label name=" " id=" " onclick="fire_acc()">1. Fire incidents</label></a>
                  <a class="nav-link"><label name=" " id=" " onclick="road_acc()">2. Road accidents</label></a>
                  <a class="nav-link"><label name=" " id=" " onclick="electrocution()">3. Electrocution</a>
                  <a class="nav-link"><label name=" " id=" " onclick="food_poisoning()">4. Food poisoning</a>
                  <a class="nav-link"><label name=" " id=" " onclick="drowning()">5. Drowning</a>
                  <a class="nav-link"><label name=" " id=" " onclick="heart_diseases()">6. Heart diseases</a>
                  <a class="nav-link"><label name=" " id=" " onclick="self_harm()">7. Self harm/ suicides</a>
                  <a class="nav-link"><label name=" " id=" " onclick="stroke()">8. Stroke (Brain attack)</a>
                  <a class="nav-link"><label name=" " id=" " onclick="falls()">9. Falls</a>
                  <a class="nav-link"><label name=" " id=" " onclick="others()">10. Others</a>
                </div>             
               </a>
            </li>
          </div>

            <li class="nav-item">
              <a class="nav-link">
                <i class="ni ni-collection text-primary"></i><label name=" " id=" " onclick="yearly()">Yearly Analysis</label>
              </a>
            </li>
       
            <li class="nav-item">
              <a class="nav-link">
                <i class="ni ni-collection text-primary"></i><label name=" " id=" " onclick="monthly()">Monthly Analysis</label>
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link">
                <i class="ni ni-collection text-primary"></i><label name=" " id=" " onclick="weekly()">Weekly Analysis</label>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link">
                <i class="ni ni-collection text-primary"></i><label name=" " id=" " onclick="daily()">Daily Analysis</label>
              </a>
            </li>
        </div>
        <!-- Divider -->
        <hr class="my-3">
        
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" >
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="NHAI_Home.php">Dashboard</a>
        
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">
                    <label style='color:red'> NHAI Ambulance Admin - </label>
                    <label ><?php  echo $nm ?></label>
                </span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="NHAI_Profile.php" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              
              <div class="dropdown-divider"></div>
              <a href="Login.php" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-10 pt-md-8">
      <div class="container-fluid" >
        <div class="header-body" >
          <!-- Card stats -->
          <div class="row" >
            <div class="col-xl-3 col-lg-6" style="margin-top: 30px;">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body" >
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Ambulance</h5>
                      <span id= "NA_total_ambulance"class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-ambulance"></i>
                      </div>
                    </div>
                  </div>
                    <p class='mt-3 mb-0 text-muted text-sm'>
                      <span class='text-success mr-2'><b><font size='5px'><?php echo $Ambulance['amb']?></font></b></span>
                    </p>
                  </div>
              </div>
            </div>
            
            <div class="col-xl-3 col-lg-6" style="margin-top: 30px;">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Ambulance Driver</h5>
                      <span id="NA_total_ambulance_driver"class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                    <p class='mt-3 mb-0 text-muted text-sm'>
                      <span class='text-success mr-2'><b><font size='5px'><?php echo $Driver['driver']?></font></b></span>
                    </p>
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </div>
    </div>
     <!-- Page content -->
    
    
<script>


function ambulancewise() {

<?php
$dataPoints = array(
  array("label"=> "MH18 HA88", "y"=> 20),
  array("label"=> "MH18 TC95", "y"=> 13),
  array("label"=> "MH18 RC88", "y"=> 7),
  
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Ambulancewise Emergency Cases - Analysis"
  },
   axisX: {
    title: "Registered Ambulances - Hire Accident Hospital"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}

function emergencywise() {

<?php
$dataPoints = array(
  array("label"=> "Fire accidents", "y"=> 225),
  array("label"=> "Road accidents", "y"=> 570),
  array("label"=> "Electrocution", "y"=> 150),
  array("label"=> "Food poisoning", "y"=> 200),
  array("label"=> "Drowning", "y"=> 266),
  array("label"=> "Heart diseases", "y"=> 550),
  array("label"=> "Self harm/suicides", "y"=> 348),
  array("label"=> "Stroke (Brain attack)", "y"=> 258),
  array("label"=> "Falls", "y"=> 150),
  array("label"=> "Others", "y"=> 325),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Emergencywise Cases - Analysis"
  },
   axisX: {
    title: "Emergency Categories"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}

function fire_acc() {

<?php
$dataPoints = array(
  array("label"=> "2010", "y"=> 825),
  array("label"=> "2011", "y"=> 570),
  array("label"=> "2012", "y"=> 950),
  array("label"=> "2013", "y"=> 500),
  array("label"=> "2014", "y"=> 466),
  array("label"=> "2015", "y"=> 750),
  array("label"=> "2016", "y"=> 348),
  array("label"=> "2017", "y"=> 558),
  array("label"=> "2018", "y"=> 350),
  array("label"=> "2019", "y"=> 425),
  array("label"=> "2020", "y"=> 1225),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Fire Accidents Emergency Cases - Analysis"
  },
   axisX: {
    title: "Year"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}


function road_acc() {

<?php
$dataPoints = array(
  array("label"=> "2010", "y"=> 1005),
  array("label"=> "2011", "y"=> 950),
  array("label"=> "2012", "y"=> 980),
  array("label"=> "2013", "y"=> 800),
  array("label"=> "2014", "y"=> 866),
  array("label"=> "2015", "y"=> 750),
  array("label"=> "2016", "y"=> 848),
  array("label"=> "2017", "y"=> 958),
  array("label"=> "2018", "y"=> 750),
  array("label"=> "2019", "y"=> 895),
  array("label"=> "2020", "y"=> 1050),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Road Accidents Emergency Cases - Analysis"
  },
   axisX: {
    title: "Year"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}

function electrocution() {

<?php
$dataPoints = array(
  array("label"=> "2010", "y"=> 400),
  array("label"=> "2011", "y"=> 750),
  array("label"=> "2012", "y"=> 360),
  array("label"=> "2013", "y"=> 240),
  array("label"=> "2014", "y"=> 486),
  array("label"=> "2015", "y"=> 750),
  array("label"=> "2016", "y"=> 868),
  array("label"=> "2017", "y"=> 988),
  array("label"=> "2018", "y"=> 710),
  array("label"=> "2019", "y"=> 550),
  array("label"=> "2020", "y"=> 700),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Electrocution Emergency Cases - Analysis"
  },
   axisX: {
    title: "Year"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}

function food_poisoning() {

<?php
$dataPoints = array(
  array("label"=> "2010", "y"=> 1500),
  array("label"=> "2011", "y"=> 2100),
  array("label"=> "2012", "y"=> 1000),
  array("label"=> "2013", "y"=> 1600),
  array("label"=> "2014", "y"=> 1806),
  array("label"=> "2015", "y"=> 1250),
  array("label"=> "2016", "y"=> 1222),
  array("label"=> "2017", "y"=> 1888),
  array("label"=> "2018", "y"=> 1478),
  array("label"=> "2019", "y"=> 1368),
  array("label"=> "2020", "y"=> 1977),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Food Poisoning Emergency Cases - Analysis"
  },
   axisX: {
    title: "Year"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}


function drowning() {

<?php
$dataPoints = array(
  array("label"=> "2010", "y"=> 105),
  array("label"=> "2011", "y"=> 354),
  array("label"=> "2012", "y"=> 990),
  array("label"=> "2013", "y"=> 880),
  array("label"=> "2014", "y"=> 356),
  array("label"=> "2015", "y"=> 750),
  array("label"=> "2016", "y"=> 218),
  array("label"=> "2017", "y"=> 428),
  array("label"=> "2018", "y"=> 730),
  array("label"=> "2019", "y"=> 215),
  array("label"=> "2020", "y"=> 500),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Drowning Emergency Cases - Analysis"
  },
   axisX: {
    title: "Year"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}

function heart_diseases() {

<?php
$dataPoints = array(
  array("label"=> "2010", "y"=> 105),
  array("label"=> "2011", "y"=> 250),
  array("label"=> "2012", "y"=> 180),
  array("label"=> "2013", "y"=> 200),
  array("label"=> "2014", "y"=> 166),
  array("label"=> "2015", "y"=> 350),
  array("label"=> "2016", "y"=> 248),
  array("label"=> "2017", "y"=> 358),
  array("label"=> "2018", "y"=> 250),
  array("label"=> "2019", "y"=> 395),
  array("label"=> "2020", "y"=> 550),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Heart Diseases Emergency cases - Analysis"
  },
   axisX: {
    title: "Year"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}

function self_harm() {

<?php
$dataPoints = array(
  array("label"=> "2010", "y"=> 700),
  array("label"=> "2011", "y"=> 950),
  array("label"=> "2012", "y"=> 980),
  array("label"=> "2013", "y"=> 800),
  array("label"=> "2014", "y"=> 866),
  array("label"=> "2015", "y"=> 900),
  array("label"=> "2016", "y"=> 848),
  array("label"=> "2017", "y"=> 958),
  array("label"=> "2018", "y"=> 750),
  array("label"=> "2019", "y"=> 895),
  array("label"=> "2020", "y"=> 500),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Self harm/suicide Emergency cases - Analysis"
  },
   axisX: {
    title: "Year"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}

function stroke() {

<?php
$dataPoints = array(
  array("label"=> "2010", "y"=> 1695),
  array("label"=> "2011", "y"=> 1957),
  array("label"=> "2012", "y"=> 980),
  array("label"=> "2013", "y"=> 1800),
  array("label"=> "2014", "y"=> 866),
  array("label"=> "2015", "y"=> 750),
  array("label"=> "2016", "y"=> 848),
  array("label"=> "2017", "y"=> 1558),
  array("label"=> "2018", "y"=> 750),
  array("label"=> "2019", "y"=> 1585),
  array("label"=> "2020", "y"=> 1550),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Stroke(Brain attack) Emergency cases - Analysis"
  },
   axisX: {
    title: "Year"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}

function falls() {

<?php
$dataPoints = array(
  array("label"=> "2010", "y"=> 100),
  array("label"=> "2011", "y"=> 250),
  array("label"=> "2012", "y"=> 380),
  array("label"=> "2013", "y"=> 400),
  array("label"=> "2014", "y"=> 566),
  array("label"=> "2015", "y"=> 650),
  array("label"=> "2016", "y"=> 748),
  array("label"=> "2017", "y"=> 858),
  array("label"=> "2018", "y"=> 950),
  array("label"=> "2019", "y"=> 195),
  array("label"=> "2020", "y"=> 550),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Falls Emergency cases - Analysis"
  },
   axisX: {
    title: "Year"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}

function others() {

<?php
$dataPoints = array(
  array("label"=> "2010", "y"=> 400),
  array("label"=> "2011", "y"=> 500),
  array("label"=> "2012", "y"=> 750),
  array("label"=> "2013", "y"=> 800),
  array("label"=> "2014", "y"=> 840),
  array("label"=> "2015", "y"=> 750),
  array("label"=> "2016", "y"=> 848),
  array("label"=> "2017", "y"=> 356),
  array("label"=> "2018", "y"=> 750),
  array("label"=> "2019", "y"=> 895),
  array("label"=> "2020", "y"=> 700),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Other Emergency cases - Analysis"
  },
   axisX: {
    title: "Year"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}

function yearly() {

<?php
$dataPoints = array(
  array("label"=> "2012", "y"=> 2849),
  array("label"=> "2013", "y"=> 2565),
  array("label"=> "2014", "y"=> 2452),
  array("label"=> "2015", "y"=> 2334),
  array("label"=> "2016", "y"=> 2002),
  array("label"=> "2017", "y"=> 1944),
  array("label"=> "2018", "y"=> 1803),
  array("label"=> "2019", "y"=> 1720),
  array("label"=> "2020", "y"=> 1127),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Yearly Emergency Cases - Analysis"
  },
   axisX: {
    title: "Year"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}

function monthly() {

<?php
$dataPoints = array(
  array("label"=> "January", "y"=> 2849),
  array("label"=> "February", "y"=> 2565),
  array("label"=> "March", "y"=> 2452),
  array("label"=> "April", "y"=> 2334),
  array("label"=> "May", "y"=> 2002),
  array("label"=> "June", "y"=> 1944),
  array("label"=> "July", "y"=> 1803),
  array("label"=> "August", "y"=> 1720),
  array("label"=> "September", "y"=> 1127),
  array("label"=> "Actober", "y"=> 2804),
  array("label"=> "November", "y"=> 2402),
  array("label"=> "December", "y"=> 1400),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Monthly Emergency Cases - Analysis 2020"
  },
   axisX: {
    title: "Month"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}

function weekly() {

<?php
$dataPoints = array(
  array("label"=> "Monday", "y"=> 2849),
  array("label"=> "Tuesday", "y"=> 2565),
  array("label"=> "Wednesday", "y"=> 2452),
  array("label"=> "Thursday", "y"=> 2334),
  array("label"=> "Friday", "y"=> 2002),
  array("label"=> "Saturday", "y"=> 1944),
  array("label"=> "Sunday", "y"=> 1803),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Weekly Emergency Cases  - Analysis (December 2020)"
  },
   axisX: {
    title: "Days"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}

function daily() {

<?php
$dataPoints = array(
  array("label"=> "Maharashtra", "y"=> 2849),
  array("label"=> "Rajasthan", "y"=> 2565),
  array("label"=> "Gujarat", "y"=> 2452),
  array("label"=> "Punjab", "y"=> 2334),
  array("label"=> "Uttar Pradesh", "y"=> 2002),
  array("label"=> "Andhra Pradesh", "y"=> 1944),
  array("label"=> "Madhya Pradesh", "y"=> 1803),
  array("label"=> "Sikkim", "y"=> 1720),
  array("label"=> "Arunachal Pradesh", "y"=> 1127),
);  
?>

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "Daily Emergency Cases - Analysis"
  },
   axisX: {
    title: "States"
  },
  axisY: {
    title: "No. of handled cases"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}


</script> 
<div class="container mt--8 pb-5">
  <div class="col-lg-12 col-md-8">
    <div class="card-body">
      <div id="chartContainer" style="height: 370px; width: 100%;"></div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


        </div>
      </div>    
    </div>    
  </div>
            </div>
          </div>    
        </div>
      </div>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  </body>
</html>