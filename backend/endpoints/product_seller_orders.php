<?php

header('Content-Type: application/json; charset=utf-8');
require_once('../config/db_config.php');

$apiKey = $_GET['apikey'] ?? null;
$ordersJson = $_GET['orders_json'] ?? null;

$sql = "SELECT seller_id
FROM `014_sellers`
WHERE api_key = '$apiKey';";

$result = mysqli_query($conn, $sql);

// ------------------------------------

if (mysqli_num_rows($result) > 0) {
  $orders = json_decode(urldecode($ordersJson), true);

  $sql = "INSERT INTO `014_orders` (order_number, product_id, quantity, placed_one)
            VALUES (?, ?, ?, NOW())";

  $stmt = $conn->prepare($sql);

  $inserted = 0;
  $errors = [];

  foreach ($orders as $order) {
    $orderNumber = $order['order_number'] ?? null;
    $productId = $order['product_id'] ?? 0;
    $quantity = $order['product_quantity'] ?? null;
    // $placedOn = $order['order_placed_on'] ?? null;
    $stmt->bind_param(
      "sii",
      $orderNumber,
      $productId,
      $quantity
      // $placedOn
    );
  
    $stmt->execute();

    if ($stmt->execute()) {
        $inserted++;
    } else {
        $errors[] = $stmt->error;
    }

  }

} else {
  http_response_code(403);
  echo json_encode([
    "error" => "Emotional Damage!"
  ]);
}

echo json_encode([
  "success" => $inserted > 0,
  "inserted" => $inserted,
  "errors" => $errors
]);

mysqli_close($conn);

?>