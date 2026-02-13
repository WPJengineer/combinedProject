<?php

header('Content-Type: application/json; charset=utf-8');
require_once('../config/db_config.php');

$apiKey = $_GET['apikey'] ?? null;
$ordersJson = $_GET['orders_json'] ?? null;

if (!$apiKey) {
  http_response_code(400);
  echo json_encode(["success" => false, "error" => "Missing apikey"]);
  exit;
}

if (!$ordersJson) {
  http_response_code(400);
  echo json_encode(["success" => false, "error" => "Missing orders_json"]);
  exit;
}

$sql = "SELECT seller_id
FROM `014_sellers`
WHERE api_key = '$apiKey';";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $orders = json_decode(urldecode($ordersJson), true);

  $sqlInsert = "INSERT INTO `014_orders` (order_number, product_id, quantity, placed_one)
            VALUES (?, ?, ?, NOW())";

  $stmt = $conn->prepare($sqlInsert);

  $inserted = 0;
  $errors = [];

  foreach ($orders as $order) {
    $orderNumber = $order['order_number'] ?? null;
    $productId = $order['product_code'] ?? 0;
    $quantity = $order['product_quantity'] ?? null;
    $stmt->bind_param(
      "sii",
      $orderNumber,
      $productId,
      $quantity
    );
  
    $stmt->execute();

    if ($stmt->execute()) {
        $inserted++;
    } else {
      $errors[] = [
        "index" => $i,
        "error" => $stmt->error,
        "order_number" => $orderNumber,
        "product_id" => $productId
      ];
    }

  }

} else {
  http_response_code(403);
  echo json_encode([
    "error" => "Invalid API key"
  ]);
}

echo json_encode([
  "success" => $inserted > 0,
  "inserted" => $inserted,
  "errors" => $errors
]);

mysqli_close($conn);

?>