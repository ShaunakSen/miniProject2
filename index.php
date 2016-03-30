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
    <!--
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    -->
    <script src="js/map.js"></script>
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
    <script>
        function initialize() {
            var mapProp = {
                center: new google.maps.LatLng(23.549879, 87.291023),
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
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
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="#services" class="smoothScroll">Services</a></li>
                    <li><a href="#locate" class="smoothScroll">Locate Us</a></li>
                    <li><a href="#contact" class="smoothScroll">Contact</a></li>
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
    <a name="locate"></a>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <h1 style="color: #E6E1E1">Locate Us...</h1>
            <hr>
            <div id="googleMap" style="width: 800px!important; height: 300px;"></div>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <div class="content">
        <div class="row">
            <a name="services"></a><h1>What We Do</h1>
        <hr>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10 information2">
                This is a <strong>Content management System</strong>
                There has to be two types of accounts, one for the administrator and the

                other for the users. Two separate login systems have been created.

                Admin has the right to access the student database, add new student

                data, delete any student’s data or update the same. Users need to

                register first by filling up a standard registration form, with the fields like

                name age roll number, branch, contact details, address, etc. The

                registration request should go the admin. Upon acceptance of the

                registration request by the admin, the user’s account gets activated.
            </div>
            <div class="col-sm-1"></div>
        </div>
            <a name="contact"></a>
        <h1> Brought to you by...</h1>
        <hr>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10 information">
                <div class="row">
                    <div class="col-xs-3">
                        Abhay Raizada<br>
                        Shaunak Sen<br>
                        Surya Prakash
                    </div>
                    <div class="col-xs-3">
                        13/IT/68<br>
                        13/IT/82<br>
                        13/IT/74
                    </div>
                    <div class="col-xs-6">
                        shaunak1105@gmail.com<br>
                        shaunak1105@gmail.com<br>
                        shaunak1105@gmail.com
                    </div>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>


    </div>
</div>
    <script src="js/smoothscroll.js"></script>
</body>
</html>
