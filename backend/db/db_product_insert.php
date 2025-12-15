<?php

// Get data
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
$assets = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/assets/images/';
$product_id = htmlspecialchars($_POST['product_id']);
$product_name = htmlspecialchars($_POST['product_name']);
$product_price = htmlspecialchars($_POST['product_price']);
$original_name = basename($_FILES["fileToUpload"]["name"]);
$extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
$safe_product_name = preg_replace('/[^a-z0-9_-]/i', '_', trim($_POST['product_name']));
$file_name = $safe_product_name . '.' . $extension;
$targetFile = $assets . $file_name;
$imageURL = '/student014/shop/assets/images/' . $file_name;

//skipping checks for file size, if already exists, format is already checked by html input in form.
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
    echo 'Image uploaded correctly';
} else {
    echo 'error';
}

require($backend.'header.php');

// Put data in the database
include('../config/db_config.php');

if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

// create query
$sql ="INSERT INTO 014_products (product_id, product_name, product_unit_price, product_image)
VALUES ('$product_id', '$product_name', '$product_price', '$imageURL')";

// execute query
if (mysqli_query($conn, $sql)) {
    echo
        '<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
            <p>Product details updated successfully</p>
            <p class="button"><a href="/student014/shop/backend/products.php">Return to Start</a></p>
        </main>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

require($backend.'footer.php');

?>