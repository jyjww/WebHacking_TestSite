<?php include 'php_function/board/viewpost.php'; ?>

<!DOCTYPE html>
<html>
    <?php include 'page_general/board_head.php'; ?>
    <body class="community_body">
        <?php include 'page_general/board_header.php'; ?>
        <main class="board_container">
            <?php include 'page_general/board_sidebar.php'; ?>
                <div class="board">
                    <div class="board_about">
                        <h1><?php echo htmlspecialchars($post['title']); ?></h1>
                        <p>작성자</p>
                        <p class="db_info"><?php echo htmlspecialchars($post['author']); ?></p>
                        <p>조회수</p>
                        <p class="db_info" id="viewCount"><?php echo htmlspecialchars($post['views']); ?></p>
                        <p>작성일</p>
                        <p class="db_info"><?php echo htmlspecialchars($post['created_at']); ?></p>
                    </div>
                    <div class="board_content">
                        <textarea name="content" class="post_content" readonly><?php echo nl2br(htmlspecialchars(trim($post['content']))); ?></textarea>
                    </div>
                    <div class="post_button">
                        <?php if (canEditPost($post['author'], $session_username)) : ?>
                            <form method="post" action="updatepost.php?id=<?php echo $post['idx_board']; ?>">
                                <button>수정</button>
                            </form>
                        <?php endif; ?>
                        <a href="board.php?board=<?php echo htmlspecialchars($post['board']); ?>">
                            <button type="button">뒤로가기</button>
                        </a>
                    </div>
                </div>
        </main>
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                fetch('php_function/board/viewcount.php?idx_board=<?php echo $post['idx_board']; ?>')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('viewCount').innerText = data;
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>
        <script src="javascript_file/pagination.js"></script>
    </body>
</html>
