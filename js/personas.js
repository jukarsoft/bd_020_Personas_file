//VARIABLES
var arrayRespuesta= Array();
var notas='';
var valor=null;


//detectar la pulsación del boton enviar
//activar un listener
window.onload=function(){	
	document.getElementById('enviar').addEventListener('click', enviarFormulario);
	document.getElementById('texto').value="";
}

function enviarFormulario() {
	alert ('enviarFormulario');
	document.getElementById('nif').classList.remove('error');
	document.getElementById('nombre').classList.remove('error');
	document.getElementById('apellidos').classList.remove('error');
	document.getElementById('texto').value="";
	
	var nif = document.getElementById('nif').value;
	var nombre = document.getElementById('nombre').value;
	var apellidos = document.getElementById('apellidos').value;
	var direccion = document.getElementById('direccion').value;
	var telefono = document.getElementById('telefono').value;
	var email = document.getElementById('email').value;
	//validar formulario
	if (nif.trim()=='' || nif.length<9) {
		document.getElementById('nif').classList.add('error');
	}
	if (nombre.trim()=='') {
		document.getElementById('nombre').classList.add('error');
	}
	if (apellidos.trim()=='') {
		document.getElementById('apellidos').classList.add('error');
	}
	
	if (nombre.trim()=='' || apellidos.trim()=='' || nif.trim()=='') {
		alert ('nif, nombre, y apellidos, son datos obligatorios');
		document.getElementById('texto').value="nif, nombre, y apellidos, son datos obligatorios";
		return;
	}
	if (nif.length<9) {
		alert ('formato del nif no correcto');
		document.getElementById('texto').value="formato del nif no correcto";
		return;
	}
	valor=validarNIF(nif);
	if (!valor) {
		alert ('nif no válido');
		document.getElementById('texto').value="nif no válido";
		return;
	}
	//envio al servidor 
	$.ajax({
			url:'bd_020_altaPersona.php', 
			type: 'post',
			data: {'nif':nif,'nombre':nombre,'apellidos':apellidos,'direccion':direccion,'telefono':telefono,'email':email},
			//beforeSend() function opcional 
			beforeSend: function() {
				//acciones a realizar mientras no se recibe la respuesta
				//var reloj = "<img src='reloj_arena.gif'>";
				//document.getElementById('texto').innerHTML=reloj;
			},
			success: function(respuesta) {
				//respuesta del servidor
				//document.getElementById('mensaje').innerText=respuesta;
				alert ('success');
				alert (respuesta);
				var arrayRespuesta=JSON.parse(respuesta);
				if (arrayRespuesta.codigo=='00') {
					alert ('codigo respuesta ok, se ha dado de alta la persona');
					notas = arrayRespuesta.codigo + ' ' + arrayRespuesta.mensaje;
				} else {notas = arrayRespuesta.codigo + ' ' + arrayRespuesta.mensaje;}
			},
			error: function(respuesta) {
				//respuesta del servidor en caso de error
				alert ('error');
				var arrayRespuesta=JSON.parse(respuesta);
				if (arrayRespuesta!='00') {
					alert ('codigo respuesta KO, se han producido errores en el programa de php');
					notas = arrayRespuesta.codigo + ' ' + arrayRespuesta.mensaje;

				} else {
					alert ('????????????????????????????????????');
				}
			},
			complete: function() {
				//acciones a realizar cuando finaliza la petición
				notas+='<br>';
				notas+='fin proceso - complete function'
				document.getElementById('texto').value=notas;
				document.getElementById('nif').value="";
				document.getElementById('nombre').value="";
				document.getElementById('apellidos').value="";
				document.getElementById('direccion').value="";
				document.getElementById('telefono').value="";
				document.getElementById('email').value="";
				alert ('complete');
			}
		})
}

function validarNIF(nif) {
var lockup = 'TRWAGMYFPDXBNJZSQVHLCKE';
	var valueNif=nif.substr(0,nif.length-1);
	var letra=nif.substr(nif.length-1,1).toUpperCase();
 
	if(lockup.charAt(valueNif % 23)==letra)
		return true;
	return false;
}
		