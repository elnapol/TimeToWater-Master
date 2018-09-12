<?php
$url = "https://time2water-2b8e6.firebaseio.com/presupuestos.json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

//print_r($response);
$data = json_decode($response, true);
foreach ($data as $key => $value) {
	echo $data[$key]["concepto"]."-".$data[$key]["ID"]."<br>";
}
?>