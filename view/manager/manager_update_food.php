<?php
// Include the manager_controller.php file
require('../../controller/manager_controller.php');
// Include the header.html file
require('../header.html');
// Get the value of the 'updateID' parameter from the URL
$updateID = $_GET['updateID'];
// Call the getFoodAndDrinkDetail function from the controller and store the result in $array
$array = $controller -> getFoodAndDrinkDetail($updateID);
?>

<html>
    <head>
    <title>Food Details Form</title>
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
            margin-top: 5%;
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
        .form input[type="date"]{
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
        const fileInput = document.getElementById('image');
        const previewContainer = document.getElementById('imagePreview');
        const previewImage = previewContainer.querySelector('.preview-image');

        if (fileInput.files && fileInput.files[0]) {
            // Create a new FileReader object
            const reader = new FileReader();
            // Set the source of the preview image to the loaded file
            reader.onload = function (e) {
                previewImage.src = e.target.result;
            };
            // Read the selected file as a data URL
            reader.readAsDataURL(fileInput.files[0]);
            previewContainer.style.display = 'block';
        } else {
            previewImage.src = '<?php echo $array["image"]; ?>'; // Set the src attribute to the previous picture URL
            previewContainer.style.display = 'block';
        }
    }
    </script>

    <title>Manager Update Food</title>
    </head>
    <body>
        <!--Form Content-->
    <div class="container">
        <div class="form">
        <h1>Food Details Form</h1>
            <form method = 'post'>
                <label for="name">Name:</label>
                <input type="text" name="foodName" value='<?php echo $array['foodName'];?>' required><br>

                <label for="description">Description:</label>
                <textarea name="description"  id='description' rows="10" cols="65" required></textarea><br>

                <label for="price">Price:</label>
                <input type="number" step="0.01" name="price" value='<?php echo $array['price'];?>' required><br>

                <label for="category">Category:</label>
                <input type="text" name="category" value='<?php echo $array['category'];?>' required><br>

                <label for="stock">Stock:</label>
                <input type="number" name="stock" min='0' max='99999' value='<?php echo $array['stock'];?>' required><br>

                <label for="image">Image:</label>
                <input type="file" id="image" name="image" value='<?php echo $array['image'];?>' onchange="previewImage()"><br>

                <div id="imagePreview" style="display: none;">
                    <img class="preview-image" src="" alt="Preview Image" style="max-width: 300px; margin-top: 10px;">
                </div>

                <!-- <label for="image">Image:</label>
                <input type="text" name="image" value='<?php echo $array['image'];?>'><br> -->

                <label for="status">Status:</label>
                <?php
                echo '<select class="form-control" name="status">';
                if($array['status'] == 'active') {
                    echo '<option value="active" SELECTED> active </option>';
                    echo '<option value="suspend" > suspend </option>';
                } else{
                    echo '<option value="active"> active </option>';
                    echo '<option value="suspend" SELECTED> suspend </option>';
                }
                    
                echo'</select><br><br>';
                ?>
                <div class="btn-group">
                    <button type="submit" name="submit">Update Item</button>
                    <button type="button" onclick="window.location.href = 'manager_view_food.php'">Back</button>
                </div>
            </form>
    </div>
</div>
            <script>
                // Get and set the value of the textarea to the foodDescription value from the PHP array
                var textarea = document.getElementById("description");
                textarea.value = "<?php echo $array['foodDescription'];?>";

            </script>

        <?php
            if(isset($_POST['submit'])){
                // Retrieve the form input values
                $foodName = $_POST['foodName'];

                $description = $_POST['description'];

                $price= $_POST['price'];
                
                $category = $_POST['category'];
                
                $stock = $_POST['stock'];

                $image = $_POST['image'];

                $status = $_POST['status'];
                
                // echo $foodName;
                // echo $description;
                // echo $price;
                // echo $category;
                // echo $stock;
                // echo $image;

                // Call the updateFoodAndDrinkController function from the controller to update the food and drink item
                if($controller -> updateFoodAndDrinkController($updateID,$foodName,$description, $price, $category, $stock, $image, $status)){
                    echo" <script>window.location='../manager/manager_view_food.php';</script>";
                }
            }
        ?>
    </body>
</html>
