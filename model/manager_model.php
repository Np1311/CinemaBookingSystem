<?php
require('user_model.php');

class manager extends user{

    public function createRoom($roomName,$roomType, $roomCapacity, $totalRow, $totalColumn){
        global $conn;
        $conn -> select_db("CSIT314_Test");

        $sql = "CREATE TABLE IF NOT EXISTS cinemaRoom (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                roomName VARCHAR(225) NOT NULL,
                roomType VARCHAR(225) NOT NULL,
                roomCapacity int(5) NOT NULL DEFAULT 0,
                totalRow int(3) NOT NULL DEFAULT 0,
                totalColumn int(3) NOT NULL DEFAULT 0,
                `status` VARCHAR(10) NOT NULL DEFAULT 'active'
                )";

        if ($conn->query($sql) === TRUE) {
            echo "Table created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }

        $sql2 = "INSERT INTO cinemaRoom (roomName, roomType, roomCapacity, totalRow, totalColumn) VALUES ('$roomName', '$roomType', '$roomCapacity', '$totalRow', '$totalColumn');";

        try {
            mysqli_query($conn, $sql2); 
            echo '<script>alert("good to go")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
        return false;}

    }

    public function viewRoom(){
        global $conn;
        $conn->select_db("CSIT314_Test");
        $array=[];

        $sql = "SELECT * FROM cinemaRoom;";

        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] =  $row;
        }
        return $array;

    }

    public function deleteRoom($deleteID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        $sql = "UPDATE cinemaRoom SET `status` = 'suspend';";

        try {
            mysqli_query($conn, $sql); 
            
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
        return false;
        }
    }

    public function getRoom($updateID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        $sql = "SELECT * FROM `cinemaRoom` WHERE id = '$updateID';";

        $result = $conn->query($sql);

        // check if the query was successful
        if (!$result) {
        echo "Error: " . $conn->error;
        exit();
        }

        // fetch the result row as an associative array
        
        while ($row = mysqli_fetch_assoc($result) ) {
            $arr = $row;
        }

        return $arr;
    }

    public function updateRoom($updateID,$roomName,$roomType,$roomCapacity,$totalRow,$totalColumn,$status){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        
        $sql =" UPDATE `cinemaRoom` SET `roomName`='$roomName',`roomType`='$roomType',`roomCapacity`='$roomCapacity',`totalRow`='$totalRow', `totalColumn`='$totalColumn' ,`status`='$status' WHERE id = '$updateID';";

        try {
            mysqli_query($conn, $sql); 
            
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error creating user")</script>'; 
        return false;}
    }
}

// $manager_model = new manager;

// $manager_model->updateRoom(1,'Room1','Standard',200,20,10,'active');
?>