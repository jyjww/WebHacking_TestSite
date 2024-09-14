<?php
    require_once 'dbconnect.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $current_session_id = session_id();
    $query = "SELECT COUNT(*) FROM login WHERE session_id = '$current_session_id'";
    $result = $db_connect -> query($query);
    $row = $result -> fetch_assoc();

    //print_r($row);
    //var_dump($row);
    
    if ($row['COUNT(*)'] == 1) {
        echo '<button onclick="location.href=\'php_function/logout.php\'" name="logout">로그아웃</button>';
        echo '<button onclick="location.href=\'mypage.php\'" name="logout">마이페이지</button>';
    } else {
        echo '<button onclick="location.href=\'loginpage.php\'" name="login">로그인</button>';
        echo '<button onclick="location.href=\'registerpage.php\'">회원가입</button>';
    }
?>