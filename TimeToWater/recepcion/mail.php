<?php 
require '../PHPMailer/PHPMailerAutoload'
$mail = new PHPMailer();

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '587';
$mail->Username = 'elnapol3@gmail.com';
$mail->Password = 'sorpresa1';

$mail->setFrom('elnapol3@gmail.com', 'TimeToWater');

$mail->addAddress('elnapol@hotmail.com','Prueba');

$mail->Subject = 'Hola';

$mail->Body = 'Planta con probelmas';

if($mail->send()){
		echo 'Enviado';
}else{
	echo 'Error';
}



?>