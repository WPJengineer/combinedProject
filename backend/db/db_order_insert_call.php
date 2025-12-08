<?php
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');

include('../config/db_config.php');

if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

$sql = "SELECT s.customer_id, c.forename, c.lastname, s.product_id, p.product_name, product_unit_price, p.product_image, s.quantity
FROM `014_shopping_cart` AS s
INNER JOIN `014_products` AS p ON s.product_id = p.product_id
INNER JOIN `014_customers` AS c ON s.customer_id = c.customer_id
WHERE s.customer_id =". $_SESSION['customer_id'].";";

$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo '<main class="bg-green flex flex-col gap-6" style="flex: 1;">
                <p>Products ordered</p>';
        while($row = mysqli_fetch_assoc($result)) {
            echo
                '<div class="w-full flex items-center gap-6">
                    <img class="w-25 border" src="'.$row['product_image'].'" alt="product-image">
                    <p>'.$row['product_name'].'</p>
                    <p id="unit-price">'.$row['product_unit_price'].'€</p>
                    <p>'.$row['forename'].'</p>
                    <p>'.$row['lastname'].'</p>
                    <p>'.$row['quantity'].'</p>
                </div>';
        }
        echo
                '<p class="button"><a href="">Return to Start</a></p>
            </main>';
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

require($backend.'footer.php');
// close channel after finishing query
mysqli_close($conn);

?>