<?php

header('Content-Type: application/json; charset=utf-8');
require('../config/db_config.php');

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

$stmt = $conn->prepare("SELECT seller_id FROM `014_sellers` WHERE api_key = ?");
  $stmt->bind_param("s", $apiKey);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
      http_response_code(403);
      echo json_encode(["error" => "Invalid API key"]);
      exit;
  }

// $sql = "SELECT seller_id
// FROM `014_sellers`
// WHERE api_key = '$apiKey';";

// $result = mysqli_query($conn, $sql);

// if (mysqli_num_rows($result) > 0) {
  $orders = json_decode($ordersJson, true);

  $sqlInsert = "INSERT INTO `014_orders` (order_number, customer_id, product_id, vendor_id, quantity)
            VALUES (?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sqlInsert);

  $inserted = 0;
  $errors = [];

  foreach ($orders as $order) {
    // $orderNumber = $order['order_number'] ?? null;
    $orderNumber = 'JOSEP';
    $customerId = 100;
    $productId = (int)$order['product_code'];
    $vendorId = 2;
    $quantity = (int)$order['product_quantity'];
    $stmt->bind_param(
      "siiii",
      $orderNumber,
      $customerId,
      $productId,
      $vendorId,
      $quantity
    );

    if ($stmt->execute()) {
        $inserted++;
    } else {
      $errors[] = [
        "error" => $stmt->error,
        "order_number" => $orderNumber,
        "product_code" => $productId
      ];
    }
  }

echo json_encode([
  "success" => $inserted > 0,
  "inserted" => $inserted,
  "errors" => $errors
]);

mysqli_close($conn);

?>