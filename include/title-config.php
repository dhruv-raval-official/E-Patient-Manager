<link rel="stylesheet" href="../assets/css/title-config.css"> 

<div class="web-title-box" >
<a href="../Accounts/logout.php">
<div class="btn web-user logout" title="Logout"> <i class="fas fa-sign-out-alt" alt="logout" title="Logout" ></i> </div>
</a>
<a href="../users/viewuser.php?uid=<?php echo $_SESSION['id']; ?>">
<h6 class="web-user username-txt" ><i class="fas fa-user-nurse username-icon"></i> <?php echo $_SESSION['username']; ?> </h6>
</a>
<h6 class="web-title" >E- Patient Manager V1.0</h6>
</div>