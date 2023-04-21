<?php
$conn = new mysqli('localhost','root', '');
require ('user_model.php');

class admin extends user{
    private $profile;

    public function __construct($profile){
        $this->profile = $profile;
    }

    public function createTable(){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        if ($this->profile == 'customer'){
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
            $profile = $this->profile;
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

// $adm = new admin('system_admin');

// $adm -> createUser('system_admin','Dan','redo',12345678,'bbb@gmail.com','asd','2022-10-09');
?>