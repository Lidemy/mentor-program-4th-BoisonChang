<?php
	
	require_once('conn.php');
	header('Content-type:application/json;charset=utf-8');
	header('Access-Control-Allow-Origin: *');  



	if (empty($_GET['todoSaveornot'])) {
		$json = array(
		  "ok" => false,
		  "message" => "Please input missing fields"
		);
		$response =json_encode($json);
		echo $response;
		die();
	}



	$sql = "SELECT todoid, status, content, isdeleted FROM Boison_todolists_todosave ORDER BY id ASC";
	$stmt = $conn->prepare($sql);  
	$result = $stmt->execute();
	$result = $stmt->get_result();
	$todoRecord = array();
	while($row = $result->fetch_assoc()) {
		array_push($todoRecord, array(
			"todoid" => $row['todoid'],
			"status" => $row['status'],
			"content" => $row['content'],
			"isdeleted" => $row['isdeleted']
		    )
	    );
	}

	$json = array(
	  "ok" => true,
	  "message" => "success!",
	  "todoRecord" => $todoRecord,
	  "todoSaveornot" => 1
	);

    $response = json_encode($json);
    echo $response;


?>

