<?php 
	header('Content-Type: text/html; charset=utf-8');
	$contador=0;
	//cookie - contador peticiones
	if (isset($_COOKIE['bd_020_altaPersonas'])) {
		$contador= $_COOKIE['bd_020_altaPersonas'];
	} else {
		//crear cookie
		setcookie('bd_020_altaPersonas', $contador, time()+3600*24*365);
	}

	//abrir un fichero para guardar los registros que se graben en bbd secuencialmente
	$f1=fopen('personas.txt', 'a+');	


	//conexion bbdd Personas
	require 'conexionPersonas.php';

	//variables
	$codigo='00';
	$mensaje="";
	$respuesta=null;
	$nif=$nombre=$apellidos=$direccion=$telefono=$email=null;

	//validación datos del formulario
	//obtención de las variables recibidas
	$nif=$_POST['nif'];
	$nombre=$_POST['nombre'];
	$apellidos=$_POST['apellidos'];
	$direccion=$_POST['direccion'];
	$telefono=$_POST['telefono'];
	$email=$_POST['email'];
	$apellidos = addslashes($apellidos);

	try {
		if (trim($nif)=='') {
			throw new Exception('<<NIF, es un dato obligatorio>>',10);
		};
		if (trim($nombre)=='') {
			throw new Exception('<<Nombre, es un dato obligatorio>>',10);
		};
		if (trim($apellidos)=='') {
			throw new Exception('<<Apellidos, es un dato obligatorio>>',10);
		};
		
		//ALTA -- en bbdd personas tabla personas
			
		//construir la sentencia SQL BBDD personas tabla personas
		$sql = "INSERT INTO personas VALUES (NULL, '$nif', '$nombre', '$apellidos', '$direccion', '$telefono', '$email')";
		//ejecutar la sentencia SQL
		if (!mysqli_query($bd, $sql)) {
			if (mysqli_errno($bd) == 1062) {
				throw new Exception('<<persona ya existe en la tabla de personas>>',1062);
				//clave duplicada (nif)
			} else {die(mysqli_error($bd));}
		} else {
			$mensaje="Registro alta efectuado en tabla personas"."<br>";
			//recuperar el id que el sistema gestor le ha asignado a la persona
			$idPersona=mysqli_insert_id($bd);
			//montar array con la información del código de estado y datos creados
			//convertir array a json
			$respuesta=array('codigo'=> $codigo, 'mensaje' => $mensaje, 'nif'=> $nif, 'nombre'=> $nombre, 'apellidos'=> $apellidos, 'direccion'=> $direccion, 'telefono'=> $telefono, 'email'=> $email, 'idpersona'=> $idPersona);	
			//preparación / grabación fichero secuencial
			$fichero=array('nif'=> $nif, 'nombre'=> $nombre, 'apellidos'=> $apellidos, 'direccion'=> $direccion, 'telefono'=> $telefono, 'email'=> $email, 'idpersona'=> $idPersona);
			$registro=implode(';', $fichero);
			$f=fputs($f1,$registro."\r"."\n");
			if (!$f) {
				throw new Exception('<<grabacion fichero texto erronea>>', 40);
			}

			$mensaje=json_encode($respuesta);
			//actualizar cookie
			//actualizar la variable de sesion		
			setcookie('bd_020_altaPersonas',++$contador, time()+3600*24*365);
			//enviar respuesta echo
			echo $mensaje;
		}
	} catch (Exception $error){
		//captura de excepciones $error es un objeto de la clase Exception
		$mensaje=$error->getMessage(); //mensaje de error
		$codigo=$error->getCode();//nos muestra el código de error
		//$linea=$error->getLine();//nos muestra en que linea de código se ha producido el error
		$respuesta=array('codigo'=>$codigo, 'mensaje'=> $mensaje);
		$mensaje=json_encode($respuesta);
		echo $mensaje;
	};


?>