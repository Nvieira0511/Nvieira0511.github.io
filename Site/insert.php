<?php

//Block 1
$user = "root"; //Enter the user name
$password = ""; //Enter the password
$host = "localhost"; //Enter the host
$dbase = "memberdb"; //Enter the database
$table = "member"; //Enter the table name
$table2 = "membertype"; //Enter the table name

//Block 2
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $phonenumber = $_POST['phone_numb'];
    $email = $_POST['email'];
    $studentStatus = $_POST['student_status'];
    $studentNumb = $_POST['student_numb'];
    $school = $_POST['school'];
    if($studentStatus == "yes"){
        $school = "Conestoga";
    }
    if($studentNumb == ""){
        $studentNumb = 'N/A';
    }

//Block 3
$connection= mysqli_connect ($host, $user, $password);
if (!$connection)
{
die ('Could not connect:' . mysql_error());
}
mysqli_select_db($connection, $dbase);

//validate existing fields
$sql = "SELECT `email` FROM `member` WHERE `email`='".$email."'";
$result = $connection->query($sql);
if(mysqli_num_rows($result) > 0) {
    header("Location: \index.php?mailError=".$email);
} else {
    echo $studentNumb;
    echo $studentStatus;
    echo 'You have been added.';
    mysqli_query($connection, "INSERT INTO $table 
    (first_name, 
    last_name, 
    phone_numb, 
    email, 
    student_status, 
    student_numb,
    schoolId)
VALUES ('$firstname',
        '$lastname',
        '$phonenumber', 
        '$email',
        '$studentStatus', 
        '$studentNumb',
        '$school')");
        header("Location: \index.php?insertSuccess=".$firstname);
}

//Block 6

mysqli_close($connection);

?>

<html>
<head>
    <title></title>
</head>
<body>
<table>
    <tr>
        <th>Your Record</th>
    </tr>
    <tr>
        <td>Name</td>
        <td><?php echo $firstname," ", $lastname; ?></td>
    </tr>
    <tr>
        <td>Phone Number</td>
        <td><?php echo $phonenumber; ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $email; ?></td>
    </tr>
    <tr>
        <td>Conestoga Student Status</td>
        <td><?php echo $studentStatus; ?></td>
    </tr>
    <tr>
        <td>Student Numb</td>
        <td><?php echo $studentNumb; ?></td>
    </tr>
</table>
</body>
<form action="viewPlayers.php">
    <input type="submit" value="View Players"/>
</form>
</html>

