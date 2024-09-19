document.getElementById('board_checkLogin').addEventListener('click', function() {
// AJAX 요청을 사용하여 PHP 파일 호출
var xhr = new XMLHttpRequest();
xhr.open('GET', 'php_function/logincheck.php', true);
xhr.onload = function() {
    if (xhr.status === 200) {
        var response = xhr.responseText;
        console.log('Response from server:', response); // 서버 응답 확인

        // 로그인 상태를 판별하기 위해 response 텍스트를 확인
        if (response.includes('로그아웃') && response.includes('마이페이지')) {
            window.location.href='updatepost.php';
        } else {
            alert('Login required to write post');
        }
    } else {
        alert('Error checking login status.' + xhr.status);
    }
};
xhr.send();
});
