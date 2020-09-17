<?php
	
	require_once('conn.php');
	require_once('utils.php');

	/*
		1. 從 cookie 讀取 PHPSESSID(token)
		2. 從檔案裡面讀取 session id 的內容
		3. 放到 $_SESSION

	*/

	

   $id = $_GET['id'];
   $username = NULL;
   $users = NULL;

	if(!empty($_SESSION['username'])) {
		$username = $_SESSION['username'];
		$users = getUserFromUsername($_SESSION['username']);
	}

   $stmt = $conn->prepare('SELECT * FROM Boison_board_comments WHERE id=?');

   $stmt->bind_param("i", $id);
   $result = $stmt->execute();
   if (!$result) {
     die('Error:' . $conn->error);
   }
   $result = $stmt->get_result();
   $row = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>留言板</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
	<header class="warning">
		<strong>此為練習用之網站，不考慮資安之設計，註冊時請勿輸入真實的帳號密碼</strong>
	</header>
	<main class="board">
		<div>
		  <a class="board__btn" href="index.php">回留言板</a>
	    </div>
	    <?php if($username) {?>
		<div class="board__title-top">
			<div class="">
				Hello! 你好呀 <span class="title__name-color"><?php  echo escape($users['username']) . " aka " . escape($users['nickname']);?></span>，要修改你的留言嗎？
			  <form method="POST" action="edit_nickname.php" class="board__title-edit hide">
				  新的暱稱：<input type="text" name="nickname"/>
				  <div>
				 	<input class="board__submit-btn" type="submit" value="提交">
				  </div>
			  </form>
		  </div>
		</div>
		<?php }  ?>
		<h1 class="board__title">編輯留言</h1>
		<?php
		  if(!empty($_GET['errCode'])){
		  	$code = $_GET['errCode'];
		  	$msg = 'Error';
		  	if($code === '1') {
		  	  $msg = '錯誤：資料不齊全';
		  	} 
		  	echo '<h2 class="error"> ' . $msg  .  '</h2>';
		  }
		?>
			<form class="board__new-comment-form" method="POST" action="handle_update_comment.php">
				<textarea name="content" rows="5"><?php echo $row['content'];  ?></textarea>
				<input type="hidden" name="id" value="<?php echo $row['id'] ?>"/>
				<input class="board__submit-btn" type="submit" value="修改留言"/>
			</form>		
	</main>
	<script src="./index.js"></script>
</body>
</html>