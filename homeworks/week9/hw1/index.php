<?php
	require_once('conn.php');
	require_once('utils.php');

	$result = $conn->query("SELECT * FROM Boison_board_comments ORDER BY id DESC");
	if(!$result) {
		die('Error' . $conn->error);
	}
	$username = NULL;
	if(!empty($_SESSION['username'])){
		$username = $_SESSION['username'];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>留言板</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>此留言板為作業展示，請勿在此留下您平常真正使用的帳號密碼</h1>
	<div class="board">
	  <?php
	    if($username){
	  ?>
	  <div class="board__title">
	    <a class="board__btn" href="logout.php">登出</a>
		  </div>
	  <?php } else { ?>
		<div class="board__title">
		  <a class="board__btn" href="register.php">註冊</a>
		  <a class="board__btn" href="login.php">登入</a>
		</div>
	  <?php } ?>
	  <?php
        if(!empty($_GET['errCode'])) {
          $code = $_GET['errCode'];
          $msg = 'Error';
          if($_GET['errCode'] === '1') {
            $msg = '資料不齊全';
          }
            echo '<h2 class="error">錯誤：' . $msg . '</h2>';
          }
      ?>
		<h2>Comments</h2>
	  <?php
		if($username){
	  ?>
		<form class="board__new-comment" method="POST" action="handle_add_comment.php">
    	  <textarea name="content" rows="5"></textarea>
			<input class="board__btn-submit" type="submit" >
		</form>
	  <?php } else { ?>
		<h2>請登入方可發布留言</h2>
	  <?php } ?>
		<section class="board__line"></section>
	  <?php
		while($row = $result->fetch_assoc()) {
	  ?>
	    <div class="comment">
		<div class="comment__avatar"></div>
		<div class="comment__body">
		  <div class="comment__author"><?php echo escape($row['nickname'])?></div>
			<span class="comment__time"><?php echo escape($row['created_at'])?></span>
			<div class="comment__content"><?php echo escape($row['content'])?></div>
		  </div>
		</div>
	  <?php } ?>
	</div>
</body>
</html>