<?php
$conn = new mysqli('localhost','root', '');

class admin {
    public function createTable($profile){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        if ($profile == 'customer'){
            $sql = "CREATE TABLE IF NOT EXISTS `customer` (
                
                `fname` varchar(255) NOT NULL,
                `lname` varchar(255) NOT NULL,
                `seat_row` int NOT NULL DEFAULT 0,
                `seat_column`INT NOT NULL DEFAULT 0,
                `phone` INT NOT NULL DEFAULT 0,
                `email` VARCHAR(255) NOT NULL,
                `password` VARCHAR(255) NOT NULL,
                `dob` DATE NOT NULL,
                
                PRIMARY KEY(phone)
            );";
        }else{
            $sql = "CREATE TABLE IF NOT EXISTS `$profile` (
                
                `fname` varchar(255) NOT NULL,
                `lname` varchar(255) NOT NULL,
                `phone` INT NOT NULL DEFAULT 0,
                `email` VARCHAR(255) NOT NULL,
                `password` VARCHAR(255) NOT NULL,
                `dob` DATE NOT NULL,
                
                PRIMARY KEY(phone)
            );";
        }

          if ($conn->query($sql) === TRUE) {
              echo "Table customer created successfully";
          } else {
              echo "Error creating table: " . $conn->error;
          }
    }
}
?>