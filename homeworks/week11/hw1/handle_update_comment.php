<?php
	require_once('conn.php');
	require_once('utils.php');

	if(
		empty($_POST['content'])
	) {
		header('Location: update_comment.php?errCode=1&id='. $_POST['id']);
		die('資料不齊全');
	}


	$username = $_SESSION['username'];
	$id = $_POST['id'];
	$content = $_POST['content'];


	$sql = "UPDATE Boison_board_comments set content=? where id=? AND username=?";
	//$sql = "insert into users(username) values('" . $username . "')";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('sis', $content, $id, $username);

	echo 'SQL' . $sql . "<br>";
	$result = $stmt->execute();
	
	if(!$result) {
		die($conn->error);
	}

	echo "新增成功";

	//	跳轉的 header
	header("location: index.php")

// <a href="index.php">go back</a>
?>

