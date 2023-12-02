<?php
require_once("./controller/connect.php");
session_start();
include("./controller/engineering-properties-controller.php");
if (isset($_SESSION['userID']) && isset($_SESSION['userFirstName']) && isset($_SESSION['userLastName'])) {
    $firstName = $_SESSION['userFirstName'];
    $lastName = $_SESSION['userLastName'];
    $printButton = '<button type="button" id="printButton" class="btn btn-custom btn-lg"><span class="glyphicon glyphicon glyphicon-print" aria-hidden="true"></span> Print</button><br><br>';
} else {
    $firstName = "";
    $lastName = "";
    $printButton = '<button type="button" id="printButtonF" class="btn btn-custom btn-lg"><span class="glyphicon glyphicon glyphicon-print" aria-hidden="true"></span> Print</button><br><br>';
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
        <title>Engineering Properties | YourQS</title>
        <meta name="description" content="Engineering properties of a steel section. Print engineering properties of a steel section.">
        <meta name="author" content="Nick Clements, Utkarsh Shah, Sulara Perera, Seema Sidhu, Paramjit Singh, Punit Kumar">
        <!-- Stylesheet -->
        <link rel="stylesheet" type="text/css"  href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" media="print" href="css/print.css">
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
                        <li><a href="section-groups.php" class="page-scroll">Home</a></li>
                        <li><a href="section-groups.php#beams" class="page-scroll">Beams</a></li>
                        <li><a href="section-groups.php#columns" class="page-scroll">Columns</a></li>
                        <li><a href="section-groups.php#piles" class="page-scroll">Piles</a></li>
                        <?php
                        if (!empty($_SESSION['userID'])) {
                            echo '<li><a href="engineering-properties.php?logout=1">Log Out</a></li>';
                        } else {
                            echo "";
                        }
                        ?>
                    </ul>
                </div>
                <!-- /.navbar-collapse --> 
            </div>
        </nav>
        <div id="section-properties"><br class="visible-xs visible-sm visible-md"><br class="visible-xs visible-sm visible-md">
            <div class="container">
                <div class="section-title" id="displayUserName">
                    <h2 class="section-group-heading">Engineering Properties<small class="pull-right"><?php
                            if (!empty($firstName) && !empty($lastName)) {
                                echo "Hi " . $firstName;
                            } else {
                                echo "";
                            }
                            ?></small>
                    </h2>
                </div>
                <div class="section-title">
                    <h3 class="section-group-subheading">Section: <?php
                        if (!empty($selectedSection)) {
                            echo $selectedSection;
                        }
                        ?></h3>
                </div>
            </div>

            <div class="container" id="allProperties">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row" id="sectionImageDiv">
                            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 text-center">
                                <span id="flangeThickness"><?php
                                    if (!empty($tfThickness)) {
                                        echo $tfThickness;
                                    } else {
                                        echo "-";
                                    }
                                    ?></span>
                                <span id="depth"><?php
                                    if (!empty($dDepth)) {
                                        echo $dDepth;
                                    } else {
                                        echo "-";
                                    }
                                    ?></span>
                                <span id="webThickness"><?php
                                    if (!empty($twThickness)) {
                                        echo $twThickness;
                                    } else {
                                        echo "-";
                                    }
                                    ?></span>                              
                                <span id="width"><?php
                                    if (!empty($bfWidth)) {
                                        echo $bfWidth;
                                    } else {
                                        echo "-";
                                    }
                                    ?></span>
                                <img src="<?php
                                    if (!empty($imagePath)) {
                                        echo $imagePath;
                                    } else {
                                        echo "img/sections/H.jpg";
                                    }
                                    ?>" id="section-image" class="img-responsive img-thumbnail" alt="Project Title">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr><th colspan="3">Dimensions</th></tr>
                                        <tr>
                                            <th>Depth</th>
                                            <th>Kg/m:</th>
                                            <th></th>
                                        </tr> 
                                        <tr>
                                            <td><?php
                                if (!empty($dDepth)) {
                                    echo $dDepth;
                                } else {
                                    echo "-";
                                }
                                    ?></td>
                                            <td><?php
                                                if (!empty($kgm)) {
                                                    echo $kgm;
                                                } else {
                                                    echo "-";
                                                }
                                    ?></td>
                                            <td></td>
                                        </tr> 
                                        <tr>
                                            <th colspan="2">Flange</th>
                                            <th>Web</th>
                                        </tr> 
                                        <tr>
                                            <th>bf Width</th>
                                            <th>tf Thickness</th>
                                            <th>tw Thickness</th>
                                        </tr> 
                                        <tr>
                                            <td><?php
                                                if (!empty($bfWidth)) {
                                                    echo $bfWidth;
                                                } else {
                                                    echo "-";
                                                }
                                    ?></td>
                                            <td><?php
                                                if (!empty($tfThickness)) {
                                                    echo $tfThickness;
                                                } else {
                                                    echo "-";
                                                }
                                    ?></td>
                                            <td><?php
                                                if (!empty($twThickness)) {
                                                    echo $twThickness;
                                                } else {
                                                    echo "-";
                                                }
                                    ?></td>
                                        </tr> 
                                        <tr>
                                            <th>d1 Depth Between Flanges</th>
                                            <th>Fillet Weld v*w</th>
                                            <th>kN/mm</th>
                                        </tr> 
                                        <td><?php
                                                if (!empty($d1Depth)) {
                                                    echo $d1Depth;
                                                } else {
                                                    echo "-";
                                                }
                                    ?></td>
                                        <td><?php
                                            if (!empty($vw15d1FilletWeld)) {
                                                echo $vw15d1FilletWeld;
                                            } else {
                                                echo "-";
                                            }
                                    ?></td>
                                        <td><?php
                                            if (!empty($standardWeld)) {
                                                echo $standardWeld;
                                            } else {
                                                echo "-";
                                            }
                                    ?></td>
                                    </table>
                                </div>
                            </div>
                        </div><br>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th colspan="2">Section Properties</th>
                                    <th colspan="2">About x-axis</th>
                                    <th colspan="2">About x-axis</th>
                                    <th colspan="2">Constant</th>
                                </tr> 
                                <tr>
                                    <td><strong>d1/tw</strong></td>
                                    <td><?php
                                            if (!empty($d1tw)) {
                                                echo $d1tw;
                                            } else {
                                                echo "-";
                                            }
                                    ?></td>
                                    <td><strong>Ix</strong></td>
                                    <td><?php
                                        if (!empty($ix)) {
                                            echo $ix;
                                        } else {
                                            echo "-";
                                        }
                                    ?><i class="text-muted"> e6 mm4</i></td>
                                    <td><strong>Iy</strong></td>
                                    <td><?php
                                        if (!empty($iy)) {
                                            echo $iy;
                                        } else {
                                            echo "-";
                                        }
                                    ?></td>
                                    <td><strong>J Torsion</strong></td>
                                    <td><?php
                                        if (!empty($jTorsion)) {
                                            echo $jTorsion;
                                        } else {
                                            echo "-";
                                        }
                                    ?><i class="text-muted"> e3 mm4</i></td>
                                </tr>
                                <tr>
                                    <td><strong>(bf-tw)/2tf</strong></td>
                                    <td><?php
                                        if (!empty($bftw2tf)) {
                                            echo $bftw2tf;
                                        } else {
                                            echo "-";
                                        }
                                    ?> </td>
                                    <td><strong>Zx</strong></td>
                                    <td><?php
                                        if (!empty($zx)) {
                                            echo $zx;
                                        } else {
                                            echo "-";
                                        }
                                    ?> <i class="text-muted"> e3 mm3</i></td>
                                    <td><strong>Zy</strong></td>
                                    <td><?php
                                        if (!empty($zy)) {
                                            echo $zy;
                                        } else {
                                            echo "-";
                                        }
                                    ?> <i class="text-muted"> e3 mm3</i></td>
                                    <td><strong>Iw Warping</strong></td>
                                    <td><?php
                                        if (!empty($iwWarping)) {
                                            echo $iwWarping;
                                        } else {
                                            echo "-";
                                        }
                                    ?><i class="text-muted"> e9 mm6</i></td>
                                </tr>
                                <tr>
                                    <td><strong>Ag Gross Area</strong></td>
                                    <td><?php
                                        if (!empty($agGrossArea)) {
                                            echo $agGrossArea;
                                        } else {
                                            echo "-";
                                        }
                                    ?><i class="text-muted"> mm2</i></td>                                            
                                    <td><strong>Sx</strong></td>
                                    <td><?php
                                        if (!empty($sx)) {
                                            echo $sx;
                                        } else {
                                            echo "-";
                                        }
                                    ?><i class="text-muted"> e3 mm3</i></td>                                            
                                    <td><strong>Sy</strong></td>
                                    <td><?php
                                        if (!empty($sy)) {
                                            echo $sy;
                                        } else {
                                            echo "-";
                                        }
                                    ?><i class="text-muted"> e3 mm3</i></td>                                            
                                    <td></td>
                                    <td></td>                                            
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><strong>rx</strong></td>
                                    <td>
                                        <?php
                                        if (!empty($rx)) {
                                            echo $rx;
                                        } else {
                                            echo "-";
                                        }
                                        ?><i class="text-muted"> mm</i>
                                    </td>
                                    <td><strong>ry</strong></td>
                                    <td><?php
                                        if (!empty($ry)) {
                                            echo $ry;
                                        } else {
                                            echo "-";
                                        }
                                        ?><i class="text-muted"> mm</i></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th colspan="6">Properties for Assessing Section Capacity</th>
                                </tr>
                                <tr>
                                    <th colspan="2">Yield Stress</th>
                                    <th colspan="2">About x-axis</th>
                                    <th colspan="2">About y-axis</th>
                                </tr>
                                <tr>
                                    <td><strong>fy Flange</strong></td>
                                    <td><?php
                                        if (!empty($fyFlange)) {
                                            echo $fyFlange;
                                        } else {
                                            echo "-";
                                        }
                                        ?><i class="text-muted"> MPa</i></td>
                                    <td><strong>Compactness</strong></td>
                                    <td><?php
                                        if (!empty($xaxisCompactness)) {
                                            echo $xaxisCompactness;
                                        } else {
                                            echo "-";
                                        }
                                        ?></td>
                                    <td><strong>Compactness</strong></td>
                                    <td><?php
                                        if (!empty($yaxisCompactness)) {
                                            echo $yaxisCompactness;
                                        } else {
                                            echo "-";
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td><strong>fy Web</strong></td>
                                    <td><?php
                                        if (!empty($fyWeb)) {
                                            echo $fyWeb;
                                        } else {
                                            echo "-";
                                        }
                                        ?></td>
                                    <td><strong>Zex</strong></td>
                                    <td><?php
                                        if (!empty($zex)) {
                                            echo $zex;
                                        } else {
                                            echo "-";
                                        }
                                        ?><i class="text-muted"> 10^3 mm3</i></td>
                                    <td><strong>Zey</strong></td>
                                    <td><?php
                                        if (!empty($zey)) {
                                            echo $zey;
                                        } else {
                                            echo "-";
                                        }
                                        ?><i class="text-muted"> 10^3 mm3</i></td>
                                </tr>
                                <tr>
                                    <td><strong>kf Form Factor</strong></td>
                                    <td><?php
                                        if (!empty($kfFormFactor)) {
                                            echo $kfFormFactor;
                                        } else {
                                            echo "-";
                                        }
                                        ?></td>
                                    <td><strong>Msx</strong></td>
                                    <td><?php
                                        if (!empty($msx)) {
                                            echo $msx;
                                        } else {
                                            echo "-";
                                        }
                                        ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th colspan="3">Fire Engineering Design Parameters</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><strong>4 Sided</strong></td>
                                    <td><strong>3 Sided</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Ksm</strong></td>
                                    <td>
                                        <?php
                                        if (!empty($ksm4Sided)) {
                                            echo $ksm4Sided;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (!empty($ksm3Sided)) {
                                            echo $ksm3Sided;
                                        } else {
                                            echo "-";
                                        }
                                        ?><i class="text-muted"> m2/T</i>                                                
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Hp/A</strong></td>
                                    <td>
                                        <?php
                                        if (!empty($hpa4Sided)) {
                                            echo $hpa4Sided;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (!empty($hpa3Sided)) {
                                            echo $hpa3Sided;
                                        } else {
                                            echo "-";
                                        }
                                        ?><i class="text-muted"> m-1</i>                                                
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>rf</strong></td>
                                    <td>
                                        <?php
                                        if (!empty($rf4Sided)) {
                                            echo $rf4Sided;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (!empty($rf3Sided)) {
                                            echo $rf3Sided;
                                        } else {
                                            echo "-";
                                        }
                                        ?><i class="text-muted"> 15 min</i>                                     
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger text-danger hidden" id="printMessage"><center><strong>Please login to print. </strong><a href="index.php#portfolio" class="btn btn-default btn-sm" target="_self"><strong>Login Now</strong></a></center></div>
                <div class="text-center" id="printIt">
                    <?php
                    echo $printButton;
                    ?>
                </div>
            </div>
        </div>
        <noscript><div class="noscriptmsg"><p>You need JavaScript enabled in your browser to work on this site. Reload this page after you have enabled JavaScript.</p></div></noscript>
        <script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
        <script type="text/javascript" src="js/bootstrap.min.js"></script> 
        <script type="text/javascript" src="js/SmoothScroll.js"></script> 
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>