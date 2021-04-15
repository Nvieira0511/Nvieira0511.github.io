<?php
if(isset($_SESSION['userId'])){
    echo 'logged in as: '. $_SESSION['userId'];
}
//Block 1
$user = "root"; //Enter the user name
$password = ""; //Enter the password
$host = "localhost"; //Enter the host
$dbase = "memberdb"; //Enter the database
$table = "team"; //Enter the table name

$value = $_GET['id'];

echo $value;
//Block 3
$connection= mysqli_connect ($host, $user, $password);
if (!$connection)
{
die ('Could not connect:' . mysql_error());
}
mysqli_select_db($connection, $dbase);

$sqlUpdate = "UPDATE coaches SET teamid=NULL WHERE id=".$value;
if ($connection->query($sqlUpdate) === TRUE) {
    echo "Record updated successfully = ".$value;
} else {
  echo "Error removing record: " . $connection->error;
  $connection->close();
}
  header("Location: viewPlayers.php");
?>