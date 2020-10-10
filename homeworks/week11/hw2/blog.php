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
          <?php if(!empty($_SESSION['username'])) { ?>
            <li><a href="admin.php">管理後台</a></li>
            <li><a href="index.php">回到首頁</a></li>
          <? } else { ?>
            <li><a href="index.php">回到首頁</a></li>
          <?php } ?>

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
    <div class="posts">
      <article class="post">
        <div class="post__header">
          <div><?php echo $title ?></div>
          <?php if(!empty($_SESSION['username'])) { ?>
            <div class="post__actions">
              <a class="post__action" href="edit.php?id=<?php echo $id ?>">編輯</a>
            </div>
          <?php } ?>
        </div>
        <div class="post__info">
          <?php echo $created_at ?>
        </div>
        <div class="post__content"><?php echo $content ?>
        </div>
      </article>
    </div>
  </div>
  <footer>Copyright © 2020 松下 Blog All Rights Reserved.</footer>
</body>
</html>