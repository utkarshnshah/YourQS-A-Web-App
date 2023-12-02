<?php
require_once("./controller/connect.php");
$logOutMsg = "";
session_start();
include("./controller/sections-controller.php");
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
        <title>Sections | YourQS</title>
        <meta name="description" content="List of steel sections with few engineering properties.">
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
        <noscript><style>.container-fluid,.container,.navbar{display:none;}</style></noscript>
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
                        <li><a href="section-groups.php#beams" class="page-scroll">Beams</a></li>
                        <li><a href="section-groups.php#columns" class="page-scroll">Columns</a></li>
                        <li><a href="section-groups.php#piles" class="page-scroll">Piles</a></li>
                        <?php
                        if (!empty($_SESSION['userID'])) {
                            echo '<li><a href="sections.php?logout=1">Log Out</a></li>';
                        } else {
                            echo "";
                        }
                        ?>
                    </ul>
                </div>
                <!-- /.navbar-collapse --> 
            </div>
        </nav>

        <!-- Section List -->
        <div id="sectionList" class="container"><br class="visible-xs visible-sm visible-md"><br class="visible-xs visible-sm visible-md">
            <div class="section-title">
                <h2 class="section-group-heading">Section List<small class="pull-right"><?php
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
                    <?php
                    if (!empty($selectedGroupName)) {
                        if ($displaySearchResult == "yes") {
                            echo "<span class='text-muted'><strong>Result for:</strong> Depth= ";
                            if (!empty($depthFrom)) {
                                echo $depthFrom;
                            } else {
                                echo " 0 ";
                            }
                            echo " to ";
                            if (!empty($depthTo) && $depthTo != $maxDepthTo) {
                                echo $depthTo;
                            } else {
                                echo " Max";
                            }
                            echo ", <strong>Nominal Depth</strong>= ";
                            if (!empty($nominalDepthFrom)) {
                                echo $nominalDepthFrom;
                            } else {
                                echo " 0 ";
                            }
                            echo " to ";
                            if (!empty($nominalDepthTo) && $nominalDepthTo != $maxNominalDepthTo) {
                                echo $nominalDepthTo;
                            } else {
                                echo " Max";
                            }
                            echo ", <strong>Width</strong>= ";
                            if (!empty($widthFrom)) {
                                echo $widthFrom;
                            } else {
                                echo " 0 ";
                            }
                            echo " to ";
                            if (!empty($widthTo) && $widthTo != $maxWidthTo) {
                                echo $widthTo;
                            } else {
                                echo " Max";
                            }
                            echo ", <strong>Weight</strong>= ";
                            if (!empty($weightFrom)) {
                                echo $weightFrom;
                            } else {
                                echo " 0 ";
                            }
                            echo " to ";
                            if (!empty($weightTo) && $weightTo != $maxWeightTo) {
                                echo $weightTo;
                            } else {
                                echo " Max";
                            }
                            echo ", <strong>Area</strong>= ";
                            if (!empty($areaFrom)) {
                                echo $areaFrom;
                            } else {
                                echo " 0 ";
                            }
                            echo " to ";
                            if (!empty($areaTo) && $areaTo != $maxAreaTo) {
                                echo $areaTo;
                            } else {
                                echo " Max";
                            }
                            echo ", <strong>Ix</strong>= ";
                            if (!empty($ixFrom)) {
                                echo $ixFrom;
                            } else {
                                echo " 0 ";
                            }
                            echo " to ";
                            if (!empty($ixTo) && $ixTo != $maxIxTo) {
                                echo $ixTo;
                            } else {
                                echo " Max";
                            }
                            echo ", <strong>Iy</strong>= ";
                            if (!empty($iyFrom)) {
                                echo $iyFrom;
                            } else {
                                echo " 0 ";
                            }
                            echo " to ";
                            if (!empty($iyTo) && $iyTo != $maxIyTo) {
                                echo $iyTo;
                            } else {
                                echo " Max";
                            }
                            echo ", <strong>Zx x-axis</strong>= ";
                            if (!empty($zxxaxisFrom)) {
                                echo $zxxaxisFrom;
                            } else {
                                echo " 0 ";
                            }
                            echo " to ";
                            if (!empty($zxxaxisTo) && $zxxaxisTo != $maxZxxaxisTo) {
                                echo $zxxaxisTo . " and ";
                            } else {
                                echo " Max and ";
                            }
                            echo "<strong>Zy y-axis</strong>= ";
                            if (!empty($zyyaxisFrom)) {
                                echo $zyyaxisFrom;
                            } else {
                                echo " 0 ";
                            }
                            echo " to ";
                            if (!empty($zyyaxisTo) && $zyyaxisTo != $maxZyyaxisTo) {
                                echo $zyyaxisTo . ".</span>";
                            } else {
                                echo " Max.</span>";
                            }
                        }
                        if ($displaySearchResult == "yes") {
                            echo "<br><br>";
                        }
                        echo "<strong>Group: " . $selectedGroupName . ".</strong>";
                        if (!empty($totalSelectedGroup)) {
                            echo "<strong> (" . $totalSelectedGroup . ") </strong>";
                        }
                        if (!empty($totalSectionFound)) {
                            echo " Sections found = <strong>" . $totalSectionFound . "</strong>.";
                        }
                    }
                    ?>
                </h4>
            </div>

            <!-- Selected Section List-->
            <div class="alert alert-danger <?php
            if ($displaySection == "no") {
                echo "";
            } elseif ($displaySection == "yes") {
                echo "hidden";
            } elseif ($displaySection == "") {
                echo "hidden";
            }
            ?>">
                No section found!
            </div>
            <div class="table-responsive <?php
            if ($displaySection == "yes") {
                echo "";
            } elseif ($displaySection == "no") {
                echo "hidden";
            } elseif ($displaySection == "") {
                echo "hidden";
            }
            ?>">
                <table class="table table-striped">
                    <tr class="info"><th>Section</th>
                        <th>Depth d</th>
                        <th>Width bf</th>
                        <th>Area</th>
                        <th>lx</th>
                        <th>ly</th>
                        <th>Zx x-axis</th>
                        <th>Zy y-axis</th>
                        <th>Weight</th>
                        <th>Flange fl</th>
                        <th>Web tw</th>
                        <th>Standard Weld</th>
                    </tr>
                    <?php
                    if (!empty($sectionsList)) {
                        echo $sectionsList;
                    }
                    ?>
                </table>                
            </div>
            <!--/ Selected Section List-->
            <!-- Searched Section List-->
            <div class="alert alert-danger <?php
            if ($displaySearchResult == "no") {
                echo "";
            } elseif ($displaySearchResult == "yes") {
                echo "hidden";
            } elseif ($displaySearchResult == "") {
                echo "hidden";
            }
            ?>">
                No section found!
            </div>
            <div class="table-responsive <?php
            if ($displaySearchResult == "yes") {
                echo "";
            } elseif ($displaySearchResult == "no") {
                echo "hidden";
            } elseif ($displaySearchResult == "") {
                echo "hidden";
            }
            ?>">
                     <?php
                     if (!empty($searchedSectionsList)) {
                         echo $searchedSectionsList;
                     }
                     ?>
            </div>
            <!--/ Searched Section List-->
        </div>
        <noscript><div class="noscriptmsg"><p>You need JavaScript enabled in your browser to work on this site. Reload this page after you have enabled JavaScript.</p></div></noscript>
        <script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
        <script type="text/javascript" src="js/bootstrap.min.js"></script> 
        <script type="text/javascript" src="js/SmoothScroll.js"></script> 
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>