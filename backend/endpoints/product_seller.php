<?php

header("Content-Type: application/json");

// $url = 'https://remotehost.es/student022/backend/sandbox.php';

// $raw = file_get_contents("php://input");
// $data = json_decode($raw, true);

// $key = $data['apiKey'];

// echo $key;

// Get apiKey
$apiKey = $_SERVER['HTTP_X_API_KEY'] ?? null;

// echo $apiKey;

// $data = array(
// 	'apiKey' => $apiKey
// );

// $ch = curl_init($url);
// // curl_setopt($ch,CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// // curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// $result = curl_exec($ch);
// curl_close($ch);

// echo $result;

// $apiKey =
// $_SERVER['HTTP_APIKEY'] ??
// '12345josh';
// $_POST['apiKey'];
// $test = $_POST['apiKey'];
// echo $test;

// echo json_encode([
//     'received_api_key' => $apiKey
// ]);
// exit;

$headers = getallheaders();
echo json_encode($headers);
exit;


$sql = "SELECT product_id
FROM `014_seller_products`
WHERE seller_id =
(SELECT seller_id FROM `014_sellers` WHERE api_key = '$apiKey');";

include('../config/db_config.php');

$result = mysqli_query($conn, $sql);

$products = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
  }
}
echo json_encode($products);
mysqli_close($conn);
exit;
?>