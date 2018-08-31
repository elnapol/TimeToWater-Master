<?php
include("conexion_vista.php");
$con = new conexion();

class compracion{ 

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


    function recuperarBandera(){

        //verificar humedad

        if($humti<=$seco&&$humti>=$mojad){
                    $bandera_hum=0;
                    $bandera_hum_text="Buen Estado de humedad";
                } 
        elseif($humti>$seco){
                    $bandera_hum=2;
                    $bandera_hum_text="Plante peligrosamente seca";
                }
        elseif($humti<$mojado){
                    $bandera_hum=1;
                    $bandera_hum_text="Planta peligrosamente humeda";
                }


              //verificar temperatura


        if($temp<=$calor && $temp>=$frio){
                    $bandera_temp=0;
                    $bandera_temp_text="Buena Temperatura";
                } 
        elseif($temp>$calor){
                    $bandera_temp=2;
                    $bandera_temp_text="Planta acalorada";
                }
        elseif($temp<$frio){
                    $bandera_temp=1;
                    $bandera_temp_text="Planta con frio";
                }
    }
}

?>