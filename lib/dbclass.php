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
* - $groupby: Almacena el valor por el que agrupar en una select, string
* - $having: Almacena el valor del having para el select, string
*
* Avaliable functions
* - setFields(String): Añade un valor a el atributo fields
* - setTables(String): Añade un valor a el atributo tables
* - setCondition(String): Añade un valor a el atributo condition
* - setOrderby(String): Añade un valor a el atributo orderby
* - setLimit(String): Añade un valor a el atributo limit
* - setValues(String): Añade un valor a el atributo values
* - setGroupBy(String): Añade un valor al atributo groupby
* - setHaving(String): Añade un valor al atributo having
* - exeSelect(): Ejecuta una consulta select, los atributos fields y tables son obligatorios, 
*     condition, ordeby, grupby, having y limit son campos opcionales, 
*	  devuelve 0 en caso de error y en caso de exito un array
* - exeDelete(): Ejecuta un delete, los atributos tables y condition son obligatorios, 
*     devuelve 0 en caso de error y 1 en caso de exito
* - exeInsert(): Ejecuta un insert, los campos tables y values son obligatorios,
*     fields es un atributo opcional,
*     devuelve 0 en caso de error y 1 en caso de exito
* - exeUpdate(): Ejecuta un update en una tabla, tables, condition y fields son obligatorios,
*     devuelve 0 en caso de error y 1 en caso de exito
* - close(): Cierra la conexion con la base de datos.
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
  private $groupby;
  private $having;

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
	  $query = "SELECT ". $this->fields ." FROM ". $this->tables ." ";
	  
	  if(isset($this->condition)){
	    $query = $query."WHERE ". $this->condition ." ";
	  }
	  if(isset($this->orderby)){
	    $query = $query."ORDER BY ". $this->orderby ." ";
	  }
	  if(isset($this->groupby)){
	    $query = $query."HAVING ". $this->having ." ";
	  }
	  if(isset($this->groupby)){
	    $query = $query."GROUP BY ". $this->groupby ." ";
	  }
	  if(isset($this->limit)){
	    $query = $query."LIMIT ". $this->limit ."";
	  }
	  
	  if($query = mysql_query($query)) {
	    unset($this->tables);
		unset($this->condition);
		unset($this->fields);
		unset($this->limit);
		unset($this->orderby);
		unset($this->groupby);
		unset($this->having);
	    return $query;
	  } else {
	    unset($this->tables);
		unset($this->condition);
		unset($this->fields);
		unset($this->limit);
		unset($this->orderby);
		unset($this->groupby);
		unset($this->having);
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
  public function setGroupBy($n){
    $this->groupby = $n;
  }
  public function setHaving($n){
    $this->having = $n;
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