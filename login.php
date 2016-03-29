<?php
require_once("resources/config.php");
require_once("resources/functions.php");

function redirect_to($url)
{
    header('Location: ' . $url);
}


?>
<?php
if (isset($_SESSION["email"])) {
    redirect_to("index.php");
    exit();
}

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


if (isset($_POST["e"])) {
    $e = escape_string($_POST['e']);
    $p = md5($_POST['p']);
    if ($e == "" || $p == "") {
        echo "login_failed";
        exit();
    } else {
        $query = query("SELECT * FROM users_registered WHERE email='$e' AND activated !='0' LIMIT 1");
        confirm($query);
        $user_check = mysqli_num_rows($query);
        $row = fetch_array($query);
        $user_id = $row['id'];
        $user_first_name = $row['first_name'];
        $user_last_name = $row['last_name'];
        $user_email = $row['email'];
        $user_type = $row['type'];
        $user_password = $row['password'];
        $user_roll = $row['roll_no'];
        $user_phone = $row['phone_number'];
        $user_dob = $row['dob'];
        $user_gender = $row['gender'];
        $user_hobby = $row['hobby'];
        if ($p != $user_password) {
            echo "login_failed";
            exit();
        } else {
            $_SESSION['user_id'] = $user_id;
            $_SESSION["first_name"] = $user_first_name;
            $_SESSION["first_name"] = $user_last_name;
            $_SESSION['email'] = $user_email;
            $_SESSION['type'] = $user_type;
            $_SESSION['roll_no'] = $user_roll;
            $_SESSION['phone_number'] = $user_phone;
            $_SESSION['dob'] = $user_dob;
            $_SESSION['gender'] = $user_gender;
            $_SESSION['hobby'] = $user_hobby;
            echo $_SESSION['email'];
            exit();

        }


    }

}


if (isset($_POST["e1"])) {
    $e = escape_string($_POST['e1']);
    $p = md5($_POST['p1']);
    if ($e == "" || $p == "") {
        echo "login_failed";
        exit();
    } else {
        $query = query("SELECT * FROM users_registered WHERE email='$e' AND activated !='0' AND type='admin' LIMIT 1");
        confirm($query);
        $user_check = mysqli_num_rows($query);
        $row = fetch_array($query);
        $user_id = $row['id'];
        $user_first_name = $row['first_name'];
        $user_last_name = $row['last_name'];
        $user_email = $row['email'];
        $user_type = $row['type'];
        $user_password = $row['password'];
        $user_roll = $row['roll_no'];
        $user_phone = $row['phone_number'];
        $user_dob = $row['dob'];
        $user_gender = $row['gender'];
        $user_hobby = $row['hobby'];
        if ($p != $user_password) {
            echo "login_failed";
            exit();
        } else {
            $_SESSION['user_id'] = $user_id;
            $_SESSION["first_name"] = $user_first_name;
            $_SESSION["first_name"] = $user_last_name;
            $_SESSION['email'] = $user_email;
            $_SESSION['type'] = $user_type;
            $_SESSION['roll_no'] = $user_roll;
            $_SESSION['phone_number'] = $user_phone;
            $_SESSION['dob'] = $user_dob;
            $_SESSION['gender'] = $user_gender;
            $_SESSION['hobby'] = $user_hobby;
            echo $_SESSION['email'];
            exit();

        }


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
    <script src="js/jquery.min.js"></script
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


        function login() {
            var e = _("email").value;
            var p = _("password").value;
            if (e == "" || p == "") {
                _("status").innerHTML = "Plz fill out the form data";
            }
            else {
                _("submit").style.display = "none";
                _("status").innerHTML = "plz wait...";
                var ajax = ajaxObj("POST", "login.php");
                ajax.onreadystatechange = function () {
                    if (ajaxReturn(ajax) == true) {
                        console.log(ajax.responseText);


                        if (ajax.responseText.trim() == "login_failed") {
                            _("status").innerHTML = "Login Unsuccessful.. Please try again";
                            _("submit").style.display = "block";

                        }
                        else {

                            window.location = "mydetails.php?user=" + ajax.responseText;
                            console.log(ajax.responseText);
                        }


                    }
                }
                ajax.send("e=" + e + "&p=" + p);
            }
        }

        function admin_login() {
            var e1 = _("email").value;
            var p1 = _("password").value;
            if (e1 == "" || p1 == "") {
                _("status").innerHTML = "Plz fill out the form data";
            }
            else {
                _("submit").style.display = "none";
                _("status").innerHTML = "plz wait...";
                var ajax = ajaxObj("POST", "login.php");
                ajax.onreadystatechange = function () {
                    if (ajaxReturn(ajax) == true) {
                        console.log(ajax.responseText);


                        if (ajax.responseText.trim() == "login_failed") {
                            _("status").innerHTML = "Login Unsuccessful.. Please try again";
                            _("submit").style.display = "block";

                        }
                        else {

                            window.location = "mydetails.php?user=" + ajax.responseText;
                            console.log(ajax.responseText);
                        }


                    }
                }
                ajax.send("e1=" + e1 + "&p1=" + p1);
            }
        }


    </script>
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
                    <li class="active"><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-sub pull-right">
                    <li><a href="signup.php">Register</a></li>
                    <li><a href="">Login</a></li>
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
            Log In
        </div>
        <br><br>

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4 student selected">Student Login</div>
            <div class="col-md-4 admin">Admin Login</div>
            <div class="col-md-2"></div>
        </div>
        <br>

        <div id="loaded-content">
            <div class="row">
                <div class="col-sm-5"></div>
                <div class="col-sm-3">
                    <div class="caption">Enter Your Email Id Here</div>
                    <input type="email" class="input" id="email" name="email" onkeyup="restrict('email')"
                           placeholder="Email Id">
                    <br>

                    <div id="emailstatus"></div>
                </div>
                <div class="col-sm-4"></div>
            </div>
            <br>

            <div class="row">
                <div class="col-sm-5"></div>
                <div class="col-sm-3">
                    <div class="caption">Enter Password</div>
                    <input type="password" class="input" id="password" name="password" placeholder="Enter Password">
                    <br><br><br>
                    <button class="submit" id="submit" onclick="login()">Submit</button>
                    <br><br>

                    <div id="status"></div>
                    <br><br><br><br><br><br><br><br><br><br>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </form>
</div>
<script>
    $('.student').on('click', function (e) {
        e.preventDefault();
        var $load = $('#loaded-content');
        $load.hide();
        $load.load('fragments/student.html', function () {
            $('.student').addClass('selected');
            $('.admin').removeClass('selected');
        }).fadeIn('slow');
    });

    $('.admin').on('click', function (e) {
        e.preventDefault();
        var $load = $('#loaded-content');
        $load.hide();
        $load.load('fragments/admin.html', function () {
            $('.admin').addClass('selected');
            $('.student').removeClass('selected');
        }).fadeIn('slow');
    });

    $('.student').on('click', function (e) {
        e.preventDefault();
        var $load = $('#loaded-content');
        //$load.hide();
        $load.load('fragments/student.html', function () {
            $('.student').addClass('selected');
            $('.admin').removeClass('selected');
        }).fadeIn('slow');
    });

    $('.admin').on('click', function (e) {
        e.preventDefault();
        var $load = $('#loaded-content');
        //$load.hide();
        $load.load('fragments/admin.html', function () {
            $('.admin').addClass('selected');
            $('.student').removeClass('selected');
        }).fadeIn('slow');
    });
</script>
</body>
</html>