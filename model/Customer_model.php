<?php
$conn = new mysqli('localhost','root', '');
class customer{
    
    private $phone;
    private $password;

    public function createTable(){
        global $conn;
        $conn -> select_db("CSIT314_Test");
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
    public function getPhoneandPass(){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        $array = array();
        
        $sql = "SELECT phone, `password` FROM `customer`;";
        
        $result = $conn->query($sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
          $array[$row['phone']] = $row['password'];
        }
       
  
  
        return $array;
    }
    public function setAccount($user){
        $this->phone = $user;
    }
    public function getAccount() {
        return $this->phone;
    }
    public function checkUser($loginPhone, $loginPass){
        $found = 'not found';
        $arr = $this->getPhoneandPass();
        foreach ($arr as $x => $x_value){
            if ($loginPhone== $x){
                 
                $found = 'found';
                if ($loginPass == $x_value){
                   $this->setAccount($loginPhone);
                   echo "<script>alert('true password');</script>";
                }else  
                    echo "<script>alert('wrong password');</script>";
            }
        }
        if ($found == 'not found'){
            echo "<script>alert('User not found');</script>";
        }
    }
}

$con = new customer;
//$arr = $con -> getPhoneandPass();
// print_r($arr);
$con->checkUser(87945631,'qwe');
print($con->getAccount());
?>
