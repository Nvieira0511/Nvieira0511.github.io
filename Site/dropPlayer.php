<?php
if(isset($_SESSION['userId'])){
    echo 'logged in as: '. $_SESSION['userId'];
}
//Block 1
$user = "root"; //Enter the user name
$password = ""; //Enter the password
$host = "localhost"; //Enter the host
$dbase = "memberdb"; //Enter the database
$table = "member"; //Enter the table name

$id = $_REQUEST["thingValue"];
$id2 = $_REQUEST["urlId"];
echo $id;
echo $id2;
//Block 3
$connection= mysqli_connect ($host, $user, $password);
if (!$connection){
    die ('Could not connect:' . mysql_error());
}
mysqli_select_db($connection, $dbase);
    $sqlSelect = "SELECT `member_id` FROM `member` WHERE `teamid`='".$id."'";
    $sqlUpdate = "UPDATE member SET teamid=null WHERE member_id =".$id."";
    if ($connection->query($sqlUpdate) === TRUE) {
        echo "Record updated successfully = ".$id;
    } else {
    echo "Error deleting record: " . $connection->error;
    }
$connection->close();
 header("Location: viewRoster.php?id=".$id2);
?>