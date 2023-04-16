<?php
$conn = new mysqli('localhost','root', '');
class customer{
    public function createTable(){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        $sql = "CREATE TABLE IF NOT EXISTS `customer` (
            `customer_id` int NOT NULL AUTO_INCREMENT,
            `fname` varchar(255) NOT NULL,
            `lname` varchar(255) NOT NULL,
            `seat_row` int NOT NULL DEFAULT 0,
            `seat_column`INT NOT NULL DEFAULT 0,
            `phone` INT NOT NULL DEFAULT 0,
            `email` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `dob` DATE NOT NULL,
            
            PRIMARY KEY(customer_id)
          );";
    
          if ($conn->query($sql) === TRUE) {
              //echo "Table customer created successfully";
          } else {
              echo "Error creating table: " . $conn->error;
          }
    }
    public function createUser($fname,$lname,$phone,$email,$password,$date){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        $mysql_date = date('Y-m-d', strtotime($date));
        $sql = "INSERT INTO customer (fname, lname, phone, email,`password`, dob)

        VALUES ('$fname','$lname','$phone','$email','$password','$mysql_date');";
        try {
            mysqli_query($conn, $sql); 
            return true; }
        catch(mysqli_sql_exception $e) {
            //die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error creating user")</script>'; 
        return false;}
    }
}


?>
