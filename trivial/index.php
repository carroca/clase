<html>
  <head>
    <script src="js/jquery.js" />
	<script src="js/jqueryui.js" />
  </head>
  <body>
  hola
  <?php
    echo "entra";
    include_once 'database.php';
    $db = new Database;
    $result = $db->exeQuery("SELECT * FROM trivial");
	$pregunta = $result[rand(0,count($result))];
	$genero = array(
	  '0' => 'Geografia',
	  '1' => 'Espectaculos',
	  '2' => 'Hitoria',
	  '3' => 'Arte y literatura',
	  '4' => 'Ciencias y naturaleza',
	  '5' => 'Deporte',
	);
	echo "<h3>" . $pregunta['pregunta'] . "</h3>";
	echo "<p>" . $pregunta['cat'] . "</p>";
	echo "<form>";
	echo "<input type='radio' value='1'>" . $pregunta['r1'] . "<br>";
	echo "<input type='radio' value='2'>" . $pregunta['r2'] . "<br>";
	echo "<input type='radio' value='3'>" . $pregunta['r3'] . "<br>";
	echo "<input type='radio' value='4'>" . $pregunta['r4'] . "<br>";
    echo "</form>"; 
	
  ?>
  adios
  </body>
</html>