<?php
	class conexion{	
		function recuperarDatos(){
			$user="napo";
			$pass="qweasdzxc123napo";
			$server="localhost";
			$db="napo";


			$con=mysql_connect($server,$user,$pass)or die("Error al conectar a la base de datos".mysql_error());
			mysql_select_db($db,$con) or die ("no se encontro la base de datos");
			$query = "SELECT * FROM timetowater WHERE id = '1'";
			$resultado = mysql_query($query);

		return mysql_fetch_row($resultado);

		}
			function recuperarDatosMiPlanta(){
			$user="napo";
			$pass="qweasdzxc123napo";
			$server="localhost";
			$db="napo";


			$con=mysql_connect($server,$user,$pass)or die("Error al conectar a la base de datos".mysql_error());
			mysql_select_db($db,$con) or die ("no se encontro la base de datos");
			$query = "SELECT * FROM miPlanta WHERE id = '1'";
			$resultado = mysql_query($query);

		return mysql_fetch_row($resultado);

		}
		function regarAutoMiPlanta($estado){
			$user="napo";
			$pass="qweasdzxc123napo";
			$server="localhost";
			$db="napo";

			$con=mysql_connect($server,$user,$pass)or die("Error al conectar a la base de datos".mysql_error());
			mysql_select_db($db,$con) or die ("no se encontro la base de datos");
			    mysql_query("UPDATE `timetowater` SET `regador`='$estado' WHERE id = 1");

		}
		function estadoCorreo($estado_correo){
			$user="napo";
			$pass="qweasdzxc123napo";
			$server="localhost";
			$db="napo";

			$con=mysql_connect($server,$user,$pass)or die("Error al conectar a la base de datos".mysql_error());
			mysql_select_db($db,$con) or die ("no se encontro la base de datos");
			    mysql_query("UPDATE `timetowater` SET `correo`='$estado_correo' WHERE id = 1");

		}
		
	}
?>