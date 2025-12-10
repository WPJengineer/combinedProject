<?php

session_start();

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';

include($backend.'/config/db_config.php');

$sql = "SELECT customer_id, forename, lastname, customer_role
FROM `014_customers`;
WHERE username = '$username' AND
`password` = '$password'";

$result = mysqli_query($conn, $sql);
print_r(mysqli_fetch_all($result, MYSQLI_ASSOC));

if (mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        // if correct input of data.
        $row = mysqli_fetch_assoc($result);
        $_SESSION['customer_id'] = $row['customer_id'];
        $_SESSION['username'] = $row['forename'];
        $_SESSION['userLastname'] = $row['lastname'];
        $_SESSION['customer_role'] = $row['customer_role'];

        if ($_SESSION['customer_role'] === "admin") {
            // admin so go to admin panel
            header("Location: /student014/shop/backend/index.php");
            exit();
        } else {
            // customer so go to products page
            header("Location: /student014/shop/backend/products.php");
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

?>