<?php   
	    // echo  "hola ,undas";
        include("conexion.php");
		$con = new conexion();
 
		$getDatos=$con->recuperarDatos();
       
        $temp = $getDatos[1];
        $hum = $getDatos[2];
        $humti = $getDatos[3];
        $estado = $getDatos[4];
        if($humti>800){
           $humComentario = "Nada humedo";
        }elseif($humti>600){
           $humComentario = "Poco humedo";
        }elseif($humti>300){
           $humComentario = "Humedo";
        }else $humComentario = "Muy humedo";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5">
    <title>TimeToWater</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
    <style>
        body{
            background-color: lightgray;
        }

        .frame{
            margin: 15px 0;
        }

        h1 {
            background-color: aquamarine;
            font-weight:bold;
        }
    </style>
<body class="container-fluid">
    <div class="row">
        <h1 class="text-center">TimeToWater</h1>
        <div class="frame">
            <!-- Display Temperatura -->
            <div class="col-sm-6">
                <h2 class="text-center">Temperatura en °C</h2>
                <div id="displayTemperatura"></div>
            </div>
            <!-- Display Humedad -->
            <div class="col-sm-6">
                <h2 class="text-center">Humedad en %</h2>
                <div id="displayHumedad"></div>
            </div>
            <div class="col-sm-6">
                <h2 class="text-center"><strong>Humedad Tierra</strong> </h2>

                <?php if($humti>800){?> 
                      <div class="alert alert-danger">
                        <h1 class="text-center"><strong>Nada humedo </strong> </h1> 
                        </div>

                    <?php}elseif($humti>600){?> 
                      <div class="alert alert-danger">
                        <h1 class="text-center"><strong>Poco humedo</strong> </h1> 
                        </div>
                    <?php}elseif($humti>300){?> 
                      <div class="alert alert-danger">
                        <h1 class="text-center"><strong>Humedo</strong> </h1> 
                        </div>
                   <?php}else{ ?> 
                     <div class="alert alert-danger">
                        <h1 class="text-center"><strong>Muy humedo</strong> </h1> 
                        </div>
                    <?php} ?>
               <!--  <div id="displayHumedadTi"></div> -->
            </div>
            <div class="col-sm-6">
                <p><h1 id="Estado"></h1></p>
                <button id="cambiar" onclick="cambiarEstado()"> ¡Cambiar! </button>
            </div>

        </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="js/sevenSeg.js"></script>
    <script>
        Estado.innerHTML = <?php echo "'".$estado."'";?>;
        
        function cambiarEstado() {
            $.get("estado.php", function(data){
                Estado.innerHTML = data;
                if(data == "off"){
                    $.get("regador.php",{estado:"on"})
                }else{
                    $.get("regador.php",{estado:"off"})
                }
                location.reload();
            }
            );
        }
    </script>
    <script>

        let tempVal = <?php echo $temp; ?>;
        let humVal = <?php  echo $hum; ?>;
        let humTiVal = <?php  echo $humti; ?>;

        $("#displayTemperatura").sevenSeg({ digits: 5, value: tempVal + 0.01});
        $("#displayHumedad").sevenSeg({
            digits: 5,
            value: humVal + 0.01,
            colorOff: "#003200",
            colorOn: "lime",
            slant:0
        });
        $("#displayHumedadTi").sevenSeg({
            digits: 5,
            value: humTiVal + 0.1,
            colorOff: "#332200",
            colorOn: "orange",
            slant:0
        });
    </script>
</body>
</html>
