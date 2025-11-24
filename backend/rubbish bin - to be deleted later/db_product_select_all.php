<?php
// Get data

// print_r($_POST);
$product_id = $_POST['product_id'];
$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db');

// establish connection to database
include('../config/db_config.php');

// create query we want to do
if ($product_id == "0") {
    $sql = "SELECT *
    FROM products";
} else {
    $sql = "SELECT product_id, product_name, product_unit_price
    FROM products
    WHERE product_id = '$product_id'";
}


// execute query
$result = mysqli_query($conn, $sql);

// if connection fails show error if not get result of query
if (mysqli_query($conn, $sql)) {
    
    if (mysqli_num_rows($result) > 0) {
    // Fetch and display each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>Product ID: " . $row['product_id'] . "</p>";
            echo "<p>Product Name: " . $row['product_name'] . "</p>";
            echo "<p>Product Price: " . $row['product_unit_price'] . "</p>";
        }
    } else {
        echo "No product found with ID: " . $product_id;
    }
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

// Send confirmation



?>