<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Conditions</title>
    
<script src="../assets/js/lib/jquery.min.js"></script>
<script src="../assets/js/lib/jquery.dataTables.min.js"></script>
<link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/lib/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../assets/js/lib/dataTables.bootstrap4.min.js"></script>

<script src="../assets/js/lib/ad4cf1f432.js" crossorigin="anonymous"></script>
<script src="../assets/js/condition.js"></script>
<link rel="stylesheet" href="../assets/css/condition.css"> 
</head>
<body>
<?php
include('../include/config.php');
include('../include/header.php');
include('../include/checkviewuserpermission.php');
check_edit_conditions_permission(); 

$successmessage="";
$errormessage="";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    if(isset($_POST['addcondition'])){
        $name=$_POST['name'];
        $description=$_POST['description'];

        $sql = "insert into patientstype(PatientsType, patients_type_Description) values ('$name','$description')";
        
        if ($con->query($sql) === TRUE) {
            $successmessage = 'Condition <b>'.$name.'</b> Added successfully';
            echo "<script> showsuccessbanner(); </script>";
          } else {
            $errormessage = "Error: ". $con->error. "Please Contact Admin / Developer Team";
            echo "<script> showerrorbanner()</script>";
          }
    }
    if(isset($_POST['update'])){
        $id = $_POST['tempid']; 
        $name = $_POST['name'];
        $description = $_POST['description'];

        $sql = "update patientstype set PatientsType = '$name', patients_type_Description = '$description' where PatientsTypeId = '$id'";
        
        if ($con->query($sql) === TRUE) {
            $successmessage = 'Condition <b>'.$name.'</b> updated successfully';
            echo "<script> $('.success-banner').show(); </script>";
          } else {
            $errormessage = "Error: ". $con->error. "Please Contact Admin / Developer Team";
            echo "<script> $('.error-banner').show(); </script>";
          }
    }
}


$query = "select c.PatientsTypeId as ConditionId,"
        ."IFNULL(c.PatientsType,'No Data') as ConditionName,"
        ."IFNULL(c.patients_type_Description,'No Data') as ConditionDescription "
        ."from patientstype c ";

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
                    <lable class="form-lable">Condition Id</lable>
                    <input type="hidden" name="tempid" id="tempupdateid" >
                    <input type="text" class="form-control" name="id" id="updateid" disabled>
                </div>
                <div class="form-row">
                    <lable class="form-lable">Condition Name</lable>
                    <input type="text" class="form-control" name="name" id="updatename">
                </div>
                <div class="form-row">
                    <lable class="form-lable">Condition Description</lable>
                    <textarea name="description" class="form-control" rows="2" id="updatedesc"></textarea>
                </div>
                <div class="form-row">
                    <input type="submit" name="update" class="btn btn-primary submit" id="update" Value="Update Condition">
                </div>
                
            </form>
            <div class="close-btn" onclick="closeupdatemodel();">
                <i class="fas fa-times btn-custom"></i>
            </div>
        </div>
        <div class="add-model">
            <form action="" method="post">
                <div class="form-row">
                    <lable class="form-lable">Condition Name</lable>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-row">
                    <lable class="form-lable">Condition Description</lable>
                    <textarea name="description" class="form-control" rows="2"></textarea>
                </div>
                <div class="form-row">
                    <input type="submit" name="addcondition" class="btn btn-primary submit" Value="Add Condition">
                </div>   
            </form>
            <div class="close-btn" onclick="closeaddmodel();">
                <i class="fas fa-times btn-custom" alt="Close" ></i>
            </div>
        </div>
        <div>
            <button class="btn btn-primary add-btn" onclick="openaddmodel();">Add New Condition</button>
        </div>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Condition Name</th>
                <th>Condition Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        while($row=mysqli_fetch_array($ret))
                { 
                    $funcall = 'updatevalue('.$row['ConditionId'].',"'.$row['ConditionName'].'","'.$row['ConditionDescription'].'");';
                 $view= "<tr>"
                        ."<td>"
                        .$row['ConditionId']
                        ."</td>"
                        .'<td>'
                        .$row['ConditionName']
                        ."</td>"
                        ."<td>"
                        .$row['ConditionDescription']
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