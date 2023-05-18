<?php
require('../../controller/booking_controller.php');
require_once('../header_login.php'); //unappear

$bookedID = $_GET['bookedID'];

if($booking_controller -> getBookingByID_controller($bookedID) == false){
    echo '<script>alert("data is not found")</script>';  
}else{
    $array = $booking_controller -> getBookingByID_controller($bookedID);
}

$movie = $array['movieID'];
$showTiming = $array['showTiming'];
$date = $array['bookingDate'];
$alphabet = range('A', 'Z');
$letters = array();
foreach ($alphabet as $char) {
  $letters[] = $char;
}

$json_string = json_encode($letters);
$row = $array['totalRow'];
$column = $array['totalColumn'];

$selectedSeat = $booking_controller -> getSelectedSeatByID_controller($bookedID);


var_dump($array);

var_dump($selectedSeat);

$takenSeat = $booking_controller ->takenSeats_controller($movie,$showTiming,$date,$bookedID);
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
            let selectedSeat = <?php echo json_encode($selectedSeat);?>;
            let takenSeats = <?php echo json_encode($takenSeat);?>;
        
            for (let i = 1; i <= <?php echo $row;?>; i++) {
                let row = alphabet[i - 1];
            
                for (let j = 1; j <= <?php echo $column;?>; j++) {
                    let seatValue = row + j;
                    let checkedAttribute = '';
                    for (let seat in selectedSeat) {
                        if (selectedSeat[seat].row === row && selectedSeat[seat].column === String(j)) {
                            checkedAttribute = 'checked';
                            break;
                        }
                    }
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

        </script>
        <style>
        * {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* Full-width input fields */
textarea,
input[type="text"],
input[type="password"],
input[type="tel"],
input[type="number"],
input[type="date"] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

textarea,
input[type="text"]:focus,
input[type="password"]:focus {
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
  background-color: #bd9a7a;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 50%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

body {
  background-color: #e7dbd0;
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

p,
span {
  color: black !important;
}

#seat_chart input[type="checkbox"]:disabled {
  background-color: red !important;
}

/* Adjust seat chart layout */
#seat_chart .col-md-1 {
  background-color: grey;
  color: white;
  text-align: center;
  margin: 5px;
  padding: 0;
}

#seat_chart .col-md-1 input[type="checkbox"] {
  margin: 2px;
}

#seat_chart .col-md-1 span {
  display: block;
  margin-top: 2px;
}

        </style>


    </head>
    <body>

        
        <section class="mt-5">
            <h3 class="text-center">Book Your Ticket Now</h3>

            <div class="container">
            <div class="row">
                <div class="">
                <div id="seat-map" id="seatCharts">
                <h3 class="text-center mt-5"  style="color:#BD9A7A;">Select Seat</h3>
                <hr>
                <label class="text-center" style="width:93%;background-color:#BD9A7A;color:white;padding:2%"> 
                SCREEN
                </label>

                <div class="row" id="seat_chart">                   
                </div>

                </div>
                <form method="post" class="mt-1">
                    <div class="container" style="color:#BD9A7A;">
                    <center>
                        <p>Please fill in this form to book your ticket.</p>
                    </center>

                    <hr>

                    <label for="Show"><b>Show Id</b></label>

                    <div class="form-group">
                        <select class="form-control"  name="show_id"  id="show_id" style="border-radius:30px;">
                           
                            
                            <?php
                                echo '<option value="'.$showTiming.'">'.$array["showTiming"].'</option>';
                            ?>
                                
                        </select>
                    </div>

                    <label for="psw"><b>No. of Tickets</b></label>
                    <input type="number" style="border-radius:30px;" id="no_ticket" name="no_ticket"  required>

                    <label for="psw-repeat"><b>Seat Deatils</b></label>
                    <input type="text" style="border-radius:30px;" name="seat_dt" id="seat_dt" required>

                    <label for="psw"><b>No. of Adult Tickets</b></label>
                    <input type="number" style="border-radius:30px;" id="adult" name="adult" value='<?php echo $array['noOfAdultTicket']; ?>' onchange='checkboxtotal()'>

                    <label for="psw"><b>No. of Child Tickets</b></label>
                    <input type="number" style="border-radius:30px;" id="child" name="child" value='<?php echo $array['noOfChildTicket']; ?>' onchange='checkboxtotal()'>

                    <label for="psw"><b>No. of Student Tickets</b></label>
                    <input type="number" style="border-radius:30px;" id="student" name="student" value='<?php echo $array['noOfStudentTicket']; ?>' onchange='checkboxtotal()'>

                    <label for="psw"><b>No. of Senior Tickets</b></label>
                    <input type="number" style="border-radius:30px;" id="senior" name="senior" value='<?php echo $array['noOfSeniorTicket']; ?>' onchange='checkboxtotal()'>

                    <h6 class="mt-5"  style="color:#BD9A7A;">Movie Show</h6>
                    <span class="mt-1" id="MovieName"><?php echo $array['movieName'];?></span>

                    <h6 class="mt-5"  style="color:#BD9A7A;">Booking Date</h6>
                    <span class="mt-1" id="date"><?php echo $date ?></span>

                    <h6 class="mt-5"  style="color:#BD9A7A;">Time:</h6>
                    <span class="mt-1" id="timing"><?php echo $showTiming;?></span>

                    <h6 class="mt-3"  style="color:#BD9A7A;">Ticket Price</h6>
                    <p class="mt-1" id="price">Adult: SGD$12</p>
                    <p class="mt-1" id="price">Child: SGD$8</p>
                    <p class="mt-1" id="price">Student: SGD$9</p>
                    <p class="mt-1" id="price">Senior: SGD$10</p>

                    <h6 class="mt-3" style="color:#BD9A7A;">Total Ticket Price</h6>
                    <p class="mt-1" id="price_details"></p>

                    <button type="submit" name="btn_booking" class="btn" style="background-color: #BD9A7A;color:white;" >Confirm Booking</button>

                </div>
                </form>
                &nbsp&nbsp<a href="staff_home_view.php" style="text-decoration: none;">
                    <button name="btn_booking1" class="btn" style="background-color: #BD9A7A;color:white;">Back</button>
                </a>
                </div>
            </div>
            </div>

        </section>
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

                
                
                $total_amnt = (($numOfTicket*12) - ($noOfChildTicket*4) - ($noOfSeniorTicket*2)-($noOfStudentTicket*3));
                $loyaltypoints = $total_amnt;
                

                
                
                

                if($booking_controller->updateBookingController($bookedID,$numOfTicket,$seats,$noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket,$total_amnt, $loyaltypoints)){
                    echo" <script>window.location='staff_home_view.php';</script>";
                }else{
                    echo '<script>alert("error while updating data")</script>';  
                }
                
               
            }
        ?>
    </body>
    </html>