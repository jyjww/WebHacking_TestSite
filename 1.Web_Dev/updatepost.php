<?php
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $views = $_POST['views'] ?? 0;
    $created_at = $_POST['created_at'] ?? date('Y-m-d H:i:s');
    $idx_board = $_POST['idx_board'] ?? '';
    $board = $_POST['board'] ?? '';
    $content = $_POST['content'] ?? '';

    var_dump($title, $author, $views, $created_at, $idx_board, $board, $content);
?>
<?php include 'php_function/board/viewpost.php'; ?>
<!DOCTYPE html>
<html lang="ko">
    <?php include 'page_general/board_head.php'; ?>
    <body class="community_body">
        <?php include 'page_general/board_header.php'; ?>
        <main class="board_container">
            <div class="sidebar">
                <ul>
                    <li><a href="board.php?board=board">공지사항</a></li>
                    <li><a href="board.php?board=sayhi">가입인사</a></li>
                    <li><a href="board.php?board=community">자유수다글</a></li>
                    <li><a href="board.php?board=pet">반려동물자랑</a></li>
                </ul>
            </div>
            <form method="post" action="php_function/board/write.php">
                <div class="board">
                    <div class="board_about">
                        <h1><input type="text" name="title" placeholder="제목" value="<?php echo htmlspecialchars($title); ?>">
                        </h1>
                        <p>작성자</p>
                        <p class="db_info"><?php echo htmlspecialchars($author); ?></p>
                        <p>조회수</p>
                        <p class="db_info"><?php echo htmlspecialchars($views); ?></p>
                        <p>작성일</p>
                        <p class="db_info"><?php echo htmlspecialchars($created_at); ?></p>
                        <input type="hidden" name="title" value="<?php echo htmlspecialchars($post['title']); ?>">
                        <input type="hidden" name="author" value="<?php echo htmlspecialchars($post['author']); ?>">
                        <input type="hidden" name="views" value="<?php echo htmlspecialchars($post['views']); ?>">
                        <input type="hidden" name="created_at" value="<?php echo htmlspecialchars($post['created_at']); ?>">
                        <input type="hidden" name="idx_board" value="<?php echo htmlspecialchars($post['idx_board']); ?>">
                        <input type="hidden" name="board" value="<?php echo htmlspecialchars($post['board']); ?>">
                        <input type="hidden" name="content" value="<?php echo htmlspecialchars($post['content']); ?>">
                    </div>
                    <div class="board_content">
                        <textarea name="content" class="post_content"><?php echo htmlspecialchars($content); ?></textarea>
                    </div>
                    <div class="post_button">
                        <button type="submit" formaction="php_function/board/write.php">제출</button>
                        <button>
                            <a href="board.php?board=<?php echo htmlspecialchars($board); ?>">뒤로가기</a>
                        </button>
                    </div>
                </div>
            </form>
        </main>
        <script src="javascript_file/pagination.js"></script>
    </body>
</html>