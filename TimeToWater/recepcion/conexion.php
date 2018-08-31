<?php
	class conexion{	
		function insertarDatos($temp,$hum,$humti){
			$user="napo";
			$pass="qweasdzxc123napo";
			$server="localhost";
			$db="napo";
			$con=mysql_connect($server,$user,$pass)or die("Error al conectar a la base de datos".mysql_error());
			mysql_select_db($db,$con) or die ("no se encontro la base de datos");
			mysql_query("UPDATE `timetowater` SET `temp`='$temp' ,`hum`='$hum' ,`humti`='$humti' WHERE id = 1");
		}
		function cambiarRegador(){
			$user="napo";
			$pass="qweasdzxc123napo";
			$server="localhost";
			$db="napo";
			$con=mysql_connect($server,$user,$pass)or die("Error al conectar a la base de datos".mysql_error());
			mysql_select_db($db,$con) or die ("no se encontro la base de datos");
			$estado = mysql_query("SELECT regador from `timetowater` where id=1 ");
			$estado = mysql_fetch_row($estado);
			return $estado;
		}
	}
?>