<?php
$conn = new mysqli('localhost','root', '');
require ('user_model.php');

class admin extends user{
    private $profile;

    public function _construct($profile){
        $this->profile = $profile;
    }

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
                `status` VARCHAR(25) DEFAULT 'active',
                
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
                `status` VARCHAR(25) DEFAULT 'active',
                
                PRIMARY KEY(phone)
            );";
        }

          if ($conn->query($sql) === TRUE) {
              echo "Table customer created successfully";
              return true;
          } else {
              echo "Error creating table: " . $conn->error;
              return false;
          }
    }
    public function listedProfile(){
        global $conn;
        $array = array();
        $sql = "SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema = 'CSIT314_Test';";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
          $array[]= $row['TABLE_NAME'];
        }
        return $array;
    }
    public function suspendAccount($curProfile,$userID){
        global $conn;
        $conn->select_db('CSIT314_Test');
        $sql = "UPDATE `$curProfile` SET `status` = 'suspend' WHERE `phone` = '$userID';";
        try {
            mysqli_query($conn, $sql); 
            echo '<script>alert("good to go")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
        return false;}
    }
    

}

// $adm = new admin('system_admin');

// $adm -> createUser('system_admin','Dan','redo',12345678,'bbb@gmail.com','asd','2022-10-09');
?>