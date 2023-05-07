<?php
require('../../controller/manager_controller.php');
?>

<html>
    <head>
    <title>Food Details Form</title>
    </head>
    <body>
        <h1>Food Details Form</h1>
            <form method = 'post'>
                <label for="name">Name:</label>
                <input type="text" name="foodName" required><br>

                <label for="description">Description:</label>
                <textarea name="description" rows="5"></textarea><br>

                <label for="price">Price:</label>
                <input type="number" step="0.01" name="price" required><br>

                <label for="category">Category:</label>
                <input type="text" name="category"><br>

                <label for="stock">Stock:</label>
                <input type="number" name="stock" min='0' max='99999' ><br>

                <label for="image">Image:</label>
                <input type="text" name="image"><br>

                

                <input type="submit" name='submit' value="Add Item">
            </form>
        <?php
            if(isset($_POST['submit'])){
                $foodName = $_POST['foodName'];

                $description = $_POST['description'];

                $price= $_POST['price'];
                
                $category = $_POST['category'];
                
                $stock = $_POST['stock'];

                $image = $_POST['image'];
                
                // echo $foodName;
                // echo $description;
                // echo $price;
                // echo $category;
                // echo $stock;
                // echo $image;
                if($controller -> createFoodController($foodName,$description, $price, $category, $stock, $image)){
                    echo" <script>window.location='../manager/manager_view_food.php';</script>";
                }
            }
        ?>
    </body>
</html>
