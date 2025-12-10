<?php

session_start();

$product_id = htmlspecialchars($_POST['product_id']);
$customer_id = htmlspecialchars($_POST['customer_id']);
$quantity = htmlspecialchars($_POST['quantity']);

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