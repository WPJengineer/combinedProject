<?php

include('../config/db_config.php');

$sql = "SELECT *
FROM `014_vendors`;";

$result = mysqli_query($conn, $sql);

$vendors = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $vendors[] = $row;
  }
}

foreach ($vendors as $vendor) {
  $vendorId = $vendor["vendor_id"];
  $apiKey = $vendor["api_key"];
  $url = $vendor["api_endpoint_products"] . "?apikey=" . $apiKey;
  getProductsFromSuppliers($conn, $vendorId, $apiKey, $url);
}

mysqli_close($conn);

function getProductsFromSuppliers($conn, $vendorId, $apiKey, $url) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  echo $result;
  if ($result === false) {
    echo "cURL error: " . curl_error($ch);
  } else {
    $products = json_decode($result, true);
    $sql = "INSERT INTO `014_products` (product_name, product_unit_price, product_image, product_desc, stock, size, product_color, vendor_id, product_code)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    foreach ($products as $product) {
      $productName = $product['product_name'] ?? null;
      $productPrice = $product['product_price'] ?? 0;
      $productImage = $product['product_image'] ?? null;
      $productDesc = $product['product_desc'] ?? null;
      $productStock = $product['product_stock'] ?? 0;
      $productSize = $product['product_size'] ?? null;
      $productColor = $product['product_color'] ?? null;
      $productCode = $product['product_id'] ?? null;
      $stmt->bind_param(
        "sdssissii",
        $productName,
        $productPrice,
        $productImage,
        $productDesc,
        $productStock,
        $productSize,
        $productColor,
        $vendorId,
        $productCode
      );
    
      $stmt->execute();
    }
  }
  curl_close($ch);
}

?>