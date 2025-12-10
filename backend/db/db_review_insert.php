<?php

$customer_id = htmlspecialchars($_POST['customer_id']);
$product_id = htmlspecialchars($_POST['product_id']);
$rating = htmlspecialchars($_POST['rating']);
$review = htmlspecialchars($_POST['review']);

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');

include('../config/db_config.php');

if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

$sql = "INSERT INTO `014_reviews` (product_id, customer_id, review_score, review_content)
VALUES ('$product_id', '$customer_id', '$rating', '$review');";

if (mysqli_query($conn, $sql)) {
    echo
        '<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
            <p>Review submitted</p>
            <p class="button"><a href="/student014/shop/backend/orders.php">Return to Start</a></p>
        </main>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

require($backend.'footer.php');

?>