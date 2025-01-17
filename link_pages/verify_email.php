<?php
    extract($_POST);
    include("connect.php");

    if(isset($_GET['token'])){
        $token = $_GET['token'];
        $token_verify = "SELECT verify_token, verify_status FROM student WHERE verify_token = '$token' LIMIT 1";
        $token_verify_run = mysqli_query($conn, $token_verify);

        if(mysqli_num_rows($token_verify_run) > 0){
            $row = mysqli_fetch_array($token_verify_run);

            if($row['verify_status'] == "0"){
                $clicked_token = $row['verify_token'];
                $update_token = "UPDATE student SET verify_status = '1' WHERE verify_token = '$clicked_token' LIMIT 1";
                $update_token_run = mysqli_query($conn, $update_token);

                if($update_token_run){
                    echo("<script>alert('Email has been verified!'); location.replace('student_login.html');</script>");
                    exit(0);
                }
                else{
                    echo("<script>alert('Verification failed!'); location.replace('student_login.html');</script>");
                    exit(0);
                }
            }
            else{
                echo("<script>alert('Account already verified. Log in to continue!'); location.replace('student_login.html');</script>");
                exit(0);
            }
        }
        else{
            echo("<script>alert('Token doesn't exist!'); location.replace('student_login.html');</script>");
        }
    }
    else{
        echo("<script>alert('Not Allowed!'); location.replace('student_login.html');</script>");
    }
?>