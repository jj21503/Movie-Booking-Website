<?php 
include('db.php'); 
session_start(); 

if (isset($_SESSION['user_id'])) {
    header("Location: movies.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: white;
            padding: 50px;
            margin: 0;
        }
        
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #2d2d2d;
            padding: 40px;
            border: 1px solid #444;
        }
        
        h2 {
            font-family: Georgia, serif;
            text-align: center;
            margin-bottom: 30px;
            margin-top: 0;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #1a1a1a;
            border: 1px solid #555;
            color: white;
            box-sizing: border-box;
        }
        
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #333;
            color: white;
            border: 1px solid #555;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
        }
        
        .error {
            background-color: #5c1a1a;
            color: #ff6b6b;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #8b0000;
        }
        
        .success {
            background-color: #1a5c1a;
            color: #51cf66;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #006400;
        }
        
        p {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        
        a {
            color: #ccc;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Register</h2>

    <?php 
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            echo "<div class='error'>Email already registered!</div>";
        } else {
            $insert = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
            if (mysqli_query($conn, $insert)) {
                echo "<div class='success'>Registration successful! <a href='login.php' style='color: #51cf66;'>Login here</a></div>";
            } else {
                echo "<div class='error'>Error: " . mysqli_error($conn) . "</div>";
            }
        }
    }
    ?>

    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <input type="submit" name="register" value="Register">
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

</body>
</html>