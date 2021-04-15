<?php
if(isset($_POST['login'])){

} 
//Block 1
$user = "root"; //Enter the user name
$password = ""; //Enter the password
$host = "localhost"; //Enter the host
$dbase = "memberdb"; //Enter the database
$table = "admin_log"; //Enter the table name


//$email = $_REQUEST['coachEmail'];
$adminUser = $_REQUEST['coachEmail'];
$passEmail = $_REQUEST['coachPass'];

//Block 3
$connection= mysqli_connect ($host, $user, $password);
if (!$connection)
{
die ('Could not connect:' . mysql_error());
}
mysqli_select_db($connection, $dbase);
$sql = "SELECT * FROM `admin_log` WHERE `acc_user`='".$adminUser."'AND `acc_pass` ='".$passEmail."'";
$result = $connection->query($sql);
if(mysqli_num_rows($result) > 0) {
  session_start();
  $_SESSION['userId'] = $adminUser;
  header("Location: \index.php?adminSuccess=true");
}else{
  header("Location: \index.php?adminFail=".$adminUser);
}
$connection->close();
?>