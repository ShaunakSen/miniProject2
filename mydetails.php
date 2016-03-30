<?php

require_once("resources/config.php");
require_once("resources/functions.php");

function redirect_to($url)
{
    header('Location: ' . $url);
}

if (isset($_GET["user"]) && isset($_SESSION['email']) && (($_GET["user"]) == $_SESSION['email'])) {
    $email = $_GET['user'];
    $sql = "SELECT * FROM users_registered WHERE email='$email' LIMIT 1";
    $query = query($sql);
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
    $user_dept = $row['dept'];
    $user_gender = $row['gender'];
    $user_hobby = $row['hobby'];
    $user_active = $row['activated'];
    $user_image = $row['image'];
    $user_country = $row['country'];
    $user_state = $row['state'];
    if ($user_active === '2' || $_SESSION['type'] == 'admin') {
        $_SESSION['active'] = true;
    }
} else {
    redirect_to("index.php");
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <style>

        html, body {
            margin: 0;
            padding: 0;
        }

        .navbar {
            width: 90%;
            margin: auto;
            border-right: 0 solid #e7e7e7;
            border-left: 0 solid #e7e7e7;
            border-color: #e7e7e7;
            border-bottom: 0;
            min-height: 60px;
            background: #dfe3e8;
            margin-bottom: 50px;
        }

        .navbar a {
            color: #0083b3 !important;
            font-size: 20px;
            letter-spacing: -0.5px;
            padding-bottom: 24px !important;
            padding-top: 20px !important;
            transition: all 0.3s linear;
        }

        .navbar-inverse .navbar-nav > li > a:hover, .navbar-inverse .navbar-nav > li > a:focus {
            background: #0081ae;
            color: #fff !important;
        }

        .navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:hover, .navbar-inverse .navbar-nav > .active > a:focus {
            color: #fff !important;
            background-color: #0081ae;
        }

        .header {
            background-color: #0D807A;

            text-align: center;
            padding-top: 69px;
        }

        .welcome-message {
            font-family: "Droid Sans", sans-serif;
            color: #e5dee9;
            line-height: 369px;
            font-size: 31px;
        }

        .data-container {
            display: flex;

        }

        .email {
            flex: 1;
            height: 100px;
            background-color: cornflowerblue;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
            border-right: 1px solid #000000;
            border-top: 1px solid #000000;
        }

        .phone {
            flex: 1;
            height: 100px;
            background-color: cornflowerblue;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
            border-top: 1px solid #000000;
        }

        .dob {
            flex: 1;
            height: 100px;
            background-color: cornflowerblue;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
            border-right: 1px solid #000000;
        }

        .dept {
            flex: 1;
            height: 100px;
            background-color: cornflowerblue;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
        }

        .gender {
            flex: 1;
            height: 100px;
            background-color: cornflowerblue;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
            border-right: 1px solid #000000;
        }

        .hobby {
            flex: 1;
            height: 100px;
            background-color: cornflowerblue;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
        }

        .admin {
            width: 170px;
            height: 45px;
            line-height: 45px;
            font-family: "Ubuntu", Helvetica, Arial, sans-serif;
            font-weight: bold;
            color: #4d4d4f;
            background-color: #90D4E8;
            text-align: center;
            margin-left: 68px;
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            border: 0 !important;
        }

        .admin:hover {
            background-color: #99a3ca;
        }

        .edit-details-button {
            width: 170px;
            height: 45px;
            line-height: 45px;
            font-family: "Ubuntu", Helvetica, Arial, sans-serif;
            font-weight: bold;
            color: #4d4d4f;
            background-color: #7ee85e;
            text-align: center;
            margin-left: 68px;
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            border: 0 !important;
        }

        .edit-details-button:hover {
            background-color: #68c852;
        }

        #profile-pic {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            border:10px solid #d1d1d1;
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
                    <?php
                    if ($_SESSION['type'] == "admin") {
                        echo '<li><a href="admin.php">Admin</a></li>';
                    }
                    ?>
                </ul>
                <ul class="nav navbar-nav navbar-sub pull-right">
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo '<li><a href="logout.php">Logout</a></li>';
                    } else {

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

<div class="row header">
    <div class="col-sm-2"></div>
    <div class="col-sm-4"><img id="profile-pic" width="300" height="300" src="<?php echo $user_image; ?>"></div>
    <div class="col-sm-4 welcome-message">Welcome <?php echo $user_first_name . " " . $user_last_name; ?></div>
    <div class="col-sm-2"></div>
</div>
<div class="data-container">
    <div class="email"><span
                style="margin-left: 40px; color: #3f3f46; font-size: 18px;">Email id:  </span><?php echo $user_email; ?></div>
    <div class="phone"><span
            style="margin-left: 40px; color: #3f3f46; font-size: 18px;">Phone no:  </span><?php echo $user_phone; ?></div>
</div>
<div class="data-container">
    <div class="dob"><span
            style="margin-left: 40px; color: #3f3f46; font-size: 18px;">Date of Birth:  </span><?php echo $user_dob; ?>
    </div>
    <div class="dept"><span
            style="margin-left: 40px; color: #3f3f46; font-size: 18px;">Department:  </span><?php echo $user_dept; ?></div>
</div>
<div class="data-container">
    <div class="gender"><span
            style="margin-left: 40px; color: #3f3f46; font-size: 18px;">Gender:  </span><?php echo $user_gender; ?></div>
    <div class="hobby"><span
            style="margin-left: 40px; color: #3f3f46; font-size: 18px;">Hobbies:  </span><?php echo $user_hobby; ?></div>
</div>
<div class="data-container">
    <div class="gender"><span
            style="margin-left: 40px; color: #3f3f46; font-size: 18px;">Country:  </span><?php echo $user_country; ?></div>
    <div class="hobby"><span
            style="margin-left: 40px; color: #3f3f46; font-size: 18px;">State:  </span><?php echo $user_state; ?></div>
</div>
<br><br>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-4">

            <?php
            if ($_SESSION['type'] == "admin") {
                echo '<div class="admin"><a href="admin.php" class="admin-panel-button">Admin Panel</a><br></div></div>';
                echo '<div class="col-sm-4"><div class="edit-details-button"><a href="edit_details.php?user=' . $_GET['user'] . '">Edit Details</a></div></div>';
            } else if ((isset($_SESSION['active'])) && ($_SESSION['active'] === true)) {
                //user has been activated by admin .. give him privileges
                echo '<div class="col-sm-4"><div class="edit-details-button"><a href="edit_details.php?user=' . $_GET['user'] . '">Edit Details</a></div></div>';
            }
            ?>
        </div>
            <br><br>
        <div class="col-sm-2"></div>

    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>