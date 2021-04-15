<?php
    session_start();
    $user = "root"; //Enter the user name
    $password = ""; //Enter the password
    $host = "localhost"; //Enter the host
    $dbase = "memberdb"; //Enter the database
    $table = "school"; //Enter the table name
    $connection= mysqli_connect ($host, $user, $password);
    if (!$connection)
    {
    die ('Could not connect:' . mysql_error());
    }
    mysqli_select_db($connection, $dbase);
    $resultSchool = mysqli_query($connection, "SELECT * FROM school");
    $rowSchool = mysqli_fetch_row($resultSchool);
?>
<!DOCTYPE html>
<head>
    <link href="css/index.css" rel="stylesheet" type="text/css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript">
        var errors = [];
        //initial function to empty error array
        function init() {
            errors.splice(0, errors.length);
            var queryString;
            queryString = window.location.search;
            console.log(queryString);
            if (queryString.includes("?mailError")) {
                queryString = queryString.split("=").pop();
                console.log(queryString);
                var x = document.getElementById("returnedError");
                x.innerHTML = "Email " + queryString + " currently in use, please use another";
                document.getElementById("returnedError").style.display = "block";
            }
            if (queryString.includes("?coachMailError")) {
                queryString = queryString.split("=").pop();
                var x = document.getElementById("coachMsgFail");
                x.innerHTML = "Email \"" + queryString + "\" already in use";
                document.getElementById("returnedError").style.display = "block";
            }
            if (queryString.includes("?coachMsg")) {
                queryString = queryString.split("=").pop();
                var x = document.getElementById("coachMsgSuccess");
                x.innerHTML = queryString + " successfully added";
                document.getElementById("returnedError").style.display = "block";
            }
            if (queryString.includes("?adminSuccess")) {
                queryString = queryString.split("=").pop();
                var x = document.getElementById("logSuccess");
                x.innerHTML = "Login successful";
                document.getElementById("logSuccess").style.display = "block";
            }
            if (queryString.includes("?adminFail")) {
                queryString = queryString.split("=").pop();
                var x = document.getElementById("logFail");
                x.innerHTML = "incorrect username or password";
                document.getElementById("logFail").style.display = "block";
            }
            if (queryString.includes("?insertSuccess")) {
                queryString = queryString.split("=").pop();
                var x = document.getElementById("insertSuccess");
                x.innerHTML = "Player " + queryString + " added successfully";
                document.getElementById("insertSuccess").style.display = "block";
            }
            else {
                console.log("wrong");
            }
        }
        //name field validation
        function isValidName() {
            errors.length = 0;
            var x;
            var nameEmpty = new Boolean(false);
            var nameInvalid = new Boolean(false);

            let nameRegex = new RegExp('^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$');

            document.getElementById("errorEmptyName").style.display = "none";
            document.getElementById("errorName").style.display = "none";

            var x = document.getElementById("firstname").value;
            //push errors to array
            if (!x.length) {
                nameEmpty = true;
            }
            else if (!nameRegex.test(x)) {
                nameInvalid = true;
            }
            if (nameEmpty == true) {
                document.getElementById("errorEmptyName").style.display = "block";
                errors.push("errorName");
            }
            if (nameInvalid == true) {
                document.getElementById("errorName").style.display = "block";
                errors.push("errorName");
            }
        }
        //name field validation
        function isValidNameLast() {
            errors.length = 0;
            var x;
            var nameEmpty = new Boolean(false);
            var nameInvalid = new Boolean(false);

            let nameRegex = new RegExp('^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$');

            document.getElementById("errorEmptyNameLast").style.display = "none";
            document.getElementById("errorNameLast").style.display = "none";

            var x = document.getElementById("lastname").value;
            //push errors to array
            if (!x.length) {
                nameEmpty = true;
            }
            else {
                if (!nameRegex.test(x)) {
                    nameInvalid = true;
                }
            }
            if (nameEmpty == true) {
                document.getElementById("errorEmptyNameLast").style.display = "block";
                errors.push("errorNameLast");
            }
            if (nameInvalid == true) {
                document.getElementById("errorNameLast").style.display = "block";
                errors.push("errorNameLast");
            }
        }
        //phone field validation
        function isValidPhone() {
            errors.length = 0;
            var x;
            var phoneEmpty = new Boolean(false);
            var phoneInvalid = new Boolean(false);
            let phoneRegex = new RegExp('[0-9]');

            document.getElementById("errorEmptyPhone").style.display = "none";
            document.getElementById("errorPhone").style.display = "none";

            var x = document.getElementById("phone").value;
            if (!x.length) {
                phoneEmpty = true;
            }
            else {
                if (!phoneRegex.test(x)) {
                    phoneInvalid = true;
                }
            }
            if (phoneEmpty == true) {
                document.getElementById("errorEmptyPhone").style.display = "block";
                errors.push("errorPhone");
            }
            if (phoneInvalid == true) {
                document.getElementById("errorPhone").style.display = "block";
                errors.push("errorPhone");
            }
        }
        //student number field validation
        function isValidStudentNumb() {
            errors.length = 0;
            var x;
            var numbEmpty = new Boolean(false);
            var numbInvalid = new Boolean(false);
            let numbRegex = new RegExp('[0-9]');

            document.getElementById("errorEmptyStudent").style.display = "none";
            document.getElementById("errorStudent").style.display = "none";

            var x = document.getElementById("studentNumb").value;
            if (!x.length) {
                numbEmpty = true;
            }
            else {
                if (!numbRegex.test(x)) {
                    numbInvalid = true;
                }
            }
            if (numbEmpty == true) {
                document.getElementById("errorEmptyStudent").style.display = "block";
                errors.push("errorStudent");
            }
            if (numbInvalid == true) {
                document.getElementById("errorStudent").style.display = "block";
                errors.push("errorStudent");
            }
        }
        function isValidEmail() {
            errors.length = 0;
            var x;
            var numbEmpty = new Boolean(false);
            var numbInvalid = new Boolean(false);
            let mailRegex = new RegExp(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);

            document.getElementById("errorEmptyEmail").style.display = "none";
            document.getElementById("errorEmail").style.display = "none";

            var x = document.getElementById("email").value;
            if (!x.length) {
                numbEmpty = true;
            }
            else {
                if (!mailRegex.test(x)) {
                    numbInvalid = true;
                }
            }
            if (numbEmpty == true) {
                document.getElementById("errorEmptyEmail").style.display = "block";
                errors.push("errorEmail");
            }
            if (numbInvalid == true) {
                document.getElementById("errorEmail").style.display = "block";
                errors.push("errorEmail");
            }
        }
        function isValidSchool() {
            errors.length = 0;
            var x;
            var nameEmpty = new Boolean(false);
            var nameInvalid = new Boolean(false);

            let nameRegex = new RegExp('^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$');

            document.getElementById("errorEmptySchool").style.display = "none";
            document.getElementById("errorSchool").style.display = "none";

            var x = document.getElementById("school").value;
            //push errors to array
            if (!x.length) {
                nameEmpty = true;
            }
            else if (!nameRegex.test(x)) {
                nameInvalid = true;
            }
            if (nameEmpty == true) {
                document.getElementById("errorEmptySchool").style.display = "block";
                errors.push("errorSchool");
            }
            if (nameInvalid == true) {
                document.getElementById("errorSchool").style.display = "block";
                errors.push("errorSchool");
            }
        }
        function showStudent() {
            document.getElementById("stuNumb").style.display = "block";
            document.getElementById("school").style.display = "none";
        }
        function hideStudent() {
            document.getElementById("stuNumb").style.display = "none";
            document.getElementById("school").style.display = "block";
        }
        //form validation 
        function validateForm() {
            if (errors.length) {
                return false
            } else {
                return true;
            }
        }
    </script>
