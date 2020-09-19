<?php
	session_start();
	require_once('conn.php');


	if(
		empty($_POST['nickname']) || 
		empty($_POST['username']) ||
		empty($_POST['password']) 
	) {
		header('Location: register.php?errCode=1');
		die('資料不齊全');
	}


	$nickname = $_POST['nickname'];
	$username = $_POST['username'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$sql = "insert into Boison_board_users(nickname, username, password)
		 values(?, ?, ?)";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sss", $nickname, $username, $password);

	$result = $stmt->execute();

	if(!$result) {
		if(strpos($conn->error, "Duplicate entry") !== false){
			echo strpos($conn->error, "Duplicate entry");	
			header('Location: register.php?errCode=2');
			exit();
		} 
	}



	$stmt = $conn->prepare("INSERT INTO Boison_board_roles(username) VALUES(?)");
	$stmt->bind_param("s", $username);
	$result = $stmt->execute();

	
	$_SESSION['username'] = $username;
	header("location: index.php");

?>

