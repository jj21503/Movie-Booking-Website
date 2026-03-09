<?php 
include('db.php'); 
include('auth.php');

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

mysqli_query($conn, "DELETE FROM bookings WHERE id='$id' AND user_id='$user_id'");
header("Location: bookings.php");
exit();
?>