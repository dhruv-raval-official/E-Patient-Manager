<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Roles</title>
    
<script src="../assets/js/lib/jquery.min.js"></script>
<script src="../assets/js/lib/jquery.dataTables.min.js"></script>
<link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/lib/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../assets/js/lib/dataTables.bootstrap4.min.js"></script>

<script src="../assets/js/lib/ad4cf1f432.js" crossorigin="anonymous"></script>
<script src="../assets/js/role.js"></script>
<link rel="stylesheet" href="../assets/css/role.css"> 
</head>
<body>
<?php
include('../include/config.php');
include('../include/header.php'); 
include('../include/checkviewuserpermission.php');
check_edit_roles_permission();

$successmessage="";
$errormessage="";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    if(isset($_POST['addrole'])){
        $name=$_POST['name'];

        $sql = "insert into roles(Role_Name) values ('$name')";
        
        if ($con->query($sql) === TRUE) {
            $successmessage = 'Role '.$name.' Added successfully';
            echo "<script> showsuccessbanner(); </script>";
          } else {
            $errormessage = "Error: ". $con->error. "Please Contact Admin / Developer Team";
            echo "<script> showerrorbanner()</script>";
          }
    }
    if(isset($_POST['update'])){
        $id = $_POST['tempid']; 
        $name = $_POST['name'];

        $sql = "update roles set Role_Name = '$name' where RoleId = '$id'";
        
        if ($con->query($sql) === TRUE) {
            $successmessage = 'Role '.$name.' updated successfully';
            echo "<script> $('.success-banner').show(); </script>";
          } else {
            $errormessage = "Error: ". $con->error. "Please Contact Admin / Developer Team";
            echo "<script> $('.error-banner').show(); </script>";
          }
    }
}


$query = "select r.RoleId as RoleId,"
        ."IFNULL(r.Role_Name,'No Data') as RoleName "
        ."from roles r";


$ret=mysqli_query($con,$query);
?>

<div class="success-banner costom-notification">
    <span id="successmsg"><?php echo $successmessage; ?></span>
    <div class="close-btn" >
    <i class="fas fa-times btn-custom" onclick="closesuccessbanner();"></i>
    </div>
</div>     
<div class="error-banner costom-notification">
    <span id="errormsg"><?php echo $errormessage; ?></span>
    <div class="close-btn" onclick="closeerrorbanner();">
    <i class="fas fa-times btn-custom"></i>
    </div>
</div>

<div class="custom-container">
    
        <div class="update-model">
            <form action="" method="post">
                <div class="form-row">
                    <lable class="form-lable">Role Id</lable>
                    <input type="hidden" name="tempid" id="tempupdateid" >
                    <input type="text" class="form-control" name="id" id="updateid" disabled>
                </div>
                <div class="form-row">
                    <lable class="form-lable">Role Name</lable>
                    <input type="text" class="form-control" name="name" id="updatename">
                </div>
                <div class="form-row">
                    <input type="submit" name="update" class="btn btn-primary submit" id="update" Value="Update Role">
                </div>
                
            </form>
            <div class="close-btn" onclick="closeupdatemodel();">
                <i class="fas fa-times btn-custom"></i>
            </div>
        </div>
        <div class="add-model">
            <form action="" method="post">
                <div class="form-row">
                    <lable class="form-lable">Role Name</lable>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-row">
                    <input type="submit" name="addrole" class="btn btn-primary submit" Value="Add Role">
                </div>   
            </form>
            <div class="close-btn" onclick="closeaddmodel();">
                <i class="fas fa-times btn-custom"></i>
            </div>
        </div>
        <div>
            <button class="btn btn-primary add-btn" onclick="openaddmodel();">Add New Role</button>
        </div>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row=mysqli_fetch_array($ret))
                { 
                    $funcall = 'updatevalue('.$row['RoleId'].',"'.$row['RoleName'].'");';
                 $view= "<tr>"
                        ."<td>"
                        .$row['RoleId']
                        ."</td>"
                        .'<td>'
                        .$row['RoleName']
                        ."</td>"
                        ."<td class='action'>"
                        ."<button class='action-btn' onclick='".$funcall."' >Edit</button> "
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