<?php

$customer_id = htmlspecialchars($_POST['customer_id']);
$product_id = htmlspecialchars($_POST['product_id']);
if (empty(htmlspecialchars($_POST['quantity']))) {
    header("Location: /student014/shop/backend/products.php");
    exit();
} else {
    $quantity = $_POST['quantity'];
}

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');
include('../config/db_config.php');

if (!isset($_SESSION['customer_id'])) {
header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

$checkIfExists = "SELECT quantity
FROM `014_shopping_cart`
WHERE customer_id = $customer_id AND product_id = $product_id;";

$result = mysqli_query($conn, $checkIfExists);

if (mysqli_num_rows($result) > 0) {
    $sql = "UPDATE `014_shopping_cart`
    SET quantity = quantity + $quantity
    WHERE customer_id = $customer_id AND product_id = $product_id;";
} else {
    $sql = "INSERT INTO `014_shopping_cart` (customer_id, product_id, quantity)
    VALUES ('$customer_id', '$product_id', '$quantity');";
}

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