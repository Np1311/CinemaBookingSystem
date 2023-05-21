<?php
//require ('../header_login.php');
require('../header.html');
require('../../controller/booking_controller.php');

$phone = 0;
$movie=$_GET['bookingID'];
$showTiming = $_GET['showTiming'];
$date = $_GET['date'];
$bookedID = 0;
/*
echo '<form method="post">';
echo '<input type="text" name="phone" placeholder="Search phone...">';
echo '<div style="text-align: center;">';
echo '<button type="submit" name="submit" class="btn">Search</button>';
echo '</div>';
echo '</form>';
*/


if(isset($_POST['submit'])){
    $phone = intval($_POST['phone']);
}

if($booking_controller -> getMovieDetail_controller($movie,$phone) == false){
echo '<script>alert("data is not found")</script>';  
}else{
    $array = $booking_controller -> getMovieDetail_controller($movie,$phone);
}





$alphabet = range('A', 'Z');
$letters = array();
foreach ($alphabet as $char) {
  $letters[] = $char;
}

$json_string = json_encode($letters);
$row = $array['totalRow'];
$column = $array['totalColumn'];
$selected_row = $array['seat_row'];
$selected_column = $array['seat_column'];
$loyalty_point = $array['loyalty_point'];
// $takenRow = 'I';
// $takenColumn = 4;
$takenSeat = $booking_controller ->takenSeats_controller($movie,$showTiming,$date,$bookedID);
var_dump($takenSeat);
echo "</br>";
var_dump($array);
echo "</br>";
echo $phone;

if ($selected_row === NULL){
    $selected_row = '';
}
?>

