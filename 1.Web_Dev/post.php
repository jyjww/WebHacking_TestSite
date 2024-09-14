
<?php include 'php_function/board/viewpost.php'; ?>
<!DOCTYPE html>
<html>
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
                <div class="board">
                    <div class="board_about">
                        <h1><?php echo htmlspecialchars($post['title']); ?>
                        </h1>
                        <p>작성자</p>
                        <p class="db_info"><?php echo htmlspecialchars($post['author']); ?></p>
                        <p>조회수</p>
                        <p class="db_info" id="viewCount""><?php echo htmlspecialchars($post['views']); ?></p>
                        <p>작성일</p>
                        <p class="db_info"><?php echo htmlspecialchars($post['created_at']); ?></p>
                    </div>
                    <div class="board_content">
                        <textarea name="content" class="post_content" readonly><?php echo nl2br(htmlspecialchars(trim($post['content']))); ?></textarea>
                    </div>
                    <div class="post_button">
                        <form method="post" action="updatepost.php">
                            <input type="hidden" name="title" value="<?php echo htmlspecialchars($post['title']); ?>">
                            <input type="hidden" name="author" value="<?php echo htmlspecialchars($post['author']); ?>">
                            <input type="hidden" name="views" value="<?php echo htmlspecialchars($post['views']); ?>">
                            <input type="hidden" name="created_at" value="<?php echo htmlspecialchars($post['created_at']); ?>">
                            <input type="hidden" name="idx_board" value="<?php echo $post['idx_board']; ?>">
                            <input type="hidden" name="board" value="<?php echo htmlspecialchars($post['board']); ?>">
                            <input type="hidden" name="content" value="<?php echo ($post['content']); ?>">
                            <button type="submit"><?php echo isset($post) ? '수정' : '작성'; ?></button>
                        </form>
                        <button type="submit" formaction="php_function/board/write.php">
                            <a href="board.php?board=<?php echo nl2br(htmlspecialchars($post['board'])); ?>">뒤로가기</a>
                        </button>
                    </div>
                </div>
        </main>
        <script>
            // DOMContentLoaded 이벤트가 발생했을 때 fetch를 통해 viewcount.php를 호출하여 조회수를 증가시킵니다
            document.addEventListener('DOMContentLoaded', (event) => {
                fetch('php_function/board/viewcount.php?idx_board=<?php echo $post['idx_board']; ?>')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('viewCount').innerText = data; // 조회수를 업데이트합니다
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>
        <script src="javascript_file/pagination.js"></script>
    </body>
</html>