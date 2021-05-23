<?php
session_start();
error_reporting(0);
include("../include/config.php");
if(isset($_POST['submit']))
{ 
    $username = $_POST['username'];
    $query = "select * "
			."from users "
			."where email = '".$username."' "
			." and Password = '".md5($_POST['password'])."'";

	$ret=mysqli_query($con,$query);
    $row=mysqli_fetch_array($ret);

if($row>0)
{
	echo 'login into system';
 $extra="../Dashboard/";
 $_SESSION['login']=$_POST['username'];
 $_SESSION['username']= $row['Prefix'].' '.$row['firstname'].' '.$row['lastname'];
 $_SESSION['id']=$row['User_Id'];
 $_SESSION['viewusers']=$row['viewusers'];
 $_SESSION['editusers']=$row['editusers'];
 $_SESSION['editdiseases']=$row['editdiseases'];
 $_SESSION['editroles']=$row['editroles'];
 $_SESSION['editconditions']=$row['editconditions'];
 $_SESSION['editusers']=$row['editusers'];
 $_SESSION['admin']=$row['admin'];
 $host=$_SERVER['HTTP_HOST'];
 $uip=$_SERVER['REMOTE_ADDR'];
 $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
 $status=1;
// For stroing log if user login successfull
 $log=mysqli_query($con,"insert into userlog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['login']."','$uip','$status')");
 mysqli_query($con,"update users set avaiblity = 1 where User_Id = '".$_SESSION['id']."'");
 //  $_SESSION['logid'] = mysql_insert_id($con);
 header("location:http://$host$uri/$extra");
// echo "location:http://$host$uri/$extra";
 exit();
}
else
{
	// For storing log if user login unsuccessfull
 //$_SESSION['login']=$_POST['username'];	
 $uip=$_SERVER['REMOTE_ADDR'];
 $status=0;
 mysqli_query($con,"insert into userlog(username,userip,status) values('".$_POST['username']."','$uip','$status')");
 $_SESSION['errmsg']="Invalid username or password";
 $extra="";
 $host  = $_SERVER['HTTP_HOST'];
 $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
 header("location:http://$host$uri/$extra");
 exit();
}
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User-Login</title>
		<link rel="icon" href="" type="image/x-icon">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="test" name="description" />
		<meta content="Akash Raval" name="author" />
		<!-- <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" /> -->
		<link rel="stylesheet" href="../assets/css/lib/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/login.css">
		<link rel="stylesheet" href="../assets/css/lib/style.css">
		<style>
		body{
		    border-color: transparent;
    background: -moz-linear-gradient(180deg, rgba(50,200,250,1) 0%, rgba(88,125,228,1) 100%); /* ff3.6+ */
    background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(50,200,250,1)), color-stop(100%, rgba(88,125,228,1))); /* safari4+,chrome */
    background: -webkit-linear-gradient(180deg, rgba(50,200,250,1) 0%, rgba(88,125,228,1) 100%); /* safari5.1+,chrome10+ */
    background: -o-linear-gradient(180deg, rgba(50,200,250,1) 0%, rgba(88,125,228,1) 100%); /* opera 11.10+ */
    background: -ms-linear-gradient(180deg, rgba(50,200,250,1) 0%, rgba(88,125,228,1) 100%); /* ie10+ */
    background: linear-gradient(270deg, rgba(50,200,250,1) 0%, rgba(88,125,228,1) 100%); /* w3c */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#18a3eb', endColorstr='#587de4',GradientType=1 ); /* ie6-9 */
    color: #fff;
 
		}
		</style>
	</head>
	<body class="login">
		<center>
		<div class="app-login">
					<h2>E-PATIENT MANAGER</h2>
				</div>
		</center>
		<div class="row">
				
				<div class="box-login">
					<form class="form-login" method="post">
						<fieldset>
							<legend>
							<img src="../assets/img/heart-beat.png" alt="img" srcset=""> Sign in to your account
								</legend>
							<p>
								Please enter your name and password to log in.<br />
								<span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>
								<span style="color:green;"><?php echo $_SESSION['succmsg']; ?><?php echo $_SESSION['succmsg']="";?></span>
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="username" placeholder="Username">
									<span id="username-error" class="help-block valid"></span>
									<i class="fa fa-user"></i> </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" placeholder="Password">
									<span id="password-error" class="help-block">Please enter at least 6 characters.</span>
									<i class="fa fa-lock"></i>
									 </span>
							</div>
							<div class="form-actions">
								
								<button type="submit" class="btn btn-primary pull-right" name="submit" value="Login">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>

					<div class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> HMS</span>. <span>All rights reserved</span>
					</div>
			
				</div>

			</div>
		</div>
		<script src="../assets/js/lib/jquery.min.js"></script>
		<script src="../assets/js/lib/bootstrap.min.js"></script>
		<script src="../assets/js/lib/jquery.cookie.js"></script>	
		<script src="../assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				
			});
		</script>
	
	</body>
	<!-- end: BODY -->
</html>