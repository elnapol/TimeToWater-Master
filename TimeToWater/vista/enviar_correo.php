<?php
	function recuperarDatos(){
		$destino = "timetowater@gmail.com";
		$nombre = "Enzo";
		$correo = "elnapol@gmail.com";
		$mensaje = "Tu planta  tiene problemas"; 

		$contenido = "Nombre: ". $nombre. "\nCorreo: ". $correo . "\n Mensaje: ". $mensaje;
		mail($destino,"Contacto", $contenido);
		header("Location:timetowater.napotex.cl/vista/mistomates.php");
	}
	?>