<?php
require_once("./controller/connect.php");
$logOutMsg = "";
session_start();
include("./controller/search-controller.php");
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
        <title>Search | YourQS</title>
        <meta name="description" content="Search steel section by its engineering properties.">
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
                        <li><a href="section-groups.php" class="page-scroll">Home</a></li>
                        <li><a href="section-groups.php#beams" class="page-scroll">Beams</a></li>
                        <li><a href="section-groups.php#columns" class="page-scroll">Columns</a></li>
                        <li><a href="section-groups.php#piles" class="page-scroll">Piles</a></li>
                        <?php
                        if (!empty($_SESSION['userID'])) {
                            echo '<li><a href="search.php?logout=1">Log Out</a></li>';
                        } else {
                            echo "";
                        }
                        ?>
                    </ul>
                </div>
                <!-- /.navbar-collapse --> 
            </div>
        </nav>

        <div id="searchForm" class="container"><br class="visible-xs visible-sm visible-md"><br class="visible-xs visible-sm visible-md">
            <div class="section-title">
                <h2 class="section-group-heading">Search<small class="pull-right"><?php
                        if (!empty($firstName) && !empty($lastName)) {
                            echo "Hi " . $firstName;
                        } else {
                            echo "";
                        }
                        ?></small>
                </h2>
            </div>
            <div class="section-title">
                <h4 class="section-group-subheading">
                    <strong>Search in group - 
                        <?php
                        if (!empty($selectedGroupName)) {
                            echo $selectedGroupName;
                        }
                        ?>
                    </strong>
                    <br><br>
                    <i>All fields are calculated in mm. Maximum 10 digits allowed.</i>
                </h4>
            </div>   
            <form name="search" method="post" action="sections.php">
                <div class="row">
                    <div class="alert alert-danger hidden">Please enter 10 numerical values.</div>
                    <div class="col-lg-4">
                        <div class="input-group form-inline">
                            <span class="input-group-addon searchField"><strong>Depth</strong></span>
                            <input type="number" name="depthFrom" id="depthFrom" min="0" max="1000000000" placeholder="From" class="form-control" aria-label="Depth From">
                            <input type="number" name="depthTo" id="depthTo" min="0" max="1000000000" placeholder="To" class="form-control" aria-label="Depth To">
                            <span class="input-group-addon searchSpan">
                                <input type="checkbox" id="chkDepth" checked="checked" name="chdDepth" aria-label="Set Depth">
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <span class="input-group-addon searchField"><strong>Area</strong></span>
                            <input type="number" name="areaFrom" id="areaFrom" min="0" max="1000000000" placeholder="From" class="form-control" aria-label="Area From">
                            <input type="number" name="areaTo" id="areaTo" min="0" max="1000000000" placeholder="To" class="form-control" aria-label="Area To">
                            <span class="input-group-addon searchSpan">
                                <input type="checkbox" id="chkArea" checked="checked" aria-label="Set Area">
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <span class="input-group-addon searchField"><strong>Width</strong></span>
                            <input type="number" name="widthFrom" id="widthFrom" min="0" max="1000000000" placeholder="From" class="form-control" aria-label="Width From">
                            <input type="number" name="widthTo" id="widthTo" min="0" max="1000000000" placeholder="To" class="form-control" aria-label="Width To">
                            <span class="input-group-addon searchSpan">
                                <input type="checkbox" id="chkWidth" checked="checked" aria-label="Set Width">
                            </span>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="input-group">
                            <span class="input-group-addon searchField"><strong>Weight</strong></span>
                            <input type="number" name="weightFrom" id="weightFrom" min="0" max="1000000000" placeholder="From" class="form-control" disabled="disabled" aria-label="Weight From">
                            <input type="number" name="weightTo" id="weightTo" min="0" max="1000000000" placeholder="To" class="form-control" disabled="disabled" aria-label="Weight To">
                            <span class="input-group-addon searchSpan">
                                <input type="checkbox" id="chkWeight" aria-label="Set Weight">
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <span class="input-group-addon searchField"><strong>Nominal<br>Depth</strong></span>
                            <input type="number" name="nominalDepthFrom" id="nominalDepthFrom" min="0" max="1000000000" placeholder="From" class="form-control" disabled="disabled" aria-label="Nominal Depth From">
                            <input type="number" name="nominalDepthTo" id="nominalDepthTo" min="0" max="1000000000" placeholder="To" class="form-control" disabled="disabled" aria-label="Nominal Depth To">
                            <span class="input-group-addon searchSpan">
                                <input type="checkbox" id="chkNominalDepth" aria-label="Set Nominal Depth">
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <span class="input-group-addon searchField"><strong>Ix</strong></span>
                            <input type="number" name="ixFrom" id="ixFrom" min="0" max="1000000000" placeholder="From" class="form-control" disabled="disabled" aria-label="Ix From">
                            <input type="number" name="ixTo" id="ixTo" min="0" max="1000000000" placeholder="To" class="form-control" disabled="disabled" aria-label="Ix To">
                            <span class="input-group-addon searchSpan">
                                <input type="checkbox" id="chkIx" aria-label="Set Ix">
                            </span>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="input-group">
                            <span class="input-group-addon searchField"><strong>Iy</strong></span>
                            <input type="number" name="iyFrom" id="iyFrom" min="0" max="1000000000" placeholder="From" class="form-control" disabled="disabled" aria-label="Iy From">
                            <input type="number" name="iyTo" id="iyTo" min="0" max="1000000000" placeholder="To" class="form-control" disabled="disabled" aria-label="Iy To">
                            <span class="input-group-addon searchSpan">
                                <input type="checkbox" id="chkIy" aria-label="Set Iy">
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <span class="input-group-addon searchField"><strong>Zx<br>x-axis</strong></span>
                            <input type="number" name="zxxaxisFrom" id="zxxaxisFrom" min="0" max="1000000000" placeholder="From" class="form-control" disabled="disabled" aria-label="Zx x-Axis From">
                            <input type="number" name="zxxaxisTo" id="zxxaxisTo" min="0" max="1000000000" placeholder="To" class="form-control" disabled="disabled" aria-label="Zx x-Axis To">
                            <span class="input-group-addon searchSpan">
                                <input type="checkbox" id="chkZx" aria-label="Set Zx x-axis">
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <span class="input-group-addon searchField"><strong>Zy<br>y-axis</strong></span>
                            <input type="number" name="zyyaxisFrom" id="zyyaxisFrom" min="0" max="1000000000" placeholder="From" class="form-control" disabled="disabled" aria-label="Zy y-axis From">
                            <input type="number" name="zyyaxisTo" id="zyyaxisTo" min="0" max="1000000000" placeholder="To" class="form-control" disabled="disabled" aria-label="Zy y-axis To">
                            <span class="input-group-addon searchSpan">
                                <input type="checkbox" id="chkZy" aria-label="Set Zy y-axis">
                            </span>
                        </div>
                    </div>
                </div>
                <br><center><button type="submit" name="btnSearch" class="btn btn-custom btn-lg"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button></center>
            </form>            
        </div>
        <noscript><div class="noscriptmsg"><p>You need JavaScript enabled in your browser to work on this site. Reload this page after you have enabled JavaScript.</p></div></noscript>
        <script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
        <script type="text/javascript" src="js/bootstrap.min.js"></script> 
        <script type="text/javascript" src="js/SmoothScroll.js"></script> 
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>