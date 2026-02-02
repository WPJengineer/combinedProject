<?php

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

$sql = "SELECT
    product_id AS product_id,
	  product_name AS product_name,
    product_image AS product_image, 
    product_unit_price AS product_price,
    product_desc AS product_desc,
    product_color AS product_color,
	  stock AS product_stock,
	  size AS product_size
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