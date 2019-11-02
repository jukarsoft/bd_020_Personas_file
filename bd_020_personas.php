<?php 






 ?>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta lang="es">
		<meta name="description" content="Resumen del contenido"> 
		<meta name="description" content="Free Web tutorials">
  		<meta name="keywords" content="HTML,CSS,XML,JavaScript">
  		<meta name="author" content="Juan Carlos">
  		<!-- diseño Responsive Design -->
  		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
  		<base href=”???????????”> 
		<title>formulario personas</title>
		<!-- link para poner un Icono de la aplicación -->
		<link rel="shortcut icon" href="img/DWA.ico" type="image/x-icon">
		<link rel="icon" href="img/DWA.ico" type="image/x-icon">
		<!--  link para cargar fuentes-->
		<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
		<!-- link  a hoja de estilos CSS-->
		<link rel="stylesheet" type="text/css" href="css/page.css">
		<!-- libreria JQuery-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<!-- link  para código de javascript-->
		<script type="text/javascript" src="js/personas.js"></script>
		<!-- código de javascript-->
		<script type="text/javascript"></script> 
	</head>
	<body>
		<main>
			<header><h1>Formulario Personas</h1></header>
			<nav></nav>
			<section>
				<form>
					<br><br>
					<label>NIF</label>
					<input type="text" id="nif" placeholder="nif"/><br>
					<label>Nombre</label>
					<input type="text" id="nombre" placeholder="nombre"/><br>
					<label>Apellidos</label>
					<input type="text" id="apellidos" placeholder="apellidos"/><br>
					<label>Direccion</label>
					<input type="text" id="direccion" placeholder="direccion"/><br>
					<label>Teléfono</label>
					<input type="text" id="telefono" placeholder="telefono"/><br>
					<label>Email</label>
					<input type="text" id="email" placeholder="email"/><br><br>
					<input type="button" id="enviar" value="enviar formulario" /><br><br>
					<label><strong>Resultado</strong></label><br>
					<textarea name="texto" id="texto" cols="70" rows="5"></textarea>
			</form>
				<article></article>
			</section>
			<aside></aside>
			<footer></footer>
		</main>
	</body>	
</html>