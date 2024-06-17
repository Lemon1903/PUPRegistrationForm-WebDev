<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "college_reg_db";

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if (!is_null($mysqli->connect_error)) {
    throw new Exception('Connection failed: ' . $mysqli->connect_error);
}
