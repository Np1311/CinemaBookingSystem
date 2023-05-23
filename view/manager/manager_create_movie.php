<?php
require('../../controller/manager_controller.php');

require('../header.html');

?>

<html>
    <head>
        <title>Movie Details Form</title>
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
            height: 110vh;
        }

        .form {
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
        }

        .form h2 {
            text-align: center;
            padding-bottom: 20px;
        }

        .form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form input[type="text"],
        .form input[type="number"],
        .form input[type="date"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-bottom: 6px;
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
        <script>
            // Function to preview the selected image
            function previewImage() {
                //Get the element
                const fileInput = document.getElementById('movieBanner');
                const previewContainer = document.getElementById('imagePreview');
                const previewImage = previewContainer.querySelector('.preview-image');
                
                // Check if files are selected
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

<div class="container">
    <div class="form">
        <h2>Create Movie Details Form</h2>
        <form method="post">
            <label for="movieName">Movie Name:</label>
            <input type="text" id="movieName" name="movieName" placeholder="Enter Movie Name" required>

            <label for="movieBanner">Movie Banner:</label>
            <input type="file" id="movieBanner" name="movieBanner" onchange="previewImage()" required>

            <div id="imagePreview" style="display: none;">
                <img class="preview-image" src="" alt="Preview Image" style="max-width: 300px; margin-top: 10px;">
            </div>

            <label for="relDate">Release Date:</label>
            <input type="date" id="relDate" name="relDate" required>

            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" placeholder="Enter Genre" required>

            <label for="duration">Duration:</label>
            <input type="number" id="duration" name="duration" min="0" max="9999" placeholder="Enter Duration in Minutes" required>

            <div class="btn-group">
                <input type="submit" name="submit" value="Submit">
                <button type="button" onclick="window.location.href = 'manager_view_movie.php'" >Back</button>
            </div>
        </form>
    </div>
</div>


        <?php
            if(isset($_POST['submit'])){
                // Get the value from the input field
                $movieName = $_POST['movieName'];
                $movieBanner = $_POST['movieBanner'];
                $relDate = $_POST['relDate'];
                $genre = $_POST['genre'];
                $duration = $_POST['duration'];
                
                // Process the form data
                
                if($controller->createMovieController($movieName, $movieBanner, $relDate, $genre, $duration)){
                    // If the createFoodController method returns true (indicating successful food creation)
                    echo "<script>window.location='../manager/manager_view_movie.php';</script>";
                }
            }
        ?>
    </body>
</html>
