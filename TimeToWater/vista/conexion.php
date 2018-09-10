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
		
	}
?>