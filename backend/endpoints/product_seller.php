<?php

header("Content-Type: application/json");

$sql = "SELECT *
FROM 014_products
LIMIT 5
;";

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