<?php
	
	require_once('conn.php');

	if (
	  empty($_POST['content']) ||
	  empty($_POST['nickname']) ||
	  empty($_POST['site_key'])
	) {
		$json = array(
		  "ok" => false,
		  "message" => "Please input missing fields"
		);
		$response =json_encode($json);
		echo $response;
		die();
	}


	$nickname = $_POST['nickname'];
	$content = $_POST['content'];
	$site_key = $_POST['site_key'];




	$sql = "INSERT INTO Boison_board_api_discussions(site_key, nickname, content) values(?, ?, ?)";
	$stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $site_key, $nickname, $content);
	$result = $stmt->execute();


	if(!$result) {
	  $json = array(
	    "ok" => false,
		"meaasge" => $conn->error
	  );		
      $response = json_encode($json);
      echo $response;
      die();
	}



	$json = array(
	  "ok" => true,
      "message" => "success!"
	);	


    $response = json_encode($json);
    echo $response;

?>



