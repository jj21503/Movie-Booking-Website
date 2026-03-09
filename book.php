<?php 
include('db.php'); 
include('auth.php'); 

$movie_id = $_GET['movie_id'] ?? '';

if (empty($movie_id)) {
    echo "<!DOCTYPE html><html><head><title>Error</title></head><body style='background-color: #1a1a1a; color: white; padding: 50px; font-family: Arial;'><p>Movie not found!</p><a href='movies.php' style='color: #ccc;'>Back to Movies</a></body></html>";
    exit();
}

$movie = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM movies WHERE id=$movie_id"));

if (!$movie) {
    echo "<!DOCTYPE html><html><head><title>Error</title></head><body style='background-color: #1a1a1a; color: white; padding: 50px; font-family: Arial;'><p>Movie not found!</p><a href='movies.php' style='color: #ccc;'>Back to Movies</a></body></html>";
    exit();
}

$success = false;
if (isset($_POST['book'])) {
    $user_id = $_SESSION['user_id'];
    $showtime_id = $_POST['showtime_id'] ?? '';
    $seats = $_POST['seats'] ?? 0;
    
    if (!empty($showtime_id) && $seats > 0) {
        $query = "INSERT INTO bookings (user_id, showtime_id, seats) VALUES ('$user_id', '$showtime_id', '$seats')";
        if (mysqli_query($conn, $query)) {
            $success = true;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Movie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: white;
            padding: 50px;
            margin: 0;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .back-link {
            color: #ccc;
            text-decoration: none;
            margin-bottom: 20px;
            display: inline-block;
        }
        
        .book-section {
            background-color: #2d2d2d;
            border: 1px solid #444;
            padding: 40px;
        }
        
        h2 {
            font-family: Georgia, serif;
            margin: 0 0 10px 0;
        }
        
        .movie-info {
            color: #ccc;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #444;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            margin-top: 20px;
            font-weight: 500;
        }
        
        select,
        input[type="number"] {
            width: 100%;
            padding: 10px;
            background-color: #1a1a1a;
            border: 1px solid #555;
            color: white;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        
        select option {
            background-color: #2d2d2d;
            color: white;
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
        
        .success {
            background-color: #1a5c1a;
            color: #51cf66;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #006400;
        }
        
        .success a {
            color: #51cf66;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="movies.php" class="back-link">← Back to Movies</a>
    
    <?php if ($success): ?>
        <div class="success">Booking successful! <a href="bookings.php">View My Bookings →</a></div>
    <?php endif; ?>
    
    <div class="book-section">
        <h2><?php echo htmlspecialchars($movie['title']); ?></h2>
        <div class="movie-info">
            <?php echo htmlspecialchars($movie['genre']); ?> - <?php echo $movie['duration']; ?> mins
        </div>

        <form method="POST">
            <label>Select Showtime:</label>
            <select name="showtime_id" required>
                <option value="">-- Choose a showtime --</option>
                <?php
                $showtimes = mysqli_query($conn, "SELECT * FROM showtimes WHERE movie_id=$movie_id");
                while ($show = mysqli_fetch_assoc($showtimes)) {
                    $time = date("g:i A", strtotime($show['show_time']));
                    echo "<option value='" . $show['id'] . "'>" . $show['show_date'] . " at " . $time . "</option>";
                }
                ?>
            </select>

            <label>Number of Seats (1-10):</label>
            <input type="number" name="seats" min="1" max="10" required>

            <input type="submit" name="book" value="Book Now">
        </form>
    </div>
</div>

</body>
</html>