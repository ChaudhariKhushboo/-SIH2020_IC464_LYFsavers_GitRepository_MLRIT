<?php
include('connection.php');
session_start();  

$accident_location = $_SESSION['accident_location'];
$id = $_SESSION['driver_id'];
$Cases = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) AS cases From `logs` WHERE `amb_driver_id` = '".$id."'"));

$sql =mysqli_query($conn,"SELECT * FROM `logs` WHERE `amb_driver_id` = '".$id."'"); 
$result = mysqli_num_rows($sql);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Driver - Logs</title>
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
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="../index.html">
        <img src="logo_black.png" class="navbar-brand-img" alt="...">
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
            <a href="Driver_Home.php" class="dropdown-item">
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
              <a href="Driver_Home.php">
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

       <ul class="navbar-nav">
    
      <li class="nav-item">
            <a class="nav-link" href="Driver_Home.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          
           <li class="nav-item">
            <a class="nav-link" href="Driver_Analysis.php">
              <i class="ni ni-chart-bar-32 text-green"></i>Analysis
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Driver_logs.php">
              <i class="ni ni-collection text-green"></i>Logs
            </a>
          </li>
      
         
          <li class="nav-item">
            <a class="nav-link" href="Driver_Profile.php">
              <i class="ni ni-single-02 text-yellow"></i> User profile
            </a>
          </li>
          
         
        </ul>
        
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="Driver_logs.php">LOGS</a>
        
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <div class="media-body ml-2 d-none d-lg-block"><span class="mb-0 text-sm  font-weight-bold">
                    <font color="red">Ambulance Driver - </font>
                    <label><?php echo $_SESSION['driver_name'] ?></label><br>
                  </span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="Driver_Profile.php" class="dropdown-item">
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
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
               <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Cases</h5>
                      <span id= "NA_total_ambulance"class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-ambulance"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap text-warning"><b><font size="5px"><?php echo $Cases['cases'] ?></font></b></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
      <div class="container mt--8 pb-5" style="max-width: 1600px;">
        <div class="row justify-content-center">
        <div class="col-lg-12 col-md-7" style="width: 600px;">
          
            <div class="card-body px-lg-5 py-lg-5"> 
                <h3 style="text-align: center;margin-top: auto 0; color: white;">Case Log</h3>   
                <div class="table-responsive">
                   <table width="900px"  border="1">
                   <table class="table align-items-center table-dark table-flush" name="new_request_table">
                      <thead class="thead-dark">
                        <tr>
                    
                        <th scope="col">Sr. No.</th>
                        <th scope="col">Hospital Name</th>
                        <th scope="col">No. of Patient</th>
                        <th scope="col">Accident Location</th>
                        <th scope="col">Request Send<br>Date - Time</th>
                        <th scope="col">Patient Admitted<br>Date - Time</th>
                        </tr>
                      </thead>
                        <tbody>
                  
                      <?php 
                      if($result > 0)
                      {
                          $i=1;
                            while($row = mysqli_fetch_array($sql))
                           {
                             echo '
                              <tr>
                              <td>'.$i.'</td>
                              <td>'.$row["hospital_name"].'</td>
                              <td>'.$row["no_of_patient"].'</td>
                              <td>'.$accident_location.'</td>
                              <td>'.$row["req_send_date"].'<br>'.$row["req_send_time"].'</td>
                              <td>'.$row["req_accept_date"].'<br>'.$row["req_accept_time"].'</td>
                             </tr>';
                              $i=$i+1;
                            }
                      }
                      else
                      {
                        echo "
                            <td rowspan = 8 style='color:red;'>No Patient get admitted by you </td>
                        ";
                      }
                           
                      ?>
                </tbody>
                   </table>
                 </table>
                </div>    
            </div>

        </div>

  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBd3PjUqq81lIOfBPYXrQGWwK5T4ystZjA"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>