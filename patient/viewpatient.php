<html>
<head>
<script src="../assets/js/lib/jquery.min.js"></script>
<script src="../assets/js/lib/bootstrap.min.js"></script> 
<link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="../assets/js/viewpatient.js"></script>
<link rel="stylesheet" href="../assets/css/viewpatient.css"> 

</head>
<body>
    

<?php
include('../include/config.php');
$error = "";
$success = "";
$successcheck = "hidden";
$errorcheck ="hidden";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST['update'] == 'Update Diagnosis'){
        $patientid = $_POST["patientid"];
        $diseaseid = $_POST["disease"];
        $diseasefrom = $_POST["diseasefrom"];
        $symptoms = $_POST["Symptoms"];
        $conditionid = $_POST["condition"];
        $notes = $_POST["notes"];

        $sql = "Update patients SET DiseaseId = '$diseaseid', DiseaseFrom='$diseasefrom', Symptoms='$symptoms', Notes='$notes', PatientsTypeId ='$conditionid',StatusId =1, UpdatedBy=1 where PatientId = '$patientid'";
         if ($con->query($sql) === TRUE) {
         $success = "Record Updated successfully";
         $successcheck = "visible";
         $errorcheck ="hidden";
         } else {
         $error = "Error: ".$con->error;
         $successcheck = "hidden";
         $errorcheck ="visible";
         }
    }
}

if($_GET["pid"] != null){
    $pid=$_GET["pid"];
    $query = "select distinct p.PatientId,"
    ."p.Firstname,"
    ."p.Lastname,"
    ."p.Birthdate,"
    ."g.Gender as Gender,"
    ."p.Mobile,"
    ."p.Email,"
    ."p.AadharNumber,"
    ."p.Address1,"
    ."p.Address2,"
    ."p.Address3,"
    ."p.City,"
    ."p.Pincode,"
    ."p.State,"
    ."p.DiseaseId,"
    ."d.disease_name,"
    ."d.disease_description,"
    ."p.DiseaseFrom,"
    ."p.Symptoms,"
    ."p.Notes,"
    ."p.PatientsTypeId,"
    ."pt.PatientsType,"
    ."pt.patients_type_Description,"
    ."p.StatusId,"
    ."s.Status,"
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
    ."where PatientId =".$pid;

    $ret=mysqli_query($con,$query);
    $row=mysqli_fetch_array($ret);  
}

function calcutateAge($dob){

    $dob = date("Y-m-d",strtotime($dob));

    $dobObject = new DateTime($dob);
    $nowObject = new DateTime();

    $diff = $dobObject->diff($nowObject);

    return $diff->y;

}

?>
<?php include('../include/header.php'); ?>
<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                    <img src="../assets/img/patient.jpg" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                    <div class="middle">
                                        <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                        <input type="file" style="display: none;" id="profilePicture" name="file" />
                                    </div>
                                </div>
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);"><?php echo $row['Firstname'].' '.$row['Lastname'] ?></a></h2>
                                    <h6 class="d-block"><b>Status</b> <?php echo $row['Status'] ?></h6>
                                    <h6 class="d-block"><b>Created By</b> <?php echo $row['CreatedByfirstname'].' '.$row['CreatedBylastname'] ?> </h6>
                                    <h6 class="d-block"><b>Created On Date</b> <?php echo $row['CreatedDate'] ?> </h6>
                                    <h6 class="d-block"><b>Updated By</b> <?php echo $row['UpdatedByfirstname'].' '.$row['UpdatedBylastname'] ?> </h6>
                                    <h6 class="d-block"><b>Updated On Date</b> <?php echo $row['UpdatedDate'] ?> </h6>
                                    <div class="success-box" style="visibility:<?php echo $successcheck ?>" ><span class="message-span"><?php echo $success ?></span></div>
                                    <div class="error-box" style="visibility:<?php echo $errorcheck?>" ><span class="message-span"><?php echo $error ?></span></div>
                                </div>
                                <div class="ml-auto">
                                    <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                                    <a href="patientlist.php">
                                    <input type="button" class="btn btn-secondary" id="btnbacktolist" value="Back To List" />
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">Diagnosis</a>
                                    </li>
                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                        

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Full Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <?php echo $row['Firstname'].' '.$row['Lastname'] ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Gender</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <?php echo $row['Gender'] ?>   
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Birth Date</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <?php echo $row['Birthdate']?>
                                            </div>
                                        </div>
                                        <hr />
                                        
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Age</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <?php 
                                            //echo (int)(date("d/m/y")-$row['Birthdate'])
                                            echo calcutateAge($row['Birthdate']);
                                            ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Contact Details</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <?php echo $row['Mobile'].' / '.$row['Email']?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Address</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <?php echo $row['Address1'].', '.$row['Address2'].', '.$row['Address3']?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">City / Pincode</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <?php echo $row['City'].' - '.$row['Pincode']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">State</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <?php echo $row['State']?>
                                            </div>
                                        </div>
                                        <hr />
                                    </div>
                                    <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                        <!-- Facebook, Google, Twitter Account that are connected to this account -->
                                        <div class="form-box">
                                        <form action="" method="post">
                                        <input type="hidden" name="patientid" value="<?php echo $row['PatientId'];?>" />
                                        <div class="form-row"> 
                                        <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Disease</label>
                                                <lable style="visibility: hidden;" id="tempDiseaseId"> <?php echo $row['DiseaseId']; ?> </lable>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <select class="form-control" name="disease" id="disease"  >
                                                    <?php $ret=mysqli_query($con,"select * from disease");
                                                        while($rowdata=mysqli_fetch_array($ret))
                                                        {
                                                    ?>
                                                    <option value="<?php echo htmlentities($rowdata['disease_Id']);?>">
                                                    <?php echo htmlentities($rowdata['disease_name']);?>
                                                </option>
                                            <?php } ?>
                                            </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Disease From</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                             <input type="text" class="form-control" id="diseasefrom" name="diseasefrom" placeholder="How old is disease?" value="<?php echo $row['DiseaseFrom']; ?>">
                                            </div> 
                                              </div>
                                        
                                        <div class="form-row"> 
                                        <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Symptoms</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <textarea class="form-control" id="Symptoms" name="Symptoms" rows="4" title="Symptoms of patient"> <?php echo $row['Symptoms']; ?> </textarea>
                                           </div> 
                                            </div>
                                        <div class="form-row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Patient Condition </label>
                                                <lable style="visibility: hidden;" id="tempCondition"> <?php echo $row['PatientsTypeId']; ?> </lable>
                                            </div>
                                            <div class="col-md-8 col-6"> 
                                            <select class="form-control" name="condition" id="condition">
                                                    <?php $ret=mysqli_query($con,"select * from patientstype");
                                                        while($rowdata=mysqli_fetch_array($ret))
                                                        {
                                                    ?>
                                                    <option value="<?php echo htmlentities($rowdata['PatientsTypeId']);?>">
                                                    <?php echo htmlentities($rowdata['PatientsType']);?>
                                                </option>
                                            <?php } ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Suggestion/Notes</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <textarea class="form-control" id="notes" name="notes" rows="4" title="Suggestions/Notes From Doctor"> <?php echo $row['Notes']; ?>  </textarea>
                                           </div> 
                                            </div>
                                            </div>
                                        <div class="form-row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;"></label>
                                            </div>
                                            <div class="col-md-5 col-6">
                                         <input type="submit" class="btn btn-primary" style="float:right" id="submitbtn" name="update" value="Update Diagnosis"> </div>
                                        </div>
                                        </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>   
</body>
</html>