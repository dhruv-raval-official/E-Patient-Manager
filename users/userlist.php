<?php
include('../include/config.php');
include('../include/checkviewuserpermission.php');

if(isset($_GET['id'])){
    
$query = "select distinct p.User_Id, "
."p.Firstname, "
."IFNULL(p.Lastname, 'No Data') as Lastname, "
."p.Mobile, "
."IFNULL(p.Email, 'No Data') as Email, "
."p.AadharNumber, p.Address1, "
."IFNULL(p.Address2, 'No Data') as Address2, "
."IFNULL(p.Address3, 'No Data') as Address3, "
."IFNULL(p.City, 'No Data') as City, "
."IFNULL(p.Pincode, 'No Data') as Pincode, "
."IFNULL(p.State, 'No Data') as State, "
."r.Role_Name as rolename, "
."p.StatusId, IFNULL(s.Status, 'No Data') as Status, "
."c.firstname as CreatedByfirstname, "
."c.lastname as CreatedBylastname, "
."u.firstname as UpdatedByfirstname, "
."u.lastname as UpdatedBylastname, "
."p.created_date, "
."p.updated_date "
."from users p "
."LEFT JOIN status s ON s.StatusId = p.StatusId "
."LEFT JOIN roles r ON r.RoleId = p.RoleId "
."LEFT Join users c ON c.User_Id = p.createdby "
."LEFT JOIN users u ON u.User_Id = p.updatedy "
."WHERE p.RoleId = ".$_GET['id'];

}
else{
$query = "select distinct p.User_Id, "
            ."p.Firstname, "
            ."IFNULL(p.Lastname, 'No Data') as Lastname, "
            ."p.Mobile, "
            ."IFNULL(p.Email, 'No Data') as Email, "
            ."p.AadharNumber, p.Address1, "
            ."IFNULL(p.Address2, 'No Data') as Address2, "
            ."IFNULL(p.Address3, 'No Data') as Address3, "
            ."IFNULL(p.City, 'No Data') as City, "
            ."IFNULL(p.Pincode, 'No Data') as Pincode, "
            ."IFNULL(p.State, 'No Data') as State, "
            ."r.Role_Name as rolename, "
            ."p.StatusId, IFNULL(s.Status, 'No Data') as Status, "
            ."c.firstname as CreatedByfirstname, "
            ."c.lastname as CreatedBylastname, "
            ."u.firstname as UpdatedByfirstname, "
            ."u.lastname as UpdatedBylastname, "
            ."p.created_date, "
            ."p.updated_date "
            ."from users p "
            ."LEFT JOIN status s ON s.StatusId = p.StatusId "
            ."LEFT JOIN roles r ON r.RoleId = p.RoleId "
            ."LEFT Join users c ON c.User_Id = p.createdby "
            ."LEFT JOIN users u ON u.User_Id = p.updatedy";
}
$ret=mysqli_query($con,$query);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of users</title>
    
<script src="../assets/js/lib/jquery.min.js"></script>
<script src="../assets/js/lib/jquery.dataTables.min.js"></script>
<link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/lib/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../assets/js/lib/dataTables.bootstrap4.min.js"></script>

<script src="../assets/js/lib/ad4cf1f432.js" crossorigin="anonymous"></script>
<script src="../assets/js/userlist.js"></script>
<link rel="stylesheet" href="../assets/css/userlist.css"> 
</head>
<body>
<?php include('../include/header.php'); 
check_view_user_permission();
    if(isset($_POST['success']))
    {?>
<div class="success-banner costom-notification">
    <span><?php echo $_POST['success']; ?></span>
    <div class="close-btn">
    <i class="fas fa-times btn-custom"></i>
    </div>
</div>
 <?php 
    }
    if(isset($_POST['errormessage']))
    {
 ?>       
<div class="error-banner costom-notification">
    <span><?php echo $_POST['errormessage']; ?></span>
    <div class="close-btn">
    <i class="fas fa-times btn-custom"></i>
    </div>
</div>
<?php } ?>

<div class="custom-container">
<?php if($_SESSION['editusers'] == 1 || $_SESSION['admin'] == 1 )
	{?>
    <div>
        <button class="btn btn-primary add-btn" onclick="openaddmodel();">Add New User</button>
    </div>
<?php } ?>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Mobile No</th>
                <th>Aadhar No</th>
                <th>City</th>
                <th>Pincode</th>
                <th>State</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row=mysqli_fetch_array($ret))
                { 
                 $view= "<tr>"
                        ."<td>"
                        .$row['User_Id']
                        ."</td>"
                        .'<td> <a href="viewuser.php?uid='.$row['User_Id'].'">'
                        .$row['Firstname']." ".$row['Lastname']
                        ."</a></td>"
                        ."<td>"
                        .$row['rolename']
                        ."</td>"
                        ."<td>"
                        .$row['Mobile']
                        ."</td>"
                        ."<td>"
                        .$row['AadharNumber']
                        ."</td>"
                        ."<td>"
                        .$row['City']
                        ."</td>"
                        ."<td>"
                        .$row['Pincode']
                        ."</td>"
                        ."<td>"
                        .$row['State']
                        ."</td>"
                        ."<td class=".$row['Status'].">"
                        .$row['Status']
                        ."</td>"
                        ."</tr>";
                          
                echo $view;
                    
                } 
        ?>
        </tbody>
    </table>
    </div>
</body>
</html>