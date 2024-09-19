<?php
    require_once 'board_db.php';

    session_start();

    // Function to fetch post by ID
    function getPostById($post_id) {
        global $db_connect;
        $sql = "SELECT * FROM posts WHERE idx_board = ?";
        $stmt = $db_connect->prepare($sql);
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc(); // Return the post data as an associative array
        } else {
            echo "<script>alert('요청한 게시글이 없습니다.'); window.location.href = '../../board.php';</script>";
            exit;
        }
    }

    // Function to check if the current user can edit the post
    function canEditPost($author, $session_username) {
        return $author === $session_username;
    }

    // Function to get post data for editing
    function getPostDataForEdit($post_id, $session_username) {
        $post = getPostById($post_id);
        if (!$post) {
            echo "<script>alert('게시글을 찾을 수 없습니다.'); window.location.href = '../../board.php';</script>";
            exit;
        }
        
        if (!canEditPost($post['author'], $session_username)) {
            echo "<script>alert('이 게시글을 수정할 권한이 없습니다.'); window.location.href = 'post.php?id=" . $post_id . "';</script>";
            exit;
        }
        
        return $post;
    }

    // Retrieve post ID from GET or POST request
    $post_id = null;
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $post_id = intval($_GET['id']);
    } elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $post_id = intval($_POST['id']);
    }

    if ($post_id) {
        // Fetch the post using the post ID
        $post = getPostById($post_id);
    } //else {
        //echo "<script>alert('잘못된 접근입니다.'); window.location.href = 'board.php';</script>";
        //exit;
    //}

    // Fetch the session username (assuming it's stored in the session)
    $session_username = $_SESSION['username'] ?? '';

    // 파일 끝에 추가
    if (isset($post_id)) {
        $post = getPostById($post_id);
        
        // 수정 페이지인 경우에만 권한 체크
        if (basename($_SERVER['PHP_SELF']) === 'updatepost.php') {
            if (!canEditPost($post['author'], $session_username)) {
                echo "<script>alert('이 게시글을 수정할 권한이 없습니다.'); window.location.href = 'post.php?id=" . $post_id . "';</script>";
                exit;
            }
        }
    }
?>