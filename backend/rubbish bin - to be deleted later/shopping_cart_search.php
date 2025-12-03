<?php

session_start();

$product_name = $_GET['product_name'];
// $customer_name = $_GET['customer_name'];

// if ($_SESSION['customer_role'] == 'admin') {
//     $sql = "SELECT s.customer_id, c.forename, c.lastname, s.product_id, p.product_name, product_unit_price, p.product_image, s.quantity
//     FROM `014_shopping_cart` AS s
//     INNER JOIN `014_products` AS p ON s.product_id = p.product_id
//     INNER JOIN `014_customers` AS c ON s.customer_id = c.customer_id
//     WHERE p.product_name LIKE '%$product_name%';";
// } else {
    $sql = "SELECT s.customer_id, c.forename, c.lastname, s.product_id, p.product_name, product_unit_price, p.product_image, s.quantity
    FROM `014_shopping_cart` AS s
    INNER JOIN `014_products` AS p ON s.product_id = p.product_id
    INNER JOIN `014_customers` AS c ON s.customer_id = c.customer_id
    WHERE p.product_name LIKE '%$product_name%'
    AND s.customer_id =". $_SESSION['customer_id'].";";
// }

// include('./config/db_config.php');

include('../config/db_config.php');

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo
        '<div class="shopping-cart">
            <div class="flex gap-6">
                <img class="w-25" src="'.$row['product_image'].'" alt="product-image">
                <div class="flex items-center gap-6">
                    <p>'.$row['product_name'].'</p>
                    <p>'.$row['product_unit_price'].'€</p>
                    <p>'.$row['forename'].'</p>
                    <p>'.$row['lastname'].'</p>
                    <p>'.$row['quantity'].'</p>
                </div>
            </div>
            <div class="flex">
                <a class="button" href="">Place Order</a>
                <a class="button" href="./forms/form_shopping_cart_update.php?product_id='.$row['product_id'].'&product_name='.$row['product_name'].'&product_price='.$row['product_unit_price'].'&product_image='.$row['product_image'].'">Edit</a>
                <a class="button" href="./forms/form_shopping_cart_delete.php?product_id='.$row['product_id'].'&product_name='.$row['product_name'].'&product_price='.$row['product_unit_price'].'&product_image='.$row['product_image'].'">Remove</a> 
            </div>
        </div>';
  }
}
mysqli_close($conn);

?>