<?php
    require('../../controller/manager_controller.php');
    require('../header.html');

    $arr = $controller->viewRoomController();
?>
<html>
<head>
    <title>Cinema Room</title>
    <style>
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

        .adminButton {
            text-align: center;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .adminButton a {
            margin: 10px;
            text-decoration: none;
        }

        .adminButton button {
            padding: 10px 20px;
            background-color: #bd9a7a;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .adminButton button:hover {
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

    </style>
</head>
<body>
    <div class="container">
       

        <table>
            <tr>
                <th>ID</th>
                <th>Room Name</th>
                <th>Room Type</th>
                <th>Room Capacity</th>
                <th>Total Row</th>
                <th>Total Column</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php
            // loop through results and display in table rows
            if (count($arr) > 0) {
                foreach ($arr as $key => $array) {
                    echo "<tr>";
                    echo "<td>" . $array['roomID'] . "</td>";
                    echo "<td>" . $array['roomName'] . "</td>";
                    echo "<td>" . $array['roomType'] . "</td>";
                    echo "<td>" . $array['roomCapacity'] . "</td>";
                    echo "<td>" . $array['totalRow'] . "</td>";
                    echo "<td>" . $array['totalColumn'] . "</td>";
                    echo "<td>" . $array['status'] . "</td>";
                    echo '<td>
                            <button class="btn btn-primary">
                                <a href="../manager/manager_update_cinema.php?updateID=' . $array['roomID'] . '" class="text-light">Update</a>
                            </button>
                            <button class="btn-danger">
                                <a href="../manager/manager_delete_cinema.php?deleteID=' . $array['roomID'] . '" class="text-light">Delete</a>
                            </button>
                        </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No data available</td></tr>";
            }
            ?>
        </table>
            <div class="adminButton">
            <a href="manager_create_cinema.php">
                <button>Create Cinema Room</button>
            </a> <br> <br>

            <a href="manager_search_room.php">
                <button>Search Room</button>
            </a> <br>

            <!--<a href="admin_delete_profile.php">
                <button>Delete profile</button>
            </a> 
            <a href="admin_reactivate_profile.php">
                <button>Reactivate profile</button>
            </a>  -->
            <a href="manager_home_view.php">
            <button>Back</button>
            </a><br>

        </div>
    </div>
</body>
</html>
