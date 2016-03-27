<?php

require_once("resources/config.php");
require_once("resources/functions.php");

function redirect_to($url)
{
    header('Location: ' . $url);
}
if((isset($_SESSION['email']))&&($_SESSION['admin'] == "admin"))
{
    $sql = "SELECT * FROM users_registered WHERE type='normal'";
    $query = query($sql);
    confirm($query);
    if (mysqli_num_rows($query) > 0) {
        while($row2 = $query->fetch_assoc()) {
            echo '<div class="details">Name: '.$row2['first_name'].' '.$row2['last_name'].'<br> Email: '.
                $row2['email'].'<br>Phone Number: '.$row2['phone_number'].'<br>Roll Number: '.$row2['roll_no'].'<br>Date of Birth: '.
                $row2['dob'].'<br>Dept: '.$row2['dept'].'<br>Gender: '.$row2['gender'].'<br>Hobbies: '.$row2['hobby'].
                '<div class="activate">'.'<a href="activation_from_admin.php?user='.$row2['email'].'">'.'Activate User</a></div>'.'</div>';

            ;
        }
    }
}
else
{
    redirect_to("index.php");
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
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
        .hobby
        {
            flex: 1;
            height: 100px;
            background-color:slateblue ;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
        }

        .admin
        {
            flex: 1;
            height: 100px;
            background-color: #a0cd9c;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            line-height: 100px;
        }

        .details
        {
            width:500px;
            height: auto;
            padding: 20px;
            margin: 20px;
            text-align: justify;
            font-family: "Droid Sans", Helvetica, Arial, sans-serif;
            letter-spacing: 1px;
            background-color: #8fc7cc;
            line-height: 35px;
        }

        .activate
        {
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


</body>
</html>