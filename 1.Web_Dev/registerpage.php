<?php
session_start();

// Check if the page is reloaded or the client moves to another page -> doesn't work. Try later.
if ($_SERVER['PHP_SELF'] != '/registerpage.php') {
    // Remove or refresh the session ID
    session_regenerate_id();

    // Destroy the session
    session_destroy();
}

if (!isset($_GET['verified']) && !isset($_SESSION['verified'])) {
  // 세션 변수 삭제
  unset($_SESSION['name']);
  unset($_SESSION['username']);
  unset($_SESSION['pass1']);
  unset($_SESSION['pass2']);
  unset($_SESSION['info']);
  unset($_SESSION['verified']);
}
?>
<!DOCTYPE html>
<html>
    <?php include 'page_general/head.php'; ?>
    <body class="mainpage_body" request method="POST">
        <?php include 'page_general/header.php'; ?>
        <div class="input_form">
            <h2>Register</h2>
            <form method="post" action="php_function/register.php">
              <div class="mypage_input">
                  <label for="name">Name</label><br>
                  <input type="text" name="name" placeholder="Name" value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name'], ENT_QUOTES) : ''; ?>" required>
              </div>
              <div class="mypage_input">
                <label for="name">User Name</label><br>
                <input type="text" name="username" placeholder="Username" required value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username'], ENT_QUOTES) : ''; ?>">
              </div>
              <div class="mypage_input">
                <label for="pass">Password</label><br>
                <input type="text" name="pass1" placeholder="********" required value="<?php echo isset($_SESSION['pass1']) ? htmlspecialchars($_SESSION['pass1'], ENT_QUOTES) : ''; ?>">
              </div>
              <div class="mypage_input">
                <label for="pass2">Check Password</label><br>
                <input type="text" name="pass2" placeholder="Password Check" required value="<?php echo isset($_SESSION['pass2']) ? htmlspecialchars($_SESSION['pass2'], ENT_QUOTES) : ''; ?>">
              </div>
              <div class="mypage_input">
                <!--<button type="submit" name="verify"class="mypage_button_xs">아이디 확인</button>-->
                <button type="submit" name="verify"class="mypage_button_s">중복확인</button>
              </div>
              <div class="mypage_info">
                <label for="info">Info (200자)</label><br>
                <textarea type="info" name="info" placeholder="Tell us about yourself" maxlength="200" onkeyup="autoResize(this)"></textarea>
                </textarea>
              </div>
              <div class="mypage_input">
                <button type="submit" name="submit_form" class="mypage_button">Submit</button>
              </div>
            </div>
        </form>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script defer src="javascript_file/menu.js"></script>
    </body>
</html>