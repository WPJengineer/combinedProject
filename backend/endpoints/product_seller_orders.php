<?php

header('Content-Type: application/json; charset=utf-8');
require_once('../config/db_config.php');

$apiKey = $_GET['apikey'];

$sql = "SELECT seller_id
FROM `014_sellers`
WHERE api_key = '$apiKey';";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $rawInput = file_get_contents('php://input');
  $orders = json_decode($rawInput, true);
  // has to be an insert into orders table after we check the apikey corresponds to a seller.

} else {
  http_response_code(403);
  echo json_encode([
    "error" => "Emotional Damage!"
  ]);
}

echo json_encode($orders);
mysqli_close($conn);

?>