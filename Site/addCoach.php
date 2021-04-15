<?php
if(isset($_POST['login'])){

}
//Block 1
$user = "root"; //Enter the user name
$password = ""; //Enter the password
$host = "localhost"; //Enter the host
$dbase = "memberdb"; //Enter the database
$table = "coaches"; //Enter the table name


//$email = $_REQUEST['coachEmail'];
$coachName = $_REQUEST['coachName'];
$coachEmail = $_REQUEST['coachEmail'];

//Block 3
$connection= mysqli_connect ($host, $user, $password);
if (!$connection)
{
die ('Could not connect:' . mysql_error());
}
mysqli_select_db($connection, $dbase);

//validate existing fields
$sql = "SELECT `coachEmail` FROM `coaches` WHERE `coachEmail`='".$coachEmail."'";
$result = $connection->query($sql);
if(mysqli_num_rows($result) > 0) {
    header("Location: \index.php?coachMailError=".$coachEmail);
} else {
    echo 'You have been added.';
    mysqli_query($connection, "INSERT INTO $table 
    (coachName, 
    coachEmail)
VALUES ('$coachName',
        '$coachEmail')");
header("Location: \index.php?coachMsg=".$coachName);
}
  $connection->close();
  
?>