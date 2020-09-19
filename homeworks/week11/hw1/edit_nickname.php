<?php
	require_once('conn.php');
	require_once('utils.php');

	if(
		empty($_POST['nickname'])
	) {
		header('Location: index.php?errCode=1');
		die('資料不齊全');
	}


	$username = $_SESSION['username'];
	$nickname = $_POST['nickname'];
	$id = $_POST['id'];
	$sql = "UPDATE Boison_board_users set nickname=? where username=?";
	//$sql = "insert into users(username) values('" . $username . "')";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ss', $nickname, $username);

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

