
<!DOCTYPE html>
<html>
    <?php include 'page_general/head.php'; ?>
    <body class="mainpage_body">
        <?php include 'page_general/header.php'; ?>
        <div class="mainpage_box">
            <h1 id="welcome_text">Welcome to yyz_code</h1>
            <p id="welcome_text2"><?php include 'php_function/session.php'; ?></p>
        </div>
        <div class="mainpage_button">
            <p id="login_text">이미 회원입니다</p>
            <?php include 'php_function/logincheck.php'; ?>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script defer src="javascript_file/menu.js"></script>
    </body>
</html>
