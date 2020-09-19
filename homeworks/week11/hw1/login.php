
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>留言板</title>
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
  
</head>

<body>
	<header class="warning">
		<strong>此為練習用之網站，不考慮資安之設計，註冊時請勿輸入真實的帳號密碼</strong>
	</header>
	<main class="board">
		<a class="board__btn" href="index.php">回留言板</a>
		<a class="board__btn" href="register.php">註冊</a>
		<h1 class="board__title">登入</h1>
		<?php
		  if(!empty($_GET['errCode'])){
		  	$code = $_GET['errCode'];
		  	$msg = 'Error';
		  	if($code === '1') {
		  	  $msg = '錯誤：資料不齊全';
		  	} else if ($code === '2') {
		  	  $msg = '帳號或是密碼輸入錯誤';
		  	} 
		  	echo '<h2 class="error"> ' . $msg  .  '</h2>';
		  }

		?>

		<form class="board__new-comment-form" method="POST" action="handle_login.php">

			<div class="board__nickname">
				<span>帳號：</span>
				<input type="text" name="username"/>
			</div>
			<div class="board__nickname">
				<span>密碼：</span>
				<input type="password" name="password"/>
			</div>

			<input class="board__submit-btn" type="submit" name="">

		</form>



	</main>

</body>
</html>