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
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="\viewPlayers.php">View Rosters</a></li>
        <li ><a href="\contact.php">Contact</a></li>
        </ul>
        <div style="margin-left: 100px; width: 20em; display: inline-block; background: #393839; padding: 1em;">
            <?php
            if(!isset($_SESSION['userId'])){
                echo '<h4>Sign in</h4>'.
                    '<form action="/login.php" class="form-container" method="POST">'.
                    '<p id=logSuccess style="color: #4CAF50; float: none;"></p>'.
                    '<p id=logFail style="color: #af4c4c; float: none;"></p>'.
                    '<input type="text" placeholder="Enter Email" name="coachEmail" required>'.
                    '<input type="password" placeholder="Enter Password" name="coachPass" required>'.
                    '<button type="submit" name="login" class="btn" style="color: #F4BD72";>Login</button>'.
                    '</form>';
            }else{
                echo '<h4>Add Coach</h4>'.
                    '<form action="/addCoach.php" class="form-container" method="POST">'.
                    '<p id=coachMsgSuccess style="color: #4CAF50; float: none;"></p>'.
                    '<p id=coachMsgFail style="color: #af4c4c; float: none;"></p>'.
                    '<input type="text" placeholder="Enter Name" name="coachName" required>'.
                    '<input type="text" placeholder="Enter Email" name="coachEmail" required>'.
                    '<button type="submit" name="add" class="btn" style="color: #F4BD72; border: 1px solid #000;">Add</button>'.
                    '</form>';
            }
            ?>
        </div>
</nav>
</div>
<br>
<div class="row">
<div class="column2" style="background-color:#aaa;">
    <iframe src="https://player.twitch.tv/?video=947115184" frameborder="0" allowfullscreen="true" scrolling="no" height="780" width="330"></iframe>
</div>
<div class="column" style="background-color:#bbb; width: 50%;">
    <div class="contain">
        <div class="wrapper">
          <div class="form">
            <h3>NaN Recruitment</h3>
            <h5>Sign Up Now!</h5>
            <div id="second" >
                <h1>Registration Form</h1>
                <p id=insertSuccess style="color: #4CAF50; float: none; display: none;"></p>
                <p id="returnedError" name="returnedError" style="display: none; color: red;"></p>
                <form id="form" name="form" action="insert.php" method="POST" onsubmit="return validateForm()">
                    <label for="name">First Name*</label>
                    <br>
                    <input type="text" name="first_name" id="firstname" onblur="isValidName()" required>
                    <span class="errorName" id="errorName" style="display: none; color: red;">Please enter a valid name</span>
                    <span class="errorEmptyName" id="errorEmptyName" style="display: none; color: red;">Please enter your name</span>
                    <br>
                    <br>
                    <label for="name">Last Name*</label>
                    <br>
                    <input type="text" name="last_name" id="lastname" onblur="isValidNameLast()" required>
                    <span class="errorNameLast" id="errorNameLast" style="display: none; color: red;">Please enter a valid last name</span>
                    <span class="errorEmptyNameLast" id="errorEmptyNameLast" style="display: none; color: red;">Please enter your last name</span>
                    <br>
                    <br>
                    <label for="phone">Phone*</label>
                    <br>
                    <input type="text" name="phone_numb" id="phone" onblur="isValidPhone()" required>
                    <span class="errorPhone" id="errorPhone" style="display: none; color: red;">Please enter a valid phone number</span>
                    <span class="errorEmptyPhone" id="errorEmptyPhone" style="display: none; color: red;">Please enter your phone number</span>
                    <br>
                    <br>
                    <label for="email">Email*</label>
                    <br>
                    <input type="text" name="email" id="email" onblur="isValidEmail()" required>
                    <span class="errorEmail" id="errorEmail" style="display: none; color: red;">Please enter a valid email address</span>
                    <span class="errorEmptyEmail" id="errorEmptyEmail" style="display: none; color: red;">Please enter your email address</span>
                    <br>
                    <br>
                    
                    
                    <!-- <label for="school">School*</label>
                    <br>
                    <input type="text" name="school" id="school" onblur="isValidSchool()" required>
                    <span class="errorSchool" id="errorSchool" style="display: none; color: red;">Please enter a valid School Name</span>
                    <span class="errorEmptySchool" id="errorEmptySchool" style="display: none; color: red;">Please enter your School name</span>
                    <br>
                    <br> -->
                    <label for="student">Are you a Conestoga full time student?</label>
                    <br>
                    <input type="radio" name="student_status" value="yes" id="radioYes" onclick="showStudent()"> Yes
                    <br>
                    <input type="radio" name="student_status" value="no" id="radio" checked onclick="hideStudent()"> No
                    <br>
                    <div id="stuNumb" style="padding-top: 1em; display: none;">
                        <label for="studentNumber">Student Number</label>
                        <br>
                        <input type="text" name="student_numb" id="studentNumb" onblur="isValidStudentNumb()">
                        <span class="errorStudent" id="errorStudent" style="display: none; color: red;">Please enter a valid student number (0-9)</span>
                        <span class="errorEmptyStudent" id="errorEmptyStudent" style="display: none; color: red;">Please enter your student number</span>
                    </div>
                    <br>
                    <br>
                    <div id="school" style="padding-top: 1em; display: block;">
                    <label for="school">Select Your School*</label>
                    <?php
                    $resultSchool->data_seek(0);
                    echo "<select name='school' id='school' style='color: #393839;'>";
                    if ($resultSchool->num_rows > 0) {
                        while($rowSchool = $resultSchool->fetch_assoc()) {
                            $schoolId = $rowSchool['SchoolId'];
                            $schoolName = $rowSchool["SchoolName"];
                            echo "<option value=".$schoolId.">".$schoolName."</option>";
                        }
                    }
                    echo "</select>";
                    ?>
                      </div>
                    <br>
                    <br>
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div class="column3" style="background-color:#ccc;">
        <a class="twitter-timeline" data-height="780" href="https://twitter.com/CC_Condors?ref_src=twsrc%5Etfw" style="width: 600px;">     
        <br>
        <br>
        </a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</html>