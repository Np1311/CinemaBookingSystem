<?php
//require ('../header_login.php');
require('../../controller/customer_controller.php');

$bookingID=$_GET['bookingID'];

$array = $controller -> getMovieDetail_controller($bookingID);



$alphabet = range('A', 'Z');
$letters = array();
foreach ($alphabet as $char) {
  $letters[] = $char;
}

$json_string = json_encode($letters);
$row = $array['totalRow'];
$column = $array['totalColumn'];
?>

<html>
  <head>
    <title>Capybara Cinema</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <link rel="icon" href="cinemalogo.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <script>
        var alphabet = JSON.parse('<?php echo $json_string; ?>');
        $(document).ready(function() {
            for(i=1;i<=<?php echo $row;?>;i++)
            {
            let row = alphabet[i-1];
            for(j=1;j<=<?php echo $column;?>;j++)
            {
                $('#seat_chart').append('<div class="col-md-1 mt-2 mb-2 ml-1 mr-2 text-center" style="background-color:grey;color:white"><input type="checkbox" id="seat" value="'+row+j+'" name="seat_chart[]" class="mr-2  col-md-2 mb-2" onclick="checkboxtotal();" >'+ row + j +'</div>')
            }

            }
        });

        function checkboxtotal()
        {
        var seat=[];
        $('input[name="seat_chart[]"]:checked').each(function(){
            seat.push($(this).val());
        });

        var st=seat.length;
        document.getElementById('no_ticket').value=st;

        var ch= document.getElementById('child').value;
        var child=(ch*4);

        var std= document.getElementById('student').value;
        var student=(std*3);

        var sr= document.getElementById('senior').value;
        var senior=(sr*2);

        var fo= document.getElementById('foods').value;
        var food=(fo*3);

        var dr= document.getElementById('drinks').value;
        var drink=(dr*2);


        var total="SGD$"+((st*12) - (child) - (senior) - (student) + (food) + (drink));
        $('#price_details').text(total);

        $('#seat_dt').val(seat.join(", "));
        }
        function addTiming() {
            var select = document.getElementById("show_id");
            var timing = document.getElementById("timing");
            timing.textContent = select.options[select.selectedIndex].text;
        }

        </script>
        <style>
        * {box-sizing:border-box}

        /* Add padding to containers */
        .container {
        padding: 16px;
        }

        /* Full-width input fields */
        textarea,input[type=text],  input[type=password], input[type=tel], input[type=number] , input[type=date]{
        width: 100%;
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
                    <div class="form-group">
                        <select class="form-control"  name="show_id"  id="show_id" style="border-radius:30px;" onChange="addTiming()">
                            <option>Select Show</option>
                            
                            <?php
                                echo '<option value="'.$array["timing1"].'">'.$array["timing1"].'</option>';
                                                            
                                echo '<option value="'.$array["timing2"].'">'.$array["timing2"].'</option>';
                                echo '<option value="'.$array["timing3"].'">'.$array["timing3"].'</option>';
                                if($array["timing4"] != 0){
                                echo '<option value="'.$array["timing4"].'">'.$array["timing4"].'</option>';
                                }
                            ?>
                                
                        </select>
                    </div>
                    

                    <label for="psw"><b>No. of Tickets</b></label>
                    <input type="number" style="border-radius:30px;" id="no_ticket" name="no_ticket"  required>

                    <label for="psw-repeat"><b>Seat Deatils</b></label>
                    <input type="text" style="border-radius:30px;" name="seat_dt" id="seat_dt" required>

                    <label for="psw"><b>No. of Child Tickets</b></label>
                    <input type="number" style="border-radius:30px;" id="child" name="child" onchange="checkboxtotal();" value='0'>

                    <label for="psw"><b>No. of Student Tickets</b></label>
                    <input type="number" style="border-radius:30px;" id="student" name="student" onchange="checkboxtotal();" value='0'>

                    <label for="psw"><b>No. of Senior Tickets</b></label>
                    <input type="number" style="border-radius:30px;" id="senior" name="senior" onchange="checkboxtotal();"value='0'>

                    <label for="number"><b>Booking Date</b></label>
                    <input type="date" style="border-radius:30px;" name="booking_date"  required>
                    </br></br>

                    <h6 class="mt-3"  style="color:#BD9A7A;">Movie Show</h6>
                    <p class="mt-1" id="MovieName"><?php echo $array['movieName'];?></p>

                    <h6 class="mt-5"  style="color:#BD9A7A;">Time:</h6>
                    <span class="mt-1" id="timing"></span>

                    <h6 class="mt-3"  style="color:#BD9A7A;">Ticket Price</h6>
                    <p class="mt-1" id="price">Adult: SGD$12</p>
                    <p class="mt-1" id="price">Child: SGD$8</p>
                    <p class="mt-1" id="price">Student: SGD$9</p>
                    <p class="mt-1" id="price">Senior: SGD$10</p>

                    <h6 class="mt-3"  style="color:#BD9A7A;">Total Ticket Price</h6>
                    <p class="mt-1" id="price_details"></p>
                    <button type="submit" name="btn_booking" class="btn" style="background-color: #BD9A7A;color:white;" >Confirm Booking</button>
                    <hr>
                </div>
                </form>

                

               
                </div>
            </div>
            </div>

        </section>
    </body>
    </html>
