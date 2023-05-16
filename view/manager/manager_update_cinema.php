
<?php
require('../../controller/manager_controller.php');

$updateID = $_GET['updateID'];
$arr = $controller -> getRoomDetail($updateID);

echo "<div class='update_room'>";
echo "<h1>Update Room</h1>";
echo "<form  method='post'>";
    echo "<label for='room-name'>Room Name:</label>";
    echo "<input type='text' name='roomName' id='roomName' value=".$arr['roomName']."><br><br>";
    echo '<label for="room-type">Room Type:</label>';
    echo "<input type='text' name='roomType' id='roomType' value=".$arr['roomType']."><br><br>";
    echo '<label for="roomCapacity">Room Capacity:</label>';
    echo "<input type='number' name='roomCapacity' id='roomCapacity' value=".$arr['roomCapacity']." min='0' max='1000'><br><br>";
    echo '<label for="totalRow">Total Row:</label>';
    echo "<input type='number' name='totalRow' id='totalRow' value=".$arr['totalRow']." min='0' max='999'><br><br>";
    echo '<label for="totalColumn">Total Column:</label>';
    echo "<input type='number' name='totalColumn' id='totalColumn' value=".$arr['totalColumn']." min='0' max='999'><br><br>";
    echo '<label for="status">Status:</label>';
    echo '<select class="form-control" name="status">';
        if($arr['status'] == 'active') {
            echo '<option value="active" SELECTED> active </option>';
            echo '<option value="suspend" > suspend </option>';
        } else{
            echo '<option value="active"> active </option>';
            echo '<option value="suspend" SELECTED> suspend </option>';
        }
            
    echo'</select><br><br>';
    echo '<input type="submit" name="submit" value="Save Changes">';
echo "</form>";
echo "</div>";
if(isset($_POST['submit'])){
    $roomName = $_POST['roomName'];
    $roomType = $_POST['roomType'];
    $roomCapacity = $_POST['roomCapacity'];
    $totalRow = $_POST['totalRow'];
    $totalColumn = $_POST['totalColumn'];
    $status = $_POST['status'];
    if($controller ->updateRoomController($updateID,$roomName,$roomType,$roomCapacity,$totalRow,$totalColumn,$status)){
        
        echo" <script>window.location='../manager/manager_view_cinema.php';</script>";
    }

}
?>