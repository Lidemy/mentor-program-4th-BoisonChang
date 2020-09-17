<?php
	require_once('conn.php');
	require_once('utils.php');

	if(
		empty($_POST['content'])
	) {
		header('Location: index.php?errCode=1');
		die('資料不齊全');
	}


	$username = $_SESSION['username'];
	$content = $_POST['content'];

	$sql = "insert into Boison_board_comments(username, content)
		 values(?, ?)";
	//$sql = "insert into users(username) values('" . $username . "')";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ss', $username, $content);

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

