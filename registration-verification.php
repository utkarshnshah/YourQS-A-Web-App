<?php
require_once("./controller/connect.php");
include("./controller/functions.php");
session_start();
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
        <title>Registration Verification | YourQS</title>
        <meta name="description" content="Verify your email account.">
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
                    <a class="navbar-brand page-scroll" href="index.php"><img src="img/YourQS-logo.jpg" class="navbar-brand" id="biscoLogo" alt="BPS"></a>
                    <div class="phone"><span>Call Today</span>+64 27 443 3732</div>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php#about" class="page-scroll">About</a></li>
                        <li><a href="index.php#services" class="page-scroll">Sections</a></li>
                        <li><a href="index.php#portfolio" class="page-scroll">Login</a></li>
                        <li><a href="index.php#testimonials" class="page-scroll">Register</a></li>
                        <li><a href="#contact" class="page-scroll">Contact</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse --> 
            </div>
        </nav>
        <!-- Verification Section -->
        <div class="container" id="forgotPassword"><br class="visible-xs visible-sm visible-md"><br class="visible-xs visible-sm visible-md">
            <div class="section-title">
                <h2 class="section-group-heading">Verify Email</h2>
            </div>
            <form name="registrationVerification" method="post" action="registration-verification.php">
                <p>We have sent you a registration code on your registered email. Please enter the code to verify your account.</p><br>
                <?php
                if (!empty($verifyErrorMsg)) {
                    echo '<div class="alert alert-info text-danger" id="verifyErrorMsg"><strong>' . $verifyErrorMsg . '</strong></div>';
                }
                ?>
                <?php
                if (!empty($verifySuccessMsg)) {
                    echo '<div class="alert alert-success text-success" id="verifySuccessMsg"><strong>' . $verifySuccessMsg . '</strong></div>';
                }
                ?>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-4">
                        <div class="input-group ">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-envelope"></i>
                            </span>
                            <input type="email" name="registeredEmail" class="form-control" placeholder="Enter Registered Email" required="required">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-4">
                        <div class="input-group ">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-barcode"></i>
                            </span>
                            <input type="number" name="verficationCode" class="form-control" aria-label="Enter Registration Code" placeholder="Enter Registration Code" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="btnVerify" id="btnVerify" class="btn btn-danger"><strong>Verify</strong></button>
                </div>
            </form>
        </div><br><br>
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
                                echo '<div class="alert alert-danger" role="alert">' . $contactErrorMessage . '</div>';
                            }
                            if (!empty($contactSuccessMsg)) {
                                echo '<div class="alert alert-success" role="alert">' . $contactSuccessMsg . '</div>';
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
        <!-- Footer Section -->
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