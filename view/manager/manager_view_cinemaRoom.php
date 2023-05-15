<!DOCTYPE html>
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
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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
        }

        .adminButton button:hover {
            background-color: #bd9a7a;
            color: #fff;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            require('../../controller/manager_controller.php');
            require('../header.html');

            $arr = $controller->viewRoomController();
        ?>

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
            </a> <br>

            <!--<a href="manager_view_cinema.php">
                <button>View Cinema Room</button>
            </a> <br> -->

            <!--<a href="admin_delete_profile.php">
                <button>Delete profile</button>
            </a> 
            <a href="admin_reactivate_profile.php">
                <button>Reactivate profile</button>
            </a>  -->
            <button type="button" onclick="window.location.href = 'manager_home_view.php'">Back</button>
        </div>
    </div>
</body>
</html>
