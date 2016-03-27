<?php
require_once("resources/config.php");

//gets called when user clicks on the email link u send them

if (isset($_GET['user']) && ($_SESSION['type'] == "admin")) {

    //sanitize the variables
    $e = escape_string($_GET['user']);

    // Check their credentials against the database
    $sql = "SELECT * FROM users_registered WHERE email='$e' AND activated='1' LIMIT 1";
    $query = query($sql);
    confirm($query);
    $numrows = mysqli_num_rows($query);
    if ($numrows == 0) {
        header("location: message.php?msg=Your credentials are not matching anything in our system");
        exit();
    }
    //match was found .. Activate user
    $sql = "UPDATE users_registered SET activated='2' WHERE email='$e' LIMIT 1";
    $query = query($sql);
    //optional double check for activated field in our database
    $sql = "SELECT * FROM users_registered WHERE email='$e' AND activated='2' LIMIT 1";
    $query = query($sql);
    confirm($query);
    $numrows = mysqli_num_rows($query);
    if ($numrows == 0) {
        header("location: message.php?msg=activation_failure");
        exit();
    } else if ($numrows == 1) {
        header("location: message.php?msg=activation_from_admin_success");
        exit();
    }

} else {
    //missing GET variables
    header("location: message.php?msg=missing_GET_variables");
    exit();

}
?>