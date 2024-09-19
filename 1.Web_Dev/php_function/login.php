<?php
session_start();
require_once 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // 로그인 처리
        $id = $_POST['username'];
        $pass = $_POST['pass1'];

        $sql = "SELECT * FROM login WHERE username = '$id' AND pass='$pass'";
        $result = mysqli_query($db_connect, $sql);
        echo "$sql<br>";

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $id;
            $_SESSION['pass1'] = $pass;

            $session_id = session_id();
            $update_sql = "UPDATE login SET session_id = '$session_id' WHERE username = '$id'";
            if (mysqli_query($db_connect, $update_sql)) {
                echo "Session ID updated successfully<br>";
            } else {
                echo "Failed to update session ID: " . mysqli_error($db_connect) . "<br>";
            }
            //mysqli_query($db_connect, $update_sql);

            echo "<script>alert('Welcome! $id'); location='../mainpage.php'</script>";
        } else {
            echo "Login failed<br>";
            session_regenerate_id(true);
        }
    } elseif (isset($_POST['logout'])) {
        if (isset($_SESSION['username'])) {
            $id = $_SESSION['username'];
            echo "Logout $id<br>";

            $clear_session_sql = "UPDATE login SET session_id = NULL WHERE username = '$id'";
            mysqli_query($db_connect, $clear_session_sql);
        }
        session_unset(); 
        session_destroy(); 

        echo "<script>alert('Good Bye, $id!'); location='../mainpage.php'</script>";
    }
}

mysqli_close($db_connect);
?>
