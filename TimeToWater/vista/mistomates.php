<?php   
        include("conexion_vista.php");
        $con = new conexion();

        $getDatos=$con->recuperarDatos();
       
        $temp = $getDatos[1];
        $hum = $getDatos[2];
        $humti = $getDatos[3];
        $estado = $getDatos[4];

        $getDatos_Cotas=$con->recuperarDatosMiPlanta();
        $calor = $getDatos_Cotas[1];
        $frio = $getDatos_Cotas[2];
        $mojado = $getDatos_Cotas[3];
        $seco = $getDatos_Cotas[4];

        include("comparacion.php");
       // $comp = new comparacion();

        
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
            <!-- logica humedad -->
            <?php
            list($bandera_hum, $bandera_hum_text) = banderaHumti($humti,$mojado, $seco);
            list($bandera_temp, $bandera_temp_text) =  banderaTemp($temp, $frio, $calor);
            ?>


            <!-- Display Temperatura -->
            <div class="col-sm-6">
                <h2 class="text-center">Temperatura en °C  <?php echo $frio." < ".$temp." > ".$calor; ?> </h2>
                <div id="displayTemperatura"></div>
            </div>
            <!-- Display Humedad -->
            <div class="col-sm-6">
                <h2 class="text-center">Humedad en %</h2>
                <div id="displayHumedad"></div>
            </div>
            <div class="col-sm-6">
                <h2 class="text-center"><strong>Humedad Tierra</strong> <?php echo $seco." < ".$humti." > ".$mojado; ?> </h2>
<?php
                humedadInformacion($humti);

?>

               <!--  <div id="displayHumedadTi"></div> -->
            </div>
            <div class="col-sm-6">
                <p><h1 id="Estado"></h1></p>
                <button id="cambiar" onclick="cambiarEstado()"> ¡Cambiar! </button>
            </div>
            
            <?php 
            if($humti<$seco&&$humti>$mojado&& $temp<$calor&&$temp>$frio){ 
                $con->regarAutoMiPlanta("off");

                ?>   <!--  Buen estado -->
                <div class="alert alert-success">
                    <img src="../Feliz.png" class="rounded-circle" alt="Cinque Terre">
                    <strong>Estoy Bien!</strong> <?php echo $bandera_hum_text." Y ".$bandera_temp_text ?>
                </div>

            <?php    

            }elseif($humti>=$seco || $humti<=$mojado || $temp>=$calor || $temp<=$frio){ ?> 
                
                          <!-- DEMACIADO SECO -->  
                <div class="alert alert-danger">
                    <img src="../triste.png" class="rounded-circle" alt="Cinque Terre">
                    <strong>Estoy Mal!</strong> <?php 
                    if($bandera_hum == 1 || $bandera_hum == 2){
                        echo $bandera_hum_text." ";

                    }
                   if($bandera_temp == 1 || $bandera_temp == 2){
                        echo $bandera_temp_text;
                    }   ?>
                </div>


         <?php   } 
                if($humti<=$mojado+100){
                    $con->regarAutoMiPlanta("off");
                }
                if($bandera_hum==2){
                    $con->regarAutoMiPlanta("on");
                }
                if($humti>=$mojado+100 && $temp>=$calor){
                    $con->regarAutoMiPlanta("on");
                }
         ?>
             



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
