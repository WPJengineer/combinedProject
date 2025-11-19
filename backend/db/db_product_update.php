<?php
// Get data
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db', 3306);
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
require($backend.'header.php');

// Put data in the database
include('../config/db_config.php');

// SQL Query
if (($product_name == "") && ($product_price != "")) {
    $sql = "UPDATE 014_products
    SET product_unit_price = '$product_price'
    WHERE product_id = '$product_id'";
} else if (($product_name != "") && ($product_price == "")) {
    $sql = "UPDATE 014_products
    SET product_name = '$product_name'
    WHERE product_id = '$product_id'";
} else {
    $sql = "UPDATE 014_products
    SET product_name = '$product_name', product_unit_price = '$product_price'
    WHERE product_id = '$product_id'";
}

// execute query
if (mysqli_query($conn, $sql)) {
    echo
        '<main>
            <p>Product details updated successfully</p>
            <p class="input-id"><a href="/student014/online_shop/backend/products.php">Return to Start</a></p>
        </main>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

require($backend.'footer.php');
?>