<?php
  session_start();
  require_once('conn.php');




  function getUserFromUsername($username) {
    global $conn;
    $stmt = $conn->prepare(
      "SELECT * FROM Boison_blog_users WHERE username=?" 
        );
    $stmt->bind_param('s', $username);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row; // username , id , nickname
  }



  function getContentFromId($id) {
    global $conn;
    $stmt = $conn->prepare(
      "SELECT * FROM Boison_blog_contents WHERE id=?" 
        );
    $stmt->bind_param('i', $id);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row; // username , id , nickname
  }




  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES); 
  }




?>