<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');

include('../config/db_config.php');

if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

$product_id = $_POST['product_id'];
$customer_id = $_POST['customer_id'];
print_r($_POST['product_id']);

$sql = "";





// close channel after finishing query
mysqli_close($conn);

require($backend.'footer.php');

?>