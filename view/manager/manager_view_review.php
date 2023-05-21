<?php
// Include the manager_controller.php file
require('../../controller/manager_controller.php');
// Include the header.html file
require('../header.html');
// Retrieve the customer reviews from the viewReviewController function
$reviewArr = $controller -> viewReviewController();

?>
<html>
<head>
	<title>Customer Reviews</title>
	<style>
        body {
            background-color: #e7dbd0;
        }

        h1 {
            margin-top: 5%;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 0 auto;
            border: 2px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            border: 2px solid #ddd;
            background-color: white;
        }

        th {
            background-color: #bd9a7a;
            color: white;
        }

        th.show-timing, td.show-timing {
            width: 15%;
        }

        th.booking-date, td.booking-date {
            width: 15%;
        }

        button {
            display: block;
            margin: 20px auto;
            background-color: #bd9a7a;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #a87d5f;
        }
    </style>


</head>
<body>
	<h1>Customer Reviews</h1>
	<table>
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
                <th>Customer Phone</th>
				<th>Total Amount</th>
				<th>Number of Tickets</th>
				<th>Movie Name</th>
				<th>Show Timing</th>
				<th>Rating</th>
				<th>Review</th>
				<th>Booking Date</th>
			</tr>
		</thead>
		<tbody>
        <?php
        // Check if there are customer reviews available
        if(count($reviewArr)>0){
            // Loop through the reviews and display them in table rows
            foreach($reviewArr as $key => $array){

            
        ?>
        <tr>
            <td><?php echo $array["fname"]; ?></td>
            <td><?php echo $array["lname"]; ?></td>
            <td><?php echo $array['phone']; ?></td>
            <td><?php echo $array["total_amnt"]; ?></td>
            <td><?php echo $array["numOfTicket"]; ?></td>
            <td><?php echo $array["movieName"]; ?></td>
            <td><?php echo $array["showTiming"]; ?></td>
            <td><?php echo $array["rating"]; ?></td>
            <td><?php echo $array["review"]; ?></td>
            <td><?php echo $array["bookingDate"]; ?></td>
        </tr>
        <?php
            }
        }
        ?>
		</tbody>
	</table>
	<button type="btn-danger" onclick="window.location.href = 'manager_home_view.php'">Back</button>
</body>
</html>
