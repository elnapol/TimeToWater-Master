<?php   
	    include("conexion.php");
		$con = new conexion();
    // Si se recibe Datos con el Método GET, los procesamos
   if (isset($_GET['T']) && isset($_GET['H']) && isset($_GET['H2'])){
        $temp = $_GET['T'];
        $hum = $_GET['H'];
        $humti = $_GET['H2'];
        $con->insertarDatos($temp,$hum,$humti);
    }
    $estado = $con->cambiarRegador();
    if($estado[0] == "off"){
        echo "Estado:0";
    }else{
        echo "Estado:1";
    }
?>
