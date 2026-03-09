<?php 
include('db.php'); 
include('auth.php'); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Movies</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: white;
            padding: 40px 20px;
            margin: 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .welcome {
            font-size: 18px;
            color: #ccc;
            margin: 0 0 10px 0;
        }
        
        h1 {
            font-family: Georgia, serif;
            font-size: 36px;
            margin: 0 0 30px 0;
        }
        
        .nav {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #333;
            border: 1px solid #555;
            margin: 0 10px;
            display: inline-block;
            font-weight: 600;
        }
        
        .movies {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }
        
        .movie {
            background-color: #2d2d2d;
            border: 1px solid #444;
            width: 280px;
        }
        
        .movie-poster {
            width: 100%;
            height: 320px;
            background-color: #1a1a1a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
        }
        
        .movie-poster img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .movie-info {
            padding: 20px;
        }
        
        .movie h3 {
            font-family: Georgia, serif;
            margin: 0 0 10px 0;
            font-size: 18px;
        }
        
        .movie-details {
            color: #ccc;
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .book-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #333;
            color: white;
            text-align: center;
            text-decoration: none;
            border: 1px solid #555;
            box-sizing: border-box;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <p class="welcome">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</p>
        <h1>Available Movies</h1>
    </div>

    <div class="nav">
        <a href="bookings.php">My Bookings</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="movies">
        <?php
        $movies = mysqli_query($conn, "SELECT * FROM movies");
        
        if (mysqli_num_rows($movies) > 0) {
            while ($movie = mysqli_fetch_assoc($movies)) {
                echo "<div class='movie'>";
                echo "<div class='movie-poster'>";
                if (!empty($movie['image_path'])) {
                    echo "<img src='" . htmlspecialchars($movie['image_path']) . "' alt='" . htmlspecialchars($movie['title']) . "'>";
                } else {
                    echo "🎬";
                }
                echo "</div>";
                echo "<div class='movie-info'>";
                echo "<h3>" . htmlspecialchars($movie['title']) . "</h3>";
                echo "<div class='movie-details'>" . htmlspecialchars($movie['genre']) . " - " . $movie['duration'] . " mins</div>";
                echo "<a href='book.php?movie_id=" . $movie['id'] . "' class='book-btn'>Book Now</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No movies available.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>