<?php
require('../../controller/manager_controller.php');

$reviewArr = $controller -> viewReviewController();

?>
<html>
<head>
	<title>Customer Reviews</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #4CAF50;
			color: white;
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
        if(count($reviewArr)>0){
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
</body>
</html>
