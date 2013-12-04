<?php

class dbColection {

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

    include_once('./config.php');
    $this->host = HOST;
	$this->user = USER;
	$this->pass = PASS;
	$this->db = DB;
	$this->con = mysql_connect($this->host, $this->user, $this->pass);
	$this->open();
  }

  //Ejecuta una sentencia SELECT basandose en los campos dados a los atributos
  public function exeSelect(){
    /*
	* Aqui ira el codigo de toda la sentencia insert
	*/
	
	if(isset($this->tables) && isset($this->fields)){
	  $query = "SELECT ". $this-fields ." FROM ". $this->tables ."";
	  
	  if(isset($this->condition) && isset($this->orderby) && isset($this->limit) ){
	    $query = "SELECT ". $this-fields ." FROM ". $this->tables . " WHERE ". $this->condition ." ORDER BY ". $this->orderby ." LIMIT ". $this->limit ."";
	  }
	  
	  if(isset($this->limit) && isset($this->orderby) ){
	    $query = "SELECT ". $this-fields ." FROM ". $this->tables ." ORDER BY ". $this->orderby ." LIMIT ". $this->limit ."";
	  }
	  
	  if(isset($this->limit) && isset($this->condition)){
	    $query = "SELECT ". $this-fields ." FROM ". $this->tables . " WHERE ". $this->condition ." LIMIT ". $this->limit ."";
	  }
	  
	  if(isset($this->condition) && isset($this->orderby) ){
	    $query = "SELECT ". $this-fields ." FROM ". $this->tables . " WHERE ". $this->condition ." ORDER BY ". $this->orderby ."";
	  }
	  
	  if(isset($this->condition)){
	    $query = "SELECT ". $this-fields ." FROM ". $this->tables ." WHERE ". $this->condition ."";
	  }
	  
	  if(isset($this->orderby)){
	    $query = "SELECT ". $this-fields ." FROM ". $this->tables ." ORDER BY ". $this->orderby ."";
	  }
	  
	  if(isset($this->limit)){
	    $query = "SELECT ". $this-fields ." FROM ". $this->tables ." LIMIT ". $this->limit ."";
	  }

	  if(mysql_query($query)) {
	    unset($this->tables);
		unset($this->condition);
		unset($this->fields);
		unset($this->limit);
		unset($this->orderby);
	    return 1;
	  } else {
	    unset($this->tables);
		unset($this->condition);
		unset($this->fields);
		unset($this->limit);
		unset($this->orderby);
	    return 0;
	  }
	  
	} else {
	  return 0;
	}
	
	if(mysql_query($query)) {
	    unset($this->tables);
		unset($this->condition);
	    return 1;
	  } else {
	    unset($this->tables);
		unset($this->condition);
	    return 0;
	  }
  }

  //Ejecuta una sentencia delete
  public function exeDelete(){
    if(isset($this->tables) && isset($this->condition)){
	  $query = "DELETE FROM " . $this->tables . " WHERE " . $this->condition;
	  if(mysql_query($query)) {
	    unset($this->tables);
		unset($this->condition);
	    return 1;
	  } else {
	    unset($this->tables);
		unset($this->condition);
	    return 0;
	  }
	} else {
      return 0;
	}
  }
  
  //Ejecuta una sentencia insert con los campos que se le han proporcionado
  public function exeInsert(){

	if(isset($this->tables) && isset($this->values)){
	  if(isset($this->fields)){
	    $query = "INSERT INTO " . $this->tables ." ". $this->fields ." VALUES " . $this->values ."";
	  } else {
	    $query = "INSERT INTO " . $this->tables ." VALUES " . $this->values ."";
	  }

	  if(mysql_query($query)) {
	    unset($this->tables);
		unset($this->values);
		unset($this->fields);
	    return 1;
	  } else {
	    unset($this->tables);
		unset($this->values);
		unset($this->fields);
	    return 0;
	  }
	} else {
	  return 0;
	}
  }
  
  public function exeUpdate(){
    if(isset($this->tables) && isset($this->condition) && isset($this->fields)){
	  $query = "UPDATE " . $this->tables . " SET ". $this->fields ." WHERE " . $this->condition ."";
	  if(mysql_query($query)) {
	    unset($this->tables);
		unset($this->condition);
		unset($this->fields);
	    return 1;
	  } else {
	    unset($this->tables);
		unset($this->condition);
		unset($this->fields);
	    return 0;
	  }
	} else {
      return 0;
	}
  }
  
  //Las siguientes funciones establecen los atributos para las consultas.
  public function setFields($this->fields){}
  public function setTables($this->tables){}
  public function setCondition($this->condition){}
  public function setOrderby($this->orderby){}
  public function setLimit($this->limit){}
  public function setValues($this->values){}
  
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
}

?>