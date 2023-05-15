<?php
require('../../controller/manager_controller.php');
require('../header.html');

$updateID = $_GET['updateID'];
$arr = $controller -> getRoomDetail($updateID);
?>

<div class="update_room">
  <h1>Update Room</h1>
  <form method="post">
    <label for="room-name">Room Name:</label>
    <input type="text" name="roomName" id="roomName" value="<?php echo $arr['roomName']; ?>"><br><br>
    
    <label for="room-type">Room Type:</label>
    <input type="text" name="roomType" id="roomType" value="<?php echo $arr['roomType']; ?>"><br><br>
    
    <label for="roomCapacity">Room Capacity:</label>
    <input type="number" name="roomCapacity" id="roomCapacity" value="<?php echo $arr['roomCapacity']; ?>" min="0" max="1000"><br><br>
    
    <label for="totalRow">Total Row:</label>
    <input type="number" name="totalRow" id="totalRow" value="<?php echo $arr['totalRow']; ?>" min="0" max="999"><br><br>
    
    <label for="totalColumn">Total Column:</label>
    <input type="number" name="totalColumn" id="totalColumn" value="<?php echo $arr['totalColumn']; ?>" min="0" max="999"><br><br>
    
    <label for="status">Status:</label>
    <select class="form-control" name="status">
      <?php if ($arr['status'] == 'active') : ?>
        <option value="active" selected>active</option>
        <option value="suspend">suspend</option>
      <?php else : ?>
        <option value="active">active</option>
        <option value="suspend" selected>suspend</option>
      <?php endif; ?>
    </select><br><br>
    
    <input type="submit" name="submit" value="Save Changes">
    <button type="button" onclick="window.location.href = 'manager_view_cinemaRoom.php'">Back</button>
  </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $roomName = $_POST['roomName'];
    $roomType = $_POST['roomType'];
    $roomCapacity = $_POST['roomCapacity'];
    $totalRow = $_POST['totalRow'];
    $totalColumn = $_POST['totalColumn'];
    $status = $_POST['status'];
    
    if ($controller->updateRoomController($updateID, $roomName, $roomType, $roomCapacity, $totalRow, $totalColumn, $status)) {
        echo "<script>window.location='../manager/manager_view_cinema.php';</script>";
    }
}
?>
