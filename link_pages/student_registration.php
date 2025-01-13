<?php
extract($_POST);
include("connect.php");
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$username = $_POST['uname'];
$password = $_POST['pwd'];
//checking for same username is present in  the db or not.
$sql = "SELECT * FROM  student WHERE username = '$username'";
$result = mysqli_query($conn, $sql) or die("Error");
if(mysqli_num_rows($result) > 0) {
   echo("<script>alert('Username already exist.Try another username.'); location.replace('student_registration.html');</script>");
} else {
   //data inserting into the table.
   $sqlinsert = "INSERT INTO student(name, phone, email, username, password) VALUES('$name','$phone','$email','$username','$password')";
   if($conn->query($sqlinsert) === TRUE) {
      echo("<script>alert('Successfully registered.'); location.replace('student_registration.html');</script>");
   } else {
      echo "Error: ".$sql.'<br>'.$conn->error;
   }
}
?>