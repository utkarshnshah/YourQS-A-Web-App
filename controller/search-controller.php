<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET['search'])) {
        if ($_GET['search'] == "beams") {
            $selectedGroup = "EB";
            $selectedGroupName = "Beams";
            $_SESSION["selectedGroup"] = "Beams";
            $_SESSION["selectedGroupName"] = "Beams";
        } elseif ($_GET['search'] == "columns") {
            $selectedGroup = "EB";
            $selectedGroupName = "columns";
            $_SESSION["selectedGroup"] = "Columns";
            $_SESSION["selectedGroupName"] = "Columns";
        } elseif ($_GET['search'] == "piles") {
            $selectedGroup = "EB";
            $selectedGroupName = "piles";
            $_SESSION["selectedGroup"] = "Piles";
            $_SESSION["selectedGroupName"] = "Piles";
        } elseif ($_GET['search'] == "eb") {
            $selectedGroup = "EB";
            $selectedGroupName = "Equivalent Welded Beams";
            $_SESSION["selectedGroup"] = "EB";
            $_SESSION["selectedGroupName"] = "Equivalent Welded Beams";
        } elseif ($_GET['search'] == "hb") {
            $selectedGroup = "HB";
            $selectedGroupName = "Heavy Welded Beams";
            $_SESSION["selectedGroup"] = "HB";
            $_SESSION["selectedGroupName"] = "Heavy Welded Beams";
        } elseif ($_GET['search'] == "hcb") {
            $selectedGroup = "HCB";
            $selectedGroupName = "High Capacity Beams";
            $_SESSION["selectedGroup"] = "HCB";
            $_SESSION["selectedGroupName"] = "High Capacity Beams";
        } elseif ($_GET['search'] == "hcc") {
            $selectedGroup = "HCC";
            $selectedGroupName = "High Capacity Columns";
            $_SESSION["selectedGroup"] = "HCC";
            $_SESSION["selectedGroupName"] = "High Capacity Columns";
        } elseif ($_GET['search'] == "lb") {
            $selectedGroup = "LB";
            $selectedGroupName = "Light Welded Beams";
            $_SESSION["selectedGroup"] = "LB";
            $_SESSION["selectedGroupName"] = "Light Welded Beams";
        } elseif ($_GET['search'] == "nb") {
            $selectedGroup = "NB";
            $selectedGroupName = "Narrow Welded Beams";
            $_SESSION["selectedGroup"] = "NB";
            $_SESSION["selectedGroupName"] = "Narrow Welded Beams";
        } elseif ($_GET['search'] == "pb") {
            $selectedGroup = "PB";
            $selectedGroupName = "Perimeter Welded Beams";
            $_SESSION["selectedGroup"] = "PB";
            $_SESSION["selectedGroupName"] = "Perimeter Welded Beams";
        } elseif ($_GET['search'] == "sb") {
            $selectedGroup = "SB";
            $selectedGroupName = "Standard Welded Beams";
            $_SESSION["selectedGroup"] = "SB";
            $_SESSION["selectedGroupName"] = "Standard Welded Beams";
        } elseif ($_GET['search'] == "ws") {
            $selectedGroup = "WS";
            $selectedGroupName = "Wide Sections";
            $_SESSION["selectedGroup"] = "WS";
            $_SESSION["selectedGroupName"] = "Wide Sections";
        } elseif ($_GET['search'] == "hcbc") {
            $selectedGroup = "HCBC";
            $selectedGroupName = "High Capacity Beam-Columns";
            $_SESSION["selectedGroup"] = "HCBC";
            $_SESSION["selectedGroupName"] = "High Capacity Beam-Columns";
        } elseif ($_GET['search'] == "sc") {
            $selectedGroup = "SC";
            $selectedGroupName = "Standard Welded Columns";
            $_SESSION["selectedGroup"] = "SC";
            $_SESSION["selectedGroupName"] = "Standard Welded Columns";
        } elseif ($_GET['search'] == "bp") {
            $selectedGroup = "BP";
            $selectedGroupName = "Welded Bearing Piles";
            $_SESSION["selectedGroup"] = "BP";
            $_SESSION["selectedGroupName"] = "Welded Bearing Piles";
        } elseif ($_GET['search'] == "hp") {
            $selectedGroup = "HP";
            $selectedGroupName = "Welded H Piles";
            $_SESSION["selectedGroup"] = "HP";
            $_SESSION["selectedGroupName"] = "Welded H Piles";
        }
    }
}
?>