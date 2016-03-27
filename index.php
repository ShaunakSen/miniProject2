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
    <meta charset="UTF-8">
    <title></title>

    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/slider.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">

    <style type="text/css">
        #apDiv1 {
            position: absolute;
            width: 599px;
            height: 593px;
            z-index: 0;
            left: 719px;
            top: 153px;
            opacity: 0.5;
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

<div class="container">


    <div id="container">

        <img src="img/left-arrow.png" alt="Prev" id="prev">

        <div id="slider">
            <div class="slide">
                <div class="slide-copy">
                    <h2>Slider One</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae commodo sem. Integer eros
                        nibh, molestie congue elementum quis, mattis nec tortor. Vivamus sed hendrerit sed vitae orci
                        convallis.</p>
                </div>
                <img src="img/slide1.jpg">
            </div>

            <div class="slide">
                <div class="slide-copy">
                    <h2>Slider Two</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae commodo sem. Integer eros
                        nibh, molestie congue elementum quis, mattis nec tortor. Vivamus sed hendrerit sed vitae orci
                        convallis.</p>
                </div>
                <img src="img/slide2.jpg">
            </div>

            <div class="slide">
                <div class="slide-copy">
                    <h2>Slider Three</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae commodo sem. Integer eros
                        nibh, molestie congue elementum quis, mattis nec tortor. Vivamus sed hendrerit sed vitae orci
                        convallis.</p>
                </div>
                <img src="img/slide3.jpg">
            </div>

            <div class="slide">
                <div class="slide-copy">
                    <h2>Slider Four</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae commodo sem. Integer eros
                        nibh, molestie congue elementum quis, mattis nec tortor. Vivamus sed hendrerit sed vitae orci
                        convallis.</p>
                </div>
                <img src="img/slide4.jpg">
            </div>


        </div>
        <img src="img/right-arrow.png" alt="Next" id="next">
    </div>
    <br><br>

    <div class="content">
        <h1>A portal for attendance and grades </h1>

        <div class="markdown">
            <p>
                "Lorem ipsum dolor sit amet,
                consectetur adipiscing elit, sed do eiusmod tempor incididunt<br>
                ut labore et dolore magna aliqua.<br>
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut<br>
                aliquip ex ea commodo consequat.<br>
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore<br>
                eu fugiat nulla pariatur.<br>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia<br>
                deserunt<br>
                mollit anim id est laborum."<br>
            </p>
        </div>
        <h1> Brought to you by </h1>

        <div class="markdown">
            Shaunak Sen <span style="color: #15354d; font-weight: bold">13/IT/82</span><br>
            Abhay Raizada <span style="color: #15354d; font-weight: bold">13/IT/68</span><br>
            Surya Prakash <span style="color: #15354d; font-weight: bold">13/IT/74</span><br>
        </div>

    </div>
</div>

</body>
</html>
