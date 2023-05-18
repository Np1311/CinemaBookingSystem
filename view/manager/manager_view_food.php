<?php
require('../../controller/manager_controller.php');
require('../header.html');

if($array = $controller -> viewFoodAndDrinkController()==false){
    $array =[];
}else{
    $array = $controller -> viewFoodAndDrinkController();
}        
?>

<html>
    <head>
    <style>
        form {
            max-width: 410px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            margin: 0 auto; /* Center the form horizontally */
            margin-bottom: 30px;
            width: 100%;
            margin-top:20px;
            margin-left:1;
        }
        body {
            background-color: #e7dbd0;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            flex-direction: column;
            /* justify-content: center; */
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            margin-top: 100px;
            
        }
        form input[type="text"] {
            width: 400px;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box;
        }

        form button[type="submit"],
        form button[type="button"] {
            background-color: #bd9a7a;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 48%;
            margin-top: 10px;
        }

        form button[type="submit"]:hover,
        form button[type="button"]:hover {
            background-color: white;
            color: #bd9a7a;
            border: 2px solid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #bd9a7a;
            color: white;
            font-weight: bold;
        }

        table td {
            text-align: center;
        }

        .managerButton {
            text-align: center;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .managerButton a {
            margin: 10px;
            text-decoration: none;
        }

        .managerButton button {
            padding: 10px 20px;
            background-color: #bd9a7a;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .managerButton button:hover {
            background-color: white;
            color: #bd9a7a;
            border: 1px solid #bd9a7a;
        }
       
        .btn-primary {
            background-color: #bd9a7a;
            color: white; /*button update */
        }

        .btn-primary:hover {
            background-color: #0062cc;
        }

        .btn-danger {
            background-color: #bd9a7a;
            color: white; /*button delete*/
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
        .custom-button {
            flex: 1;
            margin: 0 5px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            background-color: #bd9a7a;
            color: black;
            border: none;
            font-size: 14px;
        }

        .custom-button:hover {
            background-color:#bd9a7a;
            color: #bd9a7a;
            border: 1px solid #bd9a7a;
        }
        .custom-button a {
            text-decoration: none;
            color: white;
        }

    </style>
    </head>
    <body>
        <div class="container">
            <form  method="post">
                <input type="text" name="searchInput" placeholder="Search...">
                <button type="submit" name='submit' >Search</button>
                <button type="submit" name="viewAll">View All</button>
            </form>
            <?php 
            if(isset($_POST['submit'])){
                $searchInput = $_POST['searchInput'];

                if($controller->searchFoodController($searchInput) == false){
                    echo '<script>alert("'.$searchInput.' is not found")</script>';  
                }else{
                    $array = $controller->searchFoodController($searchInput);
                }
            }
            ?>
            <!--
            <form method="post">
                <button type="submit" name="viewAll">View All</button>
            </form> -->
            <?php

                if (isset($_POST['viewAll'])) {
                    if($array = $controller -> viewFoodAndDrinkController()==false){
                        $array =[];
                    }else{
                        $array = $controller -> viewFoodAndDrinkController();
                    }                
                }
            ?>
            <div class="row">
            <table>
                <thead>
                    <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Availability</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    

                    // Loop through the results and output them as table rows
                    foreach($array as $key => $arr) {
                        echo "<tr>";
                        echo "<td>" . $arr["foodName"] . "</td>";
                        echo "<td>" . $arr["foodDescription"] . "</td>";
                        echo "<td>" . $arr["price"] . "</td>";
                        echo "<td>" . $arr["category"] . "</td>";
                        echo "<td>" . $arr["stock"] . "</td>";
                        echo "<td><img src='" . $arr["image"] . "' width='100' alt = 'food1'></td>";
                        echo "<td>" . $arr["status"] . "</td>";
                        echo '<td >
                            <button class="custom-button"><a href="../manager/manager_update_food.php?updateID='.$arr['foodID'].'"
                            class="text-light">Update</a></button>
                            <button class="custom-button"><a href="../manager/manager_delete_food.php?deleteID='.$arr['foodID'].'" class="text-light">Suspend</a></button> 
                            </td>' ; 
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>


            </div>
            <div class="managerButton">
            <a href="manager_create_food.php">
                <button id='bodyButton'>Create Food</button>
            </a> </br>

            <a href="manager_home_view.php">
                <button id='bodyButton'>Back</button>
            </a> 
            <!--<a href="admin_reactivate_profile.php">
                <button id='bodyButton'>Reactivate profile</button>
            </a>  -->
            
        </div>
        </div>
        
    </body>
</html>