<?php
include('../include/config.php');
function calcutateAge($dob){

    $dob = date("Y-m-d",strtotime($dob));

    $dobObject = new DateTime($dob);
    $nowObject = new DateTime();

    $diff = $dobObject->diff($nowObject);

    return $diff->y;

}
if(isset($_GET['id'])){
    $query = "select distinct p.PatientId,"
        ."p.Firstname,"
        ."IFNULL(p.Lastname,'No Data') as Lastname,"
        ."p.Birthdate,"
        ."g.Gender as Gender,"
        ."p.Mobile,"
        ."IFNULL(p.Email,'No Data') as Email,"
        ."p.AadharNumber,"
        ."p.Address1,"
        ."IFNULL(p.Address2,'No Data') as Address2,"
        ."IFNULL(p.Address3,'No Data') as Address3,"
        ."IFNULL(p.City,'No Data') as City,"
        ."IFNULL(p.Pincode,'No Data') as Pincode,"
        ."IFNULL(p.State,'No Data') as State,"
        ."p.DiseaseId,"
        ."IFNULL(d.disease_name,'No Data') as disease_name,"
        ."d.disease_description,"
        ."p.DiseaseFrom,"
        ."p.Symptoms,"
        ."p.Notes,"
        ."p.PatientsTypeId,"
        ."IFNULL(pt.PatientsType,'No Data') as conditions,"
        ."pt.patients_type_Description,"
        ."p.StatusId,"
        ."IFNULL(s.Status,'No Data') as Status,"
        ."c.firstname as CreatedByfirstname,"
        ."c.lastname  as CreatedBylastname,"
        ."u.firstname  as UpdatedByfirstname,"
        ."u.lastname as UpdatedBylastname,"
        ."p.CreatedDate,"
        ."p.UpdatedDate "
        ."from patients p "
        ."LEFT JOIN gender g ON g.GenderId = p.Gender "
        ."LEFT Join disease d on d.disease_Id = p.DiseaseId "
        ."LEFT JOIN status s ON s.StatusId = p.StatusId "
        ."LEFT JOIN patientstype pt ON pt.PatientsTypeId = p.PatientsTypeId "
        ."LEFT Join users c ON c.User_Id = p.CreatedBy "
        ."LEFT JOIN users u ON u.User_Id = p.UpdatedBy "
        ."WHERE p.DiseaseId = ".$_GET['id'];
}
else{
$query = "select distinct p.PatientId,"
        ."p.Firstname,"
        ."IFNULL(p.Lastname,'No Data') as Lastname,"
        ."p.Birthdate,"
        ."g.Gender as Gender,"
        ."p.Mobile,"
        ."IFNULL(p.Email,'No Data') as Email,"
        ."p.AadharNumber,"
        ."p.Address1,"
        ."IFNULL(p.Address2,'No Data') as Address2,"
        ."IFNULL(p.Address3,'No Data') as Address3,"
        ."IFNULL(p.City,'No Data') as City,"
        ."IFNULL(p.Pincode,'No Data') as Pincode,"
        ."IFNULL(p.State,'No Data') as State,"
        ."p.DiseaseId,"
        ."IFNULL(d.disease_name,'No Data') as disease_name,"
        ."d.disease_description,"
        ."p.DiseaseFrom,"
        ."p.Symptoms,"
        ."p.Notes,"
        ."p.PatientsTypeId,"
        ."IFNULL(pt.PatientsType,'No Data') as conditions,"
        ."pt.patients_type_Description,"
        ."p.StatusId,"
        ."IFNULL(s.Status,'No Data') as Status,"
        ."c.firstname as CreatedByfirstname,"
        ."c.lastname  as CreatedBylastname,"
        ."u.firstname  as UpdatedByfirstname,"
        ."u.lastname as UpdatedBylastname,"
        ."p.CreatedDate,"
        ."p.UpdatedDate "
        ."from patients p "
        ."LEFT JOIN gender g ON g.GenderId = p.Gender "
        ."LEFT Join disease d on d.disease_Id = p.DiseaseId "
        ."LEFT JOIN status s ON s.StatusId = p.StatusId "
        ."LEFT JOIN patientstype pt ON pt.PatientsTypeId = p.PatientsTypeId "
        ."LEFT Join users c ON c.User_Id = p.CreatedBy "
        ."LEFT JOIN users u ON u.User_Id = p.UpdatedBy ";
}
$ret=mysqli_query($con,$query);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Patients</title>
    
