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

$id = $_REQUEST["thingValue"];
$teamName = $_REQUEST["thingValue2"];

//Block 3
$connection= mysqli_connect ($host, $user, $password);
if (!$connection){
    die ('Could not connect:' . mysql_error());
}
mysqli_select_db($connection, $dbase);
if($_POST["delete"]){
    $sqlSelect = "SELECT `teamid` FROM `team` WHERE `teamid`='".$id."'";
    $sqlDelete = "DELETE FROM team where teamid =".$id;
    if ($connection->query($sqlDelete) === TRUE) {
        echo "Record deleted successfully = ".$id;
        header("Location: viewPlayers.php");
    } else {
    echo "Error deleting record: " . $connection->error;
    header("Location: viewPlayers.php?deleteTeamFail=".$teamName);
    }
    $connection->close();
    echo $teamId;
}
if($_POST["roster"]){
    echo "roster"; 
    header("Location: viewRoster.php?id=".$id."");
    $connection->close();
}
?>