<?php
    session_start();
    require_once('conn.php');
    
    function getUserFromUsername($username) {
      global $conn;
      $sql = "SELECT * FROM Boison_board_users WHERE username =?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $username);
      $result = $stmt->execute();
      $data = $stmt->get_result();
      $row = $data->fetch_assoc();
      if(!$result) {
        die($conn->error);
      }
      if($data->num_rows === 0) {
        header('Location: login.php?errCode=2');  
        exit();   
      }
      return $row;
    }
    function escape($str) {
      return htmlspecialchars($str, ENT_QUOTES);
    }
?>