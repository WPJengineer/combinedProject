<?php

// Get data
$customer_id = $_POST['customer_id'];
$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db', 3306);

// establish connection to database
include('../config/db_config.php');

// create query we want to do
if ($customer_id == "-1") {
    $sql = "SELECT *
    FROM 014_customers";
} else {
    $sql = "SELECT customer_id, forename, lastname
    FROM 014_customers
    WHERE customer_id = '$customer_id';";
}

// execute query
$result = mysqli_query($conn, $sql);

// if connection fails show error if not get result of query
if (mysqli_query($conn, $sql)) {
    
    if (mysqli_num_rows($result) > 0) {
    // Fetch and display each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>Customer ID: " . $row['customer_id'] . "</p>";
            echo "<p>Name: " . $row['forename'] . "</p>";
            echo "<p>Lastname: " . $row['lastname'] . "</p>";
        }
    } else {
        echo "No customer found with ID: " . $customer_id;
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