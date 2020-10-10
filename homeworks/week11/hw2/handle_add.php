<?php

  require_once('conn.php');
  require_once('utils.php');


  if (empty($_POST['title']) ||
      empty($_POST['content']) ||
      empty($_SESSION['username'])
    ) {
      header("Location: edit.php?errCode=1");
      die($conn->error);
  }

  $title = $_POST['title'];
  $content = $_POST['content'];
  $username = $_SESSION['username'];


  $sql = "INSERT INTO Boison_blog_contents(title, content, username) VALUES(?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $title, $content, $username);
  $result = $stmt->execute();

  if(!$result) {
    die($conn->error);
  }


  header('Location: index.php');



?>