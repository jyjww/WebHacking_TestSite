<?php
    $db_connect = mysqli_connect("localhost", "admin", "student1234", "board");

    if ($db_connect->connect_error) {
        die("Connection failed: " . $db_connect->connect_error);
    }

    $db_connect ->set_charset("utf8");
?>