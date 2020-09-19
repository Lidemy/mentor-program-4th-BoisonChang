<?php
	require_once('conn.php');
	require_once('utils.php');


	if(
		empty($_POST['username']) ||
		empty($_POST['password']) 
	) {
		header('Location: login.php?errCode=1');
		die('資料不齊全');
	}



	$username = $_POST['username'];
	$password = $_POST['password'];
	$roleid = NULL;

	$sql = "SELECT * FROM Boison_board_users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
	$result = $stmt->execute();

	if(!$result) {
		die($conn->error);
	}

	$result = $stmt->get_result();

	if($result->num_rows === 0) {
		header('Location: login.php?errCode=2');	
		exit();		
	}

	$row = $result->fetch_assoc();


	if(password_verify($password, $row['password']) ) {
      $_SESSION['username'] = $username;
		header('Location: index.php');
	} else {
		header('Location: login.php?errCode=2');	
	}

	//	跳轉的 header
	//header("location: index.php")

// <a href="index.php">go back</a>
?>

