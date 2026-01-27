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

//josh
// $url = 'https://remotehost.es/student022/backend/endpoint/product_seller.php';

// niki
// $url = 'https://remotehost.es/student022/backend/apis/suppliers/api_endpoint_call_products.php';
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
    // 'api_key' => $apiKey // alan apikey.
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
echo $result;

// $keys = ['product_name','product_price'];
// $new_array=[];
// $test = json_decode($result, true);
// foreach ($test as $key => $value) {
//     if(in_array($key,$keys)) {
//     $new_array[$key]=$value;
//     }

//     print_r("product id: " . $value["product_id"] . " ");
//     print_r("product name: " . $value["product_name"] . " ");
//     print_r("product price: " . $value["unit_price"] . " ");
// }

// json_encode($new_array, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE)


?>