<script src="../assets/js/lib/jquery.min.js"></script>
<script src="../assets/js/lib/jquery.dataTables.min.js"></script>
<link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/lib/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../assets/js/lib/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/lib/jquery.table2excel.min.js"></script>
<script src="../assets/js/lib/ad4cf1f432.js" crossorigin="anonymous"></script>
<script src="../assets/js/patientlist.js"></script>

<link rel="stylesheet" href="../assets/css/patientlist.css"> 
</head>
<body>
<?php include('../include/header.php'); 
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
    

    <lable class="title-lable">Patient Filter</lable>
    
    <div class="filter-box">
        <div class="filter">
            <div class="fag">
                <lable>Minimum Age</lable>
                <input type="text" id="min" name="min">
            </div>
            <div class="fag">
                <lable>Maximum Age</lable>
                <input type="text" id="max" name="max">
            </div>
        </div>
        <div class="filter">
            <div class="fag">
                <lable>Disease</lable>
                <select class="form-control" name="disease" id="disease" <?php if(isset($_GET['id'])) { echo "disabled";} ?>>
                    <option value="">NO FILTER</option>
                    <?php 
                    if(isset($_GET['id'])) {
                        $querydisease = "select * from disease where disease_Id = ".$_GET['id'];
                    }
                    else{
                        $querydisease = "select * from disease"; 
                    }
                    $retdisease=mysqli_query($con,$querydisease);
                        while($rowdisease=mysqli_fetch_array($retdisease))
                        {
                    ?>
                    <option value="<?php echo htmlentities($rowdisease['disease_name']);?>">
                    <?php echo htmlentities($rowdisease['disease_name']);?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="filter">
            <div class="fag">
                <lable>Condition</lable>
                <select class="form-control" name="condition" id="condition" >
                    <option value="">NO FILTER</option>
                    <?php $retcondition=mysqli_query($con,"select * from patientstype");
                        while($rowcondition=mysqli_fetch_array($retcondition))
                        {
                    ?>
                    <option value="<?php echo htmlentities($rowcondition['PatientsType']);?>">
                    <?php echo htmlentities($rowcondition['PatientsType']);?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="filter">
            <div class="fag">
                <lable>Status</lable>
                <select class="form-control" name="status" id="status" >
                    <option value="">NO FILTER</option>
                    <?php $retstatus=mysqli_query($con,"select * from status");
                        while($rowstatus=mysqli_fetch_array($retstatus))
                        {
                    ?>
                    <option value="<?php echo htmlentities($rowstatus['Status']);?>">
                    <?php echo htmlentities($rowstatus['Status']);?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        
    </div>
 
    <div>
    <button class="btn btn-primary exportToExcel">Export to XLS</button>
    </div>
    <div>
        <button class="btn btn-primary add-btn" onclick="openaddmodel();">Add New Patient</button>
        
    </div>
    <div>
        <button class="btn btn-primary filter-switch" >Hide Filter</button>
        
    </div>
    <table class="table table-bordered table2excel" data-tableName="Patient List" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Birth Date</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Mobile No</th>
                <th>Aadhar No</th>
                <th>Disease</th>
                <th>Condition</th>
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
                        .$row['PatientId']
                        ."</td>"
                        .'<td> <a href="viewpatient.php?pid='.$row['PatientId'].'">'
                        .$row['Firstname']." ".$row['Lastname']
                        ."</a></td>"
                        ."<td>"
                        .$row['Birthdate']
                        ."</td>"
                        ."<td>"
                        .calcutateAge($row['Birthdate'])
                        ."</td>"
                        ."<td>"
                        .$row['Gender']
                        ."</td>"
                        ."<td>"
                        .$row['Mobile']
                        ."</td>"
                        ."<td>"
                        .$row['AadharNumber']
                        ."</td>"
                        ."<td>"
                        .$row['disease_name']
                        ."</td>"
                        ."<td>"
                        .$row['conditions']
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