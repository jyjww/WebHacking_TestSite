<!Doctype HTML>
<html lang="ko">
  <?php include 'page_general/head.php'; ?>
  <body class="mainpage_body">
    <header>
        <?php include 'page_general/header.php'; ?>
        <?php 
        ob_start();
        include 'php_function/mypagefunction.php';
        $content = ob_get_clean();
        ?>
    </header>
    <form method="post" action="php_function/mypagefunction.php">
      <div class="input_form">
        <h2>My Page</h2>
        <div class="mypage_input">
          <label for="name">User Name</label><br>
          <input type="text" name="name" placeholder="Username" value="<?php echo htmlspecialchars($username) ?>">
        </div>
        <div class="mypage_input">
          <label for="pass">Password</label><br>
          <input type="text" name="pass1" placeholder="********" oninput="maskPassword(this)">
        </div>
        <div class="mypage_input">
          <label for="pass2">Change Password</label><br>
          <input type="text" name="pass2" placeholder="New Password" oninput="maskPassword(this)">
          <button type="button" onclick="checkPassword()" class="mypage_button_s">Check Password</button>
        </div>
        <div class="mypage_info">
          <label for="info">Info (200자)</label><br>
          <textarea name="info" type="info" placeholder="Tell us about yourself" maxlength="200" onkeyup="autoResize(this)"><?php echo htmlspecialchars($info) ?></textarea>
          </textarea>
        </div>
        <div class="mypage_input">
          <button type="submit" name="mypage_submit"class="mypage_button">Submit</button>
        </div>
      </div>
    </form>
    <script>
        function autoResize(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        }
        function checkPassword() {
            var pass1 = document.querySelector('input[name="pass1"]').value;
            var pass2 = document.querySelector('input[name="pass2"]').value;
            if (pass1 === pass2) {
                alert('Passwords match.');
            } else {
                alert('Passwords do not match.');
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="javascript_file/menu.js"></script>
  </body>
  
</html>
