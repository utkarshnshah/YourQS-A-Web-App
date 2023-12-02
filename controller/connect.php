<?php

//Open a new connection to the MySQL server
$con = new mysqli('localhost', 'root', '', 'bisco');
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
}
date_default_timezone_set('UTC');
?> 