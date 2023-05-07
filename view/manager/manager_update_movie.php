<?php
require('../../controller/manager_controller.php');

$updateID = $_GET['updateID'];
$arr = $controller -> getMovieDetail($updateID);

$date = $arr['relDate'];


?>

<html>
    <head>
    </head>
    <body>
        <form method = 'post'>
            <label for="movieName">Movie Name:</label>
            <input type="text" id="movieName" name="movieName" value = "<?php echo $arr['movieName']?>"><br><br>

            <label for="movieBanner">Movie Banner:</label>
            <input type="text" id="movieBanner" name="movieBanner" value = "<?php echo $arr['movieBanner']?>"><br><br>

            <label for="relDate">Release Date:</label>
            <input type="date" id="relDate" name="relDate" value = "<?php echo $date?>"><br><br>

            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" value = "<?php echo $arr['genre']?>"><br><br>

            <label for="duration">Duration:</label>
            <input type="number" id="duration" name="duration" min = '0' max = '9999' value = "<?php echo $arr['duration']?>"><br><br>
            
            <label for="roomID">Room ID:</label>
            <input type="number" id="roomID" name="roomID" value = "<?php echo $arr['roomID']?>"><br><br>

            <label for="timing1">Duration:</label>
            <input type="text" id="timing1" name="timing1"  value = "<?php echo $arr['timing1']?>"><br><br>

            <label for="timing2">Duration:</label>
            <input type="text" id="timing2" name="timing2"  value = "<?php echo $arr['timing2']?>"><br><br>

            <label for="timing3">Duration:</label>
            <input type="text" id="timing3" name="timing3"  value = "<?php echo $arr['timing3']?>"><br><br>

            <label for="timing4">Duration:</label>
            <input type="text" id="timing4" name="timing4"  value = "<?php echo $arr['timing4']?>"><br><br>

            <?php
             echo '<select class="form-control" name="status">';
             if($arr['status'] == 'active') {
                 echo '<option value="active" SELECTED> active </option>';
                 echo '<option value="suspend" > suspend </option>';
             } else{
                 echo '<option value="active"> active </option>';
                 echo '<option value="suspend" SELECTED> suspend </option>';
             }
                 
            echo'</select><br><br>';
            ?>

            <input type="submit" name='submit' value="Submit">
        </form>
        <?php
            if(isset($_POST['submit'])){
                $movieName = $_POST['movieName'];

                $movieBanner = $_POST['movieBanner'];

                $relDate= $_POST['relDate'];
                
                $genre = $_POST['genre'];
                
                $duration = $_POST['duration'];

                $status = $_POST['status'];

                $roomID = $_POST['roomID'];

                $timing1 = $_POST['timing1'];

                $timing2 = $_POST['timing2'];

                $timing3 = $_POST['timing3'];

                $timing4 = $_POST['timing4'];
                
                // echo $movieName;
                // echo $movieBanner;
                // echo $relDate;
                // echo $genre;
                // echo $duration;
                if($controller -> updateMovieController($updateID,$movieName,$movieBanner, $relDate, $genre, $duration, $status, $roomID, $timing1,$timing2,$timing3,$timing4)){
                    echo" <script>window.location='../manager/manager_view_movie.php';</script>";
                }
            }
        ?>
    </body>
</html>
