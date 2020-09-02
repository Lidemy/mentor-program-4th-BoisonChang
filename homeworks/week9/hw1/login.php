<?php
  require_once('conn.php');
  require_once('utils.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>留言板登入頁面</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>此留言板為作業展示，請勿在此留下您平常真正使用的帳號密碼</h1>
  <div class="board">
    <div class="board__title">
      <a class="board__btn" href="index.php">回到首頁</a>
      <a class="board__btn" href="register.php">註冊</a>
    </div>
    <h2>留言板登入</h2>
    <?php
      if(!empty($_GET['errCode'])) {
        $code = $_GET['errCode'];
        $msg = 'Error';
        if($_GET['errCode'] === '1') {
          $msg = '資料不齊全';
        } else if ($_GET['errCode'] === '2') {
          $msg = '帳號密碼錯誤';
        }
          echo '<h2 class="error">錯誤：' . $msg . '</h2>';
        }
     ?>
    <form class="board__new-comment" method="POST" action="handle_login.php">           
      <div class="board__nickname">
        <span>帳號：</span>
        <input type="text" name="username" />
      </div>
      <div class="board__nickname">
        <span>密碼：</span>
        <input type="password" name="password" />
      </div>
      <input class="board__btn-submit" type="submit" >
    </form>
  </div>
</body>
</html>