<?php
    include 'board_db.php';
    $post_id = $_GET['idx_board']; // URL 파라미터에서 게시물 ID를 가져옵니다

    // 조회수 증가 쿼리
    $sql_update = "UPDATE posts SET views = views + 1 WHERE idx_board = $post_id";
    $db_connect -> query($sql_update);
    //var_dump($sql_update);

    $sql = "SELECT * FROM posts WHERE idx_board = $post_id";
    $result = $db_connect->query($sql);
    $post = $result->fetch_assoc();

    echo $post['views'];

    $db_connect->close();

?>