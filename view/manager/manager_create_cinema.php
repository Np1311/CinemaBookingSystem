<?php
require('../../controller/manager_controller.php');
$controller = new manager_controller;
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

            <input type="submit" name ="submit" value="submit">
        </form>
        <?php
            if(isset($_POST['submit'])){
                $roomName = $_POST['roomName'];

                $roomType = $_POST['roomType'];
                
                if($controller -> createRoomController($roomName,$roomType)){
                    echo" <script>window.location='../manager/manager_home_view.php';</script>";
                }
            }
        ?>
    </body>
</html>