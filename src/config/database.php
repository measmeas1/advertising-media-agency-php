<?php
$host = "localhost";
$host_user = "root";
$psw = "123456";
$db = "ad_agency_db";

$conn = mysqli_connect($host, $host_user, $psw, $db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
