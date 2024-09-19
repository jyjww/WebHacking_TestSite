<?php include 'php_function/mypagefunction.php';?>
<!Doctype HTML>
<html lang="ko">
  <?php include 'page_general/head.php'; ?>
  <body class="mainpage_body">
    <header>
        <?php include 'page_general/header.php'; ?>
    </header>
    <form method="post" action="php_function/mypagefunction.php">
      <div class="input_form">
        <h2>My Page</h2>
        <div class="mypage_input">
          <label for="name">User Name</label><br>
          <input type="text" name="name" placeholder="Username" value="<?php echo htmlspecialchars($username) ?>">
        </div>
        <div class="mypage_input">
          <label for="pass_current">Current password</label><br>
          <input type="password" id="pass_current" name="pass_current" placeholder="Current password" autocomplete="off">
        </div>
        <div class="mypage_input">
          <label for="pass1">New password</label><br>
          <input type="password" id="pass1" name="pass1" placeholder="New password" autocomplete="off">
        </div>
        <div class="mypage_input">
          <label for="pass2">New password check</label><br>
          <input type="password" id="pass2" name="pass2" placeholder="New password check">
          <button type="button" onclick="checkPassword()" class="mypage_button_s">Check Password</button>
        </div>
        <div class="mypage_info">
          <label for="info">Info (200자)</label><br>
          <textarea name="info" type="info" placeholder="Tell us about yourself" maxlength="200" onkeyup="autoResize(this)"><?php echo htmlspecialchars($info) ?></textarea>
        </div>
        <div class="mypage_input">
          <button type="submit" name="mypage_submit" class="mypage_button">Submit</button>
        </div>
      </div>
    </form>
    <script defer src="javascript_file/checkpass.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="javascript_file/menu.js"></script>
  </body>
</html>
