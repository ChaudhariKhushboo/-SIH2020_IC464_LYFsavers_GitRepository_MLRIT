
<?php
  
include('connection.php');
session_start();

$id = $_SESSION['id'];
$ps_nm = $_SESSION['ps_nm'];
$nm=$_SESSION['name'];

$today_date = date('Y-m-d');
$Cases = mysqli_fetch_array(mysqli_query($conn, "SELECT count(*) as cases FROM `logs` WHERE `ps_id`='".$id."'"));

$sql =mysqli_query($conn,"SELECT * FROM `logs` WHERE `req_send_date` = '".$today_date."' AND `ps_id` = '".$id."' AND `ps_flag` = '0'"); 
$result = mysqli_num_rows($sql);

if(isset($_POST['acknowledge']))
  {

        $case_no = $_POST['acknowledge'];
        $date_time = date('Y-m-d H:i:s');

        $sql = mysqli_query($conn, "UPDATE `logs` SET `ps_ack_datetime` = '".$date_time."',`ps_flag`= '1' WHERE `case_id` ='".$case_no."' ");
        if($sql)
        {
          echo"<script type='text/javascript'> 
                alert('Updated..!!');
            </script>";
           header("Location:PS_Home.php");
        }
        else
        {
          echo"<script type='text/javascript'> 
                alert('Sorry error while updation....!!');
            </script>";
            header("Location:PS_Home.php");
        }
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <meta http-equiv="refresh" content="5">
  <title>Police Admin - Dashboard</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">

  <script type="text/javascript">
       function sound()
      {
          var audio = new Audio("wind-message.mp3");
          audio.play();
      }

  </script>
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
     <a class="navbar-brand pt-0">
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
            <a href="PS_Profile.php" class="dropdown-item">
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
        <!-- Form -->
        
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="PS_Home.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
			    <li class="nav-item">
            <a class="nav-link" href="PS_Inbox.php">
              <i class="ni ni-single-02 text-red"></i>Inbox
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="PS_Analysis.php">
              <i class="ni ni-chart-bar-32 text-green"></i>Analysis
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="PS_Profile.php">
              <i class="ni ni-single-02 text-yellow"></i> User profile
            </a>
          </li>
       
        <!-- Divider -->
        <hr class="my-3">
        
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Dashboard</a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            
          </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <div class="media align-items-center">
               
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">
                    <font color="red">Police Station Admin - </font>
                    <label><?php echo $ps_nm ?></label><br>
                    <label style="margin-left: 155px;"><?php echo $nm ?></label>
                  </span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="PS_Profile.php" class="dropdown-item">
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
                      <span id= "PA_total_cases"class="h2 font-weight-bold mb-0"></span>
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

                 <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">NOTE : </h5>
                      <span id="SA_total_hospital_admins"class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="ni ni-bell-55"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    Click the below <b>Acknowledgement</b> button at time you get notified
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
      <div class="col-lg-12 col-md-7" style="width: 570px;">
        
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
              <div class="row">
              <h3 class="text-white mb-0" style="margin-left: 30px;">TODAY'S REQUEST </h3>
              <h3 class="text-white mb-0" style="margin-left: 750px;">DATE - <?php echo $today_date; 
 ?> </h3>
              </div>
            </div>
            <div class="table-responsive">
              <!--<form method="post" action="HA_Home.php">-->
             <table width="900px"  border="1">

              <table class="table align-items-center table-dark table-flush" name="new_request_table">
                <thead class="thead-dark">
                  <tr>
                    
                    <th scope="col">Serial No.</th>
                    <th scope="col">Case ID</th>
                    <th scope="col">Accident Location</th>
                    <th scope="col">Accidental Persons</th>
                    <th scope="col">Driver Name</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Ambulance No.</th>
                    <th scope="col">Hospital Name</th>
                    <th scope="col">Hospital Contact No.</th>
                    <th scope="col">Acknowledgement</th>
                    
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
                              <td>'.$row["case_id"].'</td>
                              <td>'.$row["accident_location"].'</td>
                              <td>'.$row["no_of_patient"].'</td>
                              <td>'.$row["amb_driver_name"].'</td>
                              <td>'.$row["amb_driver_mobile"].'</td>
                              <td>'.$row["amb_no_plate"].'</td>
                              <td>'.$row["hospital_name"].'</td>
                              <td>'.$row["hospital_mob"].'</td>
                              <td>'.'<form name="myform" method="POST" action = "PS_Home.php">
                                  <button class="btn btn-danger my-3" onclick="Admitted()" type="submit" id="acknowledge" name="acknowledge" value='.$row["case_id"].'> Acknowledgement
                                  </button></form>'.'</td> </tr>';
                              
                              $i=$i+1;
                            }
                             echo "<script>sound();</script>";
                      }
                      else
                      {
                        echo '
                            <td rowspan = 8>No New Request </td>
                        ';
                      }
                           
                      ?>
                </tbody>
              </table>
              </form>
            </div>
          </div>
        </div>
      </div>

      
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>