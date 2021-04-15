<?php
Session_start();
session_destroy();
if($_POST["thingValue"] == "index"){
    header("Location: index.php");
}
if($_POST["thingValue"] == "viewPlayers"){
header("Location: viewPlayers.php");
}
?>