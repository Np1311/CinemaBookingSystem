<?php
require('../../controller/manager_controller.php');

$updateID = $_GET['updateID'];

$array = $controller -> getFoodAndDrinkDetail($updateID);
?>

<html>
    <head>
    <title>Food Details Form</title>
    </head>
    <body>
        <h1>Food Details Form</h1>
            <form method = 'post'>
                <label for="name">Name:</label>
                <input type="text" name="foodName" value='<?php echo $array['foodName'];?>'><br>

                <label for="description">Description:</label>
                <textarea name="description"  id='description' rows="5" ></textarea><br>

                <label for="price">Price:</label>
                <input type="number" step="0.01" name="price" value='<?php echo $array['price'];?>'><br>

                <label for="category">Category:</label>
                <input type="text" name="category" value='<?php echo $array['category'];?>'><br>

                <label for="stock">Stock:</label>
                <input type="number" name="stock" min='0' max='99999' value='<?php echo $array['stock'];?>'><br>

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

                <input type="submit" name='submit' value="Update Item">
            </form>
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
