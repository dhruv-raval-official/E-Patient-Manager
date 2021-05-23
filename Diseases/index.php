<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Diseases</title>
    
<script src="../assets/js/lib/jquery.min.js"></script>
<script src="../assets/js/lib/jquery.dataTables.min.js"></script>
<link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/lib/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../assets/js/lib/dataTables.bootstrap4.min.js"></script>

<script src="../assets/js/lib/ad4cf1f432.js" crossorigin="anonymous"></script>
<script src="../assets/js/Diseases.js"></script>
<link rel="stylesheet" href="../assets/css/Diseases.css"> 
</head>
<body>
<?php
include('../include/config.php');
include('../include/header.php'); 
include('../include/checkviewuserpermission.php');
check_edit_diseases_permission();
$successmessage="";
$errormessage="";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    if(isset($_POST['adddisease'])){
        $name=$_POST['name'];
        $description=$_POST['description'];

        $sql = "insert into disease(disease_name, disease_description) values ('$name','$description')";
        
        if ($con->query($sql) === TRUE) {
            $successmessage = 'Disease '.$name.' Added successfully';
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

        $sql = "update disease set disease_name = '$name', disease_description = '$description' where disease_Id = '$id'";
        
        if ($con->query($sql) === TRUE) {
            $successmessage = 'Disease '.$name.' updated successfully';
            echo "<script> $('.success-banner').show(); </script>";
          } else {
            $errormessage = "Error: ". $con->error. "Please Contact Admin / Developer Team";
            echo "<script> $('.error-banner').show(); </script>";
          }
    }
}


$query = "select d.disease_Id as DiseaseId,"
        ."IFNULL(d.disease_name,'No Data') as DiseaseName,"
        ."IFNULL(d.disease_description,'No Data') as DiseaseDescription "
        ."from disease d ";

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
                    <lable class="form-lable">Disease Id</lable>
                    <input type="hidden" name="tempid" id="tempupdateid" >
                    <input type="text" class="form-control" name="id" id="updateid" disabled>
                </div>
                <div class="form-row">
                    <lable class="form-lable">Disease Name</lable>
                    <input type="text" class="form-control" name="name" id="updatename">
                </div>
                <div class="form-row">
                    <lable class="form-lable">Disease Description</lable>
                    <textarea name="description" class="form-control" rows="2" id="updatedesc"></textarea>
                </div>
                <div class="form-row">
                    <input type="submit" name="update" class="btn btn-primary submit" id="update" Value="Update Disease">
                </div>
                
            </form>
            <div class="close-btn" onclick="closeupdatemodel();">
                <i class="fas fa-times btn-custom"></i>
            </div>
        </div>
        <div class="add-model">
            <form action="" method="post">
                <div class="form-row">
                    <lable class="form-lable">Disease Name</lable>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-row">
                    <lable class="form-lable">Disease Description</lable>
                    <textarea name="description" class="form-control" rows="2"></textarea>
                </div>
                <div class="form-row">
                    <input type="submit" name="adddisease" class="btn btn-primary submit" Value="Add Disease">
                </div>   
            </form>
            <div class="close-btn" onclick="closeaddmodel();">
                <i class="fas fa-times btn-custom"></i>
            </div>
        </div>
        <div>
            <button class="btn btn-primary add-btn" onclick="openaddmodel();">Add New Disease</button>
        </div>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Diseases</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row=mysqli_fetch_array($ret))
                { 
                    $funcall = 'updatevalue('.$row['DiseaseId'].',"'.$row['DiseaseName'].'","'.$row['DiseaseDescription'].'");';
                 $view= "<tr>"
                        ."<td>"
                        .$row['DiseaseId']
                        ."</td>"
                        .'<td>'
                        .$row['DiseaseName']
                        ."</td>"
                        ."<td>"
                        .$row['DiseaseDescription']
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