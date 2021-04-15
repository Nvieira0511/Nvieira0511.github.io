<?php

//Block 1
$user = "root"; //Enter the user name
$password = ""; //Enter the password
$host = "localhost"; //Enter the host
$dbase = "memberdb"; //Enter the database
$table = "team"; //Enter the table name

//Block 2
$teamName = $_POST['teamName'];
$game = $_POST['game'];

//Block 3
$connection= mysqli_connect ($host, $user, $password);
if (!$connection)
{
die ('Could not connect:' . mysql_error());
}
mysqli_select_db($connection, $dbase);

//validate existing fields
$sql = "SELECT `teamName` FROM `team` WHERE `teamName`='".$teamName."'";
$result = $connection->query($sql);
if(mysqli_num_rows($result) > 0) {
    echo 'suh';
    header("Location: viewPlayers.php?teamError=".$teamName);
} else {
    mysqli_query($connection, "INSERT INTO $table 
    (teamName, 
    game)
VALUES ('$teamName',
        '$game')");
//Block 6
mysqli_close($connection);
header("Location: viewPlayers.php?teamSuccess=".$teamName);
}

?>