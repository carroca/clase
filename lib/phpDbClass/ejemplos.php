<?php
  include_once('dbclass.php');
  
  $db = new dbColection;
  
  /**********************
  ****Consulta DELETE****
  **********************/
  
  /*$db->setTables("usuarios");
  $db->setCondition("usuario = 'ivan'");
  
  if($db->exeDelete()){
    echo "Delete realizado";
  } else {
    echo "Delete fallido";
  }*/
  
  /**********************
  ****Consulta INSERT****
  **********************/
  
  /*$db->setTables("usuarios");
  $db->setValues("(NULL, 'mikel', '123456', 'mikel', 'mikel', 'aadssda', '0', '0')");
  $db->setFields("(`id`, `usuario`, `clave`, `Nombre`, `Apellido`, `Correo`, `admin`, `baneado`)");
  
  if($db->exeInsert()){
    echo "Insert realizado";
  } else {
    echo "Insert Fallido";
  }*/
  
  /**********************
  ****Consulta UPDATE****
  **********************/
  
  /*$db->setTables("usuarios");
  $db->setCondition("usuario = 'mikel'");
  $db->setFields("nombre = 'Mikel2'");
  
  if($db->exeUpdate()){
    echo "Update realizado";
  } else {
    echo "Update Fallido";
  }*/
  
  /**********************
  ****Consulta SELECT****
  **********************/
  
  /*$db->setFields("*");
  $db->setTables("usuarios");
  $db->setCondition("usuario = 'mikel'");
  $db->setOrderBy("id desc");
  $db->setLimit("0,2");
  
  if($row = $db->exeSelect()) {
    echo "Se ejecuta la consulta";
    foreach($row AS $fila){
	  echo "<br>";
      echo $fila['id'];
	  echo "<br>";
	  echo $fila['Nombre'];
    }
  } else {
    echo "No se ejecuta la consulta";
  }*/

  $db->close();
?>