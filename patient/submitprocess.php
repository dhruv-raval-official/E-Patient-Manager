<?php
include('../include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
$fname = $_POST["firstname"];
$lname = $_POST["lastname"];
$birthdate = $_POST["birthdate"];
$gender = $_POST["gender"];
$phonenumber = $_POST["phonenumber"];
$email = $_POST["email"];
$aadharnumber = $_POST["aadharnumber"];
$addr1 = $_POST["addr1"];
$addr2 = $_POST["addr2"];
$addr3 = $_POST["addr3"];
$city = $_POST["city"];
$state = $_POST["state"];
$zipcode = $_POST["zipcode"];

$sql = "insert into patients(Firstname, Lastname, Birthdate, Gender, Mobile, Email, AadharNumber, Address1, Address2, Address3, City, Pincode, state, CreatedBy,UpdatedBy) values ('$fname','$lname','$birthdate','$gender','$phonenumber','$email','$aadharnumber','$addr1','$addr2','$addr3','$city','$zipcode','$state',1,1)";

if ($con->query($sql) === TRUE) {
  $successmessage = 'Patient '.$fname.' '.$lname.' Added successfully';
  $data = array('success' => $successmessage);
  $url = "patientlist.php";
  redirect_post($url,$data, null);
} else {
  $errormessage = "Error: ". $con->error. "Please Contact Admin / Developer Team";
  $data = array('errormessage' => $errormessage);
  $url = "patientlist.php";
  redirect_post($url,$data, null);
}
}
function redirect_post($url, array $data, array $headers = null) {
  ?>
<form id="TempForm" action="<?php echo $url;?>" method="post">
<?php
    foreach ($data as $a => $b) {
        echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
    }
?>
</form>
<script type="text/javascript">
    document.getElementById('TempForm').submit();
</script>
<?php
}
?>