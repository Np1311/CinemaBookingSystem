<?php
require('../../controller/customer_controller.php');
session_start();
$phone = $_SESSION['customerID'];
$array = $controller->getBookingController($phone);

print_r($array);


?>

<html>
  <head>
    <title>Movie Review Form</title>
    <style>
      /* CSS for star rating */
      /* CSS for star rating */
        .stars {
        display: inline-block;
        direction: rtl;
        }
        .stars input[type="radio"] {
        display: none;
        }
        .stars label {
        font-size: 30px;
        color: #ccc;
        cursor: pointer;
        display: inline-block;
        transform: rotateY(180deg);
        }
        .stars label:hover,
        .stars label:hover ~ label,
        .stars input[type="radio"]:checked ~ label {
        color: #ffcc00;
        }

    </style>
  </head>
  <body>
    <h1>Movie Review Form</h1>
    <?php
        foreach ($array as $booking) {
        ?>
            <form method="post">
                <label for="booking_id">Booking ID:</label>
                <input type="text" id="booking_id" name="booking_id" value="<?php echo $booking['bookingID'];?>"><br><br>
        
                <label for="room_name">Room Name:</label>
                <input type="text" id="room_name" name="room_name" value="<?php echo $booking['roomName'];?>" required><br><br>
        
                <label for="movie_name">Movie Name:</label>
                <input type="text" id="movie_name" name="movie_name" value="<?php echo $booking['movieName'];?>" required><br><br>
        
                <label for="show_timing">Show Timing:</label>
                <input type="text" id="show_timing" name="show_timing" value="<?php echo $booking['showTiming'];?>" required><br><br>
        
                <label for="rating">Rating:</label>
                <div class="stars">
                    <input type="radio" id="5stars" name="rating" value="5">
                    <label for="5stars">&#9733;</label>
                    <input type="radio" id="4stars" name="rating" value="4">
                    <label for="4stars">&#9733;</label>
                    <input type="radio" id="3stars" name="rating" value="3">
                    <label for="3stars">&#9733;</label>
                    <input type="radio" id="2stars" name="rating" value="2">
                    <label for="2stars">&#9733;</label>
                    <input type="radio" id="1star" name="rating" value="1">
                    <label for="1star">&#9733;</label>
                </div>
                <br><br>
        
                <label for="review">Review:</label><br>
                <textarea id="review" name="review" rows="5" cols="50"></textarea><br><br>
        
                <input type="submit" name ='submit' value="Submit">
            </form> 
        <?php
        }
        ?>
    <?php
        
        if (isset($_POST['submit'])) {
            $booking_id = $_POST['booking_id'];
            $room_name = $_POST['room_name'];
            $movie_name = $_POST['movie_name'];
            $show_timing = $_POST['show_timing'];
            $rating = $_POST['rating'];
            $review = $_POST['review'];
        
          // Code to process and save the review goes here
            echo $rating;
            echo '</br>';
            echo $review;
            echo '</br>';
          echo "<p>Thank you for your review!</p>";
        }
        
        
    ?>
  </body>
</html>
