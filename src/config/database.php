<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ad_agency_db";
$port = "3307";

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
