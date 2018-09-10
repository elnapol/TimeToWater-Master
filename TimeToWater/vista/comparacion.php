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

        list($bandera_hum, $bandera_hum_text) = banderaHumti($humti,$mojado, $seco);
        list($bandera_temp, $bandera_temp_text) =  banderaTemp($temp, $frio, $calor);
            




        function banderaHumti($humti,$cota_baja_hum, $cota_alta_hum){

        //verificar humedad         
        //if (300<humedad<800)
            $hum = 3;
            $hum_text= "nada";
            if($humti<$cota_alta_hum&&$humti>$cota_baja_hum){
                        $bhum=0;
                        $hum_text="Buen Estado de humedad";
            } 
            elseif($humti>=$cota_alta_hum){
                        $hum=2;
                        $hum_text="Plante peligrosamente seca";
            }
            elseif($humti<=$cota_baja_hum){
                        $hum=1;
                        $hum_text="Planta peligrosamente humeda";
            }
            //echo $hum_text." ";
            return array($hum, $hum_text);
        }
        //if (15<=temperatura<=25)
        function banderaTemp($temp, $cota_baja_tem, $cota_alta_tem){
                  //verificar temperatura
            $tem = 3;
            $tem_text= "nada";
            if($temp<$cota_alta_tem && $temp>$cota_baja_tem){
                        $tem=0;
                        $tem_text="Buena Temperatura";
            } 
            elseif($temp>=$cota_alta_tem){
                        $tem=2;
                        $tem_text="Planta acalorada";
            }
            elseif($temp<=$cota_baja_tem){
                        $tem=1;
                        $tem_text="Planta con frio";
            }
            //echo $tem_text." ";
            return array($tem, $tem_text);
        }
?>
        <?php
        // Humedad de tierra se transforma en una frace
        function humedadInformacion($humti){ 
                 if($humti>=800){        ?> 
                      <div class="alert alert-danger">
                        <h1 class="text-center"><strong>Nada humedo </strong> </h1> 
                        </div>

              <?php }elseif($humti>=600){       ?> 
                      <div class="alert alert-danger">
                        <h1 class="text-center"><strong>Poco humedo</strong> </h1> 
                        </div>
        <?php       }elseif($humti>=300){       ?> 
                      <div class="alert alert-danger">
                        <h1 class="text-center"><strong>Humedo</strong> </h1> 
                        </div>
         <?php      }else{      ?> 
                     <div class="alert alert-danger">
                        <h1 class="text-center"><strong>Muy humedo</strong> </h1> 
                        </div>
                    <?php       }       
        }
        ?>




            <?php 


        function pintaMensaje(){
           
            global $temp, $humti, $estado, $calor, $frio, $mojado, $seco, $bandera_hum, $bandera_hum_text, $bandera_temp, $bandera_temp_text;
           
?>
            <div class="col-sm-6">
                <p><h1 id="Estado"></h1></p>
                <button id="cambiar" onclick="cambiarEstado()"> ¡Cambiar! </button>
            </div>

<?php       if($humti<$seco&&$humti>$mojado&& $temp<$calor&&$temp>$frio){ 

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
         <?php 
          }  
        }?>
         <?php

        function riegoAuto(){

            global $humti, $mojado, $seco, $temp, $calor, $frio, $bandera_hum, $con;
            


            if($humti<=$mojado+100){
                $con->regarAutoMiPlanta("off");
            }

            if($bandera_hum==2){
                $con->regarAutoMiPlanta("on");
            }
   

            if($humti>=$mojado+100 && $temp>=$calor){
                $con->regarAutoMiPlanta("on");
            }

            if($humti<$seco&&$humti>$mojado&& $temp<$calor&&$temp>$frio){ 
                $con->regarAutoMiPlanta("off");
            }
   
        } ?>
