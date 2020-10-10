<?php
	
	require_once('conn.php');
	require_once('utils.php');

	/*
		1. 從 cookie 讀取 PHPSESSID(token)
		2. 從檔案裡面讀取 session id 的內容
		3. 放到 $_SESSION

	*/



	$username = NULL;
	$users = NULL;
	$roleid = NULL;

	if(!empty($_SESSION['username']) ) {
		$username = $_SESSION['username'];
		$users = getUserFromUsername($_SESSION['username']);
		$roleid = $users['roleid'];
		$nickname = $users['nickname'];
	}

	$page = 1;
	if(!empty($_GET['page'])) {
		$page = intval($_GET['page']);
	} 
	$item_per_page = 5;
	$offset = ($page - 1) * $item_per_page;

	$sql = 'select C.id AS id, C.content AS content, C.created_at AS created_at, U.nickname AS nickname, U.username AS username from Boison_board_comments as C left join Boison_board_users as U on C.username = U.username WHERE C.is_deleted IS NULL order by C.id desc LIMIT ? OFFSET ?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $item_per_page, $offset);
    $result = $stmt->execute();	

	if(!$result) {
	  die("ERROR:" . $conn->error);
	}

	$result = $stmt->get_result();
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
		  <?php if(!$username) {?>
		  <a class="board__btn" href="register.php">註冊</a>
		  <a class="board__btn" href="login.php">登入</a>
	      <?php } else { ?>
	      <a class="board__btn" href="logout.php">登出</a>
	      
	      	<?php if($roleid != 2) {?>
	        	<a class="board__btn board__btn-nickname">修改暱稱</a>
	        <?php }  ?>	
	        <?php if($roleid == 1) {?>
	        	<a class="board__btn" href="edit_role.php">管理員模式</a>
	        <?php }  ?>	
	  	  <?php }  ?>


	    </div>
	      <?php if($username) {?>
		      <?php if($roleid == 2) {?>
		      	<h3> 抱歉 <span class="title__name-color"><?php  echo escape($username) . " a.k.a " . escape($nickname);?></span>，你已暫時被禁止留言，如有疑問請洽管理員。 </h3>
		      <?php } else { ?>


			  <div class="board__title-top">
				<div class="">
					Hello! 你好呀 <span class="title__name-color"><?php  echo escape($username) . " a.k.a " . escape($nickname);?></span>，請留下你的留言。
				
				  <form method="POST" action="edit_nickname.php" class="board__title-edit hide">
					  新的暱稱：<input type="text" name="nickname"/>
					  <div>
					 	<input class="board__submit-btn" type="submit" value="提交">
					  </div>
				  </form>
			  </div>
			</div>
			<h1 class="board__title">Comments</h1>
			<?php }  ?>

		<?php }  ?>

		

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


		<?php if($roleid !=2) { ?>
		  <?php if($username) { ?>  
			<form class="board__new-comment-form" method="POST" action="handle_add_comment.php">
				<textarea name="content" rows="5"></textarea>
				<input class="board__submit-btn" type="submit" value="送出留言">
			</form>
	        <?php } else { ?>
	      	<h3>請登入發布留言</h3>
          <?php }  ?>
	  	<?php }  ?>



		<div class="board_hr"></div>
		<section>

		<?php
			while($row = $result->fetch_assoc()){
		?>
			<div class="card">
				<div class="card__avatat"></div>
				<div class="card__body">
					<div class="card__info">
						<span class="card__author"><?php echo escape($row['nickname']);?>(@<?php echo escape($row['username']);?>)</span>
						<span class="card__time"><?php echo escape($row['created_at']); ?></span>
						<?php if($row['username'] === $username) { ?>
							<a href="update_comment.php?id=<?php echo $row['id'] ?>">編輯</a>
							<a href="delete_comment.php?id=<?php echo $row['id'] ?>">刪除</a>
						}
     					<?php } ?>
					</div>
					<p class="card__content"><?php echo escape($row['content']); ?></p>
				</div>
			</div>
		<?php } ?>

		</section>
		<div class="board_hr"></div>

		<?php
			 $stmt = $conn->prepare(
		     'SELECT count(id) AS count FROM Boison_board_comments WHERE is_deleted IS NULL'
		    );
        	$result = $stmt->execute();
			$result = $stmt->get_result();
			$row = $result->fetch_assoc();
			$count = $row['count'];
			$total_page = ceil($count / $item_per_page);
		?>


		<div class="page__info">
			<span>總共有 <?php echo $count ?> 筆留言 ｜ </span>
			<span>頁數 <?php echo $page ?> / <?php echo $total_page ?> </span>
		</div>
		<?php if ($count != 0) { ?> 
			<div class="paginator">
				<?php if($page != 1) {?>
				  <a href="index.php?page=1">首頁</a>
				  <a href="index.php?page=<?php echo $page-1 ?>">上一頁</a>
				<?php }?>
				<?php if($page != $total_page) {?>
	 			  <a href="index.php?page=<?php echo $page+1 ?>">下一頁</a>
	 			  <a href="index.php?page=<?php echo $total_page ?>">最後一頁</a>
				<?php }?>		
			</div>
	    <?php }?>

	</main>
	<script src="./index.js"></script>
</body>
</html>