<?php

$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db', 3306);

include('./config/db_config.php');

$sql = "SELECT *
FROM 014_customers;";

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
                '<div class="customers">
                    <div class="customer-info">
                        <p>'.$row['customer_id'].'</p>
                        <p>'.$row['forename'].'</p>
                        <p>'.$row['lastname'].'</p>
                    </div>
                    <div class="buttons">
                        <a href="./forms/form_customer_update.php?customer_id='.$row['customer_id'].'&customer_name='.$row['forename'].'&customer_lastname='.$row['lastname'].'">Update</a>
                        <a href="./forms/form_customer_delete.php?customer_id='.$row['customer_id'].'&customer_name='.$row['forename'].'&customer_lastname='.$row['lastname'].'">Delete</a> 
                    </div>
                </div>';
        }
    } else {
        echo "No customer found with ID: ";
    }
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

?>