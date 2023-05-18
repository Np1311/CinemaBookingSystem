<?php
require('../../controller/booking_controller.php');
session_start();

$phone = $_SESSION['customerID'];

if($bookingArray = $booking_controller -> getBookingsController($phone)==false){
    $bookingArray = [];
}else{
    $bookingArray = $booking_controller -> getBookingsController($phone);
}

if($foodOrderArray = $booking_controller -> getFoodOrderController($phone)==false){
    $foodOrderArray = [];
}else{
    $foodOrderArray = $booking_controller -> getFoodOrderController($phone);
}
?>
<html>
    <head>
        <style>
            body {
            background-color: #e7dbd0;
            font-family: Arial, sans-serif;
            }

            .container {
                display: flex;
                flex-direction: column;
                /* justify-content: center; */
                align-items: center;
                min-height: 100vh;
                padding: 20px;
                margin-top: 100px;
                
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                background-color: white;
            }

            table th,
            table td {
                padding: 10px;
                border: 1px solid #ccc;
            }

            table th {
                background-color: #bd9a7a;
                color: white;
                font-weight: bold;
            }

            table td {
                text-align: center;
            }
            .customerButton {
                text-align: center;
                margin-top: 20px;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-wrap: wrap;
            }

            .customerButton a {
                margin: 30px;
                text-decoration: none;
            }

            .customerButton button {
                padding: 10px 20px;
                background-color: #bd9a7a;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
                margin-bottom: 50px;
                width:400px;
            }

            .customerButton button:hover {
                background-color: white;
                color: #bd9a7a;
                border: 1px solid #bd9a7a;
            }
        </style>

    </head>
    <body>
        <div class="contianer">
            <h2> Your Bookings</h2>
        <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Room Name</th>
                <th>Movie Name</th>
                <th>Show Timing</th>
                <th>Number of Tickets</th>
                <th>Seats</th>
                <th>Tickets</th>
                <!--
                <th>Number of Adult Tickets</th>
                <th>Number of Child Tickets</th>
                <th>Number of Senior Tickets</th>
                <th>Number of Student Tickets</th> -->
                <th>Booking Date</th>
                <th>Total Amount</th>
                <th>Loyalty Points</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(count($bookingArray)>0){
            foreach ($bookingArray as $key => $arr) : 
            ?>
                <tr>
                    <td><?= $arr["bookingID"] ?></td>
                    <td><?= $arr["roomName"] ?></td>
                    <td><?= $arr["movieName"] ?></td>
                    <td><?= $arr["showTiming"] ?></td>
                    <td><?= $arr["numOfTicket"] ?></td>
                    <td><?= $arr["seats"] ?></td>
                    <td>
                        <p>Adult Ticket: <?= $arr["noOfAdultTicket"] ?></p>
                        <p>Child Ticket: <?= $arr["noOfChildTicket"] ?></p>
                        <p>Senior Ticket: <?= $arr["noOfSeniorTicket"] ?></p>
                        <p>Student Ticket: <?= $arr["noOfStudentTicket"] ?></p>
                    </td>
                    <td><?= $arr["bookingDate"] ?></td>
                    <td><?= $arr["total_amnt"] ?></td>
                    <td><?= $arr["loyaltypoints"] ?></td>
                </tr>
            <?php endforeach; 
            }else{
                echo "<td> No Data available at the moment</td>";
            }
                ?>
        </tbody>
        </table>
        <h2>Your Food and Drink order</h2>

                <?php
                $previousOrderID = null;

                if (count($foodOrderArray) > 0) {
                    foreach ($foodOrderArray as $row) {
                        if ($row["orderID"] !== $previousOrderID) {
                            if ($previousOrderID !== null) {
                                ?>
                                </tbody>
                            </table>
                            <?php
                            }
                            $previousOrderID = $row["orderID"];
                            ?>
                            <h4>OrderID: <?= $row["orderID"] ?></h4>
                            <h4>Order Date: <?= $row["orderDate"] ?></h4>
                            <h4>Total Price: <?= $row["totalPrice"] ?></h4>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Food Name</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                        }
                        ?>
                        <tr>
                            <td><?= $row["foodName"] ?></td>
                            <td><?= $row["quantity"] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    </table>
                    <?php
                } else {
                    echo "<h4>No Data available at the moment</h4>";
                }
                ?>
            

    
    </div>
    <div class="customerButton">
            <a href="customer_home_view.php">
            <button>Back</button>
            </a><br>

        </div>
    </body>
</html>