<?php
session_start();
?>
<?php
//Block 1
$user = "root"; //Enter the user name
$password = ""; //Enter the password
$host = "localhost"; //Enter the host
$dbase = "memberdb"; //Enter the database
$table = "member"; //Enter the table name
$connection= mysqli_connect ($host, $user, $password);
if (!$connection)
{
die ('Could not connect:' . mysql_error());
}
mysqli_select_db($connection, $dbase);
$result = mysqli_query($connection, "SELECT * FROM member");
$resultTeam = mysqli_query($connection, "SELECT * FROM team");
$resultCoaches = mysqli_query($connection, "SELECT * FROM coaches");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$row = mysqli_fetch_row($result);
$rowTeam = mysqli_fetch_row($resultTeam);
$rowCoach = mysqli_fetch_row($resultCoaches);
?>
<body onload="init()">
<!DOCTYPE html>
<head>
<link href="css/index2.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
        var errors = [];
        //initial function to empty error array
        function init() {
            errors.splice(0, errors.length);
            var queryString;
            queryString = window.location.search;
            console.log(queryString);
            if (queryString.includes("?teamSuccess")) {
                queryString = queryString.split("=").pop();
                console.log(queryString);
                var x = document.getElementById("returnedSuccess");
                x.innerHTML = "Team: " + queryString + " added successfully";
                document.getElementById("returnedError").style.display = "block";
            }if (queryString.includes("?teamError")) {
                queryString = queryString.split("=").pop();
                console.log(queryString);
                var x = document.getElementById("returnedError");
                x.innerHTML = "Team: " + queryString + " already exists";
                document.getElementById("returnedError").style.display = "block";
            }
            if (queryString.includes("?playerSuccess")) {
                queryString = queryString.split("=").pop();
                console.log(queryString);
                var x = document.getElementById("playerSuccess");
                x.innerHTML = "Player: " + queryString + " successfully added";
                document.getElementById("playerSuccess").style.display = "block";
            }
            if (queryString.includes("?playerError")) {
                queryString = queryString.split("=").pop();
                console.log(queryString);
                var x = document.getElementById("playerError");
                x.innerHTML = "Player: " + queryString + " is already on a team";
                document.getElementById("playerError").style.display = "block";
            }
            if (queryString.includes("?coachError")) {
                queryString = queryString.split("=").pop();
                console.log(queryString);
                var x = document.getElementById("coachError");
                x.innerHTML = "Team already has a coach";
                document.getElementById("coachError").style.display = "block";
            }
            if (queryString.includes("?coachAdd")) {
                queryString = queryString.split("=").pop();
                console.log(queryString);
                var x = document.getElementById("coachSuccess");
                x.innerHTML = "Coach: " + queryString + " successfully added";
                document.getElementById("coachSuccess").style.display = "block";
            }
            if (queryString.includes("?deleteTeamFail")) {
                queryString = queryString.split("=").pop();
                console.log(queryString);
                var x = document.getElementById("teamFail");
                x.innerHTML = "Team must be empty before deleting";
                document.getElementById("teamFail").style.display = "block";
            }
             else {
                console.log("wrong");
            }
        }
</script>
</head>
<header>
    <?php
        if(isset($_SESSION['userId'])){
            echo '<p>logged in as: '.$_SESSION['userId'].'</p>'.
            '<form action="/logOut.php" class="form-container" method="POST">'.
            "<input id='thingy' type='hidden' name='thingValue' value='viewPlayers'>".
            '<button type="submit" name="login" class="btn" style="width: 5%;color: #F4BD72";>Log Out</button>'.
            '</form>';
        }
    ?>
    </header>

    <nav>   
        <img src="img/nanLogo.png" class="img-fluid">
        <ul>
        <li><a href="index.php">Home</a></li>
        <li><a class="active"  href="viewPlayers.php">View Rosters</a></li>
        <li ><a href="\contact.php">Contact</a></li>
        </ul>
        
</nav>

<div id="all" class="all">
<?php
if(isset($_SESSION['userId'])){
  
  ?>

<form action="insertTeam.php" method="POST">
  <h3>Create Team</h3>
  <p id=returnedError style="color: #af4c4c;"></p>
  <p id=returnedSuccess style="color: #4CAF50;"></p>
  <label for="teamName">Team Name*</label>
  <input type="text" name="teamName" id="teamName" required>
  <span class="errorTeamName" id="errorTeamName" style="display: none; color: red;">Please enter a valid team name</span>
  <span class="errorEmptyTeamName" id="errorEmptyTeamName" style="display: none; color: red;">Please enter the team name</span>
  <label for="name">Game*</label>
  <select name="game" id="game">
  <option value="League of Legends">League of Legends</option>
  <option value="Rainbow Six Siege">Rainbow Six Siege</option>
  <option value="Counter Strike">Counter Strike</option>
  <option value="Valorant">Valorant</option>
  </select>
  <input type="submit" value="Create Team">
  
</form>
<?php
}
?>
  <?php

