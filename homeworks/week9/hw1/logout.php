<?php
  require_once('conn.php');
  require_once('utils.php');
  session_destroy();
  header('Location: index.php');
?>
