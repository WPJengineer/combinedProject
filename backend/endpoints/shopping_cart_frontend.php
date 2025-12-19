<?php

header("Content-Type: application/json");
session_start();

$customer_id = $_SESSION["customer_id"];

$sql = "SELECT s.customer_id, s.product_id, s.quantity, p.product_name, p.product_unit_price, p.product_image
FROM `014_shopping_cart` AS s
INNER JOIN `014_products` AS p ON p.product_id = s.product_id
WHERE s.customer_id = '$customer_id';";

include('../config/db_config.php');

$result = mysqli_query($conn, $sql);

$shopping_cart = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $shopping_cart[] = $row;
  }
}
echo json_encode($shopping_cart);
mysqli_close($conn);
exit;
?>