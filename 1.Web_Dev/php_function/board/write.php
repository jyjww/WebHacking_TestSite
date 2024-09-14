<?php
// db_connect.php
function connectToDatabase($dbname) {
    $servername = "localhost";
    $username = "admin";
    $password = "student1234";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn ->set_charset("utf8");
    return $conn;
}

// Usage examples
$member_db = connectToDatabase("member");
$board_db = connectToDatabase("board");

echo "Connected successfully<br>";

// 로그인된 사용자 정보 가져오기 (예제: 세션에서 사용자 정보 가져오기)
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href = 'login.php';</script>";
    exit;
} else{
    echo "Welcome! " . $_SESSION['username'] . "<br>";
}
$username = $_SESSION['username'];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idx_board']) && isset($_POST['author']) && isset($_POST['title']) && isset($_POST['content'])) {
    //$post_id = intval($_POST['idx_board']);
    $author = $_POST['author'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (isset($_POST['idx_board']) && !empty($_POST['idx_board'])) {
        // 글 수정
        $post_id = intval($_POST['idx_board']);

        // 작성자와 로그인된 사용자 확인
        if ($author !== $username) {
            echo "<script>alert('수정 권한이 없습니다.'); window.location.href = 'board.php';</script>";
            exit;
        }
        // 게시글 수정 쿼리 실행
        $update_query = "
        UPDATE posts 
        SET title = '$title', content = '$content'
        WHERE idx_board = $post_id AND author = '$author'
        ";
        if ($board_db->query($update_query) === TRUE) {
            echo "<script>alert('게시글이 성공적으로 수정되었습니다.'); window.location.href = '../../updatepost.php';</script>";
        } else {
            echo "오류가 발생했습니다: " . $board_db->error;
        }
    } else {
        // 글 만들기
        $author = isset($_SESSION['username']) ? $_SESSION['username'] : '';
        $insert_query = "
            INSERT INTO posts (author, title, content, views, created_at) 
            VALUES ('$author', '$title', '$content', 0 , NOW())
        ";
        if ($board_db->query($insert_query) === TRUE) {
            $new_post_id = $board_db->insert_id;
            echo "<script>alert('게시글 작성 완료'); window.location.href = '../../post.php?id=$new_post_id';</script>";
        } else {
            echo "오류가 발생했습니다: " . $board_db->error;
        }
    }
} else {
    echo "오류가 발생했습니다: " . $board_db->error;
}

$board_db->close();
?>