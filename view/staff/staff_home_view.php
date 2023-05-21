<?php
require('../../controller/booking_controller.php');
require('../header_login.php');

// Check if there are any showing movies
if($booking_controller -> getShowingMovie_controller() == false){
    echo '<script>alert("No Movie listed")</script>';
}else{
    // Retrieve the array of showing movies
    $array = $booking_controller -> getShowingMovie_controller();
}
// Output the array
print_r($array);

?>
<html>
    <head>
        <title>Capybara Cinema</title>
        <style>
            body {
            background-color: #e7dbd0;
            margin: 0;
            }

            .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            /* margin-top: 5px; */
            flex-direction: column-reverse; 
            margin-right:10px;
            }


            .form-container form {
            display: flex;
            align-items: center;
            margin-right: 10px;
            margin-bottom: 10px; 
            }

            .view-all-form {
            display: inline-block;
            background-color: #bd9a7a;
            border: 2px solid #bd9a7a;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            width:300px;
            margin-right:50px;
            }

            .view-all-form:hover{
            background-color: white;
            color: #bd9a7a;
            border: 2px solid #bd9a7a;
            }

            .form-container input[type="text"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 5px;
            width:400px;
            }

            .form-container button[type="submit"] {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #bd9a7a;
            color: white;
            cursor: pointer;
            width:100px;
            }

            .form-container button[type="submit"]:hover {
            background-color: white;
            color:#bd9a7a;
            }

            .view-all-form button[type="submit"] {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #bd9a7a; /* Update the background color */
            color: white;
            cursor: pointer;
            }

            .btn-primary {
            background-color: #bd9a7a;
            border: 2px solid white;
            color: white;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 8px;
            width: 400px;
            }

            .form-control {
            white-space: nowrap;
            overflow: hidden;
            width: 100%;
            text-overflow: ellipsis;
            }

            .input-group-text {
            font-size: 20px;
            }

            .movie-container {
                margin-top : 100px;
                max-width: 1200px;
                margin-left: 150px ;
                padding: 20px;
            }
            
            .movie-list {
                display: flex;
                flex-wrap: wrap;
            }
            .movie {
                
                width: 300px;
                margin: 20px;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                position: relative;
                transition: background-color 0.3s ease-in-out;
                box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
                margin-right:50px;
            }
            .movie img {
                width: 100%;
                height: 400px;
                object-fit: cover;
                border-radius: 5px;
            }
            .movie h2 {
                font-size: 24px;
                margin-top: 10px;
                margin-bottom: 5px;
            }
            .movie p {
                font-size: 16px;
                margin-top: 5px;
                margin-bottom: 10px;
            }
            .movie button {
                display: block;
                width: 100%;
                padding: 10px;
                border: none;
                border-radius: 5px;
                background-color: #bd9a7a;
                color: #fff;
                font-size: 16px;
                cursor: pointer;
            }
            .movie button:hover {
                background-color:white;
                color: #bd9a7a;
                border: 2px solid #bd9a7a;
            }
            body {background-color: #e7dbd0}

            .movie input[type="date"] {
            border-radius: 10px;
            width: 300px;
            height: 50px;
            }

            .movie-button button {
            display: block;
            width: 100%;
            border: none;
            border-radius: 5px;
            background-color: #bd9a7a;
            color: white;
            font-size: 16px;
            cursor: pointer;
            padding: 10px 15px; /* Add this line to set the padding */
            margin-bottom: 5px; /* Add this line to set the margin */
            }

            .movie-button button:hover {
            background-color: white;
            color: #bd9a7a;
            }


            .button-container {
            display: flex;
            justify-content: center;
            margin-top: 10px;
            gap:10px;
            }

            .button-container form {
            margin-right: 10px;
            display: inline; /* Add this line to align the button horizontally */
            
            }

        </style>
    </head>
    <body>        
        
        <div class="movie-container">

        <div class="form-container">
        <form method="post">
            <input type="text" name="bookedID" placeholder="Booking ID...">
            <button type="submit" name="bookedIDSubmit">Search</button>
        </form>
        <?php 
        // Check if the booking ID form is submitted
        if(isset($_POST['bookedIDSubmit'])){
            $bookedID = $_POST['bookedID'];
            echo" <script>window.location='staff_view_booking.php?bookedID=$bookedID';</script>";
        }
        ?>
        <form method="post">
            <input type="text" name="orderID" placeholder="Order ID...">
            <button type="submit" name="orderIDSubmit">Search</button>
        </form>
        <?php 
        // Check if the order ID form is submitted
        if(isset($_POST['orderIDSubmit'])){
            $orderID = $_POST['orderID'];
            echo" <script>window.location='staff_view_foodOrder.php?orderID=$orderID';</script>";
        }
        ?>
        <form method="post">
            <input type="text" name="searchInput" placeholder="Search Movie...">
            <button type="submit" name="submit">Search</button>
        </form>
        </div>
            <?php 
            // Check if the search form is submitted
            if(isset($_POST['submit'])){
                $searchInput = $_POST['searchInput'];

                if($booking_controller->searchMovieController($searchInput) == false){
                    echo '<script>alert("'.$searchInput.' is not found")</script>';  
                }else{
                    $array = $booking_controller->searchMovieController($searchInput);
                }
            }
            ?>
            <div class="button-container">
            <form method="post">
                <button type="submit" class="view-all-form" name="viewAll">View All</button>
            </form>
                
            </div>


            <?php
                // Check if the View All button is clicked
                if (isset($_POST['viewAll'])) {
                    if($booking_controller -> getShowingMovie_controller() == false){
                        echo '<script>alert("No Movie listed")</script>';
                    }else{
                        $array = $booking_controller -> getShowingMovie_controller();
                    }
                           
                }
            ?>
            <!--Display movie for booking-->
                <div class="movie-list">
                <?php
                foreach($array as $key=>$arr){
                ?>
                    <div class="movie">
                        <img src="<?php echo $arr['movieBanner'];?>" alt="Movie 1">
                        <h2 style="text-align: center;"><?php echo $arr['movieName'];?></h2>
                        </br>
                        <p><b>Genre: </b><?php echo $arr['genre'];?></p>
                        <p><b>Duration: </b><?php echo $arr['duration'];?>&nbspminutes</p></br>
                        <div class="movie-button">
                            <label for="number"><b>Booking Date:</b></label></br>
                            <input type="date" id="booking_date_<?php echo $arr['movieID'];?>" style="border-radius:10px;width: 300px;height: 50px;" name="booking_date" required></br></br>

                            <a href="staff_booking.php?bookingID=<?php echo $arr['movieID'];?>&showTiming=<?php echo $arr['timing1'];?>"  style="text-decoration: none;">
                                <button><?php echo $arr['timing1'];?></button>
                            </a></br></br>

                            <a href="staff_booking.php?bookingID=<?php echo $arr['movieID'];?>&showTiming=<?php echo $arr['timing2'];?>"  style="text-decoration: none;">
                                <button><?php echo $arr['timing2'];?></button>
                            </a></br></br>

                            <a href="staff_booking.php?bookingID=<?php echo $arr['movieID'];?>&showTiming=<?php echo $arr['timing3'];?>"  style="text-decoration: none;">
                                <button><?php echo $arr['timing3'];?></button>
                            </a></br></br>

                            <?php 
                            if($arr['timing4'] != 0){
                            ?>
                            <a href="staff_booking.php?bookingID=<?php echo $arr['movieID'];?>&showTiming=<?php echo $arr['timing4'];?>" style="text-decoration: none;">
                                <button><?php echo $arr['timing4'];?></button>
                            </a>
                            <?php
                            }
                            ?>
                        </div>

                        <script>
                        // add date to booking button URLs when clicked
                        var bookingButtons = document.querySelectorAll('.movie a');
                        for (var i = 0; i < bookingButtons.length; i++) {
                            bookingButtons[i].addEventListener('click', function(e) {
                                var movie = e.currentTarget.closest('.movie');
                                var dateInput = movie.querySelector('input[name="booking_date"]');
                                var dateValue = dateInput.value;
                                var url = e.currentTarget.href;
                                if (url.indexOf('&date=') > -1) {
                                    url = url.replace(/&date=.*?(&|$)/, '&date=' + dateValue + '$1');
                                } else {
                                    url += '&date=' + dateValue;
                                }
                                e.currentTarget.href = url;
                            });
                        }
                        </script>

                    </div>
                <?php
                }
                ?>

                </div>
            
        </div>
        <?php
        
        require('../footer.html');
        ?>
        
    </body>
</html>