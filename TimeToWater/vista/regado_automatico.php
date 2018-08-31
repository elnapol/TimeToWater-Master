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

?>
<?php 
        function Riegoo_automarico(){
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
        }
         ?>