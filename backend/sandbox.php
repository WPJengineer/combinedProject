<?php
$url = 'https://dataservice.accuweather.com/currentconditions/v1/305482';
$ch = curl_init();
$data = array(
	'Authorization' => 'Bearer zpka_0c52a288c0d7420b9a9acf1bc51cf5d0_8a04fb91'
);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_URL, 'https://dataservice.accuweather.com/currentconditions/v1/305482');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
$result = curl_exec($ch);
curl_close($ch);
echo $result;
?>