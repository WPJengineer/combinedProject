<?php

header('Content-Type: application/json; charset=utf-8');
require_once('../config/db_config.php');

$apiKey = $_GET['apikey'];

// has to be an insert into orders table after we check the apikey corresponds to a seller.
$sql = "";

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