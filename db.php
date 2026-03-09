<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "movie_booking_db";

$conn = mysqli_connect($host, $user, $pass, $dbname, 3306);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>