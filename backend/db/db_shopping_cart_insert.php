<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/online_shop/backend/forms/form_login.php");
    exit();
}

$customer_id = $_POST['customer_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db', 3306);

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
require($backend.'header.php');

include('../config/db_config.php');

$sql = "INSERT INTO `014_shopping_cart` (customer_id, product_id, quantity)
VALUES ('$customer_id', '$product_id', '$quantity');";

if (mysqli_query($conn, $sql)) {
    echo
        '<main>
            <p>Details updated successfully into shopping cart</p>
            <p class="input-id"><a href="/student014/online_shop/backend/products.php">Return to Start</a></p>
        </main>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

require($backend.'footer.php');
?>