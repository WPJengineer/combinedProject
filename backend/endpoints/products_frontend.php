<?php

header("Content-Type: application/json");

// $product_name = $_GET['product_name'];

$sql = "SELECT *
FROM 014_products
-- WHERE product_name LIKE '%$product_name%'
;";

include('../config/db_config.php');

$result = mysqli_query($conn, $sql);

$products = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
  }
  echo json_encode($products);
}
mysqli_close($conn);
exit;
?>