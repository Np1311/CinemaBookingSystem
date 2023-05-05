<?php
require('../../controller/manager_controller.php');
?>

<html>
    <head>
    <title>Movie Details Form</title>
    </head>
    <body>
        <h1>Movie Details Form</h1>
            <form method = 'post'>
            <label for="movieName">Movie Name:</label>
            <input type="text" id="movieName" name="movieName"><br><br>

            <label for="movieBanner">Movie Banner:</label>
            <input type="text" id="movieBanner" name="movieBanner"><br><br>

            <label for="relDate">Release Date:</label>
            <input type="date" id="relDate" name="relDate"><br><br>

            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre"><br><br>

            <label for="duration">Duration:</label>
            <input type="number" id="duration" name="duration" min = '0' max = '9999'><br><br>

            <input type="submit" name='submit' value="Submit">
        </form>
        <?php
            if(isset($_POST['submit'])){
                $movieName = $_POST['movieName'];

                $movieBanner = $_POST['movieBanner'];

                $relDate= $_POST['relDate'];
                
                $genre = $_POST['genre'];
                
                $duration = $_POST['duration'];
                
                // echo $movieName;
                // echo $movieBanner;
                // echo $relDate;
                // echo $genre;
                // echo $duration;
                if($controller -> createMovieController($movieName,$movieBanner, $relDate, $genre, $duration)){
                    echo" <script>window.location='../manager/manager_view_movie.php';</script>";
                }
            }
        ?>
    </body>
</html>
