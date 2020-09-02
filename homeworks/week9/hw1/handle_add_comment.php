<?php
    require_once('conn.php');
    require_once('utils.php');

    if(empty($_POST['content'])) {
      header('Location: index.php?errCode=1');
      die();
    }

    echo $_SESSION['username'];
    $user = getUserFromUsername($_SESSION['username']);
    $nickname = $user['nickname'];
    $content = escape($_POST['content']);
    $sql = "INSERT INTO Boison_board_comments(content, nickname) value(?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $content, $nickname);
    $result = $stmt->execute();

    if(!$result) {
      die($conn->error);
    }
    header('Location: index.php')
?>
