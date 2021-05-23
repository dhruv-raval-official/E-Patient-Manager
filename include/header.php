<?php
session_start();
// error_reporting(0);
?>
<link rel="stylesheet" href="../assets/css/header.css"> 
<?php
include('../include/checklogin.php');
check_login();
include('../include/title-config.php');


?>
<div class="navbar">
	<!-- <div class="logo-box">
		<span >EPM</span>
	</div> -->
  <a href="../Dashboard">Dashboard</a>
  <div class="subnav">
    <button class="subnavbtn">Patient <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
	<a href="../patient/">Add Patient</a>  
	<a href="../patient/patientlist.php">View Patient List</a>
      <a href="#team">Export Patients Details</a>
    </div>
  </div> 
  <div class="subnav">
    <button class="subnavbtn">Diseases <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
    <?php $rets=mysqli_query($con,"select * from disease");
        while($rolesrow=mysqli_fetch_array($rets))
        {
    ?>
      <a href="../patient/patientlist.php?id=<?php echo htmlentities($rolesrow['disease_Id']); ?>"><?php echo htmlentities($rolesrow['disease_name']);?></a>
    <?php } ?>
    </div>
  </div> 
 <?php if($_SESSION['viewusers'] == 1 || $_SESSION['admin'] == 1)
	{?>
  <div class="subnav" <?php echo $_SESSION['admin'] ?>>
    <button class="subnavbtn">Users <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
    <?php $rets=mysqli_query($con,"select * from roles");
        while($rolesrow=mysqli_fetch_array($rets))
        {
    ?>
      <a href="../users/userlist.php?id=<?php echo htmlentities($rolesrow['RoleId']); ?>"><?php echo htmlentities($rolesrow['Role_Name']);?></a>
    <?php } ?>
    </div>
  </div>
  <?php }?>
  <?php if($_SESSION['admin'] == 1)
	{?>
  <div class="subnav">
    <button class="subnavbtn">Admin <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="../Diseases">Manage Diseases</a>
	    <a href="../roles">Manage Roles</a>
      <a href="../Conditions">Manage Conditions</a>
	    <a href="../users">Add User</a>
      <a href="../users/userlist.php">View Users List</a>
    </div>
  </div> 
  <?php }?>
  <?php if($_SESSION['editusers'] == 1 || $_SESSION['editdiseases'] == 1 || $_SESSION['editconditions'] == 1 || $_SESSION['editroles'] == 1)
	{?>
  <div class="subnav">
    <button class="subnavbtn">Manage <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <?php if($_SESSION['editdiseases'] == 1 ) {?>
      <a href="../Diseases">Manage Diseases</a>
      <?php } ?>
      <?php if($_SESSION['editroles'] == 1 ) {?>
	    <a href="../roles">Manage Roles</a>
      <?php } ?>
      <?php if($_SESSION['editconditions'] == 1 ) {?>
      <a href="../Conditions">Manage Conditions</a>
      <?php } ?>
      <?php if($_SESSION['editusers'] == 1 ) {?>
	    <a href="../users">Add User</a>
      <a href="../users/userlist.php">View Users List</a>
      <?php } ?>
    </div>
  </div> 
  <?php }?>
  
  <a href="#contact">Contact</a>
</div>