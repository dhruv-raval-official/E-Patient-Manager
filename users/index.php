<?php
include('../include/config.php');
include('../include/checkviewuserpermission.php');
?>
<html>
<head>
<script src='../assets/js/lib/jquery.min.js'></script>
<script src="../assets/js/lib/jquery.steps.min.js"></script>

<link href='../assets/css/lib/bootstrap.min.css'>
<script src='../assets/js/lib/bootstrap.bundle.min.js'></script>
<script src="../assets/js/lib/ad4cf1f432.js" crossorigin="anonymous"></script>

<!-- <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> -->
<script src="../assets/js/adduser.js"></script>
<script src="../assets/js/state.js"></script>
<link rel="stylesheet" href="../assets/css/adduser.css">
</head>
<body>
    
<?php include('../include/header.php');
check_edit_user_permission();
?>
<div class="container">
<!-- JQUERY STEP -->
<div class="wrapper">
    <form action="submitprocess.php" method="post">
        <div id="wizard">
            <!-- SECTION 1 -->
            <h4></h4>
            <section>
                <div class="form-row " style="display:flex;"> <input type="text" class="form-control prefix" id="prefix" name="prefix" placeholder="MR/MRS/DR"> <input type="text" class="form-control firsthalf" id="firstname" name="firstname" placeholder="FirstName"> <input type="text" class="form-control lasthalf" id="lastname" name="lastname" placeholder="LastName"></div>
                <div class="form-row" style="display:flex;"> 
                <!-- <input type="date" class="form-control firsthalf "  id="birthdate" name="birthdate" title="Enter Patient BirthDate" placeholder="Birth Date">  -->
                    <select class="form-control firsthalf" name="role" id="role">
                        <option>SELECT ROLE</option>
                    <?php $ret=mysqli_query($con,"select * from roles");
                        while($row=mysqli_fetch_array($ret))
                        {
                    ?>
                            <option value="<?php echo htmlentities($row['RoleId']);?>">
                            <?php echo htmlentities($row['Role_Name']);?>
                        </option>
                    <?php } ?>
                    </select>
                    <select class="form-control lasthalf" name="status" id="status">
                        <option>SELECT STATUS</option>
                    <?php $ret=mysqli_query($con,"select * from status");
                        while($row=mysqli_fetch_array($ret))
                        {
                    ?>
                            <option value="<?php echo htmlentities($row['StatusId']);?>">
                            <?php echo htmlentities($row['Status']);?>
                        </option>
                    <?php } ?>
                    </select>
                 </div>
                <div class="form-row"> <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone number"> </div>
                <div class="form-row"> <input type="email" class="form-control" id="email" name="email" placeholder="Email"> </div>
                <div class="form-row"> <input type="text" class="form-control" id="aadharno" name="aadharnumber" placeholder="Aadhar Card Number"> </div>
            </section> <!-- SECTION 2 -->
            <h4></h4>
            <section>
                <div class="form-row"> <input type="text" class="form-control" id="addr1" name="addr1" placeholder="Flat/Building/Section"> </div>
                <div class="form-row"> <input type="text" class="form-control" id="addr2" name="addr2" placeholder="Address Line"> </div>
                <div class="form-row"> <input type="text" class="form-control" id="addr3" name="addr3" placeholder="Landmark Name"> </div>
                <div class="form-row"> 
                    <!-- <input type="text" class="form-control" id="state" name="state" placeholder="State">  -->
                    <select id="state" class="form-control" name="state" onchange='set_city(this.value)'></select> </div>
                <div class="form-row">
                    <select id='city' class="form-control" name="city" onchange='set_pincode(this.value)' >
                        <option value="SELECT CITY">SELECT CITY</option>
                    </select>
                     <!-- <input type="text" class="form-control" id="city" name="city" placeholder="City">  -->
                     </div>
                
                <div class="form-row"> 
                <select id='zipcode' class="form-control" name="zipcode" >
                        <option value="SELECT PINCODE">SELECT PINCODE</option>
                    </select>
                <!-- <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="zip code"> -->
                 </div>
            </section> <!-- SECTION 3 -->
            <h4></h4>
            <section> 
                <div class="form-row"> <label>Full Name : </label><label class="checklable" id="fn" ></label></div>  
                <div class="form-row"> <label>Status : </label><label class="checklable" id="st" ></label></div>  
                <div class="form-row"> <label>Role : </label><label class="checklable" id="rl" ></label></div>  
                <div class="form-row"> <label>Phone Number : </label><label class="checklable" id="mo" ></label></div>  
                <div class="form-row"> <label>Email : </label><label class="checklable" id="em" ></label></div>  
                <div class="form-row"> <label>Aadhar Card Number : </label><label class="checklable" id="aa" ></label></div>  
                <div class="form-row"> <label>Flat/Building/Section : </label><label class="checklable" id="add1" ></label></div>  
                <div class="form-row"> <label>Address : </label><label class="checklable" id="add2" ></label></div>  
                <div class="form-row"> <label>Landmark Name : </label><label class="checklable" id="add3" ></label></div>  
                <div class="form-row"> <label>City : </label><label class="checklable" id="citylable" ></label></div>  
                <div class="form-row"> <label>Zip Code : </label><label class="checklable" id="pin" ></label></div>  
                <div class="form-row"> <label>State : </label><label class="checklable" id="statelable" ></label></div>    
            </section>
        </div>
    </form>
</div>
</div>
</body>
</html>