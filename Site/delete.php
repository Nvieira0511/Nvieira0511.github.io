<?php
//Block 1
$user = "root"; //Enter the user name
$password = ""; //Enter the password
$host = "localhost"; //Enter the host
$dbase = "memberdb"; //Enter the database
$table = "member"; //Enter the table name

$id = $_REQUEST['thingValue'];
$teamid = $_REQUEST['thingValue2'];
$teamName = $_REQUEST['thingValue3'];
$name = $_REQUEST['thingValue3'];
$data = $_REQUEST['gameTeam'];

$coachId = $_REQUEST['coachId'];
$coachName = $_REQUEST['coachName'];

//Block 3
$connection= mysqli_connect ($host, $user, $password);
if (!$connection)
{
die ('Could not connect:' . mysql_error());
}
mysqli_select_db($connection, $dbase);

if($_POST["thing"]){
$sqlSelect = "SELECT `member_id` FROM `member` WHERE `member_id`='".$id."'";
$sqlDelete = "DELETE FROM member where member_id =".$id;
if ($connection->query($sqlDelete) === TRUE) {
    echo "Record deleted successfully = ".$id;
  } else {
    echo "Error deleting record: " . $connection->error;
  }
  $connection->close();
  header("Location: viewPlayers.php");
}
if($_POST["addTeam"]){
  $sqlSelect = "SELECT * from member WHERE member_id=".$id." AND teamid is null";
  $result2 = $connection->query($sqlSelect);
  if(mysqli_num_rows($result2) > 0) {
    echo "heregood";
    echo $data;
    $sqlUpdate = "UPDATE member SET teamid=".$data." WHERE member_id =".$id."";
    $result = $connection->query($sqlUpdate);
    if($connection->query($sqlUpdate) === TRUE) {
      echo "heregood";
      echo "teamid= ".$data;
      
      header("Location: viewPlayers.php?playerSuccess=".$name);
    }
    }else{
      echo "herebad";
      header("Location: viewPlayers.php?playerError=".$name);
    }
  $connection->close();
}
  

if($_POST["addCoachTeam"]){
  echo "rosterAdd";
  echo $coachId;
  echo $coachName;
  echo "team id is: " .$data;
  $sql = "SELECT * FROM `coaches` WHERE `teamid`='".$data."'";
  $result = $connection->query($sql);
  if(mysqli_num_rows($result) > 0) {
    echo "here";
    echo $coachName;
    header("Location: viewPlayers.php?coachError=".$coachName);
  } else{
    $sqlUpdate = "UPDATE coaches SET teamid=".$data." WHERE id =".$coachId."";
    if ($connection->query($sqlUpdate) === TRUE) {
      echo "Record deleted successfully = ".$id;
    } else {
      echo "Error deleting record: " . $connection->error;
    }
    $connection->close();
    header("Location: viewPlayers.php?coachAdd=".$coachName);
  }
}
if($_POST["deleteCoach"]){
  echo "rosterDelete";
  echo $coachId;
  echo $coachName;
  $sqlDelete = "DELETE FROM coaches where id =".$coachId;
  if ($connection->query($sqlDelete) === TRUE) {
      echo "Record deleted successfully = ".$id;
    } else {
      echo "Error deleting record: " . $connection->error;
    }
    $connection->close();
    header("Location: viewPlayers.php");
}
if($_POST["dropCoachTeam"]){
  echo "coachTeamDrop";
  echo $id;
  $sqlUpdate = "UPDATE coaches SET teamid=NULL WHERE id =".$id."";
    if ($connection->query($sqlUpdate) === TRUE) {
      echo "Record deleted successfully = ".$id;
    } else {
      echo "Error deleting record: " . $connection->error;
    }
    $connection->close();
    header("Location: viewPlayers.php");
  }
?>