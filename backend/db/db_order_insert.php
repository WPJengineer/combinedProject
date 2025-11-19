<?php

// Get data
$customer_id = $_POST['customer_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
// need to find a way to reset $_POST so that after an F5 doesn't cause isssues with duplicated keys.
// unset($_POST['product_id']);
// $_POST = array();
$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db', 3306);

// Put data in the database
include('../config/db_config.php');

// create query
$sql = "INSERT INTO 014_orders (customer_id, product_id, quantity)
VALUES ('$customer_id', '$product_id', '$quantity');";

// execute query
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

?>

<!-- go back to start -->
<form action="/student014/online_shop/backend/index.php">
    <p>
        <input type="submit" value="Return to start">
    </p>
</form>