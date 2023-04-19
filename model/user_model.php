<?php

class user {
    private $phone;
    private $password;
    private $email;
    private $fname;
    private $lname;
    private $dob;

    
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
    
    public function setAccount($user){
        $this->phone = $user;
    }
    public function setProfile($fname, $lname, $email, $dob, $password){
        // sanitize input data
        $fname = filter_var($fname, FILTER_SANITIZE_STRING);
        $lname = filter_var($lname, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $dob = filter_var($dob, FILTER_SANITIZE_STRING);
    
        // set the values
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->dob = $dob;
        $this->password = $password;
      }
    public function getAccount() {
        return $this->phone;
    }
    public function getFname(){
        return $this->fname;
    }
    
    public function getLname(){
        return $this->lname;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getDob(){
        return $this->dob;
    }

    public function getPassword(){
        return $this->password;
    }
    
    public function getProfile($phone){
        global $conn;

        $conn -> select_db('CSIT314_Test');

        $sql = "SELECT * FROM `customer` WHERE phone = '$phone';";
        $result = $conn->query($sql);

        // check if the query was successful
        if (!$result) {
        echo "Error: " . $conn->error;
        exit();
        }

        // fetch the result row as an associative array
        $row = $result->fetch_assoc();
        $date = $row['dob'];
        $dob = date("d/m/Y", strtotime($date));
        

        // assign the value to a variable
        $this->setProfile($row['fname'],$row['lname'],$row['email'],$dob,$row['password']);
       
    }
    public function updateUser($fname,$lname,$phone,$email,$date,$oldPhone){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        $mysql_date = date('Y-m-d', strtotime($date));
        $sql =" UPDATE `customer` SET `fname`='$fname',`lname`='$lname',`email`='$email',`dob`='$mysql_date', `phone`='$phone' WHERE phone = '$oldPhone';";

        try {
            mysqli_query($conn, $sql); 
            echo '<script>alert("good to go")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error creating user")</script>'; 
        return false;}
    }
    public function echoUser(){
        echo 'try';
    }
}
// $con = new user;

// $con -> echoUser();
// print_r($arr);
// $con->checkUser(87945631,'qwe');
// print($con->getAccount());
// $con->createTable();
?>