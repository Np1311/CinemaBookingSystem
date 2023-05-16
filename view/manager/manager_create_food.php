<?php
require('../../controller/manager_controller.php');
require('../header.html');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Food Details Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e7dbd0;
      margin: 0;
      padding: 0;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      margin-top: 6%;
      margin-bottom: 2%;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    textarea,
    input[type="number"] {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 3px;
      box-sizing: border-box;
    }

    .btn-group {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 20px;
    }

    .btn-group button,
    input[type="submit"] {
      display: inline-block;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      background-color: #bd9a7a;
      color: white;
      border: none;
      font-size: 14px;
    }

    .btn-group button:hover,
    input[type="submit"]:hover {
      background-color: white;
      color: #bd9a7a;
      border: 1px solid #bd9a7a;
    }

    form h1 {
        text-align: center;
        margin-bottom: 20px;
    }
</style>

</head>
<body>
  <form method="post">
    <h1>Food Details Form</h1>

    <label for="name">Name:</label>
    <input type="text" name="foodName" placeholder="Enter Name of Product" required><br><br>

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
</html>
