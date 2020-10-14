<?php
	
	require_once('conn.php');
	header('Content-type:application/json;charset=utf-8');
	header('Access-Control-Allow-Origin: *');  




	$stmt = $conn->prepare("DELETE FROM Boison_todolists_todosave WHERE 1=1");
	$result = $stmt->execute();




	if (empty($_POST['todolists'])) {
		$json = array(
		  "ok" => false,
		  "message" => "Please input missing fields"
		);
		$response =json_encode($json);
		echo $response;
		die();
	}
 
	$i = 0;
	$todos = $_POST['todolists'];

	while($i < sizeof($todos)) {
	  $todoid = $todos[$i]['id'];
	  $status = $todos[$i]['status'];
	  $content = $todos[$i]['content'];
	  $isdeleted = $todos[$i]['isdeleted'];
	  $sql = "INSERT INTO Boison_todolists_todosave(todoid, status, content, isdeleted) values(?, ?, ?, ?)";
	  $stmt = $conn->prepare($sql);
      $stmt->bind_param('issi', $todoid, $status, $content, $isdeleted);
	  $result = $stmt->execute();
	  $i += 1;
	}



	$json = array(
	  "ok" => true,
	  "message" => "success!",
	  "todoRecord" => $todos,
	  "todoSaveornot" => 1
	);

    $response = json_encode($json);
    echo $response;


?>





