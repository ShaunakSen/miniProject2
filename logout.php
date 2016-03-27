<?php
session_start();
function redirect_to($url)
{
    header('Location: '.$url);
}

if(isset($_SESSION["email"]))
{
    $_SESSION = array();
    session_destroy();
}
redirect_to("index.php");
?>


