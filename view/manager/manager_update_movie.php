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
            width: 500px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            margin-top: 30%;
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

        select.form-control {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

    </style>
    <script>
            function previewImage() {
                const fileInput = document.getElementById('movieBanner');
                const previewContainer = document.getElementById('imagePreview');
                const previewImage = previewContainer.querySelector('.preview-image');

                if (fileInput.files && fileInput.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                    previewContainer.style.display = 'block';
                } else {
                    previewImage.src = '';
                    previewContainer.style.display = 'none';
                }
            }
    </script>
    <title>Update Movie Details Form</title>
    </head>
    <body>
    <div class="container">
        <div class="form">
        <h1>Update Movie Details Form</h1>
        <form method = 'post'>
            <label for="movieName">Movie Name:</label>
            <input type="text" id="movieName" name="movieName" value = "<?php echo $arr['movieName']?>"><br><br>

            <label for="movieBanner">Movie Banner:</label>
            <input type="file" id="movieBanner" name="movieBanner" value = "<?php echo $arr['movieBanner']?>" onchange="previewImage()"><br><br>

            <div id="imagePreview" style="display: none;">
                <img class="preview-image" src="" alt="Preview Image" style="max-width: 300px; margin-top: 10px;">
            </div>

            <label for="relDate">Release Date:</label>
            <input type="date" id="relDate" name="relDate" value = "<?php echo $date?>"><br><br>

            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" value = "<?php echo $arr['genre']?>"><br><br>

            <label for="duration">Duration:</label>
            <input type="number" id="duration" name="duration" min = '0' max = '9999' value = "<?php echo $arr['duration']?>"><br><br>
            
            <label for="roomID">Room ID:</label>
            <input type="number" id="roomID" name="roomID" value = "<?php echo $arr['roomID']?>" placeholder="Enter Room ID" required><br><br>

            <label for="timing1">Timing:</label>
            <input type="text" id="timing1" name="timing1" value="<?php echo $arr['timing1'] ?>" placeholder="Enter Time E.g 10:00 - 20:00" pattern="\d{2}:\d{2} - \d{2}:\d{2}" required><br><br>

            <label for="timing2">Timing:</label>
            <input type="text" id="timing2" name="timing2"  value = "<?php echo $arr['timing2']?>" placeholder="Enter Time E.g 01:00 - 24:00" pattern="\d{2}:\d{2} - \d{2}:\d{2}"><br><br>

            <label for="timing3">Timing:</label>
            <input type="text" id="timing3" name="timing3"  value = "<?php echo $arr['timing3']?>" placeholder="Enter Time E.g 01:00 - 24:00" pattern="\d{2}:\d{2} - \d{2}:\d{2}"><br><br>

            <label for="timing4">Timing:</label>
            <input type="text" id="timing4" name="timing4"  value = "<?php echo $arr['timing4']?>" placeholder="Enter Time E.g 01:00 - 24:00" pattern="\d{2}:\d{2} - \d{2}:\d{2}"><br><br>

            <label for="status">Status:</label>
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
