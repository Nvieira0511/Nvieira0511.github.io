<?php
session_start();
if(isset($_SESSION['userId'])){
  echo 'logged in as: '. $_SESSION['userId']. '<br>';
}

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

?>

<!DOCTYPE html>

<head>
<link href="css/index3.css" rel="stylesheet" type="text/css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<script type="text/javascript">
        function init() {
            var queryString;
            queryString = window.location.search;
            console.log(queryString);
            if (queryString.includes("?id")) {
                queryString = queryString.split("=").pop();
                console.log(queryString);
            } else {
                console.log("wrong");
            }
        }
</script>
<body onload="init()">
<nav>   
        <img src="img/nanLogo.png" class="img-fluid">
        <ul>
        <li><a href="index.php">Home</a></li>
        <li><a class="active"  href="viewPlayers.php">View Rosters</a></li>
        <li ><a href="#contact">Contact</a></li>
        </ul>
        
</nav>
<?php

$value = $_GET['id'];
$query = "SELECT * FROM member JOIN team ON member.teamId=team.teamId WHERE team.teamId =".$value;

$resultTeam = mysqli_query($connection, "SELECT * FROM member JOIN team ON member.teamId=team.teamId WHERE team.teamId =".$value);
$row = mysqli_fetch_row($resultTeam);


$resultTeamName = mysqli_query($connection, "SELECT * FROM team WHERE team.teamId =".$value);
$rowName = mysqli_fetch_row($resultTeamName);

$resultCoachName = mysqli_query($connection, "SELECT * FROM coaches JOIN team ON coaches.teamId=team.teamId WHERE team.teamId =".$value);
$rowCoachName = mysqli_fetch_row($resultCoachName);

$resultTeam->data_seek(0);
if (!$result = mysqli_query($connection, $query)) {
    echo "Syntax Error";
} 
elseif (!mysqli_num_rows($resultCoachName)&&!mysqli_num_rows($resultTeam)) {
    echo "<h1 style='padding-bottom: 8px; width: 20%; padding-left: 1em; background: #393839; color: #F4BD72';>Team is empty</h1>";
} else {
    echo "<div id='rowOne' style='margin-top: 1em';>";
    echo "<h1>Team:"." ".$rowName[1]."</h1>";
    if ($resultCoachName->num_rows > 0) {
        $coachId = $rowCoachName[0];
        if(isset($_SESSION['userId'])){
            echo "<form id='form' name='form' action='delete.php' method='POST'>";
            echo "<h3>Coach:"." ".$rowCoachName[1]."  "."<input type='submit' name='dropCoachTeam' value='Drop from Team'>"."</h3>";
            echo "<input id='thingy' type='hidden' name='thingValue' value='".$coachId."'>";
            echo "</form>";
        }
        else{
            echo "<h3>Coach:"." ".$rowCoachName[1];
        }
    }else{
        echo "<form id='form' name='form' action='delete.php' method='POST'>";
        echo "<h3>Coach: None</h3>";
        echo "</form>";
    }
    echo "<h3>Players</h3>";
    echo "<table style='width: 100%; text-align: center;'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "</tr>";
    if ($resultTeam->num_rows > 0) {
        while($row = $resultTeam->fetch_assoc()) {
            echo "<tr>";
            echo "<form id='form' name='form' action='dropPlayer.php' method='POST'>";
            echo "<td>".$row["member_id"]."</td>"; 
            echo "<td>".$row["first_name"]." ".$row["last_name"]; 
            echo "<td>".$row["email"]."</td>"; 
            echo "<td> <input type='submit' name='thing' value='Delete'>";
            echo "<input id='thingy' type='hidden' name='thingValue' value='".$row["member_id"]."'>";
            echo "<input id='thingy' type='hidden' name='urlId' value='".$_GET["id"]."'>";
            echo "</form>";
        }
        echo "</table>";
    }
    
}
echo "</div>";
?>
</body>