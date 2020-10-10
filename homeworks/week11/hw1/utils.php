<?php
	session_start();
	require_once('conn.php');


	function generateToken() {
      $s = '';
      for($i = 1; $i <= 16; $i += 1) {
      	$s .= chr(rand(65, 90));
      }
      return $s;
	}


	function getUserFromUsername($username) {
		global $conn;
		$stmt = $conn->prepare(
			"SELECT U.id AS id, U.username AS username, U.nickname AS nickname, U.password AS password, U.created_at AS created_at, R.roleid AS roleid FROM Boison_board_roles as R Left JOIN Boison_board_users AS U ON R.username = U.username WHERE U.username=?" 
		    );
		$stmt->bind_param('s', $username);
        $result = $stmt->execute();
		$result = $stmt->get_result();
        $row = $result->fetch_assoc();
		return $row; // username , id , nickname
	}

	function escape($str) {
		return htmlspecialchars($str, ENT_QUOTES); 
	}


	function displayrolestatus($roleid) {
		switch ($roleid) {
			case 0:
				echo '一般使用者';
				break;
			case 1:
				echo '管理員';
				break;
			case 2:
				echo '遭停權使用者';
				break;
			default:
				echo '未知使用者';
				break;
		}


	}




?>

