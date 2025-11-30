<?php

// if (!isset($_SESSION['customer_id'])) {
//     header("Location: /student014/shop/backend/forms/form_login.php");
//     exit();
// }
// session_start();



$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db', 3306);
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');

// Get data
$customer_id = $_SESSION['customer_id'];

// Put data in the database
include('../config/db_config.php');

// create query
$sql = "INSERT INTO `014_orders` (product_id, customer_id, quantity)
SELECT product_id, customer_id, quantity
FROM `014_shopping_cart`
WHERE customer_id = $customer_id";

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