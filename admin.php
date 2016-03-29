<?php

require_once("resources/config.php");
require_once("resources/functions.php");

function redirect_to($url)
{
    header('Location: ' . $url);
}

?>
<!DOCTYPE html>
<html>
<head lang="en">
    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/signup.css"/>
    <meta charset="UTF-8">
    <title></title>
    <style>

        html, body {
            margin: 0;
            padding: 0;
        }

        a:link {
            text-decoration: none;
            color: #ffffff;
        }

        a:visited {
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
            color: inherit;

        }

        a:active {
            text-decoration: none;
        }

        .header {
            background-color: cornflowerblue;
            width: 100%;
            height: 50px;
            text-align: center;
            font-family: "Droid Sans", sans-serif;
            line-height: 50px;
        }

        .data-container {
            display: flex;
        }

        .email {
            flex: 1;
            height: 100px;
            background-color: tomato;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
        }

        .phone {
            flex: 1;
            height: 100px;
            background-color: violet;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
        }

        .dob {
            flex: 1;
            height: 100px;
            background-color: sandybrown;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
        }

        .dept {
            flex: 1;
            height: 100px;
            background-color: mediumturquoise;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
        }

        .gender {
            flex: 1;
            height: 100px;
            background-color: palegreen;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
        }

        .hobby {
            flex: 1;
            height: 100px;
            background-color: slateblue;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
        }

        .admin {
            flex: 1;
            height: 100px;
            background-color: #a0cd9c;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
        }

        .details {
            width: 500px;
            height: auto;
            padding: 20px;
            margin: 20px;
            text-align: justify;
            font-family: "Droid Sans", Helvetica, Arial, sans-serif;
            letter-spacing: 1px;
            background-color: #8fc7cc;
            line-height: 35px;
        }

        .activate {
            display: inline-block;
            margin-left: 10px;
            width: 120px;
            height: 50px;
            line-height: 50px;
            background-color: #00b159;
            text-align: center;
            cursor: pointer;
        }
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
                    <li><a href="about.html">About</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-sub pull-right">
                    <?
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
<br><br><br><br>
<?php
if ((isset($_SESSION['email'])) && ($_SESSION['type'] == "admin")) {
    $sql = "SELECT * FROM users_registered WHERE type='normal' AND activated='1'";
    $query = query($sql);
    confirm($query);
    if (mysqli_num_rows($query) > 0) {
        while ($row2 = $query->fetch_assoc()) {
            echo '<div class="details">Name: ' . $row2['first_name'] . ' ' . $row2['last_name'] . '<br> Email: ' .
                $row2['email'] . '<br>Phone Number: ' . $row2['phone_number'] . '<br>Roll Number: ' . $row2['roll_no'] . '<br>Date of Birth: ' .
                $row2['dob'] . '<br>Dept: ' . $row2['dept'] . '<br>Gender: ' . $row2['gender'] . '<br>Hobbies: ' . $row2['hobby'] .
                '<div class="activate">' . '<a href="activation_from_admin.php?user=' . $row2['email'] . '">' . 'Activate User</a></div>' . '</div>';;
        }
    }
} else {
    redirect_to("index.php");
}
?>
</body>
</html>