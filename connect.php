<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "cms";
$conn = mysqli_connect($server, $user, $password, $db);
if(!$conn) {
   die("Connection failed".mysqli_connect_error());
} else {
//   echo ("server connected successfuly");
}
?>