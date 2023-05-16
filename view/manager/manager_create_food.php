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

<<<<<<< HEAD
    <label for="description">Description:</label>
    <textarea name="description" rows="5" placeholder="Enter Description"></textarea><br><br>

    <label for="price">Price:</label>
    <input type="number" step="0.01" name="price" placeholder="Enter Price " required min="0"><br><br>

    <label for="category">Category:</label>
    <input type="text" name="category" placeholder="Enter Category" required><br><br>

    <label for="stock">Stock:</label>
    <input type="number" name="stock" min="0" max="99999" placeholder="Enter Stock" required><br><br>

    <label for="image">Image:</label>
    <input type="text" name="image"><br>

    <div class="btn-group">
      <input type="submit" name="submit" value="Add Item">
      <button type="button" onclick="window.location.href = 'manager_view_food.php'">Back</button>
    </div>
  </form>


  <?php
    if(isset($_POST['submit'])){
      $foodName = $_POST['foodName'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $category = $_POST['category'];
      $stock = $_POST['stock'];
      $image = $_POST['image'];

      if($controller->createFoodController($foodName, $description, $price, $category, $stock, $image)){
        echo" <script>window.location='../manager/manager_view_food.php';</script>";
      }
      
    }
  ?>
</body>
=======
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
>>>>>>> 99d0b55f42947c7c77a5bc02afca772d5e9bbe74
</html>
