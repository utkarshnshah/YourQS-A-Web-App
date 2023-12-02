<?php

// Get sections
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sectionsList = "";
    $displaySearchResult = "";
    if (!empty($_GET['view'])) {
        if ($_GET['view'] == "eb") {
            $selectedGroup = "EB";
            $selectedGroupName = "Equivalent Welded Beams";
        } else if ($_GET['view'] == "hb") {
            $selectedGroup = "HB";
            $selectedGroupName = "Heavy Welded Beams";
        } else if ($_GET['view'] == "hcb") {
            $selectedGroup = "HCB";
            $selectedGroupName = "High Capacity Beams";
        } else if ($_GET['view'] == "hcc") {
            $selectedGroup = "HCC";
            $selectedGroupName = "High Capacity Columns";
        } else if ($_GET['view'] == "lb") {
            $selectedGroup = "LB";
            $selectedGroupName = "Light Welded Beams";
        } else if ($_GET['view'] == "nb") {
            $selectedGroup = "NB";
            $selectedGroupName = "Narrow Welded Beams";
        } else if ($_GET['view'] == "pb") {
            $selectedGroup = "PB";
            $selectedGroupName = "Perimeter Welded Beams";
        } else if ($_GET['view'] == "sb") {
            $selectedGroup = "SB";
            $selectedGroupName = "Standard Welded Beams";
        } else if ($_GET['view'] == "ws") {
            $selectedGroup = "WS";
            $selectedGroupName = "Wide Sections";
        } else if ($_GET['view'] == "hcbc") {
            $selectedGroup = "HCBC";
            $selectedGroupName = "High Capacity Beam-Columns";
        } else if ($_GET['view'] == "sc") {
            $selectedGroup = "SC";
            $selectedGroupName = "Standard Welded Columns";
        } else if ($_GET['view'] == "bp") {
            $selectedGroup = "BP";
            $selectedGroupName = "Welded Bearing Piles";
        } else if ($_GET['view'] == "hp") {
            $selectedGroup = "HP";
            $selectedGroupName = "Welded H Piles";
        }
    } else {
        $displaySection = "no";
    }
    if (!empty($selectedGroup)) {
//      Query for beams
        if ($selectedGroup == "EB" || $selectedGroup == "HB" || $selectedGroup == "HCB" || $selectedGroup == "HCC" || $selectedGroup == "LB" || $selectedGroup == "NB" || $selectedGroup == "PB" || $selectedGroup == "SB" || $selectedGroup == "WS") {
            $queryForSelected = "SELECT s.Group, s.Section AS section, s.d AS depth, s.bf AS width, e.A AS area, ROUND(e.Ix1) AS Ix1, ROUND(e.`Iy x-axis`,1) AS Iyxaxis, 
            ROUND(e.`Zx x-axis`) AS Zxxaxis, e.`Zy y-axis` AS Zyyaxis, 
            ROUND(s.w) AS weight, s.tf AS tf, s.tw AS tw, s.StandardWeld AS StandardWeld 
            FROM standardsections AS s, engineeringproperties AS e WHERE 
            (s.Section=e.Section AND s.Group='EB') OR (s.Section=e.Section AND s.Group='HB') OR 
            (s.Section=e.Section AND s.Group='HCB') OR (s.Section=e.Section AND s.Group='HCC') OR 
            (s.Section=e.Section AND s.Group='LB') OR (s.Section=e.Section AND s.Group='NB') OR 
            (s.Section=e.Section AND s.Group='PB') OR (s.Section=e.Section AND s.Group='SB') OR 
            (s.Section=e.Section AND s.Group='WS') 
            ORDER BY CASE WHEN s.Group = '" . $selectedGroup . "' THEN 1 ELSE 2 END, s.Group";
        }
//      Query for columns
        if ($selectedGroup == "HCBC" || $selectedGroup == "SC") {
            $queryForSelected = "SELECT s.Group, s.Section AS section, s.d AS depth, s.bf AS width, e.A AS area, ROUND(e.Ix1) AS Ix1, ROUND(e.`Iy x-axis`,1) AS Iyxaxis, 
            ROUND(e.`Zx x-axis`) AS Zxxaxis, e.`Zy y-axis` AS Zyyaxis, 
            ROUND(s.w) AS weight, s.tf AS tf, s.tw AS tw, s.StandardWeld AS StandardWeld 
            FROM standardsections AS s, engineeringproperties AS e WHERE 
            (s.Section=e.Section AND s.Group='HCBC') OR (s.Section=e.Section AND s.Group='SC') 
            ORDER BY CASE WHEN s.Group = '" . $selectedGroup . "' THEN 1 ELSE 2 END, s.Group";
        }
//      Query for piles
        if ($selectedGroup == "BP" || $selectedGroup == "HP") {
            $queryForSelected = "SELECT s.Group, s.Section AS section, s.d AS depth, s.bf AS width, e.A AS area, ROUND(e.Ix1) AS Ix1, ROUND(e.`Iy x-axis`,1) AS Iyxaxis, 
            ROUND(e.`Zx x-axis`) AS Zxxaxis, e.`Zy y-axis` AS Zyyaxis, 
            ROUND(s.w) AS weight, s.tf AS tf, s.tw AS tw, s.StandardWeld AS StandardWeld 
            FROM standardsections AS s, engineeringproperties AS e WHERE 
            (s.Section=e.Section AND s.Group='BP') OR (s.Section=e.Section AND s.Group='HP') 
            ORDER BY CASE WHEN s.Group = '" . $selectedGroup . "' THEN 1 ELSE 2 END, s.Group";
        }

// Counting total number of records for each group
        $totalSelectedGroup = $totalEB = $totalHB = $totalHCB = $totalHCC = $totalLB = $totalNB = $totalPB = $totalSB = $totalWS = $totalHCBC = $totalSC = $totalBP = $totalHP = 0;
        $qCountGroups = "SELECT `Group`, COUNT(*) FROM engineeringproperties GROUP BY `Group`";
        $totalGroups = $con->query($qCountGroups);
        while ($rowGroups = $totalGroups->fetch_assoc()) {
// Getting total count for selected group
            if ($rowGroups['Group'] == $selectedGroup) {
                $totalSelectedGroup = $rowGroups['COUNT(*)'];
            }
// Getting total count for all groups
            if ($rowGroups['Group'] == "EB") {
                $totalEB = $rowGroups['COUNT(*)'];
            }
            if ($rowGroups['Group'] == "HB") {
                $totalHB = $rowGroups['COUNT(*)'];
            }
            if ($rowGroups['Group'] == "HCB") {
                $totalHCB = $rowGroups['COUNT(*)'];
            }
            if ($rowGroups['Group'] == "HCC") {
                $totalHCC = $rowGroups['COUNT(*)'];
            }
            if ($rowGroups['Group'] == "LB") {
                $totalLB = $rowGroups['COUNT(*)'];
            }
            if ($rowGroups['Group'] == "NB") {
                $totalNB = $rowGroups['COUNT(*)'];
            }
            if ($rowGroups['Group'] == "PB") {
                $totalPB = $rowGroups['COUNT(*)'];
            }
            if ($rowGroups['Group'] == "SB") {
                $totalSB = $rowGroups['COUNT(*)'];
            }
            if ($rowGroups['Group'] == "WS") {
                $totalWS = $rowGroups['COUNT(*)'];
            }
            if ($rowGroups['Group'] == "HCBC") {
                $totalHCBC = $rowGroups['COUNT(*)'];
            }
            if ($rowGroups['Group'] == "SC") {
                $totalSC = $rowGroups['COUNT(*)'];
            }
            if ($rowGroups['Group'] == "BP") {
                $totalBP = $rowGroups['COUNT(*)'];
            }
            if ($rowGroups['Group'] == "HP") {
                $totalHP = $rowGroups['COUNT(*)'];
            }
        }

        $result = $con->query($queryForSelected);
        $countEB = $countHB = $countHCB = $countHCC = $countLB = $countNB = $countPB = $countSB = $countWS = $countHCBC = $countSC = $countBP = $countHP = 0;
        $th = '<tr class="info"><th>Section</th>
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
                    </tr>';
        if ($result->num_rows > 0) {
            $displaySection = "yes";
            while ($row = $result->fetch_assoc()) {
                if ($row['Group'] == "EB" && $countEB == 0 && $row['Group'] != $selectedGroup) {
                    $sectionsList .= '</table><br>
                    <h4><strong>Equivalent Welded Beams (' . $totalEB . ')</strong></h4>
                    <table class="table table-striped">' . $th;
                    $countEB = $countEB + 1;
                }
                if ($row['Group'] == "HB" && $countHB == 0 && $row['Group'] != $selectedGroup) {
                    $sectionsList .= '</table><br>
                    <h4><strong>Heavy Welded Beams (' . $totalHB . ')</strong></h4>
                    <table class="table table-striped">' . $th;
                    $countHB = $countHB + 1;
                }
                if ($row['Group'] == "HCB" && $countHCB == 0 && $row['Group'] != $selectedGroup) {
                    $sectionsList .= '</table><br>
                    <h4><strong>High Capacity Beams (' . $totalHCB . ')</strong></h4>
                    <table class="table table-striped">' . $th;
                    $countHCB = $countHCB + 1;
                }
                if ($row['Group'] == "HCC" && $countHCC == 0 && $row['Group'] != $selectedGroup) {
                    $sectionsList .= '</table><br>
                    <h4><strong>High Capacity Columns (' . $totalHCC . ')</strong></h4>
                    <table class="table table-striped">' . $th;
                    $countHCC = $countHCC + 1;
                }
                if ($row['Group'] == "LB" && $countLB == 0 && $row['Group'] != $selectedGroup) {
                    $sectionsList .= '</table><br>
                    <h4><strong>Light Welded Beams (' . $totalLB . ')</strong></h4>
                    <table class="table table-striped">' . $th;
                    $countLB = $countLB + 1;
                }
                if ($row['Group'] == "NB" && $countNB == 0 && $row['Group'] != $selectedGroup) {
                    $sectionsList .= '</table><br>
                    <h4><strong>Narrow Welded Beams (' . $totalNB . ')</strong></h4>
                    <table class="table table-striped">' . $th;
                    $countNB = $countNB + 1;
                }
                if ($row['Group'] == "PB" && $countPB == 0 && $row['Group'] != $selectedGroup) {
                    $sectionsList .= '</table><br>
                    <h4><strong>Perimeter Welded Beams (' . $totalPB . ')</strong></h4>
                    <table class="table table-striped">' . $th;
                    $countPB = $countPB + 1;
                }
                if ($row['Group'] == "SB" && $countSB == 0 && $row['Group'] != $selectedGroup) {
                    $sectionsList .= '</table><br>
                    <h4><strong>Standard Welded Beams (' . $totalSB . ')</strong></h4>
                    <table class="table table-striped">' . $th;
                    $countSB = $countSB + 1;
                }
                if ($row['Group'] == "WS" && $countWS == 0 && $row['Group'] != $selectedGroup) {
                    $sectionsList .= '</table><br>
                    <h4><strong>Wide Sections (' . $totalWS . ')</strong></h4>
                    <table class="table table-striped">' . $th;
                    $countWS = $countWS + 1;
                }
                if ($row['Group'] == "HCBC" && $countHCBC == 0 && $row['Group'] != $selectedGroup) {
                    $sectionsList .= '</table><br>
                    <h4><strong>High Capacity Beam-Columns (' . $totalHCBC . ')</strong></h4>
                    <table class="table table-striped">' . $th;
                    $countHCBC = $countHCBC + 1;
                }
                if ($row['Group'] == "SC" && $countSC == 0 && $row['Group'] != $selectedGroup) {
                    $sectionsList .= '</table><br>
                    <h4><strong>Standard Welded Columns (' . $totalSC . ')</strong></h4>
                    <table class="table table-striped">' . $th;
                    $countSC = $countSC + 1;
                }
                if ($row['Group'] == "BP" && $countBP == 0 && $row['Group'] != $selectedGroup) {
                    $sectionsList .= '</table><br>
                    <h4><strong>Welded Bearing Piles (' . $totalBP . ')</strong></h4>
                    <table class="table table-striped">' . $th;
                    $countBP = $countBP + 1;
                }
                if ($row['Group'] == "HP" && $countHP == 0 && $row['Group'] != $selectedGroup) {
                    $sectionsList .= '</table><br>
                    <h4><strong>Welded H Piles (' . $totalHP . ')</strong></h4>
                    <table class="table table-striped">' . $th;
                    $countHP = $countHP + 1;
                }

                $sectionsList .= '<tr>'
                        . '<td><u><a href="engineering-properties.php?section=' . $row['section'] . '" class="text-info">' . $row['section'] . '</a></u></td>'
                        . '<td>' . $row['depth'] . '</td>'
                        . '<td>' . $row['width'] . '</td>'
                        . '<td>' . $row['area'] . '</td>'
                        . '<td>' . $row['Ix1'] . '</td>'
                        . '<td>' . $row['Iyxaxis'] . '</td>'
                        . '<td>' . $row['Zxxaxis'] . '</td>'
                        . '<td>' . $row['Zyyaxis'] . '</td>'
                        . '<td>' . $row['weight'] . '</td>'
                        . '<td>' . $row['tf'] . '</td>'
                        . '<td>' . $row['tw'] . '</td>'
                        . '<td>' . $row['StandardWeld'] . '</td>'
                        . '</tr>';
            }
            $selectedGroup = "";
        } else {
            
        }
    } else {
        $displaySection = "no";
    }
}

