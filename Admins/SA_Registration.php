<?php
include('connection.php');
session_start();
if(isset($_POST['register']))
{
	$name= $_POST['SA_reg_name'];
	$email=$_SESSION['SA_veri_email'];
	$mob=$_SESSION['SA_veri_Mob'];
	$aadhar= $_POST['SA_reg_aadhar'];
	$street=$_POST['SA_reg_street'];
	$village=$_POST['SA_reg_village'];
	$tal=$_POST['SA_reg_tal'];
	$dist=$_POST['SA_reg_dist'];
	$state=$_POST['SA_reg_state'];
	
	$username=$email;
	$str_result='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$password=substr(str_shuffle($str_result),0,8);
	
	$sql = "INSERT INTO `super_admin` (`name`, `username`, `password`, `email`, `mobile`, `aadhar_no`, `street`, `village`, `taluka`, `district`, `state`) VALUES ('$name', '$username', '$password', '$email', '$mob', '$aadhar', '$street', '$village', '$tal', '$dist', '$state')";
	
	$result = mysqli_query($conn,$sql);
	//$result=mysqli_query($conn,"INSERT INTO super_admin(name,username,password,email,mobile,aadhar_no,street, village, taluka, district, state)VALUES('$name', '$username', '$password','$email','$mob', '$aadhar','$street','$village', '$tal', '$dist', '$state')");
	if($result)
	{
			
			$sql = "UPDATE `super_admin` set `super_id` = concat(`prefix`,`id`)";
			$res = mysqli_query($conn,$sql);
			if($res)
			{
				$sql = "UPDATE `admin_registration` SET `flag` = 1 WHERE email='".$email."' AND mobile='".$mob."'";
				$resf = mysqli_query($conn, $sql);
				if($resf)
				{
					/*
						sending mail of username and password;
					*/
					echo"<script type='text/javascript'> 
							alert('record inserted...!!');
						</script>";
					header("Location:SA_Login.php");
				}
					
			}		
	}
	else
	{
		echo $conn->error;
		echo"<script type='text/javascript'> 
					alert('record not inserted...!!');
			</script>";
	}
		
	
	$conn->close();
}

?>
<!DOCTYPE html>
<html>

<head>
<script>
	
		window.history.forward();
		function noBack()
		{
			window.history.forward();
		}
		function goForward()
		{
			window.history.forward();
		}
	function SA_registration()
	{
		var mailformat= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		var name_with_space= /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
		var name_widout_space= /^[a-zA-Z-]+$/;
		var no=/^[0-9]+$/;
		var aadhar_no = /^\d{12}$/;
		var mobile_no = /^\d{10}$/; 
		
		
		
		var name=document.getElementById("SA_reg_name").value;
		var aadharno=document.getElementById("SA_reg_aadharno").value;
		var street=document.getElementById("SA_reg_street").value;
		var village=document.getElementById("SA_reg_village").value;
		var tal=document.getElementById("SA_reg_tal").value;
		var dist=document.getElementById("SA_reg_dist").value;
		var state=document.getElementById("SA_reg_state").value;
		var mob=document.getElementById("SA_reg_mobileno").value;
		var emailid=document.getElementById("SA_reg_emailid").value;

		
	
			if(!name.match(name_with_space))
			{
				 
				alert("Plz Enter valid name ");
				return false;
			}
			 else if(!emailid.match(mailformat))
			{
				 
				alert("Plz Enter valid emailid  ");
				return false;
			}
			 else if(!mobileno.match(mobile_no))
			{
				 
				alert("Plz Enter valid mobileno ");
				return false;
			}
			
			else if(!(aadhar.match(no)) || (aadhar.length!=12))
			{
				alert("Plz Enter valid Aadhar no ");
				return false;
			}
			else if(!street.match(name_with_space))
			{
				 
				alert("Plz Enter valid street  ");
				return false;
			}
			
			else if(!village.match(name_widout_space))
			{
				 
				alert("Plz Enter valid village  ");
				return false;
			}
			else if(!tal.match(name_widout_space))
			{
				 
				alert("Plz Enter valid Taluka name ");
				return false;
			}
			else if(!dist.match(name_widout_space))
			{
				 
				alert("Plz Enter valid District name ");
				return false;
			}
			else if(!state.match(name_widout_space))
			{
				 
				alert("Plz Enter valid State name ");
				return false;
			}
          
          return true;
	}
	function discard()
	{
		
		location.reload();
		return true;
	}
	

</script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Super Admin- Register</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
 <!--  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> -->
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body style="background-color:powderblue;" class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand pt-0">
        <img src="logo_white.png" class="navbar-brand-img" alt="...">
      </a>
        
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="../index.html">
                  <img src="../assets/img/brand/blue.png">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
          
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8" >
      <div class="container" style="margin-top:0px;" >
        <div class="header-body text-center mb-6">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6" >
              <!-- <h1 class="text-white">Welcome!</h1> -->
              <p class="text-lead text-light">Create New Account </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <p class = style= line-height:3.8;></p>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-7">
          <div class="card bg-secondary shadow border-0">

            <div class="card-body px-lg-5 py-lg-5">

              <form role="form" action="SA_Registration.php" method="POST">

                   <div class="row">
  
                    <div class="col-lg-6">
                      <div class="form-group">
							<label class="form-control-label" for="input-username"> Enter your Name:</label>
                            <input id="SA_reg_name" name="SA_reg_name" class="form-control" placeholder="Name" type="text">
                      </div>
                    </div>

                   

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Aadhar No:</label>
                        <input id="SA_reg_aadhar" name="SA_reg_aadhar"class="form-control" placeholder="Aadhar card Number" type="text">
                      </div>
                    </div>
					
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Street:</label>
                           <input id="SA_reg_street" name="SA_reg_street" class="form-control" placeholder="Street" type="text">

                      </div>
                    </div>
					
					 <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Village:</label>
                           <input id="SA_reg_village" name="SA_reg_village"class="form-control" placeholder="Village" type="text">

                      </div>
                    </div>
					
					 <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Taluka:</label>
                           <input id="SA_reg_tal" name="SA_reg_tal"class="form-control" placeholder="Street" type="text">

                      </div>
                    </div>
					
					 <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> District:</label>
                           <input id="SA_reg_dist" name="SA_reg_dist"class="form-control" placeholder="Street" type="text">

                      </div>
                    </div>
					
					<div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> State:</label>
                           <input id="SA_reg_state" name="SA_reg_state"class="form-control" placeholder="State" type="text">

                      </div>
                    </div>
					</div>
					
                <div class="text-center">
                 <button id="SA_register" type="submit"  name= "register" required="true" class="btn btn-success my-4" onclick="SA_registration()">Register</button>
                  <button id="discard" name = "discard"type="submit" required="true" class="btn btn-danger my-4" onclick="discard()">Discard</button>
                </div>
				
              </form>
            </div>
          </div>
          
		  <div class="row mt-3">
            <div class="col-6">
              <a href="SA_login.php" class="text-light"><small>Already have an account, go to Log in!</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </body>

</html>