<?php
require ('header_customer.html');
require('../../controller/booking_controller.php');

// Check if there are showing movies available
if($booking_controller -> getShowingMovie_controller() == false){
    echo '<script>alert("No Movie listed")</script>';
}else{
    // Get the showing movies array
    $array = $booking_controller -> getShowingMovie_controller();
}



?>
<html>
    <head>
        <title>Capybara Cinema</title>
        <style>
            /* Styles for the form container */
            .formContainer{
                
                background: black;
                color: white;
                margin: auto;
                width: 30%;
                border: 3px solid white;
                padding: 10px;
                font-family : Arial ;
                margin-top: 80px;
            
            }
            /* Styles for the primary button */
            .btn-primary{
                background-color: white; 
                border: 2px solid white;
                color: white;
                padding: 15px ;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                border-radius: 8px;
                width: 400px;
                /* margin-left: 100px; */
            }
            /* Styles for the form control */
            .form-control{
                white-space: nowrap;
                overflow: hidden;
                width: 100%;
                text-overflow: ellipsis;
            }
            /* Styles for the input group text */
            .input-group-text{
                font-size: 20px;
            }
            

            /* Styles for the movie container */
            .movie-container {
                margin-top : 100px;
                max-width: 1200px;
                margin-left: 150px ;
                padding: 20px;
            }

            /* Styles for the movie list */
            .movie-list {
                display: flex;
                flex-wrap: wrap;
            }
            /* Styles for individual movie cards */
            .movie {
                
                width: 300px;
                margin: 20px;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                position: relative;
                transition: background-color 0.3s ease-in-out;
                box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
            }
            /* Styles for movie images */
            .movie img {
                width: 100%;
                height: 400px;
                object-fit: cover;
                border-radius: 5px;
            }
            /* Styles for movie titles */
            .movie h2 {
                font-size: 24px;
                margin-top: 10px;
                margin-bottom: 5px;
            }
            /* Styles for movie details */
            .movie p {
                font-size: 16px;
                margin-top: 5px;
                margin-bottom: 10px;
            }
            /* Styles for movie booking buttons */
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
            /* Styles for movie booking buttons on hover */
            .movie button:hover {
            background-color:white;
            color: #bd9a7a;
            border: 2px solid #bd9a7a;
            }
            /* Background color for body */
            body {background-color: #e7dbd0}
            
            /*body {font-family: Verdana, sans-serif; margin:0}*/
            /* Styles for images */
            img {vertical-align: middle;}
            
        </style>
    </head>
    <body>        
        
        <div class="movie-container">
           
                <div class="movie-list">
                <?php
                foreach($array as $key=>$arr){
                ?>
                    <div class="movie">
                        <!-- Movie Information -->
                        <img src="<?php echo $arr['movieBanner'];?>" alt="Movie 1">
                        <h1 style="text-align: center;"><?php echo $arr['movieName'];?></h1>
                        <p><b>Genre: </b><?php echo $arr['genre'];?></p>
                        <p><b>Duration: </b><?php echo $arr['duration'];?>&nbspminutes</p></br>

                        <!-- Booking Date input -->
                        <label for="number"><b>Booking Date:</b></label></br>
                        <input type="date" id="booking_date_<?php echo $arr['movieID'];?>" style="border-radius:10px;width: 300px;height: 50px;" name="booking_date" required></br></br>

                        <!-- Booking time slots buttons -->
                        <a href="customer_booking.php?bookingID=<?php echo $arr['movieID'];?>&showTiming=<?php echo $arr['timing1'];?>"  style="text-decoration: none;">
                            <button><?php echo $arr['timing1'];?></button>
                        </a></br>

                        <a href="customer_booking.php?bookingID=<?php echo $arr['movieID'];?>&showTiming=<?php echo $arr['timing2'];?>"  style="text-decoration: none;">
                            <button><?php echo $arr['timing2'];?></button>
                        </a></br>

                        <a href="customer_booking.php?bookingID=<?php echo $arr['movieID'];?>&showTiming=<?php echo $arr['timing3'];?>"  style="text-decoration: none;">
                            <button><?php echo $arr['timing3'];?></button>
                        </a></br>

                        <?php 
                        if($arr['timing4'] != 0){
                        ?>
                        <a href="customer_booking.php?bookingID=<?php echo $arr['movieID'];?>&showTiming=<?php echo $arr['timing4'];?>" style="text-decoration: none;">
                            <button><?php echo $arr['timing4'];?></button>
                        </a>
                        <?php
                        }
                        ?>

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