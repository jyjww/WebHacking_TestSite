<!DOCTYPE html>
<html>
    <?php include 'page_general/head.php'; ?>
    <body class="mainpage_body">
        <?php include 'page_general/header.php'; ?>
        <div class="input_form" request method="POST">
            <h2>Login</h2>
            <form method="post" action="php_function/login.php">
                <div class="input_form_box">
                    <div class="input_box">
                        <i class="fas fa-user" id="login_icon"></i>
                        <input type="text" name="username" placeholder="ID" class="input_id">
                    </div>
                    <div class="input_box">
                        <i class="fas fa-lock" id="login_icon"></i>
                        <input type="text" name="hidePass" placeholder="Password" class="input_id" oninput="maskPassword(this)">
                        <input type="hidden" name="pass1" id="realPass">
                    </div>
                </div>
                <button type="submit" name="login" class="input_box">로그인</button>
            </form>
            <div class="register_box">
                <p id="register_text">아직 회원이 아니신가요?</p>
                <button onclick="location.href='register.html'" class="register_button">회원가입</button>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script defer src="javascript_file/menu.js"></script>
        <script>
            // 실제 비밀번호 값을 저장하는 전역 변수
            var actualPassword = '';

            function maskPassword(input) {
                console.log("maskPassword called");

                var realPasswordInput = document.getElementById("realPass");

                // 입력된 키를 추출
                var inputChar = input.value[input.value.length - 1];

                // Backspace 처리
                if (input.value.length < actualPassword.length) {
                    actualPassword = actualPassword.slice(0, -1);
                } else {
                    actualPassword += inputChar;
                }
                
                console.log("Actual password: ", actualPassword);

                // 실제 비밀번호 값을 숨겨진 필드에 저장
                realPasswordInput.value = actualPassword;
                console.log("realPass hidden field value: ", realPasswordInput.value);

                // 입력된 비밀번호를 마스킹하여 화면에 표시
                var maskedPassword = actualPassword.replace(/./g, "*");
                console.log("Masked password: ", maskedPassword);

                // 마스킹된 값을 입력 필드에 설정
                input.value = maskedPassword;
                
                // 커서 위치를 유지
                var cursorPosition = actualPassword.length;
                input.setSelectionRange(cursorPosition, cursorPosition);
                console.log("Cursor position: ", cursorPosition);
            }

        </script>
    </body>
</html>