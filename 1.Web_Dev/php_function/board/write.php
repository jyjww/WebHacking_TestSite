<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "<script>alert('글을 작성하려면 로그인이 필요합니다.'); window.location.href = 'login.php';</script>";
    exit;
}

// db connect to two databases
function connectToDatabase($dbname) {
    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn ->set_charset("utf8");
    return $conn;
}

$member_db = connectToDatabase("member");
$board_db = connectToDatabase("board");

// 로그인 여부 검증

echo $_SESSION['username'] . "<br>";

if (isset($_SESSION ['username'])) {
    $author = $_SESSION['username'];
}else{
    echo "<script>alert('Login Required to Write');</script>; window.location.href = '../../board.php';</script>";
}

//새로운 글 등록
function createNewPost ($dbname, $author, $title, $content) {
    $insert_query = "INSERT INTO posts (author, title, content, views, created_at) VALUES ('$author', '$title', '$content', 0, NOW())";
    echo $insert_query;
    if ($dbname->query($insert_query) === true){
        echo "<script>alert('게시글 작성 완료.'); window.location.href = '../../board.php';</script>";
    }else{
        echo "Error: " . $insert_query . "<br>" . $dbname->error;
    }
}

function updatePost($dbname, $post_id, $author, $title, $content) {
    // 먼저 게시글 존재 여부와 작성자 확인
    $check_query = "SELECT author FROM posts WHERE idx_board = ? LIMIT 1";
    $check_stmt = $dbname->prepare($check_query);
    $check_stmt->bind_param("i", $post_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['author'] == $_SESSION['username']) {
            // 게시글 업데이트
            $update_query = "UPDATE posts SET title = ?, content = ? WHERE idx_board = ? AND author = ?";
            $update_stmt = $dbname->prepare($update_query);
            $update_stmt->bind_param("ssis", $title, $content, $post_id, $author);

            // SQL 쿼리 출력
            if ($update_stmt->execute()) {
                echo "게시글이 성공적으로 수정되었습니다.";
                echo "<script>alert('게시글이 수정되었습니다.'); window.location.href = '../../post.php?id=" . $post_id . "';</script>";
            } else {
                echo "Error: " . $update_stmt->error;
            }
            $update_stmt->close();
        } else {
            echo "<script>alert('이 게시글을 수정할 권한이 없습니다.');</script>";
            exit;
        }
    } else {
        echo "Error: 해당 ID의 게시글을 찾을 수 없습니다: " . $post_id;
        exit;
    }
    $check_stmt->close();
}

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = $_SESSION['username'] ?? '';
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // 기존 글 수정
        $post_id = intval($_POST['id']);
        updatePost($board_db, $post_id, $author, $title, $content);
    } else {
        // 새 글 작성
        createNewPost($board_db, $author, $title, $content);
    }
} else {
    echo "잘못된 요청입니다.";
}

$board_db->close();
?>