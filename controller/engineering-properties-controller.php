<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET['section'])) {
        $selectedSection = $_GET['section'];
    }
    if (!empty($selectedSection)) {
        $qSection = "SELECT s.Group AS groupName, s.Section AS section, e.D AS depth, e.`kg/m` AS kgm, 
            s.bf AS width, e.tf AS tf, e.`tw1` AS tw1, e.`d11` AS d11, ROUND(e.`v*w (/1#5d1)`,3) AS vw15d1, s.StandardWeld AS StandardWeld, 
            e.`d1/tw` AS d1tw, e.`bf-tw 2tf` AS bftw2tf, e.Ag AS Ag, ROUND(e.`Ix1`) AS Ix1, 
            ROUND(e.`Zx x-axis`) AS Zxxaxis, e.`Sx x-axis` AS Sxxaxis, e.`rx x-axis` AS rxxaxis, 
            ROUND(e.`Iy x-axis`,1) AS Iyxaxis, e.`Zy y-axis` AS Zyyaxis, e.`Sy y-axis` AS Syyaxis, 
            ROUND(e.`ry y-axis`,1) AS ryyaxis, e.`J1` AS J1, ROUND(e.`Iw1`) AS Iw1, e.fy AS fy, e.`fy1` AS fy1, 
            ROUND(e.kf,3) AS kf, e.`Compact x-axis` AS Compactxaxis, ROUND(e.Zex) AS Zex, ROUND(e.Msx) AS Msx, 
            e.`Compact y-axis` AS Compactyaxis, ROUND(e.Zey) AS Zey, ROUND(e.`Hp/A/7#85 4 Side`,1) AS HpA7854Side, 
            e.`Hp/A 4 Side` AS HpA4Side, ROUND(e.`rf 4 Side`,1) AS rf4Side, ROUND(e.`Hp/A/7#85 3 Side`) AS HpA7853Side, 
            ROUND(e.`Hp/A`) AS HpA, ROUND(e.`rf 3 Side`,3) AS rf3Side 
            FROM standardsections AS s, engineeringproperties AS e 
            WHERE s.Section=e.Section AND e.Section='" . $selectedSection . "'";

        $section = $con->query($qSection);
        if ($section->num_rows > 0) {
            while ($sectionRow = $section->fetch_assoc()) {
                $groupName = $sectionRow['groupName'];
                $dDepth = $sectionRow['depth'];
                $kgm = $sectionRow['kgm'];
                $bfWidth = $sectionRow['width'];
                $tfThickness = $sectionRow['tf'];
                $twThickness = $sectionRow['tw1'];
                $d1Depth = $sectionRow['d11'];
                $vw15d1FilletWeld = $sectionRow['vw15d1'];
                $standardWeld = $sectionRow['StandardWeld'];
                $d1tw = $sectionRow['d1tw'];
                $bftw2tf = $sectionRow['bftw2tf'];
                $agGrossArea = $sectionRow['Ag'];
                $ix = $sectionRow['Ix1'];
                $zx = $sectionRow['Zxxaxis'];
                $sx = $sectionRow['Sxxaxis'];
                $rx = $sectionRow['rxxaxis'];
                $iy = $sectionRow['Iyxaxis'];
                $zy = $sectionRow['Zyyaxis'];
                $sy = $sectionRow['Syyaxis'];
                $ry = $sectionRow['ryyaxis'];
                $jTorsion = $sectionRow['J1'];
                $iwWarping = $sectionRow['Iw1'];
                $fyFlange = $sectionRow['fy'];
                $fyWeb = $sectionRow['fy1'];
                $kfFormFactor = $sectionRow['kf'];
                $xaxisCompactness = $sectionRow['Compactxaxis'];
                $zex = $sectionRow['Zex'];
                $msx = $sectionRow['Msx'];
                $yaxisCompactness = $sectionRow['Compactyaxis'];
                $zey = $sectionRow['Zey'];
                $ksm4Sided = $sectionRow['HpA7854Side'];
                $hpa4Sided = $sectionRow['HpA4Side'];
                $rf4Sided = $sectionRow['rf4Side'];
                $ksm3Sided = $sectionRow['HpA7853Side'];
                $hpa3Sided = $sectionRow['HpA'];
                $rf3Sided = $sectionRow['rf3Side'];
            }
            // Setting image path
            if ($groupName == "EB" || $groupName == "HB" || $groupName == "HCB" || $groupName == "HCC" || $groupName == "LB" || $groupName == "NB" || $groupName == "PB" || $groupName == "SB" || $groupName == "WS") {
                $imagePath="img/sections/I.jpg";
            }
            else{
                $imagePath="img/sections/H.jpg";                
            }
        }
    }
}
?>