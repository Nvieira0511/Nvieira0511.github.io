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
$value2 = $_GET['teamId'];
$value3 = $_GET['coachId'];

echo $value;
echo $value2;
echo $value3;
//Block 3
$connection= mysqli_connect ($host, $user, $password);
if (!$connection)
{
die ('Could not connect:' . mysql_error());
}
mysqli_select_db($connection, $dbase);

$sqlAdd = "UPDATE coaches SET teamid=".$value2." WHERE id =".$value3."";
if ($connection->query($sqlAdd) === TRUE) {
    echo "Record added successfully = ".$value;
} else {
echo "Error adding record: " . $connection->error;

$connection->close();
 header("Location: viewPlayers.php");
}
header("Location: viewPlayers.php");
?>