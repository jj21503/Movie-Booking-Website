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
    <title>Login</title>
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
    <h2>Login</h2>

    <?php 
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                header("Location: movies.php");
                exit();
            } else {
                echo "<div class='error'>Wrong password!</div>";
            }
        } else {
            echo "<div class='error'>Email not found!</div>";
        }
    }
    ?>

    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <input type="submit" name="login" value="Login">
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>

</body>
</html>