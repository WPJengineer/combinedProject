<?php
// $url = 'https://dataservice.accuweather.com/currentconditions/v1/305482';
// $ch = curl_init();
// $data = array(
// 	'Authorization' => 'Bearer zpka_0c52a288c0d7420b9a9acf1bc51cf5d0_8a04fb91'
// );
// $payload = json_encode($data);
// curl_setopt($ch, CURLOPT_URL, 'https://dataservice.accuweather.com/currentconditions/v1/305482');
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
// // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
// $result = curl_exec($ch);
// curl_close($ch);
// echo $result;

// make a function that runs all in a for loop to retrieve all products from all the urls.

// nicki
// $url = 'https://remotehost.es/student022/sandbox/apiSandbox/endpointSendVendorJosh.php';
// $apiKey = '10203040F';
// josep
$url = 'https://remotehost.es/student012/shop/backend/endpoints/seller_products.php';
$apiKey = '12345josep';
// alan
// $url = 'https://remotehost.es/student024/Shop/backend/endpoints/sellers/sellers_products.php';
// $apiKey = 'e888b918-330e-43c5-a103-111d57a4a28f';


$ch = curl_init();
$data = array(
	'apiKey' => $apiKey
);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
$result = curl_exec($ch);
if ($result === false) {
    error_log('cURL Error: ' . curl_error($ch));
    exit('Sorry! An error occurred.');
}
curl_close($ch);
// echo $result;

$test = json_decode($result, true);
foreach ($test as $key => $value) {
    // print_r($value);
    print_r($value["product_id"] . "\n");
    print_r($value["image_path"] . "\n");
    print_r($value["product_name"] . "\n");
    print_r($value["description"] . "\n");
    print_r($value["unit_price"] . "\n");
}


?>