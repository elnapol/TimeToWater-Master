<?php
	class conexion{	
		function recuperarDatos(){
			$user="napo";
			$pass="qweasdzxc123napo";
			$server="localhost";
			$db="napo";


			$con=mysql_connect($server,$user,$pass)or die("Error al conectar a la base de datos".mysql_error());
			mysql_select_db($db,$con) or die ("no se encontro la base de datos");
			/*$query = "SELECT * FROM timetowater WHERE id IN('1')";
			$resultado = mysql_query($query);

			while ($fila = mysql_fetch_array($resultado)){
						echo "$fila[temp] <br>";
						echo "$fila[hum] <br>";
						echo "$fila[humti] <br>";
					}*/
			return $con;

		}
		function mandarDatos($temp,$hum,$humti){
			$user="napo";
			$pass="qweasdzxc123napo";
			$server="localhost";
			$db="napo";
			$con=mysql_connect($server,$user,$pass)or die("Error al conectar a la base de datos".mysql_error());
			mysql_select_db($db,$con) or die ("no se encontro la base de datos");
			mysql_query("UPDATE `timetowater` SET `temp`='$temp' ,`hum`='$hum' ,`humti`='$humti' WHERE id = 1");
			//mysql_query("UPDATE `timetowater` SET `temp`='$temp' ,`hum`='$hum' ,`humti`='$humti' WHERE id = 1");
		}
	}
?>