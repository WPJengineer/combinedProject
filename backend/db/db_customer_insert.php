<?php

// Get data
$customer_id = htmlspecialchars($_POST['customer_id']);
$customer_forename = htmlspecialchars($_POST['customer_forename']);
$customer_lastname = htmlspecialchars($_POST['customer_lastname']);
$customer_username = htmlspecialchars($_POST['customer_username']);
$password = htmlspecialchars($_POST['password']);
$customer_role = htmlspecialchars($_POST['role']);

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');

// Put data in the database
include('../config/db_config.php');

if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

// create query
$sql ="INSERT INTO 014_customers (customer_id, forename, lastname, customer_role, username, password)
VALUES ('$customer_id', '$customer_forename', '$customer_lastname', '$customer_role', '$customer_username', '$password')";

// execute query
if (mysqli_query($conn, $sql)) {
    echo
        '<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
            <p>Customer details inserted successfully</p>
            <p class="button"><a href="/student014/shop/backend/customers.php">Return to Start</a></p>
        </main>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

require($backend.'footer.php');
?>