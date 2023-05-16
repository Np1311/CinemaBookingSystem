<?php
require('../../controller/manager_controller.php');
<<<<<<< HEAD

require('../header.html');
=======
>>>>>>> 99d0b55f42947c7c77a5bc02afca772d5e9bbe74

$movieID = $_GET['movieID'];
$array = $controller -> viewRoomController();




?>

<html>
  <head>
    <meta charset="UTF-8">
    <title>Radio Button Form</title>
  </head>
  <body>
    <form method='post'>
        <label>Select Room to Allocate:</label></br>&nbsp&nbsp
      
        <?php
            foreach($array as $key => $value){

        ?>
            <label>
            <input type="radio" name="roomID" value="<?php echo $value['roomID']; ?>">
            <?php echo $value['roomName'];?>&nbsp|&nbsp<?php echo $value['roomType'];?>&nbsp|&nbsp<?php echo $value['roomCapacity'];?>
            </label></br>&nbsp&nbsp
        <?php
            }
        ?>
        </br></br>
        <label for="timing1">Timing 1:</label>
        <input type="text" id="timing1" name="timing1" value='0'><br><br>

        <label for="timing2">Timing 2:</label>
        <input type="text" id="timing2" name="timing2" value='0'><br><br>

        <label for="timing3">Timing 3:</label>
        <input type="text" id="timing3" name="timing3" value='0'><br><br>

        <label for="timing4">Timing 4:</label>
        <input type="text" id="timing4" name="timing4" value='0'><br><br>
      <br><br>
      <input type="submit" name='submit' value="Submit">
    </form>
    <?php
        if(isset($_POST['submit'])){
            $roomID = $_POST['roomID'];

            $timing1 = $_POST['timing1'];

            $timing2 = $_POST['timing2'];

            $timing3 = $_POST['timing3'];

            $timing4 = $_POST['timing4'];

            if($controller -> allocateMovieController($movieID,$roomID,$timing1,$timing2,$timing3,$timing4)){
                echo" <script>window.location='../manager/manager_view_movie.php';</script>";
            }
        }
    ?>
  </body>
</html>
