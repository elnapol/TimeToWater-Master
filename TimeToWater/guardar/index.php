<?php   
    //Crea un archivo de texto para guardar los datos que envía el ESP8266
    if (!file_exists("miTemp&Hum.txt")){
        // si no existe el archivo, lo creamos
        file_put_contents("miTemp&Hum.txt", "0.0\r\n0.0");
    }
    
    // Si se recibe Datos con el Método GET, los procesamos
    if (isset($_GET['Temp']) && isset($_GET['Hum'])){
        $var3 = $_GET['Temp'];
        $var4 = $_GET['Hum'];
        $var5 = $_GET['HumTi'];
        $fileContent = $var3 . "\r\n" . $var4. "\r\n" . $var5;
        $fileSave = file_put_contents("miTemp&Hum.txt", $fileContent);
    }
   
    // Leemos los datos del archivo para guardarlos en variables
    $fileStr = file_get_contents("miTemp&Hum.txt");
    $pos1 = strpos($fileStr, "\r\n");
    $var1 = substr($fileStr, 0, $pos1);
    $var2 = substr($fileStr, $pos1 + 1,6); // de la pos1 +1 hasta el final
    $var6 = substr($fileStr, $pos1 + 7); // de la pos1 +1 hasta el final
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="15">
    <title>SERVIDOR PHP</title>
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
                <h2 class="text-center">HumedadTi en Num </h2>
                <div id="displayHumedadTi"></div>
            </div>
        
        </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="js/sevenSeg.js"></script>

    <script>
        let tempVal = <?php echo $var1; ?>;
        let humVal = <?php echo $var2; ?>;
        let humTiVal = <?php echo $var6; ?>;

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
            value: humTiVal + 0.01,
            colorOff: "#332200",
            colorOn: "orange",
            slant:0
        });
    </script>
</body>
</html>
