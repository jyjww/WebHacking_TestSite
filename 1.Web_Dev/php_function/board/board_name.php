<?php
    // 현재 게시판 이름 출력
    if (isset($_GET['board'])) {
        switch ($_GET['board']) {
            case 'board':
                echo '공지사항';
                break;
            case 'sayhi':
                echo '가입인사';
                break;
            case 'community':
                echo '자유수다글';
                break;
            case 'pet':
                echo '반려동물자랑';
                break;
            default:
                echo '전체 게시판';
                break;
        }
    } else {
        echo '전체 게시판';
    }
?>