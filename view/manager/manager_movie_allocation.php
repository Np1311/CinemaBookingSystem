<?php
require('../../controller/manager_controller.php');

require('../header.html');

$movieID = $_GET['movieID'];
$array = $controller -> viewRoomController();




?>

<html>
<head>
  <meta charset="UTF-8">
  <title>Allocate Movie Form</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #e7dbd0;
  }

  form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    margin-top: 5%;
  }

  h1 {
    text-align: center;
    margin: auto;
  }

  label {
    display: block;
    margin-bottom: 10px;
  }

  input[type="radio"] {
    margin-right: 5px;
  }

  input[type="text"] {
    width: 100%;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
  }

  .btn-group {
    width:400px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    margin-right:200px;
  }

  .btn-group button,
  input[type="submit"] {
    width:48%;
    display: inline-block;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    background-color: #bd9a7a;
    color: white;
    border: none;
    font-size: 16px;
    margin: 0 5px;
  }

  .btn-group button:hover,
  input[type="submit"]:hover {
    background-color: white;
    color: #bd9a7a;
    border: 1px solid #bd9a7a;
  }
</style>
</head>
<body>
  <form method='post'>
    <h1>Allocate Movie Form</h1></br>
    <label>Select Room to Allocate:</label>
    <?php
      foreach($array as $key => $value){
    ?>
      <label>
        <input type="radio" name="roomID" value="<?php echo $value['roomID']; ?>">
        <?php echo $value['roomName'];?> | <?php echo $value['roomType'];?> | <?php echo $value['roomCapacity'];?> required
      </label><br><br>
    <?php
      }
    ?>
    <label for="timing1">Timing:</label>
    <input type="text" id="timing1" name="timing1" placeholder="Enter Hours E.g 00:00 - 00:00" pattern="\d{2}:\d{2} - \d{2}:\d{2}" required><br><br>

    <label for="timing2">Timing:</label>
    <input type="text" id="timing2" name="timing2" placeholder="Enter Hours E.g 00:00 - 00:00" pattern="\d{2}:\d{2} - \d{2}:\d{2}"><br><br>

    <label for="timing3">Timing:</label>
    <input type="text" id="timing3" name="timing3" placeholder="Enter Hours E.g 00:00 - 00:00" pattern="\d{2}:\d{2} - \d{2}:\d{2}"><br><br>

    <label for="timing4">Timing:</label>
    <input type="text" id="timing4" name="timing4" placeholder="Enter Hours E.g 00:00 - 00:00" pattern="\d{2}:\d{2} - \d{2}:\d{2}"><br><br>

    <div class="btn-group">
      <input type="submit" name='submit' value="Submit">
      <button type="button" onclick="window.location.href = 'manager_view_movie.php'">Back</button>
    </div>
  </form>
  <?php
    if(isset($_POST['submit'])){
      $roomID = $_POST['roomID'];
      $timing1 = $_POST['timing1'];
      $timing2 = $_POST['timing2'];
      $timing3 = $_POST['timing3'];
      $timing4 = $_POST['timing4'];

      if($controller->allocateMovieController($movieID,$roomID,$timing1,$timing2,$timing3,$timing4)){
        echo" <script>window.location='../manager/manager_view_movie.php';</script>";
      }
    }
  ?>
</body>
</html>