echo "<div id='rowOne' style='margin-top: 1em';>";
echo "<h3>Coaches</h3>";
echo "<table style='width: 100%; text-align: center;'>";
if(isset($_SESSION['userId'])){
  $resultTeam->data_seek(0);
  echo "<tr>";
  echo "<th>Coach id</th>";
  echo "<p id=coachError style='color: #af4c4c;'></p>".
       "<p id=coachSuccess style='color: #4CAF50;'></p>";
  echo "<th>Name</th>";
  echo "<th>Email</th>";
  echo "<th>Current Team</th>";
  echo "</tr>";
  $resultCoaches->data_seek(0);
  if ($resultCoaches->num_rows > 0) {
    while($rowCoach = $resultCoaches->fetch_assoc()) {
      echo "<form id='form' name='form' action='delete.php' method='POST'>";
      $coachName = $rowCoach["coachName"];
      $coachId = $rowCoach["id"];
      $coachEmail = $rowCoach["coachEmail"];
      $coachTeam = $rowCoach["teamid"];
      echo "<tr>";
      echo "<td>".$coachId." "."</td>";
      echo "<td>".$coachName."</td>"; 
      echo "<td>".$coachEmail."</td>"; 
      echo "<td>".$coachTeam."</td>"; 
      echo "<td>".
      "<select name='gameTeam' id='gameTeam'>";
      $resultTeam->data_seek(0);
      while($rowTeam = $resultTeam->fetch_assoc()) {
        $teamId = $rowTeam["teamid"];
        $teamName = $rowTeam["teamName"];
        echo "<option value=".$teamId.">".$teamName."</option>";
      }
      echo "</select>".
      "<td> <input type='submit' name='addCoachTeam' value='add to team'>".
      "<td><input type='submit' name='deleteCoach' value='Delete'></td>".
      "<input id='thingy' type='hidden' name='thingValue' value='".$id."'>".
      "<input id='thingy' type='hidden' name='thingValue2' value='".$teamId."'>".
      "<input id='thingy' type='hidden' name='thingValue3' value='".$teamName."'>".
      "<input id='thingy' type='hidden' name='coachId' value='".$coachId."'>".
      "<input id='thingy' type='hidden' name='coachName' value='".$coachName."'>".
      "</form>";
      "</td>";
      echo "</tr>";
    }
  }
  echo "</table>";
}else{
  $resultTeam->data_seek(0);  
  echo "<tr>";
  echo "<th>id</th>";
  echo "<th>Name</th>";
  echo "<th>Email</th>";
  echo "<th>Current Team</th>";
  echo "</tr>";
  $resultCoaches->data_seek(0);
  if ($resultCoaches->num_rows > 0) {
    while($rowCoach = $resultCoaches->fetch_assoc()) {
      echo "<form id='form' name='form' action='delete.php' method='POST'>";
      $coachName = $rowCoach["coachName"];
      $coachId = $rowCoach["id"];
      $coachEmail = $rowCoach["coachEmail"];
      $coachTeam = $rowCoach["teamid"];
      echo "<tr>";
      echo "<td>".$coachId." "."</td>";
      echo "<td>".$coachName."</td>"; 
      echo "<td>".$coachEmail."</td>"; 
      echo "<td>".$coachTeam."</td>"; 
      echo "<td>".
      "</form>";
      "</td>";
      echo "</tr>";
    }
  }
  echo "</table>";
}
echo "</div>";
echo "<div id='rowTwo'>";
echo "<h3>Players</h3>";
echo "<p id=playerError style='color: #af4c4c;'></p>".
     "<p id=playerSuccess style='color: #4CAF50;'></p>";
