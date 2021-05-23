<?php
include('../include/config.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | E-Patient Manager</title>
    <script src="../assets/js/lib/jquery.min.js"></script>
<script src="../assets/js/lib/jquery.dataTables.min.js"></script>
<link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/lib/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../assets/js/lib/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/lib/jquery.table2excel.min.js"></script>
<script src="../assets/js/lib/ad4cf1f432.js" crossorigin="anonymous"></script>

<link href="../assets/css/Dashboard.css" rel="stylesheet">

</head>
<body>
<?php
include('../include/header.php');

$totalpatients = "select count(*) as count from patients";
$ret=mysqli_query($con,$totalpatients);
$totalpatientsCount=mysqli_fetch_array($ret);

$totaldiseases = "select count(*) as count from disease";
$ret=mysqli_query($con,$totaldiseases);
$totaldiseasesCount=mysqli_fetch_array($ret);

$totaldoctores = "select count(*) as count from users where RoleId = 2 ";
$ret=mysqli_query($con,$totaldoctores);
$totaldoctoresCount=mysqli_fetch_array($ret);

$totalnurses = "select count(*) as count from users where RoleId = 3 ";
$ret=mysqli_query($con,$totalnurses);
$totalnursesCount=mysqli_fetch_array($ret);

$availabledoctores = "select count(*) as count from users where RoleId = 2 and avaiblity = 1 ";
$ret=mysqli_query($con,$availabledoctores);
$availableDoctorCount=mysqli_fetch_array($ret);
?>
<div class="container">
<div class="main-box">
    <div class="sub-box">
        <h3>Total Patients</h3>
        <div class="count">
            <span><?php echo $totalpatientsCount['count']; ?></span>
        </div>
    </div>

    <div class="sub-box">
        <h3>Total Diseases</h3>
        <div class="count">
            <span><?php echo $totaldiseasesCount['count']; ?></span>
        </div>
    </div>

    <div class="sub-box">
        <h3>Available Doctores</h3>
        <div class="count">
            <span><?php echo $availableDoctorCount['count']; ?></span>
        </div>
        
    </div>


</div>
<div class="main-box">

    <div class="sub-box">
        <h3>Total Doctors</h3>
        <div class="count">
            <span><?php echo $totaldoctoresCount['count']; ?></span>
        </div>
    </div>

    <div class="sub-box">
        <h3>Total Nurses</h3>
        <div class="count">
            <span><?php echo $totalnursesCount['count']; ?></span>
        </div>
    </div>

    
    <div class="sub-box user" title="click and view your profile" >
    <a href="../users/viewuser.php?uid=<?php echo $_SESSION['id']; ?>">
        <h3>View Profile</h3>
        <div class="sub-user-box">
            <span><?php echo $_SESSION['username']; ?></span> 
        </div>
    </a>   
    </div>

</div>

</div>
</body>
</html>