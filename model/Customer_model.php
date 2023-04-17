<?php
$conn = new mysqli('localhost','root', '');
class customer{
    
    private $phone;
    private $password;
    private $email;
    private $fname;
    private $lname;
    private $dob;

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
    public function checkUser($loginPhone, $loginPass){
        $found = 'not found';
        $arr = $this->getPhoneandPass();
        foreach ($arr as $x => $x_value){
            if ($loginPhone== $x){
                 
                $found = 'found';
                if ($loginPass == $x_value){
                   $this->setAccount($loginPhone);
                   echo "<script>alert('true password');</script>";
                   return true;
                }else  
                    echo "<script>alert('wrong password');</script>";
                    return false;
            }
        }
        if ($found == 'not found'){
            echo "<script>alert('User not found');</script>";
        }
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
}

$con = new customer;
//$arr = $con -> getPhoneandPass();
// print_r($arr);
// $con->checkUser(87945631,'qwe');
//print($con->getAccount());
// $con->createTable();
?>
