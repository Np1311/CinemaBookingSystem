<?php
require('../../controller/booking_controller.php');

$array = $booking_controller -> getBookingPreviewController();




?>

<html>
<head>
    <title>Booking Preview</title>
    <style>
        .cinema-bookingTicket {
            background-color: #e7dbd0;
            /* padding: 20px; */
            border-radius: 5px;
            margin-left: 40px;
        }
        body{
            background-color: #e7dbd0;
        }
        .container{
            margin-top: 100px;
        }
        button {
            text-align: center;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        button a {
            margin: 10px;
            text-decoration: none;
        }

        button {
            padding: 10px 20px;
            background-color: #bd9a7a;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }

        button button:hover {
            background-color: white;
            color: #bd9a7a;
            border: 1px solid #bd9a7a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Booking Preview:</h2>
            <div class="cinema-bookingTicket">
                <p>Booking ID: <?php echo $array["bookingID"]; ?></p>
                <p>Order Date: <?php echo $array["orderDate"]; ?></p>
                <p>Movie Name: <?php echo $array["movieName"]; ?></p>
                <p>Room Name: <?php echo $array["roomName"]; ?></p>
                <p>Show Timing: <?php echo $array["showTiming"]; ?></p>
                <p>Number of Tickets: <?php echo $array["numOfTicket"]; ?></p>
                <p>Number of Adult Tickets: <?php echo $array["noOfAdultTicket"]; ?></p>
                <p>Number of Child Tickets: <?php echo $array["noOfChildTicket"]; ?></p>
                <p>Number of Senior Tickets: <?php echo $array["noOfSeniorTicket"]; ?></p>
                <p>Number of Student Tickets: <?php echo $array["noOfStudentTicket"]; ?></p>
                <p>Final Price: <?php echo $array["finalPrice"]; ?></p>
            </div>

            <button onclick="window.location.href='staff_home_view.php'">Home</button>
    </div>
</body>
</html>
