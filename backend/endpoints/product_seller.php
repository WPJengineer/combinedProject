<?php

header("Content-Type: application/json");
// missing to check apikey we get from $_POST in db and et seller_id so we can select all products that belong to that id. 
// $_POST['apiKey'];

$sql = "SELECT *
FROM 014_products
-- WHERE api_key = $apiKey
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