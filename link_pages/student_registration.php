<?php
extract($_POST);
include("connect.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token){
    $mail = new PHPMailer(true);

    $mail->isSMTP();                                         
    $mail->SMTPAuth   = true; 

    $mail->Host       = 'smtp.gmail.com';              
    $mail->Username   = 'tanmaymishra283@gmail.com';                 
    $mail->Password   = 'nczpunlnbhvpmjxo'; 
                                                         
    $mail->SMTPSecure = 'tls';                          
    $mail->Port       = 587; 

    $mail->setFrom('tanmaymishra283@gmail.com', $name);
    $mail->addAddress($email);  
                                                              
    $mail->isHTML(true);                                 
    $mail->Subject = 'Email Verification from TrackMyCourse';
    
    $email_template = "
    <h2>You have signup with TrackMyCourse</h2>
    <h5>verify your email address to login with the below given link</h5>
    <br/><br/>
    <a href = 'http://localhost/login_email_verification/verify_email.php?token=$verify_token'>Click Me</a>
    " ;
    $mail->Body = $email_template;
    $mail->send();
    //echo"mail sent";
}


$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$username = $_POST['uname'];
$password = $_POST['pwd'];
$verify_token = md5(rand());
//checking for same username is present in  the db or not.
$sql = "SELECT * FROM  registered_students WHERE username = '$username'";
$result = mysqli_query($conn, $sql) or die("Error");
if(isset($_POST["verify_email"])){
   if(mysqli_num_rows($result) > 0) {
      echo("<script>alert('Username already exist.Try another username.'); location.replace('student_registration.html');</script>");
   } else {
      //data inserting into the table.
      $sqlinsert = "INSERT INTO registered_students(name, phone, email, username, password, verify_token) VALUES('$name','$phone','$email','$username','$password', '$verify_token')";
      $sqlinsertrun =  mysqli_query($conn, $sqlinsert);


      if($sqlinsertrun){
         sendemail_verify($name, $email, $verify_token);
         header("location: link_pages/student_login.php");
      }

      //if($conn->query($sqlinsert) === TRUE) {
        // echo("<script>alert('Successfully registered.'); location.replace('student_registration.html');</script>");
      //} else {
         //echo "Error: ".$sql.'<br>'.$conn->error;
      //}
   }
}

?>