// Search sections
if (isset($_POST['btnSearch'])) {

// Validation for input data
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $displaySection = "";
    $searchedSectionsList = "";
    $selectedGroup = "";
    $selectedGroupName = "";
    $totalSectionFound = "";
    if (!empty($_SESSION["selectedGroup"])) {
        $selectedGroup = $_SESSION["selectedGroup"];
        $selectedGroupName = $_SESSION["selectedGroupName"];
    } else {
        $selectedGroup = "";
        $selectedGroupName = "";
    }

// Get maximum for particular group of Beam, Column or Pile only.
    $qmaxvalue = $maxDepthTo = $maxNominalDepthTo = $maxWidthTo = $maxWeightTo = $maxAreaTo = $maxIxTo = $maxIyTo = $maxZxxaxisTo = $maxZyyaxisTo = "";
    if ($selectedGroup == "EB" || $selectedGroup == "HB" || $selectedGroup == "HCB" || $selectedGroup == "HCC" || $selectedGroup == "LB" || $selectedGroup == "NB" || $selectedGroup == "PB" || $selectedGroup == "SB" || $selectedGroup == "WS" || $selectedGroup == "HCBC" || $selectedGroup == "SC" || $selectedGroup == "BP" || $selectedGroup == "HP") {
        $qmaxValue = "SELECT MAX(s.d), MAX(s.NominalDepth), MAX(s.bf), MAX(s.w), MAX(e.A), MAX(e.Ix1), MAX(e.`Iy x-axis`), MAX(e.`Zx x-axis`), MAX(e.`Zy y-axis`) 
        FROM standardsections AS s, engineeringproperties AS e 
        WHERE s.Section=e.Section AND s.Group='" . $selectedGroup . "'";
    } elseif ($selectedGroup == "Beams") {
        $qmaxValue = "SELECT MAX(s.d), MAX(s.NominalDepth), MAX(s.bf), MAX(s.w), MAX(e.A), MAX(e.Ix1), MAX(e.`Iy x-axis`), MAX(e.`Zx x-axis`), MAX(e.`Zy y-axis`) 
        FROM standardsections AS s, engineeringproperties AS e WHERE"
                . "(s.Section=e.Section AND s.Group='EB') OR (s.Section=e.Section AND s.Group='HB') OR "
                . "(s.Section=e.Section AND s.Group='HCB') OR (s.Section=e.Section AND s.Group='HCC') OR "
                . "(s.Section=e.Section AND s.Group='LB') OR (s.Section=e.Section AND s.Group='NB') OR "
                . "(s.Section=e.Section AND s.Group='PB') OR (s.Section=e.Section AND s.Group='SB') OR "
                . "(s.Section=e.Section AND s.Group='WS')";
    } elseif ($selectedGroup == "Columns") {
        $qmaxValue = "SELECT MAX(s.d), MAX(s.NominalDepth), MAX(s.bf), MAX(s.w), MAX(e.A), MAX(e.Ix1), MAX(e.`Iy x-axis`), MAX(e.`Zx x-axis`), MAX(e.`Zy y-axis`) 
        FROM standardsections AS s, engineeringproperties AS e 
        WHERE (s.Section=e.Section AND s.Group='HCBC') OR (s.Section=e.Section AND s.Group='SC')";
    } elseif ($selectedGroup == "Piles") {
        $qmaxValue = "SELECT MAX(s.d), MAX(s.NominalDepth), MAX(s.bf), MAX(s.w), MAX(e.A), MAX(e.Ix1), MAX(e.`Iy x-axis`), MAX(e.`Zx x-axis`), MAX(e.`Zy y-axis`) 
        FROM standardsections AS s, engineeringproperties AS e 
        WHERE (s.Section=e.Section AND s.Group='BP') OR (s.Section=e.Section AND s.Group='HP')";
    }
    $searchMax = $con->query($qmaxValue);
    if ($searchMax->num_rows > 0) {
        while ($rowMax = $searchMax->fetch_assoc()) {
            $maxDepthTo = $rowMax['MAX(s.d)'];
            $maxNominalDepthTo = $rowMax['MAX(s.NominalDepth)'];
            $maxWidthTo = $rowMax['MAX(s.bf)'];
            $maxWeightTo = $rowMax['MAX(s.w)'];
            $maxAreaTo = $rowMax['MAX(e.A)'];
            $maxIxTo = $rowMax['MAX(e.Ix1)'];
            $maxIyTo = $rowMax['MAX(e.`Iy x-axis`)'];
            $maxZxxaxisTo = $rowMax['MAX(e.`Zx x-axis`)'];
            $maxZyyaxisTo = $rowMax['MAX(e.`Zy y-axis`)'];
        }
    } else {
        $displaySearchResult = "";
    }

    // Checking if the input data is number and not more than 10 characters.
    function validateFromData($inputFromData) {
        if (!preg_match('/^[0-9]+$/', $inputFromData) || strlen($inputFromData) > 10) {
            $inputFromData = 0;
            return $inputFromData;
        } else {
            return $inputFromData;
        }
    }

    $depthFrom = $depthTo = $nominalDepthFrom = $nominalDepthTo = $widthFrom = $widthTo = $weightFrom = $weightTo = $areaFrom = $areaTo = $ixFrom = $ixTo = $iyFrom = $iyTo = $zxxaxisFrom = $zxxaxisTo = $zyyaxisFrom = $zyyaxisTo = 0;
    if (!empty($_POST["depthFrom"])) {
        $depthFrom = test_input(ROUND($_POST["depthFrom"]));
        $depthFrom = validateFromData($depthFrom);
    } else {
        $depthFrom = 0;
    }
    if (!empty($_POST["depthTo"])) {
        $depthTo = test_input(ROUND($_POST["depthTo"]));
        if (!preg_match('/^[0-9]+$/', $depthTo) || strlen($depthTo) > 10) {
            $depthTo = $maxDepthTo;
        }
    } else {
        $depthTo = $maxDepthTo;
    }

    if (!empty($_POST["nominalDepthFrom"])) {
        $nominalDepthFrom = test_input(ROUND($_POST["nominalDepthFrom"]));
        $nominalDepthFrom = validateFromData($nominalDepthFrom);
    } else {
        $nominalDepthFrom = 0;
    }
    if (!empty($_POST["nominalDepthTo"])) {
        $nominalDepthTo = test_input(ROUND($_POST["nominalDepthTo"]));
        if (!preg_match('/^[0-9]+$/', $nominalDepthTo) || strlen($nominalDepthTo) > 10) {
            $nominalDepthTo = $maxNominalDepthTo;
        }
    } else {
        $nominalDepthTo = $maxNominalDepthTo;
    }

    if (!empty($_POST["widthFrom"])) {
        $widthFrom = test_input(ROUND($_POST["widthFrom"]));
        $widthFrom = validateFromData($widthFrom);
    } else {
        $widthFrom = 0;
    }
    if (!empty($_POST["widthTo"])) {
        $widthTo = test_input(ROUND($_POST["widthTo"]));
        if (!preg_match('/^[0-9]+$/', $widthTo) || strlen($widthTo) > 10) {
            $widthTo = $maxWidthTo;
        }
    } else {
        $widthTo = $maxWidthTo;
    }

    if (!empty($_POST["weightFrom"])) {
        $weightFrom = test_input(ROUND($_POST["weightFrom"]));
        $weightFrom = validateFromData($weightFrom);
    } else {
        $weightFrom = 0;
    }
    if (!empty($_POST["weightTo"])) {
        $weightTo = test_input(ROUND($_POST["weightTo"]));
        if (!preg_match('/^[0-9]+$/', $weightTo) || strlen($weightTo) > 10) {
            $weightTo = $maxWeightTo;
        }
    } else {
        $weightTo = $maxWeightTo;
    }

    if (!empty($_POST["areaFrom"])) {
        $areaFrom = test_input(ROUND($_POST["areaFrom"]));
        $areaFrom = validateFromData($areaFrom);
    } else {
        $areaFrom = 0;
    }
    if (!empty($_POST["areaTo"])) {
        $areaTo = test_input(ROUND($_POST["areaTo"]));
        if (!preg_match('/^[0-9]+$/', $areaTo) || strlen($areaTo) > 10) {
            $areaTo = $maxAreaTo;
        }
    } else {
        $areaTo = $maxAreaTo;
    }

    if (!empty($_POST["ixFrom"])) {
        $ixFrom = test_input(ROUND($_POST["ixFrom"]));
        $ixFrom = validateFromData($ixFrom);
    } else {
        $ixFrom = 0;
    }
    if (!empty($_POST["ixTo"])) {
        $ixTo = test_input(ROUND($_POST["ixTo"]));
        if (!preg_match('/^[0-9]+$/', $ixTo) || strlen($ixTo) > 10) {
            $ixTo = $maxIxTo;
        }
    } else {
        $ixTo = $maxIxTo;
    }

    if (!empty($_POST["iyFrom"])) {
        $iyFrom = test_input(ROUND($_POST["iyFrom"]));
        $iyFrom = validateFromData($iyFrom);
    } else {
        $iyFrom = 0;
    }
    if (!empty($_POST["iyTo"])) {
        $iyTo = test_input(ROUND($_POST["iyTo"]));
        if (!preg_match('/^[0-9]+$/', $iyTo) || strlen($iyTo) > 10) {
            $iyTo = $maxIyTo;
        }
    } else {
        $iyTo = $maxIyTo;
    }

    if (!empty($_POST["zxxaxisFrom"])) {
        $zxxaxisFrom = test_input(ROUND($_POST["zxxaxisFrom"]));
        $zxxaxisFrom = validateFromData($zxxaxisFrom);
    } else {
        $zxxaxisFrom = 0;
    }
    if (!empty($_POST["zxxaxisTo"])) {
        $zxxaxisTo = test_input(ROUND($_POST["zxxaxisTo"]));
        if (!preg_match('/^[0-9]+$/', $zxxaxisTo) || strlen($zxxaxisTo) > 10) {
            $zxxaxisTo = $maxZxxaxisTo;
        }
    } else {
        $zxxaxisTo = $maxZxxaxisTo;
    }

    if (!empty($_POST["zyyaxisFrom"])) {
        $zyyaxisFrom = test_input(ROUND($_POST["zyyaxisFrom"]));
        $zyyaxisFrom = validateFromData($zyyaxisFrom);
    } else {
        $zyyaxisFrom = 0;
    }
    if (!empty($_POST["zyyaxisTo"])) {
        $zyyaxisTo = test_input(ROUND($_POST["zyyaxisTo"]));
        if (!preg_match('/^[0-9]+$/', $zyyaxisTo) || strlen($zyyaxisTo) > 10) {
            $zyyaxisTo = $maxZyyaxisTo;
        }
    } else {
        $zyyaxisTo = $maxZyyaxisTo;
    }

    if ($selectedGroup == "Beams") {
        $queryForSearch = "SELECT s.Group, s.Section AS section, s.d AS depth, s.bf AS width, e.A AS area, 
        ROUND(e.Ix1) AS Ix1, ROUND(e.`Iy x-axis`,1) AS Iyxaxis, 
        ROUND(e.`Zx x-axis`) AS Zxxaxis, e.`Zy y-axis` AS Zyyaxis, 
        ROUND(s.w) AS weight, s.tf AS tf, s.tw AS tw, s.StandardWeld AS StandardWeld FROM "
                . "standardsections AS s, engineeringproperties AS e WHERE"
                . "((s.Section=e.Section AND s.Group='EB') OR (s.Section=e.Section AND s.Group='HB') OR "
                . "(s.Section=e.Section AND s.Group='HCB') OR (s.Section=e.Section AND s.Group='HCC') OR "
                . "(s.Section=e.Section AND s.Group='LB') OR (s.Section=e.Section AND s.Group='NB') OR "
                . "(s.Section=e.Section AND s.Group='PB') OR (s.Section=e.Section AND s.Group='SB') OR "
                . "(s.Section=e.Section AND s.Group='WS')) "
                . "AND ((s.d >= " . $depthFrom . " AND s.d <=" . $depthTo . ")"
                . "AND (s.NominalDepth >= " . $nominalDepthFrom . " AND s.NominalDepth <=" . $nominalDepthTo . ")"
                . "AND (s.bf >= " . $widthFrom . " AND s.bf <=" . $widthTo . ")"
                . "AND (s.w >= " . $weightFrom . " AND s.w <=" . $weightTo . ")"
                . "AND (e.A >= " . $areaFrom . " AND e.A <=" . $areaTo . ")"
                . "AND (e.Ix1 >= " . $ixFrom . " AND e.Ix1 <=" . $ixTo . ")"
                . "AND (e.`Iy x-axis` >= " . $iyFrom . " AND e.`Iy x-axis` <=" . $iyTo . ")"
                . "AND (e.`Zx x-axis` >= " . $zxxaxisFrom . " AND e.`Zx x-axis` <=" . $zxxaxisTo . ")"
                . "AND (e.`Zy y-axis` >= " . $zyyaxisFrom . " AND e.`Zy y-axis` <=" . $zyyaxisTo . ")) "
                . "ORDER BY CASE WHEN s.Group = 'EB' THEN 1 ELSE 2 END, s.Group";
    } elseif ($selectedGroup == "Columns") {
        $queryForSearch = "SELECT s.Group, s.Section AS section, s.d AS depth, s.bf AS width, e.A AS area, 
        ROUND(e.Ix1) AS Ix1, ROUND(e.`Iy x-axis`,1) AS Iyxaxis, 
        ROUND(e.`Zx x-axis`) AS Zxxaxis, e.`Zy y-axis` AS Zyyaxis, 
        ROUND(s.w) AS weight, s.tf AS tf, s.tw AS tw, s.StandardWeld AS StandardWeld FROM "
                . "standardsections AS s, engineeringproperties AS e "
                . "WHERE ((s.Section=e.Section AND s.Group='HCBC') OR (s.Section=e.Section AND s.Group='SC')) "
                . "AND ((s.d >= " . $depthFrom . " AND s.d <=" . $depthTo . ")"
                . "AND (s.NominalDepth >= " . $nominalDepthFrom . " AND s.NominalDepth <=" . $nominalDepthTo . ")"
                . "AND (s.bf >= " . $widthFrom . " AND s.bf <=" . $widthTo . ")"
                . "AND (s.w >= " . $weightFrom . " AND s.w <=" . $weightTo . ")"
                . "AND (e.A >= " . $areaFrom . " AND e.A <=" . $areaTo . ")"
                . "AND (e.Ix1 >= " . $ixFrom . " AND e.Ix1 <=" . $ixTo . ")"
                . "AND (e.`Iy x-axis` >= " . $iyFrom . " AND e.`Iy x-axis` <=" . $iyTo . ")"
                . "AND (e.`Zx x-axis` >= " . $zxxaxisFrom . " AND e.`Zx x-axis` <=" . $zxxaxisTo . ")"
                . "AND (e.`Zy y-axis` >= " . $zyyaxisFrom . " AND e.`Zy y-axis` <=" . $zyyaxisTo . ")) "
                . "ORDER BY CASE WHEN s.Group = 'HCBC' THEN 1 ELSE 2 END, s.Group";
    } elseif ($selectedGroup == "Piles") {
        $queryForSearch = "SELECT s.Group, s.Section AS section, s.d AS depth, s.bf AS width, e.A AS area, 
        ROUND(e.Ix1) AS Ix1, ROUND(e.`Iy x-axis`,1) AS Iyxaxis, 
        ROUND(e.`Zx x-axis`) AS Zxxaxis, e.`Zy y-axis` AS Zyyaxis, 
        ROUND(s.w) AS weight, s.tf AS tf, s.tw AS tw, s.StandardWeld AS StandardWeld FROM "
                . "standardsections AS s, engineeringproperties AS e "
                . "WHERE ((s.Section=e.Section AND s.Group='BP') OR (s.Section=e.Section AND s.Group='HP'))"
                . "AND ((s.d >= " . $depthFrom . " AND s.d <=" . $depthTo . ")"
                . "AND (s.NominalDepth >= " . $nominalDepthFrom . " AND s.NominalDepth <=" . $nominalDepthTo . ")"
                . "AND (s.bf >= " . $widthFrom . " AND s.bf <=" . $widthTo . ")"
                . "AND (s.w >= " . $weightFrom . " AND s.w <=" . $weightTo . ")"
                . "AND (e.A >= " . $areaFrom . " AND e.A <=" . $areaTo . ")"
                . "AND (e.Ix1 >= " . $ixFrom . " AND e.Ix1 <=" . $ixTo . ")"
                . "AND (e.`Iy x-axis` >= " . $iyFrom . " AND e.`Iy x-axis` <=" . $iyTo . ")"
                . "AND (e.`Zx x-axis` >= " . $zxxaxisFrom . " AND e.`Zx x-axis` <=" . $zxxaxisTo . ")"
                . "AND (e.`Zy y-axis` >= " . $zyyaxisFrom . " AND e.`Zy y-axis` <=" . $zyyaxisTo . ")) "
                . "ORDER BY CASE WHEN s.Group = 'BP' THEN 1 ELSE 2 END, s.Group";
    } else {
        $queryForSearch = "SELECT s.Group, s.Section AS section, s.d AS depth, s.bf AS width, e.A AS area, 
        ROUND(e.Ix1) AS Ix1, ROUND(e.`Iy x-axis`,1) AS Iyxaxis, 
        ROUND(e.`Zx x-axis`) AS Zxxaxis, e.`Zy y-axis` AS Zyyaxis, 
        ROUND(s.w) AS weight, s.tf AS tf, s.tw AS tw, s.StandardWeld AS StandardWeld FROM "
                . "standardsections AS s, engineeringproperties AS e "
                . "WHERE ((s.Section=e.Section AND s.Group='" . $selectedGroup . "'))"
                . "AND ((s.d >= " . $depthFrom . " AND s.d <=" . $depthTo . ")"
                . "AND (s.NominalDepth >= " . $nominalDepthFrom . " AND s.NominalDepth <=" . $nominalDepthTo . ")"
                . "AND (s.bf >= " . $widthFrom . " AND s.bf <=" . $widthTo . ")"
                . "AND (s.w >= " . $weightFrom . " AND s.w <=" . $weightTo . ")"
                . "AND (e.A >= " . $areaFrom . " AND e.A <=" . $areaTo . ")"
                . "AND (e.Ix1 >= " . $ixFrom . " AND e.Ix1 <=" . $ixTo . ")"
                . "AND (e.`Iy x-axis` >= " . $iyFrom . " AND e.`Iy x-axis` <=" . $iyTo . ")"
                . "AND (e.`Zx x-axis` >= " . $zxxaxisFrom . " AND e.`Zx x-axis` <=" . $zxxaxisTo . ")"
                . "AND (e.`Zy y-axis` >= " . $zyyaxisFrom . " AND e.`Zy y-axis` <=" . $zyyaxisTo . ")) "
                . "ORDER BY CASE WHEN s.Group = '" . $selectedGroup . "' THEN 1 ELSE 2 END, s.Group";
    }

    $searchResult = $con->query($queryForSearch);
    $totalSectionFound = $searchResult->num_rows;
    if ($searchResult->num_rows > 0) {
        $displaySearchResult = "yes";
        $displaySection = "";
        $countEB = $countHB = $countHCB = $countHCC = $countLB = $countNB = $countPB = $countSB = $countWS = $countHCBC = $countSC = $countBP = $countHP = 0;
        $th = '<tr class="info"><th>Section</th>
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
                    </tr>';
        $curRowGroup = $nextGroup = "";
        $totalEB = $totalHB = $totalHCB = $totalHCC = $totalLB = $totalNB = $totalPB = $totalSB = $totalWS = $totalHCBC = $totalSC = $totalBP = $totalHP = 0;
        while ($row = $searchResult->fetch_assoc()) {
// Closing the table after each group.
            $curRowGroup = $row['Group'];

            if (($curRowGroup != $nextGroup) && $nextGroup != "") {
                $searchedSectionsList .= '</table><br>';
            }
            $nextGroup = $curRowGroup;
// Opening new table and giving heading to the section.            
            if ($row['Group'] == "EB" && $countEB == 0) {
                $searchedSectionsList .= '
                    <h4><strong>Equivalent Welded Beams</strong></h4>
                    <table class="table table-striped">' . $th;
                $countEB = $countEB + 1;
            }
            if ($row['Group'] == "HB" && $countHB == 0) {
                $searchedSectionsList .= '
                    <h4><strong>Heavy Welded Beams</strong></h4>
                    <table class="table table-striped">' . $th;
                $countHB = $countHB + 1;
            }
            if ($row['Group'] == "HCB" && $countHCB == 0) {
                $searchedSectionsList .= '
                    <h4><strong>High Capacity Beams</strong></h4>
                    <table class="table table-striped">' . $th;
                $countHCB = $countHCB + 1;
            }
            if ($row['Group'] == "HCC" && $countHCC == 0) {
                $searchedSectionsList .= '
                    <h4><strong>High Capacity Columns</strong></h4>
                    <table class="table table-striped">' . $th;
                $countHCC = $countHCC + 1;
            }
            if ($row['Group'] == "LB" && $countLB == 0) {
                $searchedSectionsList .= '
                    <h4><strong>Light Welded Beams</strong></h4>
                    <table class="table table-striped">' . $th;
                $countLB = $countLB + 1;
            }
            if ($row['Group'] == "NB" && $countNB == 0) {
                $searchedSectionsList .= '
                    <h4><strong>Narrow Welded Beams</strong></h4>
                    <table class="table table-striped">' . $th;
                $countNB = $countNB + 1;
            }
            if ($row['Group'] == "PB" && $countPB == 0) {
                $searchedSectionsList .= '
                    <h4><strong>Perimeter Welded Beams</strong></h4>
                    <table class="table table-striped">' . $th;
                $countPB = $countPB + 1;
            }
            if ($row['Group'] == "SB" && $countSB == 0) {
                $searchedSectionsList .= '
                    <h4><strong>Standard Welded Beams</strong></h4>
                    <table class="table table-striped">' . $th;
                $countSB = $countSB + 1;
            }
            if ($row['Group'] == "WS" && $countWS == 0) {
                $searchedSectionsList .= '
                    <h4><strong>Wide Sections</strong></h4>
                    <table class="table table-striped">' . $th;
                $countWS = $countWS + 1;
            }
            if ($row['Group'] == "HCBC" && $countHCBC == 0) {
                $searchedSectionsList .= '
                    <h4><strong>High Capacity Beam-Columns</strong></h4>
                    <table class="table table-striped">' . $th;
                $countHCBC = $countHCBC + 1;
            }
            if ($row['Group'] == "SC" && $countSC == 0) {
                $searchedSectionsList .= '
                    <h4><strong>Standard Welded Columns</strong></h4>
                    <table class="table table-striped">' . $th;
                $countSC = $countSC + 1;
            }
            if ($row['Group'] == "BP" && $countBP == 0) {
                $searchedSectionsList .= '
                    <h4><strong>Welded Bearing Piles</strong></h4>
                    <table class="table table-striped">' . $th;
                $countBP = $countBP + 1;
            }
            if ($row['Group'] == "HP" && $countHP == 0) {
                $searchedSectionsList .= '
                    <h4><strong>Welded H Piles</strong></h4>
                    <table class="table table-striped">' . $th;
                $countHP = $countHP + 1;
            }

            $searchedSectionsList .= '<tr>'
                    . '<td><u><a href="engineering-properties.php?section=' . $row['section'] . '" class="text-info">' . $row['section'] . '</a></u></td>'
                    . '<td>' . $row['depth'] . '</td>'
                    . '<td>' . $row['width'] . '</td>'
                    . '<td>' . $row['area'] . '</td>'
                    . '<td>' . $row['Ix1'] . '</td>'
                    . '<td>' . $row['Iyxaxis'] . '</td>'
                    . '<td>' . $row['Zxxaxis'] . '</td>'
                    . '<td>' . $row['Zyyaxis'] . '</td>'
                    . '<td>' . $row['weight'] . '</td>'
                    . '<td>' . $row['tf'] . '</td>'
                    . '<td>' . $row['tw'] . '</td>'
                    . '<td>' . $row['StandardWeld'] . '</td>'
                    . '</tr>';
        }
        $selectedGroup = "";
    } else {

        $selectedGroup = "";
        $displaySection = "";
        $displaySearchResult = "no";
    }
}
?>