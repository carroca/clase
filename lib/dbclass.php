<?php

class dbConect {

  //Atributos para conectarse a la base de datos
  private $host;
  private $user;
  private $pass;
  private $db;
  private $con;
  
  //Atributos para las sentencias sql
  private $fields;
  private $tables;
  private $condition;
  private $orderby;
  private $limit;
  private $values;

  public function __construct() {

    include_once('config.php');
    $this->host = HOST;
	$this->user = USER;
	$this->pass = PASS;
	$this->db = DB;
	$this->con = mysql_connect($this->host, $this->user, $this->pass);
	$this->open();
	
  }
  
  //Crea la conexion con la base de datos
  private function open(){
    if (!$this->$con) {
      die('Could not connect: ' . mysql_error());
    }
    mysql_select_db($this->db, $this->con);
  }

  //Cierra la conexion con la base de datos
  public function close(){
    mysql_close($this->con);
  }
  
  //Ejecuta una sentencia SELECT basandose en los campos dados a los atributos
  public function exeSelect(){
    $query = "";
    return;
  }
  
  public function exeDelete(){
    $query = "";
    return;
  }
  
  public function exeInsert(){
    $query = "";
    return;
  }
  
  public function exeUpdate(){
    $query = "";
    return;
  }
}

?>