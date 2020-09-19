<?php
		session_start();
		session_destroy();
		header('Location: index.php');	

	//	跳轉的 header
//	header("location: index.php")

// <a href="index.php">go back</a>
?>

