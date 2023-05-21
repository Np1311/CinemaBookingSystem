<?php
$conn = new mysqli('localhost','root', '');

class user_model {
    private $phone;
    private $password;
    private $email;
    private $fname;
    private $lname;
    private $dob;

    
    public function createUser($profile,$fname,$lname,$phone,$email,$password,$dob){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        $mysql_date = date('Y-m-d', strtotime($dob));
        $sql = "INSERT INTO `$profile` (fname, lname, phone, email,`password`, dob)

        VALUES ('$fname','$lname','$phone','$email','$password','$mysql_date');";
        try {
            mysqli_query($conn, $sql); 
            // $this->setProfile($fname,$lname,$phone,$email,$mysql_date,$password);
            return true; }
        catch(mysqli_sql_exception $e) {
            //die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error creating user")</script>'; 
        return false;}
    }
    
    public function setAccount($user){
        $this->phone = $user;
    }
    
    public function getAccount($profile,$phone){
        global $conn;
        $arr = array();

        $conn -> select_db('CSIT314_Test');

        $sql = "SELECT * FROM `$profile` WHERE phone = '$phone';";
        $result = $conn->query($sql);

        // check if the query was successful
        if (!$result) {
        echo "Error: " . $conn->error;
        exit();
        }

        // fetch the result row as an associative array
        
        // $date = $row['dob'];
        // $dob = date("d/m/Y", strtotime($date));
        while ($row = mysqli_fetch_assoc($result) ) {
            $arr = $row;
        }
        return $arr;
        // assign the value to a variable
        
       
    }
    public function updateUser($curProfile,$fname,$lname,$phone,$email,$password,$dob,$status,$oldPhone){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        $mysql_date = date('Y-m-d', strtotime($dob));
        $sql =" UPDATE `$curProfile` SET `fname`='$fname',`lname`='$lname',`email`='$email',`dob`='$mysql_date', `password` = $password ,`phone`='$phone' ,`status`='$status' WHERE phone = '$oldPhone';";

        try {
            mysqli_query($conn, $sql); 
            //echo '<script>alert("good to go")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error creating user")</script>'; 
        return false;}
    }
    
    public function getAllAccount($profile){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        $array=[];
        $sql = "SELECT * FROM `$profile`;"; 

        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] =  $row;
        }
        return $array;
    }
}
// $con = new user;

// $con -> echoUser();
// print_r($arr);
// $con->checkUser(87945631,'qwe');
// print($con->getAccount());
// $con->createTable();
?>