<html>
  <head>
    <title>Capybara Cinema</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <link rel="icon" href="cinemaLogo.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <script>
        var alphabet = JSON.parse('<?php echo $json_string; ?>');
        var total_price = 0;
        $(document).ready(function() {
            let selected_row = '<?php echo $selected_row;?>';
            let selected_column = <?php echo $selected_column;?>;
            let takenSeats = <?php echo json_encode($takenSeat);?>;
        
            for (let i = 1; i <= <?php echo $row;?>; i++) {
                let row = alphabet[i - 1];
            
                for (let j = 1; j <= <?php echo $column;?>; j++) {
                    let seatValue = row + j;
                    let checkedAttribute = (row === selected_row && j === selected_column) ? 'checked' : '';
                    let disabledAttribute = '';
                    for (let seat in takenSeats) {
                        if (takenSeats[seat].row === row && takenSeats[seat].column === String(j)) {
                            disabledAttribute = 'disabled';
                            break;
                        }
                    }
            
                    $('#seat_chart').append('<div class="col-md-1 mt-2 mb-2 ml-1 mr-2 text-center" style="background-color:grey;color:white"><input type="checkbox" id="seat" value="' + seatValue + '" name="seat_chart[]" class="mr-2 col-md-2 mb-2" onclick="checkboxtotal();" ' + checkedAttribute + ' ' + disabledAttribute + '>' + seatValue + '</div>');
                }
            }
            checkboxtotal();
        });



        function checkboxtotal() {
            var seat = [];
            $('input[name="seat_chart[]"]:checked').each(function() {
                if (!$(this).is(':disabled')) {
                    seat.push($(this).val());
                }
            });

            var st = seat.length;
            document.getElementById('no_ticket').value = st;

            var ad = st; // Set the initial value of adult tickets to the total number of tickets

            var ch = document.getElementById('child').value;
            var child = (ch * 4);

            var std = document.getElementById('student').value;
            var student = (std * 3);

            var sr = document.getElementById('senior').value;
            var senior = (sr * 2);

            ad = ad - parseInt(ch) - parseInt(std) - parseInt(sr); 

            total_price = ((st * 12) - (child) - (senior) - (student));
            $('#price_details').text("SGD$" + total_price);

            // Set the value of adult tickets input field using innerHTML
            document.getElementById('adult').value = ad;

            $('#seat_dt').val(seat.join(", "));
        }

        function goBack() {
            window.history.go(-1);
        }

        </script>
        <style>
        * {box-sizing:border-box}

        /* Add padding to containers */
        .container {
        padding: 16px;
        margin-right:5px;
        }

        /* Full-width input fields */
        textarea,input[type=text],  input[type=password], input[type=tel], input[type=number] , input[type=date]{
        width: 93%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
        }

        textarea,input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
        }

        /* Overwrite default styles of hr */
        hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
        }

        /* Set a style for the submit/register button */
        .registerbtn {
        background-color: #BD9A7A;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 50%;
        opacity: 0.9;

        }

        .registerbtn:hover {
        opacity:1;
        }

        /* Add a blue text color to links */
        a {
            color: dodgerblue;
        }

        /* Set a grey background color and center the text of the "sign in" section */
        .signin {
        background-color: #f1f1f1;
        text-align: center;
        }
        p,span{
            color:black !important;
        }
        #seat_chart input[type="checkbox"]:disabled {
            background-color: red !important;
        }
        

        .btn{
            background-color: #BD9A7A;
            color:white;
            margin: 0 auto;
        }

        .btn:hover{
            background-color: white;
            color:#BD9A7A;
            border: 2px solid #BD9A7A;
        }

        body{
            background-color: #e7dbd0;
        }
        </style>


    </head>
    <body>

        
        <section style=" margin-top: 1rem;">
            <h3 class="text-center">Book Your Ticket Now</h3>
            <div class="container">
            <div class="row">
                <div class="col-lg-12 offset-lg-1">
                <div id="seat-map" id="seatCharts">
                <h3 style="color:#BD9A7A; margin-top: 1rem;">Select Seat</h3>
                <hr>
                <label class="text-center" style="width:93%;background-color:#BD9A7A;color:white;padding:2%"> 
                SCREEN
                </label>

                <div class="row" id="seat_chart">                   
                </div>

                </div>
                <form method="post" style=" margin-top: 1rem;">
                    <div class="container" style="color:#BD9A7A;">
                    <center>
                        <p style=" margin-right: 5rem;">Please fill in this form to book your ticket.</p>
                    </center>

                    <hr>
                    <form method="post">
                    <input type="text" name="phone" placeholder="Search phone...">
                    <div style="text-align: center;">
                    <button type="submit" name="submit" class="btn" style="margin-right:8%;">Search</button>
                    </div>
                    </form>

                    <label for="Show"><b>Show Time</b></label>

                    <div class="form-group">
                        <select class="form-control"  name="show_id"  id="show_id" style="border-radius:30px;width:93%;">
                           
                            
                            <?php
                                echo '<option value="'.$showTiming.'">'.$array["timing1"].'</option>';
                            ?>
                                
                        </select>
                    </div>

                    <label for="psw"><b>No. of Tickets</b></label>
                    <input type="number" style="border-radius:30px;" id="no_ticket" name="no_ticket"  required>

                    <label for="psw-repeat"><b>Seat Details</b></label>
                    <input type="text" style="border-radius:30px;" name="seat_dt" id="seat_dt" required>

                    <label for="psw"><b>No. of Adult Tickets</b></label>
                    <input type="number" style="border-radius:30px;" id="adult" name="adult" value='0' onchange='checkboxtotal()'>

                    <label for="psw"><b>No. of Child Tickets</b></label>
                    <input type="number" style="border-radius:30px;" id="child" name="child" value='0' onchange='checkboxtotal()'>

                    <label for="psw"><b>No. of Student Tickets</b></label>
                    <input type="number" style="border-radius:30px;" id="student" name="student" value='0' onchange='checkboxtotal()'>

                    <label for="psw"><b>No. of Senior Tickets</b></label>
                    <input type="number" style="border-radius:30px;" id="senior" name="senior" value='0' onchange='checkboxtotal()'>

                    <label for="psw"><b>Pre-order Food & Drink:</b></label>
                    <select class="form-control"  name="preOrderFood"  id="preOrderFood" style="border-radius:30px;width:93%;">
                        
                        <option value='no'> No </option>  
                        <option value='yes'> Yes </option>

                    </select>
                    <br><br>
                    <h2 style="color:black; margin-top: 5px;">Summary</h2>
                    <h6 style="color:#BD9A7A; margin-top: 1rem;">Movie Show:</h6>
                    <span id="MovieName"><?php echo $array['movieName'];?></span>
                    <br>
                    <h6 style="color:#BD9A7A; margin-top: 1rem;">Booking Date:</h6>
                    <span id="date"><?php echo $date ?></span>

                    <h6 style="color:#BD9A7A; margin-top: 1rem;">Time:</h6>
                    <span id="timing"><?php echo $showTiming;?></span>

                    <h6 style="color:#BD9A7A; margin-top: 1rem;">Ticket Price:</h6>
                    <p  id="price">Adult: SGD$12</p>
                    <p  id="price">Child: SGD$8</p>
                    <p  id="price">Student: SGD$9</p>
                    <p  id="price">Senior: SGD$10</p>

                    <h6 style="color:#BD9A7A; margin-top: 1rem;">Total Ticket Price</h6>
                    <p  id="price_details"></p>

                    <?php if($loyalty_point != 0){?>
                    <h6 style="color:#BD9A7A; margin-top: 1rem;">Your Loyalty Point</h6>
                    <p id="loyalty_point"><?php echo $loyalty_point;?></p>
                    <input type="checkbox" name ='redeemPoint' value='yes'onclick="redeemPoints()" > Redeem Loyalty Points</input></br>

                    <?php
                    }
                    ?>
                    <div style="text-align: center;">
                        <button type="submit" name="btn_booking" class="btn" >Confirm Booking</button>
                        <button type="button" class= "btn" onclick="goBack()">Back</button> <!--Check-->
                    </div>
                </div>
                </form>
                </div>
            </div>
            </div>

        </section>
        <script>
            function redeemPoints() {
            // Get the total ticket price
            
            
            // Get the user's loyalty point balance
            var loyalty_point = parseInt(document.getElementById("loyalty_point").textContent);
            
            // Calculate the maximum amount of points that can be redeemed
            //var max_points = Math.floor(total_price / 10);
            
            // Prompt the user to enter the number of points to redeem
            var points_to_redeem = parseInt(prompt("Enter the number of points to redeem (max " + total_price + " points):"));
            
            // Validate the user's input
            if (isNaN(points_to_redeem) || points_to_redeem < 0 || points_to_redeem > total_price) {
                alert("Invalid input!");
                return;
            }
            // Calculate the new total price after the discount
            var new_total_price = total_price - points_to_redeem;
            
            // Update the price details on the page
            document.getElementById("price_details").textContent = "SGD$" + new_total_price.toFixed(2);
            
            // Deduct the redeemed loyalty points from the user's balance
            var new_loyalty_point = loyalty_point - points_to_redeem;
            document.getElementById("loyalty_point").textContent = new_loyalty_point;
            $.ajax({
                url: 'update_total_price.php',
                method: 'POST',
                data: {
                    new_total_price: new_total_price,
                    new_loyalty_point: new_loyalty_point
                },
                success: function(response) {
                    // Handle the server response if needed
                },
                error: function(xhr, status, error) {
                    // Handle the AJAX error if needed
                }
            });
            }
        </script>
        <?php
            if(isset($_POST['btn_booking'])){
                $movieID = $array['movieID'];
                $roomID = $array['roomID'];
                $movieName = $array['movieName'];
                $time = $_POST['show_id'];
                $numOfTicket = $_POST['no_ticket'];
                $seats = $_POST['seat_dt'];
                $noOfAdultTicket = $_POST['adult'];
                $noOfChildTicket = $_POST['child'];
                $noOfSeniorTicket = $_POST['senior'];
                $noOfStudentTicket = $_POST['student'];
                $bookingDate = $date;
                $roomName = $array['roomName'];

                
                if(isset($_POST['redeemPoint'])){
                    if($_POST['redeemPoint']=='yes'){
                        $total_amnt = $_SESSION['new_total_price'];
                        $loyaltypoints=$total_amnt;
                        $newLoyaltyPoints= $_SESSION['new_loyalty_point'];
                        $booking_controller->redeemPointController($newLoyaltyPoints,$phone);

                    } else {
                        $total_amnt = (($numOfTicket*12) - ($noOfChildTicket*4) - ($noOfSeniorTicket*2)-($noOfStudentTicket*3));
                        $loyaltypoints = $total_amnt;
                    }
                }else {
                    $total_amnt = (($numOfTicket*12) - ($noOfChildTicket*4) - ($noOfSeniorTicket*2)-($noOfStudentTicket*3));
                    $loyaltypoints = $total_amnt;
                }
                
                $seatArr = explode(", ",$seats);

                
                
                if($selected_row == null && $selected_column == 0){
                    $columnSeat = substr($seatArr[0], 1);
                    $rowSeat =  substr($seatArr[0], 0, 1); 
                }else {
                    $columnSeat = 0;
                    $rowSeat =  null; 
                }
                

                if($_POST['preOrderFood']== 'yes'){
                    if($booking_controller->createBookingController($phone,$movieID,$roomID,$movieName,$roomName, $time, $numOfTicket, $seats, $noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket, $bookingDate, $total_amnt, $loyaltypoints, $columnSeat, $rowSeat)){
                        echo" <script>window.location='staff_order_food.php?date=$date&phone=$phone';</script>";
                    }
                    
                }else{
                    if($booking_controller->createBookingController($phone,$movieID,$roomID,$movieName,$roomName, $time, $numOfTicket, $seats, $noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket, $bookingDate, $total_amnt, $loyaltypoints, $columnSeat, $rowSeat)){
                        echo" <script>window.location='staff_home_view.php';</script>";
                    }
                }

               
            }
        ?>
    </body>
    </html>
