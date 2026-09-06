<?php
$host = "localhost";
$username = "teama3";
$password = "cInMgLH2tZxAvqK4X5ZT";
$dbname = "matrimaa";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
  die("Database Connection Failed: " . mysqli_connect_error());
}
?>