<?php
    require_once('conn.php');
    require_once('utils.php');

    if(empty($_POST['nickname']) ||
       empty($_POST['password']) || 
       empty($_POST['username']) ) {
         header('Location: register.php?errCode=1');
         die();
    }

    $username = $_POST['username'];
    $nickname = $_POST['nickname'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO Boison_board_users(nickname, username, password) value(?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $nickname, $username, $password);
    $result = $stmt->execute();

    if(!$result) {
      if(strpos($conn->error, "Duplicate entry") !== false) {
        echo strpos($conn->error, "Duplicate entry");
        header('Location: register.php?errCode=2');
      }
      die($conn->error);
    }
    $_SESSION['username'] = $username;
    header('Location: index.php')
?>