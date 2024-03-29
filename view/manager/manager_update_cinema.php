
<?php
// Include the manager_controller.php file
require('../../controller/manager_controller.php');

// Include the header.html file
require('../header.html');

// Get the value of the 'updateID' parameter from the URL
$updateID = $_GET['updateID'];
// Call the getRoomDetail function from the controller and store the result in $arr
$arr = $controller -> getRoomDetail($updateID);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Update Room</title>
  <style>
  body {
    background-color: #e7dbd0;
  }

  .update-room {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: white;
    margin-top: 5%;
  }

  h1 {
    text-align: center;
  }

  form {
    display: flex;
    flex-direction: column;
  }

  label {
    font-weight: bold;
    font-size: 18px;
  }

  .button-container {
    display: flex;
    /*justify-content: space-between;*/
    gap:10px;
  }

  input[type="submit"],
  button {
    background-color: #bd9a7a;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    width:2000px;
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

  <div class="update-room">
    <h1>Update Room</h1>
    <!--form content-->
    <form method="post">
      <label for="room-name">Room Name:</label>
      <input type="text" name="roomName" id="roomName" value="<?php echo $arr['roomName']; ?>" required><br><br>

      <label for="room-type">Room Type:</label>
      <input type="text" name="roomType" id="roomType" value="<?php echo $arr['roomType']; ?>" required><br><br>

      <label for="roomCapacity">Room Capacity:</label>
      <input type="number" name="roomCapacity" id="roomCapacity" value="<?php echo $arr['roomCapacity']; ?>" min="0" max="1000"><br><br>

      <label for="totalRow">Total Row:</label>
      <input type="number" name="totalRow" id="totalRow" value="<?php echo $arr['totalRow']; ?>" min="0" max="999" onchange="addCapacity()" required><br><br>

      <label for="totalColumn">Total Column:</label>
      <input type="number" name="totalColumn" id="totalColumn" value="<?php echo $arr['totalColumn']; ?>" min="0" max="999" onchange="addCapacity()" required><br><br>

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

      <div class="button-container">
        <input type="submit" name="submit" value="Save Changes">
        <button type="button" onclick="window.location.href = 'manager_view_cinemaRoom.php'">Back</button>
      </div>
    </form>
  </div>

  <?php
  if (isset($_POST['submit'])) {
    // Get the values from the form
      $roomName = $_POST['roomName'];
      $roomType = $_POST['roomType'];
      $roomCapacity = $_POST['roomCapacity'];
      $totalRow = $_POST['totalRow'];
      $totalColumn = $_POST['totalColumn'];
      $status = $_POST['status'];

      // Call the updateRoomController function from the controller to update the room
      if ($controller->updateRoomController($updateID, $roomName, $roomType, $roomCapacity, $totalRow, $totalColumn, $status)) {
          echo "<script>window.location='../manager/manager_view_cinemaRoom.php';</script>";
      }
  }
  ?>
</body>
</html>
