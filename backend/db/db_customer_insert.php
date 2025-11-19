<?php

// Get data
$customer_id = $_POST['customer_id'];
$customer_forename = $_POST['customer_forename'];
$customer_lastname = $_POST['customer_lastname'];
$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db', 3306);
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
require($backend.'header.php');

// Put data in the database
include('../config/db_config.php');

// create query
$sql ="INSERT INTO 014_customers (customer_id, forename, lastname)
VALUES ('$customer_id', '$customer_forename', '$customer_lastname')";

// execute query
if (mysqli_query($conn, $sql)) {
    echo
        '<main>
            <p>Customer details updated successfully</p>
            <p class="input-id"><a href="/student014/online_shop/backend/customers.php">Return to Start</a></p>
        </main>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

require($backend.'footer.php');
?>