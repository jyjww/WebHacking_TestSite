<?php
require_once 'dbconnect.php';

if(session_status()==PHP_SESSION_NONE){
    session_start();
};

if (isset($_SESSION['username'])) {
    $session_id = session_id();
    
    $sql = "SELECT username FROM login WHERE session_id = '$session_id'";
    $result = mysqli_query($db_connect, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "안녕하세요. " . htmlspecialchars($row['username']) . "님.";
    } else {
        echo "안녕하세요. yyz_code입니다.";
    }
} else{
    echo"안녕하세요. yyz_code입니다.";
};
?>