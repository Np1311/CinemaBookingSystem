<?php
require('../../controller/manager_controller.php');



require('../header.html');

$updateID = $_GET['updateID'];
$arr = $controller -> getMovieDetail($updateID);

$date = $arr['relDate'];


?>

<html>
    <head>
    <style>
        body {
            background-color: #e7dbd0;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
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

        .form h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .form input[type="text"],
        .form input[type="number"],
        .form input[type="date"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .form .btn-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .form .btn-group button,
        .form input[type="submit"] {
            flex: 1;
            margin: 0 5px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            background-color: #bd9a7a;
            color: white;
            border: none;
            font-size: 14px;
        }

        .form .btn-group button:hover,
        .form input[type="submit"]:hover {
            background-color: white;
            color: #bd9a7a;
            border: 1px solid #bd9a7a;
        }
    </style>
    </head>
    <body>
    <div class="container">
        <div class="form">
        <h1>Update Movie Details Form</h1>
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
        <div class="btn-group">
            <input type="submit" name="submit" value="Submit">
            <button type="button" onclick="window.location.href = 'manager_view_movie.php'">Back</button>
        </div>
        </form>
    </div>
</div>
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
