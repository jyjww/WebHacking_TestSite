<?php
include 'php_function/board/viewpost.php';

if (!isset($_SESSION['username'])) {
    echo "<script>alert('게시글을 작성하거나 수정하려면 로그인이 필요합니다.'); window.location.href = 'login.php';</script>";
    exit;
}

$post = getPostById($post_id);
if (!$post || $post['author'] !== $_SESSION['username']) {
    echo "<script>alert('이 게시글을 수정할 권한이 없습니다.'); window.location.href = 'post.php?id=" . $post_id . "';</script>";
    exit;
}

?>
<!DOCTYPE html>
<html lang="ko">
    <?php include 'page_general/board_head.php'; ?>
    <body class="community_body">
        <?php include 'page_general/board_header.php'; ?>
        <main class="board_container">
            <?php include 'page_general/board_sidebar.php'; ?>
            <form method="post" action="php_function/board/write.php">
                <input type="hidden" name="id" value="<?php echo $post_id; ?>">
                <div class="board">
                    <div class="board_about">
                        <h1><input type="text" name="title" placeholder="제목" value="<?php echo htmlspecialchars($post['title']); ?>"></h1>
                        <p>작성자</p>
                        <p class="db_info"><?php echo htmlspecialchars($post['author']); ?></p>
                        <p>조회수</p>
                        <p class="db_info"><?php echo htmlspecialchars($post['views']); ?></p>
                        <p>작성일</p>
                        <p class="db_info"><?php echo htmlspecialchars($post['created_at']); ?></p>
                    </div>
                    <div class="board_content">
                        <textarea name="content" class="post_content"><?php echo htmlspecialchars($post['content']); ?></textarea>
                    </div>
                    <div class="post_button">
                        <button type="submit"><?php echo $mode === 'edit' ? '수정' : '작성'; ?></button>
                        <button type="button" onclick="history.back()">뒤로가기</button>
                    </div>
                </div>
            </form>
        </main>
        <script src="javascript_file/pagination.js"></script>
    </body>
</html>