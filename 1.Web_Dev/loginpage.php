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
    </body>
</html>