<?php
require('../../controller/manager_controller.php');

?>

<html>
    <head>
    </head>
    <body>
        <form method='post'>
            <label for="room-name">Room Name:</label>
            <input type="text" id="roomName" name="roomName"><br><br>

            <label for="room-type">Room Type:</label>
            <input type="text" id="roomType" name="roomType"><br><br>

            <label for="roomCapacity">Room Capacity:</label>
            <input type="number" id="roomCapacity" name="roomCapacity" min="0" max="1000"><br><br>

            <label for="totalRow">Total Row:</label>
            <input type="number" id="totalRow" name="totalRow" min="0" max="999"><br><br>

            <label for="totalColumn">Total Column:</label>
            <input type="number" id="totalColumn" name="totalColumn" min="0" max="999"><br><br>

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