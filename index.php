<?php
require_once("./controller/connect.php");
include("./controller/functions.php");
$logOutMsg = "";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['logout'])) {
        $firstName = "";
        $lastName = "";
        $logOutMsg = "You have logout successfully!";
        session_unset();
        session_destroy();
    }
}
if (isset($_SESSION['userID']) && isset($_SESSION['userFirstName']) && isset($_SESSION['userLastName'])) {
    header('Location: section-groups.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <noscript><meta http-equiv="refresh" content="0;url=javascript-disabled.php"></noscript>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>YourQS</title>
        <meta name="description" content="We can create a cost estimate for you using whatever design information that you can provide, most commomly PDF drawings but can be hand sketches or even photographs.">
        <meta name="author" content="Nick Clements, Utkarsh Shah, Sulara Perera, Seema Sidhu, Paramjit Singh, Punit Kumar">
        <!-- Stylesheet -->
        <link rel="stylesheet" type="text/css"  href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        <noscript><style>.container-fluid,.container,.navbar{display:none;}</style></noscript>
    </head>
    <body id="page-top" onload="clearAll()" data-spy="scroll" data-target=".navbar-fixed-top">
        <!-- Navigation -->
        <nav id="menu" class="navbar navbar-default navbar-fixed-top">
            <div class="container"> 
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="navbar-brand page-scroll" href="#page-top"><img src="img/YourQS-logo.jpg" class="navbar-brand" id="biscoLogo" alt="BPS"></a>
                    <div class="phone"><span>Call Today</span>+64 27 443 3732</div>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#about" class="page-scroll">About</a></li>
                        <li><a href="#services" class="page-scroll">Sections</a></li>
                        <li><a href="#portfolio" class="page-scroll">Login</a></li>
                        <li><a href="#testimonials" class="page-scroll">Register</a></li>
                        <li><a href="#contact" class="page-scroll">Contact</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse --> 
            </div>
        </nav>
        <!-- Header -->
        <header id="header">
            <div class="intro">
                <div class="overlay">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 intro-text">
                                <h1>Innovation from the very outset</h1>
                                <p>The steel making operation at new zealand steel's site at YourQS is a unique process.</p>
                                <a href="#about" class="btn btn-custom btn-lg page-scroll">Learn More</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Get Touch Section -->
        <div id="get-touch">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-md-offset-1">
                        <h3>Cost for your steel section</h3>
                        <p>Get started today and complete our form to request your free estimate</p>
                    </div>
                    <div class="col-xs-12 col-md-4 text-center"><a href="#contact" class="btn btn-custom btn-lg page-scroll">Free Estimate</a></div>
                </div>
            </div>
        </div>
        <!-- About Section -->
        <div id="about">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-6"> <img src="img/about.jpg" class="img-responsive" alt=""> </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="about-text">
                            <h2>Who We Are</h2>
                            <p>As a proud New Zealand owned company, YourQS has been a leading supplier of steel products for the New Zealand and Asia-Pacific markets since establishment in 2010. YourQS operates as an international steel merchant, trader, and processor, handling a wide range of steel products and services to suit your requirements.</p>
                            <h3>Why Choose Us?</h3>
                            <div class="list-style">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <ul>
                                        <li>Years of Experience</li>
                                        <li>Fully Insured</li>
                                        <li>Cost Control Experts</li>
                                        <li>100% Satisfaction Guarantee</li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <ul>
                                        <li>Free Consultation</li>
                                        <li>Satisfied Customers</li>
                                        <li>Project Management</li>
                                        <li>Affordable Pricing</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Steel Sections section-->
        <div id="services">
            <div class="container">
                <div class="section-title">
                    <h2 class="section-group-heading">Sections</h2>
                </div>
                <div class="row home-sections">
                    <div class="col-sm-4">
                        <div class="portfolio-item">
                            <h3 class="text-center">Beams</h3>
                            <div class="hover-bg"> 
                                <a href="section-groups.php">
                                    <div class="hover-text">
                                        <h5>View All</h5>
                                    </div>
                                    <img src="img/sections/I.jpg" class="img-responsive img-thumbnail center-block" alt="Project Title">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="portfolio-item">
                            <h3 class="text-center">Columns</h3>
                            <div class="hover-bg"> 
                                <a href="section-groups.php#columns">
                                    <div class="hover-text">
                                        <h5>View All</h5>
                                    </div>
                                    <img src="img/sections/H.jpg" class="img-responsive img-thumbnail center-block" alt="Project Title">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="portfolio-item">
                            <h3 class="text-center">Piles</h3>
                            <div class="hover-bg"> 
                                <a href="section-groups.php#piles">
                                    <div class="hover-text">
                                        <h5>View All</h5>
                                    </div>
                                    <img src="img/sections/H.jpg" class="img-responsive img-thumbnail center-block" alt="Project Title">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Section-->
        <div id="portfolio">
            <div class="container">
                <div class="section-title">
                    <h2>Login</h2>
                    <p>Please enter your email and password.</p>
                </div>
                <form name="login" method="post" action="index.php#portfolio">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group form-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" name="loginEmail" class="form-control" placeholder="Email" required="required">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group form-group">
                                <span class="input-group-addon">
                                    <span class="fa fa-key" aria-hidden="true"></span>
                                </span>
                                <input type="password" name="loginPassword" class="form-control" placeholder="Password" required="required">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div><br>
                    <?php
                    if (!empty($logOutMsg)) {
                        echo '<div class="alert alert-success alert-dismissable text-success" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>' . $logOutMsg . ' </strong></div>';
                    }
                    if (!empty($loginError)) {
                        echo '<div class="alert alert-danger" role="alert"><strong>' . $loginError . '</strong></div>';
                    }
                    ?>
                    <button type="submit" name="btnLogin" class="btn btn-success">Login</button>
                    <a href="forgot-password.php" class="btn btn-danger">Forgot Password</a>
                </form>
            </div>
        </div>

        <!-- Register Section -->
        <div id="testimonials">
            <div class="container">
                <div class="section-title">
                    <h2>Register</h2>
                    <p>Please fill out the form below to register.</p>
                </div>
                <form name="register" method="post" action="index.php#testimonials">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input type="text" name="firstName" class="form-control" placeholder="First Name" required="required">
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input type="text" name="lastName" class="form-control" placeholder="Last Name" required="required">
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" name="email" class="form-control" placeholder="Email" required="required">
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="fa fa-key"></span>
                                </span>
                                <input type="password" name="password" class="form-control" placeholder="Password" required="required">
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="fa fa-key"></span>
                                </span>
                                <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password" required="required">
                            </div>
                        </div>
                    </div><br>
                    <?php
                    if (!empty($errorMessage)) {
                        echo '<div class="alert alert-danger" role="alert"><strong>' . $errorMessage . '</strong></div>';
                    }
                    if (!empty($regSuccessMsg)) {
                        echo '<div class="alert alert-success" role="alert"><strong>' . $regSuccessMsg . '</strong></div>';
                    }
                    ?>
                    <button type="submit" name="btnRegister" class="btn btn-success">Register</button>
                    <a href="registration-verification.php" class="btn btn-danger">Verify</a>
                </form>
            </div>
        </div>

        <!-- Contact Section -->
        <div id="contact">
            <div class="container">
                <div class="col-md-8">
                    <div class="row">
                        <div class="section-title">
                            <h2>Get In Touch</h2>
                            <p>Please fill out the form below to send us an email and we will get back to you as soon as possible.</p>
                        </div>
                        <form name="contact" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#contact">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="contactName" class="form-control" placeholder="Full Name" required="required">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="contactEmail" class="form-control" placeholder="Email" required="required">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="message" name="message" class="form-control" rows="4" placeholder="Message" required="required"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <?php
                            if (!empty($contactErrorMessage)) {
                                echo '<div class="alert alert-danger" role="alert"><strong>' . $contactErrorMessage . '</strong></div>';
                            }
                            if (!empty($contactSuccessMsg)) {
                                echo '<div class="alert alert-success" role="alert"><strong>' . $contactSuccessMsg . '</strong></div>';
                            }
                            ?>
                            <button type="submit" name="btnContact" class="btn btn-custom btn-lg">Send Message</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3 col-md-offset-1 contact-info">
                    <address>
                        <div class="contact-item">
                            <h4>Contact Info</h4>
                            <p><span>Address</span><u><a class="addressLink" href="http://maps.google.com/maps?q=PO+Box+13-601%2CAuckland%2CNew+Zealand" target="_blank">PO Box 13-601</a></u>,<br>Auckland, New Zealand</p>
                        </div>
                        <div class="contact-item">
                            <p><span>Phone</span><u><a href="tel:+64274433732">+64 27 443 3732</a></u></p>
                        </div>
                        <div class="contact-item">
                            <p><span>Email</span><u><a href="mailto:nick@yourqs.co.nz">nick@yourqs.co.nz</a></u></p>
                        </div>
                    </address>
                </div>
            </div>
        </div>
        <div id="footer">
            <div class="container text-center">
                <p>YourQS &copy; 2017. Website developed by team <strong><a href="site-developer.php" target="_self">Real Steel</a></strong></p>
            </div>
        </div>
        <noscript><div class="noscriptmsg"><p>You need JavaScript enabled in your browser to work on this site. Reload this page after you have enabled JavaScript.</p></div></noscript>
        <script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
        <script type="text/javascript" src="js/bootstrap.min.js"></script> 
        <script type="text/javascript" src="js/SmoothScroll.js"></script> 
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>