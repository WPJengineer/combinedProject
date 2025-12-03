<?php

// if (!isset($_SESSION['customer_id'])) {
//     header("Location: /student014/shop/backend/forms/form_login.php");
//     exit();
// }

// Get data
// include('./config/db_config.php');
$product_id = $_POST['product_id'];
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');

// Put data in the database
include('../config/db_config.php');

// SQL Query
$sql = "DELETE
FROM 014_products
WHERE product_id = '$product_id'";

// execute query
if (mysqli_query($conn, $sql)) {
    echo    '<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
                <p>Product deleted successfully</p>
                <p class="button"><a href="/student014/shop/backend/products.php">Return to Start</a></p>
            </main>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

require($backend.'footer.php');
?>