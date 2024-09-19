<!DOCTYPE html>
<html>
    <?php include 'page_general/board_head.php'; ?>
    <body class="community_body">
        <?php include 'page_general/board_header.php'; ?>
        <main class="board_container">
            <?php include 'page_general/board_sidebar.php'; ?>
            <div class="board">
                <div class="board_nav_box">
                    <div class="dropdown_search">
                        <select id="searchCriteria">
                            <option value="">-</option>
                            <option value="author">작성자</option>
                            <option value="title">제목</option>
                            <option value="content">내용</option>
                        </select>
                        <select id="searchBoard">
                            <option value="">게시판</option>
                            <option value="board">공지사항</option>
                            <option value="sayhi">가입인사</option>
                            <option value="community">자유수다글</option>
                            <option value="pet">반려동물자랑</option>
                        </select>
                        <div class="date_box">
                            <label for="created_start">시작일:</label>
                            <input type="date" id="created_start" name="created_start">
                            <label for="created_end">종료일:</label>
                            <input type="date" id="created_end" name="created_end">
                        </div>
                    </div>
                    <div class="search_box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchQuery" placeholder="Search">
                        <button class="search_button" onclick="performSearch()">Search</button>
                    </div>
                </div>

                <h2>
                    <?php include 'php_function/board/board_name.php'; ?>
                </h2>
                <form class="sort_box" method="get" action="board.php">
                    <select name="sort" onchange="this.form.submit()">
                        <option value="">정렬 기준</option>
                        <option value="created_at">작성일</option>
                        <option value="views">조회수</option>
                        <option value="title">제목</option>
                    </select>
                    <noscript><input type="submit" value="Submit"></noscript>
                </form>
                <form class="table_container" method="get" action="board.php">
                    <table class="board_table">
                        <tr>
                            <th>번호</th>
                            <th>제목</th>
                            <th>글쓴이</th>
                            <th>조회수</th>
                            <th>작성일</th>
                        </tr>
                        <tbody id="boardContent"></tbody>
                        <?php
                        // 검색 조건이 있는 경우 search_result.php의 내용을 포함
                        if (isset($_GET['criteria']) && isset($_GET['query'])) {
                            include 'php_function/board/search_result.php';
                        }else{
                            include 'php_function/board/load_post.php';
                        }
                        ?>
                    </table>
                </form>
                <div class="write_button">
                    <a href='writenew.php' id ="write_button1">글쓰기</a>
                </div>
                <div class="pagination" id="pagination"></div>
            </div>
        </main>
        <script src="javascript_file/search.js"></script>
        <script src="javascript_file/pagination.js"></script>
        <script src="javascript_file/checklogin.js"></script>
    </body>
</html>