<?php
    include_once 'database.php';
    $db = new Database;
	$cat = floor(rand(0,5));
    $result = $db->exeQuery("SELECT * FROM trivial WHERE Tema = '$cat'");
	$pregunta = $result[floor(rand(1,count($result)))-1];
    echo json_encode($result);
?>