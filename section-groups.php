<?php
require_once("./controller/connect.php");
$logOutMsg = "";
session_start();
if (isset($_SESSION['userID']) && isset($_SESSION['userFirstName']) && isset($_SESSION['userLastName'])) {
    $firstName = $_SESSION['userFirstName'];
    $lastName = $_SESSION['userLastName'];
} else {
    $firstName = "";
    $lastName = "";
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['logout'])) {
        $firstName = "";
        $lastName = "";
        $logOutMsg = "You have logout successfully!";
        session_unset();
        session_destroy();
        header('Location:index.php?logout=1#portfolio');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <noscript><meta http-equiv="refresh" content="0;url=javascript-disabled.php"></noscript>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Section Groups | YourQS</title>
        <meta name="description" content="View and search beams, columns and piles.">
        <meta name="author" content="Nick Clements, Utkarsh Shah, Sulara Perera, Seema Sidhu, Paramjit Singh, Punit Kumar">
        <!-- Stylesheet -->
        <link rel="stylesheet" type="text/css"  href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
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
                        <li><a href="section-groups.php">Home</a></li>
                        <li><a href="#beams" class="page-scroll">Beams</a></li>
                        <li><a href="#columns" class="page-scroll">Columns</a></li>
                        <li><a href="#piles" class="page-scroll">Piles</a></li>
                        <?php
                        if (!empty($_SESSION['userID'])) {
                            echo '<li><a href="section-groups.php?logout=1">Log Out</a></li>';
                        } else {
                            echo "";
                        }
                        ?>
                    </ul>
                </div>
                <!-- /.navbar-collapse --> 
            </div>
        </nav>
        <!-- Steel Sections section -->
        <!-- Beams -->
        <div id="beams"><br class="visible-xs visible-sm visible-md"><br class="visible-xs visible-sm visible-md">
            <div class="container">
                <div class="section-title">
                    <h2 class="section-group-heading">Section Groups<small class="pull-right">
                            <?php
                            if (!empty($firstName) && !empty($lastName)) {
                                echo "Hi " . $firstName;
                            } else {
                                echo "";
                            }
                            ?></small>
                    </h2>
                </div>
            </div>
            <div class="container">
                <div class="section-title">
                    <h3 class="section-group-subheading">Beams<a href="search.php?search=beams" class="btn btn-default pull-right"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search Beams</a></h3>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <img src="img/sections/I.jpg" class="img-thumbnail img-responsive">
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group-btn">
                                    <a href="sections.php?view=eb" class="btn btn-primary section-groups-btn"><strong>Equivalent Welded Beams</strong></a>
                                    <a href="search.php?search=eb" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                </div>   
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group-btn">
                                    <a href="sections.php?view=hb" class="btn btn-primary section-groups-btn"><strong>Heavy Welded Beams</strong></a>
                                    <a href="search.php?search=hb" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                </div>   
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group-btn">
                                    <a href="sections.php?view=hcb" class="btn btn-primary section-groups-btn"><strong>High Capacity Beams</strong></a>
                                    <a href="search.php?search=hcb" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                </div>   
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group-btn">
                                    <a href="sections.php?view=hcc" class="btn btn-primary section-groups-btn"><strong>High Capacity Columns</strong></a>
                                    <a href="search.php?search=hcc" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group-btn">
                                    <a href="sections.php?view=lb" class="btn btn-primary section-groups-btn"><strong>Light Welded Beams</strong></a>
                                    <a href="search.php?search=lb" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                </div>   
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group-btn">
                                    <a href="sections.php?view=nb" class="btn btn-primary section-groups-btn"><strong>Narrow Welded Beams</strong></a>
                                    <a href="search.php?search=nb" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                </div>   
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group-btn">
                                    <a href="sections.php?view=pb" class="btn btn-primary section-groups-btn"><strong>Perimeter Welded Beams</strong></a>
                                    <a href="search.php?search=pb" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                </div>   
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group-btn">
                                    <a href="sections.php?view=sb" class="btn btn-primary section-groups-btn"><strong>Standard Welded Beams</strong></a>
                                    <a href="search.php?search=sb" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div><br><hr class="col-xs-12">
            </div>
        </div>

        <!-- Columns -->
        <div id="columns">
            <div class="container">
                <div class="section-title">
                    <h3 class="section-group-subheading">Columns<a href="search.php?search=columns" class="btn btn-default pull-right"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search Columns</a></h3>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group-btn">
                                    <a href="sections.php?view=hcbc" class="btn btn-primary section-groups-btn"><strong>High Capacity Beam-Columns</strong></a>
                                    <a href="search.php?search=hcbc" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                </div>   
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="input-group-btn">
                                    <a href="sections.php?view=sc" class="btn btn-primary section-groups-btn"><strong>Standard Welded Columns</strong></a>
                                    <a href="search.php?search=sc" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                </div>   
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">                                    
                        <img src="img/sections/H.jpg" class="img-thumbnail img-responsive">
                    </div>
                </div><br><hr class="col-xs-12">
            </div>
        </div>

        <!-- Piles -->
        <div id="piles">
            <div class="container">
                <div class="section-title">
                    <h3 class="section-group-subheading">Piles<a href="search.php?search=piles" class="btn btn-default pull-right"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search Piles</a></h3>
                </div>
                <div class="row">
                    <div class="col-sm-4">                                    
                        <img src="img/sections/H.jpg" class="img-thumbnail img-responsive">
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group-btn">
                                    <a href="sections.php?view=bp" class="btn btn-primary section-groups-btn"><strong>Welded Bearing Piles</strong></a>
                                    <a href="search.php?search=bp" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                </div>   
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group-btn">
                                    <a href="sections.php?view=hp" class="btn btn-primary section-groups-btn"><strong>Welded H Piles</strong></a>
                                    <a href="search.php?search=hp" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div><br><hr class="col-xs-12">
            </div>
        </div>
        <noscript><div class="noscriptmsg"><p>You need JavaScript enabled in your browser to work on this site. Reload this page after you have enabled JavaScript.</p></div></noscript>
        <script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
        <script type="text/javascript" src="js/bootstrap.min.js"></script> 
        <script type="text/javascript" src="js/SmoothScroll.js"></script> 
        <script type="text/javascript" src="js/main.js"></script>  
    </body>
</html>