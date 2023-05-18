<?php
require('../../controller/manager_controller.php');
require('../header.html');



$updateID = $_GET['updateID'];

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
    </head>
    <body>
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
                <input type="text" name="image" value='<?php echo $array['image'];?>'><br>

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
                    <button type="button" onclick="window.location.href = 'manager_home_view.php'">Back</button>
                </div>
            </form>
    </div>
</div>
            <script>
                var textarea = document.getElementById("description");
                textarea.value = "<?php echo $array['foodDescription'];?>";

            </script>

        <?php
            if(isset($_POST['submit'])){
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
                if($controller -> updateFoodAndDrinkController($updateID,$foodName,$description, $price, $category, $stock, $image, $status)){
                    echo" <script>window.location='../manager/manager_view_food.php';</script>";
                }
            }
        ?>
    </body>
</html>
