<?php

        function banderaHumti($humti,$mojado, $seco){

        //verificar humedad         
            if($humti<=$seco&&$humti>=$mojado){
                        $bhum=0;
                        $hum_text="Buen Estado de humedad";
            } 
            elseif($humti>$seco){
                        $hum=2;
                        $hum_text="Plante peligrosamente seca";
            }
            elseif($humti<$mojado){
                        $hum=1;
                        $hum_text="Planta peligrosamente humeda";
            }
            return array($hum, $hum_text);
        }

        function banderaTemp($temp, $frio, $calor){
                  //verificar temperatura

            if($temp<=$calor && $temp>=$frio){
                        $tem=0;
                        $tem_text="Buena Temperatura";
            } 
            elseif($temp>$calor){
                        $tem=2;
                        $tem_text="Planta acalorada";
            }
            elseif($temp<$frio){
                        $tem=1;
                        $tem_text="Planta con frio";
            }
            return array($tem, $tem_text);
        }
?>
        <?php
        // Humedad de tierra se transforma en un frace
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
/*
            if($humti<$seco&&$humti>$mojado&& $temp<$calor&&$temp>$frio){ 
                $con->regarAutoMiPlanta("off");

                ?>   <!--  Buen estado -->

            <?php    

            }elseif($humti>=$seco || $humti<=$mojado || $temp>=$calor || $temp<=$frio){ ?> 
                
                          <!-- DEMACIADO SECO -->  
            <?php 
                    if($bandera_hum == 1 || $bandera_hum == 2){
                        echo $bandera_hum_text." ";

                    }
                   if($bandera_temp == 1 || $bandera_temp == 2){
                        echo $bandera_temp_text;
                    }   ?>



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
         */
         ?>