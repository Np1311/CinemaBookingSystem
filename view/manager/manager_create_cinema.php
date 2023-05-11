<?php
require('../../controller/manager_controller.php');

?>

<html>
    <head>
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
        <form method='post'>
            <label for="room-name">Room Name:</label>
            <input type="text" id="roomName" name="roomName"><br><br>

            <label for="room-type">Room Type:</label>
            <input type="text" id="roomType" name="roomType"><br><br>

            <label for="roomCapacity">Room Capacity:</label>
            <input type="number" id="roomCapacity" name="roomCapacity" placeholder='Insert Row and Column' ><br><br>

            <label for="totalRow">Total Row:</label>
            <input type="number" id="totalRow" name="totalRow" min="0" max="999" ><br><br>

            <label for="totalColumn">Total Column:</label>
            <input type="number" id="totalColumn" name="totalColumn" placeholder='Max 10' min="0" max="10" onchange='addCapacity()'><br><br>

            <input type="submit" name ="submit" value="submit">
        </form>
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