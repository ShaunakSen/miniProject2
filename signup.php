<?php
require_once("resources/config.php");
require_once("resources/functions.php");

function redirect_to($url)
{
    header('Location: ' . $url);
}

if (isset($_SESSION["email"])) {
    redirect_to("index.php");
    exit();
}

if (isset($_FILES['file']['tmp_name'])) {
    if (0 < $_FILES['file']['error']) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    } else {
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $image = $_FILES['file']['name'];
        $sql = "SELECT MAX(id) AS id FROM users_registered";
        $query = query($sql);
        confirm($query);
        $row = mysqli_fetch_assoc($query);
        $max_id = $row['id'];
        $sql2 = "UPDATE users_registered SET image='$image' WHERE id='$max_id'";
        $query = query($sql2);
        confirm($query);
    }
}

if (isset($_POST['e'])) {

    $first_name = escape_string($_POST['fn']);
    $last_name = escape_string($_POST['ln']);
    $email = escape_string($_POST['e']);
    $roll = escape_string($_POST['r']);
    $phone = escape_string($_POST['pn']);
    $pass = escape_string($_POST['p']);
    $dob = escape_string($_POST['dob']);
    $dept = escape_string($_POST['dep']);
    $gender = escape_string($_POST['gen']);
    $hobby = escape_string($_POST['hobby']);
    $country = escape_string($_POST['country']);
    $state = escape_string($_POST['state']);
    $query = query("SELECT * FROM users_registered WHERE email='$email' LIMIT 1");
    confirm($query);
    $already_registered_check = mysqli_num_rows($query);
    if ($email == "" || $pass == "" || $first_name == "" || $roll == "" || $dob == "" || $dept == "" || $gender == "") {
        echo "The form submission is missing values.";
        exit();

    } else if ($already_registered_check > 0) {
        echo "You have already registered in our site. Please proceed to Log In Page";
        exit();
    } else if (strlen($pass) <= 7) {
        echo "your password is too short";
        exit();

    } else {


        // END FORM DATA ERROR HANDLING
        // Begin Insertion of data into the database
        // Hash the password and apply your own mysterious unique salt

        $p_hash = md5($pass);
        // Add user info into the database table for the main site table
        $req_id = get_id();
        $sql = "INSERT INTO users_registered(first_name,last_name,email,phone_number,roll_no,dob,dept,gender,hobby,country,state,password) VALUES ('$first_name','$last_name','$email','$phone','$roll','$dob','$dept','$gender','$hobby','$country','$state','$p_hash')";
        $query = query($sql);
        confirm($query);
        $uid = get_id();
        echo '<a href="activation.php?id=' . $uid . '&e=' . $email . '&p=' . $p_hash . '">Click here </a>';
        /*
        $to = "$e";
        $from = "it";
        $subject = 'it Activation';
        $message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>
                    Hall 2 Mess System Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;">
                    <div style="padding:10px; background:#333; font-size:24px; color:#CCC;">
                    <a style="color: #c3c0b9; text-decoration: none" href="http://hall2mess.esy.es">
                    Hall 2 Online Mess System Account Information</a></div>
                    <div style="padding:24px; font-size:17px;">Hello ' . $u . ',<br /><br />
                    Click the link below to activate your account when ready:<br /><br />
                    <a href="http://hall2mess.esy.es/activation?id=' . $uid .  '&e=' . $e . '&p=' . $p_hash . '">Click here to activate your account now</a>
                    <br /><br />Login after successful activation using your:<br />* E-mail Address: <b>' . $e . '</b></div></body></html>';
        $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        mail($to, $subject, $message, $headers);
        */
        echo "signup_success";
        exit();
    }
}

?>
<?php


