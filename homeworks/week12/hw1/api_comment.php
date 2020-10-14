<?php

	require_once('conn.php');
	header('Content-type:application/json;charset=utf-8');
	header('Access-Control-Allow-Origin: *');

	if(
	  empty($_GET['site_key'])
	) {
		$json = array(
		  "ok" => false,
		  "message" => "Please send site_key in url"
		);
		$response =json_encode($json);
		echo $response;
		die();
	} 

	$expect_num = intval($_GET['comment_num_display']);
	$site_key = $_GET['site_key'];
	$sql = "SELECT nickname, content, created_at FROM Boison_board_api_discussions WHERE site_key=? ORDER BY id DESC LIMIT ?";
	$stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $site_key, $expect_num);
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

	$real_commentNum = 0;
	$result = $stmt->get_result();
	$discussions = array();
	while($row = $result->fetch_assoc()) {
		array_push($discussions, array(
			"nickname" => $row['nickname'],
			"content" => $row['content'],
			"created_at" => $row['created_at']
		    )
	    );
	    $real_commentNum += 1;
	}

	if ($expect_num > $real_commentNum){
	  $json = array(
	    "ok" => true,
        "discussions" => $discussions,
        "moreornot" => true,
	  );
	} else {
	  $json = array(
	    "ok" => true,
        "discussions" => $discussions,
        "moreornot" => false,
	  );
	}

    $response = json_encode($json);
    echo $response;
?>



