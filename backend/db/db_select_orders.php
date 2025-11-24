<?php

$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db', 3306);

include('./config/db_config.php');

$sql = "SELECT *
FROM 014_orders;";

// execute query
$result = mysqli_query($conn, $sql);

// if connection fails show error if not get result of query
if (mysqli_query($conn, $sql)) {
    
    if (mysqli_num_rows($result) > 0) {
    // Fetch and display each row
        echo
            '<div class="insertBar">
                <div class="insertBtn buttons">
                    <a href="./forms/form_customer_insert.php">Insert New Customer</a>
                </div>
            </div>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo 
                '<div class="orders">
                    <div class="order-info">
                        <p>'.$row['order_number'].'</p>
                        <p>'.$row['product_id'].'</p>
                        <p>'.$row['customer_id'].'</p>
                    </div>
                    <div class="buttons">
                        <a href="./forms/form_order_update.php?order_number='.$row['order_number'].'&product_id='.$row['product_id'].'&customer_id='.$row['customer_id'].'">Update</a>
                        <a href="./forms/form_order_delete.php?order_number='.$row['order_number'].'&product_id='.$row['product_id'].'&customer_id='.$row['customer_id'].'">Delete</a> 
                    </div>
                </div>';
        }
    } else {
        echo "No product found with ID: ";
    }
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

?>