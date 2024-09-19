<?php
// board_db.php 포함
require_once 'board_db.php';

// 게시글 ID 가져오기 (GET 또는 POST 요청에서)
$post_id = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = intval($_GET['id']);
} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $post_id = intval($_POST['id']);
}

// 게시글 정보 가져오기
if ($post_id) {
    $sql = "SELECT * FROM posts WHERE idx_board = ?";
    $stmt = $db_connect->prepare($sql);
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $post = $result->fetch_assoc();
        
        // 게시글 정보 설정
        $title = $post['title'] ?? '';
        $author = $post['author'] ?? '';
        $views = $post['views'] ?? 0;
        $created_at = $post['created_at'] ?? date('Y-m-d H:i:s');
        $content = $post['content'] ?? '';
    } else {
        echo "<script>alert('요청한 게시글이 없습니다.'); window.location.href = '../../board.php';</script>";
        exit;
    }
    $stmt->close();
} else {
    $title = '';
    $author = $username;
    $views = 0;
    $created_at = date('Y-m-d H:i:s');
    $content = '';
}

// 데이터베이스 연결 종료
$db_connect->close();
?>
