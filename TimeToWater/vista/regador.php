<?php   
    include("conexion_vista.php");
    $con = new conexion();
    $estado = $_GET['estado'];
    $user="napo";
    $pass="qweasdzxc123napo";
    $server="localhost";
    $db="napo";
    $con=mysql_connect($server,$user,$pass)or die("Error al conectar a la base de datos".mysql_error());
    mysql_select_db($db,$con) or die ("no se encontro la base de datos");
    mysql_query("UPDATE `timetowater` SET `regador`='$estado' WHERE id = 1");
?>
