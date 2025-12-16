<?php

session_start();

$product_name = $_GET['product_name'];

$sql = "SELECT *
FROM 014_products
WHERE product_name LIKE '%$product_name%';";

// include('./config/db_config.php');

include('../config/db_config.php');

$result = mysqli_query($conn, $sql);

$products = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
    echo
        '<div class="products">
            <div class="flex gap-6">
                <img class="w-25 border" src="'.$row['product_image'].'" alt="product-image">
                <div class="flex items-center gap-6">
                    <p>'.$row['product_name'].'</p>
                    <p>'.$row['product_unit_price'].'€</p>
                    <p>'.$row['product_rating'].' stars</p>
                </div>
            </div>';
            
            if ($_SESSION['customer_role'] == "admin") {
                echo
                    '<div class="flex">
                        <form method="POST" action="./forms/form_shopping_cart_insert.php">
                            <input type="hidden" name="product_id" value="'.$row['product_id'].'">
                            <input type="hidden" name="product_image" value="'.$row['product_image'].'">
                            <input type="submit" value="Add to cart" class="button">
                        </form>
                        <form method="POST" action="./forms/form_product_update.php">
                            <input type="hidden" name="product_id" value="'.$row['product_id'].'">
                            <input type="hidden" name="product_name" value="'.$row['product_name'].'">
                            <input type="hidden" name="product_price" value="'.$row['product_unit_price'].'">
                            <input type="hidden" name="product_image" value="'.$row['product_image'].'">
                            <input type="submit" value="Update" class="button">
                        </form>
                        <form method="POST" action="./forms/form_product_delete.php">
                            <input type="hidden" name="product_id" value="'.$row['product_id'].'">
                            <input type="hidden" name="product_name" value="'.$row['product_name'].'">
                            <input type="hidden" name="product_price" value="'.$row['product_unit_price'].'">
                            <input type="hidden" name="product_image" value="'.$row['product_image'].'">
                            <input type="submit" value="Delete" class="button">
                        </form>
                    </div>
                </div>';
            } else {
                echo
                    '<div class="flex">
                        <form method="POST" action="./forms/form_shopping_cart_insert.php">
                            <input type="hidden" name="product_id" value="'.$row['product_id'].'">
                            <input type="submit" value="Add to cart" class="button">
                        </form> 
                    </div>
                </div>';
            }
  }
  echo json_encode($products);
}
mysqli_close($conn);

?>