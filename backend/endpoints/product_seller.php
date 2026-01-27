<?php

header("Content-Type: application/json");
// header("Content-Type: ");
// missing to check apikey we get from $_POST in db and et seller_id so we can select all products that belong to that id. 
// $_POST['apiKey'];
// $url = 'https://remotehost.es/student022/backend/endpoint/product_seller.php';
$apiKey =
$_SERVER['HTTP_APIKEY'] ??
// null;
'12345josh';

// print_r(getallheaders($url));
// print_r($apiKey);

// $sql = "SELECT *
// FROM 014_products
// ;";

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