<?php
require('../../controller/manager_controller.php');
require('../header.html');


$arr = $controller -> viewRoomController();

echo "<table>";
echo "<tr><th>ID</th><th>Room Name</th><th>Room Type</th><th>Room Capacity</th><th>Total Row</th><th>Total Column</th><th>Status</th><th>Action</th></tr>";

// loop through results and display in table rows
if(count($arr) > 0 )
{
    foreach($arr as $key => $array){
        echo "<tr>";
        echo "<td>" . $array['roomID'] . "</td>";
        echo "<td>" . $array['roomName'] . "</td>";
        echo "<td>" . $array['roomType'] . "</td>";
        echo "<td>" . $array['roomCapacity'] . "</td>";
        echo "<td>" . $array['totalRow'] . "</td>";
        echo "<td>" . $array['totalColumn'] . "</td>";
        echo "<td>" . $array['status'] . "</td>";
        echo '<td >
            <button class="btn btn-primary"><a href="../manager/manager_update_cinema.php?updateID='.$array['roomID'].'"
            class="text-light">Update</a></button>
            <button class="btn-danger"><a href="../manager/manager_delete_cinema.php?deleteID='.$array['roomID'].'" class="text-light">Delete</a></
            button> 
            </td>' ; 
        echo "</tr>";
    }
}
// close the table
echo "</table>";
?>

<html>
<head>
    <title>Cinema Room</title>
    <style>
        body {
            background-color: #e7dbd0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .adminButton {
            text-align: center;
        }

        .adminButton a {
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="adminButton">
        <a href="manager_create_cinema.php">
            <button id='bodyButton'>Create Cinema Room</button>
        </a> <br>

        <!--<a href="manager_view_cinema.php">
            <button id='bodyButton'>View Cinema Room</button>
        </a> <br> -->

        <!--<a href="admin_delete_profile.php">
            <button id='bodyButton'>Delete profile</button>
        </a> 
        <a href="admin_reactivate_profile.php">
            <button id='bodyButton'>Reactivate profile</button>
        </a>  -->
        <button type="button" onclick="window.location.href = 'manager_home_view.php'">Back</button>
    </div>
</body>
</html>

