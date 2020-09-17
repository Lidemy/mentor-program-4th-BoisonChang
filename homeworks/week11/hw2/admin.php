<?php

  require_once('conn.php');
  require_once('utils.php');

  $username = NULL;
  $users = NULL;

  if(!empty($_SESSION['username']) ) {
    $username = $_SESSION['username'];
    $users = getUserFromUsername($_SESSION['username']);
  }


  $page = 1;
  if(!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  } 
  $item_per_page = 10;
  $offset = ($page - 1) * $item_per_page;


  $stmt = $conn->prepare(
   'select C.id AS id, C.content AS content, C.created_at AS created_at,' .
   ' C.title AS title, U.username as username '.
   'from Boison_blog_contents as C ' .
   'left join Boison_blog_users as U on C.username = U.username '.
   'WHERE C.is_deleted IS NULL '.
   'order by C.id desc '.
   'LIMIT ? OFFSET ?' 
  );

  $stmt->bind_param('ii', $item_per_page, $offset);
  $result = $stmt->execute();

  if(!$result) {
    die("ERROR:" . $conn->error);
  }

  $result = $stmt->get_result();




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
            <li><a href="index.php">回到首頁</a></li>
          <? } else { ?>
            <li><a href="login.php">登入</a></li>
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
    <div class="container">
      <div class="admin-posts">

      <?php
        while($row = $result->fetch_assoc()){
          $title = escape($row['title']);
          $created_at = escape($row['created_at']);
          $id = escape($row['id']);
      ?>  
        <div class="admin-post">
          <div class="admin-post__title">
            <a href="blog.php?id=<?php echo $id ?>"><?php echo $title ?></a>
          </div>
          <div class="admin-post__info">
            <div class="admin-post__created-at">
              <?php echo $created_at ?>
            </div>
            <a class="admin-post__btn" href="edit.php?id=<?php echo $id ?>">
              編輯
            </a>
            <a class="admin-post__btn" href="handle_delete.php?id=<?php echo $id ?>">
              刪除
            </a>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
  </div>

  <?php
     $stmt = $conn->prepare(
       'SELECT count(id) AS count FROM Boison_blog_contents WHERE is_deleted IS NULL'
      );
    $result = $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];
    $total_page = ceil($count / $item_per_page);
  ?>

  <div class="page__info">
    <span>總共有 <?php echo $count ?> 篇內容 ｜ </span>
    <span>頁數 <?php echo $page ?> / <?php echo $total_page ?> </span>
  </div>

<?php if ($count != 0) { ?> 
  <div class="paginator">
    <?php if($page != 1) {?>
      <a href="admin.php?page=1">首頁</a>
      <a href="admin.php?page=<?php echo $page-1 ?>">上一頁</a>
    <?php }?>
    <?php if($page != $total_page) {?>
      <a href="admin.php?page=<?php echo $page+1 ?>">下一頁</a>
      <a href="admin.php?page=<?php echo $total_page ?>">最後一頁</a>
    <?php }?>   
  </div>
<?php }?>


  <footer>Copyright © 2020 松下 Blog All Rights Reserved.</footer>
</body>
</html>