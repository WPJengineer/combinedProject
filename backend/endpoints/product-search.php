<?php

session_start();

$product_name = $_GET['product_name'];

$sql = "SELECT *
FROM 014_products
WHERE product_name LIKE '%$product_name%';";

$conn = mysqli_connect('localhost', 'root', '', 'shop_db', 3306);

include('../config/db_config.php');

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo
        '<div class="products">
            <div class="flex gap-6">
                <img class="w-25" src="'.$row['product_image'].'" alt="product-image">
                <div class="flex items-center gap-6">
                    <p>'.$row['product_name'].'</p>
                    <p>'.$row['product_unit_price'].'€</p>
                </div>
            </div>';
            
            if ($_SESSION['customer_role'] == "admin") {
                echo
                    '<div class="flex">
                        <a class="button" href="./forms/form_shopping_cart_insert.php?product_id='.$row['product_id'].'">Add to cart</a>
                        <a class="button" href="./forms/form_product_update.php?product_id='.$row['product_id'].'&product_name='.$row['product_name'].'&product_price='.$row['product_unit_price'].'&product_image='.$row['product_image'].'">Update</a>
                        <a class="button" href="./forms/form_product_delete.php?product_id='.$row['product_id'].'&product_name='.$row['product_name'].'&product_price='.$row['product_unit_price'].'&product_image='.$row['product_image'].'">Delete</a> 
                    </div>
                </div>';
            } else {
                echo
                    '<div class="flex">
                        <a class="button" href="./forms/form_shopping_cart_insert.php?product_id='.$row['product_id'].'">Add to cart</a> 
                    </div>
                </div>';
            }
  }
}
mysqli_close($conn);

?>