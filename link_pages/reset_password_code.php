<?php
 extract($_POST);
 include("connect.php");

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

 //Load Composer's autoloader
 require 'vendor/autoload.php';

function reset_password_mail($name, $email, $token){
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
     $mail->Subject = 'Reset Your TrackMyCourse Password';
     
     $email_template = "
     <h2>This Email is sent to you by TrackMyCourse to Reset Your Password</h2>
     <h5>To reset Your password click the below given link</h5>
     <br/><br/>
     <a href = 'http://localhost/MinorProject/link_pages/change_password.php?token=$token&email=$email'>Click Me</a>
     " ;
     $mail->Body = $email_template;
     $mail->send();
     //echo"mail sent";
}

if(isset($_POST['reset'])){
    if(!empty(trim($_POST['email']))){
        $email = $_POST['email'];
        $check_email = "SELECT * FROM student WHERE email ='$email' LIMIT 1 ";
        $check_email_run = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($check_email_run) > 0){
            $row = mysqli_fetch_array($check_email_run);
            $get_name = $row['name'];
            $get_email = $row['email'];
            $get_token = $row['verify_token'];

            reset_password_mail($get_name, $get_email, $get_token);
            echo("<script>alert('A password reset link has been sent to your email!'); location.replace('reset_password.php');</script>");
            exit(0);
        }
        else{
            echo("<script>alert('Email not found register to continue!'); location.replace('student_registration.html');</script>");
            exit(0);
        }
    }
    else{
        echo("<script>alert('Email field is mandatory!'); location.replace('reset_password.php');</script>");
        exit(0);
    }
}

if(isset($_POST['update_password_btn'])){
    if(isset($_POST['token'])){
        if(!empty(trim($_POST['password'])) && !empty(trim($_POST['confirm_password'])) && !empty(trim($_POST['email']))){
            $token = $_POST['token'];
            $new_password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $email = $_POST['email'];

            $check_token = "SELECT * FROM student WHERE verify_token = '$token' LIMIT 1";
            $check_token_run = mysqli_query($conn, $check_token);

            if(mysqli_num_rows($check_token_run) > 0){
                if($new_password == $confirm_password){
                    $update_password = "UPDATE student SET password= '$new_password' WHERE verify_token = '$token' LIMIT 1";
                    $update_password_run = mysqli_query($conn, $update_password);
                    if($update_password_run){
                        $new_token = md5(rand());
                        $update_token = "UPDATE student SET verify_token= '$new_token' WHERE email = '$email' LIMIT 1";
                        $update_token_run = mysqli_query($conn, $update_token);
    
                        echo("<script>alert('Password has been changed!'); location.replace('student_login.html');</script>");
                        exit(0);
                    }
                    else{
                        echo("<script>alert('Password cannot be changed something went wrong!'); location.replace('change_password.php');</script>");
                        exit(0);
                    }
                }
                else{
                    echo("<script>alert('Passwords doesn't match!'); location.replace('change_password.php');</script>");
                    exit(0);
                }
            }
            else{
                echo("<script>alert('Invalid Token. Try to get a new reset password email!'); location.replace('change_password.php');</script>");
                exit(0);
            }  
        }
        else{
            echo("<script>alert('All fields are mandatory!'); location.replace('change_password.php');</script>");
            exit(0);
        }
    }
    else{
        echo("<script>alert('Invalid Token!'); location.replace('change_password.php');</script>");
        exit(0);
    }
    
}
?>