<?php

  require_once('conn.php');
  require_once('utils.php');


  if (empty($_POST['title']) ||
      empty($_POST['content']) ||
      empty($_SESSION['username']) ||
      empty($_GET['id'])
     ) {
      header("Location: edit.php?errCode=1");
      die($conn->error);
  }

  $title = $_POST['title'];
  $content = $_POST['content'];
  $username = $_SESSION['username'];
  $id = $_GET['id'];


  $sql = "UPDATE Boison_blog_contents SET title=?, content=? WHERE id=? AND username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssis", $title, $content, $id, $username);
  $result = $stmt->execute();

  if(!$result) {
    die($conn->error);
  }


  header('Location: index.php');



?>