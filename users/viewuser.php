<html>
<head>
<script src="../assets/js/lib/jquery.min.js"></script>
<script src="../assets/js/lib/bootstrap.min.js"></script> 
<link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="../assets/js/lib/jquery.dataTables.min.js"></script>
<link href="../assets/css/lib/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../assets/js/lib/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/state.js"></script>
<script src="../assets/js/viewuser.js"></script>
<link rel="stylesheet" href="../assets/css/viewuser.css"> 

</head>
<body>
    

<?php
include('../include/config.php');
include('../include/header.php'); 

$error = "";
$success = "";
$checked = "checked='checked'";
$successcheck = "hidden";
$errorcheck ="hidden";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['updatepermission'])){
        $userid = $_POST["uid"];
        if (isset($_POST["viewuser"])) { $viewuser = 1; } else { $viewuser = 0; }
        if (isset($_POST["edituser"])) { $edituser = 1; } else { $edituser = 0; }
        if (isset($_POST["managediseases"])) { $managediseases = 1; } else { $managediseases = 0; }
        if (isset($_POST["manageconditions"])) { $manageconditions = 1; } else { $manageconditions = 0; }
        if (isset($_POST["manageroles"])) { $manageroles = 1; } else { $manageroles = 0; }
        if (isset($_POST["admin"])) { $admin = 1; } else { $admin = 0; }
        $currentuser = $_SESSION["id"];

        $sql = "Update users SET viewusers = '$viewuser', editusers='$edituser', editdiseases='$managediseases', editconditions='$manageconditions', editroles ='$manageroles', admin = '$admin', updatedy='$currentuser' where User_Id = '$userid'";
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

if($_GET["uid"] != null){
    $uid=$_GET["uid"];
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
    ."p.RoleId, "
    ."p.viewusers, "
    ."p.editusers, "
    ."p.editdiseases, "
    ."p.editconditions, "
    ."p.editroles, "
    ."p.admin, "
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
    ."where p.User_Id =".$uid;

    $ret=mysqli_query($con,$query);
    $row=mysqli_fetch_array($ret);  

    $querylog = "select IFNULL(ul.uid, ".$row['User_Id']." ) as uid, "
    ."replace(ul.userip ,'::1', '127.0.0.1') as userip, "
    ."ul.Logintime, "
    ."replace(replace(ul.status, 0 , 'Invalid'), 1, 'Valid') as status "
    ."from userlog ul "
    ."where ul.username = '".$row['Email']."' order by ul.Logintime desc" ;

    $retlog=mysqli_query($con,$querylog);
     
}

?>
<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                    <img src="../assets/img/profile.png" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                    <div class="middle">
                                        <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                        <input type="file" style="display: none;" id="profilePicture" name="file" />
                                    </div>
                                </div>
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);"><?php echo $row['Firstname'].' '.$row['Lastname'] ?></a></h2>
                                    <div class="d-block"><b>Status</b> 
                                    <?php if ( $_SESSION["admin"] == 1 ) { ?>
                                    <select class="form-control " name="selectstatus" id="selectstatus" onchange="changestatus();" >
                                        <?php $retstatus=mysqli_query($con,"select * from status");
                                            while($rowstatus=mysqli_fetch_array($retstatus))
                                            {
                                        ?>
                                                <option value="<?php echo htmlentities($rowstatus['StatusId']);?>">
                                                <?php echo htmlentities($rowstatus['Status']);?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php }
                                        else
                                        {
                                            echo $row['Status'];
                                        }
                                    ?>
                                    </div>
                                    <div class="d-block"><b>Role</b> 
                                    <?php if ( $_SESSION["admin"] == 1 ) { ?>
                                    <select class="form-control " name="selectrole" id="selectrole" onchange="changerole();" <?php if ( $_SESSION["admin"] != 1 ) { echo "disabled='disabled'"; } ?> >
                                        <?php $retrole=mysqli_query($con,"select * from roles");
                                            while($rowrole=mysqli_fetch_array($retrole))
                                            {
                                        ?>
                                                <option value="<?php echo htmlentities($rowrole['RoleId']);?>">
                                                <?php echo htmlentities($rowrole['Role_Name']);?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php }
                                        else
                                        {
                                            echo $row['rolename'];
                                        }
                                    ?>
                                    </div>
                                    <h6 class="d-block"><b>Created By</b> <?php echo $row['CreatedByfirstname'].' '.$row['CreatedBylastname'] ?> </h6>
                                    <h6 class="d-block"><b>Created On Date</b> <?php echo $row['created_date'] ?> </h6>
                                    <h6 class="d-block"><b>Updated By</b> <?php echo $row['UpdatedByfirstname'].' '.$row['UpdatedBylastname'] ?> </h6>
                                    <h6 class="d-block"><b>Updated On Date</b> <?php echo $row['updated_date'] ?> </h6>
                                    <div class="success-box" style="visibility:<?php echo $successcheck ?>" ><span class="message-span"><?php echo $success ?></span></div>
                                    <div class="error-box" style="visibility:<?php echo $errorcheck?>" ><span class="message-span"><?php echo $error ?></span></div>
                                </div>
                                <div class="ml-auto">
                                    <input type="button" class="btn d-none discard-btn" id="btnDiscard" value="Discard Changes" />
                                    <input type="button" class="btn btn-primary" id="updateinfo" title="Update User Details" value="Update Info" />
                                    <a href="userlist.php">
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
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">Login History</a>
                                    </li>
                                    <?php if ( $_SESSION["admin"] == 1 ) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="permissions-tab" data-toggle="tab" href="#permissions" role="tab" aria-controls="permissions" aria-selected="false">Permissions</a>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                        <form action="" method="post">    
                                        <input type="hidden" name="uid" value="<?php echo $row['User_Id'] ?>"/>
                                        <input type='hidden' value="<?php echo $row['RoleId']; ?>" id="role"/>
                                        <input type='hidden' value="<?php echo $row['StatusId']; ?>" name="status" id="status"/>
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Full Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <div class="form-row " style="display:flex;"> <input type="text" class="form-control firsthalf" id="firstname" name="firstname" placeholder="FirstName" value="<?php echo $row['Firstname']; ?>"> <input type="text" class="form-control lasthalf" id="lastname" name="lastname" placeholder="LastName" value="<?php echo $row['Lastname']; ?>"></div>
                                            </div>
                                        </div>
                                        <hr />
                                        
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Contact Details</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <div class="form-row " style="display:flex;"> <input type="text" class="form-control firsthalf" id="Mobile" name="Mobile" placeholder="Mobile Number" value="<?php echo $row['Mobile']; ?>"> <input type="email" class="form-control lasthalf" id="Email" name="Email" placeholder="Email Address" value="<?php echo $row['Email']; ?>"></div>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Address</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <div class="form-row " style="display:flex;"> <input type="text" class="form-control buildinghalf" id="Address1" name="Address1" placeholder="Building/Flat/Section" value="<?php echo $row['Address1']; ?>"> <input type="text" class="form-control firsthalf" id="Address2" name="Address2" placeholder="Address Line 1" value="<?php echo $row['Address2']; ?>"><input type="text" class="form-control lasthalf" id="Address3" name="Address3" placeholder="Address Line 2" value="<?php echo $row['Address3']; ?>"></div>    
                                        </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">City / Pincode</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <?php echo $row['City'].' - '.$row['Pincode']?>
                                            <div class="form-row " style="display:flex;">
                                            <input type='hidden' name="selectedcity" id="selectedcity" value="<?php echo $row['City']?>"/>
                                            <select id='city' class="form-control firsthalf" name="city" onchange='set_pincode(this.value);' >
                                                <option value="SELECT CITY">SELECT CITY</option>
                                            </select>
                                            <input type='hidden' name="selectedzipcode" id="selectedzipcode" value="<?php echo $row['Pincode']?>"/>
                                            <select id='zipcode' class="form-control lasthalf" name="zipcode" onchange="changepincode();" >
                                                <option value="SELECT PINCODE">SELECT PINCODE</option>
                                            </select>
                                        </div>
                                            <br/>select checkbox to change value of city & pincode <input type="checkbox" id="switchc" onclick="switchcitypincode();" value="hide"/> 

                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">State</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <input type='hidden' name="selectedstate" id="selectedstate" value="<?php echo $row['State']?>"/>
                                            <select id="state" class="form-control" name="state" onchange='set_city(this.value)'></select>
                                            </div>
                                        </div>
                                        <hr />
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Login DateTime</th>
                                            <th>User IP</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count =1;
                                     while($rowlog=mysqli_fetch_array($retlog))
                                            { 
                                            $view= "<tr>"
                                                    ."<td>"
                                                    .$count
                                                    ."</td>"
                                                    .'<td>'
                                                    .$rowlog['Logintime']
                                                    ."</td>"
                                                    ."<td>"
                                                    .$rowlog['userip']
                                                    ."</td>"
                                                    ."<td class=".$rowlog['status'].">"
                                                    .$rowlog['status']
                                                    ."</td>"
                                                    ."</tr>";
                                                    $count = $count + 1;      
                                            echo $view;
                                                
                                            } 
                                    ?>
                                    </tbody>
                                </table>
                                    </div>
                                    <?php if ( $_SESSION["admin"] == 1 ) { ?>
                                    <div class="tab-pane fade" id="permissions" role="tabpanel" aria-labelledby="permissions-tab">
                                    <form action="" method="post">
                                    <input type="hidden" name="uid" value="<?php echo $row['User_Id'] ?>"/>
                                    <table  class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Basic</th>
                                                <th>View User</th>
                                                <th>Manage User</th>
                                                <th>Manage Diseases</th>
                                                <th>Manage Conditions</th>
                                                <th>Manage Roles</th>
                                                <th>Admin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-control" name="" id="" value="" disabled='disabled' checked='checked' />
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="form-control" name="viewuser" id="viewuser" value="on" <?php if($row['viewusers'] == 1) { echo $checked; } ?>/>
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="form-control" name="edituser" id="edituser" value="on" <?php if($row['editusers'] == 1) { echo $checked; } ?>/>
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="form-control" name="managediseases" value="on" <?php if($row['editdiseases'] == 1) { echo $checked; } ?>/>
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="form-control" name="manageconditions" value="on" <?php if($row['editconditions'] == 1) { echo $checked; } ?>/>
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="form-control" name="manageroles" value="on" <?php if($row['editroles'] == 1) { echo $checked; } ?>/>
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="form-control" name="admin" value="on" <?php if($row['admin'] == 1) { echo $checked; } ?>/>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    <center>
                                        <input type="submit" class="btn btn-primary" name="updatepermission" value="Update Permissions" />
                                    </center>
                                        </form>
                                    </div>
                                    <?php } ?>
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