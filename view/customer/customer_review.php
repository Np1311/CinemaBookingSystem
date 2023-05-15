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

      /* CSS for review form */
      body {
        font-family: Arial, sans-serif;
        background-color: #f1f1f1;
      }

      h1 {
        text-align: center;
        font-size: 32px;
        margin-top: 40px;
      }

      form {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
      }

      input[type="text"],
      input[type="submit"],
      textarea {
        width: 100%;
        padding: 12px;
        margin: 6px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 18px;
      }

      label {
        font-size: 18px;
        font-weight: bold;
        margin-top: 10px;
        display: block;
      }

      textarea {
        height: 150px;
        resize: none;
      }

      input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        font-size: 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
      }

      input[type="submit"]:hover {
        background-color: #45a049;
      }

      a button {
        background-color: #008CBA;
        color: #fff;
        font-size: 18px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
        padding: 12px;
        text-decoration: none;
        display: inline-block;
      }

      a button:hover {
        background-color: #006080;
      }
      .homeButton{
          display: block;
          margin: 0 auto;
          width: 700px;
          text-decoration: none;
          color: black;
          border: none;
      }

      .homeButton:hover {
        background-color: #286090;
        cursor: pointer;
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

                <label for="room_name"style="display:none;">Room ID:</label>
                <input type="hidden" id="room_name" name="room_ID" value="<?php echo $booking['roomID'];?>" required><br><br>
        
                <label for="room_name">Room Name:</label>
                <input type="text" id="room_name" name="room_name" value="<?php echo $booking['roomName'];?>" required><br><br>

                <label for="room_name" style="display:none;">Movie ID:</label>
                <input type="hidden" id="room_name" name="movieID" value="<?php echo $booking['movieID'];?>" required><br><br>
        
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
        </br></br>
        <?php
        }
        ?>
    <?php
        
        if (isset($_POST['submit'])) {
            $bookingID = $_POST['booking_id'];
            $roomID = $_POST['room_ID'];
            $movieID = $_POST['movieID'];
            $movieName = $_POST['movie_name'];
            $showTiming = $_POST['show_timing'];
            $rating = $_POST['rating'];
            $review = $_POST['review'];
        
            if($controller -> addReviewController($bookingID, $roomID,$movieID,$movieName,$showTiming,$rating,$review)){
              echo" <script>window.location='customer_review.php';</script>";
            }
        }
        
    ?>
    <a href="customer_home_view.php"><button class="homeButton">Home</button></a>
  </body>
</html>
