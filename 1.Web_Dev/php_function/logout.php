<?php
session_start();
require_once('dbconnect.php');

if (isset($_SESSION['username'])) {
    $session_id = session_id();
    //echo "Logout $id<br>";

    $sql = "SELECT username FROM login WHERE session_id = '$session_id'";
    $result = mysqli_query($db_connect, $sql);

    if ($result->num_rows > 0) {
        $row = $result -> fetch_assoc();
        $username = $row['username'];
        echo "Logout $username<br>";
    
        $clear_session_sql = "UPDATE login SET session_id = NULL WHERE username = '$username'";
        if (mysqli_query($db_connect, $clear_session_sql)) {
            echo "Session ID cleared successfully<br>";
        } else {
            echo "Failed to clear session ID: " . mysqli_error($db_connect) . "<br>";
        }
    } else {
        echo "Failed to clear session ID: " . mysqli_error($db_connect) . "<br>";
    }
} else {
    echo "No login user found.<br>";
}

$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_unset();
session_destroy();

echo "<script>alert('Good Bye, $username!'); location='../mainpage.php'</script>";
?>