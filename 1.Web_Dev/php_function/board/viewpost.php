<?php
    require_once 'board_db.php';

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $post_id = intval($_GET['id']);
    }elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
            $post_id = intval($_POST['id']);
    }
    if ($post_id) {
        $sql = "SELECT * FROM posts WHERE idx_board = '$post_id'";
        $result = mysqli_query($db_connect, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $post = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('요청한 게시글이 없습니다.'); window.location.href = '../../board.php';</script>";
            exit;
        }
        mysqli_close($db_connect);
    } else {
    }
?>