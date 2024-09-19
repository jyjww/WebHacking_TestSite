<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once 'dbconnect.php';

//비로그인 사용자 마이페이지 접근 차단
if (!isset($_SESSION['username'])) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href = './mainpage.php';</script>";
    exit();
}

$username = $_SESSION['username'];
$query = "SELECT pass, info FROM login WHERE username = '$username'";
$result = mysqli_query($db_connect, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // 데이터가 있을 경우 정보 출력
        $row = mysqli_fetch_assoc($result);
        $pass0 = $row['pass'];
        $info = $row['info'];
    } else {
        echo "<script>alert('해당 사용자의 정보를 찾을 수 없습니다.'); window.location.href = '../mainpage.php';</script>";
    }
} else {
    echo "쿼리 실행 중 오류가 발생했습니다: " . mysqli_error($db_connect);
}

// POST로 전달된 데이터 받기
$submitted_username = $_POST['name']; // 제출된 사용자 이름
$pass_current = $_POST['pass_current'];
$new_pass1 = $_POST['pass1'];
$new_pass2 = $_POST['pass2'];
$new_info = $_POST['info'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST 요청이 있을 때만 실행
    if ($new_pass1 !== $new_pass2) {
        echo "<script>alert('새로운 비밀번호가 일치하지 않습니다.'); window.location.href = '../mypage.php';</script>";
        exit();
    }

    if ($pass0 !== $pass_current) {
        echo "<script>alert('현재 비밀번호가 일치하지 않습니다.'); window.location.href = '../mypage.php';</script>";
        exit();
    }

    // 비밀번호가 일치하고 새로운 비밀번호가 유효한 경우 업데이트 실행
    $query = "UPDATE login SET pass = '$new_pass1', info = '$new_info' WHERE username = '$username' AND pass = '$pass_current'";
    $result = mysqli_query($db_connect, $query);

    if ($result && mysqli_affected_rows($db_connect) > 0) {
        $clear_session_sql = "UPDATE login SET session_id = NULL WHERE username = '$username'";
        mysqli_query($db_connect, $clear_session_sql);
        echo "<script>alert('정보가 성공적으로 업데이트되었습니다. 다시 로그인 해주세요.'); window.location.href = '../loginpage.php';</script>";
    } else {
        // 비밀번호가 일치하지 않거나, 정보 수정이 이루어지지 않은 경우
        echo "<script>alert('현재 비밀번호가 일치하지 않거나 업데이트할 정보가 없습니다.'); window.location.href = '../mypage.php';</script>";
    }
}
?>