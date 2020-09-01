<?php
    require_once('conn.php');
    require_once('utils.php');

    if(empty($_POST['username']) || empty($_POST['password'])) {
      header('Location: login.php?errCode=1');
      die('資料不齊全');
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM Boison_board_users WHERE username=?";
    $stmt = $conn->prepare($sql); // prepare statement 
    $stmt->bind_param("s", $username); // bind parameter
    $result = $stmt->execute(); // execute
    $data = $stmt->get_result(); // 
    $row = $data->fetch_assoc();

    if(!$result) {
      die('Error' . $conn->error);
    }

    if(password_verify($password, $row['password'])) {
      $_SESSION['username'] = $username;
      header('Location: index.php');  
    } else {
      header('Location: login.php?errCode=2');
    }
?>