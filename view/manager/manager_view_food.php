<?php
require('../../controller/manager_controller.php');


$array = $controller -> viewFoodAndDrinkController();

?>

<html>
    <head>
    </head>
    <body>
        <div class="container">
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
                            <button class="btn btn-primary"><a href="../manager/manager_update_food.php?updateID='.$arr['foodID'].'"
                            class="text-light">Update</a></button>
                            <button class="btn-danger"><a href="../manager/manager_delete_food.php?deleteID='.$arr['foodID'].'" class="text-light">Delete</a></
                            button> 
                            </td>' ; 
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>


            </div>
        </div>
        <div class="managerButton">
            <a href="manager_create_food.php">
                <button id='bodyButton'>Create Food</button>
            </a> </br>

            <!-- <a href="manager_view_cinema.php">
                <button id='bodyButton'>View Cinema Room</button>
            </a> </br> -->

            <!--<a href="admin_delete_profile.php">
                <button id='bodyButton'>Delete profile</button>
            </a> 
            <a href="admin_reactivate_profile.php">
                <button id='bodyButton'>Reactivate profile</button>
            </a>  -->
            <button type="btn-danger" onclick="window.location.href = 'manager_home_view.php'">Back</button>
        </div>
    </body>
</html>