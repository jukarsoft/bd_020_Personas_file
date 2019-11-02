<?php 
	//host, usuario, password, base de datos
	$bd = mysqli_connect('localhost', 'root', '', 'personas')
	or die("conexion con base de datos fallida");
	mysqli_set_charset($bd, "utf8");

	// Check connection
	//if (mysqli_connect_errno())  {
  	//	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	//}
	
 ?>