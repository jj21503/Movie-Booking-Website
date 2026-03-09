<?php 
include('db.php'); 
include('auth.php'); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: white;
            padding: 50px 20px;
            margin: 0;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .back-link {
            color: #ccc;
            text-decoration: none;
            margin-bottom: 30px;
            display: inline-block;
        }
        
        h1 {
            font-family: Georgia, serif;
            text-align: center;
            font-size: 36px;
            margin: 0 0 40px 0;
        }
        
        .booking {
            background-color: #2d2d2d;
            border: 1px solid #444;
            padding: 30px;
            margin-bottom: 20px;
        }
        
        .booking h3 {
            font-family: Georgia, serif;
            margin: 0 0 20px 0;
            font-size: 22px;
            border-bottom: 1px solid #444;
            padding-bottom: 15px;
        }
        
        .booking-details {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .booking-info {
            color: #ccc;
        }
        
        .booking-info-label {
            display: block;
            font-size: 12px;
            color: #888;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .booking-info-value {
            font-size: 16px;
            color: white;
        }
        
        .booking p {
            color: #ccc;
            margin: 5px 0;
        }
        
        .cancel-btn {
            margin-top: 5px;
            padding: 10px 20px;
            background-color: #5c1a1a;
            color: #ff6b6b;
            border: 1px solid #8b0000;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
        }
        
        .no-bookings {
            text-align: center;
            padding: 40px;
            color: #ccc;
        }
        
        .no-bookings a {
            color: white;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="movies.php" class="back-link">← Back to Movies</a>
    <h1>My Bookings</h1>

    <?php
    $user_id = $_SESSION['user_id'];
    
    // JOIN query to get booking details with movie and showtime info
    $query = "SELECT b.id, m.title, s.show_date, s.show_time, b.seats 
              FROM bookings b 
              JOIN showtimes s ON b.showtime_id = s.id 
              JOIN movies m ON s.movie_id = m.id 
              WHERE b.user_id = '$user_id' 
              ORDER BY s.show_date DESC, s.show_time DESC";
    
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $time = date("g:i A", strtotime($row['show_time']));
            $title = htmlspecialchars($row['title']);
            $date = htmlspecialchars($row['show_date']);
            $seats = $row['seats'];
            $booking_id = $row['id'];
            ?>
            
            <div class='booking'>
                <h3><?php echo $title; ?></h3>
                <div class='booking-details'>
                    <div class='booking-info'>
                        <span class='booking-info-label'>DATE</span>
                        <span class='booking-info-value'><?php echo $date; ?></span>
                    </div>
                    <div class='booking-info'>
                        <span class='booking-info-label'>TIME</span>
                        <span class='booking-info-value'><?php echo $time; ?></span>
                    </div>
                    <div class='booking-info'>
                        <span class='booking-info-label'>SEATS</span>
                        <span class='booking-info-value'><?php echo $seats; ?></span>
                    </div>
                </div>
                <button class='cancel-btn' onclick="if(confirm('Cancel this booking?')) { window.location='cancel.php?id=<?php echo $booking_id; ?>'; }">Cancel Booking</button>
            </div>
            
            <?php
        }
    } else {
        ?>
        <div class='no-bookings'>
            <p>No bookings yet.</p>
            <a href='movies.php'>Start booking a movie →</a>
        </div>
        <?php
    }
    ?>
</div>

</body>
</html>