<?php
require_once('dbconnect.php');

if(session_status()==PHP_SESSION_NONE){
    session_start();
}

if (isset($_SESSION['username'])) {
    $session_id = session_id();
    $sql = "SELECT username, info FROM login WHERE session_id = '$session_id'";
    $result = mysqli_query($db_connect, $sql);

    if ($result && $result -> num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $info = $row['info'];

        //echo "$username, $info<br>";
        //echo htmlspecialchars($username)."<br>";
    }else{
        $username='';
        $info='No User Found with this session id';
    }
}else{
    header('Location: ../mainpage.php');
    exit;
}

if (isset($_POST['mypage_submit'])) {
    $new_username = $_POST['name'];
    $new_pass = $_POST['pass1'];
    $new_info = $_POST['info'];
    //echo "$new_username, $new_pass, $new_info<br>";

    if(empty($new_username) || empty($new_pass) || empty($new_info)){
        echo "<script>alert('모두 입력해주세요');</script>";
    }else{
        $update_sql = "UPDATE login SET username = '$new_username', pass = '$new_pass', info = '$new_info' WHERE session_id = '$session_id'";
        $result = mysqli_query($db_connect, $update_sql);

        if ($result) {
            echo "<script>alert('회원 정보가 수정되었습니다.'); window.location.href='../mainpage.php';</script>";
        } else {
            echo "Error updating user information: " . mysqli_error($db_connect);
        }
    }
}

mysqli_close($db_connect);

?>