if (isset($_POST["emailcheck"])) {
    $email = escape_string($_POST['emailcheck']);
    $query = query("SELECT * FROM users_registered WHERE email='$email' LIMIT 1");
    confirm($query);

    $email_check = mysqli_num_rows($query);
    if ($email_check == 1) {
        echo '<span style="color: #b42a11">You are already registered in This Site. Log in <a href="#" style="color: #122b40">Here</a></span>';
        exit();
    } else {
        echo '<span style="color: #59ca54">' . $email . ' is Ok</span>';
        exit();
    }
}




?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>

    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/signup.css">
    <script>

        $('input[type="checkbox"]').bind('click', function () {
            if ($(this).is(':checked')) {
                console.log($(this).val());
            }
        });
        var error = false;
        function restrict(elem) {
            var tf = _(elem);
            var rx = new RegExp;
            if (elem == "email") {
                rx = /[' "]/gi;
            }

            else if (elem == "firstname") {
                rx = /[^a-z]/gi;
            }
            else if (elem == "lastname") {
                rx = /[^a-z]/gi;
            }

            else if (elem == "phone") {
                rx = /[^0-9]/gi;
            }
            else if (elem == "roll") {
                rx = /[^0-9A-Z/]/gi;
            }


            tf.value = tf.value.replace(rx, "");
        }

        function emptyElement(x) {
            _(x).innerHTML = "";
        }

        function validate_number_length() {
            var phone = _('phone').value;
            var phone_length = phone.length;
            var x = _('phone_length_status');
            if (phone_length >= 1 && phone_length != 10) {
                x.innerHTML = "<span style='color:#871821; font-family: 'Droid Sans', Helvetica, Arial, sans-serif'>Enter a 10 digit mobile number</span>";
            }
            else {
                x.innerHTML = "";
                stupid("phone");
            }
        }

        function run() {
            var department = $('#dept').val();
            var yearOfAdmission = $('#year').val();
            if (department != "" && yearOfAdmission != "") {
                var yearInRoll = yearOfAdmission.substr(2, 2);
                var rollSoFar = yearInRoll + "/" + department + "/";
                $('#roll').val(rollSoFar);
            }
            else {
                $('#roll').val("");
            }
            stupid("dept");
            stupid('year');
        }
        function daysInMonth(month, year) {
            return new Date(year, month, 0).getDate();
        }


        function calculateDOB() {
            var DOB = _('date').value;
            var enteredYear = DOB.substr(0, 4);
            var enteredMonth = DOB.substr(5, 2);
            var enteredDay = DOB.substr(8, 2);
            console.log("entered month: " + enteredMonth);
            console.log("entered day: " + enteredDay);
            var d = new Date();
            var year = d.getFullYear();
            var month = d.getMonth();
            var day = d.getDate();
            console.log("day: " + day);
            month++;
            console.log("month: " + month);
            var finalDay;
            var finalYear = year - enteredYear;
            var finalMonth = month - enteredMonth;
            if ((enteredMonth > month) && enteredDay > day) {
                finalYear -= 1;
                finalMonth = 12 - (enteredMonth - month) - 1;
                var daysInPrevMonth = daysInMonth((month - 1), year);
                finalDay = (daysInPrevMonth - enteredDay) + day;
            }
            else if ((enteredMonth > month) && enteredDay <= day) {
                finalYear -= 1;
                finalMonth = 12 - (enteredMonth - month);
                finalDay = day - enteredDay;
            }
            else if ((enteredMonth < month) && (enteredDay > day)) {

                finalMonth = month - enteredMonth - 1;
                var daysInPrevMonth = daysInMonth((month - 1), year);
                finalDay = (daysInPrevMonth - enteredDay) + day;

            }

            else if ((enteredMonth < month) && (enteredDay <= day)) {
                console.log("here");
                finalMonth = month - enteredMonth;

                finalDay = day - enteredDay;

            }

            _('age_calculated').innerHTML = "Your age is " + finalYear + "years and " + finalMonth + " months " + finalDay + " days";
            stupid('date');
        }

        function addHobby() {
            $('#add-hobby').css('display', 'none');
            $('#hobbies').append('<input type="text" class="input" name="hobby" id="added-hobby" placeholder="Add Hobby">');
            $('#hobbies').append('<button type="submit" onclick="addHobbyFinal()">Submit</button>');
        }
        function addHobbyFinal() {
            var hobby = $('#added-hobby').val();

            $("#demo").append('<input type="checkbox" name="hobby[]" class="hobby" value="' + hobby + '"><span style="color: #D0D0D0;font-size: 19px;position: relative;bottom: 5px;font-family: Ubuntu, sans-serif;font-weight: 200;">' + hobby + '</span><br>');

        }

        function confirmPassword() {
            var pass1 = _('password').value;
            var pass2 = _('password2').value;
            if ((pass1 != pass2) && (pass1 != "") && (pass2 != "")) {
                _("password-status").innerHTML = "<span style='color: #802928; font-family: 'Droid Sans', Helvetica, Arial, sans-serif'>Passwords do not match</span>";
            }
            else {
                stupid("password2");
            }
        }

        function checkEmail() {
            var e = _("email").value;
            if (e != "") {
                _("emailstatus").innerHTML = 'checking ...';
                var ajax = ajaxObj("POST", "signup.php");
                ajax.onreadystatechange = function () {
                    if (ajaxReturn(ajax) == true) {
                        _("emailstatus").innerHTML = ajax.responseText;
                        stupid('email');
                    }

                }
                ajax.send("emailcheck=" + e);
            }

        }

        function signup() {
            var fn = _("firstname").value;
            var ln = _("lastname").value;
            var e = _("email").value;
            var r = _("roll").value
            var p = _("phone").value;
            var p1 = _("password").value;
            var p2 = _("password2").value;
            var dob = _("date").value;
            var dept = $("#dept").val();
            var phone_length = p.length;
            var checkedValue = "";
            var country = _('slct1').value;
            var state = _('slct2').value;
            var inputElements = document.getElementsByClassName('hobby');
            for (var i = 0; inputElements[i]; ++i) {
                if (inputElements[i].checked) {
                    checkedValue += inputElements[i].value;
                    checkedValue += ":";
                }
            }

            var file_data = $('#sortpicture').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            alert(form_data);
            $.ajax({
                url: 'signup.php', // point to server-side PHP script
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (php_script_response) {
                    alert(php_script_response); // display response from the PHP script, if any
                }
            });


            if (document.getElementById('male').checked) {
                var gender = document.getElementById('male').value;
            }
            else
                var gender = document.getElementById('female').value;
            var status = _("status").value;
            if (e == "" || p1 == "" || p2 == "" || fn == "" || ln == "" || r == "" || dob == "" || dept == "" || country=="" || state=="") {
                _("status").innerHTML = "Please fill out all of the form data";
            }
            else if (p1 != p2) {
                _("status").innerHTML = "Your password fields do not match";
            }

            else if (phone_length > 1 && phone_length != 10) {
                _('status').innerHTML = "Enter a 10 digit mobile number";
            }


            else {
                // all ok
                _("submit").style.display = "none";
                _("status").innerHTML = "please wait";
                var ajax = ajaxObj("POST", "signup.php");
                ajax.onreadystatechange = function () {
                    if (ajaxReturn(ajax) == true) {
                        if (ajax.responseText != "signup_success") {
                            _("status").innerHTML = ajax.responseText;
                            _("submit").style.display = "block";
                        }
                        else {
                            _("status").innerHTML = "Ok.. please check ur inbox for the link";
                            _("submit").style.display = "none";
                        }
                    }
                }
                ajax.send("fn=" + fn + "&ln=" + ln + "&e=" + e + "&pn=" + p + "&r=" + r + "&p=" + p1 + "&dob=" + dob + "&dep=" + dept + "&gen=" + gender + "&hobby=" + checkedValue + "&country=" + country + "&state=" + state);
            }


        }

        function stupid(passedId) {


            var myId = ["firstname", "lastname", "email", "phone", "dept", "year", "roll", "date", "sortpicture", "password", "password2", "submit"];
            for (var i = 0; i < myId.length; ++i) {
                if (myId[i] == passedId)
                    break;
            }
            var nextId = myId[i + 1];

            if ((error == false) && _(passedId).value != "")
                document.getElementById(nextId).disabled = false;


        }

        function populate(s1,s2)
        {
            var s1 = document.getElementById(s1);
            var s2 = document.getElementById(s2);
            s2.innerHTML = "";
            if(s1.value=="india")
            {
                var optionArray = ["wb|wb","up|up","rajasthan|rajasthan","maharashtra|maharashtra"];
            }
            else if(s1.value == "usa"){
                var optionArray = ["california|california","florida|florida","texas|texas"];
            }
            else if(s1.value == "uk"){
                var optionArray = ["scotland|scotland","wales|wales"];
            }

            for(var option in optionArray)
            {
                var pair = optionArray[option].split("|");
                var newOption = document.createElement('option');
                newOption.value = pair[0];
                newOption.innerHTML = pair[1];
                s2.options.add(newOption);
            }
        }




    </script>
    <style type="text/css">

    </style>
</head>
<body>

<header class="header-main">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container2">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">NIT Durgapur</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-sub pull-right">
                    <?php
                    if(isset($_SESSION['email'])) {
                        echo '<li><a href="logout.php">Logout</a></li>';
                    }
                    else {

                        echo '<li><a href="signup.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
</header>
<div class="container">
    <form name="sign up form" action="signup.php" onsubmit="return false;" class="myForm">
        <br><br><br>

        <div class="header">
            <br>
            Sign Up
        </div>
        <br><br>

        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <div class="caption">Enter First Name Here</div>
                <input type="text" class="input" id="firstname" name="firstname" onkeyup="restrict('firstname')"
                       placeholder="First Name" onblur="stupid('firstname')">
                <br><br>
            </div>
            <div class="col-sm-4">
                <div class="caption">Enter Last Name Here</div>
                <input type="text" class="input" id="lastname" name="lastname" onkeyup="restrict('lastname')"
                       placeholder="Last Name" disabled onblur="stupid('lastname')">
            </div>
            <div class="col-sm-2"></div>
        </div>
        <br><br>

        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <div class="caption">Enter Your Email Id Here</div>
                <input type="email" class="input" id="email" name="email" onkeyup="restrict('email')"
                       onblur="checkEmail()"
                       placeholder="Email Id" disabled>
                <br>

                <div id="emailstatus"></div>
                <br>
            </div>
            <div class="col-sm-4">
                <div class="caption">Enter Your Phone Number Here</div>
                <input type="tel" class="input" id="phone" name="email" onkeyup="restrict('phone')"
                       onblur="validate_number_length()" placeholder="Phone Number" disabled>
                <br>
                <br>

                <div id="phone_length_status"></div>
                <br>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <div class="caption">Select Your Department Code</div>
                <select name="select" id="dept" class="department" onblur="run()" disabled>
                    <option value="">Select your Department</option>
                    <option value="BT">BT</option>
                    <option value="CE">CE</option>
                    <option value="CH">CH</option>
                    <option value="EC">EC</option>
                    <option value="EE">EE</option>
                    <option value="IT">IT</option>
                    <option value="ME">ME</option>
                    <option value="MME">MME</option>
                </select>
                <br><br>
            </div>
            <div class="col-sm-4">
                <div class="caption">Enter Your Year of Admission</div>
                <input type="number" id="year" disabled class="admission-year" name="year" min="2011" max="2015"
                       onblur="run()">
                <br><br>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <div class="caption">Enter Your Roll Number</div>
                <input type="text" class="input" id="roll" name="rollno" onblur="stupid('roll')" disabled>
                <br><br>
            </div>
            <div class="col-sm-4">
                <div class="caption">Enter Your Birth Date</div>
                <input type="date" class="date" id="date" name="date" onblur="calculateDOB()" disabled>
                <br><br>

                <div id="age_calculated">Your calculated age shows here</div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <div class="caption">Please Upload Your Profile Picture</div>
                <input type="file" name="pic" class="upload" id="sortpicture" accept="image/*" disabled
                       onblur="stupid('sortpicture')">
                <br>

                <div class="caption">Select Your Gender<br></div>
                <input type="radio" name="gender" class="gender" value="male" id="male" selected> <span
                    style="color: #D0D0D0;font-size: 19px;position: relative;bottom: 5px;font-family: Ubuntu, sans-serif;font-weight: 200;">Male</span><br>
                <input type="radio" name="gender" class="gender" value="female" id="female"><span
                    style="color: #D0D0D0;font-size: 19px;position: relative;bottom: 5px;font-family: Ubuntu, sans-serif;font-weight: 200;">Female</span><br>

                <img id="blah" style="display: none" src="#" alt="image" width="200" height="100">
            </div>
            <div class="col-sm-4">
                <div class="caption">Select Your Hobbies</div>
                <div id="hobbies">
                    <input type="checkbox" name="hobby[]" class="hobby" value="reading novels"><span
                        style="color: #D0D0D0;font-size: 19px;position: relative;bottom: 5px;font-family: Ubuntu, sans-serif;font-weight: 200;">Reading Novels</span><br>
                    <input type="checkbox" name="hobby[]" class="hobby" value="playing cricket"><span
                        style="color: #D0D0D0;font-size: 19px;position: relative;bottom: 5px;font-family: Ubuntu, sans-serif;font-weight: 200;">Playing Cricket</span><br>
                    <input type="checkbox" name="hobby[]" class="hobby" value="playing music"><span
                        style="color: #D0D0D0;font-size: 19px;position: relative;bottom: 5px;font-family: Ubuntu, sans-serif;font-weight: 200;">Playing Music</span><br>
                    <input type="checkbox" name="hobby[]" class="hobby" value="hanging out with friends"><span
                        style="color: #D0D0D0;font-size: 19px;position: relative;bottom: 5px;font-family: Ubuntu, sans-serif;font-weight: 200;">Hanging out with friends</span><br>

                    <div id="demo"></div>
                    <br><br>
                </div>
                <div id="add-hobby" onclick="addHobby()">Add a Hobby</div>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <div class="caption">chose country:</div>
                <select class="input" id="slct1" name="slct1" onchange="populate(this.id,'slct2')">
                    <option value=""></option>
                    <option value="india">India</option>
                    <option value="usa">USA</option>
                    <option value="uk">UK</option>
                </select>
            </div>
            <div class="col-sm-4">
                <div class="caption">Choose State</div>
                <select id="slct2" name="slct2" class="input">
                </select>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <div class="caption">Enter Password</div>
                <input type="password" class="input" id="password" name="password" placeholder="Enter Password" disabled
                       onblur="stupid('password')">
            </div>
            <div class="col-sm-4">
                <div class="caption">Confirm Password</div>
                <input type="password" class="input" id="password2" name="password" onblur="confirmPassword()"
                       onfocus="emptyElement('password-status')" placeholder="Enter Password" disabled>
                <br>

                <div id="password-status"></div>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <br><br>

        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <div class="submit" id="submit" onclick="signup()">Submit</div>
            </div>

            <div class="col-sm-4">
                <input type="reset" value="Reset" class="submit">
            </div>
            <div class="col-sm-2"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div id="status"></div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </form>
    <br><br>
</div>

</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
                $('#blah').css('display', 'block');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#sortpicture").change(function () {
        readURL(this);
    });

    var myId = ["firstname", "lastname", "email", "phone", "dept", "year", "roll", "date", "sortpicture", "password", "password2", "submit"];



</script>
</body>
</html>