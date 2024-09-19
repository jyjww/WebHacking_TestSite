<?php
$author = $_SESSION['username'];
$views = 0;
$created_at = date('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html lang="ko">
    <?php include 'page_general/board_head.php'; ?>
    <body class="community_body">
        <?php include 'page_general/board_header.php'; ?>
        <main class="board_container">
            <?php include 'page_general/board_sidebar.php'; ?>
            <form method="post" action="php_function/board/write.php">
                <div class="board">
                    <div class="board_about">
                        <h1><input type="text" name="title" placeholder="제목" value=""></h1>
                        <p>작성자</p>
                        <p class="db_info"><?php echo htmlspecialchars($author); ?></p>
                        <p>조회수</p>
                        <p class="db_info"><?php echo $views; ?></p>
                        <p>작성일</p>
                        <p class="db_info"><?php echo $created_at; ?></p>
                    </div>
                    <div class="board_content">
                        <textarea name="content" class="post_content"></textarea>
                    </div>
                    <div class="post_button">
                        <button type="submit">작성</button>
                        <button type="button" onclick="history.back()">뒤로가기</button>
                    </div>
                </div>
            </form>
        </main>
        <script src="javascript_file/pagination.js"></script>
    </body>
</html>