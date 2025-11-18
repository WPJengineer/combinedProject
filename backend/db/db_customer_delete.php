<?php
// Get data
$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db', 3306);
$customer_id = $_POST['customer_id'];
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
require($backend.'header.php');

// Put data in the database
include('../config/db_config.php');

// SQL Query
$sql = "DELETE
FROM 014_customers
WHERE customer_id = '$customer_id'";

// execute query
if (mysqli_query($conn, $sql)) {
    echo    
        '<main>
            <p>Product deleted successfully</p>
            <p class="input-id"><a href="/student014/online_shop/backend/customers.php">Return to Start</a></p>
        </main>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

require($backend.'footer.php');
?>