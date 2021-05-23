<?php
include('../include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
$prefix = $_POST["prefix"];
$fname = $_POST["firstname"];
$lname = $_POST["lastname"];
$status = $_POST["status"];
$role = $_POST["role"];
$phonenumber = $_POST["phonenumber"];
$email = $_POST["email"];
$aadharnumber = $_POST["aadharnumber"];
$addr1 = $_POST["addr1"];
$addr2 = $_POST["addr2"];
$addr3 = $_POST["addr3"];
$city = $_POST["city"];
$state = $_POST["state"];
$zipcode = $_POST["zipcode"];

$sql = "insert into users(Prefix, firstname, lastname, mobile, email, aadharNumber, address1, address2, address3, city, pincode, state, statusId, RoleId, createdby, updatedy) values ('$prefix','$fname','$lname','$phonenumber','$email','$aadharnumber','$addr1','$addr2','$addr3','$city','$zipcode','$state','$status','$role',1,1)";

if ($con->query($sql) === TRUE) {
  $successmessage = 'User '.$prefix.' '.$fname.' '.$lname.' Added successfully';
  $data = array('success' => $successmessage);
  $url = "userlist.php";
  redirect_post($url,$data, null);
} else {
  $errormessage = "Error: ". $con->error. "Please Contact Admin / Developer Team";
  $data = array('errormessage' => $errormessage);
  $url = "userlist.php";
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