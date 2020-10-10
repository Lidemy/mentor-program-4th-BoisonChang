<?php
	require_once('conn.php');
	require_once('utils.php');

/*
	$status = explode("_",$_POST['status']);
    $status_roleid = $status[0];
    $status_username = $status[1];
*/


    $num = 0;
	while(!empty($_POST['status' . intval($num) ])){
		$status = explode("_",$_POST['status' . intval($num)]);
  		$roleid = $status[0];
  		$username = $status[1];
  		echo $roleid . " & " . $username;


        
		$sql = "UPDATE Boison_board_roles set roleid=? where username=?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('is', $roleid, $username);
		$result = $stmt->execute();
		
		if(!$result) {
			die($conn->error);
		}
		$num+=1;
	}

	header("location: edit_role.php")

// <a href="index.php">go back</a>
?>