</head>

<body onload="init()">
    <header>
    <?php
        if(isset($_SESSION['userId'])){
            echo '<p>logged in as: '.$_SESSION['userId'].'</p>'.
            '<form action="/logOut.php" class="form-container" method="POST">'.
            "<input id='thingy' type='hidden' name='thingValue' value='index'>".
            '<button type="submit" name="login" class="btn" style="width: 5%;color: #F4BD72";>Log Out</button>'.
            '</form>';
        }
    ?>
    </header>
    <div>
    <nav>
        <img src="img/nanLogo.png" class="img-fluid">
        <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="\viewPlayers.php">View Rosters</a></li>
        <li><a class="active" href="\contact.php">Contact</a></li>
        </ul>
    </nav>
    <div style="margin-left: 5%; background-color: lightsteelblue; padding-left: 2em; padding-top: 1em; margin-top: 1em; margin-right: 50%;">
    <h1>Development Team</h1>
    <br>
    <h3>Nathan Vieira</h3>
    <h3>Nvieira7481@conestogac.on.ca</h3>
    <br>
    <h3>Nick Parker</h3>
    <h3>NParker4257@conestogac.on.ca</h3>
    <br>
    <h3>Alex Cruickshank</h3>
    <h3>ACruickshank2710@conestogac.on.ca</h3>
    <br>
    </div>
</html>