<?php

// Get data
$order_id = $_POST['order_id'];
$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db', 3306);

// establish connection to database
include('../config/db_config.php');

// create query we want to do
if ($category_id == "-1") {
    $sql = "SELECT *
    FROM 014_products";
} else if ($category_id != "0") {
    $sql = "SELECT p.product_id, p.product_name, p.product_unit_price
    FROM 014_products AS p
    INNER JOIN 014_product_category AS pc ON p.product_id = pc.product_id
    INNER JOIN 014_categories AS c ON pc.category_id = c.category_id
    WHERE c.category_id = '$category_id';";
} else {
    $sql = "SELECT p.product_id, p.product_name, p.product_unit_price
    FROM 014_products AS p
    WHERE p.product_id = '$product_id';";
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

?>

<!-- go back to start -->
<form action="/student014/online_shop/backend/index.php">
    <p>
        <input type="submit" value="Return to start">
    </p>
</form>