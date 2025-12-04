<?php

$customer_id = $_POST['customer_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// include('./config/db_config.php');

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');
include('../config/db_config.php');

if (!isset($_SESSION['customer_id'])) {
header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

$sql = "INSERT INTO `014_shopping_cart` (customer_id, product_id, quantity)
VALUES ('$customer_id', '$product_id', '$quantity');";

if (mysqli_query($conn, $sql)) {
    echo
        '<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
            <p>Details updated successfully into shopping cart</p>
            <p class="button"><a href="/student014/shop/backend/products.php">Return to Start</a></p>
        </main>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

require($backend.'footer.php');
?>