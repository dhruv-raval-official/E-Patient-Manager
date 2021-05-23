<?php
session_start();
include('../include/config.php');

$_SESSION['login']="";

date_default_timezone_set('Asia/Kolkata');
$ldate=date( 'd-m-Y h:i:s A', time () );

// $log=mysqli_query($con,"update userlog set logouttime = CURRENT_TIMESTAMP where userlogid = '".$_SESSION['logid']."'");
mysqli_query($con,"update users set avaiblity = 0 where User_Id = '".$_SESSION['id']."'");
session_unset();
//session_destroy();
$_SESSION['succmsg']="User have successfully logout";
?>
<center>
<br/>
<img src="../assets/img/ajax-loader.gif" alt="Loading...">
<h1>Logging You Out.....</h1>
<br/>
</center>
<script language="javascript">
document.location="index.php";
</script>
