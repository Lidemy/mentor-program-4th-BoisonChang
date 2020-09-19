<?php
  require_once('utils.php');
  require_once('conn.php');

  session_destroy();
  header('Location: index.php');

?>