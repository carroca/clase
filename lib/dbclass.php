<?php
/*
* @file Contiene una clase que permite interactuar con la base de datos 
*  realizando consultas, borrados, actualizaciones y añadir registros.
*
* Atributes:
* - $host: Almacena el host donde se aloja la base de datos, string
* - $user: Almacena el usuario de acceso a la base de datos, string
* - $pass: Almacena la contraseña del usuario de la base de datos, string
* - $db: Almacena el nombre de la base de datos, string
* - $conect: Contiene una funcion para realizar la conexion a la base de datos, string
* - $fields: Almacena los campos para las consultas o para los insert, string
* - $tables: Almacena las tablas con las que interactuar, string
* - $condition: Almacena las condiciones para la condicion where en el sql, string
* - $orderby: El orden a utilizar en una consulta, string
* - $limit: El limite de registros a obtener en una consulta, string
* - $values: Valores que se van a insertar en la base de datos en un insert, string
*
* Avaliable functions
* - setFields(String): Añade un valor a el atributo fields
* - setTables(String): Añade un valor a el atributo tables
* - setCondition(String): Añade un valor a el atributo condition
* - setOrderby(String): Añade un valor a el atributo orderby
* - setLimit(String): Añade un valor a el atributo limit
* - setValues(String): Añade un valor a el atributo values
* - exeSelect(): Ejecuta una consulta select, los atributos fields y tables son obligatorios, 
*     condition, ordeby y limit son campos opcionales, 
*	  devuelve 0 en caso de error y en caso de exito un array
* - exeDelete(): Ejecuta un delete, los atributos tables y condition son obligatorios, 
*     devuelve 0 en caso de error y 1 en caso de exito
* - exeInsert(): Ejecuta un insert, los campos tables y values son obligatorios,
*     fields es un atributo opcional,
*     devuelve 0 en caso de error y 1 en caso de exito
* - exeUpdate(): Ejecuta un update en una tabla, tables, condition y fields son obligatorios,
*     devuelve 0 en caso de error y 1 en caso de exito
*
*/

class dbColection {

  //Atributos para conectarse a la base de datos
  private $host;
  private $user;
  private $pass;
  private $db;
  private $conect;

  //Atributos para las sentencias sql
  private $fields;
  private $tables;
  private $condition;
  private $orderby;
  private $limit;
  private $values;

  /**
  * Implements __construct().
  */
  public function __construct() {

    include_once('./config.php');
    $this->host = HOST;
	$this->user = USER;
	$this->pass = PASS;
	$this->db = DB;
	$this->open();
  }

  /**
  * Implements exeSelect().
  */
  public function exeSelect(){

	if(isset($this->tables) && isset($this->fields)){
	  $query = "SELECT ". $this->fields ." FROM ". $this->tables ."";
	  
	  if(isset($this->condition)){
	    $query = "SELECT ". $this->fields ." FROM ". $this->tables ." WHERE ". $this->condition ."";
	  }
	  
	  if(isset($this->orderby)){
	    $query = "SELECT ". $this->fields ." FROM ". $this->tables ." ORDER BY ". $this->orderby ."";
	  }
	  
	  if(isset($this->limit)){
	    $query = "SELECT ". $this->fields ." FROM ". $this->tables ." LIMIT ". $this->limit ."";
	  }
	  
	  if(isset($this->limit) && isset($this->orderby) ){
	    $query = "SELECT ". $this->fields ." FROM ". $this->tables ." ORDER BY ". $this->orderby ." LIMIT ". $this->limit ."";
	  }
	  
	  if(isset($this->limit) && isset($this->condition)){
	    $query = "SELECT ". $this->fields ." FROM ". $this->tables . " WHERE ". $this->condition ." LIMIT ". $this->limit ."";
	  }
	  
	  if(isset($this->condition) && isset($this->orderby) ){
	    $query = "SELECT ". $this->fields ." FROM ". $this->tables . " WHERE ". $this->condition ." ORDER BY ". $this->orderby ."";
	  }
	  
	  if(isset($this->condition) && isset($this->orderby) && isset($this->limit) ){
	    $query = "SELECT ". $this->fields ." FROM ". $this->tables . " WHERE ". $this->condition ." ORDER BY ". $this->orderby ." LIMIT ". $this->limit ."";
	  }
	  
	  if($query = mysql_query($query)) {
	    unset($this->tables);
		unset($this->condition);
		unset($this->fields);
		unset($this->limit);
		unset($this->orderby);
	    return $query;
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
	
	
  }

  /**
  * Implements exeDelete().
  */
  public function exeDelete(){
    if(isset($this->tables) && isset($this->condition)){
	  $query = "DELETE FROM ". $this->tables ." WHERE " . $this->condition ."";
	  if(mysql_query($query)) {
	    
	    unset($this->tables);
		unset($this->condition);
	    return true;
	  } else {
	    unset($this->tables);
		unset($this->condition);
	    return false;
	  }
	} else {
      return false;
	}
  }
  
  /**
  * Implements exeInsert().
  */
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
  
  /**
  * Implements exeUpdate().
  */
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
  
  /**
  * Implements setFunctions().
  */
  public function setFields($n){
    $this->fields = $n;
  }
  public function setTables($n){
    $this->tables = $n;
  }
  public function setCondition($n){
    $this->condition = $n;
  }
  public function setOrderby($n){
    $this->orderby = $n;
  }
  public function setLimit($n){
    $this->limit = $n;
  }
  public function setValues($n){
    $this->values = $n;
  }

  //Crea la conexion con la base de datos
  private function open(){
    $this->conect = mysql_connect($this->host, $this->user, $this->pass);
    if(!$this->conect) {
      die('Could not connect: ' . mysql_error());
    }
    mysql_select_db($this->db, $this->conect);
  }

  //Cierra la conexion con la base de datos
  public function close(){
    mysql_close($this->conect);
  }
}

?>