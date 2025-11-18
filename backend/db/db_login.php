<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$username = $_POST['username'];
$password = $_POST['password'];
$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db', 3306);
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
// require($backend.'header.php');

include($backend.'/config/db_config.php');

$sql = "SELECT customer_id, forename, customer_role
FROM `014_customers`
WHERE username = '$username' AND
password = '$password';";

$result = mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        // if correct input of data.
        $row = mysqli_fetch_assoc($result);
        $_SESSION['customer_id'] = $row['customer_id'];
        $_SESSION['username'] = $row['forename'];
        // $role = $row['customer_role'];
        $_SESSION['customer_role'] = $row['customer_role'];

        // if ($role === "admin") {
        if ($_SESSION['customer_role'] === "admin") {
            // admin so go to admin panel
            header("Location: /student014/online_shop/backend/index.php");
            exit();
        } else {
            // customer so go to products page
            header("Location: /student014/online_shop/backend/products.php");
            exit();
        }
        
    } else  {
        echo 
        "No customer found with that username and/or password";
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);

// require($backend.'footer.php');
?>