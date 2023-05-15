<?php
require('../../controller/manager_controller.php');
require('../header.html');

?>

<html>
    <head>
    <style>
    body {
        background-color: #e7dbd0;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form {
        width: 400px;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
    }

    .form label {
        display: block;
        margin-bottom: 10px;
    }

    .form input[type="text"],
    .form input[type="number"] {
        width: 100%;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box; /* Add this line */
    }

    .form .btn-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form .btn-group button {
        flex: 1;
        margin: 0 5px;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        background-color: #bd9a7a;
        color: white;
        border: none;
    }

    .form .btn-group button:hover {
        background-color: white;
        color: #bd9a7a;
        border: 1px solid #bd9a7a;
    }

    .form input[type="submit"] {
        flex: 1;
        margin: 0 5px;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        background-color: #bd9a7a;
        color: white;
        border: none;
    }

    .form input[type="submit"]:hover {
        background-color: white;
        color: #bd9a7a;
        border: 1px solid #bd9a7a;
    }
</style>

        <script>
            function addCapacity() {
                // Get the values of the input fields
                var totalRow = parseInt(document.getElementById("totalRow").value);
                var totalColumn = parseInt(document.getElementById("totalColumn").value);

                // Calculate the room capacity
                var roomCapacity = totalRow * totalColumn;

                // Display the room capacity in the roomCapacity input field
                document.getElementById("roomCapacity").value = roomCapacity;
            }
        </script>
    </head>
    <body>
    <div class="container">
        <form class="form" method="post">
            <!-- Form content -->
            <label for="room-name">Room Name:</label>
            <input type="text" id="roomName" name="roomName" placeholder="Insert Room Name"><br><br>

            <label for="room-type">Room Type:</label>
            <input type="text" id="roomType" name="roomType" placeholder="Insert Room Type"><br><br>

            <label for="roomCapacity">Room Capacity:</label>
            <input type="number" id="roomCapacity" name="roomCapacity" placeholder="Insert Row and Column"><br><br>

            <label for="totalRow">Total Row:</label>
            <input type="number" id="totalRow" name="totalRow" min="0" max="999" placeholder="Insert Total Row"><br><br>

            <label for="totalColumn">Total Column:</label>
            <input type="number" id="totalColumn" name="totalColumn" placeholder="Max 10" min="0" max="10" onchange="addCapacity()"><br><br>

            <div class="btn-group">
            <input type="submit" name="submit" value="Submit">
            <button type="button" onclick="window.location.href = 'manager_view_cinemaRoom.php'">Back</button>
            </div>
        </form>
    </div>
        <?php
            if(isset($_POST['submit'])){
                $roomName = $_POST['roomName'];

                $roomType = $_POST['roomType'];

                $roomCapacity= $_POST['roomCapacity'];
                
                $totalRow = $_POST['totalRow'];
                
                $totalColumn = $_POST['totalColumn'];
                
                if($controller -> createRoomController($roomName,$roomType, $roomCapacity, $totalRow, $totalColumn)){
                    echo" <script>window.location='../manager/manager_view_cinemaRoom.php';</script>";
                }
            }
        ?>
    </body>
</html>