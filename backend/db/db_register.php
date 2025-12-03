<?php

include('../functions/functions.php');

registrationInputs();

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';

include($backend.'./config/db_config.php');

$sql = "SELECT username
FROM `014_customers`
WHERE username = '$username'";

$result = mysqli_query($conn, $sql);
// issue with duplicated user.
if (mysqli_num_rows($result) > 0) {
    echo 'user already exists, please either use a different username or login';
    // header("Location: /student014/shop/backend/forms/form_register.php");
    // exit();
} else {
    $insert_sql ="INSERT INTO 014_customers (forename, lastname, customer_role, username, password)
    VALUES ('$forename', '$lastname', 'customer', '$username', '$password')";

    if (mysqli_query($conn, $insert_sql)) {
        echo "Registration successful!";
        header("Location: /student014/shop/backend/forms/form_login.php");
        exit();
    } else {
        echo "Error inserting user: " . mysqli_error($conn);
    }

}

mysqli_close($conn);

?>