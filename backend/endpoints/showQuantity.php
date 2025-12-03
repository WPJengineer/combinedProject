<?php

session_start();

$product_id = $_GET['product_id'];
$customer_id = $_GET['customer_id'];
$quantity = $_GET['quantity'];

$sql =
"UPDATE `014_shopping_cart`
SET quantity = $quantity
WHERE customer_id = $customer_id AND product_id = $product_id;";


// include('./config/db_config.php');

include('../config/db_config.php');

if (mysqli_query($conn, $sql)) {
    echo $quantity;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>