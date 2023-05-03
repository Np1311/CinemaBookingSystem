<?php
require('user_model.php');

class manager extends user{

    public function createRoom($roomName,$roomType){
        global $conn;
        $conn -> select_db("CSIT314_Test");

        $sql = "CREATE TABLE IF NOT EXISTS cinemaRoom (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                roomName VARCHAR(225) NOT NULL,
                roomType VARCHAR(225) NOT NULL
                )";

        if ($conn->query($sql) === TRUE) {
            echo "Table created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }

        $sql2 = "INSERT INTO cinemaRoom (roomName, roomType) VALUES ('$roomName', '$roomType');";

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
}
?>