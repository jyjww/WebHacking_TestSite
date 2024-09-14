<?php
require_once 'board_db.php';

$board = isset($_GET['board']) ? $_GET['board'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'created_at'; // 기본 정렬 기준은 작성일

$sql = "SELECT idx_board, title, author, views, created_at FROM posts";
if ($board) {
    $sql .= " WHERE board = '$board'";
}
$sql .= " ORDER BY " . mysqli_real_escape_string($db_connect, $sort) . " DESC";

$result = mysqli_query($db_connect, $sql);

if ($result === false) {
    error_log("SQL query failed: " . mysqli_error($db_connect));
    echo "<tr><td colspan='5'>Error fetching posts</td></tr>";
}

// 결과를 테이블로 출력
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['idx_board']}</td>
                <td><a href='post.php?id={$row['idx_board']}'>{$row['title']}</a></td>
                <td>{$row['author']}</td>
                <td>{$row['views']}</td>
                <td>{$row['created_at']}</td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No posts found</td></tr>";
}

mysqli_close($db_connect);
?>
