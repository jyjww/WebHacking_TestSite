<?php
$db_connect = mysqli_connect("127.0.0.1:3307", "root", "", "member");
//$db_connect = mysqli_connect("localhost", "admin", "student1234", "member");

if ($db_connect->connect_error) {
    die("Connection failed: " . $db_connect->connect_error);
}
?>…