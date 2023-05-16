<?php
$conn = new mysqli('localhost','root', '');

class database_model {
    public function createDatabase($dbName){
        global $conn;

        $sql = "CREATE DATABASE IF NOT EXISTS $dbName";
        try {
            mysqli_query($conn, $sql); 
            echo "Database created successfully"; }
        catch(mysqli_sql_exception $e) {
            die("Error creating database: " . mysqli_error($conn)); }
    }


    public function createFirstProfile(){
        global $conn;
        $conn->select_db('CSIT314_Test');
        $sql = "CREATE TABLE IF NOT EXISTS `system_admin` (
                
            `fname` varchar(255) NOT NULL,
            `lname` varchar(255) NOT NULL,
            `phone` INT NOT NULL DEFAULT 0,
            `email` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `dob` DATE NOT NULL,
            `status` VARCHAR(25) DEFAULT 'active',
            
            PRIMARY KEY(phone)
        );";
    

      if ($conn->query($sql) === TRUE) {
          echo "Table customer created successfully";
          return true;
      } else {
          echo "Error creating table: " . $conn->error;
          return false;
      }
    }
    public function createFirstUser(){
        global $conn;
        $conn->select_db('CSIT314_Test');
        $mysql_date = '2022-12-13';
        $sql = "INSERT INTO `system_admin` (fname, lname, phone, email,`password`, dob)

        VALUES ('user1','user1',12345678,'abc@gmail.com','asd','$mysql_date');";
        try {
            mysqli_query($conn, $sql); 
            return true; }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error creating user")</script>'; 
        return false;}
    }

   
}


$con = new database_model;
$con -> createDatabase("CSIT314_Test");
$con -> createFirstProfile();
$con -> createFirstUser();

?>
