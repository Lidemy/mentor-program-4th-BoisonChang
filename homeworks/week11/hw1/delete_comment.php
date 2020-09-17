<?php
	require_once('conn.php');
	require_once('utils.php');

	if(
		empty($_GET['id'])
	) {
		header('Location: index.php?errCode=1');
		die('資料不齊全');
	}


	$username = $_SESSION['username'];
	$id = $_GET['id'];
	$content = $_POST['content'];


	$sql = "UPDATE Boison_board_comments SET is_deleted=1 where id=? AND username=?";
	//$sql = "insert into users(username) values('" . $username . "')";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('is', $id, $username);

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

