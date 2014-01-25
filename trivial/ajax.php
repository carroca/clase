<?php
  include_once 'database.php';
  $db = new Database;
  $result = $db->exeQuery("SELECT * FROM trivial");
  return json_encode($result);
?>