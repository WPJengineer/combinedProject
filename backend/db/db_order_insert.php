<?php

// if (!isset($_SESSION['customer_id'])) {
//     header("Location: /student014/shop/backend/forms/form_login.php");
//     exit();
// }
// session_start();



// include('./config/db_config.php');
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');

// Get data
$customer_id = $_SESSION['customer_id'];
$customer_forename = $_SESSION['username'];
$customer_lastname = $_SESSION['userLastname'];
// $cartTotal = $_GET['subtotal'];

// Put data in the database
include('../config/db_config.php');

$order_number = generateOrderNumber($customer_id, $customer_forename, $customer_lastname);

// create query
// check if items exist in database already.
// if exists it updates if not insert.

$sql = "INSERT INTO `014_orders` (order_number, product_id, customer_id, quantity, product_unit_price)
SELECT '$order_number', sc.product_id, sc.customer_id, sc.quantity, (p.product_unit_price * sc.quantity)
FROM `014_shopping_cart` AS sc
INNER JOIN `014_products` AS p ON p.product_id = sc.product_id
WHERE sc.customer_id = $customer_id";

// execute query
if (mysqli_query($conn, $sql)) {
    echo
        '<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
            <p>Product ordered successfully</p>
            <p class="button"><a href="/student014/shop/backend/index.php">Return to Start</a></p>
        </main>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

require($backend.'footer.php');
?>