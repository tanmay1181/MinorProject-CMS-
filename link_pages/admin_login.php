<?php
include("connect.php");
extract ($_POST);
$username = $_POST['uname'];
$password = $_POST['pwd'];
//checking for same username is present in the database or not.
$sql = "SELECT * FROM admin WHERE username = '$username'";
$result = mysqli_query($conn, $sql) or die("Error");
if(mysqli_num_rows($result) > 0) {
   $row = mysqli_fetch_assoc($result);
   if($username == $row['username'] and $password == $row['password']) {
      echo("Username and password matched.");
   } else {
      echo("<script>alert('Incorrect username and password.'); location.replace('admin_login.html');</script>");
   }
} else {
   echo("<script>alert('Username or password does not exist.'); location.replace('admin_login.html');</script>");
}
?>