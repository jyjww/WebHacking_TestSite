<?php
    $db_connect = mysqli_connect("127.0.0.1:3307", "root", "", "board");   
    //$db_connect = mysqli_connect("localhost", "admin", "student1234", "board");

    if ($db_connect->connect_error) {
        echo "Connection failed: " . $db_connect->connect_error;
    };

    $db_connect ->set_charset("utf8");
?>