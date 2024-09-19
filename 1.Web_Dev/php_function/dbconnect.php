<?php
$db_connect = mysqli_connect("127.0.0.1:3307", "root", "", "member");

if ($db_connect->connect_error) {
    echo "Failed to connect to MySQL: " . $db_connect->connect_error;
};
?>