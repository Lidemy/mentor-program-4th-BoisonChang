<?php

  require_once('conn.php');
  require_once('utils.php');

  $id = $_GET['id'];
  $title = NULL;
  $content = NULL;
  $username = NULL;
  $created_at = NULL;


  if(!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  } 


  if(!empty($id)) {
    $contents = getContentFromId($id);
    $title = escape($contents['title']);
    $content = escape($contents['content']);
    $created_at = escape($contents['created_at']); 
  } 



?>

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
          <li><a href="list.php">文章列表</a></li>
          <li><a href="#">分類專區</a></li>
          <li><a href="#">關於我</a></li>
        </div>
        <div>
            <li><a href="admin.php">管理後台</a></li>
            <li><a href="index.php">回到首頁</a></li>
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
  <div class="container-wrapper">
    <div class="container">
      <div class="edit-post">
        <form action="handle_edit.php?id=<?php echo $id ?>" method="POST">
          <div class="edit-post__title">
            發表文章：
          </div>
          <div class="edit-post__input-wrapper">
            <textarea  rows="1" class="edit-post__content" name="title"><?php echo $title;?></textarea>
          </div>
          <div class="edit-post__input-wrapper">
            <textarea rows="20" class="edit-post__content" name="content"><?php echo $content;?></textarea>
          </div>
          <div class="edit-post__btn-wrapper">
              <input class="edit-post__btn" type='submit' value="送出" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 松下's Blog All Rights Reserved.</footer>
</body>
</html>