echo "<table style='width: 100%; text-align: center;'>";
if(isset($_SESSION['userId'])){
echo "<tr>";

echo "<p id=returnedErrorPlayers></p>";
echo "<th>Player id</th>";
echo "<th>Name</th>";
echo "<th>Email</th>";
echo "</tr>";
  $result->data_seek(0);
  $resultTeam->data_seek(0);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $id = $row["member_id"];
      $name = $row["first_name"];
      $nameLast = $row["last_name"];
      $playerEmail = $row["email"];
      echo "<tr>";
      echo "<form id='form' name='form' action='delete.php' method='POST'>";
      echo "<td>".$row["member_id"]." "."</td>";
      echo "<td>".$row["first_name"]." ".$row["last_name"]; 
      echo "<td>".$playerEmail;
      echo "<td>"."<select name='gameTeam' id='gameTeam'>";
      $resultTeam->data_seek(0);
      while($rowTeam = $resultTeam->fetch_assoc()) {
        $teamId = $rowTeam["teamid"];
        $teamName = $rowTeam["teamName"];
        echo "<option value=".$teamId.">".$teamName."</option>;";
      }
      echo "</select>".
      "<td> <input type='submit' name='addTeam' value='add to team'> <td>".
      "<td> <input type='submit' name='thing' value='Delete'>".
      "<input id='thingy' type='hidden' name='thingValue' value='".$id."'>".
      "<input id='thingy2' type='hidden' name='thingValue2' value='".$teamId."'>".
      "<input id='thingy3' type='hidden' name='thingValue3' value='".$name."'>".
      "</form>";
      "</td>";
      echo "</tr>";
    }
    echo "</table>";
    } else {
      echo "0 results";
    }
}else{
  echo "<tr>";
  echo "<p id=returnedErrorPlayers></p>";
  echo "<th>id</th>";
  echo "<th>Name</th>";
  echo "<th>Email</th>";
  echo "</tr>";
  $result->data_seek(0);
  $resultTeam->data_seek(0);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $id = $row["member_id"];
      $name = $row["first_name"];
      $nameLast = $row["last_name"];
      $playerEmail = $row["email"];
      echo "<tr>";
      echo "<form id='form' name='form' action='delete.php' method='POST'>";
      echo "<td>".$row["member_id"]." "."</td>";
      echo "<td>".$row["first_name"]." ".$row["last_name"]; 
      echo "<td>".$playerEmail;
      echo "</select>".
      "</form>";
      "</td>";
      echo "</tr>";
    }
    echo "</table>";
    } else {
      echo "0 results";
    }
}
echo "</div>";
?>

<div id='rowThree'>
<table style="width: 100%; text-align: center;">
<h3>Teams</h3>
<p id=teamFail style='display: none; color: #af4c4c;'></p>
<p id=teamSuccess style='display: none; color: #4CAF50;'></p>
<tr>
  <th>Team id</th>
  <th>Team Name</th>
  <th>Game</th>
</tr>
<tr>
<?php
if(isset($_SESSION['userId'])){
  $resultTeam->data_seek(0);
  if ($result->num_rows > 0) {
    $resultTeam->data_seek(0);
    while($rowTeam = $resultTeam->fetch_assoc()) {
      $teamId = $rowTeam["teamid"];
      $teamName = $rowTeam["teamName"];
      $game = $rowTeam["game"];
      echo "<form id='form' name='form' action='deleteTeam.php' method='POST'>";
      echo "<td>".$teamId." "."</td>";
      echo "<td>".$teamName." "."</td>";
      echo "<td>".$game." "."</td>";
      echo "<td> <input type='submit' name='delete' value='Delete'>";
      echo "<input id='thingy' type='hidden' name='thingValue' value='".$teamId."'>";
      echo "<input id='thingy' type='hidden' name='thingValue2' value='".$teamName."'>";
      echo "<td> <input type='submit' name='roster' value='View Roster'>";
      echo "</form>";
      echo "</tr>";
    }
  }
}else{
  $resultTeam->data_seek(0);
  if ($result->num_rows > 0) {
    $resultTeam->data_seek(0);
    while($rowTeam = $resultTeam->fetch_assoc()) {
      $teamId = $rowTeam["teamid"];
      $teamName = $rowTeam["teamName"];
      $game = $rowTeam["game"];
      echo "<form id='form' name='form' action='deleteTeam.php' method='POST'>";
      echo "<td>".$teamId." "."</td>";
      echo "<td>".$teamName." "."</td>";
      echo "<td>".$game." "."</td>";
      echo "<input id='thingy' type='hidden' name='thingValue' value='".$teamId."'>";
      echo "<td> <input type='submit' name='roster' value='View Roster'>";
      echo "</form>";
      echo "</tr>";
    }
  }
}
echo "</div>";
mysqli_close($connection);
?>
</tr>
</table>
</body>
</div>