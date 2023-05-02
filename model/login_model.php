<?php
$conn = new mysqli('localhost','root', '');

require('user_model.php');

$user = new user;

class login{
    private $profile;
    private $uid;
    private $pass;

    public function __construct($profile,$phone, $pass){
        $this->profile = $profile;
        $this->uid = $phone;
        $this->pass = $pass;

    }

    
    public function getPhoneandPass($profile){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        $array = array();
        
        $sql = "SELECT `phone`, `password` FROM $profile;";
        
        $result = $conn->query($sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
          $array[$row['phone']] = $row['password'];
        }
       print_r ($array);
       echo $profile;
  
  
        return $array;
    }
    public function checkUser(){
        global $user;
        $found = 'not found';
        echo $this->profile;
        echo $this->uid;
        echo $this->pass;
        $arr = $this->getPhoneandPass($this->profile);
        foreach ($arr as $x => $x_value){
            if ($this->uid== $x){
                 
                $found = 'found';
                if ($this->pass == $x_value){
                   $user->setAccount($this->uid);
                   echo "<script>alert('Password Correct');</script>";
                   return true;
                }else  
                    echo "<script>alert('Inccorect password');</script>";
                    return false;
            }
        }
        if ($found == 'not found'){
            echo "<script>alert('User not found');</script>";
        }

    }
}
?>