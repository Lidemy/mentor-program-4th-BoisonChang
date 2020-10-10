<?php

  require_once('conn.php');
  require_once('utils.php');


  if (empty($_SESSION['username']) ||
      empty($_GET['id'])
     ) {
      header("Location: admin.php");
      die($conn->error);
  }

  $username = $_SESSION['username'];
  $id = $_GET['id'];


  $sql = "UPDATE Boison_blog_contents SET is_deleted=1 WHERE id=? AND username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("is", $id, $username);
  $result = $stmt->execute();

  if(!$result) {
    die($conn->error);
  }


  header('Location: admin.php');



?>