<?php
$conn = new mysqli('localhost','root', '');

require('user_model.php');




class login_model extends user_model{
    private $profile;
    private $uid;
    private $pass;

    // The constructor initializes the profile, phone, and password properties.
    public function __construct($profile,$phone, $pass){
        $this->profile = $profile;
        $this->uid = $phone;
        $this->pass = $pass;

    }

    //Function to retrieve phone and password
    public function getPhoneandPass($profile){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        $array = array();
        
        $sql = "SELECT `phone`, `password` FROM $profile WHERE status = 'active';";
        
        $result = $conn->query($sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
          $array[$row['phone']] = $row['password'];
        }
       
        return $array;
    }
    //Function to check user
    public function checkUser(){
      
        $found = 'not found';

        $arr = $this->getPhoneandPass($this->profile);
        foreach ($arr as $x => $x_value){
            if ($this->uid== $x){
                 
                $found = 'found';
                if ($this->pass == $x_value){
                   $this->setAccount($this->uid);
                   // Password is correct
                   echo "<script>alert('Password Correct');</script>";
                   return true;
                }else{
                    // Incorrect password
                    echo "<script>alert('Inccorect password');</script>";
                    return false;
                }
            }
        }
        // User not found
        if ($found == 'not found'){
            echo "<script>alert('User not found');</script>";
        }

    }
    //Function to log out of account
    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        return true;
    }
}
?>