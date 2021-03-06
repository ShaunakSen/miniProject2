<?php

/*require_once("resources/config.php");
require_once("resources/functions.php");

function redirect_to($url)
{
    header('Location: ' . $url);
}
if(isset($_GET["user"]) && isset($_SESSION['email']) &&(($_GET["user"])==$_SESSION['email']))
{
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
    $user_dept=$row['dept'];
    $user_gender = $row['gender'];
    $user_hobby = $row['hobby'];
    $user_active = $row['activated'];
    if($user_active === '2' || $_SESSION['type'] == 'admin')
    {
        $_SESSION['active']=true;
    }
}
else
{
    redirect_to("index.php");
}
*/
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/mydetails.css"/>
    <style>

        html, body {
            margin: 0;
            padding: 0;
            background-color: rgba(128,222,234,0.48);

        }

        .header {
            background-color: rgba(66, 39, 176, 0.58);
            width: 100%;
            height: 114px;
            text-align: center;
            font-family: "Droid Sans", sans-serif;
            line-height: 140px;
            color:rgba(66, 39, 176, 0.78);
            font-size: 19px;
            font-weight:bold;
            border:5px solid rgba(66, 39, 176, 0.78);

        }

        .data-container {
            display: flex;

        }

        .email {
            flex: 1;
            height: 100px;
            background-color: rgba(100, 180, 237, 0.78);
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
            border-right: 1px solid #000000;
            border-top: 1px solid #000000;
             border:2px solid #3F51B5;
             font-weight: bold;

        }

        .phone {
            flex: 1;
            height: 100px;
            background-color: rgba(100, 180, 237, 0.78);
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
            border-top: 1px solid #000000;
              border:2px solid #3F51B5;
         font-weight: bold;
        }

        .dob {
            flex: 1;
            height: 100px;
            background-color: rgba(100, 180, 237, 0.78);
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
            border-right: 1px solid #000000;
        border:2px solid #3F51B5;
         font-weight: bold;
        }

        .dept {
            flex: 1;
            height: 100px;
            background-color: rgba(100, 180, 237, 0.78);
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
            border:2px solid #3F51B5;
         font-weight: bold;
        }

        .gender {
            flex: 1;
            height: 100px;
            background-color: rgba(100, 180, 237, 0.78);
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
            font-weight: bold;
            border:2px solid #3F51B5;
        }
        .hobby
        {
            flex: 1;
            height: 100px;
            background-color:rgba(100, 180, 237, 0.78);
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
            border:2px solid #3F51B5;
         font-weight: bold;
        }

        .admin
        {
            flex: 1;
            height: 100px;
            background-color: #a0cd9c;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
            text-align: center;
            color:#3E7139;
            border:5px solid #3E7139;
            font-weight: bold;
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
                    <li class="active"><a href="index.html">Home</a></li>
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

<div class="header">

    Welcome <? echo $user_first_name." ".$user_last_name;?>
</div>
<br>
<br>
<div class="data-container">
    <div class="email"><span style="margin-left: 40px; color: rgba(66, 39, 176, 0.78); font-size: 18px;">Email id:  </span><? echo $user_email;?></div>
    <div class="phone"><span style="margin-left: 40px; color:  rgba(66, 39, 176, 0.78); font-size: 18px;">Phone no:  </span><? echo $user_phone;?></div>
</div>
<div class="data-container">
    <div class="dob"><span style="margin-left: 40px; color: rgba(66, 39, 176, 0.78); font-size: 18px;">Date of Birth:  </span><? echo $user_dob;?></div>
    <div class="dept"><span style="margin-left: 40px; color:  rgba(66, 39, 176, 0.78); font-size: 18px;">Department:  </span><? echo $user_dept;?></div>
</div>
<div class="data-container">
    <div class="gender"><span style="margin-left: 40px; color:  rgba(66, 39, 176, 0.78); font-size: 18px;">Gender:  </span><? echo $user_gender;?></div>
    <div class="hobby"><span style="margin-left: 40px; color:  rgba(66, 39, 176, 0.78); font-size: 18px;">Hobbies:  </span><? echo $user_hobby;?></div>
</div>
<br><br>
<div class="data-container">
    <div class="admin">
        <?
        if($_SESSION['type']=="admin")
        {
            echo '<a href="admin.php">Admin Panel</a><br>';
            echo '<a href="edit_details.php?user=' . $_GET['user'] . '">Edit Details</a>';
        }
        else if((isset($_SESSION['active'])) && ($_SESSION['active'] === true)) {
            //user has been activated by admin .. give him privileges
            echo '<a href="edit_details.php?user=' . $_GET['user'] . '">Edit Details</a>';
        }
        ?>
    </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>