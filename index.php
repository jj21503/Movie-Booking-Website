<?php 
session_start(); 

if (isset($_SESSION['user_id'])) {
    header("Location: movies.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Movie Booker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: white;
            text-align: center;
            padding: 100px 20px;
            margin: 0;
        }
        
        h1 {
            font-family: Georgia, serif;
            font-size: 66px;
            font-weight: 400;
            margin-bottom: 20px;
        }
        
        p {
            font-size: 18px;
            margin-bottom: 40px;
            color: #ccc;
        }
        
        a {
            display: inline-block;
            padding: 15px 40px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border: 1px solid #555;
            font-size: 16px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<h1>Movie Booker</h1>
<p>Book Your Cinema Experience</p>
<a href="login.php">Get Started</a>

</body>
</html>