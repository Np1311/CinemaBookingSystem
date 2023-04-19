<?php
$conn = new mysqli('localhost','root', '');

require('user_model.php');

$user = new user;

class login{
    
    public function getPhoneandPass($profile){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        $array = array();
        
        $sql = "SELECT phone, `password` FROM `$profile`;";
        
        $result = $conn->query($sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
          $array[$row['phone']] = $row['password'];
        }
       
  
  
        return $array;
    }
    public function checkUser($loginPhone, $loginPass){
        global $user;
        $found = 'not found';
        $arr = $this->getPhoneandPass();
        foreach ($arr as $x => $x_value){
            if ($loginPhone== $x){
                 
                $found = 'found';
                if ($loginPass == $x_value){
                   $user->setAccount($loginPhone);
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
}
?>