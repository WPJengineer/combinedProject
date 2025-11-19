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

// create query
$sql ="INSERT INTO 014_products (product_id, product_name, product_unit_price)
VALUES ('$product_id', '$product_name', '$product_price')";

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

<!-- go back to start -->
<!-- <form action="/student014/online_shop/backend/index.php">
    <p>
        <input type="submit" value="Return to start">
    </p>
</form> -->