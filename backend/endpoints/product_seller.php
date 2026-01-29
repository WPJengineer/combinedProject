<?php

// header("Content-Type: application/json");

// $apiKey = $_SERVER['HTTP_X_API_KEY'] ?? null;

// if (!$apiKey) {
//   http_response_code(401);
//   echo json_encode([
//     "error" => "Missing X-API-KEY header"
//   ]);
//   exit;
// }

// $sql = "SELECT product_id
// FROM `014_seller_products`
// WHERE seller_id =
// (SELECT seller_id FROM `014_sellers` WHERE api_key = '$apiKey');";

// include('../config/db_config.php');

// $result = mysqli_query($conn, $sql);

// $products = [];

// if (mysqli_num_rows($result) > 0) {
//   while ($row = mysqli_fetch_assoc($result)) {
//     $products[] = $row;
//   }
// }
// echo json_encode($products);
// mysqli_close($conn);
// exit;
 // -----------------------------

 // trial
header('Content-Type: application/json; charset=utf-8');
require_once('../config/db_config.php');

$apiKey = $_GET['apikey'];

// if (!$apiKey) {
//   http_response_code(403);
//   echo json_encode([
//     "error" => "Emotional Damage!"
//   ]);
//   exit;
// }

$sql = "SELECT *
FROM `014_products`
WHERE product_id IN (
    SELECT p.product_id
    FROM `014_seller_products` AS p
    WHERE p.seller_id = (
        SELECT seller_id
        FROM `014_sellers`
        WHERE api_key = '$apiKey'
    )
);";



$result = mysqli_query($conn, $sql);

$products = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
  }
} else {
  http_response_code(403);
  echo json_encode([
    "error" => "Emotional Damage!"
  ]);
}



echo json_encode($products);
mysqli_close($conn);

?>