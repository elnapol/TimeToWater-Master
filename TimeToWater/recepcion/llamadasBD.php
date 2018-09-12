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
/*
    //https://time2water-2b8e6.firebaseio.com/
$data = '{"concepto":"Curso de PHP", "subroral":"200","ID":1}';
$url = "https://time2water-2b8e6.firebaseio.com/presupuestos.json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content_Type: text/plain'));

$response = curl_exec($ch);

if(curl_errno($ch)){
    echo 'Error:'.curl_errno($ch);
}else{
    echo "Ya se insertó";
}
curl_close($ch);
*/
?>
