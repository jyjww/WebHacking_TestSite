<?php
session_start();
include 'board_db.php'; // 데이터베이스 연결 파일 포함

if ($db_connect->connect_error) {
    error_log("Database connection failed: " . $db_connect->connect_error);
    exit("Error occurred while connecting to the database.");
}

// GET 파라미터 받기
$criteria = isset($_GET['criteria']) ? $_GET['criteria'] : '';
$board = isset($_GET['board']) ? $_GET['board'] : '';
$query = isset($_GET['query']) ? $_GET['query'] : '';

$created_start = isset($_GET['created_start']) ? $_GET['created_start'] : '';
$created_end = isset($_GET['created_end']) ? $_GET['created_end'] : '';

$validCriteria = ['author', 'title', 'content'];

// 검색 조건 생성
if (empty($criteria) || empty($query)) {
    echo "<script>alert('검색 기준과 검색어를 입력해주세요.') window.location.href = '../../board.php';</script>";
    exit();
}

if (!in_array($criteria, $validCriteria)) {
    echo "<script>alert('유효하지 않은 검색 기준입니다.') window.location.href = '../../board.php';</script>";
    exit();
}

$sql = "SELECT * FROM posts WHERE ";
$searchConditions = [];

if (empty($criteria)) {
    foreach ($validCriteria as $criteria) {
        $searchConditions[] = "$criteria LIKE '%$query%'";
    }
    $sql .= "(" . implode(" OR ", $searchConditions) . ")";
} else {
    if (!in_array($criteria, $validCriteria)) {
        echo "<script>alert('유효하지 않은 검색 기준입니다.') window.location.href = '../../board.php';</script>";
        exit();
    }
    $sql .= "$criteria LIKE '%$query%'";
}

if (!empty($board)) {
    $sql .= " AND board = '$board'";
}

// ** 추가된 부분: created 기간 조건 추가 **
if (!empty($created_start) && !empty($created_end)) {
    $sql .= " AND created_at BETWEEN '$created_start' AND '$created_end'";
} elseif (!empty($created_start)) {
    $sql .= " AND created_at >= '$created_start'";
} elseif (!empty($created_end)) {
    $sql .= " AND created_at <= '$created_end'";
}

//debug code
//echo "SQL: $sql<br>";

$result = $db_connect->query($sql);

if (!$result) {
    echo "<pre>";
    echo "SQL query error: ", $board_db->error, "<br>";
    echo "SQL query: ", $sql, "<br>";
    echo "Params: ", json_encode($params), "<br>";
    echo "</pre>";
    exit();
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['idx_board']}</td>";
        echo "<td><a href='viewpost.php?id={$row['idx_board']}'>{$row['title']}</a></td>";
        echo "<td>{$row['author']}</td>";
        echo "<td>{$row['views']}</td>";
        echo "<td>{$row['created_at']}</td>";
        echo "</tr>";
    }
} else {
    echo "<script>alert('검색 결과를 찾을 수 없습니다.'); window.location.href = '../../board.php';</script>";
}

$db_connect->close();
?>