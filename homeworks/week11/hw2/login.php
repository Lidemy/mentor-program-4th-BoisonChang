<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">

  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <nav class="navbar">
    <div class="wrapper navbar__wrapper">
      <div class="navbar__site-name">
        <a href='index.php'>松下 Blog</a>
      </div>
      <ul class="navbar__list">
        <div>
          <li><a href="#">文章列表</a></li>
          <li><a href="#">分類專區</a></li>
          <li><a href="#">關於我</a></li>
        </div>
        <div>
          <li><a href="index.php">首頁</a></li>
        </div>
      </ul>
    </div>
  </nav>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to 松下 blog</div>
    </div>
  </section>
  <div class="login-wrapper">
    <h2>Login</h2>

    <?php
      if(!empty($_GET['errCode'])) {
        $errCode = $_GET['errCode'];
        if($errCode == 1) {
          $msg = '資料不齊全';
        } else if($errCode == 2) {
          $msg = '帳號密碼不正確';
        }
        echo '<h3> ' . $msg  .  '</h3>';
      }


    ?>


    <form action="handle_login.php" method="POST">
      <div class="input__wrapper">
        <div class="input__label">USERNAME</div>
        <input class="input__field" type="text" name="username" />
      </div>
      
      <div class="input__wrapper">
        <div class="input__label">PASSWORD</div>
        <input class="input__field" type="password" name="password" />
      </div>

      <input type='submit' value="登入" />
    </form>
     
  </div>
</body>
</html>