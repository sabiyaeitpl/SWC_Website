<?php 
include "../database/connection.inc.php";
if(isset($_GET['checkEmailExsist'])){
    $email = $_GET['email'];    
    $res=mysqli_query($con,"SELECT * FROM admin_users where email='$email'");
    $number_of_rows = mysqli_num_rows($res);
    $check=mysqli_fetch_assoc($res);
    echo $number_of_rows;
   

}


?>